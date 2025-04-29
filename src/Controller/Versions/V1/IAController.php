<?php

namespace App\Controller\Versions\V1;

use App\Repository\TreinoInteligenteRepository;
use App\Repository\UsuariosRepository;
use App\Service\TreinoInteligente\Exercicios;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\GeminiService;
use Symfony\Component\Serializer\SerializerInterface;
use App\Helpers\AuthHelpers;
use Symfony\Component\HttpFoundation\Request;

#[Route('/v1/ia')]
final class IAController extends AbstractController
{

    private $authHelpers;
    private GeminiService $gemini;
    private $serializer;
    private $treinoInteligente;

    public function __construct(AuthHelpers $authHelpers, GeminiService $gemini, SerializerInterface $serializer, TreinoInteligenteRepository $treinoInteligente)
    {
       $this->authHelpers = $authHelpers;
       $this->gemini = $gemini; 
       $this->serializer = $serializer;
       $this->treinoInteligente = $treinoInteligente;
    }


    #[Route('/verificar/preferencias-alimentares', methods:['POST'])]
    public function index(Request $request): JsonResponse
    {

        $this->authHelpers->is_autenticado();

        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();

        $prompt = verificarPreferenciasAlimentar($data['preferencias']);
        
        $gerado = trim(strtolower($this->gemini->gerar($prompt)));
        $gerado = rtrim($gerado, '.');

        if($gerado === "não"){
            return $this->json([
                'message' => "Isso não se encaixa como preferencia alimentar",
            ], 400);
        }


        return $this->json([
            'message' => "Isso se encaixa como uma preferencia alimentar",
        ], 200);
    }


    #[Route("/ficha-treino", methods:['POST'])]
    public function treinoInteligente(Request $request, UsuariosRepository $usuariosRepository)
    {
        $this->authHelpers->is_autenticado();
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $idUsuario = $this->authHelpers->is_autenticado()['id'];
        $prompt = gerarFichaTreino($data);
        $resultado =  preg_replace('/^```html\\n|\\n```$/', '', $this->gemini->gerar($prompt));
        $usuario = $usuariosRepository->findByToken($this->authHelpers->is_autenticado()['token']);

        $fitCoins = $usuario->getCredito() - 100;

        try{
          $this->treinoInteligente->gerarFicha($idUsuario, $data['objetivo'], $prompt, $resultado, 100, $data['nivel'], $data['local']);
          $usuario->setCredito($fitCoins);
          $usuario->setUpdatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
          $usuariosRepository->updateUsuario($usuario);
          return $this->json([
            'message' => 'Ficha de treino criada com sucesso',
        ], 201);

        }catch(\Exception $e){
            return $this->json([
                'message' => 'Ocorreu algum erro inesperado',
                'errors' => $e->getMessage(),
            ], 500);

        }    
    }

    #[Route("/ficha-treino", methods:['GET'])]
    public function listFichas()
    {
        $this->authHelpers->is_autenticado();
        $idUsuario = $this->authHelpers->is_autenticado()['id'];
        $fichas = $this->treinoInteligente->findByIdUsuario($idUsuario);

        if(!$fichas){
            return $this->json([
                'message' => 'Informações Não encontradas',
            ], 404);
        }

        $json = $this->serializer->serialize($fichas, 'json');
        return new JsonResponse($json, 200, [], true);
    }

    #[Route("/ficha-treino/{id}", methods:['GET'])]
    public function listarFicha(int $id)
    {
        $this->authHelpers->is_autenticado();
        $idUsuario = $this->authHelpers->is_autenticado()['id'];
        $ficha = $this->treinoInteligente->findById($id,$idUsuario);

        if(!$ficha){
            return $this->json([
                'message' => 'Informações Não encontradas',
            ], 404);
        }

        $json = $this->serializer->serialize($ficha, 'json');
        return new JsonResponse($json, 200, [], true);
    }


    #[Route("/gerar-exercicios", methods:['POST'])]
    public function gerarExercicios(Request $request, Exercicios $exercicios)
    {
        $this->authHelpers->is_autenticado();
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $idUsuario = $this->authHelpers->is_autenticado()['id'];
        $exercicios = $exercicios->cadastrar($data, $idUsuario);

        return $this->json($exercicios, $exercicios['status']);
    }


   /* #[Route("/ficha-treino/gerar", methods:['POST'])]
    public function nutricaoInteligente(Request $request)
    {
        $this->authHelpers->is_autenticado();
    }*/
}

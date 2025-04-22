<?php

namespace App\Controller\Versions\V1;

use App\Repository\TreinoInteligenteRepository;
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


    #[Route("/ficha-treino/gerar", methods:['POST'])]
    public function treinoInteligente(Request $request)
    {
        $this->authHelpers->is_autenticado();
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $idUsuario = $this->authHelpers->is_autenticado()['id'];
        $prompt = gerarFichaTreino($data);
        $resultado = $this->gemini->gerar($prompt);

        try{
          $this->treinoInteligente->gerarFicha($idUsuario, $data['objetivo'], $prompt, $resultado, 40);
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

   /* #[Route("/ficha-treino/gerar", methods:['POST'])]
    public function nutricaoInteligente(Request $request)
    {
        $this->authHelpers->is_autenticado();
    }*/
}

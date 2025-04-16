<?php

namespace App\Controller\Versions\V1;

use App\Helpers\AuthHelpers;
use App\Repository\PadraoAlimentarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1/padrao-alimentar')]
final class PadraoAlimentarController extends AbstractController
{

    private $auth;
    private $padraoAlimentar;
    private $serializer;

    public function __construct(AuthHelpers $authHelpers, PadraoAlimentarRepository $padraoAlimentarRepository)
    {
      $this->auth = $authHelpers;
      $this->padraoAlimentar = $padraoAlimentarRepository;

    }

    #[Route('/', methods:['GET'])]
    public function index(): JsonResponse
    {

        $this->auth->is_autenticado();
        $usuarioId = $this->auth->is_autenticado()['id'];

        $padraoAlimentar = $this->padraoAlimentar->findByUsuarioId($usuarioId);

        if(!$padraoAlimentar){
            return $this->json([
                'message' => 'Informações Não encontradas',
            ], 404);
        }

        $json = $this->serializer->serialize($padraoAlimentar, 'json');

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/cadastro', methods:['POST'])]
    public function cadastro(Request $request): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $this->auth->is_autenticado();
        $usuarioId = $this->auth->is_autenticado()['id'];

        if($this->padraoAlimentar->findByUsuarioId($usuarioId)){
            return $this->json([
                'message' => 'Usuario com informações de padrão alimentar já cadastradas'
            ], 409);
        }

        $dietaEspc = $data['dietaEspc'];
        $restricao = $data['restricao'];
        $preferencia = $data['preferencias'];

        try{
            $this->padraoAlimentar->addPadraoAlimentar($usuarioId, $dietaEspc, $restricao, $preferencia);
            return $this->json([
                'message' => 'Padrão Alimentar adicionadas com sucesso',
            ], 201);
        }catch(\Exception $e){
            return $this->json([
                'message' => 'Ocorreu algum erro inesperado',
                'errors' => $e->getMessage(),
            ], 500);
        }    
    }

}

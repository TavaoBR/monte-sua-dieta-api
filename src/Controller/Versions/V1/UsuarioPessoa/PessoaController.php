<?php

namespace App\Controller\Versions\V1\UsuarioPessoa;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Helpers\AuthHelpers;
use App\Repository\PessoaRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/v1/pessoa')]
final class PessoaController extends AbstractController
{

    private $authHelpers;
    private $pessoaRepository; 
    private $serializer;
    public function __construct(AuthHelpers $authHelpers, PessoaRepository $pessoaRepository, SerializerInterface $serializer)
    {
      $this->authHelpers = $authHelpers;
      $this->pessoaRepository = $pessoaRepository;
      $this->serializer = $serializer;
    }

    #[Route('/', methods:['GET'])]
    public function index(): JsonResponse
    {
        $this->authHelpers->is_autenticado();
        $usuarioId = $this->authHelpers->is_autenticado()['id'];

        $pessoa = $this->pessoaRepository->findByIdUsuario($usuarioId);

        if(!$pessoa){
            return $this->json([
                'message' => 'Informações Não encontradas',
            ], 404);
        }

        $json = $this->serializer->serialize($pessoa, 'json');

        return new JsonResponse($json, 200, [], true);
    }


    #[Route('/cadastro', methods:['POST'])]
    public function cadastro(Request $request): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $this->authHelpers->is_autenticado();
        $usuarioId = $this->authHelpers->is_autenticado()['id'];
        
        if($this->pessoaRepository->findByIdUsuario($usuarioId)){
            return $this->json([
                'message' => 'Usuario com informações pessoais já cadastradas'
            ], 409);
        }

        $nome = $data['nome'];
        $sobrenome = $data['sobrenome'];
        $idade = $data['idade'];
        $sexo = $data['sexo'];
        $altura = $data['altura'];
        $peso = $data['peso'];

        try{
            $this->pessoaRepository->novaPessoa($usuarioId, $nome, $sobrenome, $idade, $sexo, $altura, $peso);
            return $this->json([
                'message' => 'Informações pessoais adicionadas com sucesso',
            ], 201);

        }catch(\Exception $e){
            return $this->json([
                'message' => 'Ocorreu algum erro inesperado',
                'errors' => $e->getMessage(),
            ], 500);

        }
        
    }
}

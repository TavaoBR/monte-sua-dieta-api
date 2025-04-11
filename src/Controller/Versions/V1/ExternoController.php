<?php

namespace App\Controller\Versions\V1;

use App\Repository\UsuariosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1/externo')]
final class ExternoController extends AbstractController
{

    private $usuariosRepository;

    public function __construct(UsuariosRepository $usuariosRepository)
    {
       $this->usuariosRepository = $usuariosRepository;  
    }

    #[Route('/usuario/cadastro', methods:['POST'])]
    public function cadastroUsuario(Request $request): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();

        $nomeUsuario = $data['usuario'];
        $email = $data['email'];
        $senha = $data['senha'];
        $avatar = $data['avatar'];

        if($this->usuariosRepository->findByEmail($email) OR $this->usuariosRepository->findByNomeUsuario($nomeUsuario)){
          return $this->json([
            'message' => 'Usuario já cadastrado'
          ], 409);
        }

 
        try{
            $this->usuariosRepository->novoUsuario($nomeUsuario,  password_hash($senha,PASSWORD_DEFAULT), $email, $avatar);
            return $this->json([
                'message' => 'Conta criada com sucesso',
            ], 201);

        }catch(\Exception $e){
            return $this->json([
                'message' => 'Ocorreu algum erro inesperado',
                'errors' => $e->getMessage(),
            ], 500);
        }

    }
}

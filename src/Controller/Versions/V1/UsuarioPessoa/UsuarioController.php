<?php

namespace App\Controller\Versions\V1\UsuarioPessoa;

use App\Helpers\AuthHelpers;
use App\Repository\UsuariosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/v1/usuario')]
final class UsuarioController extends AbstractController
{
    private $authHelpers;
    private $usuariosRepository; 
    private $serializer;
    public function __construct(AuthHelpers $authHelpers, UsuariosRepository $usuariosRepository, SerializerInterface $serializer)
    {
      $this->authHelpers = $authHelpers;
      $this->usuariosRepository = $usuariosRepository;
      $this->serializer = $serializer;
    }

    #[Route('/', methods:['GET'])]
    public function perfil(): JsonResponse
    {
        $this->authHelpers->is_autenticado();

        $usuario = $this->usuariosRepository->findByToken($this->authHelpers->is_autenticado()['token']);
     
        // Serializa o objeto antes de retorná-lo
        $json = $this->serializer->serialize($usuario, 'json');

        return new JsonResponse($json, 200, [], true);

    }
    
    #[Route('/', methods:['PUT'])]
    public function editar()
    {
        $this->authHelpers->is_autenticado();
    }

    #[Route('/alterar-senha', methods:['PATCH'])]
    public function alterarSenha()
    {
        $this->authHelpers->is_autenticado();
    }
}

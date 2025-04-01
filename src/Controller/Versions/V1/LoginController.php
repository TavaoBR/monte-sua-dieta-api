<?php

namespace App\Controller\Versions\V1;

use App\Helpers\AuthHelpers;
use App\Repository\UsuariosRepository;
use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/v1/auth')]
final class LoginController extends AbstractController
{
    #[Route('/login', methods:['POST'])]
    public function logar(Request $request, AuthService $authService): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();

        $email = $data['email'];
        $senha = $data['senha'];

        $result = $authService->logar($email, $senha);

        return $this->json($result, $result['statusCode']);
    }

    #[Route('/verifica', methods:['GET'])]
    public function verificaAuth(AuthHelpers $authHelpers): JsonResponse
    {
        $auth = $authHelpers->validarTokeAuth();

        return $this->json($auth, $auth['statusCode']);
    }

    #[Route('/verifica/email', methods:['GET'])]
    public function verificaEmail(UsuariosRepository $usuariosRepository): JsonResponse
    {
        $email = $usuariosRepository->findByEmail('jamesgustavo133@gmail.com');

        return $this->json($email);
    }
}

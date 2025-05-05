<?php

namespace App\Controller\Versions\V1\NutricaoInteligente;

use App\Helpers\AuthHelpers;
use App\Service\NutricaoInteligente\PerfilNutricionalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1/perfil-nutricional')]
final class PerfilNutricionalController extends AbstractController
{
    private $auth;
    private $perfilNutriciol;

    public function __construct(AuthHelpers $authHelpers, PerfilNutricionalService $perfilNutricionalService)
    {
      $this->auth = $authHelpers;
      $this->perfilNutriciol = $perfilNutricionalService;
    }

    #[Route('/', methods:['GET'])]
    public function perfil(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/NutricaoInteligenteController.php',
        ]);
    }

    #[Route('/', methods:['POST'])]
    public function perfilCriar(Request $request): JsonResponse
    {
        $this->auth->is_autenticado();
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $idUsuario = $this->auth->is_autenticado()['id'];
        $perfilNutricional = $this->perfilNutriciol->salvar($data, $idUsuario);
        
        return $this->json($perfilNutricional, $perfilNutricional['status']);
    }
}

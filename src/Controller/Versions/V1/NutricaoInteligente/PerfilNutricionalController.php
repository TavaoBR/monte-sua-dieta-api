<?php

namespace App\Controller\Versions\V1\NutricaoInteligente;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1/perfil-nutricional')]
final class PerfilNutricionalController extends AbstractController
{
    #[Route('/', methods:['GET'])]
    public function perfil(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/NutricaoInteligenteController.php',
        ]);
    }

    #[Route('/', methods:['POST'])]
    public function perfilCriar(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/NutricaoInteligenteController.php',
        ]);
    }
}

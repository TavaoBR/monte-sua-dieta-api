<?php

namespace App\Controller\Versions\V1\NutricaoInteligente;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1/plano-alimentar')]
final class PlanoAlimentarController extends AbstractController
{
    #[Route('/plano/alimentar', name: 'app_plano_alimentar')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlanoAlimentarController.php',
        ]);
    }
}

<?php

namespace App\Controller\Versions\V1;

use App\Service\GeminiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1')]
final class DietaIAController extends AbstractController
{

    private GeminiService $gemini;
    public function __construct(GeminiService $gemini)
    {
       $this->gemini = $gemini; 
    }

    #[Route('/new/dieta')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DietaIAController.php',
        ]);
    }

    #[Route('/monte/dieta/com-ia', methods: ['GET'])]
    public function monteComIa(): JsonResponse
    {

        $result = $this->gemini->gerar('Monte uma dieta para 1 semana, no qual gostaria de aumentar minha massa magra e diminuir percentual de gordura, sou vegano. Observação, monte como se fosse uma lista');

        return $this->json([
            'result' => $result
        ]);
    }
}

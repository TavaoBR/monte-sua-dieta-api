<?php

namespace App\Controller\Versions\V1;

use App\Service\ChatGptService;
use App\Service\GeminiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/v1')]
final class DietaIAController extends AbstractController
{

    private GeminiService $gemini;
    private ChatGptService $chatGpt;
    private $serializer;
    public function __construct(GeminiService $gemini, ChatGptService $chatGpt, SerializerInterface $serializer)
    {
       $this->gemini = $gemini; 
       $this->chatGpt = $chatGpt;
       $this->serializer = $serializer;
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
        $prompt = gerarFicha();
        $gerado = $this->gemini->gerar($prompt);
    
        // Remove possíveis marcas de código
        $limpo = preg_replace('/^```(html|json)?\\n|\\n```$/', '', trim($gerado));
    
        // Tenta decodificar como JSON
        $data = json_decode($limpo, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse(['error' => 'Erro ao processar JSON', 'prompt' => $limpo], 500);
        }
    
        return new JsonResponse($data);
    }
    
}

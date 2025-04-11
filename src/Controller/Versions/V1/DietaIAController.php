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
        

        $prompt = prompt1();
        
        $gerado = $this->gemini->gerar($prompt);

        $html = preg_replace('/^```html\\n|\\n```$/', '', $gerado);

        $json = $this->serializer->serialize($html, 'json');
    
        return new JsonResponse($json, 200, [], true);
    }
    
}

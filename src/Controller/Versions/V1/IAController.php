<?php

namespace App\Controller\Versions\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\GeminiService;
use Symfony\Component\Serializer\SerializerInterface;
use App\Helpers\AuthHelpers;
use Symfony\Component\HttpFoundation\Request;

#[Route('/v1/ia')]
final class IAController extends AbstractController
{

    private $authHelpers;
    private GeminiService $gemini;
    private $serializer;

    public function __construct(AuthHelpers $authHelpers, GeminiService $gemini, SerializerInterface $serializer)
    {
       $this->authHelpers = $authHelpers;
       $this->gemini = $gemini; 
       $this->serializer = $serializer;
    }


    #[Route('/verificar/preferencias-alimentares', methods:['POST'])]
    public function index(Request $request): JsonResponse
    {

        $this->authHelpers->is_autenticado();

        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();

        $prompt = verificarPreferenciasAlimentar($data['preferencias']);
        
        $gerado = trim(strtolower($this->gemini->gerar($prompt)));
        $gerado = rtrim($gerado, '.');

        if($gerado === "não"){
            return $this->json([
                'message' => "Isso não se encaixa como preferencia alimentar",
            ], 400);
        }


        return $this->json([
            'message' => "Isso se encaixa como uma preferencia alimentar",
        ], 200);
    }
}

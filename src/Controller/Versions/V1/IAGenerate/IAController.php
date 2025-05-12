<?php

namespace App\Controller\Versions\V1\IAGenerate;

use App\Service\TreinoInteligente\Exercicios;
use App\Service\TreinoInteligente\FichaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\GeminiService;
use Symfony\Component\Serializer\SerializerInterface;
use App\Helpers\AuthHelpers;
use App\Service\NutricaoInteligente\PlanoAlimentarService;
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


    #[Route('/verificar/preferencias-alimentares', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {

        $this->authHelpers->is_autenticado();

        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();

        $prompt = verificarPreferenciasAlimentar($data['preferencias']);

        $gerado = trim(strtolower($this->gemini->gerar($prompt)));
        $gerado = rtrim($gerado, '.');

        if ($gerado === "não") {
            return $this->json([
                'message' => "Isso não se encaixa como preferencia alimentar",
            ], 400);
        }


        return $this->json([
            'message' => "Isso se encaixa como uma preferencia alimentar",
        ], 200);
    }


    #[Route("/gerar-exercicios", methods: ['POST'])]
    public function gerarExercicios(Request $request, Exercicios $exercicios)
    {
        $this->authHelpers->is_autenticado();
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $idUsuario = $this->authHelpers->is_autenticado()['id'];
        $exercicios = $exercicios->cadastrar($data, $idUsuario);

        return $this->json($exercicios, $exercicios['status']);
    }

    #[Route("/gerar-ficha-treino", methods: ['POST'])]
    public function gerarFicha(Request $request, FichaService $fichaService)
    {
        $this->authHelpers->is_autenticado();
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $idUsuario = $this->authHelpers->is_autenticado()['id'];
        $ficha = $fichaService->cadastrar($data, $idUsuario);

        return $this->json($ficha, $ficha['status']);
    }

    #[Route("/gerar-plano-alimentar", methods: ['POST'])]
    public function gerarPlanoAlimentar(Request $request, PlanoAlimentarService $planoAlimentarService)
    {
        $this->authHelpers->is_autenticado();
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $idUsuario = $this->authHelpers->is_autenticado()['id'];
        $plano = $planoAlimentarService->salvar($data, $idUsuario);
        return $this->json($plano, $plano['status']);
    }

    /* #[Route("/ficha-treino/gerar", methods:['POST'])]
    public function nutricaoInteligente(Request $request)
    {
        $this->authHelpers->is_autenticado();
    }*/
}

<?php

namespace App\Controller\Versions\V1\NutricaoInteligente;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Helpers\AuthHelpers;
use App\Service\NutricaoInteligente\PlanoAlimentarService;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/v1/plano-alimentar')]
final class PlanoAlimentarController extends AbstractController
{
    private $authHelpers;
    private $serializer;
    private $planoAlimentarService;

    public function __construct(
        AuthHelpers $authHelpers,
        SerializerInterface $serializer,
        PlanoAlimentarService $planoAlimentarService
    ) {
        $this->authHelpers = $authHelpers;
        $this->serializer = $serializer;
        $this->planoAlimentarService = $planoAlimentarService;
    }

    #[Route('/', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $this->authHelpers->is_autenticado();

        $idUsuario = $this->authHelpers->is_autenticado()['id'];

        $planos = $this->planoAlimentarService->listarPlanos($idUsuario);

        $json = $this->serializer->serialize($planos['result'], 'json', ['groups' => 'default']);

        return new JsonResponse($json, $planos['status'], [], true);
    }

    #[Route('/{token}', methods: ['GET'])]
    public function listarPlano(string $token)
    {
        $this->authHelpers->is_autenticado();

        $plano = $this->planoAlimentarService->listarPlano($token);

        $json = $this->serializer->serialize($plano['result'], 'json', ['groups' => 'default']);

        return new JsonResponse($json, $plano['status'], [], true);
    }
}

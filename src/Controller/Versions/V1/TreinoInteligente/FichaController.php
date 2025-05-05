<?php

namespace App\Controller\Versions\V1\TreinoInteligente;

use App\Repository\ExerciciosFichaRepository;
use App\Service\TreinoInteligente\FichaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Helpers\AuthHelpers;

#[Route('/v1/fichas')]
final class FichaController extends AbstractController
{

    private $authHelpers;
    private $serializer;
    private $fichaService;

    public function __construct(
        AuthHelpers $authHelpers,
        SerializerInterface $serializer,
        FichaService $fichaService
    )
    {
        $this->authHelpers = $authHelpers;
        $this->serializer = $serializer;
        $this->fichaService = $fichaService;
    }

    #[Route('/', methods:['GET'])]
    public function listarFichas()
    {
        $this->authHelpers->is_autenticado();

        $idUsuario = $this->authHelpers->is_autenticado();['id'];

        $fichas = $this->fichaService->listarFichas($idUsuario);

        $json = $this->serializer->serialize($fichas, 'json', ['groups' => 'default']);
        
       return new JsonResponse($json, $fichas['status'], [], true);
    }

    #[Route('/exercicios/{token}', methods:['GET'])]
    public function exerciciosFicha($token): JsonResponse
    {
        $this->authHelpers->is_autenticado();

        $exercicios = $this->fichaService->listarExercicios($token);

        $json = $this->serializer->serialize($exercicios, 'json', ['groups' => 'default']);
        
        return new JsonResponse($json, $exercicios['status'], [], true);
    }
}

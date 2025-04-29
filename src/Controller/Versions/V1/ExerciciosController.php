<?php

namespace App\Controller\Versions\V1;

use App\Service\TreinoInteligente\Exercicios;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UsuariosRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\Helpers\AuthHelpers;
use Symfony\Component\HttpFoundation\Request;

#[Route('/v1/exercicios')]
final class ExerciciosController extends AbstractController
{
    
    private $authHelpers;
    private $serializer;
    private $exerciosService;

    public function __construct(
        AuthHelpers $authHelpers,
        SerializerInterface $serializer,
        Exercicios $exercicios
    )
    {
        $this->authHelpers = $authHelpers;
        $this->serializer = $serializer;
        $this->exerciosService = $exercicios;
    }


    #[Route("/listar/musculos", methods:['GET'])]
    public function listarMusculosEscolhidos()
    {
        $this->authHelpers->is_autenticado();
        $idUsuario = $this->authHelpers->is_autenticado();['id'];
        $listar = $this->exerciosService->listarMusculos($idUsuario);
        $json = $this->serializer->serialize($listar, 'json', ['groups' => 'default']);
        return new JsonResponse($json, $listar['status'], [], true);
    }

    #[Route("/listar/exercicios/{id}", methods:['GET'])]
    public function listarExercicios(int $id)
    {
        $this->authHelpers->is_autenticado();
        $idUsuario = $this->authHelpers->is_autenticado();['id'];
        $listar = $this->exerciosService->listarExercicios($id, $idUsuario);
        $json = $this->serializer->serialize($listar, 'json', ['groups' => 'default']);
        return new JsonResponse($json, $listar['status'], [], true);
    }
}

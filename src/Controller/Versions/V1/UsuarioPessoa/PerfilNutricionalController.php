<?php

namespace App\Controller\Versions\V1\UsuarioPessoa;

use App\Helpers\AuthHelpers;
use App\Service\NutricaoInteligente\PerfilNutricionalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/v1/perfil-nutricional')]
final class PerfilNutricionalController extends AbstractController
{
    private $auth;
    private $perfilNutriciol;
    private $serializer;

    public function __construct(AuthHelpers $authHelpers, PerfilNutricionalService $perfilNutricionalService, SerializerInterface $serializerInterface)
    {
        $this->auth = $authHelpers;
        $this->perfilNutriciol = $perfilNutricionalService;
        $this->serializer = $serializerInterface;
    }

    #[Route('/', methods: ['GET'])]
    public function perfil(): JsonResponse
    {
        $this->auth->is_autenticado();
        $idUsuario = $this->auth->is_autenticado()['id'];
        $perfil = $this->perfilNutriciol->buscarDados($idUsuario);
        $json = $this->serializer->serialize($perfil, 'json', ['groups' => 'default']);
        return new JsonResponse($json, $perfil['status'], [], true);
    }

    #[Route('/adicionar', methods: ['POST'])]
    public function perfilCriar(Request $request): JsonResponse
    {
        $this->auth->is_autenticado();
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $idUsuario = $this->auth->is_autenticado()['id'];
        $perfilNutricional = $this->perfilNutriciol->salvar($data, $idUsuario);

        return $this->json($perfilNutricional, $perfilNutricional['status']);
    }
}

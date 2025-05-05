<?php

namespace App\Controller\Versions\V1\UsuarioPessoa;

use App\Helpers\AuthHelpers;
use App\Repository\PacotesFitCoinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/v1/fit-coins')]
final class FitCoinsController extends AbstractController
{

    private $authHelpers;
    private $serializer;
    public function __construct(AuthHelpers $authHelpers, SerializerInterface $serializer)
    {
      $this->authHelpers = $authHelpers;
      $this->serializer = $serializer;
    }

    #[Route('/', methods:['GET'])]
    public function index(PacotesFitCoinsRepository $pacotesFitCoinsRepository): JsonResponse
    {

        $this->authHelpers->is_autenticado();

        $result = $pacotesFitCoinsRepository->findAll();

        $data = array_map(fn($item) => [
            'id' => $item->getId(),
            'Titulo' => $item->getTitulo(),
            'Descricao' => $item->getDescricao(),
            'Valor' => $item->getValor(),
            'QtdCoins' => $item->getQtdCoins(),
        ], $result);

        return $this->json($data, 200);
    }

    #[Route('/{id}', methods:['GET'])]
    public function fitCoinId(int $id, PacotesFitCoinsRepository $pacotesFitCoinsRepository)
    {
        $this->authHelpers->is_autenticado();
        $result = $pacotesFitCoinsRepository->findById($id);

        if(!$result){
          return $this->json([
            'message' => 'Informação Não Encontrada'
          ], 404);
        }

        $json = $this->serializer->serialize($result, 'json');

        return new JsonResponse($json, 200, [], true);

    }
}

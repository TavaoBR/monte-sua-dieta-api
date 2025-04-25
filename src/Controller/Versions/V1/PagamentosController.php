<?php

namespace App\Controller\Versions\V1;

use App\Helpers\AuthHelpers;
use App\Service\Payments\MercadoPagoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1/pagamentos')]
final class PagamentosController extends AbstractController
{
    private $apiMercado;
    private $authHelpers;

    public function __construct(AuthHelpers $authHelpers, MercadoPagoService $mercadoPagoService)
    {
      $this->apiMercado = $mercadoPagoService;
      $this->authHelpers = $authHelpers;
    }

    #[Route('/mercado-pago', methods:['POST'])]
    public function gerarLinkMercado(Request $request)
    {
        $this->authHelpers->is_autenticado();
        $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
        $idUsuario = $this->authHelpers->is_autenticado()['id'];

        $gerar = $this->apiMercado->gerarLinkPagamento($data['pacote'], $idUsuario);

        return $this->json($gerar, $gerar['statusCode']);

    }

}

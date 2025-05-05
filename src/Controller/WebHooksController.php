<?php

namespace App\Controller;

use App\Service\Payments\MercadoPagoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/web-hooks')]
final class WebHooksController extends AbstractController
{
    #[Route('/mercado-pago', methods:['POST'])]
    public function index(Request $request, MercadoPagoService $mercadoPagoService): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') === 'application/json')
        ? $request->toArray()
        : $request->request->all();

        $idPagamento = $data['data']['id'];

        $mercadoPagoService->buscarIdPagamento($idPagamento);

        return $this->json(['status' => 'received'], 200);
    }

    #[Route('/mercado-pago/checkout-transparente', methods:['POST'])]
    public function checkoutTransparente(Request $request, MercadoPagoService $mercadoPagoService): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') === 'application/json')
        ? $request->toArray()
        : $request->request->all();

        $idPagamento = $data['data']['id'];

        $mercadoPagoService->buscarIdPagamento($idPagamento);

        return $this->json(['status' => 'received'], 200);
    }

}

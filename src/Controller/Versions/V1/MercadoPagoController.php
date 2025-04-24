<?php

namespace App\Controller\Versions\V1;

use App\Service\Payments\MercadoPagoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1/mercado-pago')]
final class MercadoPagoController extends AbstractController
{
    #[Route('/gerar-pagamento', methods:['POST'])]
    public function index(MercadoPagoService $mercadoPagoService): JsonResponse
    {
        $linkPagamento = $mercadoPagoService->testLinkPagamento();

        return $this->json([
            'result' => $linkPagamento,
        ]);
    }
}

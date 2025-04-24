<?php

namespace App\Controller\Versions\V1;

use App\Helpers\AuthHelpers;
use App\Service\Payments\MercadoPagoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route('/mercado-pago/webhook', methods: ['POST'])]
    public function webhookMercadoPago(Request $request): JsonResponse
    {
        $data = ($request->headers->get('Content-Type') === 'application/json')
            ? $request->toArray()
            : $request->request->all();
    
        // Caminho para salvar o arquivo
        $logPath = $this->getParameter('kernel.project_dir') . '/var/log/mercado_pago_webhook.log';
    
        // Conteúdo para salvar (com data e hora)
        $logData = "[" . (new \DateTime())->format('Y-m-d H:i:s') . "]\n" .
                   json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n\n";
    
        // Salva no arquivo (append)
        file_put_contents($logPath, $logData, FILE_APPEND);
    
        return $this->json(['status' => 'received'], 200);
    }
}

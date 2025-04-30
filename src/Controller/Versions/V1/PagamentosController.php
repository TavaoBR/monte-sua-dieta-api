<?php

namespace App\Controller\Versions\V1;

use App\Helpers\AuthHelpers;
use App\Repository\PagamentoPacoteFitCoinsRepository;
use App\Service\Payments\MercadoPago\CheckoutTransparenteService;
use App\Service\Payments\MercadoPagoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1/pagamentos')]
final class PagamentosController extends AbstractController
{
    private $apiMercado;
    private $authHelpers;
    private $checkoutTransparente;
    public function __construct(
      AuthHelpers $authHelpers, 
      MercadoPagoService $mercadoPagoService,
      CheckoutTransparenteService $checkoutTransparente
    )
    {
      $this->apiMercado = $mercadoPagoService;
      $this->authHelpers = $authHelpers;
      $this->checkoutTransparente = $checkoutTransparente;
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


    #[Route('/mercado-pago/pix', methods:['POST'])]
    public function gerarPix(Request $request)
    {
      $this->authHelpers->is_autenticado();
      $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();
      $idUsuario = $this->authHelpers->is_autenticado()['id'];
      $gerar = $this->checkoutTransparente->criarPix($data,$idUsuario);

      return $this->json($gerar, $gerar['status']);
    }


    #[Route('/mercado-pago/pix/foi-pago', methods:['POST'])]
    public function verificarStatusPagamento(Request $request, PagamentoPacoteFitCoinsRepository $pagamentoPacoteFitCoinsRepository)
    {

      $this->authHelpers->is_autenticado();

      $data = ($request->headers->get('Content-Type') == 'application/json') ? $request->toArray() : $request->request->all();

      $correlationId = $data['correlationId'];

      $find = $pagamentoPacoteFitCoinsRepository->findByCorrelationId($correlationId);

      if(!$find){
       return $this->json([
        "message" => "Transação Não Encontrada"
       ], 404);
      }

      return $find->getStatus() === 'approved'
      ? $this->json(['message' => 'Pagamento Aprovado'], 200)
      : $this->json(['message' => 'Pagamento Pendente'], 202);

    }

}

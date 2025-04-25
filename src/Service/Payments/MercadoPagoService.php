<?php 

namespace App\Service\Payments;

use App\Repository\PacotesFitCoinsRepository;
use App\Repository\PagamentoPacoteFitCoinsRepository;
use App\Repository\UsuariosRepository;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoService 
{

 private $usuarioRepository;
 private $paymentsRepository;
 private $pacotesRepository;   

 public function __construct(
    PacotesFitCoinsRepository $pacotesFitCoinsRepository,
    UsuariosRepository $usuariosRepository,
    PagamentoPacoteFitCoinsRepository $paymentsRepository
 ) {
    $this->usuarioRepository = $usuariosRepository;
    $this->paymentsRepository = $paymentsRepository;
    $this->pacotesRepository = $pacotesFitCoinsRepository;
 }   

 public function gerarLinkPagamento($idPacote, $idUsuario)
 {

    $pacote = $this->pacotesRepository->findById($idPacote);

    if(!$pacote){
      return [
        'statusCode' => 404,
        'message' => 'Informações Não Encontradas'
      ]; 
    }

    MercadoPagoConfig::setAccessToken($_ENV['MERCADO_PAGO_TOKEN']);
    $client = new PreferenceClient();
    $preference = $client->create([
       "items" => [[
        "id" => $pacote->getId(),
        "title" => $pacote->getTitulo(),
        "description" => $pacote->getDescricao(),
        "quantity" => 1,
        "currency_id" => "BRL",
        "unit_price" => $pacote->getValor()
       ]],
       "back_urls"=> [
              "success" => "https://test.com/success",
              "failure" => "https://test.com/failure",
              "pending" => "https://test.com/pending"
         ],
       "external_reference" => $this->generateGUID()  
    ]);

    $external = $preference->external_reference;
    $init_point = $preference->init_point;

    $json = json_encode($preference);
    $array = json_decode($json, true);

    try{
        $this->paymentsRepository->gerarPagamentoMercadoPago($idUsuario, $idPacote, $external, $array);
      return [
        'statusCode' => 201,
        'initPoint' => $init_point,
        'message' => 'Pagamento Gerado com sucesso'
      ];
    }catch(\Exception $e){
       return [
        'statusCode' => 500,
        'message' => 'Ocorreu algum erro inesperado',
        'errors' => $e->getMessage()
       ];
    }

    
 }


 public function buscarIdPagamento($idPagamento)
 {
   MercadoPagoConfig::setAccessToken($_ENV['MERCADO_PAGO_TOKEN']);
   $client = new PaymentClient();
   $payment = $client->get($idPagamento);

   $correlationId = $payment->external_reference;
   $metodoPagamento = $payment->payment_method->id ?? 'desconhecido';
   $status = $payment->status;
   $json = json_encode($payment);
   $array = json_decode($json, true);

   $pagamento = $this->paymentsRepository->findByCorrelationId($correlationId);

   $pacoteFiCoinsId = $pagamento->getIdFitCoins();
   $usuarioEntity = $pagamento->getIdUsuario();

   $pacoteFitCoins = $this->pacotesRepository->findById($pacoteFiCoinsId->getId());

   if($status === "approved"){
      $usuario = $this->usuarioRepository->findById($usuarioEntity->getId());
      $fitCoins = $usuario->getCredito() + $pacoteFitCoins->getQtdCoins();
      $pagamento->setMetodoPagamento($metodoPagamento);
      $pagamento->setIdPagamentoMercadoPago($idPagamento);
      $pagamento->setStatus($status);
      $pagamento->setMetadataJson($array);
      $pagamento->setUpdatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
      $usuario->setCredito($fitCoins);
      $usuario->setUpdatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
      $this->paymentsRepository->updatePagamento($pagamento);
      $this->usuarioRepository->updateUsuario($usuario);
   } 


 }

 function generateGUID()
 {
     if (function_exists('com_create_guid') === true) {
         return trim(com_create_guid(), '{}');
     }

     return sprintf(
         '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
         mt_rand(0, 65535),
         mt_rand(0, 65535),
         mt_rand(0, 65535),
         mt_rand(16384, 20479),
         mt_rand(32768, 49151),
         mt_rand(0, 65535),
         mt_rand(0, 65535),
         mt_rand(0, 65535)
     );
 }
 
}
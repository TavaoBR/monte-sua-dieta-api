<?php 

namespace App\Service\Payments;

use App\Repository\PacotesFitCoinsRepository;
use App\Repository\PaymentsRepository;
use App\Repository\UsuariosRepository;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
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
    PaymentsRepository $paymentsRepository
 ) {
    $this->usuarioRepository = $usuariosRepository;
    $this->paymentsRepository = $paymentsRepository;
    $this->pacotesRepository = $pacotesFitCoinsRepository;
 }   

 public function testLinkPagamento()
 {
    MercadoPagoConfig::setAccessToken($_ENV['MERCADO_PAGO_TOKEN']);
    $client = new PreferenceClient();
    $preference = $client->create([
        "items" => [[
          "id" => "1234",
          "title" => "Compra de FitCoins",
          "description" => "Compra de pacote de FitCoins",
          "quantity" => 1,
          "currency_id" => "BRL",
          "unit_price" => 5.00
        ]],
        "back_urls"=> [
              "success" => "https://test.com/success",
              "failure" => "https://test.com/failure",
              "pending" => "https://test.com/pending"
         ],
         "auto_return" => "all"
      ]);

    return $preference;
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

    $usuario = $this->usuarioRepository->findById($idUsuario);

    MercadoPagoConfig::setAccessToken($_ENV['MERCADO_PAGO_TOKEN']);
    $client = new PreferenceClient();
    $preference = $client->create([
       "items" => [[
        "id" => $this->generateGUID(),
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
    ]);

    $prefId = $preference->id;
    $init_point = $preference->init_point;
    $fitCoins = $usuario->getCredito() + $pacote->getQtdCoins();

    $json = json_encode($preference);
    $array = json_decode($json, true);

    try{
        $this->paymentsRepository->novoPagamentoMP($idUsuario, $prefId, $array);
        $usuario->setCredito($fitCoins);
        $usuario->setUpdatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
        $this->usuarioRepository->updateUsuario($usuario);
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
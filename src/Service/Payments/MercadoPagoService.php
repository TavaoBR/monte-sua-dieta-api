<?php 

namespace App\Service\Payments;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoService 
{

 public function __construct() {

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


 public function gerarLinkPagamento(){

 }
}
<?php

namespace App\Service\Payments\MercadoPago;
use App\Repository\PacotesFitCoinsRepository;
use App\Repository\PagamentoPacoteFitCoinsRepository;
use App\Repository\UsuariosRepository;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class CheckoutTransparenteService
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


    public function criarPix(array $data, $idUsuario)
    {
        $idPacote = $data['pacote'];

        $pacote = $this->pacotesRepository->findById($idPacote);

        if(!$pacote){
          return [
            'status' => 404,
            'message' => 'Informações Não Encontradas'
          ]; 
        }

        $usuario = $this->usuarioRepository->findById($idUsuario);

        if(!$usuario){
            return [
              'status' => 404,
              'message' => 'Informações Não Encontradas'
            ]; 
          }

        MercadoPagoConfig::setAccessToken($_ENV['MERCADO_PAGO_TOKEN_TRANSPARENTE']);
    
        $client = new PaymentClient();
    
        $payment = $client->create([
            "transaction_amount" => $pacote->getValor(),
            "description" => $pacote->getDescricao(),
            "payment_method_id" => "pix",
            "payer" => [
                "first_name" => $data['nome'],
                "last_name" => $data['sobrenome'],
                "email" => $usuario->getEmail(),
                "identification" => [
                    "type" => "CPF",
                    "number" => $data['cpf']
                ]
            ],  // Colocando currency_id diretamente no nível da transação
            "additional_info" => [
                "items" => [
                    [
                        "id" => $pacote->getId(), // ID interno do seu sistema
                        "title" => $pacote->getTitulo(), // Nome do produto/pacote
                        "description" => $pacote->getDescricao(),
                        "quantity" => 1,
                        "unit_price" => $pacote->getValor(),
                        "category_id" => "services"
                    ]
                ]
            ],
            "external_reference" => $this->generateGUID()
        ]);
    
        $payload = $payment->point_of_interaction->transaction_data->qr_code;
        $qrcode = $payment->point_of_interaction->transaction_data->qr_code_base64;

        $external = $payment->external_reference;

        $json = json_encode($payment);
        $array = json_decode($json, true);

        try{
            $this->paymentsRepository->gerarPagamentoMercadoPago($idUsuario, $idPacote, $external, $array);
            return [
                'status' => 201,
                'qrcode' => $qrcode,
                'payload' => $payload,
                'correlationId' => $external,
                'message' => 'Pagamento Pix Gerado com Sucesso'
              ];  
        }catch(\Exception $e){
            return [
             'status' => 500,
             'message' => 'Ocorreu algum erro inesperado',
             'errors' => $e->getMessage()
            ];
         }

    }


    public function cartaoCredito()
    {
        
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
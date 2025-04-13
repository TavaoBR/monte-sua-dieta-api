<?php

namespace App\Helpers;

use App\Service\AuthService;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthHelpers 
{
    private $authService;
    
    public function __construct(AuthService $authService)
    {
      $this->authService = $authService;
    }
    
    public function validarTokeAuth()
    {
        $headers = getallheaders();

        // Converta todas as chaves do array para letras minúsculas (opcional)
        $headers = array_change_key_case($headers, CASE_LOWER);

        $headers = str_replace('=', '', $headers);

        
        if (!isset($headers['x-monte-ia-fit-token'])) {
            return [
                'statusCode' => 400,
                'message' => 'Token inválido: cabeçalho ausente.',
                'headers' => $headers
            ];
        }

        $token = $headers['x-monte-ia-fit-token'];
        $auth = $this->authService->autenticar($token);

        return $auth ? 
            ['statusCode' => 200, 'message' => 'Autorizado.'] :
            ['statusCode' => 401, 'message' => 'Não autorizado.', 'headers' => $headers];
    }

    public function is_autenticado()
    {
        $headers = getallheaders();

        // Converta todas as chaves do array para letras minúsculas (opcional)
        $headers = array_change_key_case($headers, CASE_LOWER);

        $headers = str_replace('=', '', $headers);

        if(!isset($headers['x-monte-ia-fit-token'])){
            throw new UnauthorizedHttpException('Token inválido: cabeçalho ausente.');     
        }
        
        $token = $headers['x-monte-ia-fit-token'];
        $auth = $this->authService->autenticar($token);

        if($auth === false){
            throw new UnauthorizedHttpException('Token invalido');
        }
        
        return $auth;

    }
}
<?php

namespace App\Service\NutricaoInteligente;

use App\Repository\PlanoAlimentarRepository;
use App\Repository\UsuariosRepository;
use App\Service\GeminiService;

class PlanoAlimentarService
{
    private $usuario;
    private $planoAlimentar;
    private $gemini;
    public function __construct(
        UsuariosRepository $usuariosRepository,
        PlanoAlimentarRepository $planoAlimentarRepository,
        GeminiService $geminiService
    ) {
        $this->usuario = $usuariosRepository;
        $this->planoAlimentar = $planoAlimentarRepository;
        $this->gemini = $geminiService;
    }

    private function gerarPlano(array $data)
    {
        $prompt = gerarPlanoAlimentar($data);
        $gerado = $this->gemini->gerar($prompt);
        $limpo = preg_replace('/^```(html|json)?\\n|\\n```$/', '', trim($gerado));
        $data = json_decode($limpo, true);

        if (json_last_error() != JSON_ERROR_NONE) {
            return [
                'status' => 500,
                'message' => 'Erro ao processar JSON'
            ];
        }

        return $data;
    }

    public function salvar(array $data, $idUsuario)
    {
        $plano = $this->gerarPlano($data);

        $usuario = $this->usuario->findById($idUsuario);

        if (!$usuario) {
            return [
                "status" => 404,
                "message" => "Informação Não Encontrada"
            ];
        }

        if ($usuario->getCredito() < 400) {
            return [
                "status" => 403,
                "message" => "Você não possui FitCoins suficientes"
            ];
        }

        try {
            $this->planoAlimentar->addPlanoAlimentar($idUsuario, $plano, $data['nomePlano'], $this->generateGUID());
            $fitCoins = $usuario->getCredito() - 400;
            $usuario->setCredito($fitCoins);
            $usuario->setUpdatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
            $this->usuario->updateUsuario($usuario);

            return [
                "status" => 201,
                "message" => "Plano Alimentar criado com sucesso",
            ];
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'message' => 'Ocorreu algum erro inesperado',
                'errors' => $e->getMessage(),
            ];
        }
    }


    public function listarPlanos(int $idUsuario)
    {
        $listar = $this->planoAlimentar->findByIdUsuario($idUsuario);

        if (!$listar) {
            return [
                'status' => 404,
                'message' => 'Informação Não Encontrada'
            ];
        }

        return [
            'status' => 200,
            'result' => $listar
        ];
    }

    public function listarPlano(string $token)
    {
        $listar = $this->planoAlimentar->findByToken($token);

        if (!$listar) {
            return [
                'status' => 404,
                'message' => 'Informação Não Encontrada'
            ];
        }

        return [
            'status' => 200,
            'result' => $listar
        ];
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

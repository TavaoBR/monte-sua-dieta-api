<?php

namespace App\Service\NutricaoInteligente;

use App\Repository\PerfilNutricionalRepository;
use App\Repository\UsuariosRepository;

class PerfilNutricionalService
{
    private $perfilNutricional;
    private $usuario;

    public function __construct(PerfilNutricionalRepository $perfilNutricionalRepository, UsuariosRepository $usuariosRepository)
    {
        $this->perfilNutricional = $perfilNutricionalRepository;
        $this->usuario = $usuariosRepository;
    }

    public function salvar(array $data, int $idUsuario)
    {

        $usuario = $this->usuario->findById($idUsuario);

        if (!$usuario) {
            return [
                'status' => 404,
                'message' => 'Informações Não Encontradas'
            ];
        }

        if ($this->perfilNutricional->findByIdUsuario($idUsuario)) {
            return [
                'status' => 409,
                'message' => 'Usuario com informações já cadastradas'
            ];
        }

        try {
            $this->perfilNutricional->novoPerfil($idUsuario, $data);
            $fitCoins = $usuario->getCredito() + 200;
            $usuario->setCredito($fitCoins);
            $usuario->setUpdatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
            $this->usuario->updateUsuario($usuario);
            return [
                'status' => 201,
                'message' => 'Perfil Nutricional Criado com sucesso'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'message' => 'Ocorreu algum erro inesperado',
                'errors' => $e->getMessage()
            ];
        }
    }

    public function buscarDados(int $idUsuario)
    {

        $perfil = $this->perfilNutricional->findByIdUsuario($idUsuario);
        if (!$perfil) {
            return [
                'status' => 404,
                'message' => 'Informações Não Encontradas'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Informações Encontradas',
            'result' => $perfil
        ];
    }
}

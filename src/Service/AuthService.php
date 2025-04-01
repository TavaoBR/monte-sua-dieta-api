<?php 

namespace App\Service;

use App\Entity\LoginSession;
use App\Repository\UsuariosRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService 
{
    private $usuariosRepository;
    //private $loginSession;
    private $passwordHasher;

    public function __construct(
        UsuariosRepository $usuariosRepository,
        //LoginSession $loginSession,
        UserPasswordHasherInterface $passwordHasher,
    )
    {
       $this->usuariosRepository = $usuariosRepository;
       //$this->loginSession = $loginSession;   
       $this->passwordHasher = $passwordHasher;
    }

    public function autenticar(string $token)
    {
       $session = $this->usuariosRepository->findByToken($token);
       if($session != null){
         return [
            'id' => $session->getId(),
            'nomeUsuario' => $session->getNomeUsuario(),
            'token' => $session->getToken()
         ];
       }else{ 
        return false;
       }
    }

    public function logar(string $email, string $senha)
    {
        $usuario = $this->usuariosRepository->findByEmail($email);
        

        if(!$usuario)
        {
            return [
                'statusCode' => 404,
                'message' => 'Usuário não encontrado.' 
            ];
        } 

        if($usuario->getTentativas() === 5) 
        {
            return [
                'statusCode' => 403,
                'message' => 'Conta bloqueada após várias tentativas de login inválidas.'
            ];
        }


        if (!password_verify($senha, $usuario->getSenha())) {
            $usuario->setTentativas($usuario->getTentativas() + 1);
            $this->usuariosRepository->updateUsuario($usuario);
            return [
                'statusCode' => 403,
                'message' => 'Senha inválida.',
            ];
        }

        $token = $this->generateGUID();

        $usuario->setTentativas(0);
        $usuario->setToken($token);
        $usuario->setUpdatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));

        $this->usuariosRepository->updateUsuario($usuario);

        return [
            'statusCode' => 200,
            'message' => 'Login realizado com sucesso.',
            'token' => $token,
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
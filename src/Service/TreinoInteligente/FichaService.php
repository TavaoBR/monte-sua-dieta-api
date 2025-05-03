<?php

namespace App\Service\TreinoInteligente;

use App\Repository\ExerciciosFichaRepository;
use App\Repository\FichaTreinoRepository;
use App\Repository\UsuariosRepository;
use App\Service\GeminiService;

class FichaService
{
    private $gemini;
    private $ficha;
    private $fichaExercicio;
    private $usuario;

    public function __construct(
        GeminiService $geminiService,
        FichaTreinoRepository $fichaTreinoRepository,
        ExerciciosFichaRepository $exerciciosFichaRepository,
        UsuariosRepository $usuariosRepository
    ){
      $this->gemini = $geminiService;
      $this->ficha = $fichaTreinoRepository;
      $this->fichaExercicio = $exerciciosFichaRepository;
      $this->usuario = $usuariosRepository;
    }

    private function gerarExerciciosFicha(array $data)
    {
        $prompt = gerarFichaExercicios($data);
        $gerado = $this->gemini->gerar($prompt);
        $limpo = preg_replace('/^```(html|json)?\\n|\\n```$/', '', trim($gerado));
        $data = json_decode($limpo, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            return [
                'status' => 500,
                'message' => 'Erro ao processar JSON'
            ];
        }
    
        // Salvar o conteúdo do $data em um arquivo
        //file_put_contents(__DIR__ . '/gerar_exercicios_ficha_data.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $data;
    }

    public function cadastrar(array $data, $idUsuario)
    {
       $exercicios = $this->gerarExerciciosFicha($data);

       if (!is_array($exercicios) || !isset($exercicios[0]) || !is_array($exercicios[0])) {
        return [
            'status' => 500,
            'message' => 'Resposta da IA inválida, tente novamente daqui a pouco',
            'errors' => $exercicios,
        ];
      }

      $usuario = $this->usuario->findById($idUsuario);

      if(!$usuario){
        return [
          "status" => 404,
          "message" => "Informação Não Encontrada"
        ];
       }

       try{

        $ficha = $this->ficha->nova($idUsuario, $data, generateGUID());

        $idFicha = $ficha->getId();

        foreach($exercicios as $exercicio){
          $this->fichaExercicio->novo($idFicha, $exercicio, $exercicio['exercicios'], $ficha->getToken());
        }

        $fitCoins = $usuario->getCredito() - 400;
        $usuario->setCredito($fitCoins);
        $usuario->setUpdatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
        $this->usuario->updateUsuario($usuario);

        return [
            "status" => 201,
            "message" => "Ficha Criada com sucesso", 
        ]; 

       }catch(\Exception $e){
        return [
            'status' => 500,
            'message' => 'Ocorreu algum erro inesperado',
            'errors' => $e->getMessage(),
        ];
       }

    }

    public function listarFichas($idUsuario)
    {
        $listar = $this->ficha->findByIdUsuario($idUsuario);

        if(!$listar){
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

    public function listarExercicios($token)
    {
       $listar = $this->fichaExercicio->findByToken($token);

       if(!$listar){
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
}
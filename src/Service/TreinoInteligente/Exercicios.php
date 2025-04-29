<?php 

namespace App\Service\TreinoInteligente;

use App\Repository\GrupoMuscularPrioritarioRepository;
use App\Repository\ListaExerciciosRepository;
use App\Repository\UsuariosRepository;
use App\Service\GeminiService;

class Exercicios 
{
    private $gemini;
    private $grupoMuscular;
    private $listaExercicios;
    private $usuario;

    public function __construct(
        GeminiService $geminiService,
        GrupoMuscularPrioritarioRepository $grupoMuscularPrioritarioRepository,
        ListaExerciciosRepository $listaExerciciosRepository,
        UsuariosRepository $usuariosRepository
    ){
      $this->gemini = $geminiService;
      $this->grupoMuscular = $grupoMuscularPrioritarioRepository;
      $this->listaExercicios = $listaExerciciosRepository;
      $this->usuario = $usuariosRepository;
    }
 
    private function gerarExercicios(array $array)
    {
        $prompt = gerarExercicios($array);
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
        //file_put_contents(__DIR__ . '/gerar_exercicios_data.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
        return $data;
    }

    public function cadastrar(array $array, $idUsuario)
    {
       $exercicios = $this->gerarExercicios($array);

       if (!is_array($exercicios) || !isset($exercicios[0]) || !is_array($exercicios[0])) {
        return [
            'status' => 500,
            'message' => 'Resposta da IA inválida',
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

        $grupoMuscular = $this->grupoMuscular->novo(
            $idUsuario,
            $array['musculo'],
            $array['nivel'],
            200,
            $array['obj']
           );
    
           $idGrupo = $grupoMuscular->getId();
    
           foreach($exercicios as $exercicio){
            $this->listaExercicios->novo(
                $idUsuario, 
                $idGrupo,
                $exercicio['exercicio'],
                $exercicio['musculoAtivado'],
                $exercicio['equipamentoNecessario'],
                $exercicio['series'],
                $exercicio['repeticoes'],
                $exercicio['nivelDificuldade'],
                $exercicio['token'],
                $exercicio['comoExecutar'],
            );
           }

           $fitCoins = $usuario->getCredito() - 200;
           $usuario->setCredito($fitCoins);
           $usuario->setUpdatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
           $this->usuario->updateUsuario($usuario);

           return [
            "status" => 201,
            "message" => "Exercicios Criados", 
           ]; 

       }catch(\Exception $e){
        return [
            'status' => 500,
            'message' => 'Ocorreu algum erro inesperado',
            'errors' => $e->getMessage(),
        ];
       }
       
    }

    public function listarMusculos($idUsuario)
    {
       $listar = $this->grupoMuscular->findByIdUsuario($idUsuario);
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


    public function listarExercicios($idGrupo, $idUsuario)
    {
        $listar = $this->listaExercicios->findByIdGrupoAndIdUsuario($idGrupo,$idUsuario);
        if(!$listar){
            return [
             'status' => 404,
             'message' => 'Informação Não Encontrada'
            ];
        }
        
        $grupo = $this->grupoMuscular->findById($idGrupo);
 
        return [
         'status' => 200,
         'result' => $listar,
         'grupo' => $grupo->getGrupoMuscular()        
        ];
    }

}
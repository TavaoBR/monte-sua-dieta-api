<?php

function gerarFicha()
{
    $prompt = <<<PROMPT
    Gere uma ficha de treino personalizada com base nas informações abaixo:
    
    Nome: Gustavo Fagundes  
    Idade: 24 anos  
    Sexo: Masculino  
    Altura: 170 cm  
    Peso: 85 kg  
    Objetivo: Hipertrofia com foco em força e definição  
    Nível de experiência: Iniciante  
    Frequência semanal: 4x por semana  
    Local de treino: Academia  
    Foco principal: Parte Superior do corpo  
    Tempo por treino: Máximo 60 minutos  
    Quantidade de exercícios por dia: 5  
    Deseja incluir cardio? Sim  
    Cardio preferido: bicicleta ergométrica  
    
    Instruções para a ficha:
    - Escolha uma divisão de treino adequada ao nível e objetivo do usuário (ex: ABC, AB, Full Body).
    - Respeite a frequência semanal informada.
    - Cada dia de treino deve conter:
      - Dia da semana
      - Cardio
      - Grupo muscular foco do dia
      - Lista de exercícios, cada um com:
        - Nome
        - Músculo principal ativado
        - Equipamento necessário
        - Séries
        - Repetições
        - Descanso entre as séries (em segundos)
      - Observações gerais
    
    ⚠️ IMPORTANTE:
    - Responda somente com um array JSON válido.
    - Não inclua texto antes ou depois.
    - Não retorne o JSON como string.
    - Não use markdown ou formatação adicional.
    - Não utilize barras invertidas (\\) ou aspas escapadas.
    - A resposta deve começar com `[` e terminar com `]`, contendo apenas objetos JSON puros.
    
    Formato da resposta:
    [
      {
        "dia": "Segunda-feira",
        "cardio": "...",
        "grupoMuscular": "...",
        "exercicios": [
          {
            "nome": "...",
            "musculoAtivado": "...",
            "equipamentoNecessario": "...",
            "series": ...,
            "repeticoes": ...,
            "descanso": 60
          }
        ],
        "observacoes": "Faça apenas obersvações sobre progressão de carga, foco na técnica"
      }
    ]
    
    ⚠️ Retorne exatamente no formato acima. Sem string. Sem texto adicional.
    PROMPT;

    return $prompt;
}


function gerarFichaExercicios(array $data)
{
    $prompt = <<<PROMPT
    Gere uma ficha de treino personalizada com base nas informações abaixo:
    
    Nome: {$data['nome']}
    Idade: {$data['idade']}
    Sexo: {$data['sexo']}
    Altura: {$data['altura']} cm
    Peso: {$data['peso']} kg
    Objetivo: {$data['obj']}
    Nível de experiência: {$data['experiencia']}  
    Dificuldade dos exercicios: {$data['dificuldade']}
    Frequência semanal: {$data['frequencia']} por semana
    Local de treino: Academia  
    Foco principal: {$data['foco']} 
    Tempo por treino: Máximo 60 minutos  
    Quantidade de exercícios por dia: {$data['qtdExercicios']}  
    Deseja incluir cardio? Sim  
    Cardio preferido: {$data['cardio']}  
    
    Instruções para a ficha:
    - Escolha uma divisão de treino adequada ao nível e objetivo do usuário (ex: ABC, AB, Full Body).
    - Respeite a frequência semanal informada.
    - Cada dia de treino deve conter:
      - Dia da semana
      - Cardio
      - Grupo muscular foco do dia
      - Lista de exercícios, cada um com:
        - Nome
        - Músculo principal ativado
        - Equipamento necessário
        - Séries
        - Repetições
        - Descanso entre as séries (em segundos)
      - Observações gerais
    
    ⚠️ IMPORTANTE:
        - Responda somente com um array JSON válido.
        - Não inclua texto antes ou depois.
        - Não retorne o JSON como string.
        - Não use markdown ou formatação adicional.
        - Não utilize barras invertidas (\\) ou aspas escapadas.
        - A resposta deve começar com `[` e terminar com `]`, contendo apenas objetos JSON puros.
    
    Formato da resposta:
    [
      {
        "dia": "Segunda-feira",
        "cardio": "...",
        "grupoMuscular": "...",
        "exercicios": [
          {
            "nome": "...",
            "musculoAtivado": "...",
            "equipamentoNecessario": "...",
            "series": ...,
            "repeticoes": ...,
            "descanso": 60
          }
        ],
        "observacoes": "Observações em geral"
      }
    ]
    
    ⚠️ Retorne exatamente no formato acima. Sem string. Sem texto adicional.
    PROMPT;

    return $prompt;
}


function gerarExercicios(array $dados)
{
    $uuid = generateGUID();

    $prompt = <<<PROMPT
Gere uma lista de exercícios personalizada com base nas seguintes informações do aluno:
Nome: {$dados['nome']}
Idade: {$dados['idade']} anos
Altura: {$dados['altura']} cm
Peso: {$dados['peso']} Kg
Sexo: {$dados['sexo']}
Objetivo: {$dados['obj']}
Nível: {$dados['nivel']}
Local de treino: Academia
Liste apenas exercícios para: {$dados['musculo']}
Nível de Dificuldade: {$dados['dificuldade']}
Quantidade de exercícios: 5 exercícios

Formato de resposta:
[
  {
    "token": "$uuid",
    "exercicio": "Nome do exercício",
    "musculoAtivado": "Músculo principal ativado",
    "comoExecutar": "Como executar o exercício",
    "equipamentoNecessario": "Equipamento para executar o exercício",
    "series": "Número de séries",
    "repeticoes": "Número de repetições",
    "nivelDificuldade": "Qual o nível de dificuldade desse exercício: fácil/médio/difícil"
  },
  ...
]

Observação Importante:
- Em "como executar", faça um passo a passo breve de como realizar o exercício.
Importante:
- Retorne apenas o JSON puro, sem comentários, sem texto antes ou depois.
- Não utilize markdown nem formate com ```json.
PROMPT;

    return $prompt;
}

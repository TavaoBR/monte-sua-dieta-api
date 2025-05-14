<?php

function gerarPlanoAlimentar(array $data)
{

  $prompt = <<<PROMPT
    Você é um nutricionista virtual. Com base nos dados do usuário abaixo, gere um plano alimentar diário com 3 a 5 refeições, considerando preferências, restrições, objetivo e nível de atividade física. Cada refeição deve conter: nome da refeição, alimentos com nome, quantidade estimada, calorias e macronutrientes aproximados (proteínas, carboidratos, gorduras). No final, inclua um resumo com os totais diários de calorias e macros e uma sugestão de melhoria nutricional para o dia.

    Perfil do usuário:
    Nome: {$data['nome']}
    Idade: {$data['idade']}
    Sexo: {$data['sexo']}
    Altura: {$data['altura']} cm
    Peso: {$data['peso']} kg
    Objetivo: {$data['obj']}
    Tipo de dieta: {$data['tipoDieta']}
    Nível de atividade física: {$data['nivelAtividade']}
    Restrições: {$data['restricoes']}
    Condições médicas: {$data['condicoes']}

    ⚠️ INSTRUÇÕES ADICIONAIS:
      - Respeite estritamente o tipo de dieta informado pelo usuário em todas as refeições. 
        Exemplo: se a dieta for ovolactovegetariana, **não inclua carnes ou peixes**, apenas alimentos permitidos.
      - Leve em consideração também as restrições alimentares e condições médicas informadas.
      - Siga os alimentos típicos de cada horário de refeição:
        - Café da manhã: alimentos leves como pães, ovos, frutas, aveia, cereais, sucos, etc.
        - Almoço: refeições principais com proteína compatível com a dieta, carboidrato (arroz, batata), legumes, saladas.
        - Lanches: opções práticas como frutas, castanhas, iogurtes sem lactose, sanduíches leves.
        - Jantar: refeição mais leve e equilibrada, evitando itens muito pesados ou calóricos.
      - Evite incluir alimentos fora de contexto (ex: frango grelhado no café da manhã).
      - Respeite os costumes alimentares brasileiros.
       - ❌ Não inclua unidades como "kcal" ou "g" nos valores numéricos. Apenas os números.


    ⚠️ IMPORTANTE:
        - Responda somente com um objeto JSON válido.
        - Não inclua texto antes ou depois.
        - Não retorne o JSON como string.
        - Não use markdown ou formatação adicional.
        - Não utilize barras invertidas (\\) ou aspas escapadas.
        - A resposta deve começar com `{` e terminar com `}`, contendo apenas um objeto JSON puro.

    Formato da resposta:
    {
      "plano_alimentar": [
        {
          "refeicao": "Café da manhã",
          "alimentos": [
            {
              "nome": "...",
              "quantidade": "...",
              "calorias": ...,
              "proteinas_g": ...,
              "carboidratos_g": ...,
              "gorduras_g": ...
            }
          ]
        }
      ],
      "totais_diarios": {
        "calorias": ...,
        "proteinas_g": ...,
        "carboidratos_g": ...,
        "gorduras_g": ...
      },
      "sugestao_melhora": "..."
    }

    ⚠️ Retorne exatamente no formato acima. Sem string. Sem texto adicional.
    PROMPT;

  return $prompt;
}

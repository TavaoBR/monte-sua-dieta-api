<?php

function prompt1()
{
  $prompt = <<<PROMPT
        Gere uma dieta personalizada em HTML com foco em <strong>ganho de massa magra sem aumentar gordura corporal</strong>, com base nas informações abaixo:

        <h3 class="text-xl font-semibold text-green-700 border-l-4 border-green-500 pl-3 my-4">🧬 Dados do usuário</h3>
        <ul class="list-disc list-inside space-y-1 text-gray-700">
            <li>Sexo: Masculino</li>
            <li>Idade: 24 anos</li>
            <li>Altura: 1.70 m</li>
            <li>Peso: 85 kg</li>
            <li>Atividade física: musculação 3x por semana + cardio moderado</li>
            <li>Sem restrições alimentares</li>
        </ul>

        <h3 class="text-xl font-semibold text-green-700 border-l-4 border-green-500 pl-3 my-4">🥗 Preferências alimentares</h3>
        <ul class="list-disc list-inside space-y-1 text-gray-700">
            <li>Alimentação natural e acessível no Brasil</li>
            <li>5 a 6 refeições por dia (incluindo pré e pós-treino)</li>
            <li>Excluir: açúcar, frituras, refrigerante e ultraprocessados</li>
            <li>Incluir estimativa de calorias e macronutrientes por refeição</li>
            <li>Adicionar sugestões de suplementos (ex: whey, creatina)</li>
            <li>Incluir substituições para cada refeição</li>
        </ul>

        ⚠️ <strong>IMPORTANTE:</strong> Formate 100% do conteúdo em HTML usando exatamente as classes e estrutura abaixo. NÃO MODIFIQUE NADA. SIGA O MODELO À RISCA. SEM ADAPTAÇÕES.

        <ul class="list-disc list-inside space-y-1 text-red-600">
            <li>Use <code>&lt;h2 class="text-2xl font-bold text-center my-6"&gt;</code> como título principal</li>
            <li>Use <code>&lt;h3 class="text-xl font-semibold border-l-4 border-green-500 pl-3 my-4"&gt;</code> para seções secundárias</li>

            <li><strong class="text-blue-600">Todas as refeições DEVEM ser incluídas DENTRO de UM ÚNICO BLOCO GRID:</strong><br>
            Use <code>&lt;div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"&gt;</code> ... <code>&lt;/div&gt;</code> para envolver todos os cards.</li>

            <li><strong class="text-blue-600">Cada refeição deve ser exibida dentro de um card:</strong>
            <code>&lt;div class="relative border border-solid border-gray-200 rounded-2xl p-4 transition-all duration-500 w-full max-w-sm mx-auto"&gt;</code>

            Dentro do card, use esta estrutura EXATAMENTE:

            <ul class="list-disc list-inside text-red-600 space-y-1 ml-5">
                <li>Inclua o seguinte SVG SEM MODIFICAR:
                <br>
                <code>
                    &lt;svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"&gt;<br>
                    &nbsp;&nbsp;&lt;path d="M8.66699 12.8162L11.3501 15.4993C11.5616 15.7107 11.9043 15.7109 12.1158 15.4997L17.8753 9.75033M13.0003 23.8337C7.01724 23.8337 2.16699 18.9834 2.16699 13.0003C2.16699 7.01724 7.01724 2.16699 13.0003 2.16699C18.9834 2.16699 23.8337 7.01724 23.8337 13.0003C23.8337 18.9834 18.9834 23.8337 13.0003 23.8337Z" stroke="#4F46E5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"&gt;&lt;/path&gt;<br>
                    &lt;/svg&gt;
                </code>
                </li>
                <li><strong class="text-blue-600">Título da refeição:</strong> Nome + horário usando:<br><code>&lt;h4 class="text-base font-semibold text-gray-900 mb-2 capitalize transition-all duration-500"&gt;</code></li>
                <li><strong class="text-blue-600">Descrição detalhada:</strong> Alimentos + calorias + macros usando:<br><code>&lt;p class="text-sm font-normal text-gray-500 transition-all duration-500 leading-5"&gt;</code></li>
            </ul>
            </li>

            <li>Após os cards, adicione estas seções com seus títulos e listas:</li>
            <ul class="list-disc list-inside text-gray-700 space-y-1 ml-5">
                <li>💊 <strong class="text-blue-600">Suplementos</strong></li>
                <li>🔄 <strong class="text-blue-600">Substituições</strong></li>
                <li>💪 <strong class="text-blue-600">Observações Importantes</strong></li>
            </ul>

            <li>Use <code>&lt;ul class="list-disc list-inside text-gray-700 space-y-1"&gt;</code> para as listas dessas seções</li>
            <li>Use emojis nos títulos para facilitar leitura</li>
        </ul>

        🚫 <strong>IMPORTANTE:</strong> NÃO EXPLIQUE NADA. NÃO MODIFIQUE NADA. NÃO USE OUTRAS TAGS. A SAÍDA DEVE SER 100% HTML FORMATADO COM TAILWIND CONFORME ACIMA. NÃO ENVOLVA EM &lt;html&gt; OU &lt;body&gt;. SOMENTE O HTML DAS SEÇÕES.
    PROMPT;

  return $prompt;
}

function verificarPreferenciasAlimentar($texto)
{
  $prompt = <<<PROMPT
    isso é uma preferencia alimentar ?
    responda apenas com sim ou não
    "$texto"
  PROMPT;

  return $prompt;
}


function gerarFichaTreino(array $data)
{
  $grupos = is_array($data['grupos']) ? implode(', ', $data['grupos']) : $data['grupos'];
  $prompt = <<<PROMPT
    Gere uma ficha de treino personalizada com base nas seguintes informações do usuário:
    Nome: {$data['nome']}
    Idade: {$data['idade']}
    Sexo: {$data['sexo']}
    Altura: {$data['altura']} cm
    Peso: {$data['peso']} kg
    Objetivo: {$data['objetivo']}
    Nível: {$data['nivel']}
    Frequência semanal: {$data['frequencia']}
    Local de treino: {$data['local']}
    Grupos musculares prioritários: {$grupos}
    Deseja incluir cardio? {$data['cardio']}
    Deseja aquecimento/alongamento? {$data['alogamento']}

    A ficha deve considerar uma divisão de treino apropriada (ex: ABC, AB, Full Body), respeitando o nível, objetivo e preferências do usuário. A estrutura da resposta deve ser **apenas os cards HTML**, um para cada dia de treino, seguindo exatamente o modelo abaixo, com foco na clareza e estilo visual consistente.

     **Importante:** 
     -O local de treino informado ("{$data['local']}") deve ser a principal referência para a construção dos treinos. Adapte os exercícios e métodos considerando os recursos típicos desse local (ex: se for "casa", use treinos com peso corporal ou objetos comuns; se for "academia", utilize equipamentos e pesos; se for "ao ar livre", aproveite o ambiente).
     -Os grupos musculares prioritários especificados pelo usuário ("{$grupos}") devem ser trabalhados com mais ênfase ao longo da semana, sendo destacados com volume e frequência apropriados nos treinos.

    **Regras para a resposta:**
    - Não adicione nenhum texto antes ou depois dos cards.
    - Não inclua a div externa que agrupa os cards. Essa `div` com classe `flex flex-wrap justify-start gap-6 p-6` será adicionada pelo sistema no frontend.
    - Cada dia de treino deve ser um **card HTML separado**, com margem interna (padding) e sombra.
    - Utilize tags `<strong>` para destacar os títulos dentro dos cards (Aquecimento, Exercícios, Cardio, Alongamento).
    - Use o ícone SVG de informação (como 📋 ou semelhante) no topo de cada card.

    **Exemplo de card (replique essa estrutura):**

    ```html
    <!-- Card 1 -->
    <div class="w-full max-w-sm rounded-lg shadow-md p-6 bg-gray-900">
        <div class="text-xl mb-2">📋</div>
        <h2 class="text-white text-lg font-bold mb-2">Dia 1: Peito & Tríceps</h2>
        <p class="text-white"><strong>Aquecimento:</strong> 5 minutos de esteira leve, 10 repetições de cada:</p>
        <ul class="list-disc list-inside text-sm mb-2 text-white">
            <li>Rotação de ombros</li>
            <li>Elevação lateral de braços</li>
            <li>Remada alta</li>
        </ul>
        <p class="text-white"><strong>Exercícios:</strong></p>
        <ul class="list-disc list-inside text-sm mb-2 text-white">
            <li>Supino Reto: 4x de 8-12 repetições</li>
            <li>Supino Inclinado: 3x de 8-10 repetições</li>
            <li>Crucifixo Inclinado: 3x de 10-12 repetições</li>
            <li>Flexões: 3x até a falha</li>
            <li>Tríceps Testa: 4x de 10-12 repetições</li>
            <li>Tríceps Corda: 3x de 12 repetições</li>
            <li>Tríceps Banco: 3x até a falha</li>
        </ul>
        <p class="text-white"><strong>Cardio:</strong> 20 minutos de corrida leve na esteira ou bicicleta.</p>
        <p class="text-white"><strong>Alongamento:</strong> 5 minutos focando peito e tríceps.</p>
    </div>
    ```
    PROMPT;

  return $prompt;
}





function meAjudaAparelho($imagem)
{
  $prompt = <<<PROMPT
Olá! Poderia identificar esse aparelho de academia que aparece na imagem? Gostaria de saber o nome dele e quais tipos de exercícios posso realizar com ele.

Formato de resposta esperado:
{
  "nome_aparelho": "",
  "exercicios": [
    {
      "nome_exercicio": "",
      "musculos_trabalhados": []
    }
  ]
}

Observação Importante:
- Liste mais de um exercício, se possível.
- Em "musculos_trabalhados", informe os músculos principais ativados.
Importante:
- Retorne apenas o JSON puro, sem comentários, sem texto antes ou depois.
- Não utilize markdown nem formate com ```json.
PROMPT;

  return $prompt;
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

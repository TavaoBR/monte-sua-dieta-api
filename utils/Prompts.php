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

function verificarPreferenciasAlimentar($texto){
  $prompt = <<<PROMPT
    isso é uma preferencia alimentar ?
    responda apenas com sim ou não
    "$texto"
  PROMPT;

  return $prompt;
}
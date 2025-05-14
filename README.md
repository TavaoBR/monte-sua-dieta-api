# Minha IA Fitness

Minha IA Fitness API é uma aplicação RESTful desenvolvida com Symfony e PHP, que usa inteligência artificial para gerar planos alimentares personalizados de acordo com as necessidades nutricionais e metas de saúde dos usuários. A API permite que os usuários configurem suas preferências, registrem refeições, acompanhem metas e obtenham sugestões alimentares baseadas em dados de saúde e treino.

## Atenção, a versão desse repositorio não recebe mais atualizações, é apenas para estudo

## 🚀 Tecnologias Utilizadas

- PHP ^8.x
- [Symfony](https://symfony.com/)
- MySQL (banco de dados)
- Composer (gerenciador de dependências)
- Docker (opcional para ambiente containerizado)
- Inteligência Artificial (para sugerir planos alimentares e fichas de treino com base em dados dos usuários)

## ⚙️ Instalação

- PHP ^8.x
- Composer
- MySQL ou outro banco de dados relacional

### Passos

1. Clone o repositório:

   ```bash
   git clone https://github.com/TavaoBR/monte-sua-dieta-api.git
   cd monte-sua-dieta-api
   ```

2. Instale as dependências:

   ```bash
   composer install
   ```

3. Configure as variáveis de ambiente:
   Copie o arquivo de configuração de ambiente:

   ```bash
   cp .env.dev .env
   ```

   Edite o arquivo .env para ajustar as configurações do banco de dados e outras variáveis.

4. Configure o banco de dados:

   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. Inicie o servidor de desenvolvimento:

   ```bash
   symfony server:start
   ```

   A API estará disponível em http://localhost:8000.

## 📝 Licença

Este projeto está licenciado sob a Licença MIT. Consulte o arquivo LICENSE para mais detalhes.

👨‍💻 Autor
Gustavo de Oliveira Fagundes

GitHub: TavaoBR

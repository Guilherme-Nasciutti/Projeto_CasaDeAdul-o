# Projeto Casa de Adulão

## Introdução

Este repositório contém o código-fonte do projeto Casa de Adulão, desenvolvido pelos alunos do 5º período de Análise e Desenvolvimento de Sistemas (ADS) da Faculdade IMEPAC. O projeto foi criado para atender às necessidades da Associação Casa de Davi, proporcionando uma solução tecnológica robusta e eficiente para gerenciar suas atividades.

## Objetivo

O objetivo principal do Projeto Casa de Adulão é oferecer à Associação Casa de Davi uma plataforma web intuitiva e funcional, que auxilie na gestão de recursos, atividades e beneficiários da associação.

## Tecnologias Utilizadas

O desenvolvimento do projeto utilizou o framework CakePHP 3, conhecido por sua robustez e pela facilidade de desenvolvimento de aplicações web seguras e escaláveis. Além do CakePHP, outras tecnologias foram integradas para garantir o bom funcionamento e a usabilidade do sistema:

- **PHP 7.x**: Linguagem de programação utilizada no desenvolvimento do backend.
- **MySQL**: Sistema de gerenciamento de banco de dados relacional utilizado para armazenar dados da aplicação.
- **HTML5**: Linguagem de marcação utilizada na estruturação das páginas web.
- **CSS3**: Linguagem de estilo utilizada para o design e layout das páginas.
- **JavaScript**: Linguagem de programação utilizada para a interatividade das páginas.
- **jQuery**: Biblioteca JavaScript que simplifica a manipulação do DOM e a realização de requisições AJAX.
- **Bootstrap Icons**: Utilizado para apresentação de icones.

## Funcionalidades

### Gestão de usuários para uso do sistema

- Perfil
- Cadastro, edição e exclusão de usuários.
- Login e autenticação de usuários.

### Gestão de pessoas

- Cadastro, edição e exclusão de pessoas.

### Gestão de perfis

- Cadastro, edição e exclusão de perfis.

### Gestão de atividades

- Cadastro, edição e exclusão de atividades oferecidas pela associação.

### Relatórios

- Geração de relatórios detalhados sobre atividades e pessoas.
- Exportação de dados em CSV.

## Estrutura do Projeto

A estrutura do projeto segue a convenção do CakePHP 3, dividida em pastas específicas para cada componente da aplicação:

- **src**: Contém os arquivos principais da aplicação, incluindo Models, Views e Controllers.
- **config**: Configurações da aplicação, incluindo rotas e configurações de banco de dados.
- **webroot**: Arquivos públicos acessíveis via URL, como imagens, CSS e JavaScript.
- **logs**: Arquivos de log gerados pela aplicação.
- **plugins**: Plugins adicionais que estendem as funcionalidades do CakePHP.

## Como Executar o Projeto

Para executar o projeto localmente, siga os passos abaixo:

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/Guilherme-Nasciutti/Projeto_CasaDeAdulao.git
   cd Projeto_CasaDeAdulao
   ```

2. **Configure o banco de dados**:
   - Edite o arquivo `config/app.php` com as informações do seu banco de dados MySQL após ter executado o script do banco presente na raiz do projeto.

3. **Inicie o servidor**:
   ```bash
   bin/cake server
   ```

4. **Acesse a aplicação**:
   - Abra o navegador e acesse o link fornecido na etapa anterior.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e pull requests.

## Contato

Para mais informações, entre em contato com a equipe de desenvolvimento:

- Nome do Desenvolvedor 1: [email@example.com]
- Nome do Desenvolvedor 2: [email@example.com]

---

Obrigado por utilizar o Projeto Casa de Adulão! Esperamos que esta solução seja de grande ajuda para a Associação Casa de Davi e contribua para a melhoria contínua de suas atividades.

# Projeto PHP Alphacode - Cadastro de Usuários

![Logo](/public/assets/img/logo_rodape_alphacode.png)
##
### Sobre
Este projeto é uma avaliação técnica para testar os conhecimentos em desenvolvimento web, com foco em tecnologias como PHP, MySQL, JavaScript, HTML, CSS e integração com ferramentas como XAMPP e Composer. O objetivo do projeto é desenvolver uma aplicação CRUD para cadastro e gerenciamento de contatos.

##
### Tecnologias Utilizadas
Este projeto utiliza as seguintes tecnologias e ferramentas:

- **PHP:** Linguagem principal para o back-end.
- **MySQL:** Banco de dados relacional utilizado para armazenar os dados dos usuários.
- **HTML:** Linguagem de marcação usada para estruturar a interface do usuário.
- **CSS:** Estilização da aplicação para uma interface agradável e responsiva.
- **JavaScript:** Utilizado para interação dinâmica e validação no front-end.
- **Bootstrap:** Framework CSS para criar um layout responsivo e interativo de maneira rápida.
- **XAMPP:** Ambiente de desenvolvimento local para rodar o servidor Apache e o banco de dados MySQL.
- **Composer:** Gerenciador de dependências PHP, utilizado para gerenciar pacotes e bibliotecas.
- **JQuery:** Biblioteca JavaScript utilizada para facilitar a manipulação do DOM e integração AJAX.

## Estrutura do Projeto
A estrutura do projeto é organizada usando o padrão MVC (model-view-controller) e é estruturada da seguinte forma:

```bash
/app                 # Organização do backend
    /controller      # Controladores PHP para a lógica de negócio
    /dao             # Arquivos responsáveis pela comunicação com o banco de dados
    /model           # Modelos que representam as tabelas do banco de dados
    /view            # Arquivos de visualização (HTML)
config/              # Arquivos de configuração (banco de dados, etc.)
public/              # Organização dos arquivos públicos e roteamento
    /assets          # Arquivos públicos (imagens, scripts e css)
        /img         # Imagens utilizadas no projeto
        /css         # Arquivos de estilo
        /js          # Scripts JavaScript
```
## Banco de Dados
O banco de dados utilizado no projeto é o MySQL. Abaixo está o script necessário para criar as tabelas e o banco de dados:

### Script SQL para o Banco de Dados
```sql
-- Criação do banco de dados
CREATE DATABASE db_alphacode;

-- Comando para utilizar o banco de dados
USE db_alphacode;

-- Criação da tabela de usuários
CREATE TABLE tbl_usuario (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    data_nascimento DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    profissao VARCHAR(50) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    whatsapp BOOLEAN,
    notificacoes_email BOOLEAN,
    notificacoes_sms BOOLEAN,
    UNIQUE INDEX (id)
);
```
## Instruções de Instalação

### Requisitos
Antes de rodar o projeto, certifique-se de ter os seguintes requisitos instalados:

- **PHP** (versão 7.4.8 ou superior)
- **MySQL** (versão 5.7 ou superior)
- **XAMPP** (para rodar o Apache e MySQL localmente)
- **Composer** (para gerenciamento de dependências PHP)

## Passos para Instalar e Configurar o projeto

### 1. Baixe e instale o XAMPP:

- Baixe o XAMPP aqui
- Após instalar, inicie o Apache e MySQL no painel de controle do XAMPP.

### 2. Clone o repositório:

- Clone o repositório do projeto ou baixe como ZIP e extraia para o diretório `htdocs` do XAMPP.
O caminho será algo como: `XAMPP > htdocs > seu-projeto`.

### 3. Configure o banco de dados:

- Abra o MySQL (no painel de controle do XAMPP) e acesse o phpMyAdmin ou use um cliente MySQL de sua preferência.
- Crie o banco de dados `db_alphacode` utilizando o script SQL fornecido acima.
- Execute o `start` do Apache no XAMPP.

### 4. Configuração do banco de dados no PHP:

No diretório do seu projeto, navegue até `app/config/database.php` e edite as configurações de conexão com o banco de dados:

```php
$host = 'localhost'; // Rota local do banco
$dbname = 'db_alphacode'; // nome do banco de dados MySQL
$username = 'root'; // nome do usuário
$password = 'user'; // Senha do usuário
```

### 5. Rodando a aplicação:

No terminal ou prompt de comando, navegue até o diretório onde o projeto foi clonado e execute o comando para instalar as dependências do PHP:

```bash
composer install
```

### 6. Inicie o servidor:

Para rodar a aplicação e definir a pasta raiz como sendo a `public/`, execute o seguinte comando para iniciar o servidor local:
```bash
php -S localhost:8080 -t public
```
Agora você pode acessar a aplicação no seu navegador, acessando `http://localhost:8080`.

## Funcionalidades
- **Cadastro de Usuários:** A aplicação permite que o usuário adicione usuários, incluindo informações como nome, data de nascimento, email, telefone, celular e opções de notificações.

- **Edição de Usuários:** O usuário pode editar os dados dos usuários cadastrados.

- **Exclusão de Usuários:** Os usuários podem ser excluídos, removendo-os permanentemente do banco de dados.

- **Visualização de Usuários:** Todos os usuários cadastrados são exibidos em uma tabela, com a opção de editar ou excluir.

## Wireframe do projeto
![Screenshot](/public/assets/img/wireframe.png)

## Vídeo da aplicação
[Clique aqui](https://drive.google.com/file/d/1LRpS2O-yNSm0PpA1f3K0z6838kIWAjtt/view?usp=sharing) para ver um video da aplicação.


##
### Contribuindo
Se você deseja contribuir com este projeto, sinta-se à vontade para realizar um `Fork` e criar um `Pull Request` com melhorias ou correções.

##
### Autor
Alexssandro da Silva Gomes

[Portfolio](https://alexssandro-me.vercel.app/) |
[Linkedin](https://www.linkedin.com/in/alexssandrosilvagomes/)

<h1 align="center">Challenge-Softsul - Desenvolvedor Full Stack</h1>

![GitHub Org's stars](https://img.shields.io/github/license/Artur-Neves/Gerenciamento-escolar_java)
&nbsp;
![Badge Finalizado](http://img.shields.io/static/v1?label=STATUS&message=finalizado)

Documentação da API RESTful desenvolvida como parte do processo seletivo para a vaga de Desenvolvedor Full Stack na SoftSul.  
O desafio consiste em uma aplicação full stack com o Framework Laravel para a criação de CRUD para o modelo de Pedidos.

🌐 Acesse o projeto hospedado na Google Cloud:
https://challenge-softsul-503131231721.southamerica-west1.run.app

📄 Documentação completa da API:
https://challenge-softsul-503131231721.southamerica-west1.run.app/api/documentation

> **Observação:** A aplicação está hospedada em uma conta com recursos limitados. Por isso, algumas requisições podem apresentar tempos de resposta mais longos. Agradeço pela compreensão e paciência.

<br>

# :hammer: Funcionalidades do projeto

 - **Criação de Pedido**: Possibilidade de cadastrar novos pedidos informando nome do cliente, data do pedido, data de entrega e status.  
 - **Leitura de Pedido**: Listagem de todos os pedidos e visualização individual de um pedido específico.  
 - **Atualização de Pedido**: Edição dos dados de um pedido existente.  
 - **Exclusão de Pedido**: Remoção de um pedido do sistema.  
 - **Gerenciamento de Pedidos**: Ordenação, paginação e pesquisa dinâmica diretamente na tabela.  

<br>

## 🚀 Tecnologias principais
<div align="center">

| Categoria          | Tecnologias Utilizadas                          |
|--------------------|-------------------------------------------------|
| Linguagem          | PHP 8.2                                         |
| Framework          | Laravel 12                                      |
| Frontend           | HTML, CSS, Bootstrap, JavaScript, Blade         |
| Banco de dados     | MySQL, Cloud SQL                                |
| Documentação       | L5 Swagger, Swagger-PHP                         |
| Tabelas dinâmicas  | Yajra Laravel Datatables                        |
| Testes             | PHPUnit                                         |
| Containerização    | Docker                                          |
| Ferramentas de Dev | Laravel Tinker, Laravel Pail, Vite              |
| Deploy             | Google Cloud Run                                |
| Versionamento      | Git + GitHub                                    |

</div>
<br>

## 📌 Diferenciais Implementados

Embora o teste técnico solicitasse apenas o desenvolvimento de um CRUD básico para a entidade **Pedidos**, optei por implementar funcionalidades adicionais para tornar o projeto mais robusto e alinhado a boas práticas de desenvolvimento:

- **✅ Testes Automatizados**: Cobertura de testes para os endpoints da API, garantindo a qualidade e estabilidade do código.

- **📄 Documentação Completa da API com Swagger**: Documentação gerada utilizando **L5 Swagger** e **Swagger-PHP**, permitindo fácil visualização e interação com os endpoints.

- **🐳 Dockerização do Projeto**: Configuração para rodar todo o ambiente utilizando **Docker** e **Laravel Sail**, facilitando a instalação e execução.

- **⚡ Pesquisas Performáticas com Yajra Datatables**: Integração com **Yajra Laravel Datatables** para melhorar a performance nas consultas e listagens.

- **☁ Deploy na Google Cloud**: Implementação e configuração de **Cloud Run** para hospedar a aplicação e **Cloud SQL** para o banco de dados, garantindo escalabilidade e alta disponibilidade.


<br>

# 🛠️ Abrir e rodar o projeto

Siga os passos abaixo para executar o projeto localmente utilizando **Docker** e **Docker Compose**.

---

### 1️⃣ Clonar o repositório
```bash
git clone https://github.com/artur-neves/Challenge-Softsul.git
cd Challenge-Softsul
```

### 2️⃣ Configurar variáveis de ambiente
Copie o arquivo .env.example para .env:
```bash
cp .env.example .env
```
Copie o arquivo .env.example para .env:
```ini
APP_KEY={sua app key, ou gere com "php artisan key:generate"}
DB_PASSWORD=senha_que_voce_definir
```

### 3️⃣ Subir os containers com Docker
```bash
docker-compose up -d --build
```
Esse comando irá iniciar:
- MySQL (solftsul_db)
- PhpMyAdmin (solftsul_sgbd)
- Aplicação Laravel (solftsul)

### 4️⃣ Acessar o projeto
Com o servidor em execução, a aplicação estará disponível no seguinte endereço:
```bash
http://localhost:8000
```
A documentação da API pode ser acessada através da URL:
```bash
http://localhost:8000/api/documentation
```

---
<br> 

## 🖥️ Rodando sem Docker (instalação manual)

Caso não possua Docker instalado, siga os passos abaixo:

### 1️⃣ Requisitos mínimos
- **PHP** >= 8.2
- **Composer**
- **MySQL** >= 5.7 ou MariaDB
- **Node.js** >= 18 + **npm** ou **yarn**

### 2️⃣ Clonar o repositório
```bash
git clone https://github.com/artur-neves/Challenge-Softsul.git
cd Challenge-Softsul
```

### 3️⃣ Configurar variáveis de ambiente
Copie o arquivo .env.example para .env:
```bash
cp .env.example .env
```
Copie o arquivo .env.example para .env:
```ini
APP_KEY={sua app key, ou gere com "php artisan key:generate"}
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=challenge_softsul
DB_USERNAME=seu_usuario
DB_PASSWORD=senha_que_voce_definir
```
### 4️⃣ Instalar dependências do PHP e Node
```bash
composer install
npm install
```
### 5️⃣ Criar banco de dados e executar migrations
```bash
php artisan migrate
```

### 6️⃣ Rodar o servidor
```bash
php artisan serve
```
Com o servidor em execução, a aplicação estará disponível no seguinte endereço:
```bash
http://localhost:8000
```
A documentação da API pode ser acessada através da URL:
```bash
http://localhost:8000/api/documentation
```















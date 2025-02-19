# EventFlow

## 📌 Sobre o Projeto

O **EventFlow** é uma aplicação web para gerenciamento de eventos, permitindo que usuários criem, editem e excluam eventos de forma intuitiva. A plataforma oferece um calendário interativo e funcionalidades para controle de eventos.

## 🚀 Tecnologias Utilizadas

O **EventFlow** foi desenvolvido com as seguintes tecnologias:

### 🔹 Frontend
- [Vue.js 3](https://vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Pinia](https://pinia.vuejs.org/) - Gerenciamento de estado
- [Vue Router](https://router.vuejs.org/) - Rotas dinâmicas

### 🔹 Backend
- [Laravel 10](https://laravel.com/)
- [PHP 8.x](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [Sanctum](https://laravel.com/docs/10.x/sanctum) - Autenticação API
- [Cron Jobs](https://laravel.com/docs/10.x/scheduling) (para exclusão automática de eventos expirados)

### 🔹 Instalação
- ````git clone https://github.com/quelipee/EventFlow.git````

- ````cd EventFlow````

### 🔹 Instale as dependências:
- ````composer install````

### 🔹 Configure o .env:
-   ````
    cp .env.example .env
    php artisan key:generate
    ````
### 🔹 Inicie o servidor:
-  ````php artisan serve````
- 
## Frontend (Vue.js 3)

### 🔹 Navegue até o diretório:
- ````cd eventflow/frontend````

###  🔹 Instale as dependências:
- ````npm install````
- 
### 🔹 Configure o .env:
- ````cp .env.example .env````

### 🔹 Inicie o servidor de desenvolvimento:
- ````npm run dev````

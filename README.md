
# Restaurante Moçar
Um projeto de uma aplicação para fazer reservas em um restaurante.

### Passo a passo
Crie o Arquivo .env
```sh
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acessar o container
```sh
docker-compose exec app bash
```

Install project dependencies
```sh
composer install
```
```sh
npm install && npm run dev
```

Creat DataBase
```sh
php artisan db:create
```

Creat Tables
```sh
php artisan migrate
```

Populate the database
```sh
php artisan db:seed
```

Acessar o projeto
[http://localhost:8989](http://localhost:8989)

Para login use o formulário de cadastro ou acesse o banco de dados para pegar qualquer e-mail de usuário cadastrado e depois use a senha padrão dos usuários populado: `AGS@123.`

O primeiro usuário do banco tem um papel de Adiministrador cadastrado quando o banco foi populado usando a Spatie Permission e pode acessar a tela de reservas cadastradas. 

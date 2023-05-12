
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

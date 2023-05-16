
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


Horarios: 18:00, 19:30, 21:00. 22:30. E as domingos: 12:00, 13:30, 15:00, 16:30, 18:00, 19:30, 21:00. 22:30, 00:00, 01:30.

Tabela Mesas no banco de dados com as colunas:
- id: chave principal
- lugares: quantidade de lugares da mesa
- foto: foto da mesa

Tabela Reserva no banco de dados com as colunas:
- id: chave principal
- res_mesa: que a data e horario da reserva registrada
- user_id: que é a referencia do id do usuário
- mesa_id: que é a referencia do id da mesa

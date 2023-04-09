## Центр технического оборудования

#### Запуск
- `composer install`
- `./vendor/bin/sail up -d`
- `./vendor/bin/sail yarn install`
- `./vendor/bin/sail yarn dev`
- `cp .env.example .env`
- `./vendor/bin/sail artisan migrate`
- `./vendor/bin/sail artisan db:seed DatabaseSeeder`

#### Адрес: http://localhost/

#### Запуск тестов:
- `./vendor/bin/sail artisan config:cache --env=testing`
- `./vendor/bin/sail artisan test`

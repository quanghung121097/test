# test
build: 
 - coppy file .env.example to .env
 - docker compose up -d --build
 - docker exec -it php_test bash
 - composer install
 - npm install
 - php artisan migrate
 - php artisan db:seed
=> Ok
http://localhost

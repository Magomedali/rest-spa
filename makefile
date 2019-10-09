down:
	docker-compose down --remove-orphans

up:
	docker-compose up --build -d

init: down up

php-cli:
	docker-compose run --rm api-php-cli bash

api-test:
	docker-compose run --rm api-php-cli composer tests

api-cli:
	docker-compose run --rm api-php-cli php bin/app.php

api-migrate:
	docker-compose run --rm api-php-cli php bin/app.php migrations:migrate
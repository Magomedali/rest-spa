down:
	docker-compose down --remove-orphans

up:
	docker-compose up --build -d

init: down up

php-cli:
	docker-compose run --rm api-php-cli bash
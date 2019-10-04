down:
	docker-compose down --remove-orphans

up:
	docker-compose up --build -d

init: down up
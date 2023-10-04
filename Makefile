build:
	docker compose build
up:
	docker compose up -d
up-l:
	docker compose up
down:
	docker compose down
stop:
	docker compose stop
start:
	docker compose start
bash-php:
	docker compose exec php-students bash
logs-php:
	docker compose logs -f php-students
bash-nginx:
	docker compose exec nginx-students bash
logs-nginx:
	docker compose logs -f nginx-students

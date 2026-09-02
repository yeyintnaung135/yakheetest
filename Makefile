.PHONY: help build up stop down restart logs ps shell artisan composer install update migrate fresh seed rollback cache-clear optimize-clear test pint pint-test

help:
	@echo "Laravel Docker Commands"
	@echo "======================="
	@echo "make build          Build Docker images"
	@echo "make up             Start containers"
	@echo "make stop           Stop containers"
	@echo "make down           Stop and remove containers"
	@echo "make restart        Restart containers"
	@echo "make logs           Show logs"
	@echo "make ps             Show containers"
	@echo ""
	@echo "Laravel Commands"
	@echo "make migrate        Run migrations"
	@echo "make fresh          Fresh database + seed"
	@echo "make seed           Run seeders"
	@echo "make rollback       Rollback migrations"
	@echo "make cache-clear    Clear cache"
	@echo "make optimize-clear Clear Laravel caches"
	@echo "make test           Run tests"
	@echo ""
	@echo "Shell"
	@echo "make shell          Enter app container"
	@echo "make artisan CMD=   Run Artisan command"
	@echo "make composer CMD=  Run Composer command"

build:
	docker compose build

up:
	docker compose up -d

stop:
	docker compose stop

down:
	docker compose down

restart:
	docker compose restart

logs:
	docker compose logs -f

ps:
	docker compose ps

shell:
	docker compose exec app bash

artisan:
	docker compose exec app php artisan $(CMD)

composer:
	docker compose exec app composer $(CMD)

install:
	docker compose exec app composer install

update:
	docker compose exec app composer update

migrate:
	docker compose exec app php artisan migrate

fresh:
	docker compose exec app php artisan migrate:fresh --seed

seed:
	docker compose exec app php artisan db:seed

rollback:
	docker compose exec app php artisan migrate:rollback

cache-clear:
	docker compose exec app php artisan cache:clear

optimize-clear:
	docker compose exec app php artisan optimize:clear

test:
	docker compose exec app php artisan test

pint:
	docker compose exec app ./vendor/bin/pint

pint-test:
	docker compose exec app ./vendor/bin/pint --test
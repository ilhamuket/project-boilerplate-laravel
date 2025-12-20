APP=app
NODE=node

up:
	docker compose up -d

down:
	docker compose down

restart:
	docker compose restart

build:
	docker compose build --no-cache

logs:
	docker compose logs -f --tail=200

ps:
	docker compose ps

sh:
	docker compose exec $(APP) sh

artisan:
	docker compose exec $(APP) php artisan $(cmd)

migrate:
	docker compose exec $(APP) php artisan migrate

fresh:
	docker compose exec $(APP) php artisan migrate:fresh --seed

cache-clear:
	docker compose exec $(APP) php artisan optimize:clear

composer:
	docker compose exec $(APP) composer $(cmd)

npm:
	docker compose exec $(NODE) sh -lc "npm $(cmd)"

pint:
	docker compose exec app ./vendor/bin/pint

pint-test:
	docker compose exec app ./vendor/bin/pint --test

init:
	cp -n src/.env.example src/.env || true
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan migrate
	docker compose exec app php artisan optimize:clear
	@echo "✅ Init done. Open http://localhost:8080"

fresh-init:
	cp -n src/.env.example src/.env || true
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan migrate:fresh --seed
	docker compose exec app php artisan optimize:clear
	@echo "✅ Fresh init done."

check: pint-test
	@echo "✅ checks passed"

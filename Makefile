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
	docker compose exec $(APP) ./vendor/bin/pint

pint-test:
	docker compose exec $(APP) ./vendor/bin/pint --test

env:
	cp -n src/.env.example src/.env || true

deps:
	docker compose exec $(APP) composer install

node-deps:
	docker compose exec $(NODE) sh -lc "npm install"

key:
	docker compose exec $(APP) php artisan key:generate --force

# ✅ ini untuk orang baru setelah clone
setup: up env deps key migrate cache-clear
	@echo "✅ Setup done. Open http://localhost:8080"

# ✅ reset DB
fresh-setup: up env deps key fresh cache-clear
	@echo "✅ Fresh setup done."

check: pint-test
	@echo "✅ checks passed"

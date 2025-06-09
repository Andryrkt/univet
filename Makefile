# Makefile

# commande docker
build:
	docker-compose --env-file compose.env build

up:
	docker-compose --env-file compose.env up -d

down:
	docker-compose --env-file compose.env down

down-volumes:
	docker-compose --env-file compose.env down -v

restart:
	docker-compose --env-file compose.env restart

logs:
	docker-compose logs -f

container-app:
	docker-compose exec app bash

# creation base de données et migrations
create-database:
	php bin/console doctrine:database:create

migrate:
	php bin/console doctrine:migrations:migrate --no-interaction

# chargement des fixtures
fixtures:
	php bin/console doctrine:fixtures:load --no-interaction

# gestion des assets
cache-clear:
	php bin/console cache:clear


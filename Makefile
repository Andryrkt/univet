# Makefile

up:
	docker-compose --env-file .env.local up -d

down:
	docker-compose down

restart:
	docker-compose restart

logs:
	docker-compose logs -f


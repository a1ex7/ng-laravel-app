# Variables
DOCKER_COMPOSE = docker compose

# Build the Docker image and start the container
build:
	$(DOCKER_COMPOSE) build --no-cache
	$(DOCKER_COMPOSE) up -d
	$(DOCKER_COMPOSE) exec -usail app composer install
	$(DOCKER_COMPOSE) exec -usail app composer run post-root-package-install
	$(DOCKER_COMPOSE) exec -usail app composer run post-create-project-cmd
	$(DOCKER_COMPOSE) exec -usail app npm install
	$(DOCKER_COMPOSE) exec app npm run build

# Stop the running container
down:
	$(DOCKER_COMPOSE) down

# Start the container without rebuilding
up:
	$(DOCKER_COMPOSE) up -d --force-recreate --remove-orphans

# Start the container bash shell
shell:
	$(DOCKER_COMPOSE) exec -usail app bash

# View logs from the running container
logs:
	$(DOCKER_COMPOSE) logs

# Clean up (remove all stopped containers and networks)
clean:
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

# Rebuild without using the cache
rebuild:
	$(DOCKER_COMPOSE) build --no-cache
	$(DOCKER_COMPOSE) up -d --remove-orphans

# Run PHPUnit test
test:
	$(DOCKER_COMPOSE) exec app php artisan test

# Migrate
migrate:
	$(DOCKER_COMPOSE) exec app php artisan migrate
	$(DOCKER_COMPOSE) exec app php artisan migrate --database=sqlite.test

# Migrate
rollback:
	$(DOCKER_COMPOSE) exec app php artisan migrate:rollback
	$(DOCKER_COMPOSE) exec app php artisan migrate:rollback --database=sqlite.test

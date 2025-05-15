PROJECT_NAME=sorted-linked-list
DOCKER_COMPOSE=docker-compose

up:
	$(DOCKER_COMPOSE) up -d --build

test:
	$(DOCKER_COMPOSE) run --rm $(PROJECT_NAME) ./vendor/bin/phpunit

down:
	$(DOCKER_COMPOSE) down

rebuild:
	$(DOCKER_COMPOSE) down
	$(DOCKER_COMPOSE) up -d --build

logs:
	$(DOCKER_COMPOSE) logs -f $(PROJECT_NAME)

shell:
	$(DOCKER_COMPOSE) run --rm $(PROJECT_NAME) bash
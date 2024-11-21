.PHONY: all say_hello install start stop terminal

include .env

PHP_CONTAINER := $(COMPOSE_PROJECT_NAME)-$(PHP_CONTAINER_NAME)
NGINX_CONTAINER := $(COMPOSE_PROJECT_NAME)-$(NGINX_CONTAINER_NAME)
DB_CONTAINER := $(COMPOSE_PROJECT_NAME)-$(DB_CONTAINER_NAME)

say_hello:
	@echo "Hello World"
install:
	docker compose up -d --build
start:
	docker start $(PHP_CONTAINER) $(NGINX_CONTAINER) $(DB_CONTAINER)
stop:
	docker stop $(PHP_CONTAINER) $(NGINX_CONTAINER) $(DB_CONTAINER)
terminal:
	docker exec -it $(PHP_CONTAINER) sh
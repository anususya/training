.PHONY: all say_hello install start stop terminal

include .env

PHP_CONTAINER := $(COMPOSE_PROJECT_NAME)-$(PHP_CONTAINER_NAME)
NGINX_CONTAINER := $(COMPOSE_PROJECT_NAME)-$(NGINX_CONTAINER_NAME)
DB_CONTAINER := $(COMPOSE_PROJECT_NAME)-$(DB_CONTAINER_NAME)

say_hello:
	@echo "Hello World"
composer_inst:
	docker exec -t $(PHP_CONTAINER) sh -c 'cd /var/www/html && composer install'
install:
	docker compose up -d --build
start:
	docker start $(PHP_CONTAINER) $(NGINX_CONTAINER) $(DB_CONTAINER)
stop:
	docker stop $(PHP_CONTAINER) $(NGINX_CONTAINER) $(DB_CONTAINER)
terminal:
	docker exec -it $(PHP_CONTAINER) sh
task1:
	docker exec -it $(DB_CONTAINER) psql -d $(DB_NAME) -U $(DB_USER) -f /var/www/html/scrypts/task_1.sql
task2:
	docker exec -it $(DB_CONTAINER) psql -d $(DB_NAME) -U $(DB_USER) -f /var/www/html/scrypts/task_2.sql
task3:
	docker exec -it $(DB_CONTAINER) psql -d $(DB_NAME) -U $(DB_USER) -f /var/www/html/scrypts/task_3.sql
task4:
	docker exec -it $(DB_CONTAINER) psql -d $(DB_NAME) -U $(DB_USER) -f /var/www/html/scrypts/task_4.sql
task5:
	docker exec -it $(DB_CONTAINER) psql -d $(DB_NAME) -U $(DB_USER) -f /var/www/html/scrypts/task_5.1.sql
	docker exec -it $(PHP_CONTAINER) php /var/www/html/index.php
	docker exec -it $(DB_CONTAINER) psql -d test -U $(DB_USER) -f /var/www/html/scrypts/task_5.2.sql
reinstall_db:
	docker exec -it $(DB_CONTAINER) dropdb -U $(DB_USER) --if-exists -f $(DB_NAME)
	docker exec -it $(DB_CONTAINER) createdb -U $(DB_USER) $(DB_NAME)
	docker exec -it $(DB_CONTAINER) psql -d $(DB_NAME) -U $(DB_USER) -f /docker-entrypoint-initdb.d/init.sql

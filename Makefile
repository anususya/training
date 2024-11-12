.PHONY: all say_hello install start stop terminal

say_hello:
	@echo "Hello World"
install:
	docker compose up -d --build
start:
	docker start site-php-1
stop:
	docker stop site-php-1
terminal:
	docker exec -it site-php-1 sh
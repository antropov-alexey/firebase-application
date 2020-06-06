.PHONY: build
build:
	docker-compose up -d
	docker-compose exec php-fpm bash -c "composer install --working-dir=/web/backend"
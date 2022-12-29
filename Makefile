init: \
	docker-up \
	init-env \
	migrate

docker-up:
	docker-compose up -d

init-env:
	cp ./src/.env.example ./src/.env
	docker-compose exec php sh -c "php artisan key:generate"
	docker-compose exec php sh -c "php artisan storage:link"

migrate:
	sleep 6
	docker-compose exec php sh -c "php artisan migrate --force"

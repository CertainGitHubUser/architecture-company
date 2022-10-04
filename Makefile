up:
	docker-compose up -d

down:
	docker-compose down

rebuild:
	docker-compose down -v --remove-orphans
	docker-compose rm -vsf
	docker-compose up -d --build

rebuild-light:
	docker-compose down
	docker-compose up -d --build



db:
	docker-compose exec php ./bin/console doctrine:database:drop --force
	docker-compose exec php ./bin/console doctrine:database:create
	docker-compose exec php ./bin/console doctrine:migrations:migrate -n

migration:
	docker-compose exec php ./bin/console doctrine:migrations:diff

migration-migrate:
	docker-compose exec php ./bin/console doctrine:migrations:migrate -n
test: down test-up db test-behat

test-up:
	docker-compose -f docker-compose_test.yml up -d --build

test-behat:
	docker-compose exec php vendor/bin/behat --config config/packages/behat/behat.yml
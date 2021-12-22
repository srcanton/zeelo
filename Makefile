docker-pull:
	@docker-compose -f docker/docker-compose.yml pull

docker-down:
	@docker-compose -f docker/docker-compose.yml down --remove-orphans -v --rmi local

docker-run:
	@docker-compose -f docker/docker-compose.yml up --build -d

docker-enter:
	@docker exec -it zeelo-php bash

run: docker-run
stop: docker-down
enter: docker-enter


docker-pull-test:
	@docker-compose -f tests/docker-compose.yml pull

docker-up-background-test:
	@docker-compose -f tests/docker-compose.yml up -d

docker-run-test:
	@docker-compose -f tests/docker-compose.yml run php_test tests/run.sh $(ifWordTestPresentThenRemove)

docker-down-test:
	@docker-compose -f tests/docker-compose.yml down --remove-orphans -v --rmi local

test: docker-pull-test docker-up-background-test docker-run-test docker-down-test

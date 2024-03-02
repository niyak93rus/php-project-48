install:
	composer install --ignore-platform-reqs
	composer update --ignore-platform-reqs

gendiff:
	./bin/gendiff.php

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin
	vendor/bin/phpstan analyse -l 5 src tests bin

test:
	composer exec --verbose phpunit tests

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --do-not-cache-result --coverage-clover build/logs/clover.xml

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --do-not-cache-result --coverage-text
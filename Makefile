install:
	composer install --ignore-platform-reqs
	composer update --ignore-platform-reqs

gendiff:
	./bin/gendiff.php

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin
	vendor/bin/phpstan analyse -l 6 src tests bin

test:
	composer exec --verbose phpunit tests
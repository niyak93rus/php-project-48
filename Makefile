install:
	composer install --ignore-platform-reqs
	composer update --ignore-platform-reqs

gendiff:
	./bin/gendiff.php

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin
	composer exec --verbose phpstan

test:
	composer exec --verbose phpunit tests
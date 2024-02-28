gendiff:
	./bin/gendiff.php

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

test:
	
# --- Run example
init: setup info generate

# --- Container initiation
setup:
	docker-compose build
	docker-compose run app composer install

# --- Get command description
info:
	docker-compose run app php ./application.php -h

# --- File generation
generate:
	docker-compose run app php ./application.php silence1.xml
ifndef APP_ENV
	include .env
endif

CONSOLE=bin/console
sf_console:
	@test -f $(CONSOLE) || printf "Run \033[32mcomposer require cli\033[39m to install the Symfony console.\n"
	@exit

install:
	@printf "\033[32;49m# Starting the installation\033[39m\n";
	@composer install --verbose
	@yarn install
	@yarn encore dev
	@$(CONSOLE) doctrine:database:create --if-not-exists
	@$(CONSOLE) doctrine:migrations:migrate
	@$(CONSOLE) doctrine:fixtures:load --no-interaction
	@printf "\033[32;49m# Finished the installation. Have fun!\033[39m\n";

build:
	@printf "\033[32;49m# Building the assets\033[39m\n";
	@yarn encore dev
	@printf "\033[32;49m# Finished building the assets\033[39m\n";

refresh:
	@printf "\033[32;49m# Refreshing the database\033[39m\n";
	@$(CONSOLE) doctrine:database:create --if-not-exists
	@$(CONSOLE) doctrine:migrations:migrate
	@$(CONSOLE) doctrine:fixtures:load --no-interaction
	@printf "\033[32;49m# Finished refreshing the database\033[39m\n";

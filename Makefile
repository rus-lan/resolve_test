MAKEFLAGS += --silent

export COMPOSE_PROJECT_NAME ?= resolve_test
export APP_ENV ?= local
export ENV_ENVIRONMENT = resources/deployments/${APP_ENV}
export ENV_FILE = ${ENV_ENVIRONMENT}/.env
export DOCKER_COMPOSE = docker-compose -f ${ENV_ENVIRONMENT}/docker-compose.yml

SCRIPT_DOCKER_DIR = resources/scripts/
DOCKER = docker
COMPOSER = composer
COMPOSER_RUN = ${COMPOSER} run

ifneq ("$(wildcard $(ENV_FILE))","")
	include $(ENV_FILE)
	export $(shell sed 's/=.*//' $(ENV_FILE))
endif

.PHONY: *
SHELL=/bin/bash -o pipefail

help: ## Показывает справку по Makefile
	@printf "\033[33m%s:\033[0m\n" 'Доступные команды'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[32m%-18s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# Installation
create-dotenv: ## Генерация .env файлов
	$(SCRIPT_DOCKER_DIR)create_dotenv.sh $(COMPOSE_PROJECT_NAME) $(APP_ENV)

init: create-dotenv update-hooks ## Сборка и запуск проекта
	-${MAKE} stop build start install
init-full: init data-fixture ## Сборка и запуск проекта с фикстурами

install: ## Установка зависимостей
	-${MAKE} install-site install-balance data-migrations
install-site:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T site $(COMPOSER) install
install-balance:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER) install

build: ## Сборка контейнеров
	$(SCRIPT_DOCKER_DIR)$(APP_ENV)/docker_build.sh

reinstall: clean rm-env rm-state-file init ## полная очистка и повторная сборка
reinstall-full: clean rm-env rm-state-file init-full ## полная очистка и повторная сборка с фикстурами

clean: ## Остановка и очистка контейнеров
	$(DOCKER_COMPOSE) down --rmi local -v
rm-state-file:
	rm -rf modules/balance/vendor/*
	rm -rf modules/balance/var/cache/*
	rm -rf modules/site/vendor/*
	rm -rf modules/site/var/cache/*
rm-env:
	rm -f modules/balance/.env
	rm -f modules/site/.env
	rm -f $(ENV_FILE)
# Serving
start: ## Запуск контейнеров
	$(DOCKER_COMPOSE) up -d
restart: stop start
stop:
	$(DOCKER_COMPOSE) down

# Database
data-diff: ## Генерация мигграции на основании разницы мапинга и данных
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER_RUN) data:migrations:diff
data-fixture: ## Инсталяция данных в базу
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER_RUN) data:fixture:load
data-migrations: ## Инсталяция данных в базу
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER_RUN) data:migrations
data-recreate: ## Инсталяция данных в базу
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER_RUN) data:recreate
data-validate: ## Проверка маппинга и базы
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER_RUN) data:validate

# Testing
test-site:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T site $(COMPOSER_RUN) all:test
test-balance:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER_RUN) all:test
test: test-site test-balance ## Testing

# Check static and code style
check-site:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T site $(COMPOSER_RUN) all:check
check-balance:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER_RUN) all:check
check: check-site check-balance ## check static and code style

# Linting
lint-site:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T site $(COMPOSER_RUN) all:lint
lint-balance:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER_RUN) all:lint
lint: lint-site lint-balance ## Linting

# Code style fixing
cs-fix-site:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T site $(COMPOSER_RUN) all:fix
cs-fix-balance:
	$(DOCKER_COMPOSE) exec --user=$(USER) -T balance $(COMPOSER_RUN) all:fix
cs-fix: cs-fix-site cs-fix-balance ## Code style fixing

# Entering into containers
shell-site: ## Entering into containers to site
	$(DOCKER_COMPOSE) exec --user=$(USER) site bash
shell-balance: ## Entering into containers to balance
	$(DOCKER_COMPOSE) exec --user=$(USER) balance bash
shell-nginx: ## Entering into containers to nginx
	$(DOCKER_COMPOSE) exec nginx bash
shell-db: ## Entering into containers to db
	$(DOCKER_COMPOSE) exec db bash

# Showing logs
logs-site: ## Showing logs to site
	$(DOCKER_COMPOSE) logs site
logs-balance: ## Showing logs to balance
	$(DOCKER_COMPOSE) logs balance
logs-nginx: ## Showing logs to nginx
	$(DOCKER_COMPOSE) logs nginx
logs-db: ## Showing logs to db
	$(DOCKER_COMPOSE) logs db

# Other
ps:
	$(DOCKER_COMPOSE) ps
ls:
	$(DOCKER_COMPOSE) ls
update-hooks: ## Git hooks: update all
	$(SCRIPT_DOCKER_DIR)$(APP_ENV)/update-hooks.sh
pre-commit: cs-fix lint test check git-add ## Git hooks: pre-commit
git-add:
	git add .
plantuml-generate:
	$(SCRIPT_DOCKER_DIR)$(APP_ENV)/plantuml_generate.sh

# Global
.DEFAULT_GOAL := help

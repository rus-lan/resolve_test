#!/usr/bin/env bash

if ! [ -x "$(command -v docker-compose)" ]; then
  echo 'Error: docker-compose is not installed.' >&2
  exit 1
fi

set -e

if [[ -z "$1" ]]
then
  echo "Не указан APP_NAME!"
  exit 1;
fi

APP_NAME="$1"

DIST_FILE=${DIST_FILE:-${ENV_ENVIRONMENT}/.env.dist}
ENV_FILE=${ENV_FILE:-${ENV_ENVIRONMENT}/.env}
ENV_FILE_SITE=${ENV_FILE_SITE:-modules/site/.env}
ENV_FILE_BALANCE=${ENV_FILE_BALANCE:-modules/balance/.env}
export COMPOSE_PROJECT_NAME=${COMPOSE_PROJECT_NAME:-$APP_NAME}

COLOR="\e[34m"
DEFAULT_COLOR="\e[0m"

printf "$COLOR\n### %s$DEFAULT_COLOR\n" "Creating docker-compose .env ..."

if [ ! -f "$ENV_FILE" ]; then
  cp -f "$DIST_FILE" "$ENV_FILE"
  sed -i "s/DATABASE_HOST=\(\S*\)/DATABASE_HOST=${COMPOSE_PROJECT_NAME}_db/g" $ENV_FILE

  echo "Successfully created"
else
  echo "Docker-compose .env file already exists"
fi

if [ ! -f "$ENV_FILE_SITE" ]; then
  cp  -f "${ENV_FILE_SITE}.dist" "$ENV_FILE_SITE"
  {
      echo "APP_NAME=${APP_NAME}"
      echo "HOST_BALANCE=${COMPOSE_PROJECT_NAME}_nginx:81"
  } >> $ENV_FILE_SITE
fi

if [ ! -f "$ENV_FILE_BALANCE" ]; then
  cp  -f "${ENV_FILE_BALANCE}.dist" "$ENV_FILE_BALANCE"
  {
      echo "APP_NAME=${APP_NAME}"
      echo "DATABASE_HOST=${COMPOSE_PROJECT_NAME}_db"
  } >> $ENV_FILE_BALANCE
fi

set -a
[ -f $ENV_FILE ] && . $ENV_FILE
set +a
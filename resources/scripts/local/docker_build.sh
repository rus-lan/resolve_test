#!/usr/bin/env bash

export HOME="$HOME"
export USER="$USER"
export DOCKER_COMPOSE="${DOCKER_COMPOSE:-docker-compose}"
export COMPOSER_VERSION="${COMPOSER_VERSION:-1.8.6}"
export COMPOSE_PROJECT_NAME="${COMPOSE_PROJECT_NAME:-}"

if [[ "$(uname)" == "Darwin" ]];
then
  export _UID=1999
  export _GID=1999
else
  export _UID="$(id -u)"
  export _GID="$(id -g)"
fi

${DOCKER_COMPOSE} build \
  --build-arg UID=${_UID} \
  --build-arg GID=${_GID} \
  --build-arg COMPOSER_VERSION=${COMPOSER_VERSION} \
  site
${DOCKER_COMPOSE} build \
  --build-arg UID=${_UID} \
  --build-arg GID=${_GID} \
  --build-arg COMPOSER_VERSION=${COMPOSER_VERSION} \
  balance

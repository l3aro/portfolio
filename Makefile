### VARIABLES

arg = $(filter-out $@,$(MAKECMDGOALS))
%:
	@:

ENV?=dev
STACK_NAME?=blog
PROJECT_NAME?=l3aro/${STACK_NAME}
TAG?=latest
DC_USER?=www-data
REG_URL?=ghcr.io

### MAIN docker-compose configs

DOCKER_COMPOSE_FILE?=docker-compose.${ENV}.yml
ifneq ("$(wildcard ./docker-compose.local.yaml)","")
	DOCKER_COMPOSE_FILE+= -f docker-compose.local.yaml
endif

DOCKER_COMPOSE?=REG_URL=${REG_URL} STACK_NAME=${STACK_NAME} PROJECT_NAME=${PROJECT_NAME} ENV=${ENV} TAG=${TAG} docker compose -p ${STACK_NAME}-${ENV} -f ${DOCKER_COMPOSE_FILE}

### FUNCTIONS

up:
	${DOCKER_COMPOSE} up
up-detach:
	${DOCKER_COMPOSE} up -d
build:
	docker build --target ${ENV} -t ${REG_URL}/${PROJECT_NAME}:${TAG} -t ${REG_URL}/${PROJECT_NAME}:latest .
push:
	docker push ${REG_URL}/${PROJECT_NAME}:${TAG} \
	&& docker push ${REG_URL}/${PROJECT_NAME}:latest
pull:
	docker pull ${REG_URL}/${PROJECT_NAME}:${TAG}
down:
	${DOCKER_COMPOSE} down
sh:
	${DOCKER_COMPOSE} exec web bash
cmd:
	${DOCKER_COMPOSE} exec web bash -c "$(filter-out $@, $(MAKECMDGOALS))"
sh-root:
	${DOCKER_COMPOSE} exec -u root web bash
setup-dev:
	${DOCKER_COMPOSE} run --rm web sh -c "\
		composer install ; \
		pnpm install ; \
		php artisan migrate ; \
		php artisan icons:cache ; \
		php artisan filament:clear-cached-components \
		php artisan optimize:clear ; \
	"
dev:
	${DOCKER_COMPOSE} exec web composer run dev
solo:
	${DOCKER_COMPOSE} exec web php artisan solo
tinker:
	${DOCKER_COMPOSE} exec web php artisan tinker

.PHONY: up up-detach build push pull down sh setup-dev dev solo tinker

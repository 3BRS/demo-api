# demo-api

## Installation
```bash
$ cp .env.dist .env
$ cp .envrc.dist .envrc
$ direnv allow # install direnv https://direnv.net/ if you don't have it
$ cp compose.override.dist.yaml compose.override.yaml
$ docker compose up -d
$ composer install
$ bin/console doctrine:migrations:migrate
$ bin/console assets:install
$ yarn install
$ yarn build
```

open http://127.0.0.1 in your browser

## API documentation
http://127.0.0.1/api

http://127.0.0.1/api/docs?ui=re_doc

## Tests
Before commit run:

```bash
$ bin/ecs.sh
$ bin/phpstan.sh
$ bin/symfony-lint.sh

```

## Svelte frontend
[README.md here](svelteUi/README.md)

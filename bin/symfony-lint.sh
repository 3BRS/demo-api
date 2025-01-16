#!/usr/bin/env bash
set -euo pipefail
IFS=$'\n\t'
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

set -x

bin/console --no-interaction lint:yaml config src translations
bin/console --no-interaction lint:container
bin/console --no-interaction lint:twig templates --show-deprecations
bin/console --no-interaction doctrine:schema:validate --skip-sync

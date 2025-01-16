#!/usr/bin/env bash
set -euo pipefail
IFS=$'\n\t'
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
PROJECT_ROOT=$( dirname "$DIR" )

# project root
cd "$PROJECT_ROOT"
set -x

sed -i "s+user: 1000:1000+user: $(id -u):$(id -g)+g" compose.yaml
sed -i "s+restart: on-failure+restart: no+g" compose.yaml
cp .env.dist .env

# To avoid Git error 'Can not get current git branch: fatal: detected dubious ownership in repository at '/src'
git config --global --add safe.directory "$PROJECT_ROOT"

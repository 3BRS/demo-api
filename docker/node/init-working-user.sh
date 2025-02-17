#!/usr/bin/env sh

set -x

# This script is to be executed when the docker container is started

# Set UID of user node on guest to match the UID of the user on the host machine
# `stat -c "%u" $1` gives user(owner) of given parameter (expected a file inside current Docker container)
usermod -u $(stat -c "%u" $1) node
# Set GID of group node on guest to match the GID of the users primary group on the host machine
groupmod -g $(stat -c "%g" $1) node

# Allow user node to log in to use development tools
usermod -s /bin/bash node

mkdir -p /home/node/.cache/yarn
chown --recursive node:node /home/node/.cache/yar
chmod --recursive u+rw /home/node/.cache/yarn

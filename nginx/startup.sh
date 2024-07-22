#!/bin/sh

# Replace ENV variables
envsubst "$( /bin/bash -c 'compgen -e' | awk '$0="${"$0"}"')"  < /etc/nginx/conf.d/default.conf.env > /etc/nginx/conf.d/default.conf

/docker-entrypoint.sh nginx -g "daemon off;";
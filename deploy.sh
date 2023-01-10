#!/bin/bash

PROJECT_DIR=/srv/www/site
WORDPRESS_CONTAINER=wordpress
WORDPRESS_IMAGE=evermadefi/PROJECT:master

# test .env file is there?
if [ ! -f "$PROJECT_DIR/.env" ]; then
    echo '.env not file found!'
    exit 1
fi

# pull our wordpress image
echo 'Pull container...'
docker pull $WORDPRESS_IMAGE

# stop all active containers?
echo 'Stop container...'
docker stop $WORDPRESS_CONTAINER &> /dev/null

# remove the container
echo 'Remove container...'
docker rm -f $WORDPRESS_CONTAINER &> /dev/null

# check if mariadb is running
echo 'Run mariadb container if not already running...'
if [ ! "$(docker ps -q -f name=mysql)" ]; then
    docker run -d -p 3306:3306 --env-file $PROJECT_DIR/.env --name mysql -v $PROJECT_DIR/mariadb:/var/lib/mysql mariadb:10.3.4
fi

# check and run redix
echo 'Run redis container if not already running...'
if [ ! "$(docker ps -q -f name=redis)" ]; then
    docker run -d --name redis redis:3.2.11
fi

# finally run our main wordpress image
echo 'Run container...'
docker run -d -p 80:80 --env-file $PROJECT_DIR/.env --link redis --link mysql --name $WORDPRESS_CONTAINER $WORDPRESS_IMAGE

# delete all unused images as, this could be filtered by age etc, leaving some backups to rollback
docker image prune -f
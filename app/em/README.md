# Local DockerPress em helper 

Local DockerPress em helper to extend global em helper. This script has two main purposes:

1. Building the project specific Docker containers
2. Running commands inside Docker containers

Should be used with [em helper](https://bitbucket.org/evermade/em-helper/) in your home directory.

## em build

Build script to get current project up and running. Should be run every time you start working with the project. 

Stops existing Docker containers and builds new containers. Runs `composer install`, `npm install` and `npm build` to install and compile required assets. 

Checks in every run if WordPress and theme are installed and installing those if not. Checks also if git origin is defined and prompts the origin URL from the user if not defined.

## em bash

Runs any given command in given container and outputs its output. 

Usage: `em bash <container> <command>`

- `container` - Docker container, can be partial name ie. `wordpress`. Check existing containers with `docker ps`.
- `command` - Any bash command that you want to run. If left empty it opens bash inside the container.

Example: `em bash wordpress printenv`

Without any parameters opens bash in the WordPress container.

### Shorthands

- `em composer` - Run Composer commands on the WordPress container. Ie. `em composer install`
- `em npm` - Run NPM commands on the WordPress container. Ie. `em npm run dev`
- `em wp` - Run WP CLI commands on the WordPress container. Ie. `em wp user list`

## em block

For your everyday block management. Adds, removes, clones and lists blocks.

- `em block add <name>` - Adds block. Block needs to exist in Evermade BitBucket.
- `em block remove <name>` - Removes block.
- `em block clone <baseblock> <name>` - Creates new block using existing block as base.
- `em block list (<all> | <active>)` - Lists all available or active blocks.

## Contributors ###

- Tuomas Velling
- Paul Stewart
#!/bin/bash

EM_LOCAL_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

source $EM_LOCAL_DIR/em-dockerbash.sh

if [ ! -f "env/.env" ]; then
    echo '.env file does not exists, please create it.'
    exit 1;
else
    source $EM_LOCAL_DIR/../env/.env
fi

printHelp(){
    echo -e "Local em commands:"
    echo -e "    em bash <container> <command> - Runs given command in given container. By default bashes to WordPress container."
    echo -e "    em composer - Run Composer commands on the WordPress container"
    echo -e "    em npm - Run NPM commands on the WordPress container"
    echo -e "    em wp - Run WP CLI commands on the WordPress container"
    echo -e ""    
    echo -e "    em build - Builds DockerPress stack and runs composer/npm operations. Initial run will also setup Git and WordPress."
    echo -e "    em block - Manages blocks. Check 'em block' for more help."
}

cmd=$1
shift

case "$cmd" in
  help) printHelp
  ;;
  build) 
    source $EM_LOCAL_DIR/em-build.sh
  ;;
  block)
    source $EM_LOCAL_DIR/em-block.sh
  ;;
  bash)
    container=$1
    shift
    dockerBash $container $*
  ;;
  composer)
    runComposer $*
  ;;
  npm) 
    runNPM $*
  ;;
  wp) 
    runWP $*
  ;;
  *) printHelp
  ;;

esac




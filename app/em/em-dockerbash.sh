dockerBash(){
    if [ -z "$1" ]; then   
        container='wordpress'    
    else   
        container=$1
    fi

    if [ -z "$2" ]; then
        docker exec -it $(docker ps -qf "name=$container") bash
    else
        docker exec -it $(docker ps -qf "name=$container") bash -c "$2" 
    fi
}

runComposer(){
    dockerBash "wordpress" "cd .. && composer $*"    
}
runNPM(){
    dockerBash "wordpress" "npm $*"
}
runWP(){
    dockerBash "wordpress" "wp $* --allow-root"
}
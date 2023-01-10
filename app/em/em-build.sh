buildApp(){

    buildDocker;
    initGitRepo;

    echo -e "\nInstall all the dependencies with Composer install"
    runComposer "install --no-dev"

    if [ ! -d "$EM_LOCAL_DIR/../src/wp-content/themes/$WP_THEME_NAME" ]; then
        echo -e "\nSetup WP theme"
        git clone git@github.com:evermade/swiss.git "$EM_LOCAL_DIR/../src/wp-content/themes/$WP_THEME_NAME"
        dockerBash wordpress "rm -rf '../src/wp-content/themes/$WP_THEME_NAME/.git'"
    fi

    echo -e "\nMaking sure all the permissions are correct"
    chown evermade:evermade -R "$EM_LOCAL_DIR/../src/wp-content/themes"
    dockerBash wordpress "chmod 777 -R ../src/wp-content/themes/$WP_THEME_NAME/acf-json"
    dockerBash wordpress "chmod 777 -R ../src/wp-content/uploads"

    echo -e "\nRun NPM install"
    runNPM install --silent

    echo -e "\nRun NPM build"
    runNPM run build

    echo -e "\nChecking if WordPress needs to be installed"
    setupWordPress

    echo -e "\nEverything done, you are ready to go!"

}

buildDocker(){
    # make sure dist folder exists
    mkdir -p "dist"

    # stop and remove all containers
    (docker stop $(docker ps -a -q) && docker rm $(docker ps -a -q)) &> /dev/null

    # bring up the docker stack
    docker-compose up -d
}

initGitRepo(){
    # If this is first install from Evermade Dockerpress then remove repo.
    # Check this every time to prevent fuckups.
    repo_url=$(git config --get remote.origin.url)
    if [ "$repo_url" = "git@bitbucket.org:evermade/dockerpress.git" ]; then
        echo -e "Clearing Dockerpress repo"
        sudo rm -rf ../.git
        repo_url=$(git config --get remote.origin.url)
    fi    


    # If this is not an existing repo then init it and ask for git origin
    if [ "$repo_url" = "" ]; then
        echo -e "Initializing new git repo"
        git init ../   
 
        echo -e "Give your repository origin url (leave empty to skip):"
        read repo_url
        if [ -n "$repo_url" ]; then
            git remote add origin $repo_url
        fi

    fi
}



setupWordPress(){
    wpInstalled=$(docker exec -it $(docker ps -qf "name=wordpress") bash -c 'wp core is-installed --allow-root && echo $?')

    if [ -z "$wpInstalled" ]; then

        # Add our blocks
        #addBlock hero hero
        #addBlock columns columns
        #addBlock image image
        #addBlock section section
        #addBlock image-text image-text

        echo -e "\nSetup Wordpress"
        runWP "core install --url='$APP_URL' --title='$APP_TITLE' --admin_user='$WP_ADMIN_NAME' --admin_password='$WP_ADMIN_PASSWORD' --admin_email='$WP_ADMIN_EMAIL'"

        echo -e "\nChanging Wordpress Permalinks"
        runWP "rewrite structure '/%postname%/'"

        echo -e "\nActivating ACF plugin"
        runWP "plugin activate advanced-custom-fields-pro"

        echo -e "\nActivate theme"
        runWP "theme activate $WP_THEME_NAME"

        echo -e "\nMaking EM toolbox page"
        runWP "post create --post_type=page --post_title='em' --post_status='publish'"

        echo -e "\nUpdate show page as front page"
        runWP "option update show_on_front page"

        echo -e "\nCreate and Update page for home page"
        homepage=$(runWP "post create --porcelain --post_type=page --post_title='Home' --post_status='publish'")
        runWP "option update page_on_front $homepage"

        echo -e "\nCreate and Update page for posts"
        postspage=$(runWP "post create --porcelain --post_type=page --post_title='Blog' --post_status='publish'")
        runWP "option update page_for_posts $postspage"

    fi
    
}


buildApp;
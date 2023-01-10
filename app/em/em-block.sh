printHelp(){
	echo -e "Usage:"
    echo -e "   em block add <block> - Adds block"
    echo -e "   em block remove <block> - Removes block"
    echo -e "   em block clone <baseblock> <newblock> - Creates new block using existing block as base"
    echo -e "   em block list ( <all> | <active> ] - Lists all available or active blocks" 
    echo -e ""
}

sanitizeBlockName(){
    string=$*
    sanitizedString=""

    # Convert whole string to lowercase
    string=${string,,}

    # Split string to parts by dashes
    parts=$(echo $string | tr "-" "\n")

    # Convert string parts first letter to uppercase and combine parts to camelcase string  
    for part in $parts; do
        part=${part^}
        sanitizedString=$sanitizedString$part
    done

    # Return string by echoing it
    echo $sanitizedString
}

listActiveBlocks(){
    blocksDir="$EM_LOCAL_DIR/../src/wp-content/themes/$WP_THEME_NAME/lib/blocks/page"  
    ls -1 $(ls -d $blocksDir)
}

listAllBlocks(){
    #will be dynamic soon
    echo -e 'example (Base block)'
    echo -e 'columns'
    echo -e 'hero'
    echo -e 'image'
    echo -e 'image-text'
    echo -e 'juicer'
    echo -e 'listing'
    echo -e 'listing-posts'
    echo -e 'logo-listing'
    echo -e 'section'
    echo -e 'slide-list'    
}

fetchBlock(){
    block=$1
    blockDir=$2

    git clone git@bitbucket.org:evermade/$block-block.git $blockDir
    sudo chown evermade:evermade -R $blockDir
    sudo rm -rf "$blockDir/.git" 
}

addBlock(){
    block=$1

    if [ -z "$block" ]; then
        echo -e "Please give a block that you want to add:"
        echo -e ""
        listBlocks
        exit 1
    fi

    echo -e "Adding block '$block'"

    # Check that block does not exist already
    blockDir="$EM_LOCAL_DIR/../src/wp-content/themes/$WP_THEME_NAME/lib/blocks/page/$block"
    if [ -d $blockDir ]; then
        echo -e "\nBlock '$block' already exists"
        exit 1
    fi

    fetchBlock $block $blockDir

    echo -e "\nBlock '$block' added"
}

removeBlock(){
    block=$1
    blockDir="$EM_LOCAL_DIR/../src/wp-content/themes/$WP_THEME_NAME/lib/blocks/page/$block"

    blocksDir="$EM_LOCAL_DIR/../src/wp-content/themes/$WP_THEME_NAME/lib/blocks/page"  

    if [ -z "$(listActiveBlocks)" ]; then
        echo -e "No blocks exist to remove"
        exit 1
    fi

    if [ -z "$block" ] || [ ! -d $blockDir ]; then
        echo -e "Please give a existing block that you want to remove:"
        echo -e ""
        listActiveBlocks
        exit 1
    fi

    rm -rf $blockDir
    echo -e "Block '$block' removed"
}

cloneBlock(){

    baseBlock=$1
    newBlock=$2

    # Convert blockname to lowercase
    newBlock=${newBlock,,}

    echo -e "Creating '$newBlock' using '$baseBlock' as base"  

    # Check that block does not exist already
    newBlockDir="$EM_LOCAL_DIR/../src/wp-content/themes/$WP_THEME_NAME/lib/blocks/page/$newBlock"
    if [ -d $newBlockDir ]; then
        echo -e "\nBlock $newBlock already exists"
        exit 1
    fi

    # We are all good to clone the block
    fetchBlock $baseBlock $newBlockDir

    echo -e "\nUpdating block namespace"

    # Create magic sed strings to replace nameplace
    # Quadruple backslash is for espacing single backslash through the variable and sed  
    baseNamespace="Evermade\\\\Swiss\\\\Everblox\\\\"
    baseBlockNamespace="$baseNamespace$(sanitizeBlockName $baseBlock)"
    newBlockNamespace="$baseNamespace$(sanitizeBlockName $newBlock)"

    # Do actual namespace switching    
    find $newBlockDir -type f -exec sed -i 's,'"$baseBlockNamespace"','"$newBlockNamespace"',g' {} \;

    echo -e "\nBlock '$newBlock' added"
}

listBlocks(){
    if [ "$1" =  "active" ]; then
        echo -e "Listing currently active blocks:"
        echo -e ""
        listActiveBlocks
    else
        echo -e "Listing all blocks available:"
        echo -e ""
        listAllBlocks
    fi
}



if [ -z "$1" ]; then
	printHelp
	exit 1
fi

case "$1" in
    add)
        shift
        addBlock $*
    ;;
    remove)
        shift
        removeBlock $*
    ;;
    clone)
        shift
        cloneBlock $*
    ;;
    list)
        shift;
        listBlocks $*
    ;;
    *)
        printHelp
    ;;
esac
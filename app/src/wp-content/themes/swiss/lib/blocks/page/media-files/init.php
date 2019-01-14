<?php

namespace Evermade\Swiss\Everblox\MediaFiles;

// make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a block, not much I can do when called directly.';
	exit;
}

function init() {

    // the block name should be unique, this way we can use it to version and clone blocks
    $blockName = basename(__DIR__);

    // things this block may need before being used in WP Admin or frontend
    require_once (__DIR__.'/includes/functions.php');

    // attach our block layout to the global array
    \add_filter( 'swiss_block_layouts', function($layouts) use ($blockName){
        $layouts[] = include_once ('includes/acf.php');
        return $layouts;
    }, 10, 1 );
}

init();

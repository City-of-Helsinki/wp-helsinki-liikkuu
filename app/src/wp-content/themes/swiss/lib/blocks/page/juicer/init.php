<?php

namespace Evermade\Swiss\Everblox\Juicer;

// make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a block, not much I can do when called directly.';
	exit;
}

function init() {
    $blockName = basename(__DIR__);

    // attach our block layout to the global array
    \add_filter( 'swiss_block_layouts', function($layouts) use ($blockName){
        $layouts[] = include_once ('includes/acf.php');
        return $layouts;
    }, 10, 1 );

    // enqueue our assets
    \add_action('wp_enqueue_scripts', function(){
        \wp_enqueue_style('juicer-css', '//assets.juicer.io/embed.css');
        \wp_enqueue_script('juicer-js', '//assets.juicer.io/embed-no-jquery.js', array(), null, true);
    });
}

init();

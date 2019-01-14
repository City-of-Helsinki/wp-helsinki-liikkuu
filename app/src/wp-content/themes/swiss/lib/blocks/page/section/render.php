<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(array(
    'scheme',
    'assets',
    'section_template',
    'vertical_alignment',
    'pin_blocks',
    'overflow_visibility',
    'minimum_height'
));

$bSectionCSS = "";

if ($block->get('section_template') != "normal"):
    $bSectionCSS = "b-section--".$block->get('vertical_alignment')." b-section--".$block->get('section_template')." b-section--visibility-".$block->get('overflow_visibility');
endif;

include (__DIR__.'/templates/view.php');

$assetsHtml = "";

if (!empty($block->get('assets'))):

    foreach($block->get('assets') as $k => $v) {
        $assetsHtml .= \Evermade\Swiss\template('_asset.php', $v);
    }

endif;

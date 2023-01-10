<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['tag_type','manual']);


// If get_terms contains manual inserted url, skip it
$manual_tags = array(); // Prevent in_array Warning later
if ($block->get('manual')) {
    foreach ($block->get('manual') as $k => $v) {
        $manual_tags[] = \Evermade\Swiss\getFrom('link', $v);
    }
}

include (__DIR__.'/templates/view.php');

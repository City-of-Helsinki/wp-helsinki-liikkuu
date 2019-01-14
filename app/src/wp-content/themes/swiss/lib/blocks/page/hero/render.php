<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['background_image', 'text', 'overlay', 'youtube_id', 'scheme']);

if(!empty($block->get('text'))) include (__DIR__.'/templates/view.php');

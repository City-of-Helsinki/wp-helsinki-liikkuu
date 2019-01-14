<?php

// lets keep block data in class for encapsulation and stopping conflicts across blocks
$block = new \Evermade\Swiss\Block(['feed', 'how_many_posts']);

if(!empty($block->get('feed'))) include (__DIR__.'/templates/view.php');

<?php
// lets keep block data in class for encapsulation and stopping conflicts across blocks
$block = new \Evermade\Swiss\Block(['columns', 'section_header']);

if(!empty($block->get('columns'))) include(__DIR__.'/templates/view.php');

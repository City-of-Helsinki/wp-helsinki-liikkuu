<?php
// lets keep block data in class for encapsulation and stopping conflicts across blocks

$block = new \Evermade\Swiss\Block(['columns', 'horizontal_alignment']);

if(!empty($block->get('columns'))) include(__DIR__.'/templates/view.php');

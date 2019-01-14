<section class="b-media-files">

    <div class="b-media-files__container">

        <h3><?php echo $block->get('title'); ?></h3>
<div class="b-media-files__items">

        <?php foreach($block->get('columns') as $k => $v): ?>
        <?php $file = \Evermade\Swiss\getFrom('file', $v); 
        $image = \Evermade\Swiss\getFrom('image', $v) ? \Evermade\Swiss\Acf\getImageUrl('medium', \Evermade\Swiss\getFrom('image', $v)) : get_template_directory_uri() . "/assets/img/load-icon.svg";
        ?>
        <div class="b-media-files__item">
            <div class="c-media-files-item trigger-hover">
            <a class="c-media-files-item__image-wrapper" href="<?php echo $file['url']; ?>"><div style="background-image:url(<?php echo $image; ?>)"></div></a>
            <p class="c-media-files-item__title"><?php echo \Evermade\Swiss\getFrom('title', $v); ?></p>
            <div class="c-media-files-item__load"><a class="c-cta-link" href="<?php echo $file['url']; ?>"><?php _e('Download', 'swiss');?></a></div>
            </div>
</div>
        <?php endforeach; ?>

</div>
    </div><!-- end of b-listing__container -->

</section><!-- end of b-listing -->

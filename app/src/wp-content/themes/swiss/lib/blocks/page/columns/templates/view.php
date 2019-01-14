<section class="b-base">
    <div class="b-base__container">

        <div class="l-columns l-columns--<?php echo $block->get('horizontal_alignment'); ?>" data-column-count="<?php echo sizeof($block->get('columns')); ?>">

        <?php foreach($block->get('columns') as $k => $p): ?>

            <div class="l-columns__item">
                <div class="h-wysiwyg-html" data-scheme-target>
                    <?php echo \Evermade\Swiss\getFrom('column', $p); ?>
                </div>
            </div>

        <?php endforeach; ?>

        </div><!-- end of l-columns layout -->

    </div>
</section>

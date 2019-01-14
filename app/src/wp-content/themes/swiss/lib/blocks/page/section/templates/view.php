</div> <!-- close our last b-section__blocks -->
</div><!-- close our last b-section__content -->
</div><!-- close our last b-section -->
<div class="b-section <?php echo $bSectionCSS; ?> s-context s-context--<?php echo $block->get('scheme'); ?>" <?php if($block->get('minimum_height')){?> style="min-height:<?php echo $block->get('minimum_height');?>px"<?php } ?>><!-- open our new scheme context -->
<?php include(__DIR__.'/assets.php'); ?>
<div class="b-section__content" <?php if($block->get('pin_blocks') == "enabled"){?>data-swiss-sticky="parent"<?php } ?>>
<div class="b-section__blocks">

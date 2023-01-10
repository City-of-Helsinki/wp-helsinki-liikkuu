<script>
    function populateAria(){
        $('.j-display-filters li').each(function(element) {
            var $filter = $(this).data('filter');
            if( $filter = '' ){
                $filter = 'all';
            }
            $(this).attr('role', 'button').attr('aria-label', 'Filter social media content by ' + $filter );
        });

        $('.juicer-feed .j-poster > a, .juicer-feed .j-meta a.comments, .juicer-feed .j-meta a.heart, .juicer-feed nav .j-social').attr('tabindex', -1).attr('aria-disabled', true);

        $('.juicer-feed .feed-item').each(function(element) {
            var $text = $(this).find('.j-message').text();
            $(this).find('a.j-image').attr('aria-label', $text);
        });

        $(".j-display-filters a[target='_blank']").attr('target', '_self');
    }
</script>
<section class="b-juicer">
    <div class="b-juicer__container">
        <ul class="juicer-feed" data-feed-id="<?php echo $block->get('feed'); ?>" data-per="<?php echo $block->get('how_many_posts'); ?>" data-after="populateAria()"></ul>
    </div>
</section>

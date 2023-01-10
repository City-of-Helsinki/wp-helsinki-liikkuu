<?php if (empty($data)) {
    return false;
} ?>

<div class="c-social-media">
    <ul class="c-social-media__list">
        <?php foreach ($data as $key => $value): ?>
            <li><a href="<?php echo $value['url']; ?>"><i class="fab fa-<?php echo $value['service']; ?>" aria-label="<?php _e('Share on ', 'swiss'); echo ucfirst($value['service']);?>"></i></a></li>
        <?php endforeach; ?>
    </ul>
</div>
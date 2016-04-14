<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Pureblog
 * @since Pureblog 1.0
 */
?>

<article id="post-0" class="post no-results not-found">
    <header class="entry-header">
        <h1><?php _e('Nothing Found', 'pureblog'); ?></h1>
    </header>
    <div class="entry-content">
        <p><?php _e('Apologies, but no results were found. Perhaps searching will help find a related post.', 'pureblog'); ?></p>
        <?php get_search_form(); ?>
    </div><!-- .entry-content -->
</article><!-- #post-0 -->

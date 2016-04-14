<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package WordPress
 * @subpackage blankSlate
 * @since blankSlate 3.5
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="entry-meta-left">
            <div class="entry-date-wrap">
                <?php kumaley_entry_date(); ?>
            </div>
            <?php if (comments_open()) : ?>
                <div class="entry-comment-wrap">
                    <?php comments_popup_link(__('1', 'kumaley'), __('%', 'kumaley')); ?> <i class="fa fa-comment"></i>
                </div>
            <?php endif; ?> 
            <div class="entry-post-format-wrap">
                <i class="fa fa-quote-left"></i>
            </div> 
        </div> 
        <?php if (is_single()) : ?>
            <hgroup>
                <h3 class="entry-title">
                    <?php the_title(); ?>
                </h3>
            </hgroup> 
        <?php else : ?>
            <hgroup>
                <h3 class="entry-title">
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'kumaley'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h3>
            </hgroup>
        <?php endif; // is_single() ?> 
        <div class="entry-meta">
            <?php kumaley_entry_meta(); ?> 
            <?php edit_post_link(__('Edit', 'kumaley'), '<span class="edit-link">', '</span>'); ?> 
        </div>
    </header><!-- .entry-header -->
    <?php if (is_single()) : // Only display Excerpts for Search ?>
        <div class="entry-content">
            <?php if (has_post_thumbnail()): ?>
                <p><?php the_post_thumbnail(); ?></p>
            <?php endif; ?>
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'kumaley'), 'after' => '</div>')); ?>
        </div><!-- .entry-content -->
        <footer class="entry-meta">  
            <?php echo get_the_tag_list('<span class="tag-links">', ' ', '</span>'); ?>       
        </footer><!-- .entry-meta -->
    <?php else : ?>
        <div class="entry-content">
            <?php if (has_post_thumbnail()): ?>
                <p><?php the_post_thumbnail(); ?></p>
            <?php endif; ?>
            <?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'kumaley')); ?>
        </div><!-- .entry-summary --> 
        <footer class="entry-meta"> 
            <span class="more"><a class="more-link" href="<?php the_permalink(); ?>">Read More</a></span> 
            <?php echo get_the_tag_list('<span class="tag-links">', ' ', '</span>'); ?>       
        </footer><!-- .entry-meta -->
    <?php endif; ?> 
</article><!-- #post -->

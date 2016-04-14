<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package WordPress
 * @subpackage Pureblog
 * @since Pureblog 1.0
 */
?> 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="entry-meta-left">
            <div class="entry-date-wrap">
                <?php pureblog_entry_date(); ?>
            </div> 
            <div class="entry-post-format-wrap">
                <i class="fa fa-file-text-o"></i>
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
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'pureblog'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h3>
            </hgroup>
        <?php endif; // is_single() ?> 
        <div class="entry-meta">
            <?php pureblog_entry_meta(); ?> 
            <?php edit_post_link(__('Edit', 'pureblog'), '<span class="edit-link">', '</span>'); ?>
            <?php if (comments_open()) : ?>
                <span class="leave-reply"><i class="fa fa-comments"></i><?php comments_popup_link(__('Leave a reply', 'pureblog') . '</span>', __('1 Reply', 'pureblog'), __('% Replies', 'pureblog')); ?></span>
            <?php endif; ?>
        </div>
    </header><!-- .entry-header -->
    <?php if (is_single()) : // Only display Excerpts for Search ?>
        <div class="entry-content">
            <?php if (has_post_thumbnail()): ?>
                <p><?php the_post_thumbnail(); ?></p>
            <?php endif; ?>
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'pureblog'), 'after' => '</div>')); ?>
        </div><!-- .entry-content -->
        <footer class="entry-meta">  
            <?php echo get_the_tag_list('<span class="tag-links">', ' ', '</span>'); ?>       
        </footer><!-- .entry-meta -->
    <?php else : ?>
        <div class="entry-content">
            <?php if (has_post_thumbnail()): ?>
                <p><?php the_post_thumbnail(); ?></p>
            <?php endif; ?>
            <aside>
                <?php the_excerpt(); ?> 
            </aside>
        </div><!-- .entry-summary --> 
        <footer class="entry-meta"> 
            <span class="more"><a class="more-link" href="<?php the_permalink(); ?>">Read More</a></span> 
            <?php echo get_the_tag_list('<span class="tag-links">', ' ', '</span>'); ?>       
        </footer><!-- .entry-meta -->
    <?php endif; ?> 
</article><!-- #post --> 
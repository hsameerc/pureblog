<?php
/**
 * The default template for displaying image.
 *
 * @package WordPress
 * @subpackage Kumaley
 * @since Kumaley 1.0
 */
get_header();
?>
<div class="header-barWrapper js-header-animation"> 
    <div class="container header-bar">
        <div class="row">
            <div class="span9">
                <h3><?php printf(__('Category Archives: %s', 'kumaley'), '<span>' . single_cat_title('', false) . '</span>'); ?></h3>  
                <div class="breadcrumbs">
                    <?php
                    if (function_exists('bcn_display')) {
                        bcn_display();
                    }
                    ?>
                </div>
            </div> 
            <div class="span3 ">
                <div class="header-search">
                    <div class="input-append">
                        <?php get_search_form(); ?>
                    </div>    
                </div> 
            </div>
        </div>
    </div>
</div>	
<div class="container">
    <div class="row"> 
        <!-- #content -->
        <div id="content" class="span9">
            <?php if (category_description()) : // Show an optional category description ?>
                <div class="archive-meta"><?php echo category_description(); ?></div>
            <?php endif; ?> 
            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
                    <header class="entry-header">
                        <div class="entry-meta-left">
                            <div class="entry-date-wrap">
                                <?php kumaley_entry_date(); ?>
                            </div>  
                            <div class="entry-post-format-wrap">
                                <?php if (is_sticky() && is_home() && !is_paged()) : ?><i class="fa fa-thumb-tack"></i><?php else: ?><i class="fa fa-pencil"></i><?php endif; ?>
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
                        </div>
                    </header><!-- .entry-header --> 
                    <div class="entry-content">
                        <div class="entry-attachment">
                            <div class="attachment">
                                <?php
                                $attachments = array_values(get_children(array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID')));
                                foreach ($attachments as $k => $attachment) {
                                    if ($attachment->ID == $post->ID)
                                        break;
                                }
                                $k++;
                                if (count($attachments) > 1) {
                                    if (isset($attachments[$k]))
                                        $next_attachment_url = get_attachment_link($attachments[$k]->ID);
                                    else
                                        $next_attachment_url = get_attachment_link($attachments[0]->ID);
                                } else {
                                    $next_attachment_url = wp_get_attachment_url();
                                }
                                ?> 
                                <a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
                                    <?php
                                    $attachment_size = apply_filters('simplecatch_attachment_size', 848);
                                    echo wp_get_attachment_image($post->ID, array($attachment_size, 1024));
                                    ?>
                                </a> 
                                <?php if (!empty($post->post_excerpt)) : ?> 
                                    <?php the_excerpt(); ?> 
                                <?php endif; ?> 
                            </div><!-- .attachment --> 
                        </div><!-- .entry-attachment -->
                        <div class="entry-description">
                            <?php the_content(); ?>
                            <?php the_content(); ?>
                            <?php
                            wp_link_pages(array(
                                'before' => '<div class="pagination">',
                                'after' => '</div>',
                                'link_before' => '<span>',
                                'link_after' => '</span>',
                                'pagelink' => '%',
                                'echo' => 1
                            ));
                            ?>
                        </div><!-- .entry-description -->
                    </div><!-- .entry-summary --> 
                    <footer class="entry-meta">  
                        <?php echo get_the_tag_list('<span class="tag-links">', ' ', '</span>'); ?>       
                    </footer><!-- .entry-meta --> 
                </article>
                <?php comments_template('', true); ?> 
            <?php endwhile; ?>   
        </div> <!-- /#content -->   
        <?php get_sidebar(); ?>  
    </div><!-- /row -->
</div> <!-- /container -->
<?php get_footer(); ?>
<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage blankSlate
 * @since blankSlate 3.5
 */
get_header();
?>
<div class="header-barWrapper js-header-animation"> 
    <div class="container header-bar">
        <div class="row">
            <div class="span9">
                <?php $post_page = get_option('page_for_posts'); ?>
                <h3><?php
                    if ($post_page): echo get_the_title($post_page);
                    else: _e('Our Blog', 'kumaley');
                    endif;
                    ?></h3> 
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
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('content', get_post_format()); ?> 
                <?php comments_template('', true); ?>
                <nav class="nav-single"> 
                    <span class="nav-previous alignleft"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'kumaley') . '</span> %title'); ?></span>
                    <span class="nav-next alignright"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'kumaley') . '</span>'); ?></span>
                </nav><!-- .nav-single -->
            <?php endwhile; // end of the loop. ?>
        </div> <!-- /#content -->   
        <?php get_sidebar(); ?>  
    </div><!-- /row -->
</div> <!-- /container --> 
<?php get_footer(); ?>
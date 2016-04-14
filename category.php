<?php
/**
 * The template for displaying Category pages.
 * Used to display archive-type pages for posts in a category.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
            <?php if (have_posts()) : ?>
                <?php /* Start the Loop */ ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('content', get_post_format()); ?>
                <?php endwhile; ?>
                <?php kumaley_content_nav('nav-below'); ?>
            <?php else : ?>
                <?php get_template_part('content', 'none'); ?>
            <?php endif; // end have_posts() check  ?> 
        </div> <!-- /#content -->   
        <?php get_sidebar(); ?>  
    </div><!-- /row -->
</div> <!-- /container -->
<?php get_footer(); ?>
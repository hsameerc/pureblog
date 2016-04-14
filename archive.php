<?php
/**
 * The template for displaying Archive pages.
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
                <h3><?php
                    if (is_day()) :
                        printf(__('Daily Archives: %s', 'kumaley'), '<span>' . get_the_date() . '</span>');
                    elseif (is_month()) :
                        printf(__('Monthly Archives: %s', 'kumaley'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'kumaley')) . '</span>');
                    elseif (is_year()) :
                        printf(__('Yearly Archives: %s', 'kumaley'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'kumaley')) . '</span>');
                    else :
                        _e('Archives', 'kumaley');
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
            <?php if (category_description()) : // Show an optional category description  ?>
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
        <?php endif; // end have_posts() check   ?> 
        </div> <!-- /#content -->   
<?php get_sidebar(); ?>  
    </div><!-- /row -->
</div> <!-- /container -->
<?php get_footer(); ?>
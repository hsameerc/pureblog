<?php
/**
 * The Template for displaying pages.
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
                <h3><?php echo get_the_title(); ?></h3> 
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
                <?php get_template_part('content', 'page'); ?> 
                <?php comments_template('', true); ?> 
            <?php endwhile; // end of the loop. ?>
        </div> <!-- /#content -->   
        <?php get_sidebar(); ?>  
    </div><!-- /row -->
</div> <!-- /container --> 
<?php get_footer(); ?>
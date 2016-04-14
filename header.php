<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="row header">
 *
 * @package WordPress
 * @subpackage Kumaley
 * @since Kumaley 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel="shortcut icon" href="<?php if (kumaley_get_option('kumaley_favicon') != '') { ?><?php echo kumaley_get_option('kumaley_favicon'); ?><?php } else { ?><?php echo esc_url(get_template_directory_uri()); ?>/images/favicon.ico <?php } ?>" type="image/x-icon" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
        <?php wp_head(); ?>
        <?php if (kumaley_get_option('kumaley_customcss') != '') { ?>
            <style>
    <?php echo kumaley_get_option('kumaley_customcss'); ?>
            </style>
        <?php } ?>
    </head> 
    <body <?php body_class(); ?>>
        <!-- black line from top -->
        <div class="header-blackLine"></div> 
        <div class="container">
            <div class="row header">
                <div class="span4">
                    <!-- logo -->
                    <a href="?page=index">
                        <img class="logo" src="<?php if (kumaley_get_option('kumaley_logo') != '') { ?><?php echo kumaley_get_option('kumaley_logo'); ?><?php } else { ?><?php echo esc_url(get_template_directory_uri()); ?>/images/logo.png <?php } ?>" alt="<?php bloginfo('name'); ?> logo" style="width:207px;"/>
                    </a>

                </div>
                <div class="span8">
                    <!-- responsive dropdown menu -->
                    <div class="js-jquery-dropdown-wrapper">
                        <!-- Start Navigation List -->
                        <?php
                        if (has_nav_menu('primary')) {
                            wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'js-jquery-dropdown'));
                        } else {
                            ?> 
                            <ul class="js-jquery-dropdown">
                                <?php wp_list_pages('title_li=&depth=0'); ?>
                            </ul> 
                        <?php } ?> 
                    </div> <!-- /menu -->
                </div>
            </div> <!-- /.row -->
        </div> <!-- /.container -->  
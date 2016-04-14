<?php
/**
 * Kumaley Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Kumaley
 * @since Kumaley 1.0
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Kumaley 1.0
 */
if (!isset($content_width))
    $content_width = 940; /* pixels */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Kumaley 1.0
 */
function kumaley_setup() {

    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on Kumaley, use a find and replace
     * to change 'kumaley' to the name of your theme in all the template files
     */
    load_theme_textdomain('kumaley', get_template_directory() . '/languages');

    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support('automatic-feed-links');
    /**
     * Allows theme developers to link a custom stylesheet file to the TinyMCE visual editor. 
     */
    add_editor_style();
    //add_theme_support( "title-tag" );

    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'kumaley')
    ));

    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support('post-thumbnails');
    add_image_size('kumaley-home', '2000', '9999', false);

    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ));

    /**
     * Enable support for Post Formats
     */
    add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery'));

    /**
     * Setup the WordPress core custom background feature.
     */
    add_theme_support('custom-background', apply_filters('kumaley_custom_background_args', array(
        'default-color' => 'fff',
    )));

    //add_theme_support( "custom-header");
}

add_action('after_setup_theme', 'kumaley_setup');

/* ======================================================================= */

// Title Filter @uses wp_title() 
/* ======================================================================= */
function kumaley_filter_wp_title() {

// Print the <title> tag based on what is being viewed.
    global $page, $paged;
// Add the blog name.
    bloginfo('name');
// Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() )) {
        echo " | $site_description";
    }
}

add_filter('wp_title', 'kumaley_filter_wp_title');

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Kumaley 1.0
 */
function kumaley_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'kumaley'),
        'id' => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget gdlr-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="gdlr-widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'kumaley_widgets_init');

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Kumaley 1.0
 */
function kumaley_styles() {
    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    // External Load Styles
    wp_register_style('kumaley-bootstrap', get_template_directory_uri() . '/lib/css/bootstrap.min.css', '2.0.4');
    wp_register_style('kumaley-font-awesome', get_template_directory_uri() . '/lib/css/font-awesome.min.css', '4.3.0 ');
    /*
     * Loads our main stylesheet.
     */
    wp_enqueue_style('kumaley-style', get_stylesheet_uri(), array('kumaley-bootstrap', 'kumaley-font-awesome'));
}

add_action('wp_enqueue_scripts', 'kumaley_styles');


/* ======================================================================= */
// A safe way of adding JavaScripts to a WordPress generated page.
/* ======================================================================= */
if (!is_admin())
    add_action('wp_enqueue_scripts', 'kumaley_javascript_files');


if (!function_exists('kumaley_javascript_files')) {

    function kumaley_javascript_files() {
        wp_enqueue_script('jquery');

        // JS at the bottom for fast page loading.  
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/lib/js/bootstrap.min.js', array('jquery'), '2.0.4', true);
        wp_enqueue_script('scripts', get_template_directory_uri() . '/lib/js/scripts.js', array('jquery'), '1.0', true);
    }

}

if (!function_exists('kumaley_content_nav')) :

    /**
     * Displays navigation to next/previous pages when applicable.
     *
     * @since Kumaley 1.0
     */
    function kumaley_content_nav($nav_id) {
        global $wp_query;

        if ($wp_query->max_num_pages > 1) :
            ?>
            <nav id="<?php echo $nav_id; ?>" class="navigation" role="navigation"> 
                <div class="nav-previous alignleft"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'kumaley')); ?></div>
                <div class="nav-next alignright"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'kumaley')); ?></div>
            </nav><!-- #<?php echo $nav_id; ?> .navigation -->
            <?php
        endif;
    }

endif;

if (!function_exists('kumaley_comment')) :

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own kumaley_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since Kumaley 1.0
     */
    function kumaley_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                    <p><?php _e('Pingback:', 'kumaley'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('(Edit)', 'kumaley'), '<span class="edit-link">', '</span>'); ?></p>
                    <?php
                    break;
                default :
                    // Proceed with normal comments.
                    global $post;
                    ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                    <article>
                        <header>
                            <?php
                            echo get_avatar($comment, 44);
                            printf('<cite>%1$s %2$s</cite>', get_comment_author_link(),
                                    // If current post author is also comment author, make it known visually.
                                    ( $comment->user_id === $post->post_author ) ? '<span> ' . __('Post author', 'kumaley') . '</span>' : ''
                            );
                            ?>  
                            <div class="comment-meta">
                                <?php
                                printf('<a class="comment-link" href="%1$s"><time datetime="%2$s">%3$s</time></a>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'),
                                        /* translators: 1: date, 2: time */ sprintf(__('%1$s at %2$s', 'kumaley'), get_comment_date(), get_comment_time())
                                );
                                printf('%1$s', comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'kumaley'), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth']))));
                                ?>
                            </div>
                        </header><!-- .comment-meta -->

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'kumaley'); ?></p>
                        <?php endif; ?>

                        <div class="comment-content">
                            <?php comment_text(); ?>
                            <?php edit_comment_link(__('Edit', 'kumaley'), '<p class="edit-link">', '</p>'); ?>
                        </div><!-- .comment-content --> 
                    </article><!-- #comment-## -->
                    <?php
                    break;
            endswitch; // end comment_type check
        }

    endif;

    if (!function_exists('kumaley_entry_meta')) :

        /**
         * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
         *
         * Create your own kumaley_entry_meta() to override in a child theme.
         *
         * @since Kumaley 1.0
         */
        function kumaley_entry_meta() {
            // Translators: used between list items, there is a space after the comma.
            $categories_list = get_the_category_list(__(', ', 'kumaley'));

            // Translators: used between list items, there is a space after the comma.
            $tag_list = get_the_tag_list('', __(', ', 'kumaley'));
            $author = sprintf('<span class="author">by <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_attr(sprintf(__('View all posts by %s', 'kumaley'), get_the_author())), get_the_author()
            );

            // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
            if ($categories_list) {
                $utility_text = __('%1$s <span class="cat-links"> in %2$s </span>.', 'kumaley');
            } else {
                $utility_text = __('%1$s.', 'kumaley');
            }

            printf(
                    $utility_text, $author, $categories_list
            );
        }

    endif;
    if (!function_exists('kumaley_entry_date')) :

        function kumaley_entry_date() {
            $date = sprintf('<a href="%1$s" title="%2$s" rel="bookmark" class="entry-date"><time class="entry-date" datetime="%3$s">%4$s<br>%5$s</time></a>', esc_url(get_permalink()), esc_attr(get_the_time()), esc_attr(get_the_date('c')), esc_html(get_the_date('d')), esc_html(get_the_date('M'))
            );
            printf(
                    $date
            );
        }

    endif;
    /* ==============================================================
      //Kumaley Footer copyright
      ================================================================ */

    function kumaley_copyright() {
        ?>
        <span class="footer-company"> 
            <?php _e('Copyright', 'kumaley'); ?> &copy; <?php _e(date('Y')); ?> <span><?php bloginfo('name'); ?></span>.<?php _e('All Rights Reserved.', 'kumaley'); ?>
        </span>
        <?php
    }

    add_action('kumaley_copyright', 'kumaley_copyright');


    /**
     * Theme Options 
     *
     * @since Kumaley 1.0
     */ 
    include_once get_template_directory() . '/admin/admin-functions.php';
    include_once get_template_directory() . '/admin/admin-interface.php';
    include_once get_template_directory() . '/admin/theme-options.php';

    function kumaley_get_option($name) {
        $options = get_option('kumaley_options');
        if (isset($options[$name]))
            return $options[$name];
    }

//update theme option
    function kumaley_update_option($name, $value) {
        $options = get_option('kumaley_options');
        $options[$name] = $value;
        return update_option('kumaley_options', $options);
    }

//delete theme option
    function kumaley_delete_option($name) {
        $options = get_option('kumaley_options');
        unset($options[$name]);
        return update_option('kumaley_options', $options);
    }

    $options = get_option('kumaley');
    if (!empty($options) && isset($_REQUEST['activated']) && $_REQUEST['activated'] == 'true') {
        foreach ($options as $key => $val) {
            if ($val != '') {
                kumaley_update_option($key, $val);
            }
        }
    }
    /**
     * Install Necessary Plugins for theme 
     *
     * @since Kumaley 1.0
     */
    require_once(get_template_directory() . '/admin/plugin-activation.php');
    require_once(get_template_directory() . '/admin/kumaley-plugin-notify.php');
    add_action('tgmpa_register', 'kumaley_plugins_notify');
    
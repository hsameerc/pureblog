<?php

add_action('init', 'kumaley_options');
if (!function_exists('kumaley_options')) {

    function kumaley_options() {
        // VARIABLES
        $themename = function_exists('wp_get_theme') ? wp_get_theme() : wp_get_theme();
        $themename = $themename['Name'];
        $shortname = "of";
        // Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }
        // Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }

        // If using image radio buttons, define a directory path
        $imagepath = get_stylesheet_directory_uri() . '/images/';

        $options = array(array("name" => "General Settings",
                "type" => "heading"),
            array("name" => "Custom Logo",
                "desc" => "Choose your own logo. Optimal Size: 207px Wide by 44px Height",
                "id" => "kumaley_logo",
                "type" => "upload"),
            array("name" => "Custom Favicon",
                "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
                "id" => "kumaley_favicon",
                "type" => "upload"),
            array("name" => "Tracking Code",
                "desc" => "Paste your Google Analytics (or other) tracking code here.",
                "id" => "kumaley_analytics",
                "std" => "",
                "type" => "textarea"),
            $options[] = array("name" => "Contact Options",
        "type" => "heading"),
            array("name" => "Phone Number",
                "desc" => "Enter your Phone.",
                "id" => "kumaley_phone",
                "std" => "",
                "type" => "text"),
            array("name" => "Fax",
                "desc" => "Enter your Fax.",
                "id" => "kumaley_fax",
                "std" => "",
                "type" => "text"),
            array("name" => "Email",
                "desc" => "Enter your Email.",
                "id" => "kumaley_email",
                "std" => "",
                "type" => "text"),
            array("name" => "Address",
                "desc" => "Enter your Address.",
                "id" => "kumaley_address",
                "std" => "",
                "type" => "textarea"),
            $options[] = array("name" => "Styling Options",
        "type" => "heading"),
            array("name" => "Custom CSS",
                "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                "id" => "kumaley_customcss",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Social Settings",
                "type" => "heading"),
            array("name" => "Facebook URL",
                "desc" => "Enter your Facebook URL if you have one",
                "id" => "kumaley_facebook",
                "std" => "http://facebook.com/",
                "type" => "text"),
            array("name" => "Twitter URL",
                "desc" => "Enter your Twitter URL if you have one",
                "id" => "kumaley_twitter",
                "std" => "http://twitter.com/",
                "type" => "text"),
            array("name" => "RSS Feed URL",
                "desc" => "Enter your RSS Feed URL if you have one",
                "id" => "kumaley_rss",
                "std" => "",
                "type" => "text"),
            array("name" => "Linked In URL",
                "desc" => "Enter your Linkedin URL if you have one",
                "id" => "kumaley_linkedin",
                "std" => "http://np.linkedin.com/in/",
                "type" => "text"),
            array("name" => "Youtube URL",
                "desc" => "Enter your Youtube URL if you have one",
                "id" => "kumaley_youtube",
                "std" => "http://youtube.com/",
                "type" => "text"),
            $options[] = array("name" => "Footer Options",
        "type" => "heading"),
            array("name" => "Copyright Text",
                "desc" => "Enter your Copyright Text.",
                "id" => "kumaley_copyright",
                "std" => "",
                "type" => "textarea"),
        );
        kumaley_update_option('of_template', $options);
        kumaley_update_option('of_themename', $themename);
        kumaley_update_option('of_shortname', $shortname);
    }

}
?>

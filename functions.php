<?php
/* =BEGIN: Loading jQuery [in the footer] in WordPress via the enqueue_script
    Source: http://www.ericmmartin.com/5-tips-for-using-jquery-with-wordpress/
    2nd source: http://digwp.com/2010/03/wordpress-functions-php-template-custom-functions/
   ---------------------------------------------------------------------------------------------------- */
function wp_jquery_init() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', false, '1.7.2', true);
        wp_enqueue_script('jquery');

        // load other JS files; the final TRUE/FALSE statement is to load the file in the footer if TRUE, header if FALSE
        //wp_enqueue_script('bootstrap_jquery', get_template_directory_uri() . '/assets/js/jquery.js', array('jquery'), '1.0', true);
        //wp_enqueue_script('bootstrap_transition', get_template_directory_uri() . '/assets/js/bootstrap-transition.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_alert', get_template_directory_uri() . '/assets/js/bootstrap-alert.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_modal', get_template_directory_uri() . '/assets/js/bootstrap-modal.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_dropdown', get_template_directory_uri() . '/assets/js/bootstrap-dropdown.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_scrollspy', get_template_directory_uri() . '/assets/js/bootstrap-scrollspy.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_tab', get_template_directory_uri() . '/assets/js/bootstrap-tab.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_tooltip', get_template_directory_uri() . '/assets/js/bootstrap-tooltip.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_popover', get_template_directory_uri() . '/assets/js/bootstrap-popover.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_button', get_template_directory_uri() . '/assets/js/bootstrap-button.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_collapse', get_template_directory_uri() . '/assets/js/bootstrap-collapse.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_carousel', get_template_directory_uri() . '/assets/js/bootstrap-carousel.js', array('jquery'), '2.0.1', true);
        //wp_enqueue_script('bootstrap_typeahead', get_template_directory_uri() . '/assets/js/bootstrap-typeahead.js', array('jquery'), '2.0.1', true);
    }
}
add_action('init', 'wp_jquery_init');


/* =BEGIN: Adding Theme support for various functions
   ---------------------------------------------------------------------------------------------------- */
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
        //set_post_thumbnail_size(211, 128, true);
        add_image_size( 'blog-thumbnail', 81, 81 );
    add_theme_support( 'nav-menus' );
    add_theme_support( 'menus' );
    add_theme_support( 'automatic-feed-links' );
    add_post_type_support( 'page', 'excerpt' ); // Source: http://wordpress.mfields.org/2010/excerpts-for-pages-in-wordpress-3-0/
    //add_theme_support( 'post-formats', array( 'link', 'gallery', 'video', 'audio', 'image' ) ); // http://gregrickaby.com/2011/02/enable-post-formats-in-wordpress-3-1.html
    //add_editor_style( 'assets/css/type/taf-editorial-l.css' ); // http://digwp.com/2010/11/actual-wysiwyg/ and http://www.deluxeblogtips.com/2010/05/editor-style-wordpress-30.html
}


/* =BEGIN: Remove WP generated junk from head
    Source: http://digwp.com/2010/03/wordpress-functions-php-template-custom-functions/
   ---------------------------------------------------------------------------------------------------- */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');


/* =BEGIN: Remove p tags in category_description
    Source: http://wordpress.org/support/topic/get-rid-of-p-tags-in-category_description#post-625941
   ---------------------------------------------------------------------------------------------------- */
// remove_filter('term_description','wpautop');


/* =BEGIN: Set the content width based on the theme's design and stylesheet
    Notes: Used to set the width of images and content. Should be equal to the width the theme is designed for, generally via the style.css stylesheet.
   ---------------------------------------------------------------------------------------------------- */
if ( !isset($content_width) ) $content_width = 640;


/* =BEGIN: Get the first image attached to the Post (DigWP)
    Source: http://digwp.com/2009/08/awesome-image-attachment-recipes-for-wordpress/#dynamic-post-id
   ---------------------------------------------------------------------------------------------------- */
function attachment_toolbox($size = thumbnail) {

    if($images = get_children(array(
    'order'          => 'ASC',
    'orderby'        => 'menu_order',
    'post_type'      => 'attachment',
    'post_parent'    => get_the_ID(),
    'post_mime_type' => 'image',
    'post_status'    => null,
    'numberposts'    => 1,
    ))) {
        foreach($images as $image) {
            $attimg   = wp_get_attachment_image($image->ID,$size); // Get attachment image
            $atturl   = wp_get_attachment_url($image->ID); // Get attachment image URL
            $attlink  = get_attachment_link($image->ID); // Get attachment page link
            $postlink = get_permalink($image->post_parent);  // Get Post link
            $atttitle = apply_filters('the_title',$image->post_title);

            echo $attimg;
        }
  } elseif ( is_single() && is_post_type_hierarchical( 'cpt_colleges' ) ) {
        // This blank elseif gets rid of the automatic thumbnail on the profile pages generated by the else statement below.
  } else {
      echo '<img src="'.get_template_directory_uri().'/assets/images/icon-wreath-star.png" alt="'.get_the_title().'" />';
  }
}


/* =BEGIN: An Implementation of wp_nav_menu
    Source: http://wpfirstaid.com/2010/09/implement-wp_nav_menu/
   ---------------------------------------------------------------------------------------------------- */
function register_my_menus() {
  register_nav_menus(
    array(
      'header_primary' => __( 'Header Primary', 'wpbootstrap' ),
      'header_utility' => __( 'Header Utility', 'wpbootstrap' ),
      'footer_primary' => __( 'Footer Primary', 'wpbootstrap' ),
      'footer_secondary' => __( 'Footer Secondary', 'wpbootstrap' ),//
    )
  );
}
add_action( 'init', 'register_my_menus' );


/* =BEGIN: Theme Widgets
    Source: http://themeshaper.com/wordpress-theme-sidebar-template/
   ---------------------------------------------------------------------------------------------------- */
// Register widgetized areas
function theme_widgets_init() {
    // Area 1
    register_sidebar( array (
    'name' => 'Primary Widget Area',
    'id' => 'primary_widget_area',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

    // Area 2
    register_sidebar( array (
    'name' => 'Secondary Widget Area',
    'id' => 'secondary_widget_area',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

    // Area 3
    register_sidebar( array (
    'name' => 'Header Widget Area',
    'id' => 'header_widget_area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ) );

    // Area 4
    register_sidebar( array (
    'name' => 'Social Widget Area (article top)',
    'id' => 'social_widget_area_top',
    'before_widget' => '<div id="%1$s" class="widget %2$s grid_6 align_right">',
  'after_widget' => '</div>',
    'before_title' => '',
    'after_title' => '',
    ) );

    // Area 5
    register_sidebar( array (
    'name' => 'Social Widget Area (article bottom)',
    'id' => 'social_widget_area_bottom',
    'before_widget' => '',
  'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ) );

} // end theme_widgets_init

add_action( 'init', 'theme_widgets_init' );

$preset_widgets = array (
    'primary_widget_area'  => array( 'search', 'pages', 'categories', 'archives' ),
    'secondary_widget_area'  => array( 'links', 'meta' ),
);
if ( isset( $_GET['activated'] ) ) {
    update_option( 'sidebars_widgets', $preset_widgets );
}
// update_option( 'sidebars_widgets', NULL );

// Check for static widgets in widget-ready areas
function is_sidebar_active( $index ){
    global $wp_registered_sidebars;

    $widgetcolums = wp_get_sidebars_widgets();

    if ($widgetcolums[$index]) return true;

    return false;
} // end is_sidebar_active


/* =BEGIN: Simple WordPress thumbnail function
    Source: http://www.prelovac.com/vladimir/simple-wordpress-thumbnail-function
   ---------------------------------------------------------------------------------------------------- */
function vp_get_thumb_url( $text ) {
    global $post;

    $imageurl = "";

    // extract the thumbnail from attached imaged
    $allimages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );

    foreach ( $allimages as $img ) {
        $img_src = wp_get_attachment_image_src( $img->ID );
        break;
    }

    $imageurl = $img_src[0];

    // try to get any image
    if (!$imageurl) {
        preg_match('/<\s*img [^\>]*src\s*=\s*[\""\']?([^\""\'>]*)/i' ,  $text, $matches);
        $imageurl=$matches[1];
    }

    // try to get youtube video thumbnail
/*
    if (!$imageurl) {
        preg_match("/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/watch(\?v\=|\/v\/)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2);

        $youtubeurl = $matches2[0];
        if ($youtubeurl)
            $imageurl = "http://i.ytimg.com/vi/{$matches2[3]}/1.jpg";
        else preg_match("/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/(v\/)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2);

        $youtubeurl = $matches2[0];
        if ($youtubeurl)
            $imageurl = "http://i.ytimg.com/vi/{$matches2[3]}/1.jpg";
    }
*/

    return $imageurl;
}


/* =BEGIN: How to Customize WordPress login logo without a plugin
    Source: http://www.wprecipes.com/customize-wordpress-login-logo-without-a-plugin
   ---------------------------------------------------------------------------------------------------- */
//  *** For best results, use an image that is less than 326 pixels wide.
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/assets/images/login-logo.png) !important; }
    </style>';
} // END function

add_action('login_head', 'my_custom_login_logo');

//Custom Login Screen
function change_wp_login_url() {
  echo home_url();
} // END function

function change_wp_login_title() {
  echo get_option('blogname');
} // END function

add_filter('login_headerurl', 'change_wp_login_url');
add_filter('login_headertitle', 'change_wp_login_title');


/* =BEGIN: How to Add WordPress Pagination without a Plugin [Enhanced]
    Source: http://design.sparklette.net/teaches/how-to-add-wordpress-pagination-without-a-plugin/
   ---------------------------------------------------------------------------------------------------- */
function wpbootstrap_pagination($pages = '', $range = 5) {
  $showitems = ($range * 2)+1;
  //$showitems = 15;

  global $paged;
  if(empty($paged)) $paged = 1;

  if($pages == '') {
     global $wp_query;
     $pages = $wp_query->max_num_pages;
     if(!$pages)
     {
         $pages = 1;
     }
  }

  if(1 != $pages) {
     echo '<p class="pagination">';
     if($paged > 1 /* && $showitems < $pages // Disabled the secondary check to force the link to be displayed. */) echo '<a href="'.get_pagenum_link($paged - 1).'" class="previous"><span>previous</span></a>';
     //echo '<em>Page</em> '.$paged.'/'.$pages.'';
     if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<a href="'.get_pagenum_link(1).'">1</a> <span>…</span>';

     for ($i=1; $i <= $pages; $i++)
     {
         if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
         {
             echo ($paged == $i)? '<span class="current">'.$i.'</span>':'<a href="'.get_pagenum_link($i).'" class="inactive">'.$i.'</a>'; // This line displays the page number links
         }
     }

     if ($paged < $pages /* && $showitems < $pages // Disabled the secondary check to force the link to be displayed. */) echo '<a href="'.get_pagenum_link($paged + 1).'" class="next"><span>next</span></a>';
     if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<span>…</span> <a href="'.get_pagenum_link($pages).'">'.$pages.'</a>';
     echo '</p>';
  }
}


/* =BEGIN: How to allow authors to set their Twitter Profile URL
    Source: http://yoast.com/wordpress-rel-author-rel-me/
   ---------------------------------------------------------------------------------------------------- */
function wpbootstrap_add_social_profile( $contactmethods ) {
  // Add Twitter Profiles
  $contactmethods['twitter_profile'] = 'Twitter Username';
  return $contactmethods;

}
add_filter( 'user_contactmethods', 'wpbootstrap_add_social_profile', 10, 1);


/* =BEGIN: Removes the white spaces from wp_title
    Source: http://wordpress.org/support/topic/adjust-wp_title-to-remove-space#post-729887
   ---------------------------------------------------------------------------------------------------- */
function af_titledespacer($title) {
    return trim($title);
}

add_filter('wp_title', 'af_titledespacer');


/* =BEGIN: Show Post Time Twitter Style
    Source: http://wpzine.com/show-post-time-twitter-style/
   ---------------------------------------------------------------------------------------------------- */
function twitter_time() {
  echo "Posted about ".human_time_diff(get_the_time('U'), current_time('timestamp'))." ago";
} // END function


/* =BEGIN: Determine if Post is new
    Source: http://codex.wordpress.org/Function_Reference/human_time_diff
   ---------------------------------------------------------------------------------------------------- */
function is_new_post( $limit ) {
    $from = get_the_time('U');
    $to = current_time('timestamp');
    if ( empty($to) )
        $to = time();
    $diff = (int) abs($to - $from);
        $days = round($diff / 86400);
    if ($days <= $limit) {
        return '<span class="label info">new</span>';
    } // END if $days
} // END function


?>
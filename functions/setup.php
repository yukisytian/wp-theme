<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

// ENQUEUE SCRIPTS & STYLES
add_action( 'wp_enqueue_scripts', function(){
	// DEREGISTER DEFAULT WORDPRESS JQUERY FILE
	wp_deregister_script( 'jquery' );

	// STYLESHEETS
	wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );

	// JAVASCRIPTS
	wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), '2.8.3', false );
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', array(), '2.2.4', false );
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1', true );
}, 10 );

// REMOVE SCRIPT & STYLES ATTR TYPES
add_filter( 'style_loader_tag', '_remove_attr', 10, 2 );
add_filter( 'script_loader_tag', '_remove_attr', 10, 2 );
function _remove_attr( $tag, $handle ) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}

// THEME SETUP
add_action( 'after_setup_theme', function(){
	// THEME SUPPORTS
	add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // ENABLE SHORTCODES ON WIDGETS
    add_filter( 'widget_text', 'do_shortcode' );

    // DEFAULT SIDEBAR WIDGET
    register_sidebar( array(
    	'name'          => __( 'Sidebar' ),
        'id'            => 'sidebar-widget',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
    	'name'          => __( 'Mobile Menu' ),
        'id'            => 'mobile-menu-widget',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // DEFAULT MENU
    register_nav_menu( 'primary', __( 'Main Menu', 'wp-theme' ) );
} );

// DISABLE & REMOVE WORDPRESS EMOJIS
add_action( 'init', function(){
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    // REMOVE TINYMCE EMOJI PLUGIN
    add_filter( 'tiny_mce_plugins', function( $plugins ){
    	return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
    } );

    // REMOVE EMOJI CDN HOSTNAME FROM DNS PREFETCHING HINTS
    add_filter( 'wp_resource_hints', function( $urls, $relation_type  ){
		if ( 'dns-prefetch' == $relation_type ) {
	        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
	        $urls = array_diff( $urls, array( $emoji_svg_url ) );
	    }
	    return $urls;
    }, 10, 2 );
} );

// ADD ALT TEXT TO IMAGE ON UPLOAD
add_action( 'add_attachment', function( $post_ID ){
    if ( wp_attachment_is_image( $post_ID ) ) {
        $my_image_title = get_post( $post_ID )->post_title;
        $my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );
        $my_image_title = ucwords( strtolower( $my_image_title ) );
        $my_image_meta = array(
            'ID'        => $post_ID,
            'post_title'    => $my_image_title,
        );
        update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );
        wp_update_post( $my_image_meta );
    }
} );

// SEARCH REDIRECT TO HOME IF BLANK
add_filter( 'request', function( $query_vars ){
    if( isset( $_GET['s'] ) && $_GET['s'] == '' && !is_admin() ) {
        wp_redirect( site_url() );
        exit;
    }
    return $query_vars;
} );

// MEDIA UPLOAD SVG SUPPORT
add_action( 'upload_mimes', function( $file_types ){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
} );

// ADD BOOTSTRAP IMAGE CLASS TO WP THUMBNAILS
add_filter( 'wp_get_attachment_image_attributes', function( $attr ){
    remove_filter('wp_get_attachment_image_attributes','add_class_thumbnail');
    $attr['class'] .= ' img-fluid';
    return $attr;
} );

// DISABLE GUTENBERG BLOCK EDITOR
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);
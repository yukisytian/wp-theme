<?php
// INCLUDE PLUGIN.PHP SO WE CAN USE is_plugin_active()
include_once( ABSPATH.'wp-admin/includes/plugin.php' );

// ACF PLUGIN HOOKS & FUNCTIONS
if ( class_exists( 'acf' ) ) { 
	// OPTIONS PAGE
	acf_add_options_page( array(
        'page_title' => 'General Settings',
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-admin-site'
    ) );

   	// GOOGLE MAP INIT FOR ACF PRO
   	if ( get_field( "google_map_api_key", "option" ) ) {
		add_action('acf/init', function(){
			acf_update_setting( "google_api_key", get_field( "google_map_api_key", "option" ) );
		} );
   	}

   	// ACF INPUT READONLY & DISABLE OPTIONS
   	add_action( 'acf/render_field_settings/type=text', function( $field ){
   		acf_render_field_setting( $field, array(
	        'label'         => __( 'Read Only?', 'acf' ),
	        'instructions'  => '',
	        'type'          => 'radio',
	        'name'          => 'readonly',
	        'default_value' => 0,
	        'layout'  		=>  'horizontal',
	        'choices'       => array(
	                1 => __( "Yes", 'acf' ),
	                0 => __( "No", 'acf' ),
	            ),
	    ) );
	    acf_render_field_setting( $field, array(
	        'label'         => __( 'Disabled?', 'acf' ),
	        'instructions'  => '',
	        'type'          => 'radio',
	        'name'          => 'disabled',
	        'default_value' => 0,
	        'layout'  		=>  'horizontal',
	        'choices'       => array(
	                1 => __( "Yes", 'acf' ),
	                0 => __( "No", 'acf' ),
	            ),
	    ) );
   	} );

   	// only make these functions work on the front-end side
   	if ( !is_admin() ) {
		// HOOK TO wp_head
	   	add_action( "wp_head", function(){
		   	$tag_manager      = get_field( 'google_tag_manager', 'option' );
		   	$google_analytics = get_field( 'google_analytics', 'option' );
		   	$tracking_code    = get_field( 'google_tracking_code', 'option' );
			$tracking_num     = get_field( 'google_tracking_number', 'option' );
			$custom_css       = get_field( 'custom_css', 'option' );
	   	?>
		   	<?php if ( $tag_manager ){ ?>
			   	<!-- TAG MANAGER -->
		   		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','<?php echo $tag_manager; ?>');</script>
		   	<?php } ?>
			
		   	<?php if ( $tracking_code && $tracking_num ){ ?>
				<!-- GOOGLE TRACKING OPTION -->
		   		<script>(function(a,e,c,f,g,b,d){var h={ak:"<?php echo $tracking_num; ?>",cl:"<?php echo $tracking_code; ?>"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[f]||(a[f]=h.ak);b=e.createElement(g);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(g)[0];d.parentNode.insertBefore(b,d);a._googWcmGet=function(b,d,e){a[c](2,b,h,d,null,new Date,e)}})(window,document,"_googWcmImpl","_googWcmAk","script");
				</script>
		   	<?php } ?>
		   	
		   	<?php if ( $google_analytics ){ ?>
			   	<!-- GOOGLE ANALYTICS -->
			   	<script>
					var _gaq = _gaq || [];
					_gaq.push(['_setAccount', '<?php echo $google_analytics; ?>']);
					_gaq.push(['_trackPageview']);
					(function() {
						var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
						ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
						var s  = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
					})();
				</script>
		   	<?php } ?>

		   	<?php if ( $custom_css ){ ?>
			   	<!-- CUSTOM CSS -->
		   		<style><?php echo $custom_css; ?></style>
		   	<?php } ?>
	   	<?php } ); // wp_head end

	   	// AFTER OPENING BODY TAG
	   	add_action( "after_body_tag", function(){ ?>
		   	<?php if ( get_field( 'google_tag_manager', 'option' ) ){ ?>
		   		<!-- TAG MANAGER -->
		   		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo get_field( 'google_tag_manager', 'option' ); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		   	<?php } ?>
	   	<?php } ); // after_body_tag end

	   	// HOOK TO wp_footer
	   	add_action( "wp_footer", function(){ ?>
		   	<?php if ( get_field( 'custom_js', 'option' ) ){ ?>
				<!-- CUSTOM JS -->
		   		<script><?php echo get_field( 'custom_js', 'option' ); ?></script>
		   	<?php } ?>
	   	<?php } ); // wp_footer end
   	} // is_admin() end
}

// GRAVITY FORMS PLUGIN HOOKS & FUNCTIONS
// GFORMS TAB INDEX FUNCTION
add_filter( 'gform_tabindex', '__return_false' );

// DISABLE AUTO SCROLLING UPON SUBMISSION OF GRAVITY FORM
add_filter( 'gform_confirmation_anchor', '__return_false' );

// GRAVITY FORMS ASYNC ISSUE FIX
add_filter( 'gform_cdata_open', function( $content = "" ){
    $content = 'document.addEventListener( "DOMContentLoaded", function() { ';
    return $content;
} );
add_filter( 'gform_cdata_close', function( $content = "" ){
    $content = ' }, false );';
    return $content;
} );
add_filter( 'gform_confirmation', function( $confirmation, $form, $entry, $ajax ){
    if ( $ajax && $form['confirmation']['type'] == 'page' ) {
        $confirmation = "<script>function gformRedirect(){document.location.href='" . get_permalink($form['confirmation']['pageId']) . "';}</script>";
    } elseif ( $ajax && $form['confirmation']['type'] == 'redirect' ) {
        $confirmation = "<script>function gformRedirect(){document.location.href='" . $form['confirmation']['url'] . "';}</script>";
    }
    return $confirmation;
}, 10, 4);
<?php
// KIRKI CUSTOMIZER
locate_template( 'functions/kirki/kirki.php', TRUE, TRUE );
add_filter( 'kirki/config', '_kirki_configuration' );
function _kirki_configuration() {
    return array( 'url_path' => get_stylesheet_directory_uri() . '/functions/kirki/' );
}

// WP CUSTOMIZER
locate_template( "functions/customizer.php", TRUE, TRUE );

// THEME SETUPS, SCRIPTS & STYLES
locate_template( "functions/setup.php", TRUE, TRUE );

// PLUGIN FUNCTIONS & HOOKS
locate_template( "functions/plugins.php", TRUE, TRUE );

// FUNCTION OVERWRITES 
locate_template( "functions/overwrites.php", TRUE, TRUE );

// UPDATES
<?php
/**
 * Plugin Name: RevEngine
 * Plugin URI: https://github.com/j-norwood-young/revengine-wordpress
 * Description: Data from the reader's perspective. A Daily Maverick initiative sponsored by the Google News Initiative.
 * Author: DailyMaverick, Jason Norwood-Young
 * Author URI: https://dailymaverick.co.za
 * Version: 0.0.1-0
 * WC requires at least: 3.9
 * Tested up to: 3.9
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function revengine_init() {
    $revengine_globals = [];
    require_once(plugin_basename('includes/revengine-admin.php' ) );
    $revengine_admin = new RevEngineAdmin($revengine_globals);
    // Modules - these should eventually autoload
    require_once(plugin_basename('modules/piano-composer/piano-composer.php' ) );
    $piano_composer = new PianoComposer($revengine_globals);
}
add_action( 'init', 'revengine_init', 11 );

// Shortcodes
function shortcodes($atts) {
	// require(plugin_basename("templates/debicheck-form-shortcode.php"));
}

add_shortcode( 'debicheck-form', 'shortcodes' );

// revengine_init();
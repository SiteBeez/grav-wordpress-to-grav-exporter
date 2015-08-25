<?php
/*
Plugin Name: wp2grav
Plugin URI: https://github.com/SiteBeez/wordpress-wp2grav-markdown-exporter/tree/master/wp2grav
Description: export your Wordpress into getgrav.org content files
Author: Cord | SiteBeez.com
Author URI: http://www.slogsdon.com/
Version: 1.0.0
*/


namespace wp2grav;

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('WP2GRAV_VERSION')) {
    define('WP2GRAV_VERSION', '1.0');
}
require_once 'vendor/html-to-markdown/src/ConfigurationAwareInterface.php';
require_once 'vendor/html-to-markdown/src/Configuration.php';
require_once 'vendor/html-to-markdown/src/ElementInterface.php';
require_once 'vendor/html-to-markdown/src/Element.php';
require_once 'vendor/html-to-markdown/src/Environment.php';
require_once 'vendor/html-to-markdown/src/HtmlConverter.php';

require_once 'vendor/html-to-markdown/src/Converter/ConverterInterface.php';
$converterDir = ABSPATH . 'wp-content/plugins/wp2grav/vendor/html-to-markdown/src/Converter/';
if (is_dir($converterDir)) {
    foreach (scandir($converterDir) as $_converter) {
        /* Scan all files. */
        if (is_file($converterDir . $_converter)) {
            require_once($converterDir . $_converter);
        }
    }
}
// load configuration
require_once 'includes/wp2grav.config.php';

// init theme
if (file_exists('includes/theme_init.php')) {
    require_once 'includes/theme_init.php';
}

// Support
require_once 'includes/wp2grav-view.class.php';

// Do the businesss
require_once 'includes/wp2grav.class.php';
require_once 'includes/wp2grav-admin.class.php';


$plugin = basename(__FILE__, '.php');
if (is_admin()) {
    new WP2GravAdmin($plugin, __FILE__);
} else {
    new WP2Grav($plugin);
}

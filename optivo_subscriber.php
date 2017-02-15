<?php
/**
 * Plugin Name: Optivo Subscriber
 * Plugin URI: http://eengine.pl/
 * Description: The form of subscription optivo for cms wordpress
 * Version: 1.0
 * Author: Dominik Bielak
 * Author URI: http://eengine.pl/
 **/

// Define plugin directory for inclusions
if (!defined('OPTIVO_DIR')) {
    define('OPTIVO_DIR', dirname(__FILE__));
}

// Define plugin URL for assets
if (!defined('OPTIVO_URL')) {
    define('OPTIVO_URL', plugins_url('', __FILE__));
}

// Define plugin version for upgrade
if (!defined('OPTIVO_VERSION')) {
    define('OPTIVO_VERSION', '1.0');
}

register_activation_hook(__FILE__, 'optivo_activation');
add_action('plugins_loaded', 'optivo_init');
function optivo_init()
{
    include_once(OPTIVO_DIR.'/optivo-functions.php');
    include_once(OPTIVO_DIR.'/admin/ajax.php');
}




<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://webberty.com
 * @since             1.0.0
 * @package           WBB_Off_Canvas_Menu
 *
 * @wordpress-plugin
 * Plugin Name:       Wbb Off Canvas Menu
 * Plugin URI:        webberty.com
 * Description:       Adds a customisable Off-Canvas menu to your website.
 * Version:           1.0.0
 * Author:            Webberty
 * Author URI:        http://webberty.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wbb-offcanvas-menu
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) )
{
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wbb-ocm-activator.php
 */
function activate_wbb_push_menu()
{
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wbb-ocm-activator.php';
    WBB_Off_Canvas_Menu_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wbb-ocm-deactivator.php
 */
function deactivate_wbb_push_menu()
{
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wbb-ocm-deactivator.php';
    WBB_Off_Canvas_Menu_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wbb_push_menu' );
register_deactivation_hook( __FILE__, 'deactivate_wbb_push_menu' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wbb-ocm.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wbb_push_menu()
{

    $plugin = new WBB_Off_Canvas_Menu();
    $plugin->run();
}

run_wbb_push_menu();

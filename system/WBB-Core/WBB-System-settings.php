<?php

add_action ( 'admin_menu' , 'wbb_theme_setup_menu' );

add_action ( 'admin_init' , 'register_wbb_theme_setting' );

// Insert Menu Item
function wbb_theme_setup_menu ()
{

	add_theme_page ( 'Wbb Theme' , 'Wbb Theme' , 'manage_options' , 'wbb-theme-plugin-settings' , 'wbb_theme_settings' , 'dashicons-archive' );
}

// Function called in settings menu item
function wbb_theme_settings ()
{

	$menus = get_terms ( 'nav_menu' , array ( 'hide_empty' => TRUE ) );

        // Pagination
        
        $activate_pagination = get_option ( 'wbb_theme_activate_pagination' ) ? get_option ( 'wbb_theme_activate_pagination' ) : "" ;
    
        // Breadcrumb
        
        $activate_breadcrumb = get_option ( 'wbb_theme_activate_breadcrumb' ) ? get_option ( 'wbb_theme_activate_breadcrumb' ) : "" ;
        
        $breadcrumb_separator = get_option ( 'wbb_theme_breadcrumb_separator' ) ? get_option ( 'wbb_theme_breadcrumb_separator' ) : "&gt;" ;


	require plugin_dir_path ( __FILE__ ) . 'partials/wbb_theme_settings_callback.php';
}

function register_wbb_theme_setting ()
{

    
    // Pagination
    
    register_setting ( 'wbb-theme-setting-section' , 'wbb_theme_activate_pagination' ) ;
    
    // Breadcrumb
    
    register_setting ( 'wbb-theme-setting-section' , 'wbb_theme_activate_breadcrumb' ) ;
    
    register_setting ( 'wbb-theme-setting-section' , 'wbb_theme_breadcrumb_separator' ) ;

}


function wbb_theme_upload_scripts ()
{

    global $pagenow , $wp_customize ;

    if ( 'themes.php' === $pagenow || isset ( $wp_customize ) )
    {
        wp_enqueue_media () ;
    }
}

add_action ( 'admin_enqueue_scripts' , 'wbb_theme_upload_scripts' ) ;
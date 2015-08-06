<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://webberty.com
 * @since      1.0.0
 *
 * @package    WBB_Off_Canvas_Menu
 * @subpackage WBB_Off_Canvas_Menu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WBB_Off_Canvas_Menu
 * @subpackage WBB_Off_Canvas_Menu/admin
 * @author     Webberty <info@webberty.com>
 */
class WBB_Off_Canvas_Menu_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version     = $version;

        add_action('admin_menu', array(
            $this,
            'wbb_off_canvas_setup_menu' ));

        add_action('wp_ajax_wbb_off_canvas_save_settings', array(
            $this,
            'wbb_off_canvas_save_settings' ));


        add_action('customize_register', array(
            $this,
            "wbb_ocm_customize" ));

        add_action('customize_preview_init', array(
            $this,
            'wbb_off_canvas_customizer_live_preview'
            ) 
        );
        
        
        
        add_filter('plugin_action_links', array($this, 'wbb_ocm_setting_link'), 10, 2);
        
        
        
    }

    public function wbb_ocm_setting_link($links, $file) {

        if ( $file == 'wbb-offcanvas-menu/wbb-ocm.php' ) {
            /* Insert the link at the end*/
            $links['settings'] = sprintf( '<a href="%s"> %s </a>', admin_url( 'themes.php?page=wbb-off-canvas-menu' ), __( 'Settings', 'plugin_domain' ) );
        }
        return $links;

    }
    
    public function wbb_off_canvas_customizer_live_preview()
    {
        wp_enqueue_script($this->plugin_name."-customizer-js", plugin_dir_url(__FILE__) . 'js/wbb-ocm-customizer.js',  array( 'jquery', 'customize-preview' ), $this->version, false);

        wp_localize_script($this->plugin_name."-customizer-js", 'MyAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php') ));
    }

    public function wbb_ocm_customize($wp_customize)
    {
        $wp_customize->add_section('wbb_ocm_section', array(
            'priority'       => 1190,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Off Canvas Menu', 'textdomain'),
            'description'    => '',
        ));

        $wp_customize->add_setting(
                'wbb_ocm_menu_name', array(
            'default' => 'nav-menu',
                )
        );

        $menus = get_terms('nav_menu', array(
            'hide_empty' => false ));

        $control_settings = array();

        foreach ( $menus as $menu )
        {
            $choices[ $menu->slug ] = $menu->name;
        }

        $control_settings[ "type" ]    = "select";
        $control_settings[ "label" ]   = "Select the navigation menu:";
        $control_settings[ "section" ] = "wbb_ocm_section";
        $control_settings[ "choices" ] = $choices;

        $wp_customize->add_control(
                'wbb_ocm_menu_name', $control_settings
        );

        $wp_customize->add_setting(
                'wbb_ocm_sidebar_side', array(
            'default' => 'left',
                )
        );

        $wp_customize->add_control(
                'wbb_ocm_sidebar_side', array(
            'type'    => 'select',
            'label'   => 'Select the sidebar side:',
            'section' => 'wbb_ocm_section',
            'choices' => array(
                'left'  => 'Left',
                'right' => 'Right'
            ),
                )
        );

        $wp_customize->add_setting(
                'wbb_ocm_trigger_side', array(
            'default' => 'left',
                )
        );

        $wp_customize->add_control(
                'wbb_ocm_trigger_side', array(
            'type'    => 'select',
            'label'   => 'Select the trigger button side:',
            'section' => 'wbb_ocm_section',
            'choices' => array(
                'left'  => 'Left',
                'right' => 'Right'
            ),
                )
        );
    }

    /**
     * Add WP-Dashboard page
     */
    public function wbb_off_canvas_setup_menu()
    {
        add_theme_page('Off Canvas Menu', 'Off Canvas Menu', 'manage_options', 'wbb-off-canvas-menu', array(
            $this,
            'wbb_off_canvas_menu_settings' ));
    }

    /**
     * Show the view of the setting page.
     */
    function wbb_off_canvas_menu_settings()
    {

        $ocm_status = ( get_theme_mod("wbb_ocm_status") !== "" ? get_theme_mod("wbb_ocm_status") : "deactivated" );

        $sidebar_side = ( get_theme_mod("wbb_ocm_sidebar_side") !== "" ? get_theme_mod("wbb_ocm_sidebar_side") : "left" );
        
        $trigger_side = ( get_theme_mod("wbb_ocm_trigger_side") !== "" ? get_theme_mod("wbb_ocm_trigger_side") : "left" );
        $trigger_icon = ( get_option("wbb_ocm_trigger_icon") !== "" ? get_option("wbb_ocm_trigger_icon") : plugin_dir_url(__FILE__) . "img/trigger_icon1.png" );
        $trigger_background = ( get_theme_mod("wbb_ocm_trigger_background") !== "" ? get_theme_mod("wbb_ocm_trigger_background") : "#321321" );

        $menu_name        = get_theme_mod("wbb_ocm_menu_name");
        $css_selector     = get_option("wbb_ocm_css_selector");
        $background       = get_option("wbb_ocm_background");
        $background_hover = get_option("wbb_ocm_background_hover");
        $borders          = get_option("wbb_ocm_borders");
        $font_color       = get_option("wbb_ocm_font_color");
        $font_color_hover = get_option("wbb_ocm_font_color_hover");
        $font_family      = get_option("wbb_ocm_font_family");

        $devices_desktop = ( get_option("wbb_ocm_devices_desktop") !== "" ? get_option("wbb_ocm_devices_desktop") : 0 );
        $devices_laptop  = ( get_option("wbb_ocm_devices_laptop") !== "" ? get_option("wbb_ocm_devices_laptop") : 0 );
        $devices_tablet  = ( get_option("wbb_ocm_devices_tablet") !== "" ? get_option("wbb_ocm_devices_tablet") : 0 );
        $devices_mobile  = ( get_option("wbb_ocm_devices_mobile") !== "" ? get_option("wbb_ocm_devices_mobile") : 0 );


        include_once plugin_dir_path(__FILE__) . 'partials/wbb-ocm-admin-display.php';
    }

    /**
     * Save and update the settings via Ajax call
     */
    function wbb_off_canvas_save_settings()
    {

        if ( isset($_POST[ "wbb_ocm_trigger_background" ]) )
            set_theme_mod("wbb_ocm_trigger_background", $_POST[ "wbb_ocm_trigger_background" ]);
        
        if ( isset($_POST[ "wbb_ocm_sidebar_side" ]) )
            set_theme_mod("wbb_ocm_sidebar_side", $_POST[ "wbb_ocm_sidebar_side" ]);

        if ( isset($_POST[ "wbb_ocm_status" ]) )
        {
            set_theme_mod("wbb_ocm_status", $_POST[ "wbb_ocm_status" ]);
        }

        if ( isset($_POST[ "wbb_ocm_trigger_side" ]) )
        {
            set_theme_mod("wbb_ocm_trigger_side", $_POST[ "wbb_ocm_trigger_side" ]);
        }

        if ( isset($_POST[ "wbb_ocm_trigger_icon" ]) )
        {
            update_option("wbb_ocm_trigger_icon", $_POST[ "wbb_ocm_trigger_icon" ]);
        }


        if ( isset($_POST[ "wbb_ocm_devices_desktop" ]) )
        {
            update_option("wbb_ocm_devices_desktop", $_POST[ "wbb_ocm_devices_desktop" ]);
        }

        if ( isset($_POST[ "wbb_ocm_devices_laptop" ]) )
        {
            update_option("wbb_ocm_devices_laptop", $_POST[ "wbb_ocm_devices_laptop" ]);
        }

        if ( isset($_POST[ "wbb_ocm_devices_tablet" ]) )
        {
            update_option("wbb_ocm_devices_tablet", $_POST[ "wbb_ocm_devices_tablet" ]);
        }

        if ( isset($_POST[ "wbb_ocm_devices_mobile" ]) )
        {
            update_option("wbb_ocm_devices_mobile", $_POST[ "wbb_ocm_devices_mobile" ]);
        }

        if ( isset($_POST[ "wbb_ocm_menu_name" ]) )
        {
            set_theme_mod("wbb_ocm_menu_name", $_POST[ "wbb_ocm_menu_name" ]);
        }

        if ( isset($_POST[ "wbb_ocm_css_selector" ]) )
        {
            update_option("wbb_ocm_css_selector", $_POST[ "wbb_ocm_css_selector" ]);
        }

        if ( isset($_POST[ "wbb_ocm_background_hover" ]) )
        {
            update_option("wbb_ocm_background_hover", $_POST[ "wbb_ocm_background_hover" ]);
        }

        if ( isset($_POST[ "wbb_ocm_background" ]) )
        {
            update_option("wbb_ocm_background", $_POST[ "wbb_ocm_background" ]);
        }

        if ( isset($_POST[ "wbb_ocm_borders" ]) )
        {
            update_option("wbb_ocm_borders", $_POST[ "wbb_ocm_borders" ]);
        }

        if ( isset($_POST[ "wbb_ocm_font_color" ]) )
        {
            update_option("wbb_ocm_font_color", $_POST[ "wbb_ocm_font_color" ]);
        }

        if ( isset($_POST[ "wbb_ocm_font_color_hover" ]) )
        {
            update_option("wbb_ocm_font_color_hover", $_POST[ "wbb_ocm_font_color_hover" ]);
        }

        if ( isset($_POST[ "wbb_ocm_font_family" ]) )
        {
            update_option("wbb_ocm_font_family", $_POST[ "wbb_ocm_font_family" ]);
        }

        die();
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wbb-ocm-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_media();
        // Add the color picker css file       
        wp_enqueue_style('wp-color-picker');

        /*
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script('custom-script-handle', plugins_url('custom-script.js', __FILE__), array(
            'wp-color-picker' ), false, true);
            */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wbb-ocm-admin.js', array(
            'jquery' ), $this->version, false);

        wp_localize_script($this->plugin_name, 'MyAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php') ));
    }

}

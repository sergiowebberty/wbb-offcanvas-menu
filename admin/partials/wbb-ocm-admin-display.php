<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://webberty.com
 * @since      1.0.0
 *
 * @package    WBB_Off_Canvas_Menu
 * @subpackage WBB_Off_Canvas_Menu/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wbb_ocm_settings_container">

    <h1>WBB Off Canvas Menu</h1>
    <hr>
    
    <h3><?php _e("Status", "wbb-offcanvas-menu");?></h3>
    <div class="wbb_ocm_setting_block wbb_ocm_status_block">
        
        <div class="wbb_checkbox <?php echo ( $ocm_status === "activated" ? "activated" : "" )?>">
            
            <span class="on"><?php _e("On", "wbb-offcanvas-menu");?></span>
            <span class="off"><?php _e("Off", "wbb-offcanvas-menu");?></span>
            
            <span class="indicator"></span>
        </div>
        

        <div class="wbb_ocm_status_result wbb_ocm_status_result_activated" style="display: none;"><?php echo __("activated", "wbb-offcanvas-menu");?></div>

        <div class="wbb_ocm_status_result wbb_ocm_status_result_deactivated" style="display: none;"><?php echo __("deactivated", "wbb-offcanvas-menu");?></div>

<!--        <div class="wbb_ocm_status_result"><?php echo ( $ocm_status === "activated" ? __("activated", "wbb-offcanvas-menu") : __("deactivated", "wbb-offcanvas-menu") );?></div>-->
        <br>
        <small><?php _e("The admins always will see the menu, to check the style before activate.", "wbb-offcanvas-menu");?></small>
        <input type="hidden" name="wbb_ocm_status" value="<?php echo $ocm_status?>" />
        
    </div>
    
    
    <h3><?php _e("Menu and devices options", "wbb-offcanvas-menu");?></h3>
    <div class="wbb_ocm_setting_block">

        <div class="left-col">
            <label>
                <span class="info-span"><?php _e("Menu Name", "wbb-offcanvas-menu");?></span>
                
                <select name="wbb_ocm_menu_name">
                    <?php
                    $menus = get_terms ( 'nav_menu', array(
                        'hide_empty' => false) );

                    foreach ( $menus as $menu )
                    {
                        echo ( $menu->name === $menu_name ? "<option value='$menu->name' selected>$menu->name</option>" : "<option value='$menu->name'>$menu->name</option>" );
                    }
                    ?>

                </select>

            </label>
        </div>
        <div class="right-col">
            <label>
                <span class="info-span"><?php _e("Select the devices screen where the menu will be available", "wbb-offcanvas-menu");?></span>

                <div class="wbb_ocm_device_inputs_container">

                    <input type="text" class="wbb_ocm_devices_inputs" name="wbb_ocm_devices_desktop" value="<?php echo $devices_desktop ?>" />
                    <input type="text" class="wbb_ocm_devices_inputs" name="wbb_ocm_devices_laptop" value="<?php echo $devices_laptop ?>" />
                    <input type="text" class="wbb_ocm_devices_inputs" name="wbb_ocm_devices_tablet"  value="<?php echo $devices_tablet ?>" />
                    <input type="text" class="wbb_ocm_devices_inputs" name="wbb_ocm_devices_mobile"  value="<?php echo $devices_mobile ?>" />

                </div>

                <ul class="wbb_ocm_devices_list">
                    <li class="wbb_com_device wbb_devices_<?php echo $devices_desktop ?>" data-input="wbb_ocm_devices_desktop"></li>
                    <li class="wbb_com_device wbb_devices_<?php echo $devices_laptop ?>" data-input="wbb_ocm_devices_laptop"></li>
                    <li class="wbb_com_device wbb_devices_<?php echo $devices_tablet ?>" data-input="wbb_ocm_devices_tablet"></li>
                    <li class="wbb_com_device wbb_devices_<?php echo $devices_mobile ?>" data-input="wbb_ocm_devices_mobile"></li>
                </ul>

            </label>
        </div>

    </div>


    <h3><?php _e("Sidebar options", "wbb-offcanvas-menu");?></h3>
    <div class="wbb_ocm_setting_block">

        <div class="left-col">
            <label>
                <span class="info-span"><?php _e("Sidebar side", "wbb-offcanvas-menu");?></span>
                <select name="wbb_ocm_sidebar_side">
                    <option value="left" <?php echo ($sidebar_side === "left" ? "selected" : "") ?>><?php _e("Left", "wbb-offcanvas-menu");?></option>
                    <option value="right" <?php echo ($sidebar_side === "right" ? "selected" : "") ?>><?php _e("Right", "wbb-offcanvas-menu");?></option>
                </select>
            </label>

            <label>
                <span class="info-span"><?php _e("Select Font Family", "wbb-offcanvas-menu");?></span>
                
                <input type="hidden" name="wbb_ocm_font_family" value="<?php echo str_replace ( "\\", "", $font_family ) ?>" />
                
                <ul>
                    <li class="wbb_com_font_family_item"><span style="font-family: <?php echo str_replace ( "\\", "", $font_family ) ?>;">Theme style</span></li>
                    <li class="wbb_com_font_family_item <?php echo ( str_replace ( "\\", "", $font_family ) === "Georgia, serif" ? "active" : "" )?>" ><span style='font-family: Georgia, serif'>Serif</span></li>
                    <li class="wbb_com_font_family_item <?php echo ( str_replace ( "\\", "", $font_family ) === "Arial, Helvetica, sans-serif" ? "active" : "" )?>" ><span style='font-family: Arial, Helvetica, sans-serif'>Sans-serif</span></li>
                    <li class="wbb_com_font_family_item <?php echo ( str_replace ( "\\", "", $font_family ) === "'Courier New', Courier, monospace" ? "active" : "" )?>" ><span style='font-family: "Courier New", Courier, monospace'>Monospace</span></li>
                </ul>
                
            </label>

        </div>
        <div class="right-col">
            <fieldset>

                <label>
                    <span class="info-span"><?php _e("Background", "wbb-offcanvas-menu");?></span>
                    <input type="text" class="wbb_ocm_colorpicker" name="wbb_ocm_background" value="<?php echo $background ?>" >
                </label>
                <label>
                    <span class="info-span"><?php _e("Background on mouse over", "wbb-offcanvas-menu");?></span>
                    <input type="text" class="wbb_ocm_colorpicker" name="wbb_ocm_background_hover" value="<?php echo $background_hover ?>" >
                </label>
                <label>
                    <span class="info-span"><?php _e("Borders", "wbb-offcanvas-menu");?></span>
                    <input type="text" class="wbb_ocm_colorpicker" name="wbb_ocm_borders" value="<?php echo $borders ?>" >
                </label>
                <label>
                    <span class="info-span"><?php _e("Font color", "wbb-offcanvas-menu");?></span>
                    <div class="color-container">
                        <input type="text" class="wbb_ocm_colorpicker" name="wbb_ocm_font_color" value="<?php echo $font_color ?>" >
                    </div>
                </label>
                <label>
                    <span class="info-span"><?php _e("Font color on mouse over", "wbb-offcanvas-menu");?></span>
                    <input type="text" class="wbb_ocm_colorpicker" name="wbb_ocm_font_color_hover" value="<?php echo $font_color_hover ?>" >
                </label>

            </fieldset>
        </div>

    </div>


    <h3><?php _e("Trigger button options", "wbb-offcanvas-menu");?></h3>
    <div class="wbb_ocm_setting_block">

        <div class="left-col">

            <label>
                <span class="info-span"><?php _e("ID or Class (css selector) where the push menu trigger button will appear.", "wbb-offcanvas-menu");?></span>
                <input type="text" name="wbb_ocm_css_selector" value="<?php echo $css_selector ?>" >
            </label>

            <label>
                <span class="info-span"><?php _e("Trigger button side", "wbb-offcanvas-menu");?></span>
                <select name="wbb_ocm_trigger_side">
                    <option value="left" <?php echo ($trigger_side === "left" ? "selected" : "") ?>>Left</option>
                    <option value="right" <?php echo ($trigger_side === "right" ? "selected" : "") ?>>Right</option>
                </select>
            </label>
        </div>
        <div class="right-col">
            <label>

                <span class="info-span"><?php _e("Select the trigger button icon", "wbb-offcanvas-menu");?></span>

                <input type="hidden" name="wbb_ocm_trigger_icon" value="<?php echo $trigger_icon ?>" />

                <ul class="wbb_ocm_trigger_icon_list">

                    <li class="wbb_ocm_trigger_icon <?php echo ( $trigger_icon === plugin_dir_url ( __DIR__ ) . "img/trigger-icon-1.png" ? "active" : "" ); ?>"><img src="<?php echo plugin_dir_url ( __DIR__ ); ?>img/trigger-icon-1.png"></li>
                    <li class="wbb_ocm_trigger_icon <?php echo ( $trigger_icon === plugin_dir_url ( __DIR__ ) . "img/trigger-icon-2.png" ? "active" : "" ); ?>"><img src="<?php echo plugin_dir_url ( __DIR__ ); ?>img/trigger-icon-2.png"></li>
                    <li class="wbb_ocm_trigger_icon <?php echo ( $trigger_icon === plugin_dir_url ( __DIR__ ) . "img/trigger-icon-3.png" ? "active" : "" ); ?>"><img src="<?php echo plugin_dir_url ( __DIR__ ); ?>img/trigger-icon-3.png"></li>
                    <li class="wbb_ocm_trigger_icon <?php echo ( $trigger_icon === plugin_dir_url ( __DIR__ ) . "img/trigger-icon-4.png" ? "active" : "" ); ?>"><img src="<?php echo plugin_dir_url ( __DIR__ ); ?>img/trigger-icon-4.png"></li>
                    <li class="wbb_ocm_trigger_icon <?php echo ( $trigger_icon === plugin_dir_url ( __DIR__ ) . "img/trigger-icon-5.png" ? "active" : "" ); ?>"><img src="<?php echo plugin_dir_url ( __DIR__ ); ?>img/trigger-icon-5.png"></li>
                    <li class="wbb_ocm_trigger_icon <?php echo ( $trigger_icon === plugin_dir_url ( __DIR__ ) . "img/trigger-icon-6.png" ? "active" : "" ); ?>"><img src="<?php echo plugin_dir_url ( __DIR__ ); ?>img/trigger-icon-6.png"></li>
                    <li class="wbb_ocm_trigger_icon <?php echo ( $trigger_icon === plugin_dir_url ( __DIR__ ) . "img/trigger-icon-7.png" ? "active" : "" ); ?>"><img src="<?php echo plugin_dir_url ( __DIR__ ); ?>img/trigger-icon-7.png"></li>
                    <li class="wbb_ocm_trigger_icon <?php echo ( $trigger_icon === plugin_dir_url ( __DIR__ ) . "img/trigger-icon-8.png" ? "active" : "" ); ?>"><img src="<?php echo plugin_dir_url ( __DIR__ ); ?>img/trigger-icon-8.png"></li>

                </ul>
                <hr>

                <div class="button wbb_ocm_trigger_icon_button"><?php _e("Upload your icon", "wbb-offcanvas-menu");?></div>

                <hr>

                <span class="info-span"><?php _e("Trigger button background", "wbb-offcanvas-menu");?></span><br>
                <input type="text" class="wbb_ocm_colorpicker trigger_background" name="wbb_ocm_trigger_background" value="<?php echo $trigger_background ?>" >
                
                <span class="info-span"><?php _e("Icon preview:", "wbb-offcanvas-menu");?></span>
                <img class="wbb_com_trigger_icon_selected" src="<?php echo $trigger_icon ?>" style="background-color: <?php echo $trigger_background?>">

                
                
            </label>
        </div>

    </div>

    <hr>
    <div class="wbb_ocm_settings_submit button button-primary"><?php _e("Update", "wbb-offcanvas-menu");?></div>

</div>

<iframe id="wbb_ocm_iframe_font_family" src="<?php echo bloginfo ( "url" ) ?>">
</iframe>
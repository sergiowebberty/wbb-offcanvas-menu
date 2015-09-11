<h1 class='nav-tab-wrapper'>General Settings</h1>

<div class="wrap">

    <form method="post" action="options.php">

        <?php settings_fields ( 'wbb-theme-setting-section' ) ; ?>
        <?php do_settings_sections ( 'wbb-theme-setting-section' ) ; ?>


        <h3 class='nav-tab-wrapper'>Breadcrumb</h3>

        <table class="wp-list-table widefat fixed posts">

            <tbody>


                <tr class="alternate">

                    <td>

                        Activate Breadcrumbs

                    </td>

                    <td>

                        <input type="checkbox" name="wbb_theme_activate_breadcrumb" value="yes" <?php echo $activate_breadcrumb == "yes" ? ' checked ' : '' ; ?>>

                    </td>

                </tr>

                <tr >

                    <td>

                        Breadcrumbs Separator

                    </td>

                    <td>

                        <input type="text" name="wbb_theme_breadcrumb_separator" value="<?php echo $breadcrumb_separator ; ?>">

                    </td>

                </tr>

            </tbody>

        </table>

        <h3 class='nav-tab-wrapper'>Pagination</h3>


        <table class="wp-list-table widefat fixed posts">

            <tbody>



                <tr>

                    <td>

                        Activate Pagination

                    </td>

                    <td>

                        <input type="checkbox" name="wbb_theme_activate_pagination" value="yes" <?php echo $activate_pagination == "yes" ? ' checked ' : '' ; ?>>

                    </td>

                </tr>



            </tbody>

        </table>


        <?php submit_button () ; ?>

    </form>


</form>

</div>

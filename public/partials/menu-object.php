<div class="wbb-ocm-container <?php echo $sidebar_side ?>">
    <menu class="wbb-ocm-main-title">
        <menuitem><span class="wbb-ocm-close">X</span></menuitem>
    </menu>
    <?php
    $menu = wp_get_nav_menu_object( $menu_name );

    $menu_items = wp_get_nav_menu_items( $menu->term_id );

    $menu_list = '<menu class="wbb-ocm-main" id="menu-' . $menu_name . '">';

    foreach ( (array) $menu_items as $key => $menu_item )
    {

        $title = $menu_item->title;
        $url   = $menu_item->url;
        $menu_list .= '<menuitem data-post-id="' . $menu_item->ID . '" data-parent-id="' . $menu_item->menu_item_parent . '" data-url-target="' . $url . '">' . $title . '  </menuitem>';
    }
    $menu_list .= '</menu>';
    echo $menu_list;
    ?>

</div>
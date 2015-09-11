(function($) {
    'use strict';

//-------------------------------------------

    var opened_menus = [];

    $(document).ready(function() {
        init_menu();
    });
    $(window).resize(function() {

        if ( $(".wbb-ocm-container").length > 0 )
        {
            $(".wbb-ocm-container, .wbb-ocm-trigger").remove();
        }
        init_menu();
    });

    function init_menu()
    {

        var delay_init_menu = setInterval(function() {

            $.ajax({
                method: "POST"
                , url: MyAjax.ajaxurl
                , data: {
                    action: "wbb_ocm_return_menu"
                    , screen_size: $(window).width()
                }
                , dataType: "json"
                , success: function(data) {

                    if ( $(".wbb-ocm-container").length < 1 )
                    {

                        $("body").prepend(data.menu_object).addClass(data.sidebar_side);

                        add_style();
                        add_events();
                        rebuild_menu();

                    }

                }
            });

            $.ajax({
                method: "POST"
                , url: MyAjax.ajaxurl
                , data: {
                    action: "add_trigger_button"
                    , screen_size: $(window).width()
                }
                , dataType: "json"
                , success: function(data) {

                    if ( data !== null )
                    {
                        
                        $(".wbb-ocm-trigger").remove();

                        var trigger_div = $(data.trigger_target);

                        if ( trigger_div.length > 0 ) {

                            $(data.trigger_target).prepend(data.trigger_object);

                        }

                        else {

                            $("body").prepend(data.trigger_object);

                        }


                    }

                }
            });

            clearInterval(delay_init_menu);

        }, 500);



    }

    function add_style()
    {

        $.ajax({
            method: "POST"
            , url: MyAjax.ajaxurl
            , data: {
                action: "wbb_ocm_add_style"
            }
            , dataType: "json"
            , success: function(style) {

                // Background
                $("\
  .wbb-ocm-container\n\
, .wbb-ocm-container menu\n\
, .wbb-ocm-submenu, .wbb-ocm-container menuitem").css("background-color", style.wbb_ocm_background);

                $(".wbb-ocm-trigger").css("background-color", style.wbb_ocm_trigger_background)


                $(".wbb-ocm-container menuitem").mouseenter(function() {
                    $(this).css("background-color", style.wbb_ocm_background_hover);
                }).mouseleave(function() {
                    $(this).css("background-color", style.wbb_ocm_background);
                });

                // wbb_ocm_borders
                $("menu.wbb-ocm-submenu").css("border-right-color", style.wbb_ocm_borders);
                $("menuitem").css("border-bottom-color", style.wbb_ocm_borders);

                //Font color
                $(".wbb-ocm-container menuitem").css("color", style.wbb_ocm_font_color);
                $(".wbb-ocm-container menuitem").mouseenter(function() {
                    $(this).css("color", style.wbb_ocm_font_color_hover);
                }).mouseleave(function() {
                    $(this).css("color", style.wbb_ocm_font_color);
                });

                //Font Family
                $(".wbb-ocm-container menuitem").css("font-family", style.wbb_ocm_font_family);

            }
        });




    }

    function rebuild_menu()
    {

        var delay_rebuild = setInterval(function() {

            var lis = $(".wbb-ocm-container .wbb-ocm-main menuitem");

            $.each(lis, function(key, val) {

                var this_id = $(this).attr("data-post-id");
                var parent_id = $(this).attr("data-parent-id");
                var url = $(this).attr("data-url-target");

                if ( parent_id > 0 )
                {

                    if ( $("menuitem[data-post-id='" + parent_id + "']").find("menu").length < 1 )
                    {
                        $("menuitem[data-post-id='" + parent_id + "']").append("<menu><menuitem class='wbb-ocm-submenu-close'>Back</menuitem></menu>");
                    }

                    $("menuitem[data-post-id='" + parent_id + "'] menu").append("<menuitem data-post-id='" + this_id + "' data-url-target='" + url + "'>" + $(this).html() + "</menuitem>")

                    $(this).remove();

                }


            });

            clearInterval(delay_rebuild);

        }, 500);

    }

    function add_events()
    {

        $(document).on("click", ".wbb-ocm-submenu menuitem, .wbb-ocm-container menuitem", function() {

            var $this = $(this)
            var data_post_id = $(this).attr("data-post-id");

            if ( !$(this).parents("menu").hasClass("wbb-ocm-main-title") )
            {

                if ( $(this).find("menu").length > 0 )
                {

                    if ( parseInt(opened_menus.indexOf(data_post_id)) < 0 )
                    {

                        $(".wbb-ocm-container").append("<menu class='wbb-ocm-submenu' data-menu-id='" + data_post_id + "'>" + $(this).find("menu").html() + "</menu>");

                        var delay_submenu = setInterval(function() {

                            $(".wbb-ocm-submenu").addClass("active");

                            $(".wbb-ocm-main, .wbb-ocm-main-title").css("opacity", 0);

                            opened_menus.push(data_post_id);
                            add_style();
                            clearInterval(delay_submenu);

                        }, 100);

                    }



                }
                else if ( $(this).attr("data-url-target") === "#" || $(this).hasClass("wbb-ocm-submenu-close") )
                {
                    // Do Nothing
                }
                else
                {
                    location.href = $(this).attr("data-url-target");
                }

            }



        });

        $(document).on("click", ".wbb-ocm-submenu-close", function() {

            var $this = $(this);

            $this.parents(".wbb-ocm-submenu").removeClass("active");
            var menu_id = $this.parents(".wbb-ocm-submenu").attr("data-menu-id");

            var delay_submenu = setInterval(function() {

                opened_menus.splice(parseInt(opened_menus.indexOf(menu_id)), 1);

                $this.parents(".wbb-ocm-submenu").remove();

                if ( $(".wbb-ocm-submenu").length < 1 )
                {
                    $(".wbb-ocm-main, .wbb-ocm-main-title").css("opacity", 1);
                }

                clearInterval(delay_submenu);

            }, 250);

        });

        $(document).on("click", ".wbb-ocm-trigger, .wbb-ocm-close", function() {
            $("body, .wbb-ocm-container").toggleClass("active");
            $(".wbb-ocm-trigger").toggleClass("active");
        });


    }


    /**
     * CONNECT TEXT BLOCKS TO TEXT PATH.
     $(document).ready(function(){
     
     var original_text = $(".orinigal-text").html();
     
     var temp_point = 0;
     
     $.each( $(".connected-text"), function(i,val){
     
     var height = $(this).height();
     var line_height = $(this).css("line-height");
     
     var lines_per_block = Math.floor( height / parseInt(line_height) );
     
     var m_width = $(this).append("<span>M</span>");
     m_width = $(this).find("span").width();
     
     var characters_by_line = Math.floor( $(this).width() / m_width );
     
     
     
     
     
     });
     
     
     });
     */

//-------------------------------------------

})(jQuery);

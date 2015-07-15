(function ($)
{
    'use strict';

    /* This slide panel need the option to show normal navigation bar or slide panel as menu*/

    $ ( document ).on ( "click touchstart" , '.offcanvas-button,.offcanvas-fade-screen,.ofcanvas-close' , function (e)
    {

        $('.offcanvas-content,.offcanvas-fade-screen').toggleClass('is-visible');
        e.preventDefault();

    } );

    $(document).ready(function () {

        // NEW MENU
        $('#offcanvas_container').multileveloffcanvas({
            containersToPush: [$('#pushobj')],
            collapsed: true,
            fullCollapse: true,
            preventItemClick: false,
            overlapWidth: 20,
            menuWidth: 255,
            backText: "Back",
            swipe: "desktop",

        });

        // HIDE WHEN CLICKS OUT
        $('#pushobj').click(function (e) {

            var container = $(".js-menu-opener");

            var data_colapsed = container.attr("data-colapsed");
            $('#offcanvas_container').multileveloffcanvas('collapse');


            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                $('.js-close-menu').hide();
                if (data_colapsed === "1")
                {
                    container.attr("data-colapsed", 0);
                }
            }

        });


        // CAMBIAR A FOREACH.

        var submenus = $("li.menu-item-has-children");

        $.each(submenus, function (i, val) {

            var title = $("a", this).first().text();
            $(this).find(".levelHolderClass").first().prepend("<h2 class='title_container'>" + title + "</h2>");

        });

        $(".js-menu-opener").click(function () {

            var data_colapsed = $(this).attr("data-colapsed");

            if (data_colapsed === "0") {

                $('#offcanvas_container').multileveloffcanvas('expand');

                $(".js-menu-trigger").attr("data-colapsed", 1);
                $('.js-close-menu').show("slow");

            }

            if (data_colapsed === "1") {

                $('#offcanvas_container').multileveloffcanvas('collapse');

                $(".js-menu-opener").attr("data-colapsed", 0);
                $('.js-close-menu').hide();

            }

        });


        $(".js-close-menu").click(function () {

            $(this).hide();

            $('#offcanvas_container').multileveloffcanvas('collapse');

            $(".js-menu-opener").attr("data-colapsed", 0);


        });

        //End NEW MENU



    });


}) ( jQuery );
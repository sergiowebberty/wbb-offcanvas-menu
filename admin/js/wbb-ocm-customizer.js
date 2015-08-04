(function ($) {
    //'use strict';

    wp.customize('wbb_ocm_sidebar_side', function (value) {

        var value_back = $(value);

        value.bind(function (to) {
            
            var tostring = to.toString();
            
            var delay_update_sidebar = setInterval(function(){
                
                if( to.toString() === "right" )
                {

                    $(".wbb-ocm-container").removeClass("left");
                    $(".wbb-ocm-container").addClass("right");
                    
                    $("body").removeClass("left");
                    $("body").addClass("right");
                    
                }
                else if( to.toString() === "left" )
                {
                    
                    $(".wbb-ocm-container").removeClass("right");
                    $(".wbb-ocm-container").addClass("left"); 
                    
                    $("body").removeClass("right");
                    $("body").addClass("left"); 
                    
                }
                
                //clearInterval(delay_update_sidebar);
                
            }, 1000);
            
        });
        
    });

    wp.customize('wbb_ocm_trigger_side', function (value) {
        
        var value_back = $(value);
        
        value.bind(function (to) {
            
            var tostring = to.toString();
            
            var delay_update = setInterval(function(){
                
                if( to.toString() === "right" )
                {

                    $(".wbb-ocm-trigger").removeClass("left");
                    $(".wbb-ocm-trigger").addClass("right");
                    
                }
                else if( to.toString() === "left" )
                {
                    
                    $(".wbb-ocm-trigger").removeClass("right");
                    $(".wbb-ocm-trigger").addClass("left");
                    
                }
                
                //clearInterval(delay_update);
                
            },1000);
            
        });
        
    });


})(jQuery);
(function ($)
{
    wp.customize ( 'wbb-logo-img-upload' , function (value)
    {
        value.bind ( function (to)
                     {
                         $ ( '.js-site-logo' ).attr ( 'src' , to );
                     } );
    } );
}) ( jQuery ) ;
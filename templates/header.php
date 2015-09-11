<?php
/**
 * The header of our theme.
 *
 * @package wbb-starter-theme
 */
?>
<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}
?>



<header class="site-header">

    <section>

    <h6 class="hidden">Header</h6>

    <section>

        <div class="site-branding">

            <h1 class="site-title" itemprop="name"><?php bloginfo ( 'name' ); ?>

            <a href="<?php echo esc_url ( home_url ( '/' ) ); ?>" rel="home">



                <img src="<?php echo get_theme_mod ( 'wbb-logo-img-upload' , '' ); ?>" class="js-site-logo">



            </a>

            </h1>

            <h2 class="site-description"><?php bloginfo ( 'description' ); ?></h2>

        </div>

        </section>
</section>

</header>



 <nav class="site-navigation" itemscope="itemscope"  itemtype="http://schema.org/SiteNavigationElement" role="navigation">

        <h3 class="hidden">Navigation</h3>






            <?php
            if ( has_nav_menu ( 'primary_navigation' ) ) :

                $defaults = array (
                    'theme_location'  => 'primary_navigation' ,
                    'menu'            => 'primary' ,
                    'container'       => '' ,
                    'container_class' => 'container_class' ,
                    'container_id'    => 'container_id' ,
                    'menu_class'      => 'navigation-menu show' ,
                    'menu_id'         => 'navigation-menu' ,
                    'echo'            => TRUE ,
                    'before'          => '' ,
                    'after'           => '' ,
                    'link_before'     => '' ,
                    'link_after'      => '' ,
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>' ,
                    'depth'           => 4 ,

                );

                wp_nav_menu ( $defaults );

            endif;

            ?>


 </nav>



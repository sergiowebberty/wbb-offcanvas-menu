<?php
/**
 * The sidebar of our theme.
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
<aside class="sidebar" itemtype="http://schema.org/WPSideBar" itemscope="itemscope" role="complementary">

    <h3 class="hidden">Sidebar</h3>

    <section>



	<?php if ( is_active_sidebar ( 'sidebar-1' ) ) : ?>


        <ul class="sidebar-widgets">

		<?php dynamic_sidebar ( 'sidebar-1' ); ?>

	<?php else : ?>

		<?php
		/*
		 * This content shows up if there are no widgets defined in the backend.
		*/
		?>

		<div class="flash-alert">

			<p><?php _e ( 'This is a widget ready area. Add some and they will appear here.' , WBB_THEME_SLUG ); ?></p>

		</div>

        </ul>

	<?php endif; ?>

    </section>

</aside>


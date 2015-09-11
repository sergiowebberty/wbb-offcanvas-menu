<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
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

<footer class="site-footer">

    <section>

        <h6 class="hidden">Footer</h6>

        <section class="copyright">

            <h3 class="hidden">Copyright</h3>

            <p class="copyright">&copy; <?php echo date ( 'Y' ); ?> <?php bloginfo ( 'name' ); ?>.</p>

        </section>

        <?php wp_footer (); ?>

    </section>

</footer>


<?php
/**
 * Template part for displaying a message when no posts are found.
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


    <article <?php post_class (); ?>>

        <?php if ( is_home () && current_user_can ( 'publish_posts' ) ) : ?>

            <p><?php printf ( wp_kses ( __ ( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.' , WBB_THEME_SLUG ) , array ( 'a' => array ( 'href' => array () ) ) ) , esc_url ( admin_url ( 'post-new.php' ) ) ); ?></p>

        <?php elseif ( is_search () ) : ?>

            <p><?php esc_html_e ( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.' , WBB_THEME_SLUG ); ?></p>

            <?php get_search_form (); ?>

        <?php else : ?>



            <p><?php esc_html_e ( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.' , WBB_THEME_SLUG ); ?></p>

            <?php get_search_form (); ?>

        <?php endif; ?>

    </article>

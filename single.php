<?php
/**
 * The template for displaying all single posts.
 *
 * @package wbb-starter-theme
 */
if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

?>

<main role="main">




<?php while ( have_posts () ) : the_post ();

    get_template_part ( 'templates/content-single' , get_post_type () );

    endwhile; ?>

</main>

<?php
/**
 * The template for displaying search results pages.
 *
 * @package wbb-starter-theme
 */
if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}
?>

<main class="article" role="main">

    <h2 class="hidden">Main search</h2>

    <?php

if ( ! have_posts () ) : ?>

	<div class="flash-alert">

		<?php _e ( 'Sorry, no results were found.' , WBB_THEME_SLUG ); ?>

	</div>

	<?php get_search_form (); ?>

<?php endif; ?>

    <section class="search-result">

    <h2 class="hidden">Search Results</h2>

<?php while ( have_posts () ) : the_post (); ?>

	<?php get_template_part ( 'templates/content' , 'search' ); ?>

<?php endwhile; ?>

    </section>

<?php the_posts_navigation (); ?>

    </main>
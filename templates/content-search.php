<?php
/**
 * The template part for displaying results in search pages.
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



        <header itemprop="headline">
            <h2 class="entry-title"><a href="<?php the_permalink (); ?>" itemprop="url"><?php the_title (); ?></a></h2>

            <?php if ( get_post_type () === 'post' )
            {
                wbb_entry_meta ();
            } ?>

        </header>

        <div class="entry-summary" itemprop="text">

            <?php the_excerpt (); ?>

        </div>

    </article>



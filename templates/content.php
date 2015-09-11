<?php
/**
 * Template part for displaying the overview items for archive, category and index
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




    <article id="post-<?php the_ID (); ?>" <?php post_class (); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPosts">

        <header class="entry-header"  itemprop="headline">

            <?php the_title ( sprintf ( '<h2 class="entry-title"><a href="%s" rel="bookmark" itemprop="url" >' , esc_url ( get_permalink () ) ) , '</a></h2>' ); ?>


            <?php if ( 'post' == get_post_type () ) : ?>

                <div class="entry-meta">

                    <?php wbb_entry_meta (); ?> <!-- function for date and author and comments count /--->

                </div>

            <?php endif; ?>

        </header>
        <!-- .entry-header -->

        <div class="entry-summary" itemprop="text">

            <?php the_excerpt (); ?>

        </div>

        <footer class="entry-footer">

            <?php wbb_entry_footer (); ?>     <!-- function for categories, tags and comments/--->

        </footer>
        <!-- .entry-footer -->

    </article><!-- #post-## -->


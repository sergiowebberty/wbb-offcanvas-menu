<?php
/**
 * The template used for displaying page content in page.php
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



    <article id="post-<?php the_ID (); ?>" <?php post_class (); ?>>

        <header class="entry-header" itemprop="headline" role="banner">

            <?php the_title ( '<h1 class="entry-title">' , '</h1>' ); ?>

        </header>
        <!-- .entry-header -->

        <div class="entry-content">

            <?php the_content (); ?>

            <?php wp_link_pages ( array (
                'before' => '<nav class="pagination" itemscope itemtype="http://schema.org/SiteNavigationElement">' ,
                'after'  => '</nav>'
            ) ); ?>

        </div>
        <!-- .entry-content -->

        <footer class="entry-footer" role="contentinfo">

            <?php edit_post_link ( esc_html__ ( 'Edit' , WBB_THEME_SLUG ) , '<span class="edit-link">' , '</span>' ); ?>

        </footer>
        <!-- .entry-footer -->
        <?php comments_template('/templates/comments.php'); ?>
    </article><!-- #post-## -->


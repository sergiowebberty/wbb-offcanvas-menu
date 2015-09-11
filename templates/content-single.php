<?php
/**
 * The template used for displaying page content in single.php
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




	<article id="post-<?php the_ID (); ?>" <?php post_class (); ?>  itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

		<header class="entry-header"  itemprop="headline" role="banner">

			<?php the_title ( '<h1 class="entry-title"  itemprop="headline">' , '</h1>' ); ?>

			<div class="entry-meta">

				<?php wbb_entry_meta (); ?> <!-- function for date and author and comments count /--->

			</div>

		</header>

		<div class="entry-content">

			<?php the_content (); ?>

			<?php wp_link_pages ( array (
				'before' => '<nav class="page-nav" itemscope itemtype="http://schema.org/SiteNavigationElement"><p>' . __ ( 'Pages:' , WBB_THEME_SLUG ) ,
				'after'  => '</p></nav>'
			) ); ?>

		</div>

		<footer class="entry-footer" role="contentinfo">

			<?php wbb_entry_footer (); ?>     <!-- function for categories, tags and comments/--->

		</footer>
		<!-- .entry-footer -->
		<?php comments_template('/templates/comments.php'); ?>
	</article>


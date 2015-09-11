<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}
?>
<head>
	<meta charset="<?php bloginfo ( 'charset' ); ?>"/>

	<title  itemprop="name"><?php wp_title ( '|' , TRUE , 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11"/>

	<link rel="pingback" href="<?php bloginfo ( 'pingback_url' ); ?>"/>

	<?php wp_head (); ?>

</head>




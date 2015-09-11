<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

// IMPORTANT : KEEP THIS FILE CLEAN AS YOU CAN ....

/*
| ----------------------------------------------------------------------------------------------------------------------
| Set default upload folder
| ----------------------------------------------------------------------------------------------------------------------
| Set default upload folder
*/
if ( get_option ( 'upload_path' ) == 'wp-content/uploads' || get_option ( 'upload_path' ) == NULL )
{

	update_option ( 'upload_path' , 'assets' );

}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Excerpt as default option for pages
| ----------------------------------------------------------------------------------------------------------------------
| Add this code to have this option enabled (or if you know better way)
*/
add_action ( 'init' , 'wbb_add_excerpts_to_pages' );
function wbb_add_excerpts_to_pages ()
{
	add_post_type_support ( 'page' , 'excerpt' );
}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Sidebars /  Remove the  small segment of css in the head / Head Clean
| ----------------------------------------------------------------------------------------------------------------------
| Set some default sidebars ....
| There is a small segment of css in the head that we can remove
*/
add_action ( 'widgets_init' , 'wbb_action_widgets_init' );
function wbb_action_widgets_init ()
{

	global $wp_widget_factory;

	remove_action ( 'wp_head' ,
		[
			$wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ] ,
			'recent_comments_style'
		]
	);

	remove_action ( 'wp_head' , 'parent_post_rel_link' , 10 );
	remove_action ( 'wp_head' , 'feed_links' , 10 );
	remove_action ( 'wp_head' , 'rsd_link' );
	remove_action ( 'wp_head' , 'wlwmanifest_link' );
	remove_action ( 'wp_head' , 'index_rel_link' );
	remove_action ( 'wp_head' , 'parent_post_rel_link' , 10 );
	remove_action ( 'wp_head' , 'start_post_rel_link' , 10 );
	remove_action ( 'wp_head' , 'adjacent_posts_rel_link' , 10 );
	remove_action ( 'wp_head' , 'wp_shortlink_wp_head' , 10 );
	remove_action ( 'wp_head' , 'wp_generator' , 10 );
	remove_action ( 'wp_head' , 'print_emoji_detection_script' , 7 );
	remove_action ( 'admin_print_scripts' , 'print_emoji_detection_script' );
	remove_action ( 'wp_print_styles' , 'print_emoji_styles' );
	remove_action ( 'admin_print_styles' , 'print_emoji_styles' );

	register_sidebar (
		[
			'name'          => __ ( 'Main Sidebar' , WBB_THEME_SLUG ) ,
			'id'            => 'sidebar-1' ,
			'description'   => __ ( 'Widgets in this area will be shown on all posts and pages.' , WBB_THEME_SLUG ) ,
			'before_widget' => '<li id="%1$s" class="widget %2$s">' ,
			'after_widget'  => '</li>' ,
			'before_title'  => '<h2 class="widgettitle">' ,
			'after_title'   => '</h2>' ,
		]
	);

}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Sidebars
| ----------------------------------------------------------------------------------------------------------------------
| Any of these conditional tags that return true won't show the sidebar.
| You can also specify your own custom function as long as it returns a boolean.
| To use a function that accepts arguments, use an array instead of just the function name as a string.
| Examples:
| 'is_single'
| 'is_archive'
| ['is_page', 'about-me']
| ['is_tax', ['flavor', 'mild']]
| ['is_page_template', 'about.php']
| ['is_post_type_archive', ['foo', 'bar', 'baz']]
*/
function wbb_filter_display_sidebar ()
{

	return [
		'is_404' ,
		'is_home' ,
		'is_front_page' ,
		'is_single' ,
	];

}

add_filter ( 'WBB_display_sidebar' , 'wbb_filter_display_sidebar' );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Change welcome text
| ----------------------------------------------------------------------------------------------------------------------
| Change the welcome message from Howdy to welcome
*/
function change_howdy ( $translated , $text , $domain )
{

	if ( ! is_admin () || 'default' != $domain )
	{
		return $translated;
	}

	if ( FALSE !== strpos ( $translated , 'Howdy' ) )
	{
		return str_replace ( 'Howdy' , 'Welcome' , $translated );
	}

	return $translated;
}

add_filter ( 'gettext' , 'change_howdy' , 10 , 3 );


/*
| ----------------------------------------------------------------------------------------------------------------------
| Filter <figure>
| ----------------------------------------------------------------------------------------------------------------------
| add <figure> to each image
*/
function image_send_to_editor ( $html , $id , $caption , $title , $align , $url , $size , $alt )
{
	if ( current_theme_supports ( 'html5' ) && ! $caption )
	{
		$html = sprintf ( '<figure>%s</figure>' , $html );
	} // Modify to your needs!

	return $html;
}

add_filter ( 'image_send_to_editor' , 'image_send_to_editor' , 10 , 8 );


/*
| ----------------------------------------------------------------------------------------------------------------------
| Menus
| ----------------------------------------------------------------------------------------------------------------------
| Set default Menu's
*/
register_nav_menu ( 'primary_navigation' , __ ( 'Main navigation for the website' , WBB_THEME_SLUG ) );


$menuname                  = 'Main Navigation';
$primary_navigation        = 'primary_navigation';
$primary_footer_navigation = 'primary_footer_navigation';
$menu_exists               = wp_get_nav_menu_object ( $menuname );

// If it doesn't exist, let's create it.
if ( ! $menu_exists )
{

	$menu_id = wp_create_nav_menu ( $menuname );

	// Set up default BuddyPress links and add them to the menu.
	wp_update_nav_menu_item ( $menu_id , 0 ,
		[
			'menu-item-title'   => __ ( 'Home' , WBB_THEME_SLUG ) ,
			'menu-item-classes' => 'home' ,
			'menu-item-url'     => ( '/' ) ,
			'menu-item-status'  => 'publish'
		]
	);

	//Grab the theme locations and assign our newly - created menu
	if ( ! has_nav_menu ( $primary_navigation ) )
	{

		$locations                        = get_theme_mod ( 'nav_menu_locations' );
		$locations[ $primary_navigation ] = $menu_id;

		set_theme_mod ( 'nav_menu_locations' , $locations );

	}

	if ( ! has_nav_menu ( $primary_footer_navigation ) )
	{

		$locations                               = get_theme_mod ( 'nav_menu_locations' );
		$locations[ $primary_footer_navigation ] = $menu_id;

		set_theme_mod ( 'nav_menu_locations' , $locations );

	}


}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Theme Support / Loads the theme's translated strings.
| ----------------------------------------------------------------------------------------------------------------------
| Set Some Default The	<title><?php wp_title ( '|' , TRUE , 'right' ); ?></title>me Support Settings
| If the current locale exists as a .mo file in the theme's root directory,
| it will be included in the translated strings by the $domain.
| The .mo files must be named based on the locale exactly, sv_SE.mo for example.
| More info : https://codex.wordpress.org/Function_Reference/load_theme_textdomain
*/
add_action ( 'after_setup_theme' , 'wbb_action_after_setup_theme' );
function wbb_action_after_setup_theme ()
{

	add_theme_support ( 'html5' ,
		[
			'comment-list' ,
			'comment-form' ,
			'search-form' ,
			'gallery' ,
			'caption'
		]
	);

	add_theme_support ( 'automatic-feed-links' );

	add_theme_support ( "post-thumbnails" );

	add_theme_support ( 'post-formats' ,
		[

			//Typically styled without a title. Similar to a Facebook note update.
			'aside' ,

			//A gallery of images. Post will likely contain a gallery shortcode and will have image attachments.
			'gallery'
			,
			//A link to another site. Themes may wish to use the first <a href=””> tag in the post content as the external link for that post.
			//An alternative approach could be if the post consists only of a URL, then that will be the URL and the title (post_title) will be the name attached to the anchor for it.
			'link' ,

			// A single image. The first <img /> tag in the post could be considered the image.
			//Alternatively, if the post consists only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image.
			'image' ,

			//quote - A quotation.
			//Probably will contain a blockquote holding the quote content.
			//Alternatively, the quote may be just the content, with the source/author being the title.
			'quote' ,

			// A short status update, similar to a Twitter status update.
			'status' ,

			//A single video. The first <video /> tag or object/embed in the post content could be considered the video.
			//Alternatively, if the post consists only of a URL, that will be the video URL.
			//May also contain the video as an attachment to the post, if video support is enabled on the blog (like via a plugin).
			'video' ,

			//An audio file. Could be used for Podcasting.
			'audio' ,

			// A chat transcript, like so:
			'chat'
		]
	);

	load_theme_textdomain ( WBB_THEME_SLUG , get_template_directory () . '/languages' );

}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Add extra meta data
| ----------------------------------------------------------------------------------------------------------------------
| Add extra meta data in the heade.php side when <?php wp_head (); ?> is used
| This functionality is placed in system/WBB_Core/WBB-Core.php function name  AddMetaTags ().
*/
add_action ( 'wp_head' , 'wbb_action_wp_head' , 1 );
function wbb_action_wp_head ()
{

	//Set custom head meta when there is MSIE ...
	if ( isset( $_SERVER[ 'HTTP_USER_AGENT' ] ) && ( strpos ( $_SERVER[ 'HTTP_USER_AGENT' ] , 'MSIE' ) !== FALSE ) )
	{

		echo '<meta content="X-UA-Compatible: IE=edge,chrome=1" >' . "\n";

	}

	echo '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";

	echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo ( 'wpurl' ) . '/favicon.ico" />' . "\n";

}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Theme Customizer
| ----------------------------------------------------------------------------------------------------------------------
|  Adds the individual sections, settings, and controls to the theme customizer
|  More documentation :
|   - http://themefoundation.com/wordpress-theme-customizer/
|   - https://codex.wordpress.org/Plugin_API/Action_Reference/customize_register
|   - https://codex.wordpress.org/Class_Reference/WP_Customize_Control
|   - https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
*/
add_action ( 'customize_register' , 'action_customize_register' );
function action_customize_register ( $wp_customize )
{
	// ADD A NEW SECTION TO THE CUSTOMIZER
	$wp_customize->add_section (

		'wbb_theme_section_one' ,
		[
			'title'       => __ ( 'Logo' , WBB_THEME_SLUG ) ,
			'description' => __ ( 'Add Site logo .' , WBB_THEME_SLUG ) ,
			'priority'    => 35 ,
		]
	);

	// ADD A NEW SETTING
	$wp_customize->add_setting ( 'wbb-logo-img-upload' );

	// CREATING A CONTROL
	$wp_customize->add_control (
		new WP_Customize_Image_Control(
			$wp_customize ,
			'img-upload' ,
			[
				'label'    => __ ( 'Logo upload' , WBB_THEME_SLUG ) ,
				'section'  => 'wbb_theme_section_one' ,
				'settings' => 'wbb-logo-img-upload'
			]
		)
	);

}

/**
 * This function enqueues scripts and styles in the Customizer.
 */
add_action ( 'customize_controls_enqueue_scripts' , function ()
{

	/*
	 * Our Customizer script
	 *
	 * Dependencies: Customizer Controls script (core)
	 */
	wp_enqueue_script ( 'my-customizer-script' , get_template_directory_uri () . '/assets/scripts/customizer/customizer.js' , array ( 'customize-controls' ) );

	wp_localize_script ( 'my-customizer-script' , 'ajax_object' ,
		[
			'ajax_url' => admin_url ( 'admin-ajax.php' )
		] );

} );

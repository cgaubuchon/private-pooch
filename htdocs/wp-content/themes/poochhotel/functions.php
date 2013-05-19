<?php
/*
Author: Paul Larrow, Feast LLC
URL: http://www.wearefeast.com

Modification of Bones Theme
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
    - custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/
require_once('library/custom-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default
/*
5. library/script-loader.php
    - one place for all enqueue/registering
*/
require_once('library/script-loader.php');	  // ADDED BY FEAST - VITAL!!! BEWARE SLOPPY PLUGINS (LOOKING AT YOU COMMENTS PLUS)




/************* FEAST MODIFICATIONS *************/

// if statement is required, otherwise CMS will not load after ACF plugin upgrades
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active('advanced-custom-fields/acf.php') ) {
	
	// UNCOMMENT IF NEEDED
	
	//register_field('NextGen_Field', dirname(__File__) . '/fields/nextgen.php');
	//include_once( WP_PLUGIN_DIR . '/advanced-custom-fields-location-field-add-on/location-field.php' );
}


// Limit character count in Contact Form 7
add_filter( 'wpcf7_validate_textarea', 'character_length_validation_filter', 11, 2 );
add_filter( 'wpcf7_validate_textarea*', 'character_length_validation_filter', 11, 2 );

function character_length_validation_filter( $result, $tag ) {
	$name = $tag['name'];

	if ( !$result['valid'] )
		return $result;
	
	$max_words = 500;
	$word_count = strlen( $_POST[$name] );
	
	if ( $max_words < $word_count ) {
		$difference = $word_count - $max_words;
		$result['valid'] = false;
		$result['reason'][$name] = "Please shorten your comments by " . $difference . " characters.";
	}

	return $result;
}


// If custom excerpt lengths are required
function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// JetPack is cool, but kind of a douche
function jptweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );
}
add_action( 'loop_end', 'jptweak_remove_share' );

function jptweak_remove_admin_share() {
    remove_meta_box( 'sharing_meta' , 'page' , 'advanced' ); 
}
add_action( 'add_meta_boxes', 'jptweak_remove_admin_share', 99 );


// I hate nag messages, but I'm not sure if this works, oh well
remove_action( 'admin_notices', 'show_nag_messages', 11);


// Makes draft posts visiable by adding ?key=foryoureyesonly to preview URLs
add_filter( 'posts_results', 'wpse46014_peek_into_private', null, 2 );
function wpse46014_peek_into_private( $posts, &$query ) {

    if ( sizeof( $posts ) != 1 ) return $posts; /* not interested */

    $status = get_post_status( $posts[0] );
    $post_status_obj = get_post_status_object( $status );

    if ( $post_status_obj->public ) return $posts; /* it's public */

    if ( !isset( $_GET['key'] ) || $_GET['key'] != 'foryoureyesonly' )
        return $posts; /* not for your eyes */

    $query->_my_private_stash = $posts; /* stash away */

    add_filter( 'the_posts', 'wpse46014_inject_private', null, 2 );
}

function wpse46014_inject_private( $posts, &$query ) {
    /* do only once */
    remove_filter( 'the_posts', 'wpse46014_inject_private', null, 2 );
    return $query->_my_private_stash;
}


// TEST
// Grant authors the ability to add html to posts

function feast_disable_kses_content() {
	remove_filter('content_save_pre', 'wp_filter_post_kses', 10);
}
add_action('init','feast_disable_kses_content',20);


// Keep WordPress from stripping HTML tags out of the Menu Descriptions
remove_filter('nav_menu_description', 'strip_tags');
function cus_wp_setup_nav_menu_item($menu_item) {
	$menu_item->description = apply_filters('nav_menu_description',  $menu_item->post_content );
	return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'cus_wp_setup_nav_menu_item' );


function feast_register_menus() {
	
	//unregister_nav_menu( 'main_nav' );
	//unregister_nav_menu( 'footer_links' );
	
	register_nav_menus(
		array(
			'Social Links' 			=> __( 'Social Links' ),
			'Mobile Nav' 			=> __( 'Mobile Nav' ),
			'Subnav: Locations' 	=> __( 'Subnav: Locations' )
		)
	);

}
add_action( 'init', 'feast_register_menus' );



/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'feast-thumb-600', 600, 150, true );
add_image_size( 'feast-thumb-300', 300, 100, true );
add_theme_support( 'post-thumbnails' );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => __('Sidebar', 'feasttheme'),
    	'description' => __('The primary sidebar.', 'feasttheme'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => __('Sidebar 2', 'feasttheme'),
    	'description' => __('The second (secondary) sidebar.', 'feasttheme'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <?php 
			    /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ 
			    ?>
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>', 'feasttheme'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'feasttheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'feasttheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'feasttheme') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'feasttheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','feasttheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!


?>

<?php 

function register_these_scripts(){
		
	wp_register_script('modernizr',  get_template_directory_uri().'/library/js/modernizr.full.min.js', array(), '2.0', true);
	wp_enqueue_script( 'modernizr' );
	
	wp_dequeue_script('sitepress');
	
	wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri().'/library/js/libs/jquery-1.7.1.min.js');
    wp_enqueue_script( 'jquery' );
	
	wp_register_script( 'scripts', get_template_directory_uri().'/library/js/scripts.js', array( 'modernizr' ));
    wp_enqueue_script( 'scripts' );

    wp_register_script( 'colorbox', get_template_directory_uri().'/library/js/jquery.colorbox-min.js', array('jquery'));
	wp_enqueue_script('colorbox');
	
	//default stylesheet
	wp_register_style( 'webfontkit', get_template_directory_uri().'/library/webfontkit/stylesheet.css');
	wp_enqueue_style( 'webfontkit' );
	
	wp_register_style( 'normalize', get_template_directory_uri().'/library/css/normalize.css');
    wp_enqueue_style( 'normalize' );
	
	wp_register_style( 'colorbox-css', get_template_directory_uri().'/library/css/colorbox.css');
	wp_enqueue_style('colorbox-css');
	
	wp_register_script('razor-common', get_template_directory_uri().'/library/js/razor-common.js', array(), '1.1');
    wp_enqueue_script( 'razor-common' );

	wp_register_script('cookie', get_template_directory_uri().'/library/js/jquery.cookie.js', array('jquery'), '');
    wp_enqueue_script( 'cookie' );

	//for scripts that are needed in wp-admin
	if( !is_admin()){
		
		//NextGEN Gallery
		wp_dequeue_script( 'thickbox' );
		wp_dequeue_style( 'thickbox' );
		
		wp_dequeue_script( 'ngg-slideshow' );
		wp_dequeue_script( 'shutter' );
		
		wp_dequeue_style( 'NextGEN' );
		wp_dequeue_style( 'shutter' );
		
		//Login with Ajax
		wp_dequeue_script( 'login-with-ajax' );
		wp_dequeue_style( 'login-with-ajax' );
		
		/*
			Comments Plus Plugin v 1.42
			
			Feast hacked the plugin files to make dequeueing work. The plug was use wp_print_styles, which is bad form.
			line 62+ /plugins/comments-plus/lib/class_wdcp_public_pages.php
		*/
		wp_dequeue_script( 'wdcp_comments' );
		wp_dequeue_script( 'wdcp_twitter' );
		wp_dequeue_script( 'wdcp_facebook' );
		wp_dequeue_script( 'wdcp_google' );
		wp_dequeue_script( 'facebook-all' );
		wp_dequeue_script( 'twitter-anywhere' );
		wp_dequeue_script( 'wdcp-sd-discussion' );
		
		wp_dequeue_style( 'wdcp_comments' );
		wp_dequeue_style( 'wdcp_comments-specific' );
		wp_dequeue_style( 'wdcp-cct_theme' );
		wp_dequeue_style( 'wdcp-sd-discussion' );
		wp_dequeue_style( 'wdcp_comments-css' );
		wp_dequeue_style( 'wdcp_comments-specific-css' );
		
	}
	
	if ( is_rtl() ) {
  		wp_enqueue_style(  'style-rtl',  get_template_directory_uri().'/library/css/rtl.css'  );
	}
	
	
	
	//conditional loading onto page template
	
	global $post;
	
	$post_type = get_post_type( $post );
	
	if (is_front_page()) {
		wp_register_script('homepage-js', get_bloginfo('stylesheet_directory').'/library/js/razor-homepage.js', array('jquery'));
		wp_enqueue_script('homepage-js');
		
		wp_register_style( 'homepage-css', get_template_directory_uri().'/library/css/homepage.css');
    	wp_enqueue_style( 'homepage-css' );
	}
	
	if (is_single() && $post_type != 'products' && $post_type != 'recalls' ) {
		
		//NextGEN Gallerywp_enqueue_style('NextGEN');
		wp_enqueue_script('thickbox');
      	wp_enqueue_style('thickbox');
	  	
		wp_register_script('jquery-cycle', NGGALLERY_URLPATH .'js/jquery.cycle.all.min.js', array('jquery'), '2.88');
        wp_enqueue_script('ngg-slideshow', NGGALLERY_URLPATH .'js/ngg.slideshow.min.js', array('jquery-cycle'), '1.05');
		
		wp_enqueue_script( 'shutter' );
		wp_enqueue_style( 'shutter' );
		
		//Login with Ajax
		wp_enqueue_script( 'login-with-ajax' );
		wp_enqueue_style( 'login-with-ajax' );
		
		/*
			Comments Plus Plugin v 1.42
			
			Feast hacked the plugin files to make dequeueing work. The plug was use wp_print_styles, which is bad form.
			line 62+ /plugins/comments-plus/lib/class_wdcp_public_pages.php
		*/
		wp_enqueue_script( 'wdcp_comments' );
		wp_enqueue_script( 'wdcp_twitter' );
		wp_enqueue_script( 'wdcp_facebook' );
		wp_enqueue_script( 'wdcp_google' );
		wp_enqueue_script( 'facebook-all' );
		wp_enqueue_script( 'twitter-anywhere' );
		wp_enqueue_script( 'wdcp-sd-discussion' );
		
		wp_enqueue_style( 'wdcp_comments' );
		wp_enqueue_style( 'wdcp_comments-specific' );
		wp_enqueue_style( 'wdcp-cct_theme' );
		wp_enqueue_style( 'wdcp-sd-discussion' );
		wp_enqueue_style( 'wdcp_comments-css' );
		wp_enqueue_style( 'wdcp_comments-specific-css' );
		
	}
	
  	if (is_single() && $post_type == 'products') {
	  	//wp_enqueue_style('NextGEN');
		//wp_register_script('jquery-cycle', NGGALLERY_URLPATH .'js/jquery.cycle.all.min.js', array('jquery'), '2.88');
        //wp_enqueue_script('ngg-slideshow', NGGALLERY_URLPATH .'js/ngg.slideshow.min.js', array('jquery-cycle'), '1.05');
		wp_enqueue_script('jquery-easing', get_template_directory_uri().'/library/js/jquery-ui-1.8.2-easing-min.js', array('jquery'), '1.8.2', false);
		wp_enqueue_script('colorbox');
		wp_enqueue_style( 'colorbox-css' );
		//wp_enqueue_script('youtube-feed-manager', get_template_directory_uri().'/library/js/razor-youtube-feed-manager.js', array(), '');
		wp_enqueue_script('product-page-js', get_template_directory_uri().'/library/js/razor-product-page.js', array(), '');
		wp_enqueue_style('product-page-css', get_template_directory_uri().'/library/css/product-page.css');
		
		wp_enqueue_script( 'razor_voter', get_bloginfo('stylesheet_directory').'/library/js/razor-voter.js', array('jquery'), '' );
	    wp_localize_script( 'razor_voter', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

  	}

 	if (is_single() && $post_type == 'recalls') {
		//wp_enqueue_script( 'httpclient', get_bloginfo('stylesheet_directory').'/library/js/HttpClient.js', array('jquery'), '' );
		//wp_enqueue_script( 'submitform', get_bloginfo('stylesheet_directory').'/library/js/submitform.js', array('jquery'), '' );
  	}

	if(is_page_template('page-service-locator.php')){
		//wp_enqueue_script('jquery-easing', get_template_directory_uri().'/library/js/jquery-ui-1.8.2-easing-min.js', array('jquery'), '1.8.2', false);

		wp_register_script( 'black-white', get_template_directory_uri().'/library/js/BlackAndWhite.js', array('jquery'));
    	wp_enqueue_script( 'black-white' );
	}
	
	if(is_page_template('page-service-locator.php') || is_page_template('page-where-to-buy.php')){
		//wp_register_script( 'locator-map', get_template_directory_uri().'/library/js/razor-locator-map.js', array('jquery'), '', true);
    	//wp_enqueue_script( 'locator-map' );
		
		wp_register_style( 'locator-map-css', get_template_directory_uri().'/library/css/locator-map.css');
    	wp_enqueue_style( 'locator-map-css' );
	}

}

add_action('wp_enqueue_scripts', 'register_these_scripts');

?>
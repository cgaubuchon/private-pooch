<?php

$wp_site_home_url = home_url('/');
$wp_site_template = get_template_directory_uri();

?><!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<title><?php wp_title(''); ?></title>

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<!-- Silly IE -->
        <meta http-equiv="imagetoolbar" content="no" />

		<!-- Bing Webmaster Tools -->
		<meta name="msvalidate.01" content="" />
		
		<!-- Load fonts -->
		<script type="text/javascript" src="//use.typekit.net/nzc7ken.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

		<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
		<link rel="apple-touch-icon" href="<?php echo $wp_site_template; ?>/library/images/apple-icon-touch.png?v=1.0">
		<link rel="icon" href="<?php echo $wp_site_template; ?>/favicon.png?v=1.0">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo $wp_site_template; ?>/favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo $wp_site_template; ?>/library/images/win8-tile-icon.png?v=1.0">

  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php 
		// WordPress head functions
		wp_head();
		// end of WordPress head
		?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
					<p id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>

					<!-- if you'd like to use the site description you can un-comment it below -->
					<?php // bloginfo('description'); ?>


					<nav role="navigation">
						<?php bones_main_nav(); ?>
					</nav>

				</div> <!-- end #inner-header -->

			</header> <!-- end header -->

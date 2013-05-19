<div id="cse" style="width: 100%;"><?php _e("Loading", "bonestheme"); ?></div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/library/js/google-cse.js" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'en', style : google.loader.themes.MINIMALIST});
  google.setOnLoadCallback(function() {
    var customSearchControl = new google.search.CustomSearchControl('006825650897633400644:my_4436dxeq');

    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.setAutoComplete(true);
    customSearchControl.draw('cse', options);
	customSearchControl.execute('<?php 
		
		
		// Reads the URL to find a keyword then searches for that keyword
		// For example, http://www.website.com/404 will run a Google custom search for "404"
		$url = $_SERVER["REQUEST_URI"];

		$path_parts = pathinfo( $url );
		$extension = "." . $path_parts[ "extension" ];

		$page = basename( $url, $extension );

		echo $page;
		
		
		?>');
  }, true);
</script>
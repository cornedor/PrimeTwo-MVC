<?php
/**
 * layout.main.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 2:00 PM
 */

// TODO: create HTML class to help views with basic stuff like including css and js
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PrimeTwo<?php echo (isset($title)?' | '.$title:false); ?></title>
	
	<!-- Mobile support -->
	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<!-- jQuery 1.11.3 -->
	<script src="<?php echo $appConfig['url']; ?>/vendor/jquery-1.11.3.min.js"></script>
	
	<!-- Bootstrap 3.5.5 -->
	<link rel="stylesheet" href="<?php echo $appConfig['url']; ?>/vendor/bootstrap-3.3.5-dist/css/bootstrap.min.css">
	<script src="<?php echo $appConfig['url']; ?>/vendor/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

	<!-- Bootstrap material design master from github@2015-10-09 -->
	<link href="<?php echo $appConfig['url']; ?>/vendor/bootstrap-material-design-master/dist/css/material-fullpalette.min.css" rel="stylesheet">
	<link href="<?php echo $appConfig['url']; ?>/vendor/bootstrap-material-design-master/dist/css/roboto.min.css" rel="stylesheet">
	<link href="<?php echo $appConfig['url']; ?>/vendor/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet">
	<!--<link href="<?php echo $appConfig['url']; ?>/vendor/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet">-->
	<script src="<?php echo $appConfig['url']; ?>/vendor/bootstrap-material-design-master/dist/js/material.min.js"></script>
	<script src="<?php echo $appConfig['url']; ?>/vendor/bootstrap-material-design-master/dist/js/ripples.min.js"></script>

	<!-- Highlight JS -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.8.0/styles/default.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.8.0/highlight.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- Custom style -->
	<link rel="stylesheet" href="<?php echo $appConfig['url']; ?>/css/main.css">
	<!-- Custom javascript -->
	<script src="<?php echo $appConfig['url']; ?>/js/main.js"></script>
</head>
<body>
	<?php
    View::render('layouts.header', null, true);

    if(isset($contentView))
        include $contentView;
    else
        echo '$renderView not found';

    View::render('layouts.footer', null, true);

	?>
	<script>
		$.material.init();
		hljs.initHighlightingOnLoad();
	</script>
	<!-- Github buttons -->
	<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
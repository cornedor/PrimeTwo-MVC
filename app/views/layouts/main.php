<?php
/**
 * layout.main.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 2:00 PM
 */
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Main View</title>
	
	<!-- Mobile support -->
	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<!-- jQuery 1.11.3 -->
	<script src="./vendor/jquery-1.11.3.min.js"></script>
	
	<!-- Bootstrap 3.5.5 -->
	<link rel="stylesheet" href="./vendor/bootstrap-3.3.5-dist/css/bootstrap.min.css">
	<script src="./vendor/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

	<!-- Bootstrap material design master from github@2015-10-09 -->
	<link href="./vendor/bootstrap-material-design-master/dist/css/roboto.min.css" rel="stylesheet">
	<link href="./vendor/bootstrap-material-design-master/dist/css/material-fullpalette.min.css" rel="stylesheet">
	<link href="./vendor/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet">
	<link href="./vendor/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet">
	<script src="./vendor/bootstrap-material-design-master/dist/js/ripples.min.js"></script>
	<script src="./vendor/bootstrap-material-design-master/dist/js/material.min.js"></script>

	<!-- Custom style -->
	<link rel="stylesheet" href="./css/main.css">
	<!-- Custom javascript -->
	<script src="./js/main.js"></script>
</head>
<body>
	<?php
		View::render('layouts.header');
		if(isset($contentView))
			View::render($contentView);

		//View::render('');
		View::render('layouts.footer');
	?>
	<script>$.material.init();</script>
</body>
</html>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="header">
	<div class="container">
		<div class="row logo-menu">
			<div class="col-md-4 logo-col">
				<a class="main-logo" href="<?php echo home_url(); ?>"><img src="<?php echo IMAGES; ?>/logo.png"></a>
			</div>
			<div class="col-md-8 menu-col">
				<div class="trigger-wrap">
					<div class="menu-trigger">
						<span class="top menu-trigger--spinner"></span>
						<span class="middle menu-trigger--spinner"></span>
						<span class="bottom menu-trigger--spinner"></span>
					</div>
				</div>
				<?php wp_nav_menu(array(
					'theme_location'=>'navigation-menu',
					'walker'=>new WP_Bootstrap_Navwalker(),
					'container_class' => 'menu-location-navigation-menu-container'
				)); ?>
			</div>
		</div>
	</div>
</div>

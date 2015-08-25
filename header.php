<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if IE]><link rel="shortcut icon" href="<?php echo THEMEROOT; ?>favicon.ico"/><![endif]-->
<?php wp_head(); ?>
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
					'walker'=>new wp_bootstrap_navwalker()
				)); ?>
			</div>
		</div>
	</div>
</div>
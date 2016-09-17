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
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo home_url(); ?>">
        <img alt="<?php echo get_bloginfo('name'); ?>" src="<?php echo IMAGES; ?>/logo.png">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
			<?php wp_nav_menu(array(
				'theme_location'=>'navigation-menu',
				'depth'             => 2,
        'container'         => 'div',
        'container_class'   => 'collapse navbar-collapse',
				'container_id'      => 'navbar-collapse-1',
        'menu_class'        => 'nav navbar-nav',
        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
        'walker'            => new wp_bootstrap_navwalker()
			)); ?>
	</div>
	<!-- <div class="container">
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
			</div>
		</div>
	</div> -->
</div>

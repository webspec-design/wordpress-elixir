<?php get_header(); ?>
<?php the_post(); ?>
<div class="content interior-content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<?php if(is_404()) : ?>
					<h1>404: Page Not Found</h1>
					<p>We could not find the page you were looking for. Perhaps you should return to the <a href="<?php echo home_url(); ?>">home page</a>?</p>
				<?php else : ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>

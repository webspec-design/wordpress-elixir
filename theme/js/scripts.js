jQuery(document).ready(function($) {
	$('.menu-trigger').click(function() {
		$(this).toggleClass('active');	
		$('.menu-navigation-container').slideToggle();
	});
})
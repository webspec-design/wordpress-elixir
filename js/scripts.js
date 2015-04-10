jQuery(document).ready(function($) {
	$('.menu-trigger').click(function() {
		$(this).toggleClass('active');	
		$('.menu-navigation-container').slideToggle();
	});
	$('.mobile-dropdown').click(function() {
		$(this).toggleClass('active').next('.dropdown-menu').slideToggle();
	});
})
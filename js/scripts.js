jQuery(document).ready(function($) {
	$('.menu-trigger').click(function() {
		$(this).toggleClass('active');
		$('.menu-location-navigation-menu-container').slideToggle();
	});
	$('.mobile-dropdown').click(function() {
		$(this).toggleClass('active').next('.dropdown-menu').slideToggle();
	});
	$(window).load(function() {
		$('.menu-col, .logo-col').match_height();
	})
});

$(document).ready(function(){
	$('ul#main-menu li').click(function(){
		$('ul#main-menu li').removeClass('active');
		$(this).addClass('active');
		// $(this).addClass('active').siblings().removeClass('active');
	});
});
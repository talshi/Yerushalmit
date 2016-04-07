(function($){
	$(function(){
		$('.flexslider').flexslider();
	});
	$('.product-image-overlay').hide();
	$('.product-image').hover(function(){
		$(this).addClass('hover').next().show();
	}, function() {
		$(this).removeClass('hover').next().hide();
	});	
})(jQuery);
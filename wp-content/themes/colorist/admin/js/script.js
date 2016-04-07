( function( $ ) {
	// Add Make Plus message
		upgrade = $('<a class="colorist-buy-pro"></a>')
			.attr('href', 'http://www.webulousthemes.com/?add-to-cart=35')
			.attr('target', '_blank')
			.text(colorist_upgrade.message)
		;
		demo = $('<a class="colorist-docs"></a>')
			.attr('href','http://colorist.webulous.in/')
			.attr('target','_blank')
			.text(colorist_upgrade.demo);
		docs = $('<a class="colorist-docs"></a>')
			.attr('href','http://docs.webulous.in/colorist-free/')
			.attr('target','_blank')
			.text(colorist_upgrade.docs);
		support = $('<a class="colorist-docs"></a>')
			.attr('href','http://www.webulousthemes.com/forums/forum/free-support/colorist/')
			.attr('target','_blank')
			.text(colorist_upgrade.support);


		$('.preview-notice').append(upgrade);
		$('.preview-notice').append(demo);
		$('.preview-notice').append(docs);
		$('.preview-notice').append(support);
		// Remove accordion click event
		$('.colorist-buy-pro').on('click', function(e) {
			e.stopPropagation();
		});
		$('.colorist-docs').on('click',function(e){
			e.stopPropagation();
		})
} )( jQuery );
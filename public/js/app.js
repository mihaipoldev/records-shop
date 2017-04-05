$(function() {
	var $body = $('body');

	$body.on('click', '.ajax-open-btn', function(event) {
		if(!$(this).data('data-toggle') == 'modal') {
			event.preventDefault();
		}
		console.log('test');

		var url = $(this).data('url'),
			$target = $($(this).data('target'));

		loadingElement($target);
		setTimeout(function() {
			$.ajax({
				type: "GET",
				url: url,
				success: function(result) {
					$target.html(result);
				}
			});
		}, 100);
	});


	$(window).resize(function() {
		setListItemImageHeight();
	});

	setListItemImageHeight();
});

var loadingElement = function($element) {
	$element.isLoading({
		text: "Loading",
		position: "overlay"
	});
};

var setListItemImageHeight = function(){
	$('.record-wrapper').each(function(){
		var $figure = $(this).find('figure');
		$figure.height($figure.width());
	});
};
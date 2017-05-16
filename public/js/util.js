$(function() {
	var $body = $('body');

	$body.on('click', '.ajax-btn', function(event) {
		event.preventDefault();

		var $this = $(this),
			url = $this.data('url'),
			$target = $($this.data('target')),
			$callback = $($this.data('callback'));

		if(url && $target) {
			// loading
			setTimeout(function() {
				$.ajax({
					type: "GET",
					url: url,
					success: function(result) {
						$target.html(result);

						if($callback) {
							callFunction($callback, window);
						}
					}
				});
			}, 50);
		}
	});
});


/**
 * Call Function
 */
function callFunction(functionName, context /*, args */) {
	var args = Array.prototype.slice.call(arguments).splice(2);
	var namespaces = functionName.split('.');
	var func = namespaces.pop();

	for(var i = 0; i < namespaces.length; i++) {
		context = context[namespaces[i]];
	}

	if(typeof( context[func] ) === 'function') {
		return context[func].apply(context, args);
	}

	return null;
}
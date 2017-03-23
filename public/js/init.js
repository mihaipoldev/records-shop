jQuery(function() {
	/**
	 * add csrf token for all ajax requests
	 */
	jQuery.ajaxSetup({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="_token"]').attr('content')}
	});
});
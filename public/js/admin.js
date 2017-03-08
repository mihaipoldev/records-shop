$(function() {
	// $('body').on('click', '#add_track', function(event) {
	// 	event.preventDefault();
	//
	// 	var $group = jQuery('.renter-field-group'),
	// 		$new = null,
	// 		$list = jQuery('.renter-list');
	//
	// 	if($group.length <= 0) {
	// 		return false;
	// 	}
	//
	// 	if($group.length > 1) {
	// 		$group = $group.first();
	// 	}
	//
	// 	$new = $group.clone();
	//
	// 	$new.find('input').val('');
	//
	// 	$list.append($new);
	// });

	/* ajax save track */
	$('#add_track').on('click', function(event) {
		event.preventDefault();

		var url = $(this).attr('href');

		$.ajax({
			type: "GET",
			url: url,
			success: function(result) {
				console.log(result);
				$('#new-track').append(result);
			}
		});
	})
});
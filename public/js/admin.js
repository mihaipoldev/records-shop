$(function(){
	/* ajax save track */
	$('#add_track').on('click', function(event){
		event.preventDefault();

		var url = $(this).attr('href');

		$.ajax({
			type: "GET",
			url: url,
			cache: false,
			contentType: false,
			processData: false,
			success: function(result) {
				console.log(result);
				$('#new-track').html(result);
			}
		});
	})
});
$(function() {
	var $body = $('body'),
		$modal = $('#modal'),
		$modalWrapper = $('#modal-wrapper');

	/* START > GENERAL */
	$body.on('click', '.ajax-modal-btn', function(event) {
		if(!$(this).data('data-toggle') == 'modal') {
			event.preventDefault();
		}

		var url = $(this).data('url');

		loadingElement($modalWrapper);
		setTimeout(function() {
			$.ajax({
				type: "GET",
				url: url,
				success: function(result) {
					$modalWrapper.html(result);
				}
			});
		}, 100);
	});

	$body.on('click', '.label-select-btn', function(event) {
		event.preventDefault();

		var $parent = $(this).parent().parent();

		if(!$parent.hasClass('active')) {
			$('#label-input').val($(this).data('item-id'));
			$('#label-text').html($(this).data('item-name'));

			$('#modal table tr.active').removeClass('active');

			$parent.addClass('active');
		}
	});
	/* END */

	/* START ___ Artists */
	var $artistModal = $('#artists-modal'),
		$artistWrapper = $('#ajax-artists-wrapper');

	$body.on('click', '#manage-artists-btn, #artist-list-btn, #artist-add-btn, .artist-editor-btn, .artist-delete-btn, .artist-edit', function(event) {
		if(!$(this).data('data-toggle') == 'modal') {
			event.preventDefault();
		}

		var url = $(this).data('url');

		loadingElement($artistWrapper);
		setTimeout(function() {
			$.ajax({
				type: "GET",
				url: url,
				success: function(result) {
					$artistWrapper.html(result);
					setArtistTableActiveRow();
					initialize();
				}
			});
		}, 100);
	});

	$body.on('submit', '#artist-editor-form', function(event) {
		event.preventDefault();

		var $form = $(this),
			url = $form.attr('action'),
			data = ajaxData($form.serializeArray());

		loadingElement($artistWrapper);
		setTimeout(function() {
			$.ajax({
				type: "POST",
				url: url,
				data: data,
				success: function(result) {
					$artistWrapper.html(result);
					toastr.success('Added!', 'Artist');
					initialize();
				}
			});
		}, 100);
	});

	$body.on('click', '.artist-remove', function(event) {
		event.preventDefault();

		var url = $(this).data('url'),
			artistId = $(this).parent().data('artist-id'),
			$artistSelection = $body.find('.artist-selection[data-artist-id=' + artistId + ']');

		loadingElement($artistSelection);
		setTimeout(function() {
			$artistSelection.remove();
		}, 100);
	});

	/** fro record */
	$body.on('click', '.artist-select-btn', function(event) {
		event.preventDefault();

		var $parent = $(this).parent().parent(),
			$artistDisplay = $('#artists-display'),
			artistId = $(this).data('artist-id');

		if($parent.hasClass('active')) {
			$body.find('.artist-selection[data-artist-id=' + artistId + ']').remove();

			$parent.removeClass('active');
		}
		else {
			var artistHtml = artistSelectionHtml($(this));
			$artistDisplay.append(artistHtml);

			$parent.addClass('active');
		}
	});

	/** for track */
	$body.on('click', '.track-artist-select-btn', function(event) {
		event.preventDefault();

		var $parent = $(this).parent().parent(),
			$artistDisplay = $('.track-artists-display[data-track-id='+ $parent.data('track-id') +']'),
			artistId = $(this).data('artist-id');

		if($parent.hasClass('active')) {
			$body.find('.artist-selection[data-artist-id=' + artistId + ']').remove();

			$parent.removeClass('active');
		}
		else {
			var artistHtml = artistSelectionTrackHtml($(this));
			$artistDisplay.append(artistHtml);

			$parent.addClass('active');
		}
	});
	/* END */

	/* START ___ Tracks */
	/** ajax save track */
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
	});
	/* END */



	/* START > Photos */
	$body.on('change', '#record-image-input', function(event) {
		event.preventDefault();

		var url = $(this).data('url'),
			myFormData = new FormData();
		myFormData.append('image', $(this)[0].files[0]);

		$.ajax({
			url: url,
			type: 'POST',
			processData: false, // important
			contentType: false, // important
			data: myFormData,
			success: function(result) {
				$('#record-image').attr('src', result);
				$('#ceva').html(result);
			}
		});
	});

	// $body.on('click', '.remove-image', function(event) {
	// 	event.preventDefault();
	//
	// 	var url = $(this).data('url'),
	// 		$this = $(this);
	//
	// 	$.ajax({
	// 		url: url,
	// 		type: 'GET',
	// 		success: function() {
	// 			$this.parent().parent().remove();
	//
	// 		}
	// 	});
	// });
	//
	// $("#photos-list").sortable({
	// 	vertical: false,
	// 	items: ".sortable-item",
	// 	update: function(event, ui) {
	// 		var $sortable = $("#photos-list"),
	// 			data = $sortable.sortable("toArray"),
	// 			url = $sortable.data('url');
	// 		console.log(data);
	//
	// 		$.ajax({
	// 			type: 'POST',
	// 			url: url,
	// 			data: {
	// 				items: data
	// 			},
	// 			success: function(result){
	//
	// 			}
	// 		});
	// 	}
	// }).disableSelection();
	/* END > Photos */
});


var loadingElement = function($element) {
	$element.isLoading({
		text: "Loading",
		position: "overlay"
	});
};

var ajaxData = function(formData) {
	var data = {};

	for(var i = 0; i < formData.length; i++) {
		data[formData[i]['name']] = formData[i]['value'];
	}

	return data;
};

var artistSelectionHtml = function($selectBtn) {
	var artistName = $selectBtn.data('artist-name'),
		artistId = $selectBtn.data('artist-id'),
		editUrl = $selectBtn.data('edit-url'),
		deleteUl = $selectBtn.data('delete-url');

	return '<div class="artist-selection" data-artist-id="' + artistId + '"><span>' + artistName + '</span> <i class="fa fa-cog artist-edit" data-url="' + editUrl + '" data-toggle="modal" data-target="#artists-modal"></i> <i class="fa fa-remove artist-remove" data-url="' + deleteUl + '"></i> <input class="artist-input" type="hidden" name="artists[]" value="' + artistId + '"/></div>';
};

var artistSelectionTrackHtml = function($selectBtn) {
	var artistName = $selectBtn.data('artist-name'),
		artistId = $selectBtn.data('artist-id'),
		editUrl = $selectBtn.data('edit-url'),
		deleteUl = $selectBtn.data('delete-url');

	return '<div class="artist-selection" data-artist-id="' + artistId + '"><span>' + artistName + '</span> <i class="fa fa-cog artist-edit" data-url="' + editUrl + '" data-toggle="modal" data-target="#artists-modal"></i> <i class="fa fa-remove artist-remove" data-url="' + deleteUl + '"></i> <input class="track-artist-input" type="hidden" name="tracks[' + $selectBtn.parent().parent().data('track-id') + '][artists][]" value="' + artistId + '"/></div>';
};

var setItemTableList = function() {
	$('#modal table.list').find('tr').each(function() {
		var $tr = $(this);
		$('.artist-input').each(function() {
			if($tr.data('artist-id') == $(this).val()) {
				$tr.addClass('active');
			}
		});
	});
};

var setArtistTableActiveRow = function() {
	$('#artists-modal table.list').find('tr').each(function() {
		var $tr = $(this);
		$('.artist-input').each(function() {
			if($tr.data('artist-id') == $(this).val()) {
				$tr.addClass('active');
			}
		});
	});

	$('#artists-modal table.list-track').find('tr').each(function() {
		var $tr = $(this);
		$('.track-artists-display[data-track-id=' + $(this).data('track-id') + '] .track-artist-input').each(function() {
			if($tr.data('artist-id') == $(this).val()) {
				$tr.addClass('active');
			}
		});
	});
};

var initialize = function() {
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	})
		.on('ifToggled', function(event) {
			jQuery(this).trigger('change');
		});

	$("input[type=hidden]").bind("change", function() {
		console.log($(this).val());
	});

	toastr.options = {
		"closeButton": true,
		"debug": false,
		"progressBar": true,
		"preventDuplicates": false,
		"positionClass": "toast-top-right",
		"onclick": null,
		"showDuration": "200",
		"hideDuration": "1000",
		"timeOut": "2000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
}
/*
 *   Audio Player jQuery Plugin
 *   Author: Mihai Pol
 *   Copyright (c) 2016
 */

$(function() {
	/*
	 *  Player Helper functions
	 */
	// Convert milliseconds into Hours (h), Minutes (m), and Seconds (s)
	function timecode(ms) {
		var hms = {
			h: Math.floor(ms / (60 * 60 * 1000)),
			m: Math.floor((ms / 60000) % 60),
			s: Math.floor((ms / 1000) % 60)
		};

		var time = [];

		if (hms.h > 0) {
			time.push(hms.h);
		}

		time.push((hms.m < 10 && hms.h > 0) ? '0' + hms.m : hms.m);
		time.push(hms.s < 10 ? "0" + hms.s : hms.s);

		return time.join('.');
	}
});

//  TODO
//  shuffle playlist



var audio, duration = '';


function initAudio($element) {
	var url = $element.data('url');

	audio = new Audio(url);

	if (!audio.currentTime) {
		$('#current-duration').html('0.00');
	}

	audio.addEventListener("loadeddata", function() {
		var time = msToHMS(audio.duration);

		$('#duration').html(duration);
	});

	audio.volume = 1;

	$element.addClass('active');


	/* for other functions */
	timeout = audio.duration / 0.8;


	// initAnalyser();
}

/*
 *  Animation Bar
 */
var canvas, ctx, source, context, analyser, fbc_array, bars, bar_x, bar_width, bar_height;
var timeout, startTime = 0;
function initAnalyser() {
	context = new AudioContext(); // AudioContext object instance
	analyser = context.createAnalyser(); // AnalyserNode method
	canvas = document.getElementById('analyser_render');
	ctx = canvas.getContext('2d');
	// Re-route audio playback into the processing graph of the AudioContext
	source = context.createMediaElementSource(audio);
	source.connect(analyser);
	analyser.connect(context.destination);
}


initAudio($('#playlist li:first-child'));

var urlToSave;
var token;

// Play button
$('.audio-player #play').on('click', function() {
	audio.play();
	$(this).addClass('hidden');
	$('.audio-player #pause').removeClass('hidden');
	$('#time #current-duration').fadeIn(400);
	showDuration();

	audio.playbackRate = 4;

	urlToSave = $(this).data('url');
	token = $(this).data('token');

	// ANIMATION
	frameLooper();


});

var analyserArray = '';

function frameLooper() {
	setTimeout(function() {
		if (audio.ended) {
			console.log(analyserArray);
			$.ajax({
				method: 'post',
				url: urlToSave,
				data: {
					array: analyserArray,
					_token: token
				}
			})
				.done(function(msg) {
					alert('DONE');
				})
			return;
		}
		if (audio.paused) {
			return;
		}
		window.requestAnimationFrame(frameLooper);
		fbc_array = new Uint8Array(analyser.frequencyBinCount);
		analyser.getByteFrequencyData(fbc_array);
		ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
		ctx.fillStyle = '#00CCFF'; // Color of the bars
		bars = 100;
		s = 0;
		for (var i = 0; i < bars; i++) {
			bar_x = i * 3;
			bar_width = 2;
			bar_height = -(fbc_array[i] / 2);
			//  fillRect( x, y, width, height ) // Explanation of the parameters below
			ctx.fillRect(bar_x, canvas.height, bar_width, bar_height);
			s += fbc_array[i];
		}
		var arithmetic = s / 100;
		if (arithmetic > 50) {
			if (arithmetic > 80) {
				arithmetic *= 1.2;
			}
		}
		else {
			arithmetic *= 0.8;
		}
		console.log(arithmetic);
		analyserArray += ' ' + String(arithmetic);
		startTime += timeout;
	}, timeout);
}

// Pause button
$('.audio-player #pause').on('click', function() {
	audio.pause();
	$(this).addClass('hidden');
	$('.audio-player #play').removeClass('hidden');
});

// Stop button
$('.audio-player #stop').on('click', function() {
	audio.pause();
	audio.currentTime = 0;
	$('#pause').addClass('hidden');
	$('.audio-player #play').removeClass('hidden');
	$('#current-duration').fadeOut(400);
	showDuration();


	/// ANALYZER
	analyser.disconnect();
	source.disconnect();
	// this.stopped = true;
});

//  Time duration
function showDuration() {
	$(audio).bind('timeupdate', function() {
		//get hours and minutes
		var seconds = parseInt(audio.currentTime % 60);
		var minutes = parseInt((audio.currentTime / 60) % 60);


		// add 0 if less then 10
		if (seconds < 10) {
			seconds = '0' + seconds;
		}
		$('#current-duration').html(minutes + '.' + seconds);


		var value = 0;
		if (audio.currentTime > 0) {
			value = Math.floor((100 / audio.duration) * audio.currentTime);
		}
		$('#progress').css('width', value + '%');
	})
}

//  Next Button
$('#next').on('click', function() {
	audio.pause();
	var next = $('#playlist li.active').next();
	if (next.length == 0) {
		next = $('#playlist li:first-child');
	}
	initAudio(next);
	audio.play();
	showDuration();
});

//  Prev Button
$('#prev').on('click', function() {
	audio.pause();
	var prev = $('#playlist li.active').prev();
	if (prev.length == 0) {
		prev = $('#playlist li:last-child');
	}
	initAudio(prev);
	audio.play();
	showDuration();
});

//  Change track
$('#playlist li').on('click', function() {
	audio.pause();
	initAudio($(this));
	audio.play();
	showDuration();
});

//  volume
$('#volume').on('change', function() {
	audio.volume = parseFloat($(this).val() / 10);
});


//  progress change
$(function() {
	$(document).on('click', '#progress-bar', function() {
		var mouseX = event.pageX - $('#progress').offset().left;
		var totalWidth = $(this).width();

		var progressPercentage = mouseX / totalWidth * 100;
		progressPercentage = Math.round(progressPercentage * 100) / 100;

		var progressTime = progressPercentage / 100 * audio.duration;
		progressTime = Math.round(progressTime);

		audio.currentTime = progressTime;
		$('#progress').css('width', progressPercentage + '%');
		$('#current-duration').html(audio.currentTime);

	});
});


// Fast forwards the audio file by 30 seconds.
function forwardAudio() {

// Check for audio element support.
	if (window.HTMLAudioElement) {
		try {
			var oAudio = document.getElementById('myaudio');
			oAudio.currentTime += 30.0;
		}
		catch (e) {
// Fail silently but show in F12 developer tools console
			if (window.console && console.error("Error:" + e));
		}
	}
}
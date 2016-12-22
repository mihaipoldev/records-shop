/*
 *   Audio Player jQuery Plugin
 *   Author: Mihai Pol
 *   Copyright (c) 2016
 */

$(function() {
	/*
	 *  Variables
	 */
	var wavesurfer = WaveSurfer.create({
		container: '#waveform',
		height: 60,
		waveColor: '#999',
		progressColor: '#555',
		cursorColor: '#555',
	});

	var $btnPlay = $('#audio-player #play'),
		$btnPause = $('#audio-player #pause'),
		$btnStop = $('#audio-player #stop'),
		$btnNext = $('#audio-player #next'),
		$btnPrev = $('#audio-player #prev'),
		$currentTime = $('#audio-player #current-time'),
		$duration = $('#audio-player #duration'),
		$playlistItems = $('#audio-player #playlist li'),
		$activeTrack = $playlistItems.first(),
		$volume = $('#audio-player #volume'),
		$progress = $('#audio-player #progress'),
		$progressBar = $('#audio-player #progress-bar');

	/*
	 *  Functions
	 */
	function initWavesurfer($element) {
		var url = $element.data('url');
		wavesurfer.load(url);
		$activeTrack = $element;
	}

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

	function getProgressPercentage() {
		if (wavesurfer.getCurrentTime() > 0) {
			return Math.floor((100 / wavesurfer.getDuration()) * wavesurfer.getCurrentTime());
		}
		return 0;
	}

	function bindTimeUpdate() {
		$(wavesurfer).bind('timeupdate', function() {
			$currentTime.html(timecode(audio.currentTime));
			$progress.css('width', getProgressPercentage() + '%');
		});
	}

	function getNext() {
		var $next = $activeTrack.next();
		if ($next.length == 0) {
			$next = $playlistItems.first();
		}
		return $next;
	}

	function getPrev() {
		var $prev = $activeTrack.prev();
		if ($prev.length == 0) {
			$prev = $playlistItems.last();
		}
		return $prev;
	}

	function play() {
		wavesurfer.play();

		$btnPlay.addClass('hidden');
		$btnPause.removeClass('hidden');

		bindTimeUpdate();
	}

	function pause() {
		wavesurfer.pause();

		$btnPause.addClass('hidden');
		$btnPlay.removeClass('hidden');
	}

	function stop() {
		wavesurfer.stop();

		$btnPause.addClass('hidden');
		$btnPlay.removeClass('hidden');

		bindTimeUpdate();
	}

	function change($element) {
		if (wavesurfer.isPlaying()) {
			wavesurfer.stop();
		}
		initWavesurfer($element);
		$('#playlist li .item.active').removeClass('active');
		$element.find('.item').addClass('active');

		if (wavesurfer.isPlaying()) {
			play();
		}
	}

	/*
	 *  WaveSurfer Functions
	 */
	initWavesurfer($($playlistItems).first());

	wavesurfer.on('ready', function(  ) {
		$btnPlay.on('click', function() {
			play();
		});

		$btnPause.on('click', function() {
			pause();
		});

		$btnStop.on('click', function() {
			stop();
		});

		$btnNext.on('click', function() {
			change(getNext());
		});

		$btnPrev.on('click', function() {
			change(getPrev());
		});

		$playlistItems.on('click', function() {
			change($(this));
		});

		$volume.on('change', function() {
			wavesurfer.setVolume(parseFloat($volume.val() / 10));
		});

		$progressBar.on('click', function() {
			var mouseX = event.pageX - $progress.offset().left,
				progressPercentage = Math.round(mouseX / $progressBar.width() * 100 * 100) / 100,
				progressTime = progressPercentage / 100 * audio.duration;

			audio.currentTime = Math.round(progressTime);
			$progress.css('width', progressPercentage + '%');
			$currentTime.html(audio.currentTime);
		});

	});
});
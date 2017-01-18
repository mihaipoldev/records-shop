/*! wavesurfer.js 1.0.52
 * https://github.com/katspaugh/wavesurfer.js
 * @license CC-BY-3.0 */
"use strict";
var WaveSurfer = {
	defaultParams: {
		height: 128,
		waveColor: "#999",
		progressColor: "#555",
		cursorColor: "#333",
		cursorWidth: 1,
		skipLength: 2,
		minPxPerSec: 20,
		pixelRatio: window.devicePixelRatio,
		fillParent: !0,
		scrollParent: !1,
		hideScrollbar: !1,
		normalize: !1,
		audioContext: null,
		container: null,
		dragSelection: !0,
		loopSelection: !0,
		audioRate: 1,
		interact: !0,
		splitChannels: !1,
		mediaContainer: null,
		mediaControls: !1,
		renderer: "Canvas",
		backend: "WebAudio",
		mediaType: "audio",
		autoCenter: !0
	}, init: function(a) {
		if (this.params = WaveSurfer.util.extend({}, this.defaultParams, a), this.container = "string" == typeof a.container ? document.querySelector(this.params.container) : this.params.container, !this.container)throw new Error("Container element not found");
		if (null == this.params.mediaContainer ? this.mediaContainer = this.container : "string" == typeof this.params.mediaContainer ? this.mediaContainer = document.querySelector(this.params.mediaContainer) : this.mediaContainer = this.params.mediaContainer, !this.mediaContainer)throw new Error("Media Container element not found");
		this.savedVolume = 0, this.isMuted = !1, this.tmpEvents = [], this.createDrawer(), this.createBackend()
	}, createDrawer: function() {
		var a = this;
		this.drawer = Object.create(WaveSurfer.Drawer[this.params.renderer]), this.drawer.init(this.container, this.params), this.drawer.on("redraw", function() {
			a.drawBuffer(), a.drawer.progress(a.backend.getPlayedPercents())
		}), this.drawer.on("click", function(b, c) {
			setTimeout(function() {
				a.seekTo(c)
			}, 0)
		}), this.drawer.on("scroll", function(b) {
			a.fireEvent("scroll", b)
		})
	}, createBackend: function() {
		var a = this;
		this.backend && this.backend.destroy(), "AudioElement" == this.params.backend && (this.params.backend = "MediaElement"), "WebAudio" != this.params.backend || WaveSurfer.WebAudio.supportsWebAudio() || (this.params.backend = "MediaElement"), this.backend = Object.create(WaveSurfer[this.params.backend]), this.backend.init(this.params), this.backend.on("finish", function() {
			a.fireEvent("finish")
		}), this.backend.on("play", function() {
			a.fireEvent("play")
		}), this.backend.on("pause", function() {
			a.fireEvent("pause")
		}), this.backend.on("audioprocess", function(b) {
			a.fireEvent("audioprocess", b)
		})
	}, startAnimationLoop: function() {
		var a = this, b = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame, c = function() {
			if (!a.backend.isPaused()) {
				var d = a.backend.getPlayedPercents();
				a.drawer.progress(d), a.fireEvent("audioprocess", d), b(c)
			}
		};
		c()
	}, getDuration: function() {
		return this.backend.getDuration()
	}, getCurrentTime: function() {
		return this.backend.getCurrentTime()
	}, play: function(a, b) {
		this.backend.play(a, b), this.startAnimationLoop()
	}, pause: function() {
		this.backend.pause()
	}, playPause: function() {
		this.backend.isPaused() ? this.play() : this.pause()
	}, isPlaying: function() {
		return !this.backend.isPaused()
	}, skipBackward: function(a) {
		this.skip(-a || -this.params.skipLength)
	}, skipForward: function(a) {
		this.skip(a || this.params.skipLength)
	}, skip: function(a) {
		var b = this.getCurrentTime() || 0, c = this.getDuration() || 1;
		b = Math.max(0, Math.min(c, b + (a || 0))), this.seekAndCenter(b / c)
	}, seekAndCenter: function(a) {
		this.seekTo(a), this.drawer.recenter(a)
	}, seekTo: function(a) {
		var b = this.backend.isPaused(), c = this.params.scrollParent;
		b && (this.params.scrollParent = !1), this.backend.seekTo(a * this.getDuration()), this.drawer.progress(this.backend.getPlayedPercents()), b || (this.backend.pause(), this.backend.play()), this.params.scrollParent = c, this.fireEvent("seek", a)
	}, stop: function() {
		this.pause(), this.seekTo(0), this.drawer.progress(0)
	}, setVolume: function(a) {
		this.backend.setVolume(a)
	}, setPlaybackRate: function(a) {
		this.backend.setPlaybackRate(a)
	}, toggleMute: function() {
		this.isMuted ? (this.backend.setVolume(this.savedVolume), this.isMuted = !1) : (this.savedVolume = this.backend.getVolume(), this.backend.setVolume(0), this.isMuted = !0)
	}, toggleScroll: function() {
		this.params.scrollParent = !this.params.scrollParent, this.drawBuffer()
	}, toggleInteraction: function() {
		this.params.interact = !this.params.interact
	}, drawBuffer: function() {
		var a = Math.round(this.getDuration() * this.params.minPxPerSec * this.params.pixelRatio), b = this.drawer.getWidth(), c = a;
		this.params.fillParent && (!this.params.scrollParent || b > a) && (c = b);
		var d = this.backend.getPeaks(c);
		this.drawer.drawPeaks(d, c), this.fireEvent("redraw", d, c)
	}, zoom: function(a) {
		this.params.minPxPerSec = a, this.params.scrollParent = !0, this.drawBuffer(), this.seekAndCenter(this.getCurrentTime() / this.getDuration()), this.fireEvent("zoom", a)
	}, loadArrayBuffer: function(a) {
		this.decodeArrayBuffer(a, function(a) {
			this.loadDecodedBuffer(a)
		}.bind(this))
	}, loadDecodedBuffer: function(a) {
		this.backend.load(a), this.drawBuffer(), this.fireEvent("ready")
	}, loadBlob: function(a) {
		var b = this, c = new FileReader;
		c.addEventListener("progress", function(a) {
			b.onProgress(a)
		}), c.addEventListener("load", function(a) {
			b.loadArrayBuffer(a.target.result)
		}), c.addEventListener("error", function() {
			b.fireEvent("error", "Error reading file")
		}), c.readAsArrayBuffer(a), this.empty()
	}, load: function(a, b) {
		switch (this.params.backend) {
			case"WebAudio":
				return this.loadBuffer(a);
			case"MediaElement":
				return this.loadMediaElement(a, b)
		}
	}, loadBuffer: function(a) {
		return this.empty(), this.getArrayBuffer(a, this.loadArrayBuffer.bind(this))
	}, loadMediaElement: function(a, b) {
		this.empty(), this.backend.load(a, this.mediaContainer, b), this.tmpEvents.push(this.backend.once("canplay", function() {
			this.drawBuffer(), this.fireEvent("ready")
		}.bind(this)), this.backend.once("error", function(a) {
			this.fireEvent("error", a)
		}.bind(this))), !b && this.backend.supportsWebAudio() && this.getArrayBuffer(a, function(a) {
			this.decodeArrayBuffer(a, function(a) {
				this.backend.buffer = a, this.drawBuffer()
			}.bind(this))
		}.bind(this))
	}, decodeArrayBuffer: function(a, b) {
		this.backend.decodeArrayBuffer(a, this.fireEvent.bind(this, "decoded"), this.fireEvent.bind(this, "error", "Error decoding audiobuffer")), this.tmpEvents.push(this.once("decoded", b))
	}, getArrayBuffer: function(a, b) {
		var c = this, d = WaveSurfer.util.ajax({url: a, responseType: "arraybuffer"});
		return this.tmpEvents.push(d.on("progress", function(a) {
			c.onProgress(a)
		}), d.on("success", b), d.on("error", function(a) {
			c.fireEvent("error", "XHR error: " + a.target.statusText)
		})), d
	}, onProgress: function(a) {
		if (a.lengthComputable)var b = a.loaded / a.total;
		else b = a.loaded / (a.loaded + 1e6);
		this.fireEvent("loading", Math.round(100 * b), a.target)
	}, exportPCM: function(a, b, c) {
		a = a || 1024, b = b || 1e4, c = c || !1;
		var d = this.backend.getPeaks(a, b), e = [].map.call(d, function(a) {
			return Math.round(a * b) / b
		}), f = JSON.stringify(e);
		return c || window.open("data:application/json;charset=utf-8," + encodeURIComponent(f)), f
	}, clearTmpEvents: function() {
		this.tmpEvents.forEach(function(a) {
			a.un()
		})
	}, empty: function() {
		this.backend.isPaused() || (this.stop(), this.backend.disconnectSource()), this.clearTmpEvents(), this.drawer.progress(0), this.drawer.setWidth(0), this.drawer.drawPeaks({length: this.drawer.getWidth()}, 0)
	}, destroy: function() {
		this.fireEvent("destroy"), this.clearTmpEvents(), this.unAll(), this.backend.destroy(), this.drawer.destroy()
	}
};
WaveSurfer.create = function(a) {
	var b = Object.create(WaveSurfer);
	return b.init(a), b
}, WaveSurfer.util = {
	extend: function(a) {
		var b = Array.prototype.slice.call(arguments, 1);
		return b.forEach(function(b) {
			Object.keys(b).forEach(function(c) {
				a[c] = b[c]
			})
		}), a
	}, getId: function() {
		return "wavesurfer_" + Math.random().toString(32).substring(2)
	}, ajax: function(a) {
		var b = Object.create(WaveSurfer.Observer), c = new XMLHttpRequest, d = !1;
		return c.open(a.method || "GET", a.url, !0), c.responseType = a.responseType || "json", c.addEventListener("progress", function(a) {
			b.fireEvent("progress", a), a.lengthComputable && a.loaded == a.total && (d = !0)
		}), c.addEventListener("load", function(a) {
			d || b.fireEvent("progress", a), b.fireEvent("load", a), 200 == c.status || 206 == c.status ? b.fireEvent("success", c.response, a) : b.fireEvent("error", a)
		}), c.addEventListener("error", function(a) {
			b.fireEvent("error", a)
		}), c.send(), b.xhr = c, b
	}
}, WaveSurfer.Observer = {
	on: function(a, b) {
		this.handlers || (this.handlers = {});
		var c = this.handlers[a];
		return c || (c = this.handlers[a] = []), c.push(b), {name: a, callback: b, un: this.un.bind(this, a, b)}
	}, un: function(a, b) {
		if (this.handlers) {
			var c = this.handlers[a];
			if (c)if (b)for (var d = c.length - 1; d >= 0; d--)c[d] == b && c.splice(d, 1);
			else c.length = 0
		}
	}, unAll: function() {
		this.handlers = null
	}, once: function(a, b) {
		var c = this, d = function() {
			b.apply(this, arguments), setTimeout(function() {
				c.un(a, d)
			}, 0)
		};
		return this.on(a, d)
	}, fireEvent: function(a) {
		if (this.handlers) {
			var b = this.handlers[a], c = Array.prototype.slice.call(arguments, 1);
			b && b.forEach(function(a) {
				a.apply(null, c)
			})
		}
	}
}, WaveSurfer.util.extend(WaveSurfer, WaveSurfer.Observer), WaveSurfer.WebAudio = {
	scriptBufferSize: 256, PLAYING_STATE: 0, PAUSED_STATE: 1, FINISHED_STATE: 2, supportsWebAudio: function() {
		return !(!window.AudioContext && !window.webkitAudioContext)
	}, getAudioContext: function() {
		return WaveSurfer.WebAudio.audioContext || (WaveSurfer.WebAudio.audioContext = new (window.AudioContext || window.webkitAudioContext)), WaveSurfer.WebAudio.audioContext
	}, getOfflineAudioContext: function(a) {
		return WaveSurfer.WebAudio.offlineAudioContext || (WaveSurfer.WebAudio.offlineAudioContext = new (window.OfflineAudioContext || window.webkitOfflineAudioContext)(1, 2, a)), WaveSurfer.WebAudio.offlineAudioContext
	}, init: function(a) {
		this.params = a, this.ac = a.audioContext || this.getAudioContext(), this.lastPlay = this.ac.currentTime, this.startPosition = 0, this.scheduledPause = null, this.states = [Object.create(WaveSurfer.WebAudio.state.playing), Object.create(WaveSurfer.WebAudio.state.paused), Object.create(WaveSurfer.WebAudio.state.finished)], this.createVolumeNode(), this.createScriptNode(), this.createAnalyserNode(), this.setState(this.PAUSED_STATE), this.setPlaybackRate(this.params.audioRate)
	}, disconnectFilters: function() {
		this.filters && (this.filters.forEach(function(a) {
			a && a.disconnect()
		}), this.filters = null, this.analyser.connect(this.gainNode))
	}, setState: function(a) {
		this.state !== this.states[a] && (this.state = this.states[a], this.state.init.call(this))
	}, setFilter: function() {
		this.setFilters([].slice.call(arguments))
	}, setFilters: function(a) {
		this.disconnectFilters(), a && a.length && (this.filters = a, this.analyser.disconnect(), a.reduce(function(a, b) {
			return a.connect(b), b
		}, this.analyser).connect(this.gainNode))
	}, createScriptNode: function() {
		this.ac.createScriptProcessor ? this.scriptNode = this.ac.createScriptProcessor(this.scriptBufferSize) : this.scriptNode = this.ac.createJavaScriptNode(this.scriptBufferSize), this.scriptNode.connect(this.ac.destination)
	}, addOnAudioProcess: function() {
		var a = this;
		this.scriptNode.onaudioprocess = function() {
			var b = a.getCurrentTime();
			b >= a.getDuration() ? (a.setState(a.FINISHED_STATE), a.fireEvent("pause")) : b >= a.scheduledPause ? (a.setState(a.PAUSED_STATE), a.fireEvent("pause")) : a.state === a.states[a.PLAYING_STATE] && a.fireEvent("audioprocess", b)
		}
	}, removeOnAudioProcess: function() {
		this.scriptNode.onaudioprocess = null
	}, createAnalyserNode: function() {
		this.analyser = this.ac.createAnalyser(), this.analyser.connect(this.gainNode)
	}, createVolumeNode: function() {
		this.ac.createGain ? this.gainNode = this.ac.createGain() : this.gainNode = this.ac.createGainNode(), this.gainNode.connect(this.ac.destination)
	}, setVolume: function(a) {
		this.gainNode.gain.value = a
	}, getVolume: function() {
		return this.gainNode.gain.value
	}, decodeArrayBuffer: function(a, b, c) {
		this.offlineAc || (this.offlineAc = this.getOfflineAudioContext(this.ac ? this.ac.sampleRate : 44100)), this.offlineAc.decodeAudioData(a, function(a) {
			b(a)
		}.bind(this), c)
	}, getPeaks: function(a) {
		for (var b = this.buffer.length / a, c = ~~(b / 10) || 1, d = this.buffer.numberOfChannels, e = [], f = [], g = 0; d > g; g++)for (var h = e[g] = [], i = this.buffer.getChannelData(g), j = 0; a > j; j++) {
			for (var k = ~~(j * b), l = ~~(k + b), m = i[0], n = i[0], o = k; l > o; o += c) {
				var p = i[o];
				p > n && (n = p), m > p && (m = p)
			}
			h[2 * j] = n, h[2 * j + 1] = m, (0 == g || n > f[2 * j]) && (f[2 * j] = n), (0 == g || m < f[2 * j + 1]) && (f[2 * j + 1] = m)
		}
		return this.params.splitChannels ? e : f
	}, getPlayedPercents: function() {
		return this.state.getPlayedPercents.call(this)
	}, disconnectSource: function() {
		this.source && this.source.disconnect()
	}, destroy: function() {
		this.isPaused() || this.pause(), this.unAll(), this.buffer = null, this.disconnectFilters(), this.disconnectSource(), this.gainNode.disconnect(), this.scriptNode.disconnect(), this.analyser.disconnect()
	}, load: function(a) {
		this.startPosition = 0, this.lastPlay = this.ac.currentTime, this.buffer = a, this.createSource()
	}, createSource: function() {
		this.disconnectSource(), this.source = this.ac.createBufferSource(), this.source.start = this.source.start || this.source.noteGrainOn, this.source.stop = this.source.stop || this.source.noteOff, this.source.playbackRate.value = this.playbackRate, this.source.buffer = this.buffer, this.source.connect(this.analyser)
	}, isPaused: function() {
		return this.state !== this.states[this.PLAYING_STATE]
	}, getDuration: function() {
		return this.buffer ? this.buffer.duration : 0
	}, seekTo: function(a, b) {
		return this.scheduledPause = null, null == a && (a = this.getCurrentTime(), a >= this.getDuration() && (a = 0)), null == b && (b = this.getDuration()), this.startPosition = a, this.lastPlay = this.ac.currentTime, this.state === this.states[this.FINISHED_STATE] && this.setState(this.PAUSED_STATE), {
			start: a,
			end: b
		}
	}, getPlayedTime: function() {
		return (this.ac.currentTime - this.lastPlay) * this.playbackRate
	}, play: function(a, b) {
		this.createSource();
		var c = this.seekTo(a, b);
		a = c.start, b = c.end, this.scheduledPause = b, this.source.start(0, a, b - a), this.setState(this.PLAYING_STATE), this.fireEvent("play")
	}, pause: function() {
		this.scheduledPause = null, this.startPosition += this.getPlayedTime(), this.source && this.source.stop(0), this.setState(this.PAUSED_STATE), this.fireEvent("pause")
	}, getCurrentTime: function() {
		return this.state.getCurrentTime.call(this)
	}, setPlaybackRate: function(a) {
		a = a || 1, this.isPaused() ? this.playbackRate = a : (this.pause(), this.playbackRate = a, this.play())
	}
}, WaveSurfer.WebAudio.state = {}, WaveSurfer.WebAudio.state.playing = {
	init: function() {
		this.addOnAudioProcess()
	}, getPlayedPercents: function() {
		var a = this.getDuration();
		return this.getCurrentTime() / a || 0
	}, getCurrentTime: function() {
		return this.startPosition + this.getPlayedTime()
	}
}, WaveSurfer.WebAudio.state.paused = {
	init: function() {
		this.removeOnAudioProcess()
	}, getPlayedPercents: function() {
		var a = this.getDuration();
		return this.getCurrentTime() / a || 0
	}, getCurrentTime: function() {
		return this.startPosition
	}
}, WaveSurfer.WebAudio.state.finished = {
	init: function() {
		this.removeOnAudioProcess(), this.fireEvent("finish")
	}, getPlayedPercents: function() {
		return 1
	}, getCurrentTime: function() {
		return this.getDuration()
	}
}, WaveSurfer.util.extend(WaveSurfer.WebAudio, WaveSurfer.Observer), WaveSurfer.MediaElement = Object.create(WaveSurfer.WebAudio), WaveSurfer.util.extend(WaveSurfer.MediaElement, {
	init: function(a) {
		this.params = a, this.media = {
			currentTime: 0, duration: 0, paused: !0, playbackRate: 1, play: function() {
			}, pause: function() {
			}
		}, this.mediaType = a.mediaType.toLowerCase(), this.elementPosition = a.elementPosition
	}, load: function(a, b, c) {
		var d = this, e = document.createElement(this.mediaType);
		e.controls = this.params.mediaControls, e.autoplay = this.params.autoplay || !1, e.preload = "auto", e.src = a, e.style.width = "100%", e.addEventListener("error", function() {
			d.fireEvent("error", "Error loading media element")
		}), e.addEventListener("canplay", function() {
			d.fireEvent("canplay")
		}), e.addEventListener("ended", function() {
			d.fireEvent("finish")
		}), e.addEventListener("timeupdate", function() {
			d.fireEvent("audioprocess", d.getCurrentTime())
		});
		var f = b.querySelector(this.mediaType);
		f && b.removeChild(f), b.appendChild(e), this.media = e, this.peaks = c, this.onPlayEnd = null, this.buffer = null, this.setPlaybackRate(this.playbackRate)
	}, isPaused: function() {
		return !this.media || this.media.paused
	}, getDuration: function() {
		var a = this.media.duration;
		return a >= 1 / 0 && (a = this.media.seekable.end()), a
	}, getCurrentTime: function() {
		return this.media && this.media.currentTime
	}, getPlayedPercents: function() {
		return this.getCurrentTime() / this.getDuration() || 0
	}, setPlaybackRate: function(a) {
		this.playbackRate = a || 1, this.media.playbackRate = this.playbackRate
	}, seekTo: function(a) {
		null != a && (this.media.currentTime = a), this.clearPlayEnd()
	}, play: function(a, b) {
		this.seekTo(a), this.media.play(), b && this.setPlayEnd(b), this.fireEvent("play")
	}, pause: function() {
		this.media && this.media.pause(), this.clearPlayEnd(), this.fireEvent("pause")
	}, setPlayEnd: function(a) {
		var b = this;
		this.onPlayEnd = function(c) {
			c >= a && (b.pause(), b.seekTo(a))
		}, this.on("audioprocess", this.onPlayEnd)
	}, clearPlayEnd: function() {
		this.onPlayEnd && (this.un("audioprocess", this.onPlayEnd), this.onPlayEnd = null)
	}, getPeaks: function(a) {
		return this.buffer ? WaveSurfer.WebAudio.getPeaks.call(this, a) : this.peaks || []
	}, getVolume: function() {
		return this.media.volume
	}, setVolume: function(a) {
		this.media.volume = a
	}, destroy: function() {
		this.pause(), this.unAll(), this.media && this.media.parentNode && this.media.parentNode.removeChild(this.media), this.media = null
	}
}), WaveSurfer.AudioElement = WaveSurfer.MediaElement, WaveSurfer.Drawer = {
	init: function(a, b) {
		this.container = a, this.params = b, this.width = 0, this.height = b.height * this.params.pixelRatio, this.lastPos = 0, this.createWrapper(), this.createElements()
	}, createWrapper: function() {
		this.wrapper = this.container.appendChild(document.createElement("wave")), this.style(this.wrapper, {
			display: "block",
			position: "relative",
			userSelect: "none",
			webkitUserSelect: "none",
			height: this.params.height + "px"
		}), (this.params.fillParent || this.params.scrollParent) && this.style(this.wrapper, {
			width: "100%",
			overflowX: this.params.hideScrollbar ? "hidden" : "auto",
			overflowY: "hidden"
		}), this.setupWrapperEvents()
	}, handleEvent: function(a) {
		a.preventDefault();
		var b = this.wrapper.getBoundingClientRect();
		return (a.clientX - b.left + this.wrapper.scrollLeft) / this.wrapper.scrollWidth || 0
	}, setupWrapperEvents: function() {
		var a = this;
		this.wrapper.addEventListener("click", function(b) {
			var c = a.wrapper.offsetHeight - a.wrapper.clientHeight;
			if (0 != c) {
				var d = a.wrapper.getBoundingClientRect();
				if (b.clientY >= d.bottom - c)return
			}
			a.params.interact && a.fireEvent("click", b, a.handleEvent(b))
		}), this.wrapper.addEventListener("scroll", function(b) {
			a.fireEvent("scroll", b)
		})
	}, drawPeaks: function(a, b) {
		this.resetScroll(), this.setWidth(b), this.params.barWidth ? this.drawBars(a) : this.drawWave(a)
	}, style: function(a, b) {
		return Object.keys(b).forEach(function(c) {
			a.style[c] !== b[c] && (a.style[c] = b[c])
		}), a
	}, resetScroll: function() {
		null !== this.wrapper && (this.wrapper.scrollLeft = 0)
	}, recenter: function(a) {
		var b = this.wrapper.scrollWidth * a;
		this.recenterOnPosition(b, !0)
	}, recenterOnPosition: function(a, b) {
		var c = this.wrapper.scrollLeft, d = ~~(this.wrapper.clientWidth / 2), e = a - d, f = e - c, g = this.wrapper.scrollWidth - this.wrapper.clientWidth;
		if (0 != g) {
			if (!b && f >= -d && d > f) {
				var h = 5;
				f = Math.max(-h, Math.min(h, f)), e = c + f
			}
			e = Math.max(0, Math.min(g, e)), e != c && (this.wrapper.scrollLeft = e)
		}
	}, getWidth: function() {
		return Math.round(this.container.clientWidth * this.params.pixelRatio)
	}, setWidth: function(a) {
		a != this.width && (this.width = a, this.params.fillParent || this.params.scrollParent ? this.style(this.wrapper, {width: ""}) : this.style(this.wrapper, {width: ~~(this.width / this.params.pixelRatio) + "px"}), this.updateSize())
	}, setHeight: function(a) {
		a != this.height && (this.height = a, this.style(this.wrapper, {height: ~~(this.height / this.params.pixelRatio) + "px"}), this.updateSize())
	}, progress: function(a) {
		var b = 1 / this.params.pixelRatio, c = Math.round(a * this.width) * b;
		if (c < this.lastPos || c - this.lastPos >= b) {
			if (this.lastPos = c, this.params.scrollParent && this.params.autoCenter) {
				var d = ~~(this.wrapper.scrollWidth * a);
				this.recenterOnPosition(d)
			}
			this.updateProgress(a)
		}
	}, destroy: function() {
		this.unAll(), this.wrapper && (this.container.removeChild(this.wrapper), this.wrapper = null)
	}, createElements: function() {
	}, updateSize: function() {
	}, drawWave: function(a, b) {
	}, clearWave: function() {
	}, updateProgress: function(a) {
	}
}, WaveSurfer.util.extend(WaveSurfer.Drawer, WaveSurfer.Observer), WaveSurfer.Drawer.Canvas = Object.create(WaveSurfer.Drawer), WaveSurfer.util.extend(WaveSurfer.Drawer.Canvas, {
	createElements: function() {
		var a = this.wrapper.appendChild(this.style(document.createElement("canvas"), {position: "absolute", zIndex: 1, left: 0, top: 0, bottom: 0}));
		if (this.waveCc = a.getContext("2d"), this.progressWave = this.wrapper.appendChild(this.style(document.createElement("wave"), {
				position: "absolute",
				zIndex: 2,
				left: 0,
				top: 0,
				bottom: 0,
				overflow: "hidden",
				width: "0",
				display: "none",
				boxSizing: "border-box",
				borderRightStyle: "solid",
				borderRightWidth: this.params.cursorWidth + "px",
				borderRightColor: this.params.cursorColor
			})), this.params.waveColor != this.params.progressColor) {
			var b = this.progressWave.appendChild(document.createElement("canvas"));
			this.progressCc = b.getContext("2d")
		}
	}, updateSize: function() {
		var a = Math.round(this.width / this.params.pixelRatio);
		this.waveCc.canvas.width = this.width, this.waveCc.canvas.height = this.height, this.style(this.waveCc.canvas, {width: a + "px"}), this.style(this.progressWave, {display: "block"}), this.progressCc && (this.progressCc.canvas.width = this.width, this.progressCc.canvas.height = this.height, this.style(this.progressCc.canvas, {width: a + "px"})), this.clearWave()
	}, clearWave: function() {
		this.waveCc.clearRect(0, 0, this.width, this.height), this.progressCc && this.progressCc.clearRect(0, 0, this.width, this.height)
	}, drawBars: function(a, b) {
		if (a[0] instanceof Array) {
			var c = a;
			if (this.params.splitChannels)return this.setHeight(c.length * this.params.height * this.params.pixelRatio), void c.forEach(this.drawBars, this);
			a = c[0]
		}
		var d = [].some.call(a, function(a) {
			return 0 > a
		});
		d && (a = [].filter.call(a, function(a, b) {
			return b % 2 == 0
		}));
		var e = .5 / this.params.pixelRatio, f = this.width, g = this.params.height * this.params.pixelRatio, h = g * b || 0, i = g / 2, j = a.length, k = this.params.barWidth * this.params.pixelRatio, l = Math.max(this.params.pixelRatio, ~~(k / 2)), m = k + l, n = 1;
		this.params.normalize && (n = Math.max.apply(Math, a));
		var o = j / f;
		this.waveCc.fillStyle = this.params.waveColor, this.progressCc && (this.progressCc.fillStyle = this.params.progressColor), [this.waveCc, this.progressCc].forEach(function(b) {
			if (b)for (var c = 0; f > c; c += m) {
				var d = Math.round(a[Math.floor(c * o)] / n * i);
				b.fillRect(c + e, i - d + h, k + e, 2 * d)
			}
		}, this)
	}, drawWave: function(a, b) {
		if (a[0] instanceof Array) {
			var c = a;
			if (this.params.splitChannels)return this.setHeight(c.length * this.params.height * this.params.pixelRatio), void c.forEach(this.drawWave, this);
			a = c[0]
		}
		var d = [].some.call(a, function(a) {
			return 0 > a
		});
		if (!d) {
			for (var e = [], f = 0, g = a.length; g > f; f++)e[2 * f] = a[f], e[2 * f + 1] = -a[f];
			a = e
		}
		var h = .5 / this.params.pixelRatio, i = this.params.height * this.params.pixelRatio, j = i * b || 0, k = i / 2, l = ~~(a.length / 2), m = 1;
		this.params.fillParent && this.width != l && (m = this.width / l);
		var n = 1;
		if (this.params.normalize) {
			var o = Math.max.apply(Math, a), p = Math.min.apply(Math, a);
			n = -p > o ? -p : o
		}
		this.waveCc.fillStyle = this.params.waveColor, this.progressCc && (this.progressCc.fillStyle = this.params.progressColor), [this.waveCc, this.progressCc].forEach(function(b) {
			if (b) {
				b.beginPath(), b.moveTo(h, k + j);
				for (var c = 0; l > c; c++) {
					var d = Math.round(a[2 * c] / n * k);
					b.lineTo(c * m + h, k - d + j)
				}
				for (var c = l - 1; c >= 0; c--) {
					var d = Math.round(a[2 * c + 1] / n * k);
					b.lineTo(c * m + h, k - d + j)
				}
				b.closePath(), b.fill(), b.fillRect(0, k + j - h, this.width, h)
			}
		}, this)
	}, updateProgress: function(a) {
		var b = Math.round(this.width * a) / this.params.pixelRatio;
		this.style(this.progressWave, {width: b + "px"})
	}
}), function() {
	var a = function() {
		var a = document.querySelectorAll("wavesurfer");
		Array.prototype.forEach.call(a, function(a) {
			var b = WaveSurfer.util.extend({container: a, backend: "MediaElement", mediaControls: !0}, a.dataset);
			a.style.display = "block";
			var c = WaveSurfer.create(b);
			if (a.dataset.peaks)var d = JSON.parse(a.dataset.peaks);
			c.load(a.dataset.url, d)
		})
	};
	"complete" === document.readyState ? a() : window.addEventListener("load", a)
}();
//# sourceMappingURL=wavesurfer.min.js.map
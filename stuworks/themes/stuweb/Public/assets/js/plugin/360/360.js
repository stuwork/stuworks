(function (e) {
	e.fn.extend({
		vc3dEye : function (t) {
			new e.vc3dEye(this, t);
			return
		}
	});
	e.vc3dEye = function (t, n) {
		function h(e, t) {
			u = e;
			a = t.imagePath;
			i = t.totalImages;
			c = t.imageExtension
		}
		function p() {
			e(f).mousedown(function () {
				s = true
			});
			e(document).mouseup(function () {
				s = false
			});
			e(f).mousemove(function (e) {
				if (s == true)
					d(e.pageX - this.offsetLeft);
				else
					o = e.pageX - this.offsetLeft
			});
			e(f).bind("touchstart", function () {
				s = true
			});
			e(document).bind("touchend", function () {
				s = false
			});
			e(f).bind("touchmove", function (e) {
				e.preventDefault();
				var t = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
				if (s == true)
					d(t.pageX - this.offsetLeft);
				else
					o = t.pageX - this.offsetLeft
			});
		}
		function d(t) {
			if (o - t > 25) {
				o = t;
				r = --r < 1 ? i : r;
				e(u).css("background-image", "url(" + a + r + "." + c + ")")
			} else if (o - t < -25) {
				o = t;
				r = ++r > i ? 1 : r;
				e(u).css("background-image", "url(" + a + r + "." + c + ")")
			}
		}
		function v() {
			var t = a + "1." + c;
			e(u).css("background-image", "url(" + t + ")");
			e("<img/>").attr("src", t).load(function () {
				e(u).height(this.height).width(this.width)
			});
			for (var n = 2; n <= i; n++) {
				t = a + n + "." + c;
				e(u).append("<img src='" + t + "' style='display:none;'>");
				e("<img/>").attr("src", t).css("display", "none").load(function () {
					l++;
					if (l >= i) {
						e(f).removeClass("onLoadingDiv");
						e(f).text("")
					}
				})
			}
		}
		function m() {
			e("html").append("<style type='text/css'>.onLoadingDiv{background-color:#00FF00;opacity:0.5;text-align:center;font-size:2em;font:color:#000000;}</style>")
		}
		var r = 1,
		i = 0,
		s = false,
		o = 0,
		u,
		a,
		f = "#VCc",
		l = 1,
		c = "png";
		h(t, n);
		m();
		e(u).html("<div id='VCc' style='height:100%;width:100%;' class='onLoadingDiv'>Loading...</div>");
		v();
		p()
	}
})(jQuery)

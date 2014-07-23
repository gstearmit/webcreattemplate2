var Cufon = (function() {
	var e = function() {
		return e.replace.apply(null, arguments)
	};
	
	var v = e.DOM = {
		ready: (function() {
			var M = false,
				O = {
					loaded: 1,
					complete: 1
				};
			
			var L = [],
				N = function() {
					if (M) {
						return
					}
					M = true;
					for (var P; P = L.shift(); P()) {}
				};
			
			if (document.addEventListener) {
				document.addEventListener("DOMContentLoaded", N, false);
				window.addEventListener("pageshow", N, false)
			}
			if (!window.opera && document.readyState) {
				(function() {
					O[document.readyState] ? N() : setTimeout(arguments.callee, 10)
				})()
			}
			if (document.readyState && document.createStyleSheet) {
				(function() {
					try {
						document.body.doScroll("left");
						N()
					} catch (P) {
						setTimeout(arguments.callee, 1)
					}
				})()
			}
			i(window, "load", N);
			return function(P) {
				if (!arguments.length) {
					N()
				} else {
					M ? P() : L.push(P)
				}
			}
		})(),
		root: function() {
			return document.documentElement || document.body
		},
		
		strict: (function() {
			var L;
			if (document.compatMode == "BackCompat") {
				return false
			}
			L = document.doctype;
			if (L) {
				return !/frameset|transitional/i.test(L.publicId)
			}
			L = document.firstChild;
			if (L.nodeType != 8 || /^DOCTYPE.+(transitional|frameset)/i.test(L.data)) {
				return false
			}
			return true
		})()
	};
	
	var q = e.CSS = {
		Size: function(M, L) {
			this.value = parseFloat(M);
			this.unit = String(M).match(/[a-z%]*$/)[0] || "px";
			this.convert = function(N) {
				return N / L * this.value
			};
			
			this.convertFrom = function(N) {
				return N / this.value * L
			};
			
			this.toString = function() {
				return this.value + this.unit
			}
		},
		
		addClass: function(M, L) {
			var N = M.className;
			M.className = N + (N && " ") + L;
			return M
		},
		
		color: g(function(M) {
			var L = {};
			
			L.color = M.replace(/^rgba\((.*?),\s*([\d.]+)\)/, function(O, N, P) {
				L.opacity = parseFloat(P);
				return "rgb(" + N + ")"
			});
			
			return L
		}),
		fontStretch: g(function(L) {
			if (typeof L == "number") {
				return L
			}
			if (/%$/.test(L)) {
				return parseFloat(L) / 100
			}
			return {
				"ultra-condensed": 0.5,
				"extra-condensed": 0.625,
				condensed: 0.75,
				"semi-condensed": 0.875,
				"semi-expanded": 1.125,
				expanded: 1.25,
				"extra-expanded": 1.5,
				"ultra-expanded": 2
			}[L] || 1
		}),
		getStyle: function(M) {
			var L = document.defaultView;
			if (L && L.getComputedStyle) {
				return new A(L.getComputedStyle(M, null))
			}
			if (M.currentStyle) {
				return new A(M.currentStyle)
			}
			return new A(M.style)
		},
		
		gradient: g(function(P) {
			var Q = {
				id: P,
				type: P.match(/^-([a-z]+)-gradient\(/)[1],
				stops: []
			},
				M = P.substr(P.indexOf("(")).match(/([\d.]+=)?(#[a-f0-9]+|[a-z]+\(.*?\)|[a-z]+)/ig);
			for (var O = 0, L = M.length, N; O < L; ++O) {
				N = M[O].split("=", 2).reverse();
				
				Q.stops.push([N[1] || O / (L - 1), N[0]])
			}
			return Q
		}),
		quotedList: g(function(O) {
			var N = [],
				M = /\s*((["'])([\s\S]*?[^\\])\2|[^,]+)\s*/g,
				L;
			while (L = M.exec(O)) {
				N.push(L[3] || L[1])
			}
			return N
		}),
		recognizesMedia: g(function(Q) {
			var O = document.createElement("style"),
				N, M, L;
			O.type = "text/css";
			O.media = Q;
			try {
				O.appendChild(document.createTextNode("/**/"))
			} catch (P) {}
			M = f("head")[0];
			M.insertBefore(O, M.firstChild);
			N = (O.sheet || O.styleSheet);
			L = N && !N.disabled;
			M.removeChild(O);
			return L
		}),
		removeClass: function(N, M) {
			var L = RegExp("(?:^|\\s+)" + M + "(?=\\s|$)", "g");
			N.className = N.className.replace(L, "");
			return N
		},
		
		supports: function(N, M) {
			var L = document.createElement("span").style;
			if (L[N] === undefined) {
				return false
			}
			L[N] = M;
			return L[N] === M
		},
		
		textAlign: function(O, N, L, M) {
			if (N.get("textAlign") == "right") {
				if (L > 0) {
					O = " " + O
				}
			} else {
				if (L < M - 1) {
					O += " "
				}
			}
			return O
		},
		
		textShadow: g(function(P) {
			if (P == "none") {
				return null
			}
			var O = [],
				Q = {},
				L, M = 0;
			var N = /(#[a-f0-9]+|[a-z]+\(.*?\)|[a-z]+)|(-?[\d.]+[a-z%]*)|,/ig;
			while (L = N.exec(P)) {
				if (L[0] == ",") {
					O.push(Q);
					Q = {};
					
					M = 0
				} else {
					if (L[1]) {
						Q.color = L[1]
					} else {
						Q[["offX", "offY", "blur"][M++]] = L[2]
					}
				}
			}
			O.push(Q);
			return O
		}),
		textTransform: (function() {
			var L = {
				uppercase: function(M) {
					return M.toUpperCase()
				},
				
				lowercase: function(M) {
					return M.toLowerCase()
				},
				
				capitalize: function(M) {
					return M.replace(/(?:^|\s)./g, function(N) {
						return N.toUpperCase()
					})
				}
			};
			
			return function(O, N) {
				var M = L[N.get("textTransform")];
				return M ? M(O) : O
			}
		})(),
		whiteSpace: (function() {
			var N = {
				inline: 1,
				"inline-block": 1,
				"run-in": 1
			};
			
			var M = /^\s+/,
				L = /\s+$/;
			return function(R, P, Q, O, S) {
				if (S) {
					return R.replace(M, "").replace(L, "")
				}
				if (O) {
					if (O.nodeName.toLowerCase() == "br") {
						R = R.replace(M, "")
					}
				}
				if (N[P.get("display")]) {
					return R
				}
				if (!Q.previousSibling) {
					R = R.replace(M, "")
				}
				if (!Q.nextSibling) {
					R = R.replace(L, "")
				}
				return R
			}
		})()
	};
	
	q.ready = (function() {
		var L = !q.recognizesMedia("all"),
			P = false;
		var O = [],
			S = function() {
				L = true;
				for (var V; V = O.shift(); V()) {}
			};
		
		var T = f("link"),
			U = f("style");
		var M = {
			"": 1,
			"text/css": 1
		};

		
		function N(V) {
			if (!M[V.type.toLowerCase()]) {
				return true
			}
			return V.disabled || R(V.sheet, V.media || "screen")
		}
		function R(X, aa) {
			if (!q.recognizesMedia(aa || "all")) {
				return true
			}
			if (!X || X.disabled) {
				return false
			}
			try {
				var ab = X.cssRules,
					Z;
				if (ab) {
					search: for (var W = 0, V = ab.length; Z = ab[W], W < V; ++W) {
						switch (Z.type) {
							case 2:
								break;
							case 3:
								if (!R(Z.styleSheet, Z.media.mediaText)) {
									return false
								}
								break;
							default:
								break search
						}
					}
				}
			} catch (Y) {}
			return true
		}
		function Q() {
			if (document.createStyleSheet) {
				return true
			}
			var W, V;
			for (V = 0; W = T[V]; ++V) {
				if (W.rel.toLowerCase() == "stylesheet" && !N(W)) {
					return false
				}
			}
			for (V = 0; W = U[V]; ++V) {
				if (!N(W)) {
					return false
				}
			}
			return true
		}
		v.ready(function() {
			if (!P) {
				P = q.getStyle(document.body).isUsable()
			}
			if (L || (P && Q())) {
				S()
			} else {
				setTimeout(arguments.callee, 10)
			}
		});
		
		return function(V) {
			if (L) {
				V()
			} else {
				O.push(V)
			}
		}
	})();

	
	function D(N) {
		var M = this.face = N.face,
			L = {
				"\u0020": 1,
				"\u00a0": 1,
				"\u3000": 1
			};
		
		this.glyphs = (function(Q) {
			var P, O = {
				"\u2011": "\u002d",
				"\u00ad": "\u2011"
			};
			
			for (P in O) {
				if (!k(O, P)) {
					continue
				}
				if (!Q[P]) {
					Q[P] = Q[O[P]]
				}
			}
			return Q
		})(N.glyphs);
		this.w = N.w;
		this.baseSize = parseInt(M["units-per-em"], 10);
		this.family = M["font-family"].toLowerCase();
		
		this.weight = M["font-weight"];
		this.style = M["font-style"] || "normal";
		this.viewBox = (function() {
			var P = M.bbox.split(/\s+/);
			var O = {
				minX: parseInt(P[0], 10),
				minY: parseInt(P[1], 10),
				maxX: parseInt(P[2], 10),
				maxY: parseInt(P[3], 10)
			};
			
			O.width = O.maxX - O.minX;
			O.height = O.maxY - O.minY;
			O.toString = function() {
				return [this.minX, this.minY, this.width, this.height].join(" ")
			};
			
			return O
		})();
		
		this.ascent = -parseInt(M.ascent, 10);
		this.descent = -parseInt(M.descent, 10);
		this.height = -this.ascent + this.descent;
		this.spacing = function(V, Y, O) {
			var Z = this.glyphs,
				W, U, Q, aa = [],
				P = 0,
				X, T = -1,
				S = -1,
				R;
			while (R = V[++T]) {
				W = Z[R] || this.missingGlyph;
				if (!W) {
					continue
				}
				if (U) {
					P -= Q = U[R] || 0;
					aa[S] -= Q
				}
				X = W.w;
				if (isNaN(X)) {
					X = +this.w
				}
				if (X > 0) {
					X += Y;
					if (L[R]) {
						X += O
					}
					X *= 0.98
				}
				P += aa[++S] = ~~X;
				U = W.k
			}
			aa.total = P;
			return aa
		}
	}
	function s() {
		var M = {},
			L = {
				oblique: "italic",
				italic: "oblique"
			};
		
		this.add = function(N) {
			(M[N.style] || (M[N.style] = {}))[N.weight] = N
		};
		
		this.get = function(R, S) {
			var Q = M[R] || M[L[R]] || M.normal || M.italic || M.oblique;
			if (!Q) {
				return null
			}
			S = {
				normal: 400,
				bold: 700
			}[S] || parseInt(S, 10);
			if (Q[S]) {
				return Q[S]
			}
			var O = {
				1: 1,
				99: 0
			}[S % 100],
				U = [],
				P, N;
			if (O === undefined) {
				O = S > 400
			}
			if (S == 500) {
				S = 400
			}
			for (var T in Q) {
				if (!k(Q, T)) {
					continue
				}
				T = parseInt(T, 10);
				if (!P || T < P) {
					P = T
				}
				if (!N || T > N) {
					N = T
				}
				U.push(T)
			}
			if (S < P) {
				S = P
			}
			if (S > N) {
				S = N
			}
			U.sort(function(W, V) {
				return (O ? (W >= S && V >= S) ? W < V : W > V : (W <= S && V <= S) ? W > V : W < V) ? -1 : 1
			});
			
			return Q[U[0]]
		}
	}
	function n() {
		function N(P, R) {
			try {
				if (P.contains) {
					return P.contains(R)
				}
				return P.compareDocumentPosition(R) & 16
			} catch (Q) {}
			return false
		}
		function L(Q) {
			var P = Q.relatedTarget;
			if (P && N(this, P)) {
				return
			}
			M(this, Q.type == "mouseover")
		}
		function O(P) {
			if (!P) {
				P = window.event
			}
			M(P.target || P.srcElement, P.type == "mouseenter")
		}
		function M(P, Q) {
			setTimeout(function() {
				var R = d.get(P).options;
				if (Q) {
					R = C(R, R.hover);
					R._mediatorMode = 1
				}
				e.replace(P, R, true)
			}, 10)
		}
		this.attach = function(P) {
			if (P.onmouseenter === undefined) {
				i(P, "mouseover", L);
				i(P, "mouseout", L)
			} else {
				i(P, "mouseenter", O);
				i(P, "mouseleave", O)
			}
		};
		
		this.detach = function(P) {
			if (P.onmouseenter === undefined) {
				c(P, "mouseover", L);
				c(P, "mouseout", L)
			} else {
				c(P, "mouseenter", O);
				c(P, "mouseleave", O)
			}
		}
	}
	function w() {
		var M = [],
			N = {};

		
		function L(R) {
			var O = [],
				Q;
			for (var P = 0; Q = R[P]; ++P) {
				O[P] = M[N[Q]]
			}
			return O
		}
		this.add = function(P, O) {
			N[P] = M.push(O) - 1
		};
		
		this.repeat = function() {
			var O = arguments.length ? L(arguments) : M,
				P;
			for (var Q = 0; P = O[Q++];) {
				e.replace(P[0], P[1], true)
			}
		}
	}
	function z() {
		var N = {},
			L = 0;

		function M(O) {
			return O.cufid || (O.cufid = ++L)
		}
		this.get = function(O) {
			var P = M(O);
			return N[P] || (N[P] = {})
		}
	}
	function A(L) {
		var N = {},
			M = {};
		
		this.extend = function(O) {
			for (var P in O) {
				if (k(O, P)) {
					N[P] = O[P]
				}
			}
			return this
		};
		
		this.get = function(O) {
			return N[O] != undefined ? N[O] : L[O]
		};
		
		this.getSize = function(P, O) {
			return M[P] || (M[P] = new q.Size(this.get(P), O))
		};
		
		this.isUsable = function() {
			return !!L
		}
	}
	function i(M, L, N) {
		if (M.addEventListener) {
			M.addEventListener(L, N, false)
		} else {
			if (M.attachEvent) {
				M.attachEvent("on" + L, N)
			}
		}
	}
	function r(N, M) {
		if (M._mediatorMode) {
			return N
		}
		var O = d.get(N);
		var L = O.options;
		if (L) {
			if (L === M) {
				return N
			}
			if (L.hover) {
				u.detach(N)
			}
		}
		if (M.hover && M.hoverables[N.nodeName.toLowerCase()]) {
			u.attach(N)
		}
		O.options = M;
		return N
	}
	function g(L) {
		var M = {};
		
		return function(N) {
			if (!k(M, N)) {
				M[N] = L.apply(null, arguments)
			}
			return M[N]
		}
	}
	function t(P, O) {
		var L = q.quotedList(O.get("fontFamily").toLowerCase()),
			N;
		for (var M = 0; N = L[M]; ++M) {
			if (G[N]) {
				return G[N].get(O.get("fontStyle"), O.get("fontWeight"))
			}
		}
		return null
	}
	function f(L) {
		return document.getElementsByTagName(L)
	}
	function k(M, L) {
		return M.hasOwnProperty(L)
	}
	function C() {
		var M = {},
			L, P;
		for (var O = 0, N = arguments.length; L = arguments[O], O < N; ++O) {
			for (P in L) {
				if (k(L, P)) {
					M[P] = L[P]
				}
			}
		}
		return M
	}
	function J(O, W, M, X, P, N) {
		var U = document.createDocumentFragment(),
			R;
		if (W === "") {
			return U
		}
		var V = X.separate;
		var S = W.split(y[V]),
			L = (V == "words");
		if (L && x) {
			if (/^\s/.test(W)) {
				S.unshift("")
			}
			if (/\s$/.test(W)) {
				S.push("")
			}
		}
		for (var T = 0, Q = S.length; T < Q; ++T) {
			R = b[X.engine](O, L ? q.textAlign(S[T], M, T, Q) : S[T], M, X, P, N, T < Q - 1);
			if (R) {
				U.appendChild(R)
			}
		}
		return U
	}
	function c(M, L, N) {
		if (M.removeEventListener) {
			M.removeEventListener(L, N, false)
		} else {
			if (M.detachEvent) {
				M.detachEvent("on" + L, N)
			}
		}
	}
	function I(M, O) {
		var ad = M.nodeName.toLowerCase();
		
		if (O.ignore[ad]) {
			return
		}
		if (O.ignoreClass && O.ignoreClass.test(M.className)) {
			return
		}
		if (O.onBeforeReplace) {
			O.onBeforeReplace(M, O)
		}
		var ac = !O.textless[ad],
			Z = (O.trim === "simple");
		var aa = q.getStyle(r(M, O)).extend(O);
		if (parseFloat(aa.get("fontSize")) === 0) {
			return
		}
		var V = t(M, aa),
			Y, P, W, R, U, ab;
		var X = O.softHyphens,
			T = false,
			Q, S, N = /\u00ad/g;
		var L = O.modifyText;
		if (!V) {
			return
		}
		for (Y = M.firstChild; Y; Y = W) {
			P = Y.nodeType;
			W = Y.nextSibling;
			if (ac && P == 3) {
				if (X && M.nodeName.toLowerCase() != o) {
					Q = Y.data.indexOf("\u00ad");
					if (Q >= 0) {
						Y.splitText(Q);
						W = Y.nextSibling;
						W.deleteData(0, 1);
						S = document.createElement(o);
						S.appendChild(document.createTextNode("\u00ad"));
						M.insertBefore(S, W);
						W = S;
						T = true
					}
				}
				if (R) {
					R.appendData(Y.data);
					M.removeChild(Y)
				} else {
					R = Y
				}
				if (W) {
					continue
				}
			}
			if (R) {
				U = R.data;
				if (!X) {
					U = U.replace(N, "")
				}
				U = q.whiteSpace(U, aa, R, ab, Z);
				if (L) {
					U = L(U, R, M, O)
				}
				M.replaceChild(J(V, U, aa, O, Y, M), R);
				R = null
			}
			if (P == 1) {
				if (Y.firstChild) {
					if (Y.nodeName.toLowerCase() == "cufon") {
						b[O.engine](V, null, aa, O, Y, M)
					} else {
						arguments.callee(Y, O)
					}
				}
				ab = Y
			}
		}
		if (X && T) {
			E(M);
			if (!l) {
				i(window, "resize", j)
			}
			l = true
		}
		if (O.onAfterReplace) {
			O.onAfterReplace(M, O)
		}
	}
	function E(M) {
		var R, S, T, Q, L, P, N, O;
		R = M.getElementsByTagName(o);
		for (O = 0; S = R[O]; ++O) {
			S.className = h;
			Q = T = S.parentNode;
			if (Q.nodeName.toLowerCase() != p) {
				L = document.createElement(p);
				L.appendChild(S.previousSibling);
				T.insertBefore(L, S);
				L.appendChild(S)
			} else {
				Q = Q.parentNode;
				if (Q.nodeName.toLowerCase() == p) {
					T = Q.parentNode;
					while (Q.firstChild) {
						T.insertBefore(Q.firstChild, Q)
					}
					T.removeChild(Q)
				}
			}
		}
		for (O = 0; S = R[O]; ++O) {
			S.className = "";
			Q = S.parentNode;
			T = Q.parentNode;
			P = Q.nextSibling || T.nextSibling;
			N = (P.nodeName.toLowerCase() == p) ? Q : S.previousSibling;
			if (N.offsetTop >= P.offsetTop) {
				S.className = h;
				if (N.offsetTop < P.offsetTop) {
					L = document.createElement(p);
					T.insertBefore(L, Q);
					L.appendChild(Q);
					L.appendChild(P)
				}
			}
		}
	}
	function j() {
		if (B) {
			return
		}
		q.addClass(v.root(), K);
		clearTimeout(a);
		a = setTimeout(function() {
			B = true;
			q.removeClass(v.root(), K);
			E(document);
			B = false
		}, 100)
	}
	var x = " ".split(/\s+/).length == 0;
	var p = "cufonglue";
	var o = "cufonshy";
	var h = "cufon-shy-disabled";
	var K = "cufon-viewport-resizing";
	var d = new z();
	
	var u = new n();
	
	var H = new w();
	
	var m = false;
	var l = false;
	var a;
	var B = false;
	var b = {},
		G = {},
		F = {
			autoDetect: false,
			engine: null,
			forceHitArea: false,
			hover: false,
			hoverables: {
				a: true
			},
			
			ignore: {
				applet: 1,
				canvas: 1,
				col: 1,
				colgroup: 1,
				head: 1,
				iframe: 1,
				map: 1,
				noscript: 1,
				optgroup: 1,
				option: 1,
				script: 1,
				select: 1,
				style: 1,
				textarea: 1,
				title: 1,
				pre: 1
			},
			
			ignoreClass: null,
			modifyText: null,
			onAfterReplace: null,
			onBeforeReplace: null,
			printable: true,
			selector: (window.Sizzle || (window.jQuery &&
			function(L) {
				return jQuery(L)
			}) || (window.dojo && dojo.query) || (window.glow && glow.dom && glow.dom.get) || (window.Ext && Ext.query) || (window.YAHOO && YAHOO.util && YAHOO.util.Selector && YAHOO.util.Selector.query) || (window.$$ &&
			function(L) {
				return $$(L)
			}) || (window.$ &&
			function(L) {
				return $(L)
			}) || (document.querySelectorAll &&
			function(L) {
				return document.querySelectorAll(L)
			}) || f),
			separate: "words",
			softHyphens: true,
			textless: {
				dl: 1,
				html: 1,
				ol: 1,
				table: 1,
				tbody: 1,
				thead: 1,
				tfoot: 1,
				tr: 1,
				ul: 1
			},
			
			textShadow: "none",
			trim: "advanced"
		};
	
	var y = {
		words: /\s/.test("\u00a0") ? /[^\S\u00a0]+/ : /\s+/,
		characters: "",
		none: /^/
	};
	
	e.now = function() {
		v.ready();
		
		return e
	};
	
	e.refresh = function() {
		H.repeat.apply(H, arguments);
		return e
	};
	
	e.registerEngine = function(M, L) {
		if (!L) {
			return e
		}
		b[M] = L;
		return e.set("engine", M)
	};
	
	e.registerFont = function(N) {
		if (!N) {
			return e
		}
		var L = new D(N),
			M = L.family;
		if (!G[M]) {
			G[M] = new s()
		}
		G[M].add(L);
		return e.set("fontFamily", '"' + M + '"')
	};
	
	e.replace = function(N, M, L) {
		M = C(F, M);
		if (!M.engine) {
			return e
		}
		if (!m) {
			q.addClass(v.root(), "cufon-active cufon-loading");
			q.ready(function() {
				q.addClass(q.removeClass(v.root(), "cufon-loading"), "cufon-ready")
			});
			
			m = true
		}
		if (M.hover) {
			M.forceHitArea = true
		}
		if (M.autoDetect) {
			delete M.fontFamily
		}
		if (typeof M.ignoreClass == "string") {
			M.ignoreClass = new RegExp("(?:^|\\s)(?:" + M.ignoreClass.replace(/\s+/g, "|") + ")(?:\\s|$)")
		}
		if (typeof M.textShadow == "string") {
			M.textShadow = q.textShadow(M.textShadow)
		}
		if (typeof M.color == "string" && /^-/.test(M.color)) {
			M.textGradient = q.gradient(M.color)
		} else {
			delete M.textGradient
		}
		if (typeof N == "string") {
			if (!L) {
				H.add(N, arguments)
			}
			N = [N]
		} else {
			if (N.nodeType) {
				N = [N]
			}
		}
		q.ready(function() {
			for (var P = 0, O = N.length; P < O; ++P) {
				var Q = N[P];
				if (typeof Q == "string") {
					e.replace(M.selector(Q), M, true)
				} else {
					I(Q, M)
				}
			}
		});
		
		return e
	};
	
	e.set = function(L, M) {
		F[L] = M;
		return e
	};
	
	return e
})();

Cufon.registerEngine("vml", (function() {
	var e = document.namespaces;
	if (!e) {
		return
	}
	e.add("cvml", "urn:schemas-microsoft-com:vml");
	e = null;
	var b = document.createElement("cvml:shape");
	b.style.behavior = "url(#default#VML)";
	if (!b.coordsize) {
		return
	}
	b = null;
	var h = (document.documentMode || 0) < 8;
	document.write(('<style type="text/css">cufoncanvas{text-indent:0;}@media screen{cvml\\:shape,cvml\\:rect,cvml\\:fill,cvml\\:shadow{behavior:url(#default#VML);display:block;antialias:true;position:absolute;}cufoncanvas{position:absolute;text-align:left;}cufon{display:inline-block;position:relative;vertical-align:' + (h ? "middle" : "text-bottom") + ";}cufon cufontext{position:absolute;left:-10000in;font-size:1px;text-align:left;}cufonshy.cufon-shy-disabled,.cufon-viewport-resizing cufonshy{display:none;}cufonglue{white-space:nowrap;display:inline-block;}.cufon-viewport-resizing cufonglue{white-space:normal;}a cufon{cursor:pointer}}@media print{cufon cufoncanvas{display:none;}}</style>").replace(/;/g, "!important;"));

	function c(i, j) {
		return a(i, /(?:em|ex|%)$|^[a-z-]+$/i.test(j) ? "1em" : j)
	}
	function a(l, m) {
		if (!isNaN(m) || /px$/i.test(m)) {
			return parseFloat(m)
		}
		var k = l.style.left,
			j = l.runtimeStyle.left;
		l.runtimeStyle.left = l.currentStyle.left;
		l.style.left = m.replace("%", "em");
		var i = l.style.pixelLeft;
		l.style.left = k;
		l.runtimeStyle.left = j;
		return i
	}
	function f(l, k, j, n) {
		var i = "computed" + n,
			m = k[i];
		if (isNaN(m)) {
			m = k.get(n);
			k[i] = m = (m == "normal") ? 0 : ~~j.convertFrom(a(l, m))
		}
		return m
	}
	var g = {};

	
	function d(p) {
		var q = p.id;
		if (!g[q]) {
			var n = p.stops,
				o = document.createElement("cvml:fill"),
				i = [];
			o.type = "gradient";
			o.angle = 180;
			o.focus = "0";
			o.method = "none";
			o.color = n[0][1];
			for (var m = 1, l = n.length - 1; m < l; ++m) {
				i.push(n[m][0] * 100 + "% " + n[m][1])
			}
			o.colors = i.join(",");
			o.color2 = n[l][1];
			g[q] = o
		}
		return g[q]
	}
	return function(ad, H, Z, D, L, ae, X) {
		var o = (H === null);
		if (o) {
			H = L.alt
		}
		var J = ad.viewBox;
		var q = Z.computedFontSize || (Z.computedFontSize = new Cufon.CSS.Size(c(ae, Z.get("fontSize")) + "px", ad.baseSize));
		var z, r;
		if (o) {
			z = L;
			r = L.firstChild;
			var n = r.childNodes.length;
			if (n < H.length) {
				r.parentNode.removeChild(r);
				r = document.createElement("cufoncanvas");
				z.appendChild(r);
				if (D.printable) {
					var aa = document.createElement("cufontext");
					aa.appendChild(document.createTextNode(H));
					z.appendChild(aa)
				}
				if (!X) {
					z.appendChild(document.createElement("cvml:shape"))
				}
				o = false
			}
		} else {
			z = document.createElement("cufon");
			z.className = "cufon cufon-vml";
			z.alt = H;
			r = document.createElement("cufoncanvas");
			z.appendChild(r);
			if (D.printable) {
				var aa = document.createElement("cufontext");
				aa.appendChild(document.createTextNode(H));
				z.appendChild(aa)
			}
			if (!X) {
				z.appendChild(document.createElement("cvml:shape"))
			}
		}
		var aj = z.style;
		var S = r.style;
		var l = q.convert(J.height),
			ag = Math.ceil(l);
		var W = ag / l;
		var Q = W * Cufon.CSS.fontStretch(Z.get("fontStretch"));
		var V = J.minX,
			U = J.minY;
		S.height = ag;
		S.top = Math.round(q.convert(U - ad.ascent));
		S.left = Math.round(q.convert(V));
		aj.height = q.convert(ad.height) + "px";
		var G = Z.get("color");
		var ah = Cufon.CSS.textTransform(H, Z).split("");
		var M = ad.spacing(ah, f(ae, Z, q, "letterSpacing"), f(ae, Z, q, "wordSpacing"));
		if (!M.length) {
			return null
		}
		var k = M.total;
		var y = -V + k + (J.width - M[M.length - 1]);
		var ai = q.convert(y * Q),
			Y = Math.round(ai);
		var P = y + "," + J.height,
			m;
		var K = "r" + P + "ns";
		var v = D.textGradient && d(D.textGradient);
		var p = ad.glyphs,
			T = 0;
		var I = D.textShadow;
		var ac = -1,
			ab = 0,
			x;
		while (x = ah[++ac]) {
			var E = p[ah[ac]] || ad.missingGlyph,
				w;
			if (!E) {
				continue
			}
			if (o) {
				w = r.childNodes[ab];
				while (w.firstChild) {
					w.removeChild(w.firstChild)
				}
			} else {
				w = document.createElement("cvml:shape");
				r.appendChild(w)
			}
			w.stroked = "f";
			w.coordsize = P;
			w.coordorigin = m = (V - T) + "," + U;
			w.path = (E.d ? "m" + E.d + "xe" : "") + "m" + m + K;
			w.fillcolor = G;
			if (v) {
				w.appendChild(v.cloneNode(false))
			}
			var af = w.style;
			af.width = Y;
			af.height = ag;
			if (I) {
				var t = I[0],
					s = I[1];
				var C = Cufon.CSS.color(t.color),
					A;
				var O = document.createElement("cvml:shadow");
				O.on = "t";
				O.color = C.color;
				O.offset = t.offX + "," + t.offY;
				if (s) {
					A = Cufon.CSS.color(s.color);
					O.type = "double";
					O.color2 = A.color;
					O.offset2 = s.offX + "," + s.offY
				}
				O.opacity = C.opacity || (A && A.opacity) || 1;
				w.appendChild(O)
			}
			T += M[ab++]
		}
		var N = w.nextSibling,
			u, B;
		if (D.forceHitArea) {
			if (!N) {
				N = document.createElement("cvml:rect");
				N.stroked = "f";
				N.className = "cufon-vml-cover";
				u = document.createElement("cvml:fill");
				u.opacity = 0;
				N.appendChild(u);
				r.appendChild(N)
			}
			B = N.style;
			B.width = Y;
			B.height = ag
		} else {
			if (N) {
				r.removeChild(N)
			}
		}
		aj.width = Math.max(Math.ceil(q.convert(k * Q)), 0);
		if (h) {
			var R = Z.computedYAdjust;
			if (R === undefined) {
				var F = Z.get("lineHeight");
				if (F == "normal") {
					F = "1em"
				} else {
					if (!isNaN(F)) {
						F += "em"
					}
				}
				Z.computedYAdjust = R = 0.5 * (a(ae, F) - parseFloat(aj.height))
			}
			if (R) {
				aj.marginTop = Math.ceil(R) + "px";
				aj.marginBottom = R + "px"
			}
		}
		return z
	}
})());
Cufon.registerEngine("canvas", (function() {
	var b = document.createElement("canvas");
	if (!b || !b.getContext || !b.getContext.apply) {
		return
	}
	b = null;
	var a = Cufon.CSS.supports("display", "inline-block");
	var e = !a && (document.compatMode == "BackCompat" || /frameset|transitional/i.test(document.doctype.publicId));
	var f = document.createElement("style");
	f.type = "text/css";
	f.appendChild(document.createTextNode(("cufon{text-indent:0;}@media screen,projection{cufon{display:inline;display:inline-block;position:relative;vertical-align:middle;" + (e ? "" : "font-size:1px;line-height:1px;") + "}cufon cufontext{display:-moz-inline-box;display:inline-block;width:0;height:0;text-align:left;text-indent:-10000in;}" + (a ? "cufon canvas{position:relative;}" : "cufon canvas{position:absolute;}") + "cufonshy.cufon-shy-disabled,.cufon-viewport-resizing cufonshy{display:none;}cufonglue{white-space:nowrap;display:inline-block;}.cufon-viewport-resizing cufonglue{white-space:normal;}}@media print{cufon{padding:0;}cufon canvas{display:none;}}").replace(/;/g, "!important;")));
	document.getElementsByTagName("head")[0].appendChild(f);

	function d(p, h) {
		var n = 0,
			m = 0;
		var g = [],
			o = /([mrvxe])([^a-z]*)/g,
			k;
		generate: for (var j = 0; k = o.exec(p); ++j) {
			var l = k[2].split(",");
			switch (k[1]) {
				case "v":
					g[j] = {
						m: "bezierCurveTo",
						a: [n + ~~l[0], m + ~~l[1], n + ~~l[2], m + ~~l[3], n += ~~l[4], m += ~~l[5]]
					};
					
					break;
				case "r":
					g[j] = {
						m: "lineTo",
						a: [n += ~~l[0], m += ~~l[1]]
					};
					
					break;
				case "m":
					g[j] = {
						m: "moveTo",
						a: [n = ~~l[0], m = ~~l[1]]
					};
					
					break;
				case "x":
					g[j] = {
						m: "closePath"
					};
					
					break;
				case "e":
					break generate
			}
			h[g[j].m].apply(h, g[j].a)
		}
		return g
	}
	function c(m, k) {
		for (var j = 0, h = m.length; j < h; ++j) {
			var g = m[j];
			k[g.m].apply(k, g.a)
		}
	}
	return function(W, w, P, t, C, X) {
		var k = (w === null);
		if (k) {
			w = C.getAttribute("alt")
		}
		var A = W.viewBox;
		var m = P.getSize("fontSize", W.baseSize);
		var B = 0,
			O = 0,
			N = 0,
			u = 0;
		var z = t.textShadow,
			L = [];
		if (z) {
			for (var V = z.length; V--;) {
				var F = z[V];
				var K = m.convertFrom(parseFloat(F.offX));
				var I = m.convertFrom(parseFloat(F.offY));
				L[V] = [K, I];
				if (I < B) {
					B = I
				}
				if (K > O) {
					O = K
				}
				if (I > N) {
					N = I
				}
				if (K < u) {
					u = K
				}
			}
		}
		var aa = Cufon.CSS.textTransform(w, P).split("");
		var E = W.spacing(aa, ~~m.convertFrom(parseFloat(P.get("letterSpacing")) || 0), ~~m.convertFrom(parseFloat(P.get("wordSpacing")) || 0));
		if (!E.length) {
			return null
		}
		var h = E.total;
		O += A.width - E[E.length - 1];
		u += A.minX;
		var s, n;
		if (k) {
			s = C;
			n = C.firstChild
		} else {
			s = document.createElement("cufon");
			s.className = "cufon cufon-canvas";
			s.setAttribute("alt", w);
			n = document.createElement("canvas");
			s.appendChild(n);
			if (t.printable) {
				var T = document.createElement("cufontext");
				T.appendChild(document.createTextNode(w));
				s.appendChild(T)
			}
		}
		var ab = s.style;
		var H = n.style;
		var j = m.convert(A.height);
		var Z = Math.ceil(j);
		var M = Z / j;
		var G = M * Cufon.CSS.fontStretch(P.get("fontStretch"));
		var J = h * G;
		var Q = Math.ceil(m.convert(J + O - u));
		var o = Math.ceil(m.convert(A.height - B + N));
		n.width = Q;
		n.height = o;
		H.width = Q + "px";
		H.height = o + "px";
		B += A.minY;
		H.top = Math.round(m.convert(B - W.ascent)) + "px";
		H.left = Math.round(m.convert(u)) + "px";
		var r = Math.max(Math.ceil(m.convert(J)), 0) + "px";
		if (a) {
			ab.width = r;
			ab.height = m.convert(W.height) + "px"
		} else {
			ab.paddingLeft = r;
			ab.paddingBottom = (m.convert(W.height) - 1) + "px"
		}
		var Y = n.getContext("2d"),
			D = j / A.height;
		var S = window.devicePixelRatio || 1;
		if (S != 1) {
			n.width = Q * S;
			n.height = o * S;
			Y.scale(S, S)
		}
		Y.scale(D, D * M);
		Y.translate(-u, -B);
		Y.save();

		
		function U() {
			var x = W.glyphs,
				ac, l = -1,
				g = -1,
				y;
			Y.scale(G, 1);
			while (y = aa[++l]) {
				var ac = x[aa[l]] || W.missingGlyph;
				if (!ac) {
					continue
				}
				if (ac.d) {
					Y.beginPath();
					
					Y.moveTo(0, 0);
					if (ac.code) {
						c(ac.code, Y)
					} else {
						ac.code = d("m" + ac.d, Y)
					}
					Y.fill()
				}
				Y.translate(E[++g], 0)
			}
			Y.restore()
		}
		if (z) {
			for (var V = z.length; V--;) {
				var F = z[V];
				Y.save();
				
				Y.fillStyle = F.color;
				Y.translate.apply(Y, L[V]);
				U()
			}
		}
		var q = t.textGradient;
		if (q) {
			var v = q.stops,
				p = Y.createLinearGradient(0, A.minY, 0, A.maxY);
			for (var V = 0, R = v.length; V < R; ++V) {
				p.addColorStop.apply(p, v[V])
			}
			Y.fillStyle = p
		} else {
			Y.fillStyle = P.get("color")
		}
		U();
		
		return s
	}
})());

/*
 * The following copyright notice may not be removed under any circumstances.
 * 
 * Copyright:
 * 2005 Erik Spiekermann published by FSI Fonts und Software GmbH
 * 
 * Trademark:
 * Meta is a trademark of FSI Fonts und Software GmbH
 * 
 * Manufacturer:
 * FSI Fonts und Software GmbH
 * 
 * Designer:
 * Erik Spiekermann
 * 
 * Vendor URL:
 * http://www.fontfont.com
 * 
 * License information:
 * http://www.fontfont.com/eula/license.html
 */
Cufon.registerFont({
	w: 97,
	face: {
		"font-family": "MetaPlusCE",
		"font-weight": 400,
		"font-stretch": "normal",
		"units-per-em": "360",
		"panose-1": "2 0 0 0 0 0 0 0 0 0",
		ascent: "288",
		descent: "-72",
		"x-height": "5",
		bbox: "-28 -333 405 75",
		"underline-thickness": "7.2",
		"underline-position": "-47.52",
		stemh: "21",
		stemv: "29",
		"unicode-range": "U+0020-U+2122"
	},
	
	glyphs: {
		" ": {
			w: 82,
			k: {
				z: 4,
				y: 4,
				x: 7,
				v: 4,
				Z: 4,
				Y: 4,
				X: 4,
				W: 4,
				V: 7,
				T: 7,
				S: 7
			}
		},
		
		"!": {
			d: "70,-252r-7,181r-22,0r-6,-176xm75,-20v0,13,-10,23,-22,23v-12,0,-22,-11,-22,-23v0,-12,10,-22,22,-22v12,0,22,10,22,22",
			w: 105
		},
		
		'"': {
			d: "113,-168r-26,0r0,-87r26,0r0,87xm60,-168r-26,0r0,-87r26,0r0,87",
			w: 147
		},
		
		"#": {
			d: "191,-155r-38,0r-8,55r35,0r0,23r-39,0r-10,77r-24,0r10,-77r-45,0r-11,77r-24,0r11,-77r-35,0r0,-23r38,0r8,-55r-36,0r0,-24r39,0r11,-76r24,0r-11,76r46,0r11,-76r24,0r-11,76r35,0r0,24xm129,-155r-46,0r-7,55r45,0",
			w: 203
		},
		
		"$": {
			d: "129,-138v85,16,72,135,-12,142r0,35r-21,0r0,-34v-28,0,-53,-9,-76,-23r13,-23v20,14,40,22,63,22r0,-97v-39,-11,-69,-24,-69,-65v0,-39,28,-67,69,-71r0,-30r21,0r0,30v23,2,44,9,65,23r-13,22v-21,-13,-35,-20,-52,-21r0,86xm156,-66v0,-21,-13,-34,-39,-43r0,88v23,-4,39,-23,39,-45xm96,-148r0,-79v-23,4,-37,17,-37,39v0,19,11,31,37,40",
			w: 208
		},
		
		"%": {
			d: "293,-56v0,37,-22,60,-58,60v-36,0,-58,-24,-58,-62v0,-38,21,-62,57,-62v40,0,59,27,59,64xm132,-185v0,37,-22,59,-58,59v-36,0,-58,-24,-58,-62v0,-38,22,-61,58,-61v40,0,58,27,58,64xm227,-245r-120,245r-23,0r119,-245r24,0xm108,-184v0,-21,-4,-45,-35,-45v-23,0,-32,15,-32,39v0,30,8,45,34,45v21,0,33,-14,33,-39xm269,-55v0,-21,-4,-45,-35,-45v-23,0,-33,15,-33,39v0,30,9,45,35,45v21,0,33,-14,33,-39",
			w: 308
		},
		
		"&": {
			d: "239,0r-37,0r-25,-23v-35,48,-154,31,-154,-38v0,-31,20,-48,51,-63v-23,-21,-35,-37,-35,-55v0,-33,30,-57,64,-57v36,0,66,19,66,55v0,28,-18,42,-51,60r58,57v6,-14,6,-37,6,-56r25,0v0,43,-6,60,-14,75xm162,-40r-71,-69v-52,19,-50,93,17,92v24,0,45,-10,54,-23xm138,-181v0,-20,-14,-35,-35,-35v-17,0,-34,10,-34,33v0,14,6,23,33,46v28,-13,36,-27,36,-44",
			w: 246
		},
		
		"'": {
			d: "60,-168r-26,0r0,-87r26,0r0,87",
			w: 94
		},
		
		"(": {
			d: "63,-116v0,73,14,133,63,157r-8,15v-91,-22,-108,-227,-50,-295v14,-16,32,-31,50,-38r7,13v-46,23,-62,74,-62,148",
			w: 117,
			k: {
				"9": -4,
				"7": -7,
				"5": -4,
				"3": -4
			}
		},
		
		")": {
			d: "-1,-278v91,22,108,227,50,295v-14,16,-32,31,-50,38r-7,-14v46,-23,62,-73,62,-147v0,-73,-14,-133,-63,-158",
			w: 117
		},
		
		"*": {
			d: "154,-198r-51,18r32,42r-18,14r-32,-44r-31,44r-18,-14r31,-42r-51,-18r7,-21r51,18r0,-54r22,0r0,54r51,-18",
			w: 169
		},
		
		"+": {
			d: "174,-77r-64,0r0,64r-26,0r0,-64r-64,0r0,-26r64,0r0,-64r26,0r0,64r64,0r0,26",
			w: 193,
			k: {
				"7": 18
			}
		},
		
		",": {
			d: "49,-45v32,1,35,50,15,72v-8,8,-20,18,-31,24r-10,-15v14,-7,23,-18,25,-32v-15,1,-23,-9,-24,-23v0,-14,11,-26,25,-26",
			w: 104
		},
		
		"-": {
			d: "89,-82r-69,0r0,-28r69,0r0,28",
			w: 108,
			k: {
				z: 4,
				y: 4,
				x: 7,
				v: 2,
				s: 2,
				a: 2,
				Z: 7,
				Y: 18,
				X: 7,
				W: 5,
				V: 11,
				T: 18,
				S: 18,
				"7": 7,
				"4": 4,
				"3": 7,
				"2": 7
			}
		},
		
		".": {
			d: "75,-20v0,14,-11,25,-24,25v-14,0,-24,-11,-24,-25v0,-13,11,-24,24,-24v14,0,24,11,24,24",
			w: 102
		},
		
		"/": {
			d: "140,-273r-93,326r-24,0r94,-326r23,0",
			w: 163
		},
		
		"0": {
			d: "185,-91v0,58,-32,94,-81,94v-51,0,-81,-37,-81,-96v0,-58,32,-94,81,-94v51,0,81,37,81,96xm155,-87v0,-54,-16,-76,-52,-76v-33,0,-50,20,-50,65v0,54,16,77,52,77v33,0,50,-21,50,-66",
			w: 208,
			k: {
				"9": 4,
				"7": 7,
				"4": 7,
				"3": 11,
				"2": 4,
				".": 4,
				",": 4
			}
		},
		
		"1": {
			d: "136,0r-94,0r0,-23r33,0r0,-125v-15,10,-32,16,-49,23r-6,-16r61,-42r22,0r0,160r33,0r0,23",
			w: 156,
			k: {
				"9": 4,
				"7": 7,
				"3": 7
			}
		},
		
		"2": {
			d: "172,-23r-6,23r-138,0v-4,-30,6,-24,28,-44v23,-21,74,-52,74,-87v0,-20,-14,-31,-38,-31v-17,0,-32,5,-57,23r-12,-14v27,-23,50,-33,76,-33v37,0,64,18,64,51v10,34,-63,85,-105,113v34,-2,78,-1,114,-1",
			w: 198,
			k: {
				"9": 7,
				"7": 4,
				"5": 4,
				"4": 2,
				"3": 7,
				"1": 4
			}
		},
		
		"3": {
			d: "57,-85v30,3,78,-4,72,-38v-8,-47,-60,-51,-100,-18r-13,-15v42,-43,142,-40,143,29v0,26,-16,46,-43,54v31,7,50,29,50,55v-2,60,-76,92,-140,82r-7,-19v0,0,9,1,23,1v68,0,92,-37,92,-67v0,-40,-34,-46,-77,-44r0,-20",
			w: 189,
			k: {
				"3": 7
			}
		},
		
		"4": {
			d: "180,0r-30,0v2,17,1,43,1,63r-28,9r0,-72r-107,0r0,-22r83,-162r31,0r-84,163v21,-2,54,-1,77,-1r6,-94r22,-6r-1,100r30,-1r0,23",
			w: 196,
			k: {
				"9": 4,
				"6": 4,
				"5": 2,
				"3": 7,
				"1": 4,
				")": -4,
				"%": 7
			}
		},
		
		"5": {
			d: "157,-19v0,59,-66,98,-130,82r-5,-22v47,18,104,-15,104,-60v0,-49,-63,-55,-99,-39r12,-121r106,0r-4,23r-77,0r-6,70v50,-6,99,13,99,67",
			w: 180,
			k: {
				"9": 4,
				"7": 4,
				"6": 4,
				"3": 4,
				"2": 4,
				"1": 4
			}
		},
		
		"6": {
			d: "184,-72v0,45,-35,78,-80,78v-89,0,-101,-136,-46,-192v32,-32,62,-53,97,-63r7,18v-54,14,-95,62,-103,106v44,-37,125,-16,125,53xm57,-84v0,39,13,68,47,68v29,0,47,-22,47,-56v0,-33,-20,-50,-45,-50v-18,4,-49,2,-49,38",
			w: 207,
			k: {
				"9": 7,
				"7": 7,
				"4": 4,
				"3": 7,
				"2": 4,
				"1": 4,
				".": 4
			}
		},
		
		"7": {
			d: "169,-179r-7,28v-43,61,-84,128,-104,208r-34,9v17,-79,77,-177,117,-222r-128,0r6,-23r150,0",
			w: 181,
			k: {
				"9": 4,
				"8": 2,
				"6": 4,
				"5": 4,
				"4": 18,
				"2": 4,
				"0": 4,
				".": 36,
				"-": 7,
				",": 43,
				"+": 7,
				")": 4
			}
		},
		
		"8": {
			d: "185,-65v0,37,-32,70,-82,70v-51,0,-80,-29,-80,-65v0,-36,28,-55,51,-64v-67,-28,-52,-115,34,-115v41,0,69,21,69,54v0,31,-24,47,-49,58v30,13,57,24,57,62xm105,-15v42,0,64,-40,42,-70v-7,-10,-23,-16,-55,-30v-22,12,-40,24,-40,53v0,28,21,47,53,47xm149,-183v0,-22,-17,-36,-45,-36v-27,0,-45,15,-45,37v0,14,7,30,49,47v29,-15,41,-31,41,-48",
			w: 208,
			k: {
				"9": 2,
				"7": 4,
				"5": 2,
				"3": 7,
				"2": 2,
				".": 4
			}
		},
		
		"9": {
			d: "183,-97v0,40,-17,83,-45,115v-28,33,-75,54,-104,57r-14,-18v49,-6,113,-56,123,-101v-46,34,-118,4,-118,-60v0,-46,36,-81,81,-81v43,0,77,33,77,88xm149,-70v11,-42,-8,-92,-45,-92v-28,0,-47,23,-47,57v-1,60,57,70,92,35",
			w: 206,
			k: {
				"9": 4,
				"7": 4,
				"3": 7,
				"2": 4,
				",": 4,
				"%": 7
			}
		},
		
		":": {
			d: "79,-20v0,14,-11,24,-25,24v-13,0,-23,-11,-23,-24v0,-14,10,-24,24,-24v13,0,24,11,24,24xm79,-134v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-24v0,-14,10,-25,24,-25v13,0,24,11,24,24",
			w: 109
		},
		
		";": {
			d: "56,-45v33,1,36,50,15,72v-8,8,-19,18,-30,24r-10,-15v14,-7,22,-18,24,-32v-15,1,-23,-9,-24,-23v0,-14,11,-26,25,-26xm79,-134v0,14,-11,25,-24,25v-13,0,-24,-12,-24,-26v0,-13,11,-23,24,-23v13,0,24,11,24,24",
			w: 115
		},
		
		"<": {
			d: "102,-31r-24,16r-69,-93r69,-93r24,16r-58,77",
			w: 117
		},
		
		"=": {
			d: "208,-125r-188,0r0,-24r188,0r0,24xm208,-69r-188,0r0,-24r188,0r0,24",
			w: 227
		},
		
		">": {
			d: "109,-108r-69,93r-24,-16r58,-77r-58,-77r24,-16",
			w: 118
		},
		
		"?": {
			d: "138,-197v-5,67,-70,49,-54,117r-24,0v-7,-28,-4,-53,17,-72v14,-13,32,-19,32,-44v0,-41,-54,-34,-81,-13r-12,-20v37,-31,127,-31,122,32xm99,-20v0,14,-11,25,-24,25v-13,0,-25,-11,-25,-25v0,-13,12,-24,25,-24v13,0,24,11,24,24",
			w: 157
		},
		
		"@": {
			d: "308,-100v0,64,-37,105,-78,105v-33,0,-40,-23,-37,-42v-20,41,-94,62,-98,-14v-4,-74,66,-139,139,-101r-22,99v-6,29,-1,39,19,39v29,0,52,-38,52,-86v0,-59,-46,-106,-114,-106v-73,0,-120,65,-120,133v0,85,81,132,163,106r4,19v-96,26,-194,-20,-193,-125v0,-85,62,-152,146,-152v78,0,139,49,139,125xm206,-139v-54,-23,-86,44,-86,90v0,21,7,28,22,28v17,0,42,-16,49,-50",
			w: 331,
			k: {
				y: 7,
				x: 4,
				v: 4,
				s: 7
			}
		},
		
		A: {
			d: "206,0r-33,0r-24,-76r-92,0r-24,76r-29,0r82,-247r39,0xm142,-100r-38,-121r-39,121r77,0",
			w: 209,
			k: {
				y: 2,
				v: 2,
				l: 2,
				c: 2,
				Y: 11,
				W: 4,
				V: 11,
				U: 4,
				T: 22,
				Q: 4,
				O: 4,
				C: 2,
				".": -4,
				",": -4
			}
		},
		
		B: {
			d: "141,-131v35,4,58,31,55,63v-4,49,-27,72,-98,68r-64,0r0,-247v85,-3,151,-3,151,62v0,26,-16,45,-44,54xm165,-70v0,-50,-49,-48,-102,-46r0,92v50,1,102,5,102,-46xm63,-141v46,1,90,5,90,-40v0,-42,-43,-44,-90,-41r0,81",
			w: 219,
			k: {
				y: 4,
				x: 4,
				v: 2,
				u: 2,
				s: 4,
				q: 2,
				p: 2,
				g: 4,
				e: 4,
				a: 4,
				Z: 7,
				Y: 7,
				W: 4,
				V: 7,
				T: 14,
				A: 2
			}
		},
		
		C: {
			d: "55,-118v0,82,64,123,123,82r16,20v-20,13,-45,20,-69,20v-62,1,-102,-60,-102,-127v0,-100,90,-161,166,-107r-15,19v-63,-43,-119,10,-119,93",
			w: 206,
			k: {
				y: 14,
				w: 7,
				v: 11,
				u: 7,
				t: 4,
				s: 4,
				r: 5,
				q: 11,
				o: 11,
				n: 4,
				m: 4,
				l: 7,
				j: 4,
				i: 5,
				g: 7,
				e: 11,
				d: 7,
				c: 4,
				b: 4,
				a: 7,
				U: 4,
				S: 4,
				Q: 14,
				O: 14,
				G: 14,
				E: 4,
				C: 14,
				B: 4,
				"-": 22,
				" ": 7
			}
		},
		
		D: {
			d: "84,-247v85,-5,119,44,120,124v2,106,-63,133,-170,123r0,-247r50,0xm156,-50v34,-62,20,-183,-63,-173r-29,0r0,199v41,0,75,5,92,-26",
			w: 227,
			k: {
				z: 7,
				y: 2,
				x: 5,
				u: 2,
				s: 4,
				e: 2,
				Z: 7,
				Y: 7,
				X: 7,
				W: 4,
				V: 7,
				T: 11,
				S: 7,
				A: 4,
				".": 7,
				",": 7
			}
		},
		
		E: {
			d: "173,0r-139,0r0,-247r135,0r-4,25r-101,0r0,81r85,0r0,25r-85,0r0,90r109,0r0,26",
			w: 187,
			k: {
				y: 4,
				w: 2,
				v: 5,
				u: 2,
				t: 2,
				s: 2,
				q: 4,
				o: 4,
				g: 4,
				e: 4,
				d: 4,
				c: 2,
				a: 2,
				S: 4,
				Q: 7,
				O: 7,
				G: 7,
				C: 7,
				"-": 4,
				" ": 4
			}
		},
		
		F: {
			d: "164,-247r-5,25r-95,0r0,81r79,0r0,24r-79,0r0,117r-30,0r0,-247r130,0",
			w: 158,
			k: {
				z: 2,
				x: 4,
				u: 4,
				s: 2,
				q: 4,
				p: 4,
				o: 4,
				n: 2,
				m: 2,
				g: 2,
				e: 4,
				d: 4,
				c: 4,
				a: 4,
				Y: 4,
				V: -4,
				T: 7,
				A: 4,
				".": 22,
				",": 22,
				" ": 4
			}
		},
		
		G: {
			d: "55,-122v0,79,51,120,117,92r0,-75r-50,0r-6,-25r83,0r0,115v-81,50,-187,-4,-176,-108v-11,-102,97,-163,171,-102r-14,18v-20,-14,-34,-19,-53,-19v-52,-2,-72,49,-72,104",
			w: 230,
			k: {
				y: 4,
				w: 2,
				v: 4,
				a: 2,
				Y: 7,
				W: 7,
				V: 4,
				T: 7
			}
		},
		
		H: {
			d: "197,0r-30,0r0,-120r-104,0r0,120r-29,0r0,-247r29,0r0,103r104,0r0,-103r30,0r0,247",
			w: 230
		},
		
		I: {
			d: "63,0r-29,0r0,-247r29,0r0,247"
		},
		
		J: {
			d: "1,28v28,-15,36,-21,36,-69r0,-206r29,0r0,205v2,59,-14,71,-51,88",
			w: 100
		},
		
		K: {
			d: "198,-247r-99,116r99,131r-38,0r-94,-131r95,-116r37,0xm64,0r-30,0r0,-247r30,0r0,247",
			w: 200,
			k: {
				"\u00fc": 7,
				"\u00fb": 7,
				"\u00fa": 7,
				"\u00f9": 7,
				"\u00f6": 7,
				"\u00f5": 7,
				"\u00f4": 7,
				"\u00f3": 7,
				"\u00f2": 7,
				"\u00eb": 7,
				"\u00ea": 7,
				"\u00e9": 7,
				"\u00e8": 7,
				"\u00e5": 7,
				"\u00e4": 7,
				"\u00e3": 7,
				"\u00e2": 7,
				"\u00e1": 7,
				"\u00e0": 7,
				y: 5,
				w: 2,
				v: 7,
				u: 7,
				t: 2,
				s: 2,
				q: 7,
				p: 2,
				o: 7,
				g: 4,
				e: 11,
				d: 7,
				c: 7,
				a: 7,
				Y: 14,
				S: 7,
				Q: 11,
				O: 11,
				G: 7,
				C: 7,
				"-": 18,
				" ": 7
			}
		},
		
		L: {
			d: "161,-25r-4,25r-123,0r0,-247r30,0r0,222r97,0",
			w: 166,
			k: {
				"\u00fc": 2,
				"\u00fb": 2,
				"\u00fa": 2,
				"\u00f9": 2,
				"\u00f6": 4,
				"\u00f5": 4,
				"\u00f4": 4,
				"\u00f3": 4,
				"\u00f2": 4,
				"\u00eb": 4,
				"\u00ea": 4,
				"\u00e9": 4,
				"\u00e8": 4,
				y: 11,
				w: 7,
				v: 11,
				u: 2,
				q: 4,
				o: 4,
				e: 4,
				d: 2,
				c: 2,
				Y: 32,
				W: 18,
				V: 29,
				U: 7,
				T: 29,
				Q: 14,
				O: 14,
				G: 14,
				C: 14,
				"-": 18,
				" ": 7
			}
		},
		
		M: {
			d: "265,0r-30,0r-16,-223r-62,223r-26,0r-61,-222r-16,222r-29,0r22,-247r43,0r55,204v13,-63,38,-141,55,-204r44,0",
			w: 290,
			k: {
				y: 2,
				w: 2,
				v: 2,
				u: 2,
				e: 2,
				d: 2,
				c: 2,
				b: 2,
				a: 2,
				Y: 4,
				W: 4,
				V: 4,
				T: 7,
				S: 4
			}
		},
		
		N: {
			d: "198,0r-31,0r-79,-151v-16,-30,-28,-60,-28,-60v4,44,4,155,5,211r-31,0r0,-247r34,0r82,158v12,23,23,49,24,52v-5,-40,-5,-154,-5,-210r29,0r0,247",
			w: 232
		},
		
		O: {
			d: "123,5v-68,0,-99,-56,-100,-130v0,-78,38,-126,99,-126v43,0,65,22,77,40v15,23,23,51,23,91v1,74,-33,125,-99,125xm125,-18v50,0,64,-32,64,-97v0,-69,-8,-113,-67,-113v-50,0,-66,39,-66,97v0,67,13,113,69,113",
			w: 245,
			k: {
				x: 4,
				r: 2,
				l: 2,
				k: 2,
				h: 2,
				g: 2,
				f: 2,
				e: 2,
				d: 2,
				b: 2,
				a: 2,
				Z: 7,
				Y: 7,
				W: 4,
				V: 7,
				T: 11,
				S: 4,
				A: 4,
				".": 11,
				",": 7
			}
		},
		
		P: {
			d: "103,-247v56,-3,83,28,85,71v2,65,-53,86,-125,78r0,98r-29,0r0,-247r69,0xm63,-122v51,4,93,-3,93,-49v0,-49,-40,-54,-93,-51r0,100",
			w: 197,
			k: {
				y: -4,
				w: -4,
				v: -4,
				u: 4,
				t: -4,
				s: 4,
				q: 4,
				p: 2,
				o: 4,
				g: 4,
				e: 4,
				d: 4,
				c: 4,
				a: 4,
				Z: 7,
				T: 7,
				S: 4,
				A: 14,
				".": 43,
				",": 43
			}
		},
		
		Q: {
			d: "122,-251v122,0,127,201,48,244v24,8,45,34,81,25v-7,14,-6,29,-31,27v-40,-5,-56,-36,-99,-40v-70,-6,-98,-56,-98,-130v0,-78,38,-126,99,-126xm125,-18v50,0,64,-34,64,-97v0,-69,-5,-113,-67,-113v-49,0,-67,38,-66,97v0,67,12,113,69,113",
			w: 245,
			k: {
				Z: 4,
				Y: 7,
				W: 4,
				V: 7,
				T: 11,
				S: 4,
				A: 4,
				".": 7,
				",": -4
			}
		},
		
		R: {
			d: "92,-247v62,2,87,15,87,68v0,42,-28,68,-70,67v36,34,53,73,82,112r-37,0v-7,-16,-30,-54,-63,-96v-10,-12,-15,-16,-27,-16r0,112r-30,0r0,-247r58,0xm64,-130v49,3,85,-4,84,-50v-1,-37,-40,-46,-84,-42r0,92",
			w: 200,
			k: {
				u: 4,
				s: 2,
				q: 4,
				o: 4,
				g: 4,
				e: 4,
				d: 2,
				c: 2,
				a: 2,
				W: 4,
				T: 7,
				"-": 4
			}
		},
		
		S: {
			d: "33,-41v37,33,122,32,123,-25v1,-65,-129,-36,-129,-115v0,-73,103,-90,155,-48r-13,22v-37,-30,-107,-31,-110,19v-3,48,90,45,113,75v41,53,-5,118,-73,118v-30,0,-55,-8,-79,-23",
			w: 208,
			k: {
				y: 5,
				x: 2,
				v: 4,
				u: 2,
				p: 2,
				Z: 7,
				Y: 4,
				X: 4,
				W: 4,
				V: 7,
				T: 4,
				S: 7,
				Q: 4,
				P: 2,
				M: 4,
				E: 4,
				A: 7,
				" ": 7
			}
		},
		
		T: {
			d: "172,-247r-1,25r-67,0r0,222r-29,0r0,-222r-66,0r0,-25r163,0",
			w: 167,
			k: {
				"\u00fc": 14,
				"\u00fb": 14,
				"\u00fa": 14,
				"\u00f9": 14,
				"\u00f8": 18,
				"\u00f6": 14,
				"\u00f5": 11,
				"\u00f4": 11,
				"\u00f3": 22,
				"\u00f2": 7,
				"\u00eb": 14,
				"\u00ea": 7,
				"\u00e9": 18,
				"\u00e8": 7,
				"\u00e6": 18,
				"\u00e5": 22,
				"\u00e4": 11,
				"\u00e3": 7,
				"\u00e2": 7,
				"\u00e1": 22,
				"\u00e0": 7,
				"\u00d6": 4,
				"\u00d5": 4,
				"\u00d4": 7,
				"\u00d2": 7,
				"\u00c5": 14,
				"\u00c4": 14,
				"\u00c3": 14,
				"\u00c2": 14,
				"\u00c1": 14,
				"\u00c0": 14,
				z: 11,
				y: 14,
				x: 11,
				w: 11,
				v: 11,
				u: 14,
				s: 20,
				r: 14,
				q: 18,
				p: 11,
				o: 18,
				n: 11,
				m: 11,
				g: 14,
				e: 18,
				d: 18,
				c: 18,
				a: 22,
				Y: 7,
				W: -4,
				V: 7,
				T: 4,
				S: 4,
				Q: 4,
				O: 4,
				G: 4,
				D: -4,
				C: 4,
				A: 14,
				".": 14,
				"-": 11,
				",": 22
			}
		},
		
		U: {
			d: "114,-21v38,2,53,-17,53,-54r0,-172r29,0r0,176v1,58,-29,73,-83,75v-53,2,-80,-26,-81,-74r0,-177r30,0r0,166v1,41,5,58,52,60",
			w: 228,
			k: {
				s: 4,
				q: 2,
				p: 2,
				o: 2,
				g: 4,
				e: 2,
				d: 2,
				c: 2,
				a: 2,
				A: 4
			}
		},
		
		V: {
			d: "202,-247r-84,247r-29,0r-84,-247r32,0r53,159v7,22,13,48,14,55r68,-214r30,0",
			w: 207,
			k: {
				"\u00fc": 14,
				"\u00fb": 14,
				"\u00fa": 14,
				"\u00f9": 14,
				"\u00f6": 18,
				"\u00f5": 18,
				"\u00f4": 18,
				"\u00f3": 18,
				"\u00f2": 18,
				"\u00eb": 18,
				"\u00ea": 18,
				"\u00e9": 18,
				"\u00e8": 18,
				"\u00e5": 18,
				"\u00e4": 18,
				"\u00e3": 18,
				"\u00e2": 18,
				"\u00e1": 18,
				"\u00e0": 18,
				"\u00d6": 7,
				"\u00d5": 7,
				"\u00d4": 7,
				"\u00d3": 7,
				"\u00d2": 7,
				"\u00c5": 11,
				"\u00c4": 11,
				"\u00c3": 11,
				"\u00c2": 11,
				"\u00c1": 11,
				"\u00c0": 11,
				z: 7,
				y: 4,
				x: 7,
				u: 14,
				s: 18,
				r: 11,
				q: 18,
				p: 11,
				o: 18,
				n: 11,
				m: 11,
				j: 4,
				i: 4,
				g: 18,
				f: 4,
				e: 18,
				d: 18,
				c: 18,
				a: 18,
				Z: 4,
				S: 7,
				Q: 7,
				O: 7,
				M: 4,
				C: 7,
				A: 11,
				".": 36,
				"-": 11,
				",": 36,
				" ": 7
			}
		},
		
		W: {
			d: "287,-247r-57,247r-38,0r-44,-207v-7,51,-30,151,-43,207r-38,0r-58,-247r32,0r31,144v7,31,12,71,13,75r47,-219r34,0r46,219r45,-219r30,0",
			w: 295,
			k: {
				"\u00fc": 7,
				"\u00fb": 7,
				"\u00fa": 7,
				"\u00f9": 7,
				"\u00f6": 11,
				"\u00f5": 11,
				"\u00f4": 11,
				"\u00f3": 11,
				"\u00f2": 11,
				"\u00eb": 11,
				"\u00ea": 11,
				"\u00e9": 11,
				"\u00e8": 11,
				"\u00e5": 11,
				"\u00e4": 11,
				"\u00e3": 11,
				"\u00e2": 11,
				"\u00e1": 11,
				"\u00e0": 11,
				"\u00d6": 4,
				"\u00d5": 4,
				"\u00d4": 4,
				"\u00d3": 4,
				"\u00d2": 4,
				"\u00c5": 4,
				"\u00c4": 4,
				"\u00c3": 4,
				"\u00c2": 4,
				"\u00c1": 4,
				"\u00c0": 4,
				z: 5,
				y: 4,
				u: 7,
				s: 11,
				r: 5,
				q: 11,
				p: 7,
				o: 11,
				n: 5,
				m: 5,
				j: 2,
				i: 4,
				g: 11,
				e: 11,
				d: 11,
				c: 11,
				a: 11,
				Z: 7,
				S: 4,
				Q: 4,
				O: 4,
				M: 4,
				G: 4,
				C: 7,
				A: 4,
				".": 25,
				"-": 5,
				",": 18,
				" ": 4
			}
		},
		
		X: {
			d: "193,0r-36,0r-61,-113r-58,113r-34,0r73,-132r-66,-115r35,0r49,91r48,-91r34,0r-62,112",
			w: 196,
			k: {
				y: 7,
				w: 4,
				v: 7,
				u: 4,
				t: 4,
				q: 4,
				p: 4,
				o: 4,
				j: 4,
				i: 4,
				g: 4,
				e: 4,
				d: 4,
				c: 4,
				a: 4,
				C: 7,
				".": -4,
				"-": 7,
				" ": 4
			}
		},
		
		Y: {
			d: "189,-247r-81,151r0,96r-30,0r0,-98r-80,-149r37,0r59,122r61,-122r34,0",
			w: 186,
			k: {
				"\u00fc": 14,
				"\u00fb": 14,
				"\u00fa": 14,
				"\u00f9": 14,
				"\u00f6": 22,
				"\u00f5": 22,
				"\u00f4": 22,
				"\u00f3": 22,
				"\u00f2": 22,
				"\u00eb": 22,
				"\u00ea": 22,
				"\u00e9": 18,
				"\u00e8": 18,
				"\u00e5": 18,
				"\u00e4": 18,
				"\u00e3": 18,
				"\u00e2": 18,
				"\u00e1": 18,
				"\u00e0": 18,
				"\u00d6": 11,
				"\u00d5": 11,
				"\u00d4": 11,
				"\u00d3": 11,
				"\u00c5": 11,
				"\u00c4": 11,
				"\u00c3": 11,
				"\u00c2": 11,
				"\u00c1": 11,
				"\u00c0": 11,
				z: 7,
				x: 7,
				w: 4,
				v: 4,
				u: 14,
				s: 22,
				r: 11,
				q: 22,
				p: 14,
				o: 22,
				n: 11,
				m: 11,
				g: 22,
				e: 22,
				d: 22,
				c: 22,
				a: 22,
				S: 7,
				Q: 7,
				O: 11,
				M: 4,
				G: 7,
				C: 7,
				A: 11,
				".": 36,
				"-": 18,
				",": 36,
				" ": 4
			}
		},
		
		Z: {
			d: "170,-25r-7,25r-147,0r0,-23r122,-199r-118,0r8,-25r141,0r0,25r-118,197r119,0",
			w: 186,
			k: {
				y: 11,
				w: 4,
				v: 7,
				u: 4,
				t: 4,
				s: 4,
				r: 4,
				q: 7,
				o: 11,
				n: 4,
				m: 4,
				l: 4,
				j: 4,
				i: 4,
				g: 7,
				e: 11,
				d: 7,
				c: 7,
				a: 7,
				U: 4,
				S: 4,
				Q: 7,
				O: 7,
				G: 7,
				C: 11,
				"-": 11,
				" ": 4
			}
		},
		
		"[": {
			d: "94,56r-60,0r0,-320r60,0r0,22r-34,0r0,277r34,0r0,21",
			w: 102
		},
		
		"\\": {
			d: "140,6r-23,9r-108,-276r23,-9",
			w: 149
		},
		
		"]": {
			d: "68,56r-59,0r0,-21r33,0r0,-277r-33,0r0,-22r59,0r0,320",
			w: 102
		},
		
		"^": {
			d: "206,-99r-27,0r-65,-126r-64,126r-27,0r81,-156r21,0",
			w: 228
		},
		
		_: {
			d: "182,45r-180,0r0,-18r180,0r0,18",
			w: 183
		},
		
		"`": {
			d: "110,-220r-10,17r-80,-36r15,-28",
			w: 129
		},
		
		a: {
			d: "28,-160v48,-35,140,-39,129,44v2,34,-11,95,13,103r-14,20v-12,-4,-22,-13,-25,-26v-17,17,-31,24,-52,24v-44,0,-57,-27,-57,-51v-1,-44,43,-68,107,-65v13,-67,-60,-53,-87,-29xm129,-91v-44,-5,-81,11,-76,42v-2,47,63,38,74,5",
			w: 190,
			k: {
				y: 2,
				w: 2,
				s: 4,
				d: 2
			}
		},
		
		b: {
			d: "183,-92v0,84,-74,124,-121,73v-1,8,-1,12,-5,19r-28,0v10,-68,7,-185,1,-258r28,-5v4,9,5,79,4,104v50,-52,121,-15,121,67xm106,-21v37,0,40,-24,45,-73v7,-69,-61,-80,-89,-40r0,92v9,12,27,21,44,21",
			w: 205,
			k: {
				z: 4,
				y: 4,
				x: 7,
				w: 2,
				v: 2,
				u: 2,
				s: 4,
				p: 2,
				l: 4,
				j: 2,
				i: 2,
				g: 2,
				a: 2,
				".": 4
			}
		},
		
		c: {
			d: "132,-145v-42,-36,-86,3,-78,64v-5,62,52,82,83,43r16,18v-50,54,-130,12,-130,-67v0,-83,73,-121,125,-78",
			w: 168,
			k: {
				x: 2,
				u: 2,
				s: 4,
				r: 2,
				q: 7,
				p: 2,
				o: 5,
				n: 4,
				m: 4,
				l: 2,
				k: 9,
				j: 4,
				i: 4,
				h: 9,
				g: 5,
				f: 4,
				e: 7,
				d: 7,
				c: 7,
				b: 5,
				a: 5,
				"@": 7,
				".": 2,
				"-": 4,
				" ": 4
			}
		},
		
		d: {
			d: "23,-88v-9,-72,74,-126,121,-72v-2,-24,-1,-74,-1,-103r28,5v3,81,-7,191,6,258v-19,-2,-35,8,-33,-18v-47,48,-129,10,-121,-70xm98,-21v18,1,41,-15,45,-25r0,-95v-9,-13,-23,-18,-44,-18v-33,0,-45,31,-45,70v0,41,10,66,44,68",
			w: 205,
			k: {
				s: 2,
				p: 2,
				d: 2,
				a: 2
			}
		},
		
		e: {
			d: "99,-184v51,0,71,32,69,99r-112,0v-9,64,59,84,97,49r10,18v-55,47,-140,15,-140,-73v0,-52,29,-93,76,-93xm138,-106v0,-36,-10,-56,-41,-56v-26,0,-40,19,-41,56r82,0",
			w: 187,
			k: {
				x: 2,
				s: 2,
				g: 2,
				b: 2,
				a: 4
			}
		},
		
		f: {
			d: "34,-179v-11,-71,41,-100,91,-71r-10,20v-19,-14,-54,-14,-51,23r0,28r49,0r-8,21r-41,0r0,158r-30,0r0,-158r-17,0r0,-21r17,0",
			w: 109,
			k: {
				y: -7,
				x: -4,
				w: -7,
				v: -7,
				u: 2,
				t: -2,
				s: 2,
				q: 2,
				o: 2,
				n: 2,
				m: 2,
				g: 4,
				e: 2,
				d: 4,
				c: 2,
				a: 5,
				"@": 4,
				".": 7,
				"-": 4,
				",": 4,
				" ": 4
			}
		},
		
		g: {
			d: "136,14v0,-55,-104,-1,-106,-54v0,-14,8,-23,32,-31v-24,-8,-40,-27,-40,-51v0,-36,27,-61,66,-61v35,1,52,21,80,2r17,18v-14,10,-26,12,-42,8v26,37,-1,92,-50,88v-24,9,-32,15,-32,21v1,13,28,9,43,9v39,0,63,18,63,47v0,39,-27,57,-71,57v-65,0,-87,-23,-74,-65r29,-2v-16,27,11,45,42,45v28,0,43,-9,43,-31xm121,-124v0,-24,-10,-36,-34,-36v-22,0,-33,12,-33,37v0,23,11,36,34,36v22,0,33,-13,33,-37",
			w: 185,
			k: {
				z: -2,
				y: -4,
				x: -2,
				w: -4,
				v: -4,
				t: -4,
				s: 2,
				q: 4,
				o: 4,
				j: -2,
				g: 2,
				e: 4,
				c: 2,
				b: 2,
				a: 4,
				"@": 4,
				"-": 2
			}
		},
		
		h: {
			d: "61,-154v29,-38,109,-44,109,25r0,129r-28,0r0,-124v0,-54,-59,-35,-80,-3r0,127r-28,0r0,-221v0,-23,-4,-37,-4,-37r28,-5v4,8,5,89,3,109",
			w: 204,
			k: {
				y: 2,
				x: 2,
				w: 2,
				v: 2,
				l: 4,
				g: 2,
				a: 4
			}
		},
		
		i: {
			d: "63,0r-29,0r0,-179r29,-4r0,183xm71,-235v0,12,-10,22,-22,22v-12,0,-22,-9,-22,-21v0,-12,10,-23,22,-23v12,0,22,10,22,22",
			k: {
				"\u00ee": -9,
				y: 4,
				x: 4,
				s: 4,
				q: 2,
				l: 2,
				a: 2
			}
		},
		
		j: {
			d: "63,-184v-3,72,6,156,-5,220v-7,17,-20,27,-37,35r-14,-18v25,-11,27,-28,27,-59r0,-172xm71,-235v0,12,-10,22,-22,22v-12,0,-22,-10,-22,-22v0,-12,10,-22,22,-22v12,0,22,10,22,22",
			k: {
				x: 2,
				v: 4,
				s: 4,
				q: 4,
				o: 3,
				g: 2,
				e: 2,
				c: 2,
				a: 4
			}
		},
		
		k: {
			d: "62,0r-28,0r0,-221v0,-23,-4,-37,-4,-37r28,-5v8,71,2,182,4,263xm183,0r-37,0r-83,-102r69,-77r35,0r-71,77",
			w: 185,
			k: {
				"\u00f6": 7,
				"\u00e4": 5,
				y: 4,
				w: 2,
				v: 2,
				u: 5,
				s: 4,
				r: 4,
				q: 7,
				o: 7,
				l: 5,
				j: 4,
				i: 4,
				h: 4,
				g: 4,
				e: 7,
				d: 7,
				c: 7,
				b: 4,
				a: 5,
				"@": 7,
				"-": 11,
				" ": 11
			}
		},
		
		l: {
			d: "82,0v-24,10,-48,0,-48,-30r0,-190v0,-23,-4,-36,-4,-36r28,-6v10,54,3,159,5,226v0,16,4,20,13,17",
			w: 96,
			k: {
				s: 2,
				q: 2,
				l: 4,
				j: 4,
				g: 4,
				e: 2,
				d: 2,
				b: 2,
				a: 4,
				".": -2,
				" ": 4
			}
		},
		
		m: {
			d: "130,-127v-1,-46,-43,-34,-69,-7r0,134r-27,0v-2,-52,5,-139,-6,-177r27,-7v0,0,7,14,7,27v23,-29,79,-41,94,3v31,-41,102,-42,102,19r0,135r-29,0r0,-132v-6,-45,-47,-26,-70,1r0,131r-29,0r0,-127",
			w: 292,
			k: {
				y: 2,
				w: 2,
				v: 2,
				l: 2,
				g: 2,
				a: 4
			}
		},
		
		n: {
			d: "118,-183v26,0,49,17,48,47r0,136r-28,0r0,-121v3,-58,-53,-38,-76,-13r0,134r-28,0v-2,-52,6,-140,-7,-176r28,-8v0,0,6,13,6,28v19,-19,38,-27,57,-27",
			w: 200,
			k: {
				z: 2,
				y: 2,
				x: 2,
				w: 2,
				v: 2,
				s: 4,
				l: 3,
				g: 2,
				a: 4
			}
		},
		
		o: {
			d: "98,-185v56,0,78,40,78,98v0,60,-32,92,-77,92v-49,0,-77,-37,-77,-96v0,-58,29,-94,76,-94xm100,-19v33,0,44,-27,44,-66v0,-46,-11,-77,-46,-77v-35,0,-47,27,-46,67v0,46,8,76,48,76",
			w: 197,
			k: {
				z: 2,
				y: 2,
				x: 7,
				w: 2,
				v: 4,
				s: 2,
				l: 2,
				b: 2,
				a: 2,
				".": 2,
				",": 2
			}
		},
		
		p: {
			d: "61,-157v47,-56,131,-14,120,67v8,79,-67,123,-119,74r0,85r-28,6r0,-215v0,-27,-4,-39,-4,-39v21,1,35,-22,31,22xm62,-42v34,44,96,21,90,-44v-3,-41,-8,-72,-42,-72v-18,0,-34,9,-48,26r0,90",
			w: 204,
			k: {
				z: 2,
				y: 4,
				x: 7,
				w: 2,
				v: 2,
				u: 2,
				s: 5,
				p: 2,
				l: 2,
				j: 2,
				g: 2,
				a: 2,
				".": 4,
				",": 2
			}
		},
		
		q: {
			d: "23,-84v-10,-87,71,-131,122,-75v0,-5,1,-16,3,-20r28,0v-10,59,-3,173,-5,246r-27,6r0,-93v-46,50,-129,12,-121,-64xm53,-91v6,56,8,70,47,70v18,0,35,-10,44,-28r0,-85v-30,-44,-98,-26,-91,43",
			w: 204,
			k: {
				s: 4,
				o: 2,
				b: 2
			}
		},
		
		r: {
			d: "111,-152v-24,-7,-49,12,-49,40r0,112r-28,0v-2,-52,5,-138,-6,-176r28,-8v0,0,7,14,6,29v16,-20,36,-35,60,-28",
			w: 116,
			k: {
				z: -2,
				y: -5,
				x: -4,
				w: -4,
				v: -7,
				t: -5,
				s: 2,
				q: 2,
				o: 2,
				g: 2,
				f: -4,
				e: 2,
				d: 2,
				c: 2,
				a: 4,
				"@": 4,
				".": 7,
				"-": 4,
				",": 7
			}
		},
		
		s: {
			d: "153,-53v0,63,-89,71,-133,40r11,-20v28,20,89,27,93,-15v2,-24,-29,-29,-52,-34v-30,-6,-45,-24,-45,-49v0,-54,76,-69,118,-41r-10,21v-27,-18,-76,-21,-79,17v-2,22,28,27,49,31v32,7,48,23,48,50",
			w: 173,
			k: {
				z: 4,
				x: 4,
				v: 2,
				u: 2,
				t: 2,
				s: 4,
				q: 2,
				p: 2,
				n: 2,
				l: 2,
				j: 2,
				i: 4,
				c: 2,
				b: 4,
				a: 5,
				"@": 4,
				" ": 4
			}
		},
		
		t: {
			d: "107,-1v-29,15,-73,8,-73,-34r0,-123r-23,0r0,-21r23,0v0,-17,3,-46,3,-46r30,-6v0,0,-4,28,-4,52r45,0r-9,21r-37,0r0,116v-4,28,22,30,41,23",
			w: 115,
			k: {
				x: -4,
				v: -2,
				u: 4,
				q: 4,
				o: 2,
				n: 4,
				g: 4,
				e: 2,
				d: 4,
				c: 4,
				b: 4,
				a: 4,
				"@": 4,
				".": -2,
				"-": 4,
				" ": 4
			}
		},
		
		u: {
			d: "60,-54v-2,54,65,40,79,4r0,-127r27,-5r0,131v0,23,4,31,13,39r-18,20v-12,-10,-17,-17,-20,-29v-26,40,-109,38,-109,-25r0,-132r28,-5r0,129",
			w: 200,
			k: {
				y: 2,
				w: 2,
				v: 2,
				s: 2,
				n: 4,
				l: 2
			}
		},
		
		v: {
			d: "165,-179r-67,181r-28,0r-65,-180r29,-6r51,154v12,-43,35,-104,50,-149r30,0",
			w: 170,
			k: {
				z: 4,
				u: 2,
				s: 4,
				q: 4,
				o: 4,
				n: 2,
				j: 4,
				i: 4,
				g: 4,
				e: 2,
				d: 4,
				c: 2,
				b: 2,
				a: 4,
				"@": 4,
				".": 9,
				"-": 2,
				",": 11,
				" ": 4
			}
		},
		
		w: {
			d: "243,-179r-51,180r-27,0r-42,-145r-40,145r-26,0r-50,-179r28,-6r37,148r38,-143r30,0r40,145r33,-145r30,0",
			w: 250,
			k: {
				u: 2,
				s: 2,
				q: 2,
				o: 2,
				j: 2,
				i: 4,
				g: 4,
				e: 2,
				a: 4,
				".": 5,
				",": 7
			}
		},
		
		x: {
			d: "166,0r-34,0r-48,-76r-49,76r-33,0r67,-99r-56,-80r35,0r36,59r34,-59r33,0r-53,80",
			w: 168,
			k: {
				u: 4,
				s: 2,
				q: 5,
				o: 7,
				n: 2,
				l: 2,
				j: 4,
				i: 4,
				g: 2,
				e: 4,
				d: 5,
				c: 5,
				b: 4,
				a: 4,
				"@": 4,
				"-": 7,
				" ": 7
			}
		},
		
		y: {
			d: "160,-179r-62,185v-12,36,-27,60,-58,68r-8,-19v23,-7,31,-19,41,-55r-11,1v-13,-56,-39,-122,-57,-176r28,-10r37,117v5,17,11,44,11,44r47,-155r32,0",
			w: 165,
			k: {
				u: 2,
				s: 4,
				r: 2,
				q: 4,
				o: 4,
				n: 4,
				j: 4,
				i: 4,
				g: 4,
				e: 2,
				d: 2,
				c: 2,
				b: 2,
				a: 4,
				"@": 7,
				".": 11,
				"-": 4,
				",": 11,
				" ": 4
			}
		},
		
		z: {
			d: "149,-22r-13,22r-120,0r0,-22r98,-135r-90,0r0,-22r119,0r0,23r-93,134r99,0",
			w: 165,
			k: {
				u: 4,
				t: 4,
				s: 2,
				r: 2,
				q: 2,
				p: 2,
				o: 4,
				l: 4,
				k: 2,
				j: 4,
				i: 4,
				g: 4,
				e: 5,
				d: 5,
				c: 4,
				b: 4,
				a: 5,
				"-": 4,
				" ": 4
			}
		},
		
		"{": {
			d: "110,56v-38,3,-63,-5,-63,-45v0,-41,5,-106,-31,-104r0,-21v36,1,31,-64,31,-105v0,-40,26,-48,63,-45r0,22v-52,-11,-37,48,-37,92v0,33,-24,42,-31,47v8,1,31,10,31,46v0,38,-21,101,37,92r0,21",
			w: 119
		},
		
		"|": {
			d: "58,75r-24,0r0,-347r24,0r0,347",
			w: 92
		},
		
		"}": {
			d: "103,-93v-36,-2,-31,63,-31,104v0,40,-25,48,-63,45r0,-21v52,11,37,-48,37,-92v0,-38,24,-43,31,-47v-8,-2,-31,-14,-31,-46v0,-38,21,-101,-37,-92r0,-22v38,-3,63,5,63,45v0,42,-5,106,31,105r0,21",
			w: 119
		},
		
		"~": {
			d: "189,-117v-11,15,-23,32,-45,32v-39,0,-90,-50,-109,1r-12,-18v11,-15,23,-31,45,-31v39,0,91,50,109,-1",
			w: 212
		},
		
		"\u00a0": {
			w: 82
		},
		
		"\u00a1": {
			d: "71,61r-36,5r7,-180r22,0xm75,-166v0,12,-10,22,-22,22v-12,0,-22,-10,-22,-22v0,-13,10,-22,22,-22v12,0,22,10,22,22",
			w: 105
		},
		
		"\u00a2": {
			d: "23,-87v1,-59,24,-86,66,-96r0,-28r20,0r0,28v17,2,28,9,39,18r-16,20v-10,-8,-15,-12,-23,-13r0,139v11,-3,20,-9,28,-19r16,18v-14,14,-27,21,-44,23r0,28r-20,0r0,-27v-44,-4,-66,-42,-66,-91xm89,-158v-48,7,-48,134,0,139r0,-139",
			w: 168
		},
		
		"\u00a3": {
			d: "194,-237r-20,21v-32,-35,-95,-13,-85,45r0,28r58,0r0,24r-58,0r0,91r88,0r0,28r-157,0r0,-28r39,0r0,-91r-35,0r0,-24r35,0v-6,-72,23,-116,77,-116v22,0,43,7,58,22",
			w: 202
		},
		
		"\u00a4": {
			d: "143,-31r-23,14r-15,-22v-14,5,-34,4,-47,-1r-15,23r-22,-14r15,-24v-18,-19,-17,-68,1,-86r-15,-23r24,-15r14,23v12,-4,31,-4,42,1r14,-24r23,15r-16,23v17,8,24,71,3,86xm115,-94v0,-28,-8,-45,-35,-45v-24,0,-32,15,-32,39v0,31,10,45,34,45v22,0,33,-14,33,-39",
			w: 164
		},
		
		"\u00a5": {
			d: "192,-247r-60,112r54,0r0,22r-65,0v-5,9,-11,18,-9,34r74,0r0,21r-74,0r0,58r-31,0r0,-58r-69,0r0,-21r69,0v2,-16,-2,-26,-8,-34r-61,0r0,-22r50,0r-60,-112r36,0r60,122r60,-122r34,0",
			w: 194
		},
		
		"\u00a6": {
			d: "58,-125r-24,0r0,-147r24,0r0,147xm58,75r-24,0r0,-148r24,0r0,148",
			w: 92
		},
		
		"\u00a7": {
			d: "174,-102v0,22,-13,38,-31,48v15,10,25,25,25,45v-2,75,-124,82,-145,17r28,-13v7,41,84,44,84,-2v0,-47,-106,-42,-106,-103v0,-25,16,-41,37,-51v-17,-9,-28,-23,-28,-42v0,-67,106,-78,132,-25r-27,15v-12,-32,-75,-30,-75,9v0,28,32,32,51,43v23,14,55,27,55,59xm144,-97v-2,-29,-36,-36,-56,-49v-14,6,-31,13,-31,31v0,32,41,35,63,49v12,-5,24,-17,24,-31",
			w: 197
		},
		
		"\u00a8": {
			d: "131,-224v0,10,-8,20,-18,20v-26,0,-23,-39,0,-38v10,0,18,8,18,18xm57,-224v0,10,-8,20,-18,20v-22,0,-26,-39,-1,-38v10,0,19,8,19,18",
			w: 151
		},
		
		"\u00a9": {
			d: "291,-127v0,76,-61,133,-134,133v-73,0,-134,-57,-134,-133v0,-76,61,-134,134,-134v73,0,134,58,134,134xm267,-127v0,-65,-49,-115,-110,-115v-62,0,-110,50,-110,115v0,65,48,114,110,114v61,0,110,-49,110,-114xm123,-126v-5,49,36,73,70,50r10,14v-47,32,-103,-4,-103,-63v0,-60,53,-100,100,-67r-10,14v-35,-24,-73,4,-67,52",
			w: 314
		},
		
		"\u00aa": {
			d: "27,-257v38,-30,98,-28,98,33v0,27,-11,66,10,77r-12,16v-9,-3,-16,-11,-19,-20v-23,35,-89,13,-82,-21v-2,-33,35,-53,80,-48v8,-49,-41,-41,-65,-21xm102,-206v-32,-2,-57,7,-57,32v0,36,49,29,57,3r0,-35xm132,-86r-112,0r0,-20r112,0r0,20",
			w: 154
		},
		
		"\u00ab": {
			d: "162,-22r-20,13r-52,-77r52,-77r20,13r-42,64xm95,-22r-20,13r-52,-77r52,-77r20,13r-42,64",
			w: 181
		},
		
		"\u00ac": {
			d: "160,-28r-26,0r0,-50r-114,0r0,-26r140,0r0,76",
			w: 179
		},
		
		"\u00ad": {
			d: "90,-82r-68,0r0,-28r68,0r0,28",
			w: 108
		},
		
		"\u00ae": {
			d: "291,-127v0,76,-61,133,-134,133v-73,0,-134,-57,-134,-133v0,-76,61,-134,134,-134v73,0,134,58,134,134xm267,-127v0,-65,-49,-115,-110,-115v-62,0,-110,50,-110,115v0,65,48,114,110,114v61,0,110,-49,110,-114xm116,-203v46,-1,91,-3,90,42v0,23,-15,42,-40,41v21,17,31,43,47,66r-25,0v-15,-24,-26,-57,-51,-66r0,66r-21,0r0,-149xm137,-134v27,1,48,-1,47,-27v0,-23,-21,-27,-47,-25r0,52",
			w: 314
		},
		
		"\u00af": {
			d: "108,-246r-99,0r0,-19r99,0r0,19",
			w: 116
		},
		
		"\u00b0": {
			d: "132,-185v0,33,-18,59,-58,59v-36,0,-58,-24,-58,-62v0,-38,22,-61,58,-61v36,0,58,23,58,64xm108,-184v0,-28,-8,-45,-35,-45v-23,0,-32,13,-32,39v0,32,11,45,34,45v20,0,33,-12,33,-39",
			w: 148
		},
		
		"\u00b1": {
			d: "153,-106r-54,0r0,51r-25,0r0,-51r-54,0r0,-25r54,0r0,-48r25,0r0,48r54,0r0,25xm153,-13r-132,0r0,-26r132,0r0,26",
			w: 173
		},
		
		"\u00b2": {
			d: "18,-108v19,-10,71,-65,66,-85v-1,-33,-41,-24,-56,-9r-12,-13v33,-34,95,-29,95,19v0,36,-36,60,-56,83v17,-2,39,0,58,-1r-6,20r-89,0r0,-14",
			w: 128
		},
		
		"\u00b3": {
			d: "42,-180v27,0,43,2,43,-18v0,-27,-43,-20,-57,-5r-12,-14v24,-28,95,-28,95,17v0,13,-8,24,-20,30v14,6,23,17,23,32v-2,38,-45,56,-90,51r-6,-19v34,7,68,-4,71,-34v-3,-20,-18,-21,-47,-21r0,-19",
			w: 130
		},
		
		"\u00b4": {
			d: "110,-239r-81,36r-9,-17r74,-47",
			w: 129
		},
		
		"\u00b5": {
			d: "62,-54v-1,54,65,40,79,4r0,-127r27,-5r0,127v0,24,2,33,13,43r-18,20v-12,-10,-17,-17,-20,-29v-17,23,-53,36,-81,20r0,70r-28,6r0,-253r28,-6r0,130",
			w: 202
		},
		
		"\u00b6": {
			d: "182,45r-26,0r0,-276r-42,0r0,276r-26,0r0,-159v-44,0,-75,-30,-75,-67v0,-47,32,-74,82,-74r87,0r0,300",
			w: 216
		},
		
		"\u00b7": {
			d: "78,-100v0,13,-11,23,-24,23v-13,0,-23,-10,-23,-23v0,-13,10,-24,23,-24v13,0,24,11,24,24",
			w: 108
		},
		
		"\u00b8": {
			d: "85,41v0,26,-45,39,-65,21r7,-17v13,7,33,11,35,-5v2,-15,-22,-5,-26,-13r7,-27r22,0r-4,15v18,3,24,13,24,26",
			w: 104
		},
		
		"\u00b9": {
			d: "101,-94r-69,0r0,-19r23,0r0,-93v-10,6,-22,11,-33,16r-6,-15v21,-10,30,-32,63,-30r0,122r22,0r0,19",
			w: 117
		},
		
		"\u00ba": {
			d: "136,-201v0,44,-22,69,-58,69v-36,0,-58,-28,-58,-72v0,-44,22,-70,57,-70v39,0,59,28,59,73xm110,-199v0,-44,-14,-55,-33,-55v-22,0,-32,16,-32,47v0,38,10,55,33,55v21,0,32,-14,32,-47xm134,-86r-112,0r0,-20r112,0r0,20",
			w: 155
		},
		
		"\u00bb": {
			d: "158,-86r-51,77r-20,-13r42,-64r-42,-64r20,-13xm91,-86r-51,77r-20,-13r42,-64r-42,-64r20,-13",
			w: 181
		},
		
		"\u00bc": {
			d: "281,-275r-190,330r-23,0r189,-330r24,0xm285,-45v-2,-15,3,-36,3,-53r21,-6v-1,19,2,42,-1,59r18,0r0,19r-18,0v2,7,1,17,1,26r-25,7v0,-11,-1,-24,1,-33r-65,0r0,-16r53,-99r27,0v-9,18,-34,66,-52,96r37,0xm101,-94r-69,0r0,-19r23,0r0,-93v-10,6,-22,11,-33,16r-6,-15v21,-10,30,-32,63,-30r0,122r22,0r0,19",
			w: 342
		},
		
		"\u00bd": {
			d: "274,-275r-189,330r-24,0r190,-330r23,0xm222,-14v19,-10,71,-65,66,-85v0,-33,-40,-25,-56,-10r-12,-12v33,-35,95,-30,95,19v0,36,-35,60,-56,82r58,0r-6,20r-89,0r0,-14xm101,-94r-69,0r0,-19r23,0r0,-93v-10,6,-22,11,-33,16r-6,-15v21,-10,30,-32,63,-30r0,122r22,0r0,19",
			w: 333
		},
		
		"\u00be": {
			d: "296,-275r-189,330r-24,0r190,-330r23,0xm341,-26r-17,0r0,26r-24,7r0,-33r-64,0r0,-16r52,-99r27,0v-9,18,-34,66,-52,96v15,-2,42,9,38,-14r2,-39r21,-6r0,59r17,0r0,19xm42,-180v27,0,43,2,43,-18v0,-27,-43,-20,-57,-5r-12,-14v24,-28,95,-28,95,17v0,13,-8,24,-20,30v14,6,23,17,23,32v-2,38,-45,56,-90,51r-6,-19v34,7,68,-4,71,-34v-3,-20,-18,-21,-47,-21r0,-19",
			w: 357
		},
		
		"\u00bf": {
			d: "20,14v6,-67,70,-49,53,-117r25,0v7,28,4,53,-17,72v-14,13,-33,19,-33,44v0,40,58,32,82,13r11,20v-37,31,-126,31,-121,-32xm107,-163v0,13,-11,24,-24,24v-13,0,-24,-11,-24,-24v0,-14,11,-25,24,-25v13,0,24,11,24,25",
			w: 157
		},
		
		"\u00c0": {
			d: "208,0r-33,0r-24,-76r-92,0r-24,76r-30,0r83,-247r38,0xm144,-100r-38,-121r-39,121r77,0xm138,-278r-9,17r-81,-36r16,-28",
			w: 209,
			k: {
				Y: 11,
				W: 4,
				V: 11,
				T: 22
			}
		},
		
		"\u00c1": {
			d: "208,0r-33,0r-24,-76r-92,0r-24,76r-30,0r83,-247r38,0xm144,-100r-38,-121r-39,121r77,0xm166,-297r-81,36r-9,-17r74,-47",
			w: 209,
			k: {
				Y: 11,
				W: 4,
				V: 11,
				T: 22
			}
		},
		
		"\u00c2": {
			d: "208,0r-33,0r-24,-76r-92,0r-24,76r-30,0r83,-247r38,0xm144,-100r-38,-121r-39,121r77,0xm168,-275r-12,15r-51,-30r-48,30r-11,-15r61,-49",
			w: 209,
			k: {
				Y: 11,
				W: 4,
				V: 11,
				T: 22
			}
		},
		
		"\u00c3": {
			d: "208,0r-33,0r-24,-76r-92,0r-24,76r-30,0r83,-247r38,0xm144,-100r-38,-121r-39,121r77,0xm167,-294v-12,15,-22,23,-43,23v-28,0,-52,-26,-71,1r-10,-17v12,-15,22,-22,43,-22v28,0,52,26,71,-1",
			w: 209,
			k: {
				Y: 11,
				W: 4,
				V: 11,
				T: 22
			}
		},
		
		"\u00c4": {
			d: "208,0r-33,0r-24,-76r-92,0r-24,76r-30,0r83,-247r38,0xm144,-100r-38,-121r-39,121r77,0xm89,-281v0,10,-9,19,-19,19v-10,0,-19,-9,-19,-19v0,-10,9,-19,19,-19v10,0,19,9,19,19xm163,-281v0,10,-8,19,-18,19v-10,0,-19,-9,-19,-19v0,-10,8,-19,18,-19v10,0,19,9,19,19",
			w: 209,
			k: {
				Y: 11,
				W: 4,
				V: 11,
				T: 22
			}
		},
		
		"\u00c5": {
			d: "208,0r-33,0r-24,-76r-92,0r-24,76r-30,0r83,-247r38,0xm144,-100r-38,-121r-39,121r77,0xm144,-295v0,21,-16,38,-37,38v-21,0,-38,-17,-38,-38v0,-21,16,-38,37,-38v21,0,38,17,38,38xm128,-295v0,-12,-10,-21,-22,-21v-11,0,-21,9,-21,21v0,12,10,22,22,22v11,0,21,-10,21,-22",
			w: 209,
			k: {
				Y: 11,
				W: 4,
				V: 11,
				T: 22
			}
		},
		
		"\u00c6": {
			d: "304,0r-138,0r0,-77r-85,0r-47,77r-32,0r152,-247r147,0r-4,25r-102,0r0,81r85,0r0,25r-85,0r0,90r109,0r0,26xm166,-101r0,-118r-71,118r71,0",
			w: 318
		},
		
		"\u00c7": {
			d: "55,-118v0,82,64,123,123,82r16,20v-19,13,-44,20,-68,20r-3,11v18,3,24,13,24,26v0,26,-45,39,-65,21r7,-17v13,7,33,11,35,-5v2,-15,-22,-5,-26,-13r7,-25v-50,-10,-82,-64,-82,-125v0,-100,90,-161,166,-107r-15,19v-63,-43,-119,10,-119,93",
			w: 206,
			k: {
				i: 5
			}
		},
		
		"\u00c8": {
			d: "175,0r-139,0r0,-247r135,0r-4,25r-101,0r0,81r84,0r0,25r-84,0r0,90r109,0r0,26xm145,-278r-10,17r-80,-36r15,-28",
			w: 187
		},
		
		"\u00c9": {
			d: "175,0r-139,0r0,-247r135,0r-4,25r-101,0r0,81r84,0r0,25r-84,0r0,90r109,0r0,26xm156,-297r-81,36r-9,-17r74,-47",
			w: 187
		},
		
		"\u00ca": {
			d: "175,0r-139,0r0,-247r135,0r-4,25r-101,0r0,81r84,0r0,25r-84,0r0,90r109,0r0,26xm166,-275r-13,15r-50,-30r-48,30r-11,-15r61,-49",
			w: 187
		},
		
		"\u00cb": {
			d: "175,0r-139,0r0,-247r135,0r-4,25r-101,0r0,81r84,0r0,25r-84,0r0,90r109,0r0,26xm86,-281v0,10,-9,19,-19,19v-10,0,-18,-9,-18,-19v0,-10,8,-19,18,-19v10,0,19,9,19,19xm160,-281v0,10,-8,19,-18,19v-10,0,-19,-9,-19,-19v0,-10,8,-19,18,-19v10,0,19,9,19,19",
			w: 187
		},
		
		"\u00cc": {
			d: "65,0r-29,0r0,-247r29,0r0,247xm77,-278r-9,17r-81,-36r16,-28"
		},
		
		"\u00cd": {
			d: "65,0r-29,0r0,-247r29,0r0,247xm116,-297r-81,36r-9,-17r74,-47"
		},
		
		"\u00ce": {
			d: "65,0r-29,0r0,-247r29,0r0,247xm112,-275r-13,15r-50,-30r-49,30r-11,-15r61,-49"
		},
		
		"\u00cf": {
			d: "65,0r-29,0r0,-247r29,0r0,247xm31,-281v0,10,-8,19,-18,19v-10,0,-19,-9,-19,-19v0,-10,9,-19,19,-19v10,0,18,9,18,19xm106,-281v0,10,-9,19,-19,19v-10,0,-18,-9,-18,-19v0,-10,8,-19,18,-19v10,0,19,9,19,19"
		},
		
		"\u00d0": {
			d: "84,-247v85,-5,119,44,120,124v2,106,-63,133,-170,123r0,-116r-30,0r0,-21r30,0r0,-110r50,0xm156,-50v34,-62,20,-183,-63,-173r-29,0r0,86r57,0r-9,21r-48,0r0,92v41,0,75,5,92,-26",
			w: 227
		},
		
		"\u00d1": {
			d: "200,0r-31,0r-79,-151v-16,-30,-28,-60,-28,-60v4,44,4,155,5,211r-31,0r0,-247r34,0r82,158v12,23,22,49,23,52v-3,-41,-4,-154,-4,-210r29,0r0,247xm179,-294v-12,15,-23,23,-44,23v-28,0,-52,-26,-71,1r-10,-17v12,-15,23,-22,44,-22v28,0,51,26,70,-1",
			w: 232
		},
		
		"\u00d2": {
			d: "123,-251v82,0,97,53,101,131v3,74,-33,125,-99,125v-68,0,-99,-56,-100,-130v0,-78,37,-126,98,-126xm126,-18v50,0,64,-32,64,-97v0,-70,-8,-113,-67,-113v-50,0,-66,39,-65,97v0,66,12,113,68,113xm162,-278r-10,17r-80,-36r15,-28",
			w: 245,
			k: {
				Y: 11,
				W: 4,
				V: 7,
				T: 4
			}
		},
		
		"\u00d3": {
			d: "123,-251v82,0,97,53,101,131v3,74,-33,125,-99,125v-68,0,-99,-56,-100,-130v0,-78,37,-126,98,-126xm126,-18v50,0,64,-32,64,-97v0,-70,-8,-113,-67,-113v-50,0,-66,39,-65,97v0,66,12,113,68,113xm184,-297r-80,36r-10,-17r75,-47",
			w: 245,
			k: {
				Y: 11,
				W: 4,
				V: 7,
				T: 4
			}
		},
		
		"\u00d4": {
			d: "123,-251v82,0,97,53,101,131v3,74,-33,125,-99,125v-68,0,-99,-56,-100,-130v0,-78,37,-126,98,-126xm126,-18v50,0,64,-32,64,-97v0,-70,-8,-113,-67,-113v-50,0,-66,39,-65,97v0,66,12,113,68,113xm186,-275r-12,15r-51,-30r-48,30r-11,-15r61,-49",
			w: 245,
			k: {
				Y: 11,
				W: 4,
				V: 7,
				T: 4
			}
		},
		
		"\u00d5": {
			d: "123,-251v82,0,97,53,101,131v3,74,-33,125,-99,125v-68,0,-99,-56,-100,-130v0,-78,37,-126,98,-126xm126,-18v50,0,64,-32,64,-97v0,-70,-8,-113,-67,-113v-50,0,-66,39,-65,97v0,66,12,113,68,113xm186,-294v-12,15,-22,23,-43,23v-28,0,-52,-26,-71,1r-10,-17v12,-15,22,-22,43,-22v28,0,52,26,71,-1",
			w: 245,
			k: {
				Y: 11,
				W: 4,
				V: 7
			}
		},
		
		"\u00d6": {
			d: "123,-251v82,0,97,53,101,131v3,74,-33,125,-99,125v-68,0,-99,-56,-100,-130v0,-78,37,-126,98,-126xm126,-18v50,0,64,-32,64,-97v0,-70,-8,-113,-67,-113v-50,0,-66,39,-65,97v0,66,12,113,68,113xm104,-281v0,10,-8,19,-18,19v-10,0,-19,-9,-19,-19v0,-10,9,-19,19,-19v10,0,18,9,18,19xm179,-281v0,10,-9,19,-19,19v-10,0,-19,-9,-19,-19v0,-10,9,-19,19,-19v10,0,19,9,19,19",
			w: 245,
			k: {
				Y: 11,
				W: 4,
				V: 7,
				T: 7
			}
		},
		
		"\u00d7": {
			d: "162,-45r-19,19r-45,-46r-45,46r-19,-19r46,-45r-46,-45r19,-19r45,46r45,-46r19,19r-46,45",
			w: 195
		},
		
		"\u00d8": {
			d: "222,-120v0,96,-78,155,-153,108r-24,41r-19,-11r27,-45v-19,-22,-30,-56,-30,-98v0,-103,81,-154,154,-109r24,-39r19,12r-26,42v19,23,28,55,28,99xm122,-228v-79,0,-73,118,-54,176r96,-160v-10,-9,-24,-16,-42,-16xm82,-33v55,35,107,3,107,-82v0,-35,-4,-60,-11,-77",
			w: 245
		},
		
		"\u00d9": {
			d: "116,-21v39,2,54,-18,53,-54r0,-172r29,0r0,176v2,58,-29,73,-84,75v-52,2,-81,-25,-80,-74r0,-177r29,0r0,166v2,40,6,58,53,60xm148,-278r-10,17r-80,-36r15,-28",
			w: 228
		},
		
		"\u00da": {
			d: "116,-21v39,2,54,-18,53,-54r0,-172r29,0r0,176v2,58,-29,73,-84,75v-52,2,-81,-25,-80,-74r0,-177r29,0r0,166v2,40,6,58,53,60xm161,-297r-81,36r-9,-17r74,-47",
			w: 228
		},
		
		"\u00db": {
			d: "116,-21v39,2,54,-18,53,-54r0,-172r29,0r0,176v2,58,-29,73,-84,75v-52,2,-81,-25,-80,-74r0,-177r29,0r0,166v2,40,6,58,53,60xm177,-275r-12,15r-51,-30r-48,30r-11,-15r61,-49",
			w: 228
		},
		
		"\u00dc": {
			d: "116,-21v39,2,54,-18,53,-54r0,-172r29,0r0,176v2,58,-29,73,-84,75v-52,2,-81,-25,-80,-74r0,-177r29,0r0,166v2,40,6,58,53,60xm97,-281v0,10,-8,19,-18,19v-10,0,-19,-9,-19,-19v0,-10,8,-19,18,-19v10,0,19,9,19,19xm171,-281v0,10,-8,19,-18,19v-10,0,-19,-9,-19,-19v0,-10,9,-19,19,-19v10,0,18,9,18,19",
			w: 228
		},
		
		"\u00dd": {
			d: "190,-247r-80,151r0,96r-30,0r0,-98r-80,-149r36,0r60,122r61,-122r33,0xm149,-297r-81,36r-9,-17r75,-47",
			w: 186
		},
		
		"\u00de": {
			d: "63,-200v72,-7,125,11,125,70v0,65,-52,87,-125,79r0,51r-29,0r0,-247r29,0r0,47xm63,-76v51,4,93,-2,93,-48v0,-49,-40,-54,-93,-51r0,99",
			w: 197
		},
		
		"\u00df": {
			d: "34,-179v-3,-49,25,-73,68,-76v64,-5,84,80,34,98v-14,5,-25,6,-25,14v0,7,24,13,51,29v49,29,23,118,-42,118v-14,0,-27,-2,-35,-6r8,-19v30,15,67,-7,65,-41v8,-48,-75,-45,-73,-79v1,-34,52,-22,51,-61v0,-19,-15,-32,-37,-32v-23,0,-37,15,-37,51v0,60,5,130,-4,183r-27,0v7,-44,1,-108,3,-158r-26,0r0,-21r26,0",
			w: 207,
			k: {
				s: 7
			}
		},
		
		"\u00e0": {
			d: "30,-160v48,-35,129,-40,129,44v0,34,-12,95,13,103r-15,20v-12,-4,-21,-13,-24,-26v-17,17,-31,24,-52,24v-44,0,-58,-27,-58,-51v-1,-45,44,-68,108,-65v13,-67,-60,-53,-87,-29xm130,-91v-44,-5,-75,11,-75,42v0,47,63,38,74,5xm138,-220r-10,17r-80,-36r15,-28",
			w: 190
		},
		
		"\u00e1": {
			d: "30,-160v48,-35,129,-40,129,44v0,34,-12,95,13,103r-15,20v-12,-4,-21,-13,-24,-26v-17,17,-31,24,-52,24v-44,0,-58,-27,-58,-51v-1,-45,44,-68,108,-65v13,-67,-60,-53,-87,-29xm130,-91v-44,-5,-75,11,-75,42v0,47,63,38,74,5xm150,-239r-81,36r-9,-17r74,-47",
			w: 190
		},
		
		"\u00e2": {
			d: "30,-160v48,-35,129,-40,129,44v0,34,-12,95,13,103r-15,20v-12,-4,-21,-13,-24,-26v-17,17,-31,24,-52,24v-44,0,-58,-27,-58,-51v-1,-45,44,-68,108,-65v13,-67,-60,-53,-87,-29xm130,-91v-44,-5,-75,11,-75,42v0,47,63,38,74,5xm159,-218r-13,16r-50,-31r-48,31r-12,-16r62,-48",
			w: 190
		},
		
		"\u00e3": {
			d: "30,-160v48,-35,129,-40,129,44v0,34,-12,95,13,103r-15,20v-12,-4,-21,-13,-24,-26v-17,17,-31,24,-52,24v-44,0,-58,-27,-58,-51v-1,-45,44,-68,108,-65v13,-67,-60,-53,-87,-29xm130,-91v-44,-5,-75,11,-75,42v0,47,63,38,74,5xm160,-236v-12,15,-22,23,-43,23v-28,0,-52,-27,-71,0r-10,-16v12,-15,22,-23,43,-23v28,0,52,27,71,0",
			w: 190
		},
		
		"\u00e4": {
			d: "30,-160v48,-35,129,-40,129,44v0,34,-12,95,13,103r-15,20v-12,-4,-21,-13,-24,-26v-17,17,-31,24,-52,24v-44,0,-58,-27,-58,-51v-1,-45,44,-68,108,-65v13,-67,-60,-53,-87,-29xm130,-91v-44,-5,-75,11,-75,42v0,47,63,38,74,5xm81,-224v0,10,-8,20,-18,20v-26,0,-23,-39,0,-38v10,0,18,8,18,18xm156,-224v0,10,-8,20,-18,20v-22,0,-26,-39,-1,-38v10,0,19,8,19,18",
			w: 190
		},
		
		"\u00e5": {
			d: "30,-160v48,-35,129,-40,129,44v0,34,-12,95,13,103r-15,20v-12,-4,-21,-13,-24,-26v-17,17,-31,24,-52,24v-44,0,-58,-27,-58,-51v-1,-45,44,-68,108,-65v13,-67,-60,-53,-87,-29xm130,-91v-44,-5,-75,11,-75,42v0,47,63,38,74,5xm140,-237v0,21,-17,38,-38,38v-21,0,-38,-17,-38,-38v0,-21,17,-38,38,-38v21,0,38,17,38,38xm123,-237v0,-12,-10,-22,-22,-22v-11,0,-20,10,-20,22v0,12,9,21,21,21v11,0,21,-9,21,-21",
			w: 190
		},
		
		"\u00e6": {
			d: "147,-161v50,-48,134,-17,119,76r-112,0v-1,37,12,65,53,66v17,0,31,-5,44,-17r11,18v-30,33,-104,26,-122,-9v-15,19,-40,32,-61,32v-45,0,-57,-29,-57,-51v-1,-44,43,-68,107,-65v11,-66,-55,-56,-87,-29r-14,-20v36,-25,95,-38,119,-1xm129,-91v-41,-5,-82,9,-76,42v-2,47,63,38,74,5xm237,-106v0,-37,-12,-56,-41,-56v-26,0,-41,19,-42,56r83,0",
			w: 286
		},
		
		"\u00e7": {
			d: "132,-145v-42,-36,-86,3,-78,64v-5,62,52,82,83,43r16,18v-16,17,-32,24,-53,24r-3,11v37,8,28,56,-12,56v-11,0,-23,-5,-30,-9r8,-17v13,7,31,11,35,-5v0,-15,-22,-5,-26,-13r6,-25v-37,-9,-52,-44,-55,-89v-5,-82,73,-121,125,-78",
			w: 168,
			k: {
				i: 4
			}
		},
		
		"\u00e8": {
			d: "100,-184v52,0,72,32,70,99r-112,0v-9,63,58,84,96,49r11,18v-55,47,-140,15,-140,-73v0,-52,28,-93,75,-93xm140,-106v-1,-35,-10,-56,-41,-56v-26,0,-40,19,-41,56r82,0xm140,-220r-10,17r-80,-36r15,-28",
			w: 187
		},
		
		"\u00e9": {
			d: "100,-184v52,0,72,32,70,99r-112,0v-9,63,58,84,96,49r11,18v-55,47,-140,15,-140,-73v0,-52,28,-93,75,-93xm140,-106v-1,-35,-10,-56,-41,-56v-26,0,-40,19,-41,56r82,0xm149,-239r-80,36r-10,-17r75,-47",
			w: 187
		},
		
		"\u00ea": {
			d: "100,-184v52,0,72,32,70,99r-112,0v-9,63,58,84,96,49r11,18v-55,47,-140,15,-140,-73v0,-52,28,-93,75,-93xm140,-106v-1,-35,-10,-56,-41,-56v-26,0,-40,19,-41,56r82,0xm162,-218r-13,16r-50,-31r-49,31r-11,-16r61,-48",
			w: 187
		},
		
		"\u00eb": {
			d: "100,-184v52,0,72,32,70,99r-112,0v-9,63,58,84,96,49r11,18v-55,47,-140,15,-140,-73v0,-52,28,-93,75,-93xm140,-106v-1,-35,-10,-56,-41,-56v-26,0,-40,19,-41,56r82,0xm80,-224v0,10,-8,20,-18,20v-26,0,-23,-39,0,-38v10,0,18,8,18,18xm155,-224v0,10,-9,20,-19,20v-25,0,-22,-39,0,-38v10,0,19,8,19,18",
			w: 187
		},
		
		"\u00ec": {
			d: "65,0r-29,0r0,-179r29,-4r0,183xm87,-220r-10,17r-80,-36r15,-28"
		},
		
		"\u00ed": {
			d: "65,0r-29,0r0,-179r29,-4r0,183xm105,-239r-81,36r-9,-17r74,-47"
		},
		
		"\u00ee": {
			d: "65,0r-29,0r0,-179r29,-4r0,183xm112,-218r-13,16r-50,-31r-48,31r-11,-16r61,-48",
			k: {
				i: -9
			}
		},
		
		"\u00ef": {
			d: "65,0r-29,0r0,-179r29,-4r0,183xm36,-224v0,10,-9,20,-19,20v-25,0,-22,-39,0,-38v10,0,19,8,19,18xm103,-224v0,10,-9,20,-19,20v-25,0,-22,-39,0,-38v10,0,19,8,19,18"
		},
		
		"\u00f0": {
			d: "179,-94v0,62,-36,99,-79,99v-44,0,-77,-42,-77,-88v0,-61,60,-102,115,-76v-8,-23,-23,-43,-46,-58r-19,21r-18,-13r18,-20v-13,-7,-28,-12,-45,-17r14,-17v17,4,33,10,47,16r15,-18r18,13r-14,16v49,31,71,79,71,142xm102,-18v46,0,51,-72,42,-116v-10,-6,-28,-11,-45,-11v-27,0,-44,29,-44,63v0,34,19,64,47,64",
			w: 202
		},
		
		"\u00f1": {
			d: "63,-156v34,-40,105,-37,105,20r0,136r-29,0r0,-121v5,-59,-53,-38,-76,-13r0,134r-27,0v-2,-52,6,-140,-7,-176r28,-8v0,0,6,13,6,28xm162,-236v-12,15,-23,23,-44,23v-27,0,-51,-27,-70,0r-10,-16v12,-15,22,-23,43,-23v28,0,52,27,71,0",
			w: 200
		},
		
		"\u00f2": {
			d: "100,-185v56,0,78,40,78,98v0,60,-32,92,-77,92v-49,0,-78,-37,-78,-96v0,-58,30,-94,77,-94xm102,-19v33,0,44,-28,44,-66v0,-47,-12,-77,-47,-77v-35,0,-45,27,-45,67v0,46,8,76,48,76xm139,-220r-10,17r-80,-36r15,-28",
			w: 197
		},
		
		"\u00f3": {
			d: "100,-185v56,0,78,40,78,98v0,60,-32,92,-77,92v-49,0,-78,-37,-78,-96v0,-58,30,-94,77,-94xm102,-19v33,0,44,-28,44,-66v0,-47,-12,-77,-47,-77v-35,0,-45,27,-45,67v0,46,8,76,48,76xm154,-239r-80,36r-10,-17r75,-47",
			w: 197
		},
		
		"\u00f4": {
			d: "100,-185v56,0,78,40,78,98v0,60,-32,92,-77,92v-49,0,-78,-37,-78,-96v0,-58,30,-94,77,-94xm102,-19v33,0,44,-28,44,-66v0,-47,-12,-77,-47,-77v-35,0,-45,27,-45,67v0,46,8,76,48,76xm162,-218r-13,16r-50,-31r-48,31r-11,-16r61,-48",
			w: 197
		},
		
		"\u00f5": {
			d: "100,-185v56,0,78,40,78,98v0,60,-32,92,-77,92v-49,0,-78,-37,-78,-96v0,-58,30,-94,77,-94xm102,-19v33,0,44,-28,44,-66v0,-47,-12,-77,-47,-77v-35,0,-45,27,-45,67v0,46,8,76,48,76xm164,-236v-12,15,-23,23,-44,23v-27,0,-51,-27,-70,0r-10,-16v12,-15,22,-23,43,-23v28,0,52,27,71,0",
			w: 197
		},
		
		"\u00f6": {
			d: "100,-185v56,0,78,40,78,98v0,60,-32,92,-77,92v-49,0,-78,-37,-78,-96v0,-58,30,-94,77,-94xm102,-19v33,0,44,-28,44,-66v0,-47,-12,-77,-47,-77v-35,0,-45,27,-45,67v0,46,8,76,48,76xm81,-224v0,10,-9,20,-19,20v-25,0,-22,-39,0,-38v10,0,19,8,19,18xm156,-224v0,10,-9,20,-19,20v-26,0,-23,-39,0,-38v10,0,19,8,19,18",
			w: 197
		},
		
		"\u00f7": {
			d: "200,-85r-180,0r0,-23r180,0r0,23xm135,-20v0,14,-11,24,-25,24v-13,0,-24,-11,-24,-24v0,-14,11,-24,25,-24v13,0,24,11,24,24xm135,-170v0,14,-11,25,-24,25v-13,0,-25,-11,-25,-24v0,-14,11,-25,25,-25v13,0,24,11,24,24",
			w: 219
		},
		
		"\u00f8": {
			d: "153,-161v43,49,28,167,-54,167v-15,0,-29,-4,-40,-11r-17,29r-18,-11r19,-31v-14,-16,-21,-41,-21,-71v0,-74,54,-113,114,-85r18,-29r18,10xm72,-26v38,24,72,-4,72,-57v0,-23,-2,-39,-7,-51xm123,-152v-39,-23,-71,7,-71,58v0,19,3,37,7,49",
			w: 197
		},
		
		"\u00f9": {
			d: "62,-54v-2,54,65,40,78,4r0,-127r28,-5r0,131v0,23,3,31,12,39r-18,20v-12,-10,-16,-17,-19,-29v-26,40,-109,38,-109,-25r0,-132r28,-5r0,129xm145,-220r-10,17r-80,-36r15,-28",
			w: 200
		},
		
		"\u00fa": {
			d: "62,-54v-2,54,65,40,78,4r0,-127r28,-5r0,131v0,23,3,31,12,39r-18,20v-12,-10,-16,-17,-19,-29v-26,40,-109,38,-109,-25r0,-132r28,-5r0,129xm163,-239r-81,36r-9,-17r74,-47",
			w: 200
		},
		
		"\u00fb": {
			d: "62,-54v-2,54,65,40,78,4r0,-127r28,-5r0,131v0,23,3,31,12,39r-18,20v-12,-10,-16,-17,-19,-29v-26,40,-109,38,-109,-25r0,-132r28,-5r0,129xm163,-218r-13,16r-50,-31r-49,31r-11,-16r62,-48",
			w: 200
		},
		
		"\u00fc": {
			d: "62,-54v-2,54,65,40,78,4r0,-127r28,-5r0,131v0,23,3,31,12,39r-18,20v-12,-10,-16,-17,-19,-29v-26,40,-109,38,-109,-25r0,-132r28,-5r0,129xm82,-224v0,10,-8,20,-18,20v-22,0,-26,-39,-1,-38v10,0,19,8,19,18xm157,-224v0,10,-9,20,-19,20v-25,0,-22,-39,0,-38v10,0,19,8,19,18",
			w: 200
		},
		
		"\u00fd": {
			d: "162,-179r-62,185v-12,36,-27,60,-58,68r-8,-19v23,-7,31,-19,41,-55r-11,1v-13,-56,-39,-122,-57,-176r28,-10r37,117v6,17,8,45,11,44r47,-155r32,0xm151,-238r-81,36r-9,-17r74,-47",
			w: 165
		},
		
		"\u00fe": {
			d: "60,-158v48,-55,121,-12,121,68v0,75,-68,122,-119,74r0,85r-29,6r0,-295v0,-14,-1,-27,-4,-38r28,-5v7,27,6,75,3,105xm62,-42v34,45,89,18,89,-44v0,-42,-7,-72,-42,-72v-18,0,-33,7,-47,24r0,92",
			w: 204
		},
		
		"\u00ff": {
			d: "162,-179r-62,185v-12,36,-27,60,-58,68r-8,-19v23,-7,31,-19,41,-55r-11,1v-13,-56,-39,-122,-57,-176r28,-10r37,117v6,17,8,45,11,44r47,-155r32,0xm66,-224v0,10,-8,20,-18,20v-22,0,-26,-39,-1,-38v10,0,19,8,19,18xm140,-224v0,10,-8,20,-18,20v-26,0,-23,-39,0,-38v10,0,18,8,18,18",
			w: 165
		},
		
		"\u2013": {
			d: "194,-90r-174,0r0,-21r174,0r0,21",
			w: 214
		},
		
		"\u2014": {
			d: "276,-90r-256,0r0,-21r256,0r0,21",
			w: 295
		},
		
		"\u2018": {
			d: "77,-240v-14,7,-22,18,-24,32v15,-1,23,9,24,23v0,14,-11,26,-25,26v-33,-1,-36,-50,-15,-72v8,-8,19,-19,30,-25"
		},
		
		"\u2019": {
			d: "45,-251v33,0,36,49,15,71v-8,8,-19,19,-30,25r-10,-16v14,-7,22,-18,24,-32v-13,4,-24,-8,-24,-22v0,-14,11,-26,25,-26"
		},
		
		"\u201c": {
			d: "148,-240v-14,7,-22,18,-24,32v15,-1,23,9,24,23v0,14,-11,26,-25,26v-33,-1,-36,-50,-15,-72v8,-8,19,-19,30,-25xm77,-240v-14,7,-22,18,-24,32v15,-1,23,9,24,23v0,14,-11,26,-25,26v-33,-1,-36,-50,-15,-72v8,-8,19,-19,30,-25",
			w: 168
		},
		
		"\u201d": {
			d: "116,-251v33,0,36,49,15,71v-8,8,-19,19,-30,25r-10,-16v14,-7,22,-18,24,-32v-13,4,-24,-8,-24,-22v0,-14,11,-26,25,-26xm45,-251v33,0,36,49,15,71v-8,8,-19,19,-30,25r-10,-16v14,-7,22,-18,24,-32v-13,4,-24,-8,-24,-22v0,-14,11,-26,25,-26",
			w: 168
		},
		
		"\u2026": {
			d: "241,-20v0,14,-11,25,-24,25v-14,0,-24,-11,-24,-25v0,-13,10,-24,23,-24v14,0,25,11,25,24xm158,-20v0,14,-11,25,-24,25v-14,0,-24,-11,-24,-25v0,-13,11,-24,24,-24v14,0,24,11,24,24xm75,-20v0,14,-11,25,-24,25v-14,0,-24,-11,-24,-25v0,-13,11,-24,24,-24v14,0,24,11,24,24",
			w: 267
		},
		
		"\u20ac": {
			d: "90,-84v11,56,72,84,120,48r5,26v-62,37,-150,-4,-156,-74r-39,0r0,-21r37,0r-1,-29r-36,0r0,-22r39,0v9,-76,89,-116,152,-81r-5,26v-48,-36,-112,-4,-116,55r97,0r0,22r-99,0r0,29r99,0r0,21r-97,0",
			w: 235
		},
		
		"\u2122": {
			d: "323,-99r-24,0r-1,-124r-49,124r-16,0r-49,-124r0,124r-24,0r0,-148r38,0r44,113r44,-113r37,0r0,148xm130,-223r-47,0r0,124r-24,0r0,-124r-46,0r0,-24r117,0r0,24",
			w: 357
		}
	}
});/*!
 * The following copyright notice may not be removed under any circumstances.
 * 
 * Copyright:
 * 2005 Erik Spiekermann published by FSI Fonts und Software GmbH
 * 
 * Trademark:
 * Meta is a trademark of FSI Fonts und Software GmbH
 * 
 * Manufacturer:
 * FSI Fonts und Software GmbH
 * 
 * Designer:
 * Erik Spiekermann
 * 
 * Vendor URL:
 * http://www.fontfont.com
 * 
 * License information:
 * http://www.fontfont.com/eula/license.html
 */
Cufon.registerFont({
	w: 196,
	face: {
		"font-family": "MetaPlusCE",
		"font-weight": 500,
		"font-stretch": "normal",
		"units-per-em": "360",
		"panose-1": "2 0 0 0 0 0 0 0 0 0",
		ascent: "288",
		descent: "-72",
		"x-height": "5",
		bbox: "-37 -340 343 78",
		"underline-thickness": "7.2",
		"underline-position": "-47.52",
		stemh: "7",
		stemv: "38",
		"unicode-range": "U+0020-U+2122"
	},
	
	glyphs: {
		" ": {
			w: 81,
			k: {
				z: 4,
				y: 4,
				x: 7,
				v: 4,
				Z: 4,
				Y: 4,
				X: 4,
				W: 4,
				V: 7,
				T: 7,
				S: 7
			}
		},
		
		"!": {
			d: "77,-254r-9,178r-30,0r-9,-171xm80,-23v0,15,-13,27,-27,27v-15,0,-26,-12,-26,-27v0,-14,11,-26,26,-26v14,0,27,12,27,26",
			w: 106
		},
		
		'"': {
			d: "136,-159r-37,0r0,-96r37,0r0,96xm64,-159r-37,0r0,-96r37,0r0,96",
			w: 163
		},
		
		"#": {
			d: "191,-153r-36,0r-7,51r32,0r0,27r-36,0r-10,75r-30,0r10,-75r-40,0r-10,75r-30,0r10,-75r-31,0r0,-27r35,0r7,-51r-32,0r0,-28r36,0r10,-74r30,0r-10,74r40,0r10,-74r30,0r-10,74r32,0r0,28xm125,-153r-40,0r-7,51r40,0",
			w: 203
		},
		
		"$": {
			d: "179,-121v43,49,-3,124,-63,125r0,32r-26,0r0,-32v-27,-1,-53,-8,-74,-21r16,-32v30,25,118,31,117,-19v-1,-50,-92,-40,-111,-75v-28,-50,2,-107,59,-112r0,-28r26,0r0,28v24,1,48,11,67,24r-19,29v-31,-26,-99,-29,-99,14v0,46,90,31,107,67",
			w: 212
		},
		
		"%": {
			d: "132,-190v1,37,-23,62,-60,61v-37,0,-59,-23,-59,-61v0,-37,23,-62,59,-62v37,0,60,22,60,62xm291,-58v0,36,-22,61,-60,61v-37,0,-60,-23,-60,-61v0,-37,24,-62,60,-62v38,0,60,24,60,62xm230,-248r-127,248r-28,0r126,-248r29,0xm100,-190v0,-28,-9,-39,-28,-39v-19,0,-27,12,-27,37v0,28,9,40,28,40v19,0,27,-12,27,-38xm258,-58v0,-28,-8,-39,-27,-39v-19,0,-27,14,-27,37v0,29,8,40,27,40v19,0,27,-12,27,-38",
			w: 303
		},
		
		"&": {
			d: "250,0r-55,0r-19,-19v-15,15,-40,24,-69,24v-99,0,-114,-103,-39,-130v-57,-37,-33,-113,36,-114v40,0,70,21,70,56v0,28,-19,45,-49,59r49,48v5,-12,5,-26,5,-44r33,0v0,35,-4,51,-13,70xm153,-41r-64,-63v-41,18,-35,80,19,80v20,0,36,-6,45,-17xm103,-144v35,-11,41,-64,1,-67v-37,6,-35,43,-1,67",
			w: 251
		},
		
		"'": {
			d: "64,-159r-37,0r0,-96r37,0r0,96",
			w: 90
		},
		
		"(": {
			d: "60,-117v0,61,8,133,58,154r-10,22v-84,-23,-108,-162,-76,-260v11,-33,36,-62,75,-79r10,22v-56,37,-57,70,-57,141",
			w: 112,
			k: {
				"9": -4,
				"7": -7,
				"5": -4,
				"3": -4
			}
		},
		
		")": {
			d: "5,-280v83,26,107,153,77,256v-11,38,-40,68,-77,83r-10,-22v49,-28,58,-82,58,-149v0,-68,-9,-117,-58,-146",
			w: 113
		},
		
		"*": {
			d: "157,-191r-49,16r31,43r-24,18r-31,-44r-31,43r-23,-18r30,-42r-49,-17r10,-28r48,17r0,-52r30,0r0,52r49,-17",
			w: 167
		},
		
		"+": {
			d: "200,-84r-72,0r0,72r-37,0r0,-72r-71,0r0,-37r71,0r0,-72r37,0r0,72r72,0r0,37",
			w: 219,
			k: {
				"7": 18
			}
		},
		
		",": {
			d: "44,8v-5,-9,-23,-13,-23,-31v0,-16,12,-29,28,-29v59,0,29,95,-15,104r-14,-18v15,-5,24,-16,24,-26",
			w: 105
		},
		
		"-": {
			d: "99,-80r-79,0r0,-36r79,0r0,36",
			w: 118,
			k: {
				z: 4,
				y: 4,
				x: 7,
				v: 2,
				s: 2,
				a: 2,
				Z: 7,
				Y: 18,
				X: 7,
				W: 5,
				V: 11,
				T: 18,
				S: 18,
				"7": 7,
				"4": 4,
				"3": 7,
				"2": 7
			}
		},
		
		".": {
			d: "80,-24v0,16,-13,29,-28,29v-16,0,-29,-13,-29,-29v0,-16,13,-29,28,-29v16,0,29,13,29,29",
			w: 103
		},
		
		"/": {
			d: "142,-274r-95,328r-27,0r94,-328r28,0",
			w: 162
		},
		
		"0": {
			d: "186,-91v0,58,-33,96,-83,96v-52,0,-83,-38,-83,-96v0,-58,33,-95,83,-95v52,0,83,37,83,95xm143,-88v0,-53,-14,-69,-40,-69v-28,0,-40,23,-40,64v0,53,14,68,40,68v28,0,40,-23,40,-63",
			w: 205,
			k: {
				"9": 4,
				"7": 7,
				"4": 7,
				"3": 11,
				"2": 4,
				".": 4,
				",": 4
			}
		},
		
		"1": {
			d: "140,0r-105,0r0,-32r37,0r0,-108v-15,10,-30,16,-46,22r-10,-21r66,-47r28,0r0,154r30,0r0,32",
			w: 158,
			k: {
				"9": 4,
				"7": 7,
				"3": 7
			}
		},
		
		"2": {
			d: "179,-33r-9,33r-144,0r0,-35v31,-22,103,-60,100,-92v-4,-45,-73,-21,-85,-4r-21,-23v39,-47,145,-51,151,21v3,35,-52,75,-97,102v17,-2,78,-2,105,-2",
			w: 201,
			k: {
				"9": 7,
				"7": 4,
				"5": 4,
				"4": 2,
				"3": 7,
				"1": 4
			}
		},
		
		"3": {
			d: "14,37v49,8,112,-11,113,-59v9,-33,-55,-40,-72,-36r0,-32v28,4,75,-3,68,-32v0,-45,-70,-34,-91,-12r-19,-24v44,-44,153,-39,153,31v0,24,-13,44,-40,54v30,9,46,30,46,55v0,68,-73,90,-149,82",
			w: 192,
			k: {
				"3": 7
			}
		},
		
		"4": {
			d: "184,-3r-28,-1v2,17,1,45,1,65r-38,6r1,-70r-107,0r0,-28r73,-157r42,0r-74,153v19,-2,46,-1,67,-1v-2,-10,3,-66,5,-90r31,-8r-1,98r28,0r0,33",
			k: {
				"9": 4,
				"6": 4,
				"5": 2,
				"3": 7,
				"1": 4,
				")": -4,
				"%": 7
			}
		},
		
		"5": {
			d: "164,-23v1,61,-65,101,-136,87r-8,-29v48,17,101,-10,101,-54v0,-47,-55,-49,-95,-33r12,-130r115,0r-6,33r-73,0r-5,59v53,-10,95,19,95,67",
			w: 187,
			k: {
				"9": 4,
				"7": 4,
				"6": 4,
				"3": 4,
				"2": 4,
				"1": 4
			}
		},
		
		"6": {
			d: "189,-75v0,45,-35,80,-81,80v-51,0,-86,-41,-86,-100v0,-83,63,-139,137,-161r8,28v-48,15,-84,49,-97,95v45,-38,119,-4,119,58xm109,-118v-15,5,-43,-1,-43,36v0,37,14,57,40,57v25,0,41,-20,41,-50v0,-27,-15,-43,-38,-43",
			w: 210,
			k: {
				"9": 7,
				"7": 7,
				"4": 4,
				"3": 7,
				"2": 4,
				"1": 4,
				".": 4
			}
		},
		
		"7": {
			d: "170,-182v-3,39,-22,57,-39,87v-18,29,-50,108,-61,153r-44,12v18,-84,59,-165,101,-219v-33,4,-77,1,-114,2r9,-35r148,0",
			w: 182,
			k: {
				"9": 4,
				"8": 2,
				"6": 4,
				"5": 4,
				"4": 18,
				"2": 4,
				"0": 4,
				".": 36,
				"-": 7,
				",": 40,
				"+": 7,
				")": 4
			}
		},
		
		"8": {
			d: "195,-67v0,42,-33,73,-90,73v-51,0,-85,-27,-85,-67v0,-30,21,-53,47,-62v-24,-9,-40,-33,-40,-56v0,-38,32,-63,82,-63v80,0,112,87,29,114v30,11,57,30,57,61xm151,-59v0,-24,-15,-33,-58,-50v-42,16,-40,86,16,86v25,0,42,-15,42,-36xm144,-183v0,-19,-15,-31,-39,-31v-23,0,-38,13,-38,32v0,15,9,24,42,39v24,-12,35,-25,35,-40",
			w: 214,
			k: {
				"9": 2,
				"7": 4,
				"5": 2,
				"3": 7,
				"2": 2,
				".": 4
			}
		},
		
		"9": {
			d: "186,-94v0,79,-73,151,-139,168r-21,-24v42,-10,92,-49,105,-89v-52,31,-111,-8,-111,-67v0,-48,36,-83,84,-83v49,0,82,36,82,95xm139,-75v12,-36,-4,-83,-36,-83v-24,0,-40,20,-40,51v0,49,48,62,76,32",
			w: 205,
			k: {
				"9": 4,
				"7": 4,
				"3": 7,
				"2": 4,
				",": 4,
				"%": 7
			}
		},
		
		":": {
			d: "82,-23v0,15,-13,28,-28,28v-15,0,-27,-13,-27,-28v0,-16,12,-28,28,-28v15,0,27,12,27,28xm83,-134v0,16,-13,28,-28,28v-15,0,-28,-12,-28,-27v0,-16,13,-29,28,-29v15,0,28,13,28,28",
			w: 109
		},
		
		";": {
			d: "89,-12v0,29,-21,56,-48,65r-14,-18v15,-5,24,-16,24,-25v0,-10,-23,-7,-23,-32v0,-17,13,-29,29,-29v19,0,32,16,32,39xm84,-134v0,15,-12,29,-27,29v-15,0,-29,-14,-29,-29v0,-15,13,-28,28,-28v15,0,28,13,28,28",
			w: 116
		},
		
		"<": {
			d: "120,-29r-32,25r-79,-104r79,-103r32,25r-60,78",
			w: 136
		},
		
		"=": {
			d: "212,-124r-192,0r0,-36r192,0r0,36xm212,-58r-192,0r0,-37r192,0r0,37",
			w: 232
		},
		
		">": {
			d: "127,-108r-79,104r-32,-25r59,-79r-59,-78r32,-25",
			w: 135
		},
		
		"?": {
			d: "147,-195v0,63,-71,50,-58,115r-34,0v-8,-34,1,-56,25,-76v12,-9,27,-16,27,-35v-1,-39,-57,-30,-74,-11r-17,-26v12,-11,36,-25,68,-25v35,0,63,22,63,58xm103,-23v0,15,-12,28,-27,28v-15,0,-27,-13,-27,-28v0,-15,12,-27,27,-27v14,0,27,12,27,27",
			w: 170
		},
		
		"@": {
			d: "239,-150v-11,38,-25,74,-25,115v0,12,5,16,17,16v26,0,47,-34,47,-80v0,-56,-43,-102,-109,-102v-70,0,-115,62,-115,127v-1,83,80,129,160,101r7,24v-100,28,-201,-18,-201,-125v0,-85,63,-151,149,-151v80,0,143,50,143,126v0,63,-38,104,-82,104v-28,0,-40,-14,-41,-31v-28,35,-95,43,-99,-25v-4,-75,75,-141,149,-99xm202,-137v-54,-13,-80,43,-79,87v0,19,7,24,19,24v15,0,39,-14,46,-46",
			w: 331,
			k: {
				y: 7,
				x: 4,
				v: 4,
				s: 7
			}
		},
		
		A: {
			d: "210,0r-45,0r-20,-66r-81,0r-20,66r-43,0r82,-249r48,0xm135,-100v-4,-5,-25,-100,-30,-108v0,0,-25,91,-31,108r61,0",
			w: 211,
			k: {
				y: 2,
				v: 2,
				l: 2,
				c: 2,
				Y: 11,
				W: 4,
				V: 11,
				U: 4,
				T: 22,
				Q: 4,
				O: 4,
				C: 2,
				".": -4,
				",": -4
			}
		},
		
		B: {
			d: "96,-249v63,-3,94,17,94,61v0,27,-15,46,-43,54v41,10,53,38,53,63v0,74,-89,74,-169,71r0,-249r65,0xm154,-75v0,-41,-39,-40,-82,-38r0,79v42,4,82,-5,82,-41xm137,-157v23,-27,5,-62,-34,-58r-32,0r0,68v25,-1,54,5,66,-10",
			w: 219,
			k: {
				y: 4,
				x: 4,
				v: 2,
				u: 2,
				s: 4,
				q: 2,
				p: 2,
				g: 4,
				e: 4,
				a: 4,
				Z: 7,
				Y: 7,
				W: 4,
				V: 7,
				T: 14,
				A: 2
			}
		},
		
		C: {
			d: "66,-126v-8,82,54,121,110,82r19,26v-75,57,-175,-3,-175,-103v0,-103,92,-168,170,-113r-19,27v-55,-38,-113,7,-105,81",
			w: 207,
			k: {
				y: 14,
				w: 7,
				v: 11,
				u: 7,
				t: 4,
				s: 4,
				r: 5,
				q: 11,
				o: 11,
				n: 4,
				m: 4,
				l: 7,
				j: 4,
				i: 5,
				g: 7,
				e: 11,
				d: 7,
				c: 4,
				b: 4,
				a: 7,
				U: 4,
				S: 4,
				Q: 14,
				O: 14,
				G: 14,
				E: 4,
				C: 14,
				B: 4,
				"-": 22,
				" ": 7
			}
		},
		
		D: {
			d: "31,-249v110,-10,179,21,176,125v-2,77,-33,128,-115,124r-61,0r0,-249xm161,-120v0,-65,-19,-106,-89,-96r0,182v64,6,89,-16,89,-86",
			w: 227,
			k: {
				z: 7,
				y: 2,
				x: 5,
				u: 2,
				s: 4,
				e: 2,
				Z: 7,
				Y: 7,
				X: 7,
				W: 4,
				V: 7,
				T: 11,
				S: 7,
				A: 4,
				".": 7,
				",": 7
			}
		},
		
		E: {
			d: "172,0r-141,0r0,-249r138,0r-6,34r-91,0r0,68r77,0r0,34r-76,0r0,78r99,0r0,35",
			w: 183,
			k: {
				y: 4,
				w: 2,
				v: 5,
				u: 2,
				t: 2,
				s: 2,
				q: 4,
				o: 4,
				g: 4,
				e: 4,
				d: 4,
				c: 2,
				a: 2,
				S: 4,
				Q: 7,
				O: 7,
				G: 7,
				C: 7,
				"-": 4,
				" ": 4
			}
		},
		
		F: {
			d: "162,-249r-5,34r-85,0r0,67r69,0r0,34r-69,0r0,114r-41,0r0,-249r131,0",
			w: 158,
			k: {
				z: 2,
				x: 4,
				u: 4,
				s: 2,
				q: 4,
				p: 4,
				o: 4,
				n: 2,
				m: 2,
				g: 2,
				e: 4,
				d: 4,
				c: 4,
				a: 4,
				Y: 4,
				V: -4,
				T: 7,
				A: 4,
				".": 22,
				",": 22,
				" ": 4
			}
		},
		
		G: {
			d: "66,-121v0,74,39,109,99,85r0,-65r-43,0r-6,-34r91,0r0,117v-23,14,-50,21,-78,21v-71,1,-109,-52,-109,-126v0,-74,37,-127,108,-129v28,0,53,8,74,26r-21,26v-17,-13,-33,-19,-52,-19v-46,0,-63,40,-63,98",
			w: 233,
			k: {
				y: 4,
				w: 2,
				v: 4,
				a: 2,
				Y: 7,
				W: 7,
				V: 4,
				T: 7
			}
		},
		
		H: {
			d: "198,0r-41,0r0,-115r-85,0r0,115r-41,0r0,-249r41,0r0,100r85,0r0,-100r41,0r0,249",
			w: 228
		},
		
		I: {
			d: "73,0r-42,0r0,-249r42,0r0,249",
			w: 103
		},
		
		J: {
			d: "-1,32v27,-19,34,-24,34,-74r0,-207r42,0r0,203v2,69,-20,80,-57,100",
			w: 105
		},
		
		K: {
			d: "211,0r-54,0r-84,-133r81,-116r51,0r-86,115xm73,0r-42,0r0,-249r42,0r0,249",
			w: 209,
			k: {
				"\u00fc": 7,
				"\u00f6": 7,
				"\u00f5": 7,
				"\u00f4": 7,
				"\u00f3": 7,
				"\u00f2": 7,
				"\u00eb": 7,
				"\u00ea": 7,
				"\u00e9": 7,
				"\u00e8": 7,
				"\u00e5": 7,
				"\u00e4": 7,
				"\u00e3": 7,
				"\u00e2": 7,
				"\u00e1": 7,
				"\u00e0": 7,
				y: 5,
				w: 2,
				v: 7,
				u: 4,
				t: 2,
				s: 2,
				q: 7,
				p: 2,
				o: 7,
				g: 4,
				e: 7,
				d: 7,
				c: 7,
				a: 7,
				Y: 14,
				S: 7,
				Q: 11,
				O: 11,
				G: 7,
				C: 7,
				"-": 18,
				" ": 7
			}
		},
		
		L: {
			d: "165,-34r-7,34r-127,0r0,-249r42,0r0,215r92,0",
			w: 170,
			k: {
				y: 11,
				w: 7,
				v: 11,
				u: 2,
				q: 4,
				o: 4,
				e: 4,
				d: 2,
				c: 2,
				Y: 32,
				W: 18,
				V: 29,
				U: 7,
				T: 29,
				Q: 14,
				O: 14,
				G: 14,
				C: 14,
				"-": 18,
				" ": 7
			}
		},
		
		M: {
			d: "274,0r-41,0r-13,-198r-55,198r-35,0r-53,-198r-13,198r-41,0r23,-249r55,0r48,183v11,-59,33,-125,48,-183r55,0",
			w: 297,
			k: {
				y: 2,
				w: 2,
				v: 2,
				u: 2,
				e: 2,
				d: 2,
				c: 2,
				b: 2,
				a: 2,
				Y: 4,
				W: 4,
				V: 4,
				T: 7,
				S: 4
			}
		},
		
		N: {
			d: "199,0r-43,0r-56,-117v-13,-28,-27,-59,-32,-74r3,191r-40,0r0,-249r46,0v27,57,68,126,86,186v2,-43,-5,-127,-3,-186r39,0r0,249",
			w: 230
		},
		
		O: {
			d: "228,-124v0,78,-37,128,-102,128v-71,0,-106,-55,-106,-129v0,-82,42,-128,104,-128v70,0,104,56,104,129xm181,-122v0,-61,-13,-99,-58,-99v-42,0,-57,34,-57,94v0,64,17,100,59,100v37,0,56,-28,56,-95",
			w: 247,
			k: {
				x: 4,
				r: 2,
				l: 2,
				k: 2,
				h: 2,
				g: 2,
				f: 2,
				e: 2,
				d: 2,
				b: 2,
				a: 2,
				Z: 7,
				Y: 7,
				W: 4,
				V: 7,
				T: 11,
				S: 4,
				A: 4,
				".": 11,
				",": 7
			}
		},
		
		P: {
			d: "97,-249v69,-2,97,23,97,74v0,65,-52,87,-122,80r0,95r-41,0r0,-249r66,0xm149,-172v0,-42,-34,-47,-77,-44r0,88v43,2,77,-1,77,-44",
			w: 203,
			k: {
				y: -4,
				w: -4,
				v: -4,
				u: 4,
				t: -4,
				s: 4,
				q: 4,
				p: 2,
				o: 4,
				g: 4,
				e: 4,
				d: 4,
				c: 4,
				a: 4,
				Z: 7,
				T: 7,
				S: 4,
				A: 14,
				".": 43,
				",": 43
			}
		},
		
		Q: {
			d: "177,-10v26,11,38,31,78,24r-12,28v-51,16,-71,-38,-119,-38v-69,0,-104,-56,-104,-129v0,-81,41,-128,103,-128v68,0,105,52,105,129v0,55,-18,93,-51,114xm180,-122v0,-64,-14,-99,-57,-99v-40,0,-57,32,-57,94v0,75,22,99,59,99v36,0,55,-25,55,-94",
			w: 247,
			k: {
				Z: 4,
				Y: 7,
				W: 4,
				V: 7,
				T: 11,
				S: 4,
				A: 4,
				".": 7,
				",": -4
			}
		},
		
		R: {
			d: "201,0r-49,0v-25,-38,-42,-95,-81,-108r0,108r-40,0r0,-249r76,0v56,0,81,32,81,71v0,36,-23,69,-62,69v24,19,54,78,75,109xm71,-137v43,2,73,-1,73,-40v0,-33,-32,-42,-73,-39r0,79",
			w: 209,
			k: {
				u: 4,
				s: 2,
				q: 4,
				o: 4,
				g: 4,
				e: 4,
				d: 2,
				c: 2,
				a: 2,
				W: 4,
				T: 7,
				"-": 4
			}
		},
		
		S: {
			d: "136,-146v94,25,76,153,-36,151v-28,0,-58,-8,-82,-23r16,-31v34,25,115,34,116,-19v1,-48,-94,-38,-112,-75v-27,-53,10,-110,74,-110v28,0,57,9,79,24r-19,29v-23,-14,-38,-19,-58,-19v-24,0,-41,13,-41,34v0,24,40,33,63,39",
			w: 214,
			k: {
				y: 5,
				x: 2,
				v: 4,
				u: 2,
				p: 2,
				Z: 7,
				Y: 4,
				X: 4,
				W: 4,
				V: 7,
				T: 4,
				S: 7,
				Q: 4,
				P: 2,
				M: 4,
				E: 4,
				A: 7,
				" ": 7
			}
		},
		
		T: {
			d: "180,-249r-6,34r-62,0r0,215r-42,0r0,-215r-63,0r0,-34r173,0",
			w: 174,
			k: {
				"\u00fc": 4,
				"\u00fb": 7,
				"\u00fa": 14,
				"\u00f8": 18,
				"\u00f6": 7,
				"\u00f4": 7,
				"\u00f3": 18,
				"\u00ea": 7,
				"\u00e9": 18,
				"\u00e6": 18,
				"\u00e5": 18,
				"\u00e4": 7,
				"\u00e3": 7,
				"\u00e2": 14,
				"\u00e1": 18,
				"\u00e0": 18,
				"\u00d6": 4,
				"\u00c4": 14,
				z: 11,
				y: 14,
				x: 11,
				w: 11,
				v: 11,
				u: 14,
				s: 20,
				r: 14,
				q: 18,
				p: 11,
				o: 18,
				n: 11,
				m: 11,
				g: 14,
				e: 18,
				d: 18,
				c: 18,
				a: 18,
				Y: 7,
				W: -4,
				V: 7,
				T: 4,
				S: 4,
				Q: 4,
				O: 4,
				G: 4,
				D: -4,
				C: 4,
				A: 14,
				".": 14,
				"-": 11,
				",": 22
			}
		},
		
		U: {
			d: "201,-70v0,46,-31,74,-86,74v-66,0,-86,-33,-86,-73r0,-180r42,0r0,167v0,38,13,51,44,51v30,0,45,-18,45,-51r0,-167r41,0r0,179",
			w: 230,
			k: {
				s: 4,
				q: 2,
				p: 2,
				o: 2,
				g: 4,
				e: 2,
				d: 2,
				c: 2,
				a: 2,
				A: 4
			}
		},
		
		V: {
			d: "206,-249r-85,250r-39,0r-84,-250r46,0r45,141v22,67,5,68,28,-2r46,-139r43,0",
			w: 204,
			k: {
				"\u00fc": 7,
				"\u00fb": 14,
				"\u00fa": 14,
				"\u00f9": 14,
				"\u00f6": 11,
				"\u00f5": 7,
				"\u00f4": 7,
				"\u00f3": 18,
				"\u00f2": 7,
				"\u00eb": 7,
				"\u00ea": 7,
				"\u00e9": 18,
				"\u00e8": 7,
				"\u00e5": 18,
				"\u00e4": 11,
				"\u00e2": 7,
				"\u00e1": 18,
				"\u00e0": 7,
				"\u00d6": 4,
				"\u00c4": 11,
				z: 7,
				y: 4,
				x: 7,
				u: 14,
				s: 18,
				r: 11,
				q: 18,
				p: 11,
				o: 18,
				n: 11,
				m: 11,
				j: 4,
				i: 4,
				g: 18,
				f: 4,
				e: 18,
				d: 18,
				c: 18,
				a: 18,
				Z: 4,
				S: 7,
				Q: 7,
				O: 7,
				M: 4,
				C: 7,
				A: 11,
				".": 36,
				"-": 11,
				",": 36,
				" ": 7
			}
		},
		
		W: {
			d: "294,-249r-59,250r-48,0r-39,-187v-5,40,-26,139,-36,187r-49,0r-59,-250r44,0r25,116v10,40,11,81,14,80v6,-41,29,-146,40,-196r46,0r39,194r39,-194r43,0",
			w: 297,
			k: {
				"\u00fc": 7,
				"\u00fb": 7,
				"\u00fa": 7,
				"\u00f9": 7,
				"\u00f6": 7,
				"\u00f5": 7,
				"\u00f4": 11,
				"\u00f3": 11,
				"\u00f2": 7,
				"\u00eb": 7,
				"\u00ea": 7,
				"\u00e9": 11,
				"\u00e8": 7,
				"\u00e5": 11,
				"\u00e4": 11,
				"\u00e3": 11,
				"\u00e2": 11,
				"\u00e1": 11,
				"\u00e0": 11,
				z: 5,
				y: 4,
				u: 7,
				s: 11,
				r: 5,
				q: 11,
				p: 7,
				o: 11,
				n: 5,
				m: 5,
				j: 2,
				i: 4,
				g: 11,
				e: 11,
				d: 11,
				c: 11,
				a: 11,
				Z: 7,
				S: 4,
				Q: 4,
				O: 4,
				M: 4,
				G: 4,
				C: 7,
				A: 4,
				".": 25,
				"-": 5,
				",": 18,
				" ": 4
			}
		},
		
		X: {
			d: "200,0r-50,0r-51,-99r-50,99r-51,0r77,-134r-67,-115r50,0r40,77r39,-77r49,0r-63,113",
			w: 198,
			k: {
				y: 7,
				w: 4,
				v: 7,
				u: 4,
				t: 4,
				q: 4,
				p: 4,
				o: 4,
				j: 4,
				i: 4,
				g: 4,
				e: 4,
				d: 4,
				c: 4,
				a: 4,
				C: 7,
				".": -4,
				"-": 7,
				" ": 4
			}
		},
		
		Y: {
			d: "195,-249r-79,149r0,100r-43,0r0,-101r-78,-148r50,0r50,110r52,-110r48,0",
			w: 190,
			k: {
				"\u00fc": 14,
				"\u00fb": 14,
				"\u00fa": 14,
				"\u00f9": 14,
				"\u00f6": 14,
				"\u00f5": 7,
				"\u00f4": 11,
				"\u00f3": 22,
				"\u00f2": 11,
				"\u00eb": 7,
				"\u00ea": 7,
				"\u00e9": 22,
				"\u00e8": 7,
				"\u00e5": 22,
				"\u00e4": 11,
				"\u00e3": 7,
				"\u00e2": 7,
				"\u00e1": 22,
				"\u00e0": 7,
				"\u00d6": 7,
				"\u00c4": 11,
				z: 7,
				x: 7,
				w: 4,
				v: 4,
				u: 14,
				s: 22,
				r: 11,
				q: 22,
				p: 14,
				o: 22,
				n: 11,
				m: 11,
				g: 22,
				e: 22,
				d: 22,
				c: 22,
				a: 22,
				S: 7,
				Q: 7,
				O: 11,
				M: 4,
				G: 7,
				C: 7,
				A: 11,
				".": 36,
				"-": 18,
				",": 36,
				" ": 4
			}
		},
		
		Z: {
			d: "179,-34r-11,34r-152,0r0,-30r97,-162v8,-13,17,-24,17,-24v-26,2,-78,1,-109,1r9,-34r146,0r0,31r-96,164v-5,9,-15,21,-15,21v28,-2,81,-1,114,-1",
			w: 194,
			k: {
				y: 11,
				w: 4,
				v: 7,
				u: 4,
				t: 4,
				s: 4,
				r: 4,
				q: 7,
				o: 11,
				n: 4,
				m: 4,
				l: 4,
				j: 4,
				i: 4,
				g: 7,
				e: 11,
				d: 7,
				c: 7,
				a: 7,
				U: 4,
				S: 4,
				Q: 7,
				O: 7,
				G: 7,
				C: 11,
				"-": 11,
				" ": 4
			}
		},
		
		"[": {
			d: "99,56r-68,0r0,-320r68,0r0,27r-33,0r0,266r33,0r0,27",
			w: 107
		},
		
		"\\": {
			d: "146,7r-33,11r-108,-280r33,-11",
			w: 151
		},
		
		"]": {
			d: "77,56r-68,0r0,-27r33,0r0,-266r-33,0r0,-27r68,0r0,320",
			w: 107
		},
		
		"^": {
			d: "200,-114r-41,0r-49,-103r-50,103r-40,0r70,-141r40,0",
			w: 219
		},
		
		_: {
			d: "182,45r-180,0r0,-18r180,0r0,18",
			w: 183
		},
		
		"`": {
			d: "104,-224r-12,22r-79,-36r18,-34",
			w: 116
		},
		
		a: {
			d: "23,-162v54,-35,136,-47,136,50v0,34,-10,81,15,94r-21,26v-11,-4,-20,-13,-24,-25v-32,41,-111,22,-111,-32v0,-46,40,-67,102,-64v0,-24,1,-41,-25,-41v-26,0,-54,20,-54,20xm120,-86v-39,-2,-59,9,-59,35v0,36,45,34,58,9",
			w: 189,
			k: {
				y: 2,
				w: 2,
				s: 4,
				d: 2
			}
		},
		
		b: {
			d: "184,-94v0,80,-68,128,-117,77v-2,9,-2,12,-5,17r-36,0v9,-67,8,-185,0,-256r41,-9v6,26,1,71,3,96v51,-42,114,-2,114,75xm140,-94v0,-33,-7,-59,-35,-59v-17,0,-28,9,-35,18r0,89v30,28,70,21,70,-48",
			w: 204,
			k: {
				z: 4,
				y: 4,
				x: 7,
				w: 2,
				v: 2,
				u: 2,
				s: 4,
				p: 2,
				l: 4,
				j: 2,
				i: 2,
				g: 2,
				a: 2,
				".": 4
			}
		},
		
		c: {
			d: "64,-86v-7,59,41,76,73,42r19,25v-52,51,-136,18,-136,-70v0,-89,75,-124,130,-78r-19,26v-37,-34,-74,-1,-67,55",
			w: 168,
			k: {
				x: 2,
				u: 2,
				s: 4,
				r: 2,
				q: 7,
				p: 2,
				o: 5,
				n: 4,
				m: 4,
				l: 2,
				k: 9,
				j: 4,
				i: 4,
				h: 9,
				g: 5,
				f: 4,
				e: 7,
				d: 7,
				c: 7,
				b: 5,
				a: 5,
				"@": 7,
				".": 2,
				"-": 4,
				" ": 4
			}
		},
		
		d: {
			d: "179,0r-37,0v-2,-4,-2,-6,-3,-14v-51,44,-119,3,-119,-75v0,-74,63,-123,115,-80r-1,-96r39,6v2,80,-6,194,6,259xm134,-46r0,-93v-32,-30,-75,-16,-70,49v-10,60,45,77,70,44",
			w: 203,
			k: {
				s: 2,
				p: 2,
				d: 2,
				a: 2
			}
		},
		
		e: {
			d: "98,-186v53,0,78,37,74,106r-109,0v0,28,8,53,45,54v17,0,32,-6,46,-18r15,25v-58,51,-149,17,-149,-72v0,-55,28,-95,78,-95xm131,-109v0,-30,-13,-48,-33,-48v-22,0,-34,18,-34,48r67,0",
			w: 188,
			k: {
				x: 2,
				s: 2,
				g: 2,
				b: 2,
				a: 4
			}
		},
		
		f: {
			d: "127,-254r-13,25v-20,-11,-45,-7,-45,19r0,28r48,0r-10,27r-37,0r0,155r-39,0r0,-155r-17,0r0,-27r17,0v-7,-40,12,-83,55,-83v15,0,28,4,41,11",
			w: 114,
			k: {
				y: -7,
				x: -4,
				w: -7,
				v: -7,
				u: 2,
				t: -2,
				s: 2,
				q: 2,
				o: 2,
				n: 2,
				m: 2,
				g: 4,
				e: 2,
				d: 4,
				c: 2,
				a: 5,
				"@": 4,
				".": 7,
				"-": 4,
				",": 4,
				" ": 4
			}
		},
		
		g: {
			d: "200,-165v-12,12,-31,14,-46,10v26,30,3,96,-57,88v-13,5,-24,11,-24,17v0,7,2,8,45,8v29,0,61,14,61,51v0,39,-32,60,-81,60v-55,0,-94,-24,-78,-69r37,0v-9,21,4,39,37,39v28,0,44,-11,44,-28v0,-20,-17,-25,-51,-25v-82,0,-71,-48,-25,-59v-69,-20,-45,-119,31,-113v42,3,62,20,89,-4xm124,-125v0,-21,-10,-32,-31,-32v-20,0,-31,11,-31,32v0,21,12,31,31,31v21,0,31,-11,31,-31",
			k: {
				z: -2,
				y: -4,
				x: -2,
				w: -4,
				v: -4,
				t: -4,
				s: 2,
				q: 4,
				o: 4,
				j: -2,
				g: 2,
				e: 4,
				c: 2,
				b: 2,
				a: 4,
				"@": 4,
				"-": 2
			}
		},
		
		h: {
			d: "70,-163v37,-36,106,-33,106,34r0,129r-38,0r0,-124v-2,-48,-47,-28,-67,-7r0,131r-40,0r0,-217v0,-16,-2,-30,-4,-39r40,-9v6,22,4,75,3,102",
			w: 206,
			k: {
				y: 2,
				x: 2,
				w: 2,
				v: 2,
				l: 4,
				g: 2,
				a: 4
			}
		},
		
		i: {
			d: "71,0r-40,0r0,-179r40,-7r0,186xm77,-235v0,14,-12,26,-27,26v-14,0,-25,-12,-25,-26v0,-15,11,-27,26,-27v14,0,26,12,26,27",
			w: 101,
			k: {
				y: 4,
				x: 4,
				s: 4,
				q: 2,
				l: 2,
				g: 1,
				a: 2
			}
		},
		
		j: {
			d: "71,-4v-3,58,-16,60,-48,80r-17,-23v19,-13,25,-27,25,-57r0,-175r40,-7r0,182xm77,-236v0,15,-12,27,-27,27v-14,0,-26,-11,-26,-26v0,-14,12,-27,26,-27v14,0,27,12,27,26",
			w: 101,
			k: {
				x: 2,
				v: 4,
				s: 4,
				q: 4,
				o: 3,
				g: 2,
				e: 2,
				c: 2,
				a: 4
			}
		},
		
		k: {
			d: "70,0r-39,0r0,-212v0,-18,-1,-30,-4,-44r39,-10v9,79,2,180,4,266xm189,0r-48,0r-68,-103r54,-79r48,0r-63,77",
			w: 187,
			k: {
				"\u00f6": 7,
				"\u00e4": 5,
				y: 4,
				w: 2,
				v: 2,
				u: 5,
				s: 4,
				r: 4,
				q: 7,
				o: 7,
				l: 5,
				j: 4,
				i: 4,
				h: 4,
				g: 4,
				e: 7,
				d: 7,
				c: 7,
				b: 4,
				a: 5,
				"@": 7,
				"-": 11,
				" ": 11
			}
		},
		
		l: {
			d: "71,-60v1,33,-2,34,17,35r6,25v-7,3,-14,4,-23,4v-40,0,-40,-37,-40,-52r0,-155v0,-25,-1,-38,-4,-53r41,-9v7,57,1,141,3,205",
			w: 101,
			k: {
				s: 2,
				q: 2,
				l: 4,
				j: 4,
				g: 4,
				e: 2,
				d: 2,
				b: 2,
				a: 4,
				".": -2,
				" ": 4
			}
		},
		
		m: {
			d: "260,0r-39,0r0,-126v1,-46,-39,-24,-57,-6r0,132r-38,0r0,-125v1,-44,-36,-29,-57,-10r0,135r-38,0v-2,-56,6,-134,-7,-177r36,-10v4,6,6,14,7,24v28,-28,66,-36,91,3v34,-38,102,-41,102,27r0,133",
			w: 290,
			k: {
				y: 2,
				w: 2,
				v: 2,
				l: 2,
				g: 2,
				a: 4
			}
		},
		
		n: {
			d: "170,0r-40,0r0,-121v1,-52,-40,-31,-61,-11r0,132r-38,0v-3,-58,7,-130,-7,-177r36,-10v4,8,6,16,6,26v35,-37,104,-37,104,25r0,136",
			w: 200,
			k: {
				z: 2,
				y: 2,
				x: 2,
				w: 2,
				v: 2,
				s: 4,
				l: 3,
				g: 2,
				a: 4
			}
		},
		
		o: {
			d: "179,-90v0,59,-32,95,-81,95v-49,0,-80,-38,-80,-96v0,-58,32,-95,80,-95v52,0,81,38,81,96xm135,-90v0,-51,-14,-67,-37,-67v-25,0,-36,20,-36,64v0,53,13,68,37,68v23,0,36,-19,36,-65",
			k: {
				z: 2,
				y: 2,
				x: 7,
				w: 2,
				v: 4,
				s: 2,
				l: 2,
				b: 2,
				a: 2,
				".": 2,
				",": 2
			}
		},
		
		p: {
			d: "184,-95v0,80,-58,124,-116,84v2,19,1,56,1,79r-38,9r0,-212v0,-23,-1,-32,-4,-45r36,-7v2,6,3,11,3,22v47,-44,118,-19,118,70xm141,-91v0,-66,-40,-77,-72,-44r0,91v32,30,72,18,72,-47",
			w: 203,
			k: {
				z: 2,
				y: 4,
				x: 7,
				w: 2,
				v: 2,
				u: 2,
				s: 5,
				p: 2,
				l: 2,
				j: 2,
				g: 2,
				a: 2,
				".": 4,
				",": 2
			}
		},
		
		q: {
			d: "177,-182v-9,72,-2,170,-4,250r-38,10r1,-92v-49,42,-116,9,-116,-73v0,-87,72,-128,120,-78v0,-9,1,-12,3,-17r34,0xm135,-48r0,-87v-27,-34,-72,-17,-72,41v0,75,44,80,72,46",
			w: 203,
			k: {
				s: 4,
				o: 2,
				b: 2
			}
		},
		
		r: {
			d: "128,-184r-12,36v-22,-7,-41,6,-46,25r0,123r-39,0v-2,-57,6,-134,-7,-177r36,-10v4,8,7,19,7,29v17,-24,35,-35,61,-26",
			w: 126,
			k: {
				z: -2,
				y: -5,
				x: -4,
				w: -4,
				v: -7,
				t: -5,
				s: 2,
				q: 2,
				o: 2,
				g: 2,
				f: -4,
				e: 2,
				d: 2,
				c: 2,
				a: 4,
				"@": 4,
				".": 7,
				"-": 4,
				",": 7
			}
		},
		
		s: {
			d: "112,-108v81,19,47,113,-28,113v-22,0,-47,-7,-70,-20r14,-29v23,16,84,37,89,-6v3,-21,-29,-26,-51,-30v-27,-5,-44,-24,-44,-50v0,-59,89,-71,128,-42r-13,27v-26,-16,-69,-22,-73,10v-3,18,30,23,48,27",
			w: 174,
			k: {
				z: 4,
				x: 4,
				v: 2,
				u: 2,
				t: 2,
				s: 4,
				q: 2,
				p: 2,
				n: 2,
				l: 2,
				j: 2,
				i: 4,
				c: 2,
				b: 4,
				a: 5,
				"@": 4,
				" ": 4
			}
		},
		
		t: {
			d: "114,-3v-36,19,-83,3,-83,-39r0,-113r-21,0r0,-27r21,0v0,-15,-1,-31,1,-45r41,-10v-2,15,-3,37,-3,55r43,0r-10,27r-34,0r0,102v-2,31,18,35,40,26",
			w: 122,
			k: {
				x: -4,
				v: -2,
				u: 4,
				q: 4,
				o: 2,
				n: 4,
				g: 4,
				e: 2,
				d: 4,
				c: 4,
				b: 4,
				a: 4,
				"@": 4,
				".": -2,
				"-": 4,
				" ": 4
			}
		},
		
		u: {
			d: "136,-17v-32,36,-107,31,-107,-39r0,-123r39,-7r0,122v-8,49,49,46,62,15r0,-130r38,-7v3,52,-8,144,11,173r-27,19v-8,-6,-13,-13,-16,-23",
			w: 198,
			k: {
				y: 2,
				w: 2,
				v: 2,
				s: 2,
				n: 4,
				l: 2
			}
		},
		
		v: {
			d: "170,-182r-66,183r-35,0r-65,-182r40,-5r44,138v7,-32,30,-98,41,-134r41,0",
			w: 173,
			k: {
				z: 4,
				u: 2,
				s: 4,
				q: 4,
				o: 4,
				n: 2,
				j: 4,
				i: 4,
				g: 4,
				e: 2,
				d: 4,
				c: 2,
				b: 2,
				a: 4,
				"@": 4,
				".": 9,
				"-": 2,
				",": 11,
				" ": 4
			}
		},
		
		w: {
			d: "249,-182r-51,183r-37,0r-35,-134v-3,19,-26,105,-34,134r-37,0r-50,-181r40,-5r30,136v3,-28,25,-101,34,-133r39,0r33,134v4,-29,20,-99,27,-134r41,0",
			w: 254,
			k: {
				u: 2,
				s: 2,
				q: 2,
				o: 2,
				j: 2,
				i: 4,
				g: 4,
				e: 2,
				a: 4,
				".": 5,
				",": 7
			}
		},
		
		x: {
			d: "177,0r-50,0v-6,-10,-35,-62,-39,-68v-7,14,-33,58,-40,68r-50,0r68,-99r-53,-78r43,-8v8,14,24,42,33,59v5,-12,24,-48,29,-56r46,0r-53,83",
			w: 175,
			k: {
				u: 4,
				s: 2,
				q: 5,
				o: 7,
				n: 2,
				l: 2,
				j: 4,
				i: 4,
				g: 2,
				e: 4,
				d: 5,
				c: 5,
				b: 4,
				a: 4,
				"@": 4,
				"-": 7,
				" ": 7
			}
		},
		
		y: {
			d: "174,-182r-65,186v-15,44,-27,66,-70,74r-13,-26v25,-7,39,-17,49,-52r-13,0v-17,-65,-38,-118,-58,-179r40,-7r43,152v8,-34,32,-109,44,-148r43,0",
			w: 177,
			k: {
				u: 2,
				s: 4,
				r: 2,
				q: 4,
				o: 4,
				n: 4,
				j: 4,
				i: 4,
				g: 4,
				e: 2,
				d: 2,
				c: 2,
				b: 2,
				a: 4,
				"@": 7,
				".": 11,
				"-": 4,
				",": 11,
				" ": 4
			}
		},
		
		z: {
			d: "154,-28r-11,28r-129,0r0,-26r92,-128r-84,0r0,-28r128,0r0,28r-86,126r90,0",
			w: 168,
			k: {
				u: 4,
				t: 4,
				s: 2,
				r: 2,
				q: 2,
				p: 2,
				o: 4,
				l: 4,
				k: 2,
				j: 4,
				i: 4,
				g: 4,
				e: 5,
				d: 5,
				c: 4,
				b: 4,
				a: 5,
				"-": 4,
				" ": 4
			}
		},
		
		"{": {
			d: "120,56v-45,3,-75,-1,-75,-50r0,-62v0,-24,-24,-31,-36,-31r0,-33v12,0,36,-9,36,-32v-2,-49,-4,-117,42,-112r33,0r0,33v-24,-3,-45,5,-40,25r0,61v1,33,-22,37,-33,42v13,1,33,7,33,40v0,39,-21,95,40,86r0,33",
			w: 128
		},
		
		"|": {
			d: "67,75r-36,0r0,-348r36,0r0,348",
			w: 97
		},
		
		"}": {
			d: "120,-87v-12,0,-36,7,-36,31r0,63v-2,48,-31,52,-75,49r0,-33v24,4,44,-7,40,-26r0,-60v-1,-37,23,-35,33,-42v-13,-1,-33,-8,-33,-40v0,-39,21,-94,-40,-86r0,-33v44,-2,75,0,75,49r0,63v0,23,24,32,36,32r0,33",
			w: 128
		},
		
		"~": {
			d: "64,-140v26,-1,54,23,77,25v15,0,23,-13,31,-25r12,30v-9,15,-21,32,-44,32v-38,0,-87,-50,-109,-1r-11,-30v9,-15,21,-31,44,-31",
			w: 203
		},
		
		"\u00a0": {
			w: 81
		},
		
		"\u00a1": {
			d: "77,63r-48,7r9,-177r30,0xm79,-162v0,15,-11,27,-26,27v-14,0,-26,-12,-26,-26v0,-15,11,-27,26,-27v14,0,26,11,26,26",
			w: 106
		},
		
		"\u00a2": {
			d: "86,3v-45,-5,-66,-42,-66,-93v0,-61,34,-90,65,-96r0,-32r28,0r0,32v11,0,26,7,39,19r-20,26v-33,-33,-70,-6,-70,54v0,60,48,77,76,43r19,24v-15,15,-27,21,-44,23r0,34r-27,0r0,-34",
			w: 169
		},
		
		"\u00a3": {
			d: "204,-236r-29,31v-29,-33,-87,-9,-79,37r0,22r57,0r0,31r-57,0r0,80r90,0r0,35r-170,0r0,-35r36,0r0,-80r-34,0r0,-31r34,0v-6,-68,21,-112,84,-113v24,0,50,6,68,23",
			w: 213
		},
		
		"\u00a4": {
			d: "145,-34r-34,21v-6,-9,-11,-19,-14,-24v-11,2,-24,1,-34,-1r-14,25r-32,-21r15,-24v-16,-20,-14,-60,1,-79r-16,-25r34,-20v6,9,11,19,14,24v11,-2,21,-1,32,0v4,-9,13,-24,13,-24r33,20r-15,24v14,15,17,61,1,79xm54,-99v0,27,5,40,27,41v15,0,26,-10,26,-39v0,-27,-8,-39,-27,-39v-21,0,-26,14,-26,37",
			w: 164
		},
		
		"\u00a5": {
			d: "203,-249r-58,106r45,0r0,30r-60,0v-6,7,-8,18,-7,32r67,0r0,30r-67,0r0,51r-43,0r0,-51r-64,0r0,-30r64,0v1,-14,-1,-25,-7,-32r-57,0r0,-30r42,0r-56,-106r50,0r51,110v15,-38,34,-74,51,-110r49,0",
			w: 204
		},
		
		"\u00a6": {
			d: "67,-131r-36,0r0,-142r36,0r0,142xm67,75r-36,0r0,-142r36,0r0,142",
			w: 97
		},
		
		"\u00a7": {
			d: "130,-7v-13,-46,-110,-36,-108,-100v0,-24,13,-41,34,-53v-16,-10,-25,-24,-25,-42v3,-74,117,-78,147,-23r-38,21v-9,-27,-64,-33,-64,2v0,25,36,31,56,41v26,13,54,27,54,59v0,21,-13,39,-31,48v14,11,22,26,22,44v0,80,-133,84,-161,19r38,-18v5,19,24,27,42,27v15,0,34,-7,34,-25xm128,-67v28,-13,16,-53,-11,-58r-35,-16v-11,5,-19,12,-19,25v0,34,43,34,65,49",
			w: 202
		},
		
		"\u00a8": {
			d: "144,-227v0,14,-12,25,-25,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,25,-25v13,0,24,11,24,25xm68,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25",
			w: 163
		},
		
		"\u00a9": {
			d: "286,-128v0,75,-60,134,-133,134v-73,0,-133,-59,-133,-134v0,-75,60,-134,133,-134v73,0,133,59,133,134xm256,-128v0,-60,-46,-107,-103,-107v-57,0,-103,47,-103,107v0,60,46,108,103,108v57,0,103,-48,103,-108xm124,-131v-6,50,28,70,61,47r13,20v-45,36,-115,-1,-108,-61v-6,-63,57,-103,105,-70r-14,21v-30,-23,-62,2,-57,43",
			w: 306
		},
		
		"\u00aa": {
			d: "22,-259v35,-25,102,-30,102,25v0,29,-9,72,11,84r-15,19v-8,-4,-16,-10,-19,-19v-21,32,-90,18,-83,-24v-1,-35,30,-49,77,-47v6,-44,-36,-34,-60,-16xm138,-84r-124,0r0,-24r124,0r0,24xm94,-201v-25,-2,-44,1,-44,26v0,27,33,26,44,7r0,-33",
			w: 151
		},
		
		"\u00ab": {
			d: "174,-25r-27,18r-55,-82r55,-81r27,18r-42,63xm94,-25r-27,18r-54,-82r54,-81r27,18r-42,63",
			w: 186
		},
		
		"\u00ac": {
			d: "173,-24r-39,0r0,-50r-114,0r0,-34r153,0r0,84",
			w: 192
		},
		
		"\u00ad": {
			d: "99,-80r-79,0r0,-36r79,0r0,36",
			w: 118
		},
		
		"\u00ae": {
			d: "286,-128v0,75,-60,134,-133,134v-73,0,-133,-59,-133,-134v0,-75,60,-134,133,-134v73,0,133,59,133,134xm256,-128v0,-60,-46,-107,-103,-107v-57,0,-103,47,-103,107v0,60,46,108,103,108v57,0,103,-48,103,-108xm215,-54r-36,0v-13,-17,-30,-65,-43,-62r0,62r-30,0r0,-150v48,-2,100,-5,100,44v0,23,-15,42,-33,42v13,10,40,61,42,64xm136,-139v23,1,38,-1,38,-20v0,-19,-17,-22,-38,-21r0,41",
			w: 306
		},
		
		"\u00af": {
			d: "117,-242r-106,0r0,-25r106,0r0,25",
			w: 127
		},
		
		"\u00b0": {
			d: "132,-190v0,38,-23,61,-60,61v-37,0,-59,-23,-59,-61v0,-37,23,-62,59,-62v38,0,60,23,60,62xm100,-190v0,-28,-9,-39,-28,-39v-19,0,-27,12,-27,37v0,27,9,40,28,40v19,0,27,-12,27,-38",
			w: 145
		},
		
		"\u00b1": {
			d: "166,-100r-54,0r0,52r-38,0r0,-52r-54,0r0,-36r54,0r0,-49r38,0r0,49r54,0r0,36xm166,0r-145,0r0,-36r145,0r0,36",
			w: 186
		},
		
		"\u00b2": {
			d: "117,-193v0,31,-34,58,-55,78v19,-2,40,-1,60,-1r-7,26r-94,0r0,-20v17,-13,65,-60,62,-80v-4,-29,-34,-18,-50,-4r-17,-18v32,-34,101,-32,101,19",
			w: 138
		},
		
		"\u00b3": {
			d: "86,-137v0,-20,-18,-18,-42,-18r0,-24v15,0,39,4,40,-15v-4,-23,-36,-16,-51,-2r-17,-19v30,-29,99,-27,101,18v0,15,-6,23,-18,31v13,6,22,17,22,31v0,38,-50,59,-96,50r-8,-23v32,8,69,1,69,-29",
			w: 137
		},
		
		"\u00b4": {
			d: "104,-238r-79,36r-12,-22r73,-48",
			w: 116
		},
		
		"\u00b5": {
			d: "69,-62v-6,46,50,43,62,13r0,-130r39,-7r0,138v0,26,11,35,11,35r-28,18v-8,-6,-12,-13,-15,-23v-16,18,-45,32,-69,17v2,21,1,46,1,69r-39,9r0,-257r38,-7r0,125",
			w: 200
		},
		
		"\u00b6": {
			d: "188,45r-29,0r0,-276r-41,0r0,276r-29,0r0,-165v-46,0,-76,-28,-76,-65v0,-83,94,-70,175,-70r0,300",
			w: 218
		},
		
		"\u00b7": {
			d: "80,-99v0,16,-14,29,-29,29v-16,0,-28,-13,-28,-29v0,-16,13,-30,28,-30v16,0,29,14,29,30",
			w: 102
		},
		
		"\u00b8": {
			d: "87,40v0,28,-44,39,-67,23r9,-20v8,6,29,11,31,-3v1,-9,-14,-12,-22,-8v-5,-12,4,-24,6,-36r23,2r-5,15v19,2,25,14,25,27",
			w: 106
		},
		
		"\u00b9": {
			d: "105,-90r-74,0r0,-25r23,0r0,-83v-9,5,-19,11,-29,14r-9,-18v23,-11,33,-34,69,-31r0,118r20,0r0,25",
			w: 120
		},
		
		"\u00ba": {
			d: "135,-203v0,41,-21,71,-60,71v-37,0,-60,-27,-60,-71v0,-44,24,-72,60,-72v39,0,60,28,60,72xm102,-203v0,-37,-11,-47,-27,-47v-18,0,-26,14,-26,44v0,37,10,49,27,49v17,0,26,-14,26,-46xm137,-84r-123,0r0,-24r123,0r0,24",
			w: 151
		},
		
		"\u00bb": {
			d: "174,-89r-55,82r-26,-18r41,-64r-41,-63r26,-18xm94,-89r-54,82r-27,-18r42,-64r-42,-63r27,-18",
			w: 186
		},
		
		"\u00bc": {
			d: "284,-275r-189,330r-31,0r189,-330r31,0xm332,-26r-17,0v2,8,1,19,1,29r-30,5r0,-34r-64,0r0,-20r40,-97r33,0v-4,8,-24,65,-39,92v9,-1,23,2,30,-1v0,-17,3,-36,4,-53r26,-6v-1,19,2,45,-1,60r17,0r0,25xm105,-90r-74,0r0,-25r23,0r0,-83v-9,5,-19,11,-29,14r-9,-18v23,-11,33,-34,69,-31r0,118r20,0r0,25",
			w: 348
		},
		
		"\u00bd": {
			d: "274,-275r-189,330r-32,0r189,-330r32,0xm323,-103v0,31,-34,58,-55,78v19,-2,40,-1,60,-1r-7,26r-95,0r0,-20v18,-13,66,-60,63,-80v-4,-29,-34,-18,-50,-4r-17,-18v32,-34,101,-32,101,19xm105,-90r-74,0r0,-25r23,0r0,-83v-9,5,-19,11,-29,14r-9,-18v23,-11,33,-34,69,-31r0,118r20,0r0,25",
			w: 344
		},
		
		"\u00be": {
			d: "301,-275r-189,330r-32,0r189,-330r32,0xm348,-26r-16,0r0,29r-30,5v1,-11,-1,-25,1,-34r-64,0v1,-51,28,-76,39,-117r33,0v-4,8,-23,65,-38,92v9,-1,23,2,30,-1v0,-17,3,-36,4,-53r25,-6v2,19,-4,45,2,60r14,0r0,25xm86,-137v0,-20,-18,-18,-42,-18r0,-24v15,0,39,4,40,-15v-4,-23,-36,-16,-51,-2r-17,-19v30,-29,99,-27,101,18v0,15,-6,23,-18,31v13,6,22,17,22,31v0,38,-50,59,-96,50r-8,-23v32,8,69,1,69,-29",
			w: 364
		},
		
		"\u00bf": {
			d: "23,12v4,-65,70,-50,58,-115r34,0v5,28,-1,60,-25,75v-16,10,-27,19,-27,35v0,39,56,30,73,12r17,25v-27,33,-135,38,-130,-32xm121,-161v0,15,-13,27,-28,27v-14,0,-26,-12,-26,-27v0,-15,12,-27,27,-27v15,0,27,12,27,27",
			w: 169
		},
		
		"\u00c0": {
			d: "212,0r-45,0r-20,-66r-81,0r-20,66r-43,0r82,-249r47,0xm137,-100v-4,-5,-25,-100,-30,-108v0,0,-25,91,-31,108r61,0xm145,-282r-12,23r-79,-37r18,-33",
			w: 211
		},
		
		"\u00c1": {
			d: "212,0r-45,0r-20,-66r-81,0r-20,66r-43,0r82,-249r47,0xm137,-100v-4,-5,-25,-100,-30,-108v0,0,-25,91,-31,108r61,0xm164,-296r-79,37r-12,-23r73,-47",
			w: 211
		},
		
		"\u00c2": {
			d: "212,0r-45,0r-20,-66r-81,0r-20,66r-43,0r82,-249r47,0xm137,-100v-4,-5,-25,-100,-30,-108v0,0,-25,91,-31,108r61,0xm171,-279r-14,22r-50,-30r-48,30r-14,-22r63,-49",
			w: 211
		},
		
		"\u00c3": {
			d: "212,0r-45,0r-20,-66r-81,0r-20,66r-43,0r82,-249r47,0xm137,-100v-4,-5,-25,-100,-30,-108v0,0,-25,91,-31,108r61,0xm170,-291v-12,15,-23,24,-44,24v-28,0,-50,-30,-71,-2r-13,-22v12,-15,23,-24,44,-24v27,0,51,29,71,2",
			w: 211
		},
		
		"\u00c4": {
			d: "212,0r-45,0r-20,-66r-81,0r-20,66r-43,0r82,-249r47,0xm137,-100v-4,-5,-25,-100,-30,-108v0,0,-25,91,-31,108r61,0xm95,-284v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-26,24,-26v13,0,24,12,24,26xm170,-284v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-26,24,-26v13,0,24,12,24,26",
			w: 211,
			k: {
				Y: 11,
				V: 11,
				T: 22
			}
		},
		
		"\u00c5": {
			d: "212,0r-45,0r-20,-66r-81,0r-20,66r-43,0r82,-249r47,0xm137,-100v-4,-5,-25,-100,-30,-108v0,0,-25,91,-31,108r61,0xm145,-295v0,21,-17,38,-38,38v-21,0,-38,-17,-38,-38v0,-21,17,-38,38,-38v21,0,38,17,38,38xm128,-295v0,-12,-9,-21,-21,-21v-12,0,-21,9,-21,21v0,12,9,21,21,21v12,0,21,-9,21,-21",
			w: 211
		},
		
		"\u00c6": {
			d: "296,0r-141,0r0,-66r-77,0r-38,66r-45,0r149,-249r149,0r-6,34r-91,0r0,68r77,0r0,34r-76,0r0,78r99,0r0,35xm156,-202v-7,5,-49,90,-58,102r57,0",
			w: 307
		},
		
		"\u00c7": {
			d: "66,-126v-9,81,53,122,110,81r19,27v-20,16,-42,22,-72,22r-3,10v18,2,25,14,25,27v0,28,-45,38,-67,22r9,-19v10,5,29,9,31,-4v2,-15,-24,-1,-24,-13r6,-26v-51,-13,-80,-59,-80,-122v0,-103,92,-168,170,-113r-19,27v-56,-39,-113,8,-105,81",
			w: 207
		},
		
		"\u00c8": {
			d: "174,0r-142,0r0,-249r139,0r-6,34r-91,0r0,68r76,0r0,34r-75,0r0,78r99,0r0,35xm140,-282r-12,23r-79,-37r18,-33",
			w: 183
		},
		
		"\u00c9": {
			d: "174,0r-142,0r0,-249r139,0r-6,34r-91,0r0,68r76,0r0,34r-75,0r0,78r99,0r0,35xm147,-296r-79,37r-12,-23r73,-47",
			w: 183
		},
		
		"\u00ca": {
			d: "174,0r-142,0r0,-249r139,0r-6,34r-91,0r0,68r76,0r0,34r-75,0r0,78r99,0r0,35xm165,-279r-14,22r-50,-30r-48,30r-14,-22r63,-49",
			w: 183
		},
		
		"\u00cb": {
			d: "174,0r-142,0r0,-249r139,0r-6,34r-91,0r0,68r76,0r0,34r-75,0r0,78r99,0r0,35xm86,-284v0,14,-11,25,-24,25v-13,0,-25,-11,-25,-25v0,-14,12,-26,25,-26v13,0,24,12,24,26xm161,-284v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-26,24,-26v13,0,24,12,24,26",
			w: 183
		},
		
		"\u00cc": {
			d: "75,0r-43,0r0,-249r43,0r0,249xm89,-283r-12,23r-79,-37r18,-33",
			w: 103
		},
		
		"\u00cd": {
			d: "75,0r-43,0r0,-249r43,0r0,249xm111,-297r-80,37r-12,-23r74,-47",
			w: 103
		},
		
		"\u00ce": {
			d: "75,0r-43,0r0,-249r43,0r0,249xm117,-280r-15,22r-49,-30r-49,30r-13,-22r62,-49",
			w: 103
		},
		
		"\u00cf": {
			d: "75,0r-43,0r0,-249r43,0r0,249xm40,-285v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25xm115,-285v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25",
			w: 103
		},
		
		"\u00d0": {
			d: "31,-249v110,-10,179,21,176,125v-2,77,-33,128,-115,124r-61,0r0,-112r-29,0r0,-28r29,0r0,-109xm161,-120v0,-65,-19,-106,-89,-96r0,76r47,0r-8,28r-39,0r0,78v64,6,89,-16,89,-86",
			w: 227
		},
		
		"\u00d1": {
			d: "201,0r-43,0r-56,-117v-13,-28,-27,-59,-32,-74r3,191r-41,0r0,-249r47,0v27,57,68,126,86,186r-3,-186r39,0r0,249xm180,-291v-12,15,-22,24,-43,24v-28,0,-50,-30,-71,-2r-13,-22v12,-15,22,-24,43,-24v27,0,51,30,71,2",
			w: 230
		},
		
		"\u00d2": {
			d: "230,-124v0,78,-38,128,-103,128v-71,0,-105,-55,-105,-129v0,-82,42,-128,104,-128v70,0,104,56,104,129xm183,-122v0,-61,-13,-99,-58,-99v-42,0,-57,34,-57,94v0,64,16,100,58,100v37,0,57,-28,57,-95xm166,-282r-13,23r-79,-37r18,-33",
			w: 247
		},
		
		"\u00d3": {
			d: "230,-124v0,78,-38,128,-103,128v-71,0,-105,-55,-105,-129v0,-82,42,-128,104,-128v70,0,104,56,104,129xm183,-122v0,-61,-13,-99,-58,-99v-42,0,-57,34,-57,94v0,64,16,100,58,100v37,0,57,-28,57,-95xm178,-297r-79,37r-12,-23r73,-47",
			w: 247
		},
		
		"\u00d4": {
			d: "230,-124v0,78,-38,128,-103,128v-71,0,-105,-55,-105,-129v0,-82,42,-128,104,-128v70,0,104,56,104,129xm183,-122v0,-61,-13,-99,-58,-99v-42,0,-57,34,-57,94v0,64,16,100,58,100v37,0,57,-28,57,-95xm189,-279r-14,22r-50,-30r-48,30r-14,-22r63,-49",
			w: 247
		},
		
		"\u00d5": {
			d: "230,-124v0,78,-38,128,-103,128v-71,0,-105,-55,-105,-129v0,-82,42,-128,104,-128v70,0,104,56,104,129xm183,-122v0,-61,-13,-99,-58,-99v-42,0,-57,34,-57,94v0,64,16,100,58,100v37,0,57,-28,57,-95xm186,-291v-12,15,-23,24,-44,24v-27,0,-50,-30,-70,-2r-13,-22v12,-15,22,-24,43,-24v27,0,51,30,71,2",
			w: 247
		},
		
		"\u00d6": {
			d: "230,-124v0,78,-38,128,-103,128v-71,0,-105,-55,-105,-129v0,-82,42,-128,104,-128v70,0,104,56,104,129xm183,-122v0,-61,-13,-99,-58,-99v-42,0,-57,34,-57,94v0,64,16,100,58,100v37,0,57,-28,57,-95xm112,-284v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-26,24,-26v13,0,24,12,24,26xm188,-284v0,14,-12,25,-25,25v-13,0,-24,-11,-24,-25v0,-14,11,-26,24,-26v13,0,25,12,25,26",
			w: 247,
			k: {
				Y: 7,
				V: 7,
				T: 11
			}
		},
		
		"\u00d7": {
			d: "185,-51r-26,26r-51,-51r-51,51r-26,-27r50,-51r-50,-50r26,-26r50,50r51,-50r27,26r-51,51",
			w: 215
		},
		
		"\u00d8": {
			d: "197,-221v62,69,32,225,-72,225v-22,0,-40,-4,-55,-14r-24,41r-23,-13r27,-45v-21,-25,-30,-59,-30,-98v0,-104,79,-155,157,-113r22,-37r23,13xm159,-207v-48,-34,-93,-4,-93,81v0,24,2,44,7,61xm180,-121v0,-26,-2,-44,-7,-60r-85,141v47,30,92,7,92,-81",
			w: 247
		},
		
		"\u00d9": {
			d: "203,-70v0,46,-31,74,-86,74v-66,0,-86,-33,-86,-73r0,-180r41,0r0,167v0,38,14,51,45,51v30,0,45,-18,45,-51r0,-167r41,0r0,179xm155,-282r-12,23r-80,-37r18,-33",
			w: 230
		},
		
		"\u00da": {
			d: "203,-70v0,46,-31,74,-86,74v-66,0,-86,-33,-86,-73r0,-180r41,0r0,167v0,38,14,51,45,51v30,0,45,-18,45,-51r0,-167r41,0r0,179xm166,-296r-79,37r-12,-23r73,-47",
			w: 230
		},
		
		"\u00db": {
			d: "203,-70v0,46,-31,74,-86,74v-66,0,-86,-33,-86,-73r0,-180r41,0r0,167v0,38,14,51,45,51v30,0,45,-18,45,-51r0,-167r41,0r0,179xm180,-279r-14,22r-50,-30r-48,30r-14,-22r63,-49",
			w: 230
		},
		
		"\u00dc": {
			d: "206,-70v0,46,-31,74,-86,74v-66,0,-86,-33,-86,-73r0,-180r42,0r0,167v0,38,13,51,44,51v30,0,45,-18,45,-51r0,-167r41,0r0,179xm111,-284v0,14,-12,25,-25,25v-13,0,-24,-11,-24,-25v0,-14,11,-26,24,-26v13,0,25,12,25,26xm186,-285v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25",
			w: 230
		},
		
		"\u00dd": {
			d: "197,-249r-79,149r0,100r-43,0r0,-101r-79,-148r50,0r51,110r52,-110r48,0xm149,-297r-79,37r-12,-23r73,-47",
			w: 190
		},
		
		"\u00de": {
			d: "72,-210v76,-5,122,15,122,75v0,65,-52,87,-122,80r0,55r-41,0r0,-249r41,0r0,39xm149,-132v0,-43,-34,-47,-77,-44r0,87v42,2,77,0,77,-43",
			w: 203
		},
		
		"\u00df": {
			d: "131,-144v10,20,76,28,68,77v3,52,-54,85,-106,67r10,-27v28,10,54,-8,53,-37v0,-46,-60,-40,-60,-77v0,-31,38,-24,38,-57v0,-20,-12,-30,-30,-30v-21,0,-30,15,-30,44v0,59,6,136,-6,184r-39,0v9,-39,4,-104,5,-152r-29,0r0,-30r29,0v-3,-52,22,-76,71,-76v44,0,73,22,73,57v0,32,-40,44,-47,57",
			w: 214,
			k: {
				s: 7
			}
		},
		
		"\u00e0": {
			d: "25,-162v54,-35,136,-47,136,50v0,34,-10,81,15,94r-21,26v-11,-4,-21,-13,-25,-25v-32,42,-110,22,-110,-32v0,-46,40,-67,102,-64v0,-24,1,-41,-25,-41v-26,0,-55,20,-55,20xm121,-86v-39,-1,-58,10,-58,35v0,36,45,34,58,9r0,-44xm135,-224r-13,22r-79,-36r18,-34",
			w: 189
		},
		
		"\u00e1": {
			d: "25,-162v54,-35,136,-47,136,50v0,34,-10,81,15,94r-21,26v-11,-4,-21,-13,-25,-25v-32,42,-110,22,-110,-32v0,-46,40,-67,102,-64v0,-24,1,-41,-25,-41v-26,0,-55,20,-55,20xm121,-86v-39,-1,-58,10,-58,35v0,36,45,34,58,9r0,-44xm148,-238r-80,36r-12,-22r74,-48",
			w: 189
		},
		
		"\u00e2": {
			d: "25,-162v54,-35,136,-47,136,50v0,34,-10,81,15,94r-21,26v-11,-4,-21,-13,-25,-25v-32,42,-110,22,-110,-32v0,-46,40,-67,102,-64v0,-24,1,-41,-25,-41v-26,0,-55,20,-55,20xm121,-86v-39,-1,-58,10,-58,35v0,36,45,34,58,9r0,-44xm159,-222r-14,22r-50,-29r-48,29r-14,-22r63,-49",
			w: 189
		},
		
		"\u00e3": {
			d: "25,-162v54,-35,136,-47,136,50v0,34,-10,81,15,94r-21,26v-11,-4,-21,-13,-25,-25v-32,42,-110,22,-110,-32v0,-46,40,-67,102,-64v0,-24,1,-41,-25,-41v-26,0,-55,20,-55,20xm121,-86v-39,-1,-58,10,-58,35v0,36,45,34,58,9r0,-44xm157,-234v-12,15,-22,24,-43,24v-28,0,-51,-29,-71,-1r-13,-22v12,-15,22,-24,43,-24v27,0,52,29,71,1",
			w: 189
		},
		
		"\u00e4": {
			d: "25,-162v54,-35,136,-47,136,50v0,34,-10,81,15,94r-21,26v-11,-4,-21,-13,-25,-25v-32,42,-110,22,-110,-32v0,-46,40,-67,102,-64v0,-24,1,-41,-25,-41v-26,0,-55,20,-55,20xm121,-86v-39,-1,-58,10,-58,35v0,36,45,34,58,9r0,-44xm83,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25xm158,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25",
			w: 189
		},
		
		"\u00e5": {
			d: "25,-162v54,-35,136,-47,136,50v0,34,-10,81,15,94r-21,26v-11,-4,-21,-13,-25,-25v-32,42,-110,22,-110,-32v0,-46,40,-67,102,-64v0,-24,1,-41,-25,-41v-26,0,-55,20,-55,20xm121,-86v-39,-1,-58,10,-58,35v0,36,45,34,58,9r0,-44xm135,-238v0,21,-17,38,-38,38v-21,0,-38,-17,-38,-38v0,-21,17,-38,38,-38v21,0,38,17,38,38xm118,-238v0,-12,-9,-21,-21,-21v-12,0,-21,9,-21,21v0,12,9,22,21,22v12,0,21,-10,21,-22",
			w: 189
		},
		
		"\u00e6": {
			d: "146,-167v54,-47,135,-3,120,87r-108,0v-7,56,57,70,90,37r15,24v-31,34,-109,29,-127,-4v-27,46,-118,34,-118,-26v0,-46,40,-66,102,-63v1,-26,1,-42,-25,-42v-17,0,-37,7,-55,20r-17,-28v38,-26,93,-37,123,-5xm120,-85v-37,-4,-59,8,-59,34v0,37,45,34,58,9xm225,-109v0,-28,-11,-48,-33,-48v-21,0,-34,17,-34,48r67,0",
			w: 282
		},
		
		"\u00e7": {
			d: "64,-86v0,58,41,76,73,42r19,23v-16,17,-36,25,-57,25r-3,10v18,2,25,14,25,27v0,28,-45,38,-67,22r9,-19v8,6,30,9,31,-4v1,-14,-24,-2,-25,-13r7,-26v-38,-9,-56,-44,-56,-91v0,-82,74,-123,130,-78r-19,27v-37,-33,-67,-11,-67,55",
			w: 168
		},
		
		"\u00e8": {
			d: "100,-186v53,0,78,37,74,106r-109,0v0,28,8,53,45,54v17,0,32,-6,46,-18r15,25v-58,50,-149,18,-149,-72v0,-55,28,-95,78,-95xm133,-109v0,-30,-13,-48,-33,-48v-22,0,-34,18,-34,48r67,0xm134,-224r-12,22r-79,-36r18,-34",
			w: 188
		},
		
		"\u00e9": {
			d: "100,-186v53,0,78,37,74,106r-109,0v0,28,8,53,45,54v17,0,32,-6,46,-18r15,25v-58,50,-149,18,-149,-72v0,-55,28,-95,78,-95xm133,-109v0,-30,-13,-48,-33,-48v-22,0,-34,18,-34,48r67,0xm148,-238r-79,36r-12,-22r73,-48",
			w: 188
		},
		
		"\u00ea": {
			d: "100,-186v53,0,78,37,74,106r-109,0v0,28,8,53,45,54v17,0,32,-6,46,-18r15,25v-58,50,-149,18,-149,-72v0,-55,28,-95,78,-95xm133,-109v0,-30,-13,-48,-33,-48v-22,0,-34,18,-34,48r67,0xm163,-222r-14,22r-50,-29r-48,29r-14,-22r63,-49",
			w: 188
		},
		
		"\u00eb": {
			d: "100,-186v53,0,78,37,74,106r-109,0v0,28,8,53,45,54v17,0,32,-6,46,-18r15,25v-58,50,-149,18,-149,-72v0,-55,28,-95,78,-95xm133,-109v0,-30,-13,-48,-33,-48v-22,0,-34,18,-34,48r67,0xm86,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25xm161,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25",
			w: 188
		},
		
		"\u00ec": {
			d: "72,0r-40,0r0,-179r40,-7r0,186xm88,-224r-12,22r-80,-36r18,-34",
			w: 101
		},
		
		"\u00ed": {
			d: "72,0r-40,0r0,-179r40,-7r0,186xm109,-238r-79,36r-12,-22r73,-48",
			w: 101
		},
		
		"\u00ee": {
			d: "72,0r-40,0r0,-179r40,-7r0,186xm116,-222r-14,22r-50,-29r-48,29r-14,-22r63,-49",
			w: 101
		},
		
		"\u00ef": {
			d: "72,0r-40,0r0,-179r40,-7r0,186xm39,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25xm114,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25",
			w: 101
		},
		
		"\u00f0": {
			d: "114,-223v39,26,71,81,71,134v0,60,-34,94,-80,94v-45,0,-80,-32,-80,-83v-1,-55,47,-88,103,-74v-9,-15,-24,-31,-39,-42r-11,13r-25,-13r13,-15v-15,-8,-33,-14,-53,-16r24,-29v16,2,34,8,53,17r12,-14r25,13xm107,-31v32,0,41,-47,33,-81v-28,-15,-71,-13,-71,34v0,28,14,47,38,47",
			w: 205
		},
		
		"\u00f1": {
			d: "171,0r-39,0r0,-121v1,-52,-40,-31,-61,-11r0,132r-39,0v-2,-58,6,-129,-6,-177r36,-10v4,8,6,16,6,26v35,-36,103,-37,103,25r0,136xm164,-234v-12,15,-23,24,-44,24v-28,0,-51,-30,-70,-1r-13,-22v12,-15,22,-24,43,-24v27,0,52,29,71,1",
			w: 200
		},
		
		"\u00f2": {
			d: "181,-90v0,59,-32,95,-81,95v-49,0,-80,-38,-80,-96v0,-58,31,-95,79,-95v52,0,82,38,82,96xm137,-90v0,-51,-14,-67,-37,-67v-25,0,-36,20,-36,64v0,53,13,68,37,68v23,0,36,-19,36,-65xm134,-224r-13,22r-79,-36r18,-34"
		},
		
		"\u00f3": {
			d: "181,-90v0,59,-32,95,-81,95v-49,0,-80,-38,-80,-96v0,-58,31,-95,79,-95v52,0,82,38,82,96xm137,-90v0,-51,-14,-67,-37,-67v-25,0,-36,20,-36,64v0,53,13,68,37,68v23,0,36,-19,36,-65xm151,-238r-79,36r-12,-22r73,-48"
		},
		
		"\u00f4": {
			d: "181,-90v0,59,-32,95,-81,95v-49,0,-80,-38,-80,-96v0,-58,31,-95,79,-95v52,0,82,38,82,96xm137,-90v0,-51,-14,-67,-37,-67v-25,0,-36,20,-36,64v0,53,13,68,37,68v23,0,36,-19,36,-65xm163,-222r-15,22r-49,-29r-49,29r-13,-22r62,-49"
		},
		
		"\u00f5": {
			d: "181,-90v0,59,-32,95,-81,95v-49,0,-80,-38,-80,-96v0,-58,31,-95,79,-95v52,0,82,38,82,96xm137,-90v0,-51,-14,-67,-37,-67v-25,0,-36,20,-36,64v0,53,13,68,37,68v23,0,36,-19,36,-65xm162,-234v-12,15,-23,24,-44,24v-28,0,-50,-29,-70,-1r-13,-22v12,-15,22,-24,43,-24v27,0,52,29,71,1"
		},
		
		"\u00f6": {
			d: "181,-90v0,59,-32,95,-81,95v-49,0,-80,-38,-80,-96v0,-58,31,-95,79,-95v52,0,82,38,82,96xm137,-90v0,-51,-14,-67,-37,-67v-25,0,-36,20,-36,64v0,53,13,68,37,68v23,0,36,-19,36,-65xm86,-227v0,14,-11,25,-24,25v-13,0,-25,-11,-25,-25v0,-14,12,-25,25,-25v13,0,24,11,24,25xm161,-227v0,14,-12,25,-25,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,25,11,25,25"
		},
		
		"\u00f7": {
			d: "202,-79r-182,0r0,-34r182,0r0,34xm138,-23v0,15,-14,28,-29,28v-15,0,-27,-13,-27,-28v0,-16,12,-28,28,-28v15,0,28,12,28,28xm138,-170v0,16,-13,28,-28,28v-15,0,-28,-12,-28,-27v0,-16,13,-29,28,-29v15,0,28,13,28,28",
			w: 221
		},
		
		"\u00f8": {
			d: "154,-163v49,49,24,168,-56,168v-14,0,-27,-3,-38,-10r-20,33r-19,-11r21,-36v-46,-49,-23,-167,56,-167v15,0,27,3,39,9r20,-33r19,11xm99,-25v34,8,42,-61,32,-99r-55,91v7,5,15,8,23,8xm120,-149v-33,-21,-60,-1,-58,56v0,13,2,24,4,35"
		},
		
		"\u00f9": {
			d: "138,-17v-32,36,-107,31,-107,-39r0,-123r38,-7r0,122v-7,49,50,47,63,15r0,-130r38,-7v3,52,-8,144,11,173r-27,19v-8,-6,-13,-13,-16,-23xm144,-224r-12,22r-79,-36r18,-34",
			w: 198
		},
		
		"\u00fa": {
			d: "138,-17v-32,36,-107,31,-107,-39r0,-123r38,-7r0,122v-7,49,50,47,63,15r0,-130r38,-7v3,52,-8,144,11,173r-27,19v-8,-6,-13,-13,-16,-23xm151,-238r-79,36r-12,-22r73,-48",
			w: 198
		},
		
		"\u00fb": {
			d: "138,-17v-32,36,-107,31,-107,-39r0,-123r38,-7r0,122v-7,49,50,47,63,15r0,-130r38,-7v3,52,-8,144,11,173r-27,19v-8,-6,-13,-13,-16,-23xm164,-222r-15,22r-49,-29r-49,29r-13,-22r62,-49",
			w: 198
		},
		
		"\u00fc": {
			d: "138,-17v-32,36,-107,31,-107,-39r0,-123r38,-7r0,122v-7,49,50,47,63,15r0,-130r38,-7v3,52,-8,144,11,173r-27,19v-8,-6,-13,-13,-16,-23xm87,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25xm162,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25",
			w: 198
		},
		
		"\u00fd": {
			d: "176,-182r-65,186v-15,44,-28,66,-71,74r-13,-26v25,-7,40,-17,50,-52r-13,0v-17,-65,-39,-118,-59,-179r41,-7r43,152v8,-34,32,-109,44,-148r43,0xm149,-238r-80,36r-12,-22r74,-48",
			w: 177
		},
		
		"\u00fe": {
			d: "184,-94v0,79,-66,127,-115,78r0,84r-38,9r0,-289v0,-21,-2,-34,-5,-44r41,-9v6,26,1,71,3,96v51,-42,114,-2,114,75xm140,-94v0,-33,-7,-59,-35,-59v-17,0,-28,9,-35,18r0,89v30,28,70,21,70,-48",
			w: 204
		},
		
		"\u00ff": {
			d: "176,-182r-65,186v-15,44,-28,66,-71,74r-13,-26v25,-7,40,-17,50,-52r-13,0v-17,-65,-39,-118,-59,-179r41,-7r43,152v8,-34,32,-109,44,-148r43,0xm81,-227v0,14,-11,25,-24,25v-13,0,-25,-11,-25,-25v0,-14,12,-25,25,-25v13,0,24,11,24,25xm156,-227v0,14,-11,25,-24,25v-13,0,-24,-11,-24,-25v0,-14,11,-25,24,-25v13,0,24,11,24,25",
			w: 177
		},
		
		"\u2013": {
			d: "194,-84r-174,0r0,-31r174,0r0,31",
			w: 213
		},
		
		"\u2014": {
			d: "275,-84r-255,0r0,-31r255,0r0,31",
			w: 294
		},
		
		"\u2018": {
			d: "82,-239v-15,5,-25,15,-25,24v0,10,24,6,24,33v0,16,-13,29,-29,29v-19,0,-32,-17,-32,-40v0,-28,19,-54,47,-64",
			w: 99
		},
		
		"\u2019": {
			d: "42,-194v-5,-10,-23,-14,-23,-32v0,-16,13,-29,29,-29v57,12,26,99,-15,104r-15,-17v15,-5,24,-16,24,-26",
			w: 99
		},
		
		"\u201c": {
			d: "134,-214v4,10,24,11,24,32v0,16,-13,29,-29,29v-36,0,-40,-57,-18,-81v9,-9,20,-18,33,-23r15,18v-15,4,-25,15,-25,25xm82,-239v-15,4,-25,15,-25,25v0,9,24,6,24,32v0,16,-13,29,-29,29v-36,0,-40,-57,-18,-81v9,-9,20,-18,33,-23",
			w: 176
		},
		
		"\u201d": {
			d: "43,-194v-5,-11,-24,-13,-24,-32v0,-16,13,-29,29,-29v19,0,32,17,32,40v0,29,-19,55,-47,64r-15,-17v15,-5,25,-16,25,-26xm120,-194v-6,-10,-23,-13,-23,-32v0,-16,12,-29,28,-29v19,0,32,17,32,40v0,31,-20,55,-47,64r-15,-17v15,-5,25,-16,25,-26",
			w: 177
		},
		
		"\u2026": {
			d: "80,-24v0,16,-13,29,-28,29v-16,0,-29,-13,-29,-29v0,-16,13,-29,28,-29v16,0,29,13,29,29xm255,-24v0,16,-14,29,-29,29v-16,0,-28,-13,-28,-29v0,-16,13,-29,28,-29v15,0,29,13,29,29xm167,-24v0,16,-13,29,-28,29v-16,0,-28,-13,-28,-29v0,-16,13,-29,28,-29v16,0,28,13,28,29",
			w: 277
		},
		
		"\u20ac": {
			d: "102,-80v9,48,67,69,106,36r9,33v-62,38,-151,-2,-160,-69r-41,0r0,-32r37,0v-2,-9,0,-18,0,-27r-37,0r0,-31r42,0v14,-65,91,-106,154,-72r-9,35v-38,-31,-93,-7,-100,37r80,0r0,31r-84,0v-1,8,-1,19,0,27r84,0r0,32r-81,0",
			w: 229
		},
		
		"\u2122": {
			d: "335,-107r-32,0v-2,-35,4,-77,-2,-108r-41,108r-21,0v-15,-35,-25,-75,-42,-108r0,108r-32,0r0,-148r46,0r39,105r39,-105r46,0r0,148xm133,-226r-44,0r0,119r-32,0r0,-119r-44,0r0,-29r120,0r0,29",
			w: 358
		}
	}
});

var Prototype = {
	Version: "1.6.1",
	Browser: (function() {
		var b = navigator.userAgent;
		var a = Object.prototype.toString.call(window.opera) == "[object Opera]";
		return {
			IE: !! window.attachEvent && !a,
			Opera: a,
			WebKit: b.indexOf("AppleWebKit/") > -1,
			Gecko: b.indexOf("Gecko") > -1 && b.indexOf("KHTML") === -1,
			MobileSafari: /Apple.*Mobile.*Safari/.test(b)
		}
	})(),
	BrowserFeatures: {
		XPath: !! document.evaluate,
		SelectorsAPI: !! document.querySelector,
		ElementExtensions: (function() {
			var a = window.Element || window.HTMLElement;
			return !!(a && a.prototype)
		})(),
		SpecificElementExtensions: (function() {
			if (typeof window.HTMLDivElement !== "undefined") {
				return true
			}
			var c = document.createElement("div");
			var b = document.createElement("form");
			var a = false;
			if (c.__proto__ && (c.__proto__ !== b.__proto__)) {
				a = true
			}
			c = b = null;
			return a
		})()
	},
	
	ScriptFragment: "<script[^>]*>([\\S\\s]*?)<\/script>",
	JSONFilter: /^\/\*-secure-([\s\S]*)\*\/\s*$/,
	emptyFunction: function() {},
	
	K: function(a) {
		return a
	}
};

if (Prototype.Browser.MobileSafari) {
	Prototype.BrowserFeatures.SpecificElementExtensions = false
}
var Abstract = {};

var Try = {
	these: function() {
		var c;
		for (var b = 0, d = arguments.length; b < d; b++) {
			var a = arguments[b];
			try {
				c = a();
				
				break
			} catch (f) {}
		}
		return c
	}
};

var Class = (function() {
	function a() {}
	function b() {
		var g = null,
			f = $A(arguments);
		if (Object.isFunction(f[0])) {
			g = f.shift()
		}
		function d() {
			this.initialize.apply(this, arguments)
		}
		Object.extend(d, Class.Methods);
		d.superclass = g;
		d.subclasses = [];
		if (g) {
			a.prototype = g.prototype;
			d.prototype = new a;
			g.subclasses.push(d)
		}
		for (var e = 0; e < f.length; e++) {
			d.addMethods(f[e])
		}
		if (!d.prototype.initialize) {
			d.prototype.initialize = Prototype.emptyFunction
		}
		d.prototype.constructor = d;
		return d
	}
	function c(k) {
		var f = this.superclass && this.superclass.prototype;
		var e = Object.keys(k);
		if (!Object.keys({
			toString: true
		}).length) {
			if (k.toString != Object.prototype.toString) {
				e.push("toString")
			}
			if (k.valueOf != Object.prototype.valueOf) {
				e.push("valueOf")
			}
		}
		for (var d = 0, g = e.length; d < g; d++) {
			var j = e[d],
				h = k[j];
			if (f && Object.isFunction(h) && h.argumentNames().first() == "$super") {
				var l = h;
				h = (function(i) {
					return function() {
						return f[i].apply(this, arguments)
					}
				})(j).wrap(l);
				h.valueOf = l.valueOf.bind(l);
				h.toString = l.toString.bind(l)
			}
			this.prototype[j] = h
		}
		return this
	}
	return {
		create: b,
		Methods: {
			addMethods: c
		}
	}
})();
(function() {
	var d = Object.prototype.toString;

	function i(q, s) {
		for (var r in s) {
			q[r] = s[r]
		}
		return q
	}
	function l(q) {
		try {
			if (e(q)) {
				return "undefined"
			}
			if (q === null) {
				return "null"
			}
			return q.inspect ? q.inspect() : String(q)
		} catch (r) {
			if (r instanceof RangeError) {
				return "..."
			}
			throw r
		}
	}
	function k(q) {
		var s = typeof q;
		switch (s) {
			case "undefined":
			case "function":
			case "unknown":
				return;
			case "boolean":
				return q.toString()
		}
		if (q === null) {
			return "null"
		}
		if (q.toJSON) {
			return q.toJSON()
		}
		if (h(q)) {
			return
		}
		var r = [];
		for (var u in q) {
			var t = k(q[u]);
			if (!e(t)) {
				r.push(u.toJSON() + ": " + t)
			}
		}
		return "{" + r.join(", ") + "}"
	}
	function c(q) {
		return $H(q).toQueryString()
	}
	function f(q) {
		return q && q.toHTML ? q.toHTML() : String.interpret(q)
	}
	function o(q) {
		var r = [];
		for (var s in q) {
			r.push(s)
		}
		return r
	}
	function m(q) {
		var r = [];
		for (var s in q) {
			r.push(q[s])
		}
		return r
	}
	function j(q) {
		return i({}, q)
	}
	function h(q) {
		return !!(q && q.nodeType == 1)
	}
	function g(q) {
		return d.call(q) == "[object Array]"
	}
	function p(q) {
		return q instanceof Hash
	}
	function b(q) {
		return typeof q === "function"
	}
	function a(q) {
		return d.call(q) == "[object String]"
	}
	function n(q) {
		return d.call(q) == "[object Number]"
	}
	function e(q) {
		return typeof q === "undefined"
	}
	i(Object, {
		extend: i,
		inspect: l,
		toJSON: k,
		toQueryString: c,
		toHTML: f,
		keys: o,
		values: m,
		clone: j,
		isElement: h,
		isArray: g,
		isHash: p,
		isFunction: b,
		isString: a,
		isNumber: n,
		isUndefined: e
	})
})();

Object.extend(Function.prototype, (function() {
	var k = Array.prototype.slice;

	function d(o, l) {
		var n = o.length,
			m = l.length;
		while (m--) {
			o[n + m] = l[m]
		}
		return o
	}
	function i(m, l) {
		m = k.call(m, 0);
		return d(m, l)
	}
	function g() {
		var l = this.toString().match(/^[\s\(]*function[^(]*\(([^)]*)\)/)[1].replace(/\/\/.*?[\r\n]|\/\*(?:.|[\r\n])*?\*\//g, "").replace(/\s+/g, "").split(",");
		return l.length == 1 && !l[0] ? [] : l
	}
	function h(n) {
		if (arguments.length < 2 && Object.isUndefined(arguments[0])) {
			return this
		}
		var l = this,
			m = k.call(arguments, 1);
		return function() {
			var o = i(m, arguments);
			return l.apply(n, o)
		}
	}
	function f(n) {
		var l = this,
			m = k.call(arguments, 1);
		return function(p) {
			var o = d([p || window.event], m);
			return l.apply(n, o)
		}
	}
	function j() {
		if (!arguments.length) {
			return this
		}
		var l = this,
			m = k.call(arguments, 0);
		return function() {
			var n = i(m, arguments);
			return l.apply(this, n)
		}
	}
	function e(n) {
		var l = this,
			m = k.call(arguments, 1);
		n = n * 1000;
		return window.setTimeout(function() {
			return l.apply(l, m)
		}, n)
	}
	function a() {
		var l = d([0.01], arguments);
		return this.delay.apply(this, l)
	}
	function c(m) {
		var l = this;
		return function() {
			var n = d([l.bind(this)], arguments);
			return m.apply(this, n)
		}
	}
	function b() {
		if (this._methodized) {
			return this._methodized
		}
		var l = this;
		return this._methodized = function() {
			var m = d([this], arguments);
			return l.apply(null, m)
		}
	}
	return {
		argumentNames: g,
		bind: h,
		bindAsEventListener: f,
		curry: j,
		delay: e,
		defer: a,
		wrap: c,
		methodize: b
	}
})());
Date.prototype.toJSON = function() {
	return '"' + this.getUTCFullYear() + "-" + (this.getUTCMonth() + 1).toPaddedString(2) + "-" + this.getUTCDate().toPaddedString(2) + "T" + this.getUTCHours().toPaddedString(2) + ":" + this.getUTCMinutes().toPaddedString(2) + ":" + this.getUTCSeconds().toPaddedString(2) + 'Z"'
};

RegExp.prototype.match = RegExp.prototype.test;
RegExp.escape = function(a) {
	return String(a).replace(/([.*+?^=!:${}()|[\]\/\\])/g, "\\$1")
};

var PeriodicalExecuter = Class.create({
	initialize: function(b, a) {
		this.callback = b;
		this.frequency = a;
		this.currentlyExecuting = false;
		this.registerCallback()
	},
	
	registerCallback: function() {
		this.timer = setInterval(this.onTimerEvent.bind(this), this.frequency * 1000)
	},
	
	execute: function() {
		this.callback(this)
	},
	
	stop: function() {
		if (!this.timer) {
			return
		}
		clearInterval(this.timer);
		this.timer = null
	},
	
	onTimerEvent: function() {
		if (!this.currentlyExecuting) {
			try {
				this.currentlyExecuting = true;
				this.execute();
				
				this.currentlyExecuting = false
			} catch (a) {
				this.currentlyExecuting = false;
				throw a
			}
		}
	}
});

Object.extend(String, {
	interpret: function(a) {
		return a == null ? "" : String(a)
	},
	
	specialChar: {
		"\b": "\\b",
		"\t": "\\t",
		"\n": "\\n",
		"\f": "\\f",
		"\r": "\\r",
		"\\": "\\\\"
	}
});

Object.extend(String.prototype, (function() {
	function prepareReplacement(replacement) {
		if (Object.isFunction(replacement)) {
			return replacement
		}
		var template = new Template(replacement);
		return function(match) {
			return template.evaluate(match)
		}
	}
	function gsub(pattern, replacement) {
		var result = "",
			source = this,
			match;
		replacement = prepareReplacement(replacement);
		if (Object.isString(pattern)) {
			pattern = RegExp.escape(pattern)
		}
		if (!(pattern.length || pattern.source)) {
			replacement = replacement("");
			return replacement + source.split("").join(replacement) + replacement
		}
		while (source.length > 0) {
			if (match = source.match(pattern)) {
				result += source.slice(0, match.index);
				result += String.interpret(replacement(match));
				source = source.slice(match.index + match[0].length)
			} else {
				result += source, source = ""
			}
		}
		return result
	}
	function sub(pattern, replacement, count) {
		replacement = prepareReplacement(replacement);
		count = Object.isUndefined(count) ? 1 : count;
		return this.gsub(pattern, function(match) {
			if (--count < 0) {
				return match[0]
			}
			return replacement(match)
		})
	}
	function scan(pattern, iterator) {
		this.gsub(pattern, iterator);
		return String(this)
	}
	function truncate(length, truncation) {
		length = length || 30;
		truncation = Object.isUndefined(truncation) ? "..." : truncation;
		return this.length > length ? this.slice(0, length - truncation.length) + truncation : String(this)
	}
	function strip() {
		return this.replace(/^\s+/, "").replace(/\s+$/, "")
	}
	function stripTags() {
		return this.replace(/<\w+(\s+("[^"]*"|'[^']*'|[^>])+)?>|<\/\w+>/gi, "")
	}
	function stripScripts() {
		return this.replace(new RegExp(Prototype.ScriptFragment, "img"), "")
	}
	function extractScripts() {
		var matchAll = new RegExp(Prototype.ScriptFragment, "img");
		var matchOne = new RegExp(Prototype.ScriptFragment, "im");
		return (this.match(matchAll) || []).map(function(scriptTag) {
			return (scriptTag.match(matchOne) || ["", ""])[1]
		})
	}
	function evalScripts() {
		return this.extractScripts().map(function(script) {
			return eval(script)
		})
	}
	function escapeHTML() {
		return this.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
	}
	function unescapeHTML() {
		return this.stripTags().replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&amp;/g, "&")
	}
	function toQueryParams(separator) {
		var match = this.strip().match(/([^?#]*)(#.*)?$/);
		if (!match) {
			return {}
		}
		return match[1].split(separator || "&").inject({}, function(hash, pair) {
			if ((pair = pair.split("="))[0]) {
				var key = decodeURIComponent(pair.shift());
				var value = pair.length > 1 ? pair.join("=") : pair[0];
				if (value != undefined) {
					value = decodeURIComponent(value)
				}
				if (key in hash) {
					if (!Object.isArray(hash[key])) {
						hash[key] = [hash[key]]
					}
					hash[key].push(value)
				} else {
					hash[key] = value
				}
			}
			return hash
		})
	}
	function toArray() {
		return this.split("")
	}
	function succ() {
		return this.slice(0, this.length - 1) + String.fromCharCode(this.charCodeAt(this.length - 1) + 1)
	}
	function times(count) {
		return count < 1 ? "" : new Array(count + 1).join(this)
	}
	function camelize() {
		var parts = this.split("-"),
			len = parts.length;
		if (len == 1) {
			return parts[0]
		}
		var camelized = this.charAt(0) == "-" ? parts[0].charAt(0).toUpperCase() + parts[0].substring(1) : parts[0];
		for (var i = 1; i < len; i++) {
			camelized += parts[i].charAt(0).toUpperCase() + parts[i].substring(1)
		}
		return camelized
	}
	function capitalize() {
		return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase()
	}
	function underscore() {
		return this.replace(/::/g, "/").replace(/([A-Z]+)([A-Z][a-z])/g, "$1_$2").replace(/([a-z\d])([A-Z])/g, "$1_$2").replace(/-/g, "_").toLowerCase()
	}
	function dasherize() {
		return this.replace(/_/g, "-")
	}
	function inspect(useDoubleQuotes) {
		var escapedString = this.replace(/[\x00-\x1f\\]/g, function(character) {
			if (character in String.specialChar) {
				return String.specialChar[character]
			}
			return "\\u00" + character.charCodeAt().toPaddedString(2, 16)
		});
		
		if (useDoubleQuotes) {
			return '"' + escapedString.replace(/"/g, '\\"') + '"'
		}
		return "'" + escapedString.replace(/'/g, "\\'") + "'"
	}
	function toJSON() {
		return this.inspect(true)
	}
	function unfilterJSON(filter) {
		return this.replace(filter || Prototype.JSONFilter, "$1")
	}
	function isJSON() {
		var str = this;
		if (str.blank()) {
			return false
		}
		str = this.replace(/\\./g, "@").replace(/"[^"\\\n\r]*"/g, "");
		return (/^[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]*$/).test(str)
	}
	function evalJSON(sanitize) {
		var json = this.unfilterJSON();
		
		try {
			if (!sanitize || json.isJSON()) {
				return eval("(" + json + ")")
			}
		} catch (e) {}
		throw new SyntaxError("Badly formed JSON string: " + this.inspect())
	}
	function include(pattern) {
		return this.indexOf(pattern) > -1
	}
	function startsWith(pattern) {
		return this.indexOf(pattern) === 0
	}
	function endsWith(pattern) {
		var d = this.length - pattern.length;
		return d >= 0 && this.lastIndexOf(pattern) === d
	}
	function empty() {
		return this == ""
	}
	function blank() {
		return /^\s*$/.test(this)
	}
	function interpolate(object, pattern) {
		return new Template(this, pattern).evaluate(object)
	}
	return {
		gsub: gsub,
		sub: sub,
		scan: scan,
		truncate: truncate,
		strip: String.prototype.trim ? String.prototype.trim : strip,
		stripTags: stripTags,
		stripScripts: stripScripts,
		extractScripts: extractScripts,
		evalScripts: evalScripts,
		escapeHTML: escapeHTML,
		unescapeHTML: unescapeHTML,
		toQueryParams: toQueryParams,
		parseQuery: toQueryParams,
		toArray: toArray,
		succ: succ,
		times: times,
		camelize: camelize,
		capitalize: capitalize,
		underscore: underscore,
		dasherize: dasherize,
		inspect: inspect,
		toJSON: toJSON,
		unfilterJSON: unfilterJSON,
		isJSON: isJSON,
		evalJSON: evalJSON,
		include: include,
		startsWith: startsWith,
		endsWith: endsWith,
		empty: empty,
		blank: blank,
		interpolate: interpolate
	}
})());
var Template = Class.create({
	initialize: function(a, b) {
		this.template = a.toString();
		
		this.pattern = b || Template.Pattern
	},
	
	evaluate: function(a) {
		if (a && Object.isFunction(a.toTemplateReplacements)) {
			a = a.toTemplateReplacements()
		}
		return this.template.gsub(this.pattern, function(d) {
			if (a == null) {
				return (d[1] + "")
			}
			var f = d[1] || "";
			if (f == "\\") {
				return d[2]
			}
			var b = a,
				g = d[3];
			var e = /^([^.[]+|\[((?:.*?[^\\])?)\])(\.|\[|$)/;
			d = e.exec(g);
			if (d == null) {
				return f
			}
			while (d != null) {
				var c = d[1].startsWith("[") ? d[2].replace(/\\\\]/g, "]") : d[1];
				b = b[c];
				if (null == b || "" == d[3]) {
					break
				}
				g = g.substring("[" == d[3] ? d[1].length : d[0].length);
				d = e.exec(g)
			}
			return f + String.interpret(b)
		})
	}
});

Template.Pattern = /(^|.|\r|\n)(#\{(.*?)\})/;
var $break = {};

var Enumerable = (function() {
	function c(y, x) {
		var w = 0;
		try {
			this._each(function(A) {
				y.call(x, A, w++)
			})
		} catch (z) {
			if (z != $break) {
				throw z
			}
		}
		return this
	}
	function r(z, y, x) {
		var w = -z,
			A = [],
			B = this.toArray();
		
		if (z < 1) {
			return B
		}
		while ((w += z) < B.length) {
			A.push(B.slice(w, w + z))
		}
		return A.collect(y, x)
	}
	function b(y, x) {
		y = y || Prototype.K;
		var w = true;
		this.each(function(A, z) {
			w = w && !! y.call(x, A, z);
			if (!w) {
				throw $break
			}
		});
		
		return w
	}
	function i(y, x) {
		y = y || Prototype.K;
		var w = false;
		this.each(function(A, z) {
			if (w = !! y.call(x, A, z)) {
				throw $break
			}
		});
		
		return w
	}
	function j(y, x) {
		y = y || Prototype.K;
		var w = [];
		this.each(function(A, z) {
			w.push(y.call(x, A, z))
		});
		
		return w
	}
	function t(y, x) {
		var w;
		this.each(function(A, z) {
			if (y.call(x, A, z)) {
				w = A;
				throw $break
			}
		});
		
		return w
	}
	function h(y, x) {
		var w = [];
		this.each(function(A, z) {
			if (y.call(x, A, z)) {
				w.push(A)
			}
		});
		
		return w
	}
	function g(z, y, x) {
		y = y || Prototype.K;
		var w = [];
		if (Object.isString(z)) {
			z = new RegExp(RegExp.escape(z))
		}
		this.each(function(B, A) {
			if (z.match(B)) {
				w.push(y.call(x, B, A))
			}
		});
		
		return w
	}
	function a(w) {
		if (Object.isFunction(this.indexOf)) {
			if (this.indexOf(w) != -1) {
				return true
			}
		}
		var x = false;
		this.each(function(y) {
			if (y == w) {
				x = true;
				throw $break
			}
		});
		
		return x
	}
	function q(x, w) {
		w = Object.isUndefined(w) ? null : w;
		return this.eachSlice(x, function(y) {
			while (y.length < x) {
				y.push(w)
			}
			return y
		})
	}
	function l(w, y, x) {
		this.each(function(A, z) {
			w = y.call(x, w, A, z)
		});
		
		return w
	}
	function v(x) {
		var w = $A(arguments).slice(1);
		return this.map(function(y) {
			return y[x].apply(y, w)
		})
	}
	function p(y, x) {
		y = y || Prototype.K;
		var w;
		this.each(function(A, z) {
			A = y.call(x, A, z);
			if (w == null || A >= w) {
				w = A
			}
		});
		
		return w
	}
	function n(y, x) {
		y = y || Prototype.K;
		var w;
		this.each(function(A, z) {
			A = y.call(x, A, z);
			if (w == null || A < w) {
				w = A
			}
		});
		
		return w
	}
	function e(z, x) {
		z = z || Prototype.K;
		var y = [],
			w = [];
		this.each(function(B, A) {
			(z.call(x, B, A) ? y : w).push(B)
		});
		
		return [y, w]
	}
	function f(x) {
		var w = [];
		this.each(function(y) {
			w.push(y[x])
		});
		
		return w
	}
	function d(y, x) {
		var w = [];
		this.each(function(A, z) {
			if (!y.call(x, A, z)) {
				w.push(A)
			}
		});
		
		return w
	}
	function m(x, w) {
		return this.map(function(z, y) {
			return {
				value: z,
				criteria: x.call(w, z, y)
			}
		}).sort(function(B, A) {
			var z = B.criteria,
				y = A.criteria;
			return z < y ? -1 : z > y ? 1 : 0
		}).pluck("value")
	}
	function o() {
		return this.map()
	}
	function s() {
		var x = Prototype.K,
			w = $A(arguments);
		if (Object.isFunction(w.last())) {
			x = w.pop()
		}
		var y = [this].concat(w).map($A);
		return this.map(function(A, z) {
			return x(y.pluck(z))
		})
	}
	function k() {
		return this.toArray().length
	}
	function u() {
		return "#<Enumerable:" + this.toArray().inspect() + ">"
	}
	return {
		each: c,
		eachSlice: r,
		all: b,
		every: b,
		any: i,
		some: i,
		collect: j,
		map: j,
		detect: t,
		findAll: h,
		select: h,
		filter: h,
		grep: g,
		include: a,
		member: a,
		inGroupsOf: q,
		inject: l,
		invoke: v,
		max: p,
		min: n,
		partition: e,
		pluck: f,
		reject: d,
		sortBy: m,
		toArray: o,
		entries: o,
		zip: s,
		size: k,
		inspect: u,
		find: t
	}
})();


function $A(c) {
	if (!c) {
		return []
	}
	if ("toArray" in Object(c)) {
		return c.toArray()
	}
	var b = c.length || 0,
		a = new Array(b);
	while (b--) {
		a[b] = c[b]
	}
	return a
}
function $w(a) {
	if (!Object.isString(a)) {
		return []
	}
	a = a.strip();
	
	return a ? a.split(/\s+/) : []
}
Array.from = $A;
(function() {
	var s = Array.prototype,
		m = s.slice,
		o = s.forEach;

	function b(w) {
		for (var v = 0, x = this.length; v < x; v++) {
			w(this[v])
		}
	}
	if (!o) {
		o = b
	}
	function l() {
		this.length = 0;
		return this
	}
	function d() {
		return this[0]
	}
	function g() {
		return this[this.length - 1]
	}
	function i() {
		return this.select(function(v) {
			return v != null
		})
	}
	function u() {
		return this.inject([], function(w, v) {
			if (Object.isArray(v)) {
				return w.concat(v.flatten())
			}
			w.push(v);
			return w
		})
	}
	function h() {
		var v = m.call(arguments, 0);
		return this.select(function(w) {
			return !v.include(w)
		})
	}
	function f(v) {
		return (v !== false ? this : this.toArray())._reverse()
	}
	function k(v) {
		return this.inject([], function(y, x, w) {
			if (0 == w || (v ? y.last() != x : !y.include(x))) {
				y.push(x)
			}
			return y
		})
	}
	function p(v) {
		return this.uniq().findAll(function(w) {
			return v.detect(function(x) {
				return w === x
			})
		})
	}
	function q() {
		return m.call(this, 0)
	}
	function j() {
		return this.length
	}
	function t() {
		return "[" + this.map(Object.inspect).join(", ") + "]"
	}
	function r() {
		var v = [];
		this.each(function(w) {
			var x = Object.toJSON(w);
			if (!Object.isUndefined(x)) {
				v.push(x)
			}
		});
		
		return "[" + v.join(", ") + "]"
	}
	function a(x, v) {
		v || (v = 0);
		var w = this.length;
		if (v < 0) {
			v = w + v
		}
		for (; v < w; v++) {
			if (this[v] === x) {
				return v
			}
		}
		return -1
	}
	function n(w, v) {
		v = isNaN(v) ? this.length : (v < 0 ? this.length + v : v) + 1;
		var x = this.slice(0, v).reverse().indexOf(w);
		return (x < 0) ? x : v - x - 1
	}
	function c() {
		var A = m.call(this, 0),
			y;
		for (var w = 0, x = arguments.length; w < x; w++) {
			y = arguments[w];
			if (Object.isArray(y) && !("callee" in y)) {
				for (var v = 0, z = y.length; v < z; v++) {
					A.push(y[v])
				}
			} else {
				A.push(y)
			}
		}
		return A
	}
	Object.extend(s, Enumerable);
	if (!s._reverse) {
		s._reverse = s.reverse
	}
	Object.extend(s, {
		_each: o,
		clear: l,
		first: d,
		last: g,
		compact: i,
		flatten: u,
		without: h,
		reverse: f,
		uniq: k,
		intersect: p,
		clone: q,
		toArray: q,
		size: j,
		inspect: t,
		toJSON: r
	});
	
	var e = (function() {
		return [].concat(arguments)[0][0] !== 1
	})(1, 2);
	if (e) {
		s.concat = c
	}
	if (!s.indexOf) {
		s.indexOf = a
	}
	if (!s.lastIndexOf) {
		s.lastIndexOf = n
	}
})();


function $H(a) {
	return new Hash(a)
}
var Hash = Class.create(Enumerable, (function() {
	function e(q) {
		this._object = Object.isHash(q) ? q.toObject() : Object.clone(q)
	}
	function f(r) {
		for (var q in this._object) {
			var s = this._object[q],
				t = [q, s];
			t.key = q;
			t.value = s;
			r(t)
		}
	}
	function k(q, r) {
		return this._object[q] = r
	}
	function c(q) {
		if (this._object[q] !== Object.prototype[q]) {
			return this._object[q]
		}
	}
	function n(q) {
		var r = this._object[q];
		delete this._object[q];
		return r
	}
	function p() {
		return Object.clone(this._object)
	}
	function o() {
		return this.pluck("key")
	}
	function m() {
		return this.pluck("value")
	}
	function g(r) {
		var q = this.detect(function(s) {
			return s.value === r
		});
		
		return q && q.key
	}
	function i(q) {
		return this.clone().update(q)
	}
	function d(q) {
		return new Hash(q).inject(this, function(r, s) {
			r.set(s.key, s.value);
			return r
		})
	}
	function b(q, r) {
		if (Object.isUndefined(r)) {
			return q
		}
		return q + "=" + encodeURIComponent(String.interpret(r))
	}
	function a() {
		return this.inject([], function(s, t) {
			var r = encodeURIComponent(t.key),
				q = t.value;
			if (q && typeof q == "object") {
				if (Object.isArray(q)) {
					return s.concat(q.map(b.curry(r)))
				}
			} else {
				s.push(b(r, q))
			}
			return s
		}).join("&")
	}
	function l() {
		return "#<Hash:{" + this.map(function(q) {
			return q.map(Object.inspect).join(": ")
		}).join(", ") + "}>"
	}
	function j() {
		return Object.toJSON(this.toObject())
	}
	function h() {
		return new Hash(this)
	}
	return {
		initialize: e,
		_each: f,
		set: k,
		get: c,
		unset: n,
		toObject: p,
		toTemplateReplacements: p,
		keys: o,
		values: m,
		index: g,
		merge: i,
		update: d,
		toQueryString: a,
		inspect: l,
		toJSON: j,
		clone: h
	}
})());
Hash.from = $H;
Object.extend(Number.prototype, (function() {
	function d() {
		return this.toPaddedString(2, 16)
	}
	function e() {
		return this + 1
	}
	function a(k, j) {
		$R(0, this, true).each(k, j);
		return this
	}
	function b(l, k) {
		var j = this.toString(k || 10);
		return "0".times(l - j.length) + j
	}
	function f() {
		return isFinite(this) ? this.toString() : "null"
	}
	function i() {
		return Math.abs(this)
	}
	function h() {
		return Math.round(this)
	}
	function g() {
		return Math.ceil(this)
	}
	function c() {
		return Math.floor(this)
	}
	return {
		toColorPart: d,
		succ: e,
		times: a,
		toPaddedString: b,
		toJSON: f,
		abs: i,
		round: h,
		ceil: g,
		floor: c
	}
})());

function $R(c, a, b) {
	return new ObjectRange(c, a, b)
}
var ObjectRange = Class.create(Enumerable, (function() {
	function b(f, d, e) {
		this.start = f;
		this.end = d;
		this.exclusive = e
	}
	function c(d) {
		var e = this.start;
		while (this.include(e)) {
			d(e);
			e = e.succ()
		}
	}
	function a(d) {
		if (d < this.start) {
			return false
		}
		if (this.exclusive) {
			return d < this.end
		}
		return d <= this.end
	}
	return {
		initialize: b,
		_each: c,
		include: a
	}
})());
var Ajax = {
	getTransport: function() {
		return Try.these(function() {
			return new XMLHttpRequest()
		}, function() {
			return new ActiveXObject("Msxml2.XMLHTTP")
		}, function() {
			return new ActiveXObject("Microsoft.XMLHTTP")
		}) || false
	},
	
	activeRequestCount: 0
};

Ajax.Responders = {
	responders: [],
	_each: function(a) {
		this.responders._each(a)
	},
	
	register: function(a) {
		if (!this.include(a)) {
			this.responders.push(a)
		}
	},
	
	unregister: function(a) {
		this.responders = this.responders.without(a)
	},
	
	dispatch: function(d, b, c, a) {
		this.each(function(f) {
			if (Object.isFunction(f[d])) {
				try {
					f[d].apply(f, [b, c, a])
				} catch (g) {}
			}
		})
	}
};

Object.extend(Ajax.Responders, Enumerable);
Ajax.Responders.register({
	onCreate: function() {
		Ajax.activeRequestCount++
	},
	
	onComplete: function() {
		Ajax.activeRequestCount--
	}
});

Ajax.Base = Class.create({
	initialize: function(a) {
		this.options = {
			method: "post",
			asynchronous: true,
			contentType: "application/x-www-form-urlencoded",
			encoding: "UTF-8",
			parameters: "",
			evalJSON: true,
			evalJS: true
		};
		
		Object.extend(this.options, a || {});
		
		this.options.method = this.options.method.toLowerCase();
		
		if (Object.isString(this.options.parameters)) {
			this.options.parameters = this.options.parameters.toQueryParams()
		} else {
			if (Object.isHash(this.options.parameters)) {
				this.options.parameters = this.options.parameters.toObject()
			}
		}
	}
});

Ajax.Request = Class.create(Ajax.Base, {
	_complete: false,
	initialize: function($super, b, a) {
		$super(a);
		this.transport = Ajax.getTransport();
		
		this.request(b)
	},
	
	request: function(b) {
		this.url = b;
		this.method = this.options.method;
		var d = Object.clone(this.options.parameters);
		if (!["get", "post"].include(this.method)) {
			d._method = this.method;
			this.method = "post"
		}
		this.parameters = d;
		if (d = Object.toQueryString(d)) {
			if (this.method == "get") {
				this.url += (this.url.include("?") ? "&" : "?") + d
			} else {
				if (/Konqueror|Safari|KHTML/.test(navigator.userAgent)) {
					d += "&_="
				}
			}
		}
		try {
			var a = new Ajax.Response(this);
			if (this.options.onCreate) {
				this.options.onCreate(a)
			}
			Ajax.Responders.dispatch("onCreate", this, a);
			this.transport.open(this.method.toUpperCase(), this.url, this.options.asynchronous);
			if (this.options.asynchronous) {
				this.respondToReadyState.bind(this).defer(1)
			}
			this.transport.onreadystatechange = this.onStateChange.bind(this);
			this.setRequestHeaders();
			
			this.body = this.method == "post" ? (this.options.postBody || d) : null;
			this.transport.send(this.body);
			if (!this.options.asynchronous && this.transport.overrideMimeType) {
				this.onStateChange()
			}
		} catch (c) {
			this.dispatchException(c)
		}
	},
	
	onStateChange: function() {
		var a = this.transport.readyState;
		if (a > 1 && !((a == 4) && this._complete)) {
			this.respondToReadyState(this.transport.readyState)
		}
	},
	
	setRequestHeaders: function() {
		var e = {
			"X-Requested-With": "XMLHttpRequest",
			"X-Prototype-Version": Prototype.Version,
			Accept: "text/javascript, text/html, application/xml, text/xml, */*"
		};
		
		if (this.method == "post") {
			e["Content-type"] = this.options.contentType + (this.options.encoding ? "; charset=" + this.options.encoding : "");
			if (this.transport.overrideMimeType && (navigator.userAgent.match(/Gecko\/(\d{4})/) || [0, 2005])[1] < 2005) {
				e.Connection = "close"
			}
		}
		if (typeof this.options.requestHeaders == "object") {
			var c = this.options.requestHeaders;
			if (Object.isFunction(c.push)) {
				for (var b = 0, d = c.length; b < d; b += 2) {
					e[c[b]] = c[b + 1]
				}
			} else {
				$H(c).each(function(f) {
					e[f.key] = f.value
				})
			}
		}
		for (var a in e) {
			this.transport.setRequestHeader(a, e[a])
		}
	},
	
	success: function() {
		var a = this.getStatus();
		
		return !a || (a >= 200 && a < 300)
	},
	
	getStatus: function() {
		try {
			return this.transport.status || 0
		} catch (a) {
			return 0
		}
	},
	
	respondToReadyState: function(a) {
		var c = Ajax.Request.Events[a],
			b = new Ajax.Response(this);
		if (c == "Complete") {
			try {
				this._complete = true;
				(this.options["on" + b.status] || this.options["on" + (this.success() ? "Success" : "Failure")] || Prototype.emptyFunction)(b, b.headerJSON)
			} catch (d) {
				this.dispatchException(d)
			}
			var f = b.getHeader("Content-type");
			if (this.options.evalJS == "force" || (this.options.evalJS && this.isSameOrigin() && f && f.match(/^\s*(text|application)\/(x-)?(java|ecma)script(;.*)?\s*$/i))) {
				this.evalResponse()
			}
		}
		try {
			(this.options["on" + c] || Prototype.emptyFunction)(b, b.headerJSON);
			Ajax.Responders.dispatch("on" + c, this, b, b.headerJSON)
		} catch (d) {
			this.dispatchException(d)
		}
		if (c == "Complete") {
			this.transport.onreadystatechange = Prototype.emptyFunction
		}
	},
	
	isSameOrigin: function() {
		var a = this.url.match(/^\s*https?:\/\/[^\/]*/);
		return !a || (a[0] == "#{protocol}//#{domain}#{port}".interpolate({
			protocol: location.protocol,
			domain: document.domain,
			port: location.port ? ":" + location.port : ""
		}))
	},
	
	getHeader: function(a) {
		try {
			return this.transport.getResponseHeader(a) || null
		} catch (b) {
			return null
		}
	},
	
	evalResponse: function() {
		try {
			return eval((this.transport.responseText || "").unfilterJSON())
		} catch (e) {
			this.dispatchException(e)
		}
	},
	
	dispatchException: function(a) {
		(this.options.onException || Prototype.emptyFunction)(this, a);
		Ajax.Responders.dispatch("onException", this, a)
	},
	
	abort: function() {
		this.transport.onreadystatechange = Prototype.emptyFunction;
		this.transport.abort();
		
		Ajax.activeRequestCount--
	}
});

Ajax.Request.Events = ["Uninitialized", "Loading", "Loaded", "Interactive", "Complete"];
Ajax.Response = Class.create({
	initialize: function(c) {
		this.request = c;
		var d = this.transport = c.transport,
			a = this.readyState = d.readyState;
		if ((a > 2 && !Prototype.Browser.IE) || a == 4) {
			this.status = this.getStatus();
			
			this.statusText = this.getStatusText();
			
			this.responseText = String.interpret(d.responseText);
			this.headerJSON = this._getHeaderJSON()
		}
		if (a == 4) {
			var b = d.responseXML;
			this.responseXML = Object.isUndefined(b) ? null : b;
			this.responseJSON = this._getResponseJSON()
		}
	},
	
	status: 0,
	statusText: "",
	getStatus: Ajax.Request.prototype.getStatus,
	getStatusText: function() {
		try {
			return this.transport.statusText || ""
		} catch (a) {
			return ""
		}
	},
	
	getHeader: Ajax.Request.prototype.getHeader,
	getAllHeaders: function() {
		try {
			return this.getAllResponseHeaders()
		} catch (a) {
			return null
		}
	},
	
	getResponseHeader: function(a) {
		return this.transport.getResponseHeader(a)
	},
	
	getAllResponseHeaders: function() {
		return this.transport.getAllResponseHeaders()
	},
	
	_getHeaderJSON: function() {
		var a = this.getHeader("X-JSON");
		if (!a) {
			return null
		}
		a = decodeURIComponent(escape(a));
		try {
			return a.evalJSON(this.request.options.sanitizeJSON || !this.request.isSameOrigin())
		} catch (b) {
			this.request.dispatchException(b)
		}
	},
	
	_getResponseJSON: function() {
		var a = this.request.options;
		if (!a.evalJSON || (a.evalJSON != "force" && !(this.getHeader("Content-type") || "").include("application/json")) || this.responseText.blank()) {
			return null
		}
		try {
			return this.responseText.evalJSON(a.sanitizeJSON || !this.request.isSameOrigin())
		} catch (b) {
			this.request.dispatchException(b)
		}
	}
});

Ajax.Updater = Class.create(Ajax.Request, {
	initialize: function($super, a, c, b) {
		this.container = {
			success: (a.success || a),
			failure: (a.failure || (a.success ? null : a))
		};
		
		b = Object.clone(b);
		var d = b.onComplete;
		b.onComplete = (function(e, f) {
			this.updateContent(e.responseText);
			if (Object.isFunction(d)) {
				d(e, f)
			}
		}).bind(this);
		$super(c, b)
	},
	
	updateContent: function(d) {
		var c = this.container[this.success() ? "success" : "failure"],
			a = this.options;
		if (!a.evalScripts) {
			d = d.stripScripts()
		}
		if (c = $(c)) {
			if (a.insertion) {
				if (Object.isString(a.insertion)) {
					var b = {};
					
					b[a.insertion] = d;
					c.insert(b)
				} else {
					a.insertion(c, d)
				}
			} else {
				c.update(d)
			}
		}
	}
});

Ajax.PeriodicalUpdater = Class.create(Ajax.Base, {
	initialize: function($super, a, c, b) {
		$super(b);
		this.onComplete = this.options.onComplete;
		this.frequency = (this.options.frequency || 2);
		this.decay = (this.options.decay || 1);
		this.updater = {};
		
		this.container = a;
		this.url = c;
		this.start()
	},
	
	start: function() {
		this.options.onComplete = this.updateComplete.bind(this);
		this.onTimerEvent()
	},
	
	stop: function() {
		this.updater.options.onComplete = undefined;
		clearTimeout(this.timer);
		(this.onComplete || Prototype.emptyFunction).apply(this, arguments)
	},
	
	updateComplete: function(a) {
		if (this.options.decay) {
			this.decay = (a.responseText == this.lastText ? this.decay * this.options.decay : 1);
			this.lastText = a.responseText
		}
		this.timer = this.onTimerEvent.bind(this).delay(this.decay * this.frequency)
	},
	
	onTimerEvent: function() {
		this.updater = new Ajax.Updater(this.container, this.url, this.options)
	}
});


function $(b) {
	if (arguments.length > 1) {
		for (var a = 0, d = [], c = arguments.length; a < c; a++) {
			d.push($(arguments[a]))
		}
		return d
	}
	if (Object.isString(b)) {
		b = document.getElementById(b)
	}
	return Element.extend(b)
}
if (Prototype.BrowserFeatures.XPath) {
	document._getElementsByXPath = function(f, a) {
		var c = [];
		var e = document.evaluate(f, $(a) || document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
		for (var b = 0, d = e.snapshotLength; b < d; b++) {
			c.push(Element.extend(e.snapshotItem(b)))
		}
		return c
	}
}
if (!window.Node) {
	var Node = {}
}
if (!Node.ELEMENT_NODE) {
	Object.extend(Node, {
		ELEMENT_NODE: 1,
		ATTRIBUTE_NODE: 2,
		TEXT_NODE: 3,
		CDATA_SECTION_NODE: 4,
		ENTITY_REFERENCE_NODE: 5,
		ENTITY_NODE: 6,
		PROCESSING_INSTRUCTION_NODE: 7,
		COMMENT_NODE: 8,
		DOCUMENT_NODE: 9,
		DOCUMENT_TYPE_NODE: 10,
		DOCUMENT_FRAGMENT_NODE: 11,
		NOTATION_NODE: 12
	})
}(function(c) {
	var b = (function() {
		var f = document.createElement("form");
		var e = document.createElement("input");
		var d = document.documentElement;
		e.setAttribute("name", "test");
		f.appendChild(e);
		d.appendChild(f);
		var g = f.elements ? (typeof f.elements.test == "undefined") : null;
		d.removeChild(f);
		f = e = null;
		return g
	})();
	
	var a = c.Element;
	c.Element = function(f, e) {
		e = e || {};
		
		f = f.toLowerCase();
		
		var d = Element.cache;
		if (b && e.name) {
			f = "<" + f + ' name="' + e.name + '">';
			delete e.name;
			return Element.writeAttribute(document.createElement(f), e)
		}
		if (!d[f]) {
			d[f] = Element.extend(document.createElement(f))
		}
		return Element.writeAttribute(d[f].cloneNode(false), e)
	};
	
	Object.extend(c.Element, a || {});
	
	if (a) {
		c.Element.prototype = a.prototype
	}
})(this);
Element.cache = {};

Element.idCounter = 1;
Element.Methods = {
	visible: function(a) {
		return $(a).style.display != "none"
	},
	
	toggle: function(a) {
		a = $(a);
		Element[Element.visible(a) ? "hide" : "show"](a);
		return a
	},
	
	hide: function(a) {
		a = $(a);
		a.style.display = "none";
		return a
	},
	
	show: function(a) {
		a = $(a);
		a.style.display = "";
		return a
	},
	
	remove: function(a) {
		a = $(a);
		a.parentNode.removeChild(a);
		return a
	},
	
	update: (function() {
		var b = (function() {
			var e = document.createElement("select"),
				f = true;
			e.innerHTML = '<option value="test">test</option>';
			if (e.options && e.options[0]) {
				f = e.options[0].nodeName.toUpperCase() !== "OPTION"
			}
			e = null;
			return f
		})();
		
		var a = (function() {
			try {
				var f = document.createElement("table");
				if (f && f.tBodies) {
					f.innerHTML = "<tbody><tr><td>test</td></tr></tbody>";
					var h = typeof f.tBodies[0] == "undefined";
					f = null;
					return h
				}
			} catch (g) {
				return true
			}
		})();
		
		var d = (function() {
			var f = document.createElement("script"),
				h = false;
			try {
				f.appendChild(document.createTextNode(""));
				h = !f.firstChild || f.firstChild && f.firstChild.nodeType !== 3
			} catch (g) {
				h = true
			}
			f = null;
			return h
		})();

		
		function c(f, g) {
			f = $(f);
			if (g && g.toElement) {
				g = g.toElement()
			}
			if (Object.isElement(g)) {
				return f.update().insert(g)
			}
			g = Object.toHTML(g);
			var e = f.tagName.toUpperCase();
			
			if (e === "SCRIPT" && d) {
				f.text = g;
				return f
			}
			if (b || a) {
				if (e in Element._insertionTranslations.tags) {
					while (f.firstChild) {
						f.removeChild(f.firstChild)
					}
					Element._getContentFromAnonymousElement(e, g.stripScripts()).each(function(h) {
						f.appendChild(h)
					})
				} else {
					f.innerHTML = g.stripScripts()
				}
			} else {
				f.innerHTML = g.stripScripts()
			}
			g.evalScripts.bind(g).defer();
			
			return f
		}
		return c
	})(),
	replace: function(b, c) {
		b = $(b);
		if (c && c.toElement) {
			c = c.toElement()
		} else {
			if (!Object.isElement(c)) {
				c = Object.toHTML(c);
				var a = b.ownerDocument.createRange();
				
				a.selectNode(b);
				c.evalScripts.bind(c).defer();
				
				c = a.createContextualFragment(c.stripScripts())
			}
		}
		b.parentNode.replaceChild(c, b);
		return b
	},
	
	insert: function(c, e) {
		c = $(c);
		if (Object.isString(e) || Object.isNumber(e) || Object.isElement(e) || (e && (e.toElement || e.toHTML))) {
			e = {
				bottom: e
			}
		}
		var d, f, b, g;
		for (var a in e) {
			d = e[a];
			a = a.toLowerCase();
			
			f = Element._insertionTranslations[a];
			if (d && d.toElement) {
				d = d.toElement()
			}
			if (Object.isElement(d)) {
				f(c, d);
				continue
			}
			d = Object.toHTML(d);
			b = ((a == "before" || a == "after") ? c.parentNode : c).tagName.toUpperCase();
			
			g = Element._getContentFromAnonymousElement(b, d.stripScripts());
			if (a == "top" || a == "after") {
				g.reverse()
			}
			g.each(f.curry(c));
			d.evalScripts.bind(d).defer()
		}
		return c
	},
	
	wrap: function(b, c, a) {
		b = $(b);
		if (Object.isElement(c)) {
			$(c).writeAttribute(a || {})
		} else {
			if (Object.isString(c)) {
				c = new Element(c, a)
			} else {
				c = new Element("div", c)
			}
		}
		if (b.parentNode) {
			b.parentNode.replaceChild(c, b)
		}
		c.appendChild(b);
		return c
	},
	
	inspect: function(b) {
		b = $(b);
		var a = "<" + b.tagName.toLowerCase();
		
		$H({
			id: "id",
			className: "class"
		}).each(function(f) {
			var e = f.first(),
				c = f.last();
			
			var d = (b[e] || "").toString();
			
			if (d) {
				a += " " + c + "=" + d.inspect(true)
			}
		});
		
		return a + ">"
	},
	
	recursivelyCollect: function(a, c) {
		a = $(a);
		var b = [];
		while (a = a[c]) {
			if (a.nodeType == 1) {
				b.push(Element.extend(a))
			}
		}
		return b
	},
	
	ancestors: function(a) {
		return Element.recursivelyCollect(a, "parentNode")
	},
	
	descendants: function(a) {
		return Element.select(a, "*")
	},
	
	firstDescendant: function(a) {
		a = $(a).firstChild;
		while (a && a.nodeType != 1) {
			a = a.nextSibling
		}
		return $(a)
	},
	
	immediateDescendants: function(a) {
		if (!(a = $(a).firstChild)) {
			return []
		}
		while (a && a.nodeType != 1) {
			a = a.nextSibling
		}
		if (a) {
			return [a].concat($(a).nextSiblings())
		}
		return []
	},
	
	previousSiblings: function(a) {
		return Element.recursivelyCollect(a, "previousSibling")
	},
	
	nextSiblings: function(a) {
		return Element.recursivelyCollect(a, "nextSibling")
	},
	
	siblings: function(a) {
		a = $(a);
		return Element.previousSiblings(a).reverse().concat(Element.nextSiblings(a))
	},
	
	match: function(b, a) {
		if (Object.isString(a)) {
			a = new Selector(a)
		}
		return a.match($(b))
	},
	
	up: function(b, d, a) {
		b = $(b);
		if (arguments.length == 1) {
			return $(b.parentNode)
		}
		var c = Element.ancestors(b);
		return Object.isNumber(d) ? c[d] : Selector.findElement(c, d, a)
	},
	
	down: function(b, c, a) {
		b = $(b);
		if (arguments.length == 1) {
			return Element.firstDescendant(b)
		}
		return Object.isNumber(c) ? Element.descendants(b)[c] : Element.select(b, c)[a || 0]
	},
	
	previous: function(b, d, a) {
		b = $(b);
		if (arguments.length == 1) {
			return $(Selector.handlers.previousElementSibling(b))
		}
		var c = Element.previousSiblings(b);
		return Object.isNumber(d) ? c[d] : Selector.findElement(c, d, a)
	},
	
	next: function(c, d, b) {
		c = $(c);
		if (arguments.length == 1) {
			return $(Selector.handlers.nextElementSibling(c))
		}
		var a = Element.nextSiblings(c);
		return Object.isNumber(d) ? a[d] : Selector.findElement(a, d, b)
	},
	
	select: function(b) {
		var a = Array.prototype.slice.call(arguments, 1);
		return Selector.findChildElements(b, a)
	},
	
	adjacent: function(b) {
		var a = Array.prototype.slice.call(arguments, 1);
		return Selector.findChildElements(b.parentNode, a).without(b)
	},
	
	identify: function(a) {
		a = $(a);
		var b = Element.readAttribute(a, "id");
		if (b) {
			return b
		}
		do {
			b = "anonymous_element_" + Element.idCounter++
		} while 
		($(b));
		Element.writeAttribute(a, "id", b);
		return b
	},
	
	readAttribute: function(c, a) {
		c = $(c);
		if (Prototype.Browser.IE) {
			var b = Element._attributeTranslations.read;
			if (b.values[a]) {
				return b.values[a](c, a)
			}
			if (b.names[a]) {
				a = b.names[a]
			}
			if (a.include(":")) {
				return (!c.attributes || !c.attributes[a]) ? null : c.attributes[a].value
			}
		}
		return c.getAttribute(a)
	},
	
	writeAttribute: function(e, c, f) {
		e = $(e);
		var b = {},
			d = Element._attributeTranslations.write;
		if (typeof c == "object") {
			b = c
		} else {
			b[c] = Object.isUndefined(f) ? true : f
		}
		for (var a in b) {
			c = d.names[a] || a;
			f = b[a];
			if (d.values[a]) {
				c = d.values[a](e, f)
			}
			if (f === false || f === null) {
				e.removeAttribute(c)
			} else {
				if (f === true) {
					e.setAttribute(c, c)
				} else {
					e.setAttribute(c, f)
				}
			}
		}
		return e
	},
	
	getHeight: function(a) {
		return Element.getDimensions(a).height
	},
	
	getWidth: function(a) {
		return Element.getDimensions(a).width
	},
	
	classNames: function(a) {
		return new Element.ClassNames(a)
	},
	
	hasClassName: function(a, b) {
		if (!(a = $(a))) {
			return
		}
		var c = a.className;
		return (c.length > 0 && (c == b || new RegExp("(^|\\s)" + b + "(\\s|$)").test(c)))
	},
	
	addClassName: function(a, b) {
		if (!(a = $(a))) {
			return
		}
		if (!Element.hasClassName(a, b)) {
			a.className += (a.className ? " " : "") + b
		}
		return a
	},
	
	removeClassName: function(a, b) {
		if (!(a = $(a))) {
			return
		}
		a.className = a.className.replace(new RegExp("(^|\\s+)" + b + "(\\s+|$)"), " ").strip();
		
		return a
	},
	
	toggleClassName: function(a, b) {
		if (!(a = $(a))) {
			return
		}
		return Element[Element.hasClassName(a, b) ? "removeClassName" : "addClassName"](a, b)
	},
	
	cleanWhitespace: function(b) {
		b = $(b);
		var c = b.firstChild;
		while (c) {
			var a = c.nextSibling;
			if (c.nodeType == 3 && !/\S/.test(c.nodeValue)) {
				b.removeChild(c)
			}
			c = a
		}
		return b
	},
	
	empty: function(a) {
		return $(a).innerHTML.blank()
	},
	
	descendantOf: function(b, a) {
		b = $(b), a = $(a);
		if (b.compareDocumentPosition) {
			return (b.compareDocumentPosition(a) & 8) === 8
		}
		if (a.contains) {
			return a.contains(b) && a !== b
		}
		while (b = b.parentNode) {
			if (b == a) {
				return true
			}
		}
		return false
	},
	
	scrollTo: function(a) {
		a = $(a);
		var b = Element.cumulativeOffset(a);
		window.scrollTo(b[0], b[1]);
		return a
	},
	
	getStyle: function(b, c) {
		b = $(b);
		c = c == "float" ? "cssFloat" : c.camelize();
		
		var d = b.style[c];
		if (!d || d == "auto") {
			var a = document.defaultView.getComputedStyle(b, null);
			d = a ? a[c] : null
		}
		if (c == "opacity") {
			return d ? parseFloat(d) : 1
		}
		return d == "auto" ? null : d
	},
	
	getOpacity: function(a) {
		return $(a).getStyle("opacity")
	},
	
	setStyle: function(b, c) {
		b = $(b);
		var e = b.style,
			a;
		if (Object.isString(c)) {
			b.style.cssText += ";" + c;
			return c.include("opacity") ? b.setOpacity(c.match(/opacity:\s*(\d?\.?\d*)/)[1]) : b
		}
		for (var d in c) {
			if (d == "opacity") {
				b.setOpacity(c[d])
			} else {
				e[(d == "float" || d == "cssFloat") ? (Object.isUndefined(e.styleFloat) ? "cssFloat" : "styleFloat") : d] = c[d]
			}
		}
		return b
	},
	
	setOpacity: function(a, b) {
		a = $(a);
		a.style.opacity = (b == 1 || b === "") ? "" : (b < 0.00001) ? 0 : b;
		return a
	},
	
	getDimensions: function(c) {
		c = $(c);
		var g = Element.getStyle(c, "display");
		if (g != "none" && g != null) {
			return {
				width: c.offsetWidth,
				height: c.offsetHeight
			}
		}
		var b = c.style;
		var f = b.visibility;
		var d = b.position;
		var a = b.display;
		b.visibility = "hidden";
		if (d != "fixed") {
			b.position = "absolute"
		}
		b.display = "block";
		var h = c.clientWidth;
		var e = c.clientHeight;
		b.display = a;
		b.position = d;
		b.visibility = f;
		return {
			width: h,
			height: e
		}
	},
	
	makePositioned: function(a) {
		a = $(a);
		var b = Element.getStyle(a, "position");
		if (b == "static" || !b) {
			a._madePositioned = true;
			a.style.position = "relative";
			if (Prototype.Browser.Opera) {
				a.style.top = 0;
				a.style.left = 0
			}
		}
		return a
	},
	
	undoPositioned: function(a) {
		a = $(a);
		if (a._madePositioned) {
			a._madePositioned = undefined;
			a.style.position = a.style.top = a.style.left = a.style.bottom = a.style.right = ""
		}
		return a
	},
	
	makeClipping: function(a) {
		a = $(a);
		if (a._overflow) {
			return a
		}
		a._overflow = Element.getStyle(a, "overflow") || "auto";
		if (a._overflow !== "hidden") {
			a.style.overflow = "hidden"
		}
		return a
	},
	
	undoClipping: function(a) {
		a = $(a);
		if (!a._overflow) {
			return a
		}
		a.style.overflow = a._overflow == "auto" ? "" : a._overflow;
		a._overflow = null;
		return a
	},
	
	cumulativeOffset: function(b) {
		var a = 0,
			c = 0;
		do {
			a += b.offsetTop || 0;
			c += b.offsetLeft || 0;
			b = b.offsetParent
		} while 
		(b);
		return Element._returnOffset(c, a)
	},
	
	positionedOffset: function(b) {
		var a = 0,
			d = 0;
		do {
			a += b.offsetTop || 0;
			d += b.offsetLeft || 0;
			b = b.offsetParent;
			if (b) {
				if (b.tagName.toUpperCase() == "BODY") {
					break
				}
				var c = Element.getStyle(b, "position");
				if (c !== "static") {
					break
				}
			}
		} while 
		(b);
		return Element._returnOffset(d, a)
	},
	
	absolutize: function(b) {
		b = $(b);
		if (Element.getStyle(b, "position") == "absolute") {
			return b
		}
		var d = Element.positionedOffset(b);
		var f = d[1];
		var e = d[0];
		var c = b.clientWidth;
		var a = b.clientHeight;
		b._originalLeft = e - parseFloat(b.style.left || 0);
		b._originalTop = f - parseFloat(b.style.top || 0);
		b._originalWidth = b.style.width;
		b._originalHeight = b.style.height;
		b.style.position = "absolute";
		b.style.top = f + "px";
		b.style.left = e + "px";
		b.style.width = c + "px";
		b.style.height = a + "px";
		return b
	},
	
	relativize: function(a) {
		a = $(a);
		if (Element.getStyle(a, "position") == "relative") {
			return a
		}
		a.style.position = "relative";
		var c = parseFloat(a.style.top || 0) - (a._originalTop || 0);
		var b = parseFloat(a.style.left || 0) - (a._originalLeft || 0);
		a.style.top = c + "px";
		a.style.left = b + "px";
		a.style.height = a._originalHeight;
		a.style.width = a._originalWidth;
		return a
	},
	
	cumulativeScrollOffset: function(b) {
		var a = 0,
			c = 0;
		do {
			a += b.scrollTop || 0;
			c += b.scrollLeft || 0;
			b = b.parentNode
		} while 
		(b);
		return Element._returnOffset(c, a)
	},
	
	getOffsetParent: function(a) {
		if (a.offsetParent) {
			return $(a.offsetParent)
		}
		if (a == document.body) {
			return $(a)
		}
		while ((a = a.parentNode) && a != document.body) {
			if (Element.getStyle(a, "position") != "static") {
				return $(a)
			}
		}
		return $(document.body)
	},
	
	viewportOffset: function(d) {
		var a = 0,
			c = 0;
		var b = d;
		do {
			a += b.offsetTop || 0;
			c += b.offsetLeft || 0;
			if (b.offsetParent == document.body && Element.getStyle(b, "position") == "absolute") {
				break
			}
		} while 
		(b = b.offsetParent);
		b = d;
		do {
			if (!Prototype.Browser.Opera || (b.tagName && (b.tagName.toUpperCase() == "BODY"))) {
				a -= b.scrollTop || 0;
				c -= b.scrollLeft || 0
			}
		} while 
		(b = b.parentNode);
		return Element._returnOffset(c, a)
	},
	
	clonePosition: function(b, d) {
		var a = Object.extend({
			setLeft: true,
			setTop: true,
			setWidth: true,
			setHeight: true,
			offsetTop: 0,
			offsetLeft: 0
		}, arguments[2] || {});
		
		d = $(d);
		var e = Element.viewportOffset(d);
		b = $(b);
		var f = [0, 0];
		var c = null;
		if (Element.getStyle(b, "position") == "absolute") {
			c = Element.getOffsetParent(b);
			f = Element.viewportOffset(c)
		}
		if (c == document.body) {
			f[0] -= document.body.offsetLeft;
			f[1] -= document.body.offsetTop
		}
		if (a.setLeft) {
			b.style.left = (e[0] - f[0] + a.offsetLeft) + "px"
		}
		if (a.setTop) {
			b.style.top = (e[1] - f[1] + a.offsetTop) + "px"
		}
		if (a.setWidth) {
			b.style.width = d.offsetWidth + "px"
		}
		if (a.setHeight) {
			b.style.height = d.offsetHeight + "px"
		}
		return b
	}
};

Object.extend(Element.Methods, {
	getElementsBySelector: Element.Methods.select,
	childElements: Element.Methods.immediateDescendants
});

Element._attributeTranslations = {
	write: {
		names: {
			className: "class",
			htmlFor: "for"
		},
		
		values: {}
	}
};

if (Prototype.Browser.Opera) {
	Element.Methods.getStyle = Element.Methods.getStyle.wrap(function(d, b, c) {
		switch (c) {
			case "left":
			case "top":
			case "right":
			case "bottom":
				if (d(b, "position") === "static") {
					return null
				}
			case "height":
			case "width":
				if (!Element.visible(b)) {
					return null
				}
				var e = parseInt(d(b, c), 10);
				if (e !== b["offset" + c.capitalize()]) {
					return e + "px"
				}
				var a;
				if (c === "height") {
					a = ["border-top-width", "padding-top", "padding-bottom", "border-bottom-width"]
				} else {
					a = ["border-left-width", "padding-left", "padding-right", "border-right-width"]
				}
				return a.inject(e, function(f, g) {
					var h = d(b, g);
					return h === null ? f : f - parseInt(h, 10)
				}) + "px";
			default:
				return d(b, c)
		}
	});
	
	Element.Methods.readAttribute = Element.Methods.readAttribute.wrap(function(c, a, b) {
		if (b === "title") {
			return a.title
		}
		return c(a, b)
	})
} else {
	if (Prototype.Browser.IE) {
		Element.Methods.getOffsetParent = Element.Methods.getOffsetParent.wrap(function(c, b) {
			b = $(b);
			try {
				b.offsetParent
			} catch (f) {
				return $(document.body)
			}
			var a = b.getStyle("position");
			if (a !== "static") {
				return c(b)
			}
			b.setStyle({
				position: "relative"
			});
			
			var d = c(b);
			b.setStyle({
				position: a
			});
			
			return d
		});
		
		$w("positionedOffset viewportOffset").each(function(a) {
			Element.Methods[a] = Element.Methods[a].wrap(function(f, c) {
				c = $(c);
				try {
					c.offsetParent
				} catch (h) {
					return Element._returnOffset(0, 0)
				}
				var b = c.getStyle("position");
				if (b !== "static") {
					return f(c)
				}
				var d = c.getOffsetParent();
				
				if (d && d.getStyle("position") === "fixed") {
					d.setStyle({
						zoom: 1
					})
				}
				c.setStyle({
					position: "relative"
				});
				
				var g = f(c);
				c.setStyle({
					position: b
				});
				
				return g
			})
		});
		
		Element.Methods.cumulativeOffset = Element.Methods.cumulativeOffset.wrap(function(b, a) {
			try {
				a.offsetParent
			} catch (c) {
				return Element._returnOffset(0, 0)
			}
			return b(a)
		});
		
		Element.Methods.getStyle = function(a, b) {
			a = $(a);
			b = (b == "float" || b == "cssFloat") ? "styleFloat" : b.camelize();
			
			var c = a.style[b];
			if (!c && a.currentStyle) {
				c = a.currentStyle[b]
			}
			if (b == "opacity") {
				if (c = (a.getStyle("filter") || "").match(/alpha\(opacity=(.*)\)/)) {
					if (c[1]) {
						return parseFloat(c[1]) / 100
					}
				}
				return 1
			}
			if (c == "auto") {
				if ((b == "width" || b == "height") && (a.getStyle("display") != "none")) {
					return a["offset" + b.capitalize()] + "px"
				}
				return null
			}
			return c
		};
		
		Element.Methods.setOpacity = function(b, e) {
			function f(g) {
				return g.replace(/alpha\([^\)]*\)/gi, "")
			}
			b = $(b);
			var a = b.currentStyle;
			if ((a && !a.hasLayout) || (!a && b.style.zoom == "normal")) {
				b.style.zoom = 1
			}
			var d = b.getStyle("filter"),
				c = b.style;
			if (e == 1 || e === "") {
				(d = f(d)) ? c.filter = d : c.removeAttribute("filter");
				return b
			} else {
				if (e < 0.00001) {
					e = 0
				}
			}
			c.filter = f(d) + "alpha(opacity=" + (e * 100) + ")";
			return b
		};
		
		Element._attributeTranslations = (function() {
			var b = "className";
			var a = "for";
			var c = document.createElement("div");
			c.setAttribute(b, "x");
			if (c.className !== "x") {
				c.setAttribute("class", "x");
				if (c.className === "x") {
					b = "class"
				}
			}
			c = null;
			c = document.createElement("label");
			c.setAttribute(a, "x");
			if (c.htmlFor !== "x") {
				c.setAttribute("htmlFor", "x");
				if (c.htmlFor === "x") {
					a = "htmlFor"
				}
			}
			c = null;
			return {
				read: {
					names: {
						"class": b,
						className: b,
						"for": a,
						htmlFor: a
					},
					
					values: {
						_getAttr: function(d, e) {
							return d.getAttribute(e)
						},
						
						_getAttr2: function(d, e) {
							return d.getAttribute(e, 2)
						},
						
						_getAttrNode: function(d, f) {
							var e = d.getAttributeNode(f);
							return e ? e.value : ""
						},
						
						_getEv: (function() {
							var d = document.createElement("div");
							d.onclick = Prototype.emptyFunction;
							var g = d.getAttribute("onclick");
							var e;
							if (String(g).indexOf("{") > -1) {
								e = function(f, h) {
									h = f.getAttribute(h);
									if (!h) {
										return null
									}
									h = h.toString();
									
									h = h.split("{")[1];
									h = h.split("}")[0];
									return h.strip()
								}
							} else {
								if (g === "") {
									e = function(f, h) {
										h = f.getAttribute(h);
										if (!h) {
											return null
										}
										return h.strip()
									}
								}
							}
							d = null;
							return e
						})(),
						_flag: function(d, e) {
							return $(d).hasAttribute(e) ? e : null
						},
						
						style: function(d) {
							return d.style.cssText.toLowerCase()
						},
						
						title: function(d) {
							return d.title
						}
					}
				}
			}
		})();
		
		Element._attributeTranslations.write = {
			names: Object.extend({
				cellpadding: "cellPadding",
				cellspacing: "cellSpacing"
			}, Element._attributeTranslations.read.names),
			values: {
				checked: function(a, b) {
					a.checked = !! b
				},
				
				style: function(a, b) {
					a.style.cssText = b ? b : ""
				}
			}
		};
		
		Element._attributeTranslations.has = {};
		
		$w("colSpan rowSpan vAlign dateTime accessKey tabIndex encType maxLength readOnly longDesc frameBorder").each(function(a) {
			Element._attributeTranslations.write.names[a.toLowerCase()] = a;
			Element._attributeTranslations.has[a.toLowerCase()] = a
		});
		(function(a) {
			Object.extend(a, {
				href: a._getAttr2,
				src: a._getAttr2,
				type: a._getAttr,
				action: a._getAttrNode,
				disabled: a._flag,
				checked: a._flag,
				readonly: a._flag,
				multiple: a._flag,
				onload: a._getEv,
				onunload: a._getEv,
				onclick: a._getEv,
				ondblclick: a._getEv,
				onmousedown: a._getEv,
				onmouseup: a._getEv,
				onmouseover: a._getEv,
				onmousemove: a._getEv,
				onmouseout: a._getEv,
				onfocus: a._getEv,
				onblur: a._getEv,
				onkeypress: a._getEv,
				onkeydown: a._getEv,
				onkeyup: a._getEv,
				onsubmit: a._getEv,
				onreset: a._getEv,
				onselect: a._getEv,
				onchange: a._getEv
			})
		})(Element._attributeTranslations.read.values);
		if (Prototype.BrowserFeatures.ElementExtensions) {
			(function() {
				function a(e) {
					var b = e.getElementsByTagName("*"),
						d = [];
					for (var c = 0, f; f = b[c]; c++) {
						if (f.tagName !== "!") {
							d.push(f)
						}
					}
					return d
				}
				Element.Methods.down = function(c, d, b) {
					c = $(c);
					if (arguments.length == 1) {
						return c.firstDescendant()
					}
					return Object.isNumber(d) ? a(c)[d] : Element.select(c, d)[b || 0]
				}
			})()
		}
	} else {
		if (Prototype.Browser.Gecko && /rv:1\.8\.0/.test(navigator.userAgent)) {
			Element.Methods.setOpacity = function(a, b) {
				a = $(a);
				a.style.opacity = (b == 1) ? 0.999999 : (b === "") ? "" : (b < 0.00001) ? 0 : b;
				return a
			}
		} else {
			if (Prototype.Browser.WebKit) {
				Element.Methods.setOpacity = function(a, b) {
					a = $(a);
					a.style.opacity = (b == 1 || b === "") ? "" : (b < 0.00001) ? 0 : b;
					if (b == 1) {
						if (a.tagName.toUpperCase() == "IMG" && a.width) {
							a.width++;
							a.width--
						} else {
							try {
								var d = document.createTextNode(" ");
								a.appendChild(d);
								a.removeChild(d)
							} catch (c) {}
						}
					}
					return a
				};
				
				Element.Methods.cumulativeOffset = function(b) {
					var a = 0,
						c = 0;
					do {
						a += b.offsetTop || 0;
						c += b.offsetLeft || 0;
						if (b.offsetParent == document.body) {
							if (Element.getStyle(b, "position") == "absolute") {
								break
							}
						}
						b = b.offsetParent
					} while 
					(b);
					return Element._returnOffset(c, a)
				}
			}
		}
	}
}
if ("outerHTML" in document.documentElement) {
	Element.Methods.replace = function(c, e) {
		c = $(c);
		if (e && e.toElement) {
			e = e.toElement()
		}
		if (Object.isElement(e)) {
			c.parentNode.replaceChild(e, c);
			return c
		}
		e = Object.toHTML(e);
		var d = c.parentNode,
			b = d.tagName.toUpperCase();
		
		if (Element._insertionTranslations.tags[b]) {
			var f = c.next();
			
			var a = Element._getContentFromAnonymousElement(b, e.stripScripts());
			d.removeChild(c);
			if (f) {
				a.each(function(g) {
					d.insertBefore(g, f)
				})
			} else {
				a.each(function(g) {
					d.appendChild(g)
				})
			}
		} else {
			c.outerHTML = e.stripScripts()
		}
		e.evalScripts.bind(e).defer();
		
		return c
	}
}
Element._returnOffset = function(b, c) {
	var a = [b, c];
	a.left = b;
	a.top = c;
	return a
};

Element._getContentFromAnonymousElement = function(c, b) {
	var d = new Element("div"),
		a = Element._insertionTranslations.tags[c];
	if (a) {
		d.innerHTML = a[0] + b + a[1];
		a[2].times(function() {
			d = d.firstChild
		})
	} else {
		d.innerHTML = b
	}
	return $A(d.childNodes)
};

Element._insertionTranslations = {
	before: function(a, b) {
		a.parentNode.insertBefore(b, a)
	},
	
	top: function(a, b) {
		a.insertBefore(b, a.firstChild)
	},
	
	bottom: function(a, b) {
		a.appendChild(b)
	},
	
	after: function(a, b) {
		a.parentNode.insertBefore(b, a.nextSibling)
	},
	
	tags: {
		TABLE: ["<table>", "</table>", 1],
		TBODY: ["<table><tbody>", "</tbody></table>", 2],
		TR: ["<table><tbody><tr>", "</tr></tbody></table>", 3],
		TD: ["<table><tbody><tr><td>", "</td></tr></tbody></table>", 4],
		SELECT: ["<select>", "</select>", 1]
	}
};
(function() {
	var a = Element._insertionTranslations.tags;
	Object.extend(a, {
		THEAD: a.TBODY,
		TFOOT: a.TBODY,
		TH: a.TD
	})
})();

Element.Methods.Simulated = {
	hasAttribute: function(a, c) {
		c = Element._attributeTranslations.has[c] || c;
		var b = $(a).getAttributeNode(c);
		return !!(b && b.specified)
	}
};

Element.Methods.ByTag = {};

Object.extend(Element, Element.Methods);
(function(a) {
	if (!Prototype.BrowserFeatures.ElementExtensions && a.__proto__) {
		window.HTMLElement = {};
		
		window.HTMLElement.prototype = a.__proto__;
		Prototype.BrowserFeatures.ElementExtensions = true
	}
	a = null
})(document.createElement("div"));
Element.extend = (function() {
	function c(g) {
		if (typeof window.Element != "undefined") {
			var i = window.Element.prototype;
			if (i) {
				var k = "_" + (Math.random() + "").slice(2);
				var h = document.createElement(g);
				i[k] = "x";
				var j = (h[k] !== "x");
				delete i[k];
				h = null;
				return j
			}
		}
		return false
	}
	function b(h, g) {
		for (var j in g) {
			var i = g[j];
			if (Object.isFunction(i) && !(j in h)) {
				h[j] = i.methodize()
			}
		}
	}
	var d = c("object");
	if (Prototype.BrowserFeatures.SpecificElementExtensions) {
		if (d) {
			return function(h) {
				if (h && typeof h._extendedByPrototype == "undefined") {
					var g = h.tagName;
					if (g && (/^(?:object|applet|embed)$/i.test(g))) {
						b(h, Element.Methods);
						b(h, Element.Methods.Simulated);
						b(h, Element.Methods.ByTag[g.toUpperCase()])
					}
				}
				return h
			}
		}
		return Prototype.K
	}
	var a = {},
		e = Element.Methods.ByTag;
	var f = Object.extend(function(i) {
		if (!i || typeof i._extendedByPrototype != "undefined" || i.nodeType != 1 || i == window) {
			return i
		}
		var g = Object.clone(a),
			h = i.tagName.toUpperCase();
		
		if (e[h]) {
			Object.extend(g, e[h])
		}
		b(i, g);
		i._extendedByPrototype = Prototype.emptyFunction;
		return i
	}, {
		refresh: function() {
			if (!Prototype.BrowserFeatures.ElementExtensions) {
				Object.extend(a, Element.Methods);
				Object.extend(a, Element.Methods.Simulated)
			}
		}
	});
	
	f.refresh();
	
	return f
})();

Element.hasAttribute = function(a, b) {
	if (a.hasAttribute) {
		return a.hasAttribute(b)
	}
	return Element.Methods.Simulated.hasAttribute(a, b)
};

Element.addMethods = function(c) {
	var i = Prototype.BrowserFeatures,
		d = Element.Methods.ByTag;
	if (!c) {
		Object.extend(Form, Form.Methods);
		Object.extend(Form.Element, Form.Element.Methods);
		Object.extend(Element.Methods.ByTag, {
			FORM: Object.clone(Form.Methods),
			INPUT: Object.clone(Form.Element.Methods),
			SELECT: Object.clone(Form.Element.Methods),
			TEXTAREA: Object.clone(Form.Element.Methods)
		})
	}
	if (arguments.length == 2) {
		var b = c;
		c = arguments[1]
	}
	if (!b) {
		Object.extend(Element.Methods, c || {})
	} else {
		if (Object.isArray(b)) {
			b.each(g)
		} else {
			g(b)
		}
	}
	function g(k) {
		k = k.toUpperCase();
		
		if (!Element.Methods.ByTag[k]) {
			Element.Methods.ByTag[k] = {}
		}
		Object.extend(Element.Methods.ByTag[k], c)
	}
	function a(m, l, k) {
		k = k || false;
		for (var o in m) {
			var n = m[o];
			if (!Object.isFunction(n)) {
				continue
			}
			if (!k || !(o in l)) {
				l[o] = n.methodize()
			}
		}
	}
	function e(n) {
		var k;
		var m = {
			OPTGROUP: "OptGroup",
			TEXTAREA: "TextArea",
			P: "Paragraph",
			FIELDSET: "FieldSet",
			UL: "UList",
			OL: "OList",
			DL: "DList",
			DIR: "Directory",
			H1: "Heading",
			H2: "Heading",
			H3: "Heading",
			H4: "Heading",
			H5: "Heading",
			H6: "Heading",
			Q: "Quote",
			INS: "Mod",
			DEL: "Mod",
			A: "Anchor",
			IMG: "Image",
			CAPTION: "TableCaption",
			COL: "TableCol",
			COLGROUP: "TableCol",
			THEAD: "TableSection",
			TFOOT: "TableSection",
			TBODY: "TableSection",
			TR: "TableRow",
			TH: "TableCell",
			TD: "TableCell",
			FRAMESET: "FrameSet",
			IFRAME: "IFrame"
		};
		
		if (m[n]) {
			k = "HTML" + m[n] + "Element"
		}
		if (window[k]) {
			return window[k]
		}
		k = "HTML" + n + "Element";
		if (window[k]) {
			return window[k]
		}
		k = "HTML" + n.capitalize() + "Element";
		if (window[k]) {
			return window[k]
		}
		var l = document.createElement(n);
		var o = l.__proto__ || l.constructor.prototype;
		l = null;
		return o
	}
	var h = window.HTMLElement ? HTMLElement.prototype : Element.prototype;
	if (i.ElementExtensions) {
		a(Element.Methods, h);
		a(Element.Methods.Simulated, h, true)
	}
	if (i.SpecificElementExtensions) {
		for (var j in Element.Methods.ByTag) {
			var f = e(j);
			if (Object.isUndefined(f)) {
				continue
			}
			a(d[j], f.prototype)
		}
	}
	Object.extend(Element, Element.Methods);
	delete Element.ByTag;
	if (Element.extend.refresh) {
		Element.extend.refresh()
	}
	Element.cache = {}
};

document.viewport = {
	getDimensions: function() {
		return {
			width: this.getWidth(),
			height: this.getHeight()
		}
	},
	
	getScrollOffsets: function() {
		return Element._returnOffset(window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft, window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop)
	}
};
(function(b) {
	var g = Prototype.Browser,
		e = document,
		c, d = {};

	
	function a() {
		if (g.WebKit && !e.evaluate) {
			return document
		}
		if (g.Opera && window.parseFloat(window.opera.version()) < 9.5) {
			return document.body
		}
		return document.documentElement
	}
	function f(h) {
		if (!c) {
			c = a()
		}
		d[h] = "client" + h;
		b["get" + h] = function() {
			return c[d[h]]
		};
		
		return b["get" + h]()
	}
	b.getWidth = f.curry("Width");
	b.getHeight = f.curry("Height")
})(document.viewport);
Element.Storage = {
	UID: 1
};

Element.addMethods({
	getStorage: function(b) {
		if (!(b = $(b))) {
			return
		}
		var a;
		if (b === window) {
			a = 0
		} else {
			if (typeof b._prototypeUID === "undefined") {
				b._prototypeUID = [Element.Storage.UID++]
			}
			a = b._prototypeUID[0]
		}
		if (!Element.Storage[a]) {
			Element.Storage[a] = $H()
		}
		return Element.Storage[a]
	},
	
	store: function(b, a, c) {
		if (!(b = $(b))) {
			return
		}
		if (arguments.length === 2) {
			Element.getStorage(b).update(a)
		} else {
			Element.getStorage(b).set(a, c)
		}
		return b
	},
	
	retrieve: function(c, b, a) {
		if (!(c = $(c))) {
			return
		}
		var e = Element.getStorage(c),
			d = e.get(b);
		if (Object.isUndefined(d)) {
			e.set(b, a);
			d = a
		}
		return d
	},
	
	clone: function(c, a) {
		if (!(c = $(c))) {
			return
		}
		var e = c.cloneNode(a);
		e._prototypeUID = void 0;
		if (a) {
			var d = Element.select(e, "*"),
				b = d.length;
			while (b--) {
				d[b]._prototypeUID = void 0
			}
		}
		return Element.extend(e)
	}
});

var Selector = Class.create({
	initialize: function(a) {
		this.expression = a.strip();
		
		if (this.shouldUseSelectorsAPI()) {
			this.mode = "selectorsAPI"
		} else {
			if (this.shouldUseXPath()) {
				this.mode = "xpath";
				this.compileXPathMatcher()
			} else {
				this.mode = "normal";
				this.compileMatcher()
			}
		}
	},
	
	shouldUseXPath: (function() {
		var a = (function() {
			var e = false;
			if (document.evaluate && window.XPathResult) {
				var d = document.createElement("div");
				d.innerHTML = "<ul><li></li></ul><div><ul><li></li></ul></div>";
				var c = ".//*[local-name()='ul' or local-name()='UL']//*[local-name()='li' or local-name()='LI']";
				var b = document.evaluate(c, d, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
				e = (b.snapshotLength !== 2);
				d = null
			}
			return e
		})();
		
		return function() {
			if (!Prototype.BrowserFeatures.XPath) {
				return false
			}
			var b = this.expression;
			if (Prototype.Browser.WebKit && (b.include("-of-type") || b.include(":empty"))) {
				return false
			}
			if ((/(\[[\w-]*?:|:checked)/).test(b)) {
				return false
			}
			if (a) {
				return false
			}
			return true
		}
	})(),
	shouldUseSelectorsAPI: function() {
		if (!Prototype.BrowserFeatures.SelectorsAPI) {
			return false
		}
		if (Selector.CASE_INSENSITIVE_CLASS_NAMES) {
			return false
		}
		if (!Selector._div) {
			Selector._div = new Element("div")
		}
		try {
			Selector._div.querySelector(this.expression)
		} catch (a) {
			return false
		}
		return true
	},
	
	compileMatcher: function() {
		var e = this.expression,
			ps = Selector.patterns,
			h = Selector.handlers,
			c = Selector.criteria,
			le, p, m, len = ps.length,
			name;
		if (Selector._cache[e]) {
			this.matcher = Selector._cache[e];
			return
		}
		this.matcher = ["this.matcher = function(root) {", "var r = root, h = Selector.handlers, c = false, n;"];
		while (e && le != e && (/\S/).test(e)) {
			le = e;
			for (var i = 0; i < len; i++) {
				p = ps[i].re;
				name = ps[i].name;
				if (m = e.match(p)) {
					this.matcher.push(Object.isFunction(c[name]) ? c[name](m) : new Template(c[name]).evaluate(m));
					e = e.replace(m[0], "");
					break
				}
			}
		}
		this.matcher.push("return h.unique(n);\n}");
		eval(this.matcher.join("\n"));
		Selector._cache[this.expression] = this.matcher
	},
	
	compileXPathMatcher: function() {
		var h = this.expression,
			j = Selector.patterns,
			c = Selector.xpath,
			g, b, a = j.length,
			d;
		if (Selector._cache[h]) {
			this.xpath = Selector._cache[h];
			return
		}
		this.matcher = [".//*"];
		while (h && g != h && (/\S/).test(h)) {
			g = h;
			for (var f = 0; f < a; f++) {
				d = j[f].name;
				if (b = h.match(j[f].re)) {
					this.matcher.push(Object.isFunction(c[d]) ? c[d](b) : new Template(c[d]).evaluate(b));
					h = h.replace(b[0], "");
					break
				}
			}
		}
		this.xpath = this.matcher.join("");
		Selector._cache[this.expression] = this.xpath
	},
	
	findElements: function(a) {
		a = a || document;
		var c = this.expression,
			b;
		switch (this.mode) {
			case "selectorsAPI":
				if (a !== document) {
					var d = a.id,
						f = $(a).identify();
					
					f = f.replace(/([\.:])/g, "\\$1");
					c = "#" + f + " " + c
				}
				b = $A(a.querySelectorAll(c)).map(Element.extend);
				a.id = d;
				return b;
			case "xpath":
				return document._getElementsByXPath(this.xpath, a);
			default:
				return this.matcher(a)
		}
	},
	
	match: function(k) {
		this.tokens = [];
		var q = this.expression,
			a = Selector.patterns,
			f = Selector.assertions;
		var b, d, g, o = a.length,
			c;
		while (q && b !== q && (/\S/).test(q)) {
			b = q;
			for (var j = 0; j < o; j++) {
				d = a[j].re;
				c = a[j].name;
				if (g = q.match(d)) {
					if (f[c]) {
						this.tokens.push([c, Object.clone(g)]);
						q = q.replace(g[0], "")
					} else {
						return this.findElements(document).include(k)
					}
				}
			}
		}
		var n = true,
			c, l;
		for (var j = 0, h; h = this.tokens[j]; j++) {
			c = h[0], l = h[1];
			if (!Selector.assertions[c](k, l)) {
				n = false;
				break
			}
		}
		return n
	},
	
	toString: function() {
		return this.expression
	},
	
	inspect: function() {
		return "#<Selector:" + this.expression.inspect() + ">"
	}
});

if (Prototype.BrowserFeatures.SelectorsAPI && document.compatMode === "BackCompat") {
	Selector.CASE_INSENSITIVE_CLASS_NAMES = (function() {
		var c = document.createElement("div"),
			a = document.createElement("span");
		c.id = "prototype_test_id";
		a.className = "Test";
		c.appendChild(a);
		var b = (c.querySelector("#prototype_test_id .test") !== null);
		c = a = null;
		return b
	})()
}
Object.extend(Selector, {
	_cache: {},
	
	xpath: {
		descendant: "//*",
		child: "/*",
		adjacent: "/following-sibling::*[1]",
		laterSibling: "/following-sibling::*",
		tagName: function(a) {
			if (a[1] == "*") {
				return ""
			}
			return "[local-name()='" + a[1].toLowerCase() + "' or local-name()='" + a[1].toUpperCase() + "']"
		},
		
		className: "[contains(concat(' ', @class, ' '), ' #{1} ')]",
		id: "[@id='#{1}']",
		attrPresence: function(a) {
			a[1] = a[1].toLowerCase();
			
			return new Template("[@#{1}]").evaluate(a)
		},
		
		attr: function(a) {
			a[1] = a[1].toLowerCase();
			
			a[3] = a[5] || a[6];
			return new Template(Selector.xpath.operators[a[2]]).evaluate(a)
		},
		
		pseudo: function(a) {
			var b = Selector.xpath.pseudos[a[1]];
			if (!b) {
				return ""
			}
			if (Object.isFunction(b)) {
				return b(a)
			}
			return new Template(Selector.xpath.pseudos[a[1]]).evaluate(a)
		},
		
		operators: {
			"=": "[@#{1}='#{3}']",
			"!=": "[@#{1}!='#{3}']",
			"^=": "[starts-with(@#{1}, '#{3}')]",
			"$=": "[substring(@#{1}, (string-length(@#{1}) - string-length('#{3}') + 1))='#{3}']",
			"*=": "[contains(@#{1}, '#{3}')]",
			"~=": "[contains(concat(' ', @#{1}, ' '), ' #{3} ')]",
			"|=": "[contains(concat('-', @#{1}, '-'), '-#{3}-')]"
		},
		
		pseudos: {
			"first-child": "[not(preceding-sibling::*)]",
			"last-child": "[not(following-sibling::*)]",
			"only-child": "[not(preceding-sibling::* or following-sibling::*)]",
			empty: "[count(*) = 0 and (count(text()) = 0)]",
			checked: "[@checked]",
			disabled: "[(@disabled) and (@type!='hidden')]",
			enabled: "[not(@disabled) and (@type!='hidden')]",
			not: function(f) {
				var j = f[6],
					c = Selector.patterns,
					k = Selector.xpath,
					a, l, h = c.length,
					b;
				var d = [];
				while (j && a != j && (/\S/).test(j)) {
					a = j;
					for (var g = 0; g < h; g++) {
						b = c[g].name;
						if (f = j.match(c[g].re)) {
							l = Object.isFunction(k[b]) ? k[b](f) : new Template(k[b]).evaluate(f);
							d.push("(" + l.substring(1, l.length - 1) + ")");
							j = j.replace(f[0], "");
							break
						}
					}
				}
				return "[not(" + d.join(" and ") + ")]"
			},
			
			"nth-child": function(a) {
				return Selector.xpath.pseudos.nth("(count(./preceding-sibling::*) + 1) ", a)
			},
			
			"nth-last-child": function(a) {
				return Selector.xpath.pseudos.nth("(count(./following-sibling::*) + 1) ", a)
			},
			
			"nth-of-type": function(a) {
				return Selector.xpath.pseudos.nth("position() ", a)
			},
			
			"nth-last-of-type": function(a) {
				return Selector.xpath.pseudos.nth("(last() + 1 - position()) ", a)
			},
			
			"first-of-type": function(a) {
				a[6] = "1";
				return Selector.xpath.pseudos["nth-of-type"](a)
			},
			
			"last-of-type": function(a) {
				a[6] = "1";
				return Selector.xpath.pseudos["nth-last-of-type"](a)
			},
			
			"only-of-type": function(a) {
				var b = Selector.xpath.pseudos;
				return b["first-of-type"](a) + b["last-of-type"](a)
			},
			
			nth: function(g, e) {
				var h, i = e[6],
					d;
				if (i == "even") {
					i = "2n+0"
				}
				if (i == "odd") {
					i = "2n+1"
				}
				if (h = i.match(/^(\d+)$/)) {
					return "[" + g + "= " + h[1] + "]"
				}
				if (h = i.match(/^(-?\d*)?n(([+-])(\d+))?/)) {
					if (h[1] == "-") {
						h[1] = -1
					}
					var f = h[1] ? Number(h[1]) : 1;
					var c = h[2] ? Number(h[2]) : 0;
					d = "[((#{fragment} - #{b}) mod #{a} = 0) and ((#{fragment} - #{b}) div #{a} >= 0)]";
					return new Template(d).evaluate({
						fragment: g,
						a: f,
						b: c
					})
				}
			}
		}
	},
	
	criteria: {
		tagName: 'n = h.tagName(n, r, "#{1}", c);      c = false;',
		className: 'n = h.className(n, r, "#{1}", c);    c = false;',
		id: 'n = h.id(n, r, "#{1}", c);           c = false;',
		attrPresence: 'n = h.attrPresence(n, r, "#{1}", c); c = false;',
		attr: function(a) {
			a[3] = (a[5] || a[6]);
			return new Template('n = h.attr(n, r, "#{1}", "#{3}", "#{2}", c); c = false;').evaluate(a)
		},
		
		pseudo: function(a) {
			if (a[6]) {
				a[6] = a[6].replace(/"/g, '\\"')
			}
			return new Template('n = h.pseudo(n, "#{1}", "#{6}", r, c); c = false;').evaluate(a)
		},
		
		descendant: 'c = "descendant";',
		child: 'c = "child";',
		adjacent: 'c = "adjacent";',
		laterSibling: 'c = "laterSibling";'
	},
	
	patterns: [{
		name: "laterSibling",
		re: /^\s*~\s*/
	},
	{
		name: "child",
		re: /^\s*>\s*/
	},
	{
		name: "adjacent",
		re: /^\s*\+\s*/
	},
	{
		name: "descendant",
		re: /^\s/
	},
	{
		name: "tagName",
		re: /^\s*(\*|[\w\-]+)(\b|$)?/
	},
	{
		name: "id",
		re: /^#([\w\-\*]+)(\b|$)/
	},
	{
		name: "className",
		re: /^\.([\w\-\*]+)(\b|$)/
	},
	{
		name: "pseudo",
		re: /^:((first|last|nth|nth-last|only)(-child|-of-type)|empty|checked|(en|dis)abled|not)(\((.*?)\))?(\b|$|(?=\s|[:+~>]))/
	},
	{
		name: "attrPresence",
		re: /^\[((?:[\w-]+:)?[\w-]+)\]/
	},
	{
		name: "attr",
		re: /\[((?:[\w-]*:)?[\w-]+)\s*(?:([!^$*~|]?=)\s*((['"])([^\4]*?)\4|([^'"][^\]]*?)))?\]/
	}],
	assertions: {
		tagName: function(a, b) {
			return b[1].toUpperCase() == a.tagName.toUpperCase()
		},
		
		className: function(a, b) {
			return Element.hasClassName(a, b[1])
		},
		
		id: function(a, b) {
			return a.id === b[1]
		},
		
		attrPresence: function(a, b) {
			return Element.hasAttribute(a, b[1])
		},
		
		attr: function(b, c) {
			var a = Element.readAttribute(b, c[1]);
			return a && Selector.operators[c[2]](a, c[5] || c[6])
		}
	},
	
	handlers: {
		concat: function(d, c) {
			for (var e = 0, f; f = c[e]; e++) {
				d.push(f)
			}
			return d
		},
		
		mark: function(a) {
			var d = Prototype.emptyFunction;
			for (var b = 0, c; c = a[b]; b++) {
				c._countedByPrototype = d
			}
			return a
		},
		
		unmark: (function() {
			var a = (function() {
				var b = document.createElement("div"),
					e = false,
					d = "_countedByPrototype",
					c = "x";
				b[d] = c;
				e = (b.getAttribute(d) === c);
				b = null;
				return e
			})();
			
			return a ?
			function(b) {
				for (var c = 0, d; d = b[c]; c++) {
					d.removeAttribute("_countedByPrototype")
				}
				return b
			} : function(b) {
				for (var c = 0, d; d = b[c]; c++) {
					d._countedByPrototype = void 0
				}
				return b
			}
		})(),
		index: function(a, d, g) {
			a._countedByPrototype = Prototype.emptyFunction;
			if (d) {
				for (var b = a.childNodes, e = b.length - 1, c = 1; e >= 0; e--) {
					var f = b[e];
					if (f.nodeType == 1 && (!g || f._countedByPrototype)) {
						f.nodeIndex = c++
					}
				}
			} else {
				for (var e = 0, c = 1, b = a.childNodes; f = b[e]; e++) {
					if (f.nodeType == 1 && (!g || f._countedByPrototype)) {
						f.nodeIndex = c++
					}
				}
			}
		},
		
		unique: function(b) {
			if (b.length == 0) {
				return b
			}
			var d = [],
				e;
			for (var c = 0, a = b.length; c < a; c++) {
				if (typeof(e = b[c])._countedByPrototype == "undefined") {
					e._countedByPrototype = Prototype.emptyFunction;
					d.push(Element.extend(e))
				}
			}
			return Selector.handlers.unmark(d)
		},
		
		descendant: function(a) {
			var d = Selector.handlers;
			for (var c = 0, b = [], e; e = a[c]; c++) {
				d.concat(b, e.getElementsByTagName("*"))
			}
			return b
		},
		
		child: function(a) {
			var e = Selector.handlers;
			for (var d = 0, c = [], f; f = a[d]; d++) {
				for (var b = 0, g; g = f.childNodes[b]; b++) {
					if (g.nodeType == 1 && g.tagName != "!") {
						c.push(g)
					}
				}
			}
			return c
		},
		
		adjacent: function(a) {
			for (var c = 0, b = [], e; e = a[c]; c++) {
				var d = this.nextElementSibling(e);
				if (d) {
					b.push(d)
				}
			}
			return b
		},
		
		laterSibling: function(a) {
			var d = Selector.handlers;
			for (var c = 0, b = [], e; e = a[c]; c++) {
				d.concat(b, Element.nextSiblings(e))
			}
			return b
		},
		
		nextElementSibling: function(a) {
			while (a = a.nextSibling) {
				if (a.nodeType == 1) {
					return a
				}
			}
			return null
		},
		
		previousElementSibling: function(a) {
			while (a = a.previousSibling) {
				if (a.nodeType == 1) {
					return a
				}
			}
			return null
		},
		
		tagName: function(a, j, c, b) {
			var k = c.toUpperCase();
			
			var e = [],
				g = Selector.handlers;
			if (a) {
				if (b) {
					if (b == "descendant") {
						for (var f = 0, d; d = a[f]; f++) {
							g.concat(e, d.getElementsByTagName(c))
						}
						return e
					} else {
						a = this[b](a)
					}
					if (c == "*") {
						return a
					}
				}
				for (var f = 0, d; d = a[f]; f++) {
					if (d.tagName.toUpperCase() === k) {
						e.push(d)
					}
				}
				return e
			} else {
				return j.getElementsByTagName(c)
			}
		},
		
		id: function(a, l, b, c) {
			var k = $(b),
				g = Selector.handlers;
			if (l == document) {
				if (!k) {
					return []
				}
				if (!a) {
					return [k]
				}
			} else {
				if (!l.sourceIndex || l.sourceIndex < 1) {
					var a = l.getElementsByTagName("*");
					for (var e = 0, d; d = a[e]; e++) {
						if (d.id === b) {
							return [d]
						}
					}
				}
			}
			if (a) {
				if (c) {
					if (c == "child") {
						for (var f = 0, d; d = a[f]; f++) {
							if (k.parentNode == d) {
								return [k]
							}
						}
					} else {
						if (c == "descendant") {
							for (var f = 0, d; d = a[f]; f++) {
								if (Element.descendantOf(k, d)) {
									return [k]
								}
							}
						} else {
							if (c == "adjacent") {
								for (var f = 0, d; d = a[f]; f++) {
									if (Selector.handlers.previousElementSibling(k) == d) {
										return [k]
									}
								}
							} else {
								a = g[c](a)
							}
						}
					}
				}
				for (var f = 0, d; d = a[f]; f++) {
					if (d == k) {
						return [k]
					}
				}
				return []
			}
			return (k && Element.descendantOf(k, l)) ? [k] : []
		},
		
		className: function(b, a, c, d) {
			if (b && d) {
				b = this[d](b)
			}
			return Selector.handlers.byClassName(b, a, c)
		},
		
		byClassName: function(c, b, f) {
			if (!c) {
				c = Selector.handlers.descendant([b])
			}
			var h = " " + f + " ";
			for (var e = 0, d = [], g, a; g = c[e]; e++) {
				a = g.className;
				if (a.length == 0) {
					continue
				}
				if (a == f || (" " + a + " ").include(h)) {
					d.push(g)
				}
			}
			return d
		},
		
		attrPresence: function(c, b, a, g) {
			if (!c) {
				c = b.getElementsByTagName("*")
			}
			if (c && g) {
				c = this[g](c)
			}
			var e = [];
			for (var d = 0, f; f = c[d]; d++) {
				if (Element.hasAttribute(f, a)) {
					e.push(f)
				}
			}
			return e
		},
		
		attr: function(a, j, h, k, c, b) {
			if (!a) {
				a = j.getElementsByTagName("*")
			}
			if (a && b) {
				a = this[b](a)
			}
			var l = Selector.operators[c],
				f = [];
			for (var e = 0, d; d = a[e]; e++) {
				var g = Element.readAttribute(d, h);
				if (g === null) {
					continue
				}
				if (l(g, k)) {
					f.push(d)
				}
			}
			return f
		},
		
		pseudo: function(b, c, e, a, d) {
			if (b && d) {
				b = this[d](b)
			}
			if (!b) {
				b = a.getElementsByTagName("*")
			}
			return Selector.pseudos[c](b, e, a)
		}
	},
	
	pseudos: {
		"first-child": function(b, f, a) {
			for (var d = 0, c = [], e; e = b[d]; d++) {
				if (Selector.handlers.previousElementSibling(e)) {
					continue
				}
				c.push(e)
			}
			return c
		},
		
		"last-child": function(b, f, a) {
			for (var d = 0, c = [], e; e = b[d]; d++) {
				if (Selector.handlers.nextElementSibling(e)) {
					continue
				}
				c.push(e)
			}
			return c
		},
		
		"only-child": function(b, g, a) {
			var e = Selector.handlers;
			for (var d = 0, c = [], f; f = b[d]; d++) {
				if (!e.previousElementSibling(f) && !e.nextElementSibling(f)) {
					c.push(f)
				}
			}
			return c
		},
		
		"nth-child": function(b, c, a) {
			return Selector.pseudos.nth(b, c, a)
		},
		
		"nth-last-child": function(b, c, a) {
			return Selector.pseudos.nth(b, c, a, true)
		},
		
		"nth-of-type": function(b, c, a) {
			return Selector.pseudos.nth(b, c, a, false, true)
		},
		
		"nth-last-of-type": function(b, c, a) {
			return Selector.pseudos.nth(b, c, a, true, true)
		},
		
		"first-of-type": function(b, c, a) {
			return Selector.pseudos.nth(b, "1", a, false, true)
		},
		
		"last-of-type": function(b, c, a) {
			return Selector.pseudos.nth(b, "1", a, true, true)
		},
		
		"only-of-type": function(b, d, a) {
			var c = Selector.pseudos;
			return c["last-of-type"](c["first-of-type"](b, d, a), d, a)
		},
		
		getIndices: function(d, c, e) {
			if (d == 0) {
				return c > 0 ? [c] : []
			}
			return $R(1, e).inject([], function(a, b) {
				if (0 == (b - c) % d && (b - c) / d >= 0) {
					a.push(b)
				}
				return a
			})
		},
		
		nth: function(c, s, u, r, e) {
			if (c.length == 0) {
				return []
			}
			if (s == "even") {
				s = "2n+0"
			}
			if (s == "odd") {
				s = "2n+1"
			}
			var q = Selector.handlers,
				p = [],
				d = [],
				g;
			q.mark(c);
			for (var o = 0, f; f = c[o]; o++) {
				if (!f.parentNode._countedByPrototype) {
					q.index(f.parentNode, r, e);
					d.push(f.parentNode)
				}
			}
			if (s.match(/^\d+$/)) {
				s = Number(s);
				for (var o = 0, f; f = c[o]; o++) {
					if (f.nodeIndex == s) {
						p.push(f)
					}
				}
			} else {
				if (g = s.match(/^(-?\d*)?n(([+-])(\d+))?/)) {
					if (g[1] == "-") {
						g[1] = -1
					}
					var v = g[1] ? Number(g[1]) : 1;
					var t = g[2] ? Number(g[2]) : 0;
					var w = Selector.pseudos.getIndices(v, t, c.length);
					for (var o = 0, f, k = w.length; f = c[o]; o++) {
						for (var n = 0; n < k; n++) {
							if (f.nodeIndex == w[n]) {
								p.push(f)
							}
						}
					}
				}
			}
			q.unmark(c);
			q.unmark(d);
			return p
		},
		
		empty: function(b, f, a) {
			for (var d = 0, c = [], e; e = b[d]; d++) {
				if (e.tagName == "!" || e.firstChild) {
					continue
				}
				c.push(e)
			}
			return c
		},
		
		not: function(a, d, k) {
			var g = Selector.handlers,
				l, c;
			var j = new Selector(d).findElements(k);
			g.mark(j);
			for (var f = 0, e = [], b; b = a[f]; f++) {
				if (!b._countedByPrototype) {
					e.push(b)
				}
			}
			g.unmark(j);
			return e
		},
		
		enabled: function(b, f, a) {
			for (var d = 0, c = [], e; e = b[d]; d++) {
				if (!e.disabled && (!e.type || e.type !== "hidden")) {
					c.push(e)
				}
			}
			return c
		},
		
		disabled: function(b, f, a) {
			for (var d = 0, c = [], e; e = b[d]; d++) {
				if (e.disabled) {
					c.push(e)
				}
			}
			return c
		},
		
		checked: function(b, f, a) {
			for (var d = 0, c = [], e; e = b[d]; d++) {
				if (e.checked) {
					c.push(e)
				}
			}
			return c
		}
	},
	
	operators: {
		"=": function(b, a) {
			return b == a
		},
		
		"!=": function(b, a) {
			return b != a
		},
		
		"^=": function(b, a) {
			return b == a || b && b.startsWith(a)
		},
		
		"$=": function(b, a) {
			return b == a || b && b.endsWith(a)
		},
		
		"*=": function(b, a) {
			return b == a || b && b.include(a)
		},
		
		"~=": function(b, a) {
			return (" " + b + " ").include(" " + a + " ")
		},
		
		"|=": function(b, a) {
			return ("-" + (b || "").toUpperCase() + "-").include("-" + (a || "").toUpperCase() + "-")
		}
	},
	
	split: function(b) {
		var a = [];
		b.scan(/(([\w#:.~>+()\s-]+|\*|\[.*?\])+)\s*(,|$)/, function(c) {
			a.push(c[1].strip())
		});
		
		return a
	},
	
	matchElements: function(f, g) {
		var e = $$(g),
			d = Selector.handlers;
		d.mark(e);
		for (var c = 0, b = [], a; a = f[c]; c++) {
			if (a._countedByPrototype) {
				b.push(a)
			}
		}
		d.unmark(e);
		return b
	},
	
	findElement: function(b, c, a) {
		if (Object.isNumber(c)) {
			a = c;
			c = false
		}
		return Selector.matchElements(b, c || "*")[a || 0]
	},
	
	findChildElements: function(e, g) {
		g = Selector.split(g.join(","));
		var d = [],
			f = Selector.handlers;
		for (var c = 0, b = g.length, a; c < b; c++) {
			a = new Selector(g[c].strip());
			f.concat(d, a.findElements(e))
		}
		return (b > 1) ? f.unique(d) : d
	}
});

if (Prototype.Browser.IE) {
	Object.extend(Selector.handlers, {
		concat: function(d, c) {
			for (var e = 0, f; f = c[e]; e++) {
				if (f.tagName !== "!") {
					d.push(f)
				}
			}
			return d
		}
	})
}
function $$() {
	return Selector.findChildElements(document, $A(arguments))
}
var Form = {
	reset: function(a) {
		a = $(a);
		a.reset();
		
		return a
	},
	
	serializeElements: function(g, b) {
		if (typeof b != "object") {
			b = {
				hash: !! b
			}
		} else {
			if (Object.isUndefined(b.hash)) {
				b.hash = true
			}
		}
		var c, f, a = false,
			e = b.submit;
		var d = g.inject({}, function(h, i) {
			if (!i.disabled && i.name) {
				c = i.name;
				f = $(i).getValue();
				
				if (f != null && i.type != "file" && (i.type != "submit" || (!a && e !== false && (!e || c == e) && (a = true)))) {
					if (c in h) {
						if (!Object.isArray(h[c])) {
							h[c] = [h[c]]
						}
						h[c].push(f)
					} else {
						h[c] = f
					}
				}
			}
			return h
		});
		
		return b.hash ? d : Object.toQueryString(d)
	}
};

Form.Methods = {
	serialize: function(b, a) {
		return Form.serializeElements(Form.getElements(b), a)
	},
	
	getElements: function(e) {
		var f = $(e).getElementsByTagName("*"),
			d, a = [],
			c = Form.Element.Serializers;
		for (var b = 0; d = f[b]; b++) {
			a.push(d)
		}
		return a.inject([], function(g, h) {
			if (c[h.tagName.toLowerCase()]) {
				g.push(Element.extend(h))
			}
			return g
		})
	},
	
	getInputs: function(g, c, d) {
		g = $(g);
		var a = g.getElementsByTagName("input");
		if (!c && !d) {
			return $A(a).map(Element.extend)
		}
		for (var e = 0, h = [], f = a.length; e < f; e++) {
			var b = a[e];
			if ((c && b.type != c) || (d && b.name != d)) {
				continue
			}
			h.push(Element.extend(b))
		}
		return h
	},
	
	disable: function(a) {
		a = $(a);
		Form.getElements(a).invoke("disable");
		return a
	},
	
	enable: function(a) {
		a = $(a);
		Form.getElements(a).invoke("enable");
		return a
	},
	
	findFirstElement: function(b) {
		var c = $(b).getElements().findAll(function(d) {
			return "hidden" != d.type && !d.disabled
		});
		
		var a = c.findAll(function(d) {
			return d.hasAttribute("tabIndex") && d.tabIndex >= 0
		}).sortBy(function(d) {
			return d.tabIndex
		}).first();
		
		return a ? a : c.find(function(d) {
			return /^(?:input|select|textarea)$/i.test(d.tagName)
		})
	},
	
	focusFirstElement: function(a) {
		a = $(a);
		a.findFirstElement().activate();
		
		return a
	},
	
	request: function(b, a) {
		b = $(b), a = Object.clone(a || {});
		
		var d = a.parameters,
			c = b.readAttribute("action") || "";
		if (c.blank()) {
			c = window.location.href
		}
		a.parameters = b.serialize(true);
		if (d) {
			if (Object.isString(d)) {
				d = d.toQueryParams()
			}
			Object.extend(a.parameters, d)
		}
		if (b.hasAttribute("method") && !a.method) {
			a.method = b.method
		}
		return new Ajax.Request(c, a)
	}
};

Form.Element = {
	focus: function(a) {
		$(a).focus();
		
		return a
	},
	
	select: function(a) {
		$(a).select();
		
		return a
	}
};

Form.Element.Methods = {
	serialize: function(a) {
		a = $(a);
		if (!a.disabled && a.name) {
			var b = a.getValue();
			
			if (b != undefined) {
				var c = {};
				
				c[a.name] = b;
				return Object.toQueryString(c)
			}
		}
		return ""
	},
	
	getValue: function(a) {
		a = $(a);
		var b = a.tagName.toLowerCase();
		
		return Form.Element.Serializers[b](a)
	},
	
	setValue: function(a, b) {
		a = $(a);
		var c = a.tagName.toLowerCase();
		
		Form.Element.Serializers[c](a, b);
		return a
	},
	
	clear: function(a) {
		$(a).value = "";
		return a
	},
	
	present: function(a) {
		return $(a).value != ""
	},
	
	activate: function(a) {
		a = $(a);
		try {
			a.focus();
			
			if (a.select && (a.tagName.toLowerCase() != "input" || !(/^(?:button|reset|submit)$/i.test(a.type)))) {
				a.select()
			}
		} catch (b) {}
		return a
	},
	
	disable: function(a) {
		a = $(a);
		a.disabled = true;
		return a
	},
	
	enable: function(a) {
		a = $(a);
		a.disabled = false;
		return a
	}
};

var Field = Form.Element;
var $F = Form.Element.Methods.getValue;
Form.Element.Serializers = {
	input: function(a, b) {
		switch (a.type.toLowerCase()) {
			case "checkbox":
			case "radio":
				return Form.Element.Serializers.inputSelector(a, b);
			default:
				return Form.Element.Serializers.textarea(a, b)
		}
	},
	
	inputSelector: function(a, b) {
		if (Object.isUndefined(b)) {
			return a.checked ? a.value : null
		} else {
			a.checked = !! b
		}
	},
	
	textarea: function(a, b) {
		if (Object.isUndefined(b)) {
			return a.value
		} else {
			a.value = b
		}
	},
	
	select: function(c, f) {
		if (Object.isUndefined(f)) {
			return this[c.type == "select-one" ? "selectOne" : "selectMany"](c)
		} else {
			var b, d, g = !Object.isArray(f);
			for (var a = 0, e = c.length; a < e; a++) {
				b = c.options[a];
				d = this.optionValue(b);
				if (g) {
					if (d == f) {
						b.selected = true;
						return
					}
				} else {
					b.selected = f.include(d)
				}
			}
		}
	},
	
	selectOne: function(b) {
		var a = b.selectedIndex;
		return a >= 0 ? this.optionValue(b.options[a]) : null
	},
	
	selectMany: function(d) {
		var a, e = d.length;
		if (!e) {
			return null
		}
		for (var c = 0, a = []; c < e; c++) {
			var b = d.options[c];
			if (b.selected) {
				a.push(this.optionValue(b))
			}
		}
		return a
	},
	
	optionValue: function(a) {
		return Element.extend(a).hasAttribute("value") ? a.value : a.text
	}
};

Abstract.TimedObserver = Class.create(PeriodicalExecuter, {
	initialize: function($super, a, b, c) {
		$super(c, b);
		this.element = $(a);
		this.lastValue = this.getValue()
	},
	
	execute: function() {
		var a = this.getValue();
		
		if (Object.isString(this.lastValue) && Object.isString(a) ? this.lastValue != a : String(this.lastValue) != String(a)) {
			this.callback(this.element, a);
			this.lastValue = a
		}
	}
});

Form.Element.Observer = Class.create(Abstract.TimedObserver, {
	getValue: function() {
		return Form.Element.getValue(this.element)
	}
});

Form.Observer = Class.create(Abstract.TimedObserver, {
	getValue: function() {
		return Form.serialize(this.element)
	}
});

Abstract.EventObserver = Class.create({
	initialize: function(a, b) {
		this.element = $(a);
		this.callback = b;
		this.lastValue = this.getValue();
		
		if (this.element.tagName.toLowerCase() == "form") {
			this.registerFormCallbacks()
		} else {
			this.registerCallback(this.element)
		}
	},
	
	onElementEvent: function() {
		var a = this.getValue();
		
		if (this.lastValue != a) {
			this.callback(this.element, a);
			this.lastValue = a
		}
	},
	
	registerFormCallbacks: function() {
		Form.getElements(this.element).each(this.registerCallback, this)
	},
	
	registerCallback: function(a) {
		if (a.type) {
			switch (a.type.toLowerCase()) {
				case "checkbox":
				case "radio":
					Event.observe(a, "click", this.onElementEvent.bind(this));
					break;
				default:
					Event.observe(a, "change", this.onElementEvent.bind(this));
					break
			}
		}
	}
});

Form.Element.EventObserver = Class.create(Abstract.EventObserver, {
	getValue: function() {
		return Form.Element.getValue(this.element)
	}
});

Form.EventObserver = Class.create(Abstract.EventObserver, {
	getValue: function() {
		return Form.serialize(this.element)
	}
});
(function() {
	var v = {
		KEY_BACKSPACE: 8,
		KEY_TAB: 9,
		KEY_RETURN: 13,
		KEY_ESC: 27,
		KEY_LEFT: 37,
		KEY_UP: 38,
		KEY_RIGHT: 39,
		KEY_DOWN: 40,
		KEY_DELETE: 46,
		KEY_HOME: 36,
		KEY_END: 35,
		KEY_PAGEUP: 33,
		KEY_PAGEDOWN: 34,
		KEY_INSERT: 45,
		cache: {}
	};
	
	var e = document.documentElement;
	var w = "onmouseenter" in e && "onmouseleave" in e;
	var o;
	if (Prototype.Browser.IE) {
		var h = {
			0: 1,
			1: 4,
			2: 2
		};
		
		o = function(y, x) {
			return y.button === h[x]
		}
	} else {
		if (Prototype.Browser.WebKit) {
			o = function(y, x) {
				switch (x) {
					case 0:
						return y.which == 1 && !y.metaKey;
					case 1:
						return y.which == 1 && y.metaKey;
					default:
						return false
				}
			}
		} else {
			o = function(y, x) {
				return y.which ? (y.which === x + 1) : (y.button === x)
			}
		}
	}
	function r(x) {
		return o(x, 0)
	}
	function q(x) {
		return o(x, 1)
	}
	function k(x) {
		return o(x, 2)
	}
	function c(z) {
		z = v.extend(z);
		var y = z.target,
			x = z.type,
			A = z.currentTarget;
		if (A && A.tagName) {
			if (x === "load" || x === "error" || (x === "click" && A.tagName.toLowerCase() === "input" && A.type === "radio")) {
				y = A
			}
		}
		if (y.nodeType == Node.TEXT_NODE) {
			y = y.parentNode
		}
		return Element.extend(y)
	}
	function m(y, A) {
		var x = v.element(y);
		if (!A) {
			return x
		}
		var z = [x].concat(x.ancestors());
		return Selector.findElement(z, A, 0)
	}
	function p(x) {
		return {
			x: b(x),
			y: a(x)
		}
	}
	function b(z) {
		var y = document.documentElement,
			x = document.body || {
				scrollLeft: 0
			};
		
		return z.pageX || (z.clientX + (y.scrollLeft || x.scrollLeft) - (y.clientLeft || 0))
	}
	function a(z) {
		var y = document.documentElement,
			x = document.body || {
				scrollTop: 0
			};
		
		return z.pageY || (z.clientY + (y.scrollTop || x.scrollTop) - (y.clientTop || 0))
	}
	function n(x) {
		v.extend(x);
		x.preventDefault();
		
		x.stopPropagation();
		
		x.stopped = true
	}
	v.Methods = {
		isLeftClick: r,
		isMiddleClick: q,
		isRightClick: k,
		element: c,
		findElement: m,
		pointer: p,
		pointerX: b,
		pointerY: a,
		stop: n
	};
	
	var t = Object.keys(v.Methods).inject({}, function(x, y) {
		x[y] = v.Methods[y].methodize();
		
		return x
	});
	
	if (Prototype.Browser.IE) {
		function g(y) {
			var x;
			switch (y.type) {
				case "mouseover":
					x = y.fromElement;
					break;
				case "mouseout":
					x = y.toElement;
					break;
				default:
					return null
			}
			return Element.extend(x)
		}
		Object.extend(t, {
			stopPropagation: function() {
				this.cancelBubble = true
			},
			
			preventDefault: function() {
				this.returnValue = false
			},
			
			inspect: function() {
				return "[object Event]"
			}
		});
		
		v.extend = function(y, x) {
			if (!y) {
				return false
			}
			if (y._extendedByPrototype) {
				return y
			}
			y._extendedByPrototype = Prototype.emptyFunction;
			var z = v.pointer(y);
			Object.extend(y, {
				target: y.srcElement || x,
				relatedTarget: g(y),
				pageX: z.x,
				pageY: z.y
			});
			
			return Object.extend(y, t)
		}
	} else {
		v.prototype = window.Event.prototype || document.createEvent("HTMLEvents").__proto__;
		Object.extend(v.prototype, t);
		v.extend = Prototype.K
	}
	function l(B, A, C) {
		try {
			var z = Element.retrieve(B, "prototype_event_registry")
		} catch (D) {}
		if (Object.isUndefined(z)) {
			d.push(B);
			z = Element.retrieve(B, "prototype_event_registry", $H())
		}
		var x = z.get(A);
		if (Object.isUndefined(x)) {
			x = [];
			z.set(A, x)
		}
		if (x.pluck("handler").include(C)) {
			return false
		}
		var y;
		if (A.include(":")) {
			y = function(E) {
				if (Object.isUndefined(E.eventName)) {
					return false
				}
				if (E.eventName !== A) {
					return false
				}
				v.extend(E, B);
				C.call(B, E)
			}
		} else {
			if (!w && (A === "mouseenter" || A === "mouseleave")) {
				if (A === "mouseenter" || A === "mouseleave") {
					y = function(F) {
						v.extend(F, B);
						var E = F.relatedTarget;
						while (E && E !== B) {
							try {
								E = E.parentNode
							} catch (G) {
								E = B
							}
						}
						if (E === B) {
							return
						}
						C.call(B, F)
					}
				}
			} else {
				y = function(E) {
					v.extend(E, B);
					C.call(B, E)
				}
			}
		}
		y.handler = C;
		x.push(y);
		return y
	}
	function f() {
		for (var x = 0, y = d.length; x < y; x++) {
			v.stopObserving(d[x]);
			d[x] = null
		}
	}
	var d = [];
	if (Prototype.Browser.IE) {
		window.attachEvent("onunload", f)
	}
	if (Prototype.Browser.WebKit) {
		window.addEventListener("unload", Prototype.emptyFunction, false)
	}
	var j = Prototype.K;
	if (!w) {
		j = function(y) {
			var x = {
				mouseenter: "mouseover",
				mouseleave: "mouseout"
			};
			
			return y in x ? x[y] : y
		}
	}
	function s(A, z, B) {
		A = $(A);
		var y = l(A, z, B);
		if (!y) {
			return A
		}
		if (z.include(":")) {
			if (A.addEventListener) {
				A.addEventListener("dataavailable", y, false)
			} else {
				A.attachEvent("ondataavailable", y);
				A.attachEvent("onfilterchange", y)
			}
		} else {
			var x = j(z);
			if (A.addEventListener) {
				A.addEventListener(x, y, false)
			} else {
				A.attachEvent("on" + x, y)
			}
		}
		return A
	}
	function i(C, A, D) {
		C = $(C);
		try {
			var z = Element.retrieve(C, "prototype_event_registry")
		} catch (E) {}
		if (Object.isUndefined(z)) {
			return C
		}
		if (A && !D) {
			var B = z.get(A);
			if (Object.isUndefined(B)) {
				return C
			}
			B.each(function(F) {
				Element.stopObserving(C, A, F.handler)
			});
			
			return C
		} else {
			if (!A) {
				z.each(function(H) {
					var F = H.key,
						G = H.value;
					G.each(function(I) {
						Element.stopObserving(C, F, I.handler)
					})
				});
				
				return C
			}
		}
		var B = z.get(A);
		if (!B) {
			return
		}
		var y = B.find(function(F) {
			return F.handler === D
		});
		
		if (!y) {
			return C
		}
		var x = j(A);
		if (A.include(":")) {
			if (C.removeEventListener) {
				C.removeEventListener("dataavailable", y, false)
			} else {
				C.detachEvent("ondataavailable", y);
				C.detachEvent("onfilterchange", y)
			}
		} else {
			if (C.removeEventListener) {
				C.removeEventListener(x, y, false)
			} else {
				C.detachEvent("on" + x, y)
			}
		}
		z.set(A, B.without(y));
		return C
	}
	function u(A, z, y, x) {
		A = $(A);
		if (Object.isUndefined(x)) {
			x = true
		}
		if (A == document && document.createEvent && !A.dispatchEvent) {
			A = document.documentElement
		}
		var B;
		if (document.createEvent) {
			B = document.createEvent("HTMLEvents");
			B.initEvent("dataavailable", true, true)
		} else {
			B = document.createEventObject();
			
			B.eventType = x ? "ondataavailable" : "onfilterchange"
		}
		B.eventName = z;
		B.memo = y || {};
		
		if (document.createEvent) {
			A.dispatchEvent(B)
		} else {
			A.fireEvent(B.eventType, B)
		}
		return v.extend(B)
	}
	Object.extend(v, v.Methods);
	Object.extend(v, {
		fire: u,
		observe: s,
		stopObserving: i
	});
	
	Element.addMethods({
		fire: u,
		observe: s,
		stopObserving: i
	});
	
	Object.extend(document, {
		fire: u.methodize(),
		observe: s.methodize(),
		stopObserving: i.methodize(),
		loaded: false
	});
	
	if (window.Event) {
		Object.extend(window.Event, v)
	} else {
		window.Event = v
	}
})();
(function() {
	var d;

	function a() {
		if (document.loaded) {
			return
		}
		if (d) {
			window.clearTimeout(d)
		}
		document.loaded = true;
		document.fire("dom:loaded")
	}
	function c() {
		if (document.readyState === "complete") {
			document.stopObserving("readystatechange", c);
			a()
		}
	}
	function b() {
		try {
			document.documentElement.doScroll("left")
		} catch (f) {
			d = b.defer();
			
			return
		}
		a()
	}
	if (document.addEventListener) {
		document.addEventListener("DOMContentLoaded", a, false)
	} else {
		document.observe("readystatechange", c);
		if (window == top) {
			d = b.defer()
		}
	}
	Event.observe(window, "load", a)
})();

Element.addMethods();

Hash.toQueryString = Object.toQueryString;
var Toggle = {
	display: Element.toggle
};

Element.Methods.childOf = Element.Methods.descendantOf;
var Insertion = {
	Before: function(a, b) {
		return Element.insert(a, {
			before: b
		})
	},
	
	Top: function(a, b) {
		return Element.insert(a, {
			top: b
		})
	},
	
	Bottom: function(a, b) {
		return Element.insert(a, {
			bottom: b
		})
	},
	
	After: function(a, b) {
		return Element.insert(a, {
			after: b
		})
	}
};

var $continue = new Error('"throw $continue" is deprecated, use "return" instead');
var Position = {
	includeScrollOffsets: false,
	prepare: function() {
		this.deltaX = window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0;
		this.deltaY = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0
	},
	
	within: function(b, a, c) {
		if (this.includeScrollOffsets) {
			return this.withinIncludingScrolloffsets(b, a, c)
		}
		this.xcomp = a;
		this.ycomp = c;
		this.offset = Element.cumulativeOffset(b);
		return (c >= this.offset[1] && c < this.offset[1] + b.offsetHeight && a >= this.offset[0] && a < this.offset[0] + b.offsetWidth)
	},
	
	withinIncludingScrolloffsets: function(b, a, d) {
		var c = Element.cumulativeScrollOffset(b);
		this.xcomp = a + c[0] - this.deltaX;
		this.ycomp = d + c[1] - this.deltaY;
		this.offset = Element.cumulativeOffset(b);
		return (this.ycomp >= this.offset[1] && this.ycomp < this.offset[1] + b.offsetHeight && this.xcomp >= this.offset[0] && this.xcomp < this.offset[0] + b.offsetWidth)
	},
	
	overlap: function(b, a) {
		if (!b) {
			return 0
		}
		if (b == "vertical") {
			return ((this.offset[1] + a.offsetHeight) - this.ycomp) / a.offsetHeight
		}
		if (b == "horizontal") {
			return ((this.offset[0] + a.offsetWidth) - this.xcomp) / a.offsetWidth
		}
	},
	
	cumulativeOffset: Element.Methods.cumulativeOffset,
	positionedOffset: Element.Methods.positionedOffset,
	absolutize: function(a) {
		Position.prepare();
		
		return Element.absolutize(a)
	},
	
	relativize: function(a) {
		Position.prepare();
		
		return Element.relativize(a)
	},
	
	realOffset: Element.Methods.cumulativeScrollOffset,
	offsetParent: Element.Methods.getOffsetParent,
	page: Element.Methods.viewportOffset,
	clone: function(b, c, a) {
		a = a || {};
		
		return Element.clonePosition(c, b, a)
	}
};

document.getElementsByClassName = function(g, j) {
	var d = ($(j) || document.body).getElementsByTagName("*");
	var a = [],
		b, f = new RegExp("(^|\\s)" + g + "(\\s|$)");
	for (var e = 0, c = d.length; e < c; e++) {
		b = d[e];
		var h = b.className;
		if (h.length == 0) {
			continue
		}
		if (h == g || h.match(f)) {
			a.push(Element.extend(b))
		}
	}
	return a
};

Element.ClassNames = Class.create();

Element.ClassNames.prototype = {
	initialize: function(a) {
		this.element = $(a)
	},
	
	_each: function(a) {
		this.element.className.split(/\s+/).select(function(b) {
			return b.length > 0
		})._each(a)
	},
	
	set: function(a) {
		this.element.className = a
	},
	
	add: function(a) {
		if (this.include(a)) {
			return
		}
		this.set($A(this).concat(a).join(" "))
	},
	
	remove: function(a) {
		if (!this.include(a)) {
			return
		}
		this.set($A(this).without(a).join(" "))
	},
	
	toString: function() {
		return $A(this).join(" ")
	}
};

Object.extend(Element.ClassNames.prototype, Enumerable);
var TOUCHABLE = false;
(function() {
	var b = (("ontouchend" in window) || ("undefined" !== typeof window.DocumentTouch && document instanceof DocumentTouch));
	var a = navigator.userAgent;
	if (true == b && a.match(/Chrome/) && null == a.match(/Android/)) {
		b = false
	}
	window.TOUCHABLE = b
})();

var MODULE_WEB = "web";
var MODULE_ESHOP = "eshop";
var MODULE_BRANCH = "branch";
var LOADING_IMAGE = "webcreathtml/img/2010/layout/loadingWhiteBgr.gif";
var ScriptInfo = {
	scrollBarWidth: 0,
	debugEl: null,
	init: function() {
		var a = /\.js(\?.*)?$/;
		$$("body script[src]").findAll(function(b) {
			return b.src.match(a)
		}).each(function(c) {
			var b = c.src.match(/\?(.*)/);
			if (b) {
				var d = b[1].split("&").each(function(f) {
					var e = f.match(/(.*)=(.*)/);
					ScriptInfo[e[1]] = e[2]
				})
			}
		});
		
		this.getScrollBarWidth()
	},
	
	getScrollBarWidth: function() {
		var f = new Element("div", {
			style: "width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"
		});
		
		document.body.appendChild(f);
		var c = new Element("div", {
			style: "height:100px"
		});
		
		f.appendChild(c);
		var b = f.offsetWidth;
		var e = c.offsetWidth;
		f.style.overflowY = "scroll";
		var a = c.offsetWidth;
		document.body.removeChild(f);
		this.scrollBarWidth = (b - a)
	},
	
	isShowScrollbar: function() {
		return (window.innerWidth > document.body.getWidth())
	},
	
	isMsie6: function() {
		return (Prototype.Browser.IE && /MSIE 6\.0/.test(navigator.userAgent))
	},
	
	debugMsg: function(a) {
		if (null == this.debugEl) {
			this.debugEl = new Element("div", {
				id: "debugEl",
				style: "width:250px;height:500px;overflow:auto;position:absolute;top:5px;right:5px;background:#525252;color:#fff;padding:5px;text-align:left;"
			});
			
			document.body.appendChild(this.debugEl)
		}
		this.debugEl.innerHTML = a + "<br />" + this.debugEl.innerHTML
	}
};

ScriptInfo.init();

if ("1" != ScriptInfo.error) {
	window.onerror = function(c, b, a) {
		return true
	}
}
if ("function" == typeof(Cufon) && ("cn" != ScriptInfo.lang && "zh-cn" != ScriptInfo.lang && "tw" != ScriptInfo.lang && "zh-tw" != ScriptInfo.lang && "ja" != ScriptInfo.lang && "vi" != ScriptInfo.lang && "ko" != ScriptInfo.lang) && !ScriptInfo.isMsie6()) {
	Cufon.initialized = false;
	//".buttonCase", ".buttonCaseWhite",".moduleBlock label",
//	Cufon.replace(["h2", "#headerContent h4",  "#loginLinkBtn"], {
//		hover: true
//	});
	
	Cufon.initialized = true
}
var FormClass = Class.create();

FormClass.prototype = {
	texts: new Array(),
	hints: new Array(),
	showedHint: null,
	projectsData: new Object(),
	elementsWithValue: new Array(),
	maxChars: new Array(),
	isShowedAlert: false,
	buttonOutTimer: null,
	disableHideHint: false,
	hintTimer: null,
	initialize: function() {
		Event.observe(window, "load", this.onloadInit.bindAsEventListener(this))
	},
	
	onloadInit: function() {
		Forms.checkAutocomplete();
		
		Forms.setHints();
		
		Forms._setButtonsEvents();
		
		if ("undefined" != typeof(RubicusStaticServers)) {
			var a = new Image();
			
			a.src = RubicusStaticServers.getServer() + LOADING_IMAGE
		}
	},
	
	checkAutocomplete: function() {
		var b = this.elementsWithValue.length;
		for (var a = 0; a < b; a++) {
			if ("" != this.elementsWithValue[a].value) {
				$(this.elementsWithValue[a].id + "Value").hide()
			}
		}
	},
	
	setHints: function() {
		var f = $$(".inputHint");
		var e = f.length;
		for (var d = 0; d < e; d++) {
			var h = f[d].id;
			var b = h.replace(/Hint/, "");
			var a = $(b);
			if (!a) {
				continue
			}
			if (a.offsetWidth == 0 && $(b + "Text")) {
				b = b + "Text";
				a = $(b)
			}
			this.hints[b] = f[d];
			Event.observe(a, "focus", function(j) {
				Forms.showHint(this.id);
				Event.stop(j)
			});
			
			Event.observe(a, "click", function(j) {
				Forms.showHint(this.id);
				if (false == this.hasClassName("selectText")) {
					SelectBox.hideAll(j);
					Forms.disableHideHint = true
				}
			});
			
			if (true == a.hasClassName("withOverHint")) {
				Event.observe(a, "mouseover", function(k) {
					var j = this.id;
					clearTimeout(Forms.hintTimer);
					Forms.hintTimer = setTimeout(Forms.showHint.bind(Forms, j), 200);
					if (false == this.hasClassName("selectText")) {
						SelectBox.hideAll(k);
						Forms.disableHideHint = true
					}
				});
				
				Event.observe(a, "mouseout", function(j) {
					clearTimeout(Forms.hintTimer);
					Forms.hintTimer = setTimeout(Forms.hideHint.bind(Forms), 1000)
				})
			}
		}
		Event.observe(document, "click", function(j) {
			if (false == Forms.disableHideHint) {
				Forms.hideHint()
			} else {
				Forms.disableHideHint = false
			}
		});
		
		Event.observe(document, "keydown", function(j) {
			if (9 == j.keyCode) {
				Forms.hideHint()
			}
			if ("undefined" != typeof(Wizard) && true == Wizard.isWizard && Event.KEY_RETURN == j.keyCode) {
				Wizard.process()
			}
		});
		
		var g = $$("div.inputAlert");
		var c = g.length;
		for (var d = 0; d < c; d++) {
			this.isShowedAlert = true;
			this.hints[g[d].id] = g[d]
		}
	},
	
	showHint: function(k) {
		clearTimeout(Forms.hintTimer);
		if (true == this.isShowedAlert) {
			return
		}
		if (this.hints[k]) {
			var c = $$("div.inputAlert");
			if (this.showedHint == this.hints[k] || 0 < c.length) {
				return
			}
			this.hideHint(true);
			this.hints[k].style.display = "block";
			this.hints[k].parentNode.style.position = "relative";
			this.hints[k].parentNode.style.zIndex = "50";
			if ("input" != $(k).nodeName.toLowerCase()) {
				this.hints[k].style.left = ($(k).offsetWidth + 10) + "px";
				if (null != $("leftContent")) {
					var b = Element.cumulativeOffset($("leftContent"));
					var l = Element.cumulativeOffset(this.hints[k]);
					if ((this.hints[k].offsetWidth + l.left - (Prototype.Browser.WebKit ? 33 : 0)) > ($("leftContent").offsetWidth + b.left)) {
						var j = -(this.hints[k].offsetWidth + 10) + 5;
						this.hints[k].style.left = j + "px";
						this.hints[k].addClassName("rightArrow");
						l = Element.cumulativeOffset(this.hints[k]);
						if (l.left < b.left) {
							this.hints[k].style.left = j - (l.left - b.left) + "px"
						}
					} else {
						if (null != $("packageTwoColumn") && "undefined" != typeof($$("td.updatablePckg")[0])) {
							var e = $(k).parentNode;
							var f = false;
							var d = 0;
							do {
								if (e == $("packageTwoColumn")) {
									break
								} else {
									if (true == Element.hasClassName(e, "renewPckg") || true == Element.hasClassName(e, "currentPckg")) {
										f = true;
										d = e.offsetWidth;
										break
									}
								}
							} while 
							(e = e.parentNode);
							if (true == f) {
								var h = 415;
								var a = Element.cumulativeOffset(e);
								var g = l.left - a.left + this.hints[k].offsetWidth;
								if ((h - 7) < g) {
									var j = ($(k).offsetWidth - (g - h));
									this.hints[k].style.left = j + "px"
								}
							}
						}
					}
				}
			}
			this.showedHint = this.hints[k]
		}
	},
	
	hideHint: function(c) {
		if (true == this.isShowedAlert && true != c) {
			return
		}
		if (this.showedHint) {
			this.showedHint.style.display = "none";
			this.showedHint.removeClassName("rightArrow");
			if (true == this.isShowedAlert) {
				Element.removeClassName(this.showedHint.parentNode, "error");
				this.isShowedAlert = false
			}
			this.showedHint.parentNode.style.position = "relative";
			this.showedHint.parentNode.style.zIndex = "1";
			this.showedHint = null
		}
		var d = $$("div.inputAlert");
		var a = d.length;
		for (var b = 0; b < a; b++) {
			Element.remove($(d[b].id))
		}
	},
	
	createAlertHint: function(b, e, d) {
		if (!b || !e || !d) {
			return
		}
		Element.addClassName(b, "error");
		if (true == this.isShowedAlert) {
			return
		}
		this.hideHint();
		
		var c = new Element("span", {
			"class": "inputAlert",
			id: e
		}).update(d);
		if (Prototype.Browser.IE) {
			c.className = "inputAlert";
			c.id = e
		}
		var a = new Element("i", {
			"class": "hintEnd"
		});
		
		c.appendChild(a);
		b.appendChild(c);
		this.hints[e] = c;
		this.showedHint = c;
		this.isShowedAlert = true
	},
	
	setMaxChars: function(b, a) {
		if (b && 0 < a) {
			this.maxChars[b] = a;
			Event.observe(b, "keyup", function(c) {
				Forms._checkMaxChar($(this))
			})
		}
	},
	
	_checkMaxChar: function(a) {
		if (this.maxChars[a] < a.value.length) {
			a.value = a.value.substr(0, this.maxChars[a])
		}
	},
	
	setFocus: function() {
		var a = $$(".inputCase");
		var c = a.length;
		for (var b = 0; b < c; b++) {
			Event.observe(a[b], "click", function(f) {
				var e = this;
				if (false == Element.hasClassName(e, "inputCase")) {
					e = e.parentNode
				}
				var g = Element.childElements(e);
				var d = g.length;
				for (var h = 0; h < d; h++) {
					if ("input" == g[h].nodeName.toLowerCase() && g[h].type != "hidden") {
						Form.Element.focus(g[h]);
						return
					}
				}
			})
		}
	},
	
	_setButtonsEvents: function() {
		var a = $(".textButton"); //".buttonCase", ".buttonCaseWhite", 
		var d = a.length;
		for (var b = 0; b < d; b++) {
			Event.observe(a[b], "mouseover", function(f) {
				var e = Forms._getButtonCase(this);
				if (e && false == Element.hasClassName(e, "disabled")) {
					Element.addClassName(e, "buttonHover");
					clearTimeout(Forms.buttonOutTimer);
					if ("function" == typeof(Cufon) && true == Cufon.initialized) {
						//Cufon.replace(".buttonCase");
						//Cufon.replace(".buttonCaseWhite")
					}
				}
			});
			
			Event.observe(a[b], "mouseout", function(f) {
				var e = Forms._getButtonCase(this);
				if (e) {
					Forms.buttonOutTimer = setTimeout(Forms._buttonOut.bind(Forms, e), 50)
				}
			});
			
			Event.observe(a[b], "click", function(h) {
				var g = Event.element(h);
				if ("a" == g.nodeName.toLowerCase() || "button" == g.nodeName.toLowerCase()) {
					return true
				}
				var e = Forms._getButtonCase(g);
				if (e) {
					var f = Element.childElements(e);
					if (f[0]) {
						if ("button" == f[0].nodeName.toLowerCase()) {
							f[0].click();
							
							Event.stop(h)
						}
					}
				}
			});
			
			if ("span" == a[b].nodeName.toLowerCase()) {
				if (false == TOUCHABLE) {
					var c = new Element("u", {
						style: "position:absolute;top:0;left:0;width:" + a[b].offsetWidth + "px;height:" + a[b].offsetHeight + "px;z-index:10;background:#fff;filter: alpha(opacity=0);opacity: 0;"
					});
					
					a[b].insertBefore(c, a[b].firstChild);
					Event.observe(c, "click", function(f) {
						var e = this.nextSibling;
						do {
							if ("button" == e.nodeName.toLowerCase()) {
								Event.stop(f);
								e.click();
								
								break;
								return
							}
						} while 
						(e = e.nextSibling)
					})
				}
			}
			if (Prototype.Browser.IE && "a" == a[b].nodeName.toLowerCase()) {
				var c = new Element("u", {
					style: "position:absolute;top:0;left:0;width:" + a[b].offsetWidth + "px;height:" + a[b].offsetHeight + "px;z-index:10;background:transparent;"
				});
				
				a[b].insertBefore(c, a[b].firstChild)
			}
		}
	},
	
	_buttonOut: function(a) {
		if (a) {
			Element.removeClassName(a, "buttonHover")
		}
		if ("function" == typeof(Cufon) && true == Cufon.initialized) {
			Cufon.replace(".buttonCase");
			Cufon.replace(".buttonCaseWhite")
		}
	},
	
	_getButtonCase: function(a) {
		if ("buttonCase" != a.className || "buttonCaseWhite" != a.className || "textButton" != a.className) {
			while (a) {
				if (Element.hasClassName(a, "buttonCase") || Element.hasClassName(a, "buttonCaseWhite") || Element.hasClassName(a, "textButton")) {
					break
				}
				if ("#document" == a.nodeName) {
					a = null;
					break
				}
				a = a.parentNode
			}
		}
		return a
	},
	
	copyToOtherItem: function(c, b) {
		if (!c || "" == c.value || !b) {
			return
		}
		var a = c.value;
		b.each(function(d) {
			var e = $(d);
			if (e && "" == e.value) {
				e.value = a
			}
		})
	},
	
	toggleBlock: function(a, b) {
		a.each(function(d) {
			if ($(d) && true == b) {
				$(d).show();
				
				if (true == ScriptInfo.isMsie6()) {
					var c = $$("div.blueBoxShadowEnd")[0];
					c.style.bottom = "auto";
					c.style.bottom = "0"
				}
			} else {
				if ($(d) && !b) {
					$(d).hide();
					
					if (true == ScriptInfo.isMsie6()) {
						var c = $$("div.blueBoxShadowEnd")[0];
						c.style.bottom = "auto";
						c.style.bottom = "0"
					}
				}
			}
		})
	},
	
	toggleBlocks: function(a, c) {
		var b = 0;
		a.each(function(d) {
			var e = (Object.isArray(c)) ? c[b] : c;
			Forms.toggleBlock(new Array(d), e);
			b++
		})
	},
	
	validateFormInputs: function(n, c, a) {
		var o = $(n);
		if (!o) {
			return false
		}
		if ("undefined" == typeof(c)) {
			c = true
		}
		if ("undefined" == typeof(a)) {
			a = n
		}
		var d = $A(o.getElementsByTagName("input"));
		var e = $A(o.getElementsByTagName("textarea"));
		if (e[0]) {
			if (d[0]) {
				d = d.concat(e)
			} else {
				d = e
			}
		}
		var f = new Array();
		
		var q = true;
		var p;
		var g;
		var m;
		var j;
		var h;
		for (h = 0; h < d.length; h++) {
			p = d[h];
			g = p.getAttribute("_type");
			m = ("helper" == p.getAttribute("_helper"));
			j = ("false" == p.getAttribute("_validation"));
			if (!m && (p.offsetHeight != 0 || ("hidden" == p.type && p.parentNode.offsetHeight > 0))) {
				if (j) {
					if ("phone" == g) {
						q = this.validateFormPhoneInput(p, true) && q
					} else {
						q = this.validateFormTextInput(p) && q
					}
				} else {
					if ("radio" == p.type) {
						if (!f[p.name]) {
							f[p.name] = new Array()
						}
						f[p.name].push(p)
					} else {
						if ((!g && "text" == p.type) || "text" == g) {
							q = this.validateFormTextInput(p) && q
						} else {
							if ("phone" == g) {
								q = this.validateFormPhoneInput(p, false) && q
							} else {
								if ("vatin" == g) {
									q = this.validateFormTextInput(p) && q
								} else {
									if ("email" == g) {
										q = this.regexpValidateFormInput(p, RS_CFG.formatRegexp["email"], RS_CFG.labels["forms"]["errors"]["invalidEmail"]) && q
									} else {
										if ("date" == g) {
											q = this.regexpValidateFormInput(p, RS_CFG.formatRegexp["dateTime"], RS_CFG.labels["forms"]["errors"]["invalidDate"]) && q
										} else {
											if ("siren_siret" == g) {
												this.stripNumber(p);
												q = this.regexpValidateFormInput(p, RS_CFG.formatRegexp["siren_siret"], RS_CFG.labels["domainManager"]["newDomainForm"]["siren_siret"]) && q
											} else {
												if ("it_vat_number" == g) {
													this.stripNumber(p);
													q = this.regexpValidateFormInput(p, RS_CFG.formatRegexp["it_vat_number"], RS_CFG.labels["domainManager"]["newDomainForm"]["it_vat_number"]) && q
												} else {
													if ("it_codice_fiscale" == g) {
														this.stripNumber(p);
														q = this.regexpValidateFormInput(p, RS_CFG.formatRegexp["it_codice_fiscale"], RS_CFG.labels["domainManager"]["newDomainForm"]["it_codice_fiscale"]) && q
													} else {
														if ("text" == p.type) {
															q = this.validateFormTextInput(p) && q
														} else {
															if ("password" == p.type) {
																q = this.validateFormTextInput(p) && q
															} else {
																if ("textarea" == p.tagName.toLowerCase()) {
																	q = this.validateFormTextInput(p) && q
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		if (!q && $(a + "ErrorText")) {
			var l = $(a + "ErrorText");
			l.style.display = "";
			if (c) {
				window.scrollTo(0, 0)
			} else {
				Position.prepare();
				
				var b = Position.deltaY;
				var k = Position.cumulativeOffset(l);
				if (k[1] < b) {
					l.scrollTo()
				}
			}
		}
		return q
	},
	
	stripNumber: function(a) {
		if (!a || "input" != a.tagName.toLowerCase()) {
			return
		}
		a.value = a.value.replace(/[ \.]/g, "")
	},
	
	validateFormPhoneInput: function(c, e) {
		var a = $(c.id + "Prefix");
		var d = $(c.id + "Number");
		if (a && "" == a.value && "" != c.value) {
			this.setFormInputError(c, RS_CFG.labels["forms"]["errors"]["missingPhonePrefix"]);
			return false
		}
		if (e) {
			var b = c.getAttribute("_required");
			if (!b || "required" != b) {
				return true
			} else {
				if ("" == d.value) {
					this.setFormInputError(c, RS_CFG.labels["forms"]["errors"]["required"]);
					return false
				} else {
					this.clearFormInputError(c);
					return true
				}
			}
		} else {
			return this.regexpValidateFormInput(c, RS_CFG.formatRegexp["phone"], RS_CFG.labels["forms"]["errors"]["invalidPhone"])
		}
	},
	
	validateFormVatNumberInput: function(a) {
		a.value = a.value.strip().toUpperCase().replace(/( |\/|\\|\.|\-|\n)/g, "");
		return this.regexpValidateFormInput(a, RS_CFG.formatRegexp["vatin"], RS_CFG.labels["forms"]["errors"]["invalidVatNumber"])
	},
	
	regexpValidateFormInput: function(c, b, a) {
		if (!c || "input" != c.tagName.toLowerCase()) {
			return false
		}
		if ("" == c.value) {
			return this.validateFormTextInput(c)
		} else {
			if (c.value.match(b)) {
				this.clearFormInputError(c);
				return true
			} else {
				this.setFormInputError(c, a);
				return false
			}
		}
	},
	
	validateFormTextInput: function(c) {
		if (!c || ("input" != c.tagName.toLowerCase() && "textarea" != c.tagName.toLowerCase())) {
			return false
		}
		var b = c.getAttribute("_required");
		var a = c.getAttribute("_conditional");
		if ((!b || "required" != b) && !a) {
			return true
		} else {
			if ("" == c.value) {
				this.setFormInputError(c, RS_CFG.labels["forms"]["errors"]["required"]);
				return false
			} else {
				this.clearFormInputError(c);
				return true
			}
		}
	},
	
	validateCheckboxInput: function(a) {
		if (a.checked) {
			this.clearFormInputError(a);
			return true
		} else {
			this.setFormInputError(a);
			return false
		}
	},
	
	clearFormInputError: function(a) {
		if ($(a.id + "Row")) {
			$(a.id + "Row").removeClassName("error")
		}
	},
	
	setFormInputError: function(b, a) {
		if ($(b.id + "Row")) {
			$(b.id + "Row").addClassName("error")
		}
	},
	
	updatePhoneInput: function(c, b, a) {
		if ("" == $(b).value && "" == $(a).value) {
			$(c).value = ""
		} else {
			$(c).value = $(b).value + ($(b).value.indexOf(".") > 0 ? "" : ".") + $(a).value
		}
	},
	
	enableButton: function(a) {
		if ($(a)) {
			$(a).disabled = false;
			if ($(a + "Block")) {
				$(a + "Block").removeClassName("disabled")
			}
			if ("function" == typeof(Cufon) && true == Cufon.initialized) {
				Cufon.replace(".buttonCase")
			}
		}
	},
	
	disableButton: function(a) {
		if ($(a)) {
			$(a).disabled = true;
			if ($(a + "Block")) {
				$(a + "Block").addClassName("disabled")
			}
			if ("function" == typeof(Cufon) && true == Cufon.initialized) {
				Cufon.replace(".buttonCase")
			}
		}
	},
	
	hideButton: function(a) {
		if ($(a) && $(a + "Block")) {
			$(a + "Block").style.display = "none"
		}
	},
	
	showButton: function(a) {
		if ($(a) && $(a + "Block")) {
			$(a + "Block").style.display = ""
		}
	},
	
	setChangePassword: function(b) {
		var a = ["newPasswordRow", "newPasswordConfirmRow"];
		if (!projectOwner && !selfUserEdit) {
			a.push("passwordRow")
		}
		this.toggleBlock(a, true);
		$(b.id + "Row").hide();
		
		if ($("rbcChangePasswordFlag")) {
			$("rbcChangePasswordFlag").value = 1
		}
		changePasswordButtonClicked = true
	},
	
	setValue: function(a, b) {
		if (null != $(a)) {
			$(a).value = b
		}
	},
	
	getValue: function(a) {
		if (null != $(a)) {
			return $(a).value
		}
		return false
	},
	
	fileInputInitObserver: function(b, h) {
		var a = $(b + "_fake");
		var g = $(b);
		var d = $(h);
		d.update("<b>" + RS_CFG.labels["browse"] + "</b>");
		var c = $(h + "Block");
		Event.observe(g, "mouseover", function() {
			c.addClassName("hover");
			if ("function" == typeof(Cufon) && true == Cufon.initialized) {
				Cufon.replace(".buttonCase");
				Cufon.replace(".buttonCaseWhite")
			}
		});
		
		Event.observe(g, "mouseout", function() {
			c.removeClassName("hover");
			if ("function" == typeof(Cufon) && true == Cufon.initialized) {
				Cufon.replace(".buttonCase");
				Cufon.replace(".buttonCaseWhite")
			}
		});
		
		var e = function() {
			a.value = g.value
		};
		
		Event.observe(a, "focus", function() {
			a.blur()
		});
		
		Event.observe(g, "change", e);
		Event.observe(g, "mouseout", e)
	},
	
	toggleCheckboxes: function(c, b) {
		if ($(c)) {
			var e = $(c).getElementsByTagName("input");
			var d;
			var a;
			for (d = 0; d < e.length; d++) {
				if ("checkbox" == e[d].type && !e[d].disabled) {
					a = e[d].checked;
					e[d].checked = b;
					if (a != b && "function" == typeof(e[d].onclick)) {
						e[d].onclick()
					}
				}
			}
		}
	},
	
	showWaitingAnimation: function(d) {
		alert("waitingBlockwaitingBlockwaitingBlockwaitingBlockwaitingBlock");return 0;
		
		var c = $("leftContent");
		if (null == c) {
			c = $("content")
		}
		if (null == c) {
			return
		}
		var b = c.childElements();
		
		for (i = 0; i < b.length; i++) {
			b[i].hide()
		}
		if (!$("waitingAnimation")) {
			var a = new Element("div", {
				id: "waitingAnimation",
				"class": "waitingBlock"
			});
			
			if (!d) {
				d = RS_CFG.labels["pleaseWait"]
			}
			var e = new Element("div", {
				id: "waitingText"
			});
			
			e.update(d);
			a.appendChild(e);
			c.appendChild(a);
			Flash.writeLoadingFlash("waitingAnimation")
		} else {
			$("waitingAnimation").style.display = ""
		}
		if (null != $("page")) {
			$("page").scrollTo()
		}
		return true
	},
	
	hideWaitingAnimation: function() {
		var b = $("waitingAnimation");
		if (b) {
			var c = $("leftContent");
			if (null == c) {
				c = $("content")
			}
			if (null == c) {
				return
			}
			var a = c.childElements();
			
			for (i = 0; i < a.length; i++) {
				a[i].show()
			}
			b.parentNode.removeChild(b);
			$("page").scrollTo();
			
			return true
		}
		return false
	},
	
	toggleInputWritable: function(d, c) {
		var a = c.length;
		if (null == d || 0 > a) {
			return
		}
		var e = (false == d.value);
		for (var b = 0; b < a; b++) {
			var f = $(c[b]);
			if (null != f) {
				f.disabled = e
			}
		}
	}
};

var Forms = new FormClass();

var SelectBoxClass = Class.create();

SelectBoxClass.prototype = {
	data: new Object(),
	baseId: null,
	baseEl: null,
	textEl: null,
	defaultValue: null,
	coverEl: null,
	selectEl: null,
	rowEl: null,
	defaultHeight: 125,
	defaultWidth: 85,
	withSuggest: false,
	isOpen: new Array(),
	descendants: new Array(),
	selectedItem: null,
	itemIdPrefix: "SBI",
	itemIdWindowPrefix: "SBIW",
	selectWindow: null,
	selectWindowTitle: "",
	selectWindowLink: "",
	windowItemsEl: null,
	windowItemsColumn: new Array(),
	showWindowEl: null,
	keywords: new Object(),
	otherItemId: "__OTHER__",
	otherItemText: null,
	userOnSelectCode: null,
	disabled: new Array(),
	totalItems: 0,
	minItems: 5,
	initialize: function() {
		if (null == this.baseId) {
			Event.observe(document.body, "click", this.hideAll.bindAsEventListener(this))
		}
		return false
	},
	
	setBaseId: function(a) {
		this.baseId = a
	},
	
	run: function() {
		if (0 == Object.keys(this.data).length) {
			return false
		}
		if (null == this.baseEl) {
			this.baseEl = $(this.baseId);
			if (null == this.baseEl) {
				return false
			}
			this.coverEl = this.baseEl.parentNode;
			var a = this.baseEl;
			do {
				if ("#document" == a.nodeName) {
					break
				}
				if (-1 < a.id.indexOf("Row")) {
					this.rowEl = a;
					break
				}
			} while 
			(a = a.parentNode)
		}
		if (null == this.textEl) {
			this.textEl = $(this.baseId + "Text")
		}
		if ($(this.baseId)) {
			this.defaultValue = this.baseEl.value;
			this.selectedItem = this.baseEl.value;
			this._setBoxText(this.defaultValue)
		}
		if (false == this.withSuggest) {
			Element.addClassName(this.baseEl, "hand");
			Element.addClassName(this.coverEl, "hand");
			Element.addClassName(this.textEl, "hand")
		} else {
			this.showWindowEl = $(this.baseId + "ShowAll");
			this.textEl.removeAttribute("readonly");
			if ("object" == typeof(this.showWindowEl)) {
				this.correctWindowLink();
				
				Event.observe(this.showWindowEl, "click", this.openWindow.bindAsEventListener(this))
			}
		}
		SelectBox.descendants[this.baseId] = this;
		this.update();
		
		this._createSelect();
		
		this.afterCreate();
		
		this._setEvents();
		
		return false
	},
	
	update: function() {},
	
	afterCreate: function() {},
	
	onSelect: function() {},
	
	setUserOnSelect: function(a) {
		this.userOnSelectCode = a
	},
	
	userOnSelect: function() {
		if (null != this.userOnSelectCode) {
			eval(this.userOnSelectCode)
		}
	},
	
	getValue: function() {
		return this.baseEl.value
	},
	
	correctWindowLink: function() {
		if (null != this.showWindowEl) {
			this.showWindowEl.style.visibility = "visible";
			this.showWindowEl.style.right = "-" + (this.showWindowEl.getWidth() + 25) + "px"
		}
		return false
	},
	
	show: function() {
		this.selectEl.show();
		
		var b = parseInt(this.coverEl.getWidth(), 10) - 20;
		if (this.defaultWidth > b) {
			b = this.defaultWidth
		}
		this.selectEl.style.width = b + "px";
		if (this.totalItems < this.minItems) {
			var a = 0;
			this.selectEl.childElements().each(function(c) {
				a += c.getHeight()
			});
			
			if (0 < a) {
				this._setHeight(a)
			}
		}
		if (null != this.rowEl) {
			this.rowEl.style.zIndex = "25"
		}
		this._correctPosition();
		
		this.coverEl.addClassName("open");
		SelectBox.isOpen[this.baseId] = true;
		return false
	},
	
	_setHeight: function(a) {
		if (96 == a) {
			a = 97
		}
		this.selectEl.style.height = a + "px"
	},
	
	hide: function() {
		if (null == this.selectEl) {
			return
		}
		this.selectEl.hide();
		
		Element.removeClassName(this.coverEl, "open");
		if (null != this.rowEl) {
			this.rowEl.style.zIndex = "1"
		}
		if (SelectBox.isOpen[this.baseId]) {
			SelectBox.isOpen[this.baseId] = null
		}
		return false
	},
	
	hideAll: function(a) {
		Object.keys(SelectBox.descendants).each(function(b) {
			if ("undefined" != typeof(SelectBox.descendants[b].baseId) && "undefined" != typeof(SelectBox.descendants[b].selectEl)) {
				SelectBox.descendants[b].hide()
			}
		});
		
		return false
	},
	
	reset: function() {
		if (null != this.selectedItem && null != $(this.itemIdPrefix + this.selectedItem)) {
			$(this.itemIdPrefix + this.selectedItem).removeClassName("selected")
		}
		this.selectedItem = null;
		if (null != this.baseEl) {
			this.baseEl.value = ""
		}
		if (null != this.textEl) {
			this.textEl.value = ""
		}
		return false
	},
	
	_createSelect: function() {
		if (true == TOUCHABLE && false == this.withSuggest) {
			var d = new Element("select", {
				name: this.baseEl.name,
				id: this.baseEl.id
			});
			
			this.baseEl.parentNode.removeChild(this.baseEl);
			this.textEl.parentNode.removeChild(this.textEl);
			this.coverEl.innerHTML = "";
			this.coverEl.appendChild(new Element("i"));
			var b = this.selectedItem;
			var c = this;
			Object.keys(this.data).each(function(f) {
				if (-1 != c.disabled.indexOf(f)) {} else {
					var e = new Element("option", {
						value: f
					}).update(c.data[f]);
					if (b == f) {
						e.selected = true
					}
					d.appendChild(e);
					c.totalItems++
				}
			});
			
			if (null != this.otherItemText) {
				var a = new Element("option").update(this.otherItemText);
				d.appendChild(a);
				this.totalItems++
			}
			this.coverEl.appendChild(d);
			return
		}
		this.itemIdPrefix = this.baseId + this.itemIdPrefix;
		this.selectEl = new Element("div", {
			"class": "selectBox",
			style: "width:" + this.textEl.offsetWidth + "px;"
		});
		
		this.selectEl.hide();
		
		this.coverEl.appendChild(this.selectEl);
		var b = this.selectedItem;
		var c = this;
		Object.keys(this.data).each(function(f) {
			if (-1 != c.disabled.indexOf(f)) {
				var e = new Element("span", {
					id: c.itemIdPrefix + f,
					"class": "disabledItem"
				}).update(c.data[f])
			} else {
				var e = new Element("a", {
					id: c.itemIdPrefix + f,
					href: "#"
				}).update(c.data[f]);
				if (b == f) {
					e.addClassName("selected")
				}
				Event.observe(e, "mousedown", function(g) {
					this.blur();
					
					c.setBoxValue(this.id.replace(c.itemIdPrefix, ""));
					Event.stop(g)
				})
			}
			c.selectEl.appendChild(e);
			c.totalItems++
		});
		
		if (null != this.otherItemText) {
			var a = new Element("a", {
				id: this.itemIdPrefix + this.otherItemId,
				href: "#"
			}).update(this.otherItemText);
			Event.observe(a, "click", function(e) {
				c.hide();
				
				c.openWindow(e);
				Event.stop(e)
			});
			
			this.selectEl.appendChild(a);
			this.totalItems++;
			a.hide()
		}
		if (true == this.withSuggest) {
			this._createWindow()
		}
		return false
	},
	
	_createWindow: function() {
		this.selectWindow = new Element("div", {
			"class": "selectWindow"
		});
		
		document.body.appendChild(this.selectWindow);
		this.selectWindow.hide();
		
		if ("" != this.selectWindowTitle) {
			this.selectWindow.appendChild(new Element("h2").update(RS_CFG.labels["branch"]["selectBranchAllTitle"]))
		}
		var a = new Element("a", {
			"class": "selectWindowClose",
			href: "#"
		}).update(RS_CFG.labels["close"]);
		this.selectWindow.appendChild(a);
		Event.observe(a, "click", this.closeWindow.bindAsEventListener(this));
		this.itemIdWindowPrefix = this.baseId + this.itemIdWindowPrefix;
		var d = this;
		this.windowItemsEl = new Element("div", {
			"class": "selectWindowItems"
		});
		
		this.selectWindow.appendChild(this.windowItemsEl);
		this.windowItemsColumn[1] = new Element("div", {
			"class": "swItemsCol"
		});
		
		this.windowItemsEl.appendChild(this.windowItemsColumn[1]);
		this.windowItemsColumn[2] = new Element("div", {
			"class": "swItemsCol"
		});
		
		this.windowItemsEl.appendChild(this.windowItemsColumn[2]);
		this.windowItemsColumn[3] = new Element("div", {
			"class": "swItemsCol last"
		});
		
		this.windowItemsEl.appendChild(this.windowItemsColumn[3]);
		var j = Object.keys(this.data);
		var o = j.length;
		var b = o / 3;
		var l = new Array();
		
		l[1] = b;
		l[2] = b;
		l[3] = b;
		if (true == b.isFloat()) {
			var f = b.toFixed(1).toString();
			
			var e = f.substr(f.indexOf(".") + 1);
			b = b.toFixed(0);
			if (e < 5) {
				l[1] = parseInt(b, 10) + 1;
				l[2] = parseInt(b, 10)
			} else {
				l[1] = parseInt(b, 10);
				l[2] = parseInt(b, 10)
			}
			l[3] = parseInt(o - (l[1] + l[2]), 10)
		}
		var n = "";
		var g = new Element("div", {
			"class": "cleaner"
		});
		
		for (var h = 1, k = 1, c = 0; c < o; c++) {
			if (k > l[h]) {
				this.windowItemsColumn[h].appendChild(g);
				h++;
				k = 1
			}
			var m = new Element("a", {
				id: this.itemIdWindowPrefix + j[c],
				href: "#"
			}).update(this.data[j[c]]);
			if (n != this.data[j[c]].substr(0, 1)) {
				m.addClassName("firstAlpha")
			}
			this.windowItemsColumn[h].appendChild(m);
			Event.observe(m, "click", function(p) {
				this.blur();
				
				d.setBoxValue(this.id.replace(d.itemIdWindowPrefix, ""));
				d.closeWindow(p);
				if (true == Forms.isShowedAlert && (Forms.showedHint && -1 < Forms.showedHint.id.indexOf(d.baseId))) {
					Forms.hideHint(true)
				}
			});
			
			n = this.data[j[c]].substr(0, 1);
			k++
		}
		this.windowItemsColumn[h].appendChild(g);
		return false
	},
	
	openWindow: function(b) {
		if (b) {
			Event.stop(b)
		}
		Forms.hideHint();
		
		WindowUtilities.disableScreen("waiting_window", "waiting_window");
		document.body.style.overflow = "hidden";
		Event.observe(window, "resize", this.resizeWin.bindAsEventListener(this));
		this.selectWindow.show();
		
		if (this.windowItemsEl.offsetHeight < this.windowItemsEl.scrollHeight) {
			var a = this.windowItemsEl.scrollHeight;
			this.windowItemsColumn[1].style.height = a + "px";
			this.windowItemsColumn[2].style.height = a + "px";
			this.windowItemsColumn[3].style.height = a + "px"
		}
		this._centerWin();
		
		if ("function" == typeof(Cufon) && true == Cufon.initialized) {
			Cufon.replace(".selectWindow h2")
		}
		return false
	},
	
	closeWindow: function(a) {
		Event.stop(a);
		this.selectWindow.hide();
		
		WindowUtilities.enableScreen("waiting_window");
		Event.stopObserving(window, "resize");
		document.body.style.overflow = "auto";
		$("coverPage").style.paddingRight = "0px"
	},
	
	resizeWin: function() {
		var a = WindowUtilities.getPageSize();
		
		if ($("waiting_window")) {
			$("waiting_window").style.height = (a.pageHeight + "px");
			$("waiting_window").style.width = (a.pageWidth + "px")
		}
		this._centerWin()
	},
	
	_centerWin: function() {
		var d = WindowUtilities.getWindowScroll();
		
		var b = WindowUtilities.getPageSize();
		
		var a = (b.windowHeight - this.selectWindow.offsetHeight) / 2 + d.top;
		if (0 > a) {
			a = 0
		}
		var c = (b.windowWidth - this.selectWindow.offsetWidth) / 2 + d.left;
		if (0 > c) {
			c = 0
		}
		this.selectWindow.style.top = a + "px";
		this.selectWindow.style.left = c + "px";
		return false
	},
	
//	setBoxValue: function(c, b, a) {
//		this.baseEl.value = c;
//		if (null != this.selectedItem && null != $(this.itemIdPrefix + this.selectedItem)) {
//			$(this.itemIdPrefix + this.selectedItem).removeClassName("selected")
//		}
//		this.selectedItem = c;
//		if (null != $(this.itemIdPrefix + this.selectedItem)) {
//			$(this.itemIdPrefix + this.selectedItem).addClassName("selected")
//		}
//		this._setBoxText(c);
//		if (!b) {
//			this.hide()
//		}
//		if (!a) {
//			this.onSelect()
//		}
//		this.userOnSelect();
//		
//		Forms.hideHint();
//		
//		return false
//	},
//	
	_setBoxText: function(a) {
		if (this.data[a]) {
			this.textEl.value = html_entity_decode(this.data[a])
		}
		return false
	},
	
	_setEvents: function() {
		if (false == this.withSuggest) {
			Event.observe(this.coverEl, "mouseover", function() {
				this.addClassName("selectHover")
			});
			
			Event.observe(this.coverEl, "mouseout", function() {
				this.removeClassName("selectHover")
			});
			
			Event.observe(this.coverEl, "click", this._clickSelect.bindAsEventListener(this))
		} else {
			Event.observe(this.textEl, "click", function(b) {
				var a = this.id.replace(/Text/, "");
				SelectBox.isOpen[a] = true;
				SelectBox.hideAll(b);
				if (Forms.showedHint && -1 == Forms.showedHint.id.indexOf(a)) {
					Forms.hideHint(true)
				}
				Event.stop(b)
			})
		}
		Event.observe(document, "keydown", this._keyEvents.bindAsEventListener(this));
		return false
	},
	
	_keyEvents: function(b) {
		if (true != this.isOpen[this.baseId]) {
			var a = Event.element(b).id.replace(/Text/, "");
			if (a != this.baseId) {
				return false
			} else {
				if (a == this.baseId && false == this.descendants[a].withSuggest) {
					return false
				}
			}
		}
		switch (b.keyCode) {
			case Event.KEY_TAB:
			case Event.KEY_RETURN:
			case Event.KEY_LEFT:
			case Event.KEY_RIGHT:
				this._selectEntry();
				
				Event.stop(b);
				break;
			case Event.KEY_ESC:
				this.hideAll(b);
				Event.stop(b);
				break;
			case Event.KEY_UP:
				this._markPrevious();
				
				Event.stop(b);
				break;
			case Event.KEY_DOWN:
				this._markNext();
				
				Event.stop(b);
				break;
			default:
				if (true == this.withSuggest) {
					this._updatedByText()
				} else {
					if ("keydown" == b.type) {
						this._markByLetter(String.fromCharCode(b.keyCode))
					}
				}
				break
		}
		return false
	},
	
	_clickSelect: function(c) {
		Event.stop(c);
		var b = Event.element(c);
		if (true == Element.hasClassName(b, "disabledItem")) {
			return false
		}
		if (Forms.showedHint && -1 == Forms.showedHint.id.indexOf(this.baseId)) {
			Forms.hideHint(true)
		}
		this.textEl.blur();
		
		var a = this.baseId;
		Object.keys(SelectBox.descendants).each(function(d) {
			if ("undefined" != typeof(SelectBox.descendants[d].baseId) && a != SelectBox.descendants[d].baseId && "undefined" != typeof(SelectBox.descendants[d].selectEl)) {
				SelectBox.descendants[d].hide()
			}
		});
		
		if (this.selectEl && null == SelectBox.isOpen[this.baseId]) {
			this.show()
		} else {
			if (this.selectEl) {
				this.hide()
			}
		}
		return false
	},
	
	_selectEntry: function() {
		if (true == this.isOpen[this.baseId] && this.selectedItem) {
			this.setBoxValue(this.selectedItem)
		}
		return false
	},
	
	_markByLetter: function(a) {
		a = a.toLowerCase();
		
		var b = this;
		Object.keys(this.data).each(function(c) {
			if (a == b.data[c].substring(0, 1).toLowerCase()) {
				b.setBoxValue(c, true);
				b._correctPosition();
				
				return true
			}
		});
		
		return false
	},
	
	_markPrevious: function() {
		var c = Object.keys(this.data);
		if (this.selectedItem) {
			var a = c.indexOf(this.selectedItem);
			for (i = (a - 1); i >= 0; i--) {
				if ($(this.itemIdPrefix + c[i]) && $(this.itemIdPrefix + c[i]).visible()) {
					this.setBoxValue(c[i], true);
					this._correctPosition();
					
					break
				}
			}
		} else {
			var b = c.length;
			for (i = (b - 1); i >= 0; i--) {
				if ($(this.itemIdPrefix + c[i]) && $(this.itemIdPrefix + c[i]).visible()) {
					this.setBoxValue(c[i], true);
					this._correctPosition();
					
					break
				}
			}
		}
		return false
	},
	
	_markNext: function() {
		var c = Object.keys(this.data);
		var b = c.length;
		if (this.selectedItem) {
			var a = c.indexOf(this.selectedItem);
			for (i = (a + 1); i <= b; i++) {
				if ($(this.itemIdPrefix + c[i]) && $(this.itemIdPrefix + c[i]).visible()) {
					this.setBoxValue(c[i], true);
					this._correctPosition();
					
					break
				}
			}
		} else {
			for (i = 0; i <= b; i++) {
				if ($(this.itemIdPrefix + c[i]) && $(this.itemIdPrefix + c[i]).visible()) {
					this.setBoxValue(c[i], true);
					this._correctPosition();
					
					break
				}
			}
		}
		return false
	},
	
	_correctPosition: function() {
		if (null != this.selectedItem) {
			var d = $(this.itemIdPrefix + this.selectedItem);
			if (!d) {
				return false
			}
			var c = Element.cumulativeOffset(d);
			var b = Element.cumulativeOffset(this.selectEl);
			if (0 <= c.top && 0 <= b.top) {
				var a = c.top - b.top - (this.selectEl.offsetHeight / 2);
				if (a < 0) {
					a = 0
				}
				this.selectEl.scrollTop = a
			}
		}
		return false
	},
	
	_updatedByText: function() {
		var a = this.textEl.value.toLowerCase();
		
		var b = 0;
		this.selectedItem = null;
		this.baseEl.value = "";
		var c = this;
		var d = 0;
		this.show();
		
		Object.keys(this.data).each(function(e) {
			if (-1 < c.data[e].toLowerCase().indexOf(a) || (c.keywords[e] && -1 < c.keywords[e].toLowerCase().indexOf(a))) {
				$(c.itemIdPrefix + e).show();
				
				b += $(c.itemIdPrefix + e).offsetHeight;
				d++
			} else {
				$(c.itemIdPrefix + e).hide()
			}
		});
		
		if (this.otherItemText) {
			if (0 == d) {
				$(this.itemIdPrefix + this.otherItemId).show();
				
				b += $(this.itemIdPrefix + this.otherItemId).offsetHeight
			} else {
				$(this.itemIdPrefix + this.otherItemId).hide()
			}
		} else {
			if (0 == d) {
				this.hide();
				
				this.baseEl.value = this.otherItemId;
				this.selectedItem = this.otherItemId
			}
		}
		if (0 < b && b < this.defaultHeight) {
			this._setHeight(b)
		} else {
			if (this.defaultHeight) {
				this._setHeight(this.defaultHeight)
			}
		}
		return false
	},
	
	getHtml: function() {
		var a = new Element("div", {
			"class": "selectCase"
		});
		
		a.appendChild(new Element("input", {
			type: "hidden",
			value: "",
			name: this.baseId,
			id: this.baseId
		}));
		a.appendChild(new Element("input", {
			type: "text",
			value: "",
			"class": "selectText",
			id: this.baseId + "Text"
		}));
		if (false == this.withSuggest) {
			a.appendChild(new Element("b"))
		}
		a.appendChild(new Element("i"));
		if (true == this.withSuggest) {
			this.update();
			
			a.appendChild(new Element("a", {
				"class": "selectShowAll",
				id: this.baseId + "ShowAll",
				href: "#"
			}).update(this.selectWindowLink))
		}
		return a
	}
};

var SelectBox = new SelectBoxClass();

var BranchTypesClass = Class.create();

Object.extend(BranchTypesClass.prototype, SelectBoxClass.prototype);
Object.extend(BranchTypesClass.prototype, {
	baseId: "branch_type",
	withSuggest: true,
	update: function() {
		if ("undefined" != typeof(RS_CFG)) {
			this.selectWindowTitle = RS_CFG.labels["branch"]["selectBranchAllTitle"]
		}
		this.otherItemId = "GENERIC_BUSINESS_TYPE"
	},
	
	onSelect: function() {
		Layouts.reset()
	}
});

var BranchTypes = new BranchTypesClass();

var CountriesClass = Class.create();

Object.extend(CountriesClass.prototype, SelectBoxClass.prototype);
Object.extend(CountriesClass.prototype, {
	baseId: "country",
	currency: new Array()
});

var Countries = new CountriesClass();

var EsProvinceNamesClass = Class.create();

Object.extend(EsProvinceNamesClass.prototype, SelectBoxClass.prototype);
Object.extend(EsProvinceNamesClass.prototype, {
	baseId: "esProvince"
});

var EsProvinceNames = new EsProvinceNamesClass();

var ItProvinceNamesClass = Class.create();

Object.extend(ItProvinceNamesClass.prototype, SelectBoxClass.prototype);
Object.extend(ItProvinceNamesClass.prototype, {
	baseId: "itProvince"
});

var ItProvinceNames = new ItProvinceNamesClass();

var BrProvinceNamesClass = Class.create();

Object.extend(BrProvinceNamesClass.prototype, SelectBoxClass.prototype);
Object.extend(BrProvinceNamesClass.prototype, {
	baseId: "brProvince"
});

var BrProvinceNames = new BrProvinceNamesClass();

var CoProvinceNamesClass = Class.create();

Object.extend(CoProvinceNamesClass.prototype, SelectBoxClass.prototype);
Object.extend(CoProvinceNamesClass.prototype, {
	baseId: "coProvince"
});

var CoProvinceNames = new CoProvinceNamesClass();

var MxStatesClass = Class.create();

Object.extend(MxStatesClass.prototype, SelectBoxClass.prototype);
Object.extend(MxStatesClass.prototype, {
	baseId: "mxStates"
});

var MxStates = new MxStatesClass();

var CountriesWithUSClass = Class.create();

Object.extend(CountriesWithUSClass.prototype, SelectBoxClass.prototype);
Object.extend(CountriesWithUSClass.prototype, {
	baseId: "contact_country",
	currency: new Array(),
	taxesLabel: null,
	update: function() {
		this.setBoxValue(this.defaultValue, true, true)
	},
	
	onSelect: function() {
		if (null == this.taxesLabel) {
			this._getTaxesLabel()
		}
		if ("us" == this.selectedItem) {
			Forms.toggleBlock([UnitedStates.baseId + "Row"], true);
			if (null != this.taxesLabel) {
				this.taxesLabel.innerHTML = CFG.labels["eshop"]["taxesListForm"]["sales_tax_enabled"]
			}
		} else {
			Forms.toggleBlock([UnitedStates.baseId + "Row"], false);
			UnitedStates.reset();
			
			if (null != this.taxesLabel) {
				this.taxesLabel.innerHTML = CFG.labels["eshop"]["taxesListForm"]["taxes_enabled"]
			}
		}
	},
	
	_getTaxesLabel: function() {
		if (null == $("taxesRow")) {
			return false
		}
		var a = $("taxesRow").firstChild;
		do {
			if ("label" == a.nodeName.toLowerCase()) {
				this.taxesLabel = a;
				break
			}
		} while 
		(a = a.nextSibling);
		return false
	}
});

var CountriesWithUS = new CountriesWithUSClass();

var CurrenciesClass = Class.create();

Object.extend(CurrenciesClass.prototype, SelectBoxClass.prototype);
Object.extend(CurrenciesClass.prototype, {
	baseId: "currency_id",
	update: function() {
		if (!this.defaultValue && ("object" == typeof(CountriesWithUS) && "object" == typeof(CountriesWithUS.currency) && CountriesWithUS.selectedItem && CountriesWithUS.currency[CountriesWithUS.selectedItem])) {
			this.defaultValue = CountriesWithUS.currency[CountriesWithUS.selectedItem];
			this.selectedItem = "_" + this.defaultValue;
			this.setBoxValue(this.defaultValue, true, true)
		}
	},
	
	afterCreate: function() {
		if (true == TOUCHABLE && false == this.withSuggest) {
			$A($(this.baseEl.id).getElementsByTagName("option")).each(function(a) {
				a.value = a.value.replace(/^_/, "")
			})
		} else {
			$A(this.selectEl.getElementsByTagName("a")).each(function(a) {
				a.id = a.id.replace(this.itemIdPrefix + "_", this.itemIdPrefix)
			}.bind(this))
		}
		this.setBoxValue(this.defaultValue, true, true)
	},
	
	_setBoxText: function(a) {
		a = "_" + a;
		if (this.data[a]) {
			this.textEl.value = html_entity_decode(this.data[a])
		}
		return false
	}
});

var Currencies = new CurrenciesClass();

var UnitedStatesClass = Class.create();

Object.extend(UnitedStatesClass.prototype, SelectBoxClass.prototype);
Object.extend(UnitedStatesClass.prototype, {
	baseId: "contact_state"
});

var UnitedStates = new UnitedStatesClass();

var LanguagesClass = Class.create();

Object.extend(LanguagesClass.prototype, SelectBoxClass.prototype);
Object.extend(LanguagesClass.prototype, {
	baseId: "language"
});

var Languages = new LanguagesClass();

var TldClass = Class.create();

Object.extend(TldClass.prototype, SelectBoxClass.prototype);
Object.extend(TldClass.prototype, {
	baseId: "domainTld"
});

var Tld = new TldClass();

var TaxClass = Class.create();

Object.extend(TaxClass.prototype, SelectBoxClass.prototype);
Object.extend(TaxClass.prototype, {
	baseId: "vat"
});

var Tax = new TaxClass();

var InstalmentsCountClass = Class.create();

Object.extend(InstalmentsCountClass.prototype, SelectBoxClass.prototype);
Object.extend(InstalmentsCountClass.prototype, {
	baseId: "instalments_count"
});

var InstalmentsCount = new InstalmentsCountClass();

var PayTypeClass = Class.create();

Object.extend(PayTypeClass.prototype, SelectBoxClass.prototype);
Object.extend(PayTypeClass.prototype, {
	baseId: "payType"
});

var PayType = new PayTypeClass();

var DeliveryTypeClass = Class.create();

Object.extend(DeliveryTypeClass.prototype, SelectBoxClass.prototype);
Object.extend(DeliveryTypeClass.prototype, {
	baseId: "deliveryType"
});

var DeliveryType = new DeliveryTypeClass();

var ProviderClass = Class.create();

Object.extend(ProviderClass.prototype, SelectBoxClass.prototype);
Object.extend(ProviderClass.prototype, {
	baseId: "provider"
});

var Provider = new ProviderClass();

var ExportClass = Class.create();

Object.extend(ExportClass.prototype, SelectBoxClass.prototype);
Object.extend(ExportClass.prototype, {
	baseId: "export_format"
});

var Export = new ExportClass();

var DialCodesClass = Class.create();

Object.extend(DialCodesClass.prototype, SelectBoxClass.prototype);
Object.extend(DialCodesClass.prototype, {
	baseId: "dialCodes"
});

var DialCodes = new DialCodesClass();

var FrCompanyTypesClass = Class.create();

Object.extend(FrCompanyTypesClass.prototype, SelectBoxClass.prototype);
Object.extend(FrCompanyTypesClass.prototype, {
	baseId: "company_typeInput"
});

var FrCompanyTypes = new FrCompanyTypesClass();

var ItEntityTypesClass = Class.create();

Object.extend(ItEntityTypesClass.prototype, SelectBoxClass.prototype);
Object.extend(ItEntityTypesClass.prototype, {
	baseId: "it_entity_typeInput"
});

var ItEntityTypes = new ItEntityTypesClass();

var UserRoleClass = Class.create();

Object.extend(UserRoleClass.prototype, SelectBoxClass.prototype);
Object.extend(UserRoleClass.prototype, {
	baseId: "userRole"
});

var UserRole = new UserRoleClass();

var BackendLanguagesClass = Class.create();

Object.extend(BackendLanguagesClass.prototype, SelectBoxClass.prototype);
Object.extend(BackendLanguagesClass.prototype, {
	baseId: "language"
});

var BackendLanguages = new BackendLanguagesClass();

var EmailDomainClass = Class.create();

Object.extend(EmailDomainClass.prototype, SelectBoxClass.prototype);
Object.extend(EmailDomainClass.prototype, {
	baseId: "emailDomain"
});

var EmailDomain = new EmailDomainClass();

var EshopYearClass = Class.create();

Object.extend(EshopYearClass.prototype, SelectBoxClass.prototype);
Object.extend(EshopYearClass.prototype, {
	baseId: "yearsSelect"
});

var EshopYear = new EshopYearClass();

var EshopMonthClass = Class.create();

Object.extend(EshopMonthClass.prototype, SelectBoxClass.prototype);
Object.extend(EshopMonthClass.prototype, {
	baseId: "monthsSelect"
});

var EshopMonth = new EshopMonthClass();

var OrderStatusClass = Class.create();

Object.extend(OrderStatusClass.prototype, SelectBoxClass.prototype);
Object.extend(OrderStatusClass.prototype, {
	baseId: "orderStatusSelect"
});

var OrderStatus = new OrderStatusClass();

var OrderPaidClass = Class.create();

Object.extend(OrderPaidClass.prototype, SelectBoxClass.prototype);
Object.extend(OrderPaidClass.prototype, {
	baseId: "orderPaidSelect"
});

var OrderPaid = new OrderPaidClass();

var ExportOrdersClass = Class.create();

Object.extend(ExportOrdersClass.prototype, SelectBoxClass.prototype);
Object.extend(ExportOrdersClass.prototype, {
	baseId: "exportOrdersSelect"
});

var ExportOrders = new ExportOrdersClass();

var DispatchOrderClass = Class.create();

Object.extend(DispatchOrderClass.prototype, SelectBoxClass.prototype);
Object.extend(DispatchOrderClass.prototype, {
	baseId: "dispatchOrderSelect",
	itemWithTrack: new Object(),
	showTrackingUrl: false,
	onSelect: function() {
		if (true == this.itemWithTrack[this.selectedItem]) {
			$("trackingCodeRow").show();
			
			this.showTrackingUrl = true
		} else {
			$("trackingCodeRow").hide();
			
			$("trackingCode").value = "";
			this.showTrackingUrl = false
		}
	},
	
	validate: function() {
		if (false == this.selectedItem) {
			Element.addClassName($(this.baseId.replace(/Select/, "Row")), "error");
			return false
		} else {
			Element.removeClassName($(this.baseId.replace(/Select/, "Row")), "error")
		}
		if (true == this.showTrackingUrl) {
			if ("" == $("trackingCode").value) {
				Element.addClassName($("trackingCodeRow"), "error");
				return false
			} else {
				Element.removeClassName($("trackingCodeRow"), "error")
			}
		}
		return true
	},
	
	setDispatch: function() {
		if (true == this.validate()) {
			dispatchOrderControl.hide();
			
			$$(".blueBoxShadow")[0].hide();
			
			$("saveArea").show();
			
			$("dispatchOrderForm").submit()
		}
	}
});

var DispatchOrder = new DispatchOrderClass();

var UserEditFormClass = Class.create();

UserEditFormClass.prototype = {
	initialize: function() {},
	
	showChangePasswordRows: function(b) {
		var c = ["passwordRow", "passwordConfirmRow"];
		for (var d = 0; d < c.length; d++) {
			var a = $(c[d]);
			if (a) {
				a.style.display = "";
				var f = $(a.id.replace("Row", ""));
				f.disabled = false
			}
		}
		var e = b.parentNode;
		while (e && e.className != "formRow") {
			e = e.parentNode
		}
		e.style.display = "none"
	}
};

var UserEditForm = new UserEditFormClass();

var AdministrationBaseWindow = Class.create();

AdministrationBaseWindow.prototype = {
	id: null,
	fitInParent: false,
	container: null,
	hideAfterClose: true,
	okLabel: null,
	cancelLabel: null,
	disabledAutoHide: false,
	initialize: function() {
		if (null == $("bgFade")) {
			var a = new Element("div", {
				id: "bgFade",
				"class": "overlay_waiting_window"
			});
			
			a.style.zIndex = "1100";
			a.style.width = "100%";
			document.body.insertBefore(a, $("coverPage"))
		}
	},
	
	_hideLayer: function(a) {
		if (this.hideAfterClose) {
			$(a).style.display = "none"
		} else {
			Element.remove($(a))
		}
	},
	
	hide: function() {
		var a = AdministrationBaseWindow.prototype.container;
		if (a) {
			this._hideLayer(a);
			this._makeInvisible();
			
			document.body.style.overflow = "auto"
		}
	},
	
	_show: function(d, c, b) {
		this.container = d;
		if (!this.container.className) {
			this.container.className = "administrationWindow"
		}
		this.container.style.display = "block";
		AdministrationBaseWindow.prototype.container = d;
		if (!document.getElementsByClassName("administrationWindowClose", this.container)[0]) {
			var a = new Element("a", {
				"class": "administrationWindowClose"
			});
			
			a.onclick = this.hide.bind(this);
			this.container.appendChild(a)
		}
		this._centerWindow(this.container, c);
		Event.observe(window, "resize", this._centerWindow.bind(this, this.container, c));
		this._makeVisible();
		
		document.body.style.overflow = "hidden";
		if (false == this.disabledAutoHide) {
			Event.observe(document, "keydown", function(e) {
				if (Event.KEY_ESC == e.keyCode) {
					AdministrationBaseWindow.prototype.hide();
					
					Event.stop(e);
					return
				}
			});
			
			Event.observe($("bgFade"), "click", function() {
				AdministrationBaseWindow.prototype.hide()
			})
		}
	},
	
	_parseOptions: function(a) {
		if (a.id) {
			this.id = a.id
		}
		if (a.okLabel) {
			this.okLabel = a.okLabel
		}
		if (a.cancelLabel) {
			this.cancelLabel = a.cancelLabel
		}
		if (a.disabledAutoHide) {
			this.disabledAutoHide = a.disabledAutoHide
		}
		this.fitInParent = a.fitInParent || false
	},
	
	_makeVisible: function() {
		$("bgFade").style.visibility = "visible";
		$("bgFade").show();
		
		var a = this.getPageSize();
		
		$("bgFade").style.height = a.pageHeight + "px"
	},
	
	_makeInvisible: function() {
		$("bgFade").style.visibility = "hidden";
		$("bgFade").hide()
	},
	
	_centerWindow: function(d, f) {
		var a = $(d);
		if (!f) {
			f = document.body;
			f.appendChild(a)
		}
		if (this.container.getHeight() > document.body.getHeight()) {
			this.fitInParent = true
		}
		if (this.fitInParent) {
			var e = document.body.getHeight() - 60;
			if (e < 150) {
				e = 150
			}
			a.style.height = e + "px";
			var h = document.getElementsByClassName("popupScrollHead", this.container)[0];
			var l = document.getElementsByClassName("popupScrollFoot", this.container)[0];
			var j = document.getElementsByClassName("popupScrollBody", this.container)[0];
			var m = e - 20;
			if (h) {
				m -= h.getHeight()
			}
			if (l) {
				m -= l.getHeight()
			} else {
				m -= 25
			}
			if (j) {
				j.style.height = m + "px"
			}
		}
		var g = this.getWindowScroll();
		
		var c = 0;
		if (f) {
			var b = Element.cumulativeOffset(f);
			if (b.top) {
				c = b.top
			}
		}
		var k = Math.round(g.top - c + (document.body.getHeight() - a.getHeight()) / 2);
		if (f && k < b.top) {
			k = 15
		}
		a.style.top = k + "px";
		a.style.left = Math.round(g.left + (f.getWidth() - a.getWidth()) / 2) + "px"
	},
	
	getPageSize: function() {
		var e, a;
		if (window.innerHeight && window.scrollMaxY) {
			e = document.body.scrollWidth;
			a = window.innerHeight + window.scrollMaxY
		} else {
			if (document.body.scrollHeight > document.body.offsetHeight) {
				e = document.body.scrollWidth;
				a = document.body.scrollHeight
			} else {
				e = document.body.offsetWidth;
				a = document.body.offsetHeight
			}
		}
		var c, f;
		if (self.innerHeight) {
			c = self.innerWidth;
			f = self.innerHeight
		} else {
			if (document.documentElement && document.documentElement.clientHeight) {
				c = document.documentElement.clientWidth;
				f = document.documentElement.clientHeight
			} else {
				if (document.body) {
					c = document.body.clientWidth;
					f = document.body.clientHeight
				}
			}
		}
		var d, b;
		if (a < f) {
			d = f
		} else {
			d = a
		}
		if (e < c) {
			b = c
		} else {
			b = e
		}
		return {
			pageWidth: b,
			pageHeight: d,
			windowWidth: c,
			windowHeight: f
		}
	},
	
	getWindowScroll: function() {
		var w = window;
		var T, L, W, H;
		with(w.document) {
			if (w.document.documentElement && documentElement.scrollTop) {
				T = documentElement.scrollTop;
				L = documentElement.scrollLeft
			} else {
				if (w.document.body) {
					T = body.scrollTop;
					L = body.scrollLeft
				}
			}
			if (w.innerWidth) {
				W = w.innerWidth;
				H = w.innerHeight
			} else {
				if (w.document.documentElement && documentElement.clientWidth) {
					W = documentElement.clientWidth;
					H = documentElement.clientHeight
				} else {
					W = body.offsetWidth;
					H = body.offsetHeight
				}
			}
		}
		return {
			top: T,
			left: L,
			width: W,
			height: H
		}
	},
	
	replaceButtonMarks: function() {
		var b = $(this.id + "OkButton");
		if (b) {
			b.innerHTML = b.innerHTML.replace("%OK%", (this.okLabel ? this.okLabel : RS_CFG.labels["yes"]))
		}
		var a = $(this.id + "CancelButton");
		if (a) {
			a.innerHTML = a.innerHTML.replace("%CANCEL%", (this.cancelLabel ? this.cancelLabel : RS_CFG.labels["no"]))
		}
		if (b || a) {
			if ("function" == typeof(Cufon) && true == Cufon.initialized) {
				Cufon.replace(".buttonCase");
				Cufon.replace(".buttonCaseWhite")
			}
		}
	}
};

var AdministrationContentWindow = Class.create();

Object.extend(AdministrationContentWindow.prototype, AdministrationBaseWindow.prototype);
Object.extend(AdministrationContentWindow.prototype, {
	show: function(a) {
		this._parseOptions(a);
		if (a.contentEl) {
			this._show(a.contentEl, false, a)
		}
		var c = $(a.id + "CancelButton");
		if (null != c) {
			var b = this;
			c.onclick = function() {
				b.hide()
			}
		}
		this.replaceButtonMarks()
	}
});

var AdministrationConfirmWindow = Class.create();

Object.extend(AdministrationConfirmWindow.prototype, AdministrationBaseWindow.prototype);
Object.extend(AdministrationConfirmWindow.prototype, {
	message: null,
	okFunc: null,
	cancelFunc: null,
	show: function(a) {
		this._parseOptions(a);
		if (this.checkOptions(a)) {
			var b = $(this.id);
			var d = $(this.id + "Message");
			if (d) {
				d.innerHTML = this.message
			}
			var e = $(this.id + "OkButton");
			if (e && !e.onclick) {
				e.onclick = this.okFunc
			}
			if (this.cancelFunc) {
				var c = $(this.id + "CancelButton");
				if (c && !c.onclick) {
					c.onclick = this.cancelFunc
				}
			}
			this.replaceButtonMarks();
			
			this._show(b, false, a)
		}
	},
	
	checkOptions: function(b) {
		var a = false;
		var c = this;
		try {
			this.message = b.message;
			this.okFunc = function() {
				b.ok();
				
				c.hide()
			};
			
			if (b.cancel) {
				this.cancelFunc = function() {
					b.cancel();
					
					c.hide()
				}
			}
			a = true
		} catch (d) {
			a = false
		}
		return a
	}
});

var CreditCardPayment = Class.create();

CreditCardPayment.prototype = {
	initialize: function() {},
	
	showAdminWaitingWindow: function(f, g, e) {
		var a = document.getElementById("coverPage");
		if (!e) {
			var d = document.getElementById("content");
			if (d) {
				d.style.display = "none"
			}
		}
		var b = document.createElement("div");
		b.id = "rbcWaitingWindow";
		a.appendChild(b);
		b.innerHTML = (f ? '<img src="' + g + 'skins/default/img/loading.gif" width="16" height="16" />' : "") + "<span>" + RS_CFG.labels["pleaseWait"] + "</span>";
		b.style.width = parseInt(b.offsetWidth, 10) + "px";
		var c = a.offsetWidth / 2;
		c -= b.offsetWidth / 2;
		b.style.left = parseInt(c, 10) + "px"
	},
	
	hideAdminWaitingWindow: function() {
		var a = document.getElementById("rbcWaitingWindow");
		if (a) {
			a.parentNode.removeChild(a)
		}
	},
	
	onCreditCardFrameLoad: function() {
		var a = $("rbcCreditCardIframe");
		var b = parseInt(a.getAttribute("_onLoadCnt"), 10);
		b++;
		if (b == 1) {
			this.hideAdminWaitingWindow()
		}
		a.setAttribute("_onLoadCnt", b)
	},
	
	creditCardPageInit: function(d) {
		$("content").style.marginLeft = "0";
		$("content").style.marginRight = "0";
		this.showAdminWaitingWindow(true, d, true);
		var a = document.getElementById("rbcWaitingWindow");
		a.style.top = "300px";
		var b = document.getElementById("rbcCreditCardPayment");
		b.style.visibility = "visible";
		var c = document.getElementById("paymentForm");
		c.submit();
		
		Event.observe($("rbcCreditCardIframe"), "load", this.onCreditCardFrameLoad.bind(this))
	}
};

var PrecachedFiles = Class.create();

PrecachedFiles.prototype = {
	cachedFilesList: null,
	initialize: function(a) {
		if (!a) {
			this.cachedFilesList = new Array()
		} else {
			this.cachedFilesList = $A(a)
		}
		this.cachedFilesList.push(LOADING_IMAGE);
		Event.observe(window, "load", this.loadScripts.bind(this))
	},
	
	addFile: function(a) {
		this.cachedFilesList.push(a)
	},
	
	loadScripts: function() {
		if ("undefined" == typeof RubicusStaticServers) {
			return
		}
		if (null == $("preloadArea")) {
			document.body.appendChild(new Element("div", {
				id: "preloadArea"
			}))
		}
		$("preloadArea").innerHTML = this.cacheFiles()
	},
	
	cacheFiles: function() {
		var e = "";
		var a = this.cachedFilesList.length;
		if ("undefined" == typeof RubicusStaticServers) {
			return
		}
		for (var c = 0; c < a; c++) {
			var b = RubicusStaticServers.getServer(this.cachedFilesList[c]) + this.cachedFilesList[c];
			var d = b.substr(b.lastIndexOf(".") + 1);
			d = d.toLowerCase();
			
			if (d == "jpg" || d == "png" || d == "gif" || d == "jpeg") {
				e += '<img src="' + b + '"/>'
			} else {
				if (d == "css") {
					e += '<link rel="stylesheet" type="text/css" href="' + b + '" media="screen,handheld,projection" />'
				} else {
					if (d == "js") {
						e += '<script type="text/javascript" src="' + b + '"><\/script>'
					}
				}
			}
		}
		return e
	}
};

var FlashClass = Class.create();

FlashClass.prototype = {
	loadingSwf: "swf/loadingWhite.swf",
	loadingSwfWidth: 78,
	loadingSwfHeight: 78,
	initialize: function() {},
	
	getFlashCode: function(e, c, b, a, d) {
		if (!d) {
			e = this.getFullUrl(e);
			c = this.getFullUrl(c)
		}
		params = '<param name="movie" value="' + e + '" /><param name="quality" value="high" /><param name="play" value="true" /><param name="loop" value="true" /><param name="wmode" value="transparent" /><param name="scale" value="showall" /><param name="menu" value="false" />';
		return '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="' + b + '" height="' + a + '">' + params + '<!--[if !IE]>--><object type="application/x-shockwave-flash" data="' + e + '" width="' + b + '" height="' + a + '">' + params + '<!--<![endif]--><img src="' + c + '" width="' + b + '" height="' + a + '" alt="" /><!--[if !IE]>--></object><!--<![endif]--></object>'
	},
	
	getFullUrl: function(b) {
		var a = "/";
		if ("undefined" != typeof(RubicusStaticServers)) {
			a = RubicusStaticServers.getServer()
		} else {
			if ("undefined" != typeof(precachedFiles) && precachedFiles.staticServer) {
				a = precachedFiles.staticServer
			}
		}
		return a + b
	},
	
	getLoadingFlash: function() {
		return this.getFlashCode(this.loadingSwf, LOADING_IMAGE, this.loadingSwfWidth, this.loadingSwfHeight, false)
	},
	
	writeLoadingFlash: function(a) {
		if (null != $(a)) {
			$(a).innerHTML = this.getLoadingFlash() + $(a).innerHTML
		}
	}
};

var Flash = new FlashClass();

var BlueBoxHandlerClass = Class.create();

BlueBoxHandlerClass.prototype = {
	blockEl: null,
	contentEl: null,
	titleEl: null,
	titleText: null,
	perexEl: null,
	perexText: null,
	contentBlocks: new Array(),
	initialize: function() {},
	
	parse: function(a) {
		if (null == (this.blockEl = $(a))) {
			return
		}
		var f = $$("#" + a + " .blueBoxIn");
		if (null == (this.contentEl = f[0])) {
			return
		}
		var e = this.contentEl.childNodes;
		var b = e.length;
		for (var c = 0; c < b; c++) {
			var d = e[c];
			if ("h1" == d.nodeName.toLowerCase() && null == this.titleEl) {
				this.titleEl = d;
				this.titleText = d.innerHTML
			} else {
				if ("perex" == d.className && null == this.perexEl) {
					this.perexEl = d;
					this.perexText = d.innerHTML
				} else {
					this.contentBlocks.push(d)
				}
			}
		}
	},
	
	setTitle: function(a) {
		if (null != this.titleEl) {
			this.titleEl.innerHTML = a;
			if ("function" == typeof(Cufon) && true == Cufon.initialized) {
				Cufon.replace("h1")
			}
		}
	},
	
	setPerex: function(a) {
		if (null != this.perexEl) {
			this.perexEl.innerHTML = a
		}
	}
};

var BlueBoxHandler = new BlueBoxHandlerClass();

Number.prototype.isFloat = function() {
	return /\./.test(this.toString())
};


function html_entity_decode(c) {
	var b = document.createElement("textarea");
	b.innerHTML = c;
	var a = b.value;
	return a
}
var IECorners = {
	run: function() {
		$$(".roundCornerBlock", ".roundCornerGraph").each(function(a) {
			IECorners.execute(a, "v08vnSVo78t4JfjH")
		})
	},
	
	findPos: function(a) {
		var b = curtop = 0;
		if (a.offsetParent) {
			do {
				b += a.offsetLeft;
				curtop += a.offsetTop
			} while 
			(a = a.offsetParent)
		}
		return ({
			x: b,
			y: curtop
		})
	},
	
	execute: function(l, h) {
		if (l.className.match(h)) {
			return (false)
		}
		if (!document.namespaces.v) {
			document.namespaces.add("v", "urn:schemas-microsoft-com:vml")
		}
		l.className = l.className.concat(" ", h);
		var n = Math.min(parseInt(l.currentStyle["-moz-border-radius"] || l.currentStyle["-webkit-border-radius"] || l.currentStyle["border-radius"] || l.currentStyle["-khtml-border-radius"]) / Math.min(l.offsetWidth, l.offsetHeight), 1);
		var f = l.currentStyle.backgroundColor;
		var m = l.currentStyle.backgroundImage.replace(/^url\("(.+)"\)$/, "$1");
		var o = l.currentStyle.borderColor;
		var r = parseInt(l.currentStyle.borderWidth);
		var c = "true";
		if (isNaN(r)) {
			r = 0;
			o = f;
			c = "false"
		}
		l.style.background = "transparent";
		l.style.borderColor = "transparent";
		var b = l;
		var s = 100,
			q = 0;
		while ((typeof(b) != "unknown") && (b.currentStyle.position != "relative") && (b.tagName != "BODY")) {
			b = b.parentElement;
			q++;
			if (q >= s) {
				return (false)
			}
		}
		var e = parseInt(b.currentStyle.zIndex);
		if (isNaN(e)) {
			e = 0
		}
		var g = {
			width: l.offsetWidth - r,
			height: l.offsetHeight - r
		};
		
		var j = this.findPos(b);
		var d = this.findPos(l);
		d.y = d.y + (0.5 * r) - j.y;
		d.x = d.x + (0.5 * r) - j.x;
		var a = document.createElement("v:roundrect");
		a.arcsize = n + "px";
		a.strokecolor = o;
		a.strokeWeight = r + "px";
		a.stroked = c;
		a.style.display = "block";
		a.style.position = "absolute";
		a.style.top = d.y + "px";
		a.style.left = d.x + "px";
		a.style.width = g.width + "px";
		a.style.height = g.height + "px";
		a.style.antialias = true;
		a.style.zIndex = e - 1;
		var p = document.createElement("v:fill");
		p.color = f;
		p.src = m;
		p.type = "tile";
		a.appendChild(p);
		b.appendChild(a);
		var k = b.document.createStyleSheet();
		
		k.addRule("v\\:roundrect", "behavior: url(#default#VML)");
		k.addRule("v\\:fill", "behavior: url(#default#VML)");
		isIE6 = /msie|MSIE 6/.test(navigator.userAgent);
		if (isIE6 && (r > 0)) {
			l.style.borderStyle = "none";
			l.style.paddingTop = parseInt(l.currentStyle.paddingTop || 0) + r;
			l.style.paddingBottom = parseInt(l.currentStyle.paddingBottom || 0) + r
		}
		if (typeof(window.rounded_elements) == "undefined") {
			window.rounded_elements = new Array();
			
			if (typeof(window.onresize) == "function") {
				window.previous_onresize = window.onresize
			}
			window.onresize = this.window_resize
		}
		l.vml = a;
		window.rounded_elements.push(l)
	},
	
	window_resize: function() {
		if (typeof(window.rounded_elements) == "undefined") {
			return (false)
		}
		for (var a in window.rounded_elements) {
			var c = window.rounded_elements[a];
			var b = parseInt(c.currentStyle.borderWidth);
			if (isNaN(b)) {
				b = 0
			}
			var d = this.findPos(c.vml.parentNode);
			var e = this.findPos(c);
			e.y = e.y + (0.5 * b) - d.y;
			e.x = e.x + (0.5 * b) - d.x;
			c.vml.style.top = e.y + "px";
			c.vml.style.left = e.x + "px"
		}
		if (typeof(window.previous_onresize) == "function") {
			window.previous_onresize()
		}
	}
};

var AdPoliciesClass = Class.create();

AdPoliciesClass.prototype = {
	noWarez: null,
	deleteWeb: null,
	activateButton: null,
	initialize: function() {
		Event.observe(window, "load", this.init.bindAsEventListener(this))
	},
	
	init: function() {
		this.noWarez = $("nowarez");
		this.deleteWeb = $("deleteweb");
		this.activateButton = $("activateAd");
		if (null != this.deleteWeb && null != this.noWarez && null != this.activateButton) {
			Event.observe(this.noWarez, "change", this.test.bindAsEventListener(this));
			Event.observe(this.deleteWeb, "change", this.test.bindAsEventListener(this));
			if (true == Prototype.Browser.IE) {
				Event.observe(this.noWarez, "click", this.test.bindAsEventListener(this));
				Event.observe(this.deleteWeb, "click", this.test.bindAsEventListener(this))
			}
		}
	},
	
	test: function() {
		if (true == this.noWarez.checked && true == this.deleteWeb.checked) {
			this.activateButton.disabled = false
		} else {
			this.activateButton.disabled = true
		}
	}
};

var AdPolicies = new AdPoliciesClass();

var MetricsUtilClass = Class.create();

MetricsUtilClass.prototype = {
	timeDivergence: 0,
	initialize: function() {},
	
	getTime: function() {
		var a = new Date().getTime() / 1000;
		return parseInt(a, 10) - this.timeDivergence
	},
	
	diff: function(b, a) {
		return Math.abs(a - b)
	},
	
	getUserAgent: function() {
		return navigator.userAgent.substr(0, 200)
	},
	
	getViewportResolution: function() {
		var b, a;
		if (typeof document.documentElement != "undefined" && typeof document.documentElement.clientWidth != "undefined" && document.documentElement.clientWidth != 0) {
			b = document.documentElement.clientWidth, a = document.documentElement.clientHeight
		} else {
			if (typeof window.innerWidth != "undefined") {
				b = window.innerWidth, a = window.innerHeight
			}
		}
		return b + "x" + a
	},
	
	getScreenResolution: function() {
		var b, a;
		b = window.screen.width;
		a = window.screen.height;
		return b + "x" + a
	},
	
	isMobileDevice: function() {
		var b = (("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch);
		var a = navigator.userAgent;
		if (!b && (window.navigator.msPointerEnabled || window.navigator.msMaxTouchPoints > 0 || a.match(/IEMobile/))) {
			b = true
		}
		if (true == b && a.match(/Chrome/) && null == a.match(/Android/)) {
			b = false
		}
		return b
	}
};

var MetricsUtil = new MetricsUtilClass();

var RequestClass = Class.create();

RequestClass.prototype = {
	data: new Array(),
	className: null,
	utilObject: null,
	isSent: false,
	initialize: function(b, a) {
		this.url = document.location.href.replace(/\#step[0-9]/i, "") + "&projectThread=1";
		this.className = b;
		this.utilObject = a;
		Event.observe(window, "beforeunload", this._onwindowunload.bindAsEventListener(this));
		Event.observe(window, "load", this.run.bindAsEventListener(this))
	},
	
	run: function() {
		if ("undefined" != RS_CFG.system_time && RS_CFG.system_time) {
			this.utilObject.timeDivergence = this.utilObject.getTime() - RS_CFG.system_time
		}
		this.set("wizard_step1_starttime", this.utilObject.getTime())
	},
	
	set: function(a, b) {
		this.data[a] = b
	},
	
	increase: function(a) {
		if (this.data[a] && !isNaN(this.data[a])) {
			this.data[a]++
		} else {
			this.data[a] = 1
		}
	},
	
	get: function(a) {
		return this.data[a]
	},
	
	_onwindowunload: function() {
		this._sendData()
	},
	
	_sendData: function() {
		if (this.isSent) {
			return
		}
		var a = this.url + this._getSendParams();
		
		new Ajax.Request(a, {
			method: "get",
			asynchronous: false
		});
		
		this.isSent = true
	},
	
	_getSendParams: function() {
		var a = this._generateRequests();
		
		var b = "&class_name=" + this.className + "&project_data=" + encodeURIComponent(a.project_data);
		return b
	},
	
	_generateRequests: function() {
		var b = new PHP_Serializer(true);
		var a = b.serialize(this.data);
		a = encodeURIComponent(a);
		a = a.replace(/&/, "%28");
		a = a.replace(/=/, "%61");
		var c = new Array;
		c.project_data = a;
		return c
	}
};

var Metrics = new RequestClass("RubicusMetrics", MetricsUtil);
Metrics.set("user_agent", MetricsUtil.getUserAgent());
Metrics.set("lang", $("language").value);
Metrics.set("wizard_type", "0");
Metrics.set("viewport_resolution", MetricsUtil.getViewportResolution());
Metrics.set("screen_resolution", MetricsUtil.getScreenResolution());
Metrics.set("mobile_device", MetricsUtil.isMobileDevice() ? 1 : 0);
var PagesClass = Class.create();

PagesClass.prototype = {
	data: new Object(),
	baseEl: null,
	leftColumnEl: null,
	rightColumnEl: null,
	createdForModule: null,
	initialize: function() {},
	
	run: function() {
		if (this.createdForModule == Wizard.selectedModule) {
			return false
		}
		if (0 == Object.keys(this.data).length) {
			return false
		}
		if (null == this.baseEl) {
			this.baseEl = $("step3PagesInfo")
		}
		if (null == this.rightColumnEl) {
			this.rightColumnEl = new Element("div", {
				"class": "pagesInfo"
			});
			
			this.baseEl.insertBefore(this.rightColumnEl, this.baseEl.firstChild)
		} else {
			this.rightColumnEl.update()
		}
		if (null == this.leftColumnEl) {
			this.leftColumnEl = new Element("div", {
				"class": "pagesInfo"
			});
			
			this.baseEl.insertBefore(this.leftColumnEl, this.baseEl.firstChild)
		} else {
			this.leftColumnEl.update()
		}
		this._createPagesList();
		
		this.createdForModule = Wizard.selectedModule;
		return false
	},
	
	_createPagesList: function() {
		if ("undefined" == typeof(this.data[Wizard.selectedModule])) {
			return false
		}
		var a = this;
		this.data[Wizard.selectedModule]["general"].each(function(b) {
			a._createItem(b, a.leftColumnEl)
		});
		
		this.data[Wizard.selectedModule]["advanced"].each(function(b) {
			a._createItem(b, a.rightColumnEl)
		});
		
		return false
	},
	
	_createItem: function(a, c) {
		var b = new Element("input", {
			type: "checkbox",
			"class": "pageSelector",
			id: "page_" + a.identifier,
			name: a.identifier
		});
		
		c.appendChild(b);
		if (1 == a.selected) {
			b.checked = true
		}
		Event.observe(b, "click", function() {
			Metrics.increase("wizard_step3_checkboxes_click")
		});
		
		c.appendChild(new Element("label", {
			"for": "page_" + a.identifier
		}).update(a.title));
		c.appendChild(new Element("br"));
		return false
	}
};

var Pages = new PagesClass();

var WizardClass = Class.create();

WizardClass.prototype = {
	step: 1,
	lastStep: 3,
	data: new Array(),
	selectedModule: null,
	formRowsEl: new Object(),
	nextButtonEl: null,
	recentHash: null,
	hashPrefix: "step",
	stepAreaPrefix: "stepArea",
	infoPrefix: "stepInfo",
	infoLink: 0,
	checkHashTimer: null,
	validationRules: new Array(),
	step3title: null,
	step3desc: null,
	isButtonAsFinish: false,
	isPortalWizard: false,
	selfUrl: null,
	checkUrl: null,
	verifyUrl: null,
	sendUrl: null,
	timer: null,
	timeLimit: 2000,
	moduleTypeErrorEl: null,
	projectLabelEl: null,
	isWizard: false,
	waitingMode: true,
	isSent: false,
	initialize: function() {
		this.selfUrl = document.location.href.replace(/\#step[0-9]/i, "");
		this.checkUrl = this.selfUrl + "&checkStatus=1";
		this.verifyUrl = this.selfUrl + "&verifyStatus=1";
		//this.sendUrl = this.selfUrl ;//+ "&send=1";
		this.sendUrl = 'finish';
		var d = this;
		$$("div.formRow").each(function(e) {
			d.formRowsEl[e.id] = e;
			d.waitingMode = false
		});
		
		$$("input.moduleKey").each(function(e) {
			if ("input" == e.nodeName.toLowerCase() && true == e.checked) {
				d.selectedModule = e.value;
				$("step1WizardForm").show();
				
				el = e;
				do {
					if (true == Element.hasClassName(el, "moduleBlock")) {
						el.addClassName("selModule");
						break
					}
				} while 
				(el = el.parentNode)
			}
			if (true == TOUCHABLE) {
				Event.observe(e, "touchend", d._selectModule.bindAsEventListener(d));
				Event.observe(e.parentNode, "touchend", d._selectModule.bindAsEventListener(d))
			} else {
				Event.observe(e, "click", d._selectModule.bindAsEventListener(d));
				Event.observe(e.parentNode, "click", d._selectModule.bindAsEventListener(d))
			}
		});
		
		Event.observe(window, "load", this.run.bindAsEventListener(this));
		if (false == this.waitingMode) {
			this.nextButton = $("nextButton");
			if (this.nextButton) {
				if (true == TOUCHABLE) {
					Event.observe(this.nextButton, "touchend", this.process.bindAsEventListener(this))
				} else {
					Event.observe(this.nextButton, "click", this.process.bindAsEventListener(this))
				}
			}
			this.recentHash = this.hashPrefix + this.step;
			document.location.hash = this.recentHash;
			this.checkHashTimer = setInterval(this._checkHash.bind(this), 500);
			var c = new Element("div", {
				"class": "moduleIcon"
			});
			
			c.appendChild(new Element("i", {
				"class": "unitPng"
			}));
			$("step3ContactForm").appendChild(c);
			$("step3PagesInfo").appendChild(new Element("div", {
				"class": "cleaner"
			}));
			var c = new Element("div", {
				"class": "moduleIcon"
			});
			
			c.appendChild(new Element("i", {
				"class": "unitPng"
			}));
			$("step3PagesInfo").appendChild(c);
			this.nextButtonEl = $("nextButton");
			var a = $("project_nameRow").getElementsByTagName("label");
			if (null != a[0]) {
				var b = a[0].getElementsByTagName("strong");
				if (null != b[0]) {
					this.projectLabelEl = b[0]
				} else {
					this.projectLabelEl = a[0]
				}
			}
		}
		return false
	},
	
	run: function() {
		this.isWizard = true;
		if (true == this.waitingMode) {
			this._showWaiting();
			
			this._verify()
		} else {
			var a = this;
			if (null != $("step3Description")) {
				$("step3Description").childElements().each(function(b) {
					if ("h2" == b.nodeName.toLowerCase()) {
						a.step3title = b
					} else {
						if ("div" == b.nodeName.toLowerCase()) {
							a.step3desc = b
						}
					}
				})
			}
			if (null == this.moduleTypeErrorEl) {
				this.moduleTypeErrorEl = $("modulesSelectErrorMsg")
			}
			if (this.selectedModule) {
				Metrics.set("project_is_predefined", 1);
				Metrics.set("project_type", this.selectedModule)
			}
			this._setupForModule()
		}
	},
	
	setPortalWizard: function(a) {
		this.isPortalWizard = a
	},
	
	// ham xu li day ne
	process: function() {
		if (this.step == this.lastStep) {
			if (true == this.isSent) {
				return
			}
			//_gaq.push(["_trackPageview", "/webnodeadmin/events/wizard/finishWizard"]);
			if (true == this._validate()) {
				this._showWaiting();
				
				var a = MetricsUtil.getTime();
				
				Metrics.set("wizard_step3_endtime", a);
				Metrics.set("wizard_step3_diff", MetricsUtil.diff(Metrics.get("wizard_step3_starttime"), a));
				if (true == this.isPortalWizard) {
					this._check()
				} else {
					this._send()
				}
			}
		} else {
			this.next()
		}
		return false
	},
	
	next: function() {
		////_gaq.push(["_trackPageview", "/webnodeadmin/events/wizard/goStep/" + this.step]);
		if (true == this._validate()) {
			var e = "wizard_step" + this.step;
			var b = MetricsUtil.getTime();
			
			Metrics.set(e + "_endtime", b);
			Metrics.set(e + "_diff", MetricsUtil.diff(Metrics.get(e + "_starttime"), b));
			if (1 == this.step) {
				Metrics.set("wizard_step1_details_filled", 0);
				var a = $("step1BaseInfoBlockContent").getElementsByTagName("input");
				var d = a.length;
				for (var c = 0; c < d; c++) {
					if (a[c].value != "" && a[c].id != "languageText") {
						Metrics.increase("wizard_step1_details_filled")
					}
				}
			}
			this._showStep(this.step + 1);
			if (2 == this.step) {
				Metrics.set("wizard_step2_template_changes", 0);
				Metrics.set("wizard_step2_listings", 0)
			} else {
				if (3 == this.step) {
					Metrics.set("wizard_step3_checkboxes_click", 0)
				}
			}
			Metrics.set("wizard_step" + this.step + "_starttime", MetricsUtil.getTime())
		}
		return false
	},
	
	previous: function() {
		////_gaq.push(["_trackPageview", "/webnodeadmin/events/wizard/goStep/" + this.step]);
		this._showStep(this.step - 1);
		return false
	},
	
	_checkHash: function() {
		var a = document.location.hash.substr(1);
		if (a != this.recentHash) {
			if (a < this.recentHash || (a > this.recentHash && true == this._validate())) {
				this._showStep(a.replace(this.hashPrefix, ""))
			} else {
				document.location.hash = this.recentHash
			}
		}
		return false
	},
	
	_showStep: function(e) {
		if (0 >= e) {
			e = 1
		}
		if (null != $(this.stepAreaPrefix + e)) {
			if (null != $(this.stepAreaPrefix + this.step)) {
				$(this.stepAreaPrefix + this.step).removeClassName("selectedStep")
			}
			if (null != $(this.infoPrefix + this.step)) {
				$(this.infoPrefix + this.step).removeClassName("actual")
			}
			if (this.step < e) {
				$(this.infoPrefix + this.step).addClassName("hand");
				$(this.infoPrefix + this.step).observe("click", function() {
					Wizard._showStep(this.id.replace(Wizard.infoPrefix, ""))
				});
				
				$(this.infoPrefix + this.step).observe("mouseover", function() {
					this.addClassName("hover");
					if ("function" == typeof(Cufon) && true == Cufon.initialized) {
						Cufon.replace("#" + this.id + " h3")
					}
				});
				
				$(this.infoPrefix + this.step).observe("mouseout", function() {
					this.removeClassName("hover");
					if ("function" == typeof(Cufon) && true == Cufon.initialized) {
						Cufon.replace("#" + this.id + " h3")
					}
				});
				
				this.infoLink = this.step
			} else {
				for (var b = this.infoLink; b > (e - 1); b--) {
					$(this.infoPrefix + b).removeClassName("hand");
					$(this.infoPrefix + b).stopObserving("click");
					$(this.infoPrefix + b).stopObserving("mouseover");
					$(this.infoPrefix + b).stopObserving("mouseout")
				}
			}
			this.step = parseInt(e, 10);
			$(this.infoPrefix + this.step).addClassName("actual");
			if ("function" == typeof(Cufon) && true == Cufon.initialized) {
				//Cufon.replace("." + this.infoPrefix + " h3")
			}
			$(this.stepAreaPrefix + this.step).addClassName("selectedStep");
			$(this.stepAreaPrefix + this.step).scrollTo();
			
			this.recentHash = this.hashPrefix + this.step;
			document.location.hash = this.recentHash;
			if (2 == this.step) {
				if (MODULE_BRANCH == this.selectedModule) {
					var d = Forms.getValue(BranchTypes.baseId);
					Metrics.set("wizard_step1_branch_type", BranchTypes.selectedItem);
					if (Layouts.hasLayoutsForGroup(d)) {
						Layouts.run(d)
					} else {
						Layouts.run(MODULE_WEB)
					}
				} else {
					Layouts.run(this.selectedModule)
				}
				Layouts.registerTouch()
			}
			if (3 == this.step) {
				Layouts.unRegisterTouch();
				
				$("step3WizardForm").addClassName(this.selectedModule);
				if (MODULE_BRANCH == this.selectedModule || MODULE_ESHOP == this.selectedModule) {
					var a = ["step3ContactForm"];
					var c = ["step3PagesInfo"];
					this.step3title.update(RS_CFG.labels["wizardPage"]["contactFormTitle"]);
					this.step3desc.update(RS_CFG.labels["wizardPage"]["contactFormDesc"]);
					if (MODULE_ESHOP == this.selectedModule) {
						a.push("currency_idRow");
						a.push("taxesRow")
					} else {
						c.push("currency_idRow");
						c.push("taxesRow")
					}
					Forms.toggleBlock(a, true);
					Forms.toggleBlock(c, false)
				} else {
					$("step3PagesInfo").show();
					
					$("step3ContactForm").hide();
					
					this.step3title.update(CFG.defaultContent["labels"]["customPagesGroups"]["general"]["title"]);
					this.step3desc.update(RS_CFG.labels["wizardPage"]["customPagesDesc"])
				}
				if ("" == Forms.getValue("contact_name")) {
					Forms.setValue("contact_name", Forms.getValue("project_name"))
				}
				Pages.run();
				
				if (MODULE_ESHOP == this.selectedModule) {
					$("page_termsConditions").checked = true
				}
				this.nextButtonEl.update("<b>" + RS_CFG.labels["wizardPage"]["finish"] + "</b>");
				if ("function" == typeof(Cufon) && true == Cufon.initialized) {
					Cufon.replace(["#step3Description h2", "#nextButton"])
				}
				this.isButtonAsFinish = true
			} else {
				if (true == this.isButtonAsFinish) {
					this.nextButtonEl.update("<b>" + CFG.labels["wizardPage"]["continue"] + "</b>");
					if ("function" == typeof(Cufon) && true == Cufon.initialized) {
						Cufon.replace("#next")
					}
					this.isButtonAsFinish = false
				}
			}
			if ("function" == typeof(pngfix)) {
				pngfix()
			}
		}
	},
	
	_validate: function() {
		var b = this;
		Forms.hideHint(true);
		this._loadValidationRules();
		
		try {
			Object.keys(this.validationRules).each(function(c) {
				var d = b.validationRules[c];
				if (b.step >= d.step && (!d.module || b.selectedModule == d.module)) {
					if ("moduleType" == c) {
						if (null == Wizard.selectedModule) {
							b._showError(c);
							throw a
						}
					} else {
						if ("layout" == c) {
							if (null == Layouts.selectedLayoutID) {
								b._showError(c);
								throw a
							}
						} else {
							if (d.regexp && null == Forms.getValue(c).match(d.regexp)) {
								b._showError(c);
								throw a
							}
						}
					}
				}
			})
		} catch (a) {
			return false
		}
		return true
	},
	
	_loadValidationRules: function() {
		this.validationRules = {
			moduleType: {
				regexp: /^(.+)/,
				error: CFG.labels["wizardPage"]["selectModuleError"],
				step: 1
			},
			
			project_name: {
				regexp: /^(.+)/,
				error: CFG.langMetadata["columns"]["projects.project_name"]["error"],
				step: 1
			},
			
			language: {
				regexp: /^(.+)/,
				error: CFG.langMetadata["columns"]["projects.language"]["error"],
				step: 1
			},
			
			branch_type: {
				regexp: /^(.+)/,
				error: CFG.labels["wizardPage"]["selectBranchError"].replace("{SELECT_ALL_BRANCH_TYPE}", ' onclick="BranchTypes.openWindow();return false;"'),
				step: 1,
				module: MODULE_BRANCH
			},
			
			layout: {
				regexp: /^(.+)/,
				error: RS_CFG.labels["error"]["wizardNonLayout"],
				step: 2
			},
			
			contact_name: {
				regexp: /^(.+)/,
				error: CFG.labels["wizardPage"]["contactNameError"],
				step: 3,
				module: MODULE_BRANCH
			}
		}
	},
	
	_showError: function(a) {
		if ("" != this.validationRules[a].error) {
			if ("moduleType" == a) {
				this.moduleTypeErrorEl.update(this.validationRules[a].error);
				this.moduleTypeErrorEl.show();
				
				this.moduleTypeErrorEl.scrollTo()
			} else {
				if ("layout" == a) {
					Layouts.layoutsErrorEl.update(this.validationRules[a].error);
					Layouts.layoutsErrorEl.show();
					
					Layouts.layoutsErrorEl.scrollTo()
				} else {
					var b = $(a + "Row");
					if (null != b) {
						Forms.createAlertHint(b, a + "Error", this.validationRules[a].error)
					}
					if ("branch_type" == a) {
						Metrics.set("wizard_step1_branch_error", 1)
					}
				}
			}
		}
		return false
	},
	
	_selectModule: function(b) {
		var a = Event.element(b);
		do {
			if (true == Element.hasClassName(a, "moduleBlock")) {
				var c = this;
				if (null != $("moduleArea" + this.selectedModule)) {
					$("moduleArea" + this.selectedModule).removeClassName("selModule")
				}
				Element.childElements(a).each(function(d) {
					if ("input" == d.nodeName.toLowerCase()) {
						d.checked = true;
						c.selectedModule = d.value;
						$("step1WizardForm").show()
					}
				});
				
				a.addClassName("selModule");
				this._setupForModule();
				
				Metrics.set("project_type", this.selectedModule);
				if ("branch" != this.selectedModule) {
					Metrics.set("wizard_step1_branch_type", "");
					Metrics.set("wizard_step1_branch_error", "")
				}
				break;
				return true
			}
		} while 
		(a = a.parentNode);
		Event.stop(b);
		return false
	},
	
	_setupForModule: function() {
//		if (null != this.moduleTypeErrorEl) {
//			this.moduleTypeErrorEl.update();
//			
//			this.moduleTypeErrorEl.hide()
//		}
//		if ("undefined" != typeof(CFG) && CFG.labels["wizardPage"]["projectNameLabel"][this.selectedModule]) {
//			this.projectLabelEl.innerHTML = CFG.labels["wizardPage"]["projectNameLabel"][this.selectedModule]
//		}
//		if (MODULE_WEB == this.selectedModule) {
//			this.formRowsEl.languageRow.show();
//			
//			this.formRowsEl.branch_typeRow.hide()
//		} else {
//			if (MODULE_BRANCH == this.selectedModule) {
//				this.formRowsEl.branch_typeRow.show();
//				
//				BranchTypes.correctWindowLink();
//				
//				this.formRowsEl.languageRow.hide();
//				
//				Languages.setBoxValue(Languages.defaultValue)
//			} else {
//				if (MODULE_ESHOP == this.selectedModule) {
//					this.formRowsEl.languageRow.show();
//					
//					this.formRowsEl.branch_typeRow.hide()
//				}
//			}
//		}
//		if ("undefined" != typeof(Layouts) && 1 === this.step) {
//			Layouts.reset()
//		}
//		if ("undefined" != typeof(BranchTypes) && (MODULE_BRANCH != this.selectedModule)) {
//			BranchTypes.reset()
//		}
	},
	
	_showWaiting: function() {
		if ($("loadingInfo")) {
			return null
		}
		document.body.setStyle({
			overflow: "hidden"
		});
		
		if (null != $("leftColumn")) {
			$("leftColumn").hide()
		}
		if (null != $("rightContent")) {
			$("rightContent").hide()
		}
		$("content").appendChild(new Element("div", {
			id: "loadingInfo"
		}).update(RS_CFG.labels["wizard"]["pleaseWaitInfo"]));
		Flash.writeLoadingFlash("loadingInfo");
		if ("function" == typeof(Cufon) && true == Cufon.initialized) {
			Cufon.replace(["#loadingInfo h2", "#next"])
		}
		return false
	},
	
	_send: function() {
		this.isSent = true;
		var f = this;
		Object.keys(this.formRowsEl).each(function(l) {
			var j = f.formRowsEl[l].getElementsByTagName("input");
			var m = j.length;
			if (0 < m) {
				for (var k = 0; k < m; k++) {
					if (j[k].name == l.replace(/Row/, "")) {
						if (("radio" == j[k].type && false == j[k].checked)) {
							continue
						}
						f.data[j[k].name] = j[k].value;
						break
					}
				}
			}
			var g = f.formRowsEl[l].getElementsByTagName("select");
			var h = g.length;
			if (0 < h) {
				for (var k = 0; k < h; k++) {
					if (g[k].name == l.replace(/Row/, "")) {
						f.data[g[k].name] = g[k].value;
						break
					}
				}
			}
		});
		
		var b = $("step3ContactFormBlockContent").getElementsByTagName("input");
		var e = b.length;
		for (var c = 0; c < e; c++) {
			if (b[c].value != "") {
				Metrics.increase("wizard_step3_details_filled")
			}
		}
		this.data.country_id = this.data.contact_country;
		this.data.moduleType = Wizard.selectedModule;
		this.data.layout = Layouts.selectedLayoutID;
		this.data.email = Forms.getValue("contact_email");
		this.data.socialNetworking = 1;
		this.data.pages = new Array();
		
		
		
		$$("input.pageSelector").each(function(h) {
			if (true == h.checked) {
				var g = h.name;
				if (MODULE_BRANCH == f.selectedModule) {
					g = g.replace(MODULE_BRANCH, BranchTypes.selectedItem)
				}
				f.data.pages[g] = g;
				Metrics.increase("wizard_step3_checkboxes_filled")
			}
		});
		
		if (BranchTypes.otherItemId === BranchTypes.selectedItem && BranchTypes.textEl.value !== BranchTypes.data[BranchTypes.selectedItem]) {
			this.data.branch_type_by_user = BranchTypes.textEl.value
		}
		Metrics.set("wizard_total_diff", MetricsUtil.diff(Metrics.get("wizard_step1_starttime"), Metrics.get("wizard_step3_endtime")));
		var d = new PHP_Serializer(true);
		var a = d.serialize(this.data);
		a = encodeURIComponent(a);
		//a = a.replace(/&/, "%28");
		//a = a.replace(/=/, "%61");
		a = "wizard=" + a + Metrics._getSendParams();
		
       
		//alert(a); //return 0;
		alert(this.sendUrl);//return 0;
		
		new Ajax.Request(this.sendUrl.replace(/\#step[0-9]/i, ""), {
			method: "post",
			parameters: a,
			onSuccess: function(g) {
				
				alert(g); return 0;
				
//				if (g.responseText.match(/result:1/)) {
//					Metrics.isSent = true
//				} else {
//					if (g.responseText.match(/result:reload/)) {
//						Metrics.isSent = false;
//						document.location.href = Wizard.selfUrl.replace(/\#step[0-9]/i, "");
//						return
//					}
//				}
//				document.location.href = RS_CFG.urlGuidepost
			}
		});
		
		return false
	},
	
	_check: function() {
		GAd.run();
		
		new Ajax.Request(this.checkUrl.replace(/\#step[0-9]/i, ""), {
			method: "get",
			onSuccess: function(a) {
				if (a.responseText.match(/project_status:ACTIVE/)) {
					clearTimeout(Wizard.timer);
					Wizard._send()
				} else {
					Wizard.timer = setTimeout(Wizard._check.bind(Wizard), Wizard.timeLimit)
				}
			}
		});
		
		return false
	},
	
	_verify: function() {
		new Ajax.Request(this.verifyUrl.replace(/\#step[0-9]/i, ""), {
			method: "get",
			onSuccess: function(a) {
				if (a.responseText.match(/verify_status:1/)) {
					clearTimeout(Wizard.timer);
					document.location.reload()
				} else {
					Wizard.timer = setTimeout(Wizard._verify.bind(Wizard), Wizard.timeLimit)
				}
			}
		});
		
		return false
	}
};

var Wizard = new WizardClass();

var GAdClass = Class.create();

GAdClass.prototype = {
	data: new Array(),
	imgUrl: "http://www.googleadservices.com/pagead/conversion/1017518698/?label={GCL}&guid=ON&script=0",
	initialize: function() {
		this.data[MODULE_WEB] = "wVS2CObHywEQ6rSY5QM";
		this.data[MODULE_BRANCH] = "UwRZCN7IywEQ6rSY5QM";
		this.data[MODULE_ESHOP] = "g9ybCNbJywEQ6rSY5QM";
		this.data.__OTHER__ = "Ii6pCJaNzAEQ6rSY5QM";
		this.data.ACCOUNTANT_TAX_SERVICES = "r45PCI6OzAEQ6rSY5QM";
		this.data.ADVERTISING_AGENCY = "NhAvCIaPzAEQ6rSY5QM";
		this.data.AMUSEMENT_RECREATION = "DSQQCP6PzAEQ6rSY5QM";
		this.data.ANTIQUES_STORE = "1j-OCPaQzAEQ6rSY5QM";
		this.data.ARCHITECTURAL_FIRM = "1FwpCOaSzAEQ6rSY5QM";
		this.data.ARTIST_DESIGNER = "kTXzCN6TzAEQ6rSY5QM";
		this.data.AUTO_CAR_BODY_REPAIR_SHOP = "Vxq7CNaUzAEQ6rSY5QM";
		this.data.AUTO_CAR_DEALERSHIP = "1eVjCM6VzAEQ6rSY5QM";
		this.data.BAKERY_PASTRY_SHOP = "4ziFCMaWzAEQ6rSY5QM";
		this.data.BAND_CHOIR_MUSIC_CLUB = "j2RyCL6XzAEQ6rSY5QM";
		this.data.BEAUTY_HAIR_SALONS = "H2hjCLaYzAEQ6rSY5QM";
		this.data.BEAUTY_NAIL_SALONS = "xIG4CK6ZzAEQ6rSY5QM";
		this.data.BED_BREAKFAST = "LU5fCJ6bzAEQ6rSY5QM";
		this.data.BICYCLE_SHOP = "h2i3CJaczAEQ6rSY5QM";
		this.data.BOOKSTORE = "qsgeCI6dzAEQ6rSY5QM";
		this.data.CAFE_BAR = "vCfeCIaezAEQ6rSY5QM";
		this.data.CAR_SERVICE = "yYY0CP6ezAEQ6rSY5QM";
		this.data.CARPENTER_FRAMING_CONTRACTORS = "ZFADCPafzAEQ6rSY5QM";
		this.data.CASUAL_DINING = "0piiCO6gzAEQ6rSY5QM";
		this.data.CATERING_SERVICES = "lz_uCOahzAEQ6rSY5QM";
		this.data.CLEANING_SERVICES = "eRQLCN6izAEQ6rSY5QM";
		this.data.CLUBS_ASSOCIATIONS = "By9eCNajzAEQ6rSY5QM";
		this.data.COMPUTER_STORE = "xJfiCM6kzAEQ6rSY5QM";
		this.data.CONSULTING_GROUP = "eV3gCMalzAEQ6rSY5QM";
		this.data.CONTRACTORS = "7MMrCL6mzAEQ6rSY5QM";
		this.data.COURIER_SERVICES = "cGljCLanzAEQ6rSY5QM";
		this.data.DENTIST = "9YBxCK6ozAEQ6rSY5QM";
		this.data.DEVELOPER_CONSTRUCTION_COMPANY = "FQJ_CKapzAEQ6rSY5QM";
		this.data.DOCTOR = "6-zeCJ6qzAEQ6rSY5QM";
		this.data.DRIVING_SCHOOL = "JWC2CJarzAEQ6rSY5QM";
		this.data.ELECTRICIAN_ELECTRICAL_CONTRACTORS = "uN8rCI6szAEQ6rSY5QM";
		this.data.ELECTRONICS_ELECTRICAL_APPLIANCES = "I6U1CIatzAEQ6rSY5QM";
		this.data.EVENT_PLANNING = "_-hACP6tzAEQ6rSY5QM";
		this.data.FAITH_BASED_ORGANIZATIONS = "D1xgCPauzAEQ6rSY5QM";
		this.data.FARMERS_MARKETS = "YuBTCO6vzAEQ6rSY5QM";
		this.data.FASHION_CLOTHING_STORE = "iVLiCOawzAEQ6rSY5QM";
		this.data.FLORIST_FLOWER_SHOP = "KQ3hCN6xzAEQ6rSY5QM";
		this.data.FUNERAL_HOMES = "PfMHCNayzAEQ6rSY5QM";
		this.data.FURNITURE_STORE = "8cSkCM6zzAEQ6rSY5QM";
		this.data.GARDENING_LANDSCAPING = "jYewCMa0zAEQ6rSY5QM";
		this.data.GENERAL_MANUFACTURING = "185mCL61zAEQ6rSY5QM";
		this.data.GENERIC_BUSINESS_TYPE = "1YCACLa2zAEQ6rSY5QM";
		this.data.GLASS_AND_GLAZING_CONTRACTORS = "xmw4CK63zAEQ6rSY5QM";
		this.data.GOODS_TRANSPORTION_HAULING = "CqGsCKa4zAEQ6rSY5QM";
		this.data.GROCER_GROCERY = "eHVECJ65zAEQ6rSY5QM";
		this.data.GYM_FITNESS_SPORTS_CENTERS = "OOsyCJa6zAEQ6rSY5QM";
		this.data.HARDWARE_STORES = "SR6vCI67zAEQ6rSY5QM";
		this.data.HOME_DECOR_ACCESSORIES = "f9bjCIa8zAEQ6rSY5QM";
		this.data.HOME_IMPROVEMENT_BUILDING_SUPPLIES = "3bp_CP68zAEQ6rSY5QM";
		this.data.HOTEL = "spLiCPa9zAEQ6rSY5QM";
		this.data.HVAC_SERVICES = "ZnUgCO6-zAEQ6rSY5QM";
		this.data.CHILDCARE = "RUTVCOa_zAEQ6rSY5QM";
		this.data.CHIROPRACTOR_OSTEOPATH = "3FFBCN7AzAEQ6rSY5QM";
		this.data.INSURANCE_SERVICES = "I-xjCNbBzAEQ6rSY5QM";
		this.data.INTERIOR_DESIGN_RENOVATIONS = "U3TxCM7CzAEQ6rSY5QM";
		this.data.INVESTMENT_ADVISER = "qVsTCMbDzAEQ6rSY5QM";
		this.data.IT_CONSULTING_SERVICES = "pjwACL7EzAEQ6rSY5QM";
		this.data.JEWELER = "Q8YTCLbFzAEQ6rSY5QM";
		this.data.LAUNDRY_CLEANING_IRONING_SERVICES = "sqVeCK7GzAEQ6rSY5QM";
		this.data.LAW_OFFICE_NOTARY = "OihACKbHzAEQ6rSY5QM";
		this.data.LIBRARY = "54CnCJ7IzAEQ6rSY5QM";
		this.data.LOCKSMITH = "vq_5CJbJzAEQ6rSY5QM";
		this.data.MOTORCYCLE_SHOP = "YRcgCI7KzAEQ6rSY5QM";
		this.data.MOVING_STORAGE_SERVICES = "z8KLCIbLzAEQ6rSY5QM";
		this.data.NIGHTCLUB_DISCO = "ejniCP7LzAEQ6rSY5QM";
		this.data.NON_PROFIT_ORGANIZATIONS = "DFg-CPbMzAEQ6rSY5QM";
		this.data.OPTICIAN = "CkU9CO7NzAEQ6rSY5QM";
		this.data.OTHER_ARTS_CULTURE = "kIjjCObOzAEQ6rSY5QM";
		this.data.OTHER_BUILDING_HOUSING_SERVICES = "9rqnCN7PzAEQ6rSY5QM";
		this.data.OTHER_BUSINESS_SERVICES = "vyMPCNbQzAEQ6rSY5QM";
		this.data.OTHER_EDUCATIONAL_SERVICES = "kKWtCM7RzAEQ6rSY5QM";
		this.data.OTHER_FOOD_SERVICES = "8GwuCMbSzAEQ6rSY5QM";
		this.data.OTHER_HEALTH_SERVICES = "Lij1CL7TzAEQ6rSY5QM";
		this.data.OTHER_PERSONAL_SERVICES = "wR4SCLbUzAEQ6rSY5QM";
		this.data.OTHER_RETAIL_SHOPS = "QdhkCK7VzAEQ6rSY5QM";
		this.data.OTHER_TOURISM_SERVICES = "M1qHCKbWzAEQ6rSY5QM";
		this.data.OTHER_TRADES = "ejlNCJ7XzAEQ6rSY5QM";
		this.data.OTHER_TRANSPORTATION = "M3g7CJbYzAEQ6rSY5QM";
		this.data.OTHER_VEHICLES = "z2UmCI7ZzAEQ6rSY5QM";
		this.data.PAINTER_PAPERHANGER = "5bR6CIbazAEQ6rSY5QM";
		this.data.PET_CARE = "0Y4ZCP7azAEQ6rSY5QM";
		this.data.PHARMACY = "zsFgCPbbzAEQ6rSY5QM";
		this.data.PHOTOGRAPHY = "IDs7CO7czAEQ6rSY5QM";
		this.data.PHYSIOTHERAPIST_MASSEUSE = "JDWsCObdzAEQ6rSY5QM";
		this.data.PLUMBER = "Hf1zCN7ezAEQ6rSY5QM";
		this.data.PR_MARKETING = "nUwqCNbfzAEQ6rSY5QM";
		this.data.PRINTING_SERVICES = "ZCB-CM7gzAEQ6rSY5QM";
		this.data.REAL_ESTATE = "BwSECMbhzAEQ6rSY5QM";
		this.data.RESTAURANT = "qB15CL7izAEQ6rSY5QM";
		this.data.RETIREMENT_HOMES = "AAf_CLbjzAEQ6rSY5QM";
		this.data.ROOFER = "M00_CK7kzAEQ6rSY5QM";
		this.data.SHOE_STORE = "xDh1CKblzAEQ6rSY5QM";
		this.data.SCHOOL_COLLEGE = "bpwrCJ7mzAEQ6rSY5QM";
		this.data.SPA_BEAUTY = "G-2HCJbnzAEQ6rSY5QM";
		this.data.SPORTS_CLUBS = "dGAACI7ozAEQ6rSY5QM";
		this.data.SPORTS_OUTDOOR = "en8aCIbpzAEQ6rSY5QM";
		this.data.STATIONERY = "98g7CP7pzAEQ6rSY5QM";
		this.data.TAILORING = "2teRCPbqzAEQ6rSY5QM";
		this.data.TAXI_LIMO = "qlaQCO7rzAEQ6rSY5QM";
		this.data.TOY_STORE = "_7tgCObszAEQ6rSY5QM";
		this.data.TRAVEL = "zIvXCN7tzAEQ6rSY5QM";
		this.data.VACATION_RENTALS = "fpLOCNbuzAEQ6rSY5QM";
		this.data.VETERINARIANS = "VUm3CM7vzAEQ6rSY5QM"
	},
	
	run: function() {
		document.body.appendChild(new Element("img", {
			src: this.imgUrl.replace(/{GCL}/, this.data[Wizard.selectedModule]),
			height: 1,
			width: 1,
			alt: "",
			border: 0
		}));
		if (MODULE_BRANCH == Wizard.selectedModule && null != this.data[BranchTypes.selectedItem]) {
			document.body.appendChild(new Element("img", {
				src: this.imgUrl.replace(/{GCL}/, this.data[BranchTypes.selectedItem]),
				height: 1,
				width: 1,
				alt: "",
				border: 0
			}))
		}
	}
};

var GAd = new GAdClass();

var LayoutsClass = Class.create();

LayoutsClass.prototype = {
	data: new Object(),
	groupIdentifier: null,
	layoutsToView: new Array(),
	groupsLayouts: new Array(),
	shuffleGroups: new Array(),
	layoutsAreaEl: null,
	layoutsInList: 8,
	layoutsPage: 0,
	previewLink: null,
	layoutsToolsEl: null,
	layoutsErrorEl: null,
	layoutsGroupsEl: null,
	layoutsGroupsCreated: false,
	layoutsPagingEl: null,
	layoutInputEl: null,
	selectedLayoutID: null,
	maxPages: 5,
	bottomRange: 0,
	topRange: 0,
	showPages: 0,
	showPremium: new Array(),
	initialize: function() {
		this.showPremium.web = 0;
		this.showPremium.branch = 1;
		this.showPremium.eshop = 1
	},
	
	run: function(f) {
		if (f == this.groupIdentifier) {
			return false
		}
		this.groupIdentifier = f;
		if (true == this.hasLayoutsForGroup(f)) {
			var d = this;
			this.data.typesItems[f].each(function(e) {
				if ("undefined" != typeof d.data.items["layoutId" + e] && parseInt(d.data.items["layoutId" + e].premium, 10) <= d.showPremium[d.data.items["layoutId" + e].module]) {
					d.layoutsToView.push(e);
					if ("undefined" == typeof d.groupsLayouts[d.data.basicGroupsItems[e]]) {
						d.groupsLayouts[d.data.basicGroupsItems[e]] = []
					}
					d.groupsLayouts[d.data.basicGroupsItems[e]].push(e);
					if (-1 == d.shuffleGroups.indexOf(d.data.basicGroupsItems[e])) {
						d.shuffleGroups.push(d.data.basicGroupsItems[e])
					}
				}
			});
			
			try {
				this.layoutsToView = this.shuffleLayouts(this.layoutsToView)
			} catch (c) {}
			if (MODULE_BRANCH == Wizard.selectedModule) {
				var a = new Array();
				
				Object.keys(this.data.items).each(function(e) {
					var g = parseInt(e.replace(/layoutId/, ""), 10);
					if (-1 == d.layoutsToView.indexOf(g) && "eshop" != d.data.items[e].module) {
						a.push(g);
						if ("undefined" == typeof d.groupsLayouts[d.data.basicGroupsItems[g]]) {
							d.groupsLayouts[d.data.basicGroupsItems[g]] = []
						}
						d.groupsLayouts[d.data.basicGroupsItems[g]].push(g);
						if (-1 == d.shuffleGroups.indexOf(d.data.basicGroupsItems[g])) {
							d.shuffleGroups.push(d.data.basicGroupsItems[g])
						}
					}
				});
				
				try {
					a = this.shuffleLayouts(a)
				} catch (c) {}
				var b = this.layoutsToView.splice(0, 4);
				b = b.concat(a.splice(0, 4));
				b = b.concat(this.layoutsToView);
				b = b.concat(a);
				this.layoutsToView = b
			}
			if (null == this.layoutsAreaEl) {
				this.layoutsAreaEl = $("layoutsList")
			}
			if (null == this.layoutsToolsEl) {
				this.layoutsToolsEl = $("layoutsTools");
				this.layoutsPagingEl = new Element("div", {
					id: "layoutsPaging"
				});
				
				this.layoutsToolsEl.appendChild(this.layoutsPagingEl);
				this.layoutsToolsEl.appendChild(new Element("div", {
					"class": "cleaner"
				}))
			}
			if (null == this.layoutsErrorEl) {
				this.layoutsErrorEl = $("layoutsErrorMsg");
				this.layoutsErrorEl.hide()
			}
			if (null == this.layoutInputEl) {
				this.layoutInputEl = new Element("input", {
					type: "hidden",
					value: "",
					id: "selectedLayout",
					name: "layout"
				});
				
				this.layoutsAreaEl.appendChild(this.layoutInputEl)
			}
			this._drawItems()
		}
	},
	
	shuffleLayouts: function(h) {
		this.shuffleGroups.reverse();
		
		var l = new Array();
		
		var c = new Array();
		
		var f = 0;
		while (h.length > 0) {
			var a = h.length;
			var b = (this.shuffleGroups.length - 1);
			var m = this.layoutsInList;
			if (m < l.length || m > b) {
				m = b
			}
			var e = Math.round(Math.random() * m);
			var d = this.shuffleGroups[e];
			if (-1 < c.indexOf(d) && a > b) {
				continue
			}
			c.push(d);
			var g = Math.round(Math.random() * this.groupsLayouts[d].length - 1);
			var j = this.groupsLayouts[d].splice(g, 1)[0];
			var k = h.indexOf(j);
			l.push(h.splice(k, 1)[0]);
			if (0 == this.groupsLayouts[d].length) {
				this.shuffleGroups.splice(this.shuffleGroups.indexOf(d), 1)
			}
			if (this.layoutsInList < (c.length - 1)) {
				c.shift()
			}
			f++;
			if (f >= b) {
				c = [];
				f = 0
			}
		}
		this.shuffleGroups = new Array();
		
		this.groupsLayouts = new Array();
		
		return l
	},
	
	hasLayoutsForGroup: function(a) {
		if (this.data.typesItems && this.data.typesItems[a]) {
			return true
		}
		return false
	},
	
	reset: function() {
		this.selectedLayoutID = null;
		this.groupIdentifier = null;
		this.layoutsToView = new Array();
		
		this.groupsLayouts = new Array();
		
		this.shuffleGroups = new Array();
		
		this.layoutsPage = 0;
		this.bottomRange = 0;
		this.topRange = 0;
		this.showPages = 0;
		if (null != this.layoutsAreaEl) {
			this.layoutsAreaEl.innerHTML = ""
		}
		if (null != this.layoutsGroupsEl) {
			this.layoutsGroupsEl.hide()
		}
		if (null != this.layoutsPagingEl) {
			this.layoutsPagingEl.innerHTML = ""
		}
		if (null != this.layoutInputEl) {
			this.layoutInputEl.value = ""
		}
		return false
	},
	
	_drawItems: function() {
		if (!this.layoutsToView || (this.layoutsToView && 0 == this.layoutsToView.length) || !this.data.items || (this.data.items && 0 == this.data.items.length)) {
			return
		}
		this.layoutsAreaEl.innerHTML = "";
		var d = this.layoutsToView.length;
		var g = 0;
		var f = d;
		if (d > this.layoutsInList) {
			if (0 == this.layoutsPage) {
				g = 0;
				f = this.layoutsInList
			} else {
				g = parseInt(this.layoutsPage * this.layoutsInList, 10);
				f = parseInt(g + this.layoutsInList, 10);
				if (f > d) {
					f = d
				}
			}
		}
		for (var b = g; b < f; b++) {
			var e = this.data.items["layoutId" + this.layoutsToView[b]];
			var a = null;
			if (169 < e.preview.width) {
				a = "left: -" + parseInt((e.preview.width - 169) / 2, 10) + "px;"
			}
			var c = new Element("span", {
				"class": "layoutItem",
				id: "layoutItem" + e.id
			});
			
			c.appendChild(new Element("i", {
				"class": "lid"
			}).update("<!-- -->"));
			c.appendChild(new Element("img", {
				src: this.previewLink + e.preview.src,
				height: e.preview.height,
				width: e.preview.width,
				alt: "",
				border: "0",
				style: a
			}));
			c.appendChild(new Element("input", {
				id: "layout" + e.id,
				name: "layout",
				type: "radio",
				value: e.id,
				title: CFG.labels["wizardPage"]["selectTemplate"]
			}));
			c.appendChild(new Element("label", {
				"for": "layout" + e.id
			}).update(CFG.labels["wizardPage"]["selectTemplate"]));
			if (true == TOUCHABLE) {
				Event.observe(c, "touchend", function(h) {
					Layouts._selectLayout(this.id.replace(/layoutItem/, ""));
					Event.stop(h)
				})
			} else {
				Event.observe(c, "click", function() {
					Layouts._selectLayout(this.id.replace(/layoutItem/, ""))
				})
			}
			Event.observe(c, "dblclick", function() {
				Layouts._selectLayout(this.id.replace(/layoutItem/, ""));
				Wizard.next()
			});
			
			this.layoutsAreaEl.appendChild(c);
			if (this.selectedLayoutID == e.id) {
				this._selectLayout(e.id)
			}
		}
		this._drawPaging(d)
	},
	
	_selectLayout: function(a) {
		if (null != this.selectedLayoutID && null != $("layoutItem" + this.selectedLayoutID)) {
			$("layoutItem" + this.selectedLayoutID).removeClassName("selected")
		}
		this.selectedLayoutID = a;
		this.layoutInputEl.value = this.selectedLayoutID;
		$("layout" + a).checked = true;
		$("layoutItem" + a).addClassName("selected");
		this.layoutsErrorEl.update();
		
		this.layoutsErrorEl.hide();
		
		Metrics.increase("wizard_step2_template_changes");
		Metrics.set("wizard_step2_template_id", a);
		Metrics.set("current_template_id", a);
		return false
	},
	
	_drawPaging: function(b) {
		if (b > this.layoutsInList) {
			this.showPages = parseInt(b / this.layoutsInList, 10);
			var c = (this.showPages == this.layoutsPage ? true : false);
			if (b % this.layoutsInList) {
				this.showPages += 1
			} else {
				c = ((this.showPages - 1) == this.layoutsPage ? true : false)
			}
			this.layoutsPagingEl.innerHTML = "";
			if (0 < this.layoutsPage) {
				var a = new Element("a", {
					id: "nextPage" + (this.layoutsPage - 1),
					"class": "left",
					href: "#"
				}).update(RS_CFG.labels["previous"]);
				Event.observe(a, "click", function(e) {
					Layouts.getLayoutsPage(this.id.replace("nextPage", ""));
					Event.stop(e);
					return false
				});
				
				this.layoutsPagingEl.appendChild(a);
				a.appendChild(new Element("i"))
			}
			this._setPagingRange();
			
			for (var d = this.bottomRange; d < this.topRange; d++) {
				var a = new Element((d != this.layoutsPage ? "a" : "b"), {
					id: "layoutPage" + d,
					href: "#"
				}).update(d + 1);
				if (d != this.layoutsPage) {
					Event.observe(a, "click", function(e) {
						Layouts.getLayoutsPage(this.id.replace("layoutPage", ""));
						Event.stop(e);
						return false
					})
				}
				this.layoutsPagingEl.appendChild(a);
				a.appendChild(new Element("i"))
			}
			if (false == c) {
				var a = new Element("a", {
					id: "previousPage" + (this.layoutsPage + 1),
					"class": "right",
					href: "#"
				}).update(RS_CFG.labels["next"]);
				Event.observe(a, "click", function(e) {
					Layouts.getLayoutsPage(this.id.replace("previousPage", ""));
					Event.stop(e);
					return false
				});
				
				this.layoutsPagingEl.appendChild(a);
				a.appendChild(new Element("i"))
			}
		}
	},
	
	_setPagingRange: function() {
		if (this.layoutsPage <= Math.floor(this.maxPages / 2)) {
			this.bottomRange = 0;
			this.topRange = this.maxPages
		} else {
			this.bottomRange = this.layoutsPage - Math.floor(this.maxPages / 2);
			this.topRange = this.bottomRange + this.maxPages
		}
		if (this.topRange > this.showPages) {
			this.topRange = this.showPages;
			this.bottomRange = this.topRange - this.maxPages
		}
		if (this.bottomRange < 0) {
			this.bottomRange = 0
		}
	},
	
	getLayoutsPage: function(a) {
		a = parseInt(a, 10);
		if (a < 0 || a >= this.showPages) {
			return
		}
		this.layoutsPage = parseInt(a, 10);
		this._drawItems();
		
		Metrics.increase("wizard_step2_listings")
	},
	
	_touchXstart: null,
	_touchID: -1,
	registerTouch: function registerTouch() {
		if (true == TOUCHABLE) {
			this._onTouchStartFx = this._onTouchStart.bindAsEventListener(this);
			this._onTouchMoveFx = this._onTouchMove.bindAsEventListener(this);
			Event.observe(this.layoutsAreaEl, "touchstart", this._onTouchStartFx);
			Event.observe(this.layoutsAreaEl, "touchmove", this._onTouchMoveFx)
		}
	},
	
	unRegisterTouch: function unRegisterTouch() {
		if (true == TOUCHABLE) {
			Event.stopObserving(this.layoutsAreaEl, "touchstart", this._onTouchStartFx);
			Event.stopObserving(this.layoutsAreaEl, "touchmove", this._onTouchMoveFx)
		}
	},
	
	_onTouchStart: function onTouchStart(b) {
		for (var a = 0; a < b.changedTouches.length; a++) {
			var c = b.changedTouches[a];
			this._touchID = c.identifier;
			this._touchXstart = c.clientX
		}
	},
	
	_onTouchMove: function onTouchMove(b) {
		for (var a = 0; a < b.changedTouches.length; a++) {
			var c = b.changedTouches[a];
			if (this._touchID == c.identifier && null != this._touchXstart) {
				this._touchID = -1;
				if (this._touchXstart < c.clientX) {
					this.getLayoutsPage(this.layoutsPage - 1)
				} else {
					this.getLayoutsPage(this.layoutsPage + 1)
				}
				this._touchXstart = null;
				Event.stop(b);
				break
			}
		}
	}
};

var Layouts = new LayoutsClass();

var isIE = navigator.appVersion.match(/MSIE/) == "MSIE";
var WindowUtilities = {
	maxZIndex: 10,
	getWindowScroll: function() {
		var w = window;
		var T, L, W, H;
		with(w.document) {
			if (w.document.documentElement && documentElement.scrollTop) {
				T = documentElement.scrollTop;
				L = documentElement.scrollLeft
			} else {
				if (w.document.body) {
					T = body.scrollTop;
					L = body.scrollLeft
				}
			}
			if (w.innerWidth) {
				W = w.innerWidth;
				H = w.innerHeight
			} else {
				if (w.document.documentElement && documentElement.clientWidth) {
					W = documentElement.clientWidth;
					H = documentElement.clientHeight
				} else {
					W = body.offsetWidth;
					H = body.offsetHeight
				}
			}
		}
		return {
			top: T,
			left: L,
			width: W,
			height: H
		}
	},
	
	getPageSize: function() {
		var e, a;
		if (window.innerHeight && window.scrollMaxY) {
			e = document.body.scrollWidth;
			a = window.innerHeight + window.scrollMaxY
		} else {
			if (document.body.scrollHeight > document.body.offsetHeight) {
				e = document.body.scrollWidth;
				a = document.body.scrollHeight
			} else {
				e = document.body.offsetWidth;
				a = document.body.offsetHeight
			}
		}
		var c, f;
		if (self.innerHeight) {
			c = self.innerWidth;
			f = self.innerHeight
		} else {
			if (document.documentElement && document.documentElement.clientHeight) {
				c = document.documentElement.clientWidth;
				f = document.documentElement.clientHeight
			} else {
				if (document.body) {
					c = document.body.clientWidth;
					f = document.body.clientHeight
				}
			}
		}
		var d, b;
		if (a < f) {
			d = f
		} else {
			d = a
		}
		if (e < c) {
			b = c
		} else {
			b = e
		}
		return {
			pageWidth: b,
			pageHeight: d,
			windowWidth: c,
			windowHeight: f
		}
	},
	
	disableScreen: function(d, c, h) {
		WindowUtilities.initLightbox(c, d);
		var b = document.getElementsByTagName("body").item(0);
		var f = $(c);
		var a = WindowUtilities.getPageSize();
		
		if (h && isIE) {
			try {
				$$("select").each(function(e) {
					e.style.visibility = "hidden"
				});
				
				$$("#" + h + " select").each(function(e) {
					e.style.visibility = "visible"
				})
			} catch (g) {}
		}
		f.style.height = (a.pageHeight + "px");
		f.style.width = (a.windowWidth + "px");
		f.style.display = "block"
	},
	
	enableScreen: function(c) {
		c = c || "overlay_modal";
		var a = $(c);
		if (a) {
			a.style.display = "none";
			if (isIE) {
				try {
					$$("select").each(function(d) {
						d.style.visibility = "visible"
					})
				} catch (b) {}
			}
			a.parentNode.removeChild(a)
		}
	},
	
	initLightbox: function(d, b) {
		if ($(d)) {
			Element.setStyle(d, {
				zIndex: this.maxZIndex + 10
			})
		} else {
			var a = document.getElementsByTagName("body").item(0);
			var c = document.createElement("div");
			c.setAttribute("id", d);
			c.className = "overlay_" + b;
			c.style.display = "none";
			c.style.position = "absolute";
			c.style.top = "0";
			c.style.left = "0";
			c.style.zIndex = this.maxZIndex + 10;
			c.style.width = "100%";
			if (false == parent.showBodyOverflow) {
				a.parentNode.style.overflow = "hidden";
				a.style.overflow = "hidden"
			}
			a.insertBefore(c, a.firstChild)
		}
	},
	
	setCookie: function(b, a) {
		document.cookie = a[0] + "=" + escape(b) + ((a[1]) ? "; expires=" + a[1].toGMTString() : "") + ((a[2]) ? "; path=" + a[2] : "") + ((a[3]) ? "; domain=" + a[3] : "") + ((a[4]) ? "; secure" : "")
	},
	
	getCookie: function(c) {
		var b = document.cookie;
		var e = c + "=";
		var d = b.indexOf("; " + e);
		if (d == -1) {
			d = b.indexOf(e);
			if (d != 0) {
				return null
			}
		} else {
			d += 2
		}
		var a = document.cookie.indexOf(";", d);
		if (a == -1) {
			a = b.length
		}
		return unescape(b.substring(d + e.length, a))
	},
	
	_computeSize: function(e, h, d, a, f) {
		if (f == null) {
			f = 5
		}
		var c = document.getElementsByTagName("body").item(0);
		var g = document.createElement("div");
		g.setAttribute("id", h);
		if (a) {
			g.style.height = a + "px"
		} else {
			g.style.width = d + "px"
		}
		g.style.position = "absolute";
		g.style.top = "0";
		g.style.left = "0";
		g.style.display = "none";
		g.innerHTML = e;
		c.insertBefore(g, c.firstChild);
		var b;
		if (a) {
			b = $(h).getDimensions().width + f
		} else {
			b = $(h).getDimensions().height + f
		}
		c.removeChild(g);
		return b
	}
};

var RubicusStaticServers = {
	index: 0,
	servers: new Array(),
	skin: "default",
	fileToServerMap: new Array(),
	initialize: function() 
	{
		this.index = 0;
//		this.servers = RS_CFG.staticServers;
//		if (RS_CFG.skin) {
//			this.skin = RS_CFG.skin
//		} else {
			this.skin = "default"
//		}
	},
	
	getServer: function() {
		if (!this.servers || !this.servers.length) {
			return ""
		}
		var a = (this.index++) % this.servers.length;
		return this.servers[a]
	},
	
	getClientServer: function() {
		return this.getServer() + "_system/client/"
	},
	
	getSkinServer: function(b, a) {
		if (b) {
			if (!this.fileToServerMap[b]) {
				if (a && this.fileToServerMap.cssFileServer) {
					this.fileToServerMap[b] = this.fileToServerMap.cssFileServer
				} else {
					this.fileToServerMap[b] = this.getClientServer() + "skins/" + this.skin + "/"
				}
			}
			return this.fileToServerMap[b]
		} else {
			return this.getClientServer() + "skins/" + this.skin + "/"
		}
	},
	
	setCssSkinServer: function(a) {
		this.fileToServerMap.cssFileServer = a
	},
	
	resetIndex: function() {
		this.index = 0
	}
};

RubicusStaticServers.initialize();

var RubicusBasicTools = {
	createAssocArray: function(c) {
		var a = new Array();
		
		for (var b = 0; b < c.length; b++) {
			a[c[b][0]] = c[b][1]
		}
		return a
	}
};


function PHP_Serializer(UTF8) {
	function serialize(v) {
		var s;
		switch (v) {
			case null:
				s = "N;";
				break;
			default:
				s = this[this.__sc2s(v)] ? this[this.__sc2s(v)](v) : this[this.__sc2s(__o)](v);
				break
		}
		return s
	}
	function unserialize(s) {
		__c = 0;
		__s = s;
		return this[__s.substr(__c, 1)]()
	}
	function stringBytes(s) {
		return s.length
	}
	function stringBytesUTF8(s) {
		var c, b = 0,
			l = s.length;
		while (l) {
			c = s.charCodeAt(--l);
			b += (c < 128) ? 1 : ((c < 2048) ? 2 : ((c < 65536) ? 3 : 4))
		}
		return b
	}
	function __sc2s(v) {
		return v.constructor.toString()
	}
	function __sc2sKonqueror(v) {
		var f;
		switch (typeof(v)) {
			case ("string" || v instanceof String):
				f = "__sString";
				break;
			case ("number" || v instanceof Number):
				f = "__sNumber";
				break;
			case ("boolean" || v instanceof Boolean):
				f = "__sBoolean";
				break;
			case ("function" || v instanceof Function):
				f = "__sFunction";
				break;
			default:
				f = (v instanceof Array) ? "__sArray" : "__sObject";
				break
		}
		return f
	}
	function __sNConstructor(c) {
		return (c === "[function]" || c === "(Internal Function)")
	}
	function __sCommonAO(v) {
		var b, n, a = 0,
			s = [],
			value;
		for (b in v) {
			n = v[b] == null;
			value = "";
			value = (n ? "N;" : this[this.__sc2s(v[b])] ? this[this.__sc2s(v[b])](v[b]) : this[this.__sc2s(__o)](v[b]));
			if (!value) {
				value = "N;"
			}
			if (n || (v[b].constructor != Function)) {
				s[a] = [(!isNaN(b) && parseInt(b).toString() === b ? this.__sNumber(b) : this.__sString(b)), value].join("");
				++a
			}
		}
		return [a, s.join("")]
	}
	function __sBoolean(v) {
		return ["b:", (v ? "1" : "0"), ";"].join("")
	}
	function __sNumber(v) {
		var s = v.toString();
		
		return (s.indexOf(".") < 0 ? ["i:", s, ";"] : ["d:", s, ";"]).join("")
	}
	function __sString(v) {
		return ["s:", v.length, ':"', v, '";'].join("")
	}
	function __sStringUTF8(v) {
		return ["s:", this.stringBytes(v), ':"', v, '";'].join("")
	}
	function __sArray(v) {
		var s = this.__sCommonAO(v);
		return ["a:", s[0], ":{", s[1], "}"].join("")
	}
	function __sObject(v) {
		var o = this.__sc2s(v),
			n = o.substr(__n, (o.indexOf("(") - __n)),
			s = this.__sCommonAO(v);
		if (v.getClassName) {
			n = v.getClassName()
		}
		return ["O:", this.stringBytes(n), ':"', n, '":', s[0], ":{", s[1], "}"].join("")
	}
	function __sObjectIE7(v) {
		var o = this.__sc2s(v),
			n = o.substr(__n, (o.indexOf("(") - __n)),
			s = this.__sCommonAO(v);
		if (n.charAt(0) === " ") {
			n = n.substring(1)
		}
		if (v.getClassName) {
			n = v.getClassName()
		}
		return ["O:", this.stringBytes(n), ':"', n, '":', s[0], ":{", s[1], "}"].join("")
	}
	function __sObjectKonqueror(v) {
		var o = v.constructor.toString(),
			n = this.__sNConstructor(o) ? "Object" : o.substr(__n, (o.indexOf("(") - __n)),
			s = this.__sCommonAO(v);
		if (v.getClassName) {
			n = v.getClassName()
		}
		return ["O:", this.stringBytes(n), ':"', n, '":', s[0], ":{", s[1], "}"].join("")
	}
	function __sFunction(v) {
		return ""
	}
	function __uCommonAO(tmp) {
		var a, k;
		++__c;
		a = __s.indexOf(":", ++__c);
		k = parseInt(__s.substr(__c, (a - __c))) + 1;
		__c = a + 2;
		while (--k) {
			tmp[this[__s.substr(__c, 1)]()] = this[__s.substr(__c, 1)]()
		}
		return tmp
	}
	function __uBoolean() {
		var b = __s.substr((__c + 2), 1) === "1" ? true : false;
		__c += 4;
		return b
	}
	function __uNumber() {
		var sli = __s.indexOf(";", (__c + 1)) - 2,
			n = Number(__s.substr((__c + 2), (sli - __c)));
		__c = sli + 3;
		return n
	}
	function __uStringUTF8() {
		var c, sls, sli, vls, pos = 0;
		__c += 2;
		sls = __s.substr(__c, (__s.indexOf(":", __c) - __c));
		sli = parseInt(sls);
		vls = sls = __c + sls.length + 2;
		while (sli) {
			c = __s.charCodeAt(vls);
			pos += (c < 128) ? 1 : ((c < 2048) ? 2 : ((c < 65536) ? 3 : 4));
			++vls;
			if (pos === sli) {
				sli = 0
			}
		}
		pos = (vls - sls);
		__c = sls + pos + 2;
		return __s.substr(sls, pos)
	}
	function __uString() {
		var sls, sli;
		__c += 2;
		sls = __s.substr(__c, (__s.indexOf(":", __c) - __c));
		sli = parseInt(sls);
		sls = __c + sls.length + 2;
		__c = sls + sli + 2;
		return __s.substr(sls, sli)
	}
	function __uArray() {
		var a = this.__uCommonAO([]);
		++__c;
		return a
	}
	function __uObject() {
		var tmp = ["s", __s.substr(++__c, (__s.indexOf(":", (__c + 3)) - __c))].join(""),
			a = tmp.indexOf('"'),
			l = tmp.length - 2,
			o = tmp.substr((a + 1), (l - a));
		if (eval(["typeof(", o, ") === 'undefined'"].join(""))) {
			eval(["function ", o, "(){};"].join(""))
		}
		__c += l;
		eval(["tmp = this.__uCommonAO(new ", o, "());"].join(""));
		++__c;
		return tmp
	}
	function __uNull() {
		__c += 2;
		return null
	}
	function __constructorCutLength() {
		function ie7bugCheck() {}
		var o1 = new ie7bugCheck(),
			o2 = new Object(),
			c1 = __sc2s(o1),
			c2 = __sc2s(o2);
		if (c1.charAt(0) !== c2.charAt(0)) {
			__ie7 = true
		}
		return (__ie7 || c2.indexOf("(") !== 16) ? 9 : 10
	}
	var __c = 0,
		__ie7 = false,
		__b = __sNConstructor(__c.constructor.toString()),
		__n = __b ? 9 : __constructorCutLength(),
		__s = "",
		__a = [],
		__o = {},
		__f = function() {};
	
	PHP_Serializer.prototype.serialize = serialize;
	PHP_Serializer.prototype.unserialize = unserialize;
	PHP_Serializer.prototype.stringBytes = UTF8 ? stringBytesUTF8 : stringBytes;
	if (__b) {
		PHP_Serializer.prototype.__sc2s = __sc2sKonqueror;
		PHP_Serializer.prototype.__sNConstructor = __sNConstructor;
		PHP_Serializer.prototype.__sCommonAO = __sCommonAO;
		PHP_Serializer.prototype[__sc2sKonqueror(__b)] = __sBoolean;
		PHP_Serializer.prototype.__sNumber = PHP_Serializer.prototype[__sc2sKonqueror(__n)] = __sNumber;
		PHP_Serializer.prototype.__sString = PHP_Serializer.prototype[__sc2sKonqueror(__s)] = UTF8 ? __sStringUTF8 : __sString;
		PHP_Serializer.prototype[__sc2sKonqueror(__a)] = __sArray;
		PHP_Serializer.prototype[__sc2sKonqueror(__o)] = __sObjectKonqueror;
		PHP_Serializer.prototype[__sc2sKonqueror(__f)] = __sFunction
	} else {
		PHP_Serializer.prototype.__sc2s = __sc2s;
		PHP_Serializer.prototype.__sCommonAO = __sCommonAO;
		PHP_Serializer.prototype[__sc2s(__b)] = __sBoolean;
		PHP_Serializer.prototype.__sNumber = PHP_Serializer.prototype[__sc2s(__n)] = __sNumber;
		PHP_Serializer.prototype.__sString = PHP_Serializer.prototype[__sc2s(__s)] = UTF8 ? __sStringUTF8 : __sString;
		PHP_Serializer.prototype[__sc2s(__a)] = __sArray;
		PHP_Serializer.prototype[__sc2s(__o)] = __ie7 ? __sObjectIE7 : __sObject;
		PHP_Serializer.prototype[__sc2s(__f)] = __sFunction
	}
	PHP_Serializer.prototype.__uCommonAO = __uCommonAO;
	PHP_Serializer.prototype.b = __uBoolean;
	PHP_Serializer.prototype.i = PHP_Serializer.prototype.d = __uNumber;
	PHP_Serializer.prototype.s = UTF8 ? __uStringUTF8 : __uString;
	PHP_Serializer.prototype.a = __uArray;
	PHP_Serializer.prototype.O = __uObject;
	PHP_Serializer.prototype.N = __uNull
};
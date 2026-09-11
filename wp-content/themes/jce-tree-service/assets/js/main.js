/**
 * JCE Tree Service — front-end behavior.
 *
 * Deliberately tiny and dependency-free (no jQuery): the only thing the page
 * needs JavaScript for is the mobile nav. Everything else is CSS, so the site
 * renders and converts fine before this file finishes loading.
 */
(function () {
	'use strict';

	var toggle = document.querySelector('.nav-toggle');
	var nav = document.getElementById('primary-nav');

	if (!toggle || !nav) {
		return;
	}

	function setOpen(open) {
		toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		nav.classList.toggle('is-open', open);
	}

	toggle.addEventListener('click', function () {
		setOpen(toggle.getAttribute('aria-expanded') !== 'true');
	});

	// Close on Escape, and return focus to the button.
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
			setOpen(false);
			toggle.focus();
		}
	});

	// Close when a nav link is followed, so the menu isn't left open behind
	// an in-page anchor jump.
	nav.addEventListener('click', function (e) {
		if (e.target.closest('a')) {
			setOpen(false);
		}
	});

	// Reset state when resizing back up to the desktop layout.
	var desktop = window.matchMedia('(min-width: 1024px)');
	var onChange = function (e) {
		if (e.matches) {
			setOpen(false);
		}
	};
	if (desktop.addEventListener) {
		desktop.addEventListener('change', onChange);
	} else if (desktop.addListener) {
		desktop.addListener(onChange);
	}
})();

/**
 * Header state: transparent over the hero, solid once the page scrolls.
 * Reads scroll position inside rAF so it never forces layout on the scroll
 * thread; the styling itself is entirely CSS.
 */
(function () {
	'use strict';

	var header = document.querySelector('.site-header');
	if (!header) {
		return;
	}

	var THRESHOLD = 60;
	var ticking = false;
	var isScrolled = null;

	function apply() {
		var next = window.pageYOffset > THRESHOLD;
		if (next !== isScrolled) {
			isScrolled = next;
			header.classList.toggle('is-scrolled', next);
		}
		ticking = false;
	}

	function onScroll() {
		if (!ticking) {
			ticking = true;
			window.requestAnimationFrame(apply);
		}
	}

	apply();
	window.addEventListener('scroll', onScroll, { passive: true });
})();

/**
 * Photo reel: auto-advancing, with arrows and dots as an escape hatch.
 * Markup and slide count come from the server (template-parts/photo-reel.php)
 * so the reel still shows its first photo with no JS at all; this only adds
 * the browsing behavior on top.
 */
(function () {
	'use strict';

	var AUTO_ADVANCE_MS = 5000;
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	document.querySelectorAll('[data-photo-reel]').forEach(function (reel) {
		var slides = reel.querySelectorAll('.photo-reel__slide');
		var dots = reel.querySelectorAll('.photo-reel__dot');
		var prev = reel.querySelector('[data-photo-reel-prev]');
		var next = reel.querySelector('[data-photo-reel-next]');
		var current = 0;
		var timer = null;

		if (slides.length < 2) {
			return;
		}

		function show(index) {
			slides[current].classList.remove('is-active');
			dots[current] && dots[current].classList.remove('is-active');
			current = (index + slides.length) % slides.length;
			slides[current].classList.add('is-active');
			dots[current] && dots[current].classList.add('is-active');
		}

		function stop() {
			if (timer) {
				clearInterval(timer);
				timer = null;
			}
		}

		function start() {
			if (reduceMotion) {
				return;
			}
			stop();
			timer = setInterval(function () {
				show(current + 1);
			}, AUTO_ADVANCE_MS);
		}

		prev && prev.addEventListener('click', function () { show(current - 1); start(); });
		next && next.addEventListener('click', function () { show(current + 1); start(); });
		dots.forEach(function (dot, i) {
			dot.addEventListener('click', function () { show(i); start(); });
		});

		reel.addEventListener('mouseenter', stop);
		reel.addEventListener('mouseleave', start);
		reel.addEventListener('focusin', stop);
		reel.addEventListener('focusout', start);

		start();
	});
})();

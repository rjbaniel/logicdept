var lastScrollY = 0,
	ticking = false;
	header = document.getElementById('masthead');

jQuery( document ).ready( makeHeaderSticky() );

function makeHeaderSticky() {
	window.addEventListener('scroll', getScrollY, false);
}

function getScrollY() {
	lastScrollY = window.scrollY;
	requestTick();
}

function requestTick() {
	if (!ticking) {
		requestAnimationFrame(maybeAddScrolledClass);
		ticking = true;
	}
}

function maybeAddScrolledClass() {
	ticking = false;

	var currentScrollY = lastScrollY;
	if (currentScrollY > 1) {
		header.classList.add('site-header--scrolled');
	} else {
		header.classList.remove('site-header--scrolled');
	}
}
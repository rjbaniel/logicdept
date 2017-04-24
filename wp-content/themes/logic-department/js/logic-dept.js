var collapsable_headers = document.getElementsByClassName('collapsable__header');
for (var i = 0; i < collapsable_headers.length; i++) {
	collapsable_headers[i].addEventListener('click', toggleVisibility);
}

function toggleVisibility(event) {
	var parent = event.target.parentNode;
	if (!parent.classList.contains('collapsable')) {
		parent = parent.parentNode;
	}
	parent.classList.toggle('collapsable--hidden');
}
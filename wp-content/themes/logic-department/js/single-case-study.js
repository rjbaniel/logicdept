jQuery(document).ready(function() {
	var caseStudyBlocks = document.getElementsByClassName('case-study-block');
	var imageOverlay = document.getElementById('imageOverlay');

	for (var index = 0; index < caseStudyBlocks.length; index++) {
		var block = caseStudyBlocks[index];
		block.addEventListener('click', lightboxBlock);
	}

	imageOverlay.addEventListener('click', closeLightbox);

	function lightboxBlock(event) {
		var targetedBlock = event.target;
		while (!targetedBlock.classList.contains('case-study-block')) {
			targetedBlock = targetedBlock.parentNode;
		}
		imageOverlay.classList.add('image-overlay--active');
		var overlayImageSrc = targetedBlock.querySelector('img').src;
		var overlayImageText = targetedBlock.querySelector('.case-study-block__content').innerHTML;

		imageOverlay.querySelector('img').src = overlayImageSrc;
		imageOverlay.querySelector('.image-overlay__text').innerHTML = overlayImageText;
	}

	function closeLightbox(event) {
		imageOverlay.classList.remove('image-overlay--active');
		event.stopPropagation();
	}
});
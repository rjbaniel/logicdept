var collapsableHeaders = document.getElementsByClassName('collapsable__header');
var aboutHeaders = document.getElementsByClassName('team-member__header');
var loadMoreProjects = document.getElementById('loadMoreProjects');
var next_page = 2;
if (loadMoreProjects) {
	loadMoreProjects.addEventListener('click', ajaxLoadMoreProjects);
}
for (var i = 0; i < collapsableHeaders.length; i++) {
	collapsableHeaders[i].addEventListener('click', toggleVisibility);
}
for (var i = 0; i < aboutHeaders.length; i++) {
	collapsableHeaders[i].addEventListener('click', toggleVisibility);
}
function toggleVisibility(event) {
	var parent = event.target.parentNode;
	while (!parent.classList.contains('collapsable')) {
		parent = parent.parentNode;
	}
	parent.classList.toggle('collapsable--hidden');
}

function ajaxLoadMoreProjects(event) {
	event.preventDefault();
	var data = {
		action: 'load_next_projects_page',
		page_num: next_page
	};
	jQuery.post(ajax.ajax_url, data, function(response){
		if (response == 'done') {
			loadMoreProjects.innerHTML = "That's all!";
			return;
		}
		var parsedResponse = JSON.parse(response);
		var projectsContainer = document.querySelector('.projects-container');
		for( var i = 0; i < parsedResponse.length; i++) {
			projectsContainer.innerHTML += parsedResponse[i];
		}
		console.log(parsedResponse[0]);
	});
	next_page++;
}

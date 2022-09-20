// AJAX PAGINATION
$('.ic-pagination a').live('click', function(e){
	e.preventDefault();
	var properties_wrapper = $('.properties-wrapper');
	var link = jQuery(this).attr('href');

	// opacity and disable on click
	properties_wrapper.css({
	   'opacity' : '0.5',
	   'pointer-events' : 'none'
	});

	$.get(link, function(data, status) {
		//console.log(status);

		var properties = jQuery(".properties-wrapper .row", data);
		properties_wrapper.html(properties); // load properties
		// scroll in top of wrapper section
		$('html,body').animate({ 
				scrollTop: properties_wrapper.offset().top - 150
			}, 'slow'
		);

		// opacity and disable on click
		properties_wrapper.css({
		   'opacity' : '1',
		   'pointer-events' : 'all'
		});
	});

	//pagination.load(link+' .ic-pagination ul');
	// update url
	//window.history.pushState('obj', 'client', link);
	//return false;

});
		
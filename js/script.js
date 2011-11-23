console.log('ok');

(function($, c) {
	var dashboard = $('#communicator-dashboard-form');
	dashboard.submit(function() {
		var data = {
			action : 'communicator_submit_post',
			message : $('#communicator-dashboard-form-message')
		};
		console.log(message);
		$.post(c.ajaxUrl, 
		return false;
	});
	console.log('yea');
})(jQuery, communicator);

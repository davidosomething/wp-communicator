(function(window, $, undefined) { var communicator = {
	submitForm : function() {

		return false;
	},
	init : function() {
		console.log('hi');
		$('#communicator-dashboard-form').submit(this.submitForm);
	}
}; communicator.init(); })(window, jQuery);

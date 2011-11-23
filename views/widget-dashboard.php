<?php
?>
<div class="communicator-widget" id="communicator-dashboard_widget">
	tada...

	<form id="communicator-dashboard-form">
		<?php wp_nonce_field($this->plugin_name . '-post', $this->plugin_name . '-nonce'); ?>
		<textarea name="message" rows="1" cols="40" placeholder="your message" id="communicator-dashboard-form-message"></textarea>
		<p class="submit"><input id="communicator-dashboard-submit" name="submit" type="submit" class="button-primary" value="Post Message" />
	</form>
</div>

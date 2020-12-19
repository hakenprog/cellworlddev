(function ($) {
	//shorthand for ready event.
	$(
		function () {
			$( 'div[data-dismissible] .notice-dismiss' ).click(
				function (event) {
					event.preventDefault();
					var $this = $( this );

					var attr_value, option_name, dismissible_length, data;

					attr_value = $this.parent().attr( 'data-dismissible' ).split( '-' );

					console.log(attr_value);

					dismissible_length = attr_value.pop();

					console.log(dismissible_length);

					option_name = attr_value.join( '-' );

					data = {
						'action': 'dismiss_admin_notice',
						'option_name': option_name,
						'dismissible_length': dismissible_length,
						'nonce': dismissible_notice.nonce
					};

					$.post( ajaxurl, data );
				}
			);
		}
	)

}(jQuery));
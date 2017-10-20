(function( $ ) {
	'use strict';

$( function() {
	$( ".wpcf7" )
		.on( 'wpcf7:mailsent', function(e) {
			var sa_cf7_form_id = '(not set)';
			if ( e && e.target && e.target.id ) {
				sa_cf7_form_id = e.target.id;
			}
			
			dataLayer.push({
				'event': 'sa.form.submitted',
				'sa_form_id': sa_cf7_form_id
			});
		});
});

})( jQuery );

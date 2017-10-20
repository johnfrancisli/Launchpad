(function( $ ) {
	'use strict';

$(document).bind('gform_confirmation_loaded', function(event, formId){
    dataLayer.push({
				'event': 'sa.form.submitted',
				'sa_form_id': formId
			});
});

})( jQuery );

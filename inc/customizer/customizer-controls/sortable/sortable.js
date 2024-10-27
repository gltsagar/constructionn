wp.customize.controlConstructor['gl_sortable_pill_checkbox'] = wp.customize.Control.extend({
	ready: function(){
		'use strict';

		jQuery( ".gl_sortable_pill_checkbox_control .sortable" ).sortable({
			placeholder: "pill-ui-state-highlight",
			update: function( event, ui ) {
				traverseParent(jQuery(this).parent());
			}
		});
	
		jQuery('.gl_sortable_pill_checkbox_control .sortable-pill-checkbox').on('change', function () {
			traverseParent(jQuery(this).parent().parent().parent());
		});
	
		// Get the values from the checkboxes and add to our hidden field
		function traverseParent($element) {
			var inputValues = $element.find('.sortable-pill-checkbox').map(function() {
				if( jQuery(this).is(':checked') ) {
					return jQuery(this).val();
				}
			}).toArray();
			$element.find('.customize-control-sortable-pill-checkbox').val(inputValues).trigger('change');
		}
	}
});
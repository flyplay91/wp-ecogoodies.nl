/*
 *
 * NHP_Options_radio_img function
 * Changes the radio select option, and changes class on images
 *
 */
function nhp_radio_img_select(relid, labelclass){
	jQuery(this).prev('input[type="radio"]').prop('checked');

	jQuery('.nhp-radio-img-'+labelclass).removeClass('nhp-radio-img-selected');	
	
	jQuery('label[for="'+relid+'"]').addClass('nhp-radio-img-selected');

	if ( 'mts_header_layout' === labelclass ) {
		jQuery(document).trigger( "header_layout_changed" );
	}
}//function

jQuery(document).ready(function($) {
    $('tr[class^="header_radio_img_val-"]').hide();

    var currentVal = $('input.header_radio_img:checked', 'tr.header_radio_img').val();
	showHideHeaderLayoutOptions( currentVal );

    function showHideHeaderLayoutOptions( val ) {
    	$('tr[class^="header_radio_img_val-"]').hide();

    	$('tr[class^="header_radio_img_val-"]').each(function() {
			var $this = $(this),
				className = $this.attr('class');//console.log(className);

			if ( className.indexOf( val ) >= 0 ) {
				$this.show();
			} else {
				$this.hide();
			}
		});
    }

    $(document).on( "header_layout_changed", function() {

    	//var currentVal = $('input.header_radio_img:checked', 'tr.header_radio_img').val();//not working

    	var currentVal = $('tr.header_radio_img .nhp-radio-img-selected').find('input[type="radio"]').val();
    	showHideHeaderLayoutOptions( currentVal );
	});
})

$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

	// Trigger The Selectboxit

	$("select").selectBoxIt({

		autoWidth: false
	}); 

    // Hide Placeholder On Form Focus

	$('[placeholder]').focus(function(){

		$(this).attr('data-text', $(this).attr('placeholder'));
		$(this).attr('placeholder', '');
	}).blur(function () {

		$(this).attr('placeholder', $(this).attr('data-text'));

	});
	
	//confirmation Message On Button

	$('.confirm').click(function() {
	
		return confirm('Are You Sure?');
	})
	// Add Asterisk On Required Field

	$('input').each(function () {

		if ($(this).attr('required') === 'required'){

			$(this).after('<span class="asterisk">*</span>');
		}
	});
});

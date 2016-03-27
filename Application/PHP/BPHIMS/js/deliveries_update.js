$(document).ready(function(){
	
	/**
		Datepicker
	*/
	$("#received_date").datepicker();

	
	/**
		Show/Hide delivery information
	*/
	$('#delivery-option').on('change',function(){
		if($(this).is(':checked')) {
			$('#'+$(this).val()).hide();
		} else {
			$('#'+$(this).val()).show();
		}
	});
});
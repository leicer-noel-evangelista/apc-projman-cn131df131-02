$(document).ready(function(){
	/**
		Show/Hide delivery information
	*/
	$('#delivery-option').on('change',function(){
		if($(this).is(':checked')) {
			$('#'+$(this).val()).removeClass("hidden");
		} else {
			$('#'+$(this).val()).addClass("hidden");
		}
	});
	
	/**
		Show/Hide table column
	*/
	$('.show-hide-option').on('change',function(){
		if($(this).is(':checked')) {
			$('.'+$(this).val()).removeClass("hidden");
		} else {
			$('.'+$(this).val()).addClass("hidden");
		}
	});

	/**
		Show/Hide delivery information
	*/
	$('#delivery-supply-option').on('change',function(){
		if($(this).is(':checked')) {
			$('#'+$(this).val()).removeClass("hidden");
		} else {
			$('#'+$(this).val()).addClass("hidden");
		}
	});
	
	/**
		Enables the tooltip
	*/
	$('[data-toggle="tooltip"]').tooltip();
	
	/**
		Datepicker
	*/
	$("#expiry").datepicker();
	
	/**
		Modal
	*/
	$('#modal-delete').modal({
		'show':false
	}).on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var deleteName = button.data('delete-name');
		var deleteID = button.data('delete-id');
		
		var modal = $(this);
		modal.find('.modal-body #delete-name').text(deleteName);
		modal.find('.modal-footer #delete-id').val(deleteID);
	});
	
});
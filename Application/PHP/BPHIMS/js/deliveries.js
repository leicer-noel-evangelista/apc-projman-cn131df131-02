$(document).ready(function(){
	
	/**
		Show/Hide additional option
	*/
	$('#additional-option').on('change',function(){
		if($(this).is(':checked')) {
			$('.'+$(this).val()).show();
		} else {
			$('.'+$(this).val()).hide();
		}
	});
	
	/**
		Show/Hide table column
	*/
	$('.show-hide-option').on('change',function(){
		if($(this).is(':checked')) {
			$('.'+$(this).val()).show();
		} else {
			$('.'+$(this).val()).hide();
		}
	});
	
	/**
		Handles pagination
	*/
	$('.pagination-selector').on('change',function(){
		window.location.href = "deliveries.php?page="+$(this).val();
	});
	
	/**
		Initialize tool tips
	*/
	$('[data-toggle="tooltip"]').tooltip();
	
	
	
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
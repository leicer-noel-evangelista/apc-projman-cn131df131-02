$(document).ready(function(){
	
	var hideAjaxResult = true;
	
	/**
		Show/Hide additional option
	*/
	$('#additional-option').on('change', function(){
		if($(this).is(':checked')) {
			$('.'+$(this).val()).show();
		} else {
			$('.'+$(this).val()).hide();
		}
	});
	
	/**
		Show/Hide table column
	*/
	$('.show-hide-option').on('change', function(){
		if($(this).is(':checked')) {
			$('.'+$(this).val()).show();
		} else {
			$('.'+$(this).val()).hide();
		}
	});
	
	/**
		Handles pagination
	*/
	$('.pagination-selector').on('change', function(){
		window.location.href = "deliveries.php?page="+$(this).val();
	});
	
	/**
		Initialize tool tips
	*/
	$('html').tooltip({
		selector: '[data-toggle="tooltip"]'
	});
	
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
	
	/**
		Add ajax call to the .ajax_searcher
	*/
	$('.ajax_searcher').on('keyup', function(e){
		if(e.keyCode == 13) {
			setSelected($(this).parent().find('.first_result'));
		} else {
			var parameters = {
				'action' : $(this).attr('action'),
				'keyword' : $(this).val()
			};
			
			if($(this).attr('id') == 'department_head_id_selection') {
				parameters.department_id = $('#department_id').val();
			}
			
			if($(this).attr('id') == 'item_supply_id_selection') {
				var selected_id = [];
				$('.selected_supply_container .selected_delivery_item_id').each(function(i,v){
					selected_id[i] = $(v).val();
				});
				parameters.delivery_item_id = JSON.stringify(selected_id);
			}
			
			if($(this).attr('id') == 'item_equipment_id_selection') {
				var selected_id = [];
				$('.selected_equipment_container .selected_delivery_item_id').each(function(i,v){
					selected_id[i] = $(v).val();
				});
				parameters.delivery_equipment_id = JSON.stringify(selected_id);
			}
			
			console.log(parameters);
			
			callAJAX($(this), parameters);
		}
	});
	
	/**
		Process click on .ajax_result
	*/
	$('.ajax_container').on('click', '.ajax_result', function(e){
		if($(this).hasClass('special_result')) {
			// Process special result.
			var process = true;
			
			if(isDepartmentPage) {
				if($(this).attr('restricted')==1) {
					process = false;
				}
			}
			
			if(process) {
				setSelectedSpecial($(this));
				hideAjaxResult = true;
			} else {
				hideAjaxResult = false;
			}
		} else {
			setSelected($(this));
		}
	});
	
	/**
		Add mouseover effect on .ajax_result
	*/
	$('.ajax_container').on('mouseover', '.ajax_result', function(){
		$('.ajax_result').removeClass('initial_selected');
	});
	
	/**
		Reset searcher
	*/
	$('.ajax_selected_display').on('click', '.remove_selected_result', function(){
		var target = $(this).parent().parent().children('.ajax_searcher.form-control').attr('target'); // get the target
		$('#'+target).val('').change(); // remove the value
		$(this).parent().addClass('hidden'); // hide parent
		$(this).parent().parent().children('.form-control').removeClass('hidden'); // show input
		
		if($(this).hasClass('result_special')) {
			$(this).parent().parent().parent().find('.select_item_quantity').html('').append('<option value="0">0</option>').attr('disabled','disabled');
			$(this).parent().parent().parent().find('.button_item_add').attr('disabled','disabled').addClass('btn-default').removeClass('btn-success');
			$(this).parent().parent().children('.item_data').text('');
		}
		
		$(this).parent().empty(); // clear parent
	});
	
	/**
		Enable/Disable department_head field
	*/
	$('#department_id').on('change', function(){
		var status = $(this).val() == '' || $(this).val() == 0;
		$('#department_head_id_selection').prop('disabled', status);
		
		if(status) {
			$('#department_head_id_selection').parent().find('.ajax_selected_display').addClass('hidden');
			$('#department_head_id_selection').val('');
			$('#department_head_id_selection').removeClass('hidden');
			$('#department_head_id_selection').parent().find('#department_head_id').val('');
		}
	});
	
	/**
		Call AJAX
	*/
	function callAJAX(element, parameters) {
		if(parameters.keyword == '') {
			element.parent().children('.ajax_container').addClass('hidden');
		} else {
			$.ajax({
				url: "php/ajax.php",
				method: "POST",
				data: parameters,
				dataType: "json",
				success: function(response) {
					console.log(response);
					element.parent().children('.ajax_container').empty();
					for(var i=0; i<response.length; i++) {
						element.parent().children('.ajax_container').append(response[i]);
					}
					element.parent().children('.ajax_container').removeClass('hidden');
				},
				error: function(response) {
					console.log(response);
					alert("Something went wrong");
				}
			});
		}
	}
	
	/**
		Tag the element as selected
	*/
	function setSelected(element) {
		element.parent().addClass('hidden'); // hide ajax_container
		element.parent().parent().children('.form-control').addClass('hidden'); // hide input
		element.parent().parent().children('.ajax_selected_display').empty(); // clear
		element.parent().parent().children('.ajax_selected_display').append(element.find('img')); // append image
		element.parent().parent().children('.ajax_selected_display').append(element.find('b')); // append name
		element.parent().parent().children('.ajax_selected_display').append(' '); // add space
		element.parent().parent().children('.ajax_selected_display').append(element.find('span')); // add employee_id and position
		element.parent().parent().children('.ajax_selected_display').append('<i class="remove_selected_result glyphicon glyphicon-remove pull-right"></i>'); 
		element.parent().parent().children('.ajax_selected_display').removeClass('hidden'); // display ajax_container
		element.parent().parent().children('.form-control').val(''); // clear value
		var target = element.parent().parent().children('.form-control').attr('target');
		$('#'+target).val(element.attr('value')).change();
	}
	
	/**
		Tag the element as selected for special
	*/
	function setSelectedSpecial(element) {
		element.parent().addClass('hidden'); // hide ajax_container
		element.parent().parent().children('.form-control').addClass('hidden'); // hide input
		element.parent().parent().children('.ajax_selected_display').empty(); // clear
		element.parent().parent().children('.ajax_selected_display').append(element.find('img')); // append image
		element.parent().parent().children('.ajax_selected_display').append(element.find('b')); // append name
		element.parent().parent().children('.ajax_selected_display').append('<i class="remove_selected_result result_special glyphicon glyphicon-remove pull-right"></i>');
		element.parent().parent().children('.ajax_selected_display').removeClass('hidden'); // display ajax_container
		element.parent().parent().children('.form-control').val(''); // clear value
		var target = element.parent().parent().children('.form-control').attr('target');
		$('#'+target).val(element.attr('value')).change();
		
		// something
		var data_json = element.children('#ajax_result_data').val();
		element.parent().parent().children('.item_data').text(data_json); // specify value
		var data = JSON.parse(data_json);
		
		element.parent().parent().parent().find('.select_item_quantity').html('');
		
		var totalQuantity = parseInt(data.quantity,10) - parseInt(data.dispense,10);
		
		for(var i=1; i <= totalQuantity; i++) {
			var selected = (i == totalQuantity)?'selected="selected"':'';
			element.parent().parent().parent().find('.select_item_quantity').append('<option value="'+i+'" '+selected+'>'+i+' pcs.</option>');
		}
		element.parent().parent().parent().find('.select_item_quantity').removeAttr('disabled');
		element.parent().parent().parent().find('.button_item_add').removeAttr('disabled').removeClass('btn-default').addClass('btn-success');
	}

	/**
		Hide ajax container when clicked
	*/
	$('html').click(function() {
		if(hideAjaxResult) {
			$('.ajax_container').addClass('hidden');
		}
		hideAjaxResult = true;
	});
	
	/**
		Adding selected supply
	*/
	$('#item_supply_add').on('click', function(){
		var numberOfSelected = $('.selected_supply_container').find('tbody.table_body').children('tr.selected').length;
		var selectedQuantity = $(this).parent().parent().find('#item_supply_quantity').val();
		var data = JSON.parse($(this).parent().parent().find('#item_supply_data').text()); // parse the data
		
		var clone = $('.selected_supply_container').find('tr.clone.hidden').clone(); // clone it so we can specify the details
		clone.find('td.counter').append(numberOfSelected + 1); // add item counter
		clone.find('b.details_name').append(data.code+' - '+data.name+' ('+data.brand+') - '+data.dosage+' '+data.dosage_unit); // add name
		clone.find('span.details_batch_code').append(' '+data.batch_code); // add batch_code
		clone.find('span.details_expiry').append(' '+data.expiry); // add expiry
		clone.find('span.details_location').append(' '+data.location); // add location
		clone.find('td.quantity').append('x'+selectedQuantity); // get quantity and add it
		
		clone.find('input.input_delivery_item_id').attr('name', 'delivery_supply_id['+numberOfSelected+']').val(data.delivery_supply_id).addClass('selected_delivery_item_id');
		clone.find('input.input_quantity').attr('name', 'delivery_supply_quantity['+numberOfSelected+']').val(selectedQuantity);
		
		clone.removeClass('clone').removeClass('hidden').addClass('selected'); // remove clone and hidden; add selected
		$('.selected_supply_container').find('tbody.table_body').append(clone); // add clone
		$(this).parent().parent().find('.remove_selected_result').click(); // trigger remove
	});
	
	/**
		Adding selected equipment
	*/
	$('#item_equipment_add').on('click', function(){
		var numberOfSelected = $('.selected_equipment_container').find('tbody.table_body').children('tr.selected').length;
		var selectedQuantity = $(this).parent().parent().find('.select_item_quantity').val();
		var data = JSON.parse($(this).parent().parent().find('.item_data').text()); // parse the data
		
		var clone = $('.selected_equipment_container').find('tr.clone.hidden').clone(); // clone it so we can specify the details
		clone.find('td.counter').append(numberOfSelected + 1); // add item counter
		clone.find('b.details_name').append(data.code+' - '+data.name+' ('+data.brand+')'); // add name
		clone.find('span.details_batch_code').append(' '+data.equipment_code); // add equipment_code
		clone.find('span.details_expiry').append(' '+data.warranty); // add warranty
		clone.find('span.details_location').append(' '+data.location); // add location
		clone.find('td.quantity').append('x'+selectedQuantity); // get quantity and add it
		
		clone.find('input.input_delivery_item_id').attr('name', 'delivery_equipment_id['+numberOfSelected+']').val(data.delivery_equipment_id).addClass('selected_delivery_item_id');
		clone.find('input.input_quantity').attr('name', 'delivery_equipment_quantity['+numberOfSelected+']').val(selectedQuantity);
		
		clone.removeClass('clone').removeClass('hidden').addClass('selected'); // remove clone and hidden; add selected
		$('.selected_equipment_container').find('tbody.table_body').append(clone); // add clone
		$(this).parent().parent().find('.remove_selected_result').click(); // trigger remove
	});
	
	/**
		Remove selected item
	*/
	$('.selected_supply_container').on('click', '.remove_selected_item', function(){
		$(this).parent().parent().remove();
	});
	
	/**
		Remove selected item
	*/
	$('.selected_equipment_container').on('click', '.remove_selected_item', function(){
		$(this).parent().parent().remove();
	});
	
	/**
		Submit the form with validation
	*/
	$('#button_submit').on('click', function(){
		var message = [];
		var isValid = true;
		
		$('.field_required').each(function() {
			if ($(this).val() == "" || $(this).val() == 0) {
				isValid = false;
			}
		});
		
		if(isValid) {
			$('.final_confirmation').removeClass('hidden');
			$(this).addClass('hidden');
			$("html, body").animate({ scrollTop: $(document).height() }, 1000);
		} else {
			alert("Please complete the form");
		}
	});
	
	/**
		Cancel submit
	*/
	$('#button_submit_proceed').on('click', function(){
		$('#form_create').submit();
	});
	
	/**
		Final confirmation and submit
	*/
	$('#button_submit_cancel').on('click', function(){
		$('#button_submit').removeClass('hidden');
		$('.final_confirmation').addClass('hidden');
	});
	
});
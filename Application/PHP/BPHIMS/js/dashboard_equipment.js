$(document).ready(function(){
	
	$('.nav.nav-tabs li').on('click', function(){
		$('.nav.nav-tabs li').removeClass('active');
		$(this).addClass('active');
		$('.tabs-body').addClass('hidden');
		$('#'+$(this).attr('tab')).removeClass('hidden');
	});
	
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
	
	var pixelHeight = (data_label.length < 5)?70:40;
	
	/**
		Chart
	*/
	$('#equipment_chart')
		.css('height', (data_label.length*pixelHeight) + 'px')
		.highcharts({
			chart: {
				type: 'bar'
			},
			title: {
				text: null
			},
			xAxis: {
				categories: data_label,
				title: {
					text: 'Equipment'
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Quantity',
					align: 'middle'
				},
				labels: {
					overflow: 'justify'
				},
				allowDecimals: false
			},
			plotOptions: {
				bar: {
					dataLabels: {
						enabled: true
					}
				}
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'top',
				x: -40,
				y: 80,
				floating: true,
				borderWidth: 1,
				backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
				shadow: true
			},
			credits: {
				enabled: false
			},
			series: [
				{
					name: 'Critical Level',
					data: data_critical_level,
					color: '#d9534f'
				},
				{
					name: 'Remaining',
					data: data_remaining,
					color: '#337ab7'
				}
			]
		})
		.parent().addClass('hidden');
	
});
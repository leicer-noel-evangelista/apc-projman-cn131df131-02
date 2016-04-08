$(document).ready(function(){
	
	$('#supply_chart').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Item Supply Inventory Graph'
        },
        xAxis: {
            categories: data_label,
            title: {
                text: 'Supply'
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
    });


});
(function ($) {
	"use strict";

	// Payment chart - only initialize if required elements exist
	if ($('#price-list').length && $('#day-list').length && $('#payment-chart').length) {
		var priceListVal = $('#price-list').val();
		var dayListVal = $('#day-list').val();

		if (priceListVal && dayListVal) {
			var options = {
				series: [{
					name: 'Total Payment',
					data: JSON.parse(priceListVal)
				}],
				chart: {
					type: 'bar',
					height: 350,
					toolbar: {
						show: false,
					}
				},
				plotOptions: {
					bar: {
						borderRadius: 4,
						horizontal: false,
					}
				},
				dataLabels: {
					enabled: false
				},
				xaxis: {
					categories: JSON.parse(dayListVal),
				}
			};

			var paymentChart = new ApexCharts(document.querySelector("#payment-chart"), options);
			paymentChart.render();
		}
	}
	// payment chart end


	// event ticket chart start - only initialize if required elements exist
	if ($('#total-ticket-list').length && $('#event-name-list').length && $('#event-ticket-chart').length) {
		var ticketListVal = $('#total-ticket-list').val();
		var eventNameListVal = $('#event-name-list').val();

		if (ticketListVal && eventNameListVal) {
			var options = {
				series: JSON.parse(ticketListVal),
				chart: {
					height: 370,
					type: 'pie',
				},
				labels: JSON.parse(eventNameListVal),
				responsive: [{
					breakpoint: 480,
					options: {
						chart: {
							width: 200
						},
						legend: {
							position: 'bottom'
						}
					}
				}]
			};

			var eventTicketChart = new ApexCharts(document.querySelector("#event-ticket-chart"), options);
			eventTicketChart.render();
		}
	}
	// event ticket chart end
})(jQuery)

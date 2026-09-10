// chart 5
Highcharts.chart('chart5', {
	title: {
		text: 'ผู้เข้าอบรม'
	},
	series: [{
		type: 'pie',
		allowPointSelect: true,
		keys: ['name', 'y', 'selected', 'sliced'],
		data: [
		['Apples', 29.9, false],
		['Pears', 71.5, false],
		['Oranges', 106.4, false],
		['Plums', 129.2, false],
		['Bananas', 144.0, false],
		['Peaches', 176.0, false],
		['Prunes', 135.6, true, true],
		['Avocados', 148.5, false]
		],
		showInLegend: true
	}]
});

// chart 6
Highcharts.chart('chart6', {
	chart: {
		type: 'pie',
		options3d: {
			enabled: true,
			alpha: 45
		}
	},
	title: {
		text: 'Contents of Highsoft\'s weekly fruit delivery'
	},
	subtitle: {
		text: '3D donut in Highcharts'
	},
	plotOptions: {
		pie: {
			innerSize: 100,
			depth: 45
		}
	},
	series: [{
		name: 'Delivered amount',
		data: [
		['Bananas', 8],
		['Kiwi', 3],
		['Mixed nuts', 1],
		['Oranges', 6],
		['Apples', 8],
		['Pears', 4],
		['Clementines', 4],
		['Reddish (bag)', 1],
		['Grapes (bunch)', 1]
		]
	}]
});

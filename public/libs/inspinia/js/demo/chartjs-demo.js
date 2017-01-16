$(function() {

	var doughnutData = [
		{
			value: 300,
			color: "#a3e1d4",
			highlight: "#1ab394",
			label: "App"
		},
		{
			value: 50,
			color: "#dedede",
			highlight: "#1ab394",
			label: "Software"
		},
		{
			value: 100,
			color: "#b5b8cf",
			highlight: "#1ab394",
			label: "Laptop"
		}
	];

	var doughnutOptions = {
		segmentShowStroke: true,
		segmentStrokeColor: "#fff",
		segmentStrokeWidth: 2,
		percentageInnerCutout: 45, // This is 0 for Pie charts
		animationSteps: 100,
		animationEasing: "easeOutBounce",
		animateRotate: true,
		animateScale: false,
		responsive: true,
	};

	var ctx = document.getElementById("doughnutChart").getContext("2d");
	var myNewChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

});
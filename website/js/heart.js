$(document).ready( function(){
	$.ajax({
		url:"http://localhost/glow/hearthistory.php",
		method: "GET",
		success: function (data) {
			console.log(data);
			//data = JSON.parse(data);
			var time =[];
			var HeartRate =[];
			for(var i in data)
			{
				time.push("time" +data[i].time);
				HeartRate.push(data[i].HeartRate);
				
			}
			var chartdata = {
				labels: time,
				datasets: [
				{
					label: "Num",
					fill: false,
					lineTension: 0.1,
					backgroundcolor: "rbga(59,89,152,0.75)",
					bordercolor: "rbga(59,89,152,1)",
					pointhoverbackgroundcolor: "rbga(59,89,152,1)",
					pointhoverbordercolor: "rbga(59,89,152,1)",
					data: time	
				},
				{
					label: "HeartRate",
					fill: false,
					lineTension: 0.1,
					backgroundcolor: "rbga(59,89,152,0.75)",
					bordercolor: "rbga(59,89,152,1)",
					pointhoverbackgroundcolor: "rbga(59,89,152,1)",
					pointhoverbordercolor: "rbga(59,89,152,1)",
					data: HeartRate	
				}
				
			]
			};
			var ctx = $("#mycanvas");
			var linegraph= new Chart(ctx, {
				type: 'line',
				data: chartdata
			});
		},
		error: function (data) {
			console.log(data);
		}
		
	});
	
	
});
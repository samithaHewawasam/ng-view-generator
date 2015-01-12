  if(google){
  google.load("visualization", "1", { packages: ["corechart"]});
  }
function drawChart(ChartDiv) {
	var ChartData = $('#'+ChartDiv).find('.Chartdata').text();
	if(ChartData){
            var chartOptions = $('#'+ChartDiv).find('.Options').text();
           
            var ChartName = $('#'+ChartDiv).attr('chartname');
            chartdataobject = $.parseJSON(ChartData);
            chartOptionsObject = $.parseJSON(chartOptions);
			
	  if(google){
		
    var data = google.visualization.arrayToDataTable(chartdataobject);
    if(ChartName=='PieChart')
	{
    var chart = new google.visualization.PieChart(document.getElementById(ChartDiv));
	}
	else if(ChartName=='ColumnChart')
	{
    var chart = new google.visualization.ColumnChart(document.getElementById(ChartDiv));
     }
	else if(ChartName=='LineChart')
	{
    var chart = new google.visualization.LineChart(document.getElementById(ChartDiv));
     }
	else if(ChartName=='BarChart')
	{
    var chart = new google.visualization.BarChart(document.getElementById(ChartDiv));
     }
    chart.draw(data, chartOptionsObject);
	}
	}
}
//Google Chart  End   


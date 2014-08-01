/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$.ajax({
  url: $('#ajax_url').val(),
  context: document.body
}).done(function(data) {
    $.each(data, function(type, values) {
        if(type == 'charts'){
            $.each(values, function(chartName, items) {
                buildchart(data['date'], chartName, items);
            });
        }
        if(type == "strings"){
            buildTableChart(values);
        }
        
    });
});

function buildchart(labels, chartName, items){
    var lineChartData = {
        labels : labels,
        datasets : [
            {
                    label: chartName,
                    fillColor : "rgba(220,220,220,0.2)",
                    strokeColor : "rgba(220,220,220,1)",
                    pointColor : "rgba(220,220,220,1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(220,220,220,1)",
                    data : items,
                    scaleStartValue : 0,
                    scaleBeginAtZero : true,
                    responsive : true,
                    
            }
        ]
    }
    var elm = 'chart-'+chartName;
    $(elm+'.container').show();
    var ctx = document.getElementById(elm).getContext("2d");
    window.myLine = new Chart(ctx).Line(lineChartData, {
            responsive: true
    });
}
function buildTableChart(values){
    $.each(values, function(chartName, items) {
        var table = "<table>";
        table += "<tr><thead><th>Date</th><th>Valeurs</th></thead></tr>";
        
        $.each(items, function(date, value) {
            table += buildStringValues(date, chartName, value);
        });        
        table += "</table>";
        $('#'+chartName).append(table);
    });
    
}
function buildStringValues(date, chartName, items){
    return "<tbody><tr><td>"+date+"</td><td>"+items+"</td></tr></tbody>";
}
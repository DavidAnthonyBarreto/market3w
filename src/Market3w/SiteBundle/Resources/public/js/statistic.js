/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$( document ).ready(function() {
    if($('#statistics-add').length){
        var jqxhr = $.getJSON( $('#ajax_url').val(), function() {
            console.log( "success" );
        })
        .done(function(disabledDates) {
            $('.datepicker').datepicker({
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
                    return [ disabledDates.indexOf(string) == -1 ]
                },
                firstDay: 1,
                altField: "#datepicker",
                closeText: 'Fermer',
                prevText: 'Précédent',
                nextText: 'Suivant',
                currentText: 'Aujourd\'hui',
                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                weekHeader: 'Sem.',
                dateFormat: 'dd/mm/yy'
            },
            $.datepicker.regional['fr']
            );
        })
    }
    if($('#statistics-charts').length){
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
      
      if($('#edit-date').length && $('#edit-submit').length){
          changeEditLink($('#edit-date'));
          $('#edit-date').change(function(){
              changeEditLink($(this));
              var prevUrl = $('#edit-submit').attr('href'); 
              var newUrl = prevUrl.replace(/statistics\/.+\/edit/, 'statistics/'+$(this).val()+'/edit');
              $('#edit-submit').attr('href', newUrl);
          });
      }
  }
});


function changeEditLink(elm){
    var prevUrl = $('#edit-submit').attr('href'); 
    var newUrl = prevUrl.replace(/statistics\/.+\/edit/, 'statistics/'+elm.val()+'/edit');
    $('#edit-submit').attr('href', newUrl);
}


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
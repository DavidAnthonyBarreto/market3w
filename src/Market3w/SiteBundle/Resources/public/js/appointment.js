$( document ).ready(function(){
    $('#market3w_sitebundle_appointment_date_date').datepicker({
        beforeShowDay: $.datepicker.noWeekends,
        minDate: '0d',
        maxDate: '2w',
        firstDay: 1,
        monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        dateformat: 'dd/mm/yy'
    }).attr("readonly","readonly");
});
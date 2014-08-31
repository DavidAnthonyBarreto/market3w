$( document ).ready(function(){
    $('#appointment_date').datepicker({
        beforeShowDay: $.datepicker.noWeekends,
        minDate: '0d',
        maxDate: '2w',
        firstDay: 1,
        monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        dateformat: 'dd/mm/yy',
        altField: '#appointment_date',
        altFormat: 'dd/mm/yy'
    });
    
    // manage type option
    $('#appointment_type').change(function(){
        console.log('change');
        if ( $('#appointment_type_1').is(':checked') ) {
            $('#address').removeClass('contact_hidden');
            $('#skype').hide();
            $('#appointment_skype').val('');
            $('#appointment_address').show();
        }
        else {
            $('#skype').removeClass('contact_hidden');
            $('#appointment_address').hide();
            $('#appointment_address').find('input').each(function(){
                $(this).val('');
            });
            $('#skype').show();
        }   
    });
  
});
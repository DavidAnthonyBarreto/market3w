$( document ).ready(function(){
     $('#market3w_sitebundle_appointment_date_date').datepicker({
        beforeShowDay: $.datepicker.noWeekends,
        minDate: '0d',
        maxDate: '2w',
        firstDay: 1,
        monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        dateformat: 'dd/mm/yy',
        altField: '#market3w_sitebundle_appointment_date_date',
        altFormat: 'dd/mm/yy'
    });
    
    $('input:radio').change(function(e){
        e.preventDefault();
        manageTypeChoices();
    });
    
    manageTypeChoices();
    
    function manageTypeChoices()
    {
        var type = getCheckedItem($('input:radio'));
        
        switch(type) {
            case 'market3w_sitebundle_appointment_type_1':
                $('#skype').css('display', 'none');
                clearValue($('#market3w_sitebundle_appointment_skype'));
                $('#market3w_sitebundle_appointment_address').css('display', 'block');
                break;
            case 'market3w_sitebundle_appointment_type_2':
                $('#market3w_sitebundle_appointment_address').css('display', 'none');
                $('#market3w_sitebundle_appointment_address').find('input').each(function(){
                    clearValue($(this));
                });
                $('#skype').css('display', 'block');
                break;
            case 'market3w_sitebundle_appointment_type_3':
                $('#skype').css('display', 'none');
                clearValue($('#market3w_sitebundle_appointment_skype'));
                $('#market3w_sitebundle_appointment_address').css('display', 'none');
                $('#market3w_sitebundle_appointment_address').find('input').each(function(){
                    clearValue($(this));
                });
                break;
            default:
                $('#skype').css('display', 'none');
                $('#market3w_sitebundle_appointment_address').css('display', 'none');
                break;
        }
    }
    
    function getCheckedItem(choices) 
    {        
        for (var i = 0; i < choices.length; i++) {
            if (choices[i].checked) {
                return choices[i].id;
            }
        }
        
        return false;
    }
    
    function clearValue(input)
    {
        input.val('');
    }
});
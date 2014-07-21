$( document ).ready(function(){
    $('#market3w_sitebundle_appointment_date_date').datepicker({
        beforeShowDay: $.datepicker.noWeekends,
        minDate: '0d',
        maxDate: '2w',
        firstDay: 1,
        monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        dateformat: 'dd/mm/yy'
    });
    
    $('input:radio').change(function(e){
        e.preventDefault();
        manageTypeChoices();
    });
    
    function manageTypeChoices()
    {
        var type = getCheckedItem($('input:radio'));
        
        switch(type) {
            case 'market3w_sitebundle_appointment_type_1':
                console.log('address');
                $('#market3w_sitebundle_appointment_skype').css('display', 'none');
                clearValue($('#market3w_sitebundle_appointment_skype'));
                $('#market3w_sitebundle_appointment_address').css('display', 'block');
                break;
            case 'market3w_sitebundle_appointment_type_2':
                console.log('skype');
                $('#market3w_sitebundle_appointment_address').css('display', 'none');
                $('#market3w_sitebundle_appointment_address').find('input').each(function(){
                    clearValue($(this));
                });
                $('#market3w_sitebundle_appointment_skype').css('display', 'block');
                break;
            case 'market3w_sitebundle_appointment_type_3':
                console.log('videoconference');
                $('#market3w_sitebundle_appointment_skype').css('display', 'none');
                clearValue($('#market3w_sitebundle_appointment_skype'));
                $('#market3w_sitebundle_appointment_address').css('display', 'none');
                $('#market3w_sitebundle_appointment_address').find('input').each(function(){
                    clearValue($(this));
                });
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
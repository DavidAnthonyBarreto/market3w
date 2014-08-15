$( document ).ready(function() {
//    markRequiredFieldForm();
});

function markRequiredFieldForm()
{
    // add "*" to required field in form
    $('input').each(function(){
        if( $(this).is(':required') ) {
            // TODO : debug label not always prev element
            var inputLabel = $(this).prev();
            var label      = inputLabel.html();
            
            if( label.search('\\*') == -1 ) {
                var newLabel   = label+" *";
                inputLabel.html(newLabel);
            }           
        }
    });
}




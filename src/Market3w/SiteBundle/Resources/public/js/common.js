$( document ).ready(function() {
    // add "*" to required field in form
    $('input').each(function(){
        if( $(this).is(':required') ) {
            var inputLabel = $(this).prev();
            var label      = inputLabel.html();
            var newLabel   = label+" *";
            
            inputLabel.html(newLabel);           
        }
    });
});




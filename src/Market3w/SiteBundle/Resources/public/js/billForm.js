// Récupère le div qui contient la collection de lines
var collectionHolder = $('#lines');

// ajoute un lien « ajouter une ligne »
var $addLineLink = $('<a href="#" class="add_line_link">Ajouter une ligne</a>');
var $newLink     = $('<p></p>').append($addLineLink);

jQuery(document).ready(function() {
    collectionHolder.append($newLink);

    // ajoute un lien de suppression à tous les éléments li de
    // formulaires de tag existants
    collectionHolder.find('div.line').each(function() {
        addLineFormDeleteLink($(this));
    });

    $addLineLink.on('click', function(e) {
        // empêche le lien de créer un « # » dans l'URL
        e.preventDefault();

        // ajoute un nouveau formulaire tag (voir le prochain bloc de code)
        addLineForm(collectionHolder, $newLink);
        
        markRequiredFieldForm();
    });
});

function addLineForm(collectionHolder, $newLink) {
    // Récupère l'élément ayant l'attribut data-prototype comme expliqué plus tôt
    var prototype = collectionHolder.attr('data-prototype');

    // Remplace '__name__' dans le HTML du prototype par un nombre basé sur
    // la longueur de la collection courante
    var newForm = prototype.replace(/__name__/g, collectionHolder.children().length);

    // Affiche le formulaire dans la page dans un li, avant le lien "ajouter un tag"
    var $newFormDiv = $('<div class="line"></div>').append(newForm);
    $newLink.before($newFormDiv);
    
    // ajoute un lien de suppression au nouveau formulaire
    addLineFormDeleteLink($newFormDiv);
}

function addLineFormDeleteLink($lineFormDiv) {
    var $removeFormLink = $('<a href="#">Supprimer cette ligne</a>');
    $lineFormDiv.append($removeFormLink);

    $removeFormLink.on('click', function(e) {
        // empêche le lien de créer un « # » dans l'URL
        e.preventDefault();

        // supprime l'élément li pour le formulaire de tag
        $lineFormDiv.remove();
    });
}



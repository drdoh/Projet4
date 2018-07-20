formGenerator = {
    //labels: [],
    Qte: 1,
    //formSelector: "",
    index: 0,

    init : function(formQte){

        var $container = $('#drdoh_ticketbundle_buyer_ticket');
        formGenerator.index = $container.find(':input').length;
        formGenerator.Qte = parseInt(formQte);

        while(formGenerator.index < formGenerator.Qte){
            if (formGenerator.index == 0) {

                formGenerator.addCategory($container, formGenerator.index);
            } else {   
                formGenerator.addCategory($container, formGenerator.index);
                // S'il existe déjà des catégories, on ajoute un lien de suppression pour chacune d'entre elles
                $container.children('div').each(function() {
                    //addDeleteLink($(this));
                });
            }
        }
    },
        
    addCategory : function($container, index) {
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, ' Visiteur n°' + (formGenerator.index+1))
            .replace(/__name__/g,        formGenerator.index)
            ;

        var $prototype = $(template);
        
        $prototype.attr('class','mb-3 card-body bg-dark text-white');
        $prototype.children('legend').prepend('<i class="far fa-user"></i>' )
        $prototype.children('legend').attr("class","w-25 text-center shadow-lg p-2 bg-info rounded");
        
        $form = $prototype.children('div#drdoh_ticketbundle_buyer_ticket_'+formGenerator.index)
        var formGroup = $prototype.children('div#drdoh_ticketbundle_buyer_ticket_'+formGenerator.index).children("div");
        
        var formRow1 = formGroup.slice(0,2);
        $(formRow1).attr('class','col-6');
        $(formRow1).wrapAll('<div class="row 1 mb-3"></div>');
        
        var formRow2 = formGroup.slice(2,5);
        $(formRow2).wrapAll('<div class="row 2"></div>');
        $(formRow2).attr('class','col-4');
        
        // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
        //addDeleteLink($prototype);

        $container.append($prototype);

        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
        return formGenerator.index++;
    },
}

    

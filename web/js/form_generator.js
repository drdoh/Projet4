formGenerator = {
    Qte: 1,
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
                $container.children('div').each(function() {
                });
            }
        }
        
        $('fieldset').attr('class','mb-3 card-body bg-dark text-white');
        $('fieldset').children('legend').attr("class","w-25 text-center shadow-lg p-2 bg-info rounded");
        $('fieldset').each(function(index){
            console.log(index);
            $('fieldset').children('legend').text(' Visiteur n°'+(index+1));
            $('.initialism').text('Oups !');
            $('fieldset').children('legend').prepend('<i class="far fa-user"></i>' );
        })

    },
        
    addCategory : function($container, index) {
        var template = $container.attr('data-prototype')
            .replace(/__name__/g, formGenerator.index)
            ;
        var $prototype = $(template);
        
        $container.append($prototype);
        return formGenerator.index++;
    },
}
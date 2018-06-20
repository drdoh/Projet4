formGenerator = {
    labels: [],
    Qte: 1,
    formSelector: "",
    i: 1,

    init : function(formQte, formSelector, labels){
         
        formGenerator.labels = labels;
        formGenerator.Qte = parseInt(formQte);
        formGenerator.formSelector = formSelector;

        $container = $('form');

        while(formGenerator.i <= formGenerator.Qte){

            if(formGenerator.i === 1 ){

                for(var index in formGenerator.labels){

                    var modelName = "div"+formGenerator.formSelector+formGenerator.labels[index] ;
                    var cibleName = "div"+formGenerator.formSelector+formGenerator.labels[index];
                    var labelFr = formGenerator.labels[index];
                    formGenerator.add($(modelName),$(cibleName), labelFr);

                }

                formGenerator.add($("div"+formGenerator.formSelector +"email"),$("div"+formGenerator.formSelector +"email"), 'E-mail');
                $('#guest_index').text("Visiteur "+ formGenerator.i);
                formGenerator.i++;    

           }else{

                $('#form_card').append('<div class="text-right"><h4 class="text-right" id="guest_index">Visiteur '+formGenerator.i+'</h4></div>');
                $('#form_card').append('<div class="well" id="form_'+formGenerator.i+'"></div>');
                $('#form_' + formGenerator.i ).append('<div class="form-row 1"></div>');
                $('#form_' + formGenerator.i ).append('<div class="form-row 2"></div>');
                formGenerator.add($('div'+ formGenerator.formSelector +"lastName"),$('#form_' + formGenerator.i + ' .1'), 'Nom');
                formGenerator.add($('div'+ formGenerator.formSelector +"firstName"),$('#form_' + formGenerator.i + ' .1'), 'Prenom');
                $('#form_' + formGenerator.i + ' .1 div').attr('class','form-group col-md-6');
    
    
                formGenerator.add($('div'+ formGenerator.formSelector +'birthDate'),$('#form_'+formGenerator.i+ ' .2'), 'Date de naissance');
                formGenerator.add($('div'+ formGenerator.formSelector +'discount'),$('#form_'+formGenerator.i+' .2'), 'Réduction');
                formGenerator.add($('div'+ formGenerator.formSelector +'country'),$('#form_'+formGenerator.i+' .2'), 'Pays');
                $('#form_' + formGenerator.i + ' .2 > div').attr('class','form-group col-md-4');
                $('#form_' + formGenerator.i ).append('<hr>')
                formGenerator.i++;   
           }
        }
    }, 

    add : function($model, $cible, label){
        var $newModel= $model.clone()
        var template = $newModel.attr('data-prototype')
            .replace(/__name__label__/g, label)
            .replace(/__name__/g,       formGenerator.i)
        ;
        var $prototype = $(template);
        $cible.append($prototype);
    }
}

    

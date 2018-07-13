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
            
            if(formGenerator.i == 1){

                for(var index in formGenerator.labels){
                    var modelName = "div"+formGenerator.formSelector+formGenerator.labels[index] ;
                    var cibleName = "div"+formGenerator.formSelector+formGenerator.labels[index];                   
                    var label = formGenerator.labels[index];
                    var labelFr = formGenerator.labelFr(label);
                    var $prototype = formGenerator.proto($(modelName),labelFr);
                    $(cibleName).append($prototype);
                } 
            }else{
                $('#form_card').append('<div class="text-right"><h4 class="text-right" id="guest_index">Visiteur '+formGenerator.i+'</h4></div>');
                $('#form_card').append('<div class="well" id="form_'+formGenerator.i+'"></div>');
                $('#form_' + formGenerator.i ).append('<div class="form-row 1"></div>');
                $('#form_' + formGenerator.i ).append('<div class="form-row 2"></div>');


                var proto1 = formGenerator.proto($('div'+ formGenerator.formSelector +"lastName"), 'Nom');
                var proto2 = formGenerator.proto($('div'+ formGenerator.formSelector +"firstName"), 'Prenom');
                $('#form_' + formGenerator.i + ' .1').append(proto1);
                $('#form_' + formGenerator.i + ' .1').append(proto2);
                $('#form_' + formGenerator.i + ' .1 div').attr('class','form-group col-md-6');
    
    
                var proto1 = formGenerator.proto($('div'+ formGenerator.formSelector +'birthDate'), 'Date de naissance');
                var proto2 = formGenerator.proto($('div'+ formGenerator.formSelector +'discount'), 'Réduction');
                var proto3 = formGenerator.proto($('div'+ formGenerator.formSelector +'country'), 'Pays');
                $('#form_' + formGenerator.i + ' .2').append(proto1);
                $('#form_' + formGenerator.i + ' .2').append(proto2);
                $('#form_' + formGenerator.i + ' .2').append(proto3);
                $('#form_' + formGenerator.i + ' .2 > div').attr('class','form-group col-md-4');
                $('#form_' + formGenerator.i ).append('<hr>')
                

            }
                formGenerator.i++;    
        }
    }, 

    proto : function($model, label){
        var $newModel= $model.clone()
        var template = $newModel.attr('data-prototype')
            .replace(/__name__label__/g, label)
            .replace(/__name__/g,       formGenerator.i)
        ;
        var $prototype = $(template);
        return $prototype;
    },

    labelFr : function(label){
        switch(label){
            case "lastName":
                labelFr = "Nom";
                break;
            case "firstName":
                labelFr = "Prénom";
                break;
            case "birthDate":
                labelFr = "Date de Naissance";
                break;
            case "discount":
                labelFr = "Réduction";
                break;
            case "country":
                labelFr = "Pays";
                break;
            default:
                labelFr;
        }

        return labelFr;
    }

}

    

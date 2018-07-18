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
                    var $prototype = formGenerator.proto($(modelName));
                    $(cibleName).append($prototype);
                } 
                $('#form_1').wrap('<div class="card text-white bg-dark mb-3"></div>');
            }else{
                $('#form_card').append('<div class="card-body" id="form_'+formGenerator.i+'"></div>');
                $('#form_' + formGenerator.i).append('<h4 class="col-2 offset-10 w-25 text-center shadow p-2 mb-2 bg-info rounded" id="guest_index"><i class="far fa-user"></i> Visiteur '+formGenerator.i+'</h4>');
                $('#form_' + formGenerator.i ).wrap('<div class="card text-white bg-dark mb-3"></div>')
                $('#form_' + formGenerator.i ).append('<div class="form-row 1"></div>');
                $('#form_' + formGenerator.i ).append('<div class="form-row 2"></div>');


                var proto1 = formGenerator.proto($('div'+ formGenerator.formSelector +"lastName"));
                var proto2 = formGenerator.proto($('div'+ formGenerator.formSelector +"firstName"));
                $('#form_' + formGenerator.i + ' .1').append(proto1);
                $('#form_' + formGenerator.i + ' .1').append(proto2);
                $('#form_' + formGenerator.i + ' .1 div').attr('class','form-group col-md-6');
    
    
                var proto1 = formGenerator.proto($('div'+ formGenerator.formSelector +'birthDate'));
                var proto2 = formGenerator.proto($('div'+ formGenerator.formSelector +'discount'));
                var proto3 = formGenerator.proto($('div'+ formGenerator.formSelector +'country'));
                $('#form_' + formGenerator.i + ' .2').append(proto1);
                $('#form_' + formGenerator.i + ' .2').append(proto2);
                $('#form_' + formGenerator.i + ' .2').append(proto3);
                $('#form_' + formGenerator.i + ' .2 > div').attr('class','form-group col-md-4');             

            }
                formGenerator.i++;    
        }
    }, 

    proto : function($model){
        var $newModel= $model.clone()
        var template = $newModel.attr('data-prototype')
            .replace(/__name__/g, formGenerator.i)
        ;
        var $prototype = $(template);
        return $prototype;
    },

}

    

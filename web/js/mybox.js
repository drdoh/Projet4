 mybox ={
        init : function(){
            $("#drdoh_ticketbundle_buyer_save").click(function(){
                $('form').submit(function(e) {
                    e.preventDefault();
                });
                mybox.lien = $(this).attr("href");
                mybox.open();

                return false;
            })
        },
        open : function(){
            $('body').append('<div id="mybox"></div>');
            $('#mybox').append('<div id="mybox_aplat"></div>');
            $('#mybox').append('<div id="mybox_contener"></div>');
            $('#mybox_contener').append('<div id="mybox_relative"><div id="mybox_close"></div><div id="mybox_contenu"></div></div>');

            $('#mybox_contenu').append('<h4> Vous allez proceder au reglement par carte </h4>');
            $('#mybox_contenu').append('<form id="mybox_modal_form" role="form"></form>');
            $('#mybox_modal_form').append('<div class="form-group"> <label="control-label"> Email </label><input type="email"></input></div>');
            $('#mybox_modal_form').append('<div class="form-group"> <label="control-label"> N° de carte </label><input type="int"></input></div>');
            $('#mybox_modal_form').append('<div class="form-group"> <label="control-label"> Date de validité </label><input type="date"></input></div>');
            $('#mybox_modal_form').append('<div class="form-group"> <label="control-label"> CVC </label><input type="int"></input></div>');

            $('#mybox_close').click(mybox.close);

        },
        close : function(){
            $('#mybox').remove();
        } 
    }
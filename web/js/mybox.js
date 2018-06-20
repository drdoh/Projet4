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
            $('body').append('<div id="mybox"><div id="mybox_aplat"></div><div id="mybox_contener"><div id="mybox_relative"><div id="mybox_close"></div><div id="mybox_contenu"></div></div></div></div>');
            $('#mybox_aplat').show('slow');
            $('#mybox_contener').show('slow');

            $('#mybox_close').click(mybox.close);

        },
        close : function(){
            $('#mybox').remove();
        } 
    }
price={

// Tarif Unitaire
    full: 16,
    child : 8,
    baby : 0,
    older : 12,
    discount: 10,

// Quantité Unitaire
    fullQte:0,
    childQte :0,
    babyQte : 0,
    olderQte : 0,
    discountQte: 0,

//Options
    devise: ",00€",
    selector: "",
    id: 1,
    items:[],
    
    init: function(ticketQte, formSelector, items){
        price.selector = formSelector;
        price.items = items;
        price.fullQte = ticketQte;

        $('#qte_full_price').text(ticketQte);
        price.unit();
        price.setQte();

        

    },

    setQte: function(){
        var array = [];
        for(var i in price.items){
            var item = price.items[i];
            var varName = "qte_"+item+"_price";
                switch (item){
                    case 'full':
                        Qte = price.fullQte;
                        val = price.full;
                        break;
                    case 'child':
                        Qte = price.childQte;
                        val = price.child
                        break;
                    case 'baby':
                        Qte = price.babyQte;
                        val = price.baby;
                        break;
                    case 'older':
                        Qte = price.olderQte;
                        val = price.older;
                        break;
                    case 'discount':
                        Qte = price.discountQte;
                        val = price.discount;
                        break;
                        default : 0;
                    }         
            var total = price.unit(Qte,val);
            array.push(total);
            
            $('#qte_'+ price.items[i]+'_price').text(Qte);
            $('#total_'+ price.items[i]+'_price').text(total);
           
        }
        var totalGeneral = price.global(array)
        $('#total_price').text(totalGeneral);
    },
    
    unit: function(Qte, $){
        for(var i in price.items){
            return total = Qte * $;
        }
    },
    
    global: function(array){
        var totalGeneral = 0;
        for(var i in array){
            totalGeneral += array[i];
        }
        return totalGeneral;
    },

    // discountVerification: function(){
    //     var discount = $(price.selector +'discount').val();
    //             if(discount != 50){
    //                 qte_discount_price ++ ;
    //                 if(qte_full_price>0){
    //                     qte_full_price -- ;
    //                 }
    //                 $('#qte_discount_price').text(qte_discount_price);
    //                 $('#qte_full_price').text(qte_full_price);
    //             }else{
    //                 qte_discount_price -- ;
    //                 qte_full_price ++ ;
    //                 $('#qte_discount_price').text(qte_discount_price);
    //                 $('#qte_full_price').text(qte_full_price);
    //             }
    // },

    // birth: function(){
    //     var jours = $(price.selector +'birthDate_1_day').val();
    //     var mois = $(price.selector +'birthDate_1_month').val();
    //     var année = $(price.selector +'birthDate_1_year').val();
    //     birthDate= new Date(année,mois,jours);
    //     visiteDate = new Date(); 
    //     var age = price.dateDiff(birthDate,visiteDate);
    //     console.log(age);
    // },

    // dateDiff: function(dateold,datenew){

    //     var ynew = datenew.getFullYear();
    //     var mnew = datenew.getMonth();
    //     var dnew = datenew.getDate();
    //     var yold = dateold.getFullYear();
    //     var mold = dateold.getMonth();
    //     var dold = dateold.getDate();
    //     var diff = datenew - dateold;
    //     if(mold > mnew) diff--;
    //     else
    //     {
    //         if(mold == mnew)
    //         {
    //         if(dold > dnew) diff--;
    //         }
    //     }
    //     return diff;
    // }
}

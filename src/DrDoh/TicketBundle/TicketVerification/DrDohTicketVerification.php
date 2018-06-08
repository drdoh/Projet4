<?php 

namespace DrDoh\TicketBundle\TicketVerification;

class DrDohTicketVerification
{
    
    /**
     * Récupère le nombre de billets vendus par date
     * 
     * @return array $soldTicketsArray 'date'=>'val'
     * 
     */
    public function getSoldTickets($tickets){

        $soldTicketsArray = [];
        
        foreach($tickets as $ticket){
            var_dump($tickets);
            $ticketDate = $ticket->getDate()->format('Y-m-d');
            
            if(array_key_exists($ticketDate,$soldTicketsArray)){ 
                var_dump($ticketDate);
                $soldTicketsArray[$ticketDate] ++;
            }else{
                $soldTicketsArray[$ticketDate] = 1 ;
            }
            return $soldTicketsArray;
        }
    }


    /**
     * Récupère les dates complètes
     * 
     * @return array $fullDatesArray 
     * 
     */
    public function getFullDate($tickets, $qteMax){
        

        $soldTickets = $this->getSoldTickets($tickets);
        var_dump($soldTickets);

        foreach($tickets as $tickets){

            if(($qteMax - $soldTickets)===0){
                $dates = $data->getDate();
                $date = $dates->format('m/d/Y h:i');
                $fullDatesArray[] = $date;
            }
        };

        //var_dump($fullDatesArray);
        
        return $fullDatesArray;
    }
}
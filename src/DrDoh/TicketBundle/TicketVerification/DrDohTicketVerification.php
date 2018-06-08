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
            $ticketDate = $ticket->getDate()->format('Y-m-d');
            
            if(array_key_exists($ticketDate,$soldTicketsArray)){ 
                $soldTicketsArray[$ticketDate] ++;
            }else{
                $soldTicketsArray[$ticketDate] = 1 ;
            }   
        }
        return $soldTicketsArray;
    }


    /**
     * Récupère les dates complètes
     * 
     * @return array $fullDatesArray 
     * 
     */
    public function getFullDate($tickets, $qteMax){
        

        $soldTickets = $this->getSoldTickets($tickets);
        
        var_dump($qteMax);
        
        foreach($soldTickets as $soldTicket){
            var_dump($soldTicket);

            if(($qteMax - $soldTicket)===0){
                // $dates = $data->getDate();
                // $date = $dates->format('m/d/Y h:i');
                // $fullDatesArray[] = $date;
            }
        };

        
        return $fullDatesArray;
    }
}
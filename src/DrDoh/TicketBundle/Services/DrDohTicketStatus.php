<?php 

namespace DrDoh\TicketBundle\Services;

class DrDohTicketStatus
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

    public function getSaturday(){
        
    }


    /**
     * Récupère les jours feriés
     * 
     * @return array $holidaysArray 
     * 
     */
    public function getHolidays($maxYear){
        
        $N= date('Y');
        $holidays = [];
        $holidaysArray = [];

        for($N ; $N <= $maxYear ; $N++){
            $Pr_mai = $N.'-05-01'; 
            $Pr_novembre = $N.'-11-01'; 
            $noel = $N.'-12-25'; 
            
            if($holidays === null){
                $holidays = array ($Pr_mai,$Pr_novembre, $noel);
            }else{
                $holidaysArray = array_push($holidays,$Pr_mai,$Pr_novembre,$noel);
            }
        }

        return $holidays;
    }


    /**
     * Récupère les dates complètes
     * 
     * @return array $fullDatesArray 
     * 
     */
    public function getFullDate($tickets, $qteMax, $yearMax){
        
        $holidaysArray = $this->getHolidays($yearMax);

        $soldTickets = $this->getSoldTickets($tickets);
        
        foreach($soldTickets as $date => $soldTicket){         
            if(($qteMax - $soldTicket)===0){
                $fullDatesArray[] = $date;
            }
        };
        $fullDatesArray = array_merge_recursive($holidaysArray, $fullDatesArray);
        return $fullDatesArray;
    }
}
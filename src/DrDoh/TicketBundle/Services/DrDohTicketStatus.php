<?php 

namespace DrDoh\TicketBundle\Services;

class DrDohTicketStatus
{
    private $qteMax;
    private $yearMax;

    public function __construct($qteMax, $yearMax)
    {
        $this->qteMax = $qteMax;
        $this->yearMax = $yearMax;
    }

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
     * Récupère les jours feriés
     * 
     * @return array $holidaysArray 
     * 
     */
    public function getHolidays(){
        
        $N= date('Y');
        $holidays = [];
        $holidaysArray = [];
        
        for($N ; $N <= 2020 ; $N++){
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
    public function getFullDate($tickets){
        $holidaysArray = $this->getHolidays($this->yearMax);
        $soldTickets = $this->getSoldTickets($tickets);
        $fullDatesArray = [];
        foreach($soldTickets as $date => $soldTicket){ 
      
            if(($this->qteMax - $soldTicket) === 0){
                $fullDatesArray[] = $date;
            }
        };
        $fullDatesArray = array_merge_recursive($holidaysArray, $fullDatesArray);
        return $fullDatesArray;
    }

    /**
     * Verifie la dispo
     * 
     * @return bool $fullDatesArray 
     * 
     */
    public function checkDispo($tickets, $userChoices){

        $SoldTickets = $this->getSoldTickets($tickets);

            $dispo = true;
            $date = \DateTime::createFromFormat('d/m/Y', $userChoices['date'])->format('Y-m-d');
    
            if(array_key_exists($date,$SoldTickets) == true){
                if($SoldTickets[$date] +  $userChoices['ticket_qte'] > $this->qteMax){
                    $dispo = false;
                }    
            } 
            
        return $dispo;
    }
}
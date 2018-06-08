<?php 

namespace DrDoh\TicketBundle\TicketVerification;

class DrDohTicketVerification
{
    
    /**
     * Recupere les date ou il ne reste plus de billets
     * 
     * @return array $dateTikets
     * 
     */
    
    public function getFullDate($datas, $qteMax){
        
        foreach($datas as $data){
            $qteSold = $data->getqteSold();
            
            if(($qteMax-$qteSold)===0){
                $dates = $data->getDate();
                $date = $dates->format('m/d/Y h:i');
                $fullDatesArray[] = $date;
            }
        }

        return $fullDatesArray;
    }
}
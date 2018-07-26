<?php 

namespace DrDoh\TicketBundle\Services;

class DrDohPriceCal
{
    private $fullPrice;
    private $childPrice;
    private $babyPrice;
    private $seniorPrice;
    private $discountPrice;
    private $devise;
    private $childMaxAge;
    private $childMinAge;
    private $seniorMinAge;
    
    public function __construct($fullPrice,$childPrice,$babyPrice,$seniorPrice,$discountPrice,$devise,$childMaxAge,$childMinAge,$seniorMinAge)
    {
        $this->fullPrice = $fullPrice;
        $this->childPrice = $childPrice;
        $this->babyPrice = $babyPrice;
        $this->seniorPrice = $seniorPrice;
        $this->discountPrice = $discountPrice;
        $this->devise = $devise;
        $this->childMaxAge = $childMaxAge;
        $this->childMinAge = $childMinAge;
        $this->seniorMinAge = $seniorMinAge;
    }
    
    private function selectDiscountType($discount){
        switch($discount){
            case "employee":
                $discountPrice = $this->discountPrice;
                $priceType = "Employé";
                break;
            case "etude":
                $discountPrice = $this->discountPrice;
                $priceType = "Etudiant";
                break;
            case "military":
                $discountPrice = $this->discountPrice;
                $priceType = "Militaire";
                break;
            case "ministary":
                $discountPrice = $this->discountPrice;
                $priceType = "Membre du ministaire de la culture";
                break;
            default:
                $discountPrice = $this->fullPrice;
                $priceType = "Normal";
        }
        
        return $discountArray = ['type'=>$priceType,'price'=>$discountPrice];
    }

    private function selectAgeType($age){
        $age = intval($age);
        switch($age){
            case $age > $this->childMinAge && $age <= $this->childMaxAge:
                $agePrice = $this->babyPrice;
                $priceType = "Bébé";
                break;
            case $age > $this->childMinAge && $age <= $this->childMaxAge:
                $agePrice = $this->childPrice;
                $priceType = "Enfant";
                break;
            case $age > $this->seniorMinAge:
                $agePrice = $this->seniorPrice;
                $priceType = "Senior";
                break;
            default:
                $agePrice = $this->fullPrice;
                $priceType = "Normal";
        }
        return $ageArray = ['type'=>$priceType,'price'=>$agePrice];
    }

    private function selectType($age,$discount){
        $discountArray = $this->selectDiscountType($discount);
        $ageArray = $this->selectAgeType($age);
        if($discountArray['price'] < $ageArray['price']){
            return $discountArray;
        }else{
            return $ageArray;
        }     
    }

    private function getGuestAge($birthDate, $date){
        $date = \DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $date = new \DateTime($date);

        $diff=$date->diff($birthDate); 
        $age = $diff->format('%y');
        return $age;
    }

    private function getUPrice($age,$discount){
        $val = $this->selectType($age,$discount);
        return $priceType = $val['price'];     
    }

    private function getPriceType($age,$discount){
        $val = $this->selectType($age,$discount);
        return $priceType = $val['type'];
    
    }
            
    public function getTotalPrice($priceArray){     
        $total = array_sum($priceArray);
        return $total;
    }
    
    public function setPrices($session){   
        
        $priceArray = [];
        $datas = $session->get('buyer');
        $date = $session->get('userChoices')['date'];

        foreach($datas->getTicket() as $ticket){
            $birthDate = $ticket->getBirthDate();
            $age = $this->GetGuestAge($birthDate, $date);
            $discount = $ticket->getDiscount();

            $price = $this->getUPrice($age,$discount);
            $ticket->setValue($price);
            $ticket->setDate($date);
            $priceType = $this->getPriceType($age,$discount);
            $ticket->setType($priceType);
            $priceArray[]= $price;
        }
        $total = $this->getTotalPrice($priceArray);
        $datas->setAmountPaid($total);
    }

}
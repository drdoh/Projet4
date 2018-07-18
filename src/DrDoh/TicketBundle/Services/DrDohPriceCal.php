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
    
    public function __construct($fullPrice,$childPrice,$babyPrice,$seniorPrice, $discountPrice, $devise,$childMaxAge,$childMinAge,$seniorMinAge )
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

            
    public function getGuestAge($BirthDate, $date){
        $diff=$date->diff($BirthDate); 
        $age = $diff->format('%y');
        return $age;
    }

    public function getUPrice($age,$discount){

        switch($age){
            case $age <= $this->childMinAge:
                $agePrice = $this->babyPrice;
                break;
            case $age > $this->childMinAge && $age<= $this->childMaxAge:
                $agePrice = $this->childPrice;
                break;
            case $age > $this->childMaxAge && $age <= $this->seniorMinAge:
                $agePrice = $this->fullPrice;
                break;
            case $age > $this->seniorMinAge:
                $agePrice = $this->seniorPrice;
                break;
            default:
                $agePrice = $this->fullPrice;
        }

        switch($discount){
            case "employee":
                $discountPrice = $this->discountPrice;
                break;
            case "etude":
                $discountPrice = $this->discountPrice;
                break;
            case "military":
                $discountPrice = $this->discountPrice;
                break;
            case "ministary":
                $discountPrice = $this->discountPrice;
                break;
            default:
                $discountPrice = $this->fullPrice;
        }

        if($discountPrice < $agePrice){
            return $discountPrice;
        }else{
            return $agePrice;
        }     
    
    }

    public function getPriceType($age,$discount){

        switch($age){
            case ($age <= $this->childMinAge):
                $priceType = "Bébé";
                break;
            case $age > $this->childMinAge && $age<= $this->childMaxAge:
                $priceType = "Enfant";
                break;
            case $age > $this->childMaxAge && $age <= $this->seniorMinAge:
                $priceType = "Normal";
                break;
            case $age > $this->seniorMinAge:
                $priceType = "Senior";
                break;
            default:
                $priceType = "Normal";
            }

            if($discount != 'none'){
                switch($discount){
                        case "employee":
                        $priceType = "Employé";
                    break;
                        case "etude":
                        $priceType = "Etudiant";
                    break;
                    case "military":
                        $priceType = "Militaire";
                        break;
                    case "ministary":
                        $priceType = "Membre du ministaire de la culture";
                        break;
                    default:
                        $priceType = "Normal";
                }
            }

        return $priceType;
    
    }
            
    public function getTotalPrice($datas, $date){   
        
        $priceArray = $this->getPrices($datas, $date);
        $total = array_sum($priceArray);
        return $total;
    }
    
    public function getPrices($datas, $date){   
        
        $priceArray = [];
        
        foreach($datas->getFirstName() as $key => $value){
            $birthDate = $datas->getBirthDate()[$key];
            $birthDate = new \DateTime($birthDate);
            $age = $this->GetGuestAge($birthDate, $date);
            $discount = $datas->getDiscount()[$key];
            $price = $this->getUPrice($age,$discount);
            
            $priceArray[] = $price;
        }

        return $priceArray;
    }

    public function getPriceTypeArray($datas, $date){
        $priceTypeArray = [];

        foreach($datas->getFirstName() as $key => $value){
            $birthDate = $datas->getBirthDate()[$key];
            $birthDate = new \DateTime($birthDate);
            $age = $this->GetGuestAge($birthDate, $date);
            $discount = $datas->getDiscount()[$key];
            $priceType = $this->getPriceType($age,$discount);
            
            $priceTypeArray[] = $priceType;
        }

        return $priceTypeArray;
    }
}
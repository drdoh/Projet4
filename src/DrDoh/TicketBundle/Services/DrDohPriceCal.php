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

    public function getPriceType($age,$discount ){

        switch($age){
            case ($age <= $this->childMinAge):
                $priceType = "bébé";
                break;
            case $age > $this->childMinAge && $age<= $this->childMaxAge:
                $priceType = "enfant";
                break;
            case $age > $this->childMaxAge && $age <= $this->seniorMinAge:
                $priceType = "normal";
                break;
            case $age > $this->seniorMinAge:
                $priceType = "senior";
                break;
            default:
                $priceType = "normal";
            }

            if($discount != 'none'){
                switch($discount){
                    case "employee":
                    $priceType = "employé";
                    break;
                    case "etude":
                    $priceType = "etudiant";
                    break;
                    case "military":
                    $priceType = "militaire";
                    break;
                    case "ministary":
                    $priceType = "membre du ministaire de la culture";
                    break;
                    default:
                        $priceType = "normal";
                }
            }

        return $priceType;
    
    }
            
    public function getTotalPrice($data, $date){   
        
        $priceArray = [];

        foreach($data->getFirstName() as $key => $value){
            $birthDate = $data->getBirthDate()[$key];
            $age = $this->GetGuestAge($birthDate, $date);
            $discount = $data->getDiscount()[$key];
            $price = $this->getUPrice($age,$discount);
            
            $priceArray[] = $price;
        }

        $total = array_sum($priceArray);
        return $total;
    }

        
}
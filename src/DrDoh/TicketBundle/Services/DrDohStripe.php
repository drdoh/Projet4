<?php 

namespace DrDoh\TicketBundle\Services;

class DrDohStripe
{
    private $secretKey;
    private $publishableKey;

    public function __construct($secretKey, $publishableKey)
    {
        $this->secretKey = $secretKey;
        $this->publishableKey = $publishableKey;
        \Stripe\Stripe::setApiKey($this->secretKey);
    }

    /**
     * Get Public Key
     * 
     * @return $publishableKey
     * 
     */
    public function getPublishableKey(){
        return $this->publishableKey;
    }


    /**
     * Récupère le Charge
     * 
     * @return $charge 
     * 
     */
    public function getCharge($customer,$invoiceAmount){

        $charge = \Stripe\Charge::create(array(
            'customer' => $customer->id,
            'amount'   => $invoiceAmount*100,
            'currency' => 'eur'
        ));

        return $charge;

    }

    /**
     * Récupère les customer
     * 
     * @return  $customer 
     * 
     */
    public function getCustomer($email,$token){
        $customer = \Stripe\Customer::create(array(
            'email' => $email,
            'source'  => $token
        ));

        return $customer;
    }
}
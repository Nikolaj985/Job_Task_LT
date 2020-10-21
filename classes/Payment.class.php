<?php
class Payment{
private $paynr;    
private $payday;
private $remainingamount;
private $princpayment;
private $interestpayment;
private $totalpayment;
private $interestrate;
public function __construct($paynr, $payday, $remainingamount,$princpayment,$interestpayment,$totalpayment,$interestrate)
    {
        $this->paynr = $paynr;
        $this->payday = $payday;
        $this->remainingamount = $remainingamount;
        $this->princpayment = $princpayment;
        $this->interestpayment = $interestpayment;
        $this->totalpayment = $totalpayment;
        $this->interestrate = $interestrate;
    }

public function getPaynr(){
    return $this->paynr;
}
public function getPayday(){
    return $this->payday;
}
public function getRemammount(){
    return $this->remainingamount;
}
public function getPrincpayment(){
    return $this->princpayment;
}
public function getIntrerestpayment(){
    return $this->interestpayment;
}
public function getTotalpayment(){
    return $this->totalpayment ;
}    
public function getInterestrate(){
    return $this->interestrate;
}
    

    
public function setPaynr($x){
    $this->paynr = $x;
}
public function setPayday($x){
    $this->payday = $x;
}
public function setRemammount($x){
    $this->remainingamount = $x;
}
public function setPrincpayment($x){
    $this->princpayment = $x;
}
public function setIntrerestpayment($x){
    $this->interestpayment = $x;
}
public function setTotalpayment($x){
    $this->totalpayment = $x;
}    
public function setInterestrate($x){
    $this->interestrate = $x;
}
    
}
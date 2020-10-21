<?php
function savetocsv($payments) // Mokėjimo tvarkaraščio saugojimas .csv formatu
{
    if(count($payments)>0)
    {
        ob_end_clean();
        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="sample.csv"');
        
        $save_CSV[0] = array("Payment #", 'Payment date', "Remaining amount", "Principal payment", "Interest payment", "Total payment", "Interest rate");
        
        foreach($payments as $payment)
            {
                $save_CSV[$payment->getPaynr()] = array(
                $payment->getPaynr(), date('Y-m-d',$payment->getPayday()), $payment->getRemammount(), $payment->getPrincpayment(),$payment->getIntrerestpayment(),$payment->getTotalpayment(),$payment->getInterestrate());
    
            }
        
        $fp = fopen('php://output', 'w');
            
        foreach($save_CSV as $line)    
            {
                fputcsv($fp, $line, ';');
            }
        
        fclose($fp);
        exit();
    }
}

function roundfloor($float) //antrą skaičių po kablelio apvalina į kliento pusę (pastebėta pavyzdyje) 
    {     
        return floor($float*100)/100;  
    }

function addonemonth($date) // data + 1 mėn
    {
        return strtotime("+1 month",$date);
    }

function reschedule($payments,$payid,$perccentage) // Mokėjimo tvarkaraščio perskaičiavimas
    {
        $duration = count($payments);
        $totalpayment = roundfloor(($payments[$payid-1]->getRemammount() * ($perccentage/1200*pow(1+$perccentage/1200,$duration-                    $payid+1))/(pow((1+$perccentage/1200),$duration - $payid+1)-1)),2); 
        $remainingamount = $payments[$payid-1]->getRemammount();             
        $interestrate = $perccentage;
    
    for($i=$payid-1;$i<=$duration-1;$i++)
        {
            if($i==$duration-1)
                {
                $interestpayment = round(($remainingamount*$perccentage/1200),2);
                $totalpayment = $remainingamount + $interestpayment;
                $payments[$i]->setRemammount($remainingamount);
                $payments[$i]->setPrincpayment($remainingamount);
                $payments[$i]->setIntrerestpayment($interestpayment);
                $payments[$i]->setTotalpayment($totalpayment);
                $payments[$i]->setInterestrate($interestrate); 
                }
            else
                {   
                $interestpayment = round($remainingamount*$perccentage/1200,2);    
                $princpayment = $totalpayment - $interestpayment;    
                $payments[$i]->setRemammount($remainingamount);
                $payments[$i]->setPrincpayment($princpayment);
                $payments[$i]->setIntrerestpayment($interestpayment);
                $payments[$i]->setTotalpayment($totalpayment);
                $payments[$i]->setInterestrate($interestrate);
                $remainingamount =$remainingamount - $princpayment;
                }
        }
    
    return $payments;
}

function payschedule($remainingamount,$duration,$perccentage,$paymentstartday) // Mokėjimo tvarkaraščio generavimas
    {
        $payments = [];    
        $payday= strtotime($paymentstartday); //today
        $payday = strtotime("-1 month", $payday); //payment day in this month -> payment start - 1 month
    
        $totalpayment = roundfloor(($remainingamount * ($perccentage/1200*pow(1+$perccentage/1200,$duration))/(pow((1+$perccentage/1200),$duration)-1)),2); 
    
        $interestrate = $perccentage;
    
    for($i=1;$i<=$duration;$i++)
        {
            if($i==$duration)
                {
                    $payday = addonemonth($payday);
                    $interestpayment = round(($remainingamount*$perccentage/1200),2);
                    $princpayment = $remainingamount;
                    $totalpayment = $remainingamount + $interestpayment;
                    $payments[] = new Payment($i,$payday, $remainingamount,$princpayment,$interestpayment,$totalpayment,$interestrate); 
                }
            else
                {   
                    $payday = addonemonth($payday);  
                    $interestpayment = round($remainingamount*$perccentage/1200,2);    
                    $princpayment = $totalpayment - $interestpayment;    
                    $payments[] = new Payment($i, $payday, $remainingamount,$princpayment,$interestpayment,$totalpayment,$interestrate);    
                    $remainingamount=$remainingamount - $princpayment;
                }
        }
    
    return $payments;
}
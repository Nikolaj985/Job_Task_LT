<?php 
include_once("functions/functions.php");

session_start();

function __autoload($class)
{    
    include_once "classes/".$class.".class.php";
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['Duration']) && !isset($_POST['save'])) 
    {
        $_SESSION['Sum'] = $_POST['Sum'];
        $_SESSION['Duration'] = $_POST['Duration'];
        $_SESSION['Perccentage'] = $_POST['Perccentage'];
        $_SESSION['Payday'] = $_POST['Payday'];
        header("Location: {$_SERVER['PHP_SELF']}?Calc=1"); 
    }
    
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['Recalc']))
    {
        $_SESSION['Recalc'] = $_POST['Recalc'];
        $_SESSION['Perccentage2'] = $_POST['Perccentage'];
        header("Location: {$_SERVER['PHP_SELF']}?Calc=2"); 
    }

if($_SERVER['REQUEST_METHOD']=='POST' && ($_POST['save']==1 || $_POST['save']==2))
    {
        if($_POST['save']==1)
            {
                $payments = payschedule($_SESSION['Sum'],$_SESSION['Duration'],$_SESSION['Perccentage'],$_SESSION['Payday']); 
                savetocsv($payments);   
            }
        else
            {
                $payments = payschedule($_SESSION['Sum'],$_SESSION['Duration'],$_SESSION['Perccentage'],$_SESSION['Payday']);  
                $payments = reschedule($payments,$_SESSION['Recalc'],$_SESSION['Perccentage2']); 
                savetocsv($payments);   
            }
        
        //header("Location: {$_SERVER['PHP_SELF']}");
    }
if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['Calc']))
    {
        if($_GET['Calc']==1)
            {
                $payments = payschedule($_SESSION['Sum'],$_SESSION['Duration'],$_SESSION['Perccentage'],$_SESSION['Payday']);  
            }
        else
            {
                $payments = payschedule($_SESSION['Sum'],$_SESSION['Duration'],$_SESSION['Perccentage'],$_SESSION['Payday']);  
                $payments = reschedule($payments,$_SESSION['Recalc'],$_SESSION['Perccentage2']);    
            } 
    }
?>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	<div>
		<label for="txtSum">Paskolos suma, EUR</label>
		<input id="txtSum" type="text" name="Sum"  style="width:10em" value = "5000" />
        <label for="txtDuration">Paskolos terminas mėnesiais</label>
<select name="Duration">
<?php 
for($i=1;$i<=60;$i++){
    echo "<option value=\"".$i."\">".$i."</option>";
}?>       
</select>
	</div>
	<div>
		<label for="txtPercentage">Palūkanos</label>
		<input id="txtPercentage" type="number" name="Perccentage" min="1" max="20" value="12" style="width:3em"/> % &nbsp
        <label for="txtPayday">Mokėjimo diena </label>
        <input type="date" name="Payday" value="2017-04-15"><br><br>
		
	</div>
	<div>
		<button type="submit">Skaičiuoti</button><button type="submit" name="save" value="<?php echo $_GET['Calc']?>">Save to CSV</button>
	</div>	
</form>


<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	<div>
        <label for="txtRecalcn">Įmokos redagavimas</label>
<select id="txtRecalcn" name="Recalc">
<?php 
        foreach($payments as $payment)  
            {
                echo "<option value=\"".$payment->getPaynr()."\">".date("Y-m-d",$payment->getPayday())."</option>";
            }
?>       
</select>
		<label for="txtPercentage">Palūkanos</label>
		<input id="txtPercentage" type="number" name="Perccentage" min="1" max="20" value="7" style="width:3em"/> %
	</div>
	<div>
		<button type="submit">Perskaičiuoti</button>
	</div>	
</form>

<?php
if(isset($_GET['Calc']) && ($_GET['Calc']==1 || $_GET['Calc']==2)){
echo "<table border=\"1\">
<tr>
    <th>Payment #</th>
    <th>Payment date</th>
    <th>Remaining amount</th>
    <th>Principal payment</th>
    <th>Interest payment</th>
    <th>Total payment</th>
    <th>Interest rate</th>
    </tr>";

    foreach($payments as $payment){
    echo "<tr><td>".$payment->getPaynr()."</td><td>".date("Y-m-d",$payment->getPayday())."</td><td>".$payment->getRemammount()."</td><td>".$payment->getPrincpayment()."</td><td>".$payment->getIntrerestpayment()."</td><td>".$payment->getTotalpayment()."</td><td>".$payment->getInterestrate()."</td></tr>";
    }
    echo "</table>";
}
?>
























<?php
$SI_Reg_No ="";

if(isset($_GET['SI_Reg_No'])){$SI_Reg_No = $_GET['SI_Reg_No'];} 

include("../Modal/dbLayer.php");


$afterPaymentsInstallment = $helper->afterPaymentsInstallment($SI_Reg_No);

echo "<table class='table' id='afterPaymentsInstallment'>";
     echo "<tr>";
echo "<th>Installment No</th>";
echo "<th>Amount</th>";
echo "<th>Due Date</th>";
echo "<th>Paid Amount</th>";
echo "</tr>";

   foreach($afterPaymentsInstallment as $key => $value){  
        echo "<tr class='success'>";
$num = $key+1;
echo "<td class=".$num."INSNO".">".$value["SI_Ins_NO"]."</td>";
echo "<td class=".$num."INSAMOUNT".">".$value["SI_Ins_Amount"]."</td>";
echo "<td id=".$num."INSDUEDATE".">".$value["SI_Due_Date"]."</td>";
echo "<td id=".$num."INSPAIDAMOUNT".">".$value["SI_Paid_Amount"]."</td>";
echo "</tr>";
}

    echo "</table>";
?>


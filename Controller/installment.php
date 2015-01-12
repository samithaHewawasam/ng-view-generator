<?php

$FS_Stru_Code ="";

if(isset($_GET['FS_Code'])){$FS_Stru_Code = $_GET['FS_Code'];} 

include("../Modal/dbLayer.php");

$installment = $helper->installment($FS_Stru_Code);
echo "<table class='table' id='installmentsView'>";
     echo "<tr>";
echo "<th>Installment No</th>";
echo "<th>Amount</th>";
echo "<th>Due Date</th>";
echo "</tr>";

   foreach($installment as $key => $value){  
        echo "<tr class='success'>";

echo "<td class=".$value["FI_Ins_NO"]."INSNO".">".$value["FI_Ins_NO"]."</td>";
echo "<td class=".$value["FI_Ins_NO"]."INS".">".$value["FI_Ins_Amount"]."</td>";
echo "<td id=".$value["FI_Ins_NO"]."></td>";
echo "</tr>";
}

    echo "</table>";



?>

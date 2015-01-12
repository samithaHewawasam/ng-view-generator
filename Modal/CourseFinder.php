<?php

$registrationType = $helper->regType();

 echo "<select id='CouserFinder' name='RT_Code'>";
 echo "<option>Select Your Registration Type</option>";
foreach($registrationType  as $key => $value){


echo "<option value=".$value.">".$value."</option>";

}
echo "</select>";


?>



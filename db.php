<?php

try {
            
	$esoftConfig = new PDO('mysql:host=127.0.0.1;port=3307;dbname=esoftcar_col','esoftmetro', 'esoftmetro2014', array(
    PDO::ATTR_PERSISTENT => true
));

           
	$sql = $esoftConfig->prepare("SELECT RG_Reg_No FROM `registrations`");
        $sql->execute();
        echo "<pre>";
        var_dump($sql->fetchALL(PDO::FETCH_COLUMN, 0));
        echo "</pre>";

        }
        catch (PDOException $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            
        }




?>

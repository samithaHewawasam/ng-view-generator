 <?php

$dbh = new PDO('mysql:host=localhost;dbname=esoftcar_col', 'system', 'system@2014', array(
    PDO::ATTR_PERSISTENT => true
));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$s = array();

try {
    /* Begin a transaction, turning off autocommit */
    
    $stmt = $dbh->prepare("SELECT BM_Batch_Code,BM_Course_Code,
       BM_Commence_Date,
       BM_Target_Exam,
       IF(MONTH(BM_Commence_Date) = 12 , CONCAT('DEC/',YEAR(BM_Commence_Date)), false) ONDECEBER,IF(BM_Commence_Date BETWEEN STR_TO_DATE(CONCAT('01','/','01','/',YEAR(BM_Commence_Date)-1), '%m/%d/%Y') AND STR_TO_DATE(CONCAT('03','/','31','/',YEAR(BM_Commence_Date)), '%m/%d/%Y'), CONCAT('DEC/',YEAR(BM_Commence_Date)-1), false) DECEBER,IF(BM_Commence_Date BETWEEN STR_TO_DATE(CONCAT('04','/','01','/',YEAR(BM_Commence_Date)), '%m/%d/%Y') AND STR_TO_DATE(CONCAT('07','/','31','/',YEAR(BM_Commence_Date)), '%m/%d/%Y'), CONCAT('APR/',YEAR(BM_Commence_Date)), false) APRIL,IF(BM_Commence_Date BETWEEN STR_TO_DATE(CONCAT('08','/','01','/',YEAR(BM_Commence_Date)), '%m/%d/%Y') AND STR_TO_DATE(CONCAT('11','/','30','/',YEAR(BM_Commence_Date)), '%m/%d/%Y'), CONCAT('AUG/',YEAR(BM_Commence_Date)), false) AUGUST
FROM `batch_master`
LEFT JOIN `course_type` ON `course_type`.`CT_Course_Code` = `batch_master`.`BM_Course_Code`
LEFT JOIN `registration_type` ON `registration_type`.`RT_Code` = `course_type`.`CT_Type_Code`
WHERE D_Code = 'O/L-A/L'");
    
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //echo '<pre>';
    //var_dump($results);
    //echo '</pre>';
    
    foreach($results as $value){
    
    if(!empty($value['ONDECEBER'])){
    
    $stmt2 = $dbh->prepare("UPDATE `batch_master` SET `BM_Target_Exam` = ? WHERE `BM_Batch_Code` =?");
    $stmt2->execute(array($value['ONDECEBER'],$value['BM_Batch_Code']));
    
    $stmt3 = $dbh->prepare("INSERT IGNORE INTO `esoftcar_centralserver`.`intakes`( `Intake`, `C_Code`, `I_Status`) VALUES (?,?,'Inactive')");
    $stmt3->execute(array($value['ONDECEBER'],$value['BM_Course_Code']));
    
    }
     if(!empty($value['DECEBER'])){
    
    $stmt2 = $dbh->prepare("UPDATE `batch_master` SET `BM_Target_Exam` = ? WHERE `BM_Batch_Code` =?");
    $stmt2->execute(array($value['DECEBER'],$value['BM_Batch_Code']));
    
    $stmt3 = $dbh->prepare("INSERT IGNORE INTO `esoftcar_centralserver`.`intakes`( `Intake`, `C_Code`, `I_Status`) VALUES (?,?,'Inactive')");
    $stmt3->execute(array($value['DECEBER'],$value['BM_Course_Code']));

    }
     if(!empty($value['APRIL'])){
    
    $stmt2 = $dbh->prepare("UPDATE `batch_master` SET `BM_Target_Exam` = ? WHERE `BM_Batch_Code` =?");
    $stmt2->execute(array($value['APRIL'],$value['BM_Batch_Code']));
    
    $stmt3 = $dbh->prepare("INSERT IGNORE INTO `esoftcar_centralserver`.`intakes`( `Intake`, `C_Code`, `I_Status`) VALUES (?,?,'Inactive')");
    $stmt3->execute(array($value['APRIL'],$value['BM_Course_Code']));
    
    }
     if(!empty($value['AUGUST'])){
    
    $stmt2 = $dbh->prepare("UPDATE `batch_master` SET `BM_Target_Exam` = ? WHERE `BM_Batch_Code` =?");
    $stmt2->execute(array($value['AUGUST'],$value['BM_Batch_Code']));
    
    $stmt3 = $dbh->prepare("INSERT IGNORE INTO `esoftcar_centralserver`.`intakes`( `Intake`, `C_Code`, `I_Status`) VALUES (?,?,'Inactive')");
    $stmt3->execute(array($value['AUGUST'],$value['BM_Course_Code']));
    
    }
    
    }
    
}

catch (PDOException $e) {
    echo json_encode($e->getMessage());
    die();
    /* Recognize mistake and roll back changes */
    $dbh->rollBack();
    
}
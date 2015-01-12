<?php session_start();
 include("LogController.php");
exit;
    include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
	$DataBase = '';
$branches = array(
        "Ambalangoda" => "esoftcar_amb",
        "Anuradhapura" => "esoftcar_anu",
        "Avissawella" => "esoftcar_avi",
        "Badulla" => "esoftcar_bdl",
        "Bandarawela" => "esoftcar_ban",
        "Battaramulla" => "esoftcar_btm",
        "Batticaloa" => "esoftcar_bat",
        "Chilaw" => "esoftcar_clw",
        "Colombo" => "esoftcar_col",
        "Embilipitiya" => "esoftcar_ebm",
        "Galle" => "esoftcar_gal",
        "Gampaha" => "esoftcar_gam",
        "Hambantota" => "esoftcar_ham",
        "Hatton" => "esoftcar_hat",
        "Homagama" => "esoftcar_hom",
        "Jaela" => "esoftcar_jel",
        "Jaffna" => "esoftcar_jaf",
        "Kalmunai" => "esoftcar_kal",
        "Kandy" => "esoftcar_kan",
        "Kegalle" => "esoftcar_keg",
        "Kekirawa" => "esoftcar_kek",
        "Kilinochchi" => "esoftcar_kil",
        "Kiribathgoda" => "esoftcar_kir",
        "Kuliyapitiya" => "esoftcar_kul",
        "Kurunegala" => "esoftcar_kur",
        "Matale" => "esoftcar_mtl",
        "Matara" => "esoftcar_mat",
        "Minuwangoda" => "esoftcar_min",
        "Monaragala" => "esoftcar_mon",
        "Nawalapitiya" => "esoftcar_naw",
        "Negombo" => "esoftcar_neg",
        "Nelliyady" => "esoftcar_nel",
        "Nugegoda" => "esoftcar_nug",
        "Nuwara Eliya" => "esoftcar_ney",
        "Piliyandala" => "esoftcar_pil",
        "Polonnaruwa" => "esoftcar_pol",
        "Ratnapura" => "esoftcar_rat",
        "Trincomalee" => "esoftcar_tri",
        "Vavuniya" => "esoftcar_vav",
        "Wattala" => "esoftcar_wat",
        "Wennappuwa" => "esoftcar_wen",
        "Panadura" => "esoftcar_pan",
        "Kaluthara" => "esoftcar_klt",
        "Narammala" => "esoftcar_nar"
    );
	
	foreach($branches as $key=>$value){
	$sql="SELECT SUM(`PM_Amount`) SUMMERY FROM `".$value."`.`payments_master` WHERE MONTH(`PM_Date`) = MONTH(CURDATE()) AND YEAR(`PM_Date`) = YEAR(CURDATE())";
		$sth = $esoftConfig->prepare($sql);
		$sth->execute();
		$count = $sth->rowCount();
	
if($count)	{	
	$results = $sth->fetchAll(PDO::FETCH_ASSOC);	
$getRank[]=array(
        'BRANCH' => $key,
        'SUMMERY' => (int) $results[0]['SUMMERY']
    );
   /* array_push($getRank, (object) array(
        'BRANCH' => $key,
        'SUMMERY' => (int) $getRankResult[0][SUMMERY]
    ));
	*/
	}
	}
	
echo json_encode($getRank);	

?>

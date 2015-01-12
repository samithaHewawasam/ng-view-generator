<?php session_start();
include '../Modal/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Other Payments</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

	<!--link rel="stylesheet/less" href="Library/less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="Library/less/responsive.less" type="text/css" /-->
	<!--script src="Library/js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
<link href="Library/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="Library/css/style.css" rel="stylesheet" type="text/css">
<link href="Library/css/datepicker.css" rel="stylesheet" type="text/css">
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="Library/js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->

<!-- <link rel="shortcut icon" href="Library/img/favicon.png">-->
<script type="text/javascript" src="Library/js/jquery.min.js"></script>
<script type="text/javascript" src="Library/js/bootstrap.min.js"></script>
<script type="text/javascript" src="Library/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="Library/js/scriptt.js"></script> <!-- Costermize scripts use for payment type & clear textboxes -->
<script type="text/javascript" src="cardcheck.js"></script>
     
     

</head>

<body>
   <div style="display: none; position: absolute ! important; background-color:#5CB85C; z-index: 99999999; width: 350px; box-shadow: 0px 0px 5px green; top: 30%; right: 3%;" class="alert-warning" id="submit-errors">
      <button data-dismiss="alert" type="button" class="close"></button>
      <h5>Name: <span class="getName"></span></h5>
      <h5>Course  <span class="getBatch"></span></h5>
   </div>
   <div class="container">
   <div class="row clearfix">
      <div class="col-md-12 column">
         <div id="text" class="col-md-6">
            <font size="6" face="Georgia, Times New Roman, Times, serif" > Click Button For Other Payments  <br>
            <span class = "glyphicon glyphicon-chevron-down" id="img"></span></font>
         </div>
         <div id="button" class="col-md-6">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-container-722600">
            Other Payments
            </button>
         </div>
         <div class="modal fade" id="modal-container-722600" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h4 class="modal-title" id="myModalLabel">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="btn-group btn-breadcrumb">
                                 <a href="#" class="btn btn-primary">Other Payments</a>
                              </div>
                           </div>
                        </div>
                     </h4>
                  </div>
                  <div class="modal-body">
                     <form method="post"  class="form-inline" role="form" id="frms">
                        <fieldset>
                           <!-- Prepended text-->
                           <input name="p_type" id="types" type="hidden" >
                           <input type='hidden' id='StuName' name='c_name'>
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <p>Date</p>
                                    <div class="input-group">
                                       <input type="text" value="<?php echo date('Y-m-d') ?>" name="date" id="date1"  class="form-control" readonly>
                                    </div>
                                    <p class="help-block"></p>
                                 </div>
                              </div>
                           </div>
                           <!-- Prepended text-->
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <p>Receipt No:</p>
                                    <div class="input-group">
                                       <?php
                                         
                                         
                                                                                  
                                          $dbh =new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD,array(
    PDO::ATTR_PERSISTENT => true));
                                          $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                          $stmt=$dbh->prepare("SELECT `OP_Receipt_No` FROM `other_payments` ORDER BY `OP_Receipt_No` DESC LIMIT 1");
                                          $stmt->execute();
                                          $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                          
                                          foreach ($results as $row)
                                          {  
                                          echo "<input id='Receipt No' readonly value='$row[OP_Receipt_No]' name='Receipt_No' class='form-control' placeholder='COL/A-0001/04/2014' required='' type='text'>"; 
                                          }
                                          
                                          ?>                     
                                    </div>
                                 </div>
                                 <p class="help-block"></p>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <p>Reg No:</p>
                                    <div class="input-group">
                                       <input id="reg_n" name="reg_n" class="form-control" value="<?php echo $_SESSION['branchCode'].'-' ?>" placeholder="COL/A-000001" required="" type="text">
                                       <span></span>
                                    </div>
                                 </div>
                              </div>
                              <p class="help-block"></p>
                           </div>
                           <!-- Prepended text-->
                            <div class="row">
                              <div class="col-md-6">
                           <div class="form-group">
                              <p>Comment</p>
                              <div class="input-group">
                              <select name="comment" class="form-control">
                                 <option value="ICDL exam payments">ICDL exam payments</option>
                                 <option value="Moratuwa BIT exam fees">Moratuwa BIT exam fees</option>
                                 <option value="Extra book payments">Extra book payments</option>
                                 <option value="Card replacement fee">Card replacement fee</option>
                                 <option value="Certificate reprint fee">Certificate reprint fee</option>
                                 <option value="Edexel Cerificate payment">Edexel Cerificate payment</option>
                                 <option value="Other">Other</option>
                                 </select>
                                 
                                 
                              </div>
                           </div>
                           </div>
                           <div class="col-md-6">
                           <div class="form-group">
                              <p>Acceptable Currency</p>
                              <div class="input-group">
                                 <input id="accept" name="accepts" value="" class="form-control" placeholder="LKR" readonly required="" type="text">
                              </div>
                              <p class="help-block"></p>
                           </div></div></div>                           <h4>Payment Plan</h4>
                           <div id="tab" class="btn-group" data-toggle="buttons-radio">
                              <a id ="Cash" href="#cash" class="btn btn-large btn-info" data-toggle="tab">Cash</a>
                              <a id ="Credit_Card" href="#creditCard" class="btn btn-large btn-info" data-toggle="tab">Credit Card</a>
                              <a id ="Cheque" href="#cheque" class="btn btn-large btn-info" data-toggle="tab">Cheque</a>
                           </div>
                        </fieldset>
                        <div class="tab-content">
                           <div class="tab-pane " id="cash">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <p>How Much?</p>
                                       <div class="input-group">
                                          <div class="input-group-btn">
                                             <button type="button" class="btn btn-default dropdown-toggle " data-toggle="dropdown"> <span class="cur" id="curr1">LKR</span><span class="caret"></span></button>
                                             <input name="curree" id="qq" class="form-control" value="LKR" type="hidden">
                                             <input name="curree1" id="AmountAccspting" class="form-control" value="1" type="hidden">
                                             <ul class="dropdown-menu dropdown-menu1" >
                                                <li><a class="detect_currency"  data-currency="USD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">USD</span><span class="codeFull">United States Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="EUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EUR</span><span class="codeFull">Euro</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CAD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CAD</span><span class="codeFull">Canada Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="GBP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">GBP</span><span class="codeFull">United Kingdom Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="DEM" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DEM</span><span class="codeFull">Germany Deutsche Marks</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="FRF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FRF</span><span class="codeFull">France Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="JPY" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JPY</span><span class="codeFull">Japan Yen</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NLG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NLG</span><span class="codeFull">Netherlands Guilders</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ITL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ITL</span><span class="codeFull">Italy Lira</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CHF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CHF</span><span class="codeFull">Switzerland Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="DZD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DZD</span><span class="codeFull">Algeria Dinars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ARP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ARP</span><span class="codeFull">Argentina Pesos</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="AUD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">AUD</span><span class="codeFull">Australia Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ATS" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ATS</span><span class="codeFull">Austria Schillings</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BSD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BSD</span><span class="codeFull">Bahamas Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BBD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BBD</span><span class="codeFull">Barbados Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BEF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BEF</span><span class="codeFull">Belgium Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BMD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BMD</span><span class="codeFull">Bermuda Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BRR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BRR</span><span class="codeFull">Brazil Real</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BGL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BGL</span><span class="codeFull">Bulgaria Lev</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CAD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CAD</span><span class="codeFull">Canada Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CLP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CLP</span><span class="codeFull">Chile Pesos</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CNY" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CNY</span><span class="codeFull">China Yuan Renmimbi</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CYP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CYP</span><span class="codeFull">Cyprus Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CSK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CSK</span><span class="codeFull">Czech Republic Koruna</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="DKK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DKK</span><span class="codeFull">Denmark Kroner</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NLG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NLG</span><span class="codeFull">Dutch Guilders</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XCD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XCD</span><span class="codeFull">Eastern Caribbean Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="EGP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EGP</span><span class="codeFull">Egypt Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="EUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EUR</span><span class="codeFull">Euro</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="FJD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FJD</span><span class="codeFull">Fiji Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="FIM" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FIM</span><span class="codeFull">Finland Markka</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="FRF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FRF</span><span class="codeFull">France Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="DEM" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DEM</span><span class="codeFull">Germany Deutsche Marks</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XAU" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAU</span><span class="codeFull">Gold Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="GRD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">GRD</span><span class="codeFull">Greece Drachmas</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="HKD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">HKD</span><span class="codeFull">Hong Kong Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="HUF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">HUF</span><span class="codeFull">Hungary Forint</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ISK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ISK</span><span class="codeFull">Iceland Krona</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="INR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">INR</span><span class="codeFull">India Rupees</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="IDR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">IDR</span><span class="codeFull">Indonesia Rupiah</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="IEP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">IEP</span><span class="codeFull">Ireland Punt</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ILS" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ILS</span><span class="codeFull">Israel New Shekels</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ITL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ITL</span><span class="codeFull">Italy Lira</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="JMD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JMD</span><span class="codeFull">Jamaica Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="JPY" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JPY</span><span class="codeFull">Japan Yen</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="JOD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JOD</span><span class="codeFull">Jordan Dinar</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="KRW" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">KRW</span><span class="codeFull">Korea (South) Won</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="LBP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">LBP</span><span class="codeFull">Lebanon Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="LUF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">LUF</span><span class="codeFull">Luxembourg Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="MYR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">MYR</span><span class="codeFull">Malaysia Ringgit</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="MXP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">MXP</span><span class="codeFull">Mexico Pesos</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NLG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NLG</span><span class="codeFull">Netherlands Guilders</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NZD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NZD</span><span class="codeFull">New Zealand Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NOK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NOK</span><span class="codeFull">Norway Kroner</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="PKR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PKR</span><span class="codeFull">Pakistan Rupees</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XPD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPD</span><span class="codeFull">Palladium Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="PHP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PHP</span><span class="codeFull">Philippines Pesos</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XPT" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPT</span><span class="codeFull">Platinum Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="PLZ" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PLZ</span><span class="codeFull">Poland Zloty</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="PTE" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PTE</span><span class="codeFull">Portugal Escudo</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ROL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ROL</span><span class="codeFull">Romania Leu</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="RUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">RUR</span><span class="codeFull">Russia Rubles</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SAR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SAR</span><span class="codeFull">Saudi Arabia Riyal</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XAG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAG</span><span class="codeFull">Silver Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SGD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SGD</span><span class="codeFull">Singapore Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SKK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SKK</span><span class="codeFull">Slovakia Koruna</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ZAR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ZAR</span><span class="codeFull">South Africa Rand</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="KRW" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">KRW</span><span class="codeFull">South Korea Won</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ESP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ESP</span><span class="codeFull">Spain Pesetas</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XDR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XDR</span><span class="codeFull">Special Drawing Right (IMF)</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SDD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SDD</span><span class="codeFull">Sudan Dinar</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SEK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SEK</span><span class="codeFull">Sweden Krona</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CHF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CHF</span><span class="codeFull">Switzerland Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="TWD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">TWD</span><span class="codeFull">Taiwan Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="THB" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">THB</span><span class="codeFull">Thailand Baht</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="TTD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">TTD</span><span class="codeFull">Trinidad and Tobago Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="TRL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">TRL</span><span class="codeFull">Turkey Lira</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="GBP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">GBP</span><span class="codeFull">United Kingdom Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="USD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">USD</span><span class="codeFull">United States Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="VEB" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">VEB</span><span class="codeFull">Venezuela Bolivar</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ZMK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ZMK</span><span class="codeFull">Zambia Kwacha</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="EUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EUR</span><span class="codeFull">Euro</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XCD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XCD</span><span class="codeFull">Eastern Caribbean Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XDR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XDR</span><span class="codeFull">Special Drawing Right (IMF)</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XAG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAG</span><span class="codeFull">Silver Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XAU" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAU</span><span class="codeFull">Gold Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XPD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPD</span><span class="codeFull">Palladium Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XPT" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPT</span><span class="codeFull">Platinum Ounces</span></a>
                                                </li>
                                             </ul>
                                          </div>
                                          <input name="cashh" id="cashed" class="form-control" placeholder="4000.00" type="text">
                                       </div>
                                       <p class="help-block"></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="creditCard">
                              <div class="row"> 
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <p>How Much?</p>
                                    <div class="input-group">
                                       <div class="input-group-btn">
                                          <button type="button" class="btn btn-default dropdown-toggle " data-toggle="dropdown"> <span class="cur" id="curr2">LKR</span><span class="caret"></span></button>
                                          <ul class="dropdown-menu dropdown-menu1" >
                                             <li><a class="detect_currency"  data-currency="USD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">USD</span><span class="codeFull">United States Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="EUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EUR</span><span class="codeFull">Euro</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="CAD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CAD</span><span class="codeFull">Canada Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="GBP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">GBP</span><span class="codeFull">United Kingdom Pounds</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="DEM" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DEM</span><span class="codeFull">Germany Deutsche Marks</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="FRF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FRF</span><span class="codeFull">France Francs</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="JPY" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JPY</span><span class="codeFull">Japan Yen</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="NLG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NLG</span><span class="codeFull">Netherlands Guilders</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ITL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ITL</span><span class="codeFull">Italy Lira</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="CHF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CHF</span><span class="codeFull">Switzerland Francs</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="DZD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DZD</span><span class="codeFull">Algeria Dinars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ARP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ARP</span><span class="codeFull">Argentina Pesos</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="AUD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">AUD</span><span class="codeFull">Australia Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ATS" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ATS</span><span class="codeFull">Austria Schillings</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="BSD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BSD</span><span class="codeFull">Bahamas Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="BBD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BBD</span><span class="codeFull">Barbados Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="BEF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BEF</span><span class="codeFull">Belgium Francs</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="BMD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BMD</span><span class="codeFull">Bermuda Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="BRR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BRR</span><span class="codeFull">Brazil Real</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="BGL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BGL</span><span class="codeFull">Bulgaria Lev</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="CAD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CAD</span><span class="codeFull">Canada Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="CLP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CLP</span><span class="codeFull">Chile Pesos</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="CNY" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CNY</span><span class="codeFull">China Yuan Renmimbi</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="CYP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CYP</span><span class="codeFull">Cyprus Pounds</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="CSK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CSK</span><span class="codeFull">Czech Republic Koruna</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="DKK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DKK</span><span class="codeFull">Denmark Kroner</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="NLG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NLG</span><span class="codeFull">Dutch Guilders</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XCD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XCD</span><span class="codeFull">Eastern Caribbean Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="EGP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EGP</span><span class="codeFull">Egypt Pounds</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="EUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EUR</span><span class="codeFull">Euro</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="FJD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FJD</span><span class="codeFull">Fiji Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="FIM" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FIM</span><span class="codeFull">Finland Markka</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="FRF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FRF</span><span class="codeFull">France Francs</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="DEM" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DEM</span><span class="codeFull">Germany Deutsche Marks</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XAU" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAU</span><span class="codeFull">Gold Ounces</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="GRD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">GRD</span><span class="codeFull">Greece Drachmas</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="HKD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">HKD</span><span class="codeFull">Hong Kong Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="HUF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">HUF</span><span class="codeFull">Hungary Forint</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ISK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ISK</span><span class="codeFull">Iceland Krona</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="INR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">INR</span><span class="codeFull">India Rupees</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="IDR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">IDR</span><span class="codeFull">Indonesia Rupiah</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="IEP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">IEP</span><span class="codeFull">Ireland Punt</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ILS" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ILS</span><span class="codeFull">Israel New Shekels</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ITL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ITL</span><span class="codeFull">Italy Lira</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="JMD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JMD</span><span class="codeFull">Jamaica Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="JPY" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JPY</span><span class="codeFull">Japan Yen</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="JOD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JOD</span><span class="codeFull">Jordan Dinar</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="KRW" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">KRW</span><span class="codeFull">Korea (South) Won</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="LBP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">LBP</span><span class="codeFull">Lebanon Pounds</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="LUF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">LUF</span><span class="codeFull">Luxembourg Francs</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="MYR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">MYR</span><span class="codeFull">Malaysia Ringgit</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="MXP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">MXP</span><span class="codeFull">Mexico Pesos</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="NLG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NLG</span><span class="codeFull">Netherlands Guilders</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="NZD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NZD</span><span class="codeFull">New Zealand Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="NOK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NOK</span><span class="codeFull">Norway Kroner</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="PKR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PKR</span><span class="codeFull">Pakistan Rupees</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XPD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPD</span><span class="codeFull">Palladium Ounces</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="PHP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PHP</span><span class="codeFull">Philippines Pesos</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XPT" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPT</span><span class="codeFull">Platinum Ounces</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="PLZ" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PLZ</span><span class="codeFull">Poland Zloty</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="PTE" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PTE</span><span class="codeFull">Portugal Escudo</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ROL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ROL</span><span class="codeFull">Romania Leu</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="RUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">RUR</span><span class="codeFull">Russia Rubles</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="SAR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SAR</span><span class="codeFull">Saudi Arabia Riyal</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XAG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAG</span><span class="codeFull">Silver Ounces</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="SGD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SGD</span><span class="codeFull">Singapore Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="SKK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SKK</span><span class="codeFull">Slovakia Koruna</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ZAR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ZAR</span><span class="codeFull">South Africa Rand</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="KRW" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">KRW</span><span class="codeFull">South Korea Won</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ESP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ESP</span><span class="codeFull">Spain Pesetas</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XDR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XDR</span><span class="codeFull">Special Drawing Right (IMF)</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="SDD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SDD</span><span class="codeFull">Sudan Dinar</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="SEK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SEK</span><span class="codeFull">Sweden Krona</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="CHF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CHF</span><span class="codeFull">Switzerland Francs</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="TWD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">TWD</span><span class="codeFull">Taiwan Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="THB" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">THB</span><span class="codeFull">Thailand Baht</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="TTD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">TTD</span><span class="codeFull">Trinidad and Tobago Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="TRL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">TRL</span><span class="codeFull">Turkey Lira</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="GBP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">GBP</span><span class="codeFull">United Kingdom Pounds</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="USD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">USD</span><span class="codeFull">United States Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="VEB" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">VEB</span><span class="codeFull">Venezuela Bolivar</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="ZMK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ZMK</span><span class="codeFull">Zambia Kwacha</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="EUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EUR</span><span class="codeFull">Euro</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XCD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XCD</span><span class="codeFull">Eastern Caribbean Dollars</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XDR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XDR</span><span class="codeFull">Special Drawing Right (IMF)</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XAG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAG</span><span class="codeFull">Silver Ounces</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XAU" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAU</span><span class="codeFull">Gold Ounces</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XPD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPD</span><span class="codeFull">Palladium Ounces</span></a>
                                             </li>
                                             <li><a class="detect_currency"  data-currency="XPT" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPT</span><span class="codeFull">Platinum Ounces</span></a>
                                             </li>
                                          </ul>
                                       </div>
                                       <input  name="credit" id="credits" class="form-control" placeholder="4000.00" type="text">
                                    </div>
                                    <p class="help-block"></p>
                                 </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                 <p>Card Holder Name</p>
                                 <div class="input-group">
                                    <input  name="c_nameCard" id="cc_name" class="form-control" placeholder="Aruni" type="text">
                                 </div>
                                 <p class="help-block"></p>
                              </div>
                             </div>
                             </div>
                              
                              <script type="text/javascript">
                                 // Make sure that this code goes within a doc ready
                                 $(document).ready(function() {
                                     
                           // Step #1: Cache Sel          ectors
                                     var creditCard = $("#cc_no"),
                                         cardGrandParent = creditCard.parent().parent();
                                     
                                     // Step #2: Setup Callbacks on Events
                                     creditCard.on("cc:onReset cc:onGuess", function() {
                                 
                                         cardGrandParent.removeClass().addClass("control-group");
                                 
                                     }).on("cc:onInvalid", function() {
                                 
                                         cardGrandParent.removeClass().addClass("control-group error");
                                         $("#cc_no-type-text").text("");
                                 
                                     }).on("cc:onValid", function(event, card, niceName) {
                                 
                                         cardGrandParent.removeClass().addClass("control-group success");
                                 
                                     }).on("cc:onCardChange", function(event, card, niceName) {
                                 
                                         $("#cc_no-type-text").text(niceName);
                                  $("#QuickhiddenCreditCardType").val(niceName);
                                     // Step #3: Initialize the cardcheck plugin
                                     }).cardcheck({ iconLocation: "#Quickaccepted-cards-images" });
                                 
                                 });
                              </script>
                               <div class="row">
                              <div class="col-md-2">
                                 <div class="form-group ">
                                    <p>Card No</p>
                                    <div class="input-group">
                                       <input  name="c_no" id="cc_no" class="form-control" placeholder="3344" type="text" maxlength="4">
                                    </div>
                                    <p class="help-block"></p>
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group ">
                                    <p class="fnts">. </p>
                                    <div class="input-group">
                                       <input  name="c_no1" id="cc" class="form-control" placeholder="5566" type="text" maxlength="4">
                                    </div>
                                    <p class="help-block"></p>
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group ">
                                    <p class="fnts">.</p>
                                    <div class="input-group">
                                       <input  name="c_no2" id="cc1" class="form-control" placeholder="7788" type="text" maxlength="4">
                                    </div>
                                    <p class="help-block"></p>
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group ">
                                    <p class="fnts">.</p>
                                    <div class="input-group">
                                       <input  name="c_no3" id="cc2" class="form-control" placeholder="9900" type="text" maxlength="4">
                                    </div>
                                    <p class="help-block"></p>
                                 </div>
                              </div>
                              </div>
                            
                              <div class="form-group ">
                                 <p>Accepted Cards </p>
                                 <div class="pull-left" id="Quickaccepted-cards-images">
                                    <!-- Icons Automatically Inserted Here -->
                                 </div>
                              </div>
                             
                              <input type="hidden" id="QuickhiddenCreditCardType" name="PM_Card_Type" value="">             
                           </div>
                           <div class="tab-pane" id="cheque">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <p>How Much?</p>
                                       <div class="input-group">
                                          <div class="input-group-btn">
                                             <button type="button" class="btn btn-default dropdown-toggle " data-toggle="dropdown"> <span class="cur" id="curr3">LKR</span><span class="caret"></span></button>
                                             <ul class="dropdown-menu dropdown-menu1" >
                                                <li><a class="detect_currency"  data-currency="USD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">USD</span><span class="codeFull">United States Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="EUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EUR</span><span class="codeFull">Euro</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CAD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CAD</span><span class="codeFull">Canada Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="GBP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">GBP</span><span class="codeFull">United Kingdom Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="DEM" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DEM</span><span class="codeFull">Germany Deutsche Marks</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="FRF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FRF</span><span class="codeFull">France Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="JPY" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JPY</span><span class="codeFull">Japan Yen</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NLG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NLG</span><span class="codeFull">Netherlands Guilders</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ITL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ITL</span><span class="codeFull">Italy Lira</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CHF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CHF</span><span class="codeFull">Switzerland Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="DZD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DZD</span><span class="codeFull">Algeria Dinars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ARP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ARP</span><span class="codeFull">Argentina Pesos</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="AUD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">AUD</span><span class="codeFull">Australia Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ATS" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ATS</span><span class="codeFull">Austria Schillings</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BSD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BSD</span><span class="codeFull">Bahamas Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BBD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BBD</span><span class="codeFull">Barbados Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BEF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BEF</span><span class="codeFull">Belgium Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BMD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BMD</span><span class="codeFull">Bermuda Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BRR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BRR</span><span class="codeFull">Brazil Real</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="BGL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">BGL</span><span class="codeFull">Bulgaria Lev</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CAD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CAD</span><span class="codeFull">Canada Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CLP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CLP</span><span class="codeFull">Chile Pesos</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CNY" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CNY</span><span class="codeFull">China Yuan Renmimbi</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CYP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CYP</span><span class="codeFull">Cyprus Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CSK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CSK</span><span class="codeFull">Czech Republic Koruna</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="DKK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DKK</span><span class="codeFull">Denmark Kroner</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NLG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NLG</span><span class="codeFull">Dutch Guilders</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XCD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XCD</span><span class="codeFull">Eastern Caribbean Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="EGP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EGP</span><span class="codeFull">Egypt Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="EUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EUR</span><span class="codeFull">Euro</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="FJD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FJD</span><span class="codeFull">Fiji Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="FIM" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FIM</span><span class="codeFull">Finland Markka</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="FRF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">FRF</span><span class="codeFull">France Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="DEM" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">DEM</span><span class="codeFull">Germany Deutsche Marks</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XAU" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAU</span><span class="codeFull">Gold Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="GRD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">GRD</span><span class="codeFull">Greece Drachmas</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="HKD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">HKD</span><span class="codeFull">Hong Kong Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="HUF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">HUF</span><span class="codeFull">Hungary Forint</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ISK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ISK</span><span class="codeFull">Iceland Krona</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="INR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">INR</span><span class="codeFull">India Rupees</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="IDR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">IDR</span><span class="codeFull">Indonesia Rupiah</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="IEP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">IEP</span><span class="codeFull">Ireland Punt</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ILS" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ILS</span><span class="codeFull">Israel New Shekels</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ITL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ITL</span><span class="codeFull">Italy Lira</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="JMD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JMD</span><span class="codeFull">Jamaica Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="JPY" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JPY</span><span class="codeFull">Japan Yen</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="JOD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">JOD</span><span class="codeFull">Jordan Dinar</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="KRW" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">KRW</span><span class="codeFull">Korea (South) Won</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="LBP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">LBP</span><span class="codeFull">Lebanon Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="LUF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">LUF</span><span class="codeFull">Luxembourg Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="MYR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">MYR</span><span class="codeFull">Malaysia Ringgit</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="MXP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">MXP</span><span class="codeFull">Mexico Pesos</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NLG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NLG</span><span class="codeFull">Netherlands Guilders</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NZD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NZD</span><span class="codeFull">New Zealand Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="NOK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">NOK</span><span class="codeFull">Norway Kroner</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="PKR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PKR</span><span class="codeFull">Pakistan Rupees</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XPD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPD</span><span class="codeFull">Palladium Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="PHP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PHP</span><span class="codeFull">Philippines Pesos</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XPT" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPT</span><span class="codeFull">Platinum Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="PLZ" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PLZ</span><span class="codeFull">Poland Zloty</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="PTE" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">PTE</span><span class="codeFull">Portugal Escudo</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ROL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ROL</span><span class="codeFull">Romania Leu</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="RUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">RUR</span><span class="codeFull">Russia Rubles</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SAR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SAR</span><span class="codeFull">Saudi Arabia Riyal</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XAG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAG</span><span class="codeFull">Silver Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SGD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SGD</span><span class="codeFull">Singapore Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SKK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SKK</span><span class="codeFull">Slovakia Koruna</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ZAR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ZAR</span><span class="codeFull">South Africa Rand</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="KRW" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">KRW</span><span class="codeFull">South Korea Won</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ESP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ESP</span><span class="codeFull">Spain Pesetas</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XDR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XDR</span><span class="codeFull">Special Drawing Right (IMF)</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SDD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SDD</span><span class="codeFull">Sudan Dinar</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="SEK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">SEK</span><span class="codeFull">Sweden Krona</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="CHF" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">CHF</span><span class="codeFull">Switzerland Francs</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="TWD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">TWD</span><span class="codeFull">Taiwan Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="THB" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">THB</span><span class="codeFull">Thailand Baht</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="TTD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">TTD</span><span class="codeFull">Trinidad and Tobago Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="TRL" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">TRL</span><span class="codeFull">Turkey Lira</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="GBP" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">GBP</span><span class="codeFull">United Kingdom Pounds</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="USD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">USD</span><span class="codeFull">United States Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="VEB" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">VEB</span><span class="codeFull">Venezuela Bolivar</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="ZMK" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">ZMK</span><span class="codeFull">Zambia Kwacha</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="EUR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">EUR</span><span class="codeFull">Euro</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XCD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XCD</span><span class="codeFull">Eastern Caribbean Dollars</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XDR" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XDR</span><span class="codeFull">Special Drawing Right (IMF)</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XAG" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAG</span><span class="codeFull">Silver Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XAU" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XAU</span><span class="codeFull">Gold Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XPD" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPD</span><span class="codeFull">Palladium Ounces</span></a>
                                                </li>
                                                <li><a class="detect_currency"  data-currency="XPT" data-target="#myModal" data-toggle="modal"><span class="codeCurrency">XPT</span><span class="codeFull">Platinum Ounces</span></a>
                                                </li>
                                             </ul>
                                          </div>
                                          <input  name="chk" id="chk1" class="form-control" placeholder="4000.00" type="text">
                                       </div>
                                       <p class="help-block"></p>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <p>Cheque No</p>
                                       <div class="input-group">
                                          <input  name="chk_no" id="chk2" class="form-control" placeholder="45987952145" type="text">
                                       </div>
                                       <p class="help-block"></p>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <p>Due Date</p>
                                       <div class="input-group">
                                          <input type="text"  placeholder="YYYY-MM-DD" name="due_date" id="date2"  class="form-control" >
                                       </div>
                                       <p class="help-block"></p>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <p>Bank Name</p>
                                       <div class="input-group">
                                          <input name="bank" id="chk4" class="form-control" placeholder="Bank Of Ceylon" type="text">
                                       </div>
                                       <p class="help-block"></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                  <div class="form-group">
                  <label class="control-label" for="quickPay"></label>
                  <button id="quickPay" name="quickPay" class="btn btn-success" type="button">Pay Now &amp; Get the Print Preview</button>
                  <button id="reset" name="reset" type="reset" class="btn btn-default">Clear</button>
                  </div>
                  </form>
                  </div>
               </div>
            </div>
         </div>
         
         
         
         
         
         <!--Print Modal -->
         
         <div class="modal fade" id="printPdf" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button id="close" type="button" onClick="location.reload();" class="close" data-dismiss="modal" aria-hidden="true">×</button><br>
                     <div id="arrow"> 
                        <span class="glyphicon glyphicon-print"> <b> Print This Receipt </b> <span class="glyphicon glyphicon-arrow-down"></span> </span> 
                     </div>
                  </div>
                  <div class="modal-body" id="i">
                     <!-- Body content iframe call from out side-->
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal" onClick="location.reload();">Close</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         
         
         
         
         
         
         
         
         
         
         <!-- Modal -->
         <div class="modal fade" id="currency_cunverter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title" id="myModalLabel">Currency Converter</h4>
                  </div>
                  <div class="modal-body">
                     <form class="form-horizontal" role="form">
                        <div class="form-group">
                           <label for="inputEmail3" class="col-sm-4 control-label">Amount</label>
                           <div class="input-group">
                              <input type="text" class="form-control " id="AmountPaying" placeholder="15000">
                              <div class="help-block">
                                 <p id="prep"></p>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputPassword3" class="col-sm-4 control-label">Converted Amount</label>
                           <div class="input-group">
                              <input type="text" readonly class="form-control " id="convertedAmount" value="">
                           </div>
                        </div>
                        <input type="hidden" class="form-control" name="curree1" id="AmountAccspting">
                     </form>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="button" id="changcurr" class="btn btn-primary">Convert</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>
</html>



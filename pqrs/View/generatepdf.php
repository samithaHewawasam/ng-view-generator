<?php
   $Styles='<style type="text/css">
.topborder{border-top:#000000 thin solid}
.bottomborder{border-bottom:#000000 thin solid}
.divcon{width:95%;}
@page { margin: 20px;font-size:13px; }
body { margin: 20px;font-size:13px }
</style>';
	
	require_once("../Library/php/dompdf/dompdf_config.inc.php");

 // if ( get_magic_quotes_gpc() ){
    $content = stripslashes(file_get_contents(('../Controller/'.$_GET['File'])));
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($Styles.$content);
  $dompdf->set_paper('a4','portrait');
  $dompdf->render();

  $dompdf->stream("IncomeReport.pdf", array("Attachment" => false));

  exit(0);
//}

?>

<?php
  include("commonSlider.inc");
  $koek=readcookie("theCookie");
  $ppnr=$koek[0];

  $SP = $_REQUEST["v"];
  $part= $_REQUEST["v2"];
  $payoffOther = $_REQUEST["v3"];

  //Disadvantegous inequlity is part 1 (in which the other participant get e+g)
  //Advantegous inequlity is part 2 (in which the other participant get e-g


  if($part==1){
      insertRecord("socialPref","ppnr,disadvIneq","\"$ppnr\", \"$SP\"");
  } elseif($part==2){
      updateTableOne("socialPref","ppnr=$ppnr","advIneq","$SP");
  } elseif($part==3){
      updateTableOne("socialPref","ppnr=$ppnr","earnings","$SP");
      updateTableOne("socialPref","ppnr=$ppnr","earningsOther","$payoffOther");

      $other=lookUp("matchingSP","ppnr1='$ppnr'","ppnr2");
      //Fills the paymentSession table for final payment calculation
      updateTableOne("paymentSession","ppnr=$ppnr","paymentSP","$SP");
      updateTableOne("paymentSession","ppnr=$other","paymentSPOther","$payoffOther");

  }




  //echo $sValue;

?>

<?php
  include("commonSlider.inc");

  $table_name="subjects";
  $connection = @mysqli_connect(HOST,ADMIN, WWOORD) or die("Cannot connect to the database server");
  $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
  $sql3="SELECT * FROM $table_name ORDER BY `ppnr` ASC";
  $result=@mysqli_query($connection,$sql3) or die("Couldn't execute query ".$sql3);

  $tabel="<table class=rond align=center width=1000><tr class=oneven><th><b>Subject<b></th><th><b>Partner<b></th><th><b>Currentpage<b></th><th><b>Trial<b></th><th><b>Barg E <b></th><th><b>SP E<b></th> <th><b>SPOther E<b></th> <th><b>Total Earnings<b></th><th><b>IP<b></th><tr>";

  //$IPA=$_SERVER['REMOTE_ADDR'];

  $i=0;
  $numberOfSPOtherFilled = 0;
  while ($row=mysqli_fetch_array($result)) {

    $ppnummer=$row['ppnr'];
    //$tafelnummer=$row['tafelnummer'];
    //$tafelnummer = strtoupper($tafelnummer);
    $currentpage=$row['currentpage'];
    $trial=$row['trial'];

    $partner = findPartner($ppnummer,$trial);

    $earnings = lookUp("paymentSession","ppnr=$ppnummer","payment");

    $earningsSP = lookUp("paymentSession","ppnr=$ppnummer","paymentSP");

    $earningsSPOther = lookUp("paymentSession","ppnr=$ppnummer","paymentSPOther");

    $IPID= lookUp("subjects","ppnr=$ppnummer","subID");
    $subIPID = substr($IPID, -2);

    if ($earningsSPOther!=""){
      $numberOfSPOtherFilled++;
    }

    $earningsTotal = lookUp("paymentSession","ppnr=$ppnummer","totalPayment");


    $tabel .= "<tr class=oneven><td align=center>".$ppnummer."</td><td align=center>".$partner."</td><td align=center>".$currentpage."</td><td align=center>".$trial."</td><td align=center>".$earnings."</td><td align=center>".$earningsSP."</td><td align=center>".$earningsSPOther."</td><td align=center>".$earningsTotal."</td><td align=center>".$subIPID."</td></tr>";
    $i++;
  }
  $tabel .= "</table>";

  echo $tabel;



?>

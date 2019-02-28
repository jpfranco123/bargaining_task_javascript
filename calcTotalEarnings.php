<?php
include "commonSlider.inc";
//updateTableOne("commonParameters","name='startexp'","value","1");
for ($i=1; $i <= $NPlayers; $i++) {
  $earnings = lookUp("paymentSession","ppnr=$i","payment");

  $earningsSP = lookUp("paymentSession","ppnr=$i","paymentSP");

  $earningsSPOther = lookUp("paymentSession","ppnr=$i","paymentSPOther");

  $totalEarnings = $earnings + $earningsSP + $earningsSPOther;

  updateTableOne("paymentSession","ppnr=$i","totalPayment","$totalEarnings");

  # code...
}



header("Location: monitor.php");
?>

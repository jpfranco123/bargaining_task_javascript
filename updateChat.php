<?php

include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$result1 = orderDesc("LogChats","id");

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);


while($extract =mysql_fetch_array($result1)){
  if ($extract['ppnr']==$ppnr and $extract['trial']==$trial) {
    echo "You: ".$extract["Chat"]."<br>";
  } elseif ($extract['ppnr']==$partner and $extract['trial']==$trial) {
    echo "Other: ".$extract["Chat"]."<br>";
  }
}


?>

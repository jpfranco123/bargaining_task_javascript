<?php

include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$msg = $_REQUEST["v"];
$time = $_REQUEST["v2"];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");
$partner=findPartner($ppnr,$trial);

insertRecord("LogChats","ppnr, Chat,time,trial","\"$ppnr\", \"$msg\", \"$time\",\"$trial\"");
$result1 = orderDesc("LogChats","id");

while($extract =mysql_fetch_array($result1)){
  if ($extract['ppnr']==$ppnr and $extract['trial']==$trial) {
    echo "You: ".$extract["Chat"]."<br>";
  } elseif ($extract['ppnr']==$partner and $extract['trial']==$trial) {
    echo "Other: ".$extract["Chat"]."<br>";
  }
}


?>

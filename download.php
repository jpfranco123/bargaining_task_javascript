<?php
include "commonSlider.inc";

$folder=$_POST["folder"];


downloadCSV("commonParameters",$folder,$session);
downloadCSV("LogChats",$folder,$session);
downloadCSV("matching",$folder,$session);
downloadCSV("paymentSession",$folder,$session);
downloadCSV("sliderLog",$folder,$session);
downloadCSV("subjects",$folder,$session);
downloadCSV("trialInfo",$folder,$session);

downloadCSV("socialPref",$folder,$session);
downloadCSV("matchingSP",$folder,$session);

downloadCSV("timeMarks",$folder,$session);


//downloadCSV1("commonParameters",$folder,$session);

header("Location: monitor.php");
?>

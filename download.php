<?php
include "commonSlider.inc";

$folder=$_POST["folder"];

downloadCSVSQL("commonParameters",$folder,$session);
downloadCSVSQL("matching",$folder,$session);
downloadCSVSQL("paymentSession",$folder,$session);
downloadCSVSQL("sliderLog",$folder,$session);
downloadCSVSQL("subjects",$folder,$session);
downloadCSVSQL("trialInfo",$folder,$session);

downloadCSVSQL("socialPref",$folder,$session);
downloadCSVSQL("matchingSP",$folder,$session);

downloadCSVSQL("timeMarks",$folder,$session);

// downloadCSV("commonParameters",$folder,$session);
// downloadCSV("matching",$folder,$session);
// downloadCSV("paymentSession",$folder,$session);
// downloadCSV("sliderLog",$folder,$session);
// downloadCSV("subjects",$folder,$session);
// downloadCSV("trialInfo",$folder,$session);
//
// downloadCSV("socialPref",$folder,$session);
// downloadCSV("matchingSP",$folder,$session);
//
// downloadCSV("timeMarks",$folder,$session);


//downloadCSV1("commonParameters",$folder,$session);

header("Location: monitor.php");
?>

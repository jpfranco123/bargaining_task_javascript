<?php
include "commonSlider.inc";

$timeStart=$_REQUEST["v"];
$type=$_REQUEST["v2"];

if ($type==1){
  insertRecord("timeMarks","name, timeStamp","'startExp','$timeStart'");
} else {
  insertRecord("timeMarks","name, timeStamp","'Stamp','$timeStart'");
}


//updateTableOne("commonParameters","name='startexp'","value","1");
header("Location: monitor.php");
?>

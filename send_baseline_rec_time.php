<?php
  include("commonSlider.inc");
  $koek=readcookie("theCookie");
  $ppnr=$koek[0];

  $trial=lookUp("subjects","ppnr='$ppnr'","trial");

  $time_baseline = $_REQUEST["v"];
  $name_stamp = "Baseline_rec_start";
  //echo $name_stamp;

  insertRecord("timeMarks","ppnr, timeStamp, name","\"$ppnr\",\"$time_baseline\", \"$name_stamp\"");

?>

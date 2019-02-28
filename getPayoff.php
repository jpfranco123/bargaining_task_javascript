<?php
  include("commonSlider.inc");

  if (!$_COOKIE['theCookie']){
      header("Location: begin.html");
      exit();
  }

  $koek=readcookie("theCookie");
  $ppnr=$koek[0];

  $trial=lookUp("subjects","ppnr='$ppnr'","trial");

  $payoff=lookUp("trialInfo"," ppnr1='$ppnr' AND trial='$trial' ","payoff");

  echo $payoff;

  ?>

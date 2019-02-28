<?php
include("commonSlider.inc");
$koek=readcookie("theCookie");
$ppnr=$koek[0];
$payment=$showUpFee;
$allTrials = range(1, $totalTrials);
shuffle($allTrials);

$i=0;
$jTotalPayTrials=$totalPayTrials;
while ($i < $jTotalPayTrials) {
  $trialTemp=$allTrials[$i];
  $paymentTemp= lookUp("trialInfo","ppnr1=$ppnr and trial=$trialTemp","payoff");
  $agreement= lookUp("trialInfo","ppnr1=$ppnr and trial=$trialTemp","agreement");
  //in case that the trial was excluded:

  if($paymentTemp=="" || $agreement==2 ){
    $jTotalPayTrials+=1;
    $i++;
  } else{
    $payment += $paymentTemp;
    $i++;
  }
}

//insertRecord("paymentSession","ppnr, payment"," \"$ppnr\", \"$payment\" ");
updateTableOne("paymentSession","ppnr=$ppnr","payment","$payment");

?>

<!doctype html>
<html onContextMenu="return false;">
  <head>
	  <title>Waiting Page</title>
	  <!-- <link rel="stylesheet" href="generalConfig.css"/> -->
    <link rel="stylesheet" type="text/css" href="beleggensns.css" />
    <link rel="stylesheet" type="text/css" href="buttons.css" />

	  <script src="jquery-1.11.3.min.js"></script>

    <script>

      function startNextTrial(){
        window.location.replace('instructionsSP.php');
      }

      //Disables some functions
      window.location.hash="no-back-button";
      window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
      window.onhashchange=function(){window.location.hash="no-back-button";}

      function disableRefresh(netscape){
        var F5=(netscape||event).keyCode;
          //if(F5==116||F5==17||F5==8){
          if(F5==116||F5==17||F5==8||F5==82){
            if(!netscape){event.keyCode=0}
            return false;
            }
        }

      document.onkeydown=document.onkeypress=disableRefresh;

    </script>

  </head>

  <body>
  <h1 align="center"> Your Earnings for this part of the experiment are: $ <?php echo ($payment) ;?></h1>
  <h2 align="center"> Please click on NEXT when you are ready to start Part II of the experiment </h2>
  <div align="center">
    <button align="center" onclick="startNextTrial()" class="buttonblauw"> NEXT </button>
  </div>

  </body>

</html>

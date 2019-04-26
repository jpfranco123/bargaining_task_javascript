<?php
  include("commonSlider.inc");

  if (!$_COOKIE['theCookie']){
      header("Location: begin.html");
      exit();
  }

  $koek=readcookie("theCookie");
  $ppnr=$koek[0];
  updateTableOne("subjects","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);

  $trial=lookUp("subjects","ppnr='$ppnr'","trial");

  //$payoff=lookUp("trialInfo"," ppnr1='$ppnr' AND trial='$trial' ","payoff");
  //$thePie=pieSize($ppnr,$trial);

  //Checks if it is the last trial
  if($trial<$totalTrials){
    //$texto="When you are ready to start a new trial please click NEXT.";
    //$texto="A five seconds break:";
    $nextTrial =$trial + 1;
    $texto="Next Round: ".$nextTrial." out of ".$totalTrials.".";
    //updateTableOne("subjects","ppnr='$ppnr'","trial","$nextTrial");
    updateTableMore("subjects","ppnr=$ppnr","trial=\"$nextTrial\"");

  } else {
      $texto="This part of the experiment has finalized, please press the button to see your earnings.";
  }
?>


<!doctype html>
<html onContextMenu="return false;">
  <head>
  <title>Waiting Page</title>
  <link rel="stylesheet" href="generalConfig.css"/>
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <script src="jquery-1.11.3.min.js"></script>

  <script>
    var trial= <?php echo $trial; ?>;
    var totalTrials = <?php echo $totalTrials; ?>;
    var robotina = <?php echo $robot; ?>;

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

    function startNextTrial(){
      if (totalTrials > trial){
        document.getElementById("reminder").style.visibility="visible";
        setTimeout(function(){document.getElementById("breakTimer").innerHTML = 5;},0);
        setTimeout(function(){document.getElementById("breakTimer").innerHTML = 4;},1000);
        setTimeout(function(){document.getElementById("breakTimer").innerHTML = 3;},2000);
        setTimeout(function(){document.getElementById("breakTimer").innerHTML = 2;},3000);
        setTimeout(function(){document.getElementById("breakTimer").innerHTML = 1;},4000);
        setTimeout(function(){window.location.replace('bargaining_screen.php');},5000);
      } else {
        document.getElementById("botoncito").style.visibility="visible";
      }
    }

    function finalize(){
      window.location.replace("earnings.php");
    }

    /*
    if(robotina==1){
      startNextTrial();
    }
    */



  </script>

  </head>

  <body>


    <h5 class="textWaiting2"> <?php echo $texto ?></h5>

    <h1 class="textWaiting3"  id="breakTimer"> </h1>

    <h3 align="center" id="reminder" style="visibility:hidden" > Remember not to touch your face while the camera light is on. </h3>

    <div align="center">
      <button align="center" id="botoncito" onclick="finalize()" style="visibility:hidden" class="buttonoranje"> NEXT </button>
    </div>

    <script>
      startNextTrial();
    </script>

  </body>

</html>

<?php
//No es necesario incluirlo todavia
include("commonSlider.inc");
if (!$_COOKIE['theCookie']){
    header("Location: begin.html");
    exit();
}
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");

$partner=findPartner($ppnr,$trial);

$start_value=startValue($ppnumber,$trial);
$other_start_value=startValue($partner,$trial);
echo $other_start_value;

//$start_value=2;
//$other_start_value=2;


$iknowPie=knowPie($ppnr,$trial);

$thePie=pieSize($ppnr,$trial);

updateTableOne("subjects","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);

?>

<!doctype html>
<html onContextMenu="return false;">
  <head>
    <meta http-equi="refresh" content="30">
    <title>Efficient Bargaining</title>

    <link rel="stylesheet" href="generalConfig.css"/>
    <script src="jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="sliderConfig.css">
    <script src="js-webshim/dev/polyfiller.js"></script>
</head>
    <!-- <script>
    66: Video
    //configure before calling webshims.polyfill

    webshim.setOptions("forms-ext", {
      replaceUI: 'auto',
      "range": {
          "classes": "show-activevaluetooltip show-tickvalues"
         }
        });
        //webshim.setOptions('loadStyles', false);

        webshim.polyfill("forms forms-ext");

     </script> -->

     <!--Camera JS Coding:
     > Muaz Khan     - github.com/muaz-khan
     > MIT License   - www.webrtc-experiment.com/licence
     > Documentation - www.RecordRTC.org
     -->
     <!-- <script src="https://cdn.webrtc-experiment.com/gumadapter.js"></script> -->
     <!-- <script src="gumadapter.js"></script>
     <script src="RecordRTC1.js"></script> -->



<body>
  <div id="entirePage">

    <div class="divTitle" >
      <div id="pieInstructions">
      </div>
      <div id="timerDiv">
        ...
      </div>
      <div id="centerDiv">

        <canvas id=canvitas width="300" height="100"></canvas>

      </div>
    </div>

    <h1 id="iniOffer">  </h1>

    <!-- Slider 1 -->
    <h2 class="participantTitles"> You </h2>
    <div class="leftOfSlider" > <?php echo $minValue; ?> </div>
    <div class="divSlider" > <?php echo $maxValue; ?> </div>
    <div class="rightOfSlider" align="center" >

      <input type="range" id="slider1" class="slider" value=<?php echo $start_value;?> min=<?php echo $minValue; ?> max=<?php echo $maxValue; ?> step=<?php echo $Steps;?> list=tickmarks>
      <datalist id=tickmarks>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </datalist>
    </div>

    <!-- Slider 2 -->
    <div id="slider2Section" >
      <h2 class="participantTitles"> Other </h2>
      <div class="leftOfSlider" > <?php echo $minValue; ?> </div>
      <div class="divSlider" > <?php echo $maxValue; ?> </div>
      <div class="rightOfSlider" align="center" >
        <input type="range" id="slider2" class="slider" value=<?php echo $other_start_value; ?> min=<?php echo $minValue; ?> max=<?php echo $maxValue; ?> step=<?php echo $Steps;?> list=tickmarks disabled>
      </div>


      <p id="infoPHP2" align="center"> Waiting for Connection... </p>

    </div>

    <p id="infoPHP1" align="center"> Waiting for Connection... </p>

    <div id="videoSection" style="visibility:<?php echo $videoVisibility; ?>"  >
      <!-- Video Conference -->
      <!--
      <h2 class="insideVideo"> Video Conference </h2>
      -->

      <!-- local/remote videos container -->
      <!-- Fit video in container -->
      <div class="insideVideo" id="videos-container">
        <video id="videito" controls muted></video>
      </div>
    </div>

  </div>

  <div id="waitingPage" style="display:none" class="textWaiting">
      <h5 id="waitingPageTexto"> </h5>
    </div>






</body>

</html>

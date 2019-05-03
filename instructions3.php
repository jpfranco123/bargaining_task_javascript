<?php
include("commonSlider.inc");
Header("Cache-Control: must-revalidate");

if (!$_COOKIE['theCookie']){
  header("Location: begin.html");
  exit();
}

$koek=readcookie("theCookie");
$ppnr=$koek[0];
updateTableOne("subjects","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);
$part=$showChat*(-1)+2;
$menu=instructionMenu($_SERVER['PHP_SELF'], $ppnr,$part);

$insNextPage=  instructionsNextPage($_SERVER['PHP_SELF'], $ppnr, $part);

$insPrevPage=  instructionsPrevPage($_SERVER['PHP_SELF'], $ppnr, $part);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Instructions 3 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">
  <link rel="stylesheet" href="sliderConfig.css">


  <script>

    var d=35;
    //Diameter
    var xCanvasSize=300;
    var yCanvasSize=100
    var radius=30;
    var centerNx=0.5*xCanvasSize;
    var centerNy=radius;

    function cirkel(ctx, x, y, r, kleur){
      ctx.beginPath();
      ctx.arc(x, y, r, 0, 2 * Math.PI, false);
      ctx.fillStyle = kleur;
      ctx.fill();
    }

    function drawAlertCircle1(alertType){
      var b_canvas = document.getElementById("canvitas");
      var b_context = b_canvas.getContext("2d");
      if(alertType== -1){
        b_context.strokeStyle="white";
        b_context.textAlign="center";
        //b_context.font="30px";
        b_context.fillText("Place your initial offer",10,50,200);
      }else if(alertType==0){
        clearCanvas(b_context);
      } else if(alertType==1){
        cirkel(b_context, centerNx, centerNy, radius, "green");
      } else if (alertType==2) {
        cirkel(b_context, centerNx, centerNy, radius, "green");
        cirkel(b_context, centerNx-2*radius, centerNy, radius, "green");
        cirkel(b_context, centerNx+2*radius, centerNy, radius, "green");
      } else if (alertType==3) {
        cirkel(b_context, centerNx, centerNy, radius, "yellow");
        cirkel(b_context, centerNx-2*radius, centerNy, radius, "yellow");
        cirkel(b_context, centerNx+2*radius, centerNy, radius, "green");
      } else if (alertType==4) {
          cirkel(b_context, centerNx, centerNy, radius, "red");
      }
    }

    function drawAlertCircle2(alertType){
      var b_canvas = document.getElementById("canvitas2");
      var b_context = b_canvas.getContext("2d");
      if(alertType== -1){
        b_context.strokeStyle="white";
        b_context.textAlign="center";
        //b_context.font="30px";
        b_context.fillText("Place your initial offer",10,50,200);
      }else if(alertType==0){
        clearCanvas(b_context);
      } else if(alertType==1){
        cirkel(b_context, centerNx, centerNy, radius, "green");
      } else if (alertType==2) {
        cirkel(b_context, centerNx, centerNy, radius, "green");
        cirkel(b_context, centerNx-2*radius, centerNy, radius, "green");
        cirkel(b_context, centerNx+2*radius, centerNy, radius, "green");
      } else if (alertType==3) {
        cirkel(b_context, centerNx, centerNy, radius, "yellow");
        cirkel(b_context, centerNx-2*radius, centerNy, radius, "yellow");
        cirkel(b_context, centerNx+2*radius, centerNy, radius, "green");
      } else if (alertType==4) {
          cirkel(b_context, centerNx, centerNy, radius, "red");
      }
    }

   </script>
</HEAD>

<BODY>
  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td>
    <p align=center><?php echo $menu; ?></p>
    <H1 align=center> Basics 2 </H1>

    <p> <b> During the first <?php echo $timeForIniOffer/1000; ?>  seconds, participants select their initial offers</b>. During this period, your slider will not be seen by the other participant. Note that the initial location of the cursors is random. </p>

    <p> <b> In the following <?php echo $Time/1000; ?> seconds you will bargain with the other participant. </b> Clicking the mouse on a different part of the slider moves the cursor. A <b>deal</b> is made when <b>both cursors are in the same place for <?php echo $timeForDeal/1000; ?> second<?php echo ($timeForDeal == 1000 ? "" : "s"); ?> </b> or if <b> both sliders are matching when the time is over.</b></p>

    <p> When the position of both cursors on the slider match, a green circle will appear: </p>

    <br>

        <canvas id=canvitas width="300" height="100"></canvas>
        <script> drawAlertCircle1(1); </script>

    <p>When both cursors have been in the same place for <?php echo $timeForWarning/1000; ?> second<?php echo ($timeForWarning == 1000 ? "" : "s"); ?>, two additional circles will appear: </p>

    <br>

        <canvas id=canvitas2 width="300" height="100"></canvas>
        <script> drawAlertCircle2(2); </script>


    <br>
    <p style="float:right"><a href=<?php echo $insNextPage; ?> class="buttonblauw">Continue</a>
    <br>
    <p align=left><a href=<?php echo $insPrevPage; ?> class="buttonblauw">Back</a>
    </td></tr>
  </table>

</BODY>
</HTML>

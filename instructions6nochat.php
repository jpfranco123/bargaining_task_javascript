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
  <TITLE> Instructions 6 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">



</HEAD>

<BODY>
  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td>
    <p align=center><?php echo $menu; ?></p>
    <H1 align=center> Video Recording </H1>

    <p> During every trial your face will be recorded. For the video recording it is important that your hands, or anything else, do not interfere between the camera and your face (i.e. do not touch or scratch your face while the camera light is on). </p>

    <!--
    <p> Throughout the game your skin conductance and heart rate will also be measured. </p>
  -->

    <br>
    <p style="float:right"><a href=<?php echo $insNextPage; ?> class="buttonblauw">Continue</a>
    <br>
    <p align=left><a href=<?php echo $insPrevPage; ?> class="buttonblauw">Back</a>
    </td></tr>
  </table>

</BODY>
</HTML>

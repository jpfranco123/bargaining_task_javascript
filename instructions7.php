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
  <TITLE> Instructions 5 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">

</HEAD>

<BODY>
  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td>
    <p align=center><?php echo $menu; ?></p>
    <H1 align=center> Mediation </H1>

    <p><b>There will be 2 types of trials:</b></p>

    <p> In 40 trials you will be playing the normal bargaining task presented previously.</p>

    <p> In the other 40 trials you will be playing a modified version of the bargaining task called the mediation task. It differs from the original task in that you will only have 7 seconds to reach an agreement and if no agreement is made the trial is over and a mediation protocol is imposed. The rules of the mediation are shown below.</p>

    <p> Before each trial you will be informed whether the trial is a <b>normal bargaining trial</b> or a <b>mediation trial</b>.

    <br>
    
    <h2> Mediation protocol </h2>

    <p>For this type of trials, if no agreement is made, mediation is imposed. Under the mediation protocol the payoff to each participant will depend on:

    <p> (1) the reported pie-size by the informed participant and </p>
    <p> (2) an indirect pie-size estimation. </p>

    <p> For (2) we will apply a statistical algorithm to the slider values and measure of physiological activity in order to guess whether the pie size of each trial was either $2 or $6.</p>

    <p> The payments for the informed and uninformed participants are summarised in the tables 1-3 </p>

    <br>
    <p style="float:right"><a href=<?php echo $insNextPage; ?> class="buttonblauw">Continue</a>
    <br>
    <p align=left><a href=<?php echo $insPrevPage; ?> class="buttonblauw">Back</a>
    </td></tr>
  </table>

</BODY>
</HTML>

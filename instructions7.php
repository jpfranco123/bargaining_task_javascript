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
$part=1;
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

    <p><b>There will be 2 types of rounds:</b></p>

    <p> On some rounds you will be playing the normal bargaining task presented previously.</p>

    <p> On the other rounds you will be playing a modified version of the bargaining task called the mediation task. It differs from the original task in that you will only have 7 seconds to reach an agreement and if no agreement is made, the round is over and a mediation protocol is implemented. The rules of the mediation protocol are shown below.</p>

    <p> Before each round you will be informed whether the round is a <b>normal task round</b> or a <b>mediation task round</b>.

    <br>

    <h2> Mediation protocol </h2>

    <p> For this type of rounds, if no agreement is reached, mediation is implemented. Under the mediation protocol the payment to each participant will depend on:

    <p> (1) the reported pie-size by the informed participant and </p>
    <p> (2) an indirect pie-size estimation by an algorithm. </p>

    <p> For (2) we will guess whether the pie size of each round was either $2 or $6 by applying a statistical algorithm using the data of the informed participant's pie-size report, the slider movements and the data collected via the electrodes and the camera.</p>

    <p> The payments for the informed and uninformed participants are summarised in the tables 1, 2 and 3. </p>

    <p> Note that the final payments for this section will not be revealed until the next session. </p>

    <br>
    <p style="float:right"><a href=<?php echo $insNextPage; ?> class="buttonblauw">Continue</a>
    <br>
    <p align=left><a href=<?php echo $insPrevPage; ?> class="buttonblauw">Back</a>
    </td></tr>
  </table>

</BODY>
</HTML>

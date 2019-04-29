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
    <H1 align=center> Payment and Rounds </H1>

    <h2>Payment</h2>

    <p>If a deal is made, the informed participant’s payment is equal to the pie size minus the negotiated uninformed participant’s payment. If the agreement exceeds the pie size, the payment of the informed participant will be negative. </p>

    <p>If no deal has been made after <?php echo ($Time/1000); ?> seconds of bargaining, both participants get $0. </p>


    <h2>Roles and Rounds</h2>

    <p> The experiment consists of <?php echo $totalTrials; ?> rounds. The roles (informed and uniformed) are randomly assigned and <b>fixed for the duration of the experiment</b>. Before each round, informed and uninformed participants are randomly matched. </p>

    <p> After each round, both participants will be informed about the pie size and their payments. </p>

    <br>
    <p style="float:right"><a href=<?php echo $insNextPage; ?> class="buttonblauw">Continue</a>
    <br>
    <p align=left><a href=<?php echo $insPrevPage; ?> class="buttonblauw">Back</a>
    </td></tr>
  </table>

</BODY>
</HTML>

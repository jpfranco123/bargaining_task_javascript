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
//$part=$showChat*(-1)+2;
//$menu=instructionMenu($_SERVER['PHP_SELF'], $ppnr,$part);

//$insNextPage=  instructionsNextPage($_SERVER['PHP_SELF'], $ppnr, $part);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Instructions Part II </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
</HEAD>

<BODY>
  <br>
  <br>

  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td>
    <H1 align=center>Instructions</H1>

    <h3 align=center> Welcome to Part II of the experiment.</h3>

    <p align=center>In this section you will be asked to make <b>10 decisions.</b> In each of the 10 decision problems you are asked to decide between <b>two alternatives</b>, which are called <b>LEFT</b> and <b>RIGHT</b>. Each alternative <b>implies earnings for you and another, randomly selected, person in this room.</b> </p>

    <p align=center> At the end of the experiment (after you have made the 10 choices in private), <b>one of the 10 decision problems will be randomly selected</b> as the payment-relevant one. Your previous choice on that problem will determine the payment for you and the other, randomly selected, person.</p>

    <p align=center> During the experiment you are not allowed to communicate. If you have any questions at any time, please raise your hand. An experimenter will assist you privately. You will make your decisions privately and anonymously. Your name will never be linked to your decisions and other participants will never be able to link you with your personal decisions or earnings from the experiment. </p>

    <p align=center> Your earnings will be paid to you privately at the end of today's session.</p>

    <br>
    <p align=center><a href="socialPreferences.php" class="buttonblauw">Continue</a>
    </td></tr>
  </table>

</BODY>
</HTML>

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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Instructions 1 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
</HEAD>

<BODY>
  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td>
    <p align=center><?php echo $menu; ?></p>
    <H1 align=center>Welcome</H1>

    <p> Welcome to this experiment. During the experiment you are not allowed to communicate. If you have any questions at any time, please raise your hand. An experimenter will assist you privately. </p>

    <p>You will make your decisions privately and anonymously. Your name will never be linked to your decisions and other participants will never be able to link you with your personal decisions or earnings from the experiment. </p>

    <p> You are <b>not allowed to use your cellphone </b> at any moment during the experiment. If you haven’t turned it off yet, please do so at this moment and put it away.</p>

    <p> Your earnings depend on your decisions and the decisions of other participants. Your earnings will be paid to you privately at the end of today's session.</p>

    <br>
    <p align=center><a href=<?php echo $insNextPage; ?> class="buttonblauw">Continue</a>
    </td></tr>
  </table>

</BODY>
</HTML>

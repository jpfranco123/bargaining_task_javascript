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
    <H1 align=center> Mediation or Normal task? </H1>

    <p><b> In order to select which task to perform each participant will have to decide whether they want to paricipate in the mediation task. </b></p>

    <p> Each round during the initial offer screen participants will be asked to choose between two options by clicking on one of two buttons: </p>

    <div class="row">
    <div class="column" id="pie_report_div" style="width:50%;visibility:hidden;border:4px solid #fb9e25;">
      <!-- <p id="pie_reported_both" style="visibility:hidden;font-size:40px;"> </p> -->
      <p align="center" id="pie_report_text" style="font-size:40px;"> Please report a pie size </p>
      <div align="center">
        <button align="left" id="report2" value=2 onclick="report_pie(this.value)" style="height:120px;width:120px;font-size:60px;display: inline-block;" class="buttonoranje"> $2 </button>
        <p align="center" id="pie_report" style="font-size:60px;display: inline-block;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>
        <button align="right" id="report6" value=6 onclick="report_pie(this.value)" style="height:120px;width:120px;font-size:60px;display: inline-block;" class="buttonoranje"> $6 </button>
      </div>
    </div>
  </div>

    <p> If BOTH participants decide to participate in the mediation (that is, choose 'YES') then there is a chance of <?php echo $prob_mech_choice_selec*100; ?>% that the mediation task is selected and a chance of <?php echo (1-$prob_mech_choice_selec)*100; ?>% that the normal task is selected. </p>

    <p> If one or the two participants decide not to participate in the mediation process (that is, choose 'NO'), then there is a chance of <?php echo $prob_mech_choice_selec*100; ?>% that the normal task is selected and a chance of <?php echo (1-$prob_mech_choice_selec)*100; ?>% that the mediation task is selected. </p>

    <br>

    <p> <b>BOTH participants MUST click on a blue button. </b> If you don't click on a button, then $0.3 will be substracted from your final payment.</p>

    <br>
    <p style="float:right"><a href=<?php echo $insNextPage; ?> class="buttonblauw">Continue</a>
    <br>
    <p align=left><a href=<?php echo $insPrevPage; ?> class="buttonblauw">Back</a>
    </td></tr>
  </table>

</BODY>
</HTML>

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

$valueStart=mt_rand($minValue,$maxValue/$Steps)*$Steps;

$insNextPage=  instructionsNextPage($_SERVER['PHP_SELF'], $ppnr, $part);

$insPrevPage=  instructionsPrevPage($_SERVER['PHP_SELF'], $ppnr, $part);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Instructions 2 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">
  <link rel="stylesheet" href="sliderConfig.css">
  <script src="jquery-1.11.3.min.js"></script>
  <script src="js-webshim/dev/polyfiller.js"></script>


  <script>
  //configure before calling webshims.polyfill

  webshim.setOptions("forms-ext", {
    replaceUI: 'auto',
    "range": {
        "classes": "show-activevaluetooltip show-tickvalues"
       }
      });
      //webshim.setOptions('loadStyles', false);

      webshim.polyfill("forms forms-ext");

      function updateNumber(valor){
          document.getElementById("infoPHP1").innerHTML = valor;
      }

   </script>
</HEAD>

<BODY>
  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td>
    <p align=center><?php echo $menu; ?></p>
    <H1 align=center> Basics 1 </H1>
    <p>This is an experiment about bargaining. You will have <?php echo $totalTrials; ?> rounds of bargaining. </p>

    <p> <b> In the negotiation, two participants bargain on how to split an amount of money: the pie size. </b> </p>

    <p> <b> One participant (the informed participant) is told the total amount of money (pie size) in each round.</b> This amount will be $<?php echo $lowValuePie; ?>  or $<?php echo $highValuePie; ?> , chosen randomly with equal probability in each round. The amount will appear on the top left corner of the informed participant’s screen. </p>

    <p> <b> The other participant (the uninformed participant) is not informed of the pie size.</b> During each round, participants bargain over the uninformed participant’s payment.  </p>

    <p>You and the other participant negotiate by moving a cursor on a slider that represent values from $<?php echo $minValue; ?> to $<?php echo $maxValue; ?>. <b> Amounts on the slider represent the uninformed participant’s payment. </b>  You can try this below: </p>

    <h2 class="participantTitles"> You </h2>
    <div class="leftOfSlider" > <?php echo $minValue; ?> </div>
    <div class="divSlider" > <?php echo $maxValue; ?> </div>
    <div class="rightOfSlider" align="center" >

      <input onChange="updateNumber(this.value)" type="range" id="slider1" class="slider" value=<?php echo $valueStart;?> min=<?php echo $minValue; ?> max=<?php echo $maxValue; ?> step=<?php echo $Steps;?> list=tickmarks>
      <datalist id=tickmarks>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </datalist>
    </div>

    <p id="infoPHP1" align="center"> <?php echo $valueStart;?> </p>

    <br>
    <p style="float:right"><a href=<?php echo $insNextPage; ?> class="buttonblauw">Continue</a>
    <br>
    <p align=left><a href=<?php echo $insPrevPage; ?> class="buttonblauw">Back</a>
    </td></tr>
  </table>



</BODY>
</HTML>

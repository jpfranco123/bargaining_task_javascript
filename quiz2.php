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

$insNextPage = instructionsNextPage($_SERVER['PHP_SELF'], $ppnr, $part);

$valueDeal1=mt_rand($minValue,$maxValue/$Steps)*$Steps;
$valueDeal2=mt_rand($minValue,$maxValue/$Steps)*$Steps;

$correctA1a=$highValuePie-$valueDeal1;
$correctA1b=$valueDeal1;
$correctA2a=$lowValuePie-$valueDeal2;
$correctA2b=$valueDeal2;



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Quiz 2 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">

  <script>
  //66

  function controleren(form) {
    var answer1=document.forms['form1'].q1a.value;
    var answer2=document.forms['form1'].q1b.value;
    var answer3=document.forms['form1'].q2a.value;
    var answer4=document.forms['form1'].q2b.value;
  	if (answer1== <?php echo $correctA1a; ?> && answer2== <?php echo $correctA1b; ?> && answer3==<?php echo $correctA2a; ?>  && answer4==<?php echo $correctA2b; ?> ) {
      if("<?php echo $insNextPage; ?>"=="waittostart.php"){
          alert("Correct!\nYou have finished the instructions and the quiz questions.");
          return true;
      } else{
          alert("Correct!\nYou will now proceed to the next set of questions.");
          return true;
      }

  	}
  	else {

      //This is the code if you want to show which questions are wrong
      var incorrectQuestions = "";
      if (answer1 != <?php echo $correctA1a; ?>){
        incorrectQuestions += "1";
      }
      if (answer2 != <?php echo $correctA1b; ?>){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 2";
        } else {
          incorrectQuestions += "2";
        }
      }
      if (answer3 != <?php echo $correctA2a; ?>){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 3";
        } else {
          incorrectQuestions += "3";
        }
      }
      if (answer4 != <?php echo $correctA2b; ?>){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 4";
        } else {
          incorrectQuestions += "4";
        }
      }


  		alert("You did not answer all questions correctly (Specifically: " + incorrectQuestions + "). Please look at the instructions again or raise your hand if you need any help. \n\nHint: Amounts on the slider represent the uninformed participant’s payoff. The informed participant’s payoff is equal to the pie size minus the negotiated uninformed participant’s payoff.");
      //TO not show which questions aare wrong:
      //alert("You did not answer all questions correctly. Please look at the instructions again or raise your hand if you need any help. \n\nHint: Amounts on the slider represent the uninformed participant’s payoff. The informed participant’s payoff is equal to the pie size minus the negotiated uninformed participant’s payoff.");
  		return false;
  	}
  }
  </script>



</HEAD>

<BODY>

  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr><td colspan=2>
  <p align=center><?php echo $menu; ?></p>

  <H1 align=center>Quiz Questions II</H1>


  <form name="form1" action=<?php echo $insNextPage; ?> onsubmit="return controleren(this)">
  	<table width="90%" border="0" cellpadding="0" align=center>
  		<tr><td><br></td></tr>

  		<tr>
  			<td><b>The pie size is $<?php echo $highValuePie; ?>. Cursors were matched in $<?php echo $valueDeal1; ?>. </b></td>
      </tr>
  		<tr>

      <tr><td><br></td></tr>

  			<td>How much money does the <b> informed participant </b> get? <input type="text" name="q1a" size=2 AUTOCOMPLETE="OFF"></td>

        <tr><td><br></td></tr>

        <td>How much does the <b> uninformed participant </b> get? <input type="text" name="q1b" size=2 AUTOCOMPLETE="OFF"></td>

  		</tr>
  		<tr><td><br></td></tr>

      <tr>
        <td><b> The pie size is $<?php echo $lowValuePie; ?>. Cursors were matched in $<?php echo $valueDeal2; ?>. </b></td>
      </tr>
      <tr>

      <tr><td><br></td></tr>

        <td>How much money does the <b> informed participant </b> get? <input type="text" name="q2a" size=2 AUTOCOMPLETE="OFF"></td>

        <tr><td><br></td></tr>

        <td>How much does the <b> uninformed participant </b> get? <input type="text" name="q2b" size=2 AUTOCOMPLETE="OFF"></td>

      </tr>

  		<tr><td><br></td></tr>
  		<tr>
  		<td align=center><input name="verzend" type="submit" class="buttonblauw" value="OK"></td>
  		</tr>

  	</table>
  </form>
  </td></tr>
  </table>

</BODY>
</HTML>

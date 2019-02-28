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

$valueDeal1=mt_rand($minValue,($maxValue-0.5)/$Steps)*$Steps;
$valueDeal2=mt_rand($minValue,$lowValuePie/$Steps)*$Steps;

$correctA2a=$lowValuePie-$valueDeal2;
$correctA2b=$valueDeal2;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Quiz 3 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">

  <script>
  //66

  function controleren(form) {
    var answer1=document.forms['form1'].q1.value;
    var answer2=document.forms['form1'].q2a.value;
    var answer3=document.forms['form1'].q2b.value;
  	if (answer1== "correct" && answer2== <?php echo $correctA2a; ?> && answer3==<?php echo $correctA2b; ?> ) {
      if("<?php echo $insNextPage; ?>"=="baselineRecording.php"){
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
      if (answer1 != "correct"){
        incorrectQuestions += "1";
      }
      if (answer2 != <?php echo $correctA2a; ?>){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 2";
        } else {
          incorrectQuestions += "2";
        }
      }
      if (answer3 != <?php echo $correctA2b; ?> ){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 3";
        } else {
          incorrectQuestions += "3";
        }
      }
      alert("You did not answer all questions correctly (Specifically: " + incorrectQuestions + "). Please look at the instructions again or raise your hand if you need any help. \n\nHint: Bargaining stops only when there is a deal or when time is over. When there is a match at the last moment, and it is kept until the time is over, there is a deal.");

      //TO not show which questions aare wrong:
  		//alert("You did not answer all questions correctly. Please look at the instructions again or raise your hand if you need any help. \n\nHint: Bargaining stops only when there is a deal or when time is over. When there is a match at the last moment, and it is kept until the time is over, there is a deal.");
  		return false;
  	}
  }
  </script>



</HEAD>

<BODY>

  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr><td colspan=2>
  <p align=center><?php echo $menu; ?></p>

  <H1 align=center>Quiz Questions III</H1>


  <form name="form1" action=<?php echo $insNextPage; ?> onsubmit="return controleren(this)">
  	<table width="90%" border="0" cellpadding="0" align=center>
  		<tr><td><br></td></tr>

      <tr>
  			<td><b>The pie size is $<?php echo $highValuePie; ?>. After five seconds of bargaining both participants match on $<?php echo $valueDeal1; ?>. One second later the informed participant changes his offer to $<?php echo $valueDeal1+0.5; ?>. What is going to happen? </b></td>
  		</tr>
      <tr>
  			<td><input type="radio" name="q1" value="incorrect"> Both participants get $0<br><input type="radio" name="q1" value="incorrect"> The uninformed participant gets $<?php echo $valueDeal1; ?> and the informed participant gets $<?php echo $highValuePie-$valueDeal1; ?><br>
          <input type="radio" name="q1" value="incorrect"> The uninformed participant gets $<?php echo $valueDeal1+0.5; ?> and the informed participant gets $<?php echo $highValuePie-($valueDeal1+0.5); ?> <br><input type="radio" name="q1" value="correct"> They continue bargaining </td>
  		</tr>

        <tr><td><br></td></tr>

      <tr>
        <td><b> The pie size is $<?php echo $lowValuePie; ?>. Both participants match the cursor on $<?php echo $valueDeal2; ?> when the timer shows 1 second left, and do not change their offer afterwards.</b></td>
      </tr>
      <tr>

      <tr><td><br></td></tr>

        <td>How much money does the <b>informed participant</b> get? <input type="text" name="q2a" size=2 AUTOCOMPLETE="OFF"></td>

        <tr><td><br></td></tr>

        <td>How much does the <b>uninformed participant </b> get? <input type="text" name="q2b" size=2 AUTOCOMPLETE="OFF"></td>

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

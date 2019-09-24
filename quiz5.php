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
    var answer1=document.forms['form1'].q1a.value;
    var answer2=document.forms['form1'].q1b.value;
    var answer3=document.forms['form1'].q2.value;
  	if (answer1== "4.4" && answer2== "correct" && answer3== "correct" ) {
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

      // var incorrectQuestions = "";
      // var hints = "";
      // if (answer1 != "correct"){
      //   incorrectQuestions += "1";
      //   hints = "The answer is in the tables. However, feel free to ask the researchers for help, they will be happy to explain the tables to you." + hints
      // }
      // if (answer2 != <?php echo $correctA2a; ?>){
      //   if (incorrectQuestions != ""){
      //     incorrectQuestions += ", 2";
      //   } else {
      //     incorrectQuestions += "2";
      //   }
      //   hints = "The payment to the informed participant will depend on the actual pie size. "  + hints
      // }
      // if (answer3 != <?php echo $correctA2b; ?> ){
      //   if (incorrectQuestions != ""){
      //     incorrectQuestions += ", 3";
      //   } else {
      //     incorrectQuestions += "3";
      //   }
      //   hints = "If an agreement is made, the mediation protocol is NOT implemented. " + hints
      // }
      hints = "";
      hints = hints + "If an agreement is made, the mediation protocol is NOT implemented. " + " \n\n ";
      hints = hints +  "The payment will only depend on the tables if an agreement is NOT reached on a mediation trial" + " \n\n"  + hints;
      var msg = "You did not answer all questions correctly. Please raise your hand if you need any help. \n\nHint: "
      alert( msg + hints);

  		return false;
  	}
  }
  </script>



</HEAD>

<BODY>

  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr><td colspan=2>
  <p align=center><?php echo $menu; ?></p>

  <H1 align=center>Quiz Questions V</H1>


  <form name="form1" action=<?php echo $insNextPage; ?> onsubmit="return controleren(this)">
  	<table width="90%" border="0" cellpadding="0" align=center>
  		<tr><td><br></td></tr>

      <tr>
        <td><b> You are in a mediation round. An agreement is NOT reached and the time ends. The informed participant reported a pie size of $2 and the algorithm predicts a pie-size of $6.</b></td>
      </tr>
      <tr>

      <tr><td><br></td></tr>

        <td>How much money does the <b>uninformed participant</b> get? <input type="text" name="q1a" size=2 AUTOCOMPLETE="OFF"></td>

        <tr><td><br></td></tr>

        <td>How much does the <b>informed participant </b> get?  <br>

        <input type="radio" name="q1b" value="incorrect"> $1.6 <br><input type="radio" name="q1b" value="incorrect"> $-2.4 <br><input type="radio" name="q1b" value="correct"> Depends on the pie size </td>

        <tr><td><br></td></tr>

      </tr>



      <tr>
  			<td><b> You are in a mediation trial. An agreement is reached before the time ends. If the informed participant reported a pie size of $6 and the algorithm predicts a pie-size of $6, what will be the payment of the uninformed participant? </b></td>
  		</tr>
      <tr>
  			<td><input type="radio" name="q2" value="incorrect"> Depends on the pie size <br><input type="radio" name="q2" value="correct"> Depends on the final agreement values <br><input type="radio" name="q2" value="incorrect"> $1.73 </td>
  		</tr>

        <tr><td><br></td></tr>




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

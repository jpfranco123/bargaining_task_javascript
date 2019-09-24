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
    var answer1=document.forms['form1'].q1.value;
    var answer2=document.forms['form1'].q2.value;
    var answer3=document.forms['form1'].q3.value;
    var answer3=document.forms['form1'].q3.value;
  	if (answer1== "0.3" && answer2== "correct" && answer3== "correct" && answer3== "correct") {
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
      hints = hints + "If BOTH participants decide to participate in the mediation (that is, choose 'YES') then there is a chance of <?php echo $prob_mech_choice_selec*100; ?>% that the mediation task is selected and a chance of <?php echo (1-$prob_mech_choice_selec)*100; ?>% that the normal task is selected." + " \n\n ";
      hints = hints +  "If ANY of the two participants (could be one or both) choose not to participate in the mediation (that is, choose 'NO')  then there is a chance of <?php echo $prob_mech_choice_selec*100; ?>% that the normal task is selected and a chance of <?php echo (1-$prob_mech_choice_selec)*100; ?>% that the mediation task is selected." + " \n\n"  + hints;
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
        <td><b> Every time you don't submit an answer to whether you want to participate in the mediation process you will lose  </b></td></tr>
      <tr>
        <td><input type="text" name="q1" size=2 AUTOCOMPLETE="OFF"></td>
      </tr>
      <tr><td><br></td></tr>

      <tr>
  			<td><b> During the initial offer you and the other participant both answered 'YES' to the question of "Do you want to participate in the mediation process?". The task selected for the round will be: </b></td>
  		</tr>
      <tr>
  			<td><input type="radio" name="q2" value="incorrect"> Mediation <br><input type="radio" name="q2" value="incorrect"> Normal <br><input type="radio" name="q2" value="correct"> Cannot say with certainty. </td>
  		</tr>

        <tr><td><br></td></tr>

      <tr>
        <td><b> During the initial offer you answered 'NO' to the question of "Do you want to participate in the mediation process?". The task selected for the round will </b></td>
      </tr>
      <tr>
        <td><input type="radio" name="q3" value="incorrect"> be with <?php echo $prob_mech_choice_selec*100; ?>% chance the mediation task <br><input type="radio" name="q2" value="correct"> be with <?php echo $prob_mech_choice_selec*100; ?>% chance the normal task <br><input type="radio" name="q2" value="incorrect"> be the mediation task <br><input type="radio" name="q2" value="incorrect"> be the normal task </td>
      </tr>

        <tr><td><br></td></tr>

        <tr>
          <td><b> During the initial offer both participants answered 'NO' to the question of "Do you want to participate in the mediation process?". The task selected for the round will </b></td>
        </tr>
        <tr>
          <td><input type="radio" name="q4" value="incorrect"> be with <?php echo $prob_mech_choice_selec*100; ?>% chance the mediation task <br><input type="radio" name="q2" value="correct"> be with <?php echo $prob_mech_choice_selec*100; ?>% chance the normal task <br><input type="radio" name="q2" value="incorrect"> be with 90% chance the normal task <br><input type="radio" name="q2" value="incorrect"> be the normal task </td>
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

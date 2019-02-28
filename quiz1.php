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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Quiz 1 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">

  <script>
  //66

  function controleren(form) {
    var answer1=document.forms['form1'].q1.value;
    var answer2=document.forms['form1'].q2.value;
    var answer3=document.forms['form1'].q3.value;
    var answer4=document.forms['form1'].q4.value;
    var answer5=document.forms['form1'].q5.value;
    var nextP = "<?php echo $insNextPage; ?>";
  	if (answer1== <?php echo $maxValue; ?> && answer2== <?php echo $totalTrials; ?> && answer3=="correct" && answer4=="correct" && answer5=="correct") {
      if(nextP=="waittostart.php"){
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
      if (answer1 != <?php echo $maxValue; ?>){
        incorrectQuestions += "1";
      }
      if (answer2 != <?php echo $totalTrials; ?>){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 2";
        } else {
          incorrectQuestions += "2";
        }
      }
      if (answer3 != "correct"){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 3";
        } else {
          incorrectQuestions += "3";
        }
      }
      if (answer4 != "correct"){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 4";
        } else {
          incorrectQuestions += "4";
        }
      }
      if (answer5 != "correct"){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 5";
        } else {
          incorrectQuestions += "5";
        }
      }


  		alert("You did not answer all questions correctly (Specifically: " + incorrectQuestions + "). Please look at the instructions again or raise your hand if you need any help. \n\nHint: Roles are fixed through the 12 rounds of the experiment. Additionally, the role you get in the first round will remain the same during the whole experiment.");
      //TO not show which questions aare wrong:
      //alert("You did not answer all questions correctly. Please look at the instructions again or raise your hand if you need any help. \n\nHint: Roles are fixed through the <?php echo $totalTrials; ?>  rounds of the experiment. Additionally, the role you get in the first round will remain the same during the whole experiment.");
  		return false;
  	}
  }
  </script>



</HEAD>

<BODY>

  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr><td colspan=2>
  <p align=center><?php echo $menu; ?></p>

  <H1 align=center>Quiz Questions I</H1>


  <form name="form1" action=<?php echo $insNextPage; ?> onsubmit="return controleren(this)">
  	<table width="90%" border="0" cellpadding="0" align=center>
  		<tr><td>Before the experiment starts, we will ask you some questions to check your understanding. You can go back to the instructions by clicking on the menu at the top of the screen.</td></tr>
  		<tr><td><br></td></tr>

  		<tr>
  			<td><b>What is the maximum amount you can earn every round?</b></td></tr>
  		<tr>
  			<td><input type="text" name="q1" size=2 AUTOCOMPLETE="OFF"></td>
  		</tr>
  		<tr><td><br></td></tr>

      <tr>
  			<td><b>How many rounds are in this experiment? </b></td></tr>
  		<tr>
  			<td><input type="text" name="q2" size=2 AUTOCOMPLETE="OFF"></td>
  		</tr>
  		<tr><td><br></td></tr>


  		  <td><b>In every round of the experiment you are interacting with: </b> </td>
  		</tr>
  		<tr>
  			<td><input type="radio" name="q3" value="incorrect"> The same person (sitting in this room) throughout the experiment<br><input type="radio" name="q3" value="correct"> A randomly selected person in this room (a different person every round) <br><input type="radio" name="q3" value="incorrect"> A person sitting in another room<br><input type="radio" name="q3" value="incorrect"> A computer </td>
  		</tr>
      <tr><td><br></td></tr>

      <tr>
  			<td><b>If you are not shown the pie size your role is:</b></td>
  		</tr>
      <tr>
  			<td><input type="radio" name="q4" value="incorrect"> The informed participant<br><input type="radio" name="q4" value="correct"> The uninformed participant<br><input type="radio" name="q4" value="incorrect"> Randomly selected between the informed and the uninformed participant</td>
  		</tr>
  		<tr><td><br></td></tr>

      <tr>
        <td><b>If in the first round you are shown the pie size (this means that you are the informed participant) in the next round your role will be:</b></td>
      </tr>
      <tr>
        <td><input type="radio" name="q5" value="correct"> The informed participant<br><input type="radio" name="q5" value="incorrect"> The uninformed participant<br><input type="radio" name="q5" value="incorrect"> Randomly selected between the informed and the uninformed participant</td>
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

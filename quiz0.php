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

    var nextP = "<?php echo $insNextPage; ?>";
  	if (answer1== "correct" && answer2== "correct") {
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
      var hints = "";
      if (answer1 != "correct"){
        incorrectQuestions += "1";
        hints = "The informed participant only gets a penalty if he does NOT report a pie-size. As long as the participant presses at least one orange button there will be no penalty." + hints
      }
      if (answer2 != "correct"){
        if (incorrectQuestions != ""){
          incorrectQuestions += ", 2";
        } else {
          incorrectQuestions += "2";
        }
        hints = "The uninformed participant sees the pie-size reported by the informed participant once the initial offer period ends (that is, once the bargaining period starts). " + hints
      }

      }
      var msg = "You did not answer all questions correctly (Specifically: " + incorrectQuestions + "). Please look at the instructions again or raise your hand if you need any help. \n\nHints: ";

  		alert(msg + hints);
      //TO not show which questions aare wrong:
      //alert("You did not answer all questions correctly. Please look at the instructions again or raise your hand if you need any help. \n\nHint: Roles are fixed through the <?php echo $totalTrials; ?>  rounds of the experiment. Additionally, the role you get in the first round will remain the same during the whole experiment.");
  		return false;
  	}
  </script>



</HEAD>

<BODY>

  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr><td colspan=2>
  <p align=center><?php echo $menu; ?></p>

  <H1 align=center>Quiz Questions basics</H1>

  <form name="form1" action=<?php echo $insNextPage; ?> onsubmit="return controleren(this)">
  	<table width="90%" border="0" cellpadding="0" align=center>
  		<tr><td>Before the experiment starts, we will ask you some questions to check your understanding. You can go back to the instructions by clicking on the menu at the top of the screen.</td></tr>
  		<tr><td><br></td></tr>

      <tr>
        <td><b>The informed participant sees a pie size of $2 and he clicks on the orange button to report a pie size of $6. Is there any penalty for reporting a different pie size?</b></td>
      </tr>
      <tr>
        <td><input type="radio" name="q1" value="incorrect"> Yes <br><input type="radio" name="q1" value="correct"> No <br><input type="radio" name="q1" value="incorrect"> Cannot tell with the information given.</td>
      </tr>
      <tr><td><br></td></tr>

      <tr>
        <td><b>Does the uninformed participant see the pie size reported by the informed player?</b></td>
      </tr>
      <tr>
        <td><input type="radio" name="q2" value="correct"> Yes <br><input type="radio" name="q2" value="incorrect"> No <br><input type="radio" name="q2" value="incorrect"> Only after the bargaining. </td>
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

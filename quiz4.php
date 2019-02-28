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

$valueDeal1=mt_rand($minValue/$Steps+1,($maxValue/2)/$Steps)*$Steps*2;
$valueDeal2=mt_rand($minValue/$Steps+1,($maxValue/2)/$Steps)*$Steps*2-1*$Steps;


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Quiz 4 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">

  <script>
  //66

  function controleren(form) {
    var answer1=document.forms['form1'].q1.value;
  	if (answer1== "correct" ) {
      if("<?php echo $insNextPage; ?>"=="baselineRecording.php"){
          alert("Correct!\nYou have finished the instructions and the quiz questions.");
          return true;
      } else{
          alert("Correct!\nYou will now proceed to the next set of questions.");
          return true;
      }
  	}
  	else {
  		alert("You did not answer all questions correctly. Please look at the instructions again or raise your hand if you need any help. \n\nHint: The final payoffs are calculated only from the the position of the sliders."
    );
  		return false;
  	}
  }
  </script>



</HEAD>

<BODY>

  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr><td colspan=2>
  <p align=center><?php echo $menu; ?></p>

  <H1 align=center>Quiz Questions IV</H1>


  <form name="form1" action=<?php echo $insNextPage; ?> onsubmit="return controleren(this)">
  	<table width="90%" border="0" cellpadding="0" align=center>
  		<tr><td><br></td></tr>

      <tr>
  			<td><b> Both participants agree on the chat box to give the uninformed participant $<?php echo $valueDeal1; ?>. In the sliders they are both matched at $<?php echo $valueDeal2; ?> and a deal is made. What is going to be the payoff of the uninformed participant? </b></td>
  		</tr>
      <tr>
  			<td><input type="radio" name="q1" value="incorrect"> The uninformed participant gets $<?php echo $valueDeal1; ?><br><input type="radio" name="q1" value="incorrect"> The uninformed participant gets $0<br><input type="radio" name="q1" value="correct"> The uninformed participant gets $<?php echo $valueDeal2; ?> </td>
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

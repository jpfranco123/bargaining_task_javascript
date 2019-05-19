<?php
include("commonSlider.inc");
Header("Cache-Control: must-revalidate");
if (!$_COOKIE['theCookie']){
	header("Location: begin.html");
	exit();
	}
else {
	$koek=readcookie("theCookie");
	$ppnr=$koek[0];
}
updateTableOne("subjects","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);

?>
<html onContextMenu="return false;">
<head>
  <TITLE>  Questionnaire </TITLE>
	<!--<meta http-equiv="Refresh" content="5">-->
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<meta http-equiv="Expires" content="Mon, 01 Jan 1990 12:00:00 GMT">
	<link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <script src="jquery-1.11.3.min.js"></script>

  <script>


  function controleren(form) {
    var answer1=document.forms['form1'].age.value;
    var answer2=document.forms['form1'].bor.value;

  	if ($('input[name=mar]:checked').length>0 && $('input[name=eth]:checked').length>0 && $('input[name=eng]:checked').length>0 && $('input[name=vis]:checked').length>0 && $('input[name=edu]:checked').length>0
    && $('input[name=sex]:checked').length>0 ) {
      if($.isNumeric( answer1 ) && answer2 != "" ){
          alert("The questionnaire is complete!");
      		return true;
      } else{
          alert("Please make sure that your age and place of birth are correct.  \n\nPlease look at the instructions again or raise your hand if you need any help.");
          return false;
      }
  	}
  	else {
  		alert("Not all questions have been answered. \n\nPlease look at the instructions again or raise your hand if you need any help.");
  		return false;
  	}
  }
  </script>

	<script>

	//Disables some functions
	window.location.hash="no-back-button";
	window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
	window.onhashchange=function(){window.location.hash="no-back-button";}

	function disableRefresh(netscape){
		var F5=(netscape||event).keyCode;
		//8 is backspace
			//if(F5==116||F5==17||F5==8){
			if(F5==116||F5==17){
				if(!netscape){event.keyCode=0}
				return false;
				}
		}

	document.onkeydown=disableRefresh;
	//document.onkeydown=document.onkeypress=disableRefresh;
	//document.onkeydown=emergencyNextTrial;


	</script>



</head>

<body>
  <table width="80%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr><td colspan=2>

  <H1 align=center> Questionnaire </H1>


  <form name="form1" method="post" action="waitToBeCalled.php" onsubmit="return controleren(this)">
  	<table width="850" border="0" cellpadding="0" align=center>
  		<tr><td>Please fill in the following questionnaire. The answers will be completely confidential. </td></tr>
  		<tr><td><br></td></tr>

  		<tr>
  			<td><b>What is your age? </b></td></tr>
  		<tr>
  			<td><input type="text" name="age" size=2 AUTOCOMPLETE="OFF"></td>
  		</tr>
  		<tr><td><br></td></tr>

      <td><b>What is your current marital status? </b> </td>
      <tr>
        <td><input type="radio" name="mar" value="single"> Single<br><input type="radio" name="mar" value="married"> Married <br><input type="radio" name="mar" value="divorced"> Divorced<br><input type="radio" name="mar" value="livingother">
          Living with another <br> <input type="radio" name="mar" value="separated"> Separated <br> <input type="radio" name="mar" value="widowed"> Widowed <br> <input type="radio" name="mar" value="notsay"> Would rather not say</td>
      </tr>
      <tr><td><br></td></tr>

      <tr>
  			<td><b>Where were you born (country)? </b></td></tr>
  		<tr>
  			<td><input type="text" name="bor" size=20 AUTOCOMPLETE="OFF"></td>
  		</tr>
  		<tr><td><br></td></tr>

      <td><b> With which ethnic group do you identify? </b> </td>
      <tr>
        <td><input type="radio" name="eth" value="oz"> Australian<br>
					<input type="radio" name="eth" value="asian"> Asian <br>
					<input type="radio" name="eth" value="kiwi"> New Zealander<br>
					<input type="radio" name="eth" value="aboriginal"> Indigenous Australian or Torres Strait Islander <br>
					<input type="radio" name="eth" value="indian"> Indian <br>
					<input type="radio" name="eth" value="middleE"> Middle Eastern<br>
					<input type="radio" name="eth" value="african"> African <br>
					<input type="radio" name="eth" value="euro"> European <br>
					<input type="radio" name="eth" value="latin"> Latin American <br>
					<input type="radio" name="eth" value="notsay"> Would rather not say <br>
					<input type="radio" name="eth" value="other"> <input type="text" value="Other" name="otherEthnicity">​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​ </td>
      </tr>
      <tr><td><br></td></tr>

      <td><b>Are you a native English speaker? </b> </td>
      <tr>
        <td><input type="radio" name="eng" value="yes"> Yes<br><input type="radio" name="eng" value="no"> No<br><input type="radio" name="eng" value="notsay"> Would rather not say</td>
      </tr>
      <tr><td><br></td></tr>

      <!-- <td><b>Religious Affiliation: </b> </td>
      <tr>
        <td><input type="radio" name="rel" value="secular"> Nonreligious Secular<br><input type="radio" name="rel" value="agnostic"> Agnostic / Atheist<br><input type="radio" name="rel" value="christianity"> Christianity <br><input type="radio" name="rel" value="judaism"> Judaism
          <br><input type="radio" name="rel" value="islam"> Islam <br><input type="radio" name="rel" value="buddhism"> Buddhism <br><input type="radio" name="rel" value="notlisted"> Not Listed <br><input type="radio" name="rel" value="notsay"> Would rather not say</td>
      </tr>
      <tr><td><br></td></tr> -->

      <td><b> Vision: </b> </td>
      <tr>
        <td><input type="radio" name="vis" value="2020"> 20/20 Uncorrected vision<br><input type="radio" name="vis" value="lenses"> Corrected with contact lenses<br><input type="radio" name="vis" value="glasses"> Corrected with glasses <br><input type="radio" name="vis" value="problems"> Vision problems
          <br><input type="radio" name="vis" value="notsay"> Would rather not say</td>
      </tr>
      <tr><td><br></td></tr>

      <!-- <td><b> Which of the following best describes your political orientation? </b> </td>
      <tr>
        <td><input type="radio" name="pol" value="l2"> Very liberal<br><input type="radio" name="pol" value="l1"> Somewhat liberal<br><input type="radio" name="pol" value="n"> Neither liberal nor conservative <br><input type="radio" name="pol" value="c1"> Somewhat conservative
          <br><input type="radio" name="pol" value="c2"> Very conservative</td>
      </tr>
      <tr><td><br></td></tr> -->

      <td><b> Please indicate the highest level of education completed. </b> </td>
      <tr>
        <td><input type="radio" name="edu" value="11grade"> 11th grade or below<br>
					<input type="radio" name="edu" value="highschool"> High school graduate<br>
					<input type="radio" name="edu" value="somecollege"> Some college or university; no degree<br>
					<input type="radio" name="edu" value="undergrad"> Undergraduate<br>
					<input type="radio" name="edu" value="graduate"> Graduate <br>
					<input type="radio" name="edu" value="other"> Other </td>
      </tr>
      <tr><td><br></td></tr>

      <td><b> Please indicate your gender: </b> </td>
      <tr>
        <td><input type="radio" name="sex" value="male"> Man <br><input type="radio" name="sex" value="female"> Woman <br> <input type="radio" name="sex" value="notsay"> Would rather not say <br> <input type="radio" name="sex" value="other"> <input type="text" value="Fill in the blank" name="otherGender">​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​ </td>
      </tr>
      <tr><td><br></td></tr>

<!--
      <td><b> Gender Identity: </b> </td>
      <tr>
        <td><input type="radio" name="gen" value="female"> Female<br><input type="radio" name="gen" value="male"> Male <br> <input type="radio" name="gen" value="other"> Other <br> <input type="radio" name="gen" value="notsay"> Would rather not say </td>
      </tr>
      <tr><td><br></td></tr>

      <td><b> Sexual Orientation: </b> </td>
      <tr>
        <td><input type="radio" name="sor" value="bisexual"> Bisexual<br><input type="radio" name="sor" value="gay"> Gay <br> <input type="radio" name="sor" value="heterosexual"> Heterosexual <br>
          <input type="radio" name="sor" value="other"> Other <br><input type="radio" name="sor" value="notsay"> Would rather not say  </td>
      </tr>
      <tr><td><br></td></tr>

	-->

			<tr>
				<td><b> If you have any comments about the experiment, please write them below:</b></td></tr>
			<tr>
				<td><input type="text" name="com" size=120 AUTOCOMPLETE="OFF"></td>
			</tr>
			<tr><td><br></td></tr>



    <tr>
    <td align=center><input name="verzend" type="submit" class="buttonblauw" value="OK"></td>
    </tr>


  	</table>
  </form>
  </td></tr>
  </table>




</body>
</html>

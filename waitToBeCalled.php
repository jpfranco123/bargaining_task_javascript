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

  $age=$_POST["age"];
  $mar=$_POST["mar"];
  $bor=$_POST["bor"];
  $eth=$_POST["eth"];
  $eng=$_POST["eng"];
  $rel=$_POST["rel"];
  $vis=$_POST["vis"];
  $pol=$_POST["pol"];
  $edu=$_POST["edu"];
  $sexTemp=$_POST["sex"];
  //$gen=$_POST["gen"];
  //$sor=$_POST["sor"];
	$com=$_POST["com"];
	$com1 = str_replace("'", "", $com);

	if($sexTemp=="other"){
		$sex=$_POST["otherGender"];
	} else{
		$sex=$sexTemp;
	}

  updateTableMore("subjects","ppnr='$ppnr' ","age='$age', marital='$mar',birthPlace='$bor',ethnicity='$eth',motherEnglish='$eng',religion='$rel',vision='$vis',politics='$pol',education='$edu',sex='$sex',gender='$gen', comments='$com1'");

?>
<html>
  <head>
	  <title> Part 3 of the experiment </title>
		<link rel="stylesheet" type="text/css" href="beleggensns.css" />
		<link rel="stylesheet" type="text/css" href="buttons.css" />

  </head>

  <body>
	</br>

	<H1 align=center>Part III</H1>

	<h3 align=center> Welcome to the final part of the experiment.</h3>

	<p align=center> For the last part of the experiement you will need to wear the headphones provided. </p>

  <p align=center> On/near the right wall of the cubicle where you are sitted there is a set of headohones. Please put them on at this moment.</p>

	<br>
	<br>

	<p align=center> The following task is called the Balloon Analogue Risk Task (BART). In this task you will earn BART$ money depending on your performance.
		Each BART$ unit is quivalent to $0.5 Australian Dollars.</p>

 	<p align=center> When you are ready to start please click on CONTINUE.</p>

	<br>
	<p align=center><a href="https://mili2nd.co/cfnb" class="buttonblauw">Continue</a>
  <!-- <h1 align="center"> Thank you for your participation.</h1>
  <h2 align="center"> Please remain seated in order to continue with part 3 of the experiment. </h2> -->

		<!-- until you are called to receive your payment. </h2> -->

  </body>

</html>

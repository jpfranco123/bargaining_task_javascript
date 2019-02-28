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
	  <title>Wait To Be Called</title>
	  <link rel="stylesheet" href="beleggensns.css"/>

  </head>

  <body>
	</br>
  <h1 align="center"> Thank you for your participation.</h1>
  <h2 align="center"> Please remain seated in order to continue with part 3 of the experiment. </h2>

		<!-- until you are called to receive your payment. </h2> -->

  </body>

</html>

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

if ($startexp==1) {
                header("Location: bargaining_screen.php");
                exit();}
?>
<html>
<head>
	<meta http-equiv="Refresh" content="5">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<meta http-equiv="Expires" content="Mon, 01 Jan 1990 12:00:00 GMT">
	<link rel="stylesheet" type="text/css" href="beleggensns.css" />
</head>

<body>
<table width="760" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td>
<br>
<br>
<H1 align="center">Please wait...</H1>

<p align=center>We wait until everyone is ready to start</p>

<br>
<h3 align=center> If you can see the screen comfortably without glasses, we ask you to please take them off at this moment.</h3>
<br>
<h3 align=center> Remember not to touch or scratch your face while the camera light is on.</h3>

<!-- <h3 align=center> If you are wearing glasses, please take them off at this moment.</h3> -->



</body>
</html>

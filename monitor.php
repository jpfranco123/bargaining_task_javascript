<?php
	include("commonSlider.inc");

	$table_name="subjects";
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
	$db = @mysql_select_db(DBNAME,$connection) or die(mysql_error());
	$sql3="SELECT * FROM $table_name ORDER BY `ppnr` ASC";
	$result=@mysql_query($sql3,$connection) or die("Couldn't execute query ".$sql3);

	$tabel="<table class=rond align=center width=1000><tr class=oneven><th><b>Subject<b></th><th><b>Partner<b></th><th><b>Currentpage<b></th><th><b>Trial<b></th><th><b>Barg E <b></th><th><b>SP E<b></th> <th><b>SPOther E<b></th> <th><b>Total Earnings<b></th><th><b>IP<b></th><tr>";

	//$IPA=$_SERVER['REMOTE_ADDR'];

	$i=0;
	$numberOfSPOtherFilled = 0;
	while ($row=mysql_fetch_array($result)) {

		$ppnummer=$row['ppnr'];
		//$tafelnummer=$row['tafelnummer'];
		//$tafelnummer = strtoupper($tafelnummer);
		$currentpage=$row['currentpage'];
		$trial=$row['trial'];

		$partner = findPartner($ppnummer,$trial);

		$earnings = lookUp("paymentSession","ppnr=$ppnummer","payment");

		$earningsSP = lookUp("paymentSession","ppnr=$ppnummer","paymentSP");

		$earningsSPOther = lookUp("paymentSession","ppnr=$ppnummer","paymentSPOther");

		$IPID= lookUp("subjects","ppnr=$ppnummer","subID");
		$subIPID = substr($IPID, -2);

		if ($earningsSPOther!=""){
			$numberOfSPOtherFilled++;
		}

		$earningsTotal = lookUp("paymentSession","ppnr=$ppnummer","totalPayment");


		$tabel .= "<tr class=oneven><td align=center>".$ppnummer."</td><td align=center>".$partner."</td><td align=center>".$currentpage."</td><td align=center>".$trial."</td><td align=center>".$earnings."</td><td align=center>".$earningsSP."</td><td align=center>".$earningsSPOther."</td><td align=center>".$earningsTotal."</td><td align=center>".$subIPID."</td></tr>";
		$i++;
	}
	$tabel .= "</table>";

	if ($numberOfSPOtherFilled==$NPlayers){
			$SPOtherFilled=1;
	} else {
		$SPOtherFilled=0;
	}

	?>


<html>
<head>
<meta http-equiv="Refresh" content="5">
<link rel="stylesheet" type="text/css" href="beleggensns.css" />
<link rel="stylesheet" type="text/css" href="buttons.css" />
<style>
tr:nth-child(odd)
{
background:white;
}
tr:nth-child(even)
{
background:lightgrey;
}
</style>

<script type="text/javascript">
	var SPOtherFilled = <?php echo $SPOtherFilled; ?>;

	function loadDoc3(funcion, url, value1,value2,value3) {
		var xhttp;
		if (window.XMLHttpRequest) {
			// code for modern browsers
		xhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
				funcion(xhttp);
				//document.getElementById("AAvalueSlider1").innerHTML = xhttp.responseText;
				//xhttp.open("GET", url + "?v=" + value, true);
				//xhttp.send();
		}
	};
	xhttp.open("GET", url + "?v=" + value1+"&v2=" + value2+ "&v3=" + value3, true);
	xhttp.send();
	}

	function nada(){
	}

	function doorgaan(){
		if(confirm("Are you sure you want to continue the experiment?")){
			var tiempo = new Date().getTime();
			loadDoc3(nada,'startExpTimer.php',tiempo,1,1);
			return true;
		} else {
			return false;
		}
	}

	function stampTime(){
			var tiempo = new Date().getTime();
			loadDoc3(nada,'startExpTimer.php',tiempo,2,2);
	}

	function SPFinished(){
		if (SPOtherFilled==1){
			var texto = "All participants have finished the Social Preferences Task. Is OK to calculate Total Earnings.";
		} else {
			var texto= "Are you sure you want to calculate Total Earnings? NOT all participants have finished the Social Preferences Task.";
		}

		if(confirm(texto)){
			return true;
		} else {
			return false;
		}
	}

</script>
</head>

<body>
<p align=center> 	<a href="setup.php" class="buttonoranje">Go to setup</a></p>
<p align=center>	<a href="startexp.php" class="buttonblauw" onclick="return doorgaan()">Start Experiment</a></p>

<?php echo $tabel; ?>

</br>
</br>
</br>
</br>


<p align=center>	<a href="calcTotalEarnings.php" class="buttonblauw" onclick="return SPFinished()">Calculate Total Earnings</a></p>
<p align=center>	<a class="buttonblauw" onclick="stampTime()">Time Stamp</a></p>
<!-- <p align=center> 	<a href="download.php" class="buttonoranje"> Download DB</a></p>-->



</body>
</html>

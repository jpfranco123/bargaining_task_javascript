<?php
//Start Experiment
include("commonSlider.inc");

//Generate ppnr and see if he/she has already been signed in
$table_name="subjects";
$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
$sql="SELECT * FROM $table_name ORDER BY ppnr DESC";
$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
if ($row=mysql_fetch_array($result)) {
	$pp2=$row['ppnr']+1;
} else {
	$pp2=1;
}


if ($pp2>$NPlayers){
	header("Location: relogin.php");
	exit();
//Not TO DO!
} else {
	setcookie("theCookie", $pp2);

	//Randomization of initialSliderValue (even if $knoPie, odd otherwise)
	/*
	if (knowPie($pp2,1)) {
		$initialSliderValue=(mt_rand(0,30)*2)/10;
	} else {
		$initialSliderValue=(mt_rand(1,30)*2-1)/10;
	}
	*/

	$initialSliderValue=startValue($pp2,1);
	$IPA=$_SERVER['REMOTE_ADDR'];

  insertRecord("subjects","ppnr,sValue,session,blocked,trial,started,subID","\"$pp2\",\"$initialSliderValue\",\"$session\",'0','1','0','$IPA' ");
	insertRecord("paymentSession","ppnr"," \"$ppnr\" ");
	/*
	$partner=findPartner($pp2);
	if(knowPie($pp2)){
		$kp=1;
	} else {
		$kp=2;
	}
	*/
	//insertRecord("sessions","trial,ppnr1,ppnr2,roomNumber,pieSize, knowPie,blocked"," '1','$pp2','$partner','1','6',$kp,0 ");
	$begininstructies="Location: waittostart.php";
	header($begininstructies);
	exit();

}

?>

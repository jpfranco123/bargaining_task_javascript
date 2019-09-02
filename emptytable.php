<?php
	include("commonSlider.inc");
	$table_name1="subjects";
	$table_name3="LogChats";
	$table_name4="trialInfo";
	$table_name5="sliderLog";
	$table_name6="paymentSession";
	$table_name7="socialPref";
	$table_name8="timeMarks";
	$table_name9="reported_pies";

	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
	$db = @mysql_select_db(DBNAME,$connection) or die(mysql_error());
    $query1="TRUNCATE TABLE $table_name1";
    mysql_query($query1);

    $query3="TRUNCATE TABLE $table_name3";
    mysql_query($query3);
    $query4="TRUNCATE TABLE $table_name4";
    mysql_query($query4);
    $query5="TRUNCATE TABLE $table_name5";
    mysql_query($query5);
		$query6="TRUNCATE TABLE $table_name6";
		mysql_query($query6);

		$query7="TRUNCATE TABLE $table_name7";
		mysql_query($query7);

		$query8="TRUNCATE TABLE $table_name8";
		mysql_query($query8);

		$query9="TRUNCATE TABLE $table_name9";
		mysql_query($query9);

	//Sets the startexp to 0 (false)
	updateTableOne("commonParameters","Name='startexp' ","Value","0");

	header("Location: monitor.php");
	exit();
?>

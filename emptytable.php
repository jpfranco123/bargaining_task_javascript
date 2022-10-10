<?php
	include("commonSlider.inc");
	$table_name1="subjects";
	$table_name3="LogChats";
	$table_name4="trialInfo";
	$table_name5="sliderLog";
	$table_name6="paymentSession";
	$table_name7="socialPref";
	$table_name8="timeMarks";

	$connection = @mysqli_connect(HOST,ADMIN, WWOORD) or die("Cannot connect to the database server");
	$db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $query1="TRUNCATE TABLE $table_name1";
    mysqli_query($connection, $query1);

    $query3="TRUNCATE TABLE $table_name3";
    mysqli_query($connection, $query3);
    $query4="TRUNCATE TABLE $table_name4";
    mysqli_query($connection, $query4);
    $query5="TRUNCATE TABLE $table_name5";
    mysqli_query($connection, $query5);
		$query6="TRUNCATE TABLE $table_name6";
		mysqli_query($connection, $query6);

		$query7="TRUNCATE TABLE $table_name7";
		mysqli_query($connection, $query7);

		$query8="TRUNCATE TABLE $table_name8";
		mysqli_query($connection, $query8);

	//Sets the startexp to 0 (false)
	updateTableOne("commonParameters","Name='startexp' ","Value","0");

	header("Location: monitor.php");
	exit();
?>

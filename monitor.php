<?php
include("commonSlider.inc");

$table_name = "subjects";
$connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
$db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
$sql3 = "SELECT * FROM $table_name ORDER BY `ppnr` ASC";
$result = @mysqli_query($connection, $sql3) or die("Couldn't execute query " . $sql3);

$table = "<table class=rond align=center width=1000> <tr class=oneven> <th><b>Subject<b></th> <th><b>Partner<b></th> <th><b>Currentpage<b></th> <th><b>Trial<b></th> <th><b>Barg E <b></th> <th><b>SP E<b></th> <th><b>SPOther E<b></th> <th><b>Total Earnings<b></th> <th><b>IP<b></th> <tr>";

//$IPA=$_SERVER['REMOTE_ADDR'];

$i = 0;
$numberOfSPOtherFilled = 0;
while ($row = mysqli_fetch_array($result)) {

    $ppnummer = $row['ppnr'];
    //$tafelnummer=$row['tafelnummer'];
    //$tafelnummer = strtoupper($tafelnummer);
    $currentpage = $row['currentpage'];
    $trial = $row['trial'];

    $partner = findPartner($ppnummer, $trial);

    $earnings = lookUp("paymentSession", "ppnr=$ppnummer", "payment");

    $earningsSP = lookUp("paymentSession", "ppnr=$ppnummer", "paymentSP");

    $earningsSPOther = lookUp("paymentSession", "ppnr=$ppnummer", "paymentSPOther");

    $IPID = lookUp("subjects", "ppnr=$ppnummer", "subID");
    $subIPID = substr($IPID, -2);

    if ($earningsSPOther != "") {
        $numberOfSPOtherFilled++;
    }

    $earningsTotal = lookUp("paymentSession", "ppnr=$ppnummer", "totalPayment");


    $table .= "<tr class=oneven><td align=center>" . $ppnummer . "</td><td align=center>" . $partner . "</td><td align=center>" . $currentpage . "</td><td align=center>" . $trial . "</td><td align=center>" . $earnings . "</td><td align=center>" . $earningsSP . "</td><td align=center>" . $earningsSPOther . "</td><td align=center>" . $earningsTotal . "</td><td align=center>" . $subIPID . "</td></tr>";
    $i++;
}
$table .= "</table>";

if ($numberOfSPOtherFilled == $NPlayers) {
    $SPOtherFilled = 1;
} else {
    $SPOtherFilled = 0;
}

?>


<html>
<head>
    <!-- <meta http-equiv="Refresh" content="5"> -->
    <link rel="stylesheet" type="text/css" href="beleggensns.css"/>
    <link rel="stylesheet" type="text/css" href="buttons.css"/>
    <style>
        tr:nth-child(odd) {
            background: white;
        }

        tr:nth-child(even) {
            background: lightgrey;
        }
    </style>

    <script type="text/javascript">

        //WEBSOCKET
        //const url = 'ws:/localhost:8080';
        const url = 'ws:/130.56.248.241:8080';
        const connection = new WebSocket(url);

        connection.onopen = () => {
            send_message_mon("connected", 1);
            send_message_mon("update_game_vars", 1)
        }

        connection.onerror = (error) => {
            console.log(`WebSocket error: ${error}`);
        }

        connection.onmessage = (ms) => {


            console.log('received message from Server %s', ms.data);
            // Broadcast to everyone else.
            //client_process_messsage(ms.data);
        }

        // Monitor Functions
        var SPOtherFilled = <?php echo $SPOtherFilled; ?>;
        var refreshTime = 5000

        function loadDoc3(funcion, url, value1, value2, value3) {
            var xhttp;
            if (window.XMLHttpRequest) {
                // code for modern browsers
                xhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    funcion(xhttp);
                    //document.getElementById("AAvalueSlider1").innerHTML = xhttp.responseText;
                    //xhttp.open("GET", url + "?v=" + value, true);
                    //xhttp.send();
                }
            };
            xhttp.open("GET", url + "?v=" + value1 + "&v2=" + value2 + "&v3=" + value3, true);
            xhttp.send();
        }

        function nada() {
        }

        function doorgaan() {
            if (confirm("Are you sure you want to continue the experiment?")) {
                var tiempo = new Date().getTime();
                //loadDoc3(nada,'startExpTimer.php',tiempo,1,1);
                send_message_mon("start_experiment", 1);
                return true;
            } else {
                return false;
            }
        }

        function stampTime() {
            //var tiempo = new Date().getTime();
            //loadDoc3(nada,'startExpTimer.php',tiempo,2,2);
            var time_local = new Date().getTime();
            send_message_mon("time_marks", time_local);
        }

        function SPFinished() {
            if (SPOtherFilled == 1) {
                var texto = "All participants have finished the Social Preferences Task. Is OK to calculate Total Earnings.";
            } else {
                var texto = "Are you sure you want to calculate Total Earnings? NOT all participants have finished the Social Preferences Task.";
            }

            if (confirm(texto)) {
                return true;
            } else {
                return false;
            }
        }

        function send_message_mon(mtype, mvalue) {
            var dict = {"p1": "monitor", "p2": "monitor", "trial": "monitor", "type": mtype, "value": mvalue};
            var json_message = JSON.stringify(dict);
            console.log(`message sent: ${json_message}`);
            connection.send(json_message);
        }

        function getUpdatedTable() {
            var table = document.getElementById("table").innerHTML;
            loadDoc3(updateTable, 'update_monitor_table.php', 1, 1, 1);
            return document.getElementById("table").innerHTML;

        }

        function updateTable(xhttp) {
            document.getElementById("table").innerHTML = xhttp.responseText;
        }

        window.onload = setInterval("getUpdatedTable();", refreshTime);

    </script>
</head>

<body>
<p align=center><a href="setup.php" class="buttonoranje">Go to setup</a></p>
<p align=center><a href="startexp.php" class="buttonblauw" onclick="return doorgaan()">Start Experiment</a></p>


<p id="table"> <?php echo $table; ?> </p>

<p>

    </br>
    </br>
    </br>
    </br>


<p align=center><a href="calcTotalEarnings.php" class="buttonblauw" onclick="return SPFinished()">Calculate Total
        Earnings</a></p>
<p align=center><a class="buttonblauw" onclick="stampTime()">Time Stamp</a></p>
<!-- <p align=center> 	<a href="download.php" class="buttonoranje"> Download DB</a></p>-->


</body>
</html>

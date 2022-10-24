<?php
define("HOST", "localhost");

// fill in correct name of database
define("DBNAME", "sliders");
// fill in correct loginname/password
define("ADMIN", "root");

//define ("WWOORD","root");
define("WWOORD", "bargaining_mysql");

//define ("ADMIN","pablo");
//define ("WWOORD","pablo-ssel123");

//For this simple experiment we read all common parameters we will ever need.
$table_name = "commonParameters";
$connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
$db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
$sql = "SELECT * FROM $table_name";
$result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['Name'];
    $value = $row['Value'];
    $$name = $value;
}

//Lookups one variable in one specif record
//example: $role=lookUp("groupcomposition","pp='$ppnummer'","role");
function lookUp($table_name, $condition, $name)
{
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "SELECT $name FROM $table_name WHERE ($condition)";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
    if ($row = mysqli_fetch_array($result)) {
        $value = $row[$name];
    } else $value = "";
    return $value;
}

//Finds the partner of $ppnr
function findPartner($ppnumber, $trial)
{
    $partner = lookUp("matching", "sjnr='$ppnumber' and trial='$trial'", "sjnrother");
    return $partner;
}

function knowPie($ppnumber, $trial)
{
    $informed = lookUp("matching", "sjnr='$ppnumber' and trial='$trial'", "informed");
    return $informed;
}

function pieSize($ppnumber, $trial)
{
    $PieSize = lookUp("matching", "sjnr='$ppnumber' and trial='$trial'", "piesize");
    return $PieSize;
}

function startValue($ppnumber, $trial)
{
    $startValue = lookUp("matching", "sjnr='$ppnumber' and trial='$trial'", "startvalue");
    return $startValue;
}


//reads one common parameter
//example: $startexperiment=readCommonParameter("startexperiment");
function readCommonParameter($name)
{
    $table_name = "commonParameters";
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "SELECT * FROM $table_name WHERE (name='$name')";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
    if ($row = mysqli_fetch_array($result)) {
        $value = $row['Value'];
    }
    return $value;
}


//Updates one variable in one record
//example updateTableOne("ppnummers","ppnummer=$ppnummer and session=$session","period","1");
function updateTableOne($table_name, $condition, $name, $value)
{
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "UPDATE $table_name SET $name=\"$value\" WHERE ($condition)";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
}

//Updates more variables in the same record
//example: updateTableMore("glazen","codeglas=\"$codeglas\"","hoogte=\"$hoogte\", jeneverofniet=\"$jeneverofniet\"");
function updateTableMore($table_name, $condition, $updatestring)
{
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "UPDATE $table_name SET " . $updatestring . " WHERE ($condition)";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
}

//inserts new record in table
//example: insertRecord("decisions","ppnummer, period, decision, kans, tijd","\"$ppnummer\", \"$period\", \"$keus1\", \"$kans\", \"$tijd\"");
function insertRecord($table_name, $names, $values)
{
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "INSERT INTO $table_name (" . $names . ") VALUES (" . $values . ")";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
}

//Function by Jona Linde:
//creates a multidimensional array from the string by exploding using the symbols in $delimiters.
//Number of dimensions is given by the number of symbols in $delimiters.
//Set delimiters by for example $delimiters=array(";",",");
function multiexplode($delimiters, $string)
{
    $ary = explode($delimiters[0], $string);
    array_shift($delimiters);
    if ($delimiters != NULL) {
        foreach ($ary as $key => $val) {
            $ary[$key] = multiexplode($delimiters, $val);
        }
    }
    return $ary;
}

//Function by Jona Linde:
//Lookups one variable in one specific record at random
//example: $role=lookUpRnd("groupcomposition","pp='$ppnummer'","role");
function lookUpRnd($table_name, $condition, $name)
{
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "SELECT * FROM $table_name WHERE ($condition) ORDER BY RAND()";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
    if ($row = mysqli_fetch_array($result)) {
        $value = $row[$name];
    } else $value = "";
    return $value;
}

//Instruction menu based upon Roel van Veldhuizen design
//You need a table "instructions" with a list of instruction pages. For example:
//		CREATE TABLE `instructions` (
//		  `part` int(11) NOT NULL,
//		  `pagenumber` int(11) default NULL,
//		  `filename` varchar(80) NOT NULL,
//		  `nameinmenu` varchar(80) NOT NULL
//		) ENGINE=MyISAM DEFAULT CHARSET=latin1;
//		INSERT INTO `instructions` VALUES (1, 0, 'instructie1.php', 'Introduction');
//		INSERT INTO `instructions` VALUES (1, 1, 'instructie2.php', 'Payoff table');
//		INSERT INTO `instructions` VALUES (1, 2, 'instructiequestion1.php', 'Question 1');
//		INSERT INTO `instructions` VALUES (1, 3, 'instructiequestion2.php', 'Question 2');
//		INSERT INTO `instructions` VALUES (1, 4, 'instructiesummary.php', 'Summary');
//		INSERT INTO `instructions` VALUES (2, 0, 'instructiepart21.php', 'Introduction part 2');
//		INSERT INTO `instructions` VALUES (2, 1, 'instructiepart22.php', 'Group composition');
//		INSERT INTO `instructions` VALUES (2, 2, 'instructiepart23.php', 'Summary');
//In addition your ppnummers table needs to keep track of the maximum page visited by the subject by the variable
//vrijgemaakt1 (for instructions part 1), vrijgemaakt2 (instructions part 2) etc.
//$part is the part variable in the instructuions table (part=1 is chat confdition, part=2 is noChat condition)
function instructionMenu($page, $ppnr, $part)
{
    //de directory name van de page verwijderen
    $page = substr(strrchr($page, '/'), 1);
    //eerst instructietable inlezen en zoeken naar deze pagina
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "SELECT * FROM instructions";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $menuarray[$row['part']][$row['pagenumber']] = array($row['filename'], $row['nameinmenu']);
        //updates the part and the page
        if ($page == $row['filename']) {
            $thispage = $row['pagenumber'];
        }
        $i++;
    }

    if (!isset($part)) {
        $error = "ERROR! this file is not in the instructions table.";
        return $error;
    }
    //66
    $insMaxPage = lookUp("subjects", "ppnr=" . $ppnr, "insMaxPage");
    if ($thispage > $insMaxPage) {
        $insMaxPage = $thispage;
        //66
        updateTableOne("subjects", "ppnr=$ppnr", "insMaxPage", $insMaxPage);
    }

    //creates de menu syntax for html: for max page or before is a link, for pages not opened yet is just the name of the section.
    $count = count($menuarray[$part]);
    $menutable = "<table align=center border=1 bordercolor=#84bbf3 cellpadding=3 width=100%><tr bgcolor=#cee3f6>";
    for ($counter = 0; $counter < $count; $counter++) {
        if ($thispage == $counter) {
            $menutable .= "<td align=center><font size=1 face=arial>" . $menuarray[$part][$counter][1] . "</font></td>";
        } elseif ($insMaxPage < $counter) {
            $menutable .= "<td align=center><font size=1 face=arial>" . $menuarray[$part][$counter][1] . "</font></td>";
        } else {
            $menutable .= "<td align=center><font size=1 face=arial><a Href='" . $menuarray[$part][$counter][0] . "' class=buttonrijb1>" . $menuarray[$part][$counter][1] . "</a></font></td>";
        }
    }
    $menutable .= "</tr></table>";
    return $menutable;
}

//Returns the next page to be redirected in the instructions
function instructionsNextPage($page, $ppnr, $part)
{
    //de directory name van de page verwijderen
    $page = substr(strrchr($page, '/'), 1);
    //eerst instructietable inlezen en zoeken naar deze pagina
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "SELECT * FROM instructions";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $menuarray[$row['part']][$row['pagenumber']] = array($row['filename'], $row['nameinmenu']);
        //updates the part and the page
        if ($page == $row['filename']) {
            $thispage = $row['pagenumber'];
        }
        $i++;
    }
    if (!isset($menuarray[$part][$thispage + 1][0])) {
        return "baselineRecording.php";
    } else {
        return $menuarray[$part][$thispage + 1][0];
    }
}

//Returns the previous page to be redirected in the instructions
function instructionsPrevPage($page, $ppnr, $part)
{
    //de directory name van de page verwijderen
    $page = substr(strrchr($page, '/'), 1);
    //eerst instructietable inlezen en zoeken naar deze pagina
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "SELECT * FROM instructions";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $menuarray[$row['part']][$row['pagenumber']] = array($row['filename'], $row['nameinmenu']);
        //updates the part and the page
        if ($page == $row['filename']) {
            $thispage = $row['pagenumber'];
        }
        $i++;
    }
    return $menuarray[$part][$thispage - 1][0];
}


//Output is a standard start of a htmlpage, with no cache, browsing back disabled, enterkey is disabled in form
function startpage($title) {
?>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta http-equiv="Expires" content="Mon, 01 Jan 1990 12:00:00 GMT">
    <link rel="stylesheet" type="text/css" href="beleggensns.css"/>
    <script language="JavaScript">
        function blockEnter(evt) {
            evt = (evt) ? evt : event;
            var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
            return !(charCode == 13 || charCode == 3);
        }
    </script>
</head>
<body>

<?php
}

//returns a array of the variables saved in the cookie with writecookie
//example: $koek=readcookie("beheerder");
//$ppnummer=$koek[0];
function readcookie($variable)
{
    $cookie_val = $_COOKIE[$variable];
    return explode("-", $cookie_val);
}

//writes a cookie
//example: writecookie("beheerder",$ppnummer);
//or:      writecookie("beheerder",$ppnummer,$role);
function writecookie()
{
    $numargs = func_num_args();
    $arg_list = func_get_args();
    $cookie_val = "";
    $cookie_val = $arg_list[1];
    for ($i = 2; $i <= LENGTHCOOKIE; $i++) {
        if ($i < $numargs) {
            $cookie_val .= "-" . $arg_list[$i];
        } else {
            $cookie_val .= "- ";
        }
    }
    setcookie($arg_list[0], $cookie_val);
}

//orders the table in descending order of "id"
function orderDesc($table_name, $id)
{
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $sql = "SELECT * FROM $table_name ORDER by $id ASC";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
    return $result;
}

//Function By Pablo Franco
//Uses SQL command to upload .csv file to server (doesn't work in production because of permission issues). Does work using virtual.. MAMP.
function downloadCSVSQL($table_name, $folder, $session1)
{
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));
    $dbNombre = DBNAME;
    $ses = $session1;
    $directory = getcwd();

    $nameFile = $directory . $folder . $table_name;
    //$sql="SELECT * FROM $table_name INTO OUTFILE '/Users/juanpf/Downloads/$nameFile.csv' FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' ";
    //$sql="SELECT * FROM $table_name INTO OUTFILE '$nameFile.csv' FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' ";
    $sqlColumns = "SELECT GROUP_CONCAT(CONCAT(\"'\",COLUMN_NAME,\"'\")) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$dbNombre' AND TABLE_NAME='$table_name' ";
    $resultPRE = @mysqli_query($connection, $sqlColumns) or die("Couldn't execute query " . $sqlColumns);
    //$row=mysqli_fetch_array($resultPRE);
    if ($row = mysqli_fetch_array($resultPRE)) {
        $row1 = $row[0];
    }
    //$row1 = $row['GROUP_CONCAT(CONCAT("'",COLUMN_NAME,"'"))'];
    $sql = "SELECT $row1 UNION ALL SELECT * FROM $table_name INTO OUTFILE '$nameFile.csv' FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' ";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
    return $result;
}

//Function By Pablo Franco
//Creates database in PHP and then downloads it
function downloadCSV($table_name, $folder, $session1)
{
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));

    $dbNombre = DBNAME;
    $ses = $session1;
    $directory = getcwd();

    //$nameFile=$directory.$folder.$table_name;
    //"uploads/"
    $nameFile = $folder . $table_name . ".csv";

    $f = fopen($nameFile, 'w');
    if (!$f) {
        // Could not open file!
        //die("Couldn't open file:" $nameFile);
    }

    $sql = "SELECT * FROM $table_name";
    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);

    //headers
    $row = mysqli_fetch_assoc($result);
    //if($row) {
    fputcsv($f, array_keys($row));
    // reset pointer back to beginning
    mysqli_data_seek($result, 0);

    //info
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($f, $row);
    }

    fclose($f);

    return $result;
}

//Deletes a Row in table_name
//eg. deleteRow("trialInfo","ppnr1='$ppnr' and trial='$trial'")
function deleteRow($table_name, $condition)
{
    $connection = @mysqli_connect(HOST, ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));

    $sql = "DELETE FROM $table_name WHERE ($condition)";

    $result = @mysqli_query($connection, $sql) or die("Couldn't execute query " . $sql);
}


?>

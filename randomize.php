<?php
    include("commonSlider.inc");

    $table_name="matching";
    $connection = @mysqli_connect(HOST,ADMIN, WWOORD) or die("Cannot connect to the database server");
    $db = @mysqli_select_db($connection, DBNAME) or die(mysqli_error($connection));

    $query="TRUNCATE TABLE $table_name";
    mysqli_query($connection, $query);

    //Empties the matching table for Social Preferences (matchingSP)
    $table_nameSP="matchingSP";
    $querySP="TRUNCATE TABLE $table_nameSP";
    mysqli_query($connection, $querySP);

    $nbmg2=floor($NPlayers/$mgroupsize);
    $ppnummer=array();
    $willekeur2=array();
    $willekeur=array();
    $blocks=array();
    $groepen=array();
    $positie=array();

    for ($i=0; $i < $NPlayers*$totalTrials; $i++) {
        $ub=$maxValue/$Steps;
        $wil=mt_rand(0,$ub);
        $sv=$wil*$Steps;
        array_push($willekeur,$sv);
        $wil2=mt_rand(1,999999);
        array_push($willekeur2,$wil2);
        $pp=floor($i/($totalTrials))+1;
        array_push($ppnummer,$pp);
        $blockje=$i+1-$totalTrials*($pp-1);
        array_push($blocks,$blockje);
        $groepje=floor(($pp-1)/$mgroupsize)+1;
        array_push($groepen,$groepje);
    }

    for ($i=0; $i < $NPlayers*$totalTrials; $i++) {
        insertRecord("matching","trial, sjnr, startvalue, mgroup, randomnr","'$blocks[$i]', '$ppnummer[$i]', '$willekeur[$i]', '$groepen[$i]', '$willekeur2[$i]'");
    }

    //for all matching groups
    for ($j=1; $j < ($nbmg2+1); $j++) {

  //for all trials
    for ($i=1; $i < ($totalTrials+1); $i++) {
            $arie1=array();
            $arie2=array();
            $arie3=array();
            $sql="SELECT * FROM matching WHERE trial='$i' AND mgroup='$j' ORDER BY trial ASC";
            $result=@mysqli_query($connection, $sql) or die("Couldn't execute query ".$sql);
            while ($row=mysqli_fetch_array($result)){
                array_push($arie1, $row['randomnr']);
                array_push($arie2, $row['sjnr']);
                //Even are informed, uneven are uninformed
                if ($row['sjnr'] % 2 == 0){$inf=1;} else {$inf=0;}
                array_push($arie3, $inf);
                }
            array_multisort($arie3, $arie1, $arie2);
            for ($k=0; $k < $mgroupsize/2; $k++){
                $l=$k+1;
                $f=$mgroupsize-$l;

                //Randomizes between high and low pies.
                $pieRandom=mt_rand(0,1);
                if($pieRandom==1){
                  $piesize=$highValuePie;
                } else {
                  $piesize=$lowValuePie;
                }

                //$piesize=($Pie-1)*rand(0,1)+1;
                updateTableOne("matching","sjnr=$arie2[$k] and trial=$i","submatch",$l);
                updateTableOne("matching","sjnr=$arie2[$k] and trial=$i","sjnrother","$arie2[$f]");
                updateTableOne("matching","sjnr=$arie2[$k] and trial=$i","informed",'0');
                updateTableOne("matching","sjnr=$arie2[$k] and trial=$i","piesize",$piesize);
                updateTableOne("matching","sjnr=$arie2[$f] and trial=$i","submatch",$l);
                updateTableOne("matching","sjnr=$arie2[$f] and trial=$i","sjnrother","$arie2[$k]");
                updateTableOne("matching","sjnr=$arie2[$f] and trial=$i","informed",'1');
                updateTableOne("matching","sjnr=$arie2[$f] and trial=$i","piesize",$piesize);
                }
    }
}

//Randomization of Social Preferences Part
//$participants=range(1,$NPlayers);
$participantsShuffled=range(1,$NPlayers);
shuffle($participantsShuffled);

for ($i=0; $i < $NPlayers; $i++){
  $i1=$i;
  $i2=($i+1)%$NPlayers;//mod N

  insertRecord("matchingSP","ppnr1,ppnr2","\"$participantsShuffled[$i1]\", \"$participantsShuffled[$i2]\"");
}

    header("Location: monitor.php");
    exit();
?>

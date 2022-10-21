<?php

include("commonSlider.inc");

$mycolor="lightgreen";

if($showVideo==0){
	$videovalue="0: No";
} elseif ($showVideo==1) {
	$videovalue="1: Yes";
} else {
	$videovalue="Choose one";
}

if($showVideoOther==0){
	$othervideovalue="0: No";
} elseif ($showVideoOther==1) {
	$othervideovalue="1: Yes";
} else {
	$othervideovalue="Choose one";
}

if($showChat==0){
	$chatValue="0: No";
} elseif ($showChat==1) {
	$chatValue="1: Yes";
} else {
	$chatValue="Choose one";
}

if($robot==0){
	$robotValue="0: No";
} elseif ($robot==1) {
	$robotValue="1: Yes";
} else {
	$robotValue="Choose one";
}

if (isset($_REQUEST['treatment']))		{$nieuwtreatment=$_REQUEST['treatment'];} 		else {$nieuwtreatment=$treatment;}
if (isset($_REQUEST['mgroupsize']))		{$nieuwmgroupsize=$_REQUEST['mgroupsize'];} 		else {$nieuwmgroupsize=$mgroupsize;}
if (isset($_REQUEST['NPlayers'])) 		{$nieuwNPlayers=$_REQUEST['NPlayers'];} 			else {$nieuwNPlayers=$NPlayers;}
if (isset($_REQUEST['maxValue'])) 			{$nieuwPie=$_REQUEST['maxValue'];} 						else {$nieuwPie=$maxValue;}
if (isset($_REQUEST['session'])) 		{$nieuwsession=$_REQUEST['session'];} 				else {$nieuwsession=$session+1;}
if (isset($_REQUEST['showUpFee'])) 		{$nieuwshowupfee=$_REQUEST['showUpFee'];} 			else {$nieuwshowupfee=$showUpFee;}
if (isset($_REQUEST['showVideo'])) 		{$nieuwshowVideo=$_REQUEST['showVideo'];} 			else {$nieuwshowVideo=$showVideo;}
if (isset($_REQUEST['showVideoOther'])) {$nieuwshowVideoOther=$_REQUEST['showVideoOther'];}	else {$nieuwshowVideoOther=$showVideoOther;}
if (isset($_REQUEST['Steps']))			{$nieuwSteps=$_REQUEST['Steps'];} 					else {$nieuwSteps=$Steps;}
if (isset($_REQUEST['Time']))			{$nieuwTime=$_REQUEST['Time'];} 					else {$nieuwTime=$Time;}
if (isset($_REQUEST['totalTrials']))	{$nieuwtotalTrials=$_REQUEST['totalTrials'];} 		else {$nieuwtotalTrials=$totalTrials;}

if (isset($_REQUEST['totalPayTrials']))	{$nieuwtotalPayTrials=$_REQUEST['totalPayTrials'];} 		else {$nieuwtotalPayTrials=$totalPayTrials;}

if (isset($_REQUEST['minValue']))	{$nieuwminValue=$_REQUEST['minValue'];} 		else {$nieuwminValue=$minValue;}
if (isset($_REQUEST['showChat']))	{$nieuwshowChat=$_REQUEST['showChat'];} 		else {$nieuwshowChat=$showChat;}
if (isset($_REQUEST['updateRateMS']))	{$nieuwupdateRateMS=$_REQUEST['updateRateMS'];} 		else {$nieuwupdateRateMS=$updateRateMS;}
if (isset($_REQUEST['lowValuePie']))	{$nieuwlowValuePie=$_REQUEST['lowValuePie'];} 		else {$nieuwlowValuePie=$lowValuePie;}
if (isset($_REQUEST['highValuePie']))	{$nieuwhighValuePie=$_REQUEST['highValuePie'];} 		else {$nieuwhighValuePie=$highValuePie;}
if (isset($_REQUEST['timeForDeal']))	{$nieuwtimeForDeal=$_REQUEST['timeForDeal'];} 		else {$nieuwtimeForDeal=$timeForDeal;}
if (isset($_REQUEST['timeForWarning']))	{$nieuwtimeForWarning=$_REQUEST['timeForWarning'];} 		else {$nieuwtimeForWarning=$timeForWarning;}
if (isset($_REQUEST['timeForIniOffer']))	{$nieuwtimeForIniOffer=$_REQUEST['timeForIniOffer'];} 		else {$nieuwtimeForIniOffer=$timeForIniOffer;}

if (isset($_REQUEST['robot']))	{$nieuwrobot=$_REQUEST['robot'];} 		else {$nieuwrobot=$robot;}

if (isset($_REQUEST['SPe']))	{$nieuwSPe=$_REQUEST['SPe'];} 		else {$nieuwSPe=$SPe;}
if (isset($_REQUEST['SPg']))	{$nieuwSPg=$_REQUEST['SPg'];} 		else {$nieuwSPg=$SPg;}
if (isset($_REQUEST['SPs']))	{$nieuwSPs=$_REQUEST['SPs'];} 		else {$nieuwSPs=$SPs;}
if (isset($_REQUEST['SPt']))	{$nieuwSPt=$_REQUEST['SPt'];} 		else {$nieuwSPt=$SPt;}

if (isset($_REQUEST['send'])) {
	//updateTableMore("commonparameters","$koers==60", "treatment='$nieuwtreatment', numbersubj='$nieuwnumbersubj', grgrootte='$nieuwgroupsize', subgrsize='$nieuwsubgrsize', koers='$nieuwkoers', showupfee='$nieuwshowupfee', mpcr='$nieuwmpcr', numberblock='$nieuwnumberblock', numberround='$nieuwnumberround'");
	updateTableOne("commonParameters","Name='treatment'","Value",$nieuwtreatment);
	updateTableOne("commonParameters","Name='mgroupsize'","Value",$nieuwmgroupsize);
	updateTableOne("commonParameters","Name='NPlayers'","Value",$nieuwNPlayers);
	updateTableOne("commonParameters","Name='maxValue'","Value",$nieuwPie);
	updateTableOne("commonParameters","Name='session'","Value",$nieuwsession);
	updateTableOne("commonParameters","Name='showUpFee'","Value",$nieuwshowupfee);
	updateTableOne("commonParameters","Name='showVideo'","Value",$nieuwshowVideo);
	updateTableOne("commonParameters","Name='showVideoOther'","Value",$nieuwshowVideoOther);
	updateTableOne("commonParameters","Name='Steps'","Value",$nieuwSteps);
	updateTableOne("commonParameters","Name='Time'","Value",$nieuwTime);
	updateTableOne("commonParameters","Name='totalTrials'","Value",$nieuwtotalTrials);

	updateTableOne("commonParameters","Name='totalPayTrials'","Value",$nieuwtotalPayTrials);

	updateTableOne("commonParameters","Name='minValue'","Value",$nieuwminValue);
	updateTableOne("commonParameters","Name='showChat'","Value",$nieuwshowChat);
	updateTableOne("commonParameters","Name='updateRateMS'","Value",$nieuwupdateRateMS);
	updateTableOne("commonParameters","Name='lowValuePie'","Value",$nieuwlowValuePie);
	updateTableOne("commonParameters","Name='highValuePie'","Value",$nieuwhighValuePie);
	updateTableOne("commonParameters","Name='timeForDeal'","Value",$nieuwtimeForDeal);
	updateTableOne("commonParameters","Name='timeForWarning'","Value",$nieuwtimeForWarning);
	updateTableOne("commonParameters","Name='timeForIniOffer'","Value",$nieuwtimeForIniOffer);

	updateTableOne("commonParameters","Name='robot'","Value",$nieuwrobot);

	updateTableOne("commonParameters","Name='SPe'","Value",$nieuwSPe);
	updateTableOne("commonParameters","Name='SPg'","Value",$nieuwSPg);
	updateTableOne("commonParameters","Name='SPs'","Value",$nieuwSPs);
	updateTableOne("commonParameters","Name='SPt'","Value",$nieuwSPt);


	updateTableOne("commonParameters","Name='startexp'","Value",0);

	header("Location: randomize.php");
	exit();
}

?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="beleggensns.css" />
<link rel="stylesheet" type="text/css" href="buttons.css" />
<script>
function funktie() {


	if(document.form1.tjektreatment.checked){document.form1.treatment.disabled=false;}else{document.form1.treatment.disabled=true;}
	if(document.form1.tjekA.checked){document.form1.mgroupsize.disabled=false;}else{document.form1.mgroupsize.disabled=true;}
	if(document.form1.tjekB.checked){document.form1.NPlayers.disabled=false;}else{document.form1.NPlayers.disabled=true;}
	if(document.form1.tjekC.checked){document.form1.maxValue.disabled=false;}else{document.form1.maxValue.disabled=true;}
	if(document.form1.tjekD.checked){document.form1.session.disabled=false;}else{document.form1.session.disabled=true;}
	if(document.form1.tjekE.checked){document.form1.showUpFee.disabled=false;}else{document.form1.showUpFee.disabled=true;}
	if(document.form1.tjekF.checked){document.form1.showVideo.disabled=false;}else{document.form1.showVideo.disabled=true;}
	if(document.form1.tjekG.checked){document.form1.showVideoOther.disabled=false;}else{document.form1.showVideoOther.disabled=true;}
	if(document.form1.tjekH.checked){document.form1.Steps.disabled=false;}else{document.form1.Steps.disabled=true;}
	if(document.form1.tjekI.checked){document.form1.Time.disabled=false;}else{document.form1.Time.disabled=true;}
	if(document.form1.tjekJ.checked){document.form1.totalTrials.disabled=false;}else{document.form1.totalTrials.disabled=true;}

	if(document.form1.tjekJJ.checked){document.form1.totalPayTrials.disabled=false;}else{document.form1.totalPayTrials.disabled=true;}

	if(document.form1.tjekK.checked){document.form1.minValue.disabled=false;}else{document.form1.minValue.disabled=true;}
	if(document.form1.tjekL.checked){document.form1.showChat.disabled=false;}else{document.form1.showChat.disabled=true;}
	if(document.form1.tjekM.checked){document.form1.updateRateMS.disabled=false;}else{document.form1.updateRateMS.disabled=true;}
	if(document.form1.tjekN.checked){document.form1.lowValuePie.disabled=false;}else{document.form1.lowValuePie.disabled=true;}
	if(document.form1.tjekO.checked){document.form1.highValuePie.disabled=false;}else{document.form1.highValuePie.disabled=true;}
	if(document.form1.tjekP.checked){document.form1.timeForDeal.disabled=false;}else{document.form1.timeForDeal.disabled=true;}
	if(document.form1.tjekQ.checked){document.form1.timeForWarning.disabled=false;}else{document.form1.timeForWarning.disabled=true;}
	if(document.form1.tjekR.checked){document.form1.timeForIniOffer.disabled=false;}else{document.form1.timeForIniOffer.disabled=true;}

	if(document.form1.tjekS.checked){document.form1.robot.disabled=false;}else{document.form1.robot.disabled=true;}

	if(document.form1.tjekT.checked){document.form1.SPe.disabled=false;}else{document.form1.SPe.disabled=true;}
	if(document.form1.tjekU.checked){document.form1.SPg.disabled=false;}else{document.form1.SPg.disabled=true;}
	if(document.form1.tjekV.checked){document.form1.SPs.disabled=false;}else{document.form1.SPs.disabled=true;}
	if(document.form1.tjekW.checked){document.form1.SPt.disabled=false;}else{document.form1.SPt.disabled=true;}


}

function is_int(value){
  if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
      return true;
  } else {
      return false;
  }
}

function validateForm() {
//check the variables!!!!
var numbersubj = document.forms["form1"]["NPlayers"].value;
var grgrootte = document.forms["form1"]["mgroupsize"].value;
var totrounds1 = document.forms["form1"]["totalTrials"].value;
//var rounds = document.forms["form1"]["rounds"].value;
if (is_int(grgrootte)==true && is_int(totrounds1)==true && is_int(numbersubj)==true && numbersubj % grgrootte==0 && grgrootte % 2==0){
	if(confirm("Are you sure you want to continue?")){
    			return true;
    				} else {
    					return false;
    				}
} else {
	if(alert("The number of subjects and trials should be integers!")){
      			return true;
    				} else {
      					return false;
    				}
}
}

function emptycheck() {
//check the variables!!!!
if (confirm("All unsaved data will be lost.\nMake sure that you exported the data!\nAre you sure you want to continue?")){
    			return true;
    				} else {
    					return false;
    				}
}



</script>

</head>

<body>

<BR><BR>
<table align=center width=1000>
 <col width=5%>
 <col width=90%>
 <col width=5%>
<tr><td colspan=3 align=center><a href="monitor.php" class="buttonoranje">Back to monitor</a></td></tr>

<tr><td></td>

<td>

<form  name="form1"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
<table class=rond align=center width=100% height=500>

	<tr><td colspan=3><BR><B>All tasks</B></td>
	</tr>

	<tr><td><input type="checkbox" name=tjektreatment value="ON" onclick="funktie()"></td>
		<td align=right bgcolor=<?php echo $mycolor; ?>>Treatment:</td><td><input type="number" name="treatment" min="1" max="4" step="1" value=<?php echo $treatment; ?> size=2 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekA value="ON" onclick="funktie()"></td>
		<td align=right bgcolor=<?php echo $mycolor; ?>>Matching-group-size:</td><td><input type="number" name="mgroupsize" min="2" step="2" value=<?php echo $mgroupsize; ?> size=2 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekB value="ON" onclick="funktie()"></td>
		<td align=right bgcolor=<?php echo $mycolor; ?>>Number of subjects:</td><td><input type="number" name="NPlayers" min="2" step="2" value=<?php echo $NPlayers; ?> size=2 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekC value="ON" onclick="funktie()"></td>
		<td align=right bgcolor=<?php echo $mycolor; ?>>Largest pie size:</td><td><input type="text" name=maxValue value=<?php echo $maxValue; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekD value="ON" onclick="funktie()"></td>
		<td align=right bgcolor=<?php echo $mycolor; ?>>Session:</td><td><input type="text" name="session" value=<?php echo $session+1; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekE value="ON" onclick="funktie()"></td>
		<td align=right>Show-up fee:</td><td><input type="text" name="showUpFee" value=<?php echo $showUpFee; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekF value="ON" onclick="funktie()"></td>
		<td align=right bgcolor=<?php echo $mycolor; ?>>Show video:</td>
		<td colspan=2><select name='showVideo' disabled>
			<option value="<?php echo $showVideo; ?>"><?php echo $videovalue; ?></option>
			<option value=0>0: No</option>
			<option value=1>1: Yes</option>
			</select>
		</td>
	</tr>

	<tr><td><input type="checkbox" name=tjekG value="ON" onclick="funktie()"></td>
		<td align=right bgcolor=<?php echo $mycolor; ?>>Show video other:</td>
		<td colspan=2><select name='showVideoOther' disabled>
			<option value="<?php echo $showVideoOther; ?>"><?php echo $othervideovalue; ?></option>
			<option value=0>0: No</option>
			<option value=1>1: Yes</option>
			</select>
		</td>
	</tr>

	<tr><td><input type="checkbox" name=tjekH value="ON" onclick="funktie()"></td>
		<td align=right>Slider increments:</td><td><input type="text" name="Steps" value=<?php echo $Steps; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekI value="ON" onclick="funktie()"></td>
		<td align=right>Time per trial:</td><td><input type="text" name="Time" value=<?php echo $Time; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekJ value="ON" onclick="funktie()"></td>
		<td align=right>Number of trials:</td><td><input type="text" name="totalTrials" value=<?php echo $totalTrials; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekJJ value="ON" onclick="funktie()"></td>
		<td align=right>Number of PAYED trials:</td><td><input type="text" name="totalPayTrials" value=<?php echo $totalPayTrials; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>


	<tr><td><input type="checkbox" name=tjekK value="ON" onclick="funktie()"></td>
		<td align=right> Slider minimum value:</td><td><input type="text" name="minValue" value=<?php echo $minValue; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>


	<tr><td><input type="checkbox" name=tjekL value="ON" onclick="funktie()"></td>
		<td align=right bgcolor=<?php echo $mycolor; ?>>Show chat:</td>
		<td colspan=2><select name='showChat' disabled>
			<option value="<?php echo $showChat; ?>"><?php echo $chatValue; ?></option>
			<option value=0>0: No</option>
			<option value=1>1: Yes</option>
			</select>
		</td>
	</tr>

	<tr><td><input type="checkbox" name=tjekM value="ON" onclick="funktie()"></td>
		<td align=right>Update Rate (ms):</td><td><input type="text" name="updateRateMS" value=<?php echo $updateRateMS; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekN value="ON" onclick="funktie()"></td>
		<td align=right>Low Value Pie:</td><td><input type="text" name="lowValuePie" value=<?php echo $lowValuePie; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekO value="ON" onclick="funktie()"></td>
		<td align=right>High Value Pie:</td><td><input type="text" name="highValuePie" value=<?php echo $highValuePie; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekP value="ON" onclick="funktie()"></td>
		<td align=right> Required time for there to be a deal (ms): </td><td><input type="text" name="timeForDeal" value=<?php echo $timeForDeal; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekQ value="ON" onclick="funktie()"></td>
		<td align=right>Required time for an "almost-deal" warning to appear (ms):</td><td><input type="text" name="timeForWarning" value=<?php echo $timeForWarning; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekR value="ON" onclick="funktie()"></td>
		<td align=right>Time for initial offer (s):</td><td><input type="text" name="timeForIniOffer" value=<?php echo $timeForIniOffer; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekS value="ON" onclick="funktie()"></td>
		<td align=right bgcolor=<?php echo $mycolor; ?>>Robotina Test?:</td>
		<td colspan=2><select name='robot' disabled>
			<option value="<?php echo $robot; ?>"><?php echo $robotValue; ?></option>
			<option value=0>0: No</option>
			<option value=1>1: Yes</option>
			</select>
		</td>
	</tr>

	<tr><td><input type="checkbox" name=tjekT value="ON" onclick="funktie()"></td>
		<td align=right>Social Preferences Task - Equality payment (e):</td><td><input type="text" name="SPe" value=<?php echo $SPe; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekU value="ON" onclick="funktie()"></td>
		<td align=right>Social Preferences Task - Inequality distance (g):</td><td><input type="text" name="SPg" value=<?php echo $SPg; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekV value="ON" onclick="funktie()"></td>
		<td align=right>Social Preferences Task - Size of steps (s):</td><td><input type="text" name="SPs" value=<?php echo $SPs; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>

	<tr><td><input type="checkbox" name=tjekW value="ON" onclick="funktie()"></td>
		<td align=right>Social Preferences Task - Number of steps right and left of equality (t):</td><td><input type="text" name="SPt" value=<?php echo $SPt; ?> size=5 AUTOCOMPLETE="OFF" disabled></td>
	</tr>


	<tr><td colspan=3 align=center>

	</td></tr>
	</table>
	</td>

<td></td></tr>
<tr><td colspan=53<p align=center><BR><input type="submit" name="send" value="Confirm" class=buttonblauw> </td></tr>
</table>



</form>

<p align=center> <a href="emptytable.php" class="buttonoranje" onclick="return emptycheck()">Empty data tables</a></p>

</br>
</br>
<form align=center ame="form1" method="post" action="download.php">
	Folder location: <input type="text" name="folder" value="uploads/" name="downloadtext" size=50 AUTOCOMPLETE="OFF">
	<input name="verzend" type="submit" class="buttonblauw" value="Download Database">
</form>

</body>
</html>

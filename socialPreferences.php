<?php
include("commonSlider.inc");
Header("Cache-Control: must-revalidate");

if (!$_COOKIE['theCookie']){
  header("Location: begin.html");
  exit();
}

$koek=readcookie("theCookie");
$ppnr=$koek[0];

updateTableOne("subjects","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);

//$part=$showChat*(-1)+2;
//$insNextPage=  instructionsNextPage($_SERVER['PHP_SELF'], $ppnr, $part);

$gVar=$SPg;
$sVar=$SPs;
$tVar=$SPt;
$eVar=$SPe;

?>


<!DOCTYPE HTML>
<HTML onContextMenu="return false;">
<HEAD>
  <TITLE> EE Test </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">

  <script>
  //66
  var ts=0;
  var tVar=<?php echo round($tVar,2); ?>;
  var eVar=<?php echo round($eVar,2); ?>;
  var sVar=<?php echo round($sVar,2); ?>;
  var gVar=<?php echo round($gVar,2); ?>;
  var answersUnequal= [];
  var part=1;
  var interTime=600;
  var answersUnequalPart1= [];
  var answersUnequalPart2= [];

  function controleren(form) {
    var answer1=document.forms['form1'].q1.value;
  	if (answer1== "correct" ) {
      if("<?php echo $insNextPage; ?>"=="waittostart.php"){
          alert("Correct!\nYou have finished the instructions and the quiz questions.");
          return true;
      } else{
          alert("Correct!\nYou will now proceed to the next set of questions.");
          return true;
      }
  	}
  	else {
  		alert("You did not answer all questions correctly. Please look at the instructions again or raise your hand if you need any help. \n\nHint: The final payoffs are calculated only from the the position of the sliders."
    );
  		return false;
  	}
  }

  function siguienteParte(){
    answersUnequalPart1=answersUnequal;
    answersUnequal= [];
    part=2;
    ts=-1;
    next();
    document.getElementById("decisionSec").style. visibility="visible";

  }

  function finalPart(){

  }

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

  function earningsSP(answers1,answers2){
    var totalSPTrials = answers1.length + answers2.length;
    var randTrialSelection=Math.floor((Math.random() * totalSPTrials) + 1);
    console.log(randTrialSelection);
    if (randTrialSelection<=answers1.length){
        var decisionUnequalChosen=answers1[randTrialSelection-1];
        if (decisionUnequalChosen==0) {
           var earnings=[eVar,eVar];
        } else {
           var earningsMe=eVar+sVar*(randTrialSelection-(tVar+1));
           var earningsOther=eVar+gVar;
           var earnings=[earningsMe,earningsOther];
        }
    } else{
        var decisionUnequalChosen=answers2[randTrialSelection-answers1.length-1];
        if (decisionUnequalChosen==0) {
           var earnings=[eVar,eVar];
        } else {
           var earningsMe=eVar+sVar*(randTrialSelection-answers1.length-(tVar+1));
           var earningsOther=eVar-gVar;
           var earnings=[earningsMe,earningsOther];
        }
    }


    return earnings;

  }

  function unequal(){
    //answersUnequal[i]=1 if unequal allocation was chosen
    answersUnequal[ts]=1;
    console.log(answersUnequal);
    next();


  }

  function equal(){
    //answersUnequal[i]=0 if equal allocation was chosen
    answersUnequal[ts]=0;
    console.log(answersUnequal);
    next();
  }

  function next(){
    if (ts<2*tVar){
      ts++;
      var newStep = eVar-tVar*sVar+sVar*ts;
      newStep= Math.round(newStep*100)/100;
      if (part==1){
        //first part is with e+g
        var otherPayoff = eVar + gVar;
      } else {
        //second part is with e-g
        var otherPayoff = eVar - gVar;
      }
      otherPayoff=Math.round(otherPayoff*100)/100;

      var texto= "You receive: $".concat(newStep,"<br><br> The other receives: $",otherPayoff);
      //document.getElementById("decisionSec").style.background = "#000066";
      document.getElementById("decisionSec").style.visibility="hidden";
      setTimeout(function(){document.getElementById("decisionSec").style. visibility="visible";},interTime);
      document.getElementById("stair").innerHTML = texto;
    } else {
        if(part==1){
          document.getElementById("decisionSec").style.visibility="hidden";
          //Uploads the answers in answersUnequal for the corresponding part.
          var answersUnequalString =answersUnequal.toString();
          loadDoc3(siguienteParte,"uploadSP.php",answersUnequalString,part,0);
        }  else if(part==2){
          document.getElementById("decisionSec").style.visibility="hidden";
          var answersUnequalString =answersUnequal.toString();
          loadDoc3(finalPart,"uploadSP.php",answersUnequalString,part,0);
          answersUnequalPart2=answersUnequal;
          var payoffs = earningsSP(answersUnequalPart1,answersUnequalPart2);
          var payoffMeFinal= payoffs[0];
          var payoffOtherFinal= payoffs[1];
          loadDoc3(finalPart,"uploadSP.php",payoffMeFinal,3,payoffOtherFinal);

          document.getElementById("decisionSec").style.display = "none";
          //document.getElementById("decisionSec").style.visibility="hidden";

          var texto = "This part of the experiment has finalized. <br> <br> For this part of the experiment you receive $".concat(payoffMeFinal,".<br> The other participant receives $",payoffOtherFinal,".<br><br> We now ask you to fill in a short and confidential survey. <br> <br> Click <i>Continue</i> when ready.");
          document.getElementById("finalMessage").innerHTML = texto;
          document.getElementById("botoncito").style.visibility = "visible";

        }
    }
  }

  </script>

  <script>

  //Disables some functions
  window.location.hash="no-back-button";
  window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
  window.onhashchange=function(){window.location.hash="no-back-button";}

  function disableRefresh(netscape){
    var F5=(netscape||event).keyCode;
      if(F5==116||F5==17||F5==8||F5==82){
        if(!netscape){event.keyCode=0}
        return false;
        }
    }

  document.onkeydown=document.onkeypress=disableRefresh;


  </script>



</HEAD>

<BODY>

  <table width="80%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td>
    <H1 align=center> Experiment: Part II </H1>
    <h2 align=center id="finalMessage"> </h2>
    </td>
  </tr>

</tr></td>

  </table>

  <br>
  <br>
  <br>

  <div id="decisionSec">

  <table id="decision" width="80%" border="2px" cellpadding="2px" cellspacing="0" align="center">
    <tr>
      <td> <h2 align=center id="stair"> You receive: $<?php echo round($eVar-$tVar*$sVar,2); ?><br><br> The other receives: $<?php echo round($eVar+$gVar,2); ?> <br> </h2> <br> <p align=center><a id="left" onclick="unequal()" class="buttonblauw" > Left </a> </td>
      <td> <h2 align=center> You receive: $<?php echo round($eVar,2); ?><br><br> The other receives: $<?php echo round($eVar,2); ?> <br> </h2> <br> <p align=center><a id="right" onclick="equal()" class="buttonblauw" > Right </a> </td>
    </tr>

  </table>
  <br>
  <br>

  </div>

  <p align=center><a id="botoncito" style="visibility:hidden" href="questionnaire.php" class="buttonblauw">Continue</a>




</BODY>
</HTML>

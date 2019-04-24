<?php
//No es necesario incluirlo todavia
include("commonSlider.inc");
if (!$_COOKIE['theCookie']){
    header("Location: begin.html");
    exit();
}
$koek=readcookie("theCookie");
$ppnr=$koek[0];

$trial=lookUp("subjects","ppnr='$ppnr'","trial");



$partner=findPartner($ppnr,$trial);

$sliderValue=lookUp("subjects","ppnr='$ppnr'","sValue");

$iknowPie=knowPie($ppnr,$trial);

$thePie=pieSize($ppnr,$trial);

$videoVisibility= ($showVideo == 1 ? "visible" : "hidden");

$chatVisibility= ($showChat == 1 ? "visible" : "hidden");

updateTableOne("subjects","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);

$blocked=lookUp("subjects","ppnr='$ppnr' AND trial='$trial' ","blocked");

?>


<!doctype html>
<html onContextMenu="return false;">
  <head>
    <meta http-equi="refresh" content="30">

    <title>Version 3.3.2 Bargaining</title>
    <!--  Fixes after version 3.3.1:  Not waiting for the other to save, fixes questionnaire apostrophe problem -->

    <link rel="stylesheet" href="generalConfig.css"/>
    <script src="jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="sliderConfig.css">
    <script src="js-webshim/dev/polyfiller.js"></script>


    <script>
    //configure before calling webshims.polyfill

    webshim.setOptions("forms-ext", {
      replaceUI: 'auto',
      "range": {
          "classes": "show-activevaluetooltip show-tickvalues"
         }
        });
        //webshim.setOptions('loadStyles', false);

        webshim.polyfill("forms forms-ext");

     </script>

    <!--Camera JS Coding:
    > Muaz Khan     - github.com/muaz-khan
    > MIT License   - www.webrtc-experiment.com/licence
    > Documentation - www.RecordRTC.org
    -->
    <!-- <script src="https://cdn.webrtc-experiment.com/gumadapter.js"></script> -->
    <script src="gumadapter.js"></script>
    <script src="RecordRTC1.js"></script>

    <!-- Script 1 Sliders and Chat JS-->
    <script>

    var timeStartScript = new Date().getTime();

    //It is exact when the trial finishes before maximum time. Otherwise endTime could go a bit over the limit, but it just specifies how long it took to check both participants had a deal
    var endTime;

    var timeStartVideo;
    var timeStartedBoth;
    var maxEndTime;
    var timeStartPayoff;
    //var videoOtherON=0;
    var timeBargaining = parseInt(<?php echo $Time; ?>);
    var timeInitialOffer = parseInt(<?php echo $timeForIniOffer; ?>);
    var refreshTime = <?php echo $updateRateMS;?>;
    var warningTime = <?php echo $timeForWarning;?>;
    var dealTime = <?php echo $timeForDeal;?>;
    var bargainingStarted=0;
    //Time before everysithing starts that camera is recording
    var iniTime=3000;
    var resultsTime= 5000;
    //Modifiable variables (in database)
    var robotina = <?php echo $robot; ?>;


    var showChat= <?php echo $showChat; ?>;
    var showVideo= <?php echo $showVideo; ?>;

    //THe number of times that the script checks for the other player agreement upload (in trialinfo) before calling it a mistake.
    //var numberOfChecks = 5;
    var tempNumberOfChecks = 0;
    var enteredNextTrialFunct =0;

    //This variable quantifies the number of times it has been checked the trialInfo of the other participant without a coincidence (and when the time is already over)
    //In case a limit of this checks has been reached. The trial info is still loaded, but with an error in the agreement variable (2).
    var noAgreements = 0;

    //Makes sure that the function for starting the trial after checking that both videos started is only entered once.
    var gotInStartingFucntionAfterBothStartedRec =0 ;

    //Makes sure that Attempts to start recording only once
    //123
    var otherIsOnRoomEntered=0;

    //Function to send to POST on a PHP file the value.
    // Also runs "funcion", ononreadystatechange.
    //TODO call only this function for all loadDoc()... the other is just one special case of this
    function loadDoc5(funcion, url, value1,value2,value3,value4,value5) {
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
    xhttp.open("GET", url + "?v=" + value1+"&v2=" + value2+ "&v3=" + value3+ "&v4=" + value4+ "&v5=" + value5, true);
    xhttp.send();
    }

    //Function to send to POST on a PHP file the value.
    // Also runs "funcion", ononreadystatechange.
    //TODO call only this function for all loadDoc()... the other is just one special case of this
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

    function loadDoc(funcion, url, value) {
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
    xhttp.open("GET", url + "?v=" + value, true);
    xhttp.send();
    }

    //Does Nothing, a couple of functions are using it when using AJAX method (loaddoc...)
    function funcSLiderChange(xhttp){
    }


    //minimim x and y coordinate of circle within the canvas
    var d=35;
    //Diameter
    var xCanvasSize=300;
    var yCanvasSize=100
    var radius=30;
    var centerNx=0.5*xCanvasSize;
    var centerNy=radius;

    function cirkel(ctx, x, y, r, kleur){
      ctx.beginPath();
      ctx.arc(x, y, r, 0, 2 * Math.PI, false);
      ctx.fillStyle = kleur;
      ctx.fill();
      }

    function clearCanvas(ctx){
      ctx.clearRect(0, 0, xCanvasSize, yCanvasSize);
    }

    //Draws the corresponding alert (circles)
    //Alertype=  0(clear drawing), 1(Matching),2(Almost deal),3(Deal),4(no agreement time is up),
    function drawAlertCircle(alertType){
      var b_canvas = document.getElementById("canvitas");
      var b_context = b_canvas.getContext("2d");
      if(alertType== -1){
        b_context.strokeStyle="white";
        b_context.textAlign="center";
        //b_context.font="30px";
        b_context.fillText("Place your initial offer",10,50,200);
      }else if(alertType==0){
        clearCanvas(b_context);
      } else if(alertType==1){
        cirkel(b_context, centerNx, centerNy, radius, "green");
      } else if (alertType==2) {
        cirkel(b_context, centerNx, centerNy, radius, "green");
        cirkel(b_context, centerNx-2*radius, centerNy, radius, "green");
        cirkel(b_context, centerNx+2*radius, centerNy, radius, "green");
      } else if (alertType==3) {
        cirkel(b_context, centerNx, centerNy, radius, "yellow");
        cirkel(b_context, centerNx-2*radius, centerNy, radius, "yellow");
        cirkel(b_context, centerNx+2*radius, centerNy, radius, "green");
      } else if (alertType==4) {
          cirkel(b_context, centerNx, centerNy, radius, "red");
      }
    }


    function continuosUpdate(){
      updateSLidersTimer = setInterval(function(){ updateSliders(); }, refreshTime);

      if(showChat==1){
        updateChatsTimer = setInterval(function(){ updateChats(); }, refreshTime);
      }
    }

    var startTimer1;
    var startTimer2;
    var startVideoCheckInterval;
    var started=0;
    var finished=0;
    function updateSliders(){
      // Updates slider of the other participant
      var slider = $('#slider2');
      var valSlider2 = getValueSlider2();
      slider.val(valSlider2);

      //Checks if both sliders are the same value or not
      var valSlider1 = getValueSlider1();
      if(bargainingStarted==1){
        if (valSlider1==valSlider2 && finished==0){
          //changeConfigEqualSliders("yellow");
          if(started==0){
            started=1;
            //123
            //alertSameSliders(1);
            drawAlertCircle(1);
            startTimer2 = setTimeout(function(){agreementAlmostFinalized();}, warningTime);
            startTimer1 = setTimeout(function(){agreementFinalized();},dealTime);
          }
        } else {
            //123
            //alertSameSliders(0);
            //drawAlertCircle(0);
            window.clearTimeout(startTimer1);
            window.clearTimeout(startTimer2);
            started=0;
            if (finished==0){
              //Erases any alert message that could have hinted that a deal is about to take place
              //document.getElementById("centerDivText").innerHTML = "";
              drawAlertCircle(0);
            }
          //changeConfigEqualSliders("gray");
        }
      }
      //Updates timer and then checks if time is over
      var timer= (maxEndTime - currentTime())/1000;
      var roundTimer=Math.round(timer);
      if (isNaN(timer)){
        document.getElementById("timerDiv").innerHTML = timeInitialOffer;
      }
      else {
        if(timer>timeBargaining){
          //This happens while on the initial Offer
          document.getElementById("timerDiv").innerHTML = Math.round(timer-timeBargaining);
        } else if (timer>=0) {
          //This happen while on the bargaining part of the experiment (after the intial offer)
          document.getElementById("timerDiv").innerHTML = roundTimer;

          if(bargainingStarted==0){
            startBargaining();
          }
        }
      }
      if ( currentTime() > maxEndTime && finished==0 ){
        noAgreement();
        finished=1;
      }

    }


    //Gets sValue2 from database and updates number under slider2
    function getValueSlider2(){

      //TODO More effcient way to get data from php using jQuery?
      /*
      var vS2= $.ajax({
			      url: "updateSliders.php",
			      type: "Get",
			      dataType: "json"
		  });
      //document.getElementById("prueba").innerHTML = vS2("1");
      console.log(vS2[2]);
      return vS2;
      */
      var val2Temp = document.getElementById("infoPHP2").innerHTML;
      var timeSlider = new Date().getTime();
      loadDoc3(changeHttpSliderValue2,'updateSliders2.php',timeSlider,val2Temp,1);
      return document.getElementById("infoPHP2").innerHTML;
    }

    //Gets sValue1 ands sValue2 from database, updates number under slider1 and inserts record with both svalues in database
    function getValueSlider1(){
      var val2Temp = document.getElementById("infoPHP2").innerHTML;
      var timeSlider = new Date().getTime();
      loadDoc3(changeHttpSliderValue1,'updateSliders1.php',timeSlider,val2Temp,1);
      return document.getElementById("infoPHP1").innerHTML;

    }

    function changeHttpSliderValue1(xhttp){
      document.getElementById("infoPHP1").innerHTML = xhttp.responseText;
    }

    function changeHttpSliderValue2(xhttp){
      document.getElementById("infoPHP2").innerHTML = xhttp.responseText;
    }

    function changeConfigEqualSliders(color){
      document.body.style.background = color;
    }

    function robotina1(){
      robotinaTimer = setInterval(function(){ robotina2(); }, 4000);
    }

    function robotina2(){
      var slider = $('#slider1');
      var valRobotSlider1 = Math.round(Math.random()*6);
      slider.val(valRobotSlider1);
      loadDoc(funcSLiderChange,'sameValue.php',valRobotSlider1);
    }

    function agreementFinalized(){
      if (finished==0){
        //Checks if the constrains are still satisfied, just in case the "updatesliders" wasn't called on time to reset Timers
        var slider = $('#slider2');
        var valSlider2 = getValueSlider2();
        slider.val(valSlider2);
        var valSlider1 = getValueSlider1();

        if (valSlider1==valSlider2 && currentTime() <= maxEndTime ) {
          //Checks if time hasn't finished plus other things
          if (finished==0){
            finished=1;
            disableSLiders(1);

            //66
            endTime = new Date().getTime();

            if(robotina==1){
                window.clearInterval(robotinaTimer);
            }
            //Sets blocked=1 for me (Part Not used: and checks the other participant blocked)
            loadDoc(funcSLiderChange,'sliderBlocked.php','1');
            //if the other participant has been blocked then agreement has actually succeded (this is to prevent that last minute changes in the slider don't generate an agreement)
            //Check1
            setTimeout(function(){confirmAgreement();},refreshTime*3);
          }
        } else {
          started=0;
          if (finished==0){
            //Erases any alert message that could have hinted that a deal is about to take place
            drawAlertCircle(0);
          }
        }
      }
    }

    function confirmAgreement(){
      //Checks the other participant blocked (Not used: Sets blocked=1 for me)
      loadDoc(checkOtherBlocked,'checkSliderBlocked.php','1');
    }

    function checkOtherBlocked(xhttp){
      var oBlocked = xhttp.responseText;

      console.log("el otro bloqueo?:");
      console.log(oBlocked);
      console.log(finished);
      if (oBlocked==1) {
          //endTime = new Date().getTime();
          loadAgreementFunction(1);
      } else {
          if(currentTime() <= maxEndTime){
            finished=0;
            disableSLiders(0);
            loadDoc(funcSLiderChange,'sliderBlocked.php','0');
            started=0;
            oBlocked=0;
            drawAlertCircle(0);

            if(robotina==1){
                robotina1();
            }
          }
          else {
            noAgreement();
          }
      }
    }


    function checkDealIsCorrect(){
      //Check2
      intervalCheckDeal = setInterval(function(){loadDoc(nextTrial,'checkDealCorrect.php',1);},refreshTime*2);
    }

    function loadAgreementFunction(deal){
      loadDoc5(checkDealIsCorrect,'loadAgreement.php',timeStartScript,timeStartVideo,endTime,deal,timeStartedBoth);
    }


    //if yes==1: disables Slider1 and other relevant things
    // if yes==0: enables Slider1 and the other relvant things (timers...)
    function disableSLiders(yes){
      if (yes==1){
          $("#slider1").attr("disabled", "true");
      } else if (yes==0) {
        $("#slider1").prop("disabled",0);
      }

    }

    //function that runs when time is over. There might still be a deal if both sliders at the same deal.
    function noAgreement(){
      disableSLiders(1);

      if(robotina==1){
        try {
          window.clearInterval(robotinaTimer);
        } catch (e) {
           console.log("robotinaTimer not set (problema del checking deal)");
        } finally {

        }

      }
      //66
      //endTime = new Date().getTime();
      endTime = maxEndTime;
      var valSlider1 = getValueSlider1();
      var valSlider2 = getValueSlider2();

      if (valSlider1==valSlider2) {

        loadAgreementFunction(1);
      }else {
        loadAgreementFunction(0);
      }

    }

    function agreementAlmostFinalized(){
      if(finished==0){
        drawAlertCircle(2);
      }
    }

    //if same==1 it alerts that the sliders are the same. If same==0, it erases the alert.
    //123
    /*
    function alertSameSliders(same){

      if(same==1){
        drawAlertCircle(1);
      }
      else if (same==0) {
        drawAlertCircle(0);
      }

    }
    */



    function enterChat(){
      var F5=event.keyCode;
      if(F5==13){
        loadDoc3(submitChat,"submitChat.php",chat.msg.value,currentTime(),currentTime());
        }
    }
    //href="#" onclick='loadDoc3(submitChat,"submitChat.php",chat.msg.value,currentTime(),currentTime())'


    //Submits chat if the textarea is not empty
    //TODO check no empty areas!
    function submitChat(xhttp){
      document.getElementById("chatLogs").innerHTML = xhttp.responseText;
      chat.msg.value="";
    }

    function updateChats(){

      loadDoc(updateChats2,"updateChat.php",0)
      //$('#chatLogs').load('updateChat.php');

    }

    function updateChats2(sms){
      var chatTemp = document.getElementById("chatLogs").innerHTML;
      var chatNew = sms.responseText;
      document.getElementById("chatLogs").innerHTML = chatNew;
      if(chatNew != chatTemp){
        document.getElementById("chatSection").style.background= "#1EFF9E";
        setTimeout(function(){document.getElementById("chatSection").style.background= "grey";},150);
      }

    }

    //Moves to Next trial conditional on a check of loadAgreement of the other player (trialinfo table in Db)
    function nextTrial(sms){
      if(enteredNextTrialFunct==0){
        enteredNextTrialFunct=1;
        //0: No deal
        //1: deal
        //2: Not found
        var dealCorrect=sms.responseText;
        console.log("Was the deal correct?");
        console.log(dealCorrect);
        console.log("number of Checks:")
        console.log(tempNumberOfChecks);
        if (dealCorrect==1){
          window.clearInterval(intervalCheckDeal);
          tempNumberOfChecks=0;
          //Record video when finalized
          //stopRec();

          loadDoc(showPayoff,'getPayoff.php','0');

          //setTimeout(function(){ setInterval(function(){ checkOtherVideoSaved(); }, refreshTime); }, resultsTime);
        } else if (dealCorrect==0) {
            notSameTrialInfoFound();
            //Deal is Incorrect
            enteredNextTrialFunct=0;
        } else {
          //Havent found the other agreement.
          tempNumberOfChecks ++;
          if(tempNumberOfChecks>=3){
            //Deal is Incorrect
            notSameTrialInfoFound();
          }
          enteredNextTrialFunct=0;
        }

      }
    }

    function notSameTrialInfoFound(){

      window.clearInterval(intervalCheckDeal);
      tempNumberOfChecks=0;
      //Erase current loadAgreement.
      loadDoc(funcSLiderChange,'eraseLoadAgreement.php',1);
      //Checks if time hasn't finished
      if (currentTime() <= maxEndTime ) {
        drawAlertCircle(0);
        finished=0;
        started=0;
        disableSLiders(0);
        loadDoc(funcSLiderChange,'sliderBlocked.php','0');
        oBlocked=0;
      } else {
        // In case we get infinite loop: (after 3 loops: pass an error (agreement = 2) and go to next trial )
        //This one is not selected in the earnings randomization
        noAgreements ++;
        //error?
        if (noAgreements<=3){
          noAgreement();
        } else {
          //66
          //endTime = new Date().getTime();
          endTime = maxEndTime;

          loadDoc5(funcSLiderChange,'loadAgreement.php',timeStartScript,timeStartVideo,endTime,2,timeStartedBoth);
          loadDoc(showPayoff,'getPayoff.php','0');
        }

      }


    }

    function checkOtherVideoSaved(){
      loadDoc(checkOtherVideoSaved2,'videoSaved.php',"1");
    }

    var waitingForWaitingPage =0;

    function checkOtherVideoSaved2(xhttp){
      var oVideoSaved = xhttp.responseText;
      console.log("Number of Saved Videos?:");
      console.log(oVideoSaved);
      //123
      //if (oVideoSaved == 2 && waitingForWaitingPage ==0 ) {
      if (oVideoSaved >= 1 && waitingForWaitingPage ==0 ) {
              waitingForWaitingPage =1;
              window.location.replace("waitingPage.php");
      }
    }

    function showPayoff(xhttp){
      var pago=xhttp.responseText;
      var str1="<br>The pie size was: $ <?php echo $thePie ?> <br> <br> Your earnings are: $ ";

      console.log(pago);
      console.log(str1);
      var textoFin= str1.concat(pago);
      console.log(textoFin);

      //waitForRecordingPage(textoFin);
      //123
      document.getElementById("entirePage").style.display = "none";
      document.getElementById("waitingPageTexto").innerHTML = textoFin;
      document.getElementById("waitingPage").style.display = "block";
      timeStartPayoff=currentTime();

      loadDoc(funcSLiderChange,'savePayoffTime.php',timeStartPayoff);

      setTimeout(function(){ waitForRecordingPage("Saving, Please Wait..."); }, resultsTime);

    }


    function currentTime(){
      var tiempo = new Date().getTime();
      return tiempo;
    }

    function timeStartVideoF(){

      timeStartVideo=currentTime();
      loadDoc(funcSLiderChange,'videoWasStarted.php',1);
      startVideoCheckInterval = setInterval(function(){ startVideoPage(); }, refreshTime);

      console.log("newTime");
      console.log(timeStartVideo);
    }


    //Video v3
    function successCallback(stream) {

        console.log("successcallback")
        // RecordRTC usage goes here
        var options = {
          type: 'video',
          //video: { width: 1280, height: 720 },
          canvas: { width: 800, height: 600 },
          recorderType: WhammyRecorder // optional
          };
        recordRTC = RecordRTC(stream, options);
        recordRTC.startRecording(timeStartVideoF);
        console.log("este es el recordRTC");
        console.log(recordRTC);
        recordingPlayer.srcObject = stream;
        recordingPlayer.play();
        //recordingPlayer.srcObject = stream;
        //recordingPlayer.play();
        //timeStartVideo=currentTime();
        //loadDoc(funcSLiderChange,'videoWasStarted.php',1);
    }

    //Video V3
    function errorCallback(error) {
        console.log(error);
    }

    //Video v3
    var mediaConstraints = { video: true, audio: false };

    //66
    function otherInRoom(){
      //checks if started== 1 through php videoStarted.php
      loadDoc(otherInRoom2,'playerIsOnRoom.php',"1");
    }

    function otherInRoom2(xhttp){
      var otherIsOnRoom = xhttp.responseText;
      console.log("Other is in room?");
      console.log(otherIsOnRoom);
      if(otherIsOnRoom == 1 && otherIsOnRoomEntered==0){
        otherIsOnRoomEntered==1;
        window.clearInterval(otherOnRoomTimer);
        navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);

      }
    }

    otherOnRoomTimer = setInterval(function(){ otherInRoom(); }, refreshTime*5);

    //navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);

    //Video v3
    function stopRec(){

      window.clearInterval(updateSLidersTimer);
      if(showChat==1){
        window.clearInterval(updateChatsTimer);
      }

      recordRTC.stopRecording(function(videoURL) {
        recordingPlayer.src = videoURL;
        var recordedBlob = recordRTC.getBlob();
        //recordRTC.getDataURL(function(dataURL) { });
        var fileType = 'video';
        var fileName = ppnr + 'T' + trial + '.webm';
        // create FormData
        var formData = new FormData();
        formData.append(fileType + '-filename', fileName);
        formData.append(fileType + '-blob', recordedBlob);
        //formData.append(fileType + '-blob', blob.video);

        makeXMLHttpRequest('save.php', formData, function(progress) {
            if (progress !== 'upload-ended') {
                console.log(progress);
                return;
            }
            var initialURL = location.href.replace(location.href.split('/').pop(), '') + 'uploads/';
            // to make sure we can delete as soon as visitor leaves
            listOfFilesUploaded.push(initialURL + fileName);
        });

      });

    }


    function makeXMLHttpRequest(url, data, callback) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                console.log('upload-ended');
            }
        };
        request.upload.onloadstart = function() {
            console.log('Upload started...');
        };
        request.upload.onprogress = function(event) {
            console.log('Upload Progress ' + Math.round(event.loaded / event.total * 100) + "%");
        };
        request.upload.onload = function() {
            console.log('progress-about-to-end');
        };
        request.upload.onload = function() {
            console.log('progress-ended');
            loadDoc(funcSLiderChange,'videoWasSaved.php',"1");
        };
        request.upload.onerror = function(error) {
            console.log('Failed to upload to server');
            console.error('XMLHttpRequest failed', error);
        };
        request.upload.onabort = function(error) {
            console.log('Upload aborted.');
            console.error('XMLHttpRequest aborted', error);
        };
        request.open('POST', url);
        request.send(data);
    }

    //Disables some functions
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
    window.onhashchange=function(){window.location.hash="no-back-button";}

    function disableRefresh(netscape){
      var F5=(netscape||event).keyCode;

        //F5==82 is r
        //||F5==8 is delete
        // 17 is control
        //116 f5
        //if(F5==116||F5==17||F5==8||F5==82)
        // Added disable for r, to disable refresh
        if(F5==116||F5==17||F5==8){
          if(!netscape){event.keyCode=0}
          return false;
        }
        // Added disables r, to disable refresh in case chat is not being used

        if(F5==82 && showChat==0){
          if(!netscape){event.keyCode=0}
          return false;
        }


          // Alt+0 takes you to the next trial, in case there is an error in the trial for that participant
          if (event.altKey && F5==48){
            window.location.replace("waitingPage.php");
          }

      }



    document.onkeydown=disableRefresh;
    //document.onkeydown=emergencyNextTrial;


    </script>

  </head>

  <body>

  <div id="entirePage">

    <div class="divTitle" >
      <div id="pieInstructions">
      </div>
      <div id="timerDiv">
        ...
      </div>
      <div id="centerDiv">

        <!-- <p id="centerDivText"> </p> -->

        <canvas id=canvitas width="300" height="100"></canvas>

      </div>
    </div>

    <!--3.0.1 -->
    <h1 id="iniOffer">  </h1>

    <!-- Slider 1 -->
    <h2 class="participantTitles"> You </h2>
    <div class="leftOfSlider" > <?php echo $minValue; ?> </div>
    <div class="divSlider" > <?php echo $maxValue; ?> </div>
    <div class="rightOfSlider" align="center" >

      <input onChange="loadDoc(funcSLiderChange,'sameValue.php',this.value)" type="range" id="slider1" class="slider" value=<?php echo lookUp("subjects","ppnr='$ppnr'","sValue");?> min=<?php echo $minValue; ?> max=<?php echo $maxValue; ?> step=<?php echo $Steps;?> list=tickmarks>
      <datalist id=tickmarks>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </datalist>
    </div>

    <p id="infoPHP1" align="center"> Waiting for Connection... </p>

    <!-- Slider 2 -->
    <div id="slider2Section" >
      <h2 class="participantTitles"> Other </h2>
      <div class="leftOfSlider" > <?php echo $minValue; ?> </div>
      <div class="divSlider" > <?php echo $maxValue; ?> </div>
      <div class="rightOfSlider" align="center" >
        <input type="range" id="slider2" class="slider" value=<?php echo lookUp("subjects","ppnr='$partner'","sValue");?> min=<?php echo $minValue; ?> max=<?php echo $maxValue; ?> step=<?php echo $Steps;?> list=tickmarks disabled>
      </div>


      <p id="infoPHP2" align="center"> Waiting for Connection... </p>

    </div>

    <!-- CHATBOX -->
    <div id="chatSection" style="visibility:<?php echo $chatVisibility; ?>">
      <h2 class="insideChat"> ChatBox </h2>

      <div class="insideChat" id="chatLogs">
        Loading ...
      </div>

      <form id="insideMsg" class="insideChat" name="chat" >
      <br/>
      <textarea name="msg" id="insideMsg2">  </textarea> <br/>
      <a href="#" onclick='loadDoc3(submitChat,"submitChat.php",chat.msg.value,currentTime(),currentTime())'> Send  </a>
      </form>
    </div>

    <div id="videoSection" style="visibility:<?php echo $videoVisibility; ?>"  >
      <!-- Video Conference -->
      <!--
      <h2 class="insideVideo"> Video Conference </h2>
      -->

      <!-- local/remote videos container -->
      <!-- Fit video in container -->
      <div class="insideVideo" id="videos-container">
        <video id="videito" controls muted></video>
      </div>
    </div>




</div>


    <div id="waitingPage" style="display:none" class="textWaiting">

      <h5 id="waitingPageTexto"> </h5>

    </div>

    <!-- Script 2 Sliders and Chat JS-->
    <script>
    var knowPie= <?php echo $iknowPie; ?>;
    var Pie = <?php echo $thePie; ?>;
    if (showVideo==1){
      var showVideoSection= "visible";
    } else {
      var showVideoSection= "hidden";
    }

    if (showChat==1){
      var showChatSection= "visible";
    } else {
      var showChatSection= "hidden";
    }


    //Update continuously
    //continuosUpdate();


    function getStarted(){
      //document.getElementById("entirePage").style.visibility = "hidden";
      //document.getElementById("chatSection").style.visibility = "hidden";
      //document.getElementById("videoSection").style.visibility = "hidden";
      document.getElementById("entirePage").style.display = "none";
      document.getElementById("waitingPageTexto").innerHTML = "Please wait until all players are ready.";
      document.getElementById("waitingPage").style.display = "block";
      //document.getElementById("entirePage").style.display = "block";
      //document.getElementById("chatSection").style.display = "none";
      //document.getElementById("chatSection").style.visibility = "hidden";
      //document.getElementById("entirePage").style.display = "block";
      //document.getElementById("entirePage").style.background-color = "white";

      //123
      //startVideoCheckInterval = setInterval(function(){ startVideoPage(); }, refreshTime);
    }


    //checks if both participants are ready to start and if they are, it runs "startInitialOffer" after an "iniTime" delay
    function startVideoPage(){
      //checks if started== 1 through php videoStarted.php
      loadDoc(startVideoPage2,'videoStarted.php',"1");
    }

    function startVideoPage2(xhttp){
      var oVideoStarted = xhttp.responseText;
      console.log("Number of Started Videos?:");
      console.log(oVideoStarted);
      if(oVideoStarted == 2){

          //Change timeStartVideo for a value in the database:
          //Create variable: timeStartInterval and create srtartTimer.php

          window.clearInterval(startVideoCheckInterval);
          //loadDoc(startVideoPage3, 'startTimer.php',1);
          var timeBothVideo = currentTime();
          console.log("My Time:");
          console.log(timeBothVideo);
          loadDoc(funcSLiderChange, 'startTimer.php',timeBothVideo);
          timeStartInterval=setInterval(function(){ startInitialTimer(); }, refreshTime);

      }
    }

    function startInitialTimer(){
      loadDoc(startVideoPage3, 'checkStartTimer.php',1);
    }

    function startVideoPage3(sms){
      var timeStartVideoBothTemp = sms.responseText;
      console.log("maxtime from both");




      if (timeStartVideoBothTemp != 0 && gotInStartingFucntionAfterBothStartedRec == 0){
          console.log(timeStartVideoBothTemp);
          gotInStartingFucntionAfterBothStartedRec = 1;
          clearInterval(timeStartInterval);
          timeStartedBoth=parseInt(timeStartVideoBothTemp);
          //console.log("timeStartedBoth");
          //console.log(timeStartedBoth);
          maxEndTime = timeStartedBoth + timeBargaining *1000 + timeInitialOffer*1000 + iniTime;
          //console.log("MaxEndTime");
          //console.log(maxEndTime);

          //123 66 Be carefull: if times are different across computers you will get a mistake
          setTimeout(function(){ document.getElementById("entirePage").style.visibility = "visible";
          tiempoTrue=currentTime()-timeStartedBoth;
          console.log("Exact Start Time of Inital offer");
          console.log(tiempoTrue);
        }, iniTime-(currentTime()-timeStartedBoth));

          continuosUpdate();
          startInitialOffer();



          //setTimeout(function(){ document.getElementById("entirePage").style.visibility = "visible"; }, iniTime);


        }
    }

    function startInitialOffer(){
      //3.0.1
      if(knowPie){
        document.getElementById("pieInstructions").innerHTML = "Pie size is $" + Pie ;
      } else{
        document.getElementById("pieInstructions").innerHTML = ""
      }

      document.getElementById("slider2Section").style.visibility = "hidden";
      document.getElementById("chatSection").style.visibility = "hidden";
      document.getElementById("videoSection").style.visibility = "hidden";
      document.getElementById("waitingPage").style.display = "none";


      document.getElementById("iniOffer").innerHTML = " &nbsp &nbsp Place your initial offer";

      //3.0.3
      document.getElementById("entirePage").style.visibility = "hidden";
      document.getElementById("entirePage").style.display = "block";

      if(robotina==1){
        robotina1();
      }

      //drawAlertCircle(-1);
      //document.getElementById("centerDivText").innerHTML = "Place your initial offer";
    }


    function startBargaining(){

      //3.0.1
      document.getElementById("iniOffer").style.visibility = "hidden";

      //document.getElementById("centerDivText").style.display = "none";

      document.getElementById("slider2Section").style.visibility = "visible";


      //$("#slider1").attr("disabled", "true");
      //$("#slider1").attr("disabled", "false");

      //initiates Chat
      document.getElementById("chatSection").style.visibility = showChatSection;
      if(showChat==1){
            //document.onkeydown=enterChat;
            document.onkeyup=enterChat;
      }

      document.getElementById("videoSection").style.visibility = showVideoSection;

      bargainingStarted=1;

    }

    function waitForRecordingPage(mensaje){
      stopRec();
      document.getElementById("entirePage").style.display = "none";
      document.getElementById("waitingPageTexto").innerHTML = mensaje;
      document.getElementById("waitingPage").style.display = "block";
      setInterval(function(){ checkOtherVideoSaved(); }, refreshTime);
    }


    window.onload = getStarted();


    </script>


    <!-- Script 1 Camera JS-->
    <script>
    //Additional Variables and methods:
    //var ppnr=1;
    //var partner=2;
    var ppnr= <?php echo $ppnr; ?>;
    var partner = <?php echo $partner; ?>;

    //TODO creo q estas dos variables no se necesitan
    var trial= <?php echo $trial; ?>;
    var totalTrials = <?php echo $totalTrials; ?>;

    //Video v3
    var recordingPlayer = document.getElementById('videito');
    console.log("este es el recordingPlayer");
    console.log(recordingPlayer);

    //Dimensions of the video
    function scaleVideos() {
        var videos = document.querySelectorAll('video'),
            length = videos.length,
            video;
        var minus = 130;
        var windowHeight = 700;
        var windowWidth = 600;
        var windowAspectRatio = windowWidth / windowHeight;
        var videoAspectRatio = 4 / 3;
        var blockAspectRatio;
        var tempVideoWidth = 0;
        var maxVideoWidth = 0;

        //Relocates and scales video panes according to number of videos
        for (var i = length; i > 0; i--) {
            blockAspectRatio = i * videoAspectRatio / Math.ceil(length / i);
            if (blockAspectRatio <= windowAspectRatio) {
                tempVideoWidth = videoAspectRatio * windowHeight / Math.ceil(length / i);
            } else {
                tempVideoWidth = windowWidth / i;
            }
            if (tempVideoWidth > maxVideoWidth)
                maxVideoWidth = tempVideoWidth;
        }
        for (var i = 0; i < length; i++) {
            video = videos[i];
            if (video)
                video.width = maxVideoWidth - minus;
        }
    }

    window.onresize = scaleVideos;

    </script>


  </body>

</html>

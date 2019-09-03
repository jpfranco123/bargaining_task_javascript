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

$start_value=startValue($ppnr,$trial);
$other_start_value=startValue($partner,$trial);

$iknowPie=knowPie($ppnr,$trial);

$thePie=pieSize($ppnr,$trial);

$trial_type = trialType($ppnr,$trial);

updateTableOne("subjects","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);

?>

<!doctype html>
<html onContextMenu="return false;">
  <head>
    <!-- <meta http-equi="refresh" content="30"> -->
    <title>Efficient Bargaining</title>
    <link rel="stylesheet" type="text/css" href="buttons.css" /> <!--confirm-->
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
     //66: Video
     > Muaz Khan     - github.com/muaz-khan
     > MIT License   - www.webrtc-experiment.com/licence
     > Documentation - www.RecordRTC.org
     -->
     <!-- <script src="https://cdn.webrtc-experiment.com/gumadapter.js"></script> -->
     <!-- <script src="gumadapter.js"></script>
     <script src="RecordRTC1.js"></script> -->

<script>

  //Websocket set up.
  const url = 'ws:/45.113.235.169:8080';// 'ws:/130.56.248.241:8080'
  //const url = 'ws:/localhost:8080'
  const connection = new WebSocket(url);



// Variables Related to Bargaining trial

   // var timeStartScript = new Date().getTime();
   // var maxEndTime;
   // var bargainingStarted=0;


   var ppnr = <?php echo $ppnr;?>;
   var partner = <?php echo $partner; ?>;
   var trial = <?php echo $trial;?>;
   var trial_type = <?php echo $trial_type;?>;
   var know_pie= <?php echo $iknowPie; ?>;
   var pie_size = <?php echo $thePie; ?>;
   //var time_bargaining =<?php echo $Time; ?>/1000;
   var time_bargaining;
   var time_barg_normal =<?php echo $time_barg_normal; ?>/1000;
   var time_barg_mechanism =<?php echo $time_barg_mechanism; ?>/1000;
   var time_initial_offer =<?php echo $timeForIniOffer; ?>/1000;
   var timer;
   var timer_interval;
   var warningTime = <?php echo $timeForWarning;?>;
   var start_value = <?php echo $start_value;?>;
   var other_start_value = <?php echo $other_start_value;?>;

   var almost_deal_timer;

   var resultsTime = <?php echo $results_time;?>;//5000;
   var pie_report_val = 0;

   //Modifiable variables (in database)
   var robotina = <?php echo $robot; ?>;

   if(trial_type==1){
     time_bargaining = time_barg_normal;
   }else if(trial_type==2){
     time_bargaining = time_barg_mechanism;
   }


   connection.onopen = () => {
     send_message("start",1);
     //66
     //connection.send(`Hey, I am ppnr:${ppnr}. I am in the room.`);
   }

   connection.onerror = (error) => {
     console.log(`WebSocket error: ${error}`);
   }

   connection.onmessage = (ms) => {
     console.log('received: %s', ms.data);
     // Broadcast to everyone else.
     client_process_messsage(ms.data);
   }

   function client_process_messsage(ms){
     var message_dict = extract_message(ms);
     try{
       mtype=message_dict["type"];
       mvalue=message_dict["value"];
     }
     catch(err){
       console.log("Error when parsing messsage from server: " + ms);
     }

     if (mtype == "notification"){
        try{mvalue2=message_dict["value2"];} catch(err){console.log("Error when parsing value 2 form notifcation from server: " + ms);}
        try{mvalue3=message_dict["value3"];} catch(err){console.log("Error when parsing value 3 form notifcation from server: " + ms);}
        process_notification(mvalue,mvalue2,mvalue3);
     } else if (mtype=="slider"){
        update_other_slider(mvalue);
     } else if(mtype=="pie_report"){
        update_pie_report_uninf(mvalue);
     } else {
        console.log("Type of Messsage from Server not recognised: " + ms);
     }
   }

   function process_notification(notification,not2,not3="None"){
     if(notification == "start"){
        get_started();
     } else if(notification=="almost_deal"){
        drawAlertCircle(1);
        almost_deal_timer = setTimeout(function(){drawAlertCircle(2);}, warningTime);
     } else if(notification=="broken_deal"){
        window.clearTimeout(almost_deal_timer);
        drawAlertCircle(0);
     } else if(notification=="initial_offer_end"){
        startBargaining();
     } else if(notification=="payoff"){
        try{window.clearTimeout(almost_deal_timer);} catch(err){}
        show_payoff(not2,not3);
     } else if(notification=="you are connected"){
        //Correct but do nothing.
     } else if(notification=="pie_report"){
        //Correct but do nothing.
     } else {
       console.log("Notification from Server not recognised: " + notification);
     }

   }

    function enter_room(){
      console.log("I am here");
      document.getElementById("entirePage").style.display = "none";
      document.getElementById("waitingPageTexto").innerHTML = "Please wait until all players are ready.";
      document.getElementById("waitingPage").style.display = "block";
    }

    function get_started(){
      update_my_slider(start_value);
      update_other_slider(other_start_value);

      startInitialOffer();

      if(robotina==1){
        robotina1();
      }
    }

    function startInitialOffer(){
      $(window).trigger('resize');//This is the only way I found to solve an annoying bug in which sliders show up small
      //66:Video: Start Recording.
      console.log("do I know pie: " + know_pie);
      if(know_pie){
        document.getElementById("pieInstructions").innerHTML = "Pie size is $" + pie_size ;

        document.getElementById("report2").style.visibility = "visible";
        document.getElementById("report6").style.visibility = "visible";

        document.getElementById("pie_report_text").style.visibility = "visible";
        document.getElementById("pie_report").style.visibility = "visible";

      } else{
        document.getElementById("pieInstructions").innerHTML = "";
      }

      document.getElementById("slider2Section").style.visibility = "hidden";
      document.getElementById("waitingPage").style.display = "none";

      document.getElementById("iniOffer").innerHTML = " &nbsp &nbsp Place your initial offer";

      document.getElementById("entirePage").style.display = "block";
      document.getElementById("entirePage").style.visibility = "visible";


      start_timer(time_initial_offer);
    }

    function startBargaining(){
      document.getElementById("iniOffer").style.visibility = "hidden";
      if(know_pie){
        document.getElementById("report2").style.visibility = "hidden";
        document.getElementById("report6").style.visibility = "hidden";
        document.getElementById("pie_report_text").style.visibility = "hidden";
        document.getElementById("pie_report").style.visibility = "hidden";
      } else{

      }

      if(pie_report_val == 0){
        document.getElementById("pie_reported_both").innerHTML = "No pie reported by the informed player." ;
      } else{
        document.getElementById("pie_reported_both").innerHTML = "The informed player reported a pie of $" + pie_report_val ;
      }
      document.getElementById("pie_reported_both").style.visibility = "visible";


      document.getElementById("slider2Section").style.visibility = "visible";
      start_timer(time_bargaining);
    }

    function show_payoff(payoff, agreement){
      disable_sliders(1);

      if(agreement==0 && trial_type==2){
        var text=`<br>The pie size was: $ ${pie_size} <br> <br> Your earnings will be determined based on the results of the mechanism.`;
      } else {
        var text=`<br>The pie size was: $ ${pie_size} <br> <br> Your earnings are: $ ${payoff}`;
      }


      console.log(text);

      document.getElementById("entirePage").style.display = "none";
      document.getElementById("waitingPageTexto").innerHTML = text;
      document.getElementById("waitingPage").style.display = "block";

      setTimeout(function(){ finalise_trial("Please Wait for the next trial to start."); }, resultsTime);
    }

    // 66: Check waitingPage.php
    function finalise_trial(mensaje){
      //stopRec();66:Video
      document.getElementById("entirePage").style.display = "none";
      document.getElementById("waitingPageTexto").innerHTML = mensaje;
      document.getElementById("waitingPage").style.display = "block";
      connection.close();
      window.location.replace("waitingPage.php");
    }

//Utility functions:

    function extract_message(ms){
      var message_dict = JSON.parse(ms);
      return message_dict;
    }

    function send_message(mtype,mvalue){
      var dict = {"p1":ppnr, "p2":partner, "trial":trial, "type":mtype, "value":mvalue};
      var json_message = JSON.stringify(dict);
      console.log(`message sent: ${json_message}`);
      connection.send(json_message);
    }


    function update_my_slider(value){
      //Update slider
      var slider = $('#slider1');
      slider.val(value);
      //Update text value
      //Send value to server
      send_my_updated_slider(value);
    }

    function send_my_updated_slider(value){
      document.getElementById("infoPHP1").innerHTML = value;
      send_message("slider",value);
    }

    function update_other_slider(value){
      var slider = $('#slider2');
      slider.val(value);
      document.getElementById("infoPHP2").innerHTML = value;
    }

    function update_pie_report_uninf(value){
      pie_report_val =value;
    }

    //if yes==1: disables Slider1 and other relevant things
    // if yes==0: enables Slider1 and the other relvant things (timers...)
    function disable_sliders(yes){
      if (yes==1){
        $("#slider1").attr("disabled", "true");
      } else if (yes==0) {
        $("#slider1").prop("disabled",0);
      }
    }

    function start_timer(total_time){
      window.clearInterval(timer_interval);
      timer = total_time;
      document.getElementById("timerDiv").innerHTML = timer;
      timer_interval = setInterval(function(){ update_timer(); }, 1000);
      //Math.round(time_left);
    }

    function update_timer(){
      timer = timer - 1;
      document.getElementById("timerDiv").innerHTML = timer;
    }

    //Robotina
    function robotina1(){
      robotinaTimer = setInterval(function(){ robotina2(); }, 4000);
    }

    function robotina2(){
      //var slider = $('#slider1');
      var valRobotSlider1 = Math.round(Math.random()*6);
      update_my_slider(valRobotSlider1);
      //slider.val(valRobotSlider1);
    }

    function report_pie(pie){
      send_message("pie_report",pie);
      update_pie_report_inf(pie);
    }

    function update_pie_report_inf(pie){
      document.getElementById("pie_report_text").innerHTML = "Pie Size to Report:"
      document.getElementById("pie_report").innerHTML = pie;
    }

















//Screen Details
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

// General stuff to make the browser rules-game-friendly

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

        if(F5==82){
          if(!netscape){event.keyCode=0}
          return false;
        }

          // Alt+0 takes you to the next trial, in case there is an error in the trial for that participant
          if (event.altKey && F5==48){
            error_happened("forced exit");
          }

      }

      function error_happened(err){
        send_message("error",err);
        window.location.replace("waitingPage.php");
        connection.close();
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

        <canvas id=canvitas width="300" height="100"></canvas>

      </div>
    </div>

    <h1 id="iniOffer">  </h1>

    <!-- Slider 1 -->
    <h2 class="participantTitles"> You </h2>
    <div class="leftOfSlider" > <?php echo $minValue; ?> </div>
    <div class="divSlider" > <?php echo $maxValue; ?> </div>
    <div class="rightOfSlider" align="center" >

      <input onChange="send_my_updated_slider(this.value)" type="range" id="slider1" class="slider" value=<?php echo $start_value;?> min=<?php echo $minValue; ?> max=<?php echo $maxValue; ?> step=<?php echo $Steps;?> list=tickmarks>
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
        <input type="range" id="slider2" class="slider" value=<?php echo $other_start_value;?> min=<?php echo $minValue; ?> max=<?php echo $maxValue; ?> step=<?php echo $Steps;?> list=tickmarks disabled>
      </div>


      <p id="infoPHP2" align="center"> Waiting for Connection... </p>

    </div>

    <!-- pie_size report -->
    <div align="center">
      <button align="center" id="report2" value=2 onclick="report_pie(this.value)" style="visibility:hidden;height:200px;width:200px;" class="buttonoranje"> 2 </button>
      <button align="center" id="report6" value=6 onclick="report_pie(this.value)" style="visibility:hidden;height:200px;width:200px;" class="buttonoranje"> 6 </button>
      <p id="pie_reported_both" style="visibility:hidden;font-size:100px;"> </p>
      <p id="pie_report_text" style="visibility:hidden;font-size:60px;"> Please report a pie size </p>
      <p id="pie_report" style="visibility:hidden;font-size:60px;"> -- </p>
    </div>


  </div>

  <div id="waitingPage" style="display:none" class="textWaiting">
      <h5 id="waitingPageTexto"> </h5>
    </div>

  <script>
    //console.log("I am here");
    window.onload = enter_room();
    // 66: Video
    // //Video v3
    // var recordingPlayer = document.getElementById('videito');
    // console.log("este es el recordingPlayer");
    // console.log(recordingPlayer);
    //
    // //Dimensions of the video
    // function scaleVideos() {
    //     var videos = document.querySelectorAll('video'),
    //         length = videos.length,
    //         video;
    //     var minus = 130;
    //     var windowHeight = 700;
    //     var windowWidth = 600;
    //     var windowAspectRatio = windowWidth / windowHeight;
    //     var videoAspectRatio = 4 / 3;
    //     var blockAspectRatio;
    //     var tempVideoWidth = 0;
    //     var maxVideoWidth = 0;
    //
    //     //Relocates and scales video panes according to number of videos
    //     for (var i = length; i > 0; i--) {
    //         blockAspectRatio = i * videoAspectRatio / Math.ceil(length / i);
    //         if (blockAspectRatio <= windowAspectRatio) {
    //             tempVideoWidth = videoAspectRatio * windowHeight / Math.ceil(length / i);
    //         } else {
    //             tempVideoWidth = windowWidth / i;
    //         }
    //         if (tempVideoWidth > maxVideoWidth)
    //             maxVideoWidth = tempVideoWidth;
    //     }
    //     for (var i = 0; i < length; i++) {
    //         video = videos[i];
    //         if (video)
    //             video.width = maxVideoWidth - minus;
    //     }
    // }

    // <!--
    //   <div id="videoSection" style="visibility:<?php echo $videoVisibility; ?>"  >
    //     <!-- Video Conference -->
    //     <!--
    //     <h2 class="insideVideo"> Video Conference </h2>
    //     -->
    //
    //     <!-- local/remote videos container -->
    //     <!-- Fit video in container -->
    //     <div class="insideVideo" id="videos-container">
    //       <video id="videito" controls muted></video>
    //     </div>
    //   </div>
    // -->
  </script>





</body>

</html>

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
$part=$showChat*(-1)+2;
$menu=instructionMenu($_SERVER['PHP_SELF'], $ppnr,$part);

$insNextPage=  instructionsNextPage($_SERVER['PHP_SELF'], $ppnr, $part);

$insPrevPage=  instructionsPrevPage($_SERVER['PHP_SELF'], $ppnr, $part);

//Initial values: one even and one odd so there is no "deal" from the start.
$valueDeal1=mt_rand($minValue/$Steps+1,($maxValue/2)/$Steps)*$Steps*2;
$valueDeal2=mt_rand($minValue/$Steps+1,($maxValue/2)/$Steps)*$Steps*2-1*$Steps;

$videoVisibility= ($showVideo == 1 ? "visible" : "hidden");

$chatVisibility= ($showChat == 1 ? "visible" : "hidden");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
  <TITLE> Instructions 4 </TITLE>
  <link rel="stylesheet" type="text/css" href="beleggensns.css" />
  <link rel="stylesheet" type="text/css" href="buttons.css" />
  <link rel="stylesheet" href="generalConfigInstruct.css">
  <link rel="stylesheet" href="sliderConfig.css">
  <script src="jquery-1.11.3.min.js"></script>
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

      function updateNumber(valor){
          document.getElementById("infoPHP1").innerHTML = valor;
      }

   </script>


  <script>

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



    var initiated=0;
    var bargainingTime = 0;
    var warningTime = <?php echo $timeForWarning;?>;
    //var dealTime = <?php echo $timeForDeal;?>;
    //66
    var slider1 = <?php echo $valueDeal1; ?>;
    var slider2 = <?php echo $valueDeal2; ?>;
    var timerDealAlert;
    var timeB =<?php echo $Time; ?>;
    var timeIni =<?php echo $timeForIniOffer; ?>;
    var timer;
    var timerInterval;
    var chatHistory = "Other: Hello "

    function uninformedPlayer(){
      //document.getElementById("canvitas").style.display = "none";
      //document.getElementById("UP").class = "buttonoranje";
      document.getElementById("entirePage").style.visibility = "visible";
      document.getElementById("pieInstructions").innerHTML = "";
      var uninformedpl = $('#UP');
      uninformedpl.removeClass("buttonblauw");
      uninformedpl.addClass("buttonoranje");

      var informedpl = $('#IP');
      informedpl.removeClass("buttonoranje");
      informedpl.addClass("buttonblauw");

      document.getElementById("IOP2").style.visibility = "hidden";
      document.getElementById("BP2").style.visibility = "hidden";

      document.getElementById("IOP1").style.visibility = "visible";
      document.getElementById("BP1").style.visibility = "visible";

      if (initiated==0){
        initial();
        initiated=1;
      }
    }

    function informedPlayer(){
      document.getElementById("entirePage").style.visibility = "visible";
      document.getElementById("pieInstructions").innerHTML = "Pie size is $6";
      var informedpl = $('#IP');
      informedpl.removeClass("buttonblauw");
      informedpl.addClass("buttonoranje");

      var uninformedpl = $('#UP');
      uninformedpl.removeClass("buttonoranje");
      uninformedpl.addClass("buttonblauw");

      document.getElementById("IOP1").style.visibility = "hidden";
      document.getElementById("BP1").style.visibility = "hidden";

      document.getElementById("IOP2").style.visibility = "visible";
      document.getElementById("BP2").style.visibility = "visible";

      if (initiated==0){
        initial();
        initiated=1;
      }
    }

    /*
    $('.UP').click(function() {
    $(this).toggleClass('buttonblauw');
    $(this).toggleClass('buttonoranje');
    });
    */

    var showChat= <?php echo $showChat; ?>;
    var showVideo= <?php echo $showVideo; ?>;
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


    function initial(){
      //66
      bargainingTime=0;
      drawAlertCircle(0);
      clearTimeout(timerDealAlert);


      document.getElementById("slider2Section").style.visibility = "hidden";
      document.getElementById("chatSection").style.visibility = "hidden";
      document.getElementById("videoSection").style.visibility = "hidden";
      document.getElementById("iniOffer").style.visibility = "visible";
      document.getElementById("iniOffer").innerHTML = " &nbsp &nbsp Place your initial offer";
      //document.getElementById("timerDiv").innerHTML = <?php echo $timeForIniOffer; ?>;
      startTimer(timeIni);

      var IOPeriod = $('#IOP1');
      IOPeriod.removeClass("buttonblauw");
      IOPeriod.addClass("buttonoranje");

      var BPeriod = $('#BP1');
      BPeriod.removeClass("buttonoranje");
      BPeriod.addClass("buttonblauw");

      var IOPeriod = $('#IOP2');
      IOPeriod.removeClass("buttonblauw");
      IOPeriod.addClass("buttonoranje");

      var BPeriod = $('#BP2');
      BPeriod.removeClass("buttonoranje");
      BPeriod.addClass("buttonblauw");
    }

    function bargaining(){
      bargainingTime=1;
      if(slider1==slider2){
        drawAlertCircle(1);
        timerDealAlert = setTimeout(function(){drawAlertCircle(2);}, warningTime);
      } else{
        drawAlertCircle(0);
        clearTimeout(timerDealAlert);
      }


      document.getElementById("iniOffer").style.visibility = "hidden";
      document.getElementById("slider2Section").style.visibility = "visible";
      document.getElementById("chatSection").style.visibility = showChatSection;
      document.getElementById("videoSection").style.visibility = showVideoSection;

      //document.getElementById("timerDiv").innerHTML = <?php echo $Time; ?>;
      startTimer(timeB);

      var BPeriod = $('#BP1');
      BPeriod.removeClass("buttonblauw");
      BPeriod.addClass("buttonoranje");

      var IOPeriod = $('#IOP1');
      IOPeriod.removeClass("buttonoranje");
      IOPeriod.addClass("buttonblauw");

      var BPeriod = $('#BP2');
      BPeriod.removeClass("buttonblauw");
      BPeriod.addClass("buttonoranje");

      var IOPeriod = $('#IOP2');
      IOPeriod.removeClass("buttonoranje");
      IOPeriod.addClass("buttonblauw");


    }

    function changeSliderValue(valor){
        document.getElementById("infoPHP1").innerHTML = valor;
        slider1=valor;
        //66
        console.log(bargainingTime);
        if(bargainingTime==1){
          if(slider1==slider2){
            drawAlertCircle(1);
            timerDealAlert = setTimeout(function(){drawAlertCircle(2);}, warningTime);
          } else{
            drawAlertCircle(0);
            clearTimeout(timerDealAlert);
          }
        }
    }

    function startTimer(initialTime){
      timer=initialTime/1000;
      clearInterval(timerInterval);
      document.getElementById("timerDiv").innerHTML = timer;
      timerInterval = setInterval(function(){hp2();},1000);
    }

    function hp(timecito,time){
      setTimeout(function(){document.getElementById("timerDiv").innerHTML = timecito;},time);
    }

    function hp2(){
      if (timer<=0){
        document.getElementById("timerDiv").innerHTML = 0;
        clearInterval(timerInterval);
      } else{
        timer=timer-1;
        document.getElementById("timerDiv").innerHTML = timer;
      }
    }

    function updateChat(){
      var newChat = chat.msg.value;
      chatHistory = chatHistory + "</br> You: " + newChat;
      document.getElementById("chatLogs").innerHTML = chatHistory;
      chat.msg.value="";
    }



    function enterChat(){
      var F5=event.keyCode;
      if(F5==13){
        updateChat();
        }
    }

    if(showChat==1){
        document.onkeyup=enterChat;
    }



   </script>
</HEAD>

<BODY>
  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td>
    <p align=center><?php echo $menu; ?></p>
    <H1 align=center> Example </H1>
    </td>
  </tr>

</tr></td>

  </table>

  <table width="60%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td> <p align=center><a id="UP" onclick="uninformedPlayer()" class="buttonblauw" > Show UNINFORMED participant screen </a> </td>
      <td>  <p align=center><a id="IP" onclick="informedPlayer()"  class="buttonblauw" > Show INFORMED participant screen</a> </td>
    </tr>
    <tr><td><br></td></tr>
    <tr>
      <td> <p align=center><a id="IOP1" onclick="initial()" class="buttonoranje" style="visibility:hidden"> INITIAL OFFER Period </a> </td>
      <td>  <p align=center><a id="IOP2" onclick="initial()"  class="buttonoranje" style="visibility:hidden"> INITIAL OFFER Period</a> </td>
    </tr>
        <tr><td><br></td></tr>
    <tr>
      <td> <p align=center><a id="BP1" onclick="bargaining()" class="buttonblauw" style="visibility:hidden"> BARGAINING Period </a> </td>
      <td>  <p align=center><a id="BP2" onclick="bargaining()"  class="buttonblauw" style="visibility:hidden"> BARGAINING Period</a> </td>
    </tr>



  </table>

  </br>

  <table width="70%" border="5px" cellpadding="18px" cellspacing="0" align="center">

  <tr><td>

    <div id="entirePage" style="visibility:hidden">

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

      <!--3.0.1 -->
      <h1 id="iniOffer">  </h1>

      <!-- Slider 1 -->
      <h2 class="participantTitles"> You </h2>
      <div class="leftOfSlider" > <?php echo $minValue; ?> </div>
      <div class="divSlider" > <?php echo $maxValue; ?> </div>
      <div class="rightOfSlider" align="center" >

        <input type="range" onChange="changeSliderValue(this.value)" id="slider1" class="slider" value=<?php echo $valueDeal1; ?> min=<?php echo $minValue; ?> max=<?php echo $maxValue; ?> step=<?php echo $Steps;?> list=tickmarks>
        <datalist id=tickmarks>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </datalist>
      </div>

      <p id="infoPHP1" align="center"> <?php echo $valueDeal1; ?></p>

      <!-- Slider 2 -->
      <div id="slider2Section" >
        <h2 class="participantTitles"> Other </h2>
        <div class="leftOfSlider" > <?php echo $minValue; ?> </div>
        <div class="divSlider" > <?php echo $maxValue; ?> </div>
        <div class="rightOfSlider" align="center" >
          <input type="range" id="slider2" class="slider" value=<?php echo $valueDeal2; ?> min=<?php echo $minValue; ?> max=<?php echo $maxValue; ?> step=<?php echo $Steps;?> list=tickmarks disabled>
        </div>


        <p id="infoPHP2" align="center"> <?php echo $valueDeal2; ?> </p>

      </div>

      <!-- CHATBOX style="visibility:<?php echo $chatVisibility; ?>" -->
      <div id="chatSection" >
        <h2 class="insideChat"> ChatBox </h2>

        <div class="insideChat" id="chatLogs">
          Other: Hello
        </div>

        <form id="insideMsg" class="insideChat" name="chat" >
        <br/>
        <textarea name="msg" id="insideMsg2">  </textarea> <br/>
        <a onclick="updateChat()"> <u> Send </u>  </a>
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


    </td></tr>

  </table>


  <table width="80%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td>
      <br>
      <p style="float:right"><a href=<?php echo $insNextPage; ?> class="buttonblauw">Continue</a>
      <br>
      <p align=left><a href=<?php echo $insPrevPage; ?> class="buttonblauw">Back</a>
    </tr></td>

  </table>

</BODY>
</HTML>

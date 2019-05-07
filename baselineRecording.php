<?php
include("commonSlider.inc");
Header("Cache-Control: must-revalidate");
if (!$_COOKIE['theCookie']){
	header("Location: begin.html");
	exit();
	}
else {
	$koek=readcookie("theCookie");
	$ppnr=$koek[0];
}
updateTableOne("subjects","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);

?>
<html>
<head>
	<!-- <META HTTP-EQUIV="Pragma" CONTENT="no-cache"> -->

	<link rel="stylesheet" type="text/css" href="beleggensns.css" />
	<link rel="stylesheet" type="text/css" href="buttons.css" />
  <script src="jquery-1.11.3.min.js"></script>


  <script>
		var emotion=1;
    var recordingTime=8000;
		//var timeBeforeStarting=15000;
    var ppnr= <?php echo $ppnr; ?>;
		var timeStartVideo;


		function start(){

			document.getElementById("instrucciones").style.display = "none";
			time_start_vid();
			//navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
		}

    //Exact time of startVideo. Is called from within RecordRTC: recordRTC had to be modified hence the name RecordRTC1
    function time_start_vid(){
      timeStartVideo=currentTime();
      console.log("newTime");
      console.log(timeStartVideo);
			emotionText="Neutral";
			document.getElementById("breakTimer").innerHTML = emotionText;
      intervalTimer=setInterval(function(){ nextEmotion();},recordingTime);

			//setTimeout(function(){stopRec();}, recordingTime);
      //setTimeout(function(){nextPage();}, recordingTime);
    }

		//window.onload = time_start_vid();

		/*
    function nextPage(){
      window.clearInterval(intervalTimer);
      document.getElementById("breakTimer").innerHTML=0;

    }
		*/

		function nextEmotion(){
			emotion=emotion+1;
			// if (emotion==2) {
			// 	emotionText="Anger";
			// }
			// else if (emotion==3){
			// 	emotionText="Fear";
			// }
			// else if (emotion==4){
			// 	emotionText="Joy";
			// }
			// else if (emotion==5){
			// 	emotionText="Disgust";
			// }
			// else if (emotion==6){
			// 	emotionText="Sadness";
			// }
			// else if (emotion==7){
			// 	emotionText="Surprise";
			// }
			if (emotion==2){
				emotionText="";
				document.getElementById("breakTimer").innerHTML = emotionText;
				//stopRec();
				window.clearInterval(intervalTimer);
				loadDoc(finish,'send_baseline_rec_time.php',timeStartVideo);
			}

			document.getElementById("breakTimer").innerHTML = emotionText;
		}

		function finish(){
			window.location.replace('waittostart.php');
		}
    // function successCallback(stream) {
		//
		//
    //     console.log("successcallback")
    //     // RecordRTC usage goes here
    //     var options = {
    //       type: 'video',
    //       //video: { width: 1280, height: 720 },
    //       canvas: { width: 800, height: 600 },
    //       recorderType: WhammyRecorder // optional
    //       };
    //     recordRTC = RecordRTC(stream, options);
    //     recordRTC.startRecording(timeStartVideoF);
    //     console.log("este es el recordRTC");
    //     console.log(recordRTC);
    //     //recordingPlayer.srcObject = stream;
    //     //recordingPlayer.play();
		//
    //     //timeStartVideoOld=currentTime();
    //     //console.log("beforetime");
    //     //console.log(timeStartVideoOld);
		//
		//
    // }
		//
    // function stopRec(){
    //   endVideo=currentTime();
    //   console.log(endVideo-timeStartVideo);
    //   console.log("end1");
    //   recordRTC.stopRecording(function(videoURL) {
    //     recordingPlayer.src = videoURL;
    //     var recordedBlob = recordRTC.getBlob();
    //     //recordRTC.getDataURL(function(dataURL) { });
    //     var fileType = 'video';
    //     var fileName = ppnr + 'Baseline' + '.webm';
    //     // create FormData
    //     var formData = new FormData();
    //     formData.append(fileType + '-filename', fileName);
    //     formData.append(fileType + '-blob', recordedBlob);
    //     //formData.append(fileType + '-blob', blob.video);
		//
    //     makeXMLHttpRequest('save.php', formData, function(progress) {
    //         if (progress !== 'upload-ended') {
    //             console.log(progress);
    //             return;
    //         }
    //         var initialURL = location.href.replace(location.href.split('/').pop(), '') + 'uploads/';
    //         // to make sure we can delete as soon as visitor leaves
    //         listOfFilesUploaded.push(initialURL + fileName);
    //     });
		//
    //   });
		//
    // }
		//
    // function errorCallback(error) {
    //     console.log(error);
    // }
		//
    // var mediaConstraints = { video: true, audio: false };
		//
    // function makeXMLHttpRequest(url, data, callback) {
    //     var request = new XMLHttpRequest();
    //     request.onreadystatechange = function() {
    //         if (request.readyState == 4 && request.status == 200) {
    //             console.log('upload-ended');
    //         }
    //     };
    //     request.upload.onloadstart = function() {
    //         console.log('Upload started...');
    //     };
    //     request.upload.onprogress = function(event) {
    //         console.log('Upload Progress ' + Math.round(event.loaded / event.total * 100) + "%");
    //     };
    //     request.upload.onload = function() {
    //         console.log('progress-about-to-end');
    //     };
    //     request.upload.onload = function() {
    //         console.log('progress-ended');
    //         window.location.replace('waittostart.php');
    //     };
    //     request.upload.onerror = function(error) {
    //         console.log('Failed to upload to server');
    //         console.error('XMLHttpRequest failed', error);
    //     };
    //     request.upload.onabort = function(error) {
    //         console.log('Upload aborted.');
    //         console.error('XMLHttpRequest aborted', error);
    //     };
    //     request.open('POST', url);
    //     request.send(data);
    // }

		//window.location.replace('waittostart.php');


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


	  function currentTime(){
	    var tiempo = new Date().getTime();
	    return tiempo;
	  }


		//setTimeout(start,timeBeforeStarting);

  </script>
</head>

<body>
<table width="760" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td>
<br>
<br>
<div id=instrucciones>
<H1 align="center">Before we start the experiment we will record your face. </H1>

<h3 align=center>We ask you to please express a neutral face while the word "neutral" appears on the screen.</h3>
<!--
<h3 align=center>Do not start this part until you have been called to the front and your picture has been taken.</h3> -->

<p align=center><a id="UP" onclick="start()" class="buttonblauw" > Start Recording </a>

</div>

<br>
<br>

<h1 align=center class="textWaiting3"  id="breakTimer"> </h1>

<div class="insideVideo" id="videos-container" style="display:none" >
  <video id="videito" controls muted></video>
</div>




<!-- <script>
  var recordingPlayer = document.getElementById('videito');
</script> -->



</body>
</html>

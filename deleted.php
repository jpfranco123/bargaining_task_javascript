

<script src="firebase.js"></script>
<script src="RTCMultiConnection.js"></script>

<script>


function stopRec(){
  //Record video when finalized
  var stream = connection.streams[localStreamid];
  console.log(localStreamid);
  console.log(stream);
  console.log(remoteStreamid);
  console.log("no se q pasa 1");
  stream.stopRecording(function (blob) {
        //connection.saveToDisk(blob.video,ppnr+".webm");
        console.log(blob);
        console.log(blob.video);
        //funcion 1 para guardar en saver.
        var fileType = 'video';
        var fileName = ppnr + 'T' + trial + '.webm';
        // create FormData
        var formData = new FormData();
        console.log(formData);
        formData.append(fileType + '-filename', fileName);
        console.log(formData);
        formData.append(fileType + '-blob', blob.video);
        console.log(formData);
        console.log('Uploading ' + fileType + ' recording to server.');

        makeXMLHttpRequest('save.php', formData, function(progress) {
            if (progress !== 'upload-ended') {
                console.log(progress);
                return;
            }
            var initialURL = location.href.replace(location.href.split('/').pop(), '') + 'uploads/';
            console.log('ended', initialURL + fileName);
            // to make sure we can delete as soon as visitor leaves
            listOfFilesUploaded.push(initialURL + fileName);
        });
        // Para eliminar todo eliminarmakeXMLHttp..... y eliminar save.php



    }, {audio:false, video:true} );
}

var connection = new RTCMultiConnection();

connection.session = {

    audio: false,
    video: true
};

connection.mediaConstraints = {
  mandatory: {
    minWidth: 320,
    maxWidth: 320,
    minHeight: 240,
    maxHeight: 240,
    //minFrameRate: 10
  }
};


function appendVideo(video, streamid, tipo) {
    video.width = 600;
    video = getVideo(video, streamid, tipo);
    //video.removeAttribute('controls');
    videosContainer.insertBefore(video, videosContainer.firstChild);
    rotateVideo(video);
    scaleVideos();

    //Record Video after both cameras are showing video
    //TODO cambiar localStreamid por remoteStreamid para que cada quien grabe lo del otro.
    var stream = connection.streams[localStreamid];

    /*
    connection.mediaConstraints.mandatory = {
    minWidth: 640,
    maxWidth: 640,
    minHeight: 480,
    maxHeight: 480,
    minFrameRate: 10
    };
    */



    stream.startRecording({
        audio: false,
        video: true
    });

    //Another Option: Stop recording after 30 sec.
    /*
    setTimeout(function(){
      stream.stopRecording(function (blob) {
          connection.saveToDisk(blob.video,ppnr+".webm");
      }, {audio:false, video:true} );
    },10000);
    */
}

//Records video (modified to exclude audio and save automiatically)
function getVideo(video, streamid, tipo) {
    var div = document.createElement('div');
    div.className = 'video-container';
    div.appendChild(video);
    return div;
}

function rotateVideo(mediaElement) {
    mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
    setTimeout(function() {
        mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
    }, 1000);
}

connection.onstreamended = function(e) {
    var div = e.mediaElement.parentNode;
    div.style.opacity = 0;
    rotateVideo(div);
    setTimeout(function() {
        if (div.parentNode) {
            div.parentNode.removeChild(div);
        }
        scaleVideos();
    }, 1000);
};



function searchForSession(){
  if(foundConnection==0){
    connection.join(sessionPartner);
    console.log(foundConnection);
  } else {
    clearInterval(connInt);
  }
}


// setup signaling to search existing sessions
connection.connect();


//Creates or joins a room depending on the ppnr
var foundConnection=0;
var group= Math.min(partner,ppnr)
if ( ppnr == Math.min(partner,ppnr) ){
  connection.sessionid = group.toString();
  connection.open();
}
else {
  sessionPartner = group.toString();
  var connInt = setInterval(function(){ searchForSession(); }, refreshTime);
}

  var videosContainer = document.getElementById('videos-container');




      //66
      connection.onstream = function(e) {

      //TODO easy solution for detecting if joining the room was succesfull
      foundConnection=1;
        if(e.type=="remote"){
          remoteStreamid=e.streamid;

          //if showVideoOther=1 shows video of the other player
          if(1 == <?php echo $showVideoOther;?>){
            appendVideo(e.mediaElement, e.streamid, e.type);
          }
          if(0 == <?php echo $showVideoOther;?>){
            appendVideo(streamLocal.mediaElement, streamLocal.streamid, e.type);
          }
          timeStartVideo = new Date().getTime();
          //Calculates the maximum time for the negotiation
          maxEndTime = timeStartVideo + timeBargaining *1000 + timeInitialOffer*1000 + iniTime;
          videoON=1;
          console.log("remoto");
          console.log(remoteStreamid);

        }
        else{
          localStreamid=e.streamid;
          streamLocal = connection.streams[localStreamid];


          console.log("local");
          console.log(localStreamid);
          //if showVideoOther=0 shows video of himself

        }
      };

</script>

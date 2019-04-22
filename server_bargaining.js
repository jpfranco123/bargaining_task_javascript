const WebSocket = require('/usr/local/node_modules/ws');
//const WebSocket = require('ws');

const wss = new WebSocket.Server({ port: 8080 });

//66. Extract these from the dataBase
var bargaining_time = 5;
var initial_offer_time = 20;
var deal_confirmation_time = 3;



var ppnr_dict ={};
ppnr_dict["client_id"]={};
ppnr_dict["other_ppnr"]={};
ppnr_dict["slider_pos"]={};
ppnr_dict["almostDeal"]={};


ppnr_dict["trial"]={};
ppnr_dict["timers_trial"]={};



wss.on('connection', function connection(ws) {
  ws.on('message', function incoming(ms) {
    console.log('received: %s', ms);
    // Broadcast to everyone else.
    process_messsage(ms,ws);


    // wss.clients.forEach(function each(client) {
    //   if (client !== ws && client.readyState === WebSocket.OPEN) {
    //     client.send(ms);
    //   }
    // });
  });
  ws.send('Hey new client, this is the server. We are connected.');
});

console.log('Server Running');

function process_messsage(ms,ws){
  var message_dict = extract_message(ms);
  try{
    mp1=message_dict["p1"];
    mp2=message_dict["p2"];
    mtrial=message_dict["trial"];
    mtype=message_dict["type"];
    mvalue=message_dict["value"];
  }
  catch(err){
    console.log("Error when parsing messsage from client: " + ms)
  }

  if (mtype == "start"){
    initialise_ppnr(mp1,mp2,ws, mtrial)
  } else if (mtype="slider"){
    update_slider(mp1,mvalue);
  } else{
    console.log("Type of Messsage from Client not recognised: " + ms)
  }
}

function initialise_ppnr(mp1,mp2,ws,mtrial){
  ppnr_dict["client_id"][mp1]=ws;
  ppnr_dict["other_ppnr"][mp1]=mp2;
  ppnr_dict["slider_pos"][mp1]= get_slider_initial_val(mp1,trial);
  ppnr_dict["trial"][mp1]= mtrial;

  if(mp2 in ppnr_dict["client_id"]){
    if(ppnr_dict["other_ppnr"][mp2] == mp1){ // Cofirming that the other participant acknlowledges this ppnr as his opponent
      startTrial(mp1,mp2);
    } else {
      throw "Matching doesn't match: Participant " + mp2 + " doesn't recognise " + mp1 + "as oponent.";
    }
  }

}

//66: initialSliderPosition
function get_slider_initial_val(mp1,trial){

}


// Extracts message sent by the client and transforms it into a vector with the relevant parameters
// Message example (in JSON format): {p1: 1, p2:4, trial:1, type: slider, value:4.2} . types: slider or notification
// Message parameters: p1, p2, trial, type, value
function extract_message(ms){
  var message_dict = JSON.parse(ms);
  return message_dict;
}


function start_trial(mp1,mp2){
  send_to_ppnr_notif(mp1,"start");
  ssend_to_ppnr_notif(mp2,"start");
  setTimeout(function(){initial_offer_finalized(mp1,mp2);}, initial_offer_time);
  //66. save initial time(starttime.php)
}

//66. This timer has to be different for each pair.
var timer0;
function initial_offer_finalized(p1,p2){
  send_to_ppnr_notif(p1,"initial_offer_end");
  send_to_ppnr_notif(p2,"initial_offer_end");
  timer0 = setTimeout(function(){bargaining_time_is_up(p1,p2);}, bargaining_time);
}

// Sends message (dictionary) to ppnr
function send_to_ppnr_notif(p,message){
  var dict = {type : "notification", value : message};
  var json_message = JSON.stringify(dict);
  connection_ppnr = ppnr_clients[p];
  connection_ppnr.send(json_message);
}

// Sends message (dictionary) to ppnr
function send_to_ppnr_slider(p,s_value){
  var dict = {type : "slider", value : s_value};
  var json_message = JSON.stringify(dict);
  connection_ppnr = ppnr_clients[p];
  connection_ppnr.send(json_message);
}

//Save and send value

//66. This timer has to be different for each pair.
var timer;
function update_slider(p1,value){
  // Update server dictionary with current slider Values
  ppnr_dict["slider_pos"][p1]=value;

  // Send opponent new value of the oSlider.
  p2 = ppnr_dict["other_ppnr"][p1];
  send_to_ppnr_slider(p2,value);

  if(ppnr_dict["slider_pos"][p1] == ppnr_dict["slider_pos"][p2]){
    ppnr_dict["almostDeal"][p1] = true;
    ppnr_dict["almostDeal"][p2] = true;
    timer = setTimeout(function(){deal_finalised(p1,p2,"deal");}, deal_confirmation_time);
  } else if(ppnr_dict["slider_pos"][p1] != ppnr_dict["slider_pos"][p2] && ppnr_dict["almostDeal"][p1]){
      ppnr_dict["almostDeal"][p1] = false;
      ppnr_dict["almostDeal"][p2] = false;
      window.clearTimeout(timer);
  }
  //66. save value
}

//66. Merge deal_finalised with bargaining_time_is_up???
function deal_finalised(p1,p2){
  // 66. Save deal
  window.clearTimeout(timer0);
  bargaining_finalised(p1,p2);
}

function bargaining_time_is_up(p1,p2){
  // 66. Save NO deal
  window.clearTimeout(timer);
  bargaining_finalised(p1,p2);
}

function bargaining_finalised(p1,p2){
  //66. Reset dicts...
  //66. Remove clients
}

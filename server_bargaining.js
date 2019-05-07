// <?php
//include("commonSlider.inc");


//$sliderValue=lookUp("subjects","ppnr='$ppnr'","sValue");

//updateTableOne("subjects","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);

//$blocked=lookUp("subjects","ppnr='$ppnr' AND trial='$trial' ","blocked");

// ?>

//<script>

// var mysql = require('/usr/local/node_modules/mysql');
// const WebSocket = require('/usr/local/node_modules/ws');
var mysql = require('mysql');
const WebSocket = require('ws');

//Websocket creation
const wss = new WebSocket.Server({ port: 8080 });

//MySQL connection
 var con = mysql.createConnection({
   host: "localhost",
   user: "root",
   password: "bargaining_mysql",
   database: "sliders"
 });

//var con = mysql.createConnection({
//  host: "localhost",
//  user: "root",
//  password: "root",
//  database: "sliders",
//  port:'8889'
//});



con.connect(function(err) {
  if (err) throw err;
  console.log("Connected to SQL!");

  //Extract these from the dataBase
  // 123. All times should be in milliseconds.
  //lookUp_js(table_name,condition,name)
  //const bargaining_time =  lookUp_js("commonParameters","Name='Time'","Value", var_to_update, data_type, ppnr_dict="none")//.then(function(value){return(value);});
  //const general_vars["initial_offer_time"] = lookUp_js("commonParameters","Name='timeForIniOffer'","Value");
  //var deal_confirmation_time = lookUp_js("commonParameters","Name='timeForDeal'","Value");
  load_game_parameters();

  //parseInt(l
  //bargaining_time.then(function(value){console.log("bargtime = ")});
  //bargaining_time.then(function(value){console.log(value)});
});

function load_game_parameters(){
  lookUp_js("commonParameters","Name='Time'","Value","general_vars", "bargaining_time", "integer");//.then(function(value){return(value);});
  lookUp_js("commonParameters","Name='timeForIniOffer'","Value","general_vars", "initial_offer_time", "integer");
  lookUp_js("commonParameters","Name='timeForDeal'","Value", "general_vars", "deal_confirmation_time", "integer");
}


// Condition for it to be integer...
async function lookUp_js(table_name,condition,name, dictionary, var_to_update, data_type, ppnr_d=0){
  var sql = `SELECT ${name} FROM ${table_name} WHERE (${condition})`;
  //var clean_result;
  //"SELECT ?? FROM ?? WHERE (?)"
  //con.query(sql, [name, table_name, condition], function (err, result) {

  let promise = new Promise( function(resolve,reject){
    con.query(sql, function (err, result,fields) {
    console.log(sql);//123: Remove if working
    console.log(result);//123: Remove if working
    if (err) throw err;
    var name_var = fields[0].name;
    var clean_result = result[0][name_var];
    console.log(typeof clean_result);
    console.log(clean_result);
    resolve(clean_result);
    });
  });

  let results = await promise;

  if (data_type="integer"){
      results_c = parseInt(results);
  } else if(data_type="numeric"){
      results_c = Number(results);
  } else {
      console.log("data type to convert data not found");
  }

  if (dictionary=="general_vars"){
      general_vars[var_to_update]=results_c;
      console.log("was the var saved:");
      console.log(general_vars[var_to_update]);
  } else if (dictionary=="ppnr_dict"){
      ppnr_dict[var_to_update][ppnr_d]=results_c;
      console.log("was the var saved:"+var_to_update+ppnr_d);
      console.log(ppnr_dict[var_to_update][ppnr_d]);

  } else {
      console.log("dictionary to update not found");
  }

  console.log("the lookup result is ");
  console.log(results_c);
  return(results);

}

//insertRecord("trialInfo","ppnr1, ppnr2, trial, timeStartScript, timeStartVideo,endTime,sValue,agreement,pie,payoff,videoSaved,timeStartedBoth","\"$ppnr\", \"$partner\", \"$trial\", \"$timeStartScript\", \"$timeStartVideo\", \"$endTime\", \"$sValue\", \"$agreement\", \"$thePie\", \"$payoff\",'0',\"$bothStartedTime\" ");
function insertRecord_js(table_name,names,values){
  var sql = `INSERT INTO ${table_name} (${names}) VALUES (${values})`;
  //"INSERT INTO ?? (??) VALUES (?)";
  //con.query(sql, [table_name, names, values], function (err, result) {
  con.query(sql, function (err, result) {
    console.log(sql);//123: Remove if working
    console.log(result);//123: Remove if working
    if (err) throw err;
    return(result);
  });
}

function updateTableOne_js(table_name, condition,name,value){
  var sql = `UPDATE ${table_name} SET ${name}=${value} WHERE (${condition})`;
  //"UPDATE ?? SET ??=? WHERE (?)";
  //con.query(sql, [table_name, name, value,condition], function (err, result) {
  con.query(sql, function (err, result) {
    console.log(sql);//123: Remove if working
    console.log(result);//123: Remove if working
    if (err) throw err;
    return(result);
  });
}

//example: updateTableMore("subjects","ppnr=$ppnr","sValue=\"$initialSliderValue\", blocked='0', started='0', timeBothStartedVideo='0', trial=\"$nextTrial\"");
// function updateTableMore($table_name,$condition,$updatestring){
// 	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error()." updateTableConnectionError");
// 	$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
// 	$sql="UPDATE $table_name SET ".$updatestring." WHERE ($condition)";
function updateTableMany_js(table_name, condition,update_string){
  var sql = `UPDATE ${table_name} SET ${update_string} WHERE (${condition})`;
  //"UPDATE ?? SET ?? WHERE (?)";
  //con.query(sql, [table_name, update_string,condition], function (err, result) {
  con.query(sql, function (err, result) {
    console.log(sql);//123: Remove if working
    console.log(result);//123: Remove if working
    if (err) throw err;
    return(result);
  });
}


//66. Change order? ppnr/var
var ppnr_dict ={};
ppnr_dict["client_id"]={};//123: Maybe not needed
ppnr_dict["other_ppnr"]={};
ppnr_dict["slider_pos"]={};
ppnr_dict["almostDeal"]={};
ppnr_dict["trial"]={};
ppnr_dict["initial_val"]={};
ppnr_dict["know_pie"]={};
ppnr_dict["pie_size"]={};
ppnr_dict["bargaining_started"]={};

ppnr_dict["bargaining_timer"]={};
ppnr_dict["deal_timer"]={};

var general_vars={};



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
  var dict = {type : "notification", value : "you are connected", value2: "None"};
  var json_message = JSON.stringify(dict);
  ws.send(json_message);


});

console.log('Server Running');

function process_messsage(ms,ws){
  var message_dict = extract_message(ms);
  try{
    var mp1=message_dict["p1"];
    var mp2=message_dict["p2"];
    var mtrial=message_dict["trial"];
    var mtype=message_dict["type"];
    var mvalue=message_dict["value"];
  }
  catch(err){
    console.log("Error when parsing messsage from client: " + ms);
  }

  if (mtype == "start"){
      initialise_ppnr(mp1,mp2,ws, mtrial);
  } else if (mtype=="slider"){
      update_slider(mp1,mvalue);
  } else if(mtype=="error"){
      error_trial(mp1,mp2);
  } else if(mp1=="monitor"){
      console.log("processing message from monitor"+mtype);
      process_message_from_monitor(mtype,mvalue);
  } else {
      console.log("Type of Messsage from Client not recognised: " + ms);
  }
}

//66. Modify monitor to process messages!
function process_message_from_monitor(mtype,mvalue){
  if (mtype=="connected"){
     console.log("Monitor connected");
  } else if(mtype=="start_experiment"){
      var tiempo = new Date().getTime();
      insertRecord_js("timeMarks","timeStamp, name",` '${tiempo}', 'start_exp' `);
  } else if(mtype=="time_marks"){
      var tiempo_server = new Date().getTime();
      insertRecord_js("timeMarks","timeStamp,timeStampLocal, name",` '${tiempo_server}', '${mvalue}', 'stamp' `);
  } else if(mtype=="update_game_vars"){
      console.log("updating_game_vars");
      load_game_parameters();
  } else {
     console.log("Type of Messsage from Monitor not recognised: " + mtype);
  }
}

async function initialise_ppnr(mp1,mp2,ws,mtrial){

  var condition = `sjnr='${mp1}' AND trial='${mtrial}' `;
  lookUp_js("matching",condition,"informed","ppnr_dict", "know_pie", "integer",mp1);
  lookUp_js("matching",condition,"startvalue","ppnr_dict", "initial_val", "numeric",mp1).then(function(s_value){ppnr_dict["slider_pos"][mp1]=s_value;});
  let promise = lookUp_js("matching",condition,"piesize","ppnr_dict", "pie_size", "integer",mp1);

  ppnr_dict["bargaining_started"][mp1]=0;

  ppnr_dict["client_id"][mp1]=ws;
  ppnr_dict["other_ppnr"][mp1]=mp2;
  //ppnr_dict["slider_pos"][mp1]= get_slider_initial_val(mp1,mtrial);
  ppnr_dict["trial"][mp1]= mtrial;


  if(mp2 in ppnr_dict["bargaining_started"]){
    if(ppnr_dict["other_ppnr"][mp2] == mp1){ // Cofirming that the other participant acknlowledges this ppnr as his opponent
      let results = await promise;
      start_trial(mp1,mp2);
    } else {
      console.log("Matching doesn't match: Participant " + mp2 + " doesn't recognise " + mp1 + " as oponent.");
    }
  }

}

//Get InitialSlider Position for participant "mp1" and trial "trial"
// function get_slider_initial_val(mp1,trial){
//   var condition = "sjnr='"+ mp1 + "' and trial='" + trial + "'";
//
//   lookUp_js("matching",condition,"startvalue","ppnr_dict", "initial_val", "numeric",mp1);
//   //var initial_val = lookUp_js("matching",condition,"startvalue");
//   return(initial_val);
// }


// Extracts message sent by the client and transforms it into a vector with the relevant parameters
// Message example (in JSON format): {p1: 1, p2:4, trial:1, type: slider, value:4.2} . types: slider or notification
// Message parameters: p1, p2, trial, type, value
function extract_message(ms){
  var message_dict = JSON.parse(ms);
  return message_dict;
}


function start_trial(mp1,mp2){
  send_to_ppnr_notif(mp1,"start");
  send_to_ppnr_notif(mp2,"start");
  setTimeout(function(){initial_offer_finalized(mp1,mp2);}, general_vars["initial_offer_time"]);
  var timeStarted = new Date().getTime();
  var trial = ppnr_dict["trial"][mp1];
  //var condition = `sjnr='${mp1}' AND trial='${trial}' `;
  //var condition2 = `ppnr='${mp2}' AND trial='${trial}' `;
  var pie_size = ppnr_dict["pie_size"][mp1];//["6"];//7;
  //var pie_size2 = ppnr_dict["pie_size"][mp2];
  //ppnr_dict["pie_size"][mp1];
  console.log(` this is the piesize`);
  console.log(pie_size);

  //123: Maybe remove double trial info
  insertRecord_js("trialInfo","ppnr1, ppnr2, trial, timeStarted, pie",` '${mp2}', '${mp1}', '${trial}', '${timeStarted}', '${pie_size}' `);
  insertRecord_js("trialInfo","ppnr1, ppnr2, trial, timeStarted, pie",` '${mp1}', '${mp2}', '${trial}', '${timeStarted}', '${pie_size}' `);
  //updateTableOne_js("trialInfo",condition1,"timeStarted",timeStarted);
  //updateTableOne_js("trialInfo",condition2,"timeStarted",timeStarted);
}

function initial_offer_finalized(p1,p2){
  send_to_ppnr_notif(p1,"initial_offer_end");
  send_to_ppnr_notif(p2,"initial_offer_end");
  ppnr_dict["bargaining_started"][p1]=1;
  ppnr_dict["bargaining_started"][p2]=1;
  check_match(p1,p2);
  timer_room = Math.min(p1,p2);
  ppnr_dict["bargaining_timer"][timer_room] = setTimeout(function(){bargaining_time_is_up(p1,p2);}, general_vars["bargaining_time"]);
}

// Sends message (dictionary) to ppnr
function send_to_ppnr_notif(p,message, message2 = "None"){
  var dict = {type : "notification", value : message, value2: message2};
  var json_message = JSON.stringify(dict);
  console.log(json_message);
  connection_ppnr = ppnr_dict["client_id"][p];
  connection_ppnr.send(json_message);
}

// Sends message (dictionary) to ppnr
function send_to_ppnr_slider(p,s_value){
  var dict = {type : "slider", value : s_value};
  var json_message = JSON.stringify(dict);
  connection_ppnr = ppnr_dict["client_id"][p];//123. Might be an error here
  connection_ppnr.send(json_message);
}

//Save and send value

function update_slider(p1,value){
  p2 = ppnr_dict["other_ppnr"][p1];

  // Update server dictionary with current slider Values
  ppnr_dict["slider_pos"][p1]=value;
  // Send opponent new value of the oSlider.
  send_to_ppnr_slider(p2,value);

  check_match(p1,p2);

  //Save Update to database
  var timeUpdate = new Date().getTime();
  var trial = ppnr_dict["trial"][p1];
  var value2 = ppnr_dict["slider_pos"][p2];
  var names = ["ppnr1","ppnr2","time","sValue1","sValue2","trial"];
  var values= [p1,p2,timeUpdate,value,value2,trial];
  insertRecord_js("sliderLog",names,values)
}


function check_match(p1,p2){
  if(ppnr_dict["slider_pos"][p1] == ppnr_dict["slider_pos"][p2] && ppnr_dict["bargaining_started"][p1]==1 && ppnr_dict["bargaining_started"][p2]==1 && !ppnr_dict["almostDeal"][p1]){
    ppnr_dict["almostDeal"][p1] = true;
    ppnr_dict["almostDeal"][p2] = true;
    timer_room = Math.min(p1,p2);
    ppnr_dict["deal_timer"][timer_room] = setTimeout(function(){deal_closed(p1,p2);}, general_vars["deal_confirmation_time"]);
    send_to_ppnr_notif(p1,"almost_deal");
    send_to_ppnr_notif(p2,"almost_deal");
  } else if(ppnr_dict["slider_pos"][p1] != ppnr_dict["slider_pos"][p2] && ppnr_dict["almostDeal"][p1]){
      ppnr_dict["almostDeal"][p1] = false;
      ppnr_dict["almostDeal"][p2] = false;
      timer_room = Math.min(p1,p2);
      clearTimeout(ppnr_dict["deal_timer"][timer_room]);
      send_to_ppnr_notif(p1,"broken_deal");
      send_to_ppnr_notif(p2,"broken_deal");
  }
}

function deal_closed(p1,p2){

  //Clear timer
  timer_room = Math.min(p1,p2);
  try {
    clearTimeout(ppnr_dict["bargaining_timer"][timer_room]);
  } catch(err){}

  //Save dealTime
  var trial = ppnr_dict["trial"][p1];
  var condition1 = `ppnr1='${p1}' AND trial='${trial}' `;
  var condition2 = `ppnr1='${p2}' AND trial='${trial}' `;
  var sValue1 = ppnr_dict["slider_pos"][p1];
  var sValue2 = ppnr_dict["slider_pos"][p2];
  var errorFlag =0;
  if (sValue1 != sValue2){
    errorFlag = 1;
  }

  var payoff1 = get_payoff(p1,true,sValue1,trial);
  var payoff2 = get_payoff(p2,true,sValue2,trial);

  var timeDeal = new Date().getTime();
  var update1 = `endTime=${timeDeal}, sValue=${sValue1}, agreement='1', payoff = ${payoff1}, errorFlag=${errorFlag} `;
  var update2 = `endTime=${timeDeal}, sValue=${sValue2}, agreement='1', payoff = ${payoff2}, errorFlag=${errorFlag} `;
  updateTableMany_js("trialInfo", condition1, update1);
  updateTableMany_js("trialInfo", condition2, update2);

  console.log("Deal");
  console.log("p1:",p1," p2:",p2);
  //Finalise trial
  bargaining_finalised(p1,p2,payoff1,payoff2);
}


function bargaining_time_is_up(p1,p2){
  if( ppnr_dict["almostDeal"][p1] && ppnr_dict["almostDeal"][p2]){
    //Clear almost deal timer
    timer_room = Math.min(p1,p2);
    clearTimeout(ppnr_dict["deal_timer"][timer_room]);
    deal_closed(p1,p2);
  } else{
    no_deal(p1,p2);
  }
}

function no_deal(p1,p2){
  // Save NO deal
  var trial = ppnr_dict["trial"][p1];
  var condition1 = `ppnr1='${p1}' AND trial='${trial}' `;
  var condition2 = `ppnr1='${p2}' AND trial='${trial}' `;
  var sValue1 = ppnr_dict["slider_pos"][p1];
  var sValue2 = ppnr_dict["slider_pos"][p2];
  var errorFlag =0;
  if (sValue1 == sValue2){
    errorFlag = 1;
  }

  var payoff1 = get_payoff(p1,false,sValue1,trial);
  var payoff2 = get_payoff(p2,false,sValue2,trial);
  var timeEndTrial = new Date().getTime();
  var update1 = `endTime=${timeEndTrial}, sValue=${sValue1}, agreement='0', payoff = '0', errorFlag=${errorFlag} `;
  var update2 = `endTime=${timeEndTrial}, sValue=${sValue2}, agreement='0', payoff = '0', errorFlag=${errorFlag} `;
  updateTableMany_js("trialInfo", condition1, update1);
  updateTableMany_js("trialInfo", condition2, update2);

  console.log("No deal");
  //Finalise trial
  bargaining_finalised(p1,p2,payoff1,payoff2);
}

function error_trial(p1,p2){
  // Save NO deal
  var trial = ppnr_dict["trial"][p1];
  var condition1 = `ppnr1='${p1}' AND trial='${trial}' `;
  var condition2 = `ppnr1='${p2}' AND trial='${trial}' `;
  var sValue1 = ppnr_dict["slider_pos"][p1];
  var sValue2 = ppnr_dict["slider_pos"][p2];
  var errorFlag =2;

  var payoff1 = 0;
  var payoff2 = 0;
  var timeEndTrial = new Date().getTime();
  var update1 = `endTime=${timeEndTrial}, sValue=${sValue1}, agreement='0', payoff = '0', errorFlag=${errorFlag} `;
  var update2 = `endTime=${timeEndTrial}, sValue=${sValue2}, agreement='0', payoff = '0', errorFlag=${errorFlag} `;
  updateTableMany_js("trialInfo", condition1, update1);
  updateTableMany_js("trialInfo", condition2, update2);

  //Finalise trial
  console.log("error_trial");
  bargaining_finalised(p1,p2,payoff1,payoff2);
}

function get_payoff(pp,deal,sValue,trial){
  var payoff;

  var knowPie = ppnr_dict["know_pie"][pp];
  var pie =  ppnr_dict["pie_size"][pp];
  //var knowPie = lookUp_js("matching",condition,"informed");
  //var pie = lookUp_js("matching",condition,"piesize");
  if(deal){
    if (knowPie==1) {
      payoff = pie - sValue;
    } else {
      payoff = sValue;
    }
  }else {
    payoff=0;
  }
  payoff = Number(payoff);
  payoff_str = payoff.toFixed(1);
  return(payoff_str);
}

function bargaining_finalised(p1,p2,payoff1,payoff2){
  send_to_ppnr_notif(p1,"payoff",payoff1);
  send_to_ppnr_notif(p2,"payoff",payoff2);

  ws1 = ppnr_dict["client_id"][p1];
  ws2 = ppnr_dict["client_id"][p2];
  ws1.terminate();
  ws2.terminate();

  //Reset dictionaries
  // ppnr_dict["client_id"][p1]={};
  // ppnr_dict["other_ppnr"][p1]={};
  // ppnr_dict["slider_pos"][p1]={};
  // ppnr_dict["almostDeal"][p1]={};
  // ppnr_dict["trial"][p1]={};
  // ppnr_dict["know_pie"][p1]={};
  // ppnr_dict["pie_size"][p1]={};
  // ppnr_dict["initial_val"][p1]={};
  //
  // ppnr_dict["client_id"][p2]={};
  // ppnr_dict["other_ppnr"][p2]={};
  // ppnr_dict["slider_pos"][p2]={};
  // ppnr_dict["almostDeal"][p2]={};
  // ppnr_dict["trial"][p2]={};
  // ppnr_dict["know_pie"][p2]={};
  // ppnr_dict["pie_size"][p2]={};
  // ppnr_dict["initial_val"][p2]={};

  delete ppnr_dict["client_id"][p1];
  delete ppnr_dict["other_ppnr"][p1];
  delete ppnr_dict["slider_pos"][p1];
  delete ppnr_dict["almostDeal"][p1];
  delete ppnr_dict["trial"][p1];
  delete ppnr_dict["know_pie"][p1];
  delete ppnr_dict["pie_size"][p1];
  delete ppnr_dict["initial_val"][p1];
  delete ppnr_dict["bargaining_started"][p1];

  delete ppnr_dict["client_id"][p2];
  delete ppnr_dict["other_ppnr"][p2];
  delete ppnr_dict["slider_pos"][p2];
  delete ppnr_dict["almostDeal"][p2];
  delete ppnr_dict["trial"][p2];
  delete ppnr_dict["know_pie"][p2];
  delete ppnr_dict["pie_size"][p2];
  delete ppnr_dict["initial_val"][p2];
  delete ppnr_dict["bargaining_started"][p2];

  timer_room = Math.min(p1,p2);

  delete ppnr_dict["bargaining_timer"][timer_room];
  delete ppnr_dict["deal_timer"][timer_room];

  console.log(`Participants ${p1} and ${p2} where cleared from server. Their websocket is still working.`);//123 Check this is true


}

//</script>

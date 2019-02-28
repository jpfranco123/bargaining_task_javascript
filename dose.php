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

?>
<!DOCTYPE HTML>
<HTML>
  <HEAD>
    <TITLE> DOSE </TITLE>
    <link rel="stylesheet" type="text/css" href="generalConfig.css" />
  </HEAD>

  <BODY>

    <!-- <h1 align="center">  </h1> id="dose" width="850" height="550" border="1" cellpadding="0" cellspacing="0" align="center" -->
    <div id="doseWraper">

      <table id="dose" border="1" >

        <tr>
          <td id="doseGamble1">$4</td>
          <td></td>
          <td></td>
        </tr>

        <tr>
          <td></td>
          <td>vs.</td>
          <td id="doseSafe">$0</td>
        </tr>

        <tr>
          <td id="doseGamble2">$-2</td>
          <td></td>
          <td></td>
        </tr>

        <tr>
          <td class="doseButton">Accept</td>
          <td></td>
          <td class="doseButton">Reject</td>
        </tr>

      </table>

    </div>

  </BODY>
</HTML>

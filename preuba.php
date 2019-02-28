<?php
  include("commonSlider.inc");
  //$koek=readcookie("theCookie");
	//$ppnr=$koek[0];
  $trial=lookUp("subjects","ppnr=1","trial");

  if($trial==""){
    $answer="empty";
  } else {
    $answer=$trial;
    //$answer=$trial;
  }

  //$casa="claro";



?>
<!doctype html>
<html>
<head>
</head>
<body>
  <p> 5<?php echo $answer ?></p>
</body>
</html>

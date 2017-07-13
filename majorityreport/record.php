<?php
    include "vars.php";
    // print "curl -vsS -m ".$timeCalc." ".$streamURL." > ".$files_dir.$file_name.$dateTime.".mp3";
    exec("curl -vsS -m ".$timeCalc." ".$streamURL." > ".$files_dir.$file_name.$dateTime.".mp3");
?>

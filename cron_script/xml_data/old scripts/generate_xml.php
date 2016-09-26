<?php
ob_start();
$pass = "ruzn@m@t!";
$xml = file_get_contents("http://www.shoofeetv.com/syndications/ruznamati/view/xml?username=ruznamati&pass=".$pass."");
$file = fopen('shoofeetv.xml', 'w');
fwrite($file, $check.$xml.$pagecontent);
fclose($file);
ob_end_flush();
?>

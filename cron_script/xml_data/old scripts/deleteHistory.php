<?php
//session_start();
$_SESSION['location']='cron_script';
include_once('../../config.php');
$tableName=' roz_temp_data';
$whereCheck=' where NOW()>end_date';
$generalObj->deleteQuery($tableName,$whereCheck);

?>
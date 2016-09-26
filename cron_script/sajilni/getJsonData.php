<?php
/**
 * Created by JetBrains PhpStorm.
 * User: shareif
 * Date: 10/17/14
 * Time: 1:01 PM
 * To change this template use File | Settings | File Templates.
 */

$_SESSION['location']='cron_script';
//include_once('../../config.php');
$url = "https://www.sajilni.com/json/events/upcoming/10/1";


$content = file_get_contents($url);
//$JSON_Data = json_encode($content);
//print_r($JSON_Data);
$file = fopen('data.json', 'w');
$staratTag=' ';
$endTag='  ';
//
fwrite($file, $content);
fclose($file);

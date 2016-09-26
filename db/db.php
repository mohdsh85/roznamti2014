<?
$host = 'localhost';
$user = 'root';
$db =$dbName;
$dbpw='';
@$link=mysql_connect($host,$user,$dbpw);
@mysql_select_db($db,$link);
?>
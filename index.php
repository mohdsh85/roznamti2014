<?
	/*
		copyrights reserved for www.roznamti.com
		2012-2013
		IT department 
		index page for user managment area 
	*/
	///include config page
    ob_start();
	session_start();
	include('config.php');
//---------profile settings
if(!isset($_COOKIE['direction']))
    $_COOKIE['direction']='';
if(isset($_GET['CategoryType']))
		include('html/'.$_COOKIE['direction'].'categoryPage.html');
	else
		include('html/'.$_COOKIE['direction'].'index.html');
	//include('html/'.$direction.'list.html');
        ob_end_flush();
?>
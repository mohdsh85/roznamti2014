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
	include('html/'.$_COOKIE['direction'].'advanceSearch.html');
	//include('html/'.$direction.'list.html');
        ob_end_flush();
?>
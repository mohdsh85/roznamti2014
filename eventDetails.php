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
	if($_GET['sevId']!='')
		{
			$ids=explode('_',$_GET['sevId']);
			$_GET['root']=$ids[1];
			$_GET['evId']=$ids[0];
		}
		
	$generalObj->getEventDetails($_GET['root'],$_GET['evId']);
//---------profile settings
		include('html/'.$_COOKIE['direction'].'eventDetails.html');
	//include('html/'.$direction.'list.html');
        ob_end_flush();
?>
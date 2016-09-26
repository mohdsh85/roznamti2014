<?
	/*
		copyrights reserved for Be3o 
		mohammad al shareif
	*/
	ob_start();
	session_start();
	include('../config.php');
	include('logged.php');
	$obj=new logged();
	switch ($_POST['action'])
	{
		case 'getProfile':
		echo $obj->getProfile();
		break;
	}

	ob_flush();
?>
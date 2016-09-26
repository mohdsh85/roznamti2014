<?
	/*
		copyrights reserved for Be3o 
		mohammad al shareif
	*/
	ob_start();
	session_start();
	include('../configAjax.php');
	include('nonLoggedClass.php');
	$obj=new nonLoggedClass();
	switch ($_POST['action'])
	{
		case 'registerNewUser':
		echo $obj->insertNewUser();
		break;
		case 'checkLogin':
		echo $obj->checkLogin();
		break;
		case 'resetPassword':
		echo $obj->resetPassword();
		break;
		case 'updateResetedPassword':
		echo $obj->updateResetedPassword();
		break;
		case 'ContactUsFor':
		echo $obj->ContactUsFor();
		break;
	}

	ob_flush();
?>
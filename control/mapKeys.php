<?
error_reporting(E_ALL); 
ini_set( 'display_errors','1');
	include('config.php');
	
	if(empty($_SESSION[$userLoggedSession]))
	{
		include ('nonLogged/nonLoggedClass.php');
		$nonLoggedObj=new nonLoggedClass();
		$nonLoggedBox=$nonLoggedObj->loginData();
		include('html/indexPreLogged.html');
	}
	else
	{
		include ('logged/logged.php');
		$loggedObj=new logged();
		$loggedBox=$loggedObj->mapKeys($_GET['catId'],$_GET['looking_for_other_resources_on_parse']);
		include('html/indexLogged.html');
	}

?>
<?
error_reporting(E_ALL);
ini_set( 'display_errors','1');
	include('config.php');
//$_SESSION[$userLoggedSession]=1;
	if(empty($_SESSION[$userLoggedSession]) && @$_GET['logout']!='true')///check keep me logged
	{
		if(@$_COOKIE['secureValue']==md5($secureValue.@$_COOKIE['user_id']))
		{
			$_SESSION[$userLoggedSession]=$_COOKIE['user_id'];
		}
	}
	if(empty($_SESSION[$userLoggedSession]) )
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
		$loggedBox=$loggedObj->buildMainBox();
		include('html/indexLogged.html');
	}

?>
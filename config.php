<?
	/*
		copyrights reserved for www.roznamti.com
		2012-2013
		IT department 
		config  page used as start point in loading the system 
	*/
	date_default_timezone_set('Asia/Amman');
	define('sitePathForLogin','http://'.$_SERVER['HTTP_HOST'].'/');
	define('loadTime',time());
	$tabelPrefix='roz_';
	$userLoggedSession='roznamti_user_Id';
	$sitePath='http://'.$_SERVER['HTTP_HOST'].'/';
	$rootPath='/index.php';
	$secureKey='roznamtiNewDesign';
	//image and thumb default size
    $userImageH = 65;
    $userImageW = 58;
    $userThumbH = 32;
    $userThumbW = 32;
	$eventImageNormalH=138;
	$eventImageNormalW=117;
	$eventImageDetailsH=175;
	$eventImageDetailsW=149;
	$eventImageThumbH=32;
	$eventImageThumbW=32;
	//Points System
	$dataPerView=20;
    $brandedPoints = 50;
    $addPoints = 5;
    $addLimit = 10;
    $revPoints = 3;
    $revLimit = 50;
    $shareFPoints = 2;
    $shareMPoints = 1;
    $inviteMPoints = 5;

    //dfeault cat for suggestions
    $suggestDefaultCat = '3,4,1';
	$catImagesPath='images/catImages/';
	$eventImagesPath='images/eventImages/';
	$channelImagesPath='images/channelImages/';
	if(@$_COOKIE['lang']=='')///no cookies  set default values 
	{
		setcookie('lang','en',time()+(60*60*24*365));
		$_COOKIE['lang']='en';//default lang
		setcookie('direction','',time()+(60*60*24*365));
		$_COOKIE['direction']='';
	}
	if(@$_COOKIE['direction']=='')///no cookies  set default values 
	{
		setcookie('direction','',time()+(60*60*24*365));
		//$_COOKIE['direction']='';
	}
	$arraylanguagesValues=array('en','ar');
	$arraylanguagesDirection=array('','rtl/');
	if(@$_GET['lang']!='' && in_array($_GET['lang'],$arraylanguagesValues))
	{
		setcookie('lang',$_GET['lang'],time()+(60*60*24*365));
		$_COOKIE['lang']=$_GET['lang'];//user lang lang
		$key = array_search($_GET['lang'], $arraylanguagesValues);
		setcookie('direction',$arraylanguagesDirection[$key],time()+(60*60*24*365));
		header('Location:'.$_GET['currPage']);
	}
	include_once('lang/'.$_COOKIE['lang'].'.php');
	$lang=new lang();
	$langPrefix=$_COOKIE['lang'];
	$defaultSecureValue=md5($lang->encodeKey.@$defaultCatId);
	$arraylanguages=array('','en','ar');
	$letters=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$timeList='';
	for($i=0;$i<24;$i++)
	{
		$lab=$i;
		if($i<10)
			$lab='0'.$i;
			
			$timeList[]=$lab;
	}
	/*--end language-*/
	/* include formHtml page*/
	include_once('formHtml/formHtml.php');
	$formHtml=new formHtml();
	/*--end Html-*/
	$dbName='roz2016';
	include_once('db/db.php');
	include_once('mainClass/mysql.php');
	include_once('mainClass/generalClass.php');
	$generalObj=new generalClass();
	$currentCat=$generalObj->getCurrentCat();


?>
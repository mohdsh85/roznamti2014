<?
	/*
		copyrights reserved for www.qurranRecords.com
		2012-2013
		IT department 
		config  page used as start point in loading the system 
		mohammad al shareif 
		mohdsh85@gmail.com
		962797255009
	*/
	ob_start();
	//session_start();
	$data='';
	define('sitePathForLogin','http://'.$_SERVER['HTTP_HOST'].'/roznamti2014/');
	$ownerMail='mohdsh85@gmail.com';
	$tabelPrefix='roz_';
	$secureValue="mohdsh1985";
	$userLoggedSession='roznamti_logged_user';
	$direction='';
	$justFloat='';
	$sitePath='http://'.$_SERVER['HTTP_HOST'].'/roznamti2014/';
	$rootPath='/index.php';
	
	include_once('../../lang/en.php');
	$lang=new lang();
	/* include formHtml page*/
	include_once('../../formHtml/formHtml.php');
	$formHtml=new formHtml();
	/*--end Html-*/
	$dbName='roz2016';
	include_once('../../db/db.php');
	include_once('../../mainClass/mysql.php');
	include_once('../../mainClass/generalClass.php');
	$generalObj=new generalClass();
	$header=$generalObj->headerData();
	$footer=$generalObj->footerData();
	ob_flush();
?>
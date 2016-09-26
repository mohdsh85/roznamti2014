<?php // You need to add server side validation and better error handling here
include('config.php');
if($_SESSION[$userLoggedSession]!='')
	{
		include('logged/logged.php');
		$obj=new logged();
	}
	else
	{
		exit('Session Expire');
	}
switch ($_POST['action'])
{
	case 'saveCategory':
	echo $obj->saveCategory($_POST['catName']);
	break;
	case 'getCategorySub':
	echo $obj->getCategorySub($_POST['root'],$_POST['secure']);
	break;
	case 'saveCategorySub':
	echo $obj->saveCategorySub($_POST['catName'],$_POST['root'],$_POST['secure']);
	break;
	case 'viewSubCatcategorySelection':
	echo $obj->viewSubCatcategorySelection($_POST['root'],$_POST['secure'],$_POST['looking_for_other_resources_on_parse']);
	break;
	case 'setDefaultCat':
	echo $obj->setDefaultCat($_POST['root'],$_POST['secure']);
	break;
	case 'updateOrderCat':
	echo $obj->updateOrderCat($_POST['root'],$_POST['secure'],$_POST['order']);
	break;
	case 'other_resource_parser':
	echo $obj->other_resource_parser($_POST['root'],$_POST['secure']);
	break;
	case 'updateEventImage':
	echo $obj->updateEventImage($_POST['mappedKey'],$_POST['value'],$_POST['tableIndex']);
	break;
	case 'extraTableImage':
	echo $obj->extraTableImage($_POST['root'],$_POST['secure']);
	break;
	case 'updateChannelImage':
	echo $obj->updateChannelImage($_POST['value'],$_POST['channelId']);
	break;
	case 'updateChannelName':
	echo $obj->updateChannelName($_POST['value'],$_POST['channelId'],$_POST['prefixName']);
	break;
	case 'updateControlTitles':
	echo $obj->updateControlTitles($_POST['filed'],$_POST['mappedKey'],$_POST['value'],$_POST['tableIndex']);
	break;
}
?>
<?
include('config.php');
	switch ($_POST['action'])
	{
		case 'loadMoreRecords':
		echo $generalObj->eventListHp((int)$_POST['nextOffset'],(int)$_POST['currentCat'],@$_POST['dateValue'],@$_POST['fromTime'],@$_POST['toTime']);
		break;

	}
?>
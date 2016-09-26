<?
include('config.php');
	switch ($_POST['action'])
	{
		case 'filterSuggestedEvents':
		echo $generalObj->createWhereSuggestedSearch($_POST['dateValue'],$_POST['fromTime'],$_POST['toTime'],$_POST['currentCat']);
		break;
		case 'getSearchCatList':
		echo $generalObj->getSearchCatList($_POST['searchCatList'],$_POST['secureSearchCatList'],$_POST['cat']);
		break;
		case 'getFilterListDataTwo':
		echo $generalObj->getFilterListDataTwo($_POST['searchCatList'],$_POST['secureSearchCatList'],$_POST['cat']);
		break;
		case 'getKeywordsCategory':
		echo $generalObj->getKeywordsCategory($_POST['catId']);
		break;
	}
?>
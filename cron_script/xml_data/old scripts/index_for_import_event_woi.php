<?php
//session_start();
$_SESSION['location']='cron_script';
include_once('../../config.php');




$query = "";
$data = array();  
 
$folderPath='feedsShofeeTv/'.date('m-d-Y').'/xmlFiles/';
		if(opendir($folderPath)!==false)
		{
			$dir = opendir($folderPath); 
			$content=array();
			while ($read = readdir($dir)) 
			{ 
				if ($read!='.' && $read!='..') 
				{ 
					$content[]=$read;
				} 
			} 
		}
		print_r($content);
		
foreach($content as $indexValues)
{
//$dom = DOMDocument::load('../../../cron_scripts/xml_data/shoofeetv.xml') or die('Eror:');
$dom = DOMDocument::load($folderPath.$indexValues) or die('Eror:');
		$channelIdParserr = $dom->getElementsByTagName( 'channel' );
		$channelId=$channelIdParserr->item(0)->getAttribute('id');//channel id
		$namear=$channelIdParserr->item(0)->getElementsByTagName('display-name')->item(0)->nodeValue;// name ar 
		$nameen=$channelIdParserr->item(0)->getElementsByTagName('display-name')->item(1)->nodeValue;// name en 
		//echo $channelId .' '.$namear .'' .$nameen;
		insertIntoChannel($channelId,$namear,$nameen,'nologo');
$params = $dom->getElementsByTagName( 'programme' );

$k=0;
///get big channel to set show under it
foreach ($params as $param) //go to each section 1 by 1
{
	
		$startTime=strtotime($params->item($k)->getAttribute('start'));//channel id
		$endTime=strtotime($params->item($k)->getAttribute('stop'));//channel id
		$progTitle=$params->item($k)->getElementsByTagName('title')->item(0)->nodeValue;//prog ar 
		$progTitleen=$params->item($k)->getElementsByTagName('title')->item(1)->nodeValue;//prog ar 
		$desc=$params->item($k)->getElementsByTagName('desc')->item(0)->nodeValue;//prog ar 
		$descen=$params->item($k)->getElementsByTagName('desc')->item(1)->nodeValue;//prog ar 
	//	echo $startTime.' '.$endTime.' '.$progTitle.' '.$progTitleen.' '.$descen.'<br/>';
		$tableName='roz_temp_data';
		$whereCheck=' where other_id='.$channelId.' and start_date="'.$startTime.'"';
 		$channels=$generalObj->selectQuery($tableName,'start_date','',$whereCheck,'','','');
		$values=array('start_date'=>$startTime,'end_date'=>$endTime,'owner'=>'1','cat_id'=>'3','url'=>$url,'other_id'=>$channelId,'other_id_2'=>$channelId,'image'=>$programLogoValue,'other_resources'=>1,'title_ar'=>$progTitle,'description_ar'=>$programDescriptionArValue,'title_en'=>$progTitleen,'description_en'=>$programDescriptionEnValue);
		if($whereCheck==0)
			$generalObj->insertQuery($tableName,$values);
		/*
    ////------channels information data
	////---------code for insert channel data-------------
		//echo '--------start channel details----------- <br/>';
		$channelId=$params->item($k)->getAttribute('id');
		//get channel logo data from here
		$parmLogo=$params->item($k)->getElementsByTagName('logo');
		$countLogo=0;
		// foreach( $parmLogo as $paramLogoDummper)
		//{
		//echo '<br/>';
		//echo 'channel logo:'.$parmLogo->item(0)->nodeValue;
		// $countLogo++;
		//}
		////end channel logo]
		//get channel name
		//echo '<br/>';
		$parmChannelName=$params->item($k)->getElementsByTagName('name');
		//echo 'channel Name ar :'.$parmChannelName->item(0)->nodeValue;
		//echo 'channel Name en :'.$parmChannelName->item(1)->nodeValue;
		///end channel details
		//echo '<br/>';
		//echo '-------------------end channel details----------------------';
		//echo '<br/>';
		$lastCahnnelInsertedId=insertIntoChannel($params->item($k)->getAttribute('id'),$parmChannelName->item(0)->nodeValue,$parmChannelName->item(1)->nodeValue,$parmLogo->item(0)->nodeValue);

	////----channels information end
			///get shows data
	 	$iShows=0;
		$paramShows= $params->item($k)->getElementsByTagName( 'shows' );
		foreach($paramShows as $paramShowsData)
		{
			$showList=$paramShows->item($iShows)->getElementsByTagName( 'show' );
			//----get show source
			//echo '---------------------this event show by--------------<br/>';
			//echo 'show by:'.$showList->item(0)->getAttribute('by').'<br/> ';
			//end show source
			$ishowListDetails=0;
			
			///start show details
			//echo '<br/>-------------------------showing details-------------<br/>';
			foreach( $showList as $showListDetails )
			{
				//start date data
				//length data
				$getFullLength=$showList->item($ishowListDetails)->getElementsByTagName( 'length' );
				//echo 'show length :'.$getFullLength->item(0)->nodeValue.'<br/> ';
				$lengthValue=$getFullLength->item(0)->nodeValue;
				
				
				$startDate=$showList->item($ishowListDetails)->getElementsByTagName( 'startdate' );
				//echo $ishowListDetails.' show Startsate :'.date('Y-m-d H:i:s',$startDate->item(0)->nodeValue).'<br/> ';
				$startDateValue=date('Y-m-d H:i:s',$startDate->item(0)->nodeValue);
				//echo $startDateValue.' '.
				$startDateShofeTv=$startDate->item(0)->nodeValue;
				$endDateShofeTv=$startDateShofeTv+(60*$lengthValue);
				$getEndDate = $startDate->item(0)->nodeValue+(60*$lengthValue);
				$endDateValue=date('Y-m-d H:i:s',$getEndDate);
				//echo 'End date'.$endDateValue.'<br/>';
				//end startdate date("d-m", $stamp); 
				//length data
				$getFullLength=$showList->item($ishowListDetails)->getElementsByTagName( 'length' );
				//echo 'show length :'.$getFullLength->item(0)->nodeValue.'<br/> ';
				$lengthValue=$getFullLength->item(0)->nodeValue;
				//end length
				//length data
				///----program_id
				$programId=$showList->item($ishowListDetails)->getElementsByTagName('program');
				//echo 'show program :'.$programId->item(0)->getAttribute('id').'<br/> ';
				$programIdValue=$programId->item(0)->getAttribute('id');
				//program name
				$programName=$showList->item($ishowListDetails)->getElementsByTagName('name');
				//echo 'show program title ar :'.$programName->item(0)->nodeValue.'<br/> ';
				//echo 'show program title en :'.$programName->item(1)->nodeValue.'<br/> ';
				$programeNameArValue=$programName->item(0)->nodeValue;
				$programeNameEnValue=$programName->item(1)->nodeValue;
				//echo $programeNameArValue.'1<br>';
				///----description
				$programDescription=$showList->item($ishowListDetails)->getElementsByTagName('description');
				//echo 'show program title ar :'.$programDescription->item(0)->nodeValue.'<br/> ';
				//echo 'show program title en :'.$programDescription->item(1)->nodeValue.'<br/> ';
				///description desc
				$programDescriptionArValue=$programDescription->item(0)->nodeValue;
				$programDescriptionEnValue=$programDescription->item(1)->nodeValue;
				
				$programLogo=$showList->item($ishowListDetails)->getElementsByTagName('logo');
				//echo ' show logo pro:'.$programLogo->item(0)->nodeValue.'<br/>';
				$programLogoValue=$programLogo->item(0)->nodeValue;
				//end length
				///-----type of event
				$type=0;
				
				$typeEvent=$showList->item($ishowListDetails)->getElementsByTagName( 'type' );
				$typeEventValue=$typeEvent->item(0)->nodeValue;
				if($typeEventValue=='Repeated')
					$type=1;
					
				$url1=$showList->item($ishowListDetails)->getElementsByTagName('url');
				$url=$url1->item(0)->nodeValue;
				
				//program name
				
				$programNameGenre=$showList->item($ishowListDetails)->getElementsByTagName('name');
				//echo 'show genere title ar :'.$programNameGenre->item(2)->nodeValue.'<br/> ';
				//echo 'show genere title en :'.$programNameGenre->item(3)->nodeValue.'<br/> ';
				$programNameGenreArValue=$programNameGenre->item(2)->nodeValue;
				$programNameGenreEnValue=$programNameGenre->item(3)->nodeValue;
				
				
				
				$programGenre=$showList->item($ishowListDetails)->getElementsByTagName('genre');
					$programGenre=$programGenre->item(0)->getAttribute('id');
		
				
				//echo '--------------ending parsing details for first event--------------<br/>';
				//$categoryId='13';Ù
				//check if this allready in sert to event table
				
				$tableId=3;
				$startDateValue=$startDateShofeTv;
				$enDate=$endDateShofeTv;
				$tableName=' roz_events_'.$tableId.'_current';
				$where='where  other_id_2 = '.$channelId.' and start_date =\''.$startDateValue.'\'';
			//	echo $where;
				$foundRecord=$generalObj->selectQuery($tableName,'*','',$where,'','','');
				if($startDateValue>1339448400 )
					echo $programeNameArValue.'<br>'. $startDateValue.'<br>'.date('Y-m-d H:i',$startDateValue).'<br/>';;
				
			if($foundRecord==0)
			{
					$programeNameEnValue=mysql_escape_string($programeNameEnValue);
					$programDescriptionEnValue=mysql_escape_string($programDescriptionEnValue);
					$programeNameEnValue=trim($programeNameEnValue);
					$programDescriptionEnValue=trim($programDescriptionEnValue);
					$programeNameEnValue=str_replace('ِ',' ',$programeNameEnValue);
					$ishowListDetails++;
					//insert into event 
					$tableName=' roz_events_'.$tableId.'_current';
					echo $tableName;
					// $programGenre->item(0)->getAttribute('id')
					$categoryName='roz_taxonmy_category';
					if($programGenre==0 || empty($programGenre))
					   $programGenre=4000;
					$where='where  other_resource_id= '.$programGenre;
				    $generalObj->selectQuery($categoryName,'id','',$where,'','','');
					//echo '<br >'.$generalObj->id[0].'<br>';
					if(!isset($generalObj->id[0]))
					{
							$where='where  other_resource_id= 4000';
				            $generalObj->selectQuery($categoryName,'id','',$where,'','','');
							$catId= $generalObj->id[0];
					}
					else
					$catId= $generalObj->id[0];
				//	echo '<br>dodo'.$catId.'<br>';
					$whereRe=' where cat_id='.$cat_id.' and other_id='.$programIdValue.' and other_id_2='.$channelId;
					$foundRecordData=$generalObj->selectQuery($tableName,'*','',$whereRe,'','','');
					$stDate=$startDateShofeTv;
					$enDate=$endDateShofeTv;
					if($foundRecordData==0)
					{
						$values=array('start_date'=>$stDate,'end_date'=>$enDate,'owner'=>'1','cat_id'=>$catId,'url'=>$url,'other_id'=>$programIdValue,'other_id_2'=>$channelId,'image'=>$programLogoValue,'other_resources'=>1);
						$generalObj->insertQuery($tableName,$values);
						$lastEvent=$generalObj->lastInsertedrow;
						//check if program text exist
						//$tableId=3;
						$tableName=' roz_events_'.$tableId.'_current_info';
						$where='where  sub_program_id = '.$programIdValue;
						//$foundRecordInfo=
						$foundRecordInfo=$generalObj->selectQuery($tableName,'*','',$where,'','','');
						///insert into event Lang
						//$tableName="roz_event_lang";
						//echo $generalObj->title_ar[0];
						if( $foundRecordInfo==0)
							{
								$values=array('event_id'=>$lastEvent,'sub_program_id'=>$programIdValue,'title_ar'=>$programeNameArValue,'description_ar'=>$programDescriptionArValue,'title_en'=>$programeNameEnValue,'description_en'=>$programDescriptionEnValue);
								$generalObj->insertQuery($tableName,$values);
							
							}
					}
					else
					{
							//$generalObj->deleteQuery($tableName,$whereRe);
							$values=array('start_date'=>$stDate,'end_date'=>$enDate,'owner'=>'1','cat_id'=>$catId,'url'=>$url,'other_id'=>$programIdValue,'other_id_2'=>$channelId,'image'=>$programLogoValue,'other_resources'=>1);
							$generalObj->updateQuery($tableName,$values,' where event_id='.$generalObj->event_id[0]);
					}
				

			}
}

			
			$iShows++;
		}
*/
	 ////end showing data here
	$k++;

}
}



function insertIntoChannel($channelId,$nameAr,$nameEn,$logo)
{
		$q=mysql_query(" select channel_id,id from roz_channel_list where channel_id=".$channelId);
		$num=mysql_num_rows($q);
		if($num>0)
		{
			return mysql_result($q,0,'id');
		}
		else
		{
			mysql_query(" insert into roz_channel_list (channel_id,name_ar,name_en,logo,event_by) values ('$channelId','$nameAr','$nameEn','$logo','1') ");
			return mysql_insert_id();
		}
}


?>


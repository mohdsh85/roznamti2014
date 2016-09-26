<?php
//session_start();

include_once('../../configNoNeedLocation.php');




$query = "";
$data = array();  
 function add_person( $id, $domein, $naam, $land, $streek, $substreek, $jaar, $type, $smaak, $formaat, $druivensoort, $prijsnormaal,
   $prijs6, $prijs12, $prijs24, $info, $actieid, $afbeelding, $kleur, $titel, $description, $keywords, $afbeeldingalt, $spijs, $leverancier, $levertijd )
  {
    global $data;  
     $data []= array(
  'id' => $id,
  'domein' => $domein,
  'naam' => $naam,
  'land' => $land, 
  'streek' => $streek,
  'substreek' => $substreek,
  'jaar' => $jaar,
  'type' => $type,
  'smaak' => $smaak,
  'formaat' => $formaat,
  'druivensoort' => $druivensoort,
  'prijsnormaal' => $prijsnormaal,
  'prijs6' => $prijs6,
  'prijs12' => $prijs12,
  'prijs24' => $prijs24,
  'info' => $info,
  'actieid' => $actieid,

  'afbeelding' => $afbeelding,
  'kleur' => $kleur,
  'titel' => $titel,
  'description' => $description,
  'keywords' => $keywords,
  'afbeeldingalt' => $afbeeldingalt,
  'spijs' => $spijs,
  'leverancier' => $leverancier,
  'levertijd' => $levertijd
  );
      }




//$dom = DOMDocument::load('../../../cron_scripts/xml_data/shoofeetv.xml') or die('Eror:');
$dom = DOMDocument::load('shoofeetv.xml') or die('Eror:');
$params = $dom->getElementsByTagName( 'channel' );

$k=0;
///get big channel to set show under it
foreach ($params as $param) //go to each section 1 by 1
{
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
				/*if($programGenre->item(0)->getAttribute('id')=='2170' || $programGenre->item(0)->getAttribute('id')=='2193' || $programGenre->item(0)->getAttribute('id')=='3162' || $programGenre->item(0)->getAttribute('id')=='2164' || $programGenre->item(0)->getAttribute('id')=='2160' || $programGenre->item(0)->getAttribute('id')=='3422' || $programGenre->item(0)->getAttribute('id')=='3060')
				{
					$programGenre=0;
					
				}*/
				
				//echo '--------------ending parsing details for first event--------------<br/>';
				//$categoryId='13';Ù
				//check if this allready in sert to event table
				
				$tableId=3;
				$startDateValue=$startDateShofeTv;
				$enDate=$endDateShofeTv;
				$tableName='roz_inserting_events';
				//$tableName=' roz_events_'.$tableId.'_current';
				
				$where='';
			//	echo $where;
				
					$programeNameEnValue=mysql_escape_string($programeNameEnValue);
					$programDescriptionEnValue=mysql_escape_string($programDescriptionEnValue);
					$programeNameEnValue=trim($programeNameEnValue);
					$programDescriptionEnValue=trim($programDescriptionEnValue);
					$programeNameEnValue=str_replace('ِ',' ',$programeNameEnValue);
					$ishowListDetails++;
					//insert into event 
					//$tableName=' roz_events_'.$tableId.'_current';
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
					$whereRe=' ';
					$stDate=$startDateShofeTv;
					$enDate=$endDateShofeTv;
					
					$values=array('start_date'=>$stDate,'end_date'=>$enDate,'owner'=>'1','cat_id'=>$catId,'url'=>$url,'other_id'=>$programIdValue,'other_id_2'=>$channelId,'image'=>$programLogoValue,'other_resources'=>1);
					$generalObj->insertQuery($tableName,$values);
					$lastEvent=$generalObj->lastInsertedrow;
					//check if program text exist
					//$tableId=3;
					//$tableName=' roz_events_'.$tableId.'_current_info';
					$tableInfo='roz_inserting_events_info';
					$where='where  sub_program_id = '.$programIdValue;
					//$foundRecordInfo=
					$foundRecordInfo=$generalObj->selectQuery($tableInfo,'*','',$where,'','','');
					///insert into event Lang
					//$tableName="roz_event_lang";
					//echo $generalObj->title_ar[0];
					if( $foundRecordInfo==0)
					{
						$values=array('event_id'=>$lastEvent,'sub_program_id'=>$programIdValue,'title_ar'=>$programeNameArValue,'description_ar'=>$programDescriptionArValue,'title_en'=>$programeNameEnValue,'description_en'=>$programDescriptionEnValue);
						$generalObj->insertQuery($tableInfo,$values);
					
					}

			}

			
			$iShows++;
		}
	 ////end showing data here
	$k++;

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


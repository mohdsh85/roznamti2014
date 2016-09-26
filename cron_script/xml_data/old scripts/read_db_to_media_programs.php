<?
	$_SESSION['location']='cron_script';
	include_once('../../config.php');
	$tableId=3;
	$tableNameDestination='roz_events_'.$tableId.'_current';
	$tableInfoDestination='roz_events_'.$tableId.'_current_info';
	
	$tableNameSource='roz_inserting_events';
	$tableInfoSource='roz_inserting_events_info';
	
	$data=date('Y-m-d h:i:s a');
	$date=strtotime($date);
	$whereDestination=' ';
	////get data records
	$foundRecordInfo=$generalObj->selectQuery($tableInfoSource,'event_id,sub_program_id,title_ar,description_ar,title_en,description_en','',$whereDestination,'','','');
	for($i=0;$i<$foundRecordInfo;$i++)
	{
		$sub_program_id=$generalObj->sub_program_id[$i];
		$title_ar=$generalObj->title_ar[$i];
		$description_ar=$generalObj->description_ar[$i];
		$title_en=$generalObj->title_en[$i];
		$description_en=$generalObj->description_en[$i];
		$event_id=$generalObj->event_id[$i];
		
		////check the current table for the same record 
		$whereRe=' where sub_program_id='.$sub_program_id;
		$recordInDestiniation=$generalObj->selectQuery($tableInfoDestination,'sub_program_id','',$whereRe,'','','');
		if($recordInDestiniation==0)///insert new record
		{
			$values=array('event_id'=>$event_id,'sub_program_id'=>$sub_program_id,'title_ar'=>$title_ar,'description_ar'=>$description_ar,'title_en'=>$title_en,'description_en'=>$description_en);
			$generalObj->insertQuery($tableInfoDestination,$values);
		}
	}
	////get programs

	
?>
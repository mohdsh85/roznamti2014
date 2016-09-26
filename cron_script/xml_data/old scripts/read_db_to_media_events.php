<?
	//session_start();
	$_SESSION['location']='cron_script';
	include_once('../../config.php');
	$tableId=3;
	$tableNameDestination='roz_events_'.$tableId.'_current';
	$tableInfoDestination='roz_events_'.$tableId.'_current_info';
	
	$tableNameSource='roz_inserting_events';
	$tableInfoSource='roz_inserting_events_info';
	
	$data=date('Y-m-d h:i:s a');
	$date=strtotime($date);
	$whereDestination=' where start_date>="'.$date.'"';
	////get data records
	$foundRecordInfo=$generalObj->selectQuery($tableNameSource,'start_date,end_date,cat_id,url,other_id,other_id_2,image','',$whereDestination,'','','');
	for($i=0;$i<$foundRecordInfo;$i++)
	{
		$start_date=$generalObj->start_date[$i];
		$end_date=$generalObj->end_date[$i];
		$url=$generalObj->url[$i];
		$catId=$generalObj->cat_id[$i];
		$other_id_2=$generalObj->other_id_2[$i];
		$image=$generalObj->image[$i];
		$other_id=$generalObj->other_id[$i];
		$owner=1;
		$other_resources=1;
		
		////check the current table for the same record 
		$whereRe=' where cat_id='.$catId.' and other_id='.$other_id.' and other_id_2='.$other_id_2.' and start_date="'.$start_date.'"';
		$recordInDestiniation=$generalObj->selectQuery($tableNameDestination,'event_id','',$whereRe,'','','');
		if($recordInDestiniation==0)///insert new record
		{
			$values=array('start_date'=>$start_date,'end_date'=>$end_date,'owner'=>$owner,'cat_id'=>$catId,'url'=>$url,'other_id'=>$other_id,'other_id_2'=>$other_id_2,'image'=>$image,'other_resources'=>$other_resources);
			$generalObj->insertQuery($tableNameDestination,$values);
			$lastEvent=$generalObj->lastInsertedrow;
		}
		else///update
		{
			//$generalObj->deleteQuery($tableName,$whereRe);
			$values=array('start_date'=>$start_date,'end_date'=>$end_date,'owner'=>$owner,'cat_id'=>$catId,'url'=>$url,'other_id'=>$other_id,'other_id_2'=>$other_id_2,'image'=>$image,'other_resources'=>$other_resources);
			$generalObj->updateQuery($tableNameDestination,$values,' where event_id='.$generalObj->event_id[0]);
			$lastEvent=$generalObj->event_id[0];
		}
		
							
	}
	////get programs

	
?>
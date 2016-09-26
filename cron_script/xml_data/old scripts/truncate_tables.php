<?
		//session_start();
		$_SESSION['location']='cron_script';
		include_once('../../config.php');
		$tableNameSource='roz_inserting_events';
		$tableInfoSource='roz_inserting_events_info';
		
		mysql_query("truncate roz_inserting_events");
		mysql_query("truncate roz_inserting_events_info");
		
		mysql_query("truncate roz_data_api_pray_time");
		mysql_query("truncate roz_data_api_weather");
?>
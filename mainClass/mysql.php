<?
	/*
		copyrights reserved for www.roznamti.com
		2012-2013
		IT department 
		sql class for sql database commands
	*/
	class mysql
	{
			////inserting query 
			///////inserting query here 
			function insertQuery($tableName,$values)
			{
				global $link,$affectedRow;
				$value=array_keys($values);
				$q=' insert into '.$tableName.' (';
				for($i=0;$i<count($value);$i++)
				{
					if($i<count($value)-1)
						$q.=$value[$i].',';
					else
						$q.=$value[$i];
				}
				$q.=' ) values (';
				
				for($i=0;$i<count($value);$i++)
				{
					$values[$value[$i]]=$this->simpleFilterInput($values[$value[$i]]);
					if($i<count($value)-1)
						$q.='"'.$values[$value[$i]].'",';
					else
						$q.='"'.$values[$value[$i]].'"';
				}
				$q.=')';
			//	echo $q.'<br/>';
				//die();
				$z=mysql_query($q);
				$this->lastInsertedrow=mysql_insert_id($link);
				$affectedRow=mysql_affected_rows($link);
				///when query fails
				if($affectedRow<1)
				{
					$this->insertIntoErrorLog('200',$tableName,$value);
				}
				//return $q;
				if($z)
					return true;
			}
			function insertQueryNoFilter($tableName,$values)
			{
				global $link,$affectedRow;
				$value=array_keys($values);
				$q=' insert into '.$tableName.' (';
				for($i=0;$i<count($value);$i++)
				{
					if($i<count($value)-1)
						$q.=$value[$i].',';
					else
						$q.=$value[$i];
				}
				$q.=' ) values (';
				
				for($i=0;$i<count($value);$i++)
				{
					$values[$value[$i]]=$values[$value[$i]];
					if($i<count($value)-1)
						$q.='"'.$values[$value[$i]].'",';
					else
						$q.='"'.$values[$value[$i]].'"';
				}
				$q.=')';
				//echo $q;
				//die();
				mysql_query($q);
				$this->lastInsertedrow=mysql_insert_id($link);
				$affectedRow=mysql_affected_rows($link);
				///when query fails
				if($affectedRow<1)
				{
					$this->insertIntoErrorLog('200',$tableName,$value);
				}
				//return $q;
			}
				////updating  query 
			function updateQuery($tableName,$values,$where)
			{
				$value=array_keys($values);
				$q=' update  '.$tableName.' set ';
				for($i=0;$i<count($value);$i++)
				{
					//$values[$value[$i]]=$this->filterInput($values[$value[$i]]);
					$values[$value[$i]]=$values[$value[$i]];
					if($i<count($value)-1)
						$q.=$value[$i].'="'.$values[$value[$i]].'",';
					else
						$q.=$value[$i].'="'.$values[$value[$i]].'"';
				}
				$q.=$where;
				//echo $q;
				mysql_query($q);
				//return $q;
			}
				////delete   query 
			function deleteQuery($tableName,$where)
			{
				$q=' delete from  '.$tableName.'  '.$where;
				//echo $q;
				mysql_query($q);
				//return $q;
			}
			/* retirve counter for data for*/
			function returnCounterRecords($table_name='',$field='',$index='',$where='',$DISTINCT='',$limit='',$ordering='')
			{
				global $link,$affectedRow;
				$q=mysql_query( ' select count('.$field.') as counterRecord  from '.$table_name.' '.$where.'  '.$ordering.' '.$limit);
				$num=@mysql_result($q,0,'counterRecord');
				if($num>0)
				{
					$this->counterRecord=$num;
				}
				else
					return 0;
				$affectedRow= mysql_affected_rows($link);
				///show error handler 
				////check error on query
				if($affectedRow<1)
				{
					$this->insertIntoErrorLog('100',$table_name,$field,$index,$where,$DISTINCT,$limit,$ordering);
				}
			}
			/////function select query 
			///can select * and some fileds 
			//the the result will be set to each one coulmns
			function selectQuery($table_name='',$field='',$index='',$where='',$DISTINCT='',$limit='',$ordering='')
			{
				global $link,$affectedRow;
				$q=mysql_query(' select '.$DISTINCT.' '.$field.' from '.$table_name.' '.$where.'  '.$ordering.' '.$limit);
				//echo ' select '.$DISTINCT.' '.$field.' from '.$table_name.' '.$where.'  '.$ordering.' '.$limit;
				$num=@mysql_num_rows($q);
				if($num>0)
				{
					if($field!='*')
					{
						$listFields=explode(',',$field);
						for($z=0;$z<$num;$z++)
						{
								for($i=0;$i<sizeof($listFields);$i++)
								{
									// $this->{mysql_result($dataQuery,$i,'column_name')}='';// mysql_result($dataQuery,$i,'column_name');
									 $this->{$listFields[$i]}[$z]=mysql_result($q,$z,$listFields[$i]);
								}
						}
					}
					else
					{
						$dataQuery=mysql_query("select column_name from information_schema.columns  where table_name = '".$table_name."'");
						$numCoulm=mysql_num_rows($dataQuery);
						for($z=0;$z<$num;$z++)
						{
								for($i=0;$i<$numCoulm;$i++)
								{
									// $this->{mysql_result($dataQuery,$i,'column_name')}='';// mysql_result($dataQuery,$i,'column_name');
									 $this->{mysql_result($dataQuery,$i,'column_name')}[$z]=mysql_result($q,$z,mysql_result($dataQuery,$i,'column_name'));
											
								}
						}
					}
					return $num;
				}
				else
					return 0;
				$affectedRow= mysql_affected_rows($link);
				///show error handler 
				////check error on query
				if($affectedRow<1)
				{
					$this->insertIntoErrorLog('100',$table_name,$field,$index,$where,$DISTINCT,$limit,$ordering);
				}
			}
			
			/////inserting into error log database 
			/*
				erro log file
				100 select error
				200 insert 
				300 delete
				400 update
			*/
			function insertIntoErrorLog($errorType,$table_name='',$field='',$index='',$where='',$DISTINCT='',$limit='',$ordering='')
			{
				/////////
				global $tabelPrefix,$userLoggedSession;
				$time=date('Y-m-d H:i');
				//echo $time;
				//set values to be inserted into error log
				$values=array('user_id'=>$userLoggedSession,'error_type'=>$errorType,'table_name'=>$table_name,'field'=>$field,'where_value'=>$where,'limit_value'=>$limit,'date_value'=>$time);
				////inserting into db
				//////building error body
				$body=$this->buildErrorBody($errorType,$table_name);
				$this->insertQueryError($tabelPrefix.'error_log',$values,$body);
				////sending mail to check error
				//echo $this->mailing('mohdsh85@gmail.com','Roznamti error log','error log',$body);
			}
			///////inserting query error handler here 
			function insertQueryError($tableName,$values,$body)
			{
				global $link,$affectedRow;
				$value=array_keys($values);
				$q=' insert into '.$tableName.' (';
				for($i=0;$i<count($value);$i++)
				{
					if($i<count($value)-1)
						$q.=$value[$i].',';
					else
						$q.=$value[$i];
				}
				$q.=' ) values (';
				
				for($i=0;$i<count($value);$i++)
				{
					if($i<count($value)-1)
						$q.='"'.$values[$value[$i]].'",';
					else
						$q.='"'.$values[$value[$i]].'"';
				}
				$q.=')';
			//	echo $q;
				//die();
				mysql_query($q);
				$affectedRow=mysql_affected_rows($link);
				///when query fails
				if($affectedRow<1)
				{
					////sending mail to check error
					$this->mailing('mohdsh85@gmail.com','Quraan Readers error log','error log',$body);
					
				}
					$this->mailing('mohdsh85@gmail.com','Quraan Readers error log','error log query ',$q);
				//return $q;
			}
			
			
			//////createTableMainCategory
			/* function for creating main category tables*/
			/* this function will build the structure automaticlly */
			function createTableMainCategory($id)
			{
				global $tabelPrefix,$dbName;
					$q=mysql_query(" CREATE TABLE IF NOT EXISTS `".$dbName."`.`".$tabelPrefix."events_".$id."_current` (
											 `event_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
											 `start_date` INT NOT NULL ,
											 `end_date` INT NOT NULL ,
											 `owner` INT NOT NULL ,
											 `cat_id` INT NOT NULL ,
											 `url` TEXT NOT NULL ,
											 `other_id` INT NOT NULL ,
											 `other_id_2` INT NOT NULL ,
											 `image` TEXT NOT NULL ,
											 `other_resources` INT NOT NULL ,
											 `event_location` text NOT NULL,
											 `event_rate` INT NOT NULL, 
											  `event_mapped_key` INT NOT NULL,
											 INDEX (`cat_id`),
											 INDEX (`start_date`),
											 INDEX (`end_date`)
											) ENGINE= InnoDB ");
											
					$q=mysql_query(" CREATE TABLE IF NOT EXISTS `".$dbName."`.`".$tabelPrefix."events_".$id."_history` (
											 `event_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
											 `start_date` INT NOT NULL ,
											 `end_date` INT NOT NULL ,
											 `info_id` INT NOT NULL ,
											 `owner` INT NOT NULL ,
											 `cat_id` INT NOT NULL ,
											 `url` TEXT NOT NULL ,
											 `other_id` INT NOT NULL ,
											 `other_id_2` INT NOT NULL ,
											 `image` TEXT NOT NULL ,
											 `other_resources` INT NOT NULL ,
											 `event_location` text NOT NULL,
											 `event_rate` INT NOT NULL,
											 `event_mapped_key` INT NOT NULL,
											 INDEX (`cat_id`),
											 INDEX (`start_date`),
											 INDEX (`end_date`)
											) ENGINE= InnoDB ");
											
					mysql_query(" ALTER TABLE `".$tabelPrefix."events_".$id."_history` ADD FOREIGN KEY (`cat_id`) REFERENCES `".$dbName."`.`".$tabelPrefix."taxonmy_category`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");
					mysql_query(" ALTER TABLE `".$tabelPrefix."events_".$id."_current` ADD FOREIGN KEY (`cat_id`) REFERENCES `".$dbName."`.`".$tabelPrefix."taxonmy_category`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");
					
					mysql_query(" CREATE TABLE IF NOT EXISTS `".$dbName."`.`".$tabelPrefix."events_".$id."_info` (
											 `id` INT NOT NULL  AUTO_INCREMENT PRIMARY KEY ,
											 `sub_program_id` int(11) default NULL ,
											 `mapped_key` int(1) default 0 ,
											 `title_ar` VARCHAR( 150)NOT NULL ,
											 `description_ar` TEXT NOT NULL ,
											 `title_en` VARCHAR( 150)NOT NULL ,
											 `description_en` TEXT NOT NULL ,
											 `image` TEXT NOT NULL ,
											 `tagz` TEXT NOT NULL ,
											 INDEX (`sub_program_id`)

											) ENGINE= InnoDB ");
					
					
											
			}
				/////function select field name of table
			function selectStructure($table_Name='')
			{
			
				$q=mysql_query('SHOW COLUMNS FROM '. $table_Name  );
				//return 'SHOW COLUMNS FROM '. $table_Name;
				$num=mysql_num_rows($q);
				$this->counterRecord=$num;
				if($num>0)
				{
					$columnsName=array('field');
					for($z=0;$z<$num;$z++)
					{
						for($i=0;$i<1;$i++)
						{
							
							$this->{$columnsName[$i]}[$z]=mysql_result($q,$z,$columnsName[$i]);
				
						}
					}	
					
				}
			}
			
			
			/////function select Structure of table
			function selectFieldStructure($table_name )
			{
			
				$q=mysql_query('SHOW COLUMNS FROM '. $table_name  );
				$num=mysql_num_rows($q);
				$this->counter=$num;
				if($num>0)
				{
					$columnsName=array('field','null');
					for($z=0;$z<$num;$z++)
					{
						for($i=0;$i<2;$i++)
						{
							
							$this->{$columnsName[$i]}[$z]=mysql_result($q,$z,$columnsName[$i]);
				
						}
					}	
					
				}
			}
	/***/	
			/////function select query 
			///can select * and some fileds 
			//the the result will be set to each one coulmns
			function selectQueryCommentOrdering($table_name='',$field='',$index='',$where='',$DISTINCT='',$limit='',$ordering='')
			{
				global $link,$affectedRow;
				if($_GET['postId']=='')
					$limit=' limit 0,5';
				else
					$limit='';
				$q=mysql_query(' SELECT * FROM (SELECT '.$field.' FROM '.$table_name.' '.$where.' '.$ordering.'  '.$limit.' ) AS  `table` ORDER BY id');
				$num=@mysql_num_rows($q);
				if($num>0)
				{
					if($field!='*')
					{
						$listFields=split(',',$field);
						for($z=0;$z<$num;$z++)
						{
								for($i=0;$i<sizeof($listFields);$i++)
								{
									// $this->{mysql_result($dataQuery,$i,'column_name')}='';// mysql_result($dataQuery,$i,'column_name');
									 $this->{$listFields[$i]}[$z]=mysql_result($q,$z,$listFields[$i]);
								}
						}
					}
					else
					{
						$dataQuery=mysql_query("select column_name from information_schema.columns  where table_name = '".$table_name."'");
						$numCoulm=mysql_num_rows($dataQuery);
						for($z=0;$z<$num;$z++)
						{
								for($i=0;$i<$numCoulm;$i++)
								{
									// $this->{mysql_result($dataQuery,$i,'column_name')}='';// mysql_result($dataQuery,$i,'column_name');
									 $this->{mysql_result($dataQuery,$i,'column_name')}[$z]=mysql_result($q,$z,mysql_result($dataQuery,$i,'column_name'));
											
								}
						}
					}
					return $num;
				}
				else
					return 0;
				$affectedRow= mysql_affected_rows($link);
				///show error handler 
				////check error on query
				if($affectedRow<1)
				{
					$this->insertIntoErrorLog('100',$table_name,$field,$index,$where,$DISTINCT,$limit,$ordering);
				}
			}
			
			
					//check if tabel found
			function Table_Exist($tabelName)
			{
			
				if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$tabelName."'"))==1) 
					return  1;
				else 
					return 0;
			}
			//build table
			function build_user_table($id)
			{			
				global $tabelPrefix,$dbName;
				$q=mysql_query(" CREATE TABLE IF NOT EXISTS `".$dbName."`.`".$tabelPrefix."ugc_user_events_".$id."_current` (
						 `event_id` int(11) NOT NULL auto_increment,
						  `title` text NOT NULL,
						  `description` text,
						  `owner` int(11) NOT NULL,
						  `image` text NOT NULL,
						  `cat_id` int(11) NOT NULL,
						  `start_date` int(11) NOT NULL,
						  `end_date` int(11) NOT NULL,
						  `location` text,
						  PRIMARY KEY  (`event_id`)) ENGINE= InnoDB ");
						  
					mysql_query(" ALTER TABLE `".$dbName."`.`".$tabelPrefix."ugc_user_events_".$id."_current` ADD FOREIGN KEY (`cat_id`) REFERENCES `".$dbName."`.`".$tabelPrefix."taxonmy_category`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");
					mysql_query(" ALTER TABLE `".$dbName."`.`".$tabelPrefix."ugc_user_events_".$id."_current` ADD FOREIGN KEY (`owner`) REFERENCES `".$dbName."`.`".$tabelPrefix."users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");	
						  
				$qHistory=mysql_query(" CREATE TABLE IF NOT EXISTS `".$dbName."`.`".$tabelPrefix."ugc_user_events_".$id."_history` (
						  `event_id` int(11) NOT NULL auto_increment,
						  `title` text NOT NULL,
						  `description` text,
						  `owner` int(11) NOT NULL,
						  `image` text NOT NULL,
						  `cat_id` int(11) NOT NULL,
						  `start_date` int(11) NOT NULL,
						  `end_date` int(11) NOT NULL,
						  `location` text,
						  PRIMARY KEY  (`event_id`)) ENGINE= InnoDB ");
						  
						
						  mysql_query(" ALTER TABLE `".$dbName."`.`".$tabelPrefix."ugc_user_events_".$id."_history` ADD FOREIGN KEY (`cat_id`) REFERENCES `".$dbName."`.`".$tabelPrefix."taxonmy_category`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");
						mysql_query(" ALTER TABLE `".$dbName."`.`".$tabelPrefix."ugc_user_events_".$id."_history` ADD FOREIGN KEY (`owner`) REFERENCES `".$dbName."`.`".$tabelPrefix."users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");	
			}
			
			
	
			
	}
	
	

?>
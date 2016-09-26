<?
	class logged extends generalClass
	{
		
		function editEvents()
		{
			global $tabelPrefix,$secureValue;
			$data='';
			if(@$_GET['catId']!='')
			{
				if(md5($secureValue.$_GET['catId'])==$_GET['passV'])
				{
					$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','id,title,root','','where root='.$_GET['catId']);
					if($catList==0)
					{
						$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','id,title,root','','where id='.$_GET['catId']);
						$data.='<form method="post" name="filter" id="filter" action="?catId='.$_GET['catId'].'&passV='.$_GET['passV'].'&tabId='.$_GET['tabId'].'">';
						$data.='<div class="recordRow">
							<div class="leftBoxHp"><span class="lablePlay">Last Level</span></div>';
						$data.='<div class="recordRow">
							<div class="leftBoxHp"><span class="lablePlay"><input id="st_period" name="st_period" type="text" size="25" maxlength="10"  readonly="true" onFocus="this.select();lcs(this)"  onClick="event.cancelBubble=true;this.select();lcs(this)" /></span></div>';
						$data.='<div class="recordRow">
							<div class="leftBoxHp"><span class="lablePlay"><input id="en_period" name="en_period" type="text" size="25" maxlength="10"  readonly="true" onFocus="this.select();lcs(this)"  onClick="event.cancelBubble=true;this.select();lcs(this)" /></span></div>';
						$data.='<div class="recordRow">
							<div class="leftBoxHp"><span class="lablePlay"><input type="submit" name="filter" id="filter" value="Filter" /></span></div>';
							$data.='</form>';
							$table='';
							if(@$_POST['st_period']!='' &&  @$_POST['en_period']!='')
							{
								$tablename=$tabelPrefix.'events_'.$_GET['tabId'].'_current'	;			
								$tableinfo=$tabelPrefix.'events_'.$_GET['tabId'].'_info';
								$stTime=strtotime($_POST['st_period']);
								$enTime=strtotime($_POST['en_period']);
								$where=' where start_date>="'.$stTime.'" and end_date<="'.$enTime.'"';	
								$qEvents=$this->selectQuery($tablename,'event_mapped_key,event_id','',$where);
								if($qEvents>0)
								{
									$table='<table border="1" width="95%" cellpadding="2" cellspacing="2">';
									for($z=0;$z<$qEvents;$z++)
									{
										$qEventsDetails=$this->selectQuery($tableinfo,'mapped_key,id,title_en,description_en','',' where mapped_key='.$this->event_mapped_key[$z]);
										$table.='<tr>';
										$table.='<td><input type="text" value="'.$this->title_en[0].'" size="40" id="id_'.$this->id[0].'" onblur="changeTitle(\'title_en\',\''.$this->event_mapped_key[$z].'\',this.value,\''.$_GET['tabId'].'\')" /></td>';
										$table.='<td><input type="text" value="'.$this->description_en[0].'" id="desc_'.$this->id[0].'" size="80" onblur="changeTitle(\'description_en\',\''.$this->event_mapped_key[$z].'\',this.value,\''.$_GET['tabId'].'\')" /></td>';
									}
									$table.='</table>';
								}
							}
							$data.= $table;
							
					}
				}
			}
			else
			$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','id,title,root','','where root=0 ');
			
			$j=0;
			foreach($this->id as $index)
			{
				if(@$_GET['tabId']=='')
					$tabId=$this->id[$j];
				else
					$tabId=$_GET['tabId'];
				$data.='<div class="recordRow">
					<div class="leftBoxHp"><span class="lablePlay"><a href="?catId='.$this->id[$j].'&passV='.md5($secureValue.$this->id[$j]).'&tabId='.$tabId.'">'.$this->title[$j].'</a></span></div>';
				$j++;
			}
			return $data;
			
		}
		function buildMainBox()
		{
			unset($data);
			global $lang,$justFloat;
			$data='
			 <div class="ionTabs" id="tabs_1" data-name="">
				<ul class="ionTabs__head">
					<li class="ionTabs__tab" data-target="dataParser"  onclick="setTab(\'recordMp3\')">'.$lang->record_file_lang.'</li>
					<li class="ionTabs__tab" data-target="profile"   style="float:'.$justFloat.'" onclick="setTab(\'profile\');showUserProfile()">'.$lang->my_profile_lang.'</li>
					<li class="ionTabs__tab" data-target="category"   style="float:'.$justFloat.'" onclick="setTab(\'followingList\');showUserProfile()">'.$lang->category_lang.'</li>
					<li class="ionTabs__tab" data-target="insertMovie"   style="float:'.$justFloat.'" onclick="setTab(\'insertMovie\');showUserProfile()">Insert Movie</li>
				</ul>
				
				<div class="ionTabs__body">
						<div class="ionTabs__item" data-name="dataParser">
						<div  class="tabContentData">
							'.$this->newUploadFileJquery().'
						</div></div>
		
						<div class="ionTabs__item" data-name="profile"  style="height:1500px">
							<div  class="tabContentData">
								Comming soon
						</div>
						</div>
						<div class="ionTabs__item" data-name="category">
										<div  id="followingList" class="tabContentData"   style="height:1000px">
								'.$this->category().'
										</div>
						</div>
												<div class="ionTabs__item" data-name="insertMovie">
										<div  id="insertMovie" class="tabContentData"   style="height:1000px">
								'.$this->insertMovie().'
										</div>
						</div>
						<div class="ionTabs__preloader"></div>
					</div>
				</div>';
	return $data;
		}

	function insertMovie()
    {
        global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
        $data='<div class="regRecords">';
        $data.='<div class="regRecordsLabel">'.$lang->title_ar.'</div><div class="spanSpace">:</div>';
        $data.='<div class="regRecordsInput">'.$formHtml->textBox('title_ar','title_ar','50','','','textInput','').'<span class="errorFiled" id="file_lable_required">'.$lang->file_lable_require_lang.'</span></div>';
        $data.='</div>';
        $data.='<div class="regRecords">';
        $data.='<div class="regRecordsLabel">'.$lang->desc_ar.'</div><div class="spanSpace">:</div>';
        $data.='<div class="regRecordsInput">'.$formHtml->textArea('desc_ar','desc_ar','50','','','textInput','').'<span class="errorFiled" id="file_lable_required">'.$lang->file_lable_require_lang.'</span></div>';
        $data.='</div>';
        $data.='<div class="regRecords">';
        $data.='<div class="regRecordsLabel">'.$lang->title_en.'</div><div class="spanSpace">:</div>';
        $data.='<div class="regRecordsInput">'.$formHtml->textBox('title_en','title_en','50','','','textInput','').'<span class="errorFiled" id="file_lable_required">'.$lang->file_lable_require_lang.'</span></div>';
        $data.='</div>';
        $data.='<div class="regRecords">';
        $data.='<div class="regRecordsLabel">'.$lang->desc_en.'</div><div class="spanSpace">:</div>';
        $data.='<div class="regRecordsInput">'.$formHtml->textArea('desc_en','desc_en','50','','','textInput','').'<span class="errorFiled" id="file_lable_required">'.$lang->file_lable_require_lang.'</span></div>';
        $data.='</div>';
        return $data;

    }
		/*	category */
		function category()
		{
			global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
			$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','extraTableImage,title,root,id,is_default,order_list,looking_for_other_resources_on_parse','','where root=0 ');
			$data='<div class="regRecords"><div class="regRecordsLabel">Category Name</div><div class="regRecordsLabel">'.$formHtml->textBox('categoryName','categoryName','24','js','','textInput').'</div><div>'.$formHtml->button('saveCat','saveCat','Save','onclick=saveCategory()','buttonClass').'</div></div>';
			if($catList>0)
			{
				for($i=0;$i<$catList;$i++)
				{
					$data.='<div class="recordRow">
					<div class="leftBoxHp"><span class="lablePlay"><a href="javascript:" onclick="viewSubCat(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')">'.$this->title[$i].'</a></span>
					<div class="order"><a href="javascript:" onclick="openUploadImageCat(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')" >&nbsp;Upload Category Image</a></div>
					<div class="order"><a href="javascript:" onclick="openMapEventImagesPage(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')" >&nbsp;Map Event Images</a></div>
					</div>';
					$checked='';
					if($this->is_default[$i]==1)
						$checked='checked=checked';
					$checked2='';
					if($this->looking_for_other_resources_on_parse[$i]==1)
						$checked2='checked=checked';
					$checked3='';
					if($this->extraTableImage[$i]==1)
						$checked3='checked=checked';
					$data.='<div class="rightBoxHp">
					<div class="order">'.$formHtml->radioButton('isDefault','isDefault','',' onchange="setDefaultCat(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')"',$lang->is_default_lang,$checked,'').'</div>
						<div class="order">'.$formHtml->textBox('orderId_'.md5($secureValue.$this->id[$i]),'orderId_'.md5($secureValue.$this->id[$i]),6,'onblur="updateOrderCat(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')"',$this->order_list[$i]).'</div>
						<div class="order">'.$formHtml->checkBox('other_resource_parser_'.md5($secureValue.$this->id[$i]),'other_resource_parser_'.md5($secureValue.$this->id[$i]),6,'onclick="other_resource_parser(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')"',$lang->other_resource_parse_lang,$checked2,'','1').'</div>
						<div class="order">'.$formHtml->checkBox('extraTableImage'.md5($secureValue.$this->id[$i]),'extraTableImage'.md5($secureValue.$this->id[$i]),6,'onclick="extraTableImage(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')"',$lang->extraTableImage_lang,$checked3,'','1').'</div>

					</div></div>';
				}
			}else
			{
				$data.='<div class="regRecords">No data Found</div>';
			}
			return $data;
		}
		/*	
			get sub categorise
		*/
		function getCategorySub($root,$secure)
		{
			global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
			if(md5($secureValue.$root)!=$secure)
				return 'Error in passing Values';
			$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','title,root,id,order_list','',' where root='.$root);
			$data='<div class="regRecords"><div class="regRecordsLabel">Category Name</div><div class="regRecordsLabel">'.$formHtml->textBox('categoryName','categoryName','24','js','','textInput').'</div><div>'.$formHtml->button('saveCat','saveCat','Save','onclick=saveCategorySub(\''.$root.'\',\''.$secure.'\')','buttonClass').'</div></div>';
			if($catList>0)
			{
				for($i=0;$i<$catList;$i++)
				{
					$data.='<div class="recordRow"><div class="leftBoxHp"><span class="lablePlay"><a href="javascript:" onclick="viewSubCat(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')">'.$this->title[$i].'</a></span>
					<div class="order"><a href="javascript:" onclick="openUploadImageCat(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')" >&nbsp;Upload Image</a></div></div>';
					
					$data.='<div class="rightBox"><div class="order">'.$formHtml->textBox('orderId_'.md5($secureValue.$this->id[$i]),'orderId_'.md5($secureValue.$this->id[$i]),6,'onblur="updateOrderCat(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\')"',$this->order_list[$i]).'</div>
					</div></div>';
				}
			}else
			{
				$data.='<div class="regRecords">No data Found</div>';
			}
			return $data;
		}
		
		function saveCategorySub($name,$id,$secure)
		{
			global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
			if(md5($secureValue.$id)!=$secure)
				return 'Error in passing Values';
			$name=$this->simpleFilterInput($name);
			$array=array('root'=>$id,'title'=>$name);
			$insert=$this->insertQuery($tabelPrefix.'taxonmy_category',$array);
			$lastId=$this->lastInsertedrow;
			if($lastId>0)
			{
				$data='<div>Category Added to table</div>';
				return $data;
			}
		}
		/* setDefaultCat*/
		function setDefaultCat($id,$secure)
		{
			global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
			if(md5($secureValue.$id)!=$secure)
				return 'Error in passing Values';
			$name=$this->simpleFilterInput($name);
			$array=array('is_default'=>0);
			$insert=$this->updateQuery($tabelPrefix.'taxonmy_category',$array,'');

			$array=array('is_default'=>1);
			$insert=$this->updateQuery($tabelPrefix.'taxonmy_category',$array,' where id='.$id);
			return $data;
		}
		/* setDefaultCat*/
		function updateOrderCat($id,$secure,$order)
		{
			global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
			if(md5($secureValue.$id)!=$secure)
				return 'Error in passing Values';
			$name=$this->simpleFilterInput($name);
			$array=array('order_list'=>$order);
			$insert=$this->updateQuery($tabelPrefix.'taxonmy_category',$array,' where id='.$id);
			return $data;
		}
		/*	other_resource_parser*/
		function other_resource_parser($id,$secure)
		{
			global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
			if(md5($secureValue.$id)!=$secure)
				return 'Error in passing Values';
			$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','looking_for_other_resources_on_parse','',' where id='.$id);
			if($this->looking_for_other_resources_on_parse[0]==0)
				$v=1;
			else
				$v=0;
			$array=array('looking_for_other_resources_on_parse'=>$v);
			$insert=$this->updateQuery($tabelPrefix.'taxonmy_category',$array,' where id='.$id);
			return $data;

		}
		/*	other_resource_parser*/
		function extraTableImage($id,$secure)
		{
			global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
			if(md5($secureValue.$id)!=$secure)
				return 'Error in passing Values';
			$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','extraTableImage','',' where id='.$id);
			if($this->extraTableImage[0]==0)
				$v=1;
			else
				$v=0;
			$array=array('extraTableImage'=>$v);
			$insert=$this->updateQuery($tabelPrefix.'taxonmy_category',$array,' where id='.$id);
			return $data;

		}
		/*	save catehory*/
		function saveCategory($name)
		{
			global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$eventImagesPath;
;
			$name=$this->simpleFilterInput($name);
			$array=array('root'=>0,'title'=>$name);
			$insert=$this->insertQuery($tabelPrefix.'taxonmy_category',$array);
			$lastId=$this->lastInsertedrow;
			if($lastId>0)
			{
				$data='<div>Category Added to table</div>';
				$this->createTableMainCategory($lastId);
				mkdir($eventImagesPath.$lastId);
				return $data;
			}
			
		}
		/* form to allow user upload files */
		function newUploadFileJquery()
		{
			unset($data);
			global $userLoggedSession,$tabelPrefix,$lang,$formHtml;
			$data=$formHtml->openForm('post','#','uploadMp3','uploadMp3','');
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->file_lable_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$formHtml->textBox('file_lable','file_lable','50','','','textInput','').'<span class="errorFiled" id="file_lable_required">'.$lang->file_lable_require_lang.'</span></div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->file_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$formHtml->imageUpload('file_upload','file_upload','multiple').'</div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$formHtml->submit('submit','submit',$lang->upload_lang,'','buttonClass').'&nbsp;'.$formHtml->resetButton('reset','reset',$lang->reset_lang,'','buttonClass').'</div>';
					$data.='<div id="uploadingFileResult"  class="noticePargrapheUploading"></div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecords"><span  class="noticePargrapheHeader">'.$lang->notice_header_lang.'</span></div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="noticePargraphe">'.$lang->notice_upload_area_lang.'</div>';
				$data.='</div>';
				$data.=$formHtml->closeForm();
				return $data;

		}
			/*
			profile
			*/
			function getProfile()
			{
				unset($data);
				global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
				$userId=$_SESSION[$userLoggedSession];
				$q=$this->selectQuery($tabelPrefix.'users_admin','user_full_name,user_email,user_dob,user_imagepath','',' where userId='.$userId);
				if($q==1)
				{
					$getCountry=$this->dataBaseCountry(' and country_id='.$this->user_country[0]);
				$data='';
				
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->full_name_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$this->user_full_name[0].'</div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->email_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$this->user_email[0].'<span class="warningFiled" >'.$lang->on_one_can_access_this_lang.'</span></div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->gender_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$this->genderArray[$this->user_gender[0]].'</div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->country_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$this->country_lable[0].'<span class="warningFiled" >'.$lang->on_one_can_access_this_lang.'</span></div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->age_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.(date('Y')-$this->user_dob[0]).'</div>';
				$data.='</div>';
				
				$data.='<div class="regRecords">';
				$data.='<div class="MenuProfile  whiteLink first"><a href="profile.php?'.$this->user_full_name[0].'&pId='.$userId.'&secondPath='.md5($secureValue.$userId).'" title="'.$lang->how_people_see_my_profle_lang.'" class="blackLink">'.$lang->how_people_see_my_profle_lang.'</a></div>';
				$data.='</div>';
				
				$data.='<div class="regRecords">';
				$data.='<div class="MenuProfile  blackLink second">'.$lang->following_voices_lang.''.$this->getFollowingTotal($userId).'</div></div>';
				$data.='<div class="regRecords">';
				$data.='<div class="MenuProfile  blackLink  third">'.$lang->following_this_voices_lang.' '.$this->getTotalFollowedByThis($userId).'</div></div>';
				
				$data.='<div class="regRecords">';
					$data.='<div class="MenuProfile  whiteLink fourth"><a href="stream.php" title="'.$lang->my_records_stream_lang.'" class="blackLink">'.$lang->my_records_stream_lang.'</a></div>';
				$data.='</div>';
				
				$data.='<div class="regRecords">';
					$data.='<div class="MenuProfile  whiteLink fifth"><a href="?logout=true" title="'.$lang->logout_text_lang.'" class="blackLink">'.$lang->logout_lang.'</a></div>';
				$data.='</div>';
				
				$data.='</div>';
				
				
				
				}
				else
				{
				$data.='<div class="regRecords">';
					$data.='<div class="">'.$lang->session_expire_lang.' <a href="?logout=true" >'.$lang->click_here.'</a></div>';
				$data.='</div>';
				}
				return $data;
			}
			
			
			function parserList()
			{
				global $userLoggedSession,$secureValue;
				$uploaddir = 'uploads/'.md5($secureValue.$_SESSION[$userLoggedSession]).'/';
				        if (@opendir($uploaddir) !== false) {
				$content = array();
				$dir = opendir($uploaddir);
				//@chmod($userFolderPath.$checkfolder,'0777');
				while ($read = readdir($dir)) {
				if ($read != '.' && $read != '..') {
					$content[] = $read;
				}
				}
				$data='';
				if(sizeof($content)>0)
				{
					$data='';
					for($i=0;$i<sizeof($content);$i++)
					{
							$data.='<div><a href="openFile.php?filename='.$content[$i].'">'.$content[$i].'</a></div>';
					}
					return $data;
				}
				else
				{
					return 'NO files Exist ';	
				}
			}
			}
			
			function openFile($fileName)
			{
				global $userLoggedSession,$secureValue;
				$uploaddir = 'uploads/'.md5($secureValue.$_SESSION[$userLoggedSession]).'/';
				        if (@opendir($uploaddir) !== false) {
				$content = array();
				$dir = opendir($uploaddir);
				//@chmod($userFolderPath.$checkfolder,'0777');
				while ($read = readdir($dir)) {
				if ($read != '.' && $read != '..') {
					$content[] = $read;
				}
				}
			}
				if(sizeof($content)>0)
				{
					$data='';
					for($i=0;$i<sizeof($content);$i++)
					{
						if($content[$i]==$fileName)
						{
							return $this->parserView($uploaddir.$fileName);
							break;
						}
							$data.='<div><a href="openFile.php?filename='.$content[$i].'">'.$content[$i].'</a></div>';
					}
					return $data;
				}
			
			}
			
			function parserView($path)
			{
				global $formHtml;
				if(@(int)$_GET['catSelctedValue']!=0)
					return $this->insertParser();
						$data= " <div> <strong>Impoarting data for ".$path."</strong></div>";
						// load the class file
						require_once 'XML2003Parser.php';
						
						// instantiate new object
						$excel = new XML2003Parser($path);
						//$excel->loadXMLFile('example.xml'); -> unnecessary since file is already loaded on construct (see line above)
						
						// get array of the table
						$table = $excel->getTableData();
						
						// display instruction
						// print as HTML table
						$query=' ';
						
						
						$data.=  "<table border=1>";
						$x=0;
						foreach($table["table_contents"] as $row){
						$k=0;
						$data.=  "<tr>";
						$query.='(';
						foreach($row["row_contents"] as $cell){
						
						$data.=  "<td>";
						$data.=  $cell["value"];
						$data.=  "</td>";
						$cell["value"]=str_replace("'",'`',$cell["value"]);
						$cell["value"]=str_replace('"','`',$cell["value"]);
						$k++;
						}
						//	echo $query.'<br/>';
						//mysql_query($query);
						$data.=  "</tr>";
						$x++;
						} 
						//echo $query;
						$data.=  "</table>";
						$data.='<div id="Tab____category">'.$this->categorySelection().'</div>';
						$data.='<div class="regRecords"><div>'.$formHtml->button('saveCat','saveCat','Save','onclick=insertDataParser(\''.$_GET['filename'].'\')','buttonClass').'</div></div>';
						return $data;
			}
			
			/*
				recursive function for getting root table id 
			*/
			function getTableRoot($catId)
			{
					global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
					$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','id,root','',' where id='.$catId,'');	
						if($this->root[0]==0)
							return $this->id[0];
						else
							return $this->getTableRoot($this->root[0]);
						
			}
			function insertParser()
			{
				global $userLoggedSession,$secureValue,$tabelPrefix;
				$path = 'uploads/'.md5($secureValue.$_SESSION[$userLoggedSession]).'/'.$_GET['filename'];
				//$catSelctedValue=(int)$_GET['catSelctedValue'];
				$catId=(int)$_GET['catSelctedValue'];;
				$catSelctedValue=$this->getTableRoot($catId);
				
				$looking_for_other_resources_on_parse=(int)$_GET['looking_for_other_resources_on_parse'];
						require_once 'XML2003Parser.php';
						$excel = new XML2003Parser($path);
						$table = $excel->getTableData();
						
						$tableName=$tabelPrefix.'events_'.$catSelctedValue.'_current';
						$tableNameInfo=$tabelPrefix.'events_'.$catSelctedValue.'_info';
						
						//if((int)$_GET['subSelectedValue']!=0)
						//	$catSelctedValue=(int)$_GET['subSelectedValue'];
						
						$data=  "<table border=1>";
						$x=0;
						
						foreach($table["table_contents"] as $row){
							$randomMappedKey=rand(0,1000)+((rand(0,100))*$x)+rand(0,1000);
							$query=" insert into ".$tableName."  (start_date,end_date,other_id,other_id_2,event_location,cat_id,event_mapped_key)";
							$query2=" insert into ".$tableNameInfo." (mapped_key,title_ar,description_ar,title_en,description_en)";
							$query2.=" values (".$randomMappedKey;
						$k=0;
						$data.=  "<tr>";
						$query.=' values (';
						$startTime1=0;
						foreach($row["row_contents"] as $cell){
						$cell["value"]=str_replace("'",'`',$cell["value"]);
						$cell["value"]=str_replace('"','`',$cell["value"]);
							//$stTime=
							if($k==0)//date
							{
								$v=explode('T',$cell["value"]);
								$startTime1=strtotime($v[0]);
							}
							if($k==1)//start hours
							{
								$startTime=$startTime1+($cell["value"]*60*60);
							}
							if($k==2)//start minutes
							{
								$startTime=$startTime+$cell["value"]*60;
								$query.=$startTime;
							}
							//duration
							if($k==3)
							{
								$endTime=$startTime+$cell["value"]*60;
								$query.=','.$endTime;
							}
							
							if($k==4)
							{
								$titleAr=$cell["value"];
								$query2.=',"'.$titleAr.'"';
							}
							if($k==5)
							{
								$descriptionAr=$cell["value"];
								$query2.=',"'.$descriptionAr.'"';
							}
							if($k==6)
							{
								$titleEn=$cell["value"];
								$query2.=',"'.$titleEn.'"';
							}
							if($k==7)
							{
								$descriptionEn=$cell["value"];
								$query2.=',"'.$descriptionEn.'"';
							}
							if($k==8)
							{
								$otherSource1=$cell["value"];
								$query.=','.$otherSource1;
							}
							if($k==9)
							{
								$otherSource2=$cell["value"];
								$query.=','.$otherSource2;
							}
							if($k==10)//location
							{
								$event_location=$cell["value"];
								$query.=',"'.$event_location.'"';
							}
								
						$data.=  "<td>";
						$data.=  $cell["value"];
						$data.=  "</td>";
						
						$k++;
						}
						$query.=' ,'.$catId.','.$randomMappedKey.')';
						$query2.=')';
						//$data.=$query;
						if( mysql_query($query) &&	mysql_query($query2))
							$data.='<td>Done</td>';
						else
							$data.='<td>Error '.mysql_error().'</td>';
						//$data.=$query2;
						$data.=  "</tr>";
						$x++;
						} 
						$data.='<tr><td><a href="mapKeys.php?catId='.$catSelctedValue.'&looking_for_other_resources_on_parse='.$looking_for_other_resources_on_parse.'">Next Step</a></td></tr>';
						$data.=  "</table>";
						return $data;
			}
			
			/*	mapKeys after inserting the data from the XML files */
			function mapKeys($catId,$looking_for_other_resources_on_parse)
			{
					global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
					
					$tableName=$tabelPrefix.'events_'.$catId.'_current';
					$tableNameInfo=$tabelPrefix.'events_'.$catId.'_info';
					$catList=$this->selectQuery($tableNameInfo,"title_en",'',' ','DISTINCT');
					$j=0;
					foreach($this->title_en as $titles)
					{
						$allInformation=$this->selectQuery($tableNameInfo,'mapped_key','',' where title_en="'.$this->title_en[$j].'"','');
						$fixedKey=$this->mapped_key[0];////default fixed key 
						$replacedKeys=implode(',',$this->mapped_key);
						mysql_query(" update ".$tableName." set event_mapped_key=".$fixedKey." where event_mapped_key in (".$replacedKeys.") ");
						mysql_query(" delete from ".$tableNameInfo." where title_en='".$this->title_en[$j]."' and mapped_key<>".$fixedKey);
						$j++;
					}
					//////this is importantttttttttttt data 
					if($looking_for_other_resources_on_parse==1)
					{
						$tableOtherSource=$this->selectQuery($tabelPrefix.'taxonmy_category','table_for_titles_source','',' where id='.$catId,'');	
						$tableOtherSource=$this->table_for_titles_source[0];
						$catList=$this->selectQuery($tableNameInfo,'mapped_key','',' ','DISTINCT');
						$j=0;
						foreach($this->mapped_key as $mapped_key)
						{
							$newTitle='';
							$allInformation=$this->selectQuery($tableName,'other_id,other_id_2','',' where event_mapped_key="'.$this->mapped_key[$j].'"',' ','  limit 0,1');
							$tableOtherSourceq=$this->selectQuery($tableOtherSource,'team_name','',' where team_id ='.$this->other_id[0],'');
							$newTitle=$this->team_name[0].' Vs ';
							$tableOtherSourceq=$this->selectQuery($tableOtherSource,'team_name','',' where team_id ='.$this->other_id_2[0],'');	
							$newTitle.=$this->team_name[0];
							mysql_query(" update ".$tableNameInfo." set title_en='".$newTitle."' where mapped_key='".$this->mapped_key[$j]."'");
							//echo " update ".$tableNameInfo." set title_en='".$newTitle."' where mapped_key='".$this->mapped_key[$j]."'";
								$j++;
						}
					}
				

					return 'Done...... just click <a href="index.php">here...</a>';
			}
			
			
			
			
			
			
			
			function categorySelection()
			{
					global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
					$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','title,root,id,looking_for_other_resources_on_parse','','where root=0 ');
					
					if($catList>0)
					{
						$data='';
						for($i=0;$i<$catList;$i++)
						{
							$data.='<div class="recordRow"><div class="leftBoxHp"><span class="lablePlay"><input type="radio" name="selectedCat" id="selectedCat" value="'.$this->id[$i].'" onclick="setCatValue(\''.$this->id[$i].'\',\''.$this->looking_for_other_resources_on_parse[$i].'\')"><a href="javascript:" onclick="viewSubCatcategorySelection(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\',\''.$this->looking_for_other_resources_on_parse[$i].'\')">'.$this->title[$i].'</a></span></div></div>';
						}
					}else
					{
						$data='<div class="regRecords">No data Found</div>';
					}
					return $data;
			}
			function viewSubCatcategorySelection($root,$secure,$looking_for_other_resources_on_parse)
			{
				global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue;
				if(md5($secureValue.$root)!=$secure)
					return 'Error in passing Values';
				$catList=$this->selectQuery($tabelPrefix.'taxonmy_category','title,root,id','',' where root='.$root);
									$data='';

				if($catList>0)
				{
					$data='';
					for($i=0;$i<$catList;$i++)
					{
						$data.='<div class="recordRow"><div class="leftBoxHp"><span class="lablePlay"><input type="radio" name="selectedCat" id="selectedCat" value="'.$this->id[$i].'"  onclick="setCatValue(\''.$this->id[$i].'\',\''.$looking_for_other_resources_on_parse.'\')"><a href="javascript:" onclick="viewSubCatcategorySelection(\''.$this->id[$i].'\',\''.md5($secureValue.$this->id[$i]).'\',\''.$looking_for_other_resources_on_parse.'\')">'.$this->title[$i].'</a></span></div></div>';
					}
				}else
				{
					$data.='<div class="regRecords">No data Found</div>';
				}
				return $data;
			}
			/* updateEventImage */
			function updateControlTitles($filed,$mappedKey,$value,$tableIndex)
			{
				global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue,$eventImagesPath;
				$array=array($filed=>$value);
				$this->updateQuery($tabelPrefix.'events_'.$tableIndex.'_info',$array,' where mapped_key='.$mappedKey);
				return true;
			}
			/* updateEventImage */
			function updateEventImage($mappedKey,$imageName,$tableIndex)
			{
				global $userLoggedSession,$tabelPrefix,$lang,$formHtml,$secureValue,$eventImagesPath;
				$uploaddir=$eventImagesPath.'/temp/';
				$array=array('image'=>$imageName);
				$this->updateQuery($tabelPrefix.'events_'.$tableIndex.'_info',$array,' where mapped_key='.$mappedKey);
				copy($uploaddir.$imageName,$eventImagesPath.$tableIndex.'/'.$imageName);
				return true;
			}
			function updateChannelImage($value,$channelId)
			{
				global $tabelPrefix;
				$array=array('logo'=>$value);
				$this->updateQuery($tabelPrefix.'channel_list',$array,' where channel_id='.$channelId);
				return true;
			}
			
			function updateChannelName($value,$channelId,$pre)
			{
				global $tabelPrefix;
				$lable='name_'.$pre;
				$array=array($lable=>$value);
				$this->updateQuery($tabelPrefix.'channel_list',$array,' where channel_id='.$channelId);
				return true;
			}
	}
	
?>
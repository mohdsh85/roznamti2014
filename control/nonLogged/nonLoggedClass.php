<?
	class nonLoggedClass extends generalClass
	{
		function buildMainBox()
		{
			global $lang,$justFloat;
			unset($data);
			$data='
			 <div class="ionTabs" id="tabs_1" data-name="">
				<ul class="ionTabs__head">
					<li class="ionTabs__tab" data-target="RecentRecords">'.$lang->recent_added_lang.'</li>
					<li class="ionTabs__tab" data-target="mostHeard" >'.$lang->most_liked_lang.'</li>
					<li class="ionTabs__tab" data-target="login"  style="float:'.$justFloat.'">'.$lang->login_now_lang.'</li>
					<li class="ionTabs__tab" data-target="register" style="float:'.$justFloat.'">'.$lang->register_lang.'</li>
				</ul>
				
				<div class="ionTabs__body">
				<div class="ionTabs__item" data-name="RecentRecords" style="height:1000px">
								<div  id="RecentAddedRecords" class="tabContentData">
										<input type="hidden" name="offsetRecords" id="offsetRecords" value="1" />'.$this->recent_added_record(1).'
										</div>
						</div>
				<div class="ionTabs__item" data-name="mostHeard"  style="height:1500px" >
				<div  class="tabContentData">
								'.$this->mostLiked().'
				</div>
				</div>
				<div class="ionTabs__item" data-name="login">
										<div  class="tabContentData">
'.$this->loginData().'</div>
				</div>
				<div class="ionTabs__item setHeight" data-name="register" id="registerBox">'.$this->registerNewUser().'</div>
				
				<div class="ionTabs__preloader"></div>
				</div>
				</div>';
	return $data;
		}
			/*loginData*/
			function loginData()
			{
				unset($data);
				global $lang,$formHtml;
				
				$data=$formHtml->openForm('post','','registerForm','registerForm','');
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->email_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$formHtml->textBox('user_email_loggin','user_email_loggin','50','','','textInput','').'<span class="errorFiled" id="error_user_email_loggin">'.$lang->please_fill_lang.' '.$lang->email_lang.'</span></div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->password_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$formHtml->passwordBox('user_password_loggin','user_password_loggin','50','','','textInput','').'<span class="errorFiled" id="error_min_user_password_loggin">'.$lang->min_password_six_char_lang.'</span></div>';
				$data.='</div>';
				
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">&nbsp;</div>';
					$data.='<div class="regRecordsInput" >'.$lang->keep_me_logged_lang.''.$formHtml->checkbox('keep_me_logged','keep_me_logged','','value=1','','').' | <a href="javascript:" onclick="resetPassword(\''.$lang->reset_password_lang.'\',\''.$lang->email_lang.'\',\''.$lang->please_fill_lang.' '.$lang->email_lang.'\')">'.$lang->forgot_password_lang.'</a></div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$formHtml->button('login','login',$lang->login_now_lang,'onclick="loginNow()"','buttonClass').'&nbsp;'.$formHtml->resetButton('reset','reset',$lang->reset_lang,'','buttonClass').'</div>';
					$data.='<div id="loginResult"  class="loadingFiled"><img src="img/preloader-flat.gif" border=0 width="32" height="10" /></div>';
				$data.='</div>';
				
				$data.=$formHtml->closeForm();
				return $data;
			}
			/*do login */
			function checkLogin()
			{
				global $tabelPrefix,$lang,$userLoggedSession,$secureValue;
					ob_start();

				$userEmail=$this->filterInput($_POST['user_email']);
				$userPassword=$this->filterInput($_POST['user_password']);
				if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $userEmail)) 
					return $lang->error_mail_format_lang;//check mail validity
			$user_password=md5($secureValue.$userPassword);
                $user_password=($userPassword);
			//echo $user_password;
			$checkLogin=$this->selectQuery($tabelPrefix.'users_admin','userId','',' where user_email="'.$userEmail.'" and user_password ="'.$user_password.'"');
			if($checkLogin==1)
			{
				$this->createSession($userLoggedSession,$this->userId[0]);
				if($_POST['keep_me_logged']==1)
				{
					$this->createSession('keepMelooged',$this->userId[0]);
				}
					ob_flush();

				return 1; 
			}
			else
				return $lang->invalid_user_name_or_password_lang; 
			}
			/* get user activity profle */
			function getActivityUser($userId,$allowDelete='')
			{
			global $sitePath,$lang,$tabelPrefix,$recordPerPage,$secureValue;
			
			//$offset=(int)$offset;
			//$limit='  '.$this->limit($offset,$recordPerPage);
			//selectQuery($table_name='',$field='',$index='',$where='',$DISTINCT='',$limit='',$ordering='')
			$mainQ=$this->selectQuery($tabelPrefix.'users_uploaded_files','file_label,file_id,user_uplaoded_name,file_path,file_posted_date,user_uploaded_id','',' where file_status=0 and user_uploaded_id='.$userId,' ','','  order by file_posted_date DESC');
			$j=0;
			$data='';
			$data='<div class="boxLable">'.$lang->activity_lang.'</div>';
			if($mainQ>0)
			{
				foreach($this->file_id as $index)
				{
					$data.=$this->buildRecordDesign($this->file_label[$j],$this->file_id[$j],$this->user_uplaoded_name[$j],$this->file_path[$j],$this->file_posted_date[$j],$this->user_uploaded_id[$j],'true','');

				$j++;
				}
			}else
			{
					$data.='<div class="regRecords">';
						$data.='<div class="regRecordsLabel"></div>';
						$data.='<div class="regRecordsInput">'.$lang->no_records_uploaded_yet_lang.'</div>';
					$data.='</div>';
			}

return $data;
			}
					///get social links and file rating 
		function buildProfileSocialBox($uId)
		{
			global $lang,$tabelPrefix;
			$data='<div class="userRatingProfile">'.$this->getUserRatingLableImage($uId).'</div>';
			$data.='<div class="shareTextProfile">'.$lang->share_this_profile_on_lang.'</div>';
			$data.=$this->socialMediaLinks('profile.php?spId='.$uId);
			$data.=$this->followUnFollow($uId,md5(rand(100,1000)));
			//$checkOwner=$this->selectQuery($tabelPrefix.'users','user_full_name','',' where userId='.$uId);
			$data.='<div class="followingTotal">'.$lang->following_voices_lang.''.$this->getFollowingTotal($uId).'</div>';
			//"'.$this->user_full_name[0].'" 
			$data.='<div class="followingTotal">'.$lang->following_this_voices_lang.' '.$this->getTotalFollowedByThis($uId).'</div>';
			return $data;
		}
		function fileBasicInformation($fileId)
		{
			global $sitePath,$lang,$tabelPrefix,$recordPerPage,$secureValue;
			$mainQ=$this->selectQuery($tabelPrefix.'users_uploaded_files','file_label,user_uplaoded_name,file_path,file_posted_date,user_uploaded_id','',' where file_status=0 and file_id='.$fileId,' ','','  order by file_posted_date DESC');
			$j=0;
			$data='';
			$data='<div class="boxLable">'.$lang->activity_lang.'</div>';
			if($mainQ==1)
			{
					$data.='<div class="recordRow" id="del_'.md5($secureValue.$fileId).'">';
					$data.=$this->buildRecordDesign($this->file_label[$j],$fileId,$this->user_uplaoded_name[$j],$this->file_path[$j],$this->file_posted_date[$j],$this->user_uploaded_id[$j],'','true');
						$data.='</div>';


			}else
			{
					$data.='<div class="regRecords">';
						$data.='<div class="regRecordsLabel"></div>';
						$data.='<div class="regRecordsInput">'.$lang->no_records_uploaded_yet_lang.'</div>';
					$data.='</div>';
			}

return $data;
			}
					/* function mostLiked*/
		function mostLiked()
		{
			global $sitePath,$lang,$tabelPrefix,$recordPerPage,$secureValue;
			//selectQuery($table_name='',$field='',$index='',$where='',$DISTINCT='',$limit='',$ordering='')
			$mostlikedVoices=$this->selectQuery($tabelPrefix.'record_likes','record_file_id','',' where record_total_like<>0','  ','limit 0,10','  order by record_total_like DESC ');
			if($mostlikedVoices>0)
				$showingIds=implode(',',$this->record_file_id);
			else
				return $lang->no_records_uploaded_yet_lang;
			$mainQ=$this->selectQuery($tabelPrefix.'users_uploaded_files','file_label,file_id,user_uplaoded_name,file_path,file_posted_date,user_uploaded_id','',' where file_id in  ('.$showingIds.') ',' ','',' ');
			$j=0;
			$data='';
			if($mainQ>0)
			{
				foreach($this->file_id as $index)
				{
			$data.=$this->buildRecordDesign($this->file_label[$j],$this->file_id[$j],$this->user_uplaoded_name[$j],$this->file_path[$j],$this->file_posted_date[$j],$this->user_uploaded_id[$j]);

					$j++;
				}
			}

return $data;
		}
		/*
			request to reset password 
		*/
		function resetPassword()
		{
			global $sitePath,$lang,$tabelPrefix,$recordPerPage,$secureValue;
			$user_email=$this->filterInput($_POST['user_email']);
			$num1=$this->filterInput($_POST['num1']);
			$num2=$this->filterInput($_POST['num2']);
			$validateSum=$this->filterInput($_POST['validateSum']);
			if(($num1+$num2)==$validateSum)
			{
				if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $user_email)) 
					return $lang->error_mail_format_lang;//check mail validity
					$checkMail=$this->selectQuery($tabelPrefix.'users','userId','',' where user_email="'.$user_email.'"','  ','',' ');
					if($checkMail==1)
					{
						$token=md5(md5($secureValue.$this->userId[0]));
						$values=array('userRequestdId'=>$this->userId[0],'tokenValue'=>$token);
						$checkOldRequest=$this->selectQuery($tabelPrefix.'users_password_reset','userRequestdId','',' where userRequestdId="'.$this->userId[0].'"','  ','',' ');
						if($checkOldRequest==0)///if no old request
							$this->insertQuery($tabelPrefix.'users_password_reset',$values);
						$body='<a href="'.$sitePath.'forgotPassword.php?token='.$token.'">Click here </a>';
						$this->resetPasswordMail($user_email,$body);///mailing user to with reseted link
						return $lang->check_your_mail_to_reset_password_lang;
					}else
					return ' '.$lang->not_registerd_email_lang.' <a href="javascript:" onclick="openRegisterFormTab()">'.$lang->register_lang.'</a>';
			}else
				return 'error in numbers!!!! please validate your JavaScript';
		}
		/*
			update the rested password
		*/
		function updateResetedPassword()
		{
			global $sitePath,$lang,$tabelPrefix,$recordPerPage,$secureValue;
			$user_password=$this->filterInput($_POST['user_password']);
			$confirm_password=$this->filterInput($_POST['confirm_password']);
			$token=$this->filterInput($_POST['token']);
			$q=$this->selectQuery($tabelPrefix.'users_password_reset','userRequestdId',' ',' where tokenValue="'.$token.'"');
			if($user_password==$confirm_password)
			{
				if($q==1)
				{
					$this->deleteQuery($tabelPrefix.'users_password_reset',' where tokenValue="'.$token.'"');
					$array=array('user_password'=>md5($secureValue.$user_password));
					$this->updateQuery($tabelPrefix.'users',$array,' where userId='.$this->userRequestdId[0]);
					return $lang->password_updated_lang.' &nbsp;';
				}else
				return $lang->this_token_expire_or_updates;
			}else
			{
				return 'please validate your JavaScript';
			}
		}
		///send mail to reset password 
		function resetPasswordMail($to,$body)
		{
			global $lang;
			$mailText.='<div style="width:100%;text-align:left">'.$lang->reset_password_mail_text.'</div>';
			$mailText.='<div style="width:100%;text-align:left">'.$body.'</div>';
			$mailText.='<div style="width:100%;text-align:left">'.$lang->thanks_lang.'</div>';
			$mailText.='<div style="width:100%;text-align:left">'.$lang->domain_name.'</div>';
			$this->mailing($to,$lang->reset_password_lang,$mailText);
		}
		function ContactUsFor()
		{
			global $sitePath,$lang,$tabelPrefix,$recordPerPage,$secureValue,$ownerMail;
			$user_email=$this->filterInput($_POST['user_email']);
			$num1=$this->filterInput($_POST['num1']);
			$num2=$this->filterInput($_POST['num2']);
			$message=$this->filterInput($_POST['message']);
			$validateSum=$this->filterInput($_POST['validateSum']);
			if(($num1+$num2)==$validateSum)
			{
				if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $user_email)) 
					return $lang->error_mail_format_lang;//check mail validity
				
						global $lang;
						$mailText.='<div style="width:100%;text-align:left">'.$lang->contact_us_lang.'</div>';
						$mailText.='<div style="width:100%;text-align:left">'.$message.'</div>';
						$mailText.='<div style="width:100%;text-align:left">From: '.$user_email.'</div>';
						$this->mailing($ownerMail,$lang->contact_us_lang,$mailText);
						return $lang->thanks_for_contact_us_lang;
			}else
				return 'error in numbers!!!! please validate your JavaScript';
		}
	}
	
?>
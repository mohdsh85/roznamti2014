<?
	/*
		copyrights reserved for www.roznamti.com
		2012-2013
		IT department 
		u general class used for main functions that may use anywhere on the system 
	*/
	
class generalClass extends mysql 

{
	var  $userLoggedId;
	var $userLoggedLang;
	var $userLoggedCountry;
	var $userName;
	function generalClass()
	{
		global $lang,$userLoggedSession,$tabelPrefix;
		if(@$_SESSION[$userLoggedSession]!='')
		{
			$q=$this->selectQuery($tabelPrefix.'users_admin','user_full_name,user_email','',' where userId='.$_SESSION[$userLoggedSession],'','','');
			$this->userName=$this->user_full_name[0];
			$this->userEmail=$this->user_email[0];
		}
	}
	/*
		get quick access function to filter homepage
	*/
	function getQuickAccess()
	{
		global $tabelPrefix;
		$q=$this->selectQuery($tabelPrefix.'quick_access','url,image','',' ','','',' ');
		if($q>0)
		{
			$data='';
			for($i=0;$i<$q;$i++)
			{
				$data.='<li><div><a href="'.$this->url[$i].'"><img src="'.$this->image[$i].'" width="60px" height="60px" border="0" /></a></div></li>';
			}
			return $data;
		}
		
	}

	/* roznamti new design */
	function navigation()
	{
		$data='';
		global $tabelPrefix,$currentCat,$secureKey,$lang,$langPrefix;
        if(!isset($_GET['catId']))
            $_GET['catId']=0;
		$innerPageCat=(int)$_GET['catId'];
		$q=$this->selectQuery($tabelPrefix.'taxonmy_category','id,root,title,table_for_sub_cat,table_for_sub_cat_box_2,no_keyword_search','',' where root=0 and showing=1 ','','',' order by order_list ASC ');
		$data=' <ul class="Navigation">';
		$lableFour=$lableFourSelected=$lang->lable_lable_4;
		$lableFive=$lableFiveSelected=$lang->lable_lable_5;
		$lableSix=$lableSixSelected=$lang->lable_lable_6;
			$data.='<li> <a href="index.php" >Home</a></li>';
			if($langPrefix=='en')
			$data.='<li> <a href="index.php?lang=ar" >ar</a></li>';
			else
			$data.='<li> <a href="index.php?lang=en" >en</a></li>';
       // print_r($q);
        if($q>0)
        {
            for($i=0;$i<sizeof($this->title);$i++)
            {
                $class='';

                $labelOne=$lang->{$this->title[$i].'_lable_1'};
                $lableTwo=$lableTwoSelected=$lang->{$this->title[$i].'_lable_2'};
                $lableThree=$lableThreeSelected=$lang->{$this->title[$i].'_lable_3'};
                if($currentCat==$this->id[$i])
                {
                    $class='class=current';
                    if($_GET['keywordValue']!='')
                        $labelOne=$_GET['keywordValue'];
                    if($_GET['tags']!='')
                        $lableTwoSelected=$_GET['tags'];
                    if($_GET['tags2']!='')
                        $lableThreeSelected=$_GET['tags2'];
                    if($_GET['dateFilter']!='')
                        $lableFourSelected=$_GET['dateFilter'];
                    if($_GET['fromTime']!='')
                        $lableFiveSelected=$_GET['fromTime'];
                    if($_GET['toTime']!='')
                        $lableSixSelected=$_GET['toTime'];
                }
                // href="?CategoryType='.$this->title[$i].'&catId='.$this->id[$i].'"
                //index.php?CategoryType='+title+'&catId='+nextCat+'&secureCat='+secureCat+'
                $data.='<li id="'.md5($secureKey.$this->id[$i]).'" onclick="showsearchBox(\''.$this->id[$i].'\',\''.md5($secureKey.$this->id[$i]).'\',\''.$this->title[$i].'\',\''.$this->table_for_sub_cat[$i].'\',\''.md5($this->table_for_sub_cat[$i]).'\',\''.$this->table_for_sub_cat_box_2[$i].'\',\''.md5($this->table_for_sub_cat_box_2[$i]).'\',\''.$this->no_keyword_search[$i].'\',\''.$labelOne.'\',\''.$lableTwo.'\',\''.$lableThree.'\',\''.$lableFour.'\',\''.$lableFive.'\',\''.$lableSix.'\',\''.$innerPageCat.'\',\''.$lableTwoSelected.'\',\''.$lableThreeSelected.'\',\''.$lableFourSelected.'\',\''.$lableFiveSelected.'\',\''.$lableSixSelected.'\',\'1\')" style="display:none"></li>';
                $data.='<li '.$class.' > <a href="index.php?CategoryType='.$this->title[$i].'&catId='.$this->id[$i].'&secureCat='.md5($secureKey.$this->id[$i]).'" >'.$this->title[$i].'</a></li>';
            }
        }

		$data.='</ul>';
		return $data;
	}
	/*
		return result from any table of  result request 
	*/
	function getSearchCatList($table_for_sub_cat,$secureTableForSubCat,$cat)
	{
		global $tabelPrefix,$currentCat,$secureKey,$langPrefix;
		$cat=(int)$cat;
		if(md5($table_for_sub_cat)==$secureTableForSubCat)
		{
			if($table_for_sub_cat=='')
			{
				$q=$this->selectQuery($tabelPrefix.'taxonmy_category','id,title','',' where root='.$cat.' and showing=1 ','','',' order by order_list ASC ');
				return implode(',',$this->title);
				
			}
			if($table_for_sub_cat=='channel_list')
			{
				$nameLab='name_'.$langPrefix;
				$q=$this->selectQuery($tabelPrefix.$table_for_sub_cat,'channel_id,'.$nameLab,'','','','',' order by binary ('.$nameLab.') ASC ');
				return implode(',',$this->{$nameLab});
			}
			if($table_for_sub_cat=='team_list')
			{
				$nameLab='team_name';
				$q=$this->selectQuery($tabelPrefix.$table_for_sub_cat,'team_id,'.$nameLab,'','','','',' order by binary ('.$nameLab.') ASC ');
				return implode(',',$this->{$nameLab});
			}
		}
	}
	
	/*
		return second box result for search from any table of  result request 
	*/
	function getFilterListDataTwo($table_for_sub_cat,$secureTableForSubCat,$cat)
	{
		global $tabelPrefix,$currentCat,$secureKey,$langPrefix;
		$cat=(int)$cat;
		if(md5($table_for_sub_cat)==$secureTableForSubCat)
		{
			if($table_for_sub_cat=='')
			{
				$q=$this->selectQuery($tabelPrefix.'taxonmy_category','id,title','',' where root='.$cat.' and showing=1 ','','',' order by order_list ASC ');
				return implode(',',$this->title);
				
			}
			if($table_for_sub_cat=='cinema_sub_cat')
			{
				$nameLab=$langPrefix.'_name';
				$q=$this->selectQuery($tabelPrefix.$table_for_sub_cat,$nameLab,'','','','',' order by binary ('.$nameLab.') ASC ');
				return implode(',',$this->{$nameLab});
			}
		}
	}
	/*	return the current cat*/
	function getCurrentCat()
	{
		$data='';
		global $tabelPrefix;
		if(isset($_GET['catId']))
			return $_GET['catId'];
		else
			return 0;
		//else
			//$q=$this->selectQuery($tabelPrefix.'taxonmy_category','id','',' where is_default=1 ','','',' ');
		return $this->id[0];
	}


	
	/* return geader view*/
	function headerData()
	{
		global $lang,$userLoggedSession,$secureValue;
		$data='
			<div class="logo" onclick="homePage()">
				&nbsp;
			</div>
			<div><ul id="navigation">';
				if(@$_SESSION[$userLoggedSession]!='')
				{
					$data.='<li>
							<a href="index.php?logout=true" >Logout</a>
							</li>';
					$data.='<li>
							<a href="#" >'.$this->printName($this->userName).'</a>
							</li>';
					$data.='<li>
							<a href="parser.php" >Parser</a>
							</li>
							<li>
							<a href="eEvents.php" >Edit Events</a>
							</li>
					<li>
							<a href="openMapChannelImagesPage.php?id='.$_SESSION[$userLoggedSession].'&secure='.md5($secureValue.$_SESSION[$userLoggedSession]).'" >Map Channels</a>
							</li>
					<li>
							<a href="mapKeys.php?catId=1&looking_for_other_resources_on_parse=0" >TV Map</a>
							</li>
							
							';
				}
				
			$data.='</ul>
		</div>';
	return $data;
	}
	/* return geader view*/
	function footerData()
	{
		global $lang,$arraylanguagesLabels,$arraylanguagesValues;
		$data="<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-32875398-1', 'roznamti.com');
  ga('send', 'pageview');

</script>
";
		$data.= '<div style="text-align:left;font-size:12px">©2012-'.date('Y').' '.$lang->domain_name.'</div>';
        return $data;
		
	}


	function socialMedia($link='')
	{
		$data='';

$data='<ul class="Social">
					 <li class="Search"  style="display:none"> <a href="#">Search</a></li>
                    <li class="Google"> <a target="_blank" href="https://plus.google.com/share?url='.sitePathForLogin.''.$link.'" target="_blank" >Google+</a></li>
                    <li class="facebook"> <a  target="_blank" href="http://www.facebook.com/sharer.php?u='.sitePathForLogin.''.$link.'">Facebook</a></li>
                    <li class="twitter"> <a  target="_blank" href="https://twitter.com/intent/tweet?url='.sitePathForLogin.''.$link.'" target="_blank">Twitter</a></li>
                </ul>
';
	return $data;
	}
	function socialMediaEvents($link='')
	{
		$data='';

			$data='<ul class="SocialShare">
			<li class="Google"> <a  target="_blank" href="https://plus.google.com/share?url='.sitePathForLogin.''.$link.'" target="_blank" >Google</a></li>
			<li class="facebook"> <a  target="_blank" href="http://www.facebook.com/sharer.php?u='.sitePathForLogin.''.$link.'">Facebook</a></li>
			<li class="twitter"> <a  target="_blank" href="https://twitter.com/intent/tweet?url='.sitePathForLogin.''.$link.'" target="_blank">Twitter</a></li>
			</ul>';

	return $data;
	}
	
	function jQueryHP()
	{
		global $secureKey;
		$data='<div id="banner-slide">
                    <ul class="bjqs">
                      <li><a href="index.php?CategoryType=TV&catId=1&secureCat=99ffa6c102c264eac247f9efbe638afc"><img src="html/images/banner01.jpg" title=" " width="816px" height="225px"></a></li>
                      <li><a href="index.php?CategoryType=Cinema&catId=2&secureCat=7ca1dac4bd703a743b06aa426a061775"><img src="html/images/banner02.jpg" title=" " width="816px" height="225px"></a></li>
                      <li><a href="index.php?CategoryType=Football&catId=3&secureCat=5391a3187ea34fb6facfe739c94ec520"><img src="html/images/banner03.jpg" title=" " width="816px" height="225px"></a></li>
                      <li><a href="index.php?CategoryType=Community&catId=26&secureCat=7b9f85ff27697e5289ff57d160c36eed"><img src="html/images/banner04.jpg" title=" " width="816px" height="225px"></a></li>
                      <li><img src="html/images/banner05.jpg" title=" " width="816px" height="225px"></li>
                      <li><a href="index.php?CategoryType=Entertainment&catId=30&secureCat=fb16b0a9c795261db2fb71fcc202edd3"><img src="html/images/banner06.jpg" title=" " width="816px" height="225px"></a></li>
                    </ul>
                </div>';
		return $data;
	}
	//cerate where when user filter on small search then scroll
	function createWhereSmallSeachBox($date='',$from='',$to='')
	{
			if($date=='')
			{
				$date=date('Y-m-d');
			}
			if($from=='')
			{
				$from=date('H:i');
			}
			if($to=='')
			{
				$to=date('H:i',strtotime(date('H:i')+60*60));
			}

			$dFrom=strtotime($date.$from);
			$dTo=strtotime($date.$to);
		$where=' where start_date>="'.$dFrom.'" and end_date<="'.$dTo.'"';
		return $where;
	}
	/*
		build teh event list suggested for the Hp 
	*/
	function eventListHp($page='',$currentCat='',$dateSearched='',$fromTime='',$toTime='')
	{
		$data='';			

		global $tabelPrefix,$dataPerView,$langPrefix;
		if($page=='')
			$page=1;
		if($dateSearched!='')//if user selectet to filter dates on small box then on scroll should read the values on the right bob
		{
			$where=$this->createWhereSmallSeachBox($dateSearched,$fromTime,$toTime);
			$limit=$this->limit($page,50);

		}
		else
		{
			$where='where  start_date >="'.time().'"';
			$limit=$this->limit($page,$dataPerView);

		}
		if((int)$currentCat==0)///if no category
		{
			////calling code to get data from all categorize 
			return $this->buildSuggested($limit,$where);
		}
		else//if selected category
		{

		$qCat=$this->selectQuery($tabelPrefix.'taxonmy_category','imageCat,extraTableImage,table_for_sub_cat','','  where id='.$currentCat,'','','  ');
		$q=$this->selectQuery($tabelPrefix.'events_'.$currentCat.'_current','event_id,start_date,end_date,event_mapped_key,other_id,other_id_2,cat_id,event_location','',$where,'','',' order by start_date ASC '.$limit);
		}
		$data='';
		if($q>0)
		{
			for($i=0;$i<$q;$i++)
			{
				$title='title_'.$langPrefix;
				$description='description_'.$langPrefix;
				$extraImage='';
				$getInfo=$this->selectQuery($tabelPrefix.'events_'.$currentCat.'_info',$title.','.$description.',image,title_en','',' where mapped_key='.$this->event_mapped_key[$i],'','','');
				$data.=$this->buildEventDesign($this->start_date[$i],$this->end_date[$i],$this->{$title}[0],$this->{$description}[0],$this->image[0],$currentCat,$this->event_id[$i],$this->imageCat[0],$this->extraTableImage[0],$this->table_for_sub_cat[0],$this->other_id[$i],$this->other_id_2[$i],$this->cat_id[$i],$this->event_location[$i],$this->title_en[0]);
	
			}
		}
					return $data;
	}
	
	function buildBloxkSideEvents($type)
	{
		switch ($type)
		{
			case '0':
				$where=' where "'.time().'" between start_date and  end_date ';
			break;
			case '1':
				$where=' where start_date>"'.time().'"';
			break;
			case '2':
				$where=' where max(`end_date`)';
			break;
		}
		$limit=$this->limit(1,5);
		return $this->buildNowNextExents($limit,$where);
	}
	/* suggested homePage*/
	function buildNowNextExents($limit,$where='')
	{
		global $tabelPrefix,$currentCat,$dataPerView,$langPrefix,$lang;
		$this->id='';
        $data='';
		if((int)($_GET['catId'])!=0)
		{
			$this->id[0]=$_GET['catId'];
			$q=$this->selectQuery($tabelPrefix.'taxonmy_category','title,imageCat','','  where id='.$this->id[0],'','',' order by id  limit 0,4 ');
		}
		else
		{
			$q=$this->selectQuery($tabelPrefix.'taxonmy_category','id,title,imageCat','','  where root=0 ','','',' order by id  limit 0,4 ');
		}
		//print_r($this->id);
		$totalEvents=0;
		if(sizeof($this->id)>0)
		{
			for($z=0;$z<sizeof($this->id);$z++)
			{
					$qEvents=$this->selectQuery($tabelPrefix.'events_'.$this->id[$z].'_current','event_id,start_date,event_mapped_key','',$where,'','',' order by start_date ASC '.$limit);
				if($qEvents>0)
				{
					for($w=0;$w<$qEvents;$w++)
					{
						$title='title_'.$langPrefix;
						$description='title_'.$langPrefix;
						$getInfoEvents=$this->selectQuery($tabelPrefix.'events_'.$this->id[$z].'_info',$title,'',' where mapped_key='.$this->event_mapped_key[$w],'','','');
						$data.=$this->buildNowNextExentsDesign($this->start_date[$w],$this->{$title}[0],$this->event_id[$w],$this->id[$z],$this->imageCat[$z],$this->title[$z]);
						$totalEvents++;
						if($totalEvents>5)
							break;
			
					}
				}else
				{
					
				}
				
					if($totalEvents>5)
						break;
			}
		}else
		{
			$data='';
		}
		if(($data==''))
			$data= $lang->no_data_found_lang;
		return $data;
	}	
	
	function buildNowNextExentsDesign($startDate,$title,$event_id,$root,$imageCategory,$titleCat)
	{
		global $catImagesPath;
		$dataDes='<li class="'.$titleCat.'"><span>'.date('H:i',$startDate).'&nbsp;</span><a href="eventDetails.php?evId='.$event_id.'&root='.$root.'">'.$title.'</a><span style="float:right"></span></li>';
		            /* <li class="tv"><span>21:30&nbsp;</span><a href="eventDetails.php?evId=12391&amp;root=1">Annashrah Al Fanneyah</a><span style="float:right"></span></li>
             <li class="football"><span>21:30&nbsp;</span><a href="eventDetails.php?evId=12391&amp;root=1">Annashrah Al Fanneyah</a><span style="float:right"></span></li>
             <li class="cinema"><span>21:30&nbsp;</span><a href="eventDetails.php?evId=12391&amp;root=1">Annashrah Al Fanneyah</a><span style="float:right"></span></li>
             <li class="entertainment"><span>21:30&nbsp;</span><a href="eventDetails.php?evId=12391&amp;root=1">Annashrah Al Fanneyah</a><span style="float:right"></span></li>
             <li class="society"><span>21:30&nbsp;</span><a href="eventDetails.php?evId=12391&amp;root=1">Annashrah Al Fanneyah</a><span style="float:right"></span></li>
              <li class="conferences"><span>21:30&nbsp;</span><a href="eventDetails.php?evId=12391&amp;root=1">Annashrah Al Fanneyah</a><span style="float:right"></span></li>*/

		return $dataDes;
	}
	/* suggested homePage*/
	function buildSuggested($limit,$where='',$selectedCategory='')
	{
		global $tabelPrefix,$currentCat,$dataPerView,$langPrefix,$lang;
		//echo $limit;
        $data='';
		if($where=='')
			$where=' where start_date>="'.time().'"';
			if((int)$selectedCategory!=0)
			{
		$q=$this->selectQuery($tabelPrefix.'taxonmy_category','id,imageCat,extraTableImage,table_for_sub_cat','','  where id='.$selectedCategory,'','','  ');
		}
		else
		$q=$this->selectQuery($tabelPrefix.'taxonmy_category','id,imageCat,extraTableImage,table_for_sub_cat','','  where root=0 ','','',' order by id  limit 0,4 ');
		//print_r($this->id);
	//	echo $q;
		if(sizeof($this->id)>0)
		{	
			//echo $limit;
			for($z=0;$z<sizeof($this->id);$z++)
			{
					$qEvents=$this->selectQuery($tabelPrefix.'events_'.$this->id[$z].'_current','event_id,start_date,end_date,event_mapped_key,other_id,other_id_2,cat_id,event_location','',$where,'','',' order by start_date ASC '.$limit);
					
				if($qEvents>0)
				{
					for($w=0;$w<$qEvents;$w++)
					{
						$title='title_'.$langPrefix;
						$description='description_'.$langPrefix;
						$getInfoEvents=$this->selectQuery($tabelPrefix.'events_'.$this->id[$z].'_info',$title.','.$description.',image,title_en','',' where mapped_key='.$this->event_mapped_key[$w],'','','');
						$data.=$this->buildEventDesign($this->start_date[$w],$this->end_date[$w],$this->{$title}[0],$this->{$description}[0],$this->image[0],$this->id[$z],$this->event_id[$w],$this->imageCat[$z],$this->extraTableImage[$z],$this->table_for_sub_cat[$z],$this->other_id[$w],$this->other_id_2[$w],$this->cat_id[$w],$this->event_location[$w],$this->title_en[0]);
			
					}
				}else
				{
					//$data.= $lang->no_data_found_lang;
				}
					
			}
		}else
		{
			return '';
		}
		return $data;
	}
	/*	generate where for suggested block*/
	function createWhereSuggestedSearch($date='',$from='',$to='',$selectedCategory='')
	{
			if($date=='')
			{
				$date=date('Y-m-d ');
			}
			if($from=='')
			{
				$from=date(' H:i ');
			}
			if($to=='')
			{
				$to=date( 'H:i ',strtotime(date('H:i')+60*60));
			}

			$dFrom=strtotime($date.$from);
			$dTo1=strtotime($date.$to);
			$dTo=$dTo1;
		$where=' where start_date>="'.$dFrom.'" ';// and end_date<="'.$dTo.'"
		$data='';
		global $tabelPrefix,$dataPerView,$langPrefix,$lang;
		if(!isset($page))
			$page=1;
		$limit=$this->limit($page,$dataPerView);
		//echo date('Y-m-d H :i a',$dFrom).'---'.date('Y-m-d H :i a',$dTo);
		$res=$this->buildSuggested($limit,$where,$selectedCategory);
		//if($res=='')
			//$res=$lang->no_data_found_lang;
		$data='<div class="SuggestedEvent" id="SuggestedEvent"><h2 class="title">  <span>'.$lang->search_result_lang.'</span></h2>';
		$data.=$res;
		$data.='</div>';
		return $data;
	}
	
	/* print event design result */
	function buildEventDesign($startDate,$endDate,$title,$description='',$image='',$catId,$eventId,$imageCat,$extraTableImage='',$table_for_sub_cat='',$other_id='',$other_id_2='',$subCatId='',$event_location='',$title_en='')
	{
			global $eventImagesPath,$catImagesPath,$catImagesPath;
			$description = substr($description, 0, 100);
			$description = substr($description, 0, strrpos($description, ' ')).'';
        $data='';
			///check if extra imnage exist 
			$extraImage='';
	if(trim($title)=='')
				$title=$title_en;
			if($extraTableImage==1)
			{
				$extraImage=$this->getExtraImage($table_for_sub_cat,$other_id,$other_id_2,$subCatId,$catId);
			}
			$data.='<div class="event">
			<div class="EventDate"><span>'.date('d',$startDate).'</span> '.date('M',$startDate).'</div>';
			if($image!='')
            {
                if($catId==30)//wrong case
                {
                    $data.='<img src="'.$image.'" width="211" height="158" />';
                }
                else
				$data.='<img src="'.$eventImagesPath.''.$catId.'/'.$image.'" width="211" height="158" />';
            }
			else
			{
				$data.='<img src="'.$catImagesPath.''.$imageCat.'" width="211" height="158" />';
			}
			$data.='<div class="eventDesc">
			<h3>'.$title.'</h3>
			<span class="EventTime">'.date('H:i a',$startDate).' - '.date('H:i a',$endDate).'</span>
			<p>

			';
              if($catId==30)
                    $data.=$this->stripSlashesData($this->filterInput($title));
                else
                   $data.= $this->stripSlashesData($this->filterInput($description));
			$data.='</p>';
			if($event_location!='' && $event_location!='0')
				$data.='<div class="EventLocationHp">'.$event_location.'</div>';
			$data.='<div class="extraImageForEvent">'.$extraImage.'</div>
			<a class="BlueBtn"  href="eventDetails.php?evId='.$eventId.'&root='.$catId.'">More</a>
			 '.$this->socialMediaEvents("eventDetails.php?sevId=".$eventId.'_'.$catId).'
			
			</div>
			<div class="ClearBoth"></div>
			</div>';
		return $data;
	}
	/*
		return extra image 
	*/
	function getExtraImage($table_for_sub_cat,$other_id,$other_id_2,$subCatId,$catOpenedId)
	{
		global $tabelPrefix,$langPrefix,$catImagesPath,$channelImagesPath,$secureKey;
		//$this->imageCat[0]=$this->logo[0]='';
		//return '';
		if($table_for_sub_cat=='channel_list')
		{
			$this->logo[0]='';
			$q=$this->selectQuery($tabelPrefix.$table_for_sub_cat,'logo,name_en','',' where channel_id='.$other_id,'','','');
			
			$linkStart='<a href="advanceSearch.php?catId='.$catOpenedId.'&tags='.$this->name_en[0].'&secureCat='.md5($secureKey.$catOpenedId).'">';
			$linkEnd='</a>';
			if($this->logo[0]!='')
			{
				if(file_exists($channelImagesPath.''.$this->logo[0]))
					return $linkStart.'<img src="'.$channelImagesPath.''.$this->logo[0].'" width="60" height="60" border=0 title="'.$this->name_en[0].'" />'.$linkEnd;
				else
					return $linkStart.$this->name_en[0].$linkEnd;
			}else
					return $linkStart.$this->name_en[0].$linkEnd;

		}else
		if($table_for_sub_cat=='team_list')
		{
			$q=mysql_query(" select imageCat,title from ".$tabelPrefix."taxonmy_category where  id=".$subCatId);
			$linkStart='<a href="advanceSearch.php?catId='.$catOpenedId.'&tags2='. mysql_result($q,0,'title').'&secureCat='.md5($secureKey.$catOpenedId).'">';
			$linkEnd='</a>';
			if(mysql_result($q,0,'imageCat')!='')
			{
				if(file_exists($catImagesPath.''.mysql_result($q,0,'imageCat')))
					return $linkStart.'<img src="'.$catImagesPath.''.mysql_result($q,0,'imageCat').'" width="60" height="60" border=0 title="'. mysql_result($q,0,'title').'" />'.$linkEnd;
				else
					return  $linkStart.mysql_result($q,0,'title').$linkEnd;
			}else
					return  $linkStart.mysql_result($q,0,'title').$linkEnd;

		}
		else
		{
			//$q=$this->selectQuery($tabelPrefix.'taxonmy_category','imageCat,title','','  where id='.$subCatId,'','','  ');
			$q=mysql_query(" select imageCat,title from ".$tabelPrefix."taxonmy_category where  id=".$subCatId);
			$linkStart='<a href="advanceSearch.php?catId='.$catOpenedId.'&tags='. mysql_result($q,0,'title').'&secureCat='.md5($secureKey.$catOpenedId).'">';
			$linkEnd='</a>';
			if(mysql_result($q,0,'imageCat')!='')
			{
				if(file_exists($catImagesPath.''.mysql_result($q,0,'imageCat')))
					return $linkStart.'<img src="'.$catImagesPath.''.mysql_result($q,0,'imageCat').'" width="60" height="60" border=0 title="'. mysql_result($q,0,'title').'" />'.$linkEnd;
				else
					return  $linkStart.mysql_result($q,0,'title').$linkEnd;
			}else
					return  $linkStart.mysql_result($q,0,'title').$linkEnd;
		}
		/*
		if($table_for_sub_cat=='team_list')
		{
			$q=$this->selectQuery($tabelPrefix.$table_for_sub_cat,'team_name','',' where team_id in('.$other_id.','.$other_id_2.')','','','');
			return $this->team_name[0].' '.$this->team_name[1];
		}*/
	}
	/* get country list as array */
	function dataBaseCountry($where='')
	{
		global $tabelPrefix;
		$q=$this->selectQuery($tabelPrefix.'country','country_id,country_lable','',' where rootId=0 '.$where,'','',' order by country_lable ASC ');
	}
	/* build the list */
	function buildCountryList($name)
	{
		global $formHtml,$lang;
		$this->dataBaseCountry();
		$j=0;
		$data=$formHtml->openSelectBox($name,$name,'','','');
		$data.=$formHtml->selectOption('-1',$lang->select_country_lang,'');
		foreach($this->country_id as $index)
		{
			$data.=$formHtml->selectOption($this->country_id[$j],$this->country_lable[$j],'');
			$j++;
		}
		$data.=$formHtml->closeSelectBox();
		return $data;
	}
	function buildYearList($name)
	{
		global $formHtml,$lang;
		$data=$formHtml->openSelectBox($name,$name,'','','');
		$data.=$formHtml->selectOption('-1',$lang->select_dob_lang,'');
		for($i=1950;$i<(date('Y')-7);$i++)
		{
			$data.=$formHtml->selectOption($i,$i,'');
		}
		$data.=$formHtml->closeSelectBox();
		return $data;
	}

	///filter input
	function filterInput($value)
	{
		$value = preg_replace("/\<(.+?)\>/is", '', $value);
        $tags = array( 'p', 'span');
        $value = preg_replace( '#<(' . implode( '|', $tags) . ')>.*?</\1>#s', '', $value);

        $value = htmlspecialchars($value, ENT_NOQUOTES);
        $value=strip_tags($value);
		return mysql_escape_string($value);
	}
	///filter input
	function simpleFilterInput($value)
	{
		//$value=addslashes($value);
		return mysql_escape_string($value);
	}
	////fstripSlashesData
	function stripSlashesData($title)
	{
		$title=str_replace('\n','<br/>',$title);
		$title=str_replace('\\','',$title);
		return stripslashes($title);
	}
	function limit($page,$dataPerView)
	{
		$startView=$page*$dataPerView;
		$startViewRecord=$startView-$dataPerView;
		$endView=$startViewRecord;
		return ' limit '.$startViewRecord.','.$dataPerView;
	}
	
	///////sending mail function 
	///function for sending all mails on the system
	function mailing($mailTo,$title,$body)
	{
		global $lang;
		$from_name = $lang->domain_name;
		$from_email = "Roznamti";
		$header = "Content-type: text/html; charset=utf-8\r\n";
		$header .= "From: $from_name <$from_email>\r\n"; 
		$data='<div style="background-color: #efefef;border-radius: 5px;height: 500px;width: 98%;">';
		$data.='<div style="width: 90%;text-align: left;margin: 15px;padding-top: 15px;"><img src="'.sitePathForLogin.'images/logo.png" width="250px" height="50px" /></div>';
		$data.='<div style="width:100%"><hr/></div>';
		$data.='<div style="width: 100%;text-align: center;font-family: arial;font-size: 25px;font-weight: bold;"><div style="width:95%">'.$title.'</div></div>';
		$data.='<div style="width: 100%;text-align: left;font-family: arial;font-size: 25px;margin-left: 15px;"><div style="width:95%">'.$body.'</div></div>';
		$data.='</div>';
		
		if(@mail($mailTo,$title,$data,$header))
			return true;
		else
			return false;
			/**/
			
			/**/
	}
	
	///
	/*
		building error body 
		100 select 
		200 insert 
		300 delete
		400 update
	*/
	function buildErrorBody($errType,$table_name)
	{
		switch ($errType) 
		{
			case '100':
			$text="select query from ";
			break;
			case '200':
			$text="insert query to ";
			break;
			case '300':
			$text="delete query from ";
			break;
			case '400':
			$text="update query into  ";
			break;
		}
		return 'Error in '.$text.' '.$table_name;
		
	}
	
	

	/* convert array to db format */
	function convertArrayToDbFormat($array)
	{
		if(sizeof($array>0))
		{
			$result='';
			for($i=0;$i<sizeof($array);$i++)
			{
				if($i<(sizeof($array)-1))
				{
					$result.=$array[$i].',';
				}
				else
				{
					$result.=$array[$i];
				}
			}
			return $result;
		}
	}
		/* ending main menu with sub levekl area */

	/* end return main category image for menu*/
	//------create session 
	/* this function used to create seesion */
	function createSession($session_name,$session_value)
	{
		//session_register($session_name);
		$_SESSION[$session_name]=$session_value;
	}
	/*
	reset_password_form
	<br />
*/
	function reset_password_form($userId,$token)
	{
		global $tabelPrefix,$userLoggedSession,$secureValue,$lang,$formHtml;
		$userId=(int)$userId;
		if(md5(md5($secureValue.$userId))==$token)
		{
			unset($data);
				$data='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->new_lang.''.$lang->password_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$formHtml->passwordBox('user_password_reset','user_password_reset','50','','','textInput','').'<span class="errorFiled" id="error_user_password">'.$lang->password_error_lang.'</span><span class="errorFiled" id="error_min_user_password_reset">'.$lang->min_password_six_char_lang.'</span></div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$lang->confirm_password_lang.'</div><div class="spanSpace">:</div>';
					$data.='<div class="regRecordsInput">'.$formHtml->passwordBox('confirm_password_reset','confirm_password_reset','50','','','textInput','').'</div>';
				$data.='</div>';
				$data.='<div class="regRecords">';
					$data.='<div class="regRecordsLabel">'.$formHtml->button('register','register',$lang->reset_password_lang,'onclick="resetPasswordUpdated(\''.$userId.'\',\''.$token.'\')"','buttonClass').'&nbsp;</div>';
					$data.='<div id="loadingArea"  class="loadingFiled"><img src="img/preloader-flat.gif" border=0 width="32" height="10" /></div>';
				$data.='</div>';
				return $data;
		}else
		return $lang->unexcpected_error_lang;
	}


	function printName($name)
	{
		return ucfirst($name);
	}

	/*
		print profile owener	
	*/
	function printProfileOwner($uId)
	{
		global $tabelPrefix;
		$checkOwner=$this->selectQuery($tabelPrefix.'users','user_full_name','',' where userId='.$uId);
		$array[0]=$this->user_full_name[0];
		return $array;
	}
	//////time zone
	function timeZone()
	{
		global $userLoggedSession;
		if(session_is_registered($userLoggedSession))
		{
			$zoneTime=time()+$this->returnTimeZoneasStrtime();
			return $zoneTime;
		}
		else
			return time();//default server time
	}
	///funcion thats convert months and am pm to arabic language
	function convertTimeLang($timing)
	{
		$arrayTiming=array();
		global $lang;
		$amPm=strftime("%P", ($timing));
		if($amPm=='am' ||$amPm=='AM' )
			$extraTime=$lang->am_lang;
		else
			$extraTime=$lang->pm_lang;
		$arrayTiming[0]=$extraTime;
		$month=ucfirst(strftime("%b", ($timing)));
		$arrayTiming[1]=$lang->{$month};
		return $arrayTiming;

	}
	///return user time zone as strtotime
	function returnTimeZoneasStrtime($userId='')
	{
		if($this->userLoggedId>0)
			return ($this->userLoggedTimeZone)*60*60;
		else
			return 0;
		if($userId=='')
			return $this->userLoggedTimeZone*60*60;
		else
		{
			//global $tabelPrefix;
			//$userProfileOpend=$this->selectQuery($tabelPrefix.'users','time_zone','','  where id='.$userId,'',' ','');
			return $this->userLoggedTimeZone*60*60;
		}
	}
	///function that return the time period for selected date as 24 hour
	function datePeriodDayTimeZone($day)
	{
		$day=date('Y-m-d',$day);
		$day=strtotime($day);
		$userTime=$this->returnTimeZoneasStrtime();
		$period[0]=($day-$userTime);
		$period[1]=($day-$userTime)+24*60*60;
		return $period;
	}
    /*return day name for date*/
    function returnNameOfDay($date)
    {
		global $lang;
        if(strtotime(date('Y-m-d').'+6 day') >= $date){
            $weekday = date('l', $date);
            return $lang->{strtolower($weekday)};   
        }else{
			$amPm = $this->convertTimeLang($date);  
            $weekday = date('d', $date).' '.$amPm[1];
            return $weekday;  
        } 
    }
    /*get date as text*/
	function getTodayAsTextByDate($Edate)
	{
	    global $lang;
		$now = date('Y-m-d');
        $eventDate = date('Y-m-d',$Edate); 
        $format = '';
        
        if(strtotime($eventDate)== strtotime($now)){
                  $format = $lang->today_lang;
        }else if(strtotime($eventDate)== strtotime($now.'+1 days')){
                  $format = $lang->tomm_lang;
        }else{
				$dateAfter = strtotime($eventDate);
				$amPm = $this->convertTimeLang($dateAfter);  
                $format = date('d', $dateAfter).' '.$amPm[1];
        }
        
        return $format;
	}


	////time diffrence
	function time_difference($date)
	{
	global $lang,$languages;
	if(empty($date)) {
	return "No date provided";
	}
	
	$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	$lengths         = array("60","60","24","7","4.35","12","10");
	
	$now             = time();
	$unix_date         = $date;
	
	// check validity of date
	if(empty($unix_date)) {
	return "Bad date";
	}
	
	// is it future date or past date
	if($now > $unix_date) {
	$difference     = $now - $unix_date;
	$tense         = "$lang->ago";
	
	} else {
	$difference     = $unix_date - $now;
	$tense         = "$lang->fromNow";
	}
	
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	$difference /= $lengths[$j];
	}
	
	$difference = round($difference);
	
	if($difference != 1) {
	if($languages=='')
	$periods[$j].= "$lang->s";
	else
	{
		if($difference>=3 && $difference<=10)
		$periods[$j]=$lang->{$periods[$j].'3'};
		else if($difference>10)
		$periods[$j]=$lang->{$periods[$j].'1'};
		else
		$periods[$j]=$lang->{$periods[$j].$difference};
	}
	}
	else if($difference == 1)
	{
	$periods[$j]=$lang->{$periods[$j].'1'};	
	}
	if($difference==0)
		return "$lang->now_lang";
	else
	if($languages=='ar/' && $difference<3 )
	{
		return " $periods[$j] {$tense}";
	}
	else
	{
		return "$difference $periods[$j] {$tense}";
	}
		
	}
    /****/
    	/* dispaly no permission function */
	function noPermission()
	{
		global $lang;
		return '<div class="confirmationMsg">'.$lang->noPermissionToAccessThisPage.'</div>';
	}


	/* dispaly no permission function */
	function noDataFound()
	{
		global $lang;
		return $lang->noDataFound;
	}



		function returnMonthName()
		{
			global $lang;
			return $lang->Jan.':'.$lang->Feb.':'.$lang->Mar.':'.$lang->Apr.':'.$lang->May.':'.$lang->Jun.':'.$lang->Jul.':'.$lang->Aug.':'.$lang->Sep.':'.$lang->Oct.':'.$lang->Nov.':'.$lang->Dec ;	
		}
		
		/**cut string after the number*/
		function cutString($string,$min,$max)
		{
			$newString = substr($string,$min,$max);
			return $newString;
		}
		///build advance search funtion 
		///
		function advanceSerachResult()
		{
			global $tabelPrefix,$currentCat,$secureKey,$lang,$langPrefix;
			$catId=(int)$_GET['catId'];
			$secureCat=$_GET['secureCat'];
			$keywordValue=$this->filterInput($_GET['keywordValue']);
			$tags=$this->filterInput($_GET['tags']);
			$tags2=$this->filterInput($_GET['tags2']);
			$dateFilter=$this->filterInput($_GET['dateFilter']);
			$fromTime=$this->filterInput($_GET['fromTime']);
			$toTime=$this->filterInput($_GET['toTime']);
			$getCategoryDetails=$this->selectQuery($tabelPrefix.'taxonmy_category','extraTableImage,imageCat,table_for_sub_cat,table_for_sub_cat_box_2','',' where id='.$catId);
			$limit=' limit 0,20';
			//get tags from locations 
			$filterTags1=$this->table_for_sub_cat[0];
			$filterTags2=$this->table_for_sub_cat_box_2[0];
			$serachingCat='';
			$otherIds='';
			$where=' where 1=1  ';
			if($filterTags1=='' && $keywordValue=='')///if the tags 1 return the category 
			{
				$whereCatId=' where title like "%'.$tags.'" ';
				$getCategoryDetails=$this->selectQuery($tabelPrefix.'taxonmy_category','id','',$whereCatId);
				$serachingCat=$this->id[0];
				$where.=' and cat_id='.$serachingCat;
			}
			else//if filter tags one contins other resoutrces 
			if($tags!='')
			{
				////get filter from other tabels for v or for sport
					if($filterTags1=='channel_list')
					{
						
						$nameLab='name_'.$langPrefix;
						$q=$this->selectQuery($tabelPrefix.$filterTags1,'channel_id','',' where '.$nameLab.' = "'.$tags.'" ','','',' order by binary ('.$nameLab.') ASC ');
						//$otherIds=implode(',',$this->channel_id);
						$where.=' and other_id='.$this->channel_id[0];
					}
					if($filterTags1=='team_list')
					{
						$nameLab='team_name';
						$q=$this->selectQuery($tabelPrefix.$filterTags1,'team_id','',' where '.$nameLab.' = "'.$tags.'" ','','',' order by binary ('.$nameLab.') ASC ');
						if(sizeof($this->team_id)>0)
							$otherIds=implode(',',$this->team_id);
						else
						{
							$this->team_id[0]=0;
						}
						$where.=' and (other_id='.$this->team_id[0].' or other_id_2='.$this->team_id[0].' ) ';
					}
			}///ending data from  other resources tables 
			if($serachingCat=='' && $tags2!='')///hget teh cat id
			{
				if($filterTags2=='')
				{
					$whereCatId=' where title = "'.$tags2.'" ';
					$getCategoryDetails=$this->selectQuery($tabelPrefix.'taxonmy_category','id','',$whereCatId);
					$serachingCat=$this->id[0];
				}
				else
				{
					$whereCatId=' where en_name = "'.$tags2.'" ';
					$getCategoryDetails=$this->selectQuery($tabelPrefix.'taxonmy_category','id_sub_cat','',$whereCatId);
					$serachingCat=$this->id_sub_cat[0];
				}
			}
		//	echo $serachingCat.'xx---yy'.$catId.'----'.$secureCat.'------'.$keywordValue.' '.$tags.' '.$tags2.' '.$dateFilter.' '.$fromTime.' '.$toTime;
			if($serachingCat!='' && $keywordValue=='')
				$where.=' and  cat_id='.$serachingCat;
			
			$filterTiming=false;
			if((int)$dateFilter!=0)
			{
				$filterTiming=true;
				$dateFilter=strtotime($dateFilter);
			}
			if($filterTiming)////filter dates and check hours 
			{
				if((int)$fromTime!=0 && (int)$toTime!=0)
				{
					$fromTimeFilter=$dateFilter+date("H:i", strtotime($fromTime))*60*60;
					$toTimeFilter=$dateFilter+date("H:i", strtotime($toTime))*60*60;
					$where.=' and start_date between "'.$fromTimeFilter.'" and "'.$toTimeFilter.'"';
				}else
				if((int)$fromTime!=0)
				{
					$fromTimeFilter=$dateFilter+date("H:i", strtotime($fromTime))*60*60;
					$where.=' and start_date >= "'.$fromTimeFilter.'"';
				}
				else
				if((int)$toTime!=0)
				{
					$toTimeFilter=$dateFilter+date("H:i", strtotime($toTime))*60*60;
					$where.=' and start_date <= "'.$toTimeFilter.'"';
				}
				else
					$where.=' and start_date between "'.$dateFilter.'" and "'.($dateFilter+24*60*60).'" ';
			}
			else//just selecting start time
			{
				if((int)$fromTime!=0)
				{
					$fromTimeFilter=time()+date("H:i", strtotime($fromTime))*60*60;
					$where.=' and start_date >= "'.$fromTimeFilter.'"';
				}else
				$where.=' and start_date >= "'.time().'" ';//  
			}
				//echo $where;
			$title='title_'.$langPrefix;
			$description='description_'.$langPrefix;
			$whereTitle='';
				if($keywordValue!='')
				{
					$titleValue='title_'.$langPrefix;
					$qTitleQuery=$this->selectQuery($tabelPrefix.'events_'.$catId.'_info','mapped_key','',
					' where '.$titleValue.' like "%'.$keywordValue.'" ' ,'','','');
					//echo ' where '.$titleValue.' like "%'.$keywordValue.'" ';
					 $whereTitle=' and event_mapped_key='.$this->mapped_key[0];
					// echo $where.$whereTitle;
					// echo time();
				}
				$q=$this->selectQuery($tabelPrefix.'events_'.$catId.'_current','event_id,start_date,end_date,event_mapped_key,other_id,other_id_2,cat_id,event_location','',$where.$whereTitle,'','',' order by start_date ASC '.$limit);
		$data='';
		if($q>0)
		{
			for($i=0;$i<$q;$i++)
			{
				$extraImage='';
				$getInfo=$this->selectQuery($tabelPrefix.'events_'.$catId.'_info',$title.','.$description.',image,title_en','',' where mapped_key='.$this->event_mapped_key[$i],'','','');
				if($getInfo>0)
				$data.=$this->buildEventDesign($this->start_date[$i],$this->end_date[$i],$this->{$title}[0],$this->{$description}[0],$this->image[0],$currentCat,$this->event_id[$i],$this->imageCat[0],$this->extraTableImage[0],$this->table_for_sub_cat[0],$this->other_id[$i],$this->other_id_2[$i],$this->cat_id[$i],$this->event_location[$i],$this->title_en[0]);
	
			}
		}
		else
			$data='No data found...';
			return $data;
			
		}
		
		/* getKeywordsCategory */
		function getKeywordsCategory($catId)
		{
			global $tabelPrefix,$langPrefix,$eventImagesPath,$catImagesPath;
			$catId=(int)$catId;
			$title='title_'.$langPrefix;
			$qCat=$this->selectQuery($tabelPrefix.'events_'.$catId.'_info',$title,'','','DISTINCT','','  ');
			return implode(',',$this->{$title});
		}
		function getEventDetails($root,$evId)
		{
			$currentCat=$root;
			$root=(int)$root;
			$evId=(int)$evId;
			global $tabelPrefix,$langPrefix,$eventImagesPath,$catImagesPath;
			$limit=' limit 0,1';
			$where=' where event_id='.$evId;
			$qCat=$this->selectQuery($tabelPrefix.'taxonmy_category','imageCat,extraTableImage,table_for_sub_cat','','  where id='.$currentCat,'','','  ');
			$q=$this->selectQuery($tabelPrefix.'events_'.$currentCat.'_current','event_id,start_date,end_date,event_mapped_key,other_id,other_id_2,cat_id,event_location','',$where,'','',' order by start_date ASC '.$limit);
		$data='';
		if($q>0)
			{
				for($i=0;$i<$q;$i++)
				{
				$title='title_'.$langPrefix;
				$description='description_'.$langPrefix;
				$extraImage='';
				$getInfo=$this->selectQuery($tabelPrefix.'events_'.$currentCat.'_info',$title.','.$description.',image','',' where mapped_key='.$this->event_mapped_key[$i],'','','');
					$this->stDate=$this->start_date[$i];
					$this->enDate=$this->end_date[$i];
					$this->titleEvent=$this->{$title}[0];
					$this->description=$this->{$description}[0];
					$this->image=$this->image[0];
					$this->imageCat=$this->imageCat[0];
					$this->extraTableImage=$this->extraTableImage[0];
					$this->table_for_sub_cat=$this->table_for_sub_cat[0];
					$this->other_id=$this->other_id[$i];
					$this->other_id_2=$this->other_id_2[$i];
					$this->cat_id=$this->cat_id[$i];
					$this->event_location=$this->event_location[$i];
					if($this->event_location==0)
						$this->event_location='';
					$extraImage='';
					
					if($this->extraTableImage==1)
					{
						$this->extraImage=$this->getExtraImage($this->table_for_sub_cat,$this->other_id,$this->other_id_2,$this->cat_id,$currentCat);
					}
					$this->eventDate='<span>'.date('d',$this->stDate).'</span> '.date('M',$this->stDate);
					if($this->image!='')
					{
                        if($currentCat==30)//wrong case
                        {
                            $this->imageView='<img src="'.$this->image.'" width="211" height="158" />';
                            $this->imageSocial=$this->image;
                        }
                        else
                        {
						$this->imageView='<img src="'.$eventImagesPath.''.$root.'/'.$this->image.'" width="211" height="158" />';
						$this->imageSocial=$eventImagesPath.''.$root.'/'.$this->image;
                        }
					}
					else
					{
						$this->imageView='<img src="'.$catImagesPath.''.$this->imageCat.'" width="211" height="158" />';
						$this->imageSocial=$catImagesPath.''.$this->imageCat;
					}
					$this->timing=date('H:i a',$this->stDate).' - '.date('H:i a',$this->enDate);
					$this->social=$this->socialMediaEvents("eventDetails.php?sevId=".$evId.'_'.$root);
					$this->descriptionSocial=substr($this->description, 0, 80);
					$this->descriptionSocial = substr($this->descriptionSocial, 0, strrpos($this->descriptionSocial, ' ')).'';

					
				}
			}
	}
		/**/
}



?>
<?
include('config.php');
echo '
  <script type="text/javascript" src="js/vendor/jquery-1.10.2.min.js" language="javascript1.5" ></script>
<script type="text/javascript" src="js/js.js" language="javascript1.5" ></script>';
	if($_GET['secure']!=md5($secureValue.$_GET['id']))
	{
		echo 'Error ';
		exit();
	}
	else
	{
		//$_GET['id']
		$uploaddir=$channelImagesPath;
		if (@opendir($uploaddir) !== false) {
			$content = array();
		$dir = opendir($uploaddir);
		while ($read = readdir($dir)) {
		if ($read != '.' && $read != '..') {
		$content[] = $read;
		}
		}
		$data='';
		if(sizeof($content)>0)
		{
			$images='<table width="50%"  align="center" border="1">';
			for($i=0;$i<sizeof($content);$i++)
			{
					if(($i%2)==0)
						$images.='<tr style="max-height:100px;" valign="top">';
					$images.='<td valign="top"><img src="'.$uploaddir.$content[$i].'" width="50" height="50" valign="top" /><br/>'.$content[$i].'</td>';
			}
			$images.='</table>';
		}
		else
		{
				$images= 'NO files Exist ';	
		}
		}
		else
		{
			mkdir($uploaddir);
			$images='Please close window and re-open it';
		}
		$q=$generalObj->selectQuery($tabelPrefix.'channel_list','name_en,channel_id,logo,name_ar','','order by binary (name_en)','  ');
			$events='<table width="50%" align="center" border="0">';
			if($q>0)
			{
				for($i=0;$i<$q;$i++)
				{
						$events.='<tr><td  valign="top"> '.$generalObj->name_en[$i].'</td><td><input type="text" value="'.$generalObj->logo[$i].'" name="imageEvent_'.$i.'" id="imageEvent_'.$i.'" onblur="updateChannelImage(this.value,\''.$generalObj->channel_id[$i].'\')" />
						<input type="text" value="'.$generalObj->name_en[$i].'" name="channel_en_'.$i.'" id="channel_en_'.$i.'" onblur="updateChannelName(this.value,\''.$generalObj->channel_id[$i].'\',\'en\')" />
						<input type="text" value="'.$generalObj->name_ar[$i].'" name="channel_ar_'.$i.'" id="channel_ar_'.$i.'" onblur="updateChannelName(this.value,\''.$generalObj->channel_id[$i].'\',\'ar\')" />
						</td></tr>';
						$events.='<tr><td colspan="2"><hr/></td></tr>';
				}
			}
			else
				$events.='No Events';
			$events.='</table>';
			$data='<table width="100%" height="100%" align="center" border="1">';
			$data.='<tr><td width="50%" valign="top">'.$events.'</td><td width="48%" valign="top">'.$images.'</td></tr>';
			$data.='</table>';
		echo $data;
	}
?>
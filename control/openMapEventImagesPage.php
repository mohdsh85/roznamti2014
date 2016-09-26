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
		$uploaddir=$eventImagesPath.'/temp/';
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
			$images='<table width="50%" height="100%" align="center" border="1">';
			for($i=0;$i<sizeof($content);$i++)
			{
					if(($i%2)==0)
						$images.='<tr>';
					$images.='<td><img src="'.$uploaddir.$content[$i].'" width="150" height="150" /><br/>'.$content[$i].'</td>';
			}
			$images.='</tbody>';
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
		$q=$generalObj->selectQuery($tabelPrefix.'events_'.$_GET['id'].'_info','title_en,mapped_key,image');
			$events='<table width="50%" height="100%" align="center" border="0">';
			if($q>0)
			{
				for($i=0;$i<$q;$i++)
				{
						$events.='<tr><td>'.$generalObj->title_en[$i].'</td><td><input type="text" value="'.$generalObj->image[$i].'" name="imageEvent_'.$i.'" id="imageEvent_'.$i.'" onblur="updateEventImage(\''.$generalObj->mapped_key[$i].'\',this.value,\''.$_GET['id'].'\')" /></td></tr>';
				}
			}
			else
				$events.='No Events';
			$events.='</table>';
			$data='<table width="100%" height="100%" align="center" border="1">';
			$data.='<tr><td width="50%" valign="top">'.$events.'</td><td>'.$images.'</td></tr>';
			$data.='</table>';
		echo $data;
	}
?>
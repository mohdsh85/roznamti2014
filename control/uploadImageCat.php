<?
include('config.php');

	if($_GET['secure']!=md5($secureValue.$_GET['id']))
	{
		echo 'Error ';
		exit();
	}
	else
	{

		if(isset($_FILES['newCatImage']['tmp_name']))
		{
			$fileType=(explode('.',$_FILES['newCatImage']['name']));
			$fileType=strtolower($fileType[1]);
			$arrayImages=array('jpg','png','gif','jpeg');
			if((in_array($fileType,$arrayImages)))
			{
				$imageName=time().'.'.$fileType;
				move_uploaded_file($_FILES['newCatImage']['tmp_name'],$catImagesPath.''.$imageName);
				$values=array('imageCat'=>$imageName);
				$q=$generalObj->updateQuery($tabelPrefix.'taxonmy_category',$values,' where id='.$_GET['id']);
					echo 'Done............';
			}else
			{
				echo 'Error Image Type';
			}
		}
		
		$data=$formHtml->openForm('post','?id='.$_GET['id'].'&secure='.$_GET['secure'],'uploadCat','uploadCat','');
		$data.=$formHtml->imageUpload('newCatImage','newCatImage','');
		$data.=$formHtml->submit('Save','Save','Update','','');
		$data.=$formHtml->closeForm();
		$getImage=$generalObj->selectQuery($tabelPrefix.'taxonmy_category','imageCat','',' where id='.$_GET['id']);
		if($generalObj->imageCat[0]!='')
		{
			$data.='<img src="'.$catImagesPath.''.$generalObj->imageCat[0].'" /> ';
		}
		echo $data;
	}
?>
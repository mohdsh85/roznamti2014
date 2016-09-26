<?php // You need to add server side validation and better error handling here
include('config.php');
$data = array();
if($_SESSION[$userLoggedSession]=='')
{
    $error = true;
	$data = ($error) ? array('error' => $lang->session_expire_lang.' <a href="?logout=true" >'.$lang->click_here.'</a>') : array('files' => $files);
	echo json_encode($data);
	exit();
}

if(isset($_GET['files']))
{	
	$error = false;
	$files = array();

	$uploaddir = 'uploads/'.md5($secureValue.$_SESSION[$userLoggedSession]).'/';
	if(!(file_exists($uploaddir)))
		mkdir($uploaddir);
	$fileName=time();
	
	foreach($_FILES as $file)
	{
		$fileType=explode('.',$file['name']);
		$fileType=strtolower($fileType[1]);
		$length=$file['length'];
		if($fileType=='')
		{
			$error = true;
			$data = ($error) ? array('error' => $lang->file_types_accepted_lang.' "'.strtoupper($fileType).'" '.$lang->not_accpted_lang ) : array('files' => $files);
			echo json_encode($data);
			exit();
		}
		if(move_uploaded_file($file['tmp_name'], $uploaddir .$_POST['file_lable_required'].'.'.$fileType))
		{
			$files[] = $uploaddir .$_POST['file_lable_required'].'.'.$fileType;
			//$insert into uploaded files 
		}
		else
		{
		    $error = true;
		}
	}
	$data = ($error) ? array('error' => $lang->error_while_uploading_lang) : array('files' => $files);
}
else
{
	$data = array('success' => $generalObj->userName.' '.$_POST['file_lable_required'].' Uploaded <a href=parser.php>Click Here </a>', 'formData' => $_POST);
}

echo json_encode($data);

?>
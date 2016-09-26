<?php
                     
$ftp_server = "woiftp.whatsonindia.com";
$ftp_user = "shoofeetv";
$ftp_pass = "Sh00f66Tv";
$server_directory='/'.date('m-d-Y').'/Regular';
/*$ftp_server_roz = "roznamti.com";
$ftp_user_roz= "roznamti";
$ftp_pass_roz= "Roz201320!";
$conn_id_roz = ftp_connect($ftp_server_roz) or die("Couldn't connect to $ftp_server"); 
*/
mkdir(' /home/content/07/10260507/html/cron_script/xml_data/feedsShoofeTv/'.date('m-d-Y'),0777);

mkdir('/home/content/07/10260507/html/cron_script/xml_data/feedsShoofeTv/'.date('m-d-Y').'/xmlFiles',0777);
$local_file='/home/content/07/10260507/html/cron_script/xml_data/feedsShoofeTv/'.date('m-d-Y').'/data.tar.gz';
// set up a connection or die
/**/
$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); // connect to another server 

// try to login
if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
    //echo "Connected as $ftp_user@$ftp_server\n";
	if (ftp_chdir($conn_id, $server_directory)) {
    //echo "Current directory is now: " . ftp_pwd($conn_id) . "\n";///change direcoty
	
	$contents = ftp_nlist($conn_id, ".");///lisitng all content

} else { 
    echo "Couldn't change directory\n";
}
$server_file=$contents[0];

if (ftp_get($conn_id,   $local_file,$server_file,FTP_BINARY)) {
   //echo "Successfully written to $local_file\n";
} else {
   echo "There was a problem\n";
}
}

exec('tar -xvf '.$local_file .' -C /home/content/07/10260507/html/cron_script/xml_data/feedsShoofeTv/'.date('m-d-Y').'/xmlFiles');////unix command for extract the files 
/*
$archive = new PharData('/some/file.tar.gz');
foreach($archive as $file) {
        echo "$file\n";
}*/
// close the connection
ftp_close($conn_id);  
?>
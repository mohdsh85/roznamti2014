<?php
//session_start();
//date_default_timezone_set('Asia/Amman');
$_SESSION['location']='cron_script';
include_once('../../config.php');
$query = "";
$data = array();  
$date=time()-24*60*60;

$date= date('m-d-Y',$date);
$tableName='roz_events_1_current';
$tableInfo='roz_events_1_info';
//$date='05-12-2014';
$folderPath='feedsShofeeTv/'.$date.'/xmlFiles/';
		//print_r($content);
		$arrayChannels=array('ME MBC1.xml','WOA MBC2.xml','ME MBC3.xml','ME MBC4.xml','ME MBC Drama.xml','WOA MBC MAX.xml','WOA MBC Action.xml','ME Moga Comedy.xml','ME LBC.xml','ME Rotana Cinema.xml','ME Rotana Khalijiah.xml','ME Rotana Masriya.xml','ME Rotana Movies.xml','ME Rotana Music.xml','ME Rotana Zaman.xml','WOA beIN Sports 1.xml','WOA beIN Sports 10.xml','WOA beIN Sports 2.xml','WOA beIN Sports 3.xml','WOA beIN Sports 4.xml','WOA beIN Sports 5.xml','WOA beIN Sports 6.xml','WOA beIN Sports 7.xml','WOA beIN Sports 8.xml','WOA beIN Sports 9.xml','ME Abu Dhabi al Oula+1.xml','ME Nile Drama.xml','ME Nile Comedy.xml','ME Dream 1.xml','ME Dream 2.xml','ME MTV Lebanon.xml','ME Moga Comedy.xml','ME Abu Dhabi Drama.xml','ME Qatar.xml','ME Rotana Khalijiah.xml','ME CBC Drama.xml','ME Dubai TV.xml');
		//$arrayChannels=array('ME Moga Comedy.xml','ME MBC1.xml','ME Dubai Sport.xml','ME Dubai Sports 2.xml','ME LBC.xml','ME MBC3.xml','ME MBC4.xml','ME Rotana Cinema.xml','ME Rotana Khalijiah.xml','ME Rotana Masriya.xml','ME Rotana Movies.xml','ME Rotana Music.xml','ME Rotana Zaman.xml','WOA Abu Dhabi Sports 3 HD.xml','WOA Abu Dhabi Sports 4 HD.xml','WOA Abu Dhabi Sports 5 HD.xml','WOA Abu Dhabi Sports 6 HD.xml','WOA Abu Dhabi Sports 7 HD.xml','WOA Abu Dhabi Sports 8 HD.xml','WOA Abu Dhabi Sports.xml','WOA Abu Dhabi Sports2.xml','WOA Fox.xml','WOA Fox Movies.xml','WOA Geo TV.xml','WOA MBC2.xml','WOA MTV.xml','WOA National Geographic Abu Dhabi.xml','WOA Sky News.xml');
		///'WOA beIN Sports 1.xml','WOA beIN Sports 10.xml','WOA beIN Sports 2.xml','WOA beIN Sports 3.xml','WOA beIN Sports 4.xml','WOA beIN Sports 5.xml','WOA beIN Sports 6.xml','WOA beIN Sports 7.xml','WOA beIN Sports 8.xml','WOA beIN Sports 9.xml',
for($j=0;$j<sizeof($arrayChannels);$j++)
{
					$channelIdParserr=0;
					$channelId=0;
    echo $folderPath.$arrayChannels[$j].'<br/>';
                    if(file_exists($folderPath.$arrayChannels[$j]))
                    {
                        $dom = DOMDocument::load($folderPath.$arrayChannels[$j]) or die('Eror:');
                        $channelIdParserr = $dom->getElementsByTagName( 'channel' );
                        $channelId=$channelIdParserr->item(0)->getAttribute('id');//channel id
                        $namear=$channelIdParserr->item(0)->getElementsByTagName('display-name')->item(0)->nodeValue;// name ar
                        $nameen=$channelIdParserr->item(0)->getElementsByTagName('display-name')->item(1)->nodeValue;// name en
                        //echo $channelId .' '.$namear .'' .$nameen;
                        $channelId=insertIntoChannel($channelId,$namear,$nameen,'nologo');
                        echo $channelId.' '.$nameen.'<br/>';
                        $params = $dom->getElementsByTagName( 'programme' );
                        $k=0;
                        ///get big channel to set show under it
                        foreach ($params as $param) //go to each section 1 by 1
                        {
                            $startTime=strtotime($params->item($k)->getAttribute('start'));//channel id
                            $endTime=strtotime($params->item($k)->getAttribute('stop'));//channel id
                            $progTitle=$params->item($k)->getElementsByTagName('title')->item(0)->nodeValue;//prog ar
                            $progTitleen=$params->item($k)->getElementsByTagName('title')->item(1)->nodeValue;//prog ar
                            $desc=$params->item($k)->getElementsByTagName('desc')->item(0)->nodeValue;//prog ar
                            $descen=$params->item($k)->getElementsByTagName('desc')->item(1)->nodeValue;//prog ar
                            $channel=$params->item($k)->getAttribute('channel');
                            //echo $channelId.'<br/>';
                            //	echo $progTitleen;

                            $whereCheck=' where other_id='.$channel.' and start_date="'.$startTime.'"';
                            $eventNotInserted=$generalObj->selectQuery($tableName,'start_date','',$whereCheck,'','','');
                            if($eventNotInserted==0)
                            {
                                $randomMappedKey=rand(0,1000)+(rand(0,100)*$channel)+($k+$j);

                                echo $startTime.' '.$endTime.' '.$randomMappedKey.' '.$progTitleen.' '.$channel.'<br/>';
                                $values=array('start_date'=>$startTime,'end_date'=>$endTime,'owner'=>'1','cat_id'=>'9','url'=>$url,'other_id'=>$channel,'other_id_2'=>'0','event_mapped_key'=>$randomMappedKey);
                                $generalObj->insertQuery($tableName,$values);
                                $progTitleen=str_replace("'",'`',$progTitleen);
                                $valuesInfo=array('title_ar'=>$progTitle,'description_ar'=>$desc,'title_en'=>$progTitleen,'description_en'=>$descen,'mapped_key'=>$randomMappedKey);
                                $generalObj->insertQuery($tableInfo,$valuesInfo);

                            }
                            $k++;
                        }
                    }

					//sleep(1);
}



function insertIntoChannel($channelId,$nameAr,$nameEn,$logo)
{
		$q=mysql_query(" select channel_id,id from roz_channel_list where channel_id=".$channelId);
		$num=mysql_num_rows($q);
		if($num>0)
		{
			return mysql_result($q,0,'channel_id');
		}
		else
		{
			mysql_query(" insert into roz_channel_list (channel_id,name_ar,name_en,logo,event_by) values ('$channelId','$nameAr','$nameEn','$logo','1') ");
			return $channelId;
		}
}


?>


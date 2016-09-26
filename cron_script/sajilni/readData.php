<?php
/**
 * Created by JetBrains PhpStorm.
 * User: shareif
 * Date: 10/18/14
 * Time: 5:32 PM
 * To change this template use File | Settings | File Templates.
 */
$_SESSION['location']='cron_script';
include_once('../../config.php');
$tableName=' roz_events_30_current';
$tableInfo='roz_events_30_info';
$query = "";
$content = file_get_contents("data.json");
//$content=str_replace('[','',$content);
//$content=str_replace(']','',$content);
//if($content!='')
//{
//     $content=json_decode($content);
//    // echo $id[0];
//    echo  $content;
//}


$json_a = json_decode($content, true);
for($i=0;$i<sizeof($json_a);$i++)
{
    $mapped_key=$json_a[$i]['id'];
    $name=$json_a[$i]['name'];
    $description=$json_a[$i]['description'];

    $startTime=$json_a[$i]['startDate']/1000;
    $endTime=$json_a[$i]['endDate']/1000;
    $image=$json_a[$i]['eventImages'];
    $url='';
    $other_id=0;
    $imageArray= $image[0]['image'];
    $imagePath='https://www.sajilni.com/images/homepage-eventlist-block/'.$imageArray['physicalName'];
    //selectQuery($table_name='',$field='',$index='',$where='',$DISTINCT='',$limit='',$ordering='')
    $checkdata=0;
    $checkdata=$generalObj->selectQuery($tableName,'event_id','0',' where event_mapped_key='.$mapped_key);
    if($checkdata==0)
    {
        $values=array('start_date'=>$startTime,'end_date'=>$endTime,'owner'=>'1','cat_id'=>'30','url'=>$url,'other_id'=>$channel,'other_id_2'=>'0','event_mapped_key'=>$mapped_key);
        $generalObj->insertQuery($tableName,$values);
        $valuesInfo=array('image'=>$imagePath,'title_ar'=>$name,'description_ar'=>$description,'title_en'=>$name,'description_en'=>$description,'mapped_key'=>$mapped_key);
        $generalObj->insertQuery($tableInfo,$valuesInfo);
    }


}
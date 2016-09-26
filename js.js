// JavaScript Document

var getWhereFilterEvents=false;
function loadMoreRecords()
{
	var extraUrl='';
	if(getWhereFilterEvents)//if load more records after serching the box
	{
       // alert(1);
			var dateValue=$( "#inputField" ).val();
			var fromTime=$( "#fromTime" ).val();
			var toTime=$( "#toTime" ).val();
			extraUrl="&dateValue="+dateValue+"&fromTime="+fromTime+"&toTime="+toTime;

	}
		 	var currOffset=parseInt($('#indexPage').val());
			var nextOffset=currOffset+1;
			var currentCat=parseInt($('#currentCat').val());
		 	document.getElementById('indexPage').value=nextOffset;
			allowRun=false;
			$.ajax({
			  type: "POST",
			  url: "ajax.php",
			  data: "action=loadMoreRecords&nextOffset="+nextOffset+"&currentCat="+currentCat+extraUrl,
			  cache: false,
			  success: function(html){
				  	//	 document.getElementById('loaderImg').style.display='none';
				  if(html!=0)
				  {
				  	document.getElementById('SuggestedEvent').style.height=parseInt( document.getElementById('SuggestedEvent').style.height)+500+'px';
	 				document.getElementById('SuggestedEvent').innerHTML+=html;
					allowRun=true;
					
				  }else
				  {
	 						//document.getElementById('endRecords').style.display='block';
				  }
			  }
			});
}
/*
	search header box values 
*/
var currentSelectedcat=0;
var filterList=filterListBoxTwo=keyWordsData='';

function doFilter(filterListResult)
{
	
}
var vIndex=0;
var vIndexDataTwo=0;

function filterData()
{
		if(event.keyCode == 40 || event.keyCode == 38) {
			return '';
		}
   var 	filterListData=filterList.split(',');
	var data='<ul style="list-style:none">';
	var v=document.getElementById('tags').value;
	var j=vIndex=0;
	for(var i=0;i<filterListData.length;i++)
	{
		if(filterListData[i].toLowerCase().match(v.toLowerCase()))
		{
			data+='<li id="index_'+j+'" onmouseover="clickElementFillField(\'tags\',\''+filterListData[i]+'\',\'filterList\')" class="filterListLable">'+filterListData[i]+'</li>';
			j++;
		}
	}
	data+='</ul>';
	
	document.getElementById('filterList').innerHTML=data;
	document.getElementById('filterList').style.top=document.getElementById('tags').offsetTop+25+'px';
	document.getElementById('filterList').style.left=document.getElementById('tags').offsetLeft+'px';
	document.getElementById('filterList').style.display='block';
	
}
/*	fill selected value on the box*/
function clickElementFillField(filledValue,clickedValue,filterListLable)
{
	document.getElementById(filledValue).value=clickedValue;
	//document.getElementById(filterListLable).style.display='none';
	//document.getElementById(filledValue).blur();
}
window.onkeydown = keydown;

function keydown() {
//closeCalendar()	/* data one*/
if(document.getElementById('filterList'))
{	
  if(document.getElementById('filterList').style.display=='block')
  {
		if(event.keyCode == 40) {//up
			if(vIndex<=0)
				vIndex=0;
			if((vIndex-1)>=0)
				document.getElementById("index_"+(vIndex-1)).className='ddlHover';
			document.getElementById("index_"+vIndex).className='ddlout';
			vIndex++;
			
		}
		if(event.keyCode == 38) {//down
				if(vIndex<=0)
				vIndex=0;
			document.getElementById("index_"+vIndex).className='filterList ddlHover';
			if((vIndex)>=0)
				document.getElementById("index_"+(vIndex-1)).className='filterList ddlout';
			vIndex--;
			
		}
		if(event.keyCode == 13) {//enter
			var cuurV=0;
		if((vIndex-1)>0)
			cuurV=(vIndex-1);
				document.getElementById('tags').value=document.getElementById('index_'+cuurV).innerHTML;
				document.getElementById('filterList').style.display='none';
				document.getElementById('tags').blur();

		}
		if(event.keyCode == 27) {//escape
				document.getElementById('tags').value='';
				document.getElementById('filterList').style.display='none';
				document.getElementById('tags').blur();
		}
  }
}
	/* data two*/
	if(document.getElementById('filterDataTwo'))
	{
  if(document.getElementById('filterDataTwo').style.display=='block')
  {
		if(event.keyCode == 40) {
			if(vIndexDataTwo<=0)//up
				vIndexDataTwo=0;
			if((vIndexDataTwo-1)>=0)
				document.getElementById("index_data_two_"+(vIndexDataTwo-1)).className='ddlHover';
			document.getElementById("index_data_two_"+vIndexDataTwo).className='ddlout';
			vIndexDataTwo++;
			
		}
		if(event.keyCode == 38) {///down
				if(vIndexDataTwo<=0)
				vIndexDataTwo=0;
			document.getElementById("index_data_two_"+vIndexDataTwo).className='filterList ddlHover';
			if((vIndexDataTwo)>=0)
				document.getElementById("index_data_two_"+(vIndexDataTwo-1)).className='filterList ddlout';
			vIndexDataTwo--;

			
		}
		if(event.keyCode == 13) {//enter
			var cuurV=0;
		if((vIndexDataTwo-1)>0)
			cuurV=(vIndexDataTwo-1);
			document.getElementById('tags2').value=document.getElementById('index_data_two_'+cuurV).innerHTML;
				document.getElementById('filterDataTwo').style.display='none';
				document.getElementById('tags2').blur();

		}
		if(event.keyCode == 27) {//escape
				document.getElementById('tags2').value='';
				document.getElementById('filterDataTwo').style.display='none';
				document.getElementById('tags2').blur();
		}
  }
	}
	
if(document.getElementById('filterListKeyWord'))
{	
  if(document.getElementById('filterListKeyWord').style.display=='block')
  {
		if(event.keyCode == 40) {//up
			if(vIndexDataThree<=0)
				vIndexDataThree=0;
			if((vIndexDataThree-1)>=0)
				document.getElementById("index_data_three_"+(vIndexDataThree-1)).className='ddlHover';
			document.getElementById("index_data_three_"+vIndexDataThree).className='ddlout';
			vIndexDataThree++;
			
		}
		if(event.keyCode == 38) {//down
				if(vIndexDataThree<=0)
				vIndexDataThree=0;
			document.getElementById("index_data_three_"+vIndexDataThree).className='filterList ddlHover';
			if((vIndexDataThree)>=0)
				document.getElementById("index_data_three_"+(vIndexDataThree-1)).className='filterList ddlout';
			vIndexDataThree--;
			
		}
		if(event.keyCode == 13) {//enter
			var cuurV=0;
		if((vIndexDataThree-1)>0)
			cuurV=(vIndexDataThree-1);
				document.getElementById('keywordValue').value=document.getElementById('index_data_three_'+cuurV).innerHTML;
				document.getElementById('filterListKeyWord').style.display='none';
				document.getElementById('keywordValue').blur();

		}
		if(event.keyCode == 27) {//escape
				document.getElementById('keywordValue').value='';
				document.getElementById('filterListKeyWord').style.display='none';
				document.getElementById('keywordValue').blur();
		}
  }
}
	
	
}
/*
	on key up do filter list
*/
function filterDataTwo()
{
	if(event.keyCode == 40 || event.keyCode == 38) {
		return '';
	}
   var 	filterListData=filterListBoxTwo.split(',');
	var data='<ul style="list-style:none">';
	var v=document.getElementById('tags2').value;
	var j=vIndexDataTwo=0;
	for(var i=0;i<filterListData.length;i++)
	{
		if(filterListData[i].toLowerCase().match(v.toLowerCase()))
		{
			data+='<li id="index_data_two_'+j+'"  onmouseover="clickElementFillField(\'tags2\',\''+filterListData[i]+'\',\'filterDataTwo\')"  class="filterListLable">'+filterListData[i]+'</li>';
			j++;
		}
	}
	data+='</ul>';
	
	document.getElementById('filterDataTwo').innerHTML=data;
	document.getElementById('filterDataTwo').style.top=document.getElementById('tags2').offsetTop+25+'px';
	document.getElementById('filterDataTwo').style.left=document.getElementById('tags2').offsetLeft+'px';
	document.getElementById('filterDataTwo').style.display='block';
}
/* get keyword data */
/* keyword filteration*/
function filterKeyWordData()
{
	if(event.keyCode == 40 || event.keyCode == 38) {
		return '';
	}
	
   var 	filterListDataKeyWord=keyWordsData.split(',');
	var data='<ul style="list-style:none">';
	var v=document.getElementById('keywordValue').value;
	var j=vIndexDataThree=0;
	for(var i=0;i<filterListDataKeyWord.length;i++)
	{
		if(filterListDataKeyWord[i].toLowerCase().match(v.toLowerCase()))
		{
			data+='<li id="index_data_three_'+j+'"  onmouseover="clickElementFillField(\'keywordValue\',\''+filterListDataKeyWord[i]+'\',\'filterListKeyWord\')"  class="filterListLable">'+filterListDataKeyWord[i]+'</li>';
			j++;
		}
	}
	data+='</ul>';
	
	document.getElementById('filterListKeyWord').innerHTML=data;
	document.getElementById('filterListKeyWord').style.top=document.getElementById('keywordValue').offsetTop+25+'px';
	document.getElementById('filterListKeyWord').style.left=document.getElementById('keywordValue').offsetLeft+'px';
	document.getElementById('filterListKeyWord').style.display='block';
}
function getKeywordsCategory(catId)
{
		//-------------get sub cat list
		$.ajax({
		type: "POST",
		url: "searchAjax.php",
		data: "action=getKeywordsCategory&catId="+catId,
		cache: false,
		success: function(html){
			keyWordsData=html;
		}
		});

		///--------------
}
/*
	build filter list box 
*/
function getFilterList(searchCatList,secureSearchCatList,nextCat)
{
		//-------------get sub cat list
		$.ajax({
		type: "POST",
		url: "searchAjax.php",
		data: "action=getSearchCatList&searchCatList="+searchCatList+"&secureSearchCatList="+secureSearchCatList+"&cat="+nextCat,
		cache: false,
		success: function(html){
			filterList=html;
		}
		});

		///--------------
}
function getFilterListDataTwo(table_for_sub_cat_box_2,table_for_sub_cat_box_2_secure,nextCat)
{
		//-------------get sub cat list
		$.ajax({
		type: "POST",
		url: "searchAjax.php",
		data: "action=getFilterListDataTwo&searchCatList="+table_for_sub_cat_box_2+"&secureSearchCatList="+table_for_sub_cat_box_2_secure+"&cat="+nextCat,
		cache: false,
		success: function(html){
			filterListBoxTwo=html;
		}
		});

		///--------------
}
var previousCat='';
function  showsearchBox(nextCat,secureCat,title,searchCatList,secureSearchCatList,table_for_sub_cat_box_2,table_for_sub_cat_box_2_secure,no_keyword_search,lable_one,lable_two,lable_three,lable_four,lable_five,lable_six,innerPage,lable_two_selected,lable_three_selected,lable_four_selected,lable_five_selected,lable_six_selected)
{
	if(previousCat!='')
			document.getElementById(previousCat).className='';
	if(nextCat!=currentSelectedcat)
	{
		$( "#searchBox" ).slideUp();
			previousCat=secureCat;
		document.getElementById(secureCat).className='current';
		currentSelectedcat=nextCat;
		var disabledkeyword='';
		if(no_keyword_search==1 || 1==1)
			disabledkeyword='disabled=disabled';
		var c='<div class="search">';
		c+='<div class="thred"> <input type="text" value="'+lable_one+'" style="width:100%" class="inputStyle2"  onfocus="emptyFiledKeepValue(\''+lable_one+'\',\'keywordValue\');getKeywordsCategory(\''+nextCat+'\')" onblur="checkFiledReturnValue(\'keywordValue\');hideElement(\'filterListKeyWord\')"  id="keywordValue"  onkeyup="filterKeyWordData()" /> </div>';
		
		c+='<div class="thred" id="filterListKeyWord" class="filterDataBox"   style="display:none;position: absolute;border: 1px solid;z-index: 2;background-color: #fff;list-style: none;"></div>';
		
		c+='<div class="thred"> <input  value="'+lable_two_selected+'"   id="tags" type="text" style="width:100%" class="inputStyle2" onfocus="emptyFiledKeepValue(\''+lable_two+'\',\'tags\');getFilterList(\''+searchCatList+'\',\''+secureSearchCatList+'\',\''+nextCat+'\')" onkeyup="filterData()" onblur="checkFiledReturnValue(\'tags\');hideElement(\'filterList\')" /> </div>';
		
		c+='<div class="thred" id="filterList" class="filterDataBox"   style="display:none;position: absolute;border: 1px solid;z-index: 2;background-color: #fff;list-style: none;"></div>';
		
		c+='<div class="thred"> <input value="'+lable_three_selected+'" name="" type="text" id="tags2" style="width:100%;display:block" class="inputStyle2" onfocus="emptyFiledKeepValue(\''+lable_three+'\',\'tags2\');getFilterListDataTwo(\''+table_for_sub_cat_box_2+'\',\''+table_for_sub_cat_box_2_secure+'\',\''+nextCat+'\')"  onkeyup="filterDataTwo()"  onblur="checkFiledReturnValue(\'tags2\');hideElement(\'filterDataTwo\')" /> </div>';
		
		c+='<div class="thred" id="filterDataTwo" class="filterDataBox" style="display:none;position: absolute;border: 1px solid;z-index: 2;background-color: #fff;list-style: none;"></div>';
		c+='<div class="thred DateThred"> <input  type="text" style="width:100%" class="inputStyle2"  id="inputFieldJS" name="inputFieldJS" value="'+lable_four_selected+'" onblur="" /> </div>';
		
		c+='<div class="thred TimeThred"> <input name="" type="text"  class="inputStyle2" id="fromTimeJs" value="'+lable_five_selected+'"   />';
		c+='<input  type="text" style="width:48%; margin-left:-4px;display:none" class="inputStyle2"  id="toTimeJs"  value="'+lable_six_selected+'" /> </div>';
		c+='<div class="thred" >  <a href="javascript:" class="BlueBtn" onclick="buildSearchUrl(\''+nextCat+'\',\''+secureCat+'\',\''+lable_one+'\',\''+lable_two+'\',\''+lable_three+'\',\''+lable_four+'\',\''+lable_five+'\',\''+lable_six+'\')">Search '+title+' </a>';
		
		/*if(innerPage!=nextCat)
		c+='<a href="index.php?CategoryType='+title+'&catId='+nextCat+'&secureCat='+secureCat+'" class="goToPage BlueBtn"> Go to '+title+' page </a>';
		c+='<a href="javascript:" onclick="hideSearchBox()" class="hideSearch">Hide<span ></span> </a> </div></div>';
		*/
	document.getElementById('searchBox').innerHTML=c;
                $(function() {$('#fromTimeJs').timepicker({ 'step': 15 });$('#toTimeJs').timepicker({ 'step': 30 });});
$(function(){new JsDatePick({useMode:2,	target:"inputFieldJS",dateFormat:"%d-%M-%Y"});});;	//document.getElementById('searchBox').style.display='block';
				
			$( "#searchBox" ).slideToggle();
			doFilter(filterList);
	}
}

/* build serach url for advance serach */
function buildSearchUrl(nextCat,secureCat,lable_one,lable_two,lable_three,lable_foure,lable_five,lable_six)
{
	var url='advanceSearch.php?catId='+nextCat+'';
	var goToPage=true;
	if(document.getElementById('keywordValue').value!=lable_one)
	{
		url+='&keywordValue='+document.getElementById('keywordValue').value;
		goToPage=false;
	}
	if(document.getElementById('tags').value!=lable_two)
	{
		url+='&tags='+document.getElementById('tags').value;;
		goToPage=false;
	}
	if(document.getElementById('tags2').value!=lable_three)
	{
		url+='&tags2='+document.getElementById('tags2').value;;
		goToPage=false;
	}
	if(document.getElementById('inputFieldJS').value!='' && document.getElementById('inputFieldJS').value!=lable_foure)
	{
		url+='&dateFilter='+document.getElementById('inputFieldJS').value;;
		goToPage=false;
	}
	if(document.getElementById('fromTimeJs').value!='' && document.getElementById('fromTimeJs').value!=lable_five)
	{
		url+='&fromTime='+document.getElementById('fromTimeJs').value;;
		goToPage=false;
	}
	if(document.getElementById('toTimeJs').value!='' && document.getElementById('toTimeJs').value!=lable_six)
	{
		url+='&toTime='+document.getElementById('toTimeJs').value;;
		goToPage=false;
	}
	
		url+='&secureCat='+secureCat;;
	if(goToPage==true)///if the user click serach with no any filter
		window.location='index.php?CategoryType=Search&catId='+nextCat+'&secureCat='+secureCat;
	else
		window.location=url;
}

//-----------
var currentLable='';
function emptyFiledKeepValue(lable,id)
{
	currentLable=lable;
	document.getElementById(id).value='';
}
function checkFiledReturnValue(id)
{
	if(document.getElementById(id).value=='')
		document.getElementById(id).value=currentLable;
}
function hideSearchBox()
{
		if(document.getElementById('searchBox').innerHTML!='&nbsp;')
		{
			$( "#searchBox" ).slideUp();
			document.getElementById('searchBox').innerHTML='&nbsp;';
		}
}
function hideElement(id)
{
	setTimeout(hideNow(id),2000);
}
function hideNow(id)
{
	document.getElementById(id).style.display='none';
}
/* search homepage fields*/
function filterSuggestedEvents()
{
	getWhereFilterEvents=true;
	lastScroll=0;
	 $(this).scrollTop(0);
	document.getElementById('indexPage').value=1;
	var dateValue=$( "#inputField" ).val();
	var fromTime=$( "#fromTime" ).val();
	var toTime=$( "#toTime" ).val();
	var currentCat=parseInt($('#currentCat').val());
			$.ajax({
			  type: "POST",
			  url: "searchAjax.php",
			  data: "action=filterSuggestedEvents&dateValue="+dateValue+"&fromTime="+fromTime+"&toTime="+toTime+"&currentCat="+currentCat,
			  cache: false,
			  success: function(html){
				  document.getElementById('SuggestedEvent').innerHTML=html;
			  }
			});
}
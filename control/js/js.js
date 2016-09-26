/*
	copyrights reserved for www.ohhcandy.com
	2012-2013
	IT department 
	JS main class function 
*/
/////open page
function ajaxHandler()
{

	if (window.XMLHttpRequest)
	{
		http=new XMLHttpRequest();
	}
	else
	{
		http=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return http;
}
var setTabv='RecentRecords';
function setTab(v)
{
	setTabv=v;
}
function openUploadImageCat(id,secure)
{
	window.open('uploadImageCat.php?id='+id+'&secure='+secure,'UplaodCat','width=300,height=300');
}
function openMapEventImagesPage(id,secure)
{
	window.open('openMapEventImagesPage.php?id='+id+'&secure='+secure,'UplaodCat','width=1000,height=600');
}
function changeTitle(filed,mappedKey,value,tableIndex)
{
		//showBlockPopUpAjax('500','150','Building Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=updateControlTitles&mappedKey="+mappedKey+"&value="+value+"&tableIndex="+tableIndex+"&filed="+filed,
		cache: false,
		success: function(html){
			//closeDataBlock();
			
		}
		});
}

function updateEventImage(mappedKey,value,tableIndex)
{
		//showBlockPopUpAjax('500','150','Building Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=updateEventImage&mappedKey="+mappedKey+"&value="+value+"&tableIndex="+tableIndex,
		cache: false,
		success: function(html){
			//closeDataBlock();
			
		}
		});
}
function updateChannelName(value,channelId,prefixName)
{
		//showBlockPopUpAjax('500','150','Building Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=updateChannelName&value="+value+"&channelId="+channelId+"&prefixName="+prefixName,
		cache: false,
		success: function(html){
			//closeDataBlock();
			
		}
		});
}

function updateChannelImage(value,channelId)
{
		//showBlockPopUpAjax('500','150','Building Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=updateChannelImage&value="+value+"&channelId="+channelId,
		cache: false,
		success: function(html){
			//closeDataBlock();
			
		}
		});
}
/* category option*/
function saveCategory()
{
     var  catName = $('#categoryName').val(); // get the message
	if(catName=='')
	 {
		 alert('fill category');
 		 focusElement('categoryName');
		 return false;
	 }
		showBlockPopUpAjax('500','150','Building Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=saveCategory&catName="+catName,
		cache: false,
		success: function(html){
			showBlockPopUpAjax('500','auto','Building Category',html);
			setTimeout("homePageCat()",1000);
		}
		});
}
/* set default cat*/
function setDefaultCat(root,secure)
{
		showBlockPopUpAjax('500','150','Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=setDefaultCat&root="+root+"&secure="+secure,
		cache: false,
		success: function(html){
			closeDataBlock();
		}
		});
}

/* set default cat*/
function updateOrderCat(root,secure)
{
	var order=document.getElementById('orderId_'+secure).value;
		showBlockPopUpAjax('500','150','Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=updateOrderCat&root="+root+"&secure="+secure+"&order="+order,
		cache: false,
		success: function(html){
			closeDataBlock();
		}
		});
}
function other_resource_parser(root,secure)
{
	var order=document.getElementById('orderId_'+secure).value;
		showBlockPopUpAjax('500','150','Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=other_resource_parser&root="+root+"&secure="+secure+"&order="+order,
		cache: false,
		success: function(html){
			closeDataBlock();
		}
		});
}

function extraTableImage(root,secure)
{
	var order=document.getElementById('orderId_'+secure).value;
		showBlockPopUpAjax('500','150','Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=extraTableImage&root="+root+"&secure="+secure+"&order="+order,
		cache: false,
		success: function(html){
			closeDataBlock();
		}
		});
}

function saveCategorySub(root,secure)
{
     var  catName = $('#categoryName').val(); // get the message
	if(catName=='')
	 {
		 alert('fill category');
 		 focusElement('categoryName');
		 return false;
	 }
		showBlockPopUpAjax('500','150','Building Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=saveCategorySub&catName="+catName+"&root="+root+"&secure="+secure,
		cache: false,
		success: function(html){
			showBlockPopUpAjax('500','auto','Building Category',html);
			setTimeout("homePageCat()",1000);
		}
		});
}
function viewSubCat(id,secure)
{
		showBlockPopUpAjax('500','150','Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=getCategorySub&root="+id+"&secure="+secure,
		cache: false,
		success: function(html){
			document.getElementById('Tab____category').innerHTML=html;
			closeDataBlock();
		}
		});
}
function viewSubCatcategorySelection(id,secure,looking_for_other_resources_on_parse)
{
		showBlockPopUpAjax('500','150','Category',showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=viewSubCatcategorySelection&root="+id+"&secure="+secure+"&looking_for_other_resources_on_parse="+looking_for_other_resources_on_parse,
		cache: false,
		success: function(html){
			document.getElementById('Tab____category').innerHTML=html;
			closeDataBlock();
		}
		});
}
var catSelctedValue=0;
var looking_for_other_resources_on_parse=0;
function setCatValue(id,looking_for_other_resources_on_parseValue)
{
	catSelctedValue=id;
	looking_for_other_resources_on_parse=looking_for_other_resources_on_parseValue;
}
function insertDataParser(fileName)
{
	if(catSelctedValue==0)
		{
			alert('No Cat selected....');
			return false;
		}
		//alert(catSelctedValue);
		//alert(looking_for_other_resources_on_parse);
		window.location='openFile.php?filename='+fileName+'&catSelctedValue='+catSelctedValue+'&looking_for_other_resources_on_parse='+looking_for_other_resources_on_parse;
		
}
/* end categories*/

function homePage()
{
	window.location='index.php';
}
function homePageCat()
{
	window.location='index.php';
}
function deleteStreamRecord(id,secureId,lable)
{
	var msg=confirm(lable);
	if(msg)
	{
	 	document.getElementById('del_'+secureId).style.display='none';
			$.ajax({
			  type: "POST",
			  url: "ajax.php",
			  data: "action=removeRecord&id="+id+"&secureId="+secureId,
			  cache: false,
			  success: function(html){
			  }
			});
	}
	else
	return false;
}
/*
loginNow
*/
function loginNow()
{
	 document.getElementById('error_user_email_loggin').style.display='none';
	 document.getElementById('error_min_user_password_loggin').style.display='none';
     var  user_email_loggin = $('#user_email_loggin').val(); // get the message
	if(user_email_loggin=='')
	 {
		 document.getElementById('error_user_email_loggin').style.display='block';
 		 focusElement('user_email_loggin');
		 return false;
	 }
	if(!(checkEmail(user_email_loggin)))
	{
		 document.getElementById('error_user_email_loggin').style.display='block';
 		 focusElement('user_email_loggin');
		 return false;
	}
     var  user_password_loggin = $('#user_password_loggin').val(); // get the message
	 if(user_password_loggin=='')
	 {
		 document.getElementById('error_user_password_loggin').style.display='block';
 		 focusElement('user_password_loggin');
		 emptyField('user_password_loggin');
		 return false;
	 }
	 if(stringLength(user_password_loggin)<6)
	 {
		 document.getElementById('error_min_user_password_loggin').style.display='block';
		 emptyField('user_password_loggin');
		 return false;
	 }
	 document.getElementById('loginResult').style.display='block';
	 document.getElementById('login').disabled=true;
	 document.getElementById('reset').disabled=true;
		checkLogin(user_email_loggin,user_password_loggin);
	 
}
var num1=num2=0;
function resetPassword(title,lang,langErr)
{
	 num1=Math.floor((Math.random()*10)+1);
	 num2=Math.floor((Math.random()*10)+1);
	var content='<div style="width:95%"><div class="imageClicable" >'+lang+':</div><div class="imageClicable" ><input class="textInput" type="text" name="emailReseted" id="emailReseted" size="40" /><span class="errorFiled" id="error_user_email_loggin_reset_password">'+langErr+'</div></div>';
	content+='<div style="width:95%;float: left;margin-top: 14px;"><div class="imageClicable" >'+num1+' + '+num2+':</div><div class="imageClicable" ><input class="textInput" type="text" name="validateSum" id="validateSum" size="40" /></div></div>';
	content+='<div style="width:95%;float: left;margin-top: 47px;" id="resultRestedMsg"><input type="button" value="'+title+'" name="resetButton" id="resetButton"  class="buttonClass" onclick="validateResetForm()"></div>';
	
		 	 showBlockPopUpAjax('1000','220',title,content);
}
function validateResetForm()
{
     var  user_email = $('#emailReseted').val(); // get the message
	if(user_email=='')
	 {
		 document.getElementById('error_user_email_loggin_reset_password').style.display='block';
 		 focusElement('emailReseted');
		 return false;
	 }
	if(!(checkEmail(user_email)))
	{
		 document.getElementById('error_user_email_loggin_reset_password').style.display='block';
 		 focusElement('emailReseted');
		 return false;
	}
     var  validateSum = $('#validateSum').val(); // get the message
	 if(parseInt(validateSum)!=(parseInt(num1+num2)))
	 {
		 document.getElementById('validateSum').value='!!!';
 		 focusElement('validateSum');
		 return false;
	 }
        $.ajax({
          type: "POST",
          url: "nonLogged/ajax.php",
          data: "action=resetPassword&user_email="+user_email+'&num1='+num1+'&num2='+num2+'&validateSum='+validateSum,
          cache: false,
          success: function(html){
			 	document.getElementById('resultRestedMsg').innerHTML=html;

          }
        });
}

function contact_us(mailLab,messageLab,err)
{
	 num1=Math.floor((Math.random()*10)+1);
	 num2=Math.floor((Math.random()*10)+1);
	var content='<div style="width:95%"><div class="imageClicable" >'+mailLab+':</div><div class="imageClicable" ><input class="textInput" type="text" name="emailReseted" id="emailReseted" size="40" /><span class="errorFiled" id="error_user_email_loggin_reset_password">'+err+'</div></div>';
		 content+='<div  style="width:95%;float:left;margin-top: 14px;"><div class="imageClicable">'+messageLab+':</div><div class="imageClicable" ><textarea name="message" id="message" rows="8" cols="40" ></textarea></div></div>';
	content+='<div style="width:95%;float: left;margin-top: 14px;"><div class="imageClicable" >'+num1+' + '+num2+':</div><div class="imageClicable" ><input class="textInput" type="text" name="validateSum" id="validateSum" size="40" /></div></div>';
	content+='<div style="width:95%;float: left;margin-top: 47px;" id="resultRestedMsg"><input type="button" value="Send us" name="resetButton" id="resetButton"  class="buttonClass" onclick="validateContactUsForm()"></div>';
	
		 	 showBlockPopUpAjax('1000','380','Contact us',content);
}

function validateContactUsForm()
{
     var  message = $('#message').val(); // get the message
     var  user_email = $('#emailReseted').val(); // get the message
	if(user_email=='' || message=='')
	 {
		 document.getElementById('error_user_email_loggin_reset_password').style.display='block';
 		 focusElement('emailReseted');
		 return false;
	 }
	if(!(checkEmail(user_email)))
	{
		 document.getElementById('error_user_email_loggin_reset_password').style.display='block';
 		 focusElement('emailReseted');
		 return false;
	}
     var  validateSum = $('#validateSum').val(); // get the message
	 if(parseInt(validateSum)!=(parseInt(num1+num2)))
	 {
		 document.getElementById('validateSum').value='!!!';
 		 focusElement('validateSum');
		 return false;
	 }
        $.ajax({
          type: "POST",
          url: "nonLogged/ajax.php",
          data: "action=ContactUsFor&user_email="+user_email+'&num1='+num1+'&num2='+num2+'&validateSum='+validateSum+"&message="+message,
          cache: false,
          success: function(html){
			 	document.getElementById('resultRestedMsg').innerHTML=html;

          }
        });
}/* check login data engin */
function checkLogin(user_email,user_password)
{
	var keep_me_logged=0;
		if(document.getElementById('keep_me_logged').checked==true)
			{
				keep_me_logged=1;
			}
        $.ajax({
          type: "POST",
          url: "nonLogged/ajax.php",
          data: "action=checkLogin&user_email="+user_email+"&user_password="+user_password+'&keep_me_logged='+keep_me_logged,
          cache: false,
          success: function(html){
			  if(html==1)
			  {
					redirectAfterRegisterPage();
			  }
				else
				{
			 		document.getElementById('loginResult').innerHTML=html;
						 document.getElementById('login').disabled=false;
						 document.getElementById('reset').disabled=false;

				}

          }
        });
}
function resetPasswordUpdated(userId,token)
{
     var  user_password = $('#user_password_reset').val(); // get the message
   	var  confirm_password = $('#confirm_password_reset').val(); // get the message
	 if(user_password=='' || confirm_password=='' || confirm_password!=user_password)
	 {
 		 focusElement('user_password_reset');
		 emptyField('user_password_reset');
		 emptyField('confirm_password_reset');
		 document.getElementById('error_min_user_password_reset').style.display='block';
		 return false;
	 }
	 if(stringLength(user_password)<6)
	 {
		 emptyField('user_password_reset');
		 emptyField('confirm_password_reset');
		 return false;
	 }
        $.ajax({
          type: "POST",
          url: "nonLogged/ajax.php",
          data: "action=updateResetedPassword&user_password="+user_password+"&confirm_password="+confirm_password+'&token='+token,
          cache: false,
          success: function(html){
			  document.getElementById('resetPasswordResult').innerHTML=html;
          }
        });
}
/* empty field */
function emptyField(id)
{
	document.getElementById(id).value='';
}
/* get string length*/
function stringLength(str)
{
	var n = str.length;
	return n;
}
/* focuse on field */
function focusElement(id)
{
 	$('#'+id).focus();
}
function redirectAfterRegisterPage()
{
	window.location='index.php';
}
/*
	showUserProfile
*/
function showUserProfile()
{
        $.ajax({
          type: "POST",
          url: "logged/ajax.php",
          data: "action=getProfile",
          cache: false,
          success: function(html){
			 	document.getElementById('profileView').innerHTML=html;

          }
        });
}
/*addComment*/
function addComment(id,secKey)
{
     var  msg = $('#comment_'+secKey).val(); // get the message
      if (msg.length > 100) // make sure character are within the limit, this is optional
      {
        alert("Characters must be only 100");
      }else if (msg == ""){
        alert("Please enter a message");
      }else{
        $('input[type=submit]').attr('disabled', true); // to prevent multiple insert at once
        $.ajax({
          type: "POST",
          url: "ajax/ajax.php",
          data: "action=addComment&msg=" + msg+"&id="+id+"&sec="+secKey,
          cache: false,
          success: function(html){
            $('#listdivComments_'+secKey).append(html);
            $('#listdivComments_'+secKey+'.list:last').hide().slideDown('slow'); // for effects only
            $('#comment_'+secKey).val("");// reset the textarea value
             $('#comment_'+secKey+'[type=submit]').attr('disabled', false);
          }
        });
      }
      return false;
	/*$('#'+secKey).append('test');
    $('#'+secKey+' .list:last').hide().slideDown('slow');*/
	 
}
function loginRegister(title,msg,login,register)
{
	//
	var content='<div><div class="imageClicable" onclick="loginForm()"><div class="buttonStyle followTextProfile paddingLeft" >'+login+'</div></div>';
	 			content+='<div class="imageClicable" onclick="openRegisterForm()"><div class="buttonStyle followTextProfile paddingLeft1" >'+register+'</div></div></div>';
	 			content+='<div class="warningFiled loginRegisterBox">'+msg+'</div>';
	 	 showBlockPopUpAjax('80%','200',title,content);
}
/*	
getFollwingList
*/
function getFollwingList(userId,secureV,title)
{
		showBlockPopUpAjax('500','150',title,showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=getFollowingReaderList&userId="+userId+"&secureV="+secureV,
		cache: false,
		success: function(html){
			showBlockPopUpAjax('500','auto',title,html);
		}
		});
}
/* getFollwersList*/
function getFollwersList(userId,secureV,title)
{
		showBlockPopUpAjax('500','150',title,showloaderImageOnly());
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=getFollowerReaderList&userId="+userId+"&secureV="+secureV,
		cache: false,
		success: function(html){
			showBlockPopUpAjax('500','auto',title,html);
		}
		});
}
/*
	report an error for a voice 
*/
function reportVoiceError(fileId,secureId)
{

	var content='<div><div class="imageClicable" onclick="closeDataBlock()"><div class="buttonStyle followTextProfile paddingLeft">Cancel</div></div>';
	content+='<div class="imageClicable"  onclick="onOkayThereisError(\''+fileId+'\',\''+secureId+'\')"><div class="buttonStyle followTextProfile paddingLeft1">Send Report</div></div></div>';
	 	 showBlockPopUpAjax('1000','200','Send Error',content);
}
function onOkayThereisError(fileId,secureId)
{
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "action=reportVoiceError&fileId="+fileId+"&secureId="+secureId,
		cache: false,
		success: function(html){
		showBlockPopUpAjax('1000','150','Error Report','<div class="imageClicable" style="width:100%">'+html+'</div>');
		}
		});
}
function loginForm()
{
	window.location='index.php?#tabs|:login';
}
function openRegisterForm()
{
	window.location='index.php?#tabs|:register';
}
function profilePage()
{
	window.location='index.php?#tabs|:profile';
}
function openRegisterFormTab()
{
	document.getElementById('Button____register').click();
	closeDataBlock();
}

/*Check if Mail is in Right form*/
function checkEmail(value){
	var errors=false;
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    var ArEmailExp = /[\u0600-\u06FF\u0750-\u077F]/;
    if(value.match(emailExp) && !value.match(ArEmailExp)){
        errors = true;
    }else{
        errors = false;
       // eMassage = mailMassage;
    }
	return errors;
   // handleErrors('regEmail');
}


function showloader(idDiv)
{
	document.getElementById(idDiv).innerHTML='<img src="img/preloader-flat.gif" width="32px" height="10px" border="0" />';
}
function showloaderImageOnly()
{
	return '<div style="position:relative;top:30px"><img src="img/preloader-flat.gif" width="17px" height="17px" border="0" /></div>';
}

function hideloader(idDiv)
{
	document.getElementById(idDiv).innerHTML='';
}

function goTo(target)
{
	window.location=target;
}



/* show block popup with ajax*/
function showBlockPopUpAjax(width,height,title,contentData)
{
     var dataBlock=document.getElementById('displayData');
	dataBlock.style.display='block';
	dataBlock.style.width=width+'px';
	if(height=='auto')
	dataBlock.style.height=height;else
	dataBlock.style.height=height+'px';
	
	dataBlock.style.width='85%';
	dataBlock.style.height='auto';
	
	dataBlock.style.left=getLeftValueForScroll(dataBlock)+"px";
	dataBlock.style.top=getTopValueForScroll(dataBlock)+"px";
	dataBlock.innerHTML=displayDataBlock();
	document.getElementById('titleForPopup').innerHTML=title;
    document.getElementById('innerContentInPopup').innerHTML = contentData+'<div style="float:left;height:50px;width:100%">&nbsp;</div>';
}
function showLoadingImg()
{
    return '<img src="img/preloader-flat.gif" width="17px" height="17px" border="0" />';
}
function closeDataBlock()
{
	document.getElementById('displayData').innerHTML=''
	;document.getElementById('displayData').style.display='none';
	unshadowAllBody();
}

function displayDataBlock()
{
	var data='';data+='<div id="headerforpopup" class="headerforpopup"><span class="titelinheaderforpopup" id="titleForPopup"></span><div class="closeiconinpopup"><img src="images/close.png" onclick="closeDataBlock()"></div></div>';data+='<div id="innerContentInPopup" class="grayBGinbox" style="text-align:center">'+showLoadingImg()+'</div>';return data;
}
function getTopValueForScroll(ele){var docW=0,sTop=0;if(document.body&&document.body.offsetWidth){sTop=document.body.scrollTop;}
if(sTop==0){if(document.compatMode=='CSS1Compat'&&document.documentElement&&document.documentElement.offsetWidth){sTop=document.documentElement.scrollTop;}}
if(ele.offsetHeight==0)
{var ob_array=(ele.style.height).split(" ");fullH=parseInt(ob_array[0])/2;}
else
fullH=ele.offsetHeight/2;winH=window.innerHeight/2;finalValue=winH-fullH+sTop;if(finalValue<0){finalValue=finalValue*-1;}
return finalValue}
function getLeftValueForScroll(ele)
{var docW=0,sLeft=0;if(document.body&&document.body.offsetWidth){docW=document.body.offsetWidth;sLeft=document.body.scrollLeft;}
if(docW==0&&sTop==0&&sLeft==0){if(document.compatMode=='CSS1Compat'&&document.documentElement&&document.documentElement.offsetWidth){docW=document.documentElement.offsetWidth;sLeft=document.documentElement.scrollLeft;}}
finalValue=((docW-ele.offsetWidth)/2)+sLeft;if(finalValue<0){finalValue=finalValue*-1;}
return finalValue}
function shadowAllBody()
{$(document).ready(function(){loadPopupBox();$('#popupBoxClose').click(function(){unloadPopupBox();});$('#popupBoxClose').click(function(){unloadPopupBox();});function unloadPopupBox(){$('#displayData').fadeOut("slow");$("#content").css({"opacity":"1"});}
function loadPopupBox(){$('#displayData').fadeIn("slow");$("#content").css({"opacity":"0.3"});}});}
function unshadowAllBody()
{$(document).ready(function(){unloadPopupBox();function unloadPopupBox(){$('#displayData').fadeOut("slow");$("#content").css({"opacity":"1"});}});}
/*shake image*/




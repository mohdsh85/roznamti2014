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
var mobile='../';
var setTabv='RecentRecords';
function setTab(v)
{
	setTabv=v;
}
function homePage()
{
	window.location='index.php';
}
var publicTime=0;
function playPause(id,t)
{
	publicTime=t;
	document.getElementById(publicTime+'_href_'+id).click();
}

function playPauseUsingPlayer(id,publicTime2)
{
	//1395582204_image_c81e728d9d4c2f636f067f89cc14862c
	if(	document.getElementById(publicTime2+'_image_'+id).className=='playPause playPauseClicked')
		document.getElementById(publicTime2+'_image_'+id).className='playPause';
	else	
		document.getElementById(publicTime2+'_image_'+id).className='playPause playPauseClicked';
}
/* followUnFollow*/
function followUnFollow(id,secureId,secureDiv)
{
				  // $('#followUnFollow_'+secureDiv).animate({left:'250px'});
				 // alert(1);
				  showloader(secureDiv);
					$.ajax({
					  type: "POST",
					  url: mobile+"social/ajax.php",
					  data: "action=followUnFollow&userToFollowId="+id+"&secureId="+secureId+'&secureDiv='+secureDiv,
					  cache: false,
					  success: function(html){
						  //$('selector').attr('href','http://example.com');
						 // alert(html);
						  	document.getElementById(secureDiv).innerHTML=html;
							updateFollowedMeList(id,secureId);
					  }
					});
}
/* followUnFollow*/
function updateFollowedMeList(id,secureId)
{
				  // $('#followUnFollow_'+secureDiv).animate({left:'250px'});
				 // alert(1);
					$.ajax({
					  type: "POST",
					  url: mobile+"social/ajax.php",
					  data: "action=updateFollowedMeList&userToFollowId="+id+"&secureId="+secureId,
					  cache: false,
					  success: function(html){
					  }
					});
}/*
	likeUnLike
*/
function showRecentRecordsLoader()
{
	 if(setTabv=='RecentRecords')//scrolling on recent record tab
	 {
		 	var currOffset=parseInt($('#offsetRecords').val());
			if(document.getElementById('loadingRecords'+currOffset))
	 			document.getElementById('loadingRecords'+currOffset).style.display='block';
	 }
}
/* filter users by list of lettere*/
function filterUsersLetter(letterIndex)
{
		  document.getElementById('serachResult').style.display='block';
			$.ajax({
			  type: "POST",
			  url: "ajax.php",
			  data: "action=filterReadersLetter&letterIndex="+letterIndex,
			  cache: false,
			  success: function(html){
				  document.getElementById('serachResult').innerHTML=html;
			  }
			});
}
/*
	het the latest records 
*/
function lastRecord()
{
			$.ajax({
			  type: "POST",
			  url: "ajax.php",
			  data: "action=getNewRecord",
			  cache: false,
			  success: function(html){
				  document.getElementById('newRecord').innerHTML=html;
			  }
			});
}
/*
	get latest records using scroll data 
*/
function showRecentRecords()
{
	 if(setTabv=='RecentRecords')//scrolling on recent record tab
	 {
		// document.getElementById('loaderImg').style.display='block';
		 	var currOffset=parseInt($('#offsetRecords').val());
			if(document.getElementById('loadingRecords'+currOffset))
	 			document.getElementById('loadingRecords'+currOffset).style.display='block';
			var nextOffset=currOffset+1;
		 	document.getElementById('offsetRecords').value=nextOffset;
			
			$.ajax({
			  type: "POST",
			  url: "ajax.php",
			  data: "action=loadMoreRecords&nextOffset="+nextOffset,
			  cache: false,
			  success: function(html){
				  	//	 document.getElementById('loaderImg').style.display='none';

				  if(html!=0)
				  {
				  	document.getElementById('Tab____RecentRecords').style.height=parseInt( document.getElementById('Tab____RecentRecords').style.height)+1500+'px';
	 				document.getElementById('loadingRecords'+currOffset).innerHTML=html;
					
				  }else
				  {
	 						document.getElementById('endRecords').style.display='block';
				  }
			  }
			});
	 }
	 
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
	like and unlike process
*/
function likeUnLike(recordId,secureV,request,unlikeT,likeT)
{
	var warning='';
	document.getElementById("lable_"+secureV).onclick=function (){alert('wait');};
        $.ajax({
          type: "POST",
          url: "ajax.php",
          data: "action=likeUnLike&recordId="+recordId+"&secureV="+secureV,
          cache: false,
          success: function(html){
			  if(html==0)///un expected error
			  {
					warning='<img src="images/emotions/img/expliation_mark.jpg" width="16" height="16" border="0" title="error found.." />';
					document.getElementById("text_"+secureV).innerHTML+=warning;
					if(request==1)//do like request
							document.getElementById("lable_"+secureV).onclick=function (){likeUnLike(recordId,secureV,0,unlikeT,likeT)};
					else
							document.getElementById("lable_"+secureV).onclick=function (){likeUnLike(recordId,secureV,1,unlikeT,likeT)};
			  }else// if every thing is okay
			  {
					if(request==1)//do like
					{
							var likeNum=parseInt(document.getElementById(secureV).innerHTML)+1;
							document.getElementById("text_"+secureV).innerHTML=warning;
							document.getElementById("text_"+secureV).className='functionImages  likeUnlikeStatus';
							document.getElementById(secureV).innerHTML=likeNum;
							document.getElementById("lable_"+secureV).onclick=function (){likeUnLike(recordId,secureV,0,unlikeT,likeT)};
					}else
					{
							var likeNum=parseInt(document.getElementById(secureV).innerHTML)-1;
							document.getElementById("text_"+secureV).innerHTML=warning;
							document.getElementById("text_"+secureV).className='functionImages  likeUnlike';
							document.getElementById(secureV).innerHTML=likeNum;
							document.getElementById("lable_"+secureV).onclick=function (){likeUnLike(recordId,secureV,1,unlikeT,likeT)};
					}
			  }
          }
        });

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
          url: mobile+"nonLogged/ajax.php",
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
          url: mobile+"nonLogged/ajax.php",
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
          url: "ajax.php",
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
/*
	registerNewUser
*/
function registerNewUser()
{
	 document.getElementById('error_user_full_name').style.display='none';
	 document.getElementById('error_user_email').style.display='none';
	 document.getElementById('error_user_gender').style.display='none';
	 document.getElementById('error_area_user_country').style.display='none';
	 document.getElementById('error_user_password').style.display='none';
	 document.getElementById('error_user_dob').style.display='none';
     var  user_full_name = $('#user_full_name').val(); // get the message
	 stringLength(user_full_name);
	 if(user_full_name=='')
	 {
		 document.getElementById('error_user_full_name').style.display='block';
		 focusElement('user_full_name');
		 return false;
	 }
     var  user_email = $('#user_email').val(); // get the message
	if(user_email=='')
	 {
		 document.getElementById('error_user_email').style.display='block';
 		 focusElement('user_email');
		 return false;
	 }
	if(!(checkEmail(user_email)))
	{
		 document.getElementById('error_user_email').style.display='block';
 		 focusElement('user_email');
		 return false;
	}
     var  user_gender = $('#user_gender').val(); // get the message
	 	if(user_gender=='-1')
	 {
		 document.getElementById('error_user_gender').style.display='block';
 		 focusElement('user_gender');
		 return false;
	 }
     var  user_country = $('#user_country').val(); // get the message
 	if(user_country=='-1')
	 {
		 document.getElementById('error_area_user_country').style.display='block';
 		 focusElement('user_country');
		 return false;
	 }
	 
     var  user_dob = $('#user_dob').val(); // get the message
 	if(user_dob=='-1')
	 {
		 document.getElementById('error_user_dob').style.display='block';
 		 focusElement('user_dob');
		 return false;
	 }

     var  user_password = $('#user_password').val(); // get the message
   	var  confirm_password = $('#confirm_password').val(); // get the message
	 if(user_password=='' || confirm_password=='' || confirm_password!=user_password)
	 {
		 document.getElementById('error_user_password').style.display='block';
 		 focusElement('user_password');
		 emptyField('user_password');
		 emptyField('confirm_password');
		 return false;
	 }
	 if(stringLength(user_password)<6)
	 {
		 document.getElementById('error_min_user_password').style.display='block';
		 emptyField('user_password');
		 emptyField('confirm_password');
		 return false;
	 }
	 document.getElementById('loadingArea').style.display='block';
	 document.getElementById('register').disabled=true;
	 document.getElementById('reset').disabled=true;
	saveNewUser(user_full_name,user_email,user_gender,user_country,user_password,confirm_password,user_dob);
	 
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
          url: mobile+"nonLogged/ajax.php",
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
/* register new user*/
function saveNewUser(user_full_name,user_email,user_gender,user_country,user_password,confirm_password,user_dob)
{
        $.ajax({
          type: "POST",
          url: mobile+"nonLogged/ajax.php",
          data: "action=registerNewUser&user_full_name="+user_full_name+"&user_email="+user_email+"&user_gender="+user_gender+"&user_country="+user_country+"&user_password="+user_password+"&confirm_password="+confirm_password+"&user_dob="+user_dob,
          cache: false,
          success: function(html){
			  var result=html.split('_');
			  if(result[0]==1)
			  {
			 		document.getElementById('loadingArea').innerHTML=result[1];
					redirectAfterRegisterPage();
			  }
				else
			 	document.getElementById('loadingArea').innerHTML=result[0];

          }
        });
}
function redirectAfterRegisterPage()
{
	window.location='?';
}
/*
	showUserProfile
*/
function showUserProfile()
{
        $.ajax({
          type: "POST",
          url: mobile+"logged/ajax.php",
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
	window.location='login.php';
}
function openRegisterForm()
{
	window.location='register.php';
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




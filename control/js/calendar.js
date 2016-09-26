/* mohammed al sharif */

function leadingZero(nr)
{
	if (nr < 10) nr = "0" + nr;
	return nr;
}


function getObj(objID)
{
    if (document.getElementById) {return document.getElementById(objID);}
    else if (document.all) {return document.all[objID];}
    else if (document.layers) {return document.layers[objID];}
}

function checkClick(e) {
	e?evt=e:evt=event;
	CSE=evt.target?evt.target:evt.srcElement;
	if (getObj('fc'))
		if (!isChild(CSE,getObj('fc')))
			getObj('fc').style.display='none';
}

function isChild(s,d) {
	while(s) {
		if (s==d) 
			return true;
		s=s.parentNode;
	}
	return false;
}

function Left(obj)
{
	var curleft = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;
	return curleft;
}

function Top(obj)
{
	var curtop = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
		curtop += obj.y;
	return curtop;
}
	
document.write('<table id="fc" style="z-index:10001;position:absolute;border-collapse:collapse;background:#FFFFFF;border:1px solid #ABABAB;display:none" class="smallCalender" cellpadding=2>');
document.write('<tr><td colspan=7><table border=0 align=center width=90% class="calenderHdr"><tr><td style="cursor:pointer" onclick="csubm()"  class="CalLeftArrow"><img src="images/cal_l_arrow.png"></td><td colspan=5 id="mns" align="center" style="font:bold 13px Arial"></td><td align="right" style="cursor:pointer" onclick="caddm()"><img src="images/cal_r_arrow.png"></td></tr></table></td></tr>');
document.write('<tr><th>S</th><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th></tr>');
for(var kk=1;kk<=6;kk++) {
	document.write('<tr>');
	for(var tt=1;tt<=7;tt++) {
		num=7 * (kk-1) - (-tt);
		document.write('<td id="v' + num + '" >&nbsp;</td>');
	}
	document.write('</tr>');
}
document.write('</table>');

document.all?document.attachEvent('onclick',checkClick):document.addEventListener('click',checkClick,false);


// Calendar script
var now = new Date;
var sccm=0;     //now.getMonth(); // starting disabled months before this months this is the default
var sccy=1920; //now.getFullYear();//2007
var ccm=now.getMonth();//defualt date from this month
var ccy=now.getFullYear(); //defualt date from this year 2007


//var sccm =leadingZero(sccmm);
//var ccm=leadingZero(ccmm);


var updobj;
function lcs(ielem) {
	updobj=ielem;
	getObj('fc').style.left=Left(ielem)+'px';
	getObj('fc').style.top=Top(ielem)+ielem.offsetHeight+'px';
	getObj('fc').style.display='';
	
	// First check date is valid
	curdt=ielem.value;
	curdtarr=curdt.split('/');
	isdt=true;
	for(var k=0;k<curdtarr.length;k++) {
		if (isNaN(curdtarr[k]))
			isdt=false;
	}
	if (isdt&(curdtarr.length==3)) {
		ccm=curdtarr[1]-1;
		ccy=curdtarr[2];
		prepcalendar(curdtarr[0],curdtarr[1]-1,curdtarr[2]);
	}
	
}

function evtTgt(e)
{
	var el;
	if(e.target)el=e.target;
	else if(e.srcElement)el=e.srcElement;
	if(el.nodeType==3)el=el.parentNode; // defeat Safari bug
	return el;
}
function EvtObj(e){if(!e)e=window.event;return e;}
function cs_over(e) {
	//evtTgt(EvtObj(e)).style.background='#FFCC66';
}
function cs_out(e) {
	//evtTgt(EvtObj(e)).style.background='#E9E9E9';
}
function cs_click(e) {
	updobj.value=calvalarr[evtTgt(EvtObj(e)).id.substring(1,evtTgt(EvtObj(e)).id.length)];
	getObj('fc').style.display='none';
	
}

var mn=new Array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
var mnn=new Array('31','28','31','30','31','30','31','31','30','31','30','31');
var mnl=new Array('31','29','31','30','31','30','31','31','30','31','30','31');
var calvalarr=new Array(42);

function f_cps(obj) {
	/*obj.style.background='#E9E9E9';
	obj.style.font='10px Arial';
	obj.style.color='#333333';
	obj.style.textAlign='center';
	obj.style.textDecoration='none';
	obj.style.border='0px solid #6487AE';*/
	obj.style.cursor='pointer';
	obj.style.background_image='url(images/cal_bg.jpg) repeat-x bottom';

}

function f_cpps(obj) {
	
	obj.style.background='#C4D3EA';
	obj.style.font='10px Arial';
	obj.style.color='#ABABAB';
	obj.style.textAlign='center';
	obj.style.textDecoration='line-through';
	obj.style.border='1px solid #6487AE';
	obj.style.cursor='default';
	/**/
}

function f_hds(obj) {
	/**/
	obj.style.background='#FFF799';
	obj.style.font='bold 10px Arial';
	obj.style.color='#333333';
	obj.style.textAlign='center';
	obj.style.border='1px solid #6487AE';
	obj.style.cursor='pointer';
	
}

// day selected
function prepcalendar(hd,cm,cy) {
	now=new Date();
	sd= 1;   //now.getDate();//
	//document.write(sd);
	td=new Date();
	td.setDate(1);
	td.setFullYear(cy);
	td.setMonth(cm);
	cd=td.getDay();
	//document.write(cd);
	getObj('mns').innerHTML=mn[cm]+ ' ' + cy;
	marr=((cy%4)==0)?mnl:mnn;
	for(var d=1;d<=42;d++) {
		f_cps(getObj('v'+parseInt(d)));
		if ((d >= (cd -(-1))) && (d<=cd-(-marr[cm]))) {
			dip=((d-cd < sd)&&(cm==sccm)&&(cy==sccy));
			htd=((hd!='')&&(d-cd==hd));
			if (dip)
				f_cpps(getObj('v'+parseInt(d)));
			else if (htd)
				f_hds(getObj('v'+parseInt(d)));
			else
				f_cps(getObj('v'+parseInt(d)));

			getObj('v'+parseInt(d)).onmouseover=(dip)?null:cs_over;
			getObj('v'+parseInt(d)).onmouseout=(dip)?null:cs_out;
			getObj('v'+parseInt(d)).onclick=(dip)?null:cs_click;
			
			getObj('v'+parseInt(d)).innerHTML=d-cd;	
			calvalarr[d]=''+cy+'-'+leadingZero(cm-(-1))+'-'+leadingZero(d-cd);
		}
		else {
			getObj('v'+d).innerHTML='-';
			getObj('v'+parseInt(d)).onmouseover=null;
			getObj('v'+parseInt(d)).onmouseout=null;
			getObj('v'+parseInt(d)).style.cursor='default';
			}
	}
}

prepcalendar('',ccm,ccy);
//getObj('fc'+cc).style.visibility='hidden';

function caddm() {
	marr=((ccy%4)==0)?mnl:mnn;
	
	ccm+=1;
	if (ccm>=12) {
		ccm=0;
		ccy++;
	}
	cdayf();
	prepcalendar('',ccm,ccy);
}

function csubm() {
	marr=((ccy%4)==0)?mnl:mnn;
	
	ccm-=1;
	if (ccm<0) {
		ccm=11;
		ccy--;
	}
	cdayf();
	prepcalendar('',ccm,ccy);
}

function cdayf() {
if ((ccy>sccy)|((ccy==sccy)&&(ccm>=sccm)))
	return;
else {
	ccy=sccy;
	ccm=sccm;
	cfd=scfd;
	}
}
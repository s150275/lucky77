/*
已知函式資料 :
pageIndex() : 首頁 , pageGame(){ : 立刻投注 , pageLimit() : 個人設定 , pageNewTick() : 下注明細
pageReport() : 歷史報表 , pageRule() : 規則說明 , pagePlayRule() : 玩法說明 , pageQA() : 常見問題
logout() : 登出遊戲
relogin() : 查詢是否已久未執行 , clickBet() : 選號 , randBet() : 系統亂數選號 , chBet() : 設定選號畫面 
toDate() : 改變剩下時間 , gogotime() : 計算開獎剩下時間 ,
creatRequestObj() : 產生AJAX物件 , loading() : 系統載入初始化
enterBet() : 確認投注 , sumBet() : 賭注總合
vuvuary() : 賠率星球欄位值

logintest() : , chpass() " , reCord() : , ggCord() : , 
addButton()  : , , reNum() : , html_01() : , html_02() : , 
padLeft() :  , noBet() : ,  
noPoint() : , sumBetT() : , pageTick() : , pageCord() : , showSWF() : , 
createSWFObject() : , dateChY() : , dateChM() : , dateChD() : , 
pageNextTick() : , addDate() : , alertReportV() : , alertReport() : , tabelReport() : , 
getReport() : , reNumP() : , lastBet() : , getLimit() : , reOdds() : , chOdds() : , 
pageEnd() : , commafy() : ,  setInterval() : , IdxArray() : , 
frombingo() : , chLang() : ,

已知變數資料 :
gamepoint : 會員遊戲點數
numberAry : 選取號碼陣列 ,
pCord , pCCord , f1log , ggCordi , st1 , valAry , enterBeting , 
betpoint , rTick , tickSet , tabelReportDate , getReportName , limitAry
roddsAry , 
*/
var buttonText=[300,301,302,303,304,305,306,307,308];
var buttonUrl=['pageIndex()','pageGame()','pageLimit()','pageNewTick()','pageReport()','pageRule()','pagePlayRule()','pageQA()','logout()'];
var modeName=[5000,5001,5002,5003,5004,5005,5006,5007,5008];
var modeName2=[[],[173,174],[175,176],[173,174],[],[],[],[],[]];
var tickErr=[354,355,355,355,355,355,355,356,357,358,359,357,360,361,362,362];
var name,point,period,opentime=40,page='index1',logining=true,lang='tw';
var Game_State = false;	// 遊戲狀態


// 產生AJAX物件
function creatRequestObj(){
	var a=null;
	try{
		a=new XMLHttpRequest;
	}catch(c){
		try{
			a=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(b){
			try{
				a=new ActiveXObject("Microsoft.XMLHTTP");
			}catch(d){
				a=null;
			}
		}
	}
	//a.overrideMimeType('text/txt;charset=utf-8;');
	return a;
}
// 登出遊戲
// 211 已安全登出本遊戲
function logout(){
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=logout&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			if(a=='sorry') alert('請由娛樂網首頁登出');
			else{
				alert(Lang(211));
				location.reload();
			}
		}
	}
	b.send(null);
}
// 登入系統
// 36 請輸入帳號
// 37 請輸入密碼
function login(){
	if(document.getElementById('logname').value.length<4){alert(Lang(36));return;}
	if(document.getElementById('logpass').value.length<4){alert(Lang(37));return;}
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=login&name='+
	document.getElementById('logname').value+'&pass='+document.getElementById('logpass').value+'&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			document.getElementById('logname').value='';
			document.getElementById('logpass').value='';
			if(a.indexOf('-1')>-1||a.indexOf('-2')>-1)alert(Lang(202));
			else if(a.indexOf('-3')>-1)alert(Lang(38));
			else if(a.indexOf('-4')>-1)alert(Lang(38));
			else if(a.indexOf('1')>-1){
				logining=true;
				f1log=true;
				pageGame();
				relogin();
			}
			else alert(Lang(39));
		}
	}
	b.send(null);
}
// ???加入登入訊息
function logintest(){
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=logintest&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			if(a=='1'){
				logining=true;
				f1log=true;
				pageGame();
				relogin();
			}
			else logintest();
		}
	}
	b.send(null);
}
// 
function chpass(){
	if(document.getElementById('opass').value<4||document.getElementById('npass').value<4||document.getElementById('cpass').value<4){alert(Lang(199));return;}
	if(document.getElementById('opass').value==document.getElementById('npass').value){alert(Lang(200));return;}
	if(document.getElementById('npass').value!=document.getElementById('cpass').value){alert(Lang(201));return;}
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=chpass&parameter='+document.getElementById('opass').value+','+document.getElementById('npass').value+'&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			alert(Lang(b.responseText.indexOf('-')>-1?202:203));
		}
	}
	b.send(null);
}
var pCord=null;
var pCCord='';
// 
function reCord(re){
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=record&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			if(a.indexOf('-')>-1){
			}else if(a.indexOf('@')>-1){
				pCord=a.split('@'); 
				//if(pCCord!=a){
					pCCord=a;
					setTimeout(pageTick,444);
					//();
					pageCord();
				//}
			}
		}else{
		}
	}
	b.send(null);
	if(re) setTimeout("reCord(true)",6666);
}
var f1log=false;
// 查詢是否已久未執行
// 321 會員帳號
// 32 遊戲點數
// 301 立刻投注
// 308 登出遊戲
function relogin(re){
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=renew&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			if(a.indexOf('-')>-1){
				if(logining){
					//alert("relogin");
					//pageIndex();
					/*
					if(a.indexOf('-7')>-1) alert(Lang('您帳號在其他地方被登入'));
					else alert(Lang('帳號閒置過久，已登出'));*/
					logining=false;
				}
			}else if(a.indexOf('@')>-1&&a.indexOf(',')>-1){
				var ary=a.split('@');
				name=ary[0],point=ary[1].split(',').join('');
				var pry=ary[2].split(',');
				period=pry[0],opentime=parseInt(pry[1],10);
				if(document.getElementById('htmllogin2')!=null){
					var html=
					Lang(321).replace('#n#',ary[0])+'<br>'+
					Lang(32)+' : '+ary[1]+'<br>'+
					'<span onclick="pageGame();" style="cursor:pointer;">'+Lang(301)+'</span> | '+
					'<span onclick="logout();" style="cursor:pointer;color:#00fff0;">'+Lang(308)+'</span>';					
					document.getElementById('htmllogin2').innerHTML=html;
					if(f1log){						
						f1log=false;
						pageGame();
					}
				}else if(page=='game'){
					if(document.getElementById('gameid')!=null)document.getElementById('gameid').innerHTML=ary[0];
					if(document.getElementById('gamepoint')!=null)document.getElementById('gamepoint').innerHTML=ary[1];
					if(document.getElementById('period')!=null)document.getElementById('period').innerHTML=pry[0];
				}
			}
		}
	}
	b.send(null);
	//document.getElementById('htmltest').innerHTML=''+logining+','+re+','+Date.parse(new Date);
	//setTimeout("relogin(true)",3000);
}
var ggCordi=true;
// 改變開獎期數文字變化
function ggCord()
{
	if(document.getElementById('ggCord')!=null)document.getElementById('ggCord').style.color=ggCordi?'#FFF':'#F00';
	if(document.getElementById('bigballno')!=null)document.getElementById('bigballno').style.color=ggCordi?'#000':'#F00';
	ggCordi=!ggCordi;
	setTimeout(ggCord,1000);
}
// 設定Menu按鈕
function addButton(){
	var html='<div class="mainbutton_left"></div>';
	for(var i=0;i<buttonText.length;i++) html+='<div class="mainbutton" style="left:'+(0+102*i)+'px;'+(i==buttonText.length-1?'color:#FF0;':'')+'" onclick="'+buttonUrl[i]+'">'+Lang(buttonText[i])+'</div>';
	html+='<div class="mainbutton_right"></div><a href="http://www.taiwanlottery.com.tw/Lotto/BINGOBINGO/drawing.aspx" target="new" id="mainbutton_url">'+Lang(309)+'</a>';//<div style="cursor:pointer;" onclick="logout();" class="mainbutton_logout"></div>';
	//document.getElementById('htmlbotton').innerHTML=html;
}
function kkpp(){
}
var st1=true;

// 首頁
function pageIndex(){
	page='index';
	var html='<div id="htmllogin"></div><div id="htmlnotice" style="line-height:29px;font-size:14px;">'+
	'<br><br>'+
	'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05-20&nbsp;新增春夏秋冬玩法,中獎更容易,玩法更有趣<br>'+
	'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05-01&nbsp;賓果開獎時間為07:05 ~ 24:00,每天共204場<br>'+
	'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;04-21&nbsp;新增即時線上直播系統<br>'+
	'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;04-10&nbsp;本公司配合之優質代理商系統為您服務~ <br>'+
	'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;04-01&nbsp;新增特別獎號新玩法,大小單雙隨你選<br>'+
	'</div><div id="htmlno_2"><div id="htmlno_3"><div id="htmlno"><div id="htmlno1" src="http://test.atm688.net/"><div id="htmlno2" src=""><div id="htmlno_1"><div id="htmlno1"><div id="htmlno2"></div><div></div></div></div></div><div id="htmltv"><embed width="295" height="207" allowfullscreen="true" allowscriptaccess="always" type="application/x-shockwave-flash" src="http://www.youtube.com/v/_soD8iJjgS8?version=3&autoplay=1&loop=1&playlist=_soD8iJjgS8"></embed></div><div id="htmlad"></div>';//<div id="htmladve"></div>
	document.getElementById('html').innerHTML=html;
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=renew&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			if(a.indexOf('-')>-1){
				var html=
				'<div id="htmllogin2">'+
				Lang(97)+'&nbsp;:&nbsp;&nbsp;<input type="text" id="logname" class="loginText" style="width:120px;"><br>'+
				Lang(98)+'&nbsp;:&nbsp;&nbsp;<input type="password" id="logpass" class="loginText" style="width:120px;" onkeyup="if(event.keyCode==13)login()"><br>'+
				'<div id="freebut" onclick="logintest()"></div>'+
				'<input type="button" class="loginButton" onclick="login()" value="">'+
				'</div>';
				document.getElementById('htmllogin').innerHTML=html;
				if(st1)relogin(true);
			}else{
				document.getElementById('htmllogin').innerHTML='<div id="htmllogin2"></div>';
				logining=true;
				relogin(true);
			}
			st1=false;
			pageCord();
		}
	}
	b.send(null);
}
// 選取號碼陣列
var numberAry=[];
// 系統亂數選號
// 336 : 關盤中
function randBet(p)
{
	//alert("randBet()系統亂數選號-傳入參數 : "+p);
	// p 亂數數目
	if(opentime < 1)
	{	alert(Lang(336));return;	}
	numberAry=[];
	while(numberAry.length != p)
	clickBet(Math.floor(Math.random()*80) + 1);
}
// 選號
// 336 : 關盤中
function clickBet(p)
{
	//alert("clickBet()選號-傳入參數 : "+p);
	if(opentime<1)
	{	alert(Lang(336));return;	}

	var on=true;
	// 查詢號碼是否已有選取
	for(var i = numberAry.length - 1 ; i > -1 ; i--)
	{
		if(numberAry[i]==p)
		{
			numberAry.splice(i,1) , i = -1 , on = false ;
		}
	}
	// 沒有選取且選取值少於8,加入陣列
	if(on && numberAry.length < 8)
	{	numberAry.push(p);	}
	chBet();	// 設定選號畫面
	sumBet();	// 賭注總合
	//alert(on + " - " + numberAry.length);
}
// 設定選號畫面
function chBet()
{
	// betB 沒有選取的Class , betC : 已有選取的Class
	for(var i = 1 ; i <= 80 ; i++)
	{// 把所有號碼設成沒有選取
		if(document.getElementById('d_'+i) != null)
		{// 把沒有選取的號碼設Class
			document.getElementById('d_'+i).className='betB';
		}
	}
	for(var i = 0 ; i < numberAry.length ; i++)
	{// 把有選取的號碼設定成選取Class
		if(document.getElementById('d_'+numberAry[i])!=null)
		{
			document.getElementById('d_'+numberAry[i]).className='betC';
		}
	}
	
	for(var i = 1 ; i <= 5 ; i++)
	{
		if( i > numberAry.length )
		{
			document.getElementById('sum_'+(i+2)).innerHTML='0';	// 注數
			document.getElementById('vuvuh_'+(i+2)).style.background = i % 2 == 0 ? '#FFF' : '';	// 星數
			document.getElementById('vuvuh_'+(i+2)).style.color='';
			document.getElementById('mo_'+(i+2)+'_0').value='';		// 押注點數
			document.getElementById('mo_'+(i+2)+'_0').disabled=true;
			document.getElementById('mo_'+(i+2)+'_0').style.background='#BBB';
		}
		else
		{
			var s=1;
			for(var j = 2 ; j <= numberAry.length ; j++) s*=j;
			for(var j = 2 ; j <= i ; j++) s/=j;
			for(var j = 2 ; j <= numberAry.length - i ; j++) s/=j;
			document.getElementById('sum_'+(i+2)).innerHTML=s;
			document.getElementById('vuvuh_'+(i+2)).style.background='#63C';
			document.getElementById('vuvuh_'+(i+2)).style.color='#FFF';
			document.getElementById('mo_'+(i+2)+'_0').disabled=false;
			document.getElementById('mo_'+(i+2)+'_0').style.background='#FFF';
		}
	}
}
// 
function reNum(t){
	return commafy(t.replace(/[^0-9-]/g,''));
}
// 
function html_01(x,y,a,b){
	var html=
	'<div style="position:absolute;left:'+x+'px;top:'+y+'px;">'+
	'<table cellpadding="0" cellspacing="0"><tr><td class="bdivp" style="border:0px"></td>'+
	'<td class="bdivo" id="odd_'+b+'" style="border:0px">0.00</td><td class="bdivt" style="width:85px;border:0px"><input id="mo_'+b+'" type="text" class="OF_T" disabled="true" onBlur="this.value=noPoint(this.value);sumBet()" onKeyUp="this.value=reNum(this.value)"></td></tr></table>'+ 
	'</div>';
	return html;//class="bdivttext"
}
// 
function html_02(x,y,a,b){
	var html=
	'<div style="position:absolute;left:'+x+'px;top:'+y+'px;">'+
	'<table cellpadding="0" cellspacing="0"><tr><td class="bdivp" style="border:0px"></td>'+
	'<td class="bdivo" id="odd_'+b+'" style="border:0px">0.00</td><td class="bdivt" style="width:90px;border:0px">&nbsp;&nbsp;<input id="mo_'+b+'" type="text" class="OF_T" disabled="true" onBlur="this.value=noPoint(this.value);sumBet()" onKeyUp="this.value=reNum(this.value)"></td></tr></table>'+ 
	'</div>';
	return html;//class="bdivttext"
}
// 個人設定
function pageLimit(){
	//if(!logining){alert(Lang(322));return;}
	page='limit';
	var html='<div class="htmltitle">'+Lang(302)+'</div><div class="htmltitle_left"></div><div class="htmltitle_right"></div><div id="htmllimit"></div>';
	document.getElementById('html').innerHTML=html;
	html=
	'<table border="0" cellspacing="0" cellpadding="0" class="table_list" style="position:absolute;top:50px;left:50px;width:500px;"><tr class="table_header">'+
	'<th>'+Lang(105)+'</th><th>'+Lang(107)+'</th><th>'+Lang(108)+'</th><th>'+Lang(109)+'</th></tr>';
	for(var i=0;i<modeName.length;i++) html+='<tr class="'+(i%2==0?'table_list_tr_bglight':'table_list_tr_bgdack')+'"><td align="center">'+Lang(modeName[i])+'</td><td id="l'+i+'" align="right"></td><td id="b'+i+'" align="right"></td><td id="m'+i+'" align="right"></td></tr>';
	html+=
	'</table>'+
	'<table border="0" cellspacing="0" cellpadding="0" class="table_list" style="position:absolute;top:50px;left:600px;width:250px;"><tr class="table_header">'+
	'<th></th><th>'+Lang(29)+'</th></tr>'+
	'<tr class="table_list_tr_bglight"><td align="right">'+Lang(196)+'</td><td align="center"><input type="password" id="opass" class="loginText"></td></tr>'+
	'<tr class="table_list_tr_bglight"><td align="right">'+Lang(197)+'</td><td align="center"><input type="password" id="npass" class="loginText"></td></tr>'+
	'<tr class="table_list_tr_bglight"><td align="right">'+Lang(198)+'</td><td align="center"><input type="password" id="cpass" class="loginText"></td></tr>'+
	'<tr><td align="center" height="30" colspan="2" class="table_footer"><div class="loginText" onclick="chpass()" style="cursor:pointer;">'+Lang(210)+'</div></td></tr>';
	'</table>';
	document.getElementById('htmllimit').innerHTML=html+pageEnd(400);
	getLimit();
}
// 改變剩下時間
// 250 時
// 251 分
// 252 秒
// 336 關盤中
function toDate(s){
	if( s == 0 ) return Lang(336);
	var v='&nbsp;';
	if(s>=3600) v+=padLeft(Math.floor(s/3600),2)+Lang(250);
	if(s>=60) v+=padLeft(Math.floor((s-(Math.floor(s/3600)*3600))/60),2)+Lang(251);
	v+=padLeft((s%60)+'',2)+Lang(252);
	//alert(v); 38秒
	return v;
}
// 計算開獎剩下時間
function gogotime()
{
	//alert(opentime);
	if(opentime > 0) opentime--;
	if(document.getElementById('opentime')!=null)
	{
		if(opentime == 0 && valAry.length != 0)
		{	noBet();	}
		document.getElementById('opentime').innerHTML=toDate(opentime);
	}
	setTimeout(gogotime,1000);
}
// 
function padLeft(s,l){
	if(s.length>=l) return s;
	else return padLeft('0'+s,l);
}
var valAry=[];

// 賭注總合
function sumBet()
{
	//alert("sumBet()-賭注總合");
	valAry=[];
	betpoint=0;
	for(var i = 0 ; i < 3 ; i++)
	{
		for(var j = 0 ; j < 2 ; j++)
		{	sumBetT(i,j);	}
	}
	
	for(var i = 3 ; i < 8 ; i++)
	{	sumBetT(i,0);	}
	/*
	var html=valAry.join("<br>");
	document.getElementById('htmltest').innerHTML=html;*/
}
// 沒有賭注
function noBet(){
	if(enterBeting)alert(Lang(343));
	valAry=[];numberAry=[];
	chBet();
	for(var i=0;i<3;i++) for(var j=0;j<2;j++) document.getElementById('mo_'+i+'_'+j).value='';
	for(var i=3;i<8;i++) document.getElementById('mo_'+i+'_0').value='';/*
	var html=valAry.join("<br>");
	document.getElementById('htmltest').innerHTML=html;*/
}
var enterBeting=false;
// 賭注下注
// 336 關盤中
// 343 投注中...請稍後再進行操作
// 344 投注點數總和高於遊戲點數
// 345 下注成功
// 346 下注失敗
// 347 您尚未下注
function enterBet(r)
{
	// 取出下注點數
	// 取出上限點數
	if(opentime < 1){alert(Lang(336));return;}
	if(enterBeting){alert(Lang(343));return;}
	alert("確認投注" + enterBeting + betpoint);
	if(r)sumBet();
	alert("確認投注" + enterBeting + betpoint);
	if(betpoint > point)
	{// 
		alert(Lang(344)+'('+commafy(betpoint)+' > '+commafy(point)+')');return;
	};
	
	if(betpoint > 0)
	{
		enterBeting=true;		
		var b=new creatRequestObj();
		b.open('GET','tick.php?var='+valAry.join('*')+'&'+Date.parse(new Date),!0);
		b.onreadystatechange=function(){
			if(b.readyState==4){
				enterBeting=false;
				//reCord(false);
				relogin(false);
				if(b.status==200){
					var a=b.responseText;
					var al=a.split(',');
					var v='',vn='';
					for(var i=0;i<valAry.length;i++){
						var u=valAry[i].split('@');
						if(al[i]=='-1')v+=Lang(modeName[u[0]])+'['+(u[0]<4?Lang(modeName2[u[0]][u[1]]):u[1])+']@'+Lang(166)+u[3]+"\t"+Lang(32)+" "+u[2]+"\n";
						else{
							if(al[i].indexOf('@')>-1)vn+=Lang(modeName[u[0]])+'['+(u[0]<4?Lang(modeName2[u[0]][u[1]]):u[1])+']@'+Lang(166)+u[3]+"\t"+Lang(32)+" "+u[2]+"\t"+Lang(165)+' ['+al[i].split('@')[1].split('-').join(',')+'] '+Lang(tickErr[al[i].split('@')[0]]).replace('#n#',al[i].split('@')[0])+"\n";
							else vn+=Lang(modeName[u[0]])+'['+(u[0]<4?Lang(modeName2[u[0]][u[1]]):u[1])+']@'+Lang(166)+u[3]+"\t"+Lang(32)+" "+u[2]+"\t"+Lang(tickErr[al[i]])+'('+al[i]+')'+"\n";
						}
					}
					noBet();
					pageTick();
					if(v!='')alert("------------------------"+Lang(345)+"------------------------\n"+v);
					if(vn!='')alert("------------------------"+Lang(346)+"------------------------\n"+vn);
				}else alert('線路不穩,下注失敗');
			}
		}
		b.send(null);		
	}
	else
	{	alert(Lang(347));	}
}
// 沒有點數
function noPoint(p){
	if(point<betpoint+parseInt(p.split(',').join(''),10)){alert(Lang(344));return '';}
	return p;
}
var betpoint=0;
// 賠率星球欄位值
function vuvuary(i)
{
	var tnum=[1,2,2,3,3];
	if(i >= 3)
	{// 
		var h2=[];
		for(var u = 0 ; u < tnum[i-3] ; u++)
		{
			h2.push(document.getElementById('odd_'+i+'_'+u).innerHTML);
			return h2.join(',');
		}
	}
}
// 
// 348 投注點數低於最低值
// 349 投注點數高於最高值
// 344 投注點數總和高於遊戲點數
function sumBetT(i,j)
{
//limitAry[0]=[50,50,50,50,30,30,30,30,30];	//
//limitAry[1]=[500,20000,20000,10000,10000,10000,3000,2000,1000];	//
//limitAry[2]=[10000,40000,40000,10000,20000,20000,3000,10000,2000];	//
	var k = parseInt(document.getElementById('mo_'+i+'_'+j).value.split(',').join(''),10);
	//alert( "sumBetT()  i : " + i + " j : " + j + " k : " + k);
	// 有設值
	if(k > 0)
	{
	//alert("sumBetT OK" + limitAry[0][0]);
		//if( k < limitAry[0][i+1] )
		if( k < 30 )
		{// 投注點數低於最低值
			k=0;
			alert(Lang(348)+' '+commafy(limitAry[0][i+1]));
		}
		
		if(k > limitAry[1][i+1])
		{// 投注點數高於最高值
			k=0;
			alert(Lang(349)+' '+commafy(limitAry[1][i+1]));
		}

		if(k > point)
		{// 投注點數總和高於遊戲點數
			k=0;
			alert(Lang(344)+' '+commafy(point));
		}
		var p = 1;

		// 星數資料
		if(i >= 3 )
		{
			// 注數資料
			p = parseInt(document.getElementById('sum_'+i).innerHTML,10);
			// 下注金額
			k *= p;
		}
		// 賠率
		var h = document.getElementById('odd_'+i+'_'+j).innerHTML;
		// 求出賠率欄位
		if(i >= 3)
		{	h = vuvuary(i);	}
		
		if(k > 0)
		{
			valAry.push((i+1)+'@'+(i>=3?numberAry.join(','):j)+'@'+k+'@'+h);
		}
		else
		{	document.getElementById('mo_'+i+'_'+j).value=commafy(p==0?0:k/p);	}
		betpoint += k;
	}
	//alert("sumBetT OK");
}
var rTick=[];
// 
function pageTick(){
	if(document.getElementById('pTick')==null) return;
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=tick&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			if(a.indexOf('-')>-1&&1==2)err(a);
			else if(a.indexOf('^')>-1){//&&a.indexOf('*')>-1&&a.indexOf('#')>-1
				var ra=a.split('^');
				rTick=ra[0].split('*');
				var rTick2=ra[1].split('#');
				var c=0,lp=[];
				var html=
				'<table width="100%" cellspacing="0" cellpadding="0" border="0" class="tickTable">'+
				'<tr><th colspan="4" style="color:#FFF;font-size:13px;background:#D2523C;letter-spacing:4px;">'+Lang(350)+'</th></tr>'+
				'<tr style="font-size:12px;"><td style="background:#FFFFDA">'+Lang(163)+'</td><td style="background:#FFFFDA">'+Lang(168)+'</td><td style="background:#FFFFDA">'+Lang(166)+'</td><td style="background:#FFFFDA">'+Lang(169)+'</td></tr>';
				if(ra[0].length>5)for(var i=0;i<rTick.length;i++){
					var g=rTick[i].split('@');
					if(Number(g[0])!=Number(period)) lp.push(rTick[i]);
					else{
						html+='<tr style="font-size:10px;"><td>'+String(g[0]).substr(4)+'</td>';
						var k='';
						if(g[1]<3){
							k+=Lang(modeName[g[1]])+'[';
							if(g[1]==1) k+=Lang(g[2]=='0'?173:174);
							if(g[1]==2) k+=Lang(g[2]=='0'?175:176);
							k+=']';
						}else if(g[1]==3) k+=Lang(modeName[g[1]])+'['+(Lang(g[2]=='0'?173:174))+']';
						else k=Lang(modeName[g[1]])+'['+g[2]+']';
						html+='<td>'+k+'</td>';
						html+='<td>'+(g[3].split(',').join('/'))+'</td><td>'+commafy(g[4])+'</td></tr>';
						c+=parseInt(g[4]);
					}
				}
				html+='<tr><th colspan="2" align="right">'+Lang(339)+'</th><td colspan="2">'+commafy(c)+'</td></tr>';
				if(lp.length){
					c=0;
					html+=
					'<tr><th colspan="4" style="color:#FFF;font-size:13px;background:#D2523C;letter-spacing:4px;">'+Lang(351)+'</th></tr>';
					for(var i=0;i<lp.length;i++){
						var g=lp[i].split('@');
						html+='<tr style="font-size:10px;"><td>'+String(g[0]).substr(4)+'</td>';
						var k='';
						if(g[1]<3){
							k+=Lang(modeName[g[1]])+'[';
							if(g[1]==1) k+=Lang(g[2]=='0'?173:174);
							if(g[1]==2) k+=Lang(g[2]=='0'?175:176);
							k+=']';
						}else if(g[1]==3) k+=Lang(modeName[g[1]])+'['+(Lang(g[2]=='0'?173:174))+']';
						else k=Lang(modeName[g[1]])+'['+g[2]+']';
						html+='<td>'+k+'</td>';
						html+='<td>'+(g[3].split(',').join('/'))+'</td><td>'+commafy(g[4])+'</td></tr>';
						c+=parseInt(g[4]);
					}
					html+='<tr><th colspan="2" align="right">'+Lang(339)+'</th><td colspan="2">'+commafy(c)+'</td></tr>';
					html+='</table>';
				}else{
					c=0;
					html+=
					'<tr><th colspan="4" style="color:#FFF;font-size:13px;background:#D2523C;letter-spacing:4px;">'+Lang(352)+'</th></tr>'+
					'<tr style="font-size:12px;"><td style="background:#FFFFDA">'+Lang(163)+'</td><td style="background:#FFFFDA">'+Lang(168)+'</td><td style="background:#FFFFDA">'+Lang(166)+'</td><td style="background:#FFFFDA">'+Lang(159)+'</td></tr>';
					if(ra[1].length>5)for(var i=0;i<rTick2.length;i++){
						var g=rTick2[i].split('@');
						html+='<tr style="font-size:10px;"><td>'+String(g[1]).substr(4)+'</td>';
						var k='';
						if(g[3]<3){
							k+=Lang(modeName[g[3]])+'[';
							if(g[3]==1) k+=Lang(g[4]=='0'?173:174);
							if(g[3]==2) k+=Lang(g[4]=='0'?175:176);
							k+=']';
						}else if(g[3]==3) k+=Lang(modeName[g[3]])+'['+(Lang(g[4]=='0'?173:174))+']';
						else k=Lang(modeName[g[3]])+'['+g[4]+']';
						html+='<td>'+k+'</td>';
						html+='<td>'+(g[5].split(',').join('/'))+'</td><td style="color:'+(Number(g[7])+Number(g[8])-Number(g[6])<0?'#F00':'#090')+'">'+commafy(Number(g[7])+Number(g[8])-Number(g[6]))+'</td></tr>';
						c+=(Number(g[7])+Number(g[8])-Number(g[6]));
					}
					html+='<tr><th colspan="2" align="right">'+Lang(339)+'</th><td colspan="2"  style="color:'+(c<0?'#F00':'#090')+'">'+commafy(c)+'</td></tr>';
				}
				html+='</table>';
				
				if(document.getElementById('pTick').innerHTML.toLowerCase()!=html.toLowerCase())document.getElementById('pTick').innerHTML=html;	
			}
		}else{
		}
	}
	b.send(null);	
}
// 
// 313 第 #n# 期
function pageCord(){
	if(pCord==null) return;
	var html='';
	if(document.getElementById('htmlno_1')!=null){
		var p=pCord[0].split(',');
		html='<table width="100%" cellspacing="0" cellpadding="0" border="0">'+
		'<tr><td colspan="30">'+p[1]+' '+Lang(310).replace('#n#',p[0])+'</td></tr>'+
		'<tr><td colspan="30" style="height:10px;"></td></tr><tr><td>'+Lang(311)+'</td>';
		for(var i=2;i<12;i++) html+='<td class="cord_b">'+String(Number(p[i])+100).substr(1)+'</td><td></td>';
		html+='<td style="width:100px;"></td></tr><tr><td colspan="30" style="height:5px;"></td></tr><tr><td></td>';
		for(var i=12;i<22;i++) html+='<td class="cord_'+(i==21?'r':'b')+'">'+String(Number(p[i])+100).substr(1)+'</td><td></td>';
		html+='<td></td></tr><tr><td colspan="30" style="height:10px;"></td></tr>'+
		'<tr><td>'+Lang(modeName[0])+'</td><td class="cord_r">'+String(Number(p[21])+100).substr(1)+'</td><td colspan="30" style="font-weight:1200;font-size:21px;text-align:left">'+Lang(Number(p[21])>40?173:174)+'&nbsp;&nbsp;&nbsp;&nbsp;'+Lang(Number(p[21])%2==1?175:176)+'</td></tr>'+
		'</table>';
		document.getElementById('htmlno_1').innerHTML=html;
	}
	if(document.getElementById('pCord')==null||pCord==null) return;
	var p1=pCord[0].split(','),d1=[],html2='';
	for(var j=2;j<p1.length;j++) d1.push(parseInt(p1[j])+100);
	d1.sort();
	for(var j=0;j<d1.length;j++) html2+='<td class="nowball'+(d1[j]-100==Number(p1[21])?'_r':'')+'">'+String(d1[j]).substr(1)+'</td><td style="background:#a95da7"></td>';
	html=
	'<table width="100%" cellspacing="0" cellpadding="0" border="0">'+
	'<tr><td class="bignowta" colspan="'+(1+d1.length*2)+'" align="center" style="font-size:16px;">'+Lang(312)+'&nbsp;&nbsp;'+Lang(313).replace('#n#','<span id="bigballno">'+p1[0]+'</span>')+'&nbsp;&nbsp;'+Lang(164)+'&nbsp;&nbsp;'+p1[1]+'</td></tr>'+
	'<tr><td style="background:#a95da7"></td>'+html2+'</tr></table>'+
	'<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table_ball">'+
	'<tr><th style="color:#FF0;height:50px;">'+Lang(315)+'</th><th style="color:#FF0;font-size:21px;">'+Lang(314)+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="image/b1/ball_background_22.gif" style="position:absolute; top:85px;left:455px;"><span style="color:#FFF;font-size:12px;top:20px;">'+Lang(320)+'</span></th><th style="color:#FF0;" width="3%">'+Lang(316)+'</th><th style="color:#FF0;" width="4%">'+Lang(317)+'</th><th style="color:#FF0;" width="4%">'+Lang(318)+'</th><th style="color:#FF0;" width="4%">'+Lang(319)+'</th></tr>';	
	for(var i=0;i<pCord.length-1;i++){
		var p=pCord[i].split(',');		
		html+='<tr style="height:50px;"><td class="cord_a" style="font-size:12px;">'+p[0]+'<br>'+p[1]+'</td><td class="cord_a">';
		var u=[0,0],d=[],hoo=0;
		for(var j=2;j<p.length;j++) d.push(parseInt(p[j])+100);
		if(i+1<pCord.length){
			var p2=pCord[i+1].split(',');		
			for(var j=2;j<p.length;j++) for(var j2=2;j2<p2.length;j2++) if(p[j]==p2[j2]) hoo++;
		}
		d.sort();
		for(var j=0;j<d.length;j++){ 
			html+='<div class="cord_'+(parseInt(p[21])==d[j]-100?'r':'b')+'">'+String(d[j]).substr(1)+'</div>';
			u[parseInt(d[j])-100<41?0:1]++;
		}
		html+='</td>'+
		'<td align="center" class="cord_a" style="font-size:19px;">'+hoo+'</td>'+
		'<td align="center" class="cord_a" style="color:'+(u[1]>=13?'#0F0':'#FFF')+'">'+Lang(u[0]>=13?174:(u[1]>=13?173:178))+'</td>'+
		'<td align="center" class="cord_a" style="color:'+(parseInt(p[21])>40?'#0F0':'#FFF')+'">'+Lang(parseInt(p[21])<41?174:173)+'</td>'+
		'<td align="center" class="cord_a" style="color:'+(parseInt(p[21])%2==0?'#0F0':'#FFF')+'">'+Lang(parseInt(p[21])%2==0?176:175)+'</td>'+
		'</tr>';
	}
	html+='</table>';
	document.getElementById('pCord').innerHTML=html;
	var lo=pCord[0].split(',');
	html=
	'<table width="100%" cellspacing="0" cellpadding="0" border="0">'+
	'<tr><td colspan="4" align="center">'+Lang(313).replace('#n#','<span id="ggCord">'+lo[0]+'</span>')+'</td></tr>'+
	'<tr><td rowspan="2" width="10%"></td><td rowspan="2" align="center" class="cord_rb">'+String(parseInt(lo[21])+100).substr(1)+'</td><td></td><td align="center" style="font-size:15px;">'+Lang(Number(lo[21])>40?173:174)+'</td></tr>'+
	'<tr><td></td><td align="center" style="font-size:15px;">'+Lang(Number(lo[21])%2==1?175:176)+'</td></tr>'+
	'</table>';
	if(document.getElementById('pCordNew').innerHTML.toLowerCase()!=html.toLowerCase())document.getElementById('pCordNew').innerHTML=html;
}
// 
function showSWF(urlString, elementID){ 
    var displayContainer = document.getElementById(elementID); 
    var flash = createSWFObject(urlString, 'opaque', 275, 190); 
    displayContainer.appendChild(flash); 
}

// 
function createSWFObject(urlString, wmodeString, width, height){ 
    var SWFObject = document.createElement("object"); 
    SWFObject.setAttribute("type","application/x-shockwave-flash"); 
    SWFObject.setAttribute("width","100%"); 
    SWFObject.setAttribute("height","100%"); 
    var movieParam = document.createElement("param"); 
    movieParam.setAttribute("name","movie"); 
    movieParam.setAttribute("value",urlString); 
    SWFObject.appendChild(movieParam); 
    var wmodeParam = document.createElement("param"); 
    wmodeParam.setAttribute("name","wmode"); 
    wmodeParam.setAttribute("value",wmodeString); 
    SWFObject.appendChild(wmodeParam);      
    return SWFObject; 
} 
// 
function dateChY(n){
	var y=(new Date()).getFullYear();
	var html='<select class="setcss" onchange="if(tickSet['+n+']!=this.value){tickSet['+n+']=this.value;getReport(\'bettick\');}" onblur="if(tickSet['+n+']!=this.value){tickSet['+n+']=this.value;getReport(\'bettick\');}" style="width:55px;">';
	for(var i=0;i<3;i++) html+='<option '+(y-i==tickSet[n]?'selected':'')+' value="'+(y-i)+'">'+(y-i)+'</option>';
	html+='</select>'; 
	return html;
}
// 
function dateChM(n){
	var m=(new Date()).getMonth()+1;
	var html='<select class="setcss" onchange="if(tickSet['+n+']!=this.value){tickSet['+n+']=this.value;getReport(\'bettick\');}" onblur="if(tickSet['+n+']!=this.value){tickSet['+n+']=this.value;getReport(\'bettick\');}" style="width:40px;">';
	for(var i=1;i<13;i++) html+='<option '+(i==tickSet[n]?'selected':'')+' value="'+String(100+i).substr(1)+'">'+String(100+i).substr(1)+'</option>';
	html+='</select>'; 
	return html;
}
// 
function dateChD(n){
	var m=(new Date()).getDate();
	var html='<select class="setcss" onchange="if(tickSet['+n+']!=this.value){tickSet['+n+']=this.value;getReport(\'bettick\');}" onblur="if(tickSet['+n+']!=this.value){tickSet['+n+']=this.value;getReport(\'bettick\');}" style="width:40px;">';
	for(var i=1;i<32;i++) html+='<option '+(i==tickSet[n]?'selected':'')+' value="'+String(100+i).substr(1)+'">'+String(100+i).substr(1)+'</option>';
	html+='</select>'; 
	return html;
}
var tickSet=[(new Date()).getFullYear(),String((new Date()).getMonth()+101).substr(1),String((new Date()).getDate()+100).substr(1),(new Date()).getFullYear(),String((new Date()).getMonth()+101).substr(1),String((new Date()).getDate()+100).substr(1)];
// 歷史報表
function pageReport(){
	if(!logining){alert(Lang(322));return;}
	page='tick';
	tickSet=[(new Date()).getFullYear(),String((new Date()).getMonth()+101).substr(1),String((new Date()).getDate()+100).substr(1),(new Date()).getFullYear(),String((new Date()).getMonth()+101).substr(1),String((new Date()).getDate()+100).substr(1)];
	var html='<div class="htmltitle">'+Lang(304)+'</div><div class="htmltitle_left"></div><div class="htmltitle_right"></div><div id="htmltick"></div>';
	document.getElementById('html').innerHTML=html+pageEnd(600);
	html=
	'<table border="0" cellspacing="0" cellpadding="0" width="100%">'+
	'<tr><td style="width:50px;"></td><td align="center" style="background:#FFF;font-family:Verdana, Geneva, sans-serif;color:#000;">'+Lang(141)+'&nbsp;&nbsp;'+
	'<span id="date_s_y">'+dateChY(0)+'</span>&nbsp;-'+
	'<span id="date_s_m">'+dateChM(1)+'</span>-'+
	'<span id="date_s_d">'+dateChD(2)+'</span>&nbsp;~&nbsp;'+
	'<span id="date_e_y">'+dateChY(3)+'</span>&nbsp;-'+
	'<span id="date_e_m">'+dateChM(4)+'</span>-'+
	'<span id="date_e_d">'+dateChD(5)+'</span>&nbsp;&nbsp;'+
	'<input type="button" class="alerttext_b" style="width:40px;" value="'+Lang(142)+'" onclick="addDate(0)">&nbsp;'+
	'<input type="button" class="alerttext_b" style="width:40px;" value="'+Lang(143)+'" onclick="addDate(1)">&nbsp;'+
	'<input type="button" class="alerttext_b" style="width:40px;" value="'+Lang(144)+'" onclick="addDate(2)">&nbsp;'+
	'<input type="button" class="alerttext_b" style="width:40px;" value="'+Lang(145)+'" onclick="addDate(3)">&nbsp;'+
	'<input type="button" class="alerttext_b" style="width:40px;" value="'+Lang(146)+'" onclick="addDate(4)">&nbsp;'+
	'<input type="button" class="alerttext_b" style="width:40px;" value="'+Lang(147)+'" onclick="addDate(5)">'+
	'</td><td style="width:50px;"></td></tr><tr><td></td><td id="ticktable"></td><td></td></tr></table>';
	document.getElementById('htmltick').innerHTML=html;
	getReport('bettick');
}
// 下注明細
function pageNewTick(){
	if(!logining){alert(Lang(322));return;}
	page='newtick';
	var html='<div class="htmltitle">'+Lang(303)+'</div><div class="htmltitle_left"></div><div class="htmltitle_right"></div><div id="htmltick"></div>';
	document.getElementById('html').innerHTML=html+pageEnd(600);
	html=
	'<table border="0" cellspacing="0" cellpadding="0" width="100%">'+
	'<tr><td></td><td> </td><td></td></tr><tr><td width="100"></td><td id="ticktable"></td><td width="100"></td></tr></table>';
	document.getElementById('htmltick').innerHTML=html;
	getReport('newbettick');
}
// 
function pageNextTick(){
	if(!logining){alert(Lang(322));return;}
	page='nexttick';
	var html='<div class="htmltitle">'+Lang(353)+'</div><div class="htmltitle_left"></div><div class="htmltitle_right"></div><div id="htmltick"></div>';
	document.getElementById('html').innerHTML=html+pageEnd(600);
	html=
	'<table border="0" cellspacing="0" cellpadding="0" width="100%">'+
	'<tr><td></td><td> </td><td></td></tr><tr><td width="100"></td><td id="ticktable"></td><td width="100"></td></tr></table>';
	document.getElementById('htmltick').innerHTML=html;
	getReport('nextbettick');
}
// 
function addDate(n){
	var a1=(new Date()).valueOf(),a2=(new Date()).valueOf(),d=(new Date()).getDay();
	if(d==0) d=6;else d--;
	if(n==1) a1-=3600*24*1000,a2-=3600*24*1000;
	if(n==2) a1-=3600*24*1000*d,a2+=3600*24*1000*(6-d);
	if(n==3) a1-=3600*24*1000*(d+7),a2-=3600*24*1000*(d+1);
	var d1=new Date(a1),d2=new Date(a2);
	if(n==4) d1=new Date((new Date()).getFullYear(),(new Date()).getMonth(),1),d2=new Date((new Date()).getFullYear(),(new Date()).getMonth()+1,0);
	else if(n==5) d1=new Date((new Date()).getFullYear(),(new Date()).getMonth()-1,1),d2=new Date((new Date()).getFullYear(),(new Date()).getMonth(),0);
	tickSet[0]=d1.getFullYear();
	tickSet[1]=String(d1.getMonth()+101).substr(1);
	tickSet[2]=String(d1.getDate()+100).substr(1);
	tickSet[3]=d2.getFullYear();
	tickSet[4]=String(d2.getMonth()+101).substr(1);
	tickSet[5]=String(d2.getDate()+100).substr(1);
	document.getElementById('date_s_y').innerHTML=tickSet[0];
	document.getElementById('date_s_m').innerHTML=tickSet[1];
	document.getElementById('date_s_d').innerHTML=tickSet[2];
	document.getElementById('date_e_y').innerHTML=tickSet[3];
	document.getElementById('date_e_m').innerHTML=tickSet[4];
	document.getElementById('date_e_d').innerHTML=tickSet[5];
	getReport('bettick');
}
var tabelReportDate=null,tabelReportPage=0;
// 
function alertReportV(){
	document.getElementById('alertReport').innerHTML='';
	document.getElementById('alertReport').style.display="none";
	document.getElementById('alertbg').style.display="none";
}
// 
function alertReport(i){
	if(document.getElementById('alertReport')==null) document.body.innerHTML+='<div id="alertbg" onclick="alertReportV()"></div><div id="alertReport"></div>';
	document.getElementById('alertReport').style.display="";
	document.getElementById('alertbg').style.display="";
	var g=tabelReportDate[i].split('@'),nary=[];
	if(Number(g[3])<4) nary.push(ary[i]);
	else{
		var nu=frombingo(g[4].split(','),Number(g[3])-3),rn=g[9].split(','),od=g[5].split(',');
		for(var j=6;j<9;j++) g[j]=Number(g[j])/nu.length;
		for(var j=0;j<nu.length;j++){
			var k=0;
			for(var p=0;p<rn.length;p++) for(var u=0;u<nu[j].length;u++)if(Number(rn[p])==Number(nu[j][u])) k++;
			if(Number(g[3])<6&&k>0) k=od[k-1]*g[6];
			else if(Number(g[3])<8&&k>1) k=od[k-2]*g[6];
			else if(Number(g[3])<9&&k>2) k=od[k-3]*g[6];
			else k=0;
			g[7]=k;
			g[4]=nu[j];
			nary.push(g.join('@'));
		}
	}
	var html=
	'<table border="0" cellspacing="0" cellpadding="0" class="table_list" width="100%"><tr class="table_header" style="height:12px;">'+
	'<td align="center">'+Lang(167)+'</td><td align="center">'+Lang(165)+'</td><td align="center">'+Lang(169)+'</td><td id="wat_0" align="center" style="display:none">'+Lang(161)+'</td><td align="center" '+(page=='newtick'?'style="display:none"':'')+'>'+Lang(159)+'</td></tr>';
	var s=[0,0,0],ss=[0,0,0],wat=1;
	for(var i=0;i<nary.length;i++){
		var w=nary[i].split('@'); 
		var h=[Number(w[6]),Number(w[7])+Number(w[8])-Number(w[6]),Number(w[8])];
		if(1==1){
			var g=w[4].split(','),g9=w[9].split(',');
			for(var j=0;j<g.length;j++){
				var st='';
				for(var k=0;k<g9.length;k++) if(g[j]==g9[k])st=' style="font-weight:900;color:#F00;"';
				g[j]='<span'+st+'>'+String(100+Number(g[j])).substr(1)+'</span>';
			}
			w[4]=g.join(',');
			html+=
			'<tr class="'+(i%2==0?'table_list_tr_bglight':'table_list_tr_bgdack')+'">'+
			'<td align="center">No.'+(i+1)+'</td>'+
			'<td align="center">'+w[4]+'</td>'+
			'<td align="right" style="color:#090">'+reNumP(h[0])+'</td>'+
			'<td id="wat_'+wat+'" align="right" style="color:#999;display:none;">'+reNumP(h[2])+'</td>'+
			'<td align="right" style="color:#'+(h[1]>0?'0A0':'F00')+';'+(page=='newtick'?'display:none':'')+';">'+reNumP(h[1])+'</td>'+
			'</tr>';
			ss[0]+=h[0],ss[1]+=h[1],ss[2]+=h[2],wat++;
		}
		s[0]+=h[0],s[1]+=h[1],s[2]+=h[2];
	}
	html+='</table>';	
	var htmltop='<div id="alertReportTop"  onclick="alertReportV()">X</div>';
	document.getElementById('alertReport').innerHTML=htmltop+html;
	if(page!='newtick') if(s[2]!=0) for(var i=0;i<wat;i++)document.getElementById('wat_'+i).style.display='';
}
// 
function tabelReport(pa){
	var html=
	'<table border="0" cellspacing="0" cellpadding="0" class="table_list" width="100%"><tr class="table_header" style="height:12px;">'+
	'<td align="center">'+Lang(167)+'</td><td align="center">'+Lang(162)+'</td><td align="center">'+Lang(163)+'</td><td align="center">'+Lang(164)+'</td><td align="center">'+Lang(165)+'</td><td align="center">'+Lang(166)+'</td><td align="center">'+Lang(209)+'</td><td align="center">'+Lang(32)+'</td><td id="ww_0" align="center" style="display:none">'+Lang(161)+'</td><td align="center" '+(page=='newtick'?'style="display:none"':'')+'>'+Lang(159)+'</td></tr>';
	var s=[0,0,0],ss=[0,0,0],ssp=12,ww=1;
	if(tabelReportDate[0].length>10)for(var i=0;i<tabelReportDate.length;i++){
		var w=tabelReportDate[i].split('@'); 
		var h=[Number(w[6]),Number(w[7])+Number(w[8])-Number(w[6]),Number(w[8])];
		if(i>=Number(pa)*ssp&&i<(Number(pa)+1)*ssp){
			var g=w[4].split(','),g9=w[9].split(',');
			for(var j=0;j<g.length;j++){
				var st='';
				for(var k=0;k<g9.length;k++) if(g[j]==g9[k])st=' style="font-weight:900;color:#F00;"';
				g[j]='<span'+st+'>'+String(100+Number(g[j])).substr(1)+'</span>';
			}
			if(w[3]==1||w[3]==3) w[4]=Lang(parseInt(w[4])==0?173:174);
			else if(w[3]==2) w[4]=Lang(parseInt(w[4])==0?175:176);
			else w[4]=g.join(',');
			var su=1;
			if(w[3]>3){
				for(var j=2;j<=g.length;j++) su*=j;
				for(var j=2;j<=w[3]-3;j++) su/=j;
				for(var j=2;j<=g.length-w[3]+3;j++) su/=j;
			}
			html+=
			'<tr class="'+(i%2==0?'table_list_tr_bglight':'table_list_tr_bgdack')+'">'+
			'<td align="center">No.'+(i+1)+'</td>'+
			'<td align="center">'+w[0]+'</td>'+
			'<td align="center">'+w[1]+'</td>'+
			'<td align="center">'+w[2]+'</td>'+
			'<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;'+Lang(modeName[w[3]])+(w[3]>3&&g.length!=w[3]-3?Lang(177):'')+' ['+w[4]+']</td>'+
			'<td align="center">'+w[5].split(',').join('/')+'</td>'+					
			'<td align="right" style="color:#00B;cursor:pointer;" '+(s==1?'':'onclick="alertReport('+i+')"')+'>'+reNumP(su)+'</td>'+			
			'<td align="right" style="color:#090">'+reNumP(h[0])+'</td>'+
			'<td id="ww_'+ww+'" align="right" style="color:#999;display:none">'+reNumP(h[2])+'</td>'+
			'<td align="right" style="color:#'+(h[1]>0?'0A0':'F00')+';'+(page=='newtick'?'display:none':'')+';">'+reNumP(h[1])+'</td>'+
			'</tr>';
			ss[0]+=h[0],ss[1]+=h[1],ss[2]+=h[2],ww++;
		}
		s[0]+=h[0],s[1]+=h[1],s[2]+=h[2];
	}
	var seda='<select class="setcss" onchange="tabelReport(this.value)">';
	for(var i=0;i<Math.ceil(tabelReportDate.length/ssp);i++)
		seda+='<option value='+i+' '+(Number(pa)==i?'selected':'')+'>'+Lang(190).replace('#n#',i+1)+'</option>';
	seda+'</select>';
	html+='<tr style="background:#DDD;"><td colspan="7" align="right" style="font-weight:900;color:#00F">'+Lang(193)+'</td><td align="right" style="color:#090">'+reNumP(ss[0])+'</td><td align="right" id="ww_'+ww+'" style="color:#999;display:none;">'+reNumP(ss[2])+'</td><td align="right" style="color:#'+(ss[1]>0?'0A0':'F00')+';'+(page=='newtick'?'display:none':'')+';">'+reNumP(ss[1])+'</td></tr>'+
	'<tr style="background:#DDD;"><td align="center" colspan="6" style="color:#000">'+seda+'</td><td align="right" style="font-weight:900;color:#00F">'+Lang(159)+'</td><td align="right" style="color:#00B">'+reNumP(s[0])+'</td><td align="right" id="ww_'+(ww+1)+'" style="color:#999;display:none;">'+reNumP(s[2])+'</td><td align="right" style="color:#'+(s[1]>0?'0A0':'F00')+';'+(page=='newtick'?'display:none':'')+';">'+reNumP(s[1])+'</td></tr>';
	html+='</table>';
	document.getElementById('ticktable').innerHTML=html;
	if(page!='newtick'&&s[2]>0) for(var i=0;i<ww+2;i++) document.getElementById('ww_'+i).style.display='';
}
var getReportName;
// 
function getReport(v){
	getReportName=v;
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct='+v+'&parameter='+tickSet.join(',')+'&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			var ary=b.responseText.split('#'),nary=[];/*
			if(ary[0].indexOf('@')>-1)for(var i=0;i<ary.length;i++){
				var g=ary[i].split('@');
				if(Number(g[3])<4) nary.push(ary[i]);
				else{
					var nu=frombingo(g[4].split(','),Number(g[3])-3),rn=g[9].split(','),od=g[5].split(',');
					for(var j=6;j<9;j++) g[j]=Number(g[j])/nu.length;
					for(var j=0;j<nu.length;j++){
						var k=0;
						for(var p=0;p<rn.length;p++) for(var u=0;u<nu[j].length;u++)if(Number(rn[p])==Number(nu[j][u])) k++;
						if(Number(g[3])<6&&k>0) k=od[k-1]*g[6];
						else if(Number(g[3])<8&&k>1) k=od[k-2]*g[6];
						else if(Number(g[3])<9&&k>2) k=od[k-3]*g[6];
						else k=0;
						g[7]=k;
						g[4]=nu[j];
						nary.push(g.join('@'));
					}
				}
			}*/
			tabelReportDate=b.responseText.split('#');//a.split('#');
			tabelReport(0);
		}
	}
	b.send(null);	
}
// 
function reNumP(num){
	num=num+'';
	if(num.indexOf('.')==-1) return reNum(num);
	var nums=num.split('.');
	var numd=(nums[1].replace(/[^0-9-]/g,'')).substr(0,2);
	if(numd=='0'||numd=='00') return reNum(nums[0]);
	return reNum(nums[0])+'.'+numd;
}
// 立刻投注
function pageGame(){
	location.href = "pageGame.php" ;
	return false;
	//if(!logining){alert(Lang(322));return;}
	//alert(2221111);
	// 308 登出遊戲 , 323 會員名稱 , 324 當前期數 , 325 投注剩餘時間 , 326 開獎期數 , 327 超獎猜
	// 328 猜大小 , 342 刷新 , 
	page='game';
	var html='<div class="htmltitle"><marquee>歡迎光臨：。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;本站所提供之遊戲,純屬娛樂點數購買,嚴禁會員有賭博行為,如有違反自行負責。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如遇台灣彩卷賓果官網流量爆衝，使本網達不到採集效果時，而造成無法顯示開獎結果，下注單乃識為有效單。敬請各會員見諒。 </marquee></div><div class="htmltitle_left"></div><div class="htmltitle_right"></div><div id="htmlgame"></div><div id="starform"></div><div id="pCord"></div><div id="pTick"></div><div id="pCordNew"></div><div id="pAdNew"><iframe id="tviframe" scrolling="no" width="100%" height="100%" frameborder="0" src="bingo/tv.html?'+(new Date())+'"></iframe></div></div>';
	document.getElementById('html').innerHTML=html;
	//showSWF("http://kim888.tw/LoadUi.swf","pAdNew");//http://kim888.tw/LoadUi.swf
	html=
	'<div id="mycfg">'+Lang(323)+':<span id="gameid">'+name+'</span>&nbsp;<span style="color:#FF0;">'+Lang(32)+':</span><span id="gamepoint" style="color:#FFF;">'+
	commafy(point)+'</span>&nbsp;&nbsp;<span style="font-size:19px;">'+
	Lang(324)+':<span id="period" style="color:#F00;">'+period+'</span>&nbsp;&nbsp;'+
	Lang(325)+':<span id="opentime" style="color:#0FF;">'+toDate(opentime)+'</span>&nbsp;&nbsp;<span onclick="pageGame();" style="font-size:21px;cursor:pointer;color:#FF0;">['+Lang(342)+']</span>&nbsp;&nbsp;<span onclick="logout();" style="font-size:21px;cursor:pointer;color:#FF0;">['+Lang(308)+']</span></div>'+
	'<div class="divtr" style="width:705px;left:290px;top:50px;">'+
	'<div class="divtrti" style="left:15px;">'+Lang(326)+'</div>'+
	'<div class="divtrti" style="left:265px;">'+Lang(327)+'</div>'+
	'<div class="divtrti" style="left:570px;">'+Lang(328)+'</div>'+
	'</div><div id="tlrubg"></div><div id="tl28vu"></div>'+
	html_02(420,90,'','0_0')+html_02(420,130,'','0_1')+
	html_02(610,90,'','1_0')+html_02(610,130,'','1_1')+
	html_01(820,90,'','2_0')+html_01(820,130,'','2_1')+
	'<div class="divtr" style="width:443px;left:290px;top:175px;"><div class="divtrti">'+Lang(329)+'</div>'+
	'<div class="divtrtx">'+Lang(331)+'</div></div>'+
	'<div class="divtr" style="width:443px;left:290px;top:275px;"><div class="divtrti">'+Lang(330)+'</div>'+
	'<div class="divtrtx">'+Lang(332)+'</div></div>';
	for(var i=1;i<=8;i++) html+='<div class="betB" style="top:'+(215+(i>4?30:0))+'px;left:'+(245+(i>4?i-4:i)*45)+'px;" onclick="randBet('+i+')">'+i+'</div>';
	for(var i=0;i<8;i++)
		for(var j=0;j<10;j++){
			var k=1+i*10+j;
			html+='<div id="d_'+k+'" class="betB" style="top:'+(310+i*32)+'px;left:'+(290+j*45)+'px;" onclick="clickBet('+k+')">'+String(100+k).substr(1)+'</div>';
		}
	html+=
		'<div class="gamebutton1" style="left:500px;top:220px;cursor:pointer;" onclick="enterBet(true)">'+Lang(333)+'</div>'+
		'<div class="gamebutton" style="left:465px;top:565px;cursor:pointer;" onclick="noBet()">'+Lang(334)+'</div>'+
		'<div class="gamebutton2" style="left:600px;top:220px;cursor:pointer;" onclick="lastBet()">'+Lang(335)+'</div>';
	document.getElementById('htmlgame').innerHTML=html+pageEnd(600);
	// Code
	//document.getElementById('code1').innerHTML=html+pageEnd(600);
	
	pageCord();
	pageTick();
	var tnum=[1,2,2,3,3];
	var hb=' style="background:#FFF;" ';
	html=
	'<table class="mulition_table" width="240" cellspacing="0" cellpadding="0" border="1">'+
	'<tr height="35"><th>'+Lang(204)+'</td><th>'+Lang(207)+'</td><th>'+Lang(166)+'</td><th>'+Lang(208)+'</td><th>'+Lang(209)+'</td></tr>';
	for(var i=0;i<5;i++){
		html+='<tr><td class="TD_OF" '+(i%2?hb:'')+' rowspan="'+tnum[i]+'" id="vuvuh_'+(i+3)+'">'+(i+1)+Lang(205)+'</td>';// 
		html+='<td height="35" '+(i%2?hb:'')+'>'+Lang(206)+(i+2-tnum[i])+'</td><td '+(i%2?hb:'')+'><div class="OF_P" id="odd_'+(i+3)+'_0"></div></td>';
		html+='<td rowspan="'+tnum[i]+'" '+(i%2?hb:'')+'><input type="text"  id="mo_'+(i+3)+'_0" class="OF_T" disabled="true" onBlur="this.value=noPoint(this.value);chBet();sumBet()" onKeyUp="this.value=reNum(this.value)"></td><td rowspan="'+tnum[i]+'" '+(i%2?' style="background:#FFF;color:#009;" ':' style="color:#009;" ')+' id="sum_'+(i+3)+'">0</td></tr>';
		for(var j=1;j<tnum[i];j++)html+='<tr><td height="35" '+(i%2?hb:'')+'>'+Lang(206)+(i+2+j-tnum[i])+'</td><td '+(i%2?hb:'')+'><div class="OF_P" id="odd_'+(i+3)+'_'+j+'"></div></td></tr>';
	}
	html+='</table>';// autocomplete="off" disabled=""
	document.getElementById('starform').innerHTML=html;
	document.getElementById('code1').innerHTML=html;
	roddsAry=null;
	getLimit();
	reOdds();
	//relogin(false);
}
// 
// 336 關盤中
// 337 上期無投注注單
function lastBet(){	
	if(opentime<1){alert(Lang(336));return;}
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=lasttick&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			if(a.indexOf('-')>-1)alert(Lang(337));
			else{
				var v=b.responseText.split('*')[1].split('#');
				var html="\t"+Lang(313).replace('#n#',b.responseText.split('*')[0])+"\n",sum=0;
				for(var i=0;i<v.length;i++){
					var d=v[i].split('@');
					if(Number(d[0])==1||Number(d[0])==3) d[1]=Lang(d[1]=='0'?173:174);
					if(Number(d[0])==2) d[1]=Lang(d[1]=='0'?173:174);
					if(Number(d[0])>=4){
						var d1=d[1].split(',');
						for(var j=0;j<d1.lebgth;j++) d1[j]=String(Number(d1[j])+100).substr(1);
						d[1]=d1.join(',');
					}
					html+=Lang(modeName[d[0]])+' ['+d[1]+']'+"\t"+Lang(32)+' '+reNumP(d[2])+"\n";
					sum+=Number(d[2]);
				}				
				if(point<sum){alert(Lang(338));return;}
				html+="\t"+Lang(339)+"\t"+reNumP(sum)+Lang(340)+"\n"+Lang(341);
				if(confirm(html)){
					valAry=[];betpoint=0;
					for(var i=0;i<v.length;i++){
						var d=v[i].split('@');
						valAry.push(d[0]+'@'+d[1]+'@'+d[2]+'@'+(d[0]<4?document.getElementById('odd_'+(d[0]-1)+'_'+d[1]).innerHTML:vuvuary(d[0]-1)));
						betpoint+=Number(d[2]);
					}
					enterBet(false);
				}
			}
		}
	}
	b.send(null);	
}
var limitAry=null;
// 取得基本設定值
function getLimit()
{
	//limitAry 50,50,50,50,30,30,30,30,30@500,20000,20000,10000,10000,10000,3000,2000,1000@10000,40000,40000,10000,20000,20000,3000,10000,2000
	// 最低押注@最高押注@單期最高押注
	// 超級獎號,超級號碼大小,超級號碼單雙,猜大小,一星,二星,三星,四星,五星
	var a="50,50,50,50,30,30,30,30,30@500,20000,20000,10000,10000,10000,3000,2000,1000@10000,40000,40000,10000,20000,20000,3000,10000,2000";
	if(a.indexOf('-')>-1)err(a);
	else{
		limitAry=[];
		var v=a.split('@');
		for(var i=0;i<v.length;i++)
		{	limitAry[i]=v[i].split(',');	}
		if(page=='limit')
			for(var i=0;i<limitAry[0].length;i++)
			{
				document.getElementById('l'+i).innerHTML=commafy(limitAry[0][i]);
				document.getElementById('b'+i).innerHTML=commafy(limitAry[1][i]);
				document.getElementById('m'+i).innerHTML=commafy(limitAry[2][i]);
			}
	}

//	var b=new creatRequestObj();
//	b.open('GET','ajax.php?direct=limit&'+Date.parse(new Date),!0);
//	b.onreadystatechange=function(){
//		if(b.readyState==4){
//			var a=b.responseText;
//			if(a.indexOf('-')>-1)err(a);
//			else{
//				limitAry=[];
//				var v=a.split('@');
//				for(var i=0;i<v.length;i++)
//				{	limitAry[i]=v[i].split(',');	}
//				if(page=='limit')
//					for(var i=0;i<limitAry[0].length;i++)
//					{
//						document.getElementById('l'+i).innerHTML=commafy(limitAry[0][i]);
//						document.getElementById('b'+i).innerHTML=commafy(limitAry[1][i]);
//						document.getElementById('m'+i).innerHTML=commafy(limitAry[2][i]);
//					}
//			}
//		}
//	}
	b.send(null);	
}
// 
function reOdds(){
	if(page!='game') return;
	var b=new creatRequestObj();
	b.open('GET','ajax.php?direct=newestodds&'+Date.parse(new Date),!0);
	b.onreadystatechange=function(){
		if(b.readyState==4){
			var a=b.responseText;
			if(a.indexOf('-')>-1)err(a);
			else{
				//setTimeout(reOdds,5000);
				if(a.indexOf('@')>-1)chOdds(a);
			}
		}else{
		}
	}
	b.send(null);
	setTimeout(reOdds,5337);	
}
var roddsAry=null;
// 
function chOdds(a){
	if(page!='game') return;
	//if(roddsAry==a) return;	
	if(roddsAry==null) roddsAry=a;
	var a1=a.split('@'),r1=roddsAry.split('@');
	for(var i=0;i<a1.length;i++){
		if(a1[i].indexOf('%')>-1){
			var a2=a1[i].split('%'),r2=r1[i].split('%');
			for(var j=0;j<a2.length;j++){
				var a3=a2[j].split('#'),r3=r2[j].split('#');
				document.getElementById('odd_'+i+'_'+j).innerHTML=a3[0];
				document.getElementById('odd_'+i+'_'+j).style.color=a3[0]!=r3[0]?'#F00':'#FFF';
				document.getElementById('mo_'+i+'_'+j).disabled=a3[1]=='1'?false:true;
				document.getElementById('mo_'+i+'_'+j).style.background=a3[1]=='1'?'#FFF':'#BBB';
				if(a3[1]!='1')document.getElementById('mo_'+i+'_'+j).value='';
			}
		}else{
			var a2=a1[i].split('#'),r2=r1[i].split('#');
			var a3=a2[0].split(','),r3=r2[0].split(',');
			document.getElementById('mo_'+i+'_0').disabled=a2[1]=='1'?false:true;
				document.getElementById('mo_'+i+'_0').style.background=a2[1]=='1'?'#FFF':'#BBB';
			if(a2[1]!='1')document.getElementById('mo_'+i+'_0').value='';
			for(var j=0;j<a3.length;j++){
				document.getElementById('odd_'+i+'_'+j).innerHTML=a3[j];
				document.getElementById('odd_'+i+'_'+j).style.color=a3[j]!=r3[j]?'#F00':'#000';
			}
		}
		chBet();
	}
	roddsAry=a;
}
// 規則說明
function pageRule(){
	page='rule';
	var html='<div class="htmltitle">'+Lang(305)+'</div><div class="htmltitle_left"></div><div class="htmltitle_right"></div><div id="htmlrule"></div>';
	document.getElementById('html').innerHTML=html;
	html='<div id="testrule"></div>';
	/*html=
	'<table border="0" cellspacing="0" cellpadding="0" class="table_list" style="position:absolute;top:20px;left:50px;width:900px;">'+
	'<tr class="table_list_tr_bglight"><td align="left"  style="font-size:15px;line-height:40px;">'+
	Lang('1.客戶一經在本公司開戶或投注，即被視為已接受這些規則。')+'<br>'+
    Lang('2.如果客戶懷疑自己的資料被盜用，應立即通知本司，並更改個人詳細資料，且之前所使用的使用者名稱及密碼將全部無效。')+'<br>'+
    Lang('3.客戶有責任確保自己的帳戶及登入資料的保密性，且在本網站上以個人的使用者名稱及密碼的任何線上投注將被視為有效。')+'<br>'+
    Lang('4.為了避免出現爭議，請務必在下注之後檢查下注狀況。')+'<br>'+
    Lang('5.不論任何原因，開獎之後所接受的投注，將一律被視為『無效』。')+'<br>'+
    Lang('6.任何的投訴必須在開獎之前提出，本公司將不會受理任何開獎之後的投訴。')+'<br>'+
    Lang('7.公佈的投注時間、項目及賠率出現打字錯誤或人為失誤時，本公司有權保留會員注單執行刪除權力。')+'<br>'+
    Lang('8.公佈的投注時間、項目及賠率出現打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確開獎時間、賠率結算注單。')+'<br>'+
    Lang('9.公佈之所有賠率為浮動賠率，派彩時的賠率將以本公司確認投注時之賠率為準。')+'<br>'+
    Lang('10.如本公司查覺客戶投注狀況異常時，有權即時中止客戶投注並刪除不正常注單。')+'<br>'+
    Lang('11.如因在本網站投注觸犯當地法律，本公司概不負責。')+'<br>'+
    Lang('12.下注成功後，有效注單一律不得更改。')+'<br>'+
    Lang('13.本站開獎結果依官網公佈結果為準。')+'<br>'+
	'</td></tr></table>';*/
	document.getElementById('htmlrule').innerHTML=html+pageEnd(400);
}
// 玩法說明
function pagePlayRule(){
	page='playrule';
	var html='<div class="htmltitle">'+Lang(306)+'</div><div class="htmltitle_left"></div><div class="htmltitle_right"></div><div id="htmlgamerule"></div>';
	document.getElementById('html').innerHTML=html;
	html='<div id="testgamerule"></div>';
	document.getElementById('htmlgamerule').innerHTML=html+pageEnd(1000);
}
// 常見問題
function pageQA(){
	page='QA';
	var html='<div class="htmltitle">'+Lang(307)+'</div><div class="htmltitle_left"></div><div class="htmltitle_right"></div><div id="htmlQA"><div id="testQA"></div></div>';
	document.getElementById('html').innerHTML=html+pageEnd(400);
}
// 
function pageEnd(p){
	return '<div id="pageEnd" style="position:absolute;top:'+p+'px;left:0px;"><div class="htmltitle_m"></div><div class="htmltitle_left_m"></div><div class="htmltitle_right_m"></div>';
}
// 
function commafy(num){
	num=num+'';
	var re=/(-?\d+)(\d{3})/;
	while(re.test(num)) num=num.replace(re, "$1,$2");
    return num;
}
function err(a){
}
// 
function loading(){
	//addButton();	// 設定Menu按鈕
	//pageIndex();	// 首頁
	//gogotime();
	reCord(true);
	ggCord();
}
// 每3秒查詢重新讀取資料
setInterval(relogin,3000);
// 
function IdxArray(m, idxArray) {
    this.m = m;
    this.idxArray = idxArray;
}

IdxArray.prototype.hasNext = function() {
    return this.idxArray[0] < this.m - this.idxArray.length;
};

IdxArray.prototype.position = function() {
    if(this.idxArray[this.idxArray.length - 1] != this.m - 1) {
        return this.idxArray.length - 1;
    }
    else {
        var pos = this.idxArray.length - 2;
        while(this.idxArray[pos + 1] - this.idxArray[pos] == 1) { pos--;}
        return pos;
    }
};

IdxArray.prototype.next = function() {
    var pos = this.position();
    var idxArr = this.idxArray.slice(0, pos);
    idxArr.push(this.idxArray[pos] + 1);
    for(var i = pos + 1; i < this.idxArray.length; i++) {
        idxArr.push(idxArr[i - 1] + 1);
    }
    return new IdxArray(this.m, idxArr);
};

IdxArray.prototype.toList = function(src) {
    //return this.idxArray.map(function(idx) { return src[idx]; });
	var neidxArray=[];
	for(var i=0;i<this.idxArray.length;i++) neidxArray.push(src[this.idxArray[i]]);
	return neidxArray;
};

IdxArray.get = function(m, n) {
    var idxArray = [];
    for(var i = 0; i < n; i++) { idxArray.push(i); }
    return new IdxArray(m, idxArray);
};
// 
function frombingo(src, n) {
    var idxArray = IdxArray.get(src.length, n);
    var all = [];
    all.push(idxArray.toList(src));
    while(idxArray.hasNext()) {
        idxArray = idxArray.next();
        all.push(idxArray.toList(src));
    }
    return all;
}
// 
function chLang(v){
	if(v==lang) return;
	lang=v;
	addButton();
	if(page=='index')
	{
		alert("chLang");
		pageIndex();
	}
	else if(page=='limit')pageLimit();
	else if(page=='tick')pageReport();
	else if(page=='newtick')pageNewTick();
	else if(page=='nexttick')pageNextTick();
	else if(page=='game')pageGame();
	else if(page=='rule')pageRule();
	else if(page=='playrule')pagePlayRule();
	else if(page=='QA')pageQA();
}
//gogotime();
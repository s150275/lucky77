<?php
// ############ ########## ########## ############
// ## 贏家娛樂城-專用函式							##
// ############ ########## ########## ############
/*
載入方式:
include_once($MAIN_BASE_ADDRESS . "Project/WinHappy/func_WinHappy.php");

//~@_@~// START 秀出陣列資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//~@_@~// END 秀出陣列資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

常用函式
function WinHappy_BingoDraw(					賓果開獎(200522)
// 取得Bingo期號
$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)

// 取得會員資料
$array_Member_Info = WinHappy_getMemberInfo( $_SESSION['Member_ID'] ) ;		// 取得會員資料
// 找出父ID
$array_AgentInfo = WinHappy_getAgentInfo( $array_Member_Info['Member_Father_ID'] ) ;		// 取得代理人資料
// 取得所有上線代理人資料
$array_AgentList = WinHappy_getAgentList( $_SESSION['AID'] , "A,N,S,I,O,W,AI" , "") ;		// 取得所有上線代理人資料
// N : 名稱 , S : 分成比 , W : 返水比 , I : id  , O : 權限 , AI : 代理人ID
$tmp_AgentList = array2str($array_AgentListN , " > ");



V0.1
	WinHappy_checkBetMaxMinmultiple()		判斷最低單注倍數(200810)
	WinHappy_sentBackupData()				上傳備源資料(200808)
	WinHappy_setBackupInfo()				設定備援系統資料(200808)
	WinHappy_getLarge_Table_Info()			取得大盤表資料(200806)
	WinHappy_BingoNumAddFix0()				把Bingo小於10的值補0(200730)
	WinHappy_getMemberBetLimitInfo()		取得會員下注限額資訊(200729)
	WinHappy_htmlDraw_Bingo_Left()			開獎Bingo資訊-左方(200726)
	WinHappy_getBingo_RoadInfo_Right()		取得大小單雙牌路表-向右移(200724)
	WinHappy_get_Size_Same_Info()			找出一般大小連莊次數(200715)
	WinHappy_getSuper_BS_SD_Info()			找出超級大小單雙連莊次數(200715)
	WinHappy_getBingo_Same_Num()			找出連莊球數(200715)
	WinHappy_htmlMobileBingoNum()			手機Bingo獎號(220712)
	WinHappy_sentBetMail()					送出下注資料給管理者(200711)
	WinHappy_checkSide_Top()				是否已超過單邊最高限額(200707)
	WinHappy_checkPeak_Value()				某日是否已超過封頂值(200707)
	WinHappy_IsAdminAgent()					是否為管理代理人(200704)
	WinHappy_getSystemSet()					取得系統設定值(200702)
	WinHappy_setBetInfo()					設定下注資料或回傳下注總金額(200702)
	WinHappy_getBingo_RoadInfo()			取得大小單雙牌路表(20200630)
	WinHappy_getStratEnd_Bingo_Period()		取得某日開獎的第一期和最後一期號碼(200613)
	WinHappy_subPeriod2Date()				Bingo期號轉時間(20200608)
	WinHappy_getSearchDateBlock()			取得查詢日期區間(200531)
	WinHappy_setMoneyCss()					設定金額CSS(200530)
	WinHappy_htmlReportInfo()				秀出報表內容(200529)
	WinHappy_getBetMoney()					取得下注相關金額(200528)
	WinHappy_Match_Number()					配對成功奬號(200524)
	WinHappy_getCombinationToString()		取得無重複的排列組合資料(200522)
	WinHappy_BingoDraw()					賓果開獎(200522)
	WinHappy_getBetLimit()					取得內定下注限額(200519)
	WinHappy_getLoginName()					取得登入帳號的名字(200519)
	WinHappy_getMemberInfo()				取得會員資料(200519)
	WinHappy_getAgentInfo()					取得代理人資料(200519)
	WinHappy_getAgentList()					取得所有上線代理人資料(200728)
	WinHappy_getBetOdds()					取得下注賠率(20200516)
	WinHappy_htmlBetTickList()				秀出投注單列表(20200515)
	WinHappy_htmlCordNew()					秀出新開獎重要資訊(20200512)
	WinHappy_htmlDrawNumberList()			秀出開獎號碼列表(20200512)
	WinHappy_getGamePara()					取得遊戲相關參數(20200508)
	WinHappy_checkBingoPeriod()				判斷Bingo期號(20200507)
	WinHappy_checkMember()					限制遊戲會員存取頁面(20200510)
	WinHappy_readyMemberLogin()				查詢遊戲會員是否已登入(20200506)
	WinHappy_SetMemberSession()				設定登入遊戲會員的SESSION(20200506)
	WinHappy_checkAgent()					限制代理人管理後台存取頁面(200506)
	WinHappy_readyAgentLogin()				查詢已登入代理人後台(200506)
	WinHappy_SetAgentSession()				設定登入代理人後台的SESSION(200506)
	WinHappy_checkGameTime()				判斷目前遊戲時間狀態(20200504)

=======================================================================================
函式順序

代理人後台控管
	WinHappy_checkAgent()					限制代理人管理後台存取頁面(200506)
	WinHappy_readyAgentLogin()				查詢已登入代理人後台(200506)
	WinHappy_SetAgentSession()				設定登入代理人後台的SESSION(200506)
	WinHappy_IsAdminAgent()					是否為管理代理人(200704)

遊戲會員控管
	WinHappy_checkMember()					限制遊戲會員存取頁面(20200510)
	WinHappy_readyMemberLogin()				查詢遊戲會員是否已登入(20200506)
	WinHappy_SetMemberSession()				設定登入遊戲會員的SESSION(20200506)

遊戲相關
	WinHappy_checkGameTime()				判斷目前遊戲時間狀態(20200504)
	WinHappy_getGamePara()					取得遊戲相關參數(20200508)
	WinHappy_getBetLimit()					取得內定下注限額(200519)

Bingo相關
	WinHappy_checkBingoPeriod()				判斷Bingo期號(20200507)
	WinHappy_subPeriod2Date()				Bingo期號轉時間(20200608)
	WinHappy_htmlDrawNumberList()			秀出開獎號碼列表(20200512)
	WinHappy_htmlCordNew()					秀出新開獎重要資訊(20200512)
	WinHappy_htmlDraw_Bingo_Left()			開獎Bingo資訊-左方(200726)
	WinHappy_getStratEnd_Bingo_Period()		取得某日開獎的第一期和最後一期號碼(200613)
	WinHappy_getBingo_RoadInfo()			取得大小單雙牌路表(20200630)
	WinHappy_getBingo_RoadInfo_Right()		取得大小單雙牌路表-向右移(200724)
	WinHappy_getBingo_Same_Num()			找出連莊球數(200715)
	WinHappy_getSuper_BS_SD_Info()			找出超級大小單雙連莊次數(200715)
	WinHappy_get_Size_Same_Info()			找出一般大小連莊次數(200715)
	WinHappy_BingoNumAddFix0()				把Bingo小於10的值補0(200730)

下注相關
	WinHappy_htmlBetTickList()				秀出投注單列表(20200515)
	WinHappy_getBetOdds()					取得下注賠率(20200516)
	WinHappy_setBetInfo()					設定下注資料或回傳下注總金額(200702)
	WinHappy_checkPeak_Value()				某日是否已超過封頂值(200707)
	WinHappy_checkSide_Top()				是否已超過單邊最高限額(200707)
	WinHappy_sentBetMail()					送出下注資料給管理者(200711)

開獎相關
	WinHappy_getCombinationToString()		取得無重複的排列組合資料(200522)
	WinHappy_BingoDraw()					賓果開獎(200522)
	WinHappy_Match_Number()					配對成功奬號(200524)
	WinHappy_sumCalculate_Multiple()		計算財神九仔生計算值和倍數值(200608)

代理人相關
	WinHappy_getAgentInfo()					取得代理人資料(200519)
	WinHappy_getAgentList()					取得所有上線代理人資料(200728)

會員相關
	WinHappy_getMemberInfo()				取得會員資料(200519)
	WinHappy_getMemberBetLimitInfo()		取得會員下注限額資訊(200729)

統計報表
	WinHappy_getBetMoney()					取得下注相關金額(200528)
	WinHappy_htmlReportInfo()				秀出報表內容(200529)
	WinHappy_setMoneyCss()					設定金額CSS(200530)
	WinHappy_getLarge_Table_Info()			取得大盤表資料(200806)

系統相關
	WinHappy_getSystemSet()					取得系統設定值(200702)
	WinHappy_checkBetMaxMinmultiple()		判斷最低單注倍數(200810)

備援系統
	WinHappy_setBackupInfo()				設定備援系統資料(200808)
	WinHappy_sentBackupData()				上傳備源資料(200808)

手機用
	WinHappy_htmlMobileBingoNum()			手機Bingo獎號(220712)

其它
	WinHappy_getLoginName()					取得登入帳號的名字(200519)
	WinHappy_getSearchDateBlock()			取得查詢日期區間(200531)
*/
if(!isset($_SESSION))
{	session_start();	}
//echo session_id();

// 是否代理人登出系統
if( $_GET['Funct'] == "AgentLOGOUT" )
{
	// 加入LOG
	$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
	$array_LogInfo['OperatorID'] = $_SESSION['Agent_ID'] ;			// 操作者ID
	$array_LogInfo['OperatorName'] = $_SESSION['Agent_Name'] ;		// 操作者姓名
	$array_LogInfo['FileName'] = "" ;								// 執行程式
	$array_LogInfo['Table'] = "" ;									// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
	$array_LogInfo['ID'] = "" ;										// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
	$array_LogInfo['Type'] = "登出" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
	$array_LogInfo['Info'] = "{$_SESSION['Agent_Name']}-登出管理後台系統" ;		// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
	$array_LogInfo['SQL'] = "" ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)
	$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
	// 會員操作
	$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
	$_SESSION['Agent_ID'] = "" ;
	unset($_SESSION);

	// 設定Cookie
	setcookie("Agent_Login_Name", "", time()+60*60*24*365);
	setcookie("Agent_Login_Passwd", "" , time()+60*60*24*365);

	alertgo("登出成功" , "Agent_Login.php");
}
// 是否遊戲會員登出系統
if( $_GET['Funct'] == "AgentMemberLOGOUT" )
{
	// 加入LOG
	$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
	$array_LogInfo['OperatorID'] = $_SESSION['Business_ID'] ;			// 操作者ID
	$array_LogInfo['OperatorName'] = $_SESSION['Business_Name'] ;		// 操作者姓名
	$array_LogInfo['FileName'] = "" ;								// 執行程式
	$array_LogInfo['Table'] = "" ;									// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
	$array_LogInfo['ID'] = "" ;										// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
	$array_LogInfo['Type'] = "登出" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
	$array_LogInfo['Info'] = "{$_SESSION['Business_Name']}-登出管理後台系統" ;		// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
	$array_LogInfo['SQL'] = "" ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)
	$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
	// 會員操作
	$tmpCode = func_WriteLogFieldInfo( "Business" , "Business_ID" , $_SESSION['Business_ID'] , "Business_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料

	$_SESSION['Member_ID'] = "" ;
	unset($_SESSION);

	// 設定Cookie
	setcookie("Agent_Login_Name", "", time()+60*60*24*365);
	setcookie("Agent_Login_Passwd", "" , time()+60*60*24*365);

	alertgo("登出成功" , "Agent_Login.php");
}

// 是否手機遊戲會員登出系統
if( $_GET['Funct'] == "MobileMemberLOGOUT" )
{
	// 加入LOG
//	$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
//	$array_LogInfo['OperatorID'] = $_SESSION['Business_ID'] ;			// 操作者ID
//	$array_LogInfo['OperatorName'] = $_SESSION['Business_Name'] ;		// 操作者姓名
//	$array_LogInfo['FileName'] = "" ;								// 執行程式
//	$array_LogInfo['Table'] = "" ;									// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
//	$array_LogInfo['ID'] = "" ;										// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
//	$array_LogInfo['Type'] = "登出" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
//	$array_LogInfo['Info'] = "{$_SESSION['Business_Name']}-登出管理後台系統" ;		// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
//	$array_LogInfo['SQL'] = "" ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)
//	$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
//	// 會員操作
//	$tmpCode = func_WriteLogFieldInfo( "Business" , "Business_ID" , $_SESSION['Business_ID'] , "Business_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料

	$_SESSION['Member_ID'] = "" ;
	unset($_SESSION);

	// 設定Cookie
	setcookie("Agent_Login_Name", "", time()+60*60*24*365);
	setcookie("Agent_Login_Passwd", "" , time()+60*60*24*365);

	alertgo("登出成功" , "login.php");
}
// 是否手機遊戲會員登出系統
if( $_GET['Funct'] == "WinHappyMemberLOGOUT" )
{
	// 加入操作LOG
	$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
	$array_LogInfo['OperatorID'] = $_SESSION['Member_ID'] ;			// 操作者ID
	$array_LogInfo['OperatorName'] = $_SESSION['Member_Name'] ;		// 操作者姓名
	$array_LogInfo['FileName'] = "" ;								// 執行程式
	$array_LogInfo['Table'] = "" ;									// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
	$array_LogInfo['ID'] = "" ;										// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
	$array_LogInfo['Type'] = "登出" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
	$array_LogInfo['Info'] = "{$_SESSION['Member_Name']}-登出系統" ;		// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
	$array_LogInfo['SQL'] = "" ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)
	$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
	// 會員操作
	$tmpCode = func_WriteLogFieldInfo( "Member" , "Member_ID" , $_SESSION['Member_ID'] , "Member_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料

	$_SESSION['Member_ID'] = "" ;
	unset($_SESSION);

	// 設定Cookie
	setcookie("Agent_Login_Name", "", time()+60*60*24*365);
	setcookie("Agent_Login_Passwd", "" , time()+60*60*24*365);

	alertgo("登出成功" , "index.php");
}

// 管理後台控管
//~@_@~// START 限制代理人管理後台存取頁面 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_checkAgent()
{
	/*
	範例			: WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面
	功能			: 限制代理人管理後台存取頁面
	修改日期		: 20200506
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面
	*/
	global $Conn_Website_Name;
	if ($_SESSION['Website_Name'] != $Conn_Website_Name)
	{
		$_SESSION['Website_Name'] = $Conn_Website_Name ;
		$_SESSION['Agent_ID'] = "" ;
	}
	if( !isset($_SESSION['Agent_ID']) OR $_SESSION['Agent_ID'] == "" )
	{
		//頁面導向
		alertgo('','Agent_Login.php');
	}
	else
	{
		// 設定Cookie
		setcookie("Agent_Last_Login_Time", date("Y-m-d H:i:s") , time()+60*60*24*365);
	}
}
//~@_@~// END 限制代理人管理後台存取頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢已登入代理人後台 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_readyAgentLogin()
{
	/*
	範例			: WinHappy_readyAgentLogin( $subType ) ;		// 查詢已登入代理人後台
	功能			: 查詢已登入代理人後台
	修改日期		: 20200506
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_readyAgentLogin() ;		// 查詢已登入代理人後台
	*/
	global $MAIN_FILE_NAME ;
	global $Conn_Website_Name;
	
	if($_SESSION['Website_Name'] != $Conn_Website_Name)
	{
		$_SESSION['Website_Name'] = $Conn_Website_Name ;
		$_SESSION['Agent_ID'] = "" ;
	}
	if(isset($_SESSION['Agent_ID']) OR $_SESSION['Agent_ID'] != "")
	{
		//頁面導向
		if( $MAIN_FILE_NAME != "Agent_Login.php" )
		{	alertgo('','Agent_Login.php');	}
		#else
		#{	alertgo('','Manage_Object.php');	}
	}
}
//~@_@~// END 查詢已登入代理人後台 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定登入代理人後台的SESSION ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_SetAgentSession($LIST)
{
	/*
	範例			: WinHappy_SetAgentSession( $LIST ) ;		// 設定登入代理人後台的SESSION
	功能			: 設定登入代理人後台的SESSION
	修改日期		: 20200506
	參數說明 :
		$LIST	: 傳入的代理人資料
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_SetAgentSession( $LIST ) ;		// 設定登入代理人後台的SESSION
	*/
	//存入SESSION
	$_SESSION['Agent_ID'] = $LIST['Agent_ID'];
	$_SESSION['Agent_Name'] = $LIST['Agent_Name'];
	$_SESSION['Agent_On'] = $LIST['Agent_On'];
}
//~@_@~// END 設定登入代理人後台的SESSION ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 是否為管理代理人 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_IsAdminAgent()
{
	/*
	範例			: $tmp_Admin_Check = WinHappy_IsAdminAgent( $LIST ) ;		// 是否為管理代理人
	功能			: 是否為管理代理人-確認只有管理代理人可以執行
	修改日期		: 20200704
	參數說明 :
		無
	回傳參數 :
		$tmp_Admin_Check	是否為管理代理人(1:是管理員,0:不是管理員)
	使用範例 :		:
		$tmp_Admin_Check = WinHappy_IsAdminAgent() ;		// 是否為管理代理人
	*/
	// 是否為管理代理人
	if( $_SESSION['Agent_ID'] == "Agent2005100001" )
	{	return 1;	}
	else
	{	return 0;	}
}
//~@_@~// END 是否為管理代理人 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 遊戲會員控管
//~@_@~// START 限制遊戲會員存取頁面 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_checkMember()
{
	/*
	範例			: WinHappy_checkMember() ;		// 限制遊戲會員存取頁面
	功能			: 限制遊戲會員存取頁面
	修改日期		: 20200510
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_checkMember() ;		// 限制遊戲會員存取頁面
	*/
	global $Conn_Website_Name;
	if ($_SESSION['Website_Name'] != $Conn_Website_Name)
	{
		$_SESSION['Website_Name'] = $Conn_Website_Name ;
		$_SESSION['Member_ID'] = "" ;
	}
	if( !isset($_SESSION['Member_ID']) OR $_SESSION['Member_ID'] == "" )
	{
		//頁面導向
		alertgo('請先登入系統','index.php');
	}
	else
	{
		// 設定Cookie
		setcookie("Agent_Last_Login_Time", date("Y-m-d H:i:s") , time()+60*60*24*365);
	}
}
//~@_@~// END 限制遊戲會員存取頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢遊戲會員是否已登入 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_readyMemberLogin()
{
	/*
	範例			: WinHappy_readyMemberLogin() ;		// 查詢遊戲會員是否已登入
	功能			: 查詢遊戲會員是否已登入
	修改日期		: 20200506
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_readyMemberLogin() ;		// 查詢遊戲會員是否已登入
	*/
	global $MAIN_FILE_NAME ;
	global $Conn_Website_Name;
	
	if($_SESSION['Website_Name'] != $Conn_Website_Name)
	{
		$_SESSION['Website_Name'] = $Conn_Website_Name ;
		$_SESSION['Member_ID'] = "" ;
	}
	if(isset($_SESSION['Member_ID']) OR $_SESSION['Member_ID'] != "")
	{
		//頁面導向
		if( $MAIN_FILE_NAME != "index.php" )
		{	alertgo('請先登入系統-WinHappy_readyMemberLogin','index.php');	}
		#else
		#{	alertgo('','Manage_Object.php');	}
	}
}
//~@_@~// END 查詢遊戲會員是否已登入 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定登入遊戲會員的SESSION ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_SetMemberSession($LIST)
{
	/*
	範例			: WinHappy_SetMemberSession( $LIST ) ;		// 設定登入遊戲會員的SESSION
	功能			: 設定登入遊戲會員的SESSION
	修改日期		: 20200506
	參數說明 :
		$LIST	: 傳入的遊戲會員資料
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_SetMemberSession( $LIST ) ;		// 設定登入遊戲會員的SESSION
	*/
	//存入SESSION
	$_SESSION['Member_ID'] = $LIST['Member_ID'];
	$_SESSION['Member_Name'] = $LIST['Member_Name'];
	$_SESSION['Member_On'] = $LIST['Member_On'];
}
//~@_@~// END 設定登入遊戲會員的SESSION ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 遊戲相關
//~@_@~// START 判斷目前遊戲時間狀態 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_checkGameTime( $sub_Date )
{
	/*
	範例			: $array_GameInfo = WinHappy_checkGameTime() ;		// 判斷目前遊戲時間狀態
	功能			: 判斷目前遊戲時間狀態
	修改日期		: 20200504
	參數說明 :
		$sub_Date		輸入日期時間
	回傳參數 :
		$array_GameInfo['State']	目前狀態(1:進行中,0:關盤中)
		$array_GameInfo['Second']	目前狀態剩下秒數
	使用範例 :		:
		$array_GameInfo = WinHappy_checkGameTime() ;		// 判斷目前遊戲時間狀態
	*/
	$tmpShowMsg = 0 ;

	if ( !$sub_Date )
	{	$sub_Date = date("Y-m-d H:i:s") ;	}

	$array_Now = getSplitDate( $sub_Date , "A") ;			// 全部分析
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{
		echo "<p>比對時間 : </p>" ;print_r($array_Now);echo "<br>" ;
		echo "<p>比對時間 : $sub_Date</p>" ;
	}
	$array_GameInfo['State'] = 0 ;
	$array_GameInfo['Second'] = 0 ;
	
	// 00:00-07:04 bingo關盤中
	if( $array_Now[3] < 7 OR ( $array_Now[3] == 23 AND $array_Now[4] >= 55) )
	{}
	else
	{// 07:05-23:54 bingo開盤中
		// 如果為開號前30秒關盤04,09,14,19,24,29,34,39,44,49,54,59 : 30
		// 找出%5的值
		$tmp_Mod = $array_Now[4] % 5 ;
		if( !( $tmp_Mod == 4 AND $array_Now[5] >= 30 ) )
		{
			$array_GameInfo['State'] = 1 ;
			// 找出相差分鐘數
			$tmp_Min = 5 - $tmp_Mod - 1 ;
			$tmp_Sec = 60 - $array_Now[5] ;
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{
				echo "比對時間 : $sub_Date " ;
				echo ", 相差分鐘 : $tmp_Min(" . $tmp_Min * 60 . "秒) , 相差秒數 : $tmp_Sec " ;
			}
			
			// 找出開盤剩下秒數
			$array_GameInfo['Second'] = ( $tmp_Min * 60 ) + $tmp_Sec - 30;
		}
		else
		{// 30秒關盤中
			$array_GameInfo['Second'] = 60 - $array_Now[5];
		}
	}
	
	return $array_GameInfo ;
}
//~@_@~// END 判斷目前遊戲時間狀態 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得遊戲相關參數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getGamePara()
{
	/*
	範例			: $array_GamePara = WinHappy_getGamePara() ;		// 取得遊戲相關參數
	功能			: 取得遊戲相關參數
	修改日期		: 20200508
	參數說明 :
		無
	回傳參數 :
		$array_GamePara		設定參數
	使用範例 :		:
		$array_GamePara = WinHappy_getGamePara() ;		// 取得遊戲相關參數
	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	$array_GamePara['odd_0_0'] = 1.95 ;		// 超級大賠率
	$array_GamePara['odd_0_1'] = 1.95 ;		// 超級小賠率

	$array_GamePara['odd_1_0'] = 1.95 ;		// 超級單賠率
	$array_GamePara['odd_1_1'] = 1.95 ;		// 超級雙賠率
	
	$array_GamePara['odd_2_0'] = 8 ;		// 一般大賠率
	$array_GamePara['odd_2_1'] = 8 ;		// 一般小賠率
	
	$array_GamePara['odd_3_0'] = 3.2 ;		// 1星中1賠率
	
	$array_GamePara['odd_4_0'] = 1.5 ;		// 2星中1賠率
	$array_GamePara['odd_4_1'] = 4 ;		// 2星中2賠率
	
	$array_GamePara['odd_5_0'] = 3.2 ;		// 3星中2賠率
	$array_GamePara['odd_5_1'] = 25 ;		// 3星中3賠率
	
	$array_GamePara['odd_6_0'] = 1.5 ;		// 4星中2賠率
	$array_GamePara['odd_6_1'] = 6 ;		// 4星中3賠率
	$array_GamePara['odd_6_2'] = 50 ;		// 4星中4賠率
	
	$array_GamePara['odd_7_0'] = 3 ;		// 5星中3賠率
	$array_GamePara['odd_7_1'] = 25 ;		// 5星中4賠率
	$array_GamePara['odd_7_2'] = 400 ;		// 5星中5賠率

	// 中幾星賠率設定
	$array_GamePara["Pair_3_0"][1] = $array_GamePara['odd_3_0'];
	$array_GamePara["Pair_4_0"][1] = $array_GamePara['odd_4_0'];
	$array_GamePara["Pair_4_0"][2] = $array_GamePara['odd_4_1'];
	$array_GamePara["Pair_5_0"][2] = $array_GamePara['odd_5_0'];
	$array_GamePara["Pair_5_0"][3] = $array_GamePara['odd_5_1'];
	$array_GamePara["Pair_6_0"][2] = $array_GamePara['odd_6_0'];
	$array_GamePara["Pair_6_0"][3] = $array_GamePara['odd_6_1'];
	$array_GamePara["Pair_6_0"][4] = $array_GamePara['odd_6_2'];
	$array_GamePara["Pair_7_0"][3] = $array_GamePara['odd_7_0'];
	$array_GamePara["Pair_7_0"][4] = $array_GamePara['odd_7_1'];
	$array_GamePara["Pair_7_0"][5] = $array_GamePara['odd_7_2'];

	$array_GamePara['OddCount0'] = 2 ;			// 超級大小賠率數目
	$array_GamePara['OddCount1'] = 2 ;			// 超級單雙賠率數目
	$array_GamePara['OddCount2'] = 2 ;			// 一般大小賠率數目
	$array_GamePara['OddCount3'] = 1 ;			// 1星賠率數目
	$array_GamePara['OddCount4'] = 2 ;			// 2星賠率數目
	$array_GamePara['OddCount5'] = 2 ;			// 3星賠率數目
	$array_GamePara['OddCount6'] = 3 ;			// 4星賠率數目
	$array_GamePara['OddCount7'] = 3 ;			// 5星賠率數目

	$array_GamePara['MoCount0'] = 2 ;			// 超級大小金額欄位數目
	$array_GamePara['MoCount1'] = 2 ;			// 超級單雙金額欄位數目
	$array_GamePara['MoCount2'] = 2 ;			// 一般大小金額欄位數目
	$array_GamePara['MoCount3'] = 1 ;			// 1星金額欄位數目
	$array_GamePara['MoCount4'] = 1 ;			// 1星金額欄位數目
	$array_GamePara['MoCount5'] = 1 ;			// 1星金額欄位數目
	$array_GamePara['MoCount6'] = 1 ;			// 1星金額欄位數目
	$array_GamePara['MoCount7'] = 1 ;			// 1星金額欄位數目
	
	return $array_GamePara;
}
//~@_@~// START 取得內定下注限額 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getBetLimit()
{
	/*
	範例			: $array_BetLimit = WinHappy_getBetLimit() ;		// 取得內定下注限額
	功能			: 取得內定下注限額
	修改日期		: 20200519
	參數說明 :
		無
	回傳參數 :
		$array_BetLimit		設定參數
	使用範例 :		:
		$array_BetLimit = WinHappy_getBetLimit() ;		// 取得內定下注限額
	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	$array_BetLimit['BetLimit_Super_BigSmall'] = 2500 ;			// 超級號碼大小
	$array_BetLimit['BetLimit_Super_BigSmall_Low'] = 50 ;			// 超級號碼大小-最低
	$array_BetLimit['BetLimit_Super_BigSmall_Side'] = 200000 ;		// 超級號碼大小-單邊
	$array_BetLimit['BetLimit_Super_BigSmall_On'] = 1 ;				// 超級號碼大小-開啟
	$array_BetLimit['BetLimit_Super_SingleDouble'] = 2500 ;		// 超級號碼單雙
	$array_BetLimit['BetLimit_Super_SingleDouble_Low'] = 50 ;		// 超級號碼單雙-最低
	$array_BetLimit['BetLimit_Super_SingleDouble_Side'] = 200000 ;	// 超級號碼單雙-單邊
	$array_BetLimit['BetLimit_Super_SingleDouble_On'] = 1 ;			// 超級號碼單雙-開啟
	$array_BetLimit['BetLimit_BigSmall'] = 2500 ;					// 猜大小
	$array_BetLimit['BetLimit_BigSmall_Low'] = 50 ;					// 猜大小-最低
	$array_BetLimit['BetLimit_BigSmall_Side'] = 200000 ;			// 猜大小-單邊
	$array_BetLimit['BetLimit_BigSmall_On'] = 1 ;					// 猜大小-開啟
	$array_BetLimit['BetLimit_1Start'] = 2500 ;						// 1星
	$array_BetLimit['BetLimit_1Start_Low'] = 50 ;					// 1星-最低
	$array_BetLimit['BetLimit_1Start_Side'] = 200000 ;				// 1星-單邊
	$array_BetLimit['BetLimit_1Start_On'] = 1 ;						// 1星-開啟
	$array_BetLimit['BetLimit_2Start'] = 2500 ;						// 2星
	$array_BetLimit['BetLimit_2Start_Low'] = 50 ;					// 2星-最低
	$array_BetLimit['BetLimit_2Start_Side'] = 200000 ;				// 2星-單邊
	$array_BetLimit['BetLimit_2Start_On'] = 1 ;						// 2星-開啟
	$array_BetLimit['BetLimit_3Start'] = 2500 ;						// 3星
	$array_BetLimit['BetLimit_3Start_Low'] = 50 ;					// 3星-最低
	$array_BetLimit['BetLimit_3Start_Side'] = 200000 ;				// 3星-單邊
	$array_BetLimit['BetLimit_3Start_On'] = 1 ;						// 3星-開啟
	$array_BetLimit['BetLimit_4Start'] = 2500 ;						// 4星
	$array_BetLimit['BetLimit_4Start_Low'] = 50 ;					// 4星-最低
	$array_BetLimit['BetLimit_4Start_Side'] = 200000 ;				// 4星-單邊
	$array_BetLimit['BetLimit_4Start_On'] = 1 ;						// 4星-開啟
	$array_BetLimit['BetLimit_5Start'] = 2500 ;						// 5星
	$array_BetLimit['BetLimit_5Start_Low'] = 50 ;					// 5星-最低
	$array_BetLimit['BetLimit_5Start_Side'] = 200000 ;				// 5星-單邊
	$array_BetLimit['BetLimit_5Start_On'] = 1 ;						// 5星-開啟
	
	return $array_BetLimit;
}

// Bingo相關
//~@_@~// END 取得遊戲相關參數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 判斷Bingo期號 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_checkBingoPeriod( $sub_Date = "" )
{
	/*
	範例			: $array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
	功能			: 判斷Bingo期號
	修改日期		: 20200504
	參數說明 :
		$sub_Date		輸入日期時間
	回傳參數 :
		$array_BingoPeriod['NowBingo']			本期期數
		$array_BingoPeriod['NowBingo_Time']		本期期數開獎日期
		$array_BingoPeriod['LastBingo']			上一期期數
		$array_BingoPeriod['LastBingo_Time']	上一期期數開獎日期
	使用範例 :		:
		$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
		//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
	*/
	$tmpShowMsg = 0 ;

	if ( !$sub_Date )
	{	$sub_Date = date("Y-m-d H:i:s") ;	}

	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "查詢日期 : $sub_Date<br>" ;	}

	$tmpDiff = getMinDiff( date("Y") . "-01-01 00:00:00" , $sub_Date , "D" ) ;		// 比較分鐘差
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "相差天數 : $tmpDiff<br>" ;	}
	//$tmpMinDiff = getMinDiff( date("Y-m-d") . " 00:00:00" , date("Y-m-d") . " 07:04:00" , "I" ) ;		// 比較分鐘差
	// 分析查詢日期
	$array_Now = getSplitDate( $sub_Date , "A") ;			// 全部分析
	
	$tmpMinDiff = getMinDiff( "$array_Now[0]-$array_Now[1]-$array_Now[2] 00:00:00" , $sub_Date , "I" ) ;		// 比較分鐘差
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "相差分數(420) : $tmpMinDiff<br>" ;	}
	// 當日期數
	$tmp_day_BingoPeriod = ($tmpMinDiff - 420) / 5 ;
	
	$array_BingoPeriod['LastBingo'] = "109" . func_addFix0( ( $tmpDiff * 203 ) + (int)$tmp_day_BingoPeriod , 6 );
	$array_BingoPeriod['NowBingo'] = $array_BingoPeriod['LastBingo'] + 1;
	
	// 如果為本日未開獎時間
	if( $tmpMinDiff < 425 )
	{
		$array_BingoPeriod['LastBingo'] = "109" . func_addFix0(( $tmpDiff * 203 ) , 6) ;
		$array_BingoPeriod['NowBingo'] = $array_BingoPeriod['LastBingo'] + 1;

		$array_BingoPeriod['NowBingo_Time'] = "07:05" ;	// 本期期數開獎日期
		$array_BingoPeriod['LastBingo_Time']	= "23:55" ;	// 上一期期數開獎日期
	}
	if( $array_Now[3] == 23 AND $array_Now[4] >= 55 )
	{// 如果為本日最後一期
		$array_BingoPeriod['NowBingo_Time'] = "07:05" ;	// 本期期數開獎日期
		$array_BingoPeriod['LastBingo_Time']	= "23:55" ;	// 上一期期數開獎日期
	}
	else if( $array_Now[4] >= 55 )
	{// 本小時最後一期,小時+1
		$array_BingoPeriod['NowBingo_Time'] = sprintf("%02s" , ($array_Now[3] + 1)) . ":00" ;	// 本期期數開獎日期
		$array_BingoPeriod['LastBingo_Time']	= "{$array_Now[3]}:55" ;	// 上一期期數開獎日期
	}
	else if( $array_Now[4] < 5 )
	{// 本小時第一期,小時-1
		$array_BingoPeriod['NowBingo_Time'] = $array_Now[3] . ":05" ;	// 本期期數開獎日期
		$array_BingoPeriod['LastBingo_Time']	= $array_Now[3] . ":00" ;	// 上一期期數開獎日期
	}
	else
	{
		$tmp_Min = (int)($array_Now[4] / 5) ;
		$array_BingoPeriod['NowBingo_Time'] = $array_Now[3] . ":" . sprintf("%02s" , ($tmp_Min + 1) * 5) ;	// 本期期數開獎日期
		$array_BingoPeriod['LastBingo_Time']	= $array_Now[3] . ":" . sprintf("%02s" , ($tmp_Min * 5)) ;	// 上一期期數開獎日期
	}
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{
		echo "上期期數 :{$array_BingoPeriod['LastBingo']} , 上期期數開獎日期 :{$array_BingoPeriod['LastBingo_Time']}<br>" ;
		echo "當期期數 :{$array_BingoPeriod['NowBingo']} , 本期期數開獎日期 :{$array_BingoPeriod['NowBingo_Time']}<br>" ;
	}
	return $array_BingoPeriod ;
}
//~@_@~// END 判斷Bingo期號 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START Bingo期號轉時間 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_subPeriod2Date( $sub_Period )
{
	/*
	範例			: $tmp_BingoDate = WinHappy_subPeriod2Date($sub_Period) ;		// Bingo期號轉時間
	功能			: 判斷Bingo期號
	修改日期		: 20200504
	參數說明 :
		$sub_Period		輸入Bingo期號
	回傳參數 :
		$tmp_BingoDate	Bingo期號開獎日期
	使用範例 :		:
		$tmp_BingoDate = WinHappy_subPeriod2Date($sub_Period) ;		// Bingo期號轉時間
	*/
	$tmpShowMsg = 0 ;
	//if ( !$sub_Date )
	// 109032429
	// 取出年份-取出前3個字
	$tmp_Year = mb_substr( $sub_Period , 0 , 3 , "utf-8")+1911;
	//echo "取出年份 : $tmp_Year , " ;

	// 取出日期-取出最後6個字
	$tmp_Date_Str = mb_substr( $sub_Period , 3 , 6 , "utf-8");
	if ( $tmpShowMsg )
	{	echo "取出日期 : $tmp_Date_Str , <br>" ;	}
	
	$tmp_Day = (int)($tmp_Date_Str / 203) ;
	if ( $tmpShowMsg )
	{	echo "天數 : $tmp_Day , <br>" ;	}

	$tmp_Mod = $tmp_Date_Str % 203 ;
	if ( $tmpShowMsg )
	{	echo "餘數 : $tmp_Mod , <br>" ;	}
	
	//$tmp_Timestamp_Year = date("2020-01-01 00:00:00") ;
	$tmp_Timestamp_Year = strtotime("{$tmp_Year}-01-01 00:00:00") ;
	if ( $tmpShowMsg )
	{	echo "開獎年份時間戳 : {$tmp_Year}-01-01 00:00:00 - $tmp_Timestamp_Year , <br>" ;	}
	
	if( $tmp_Mod == 0 )
	{// 最後一期
		// 找出時間戳(秒數) = 年 + 日 + 07:00 + 餘數
		$tmp_Timestamp = strtotime("{$tmp_Year}-01-01 00:00:00") + (($tmp_Day-1) * 86400) + 25200 + ( 203 * 300 ) ;
	}
	else
	{
		// 找出時間戳(秒數) = 年 + 日 + 07:00 + 餘數
		$tmp_Timestamp = strtotime("{$tmp_Year}-01-01 00:00:00") + ($tmp_Day * 86400) + 25200 + ($tmp_Mod * 300) ;
	}

	if ( $tmpShowMsg )
	{	echo "開獎時間戳 : $tmp_Timestamp , <br>" ;	}
	
	$tmp_Draw_DT = date("Y-m-d H:i:s",$tmp_Timestamp);
	if ( $tmpShowMsg )
	{	echo "開獎時間 : $tmp_Draw_DT<br>" ;	}
	
	return $tmp_Draw_DT ;
}
//~@_@~// END Bingo期號轉時間 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出開獎號碼列表 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_htmlDrawNumberList()
{
	global $link;
	/*
	範例			: WinHappy_htmlDrawNumberList() ;		// 秀出開獎號碼列表
	功能			: 秀出開獎號碼列表
	修改日期		: 20200512
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_htmlDrawNumberList() ;		// 秀出開獎號碼列表
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// 最新一期球號
	$tmpSQL_Bingo = "SELECT * FROM Bingo ORDER BY id_Bingo DESC LIMIT 1" ;
	$array_Bingo_Info = func_DatabaseGet( $tmpSQL_Bingo , "SQL" , "" ) ;		// 取得資料庫資料
	
	echo "	<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
	echo "		<tbody>\n";
	echo "			<tr>\n";
	echo "				<td class=\"bignowta\" colspan=\"41\" align=\"center\" style=\"font-size:16px;\">Bingo Bingo 最新一期開獎號碼&nbsp;&nbsp;第 <span id=\"bigballno\" style=\"color: rgb(0, 0, 0);\">{$array_Bingo_Info['Bingo_Period']}</span> 期&nbsp;&nbsp;時間&nbsp;&nbsp;{$array_Bingo_Info['Bingo_DrawDT']}</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	
	// 分析獎號
	$array_Bingo_Num = str2array($array_Bingo_Info['Bingo_Num'],",");
	
	foreach( $array_Bingo_Num as $key => $value )
	{
		if( $value == $array_Bingo_Info['Bingo_Super_Num'])
		{	$tmp_Class = "nowball_r" ;	}
		else
		{	$tmp_Class = "nowball" ;	}
		echo "				<td style=\"background:#010101\"></td>\n";
		echo "				<td class=\"$tmp_Class\">$value</td>\n";
	}
	echo "				<td style=\"background:#010101\"></td>\n";
	
	echo "			</tr>\n";
	echo "		</tbody>\n";
	echo "	</table>\n";
	echo "\n";
	
	echo "	<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"table_ball\">\n";
	echo "		<tbody>\n";
	echo "			<tr>\n";
	echo "				<th style=\"color:#FF0;height:50px;\">期數時間</th>\n";
	echo "				<th style=\"color:#FF0;font-size:21px;\">開獎號碼&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"images/ball_background_22.gif\" style=\"position:absolute; top:85px;left:455px;\"><span style=\"color:#FFF;font-size:12px;top:20px;\">紅色球為超級獎號</span></th>\n";
	echo "				<th style=\"color:#FF0;\" width=\"3%\">連莊<br>\n";
	echo "					球數</th>\n";
	echo "				<th style=\"color:#FF0;\" width=\"4%\">一般<br>\n";
	echo "					大小</th>\n";
	echo "				<th style=\"color:#FF0;\" width=\"4%\">超級<br>\n";
	echo "					大小</th>\n";
	echo "				<th style=\"color:#FF0;\" width=\"4%\">超級<br>\n";
	echo "					單雙</th>\n";
	echo "			</tr>\n";
	
	$SQL_Bingo = "SELECT * FROM Bingo ORDER BY Bingo_Period DESC LIMIT 20" ;
	//echo $SQL_Bingo . "<br>" ; 
	$QUERY_Bingo = mysqli_query($link , $SQL_Bingo) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY_Bingo) )
	{
		// 一條條獲取
		while ($LIST_Bingo = mysqli_fetch_assoc($QUERY_Bingo))
		{
			echo "			<tr style=\"height:50px;\">\n";
			echo "				<td class=\"cord_a\" style=\"font-size:12px;\">{$LIST_Bingo['Bingo_Period']}<br>\n";
			echo "					{$LIST_Bingo['Bingo_DrawDT']}\n";
			echo "				</td>\n";
			echo "				<td class=\"cord_a\">\n";
	
			$array_LIST_Bingo_Num = str2array($LIST_Bingo['Bingo_Num'],",");
			
			foreach( $array_LIST_Bingo_Num as $key => $value )
			{
				if( $value == $LIST_Bingo['Bingo_Super_Num'])
				{	$tmp_Class = "cord_r" ;	}
				else
				{	$tmp_Class = "cord_b" ;	}
				echo "					<div class=\"$tmp_Class\">$value</div>\n";
			}
			echo "				</td>\n";
			echo "				<td align=\"center\" class=\"cord_a\" style=\"font-size:19px;\">{$LIST_Bingo['Bingo_Super_Same']}</td>\n";
			$array_Bingo_Size_Same = str2array($LIST_Bingo['Bingo_Size_Same'] , ",");
			$array_Bingo_Size_Same[0] == "大" ? $tmp_Color = "#0F0" : $tmp_Color = "#FFF";
			echo "				<td align=\"center\" class=\"cord_a\" style=\"color:{$tmp_Color}\">{$array_Bingo_Size_Same[0]}</td>\n";
			
			$array_Bingo_Super_BS_Same = str2array($LIST_Bingo['Bingo_Super_BS_Same'] , ",");
			$array_Bingo_Super_BS_Same[0] == "大" ? $tmp_Color = "#0F0" : $tmp_Color = "#FFF";
			echo "				<td align=\"center\" class=\"cord_a\" style=\"color:{$tmp_Color}\">{$array_Bingo_Super_BS_Same[0]}</td>\n";
			
			$array_Bingo_Super_SD_Same = str2array($LIST_Bingo['Bingo_Super_SD_Same'] , ",");
			$array_Bingo_Super_SD_Same[0] == "雙" ? $tmp_Color = "#0F0" : $tmp_Color = "#FFF";
			echo "				<td align=\"center\" class=\"cord_a\" style=\"color:{$tmp_Color}\">{$array_Bingo_Super_SD_Same[0]}</td>\n";
			echo "			</tr>\n";
	
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_Bingo);
	}
	echo "		</tbody>\n";
	echo "	</table>\n";
}
//~@_@~// END 秀出最新一期開獎號碼 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出新開獎重要資訊 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_htmlCordNew()
{
	global $link;
	/*
	範例			: WinHappy_htmlCordNew() ;		// 秀出新開獎重要資訊
	功能			: 秀出新開獎重要資訊
	修改日期		: 20200512
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_htmlCordNew() ;		// 秀出新開獎重要資訊
	*/
	$tmpShowMsg = 0 ;

	// 最新一期球號
	$tmpSQL_Bingo = "SELECT * FROM Bingo ORDER BY id_Bingo DESC LIMIT 1" ;
	$array_Bingo_Info = func_DatabaseGet( $tmpSQL_Bingo , "SQL" , "" ) ;		// 取得資料庫資料

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	echo "	<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
	echo "		<tbody>\n";
	echo "			<tr>\n";
	echo "				<td colspan=\"4\" align=\"center\">第 <span id=\"ggCord\" style=\"color: rgb(255, 255, 255);\">{$array_Bingo_Info['Bingo_Period']}</span> 期</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td rowspan=\"2\" width=\"10%\"></td>\n";
	echo "				<td rowspan=\"2\" align=\"center\" class=\"cord_rb\">{$array_Bingo_Info['Bingo_Super_Num']}</td>\n";
	echo "				<td></td>\n";
	
	$array_Bingo_Super_BS_Same = str2array($array_Bingo_Info['Bingo_Super_BS_Same'] , ",");
	echo "				<td align=\"center\" style=\"font-size:15px;\">{$array_Bingo_Super_BS_Same[0]}</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<td></td>\n";
	
	$array_Bingo_Super_SD_Same = str2array($array_Bingo_Info['Bingo_Super_SD_Same'] , ",");
	echo "				<td align=\"center\" style=\"font-size:15px;\">{$array_Bingo_Super_SD_Same[0]}</td>\n";
	echo "			</tr>\n";
	echo "		</tbody>\n";
	echo "	</table>\n";
}
//~@_@~// END 秀出新開獎重要資訊 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 開獎Bingo資訊-左方 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_htmlDraw_Bingo_Left()
{
	global $link;
	/*
	範例			: WinHappy_htmlCordNew() ;		// 開獎Bingo資訊-左方
	功能			: 開獎Bingo資訊-左方
	修改日期		: 20200726
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_htmlDraw_Bingo_Left() ;		// 開獎Bingo資訊-左方
	*/
	$tmpShowMsg = 0 ;

	// 是否有最新一期資料
	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)

	// 最新一期球號
	$tmpSQL_Bingo = "SELECT * FROM Bingo WHERE Bingo_Period = '{$array_BingoPeriod['LastBingo']}'" ;
	$array_Bingo_Info = func_DatabaseGet( $tmpSQL_Bingo , "SQL" , "" ) ;		// 取得資料庫資料
	if( $array_Bingo_Info['Bingo_Num'] )
	{
		$array_Bingo_Num = str2array($array_Bingo_Info['Bingo_Num'] , ",");
		
		echo "	<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
		echo "		<tbody>\n";
		echo "			<tr>\n";
		for( $i = 0 ; $i < 10 ; $i++ )
		{
			$tmp_Index = ($i % 4) +1 ;
			$array_Bingo_Num[$i] == $array_Bingo_Info['Bingo_Super_Num'] ? $tmp_Class = "Draw_Red" : $tmp_Class = "Draw_$tmp_Index" ;
			echo "				<td class=\"$tmp_Class\">$array_Bingo_Num[$i]</td>\n";
		}
	
	//	echo "				<td class=\"Draw_1\">01</td>\n";
	//	echo "				<td class=\"Draw_2\">09</td>\n";
	//	echo "				<td class=\"Draw_Red\">15</td>\n";
	//	echo "				<td class=\"Draw_4\">18</td>\n";
	//	echo "				<td class=\"Draw_1\">22</td>\n";
	//	echo "				<td class=\"Draw_2\">24</td>\n";
	//	echo "				<td class=\"Draw_3\">31</td>\n";
	//	echo "				<td class=\"Draw_4\">33</td>\n";
	//	echo "				<td class=\"Draw_1\">35</td>\n";
	//	echo "				<td class=\"Draw_2\">38</td>\n";
		echo "			<tr>\n";
		echo "			<tr>\n";
		for( $i = 10 ; $i < 20 ; $i++ )
		{
			$tmp_Index = ($i % 4) + 1 ;
			$array_Bingo_Num[$i] == $array_Bingo_Info['Bingo_Super_Num'] ? $tmp_Class = "Draw_Red" : $tmp_Class = "Draw_$tmp_Index" ;
			echo "				<td class=\"$tmp_Class\">$array_Bingo_Num[$i]</td>\n";
		}
	//	echo "				<td class=\"Draw_3\">43</td>\n";
	//	echo "				<td class=\"Draw_4\">48</td>\n";
	//	echo "				<td class=\"Draw_1\">52</td>\n";
	//	echo "				<td class=\"Draw_2\">57</td>\n";
	//	echo "				<td class=\"Draw_3\">58</td>\n";
	//	echo "				<td class=\"Draw_4\">63</td>\n";
	//	echo "				<td class=\"Draw_1\">64</td>\n";
	//	echo "				<td class=\"Draw_2\">70</td>\n";
	//	echo "				<td class=\"Draw_3\">77</td>\n";
	//	echo "				<td class=\"Draw_4\">78</td>\n";
		echo "			</tr>\n";
		echo "		</tbody>\n";
		echo "	</table>\n";
	}
}
//~@_@~// END 開獎Bingo資訊-左方 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得某日開獎的第一期和最後一期號碼 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getStratEnd_Bingo_Period( $subDate )
{
	global $link;
	/*
	範例			: $array_StratEnd_Bingo_Period = WinHappy_getStratEnd_Bingo_Period( $subDate ) ;		// 取得某日開獎的第一期和最後一期號碼
	功能			: 取得某日開獎的第一期和最後一期號碼
	修改日期		: 20200613
	參數說明 :
		$subDate	尋找開獎日期
	回傳參數 :
		$array_StratEnd_Bingo_Period	第一期和最後一期號碼
		$array_StratEnd_Bingo_Period['Start']	第一期
		$array_StratEnd_Bingo_Period['End']		最後一期
	使用範例 :		:
		$array_StratEnd_Bingo_Period = WinHappy_getStratEnd_Bingo_Period( date("Y-m-d") ) ;		// 取得某日開獎的第一期和最後一期號碼
		// Start : 第一期 , End : 最後一期
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	// 沒有設值,設定為今日
	if( empty($subDate) )
	{	$subDate = date("Y-m-d") ;	}
	
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "查詢日期 : $subDate<br>" ;	}

	// 找出年分資料
	$tmp_Year = mb_substr( $subDate , 0 , 4 , "utf-8");
	
	// 找出日期為第幾天
	// 找出本年的第一天時間戳
	$tmp_Timestamp_Start = strtotime( $tmp_Year . "-01-01 00:00:00") ;
	$tmp_Bingo_Year = date("Y") - 1911;

	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "本年的第一天時間戳 : $tmp_Timestamp_Start<br>" ;	}
	
	// 找出本日的時間戳
	$tmp_Timestamp_Now = strtotime( $subDate , "00:00:01" ) ;

	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "本年的某日的時間戳 : $tmp_Timestamp_Now<br>" ;	}

	// 找出相差天數-為前一天
	$tmp_Diff = (int)(($tmp_Timestamp_Now - $tmp_Timestamp_Start)/86400) ;
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "相差天數 : $tmp_Diff<br>" ;	}

	$array_StratEnd_Bingo_Period['Start'] = $tmp_Bingo_Year . "0" . ($tmp_Diff * 203 )+ 1 ;		// 最後一期
	$array_StratEnd_Bingo_Period['End'] = $tmp_Bingo_Year . "0" . ( $tmp_Diff+1) * 203 ;	// 第一期

	return $array_StratEnd_Bingo_Period ;
}
//~@_@~// END 取得本日開獎的第一期和最後一期 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得大小單雙牌路表 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getBingo_RoadInfo( $sub_Type = "BS" )
{
	global $link;
	/*
	範例			: WinHappy_getBingo_RoadInfo( $sub_Type ) ;		// 取得大小單雙牌路表
	功能			: 取得大小單雙牌路表
	修改日期		: 20200630
	參數說明 :
		$sub_Type	牌路表類別(BS:大小 , SD:單雙)
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_getBingo_RoadInfo( "BS" ) ;		// 取得大小單雙牌路表
		WinHappy_getBingo_RoadInfo( "SD" ) ;		// 取得大小單雙牌路表
	*/
	$tmpShowMsg = 0 ;

	$tmp_NowState = "" ;		// 目前的狀態
	$tmp_Index = 0 ;			// 索引值
	$array_State = array();		// 儲存目前的索引
	$tmp_Start_Value = "" ;		// 一開始的值,後面就一直互換
	$tmp_Max_Level = 1 ;		// 最多層數
	
	//$sub_Type	牌路表類別(BS:大小 , SD:單雙)
	$array_Type['BS'][0] = "大" ;
	$array_Type['BS'][1] = "小" ;
	$array_Type['SD'][0] = "單" ;
	$array_Type['SD'][1] = "雙" ;
	
	// 找出最新Bingo開獎號200個
	$SQL = "SELECT * FROM Bingo ORDER BY Bingo_Period DESC LIMIT 200" ;
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>查詢的SQL : $SQL</p>" ; 	}
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		//$tmp_Index = 0 ;
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			// 收集完成結束-內定欄數(最多)
			if( $tmp_Index > 27 )
			{	break;	}
			
			// 求出此Bingo的狀態
			$tmp_State = mb_substr($LIST["Bingo_Super_{$sub_Type}_Same"] , 0 ,1 , "utf-8");
			if( $tmp_NowState == $tmp_State )
			{// 和上一個相同值
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "{$LIST['Bingo_Period']} - $tmp_Index 和上一個相同值 : " . $LIST["Bingo_Super_{$sub_Type}_Same"] . " , $tmp_State <br>" ;	}
				
				$array_State[$tmp_Index]['Num']++ ;
				// 設定最大層數值
				if( $tmp_Max_Level < $array_State[$tmp_Index]['Num'] )
				{ $tmp_Max_Level = $array_State[$tmp_Index]['Num'] ;	}
			}
			else
			{// 和上一個不同值
				$tmp_NowState = $tmp_State ;
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "{$LIST['Bingo_Period']} - $tmp_Index 和上一個不同值 : " . $LIST["Bingo_Super_{$sub_Type}_Same"] . " , $tmp_State <br>" ;	}
				
				if( $array_State[$tmp_Index]['Type'] == "")
				{// 沒有設值,是第一筆
					if( $tmp_State == $array_Type[$sub_Type][0] )
					{	$tmp_Start_Value = 0 ;	}
					else
					{	$tmp_Start_Value = 1 ;	}
				}
				else
				{// 已有設值,不是第一筆
					$tmp_Index++ ;
					// 收集完成結束
					if( $tmp_Index > 27 )
					{	break;	}
				}
				// 設定要確認的Index值
				$tmp_Check_Index = ($tmp_Index + $tmp_Start_Value)%2 ;
				$array_State[$tmp_Index]['Type'] = $array_Type[$sub_Type][$tmp_Check_Index] ;
				$array_State[$tmp_Index]['Num'] = 1 ;
			}
			
		}
		
		// 返轉陣列
		$array_State = array_reverse($array_State);
		//echo "<p>求出陣列</p>" ;print_r($array_State);echo "<br>" ;
		// 算出陣列內的值為何(空白:無 , 0 : (大,單) , 1 : (小,雙) )
		//$array[0][20]

		// 產生表格資料
		echo "<table>" ;
		echo "<tr>" ;
		if($sub_Type == "BS")
		{	echo "    <td rowspan='20' valign=top><img src='images/Banner_BigSmall.png'></td>" ;	}
		else
		{	echo "    <td rowspan='20' valign=top><img src='images/Banner_SingleDouble.png'></td>" ;	}
		echo "</tr>" ;
		if( $array_State[0]['Type'] == "大" )
		{	$tmp_Start_Value = 0 ;	}
		else
		{	$tmp_Start_Value = 0 ;	}
		
		for( $i = 0 ; $i <= $tmp_Max_Level ; $i++ )
		{// 建立每個層數的值
			$tmp_Td[$i] = "" ;
			foreach( $array_State as $key => $value )
			{
				$tmp_Check_Index = ($key + $tmp_Start_Value)%2 ;
				if( $value['Num'] > $i )
				{	$tmp_Td[$i] .= "<td class='{$sub_Type}_{$tmp_Check_Index}'>{$value['Type']}</td>" ;	}
				else
				{	$tmp_Td[$i] .= "<td></td>" ;	}
			}
		}

		for( $i = 0 ; $i < $tmp_Max_Level ; $i++ )
		{
			echo "<tr>$tmp_Td[$i]</tr>" ;
		}


		echo "</table>" ;
		
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{	echo "沒有找到資料<br>" ;	}
	//echo "<p>找到的陣列值</p>" ;print_r($array_State);echo "<br>" ;

}
//~@_@~// END 取得大小單雙牌路表 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得大小單雙牌路表-向右移 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getBingo_RoadInfo_Right( $sub_Type = "BS" , $sub_Show = "C" )
{
	global $link;
	global $Funct ;
	global $MAIN_BASE_ADDRESS ;
	/*
	範例			: WinHappy_getBingo_RoadInfo_Right( $sub_Type ) ;		// 取得大小單雙牌路表
	功能			: 取得大小單雙牌路表
	修改日期		: 20200630
	參數說明 :
		$sub_Type	牌路表類別(BS:大小 , SD:單雙)
		$sub_Show	呈現模式(C:電腦 , M:手機)
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_getBingo_RoadInfo_Right( "BS" ) ;		// 取得大小單雙牌路表
		WinHappy_getBingo_RoadInfo_Right( "SD" ) ;		// 取得大小單雙牌路表
	*/
	$tmpShowMsg = 0 ;

	if( $sub_Show == "C" )
	{	$sub_Show_Index = 27;	}
	else
	{	$sub_Show_Index = 15;	}

	$tmp_NowState = "" ;		// 目前的狀態
	$tmp_Index = 0 ;			// 索引值
	$array_State = array();		// 儲存目前的索引
	$tmp_Start_Value = "" ;		// 一開始的值,後面就一直互換
	$tmp_Max_Level = 1 ;		// 最多層數
	
	//$sub_Type	牌路表類別(BS:大小 , SD:單雙)
	$array_Type['BS'][0] = "大" ;
	$array_Type['BS'][1] = "小" ;
	$array_Type['SD'][0] = "單" ;
	$array_Type['SD'][1] = "雙" ;
	
	// 找出最新Bingo開獎號200個
	$SQL = "SELECT * FROM Bingo ORDER BY Bingo_Period DESC LIMIT 200" ;
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>查詢的SQL : $SQL</p>" ; 	}
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		//$tmp_Index = 0 ;
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			// 收集完成結束-內定欄數(最多)
			if( $tmp_Index > $sub_Show_Index )
			{	break;	}
			
			// 求出此Bingo的狀態
			$tmp_State = mb_substr($LIST["Bingo_Super_{$sub_Type}_Same"] , 0 ,1 , "utf-8");
			if( $tmp_NowState == $tmp_State )
			{// 和上一個相同值
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "{$LIST['Bingo_Period']} - $tmp_Index 和上一個相同值 : " . $LIST["Bingo_Super_{$sub_Type}_Same"] . " , $tmp_State <br>" ;	}
				
				$array_State[$tmp_Index]['Num']++ ;
				// 設定最大層數值
				if( $tmp_Max_Level < $array_State[$tmp_Index]['Num'] )
				{ $tmp_Max_Level = $array_State[$tmp_Index]['Num'] ;	}
			}
			else
			{// 和上一個不同值
				$tmp_NowState = $tmp_State ;
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "{$LIST['Bingo_Period']} - $tmp_Index 和上一個不同值 : " . $LIST["Bingo_Super_{$sub_Type}_Same"] . " , $tmp_State <br>" ;	}
				
				if( $array_State[$tmp_Index]['Type'] == "")
				{// 沒有設值,是第一筆
					if( $tmp_State == $array_Type[$sub_Type][0] )
					{	$tmp_Start_Value = 0 ;	}
					else
					{	$tmp_Start_Value = 1 ;	}
				}
				else
				{// 已有設值,不是第一筆
					$tmp_Index++ ;
					// 收集完成結束
					if( $tmp_Index > $sub_Show_Index )
					{	break;	}
				}
				// 設定要確認的Index值
				$tmp_Check_Index = ($tmp_Index + $tmp_Start_Value)%2 ;
				$array_State[$tmp_Index]['Type'] = $array_Type[$sub_Type][$tmp_Check_Index] ;
				$array_State[$tmp_Index]['Num'] = 1 ;
			}
			
		}
		
		// 返轉陣列
		$array_State = array_reverse($array_State);
		
		// 測試用陣列
		if( $Funct == "RoadInfo" )
		{
			//$array_State[1]['Num'] = "7" ;
			//$array_State[2]['Num'] = "8" ;
			//$array_State[3]['Num'] = "10" ;
			//$array_State[6]['Num'] = "10" ;
			//$array_State[7]['Num'] = "5" ;
			$array_State[27]['Num'] = "8" ;
		}
		
		//echo "<p>RoadInfo() 求出陣列</p>" ;print_r($array_State);echo "<br>" ;

		// 算出陣列內的值為何(空白:無 , 0 : (大,單) , 1 : (小,雙) )
		foreach( $array_State as $key => $value )
		{
			//echo "$key => {$value['Type']} {$value['Num']}<br>" ;
			$tmp_X = $key ;	// 左右值
			$tmp_Y = 0 ;	// 上下值
			$tmp_RunRigth = 0 ;	// 往右移
			
			for( $i = 0 ; $i < $value['Num'] ; $i++ )
			{
				if( $i < 6 )
				{
					if( $array_Content[$tmp_X][$i] == "" AND $tmp_RunRigth != 1 )
					{// 沒有內容,直接設定
						//$tmp_X = $i ;	// 左右值
						$tmp_Y = $i ;	// 上下值
					}
					else// 有內容,往右設定
					{
						$tmp_RunRigth = 1 ;	// 往右移
						$tmp_X++ ;	// 左右值
						//$tmp_Y = $i ;	// 上下值
					}
				}
				else
				{// 往右設定
					$tmp_X++ ;	// 左右值
				}
				//echo "$tmp_X $tmp_Y {$value['Type']}<br>" ;
				$array_Content[$tmp_X][$tmp_Y] = $value['Type'] ;
			}
		}
		// 產生表格資料
		echo "<table>\n" ;
		echo "<tr>\n" ;
		if($sub_Type == "BS")
		{	echo "    <td rowspan='7' valign=top><img src='{$MAIN_BASE_ADDRESS}images/Banner_BigSmall.png'></td>\n" ;	}
		else
		{	echo "    <td rowspan='7' valign=top><img src='{$MAIN_BASE_ADDRESS}images/Banner_SingleDouble.png'></td>\n" ;	}
		echo "</tr>\n" ;

		for( $i = sizeof($array_Content)-$sub_Show_Index-1 ; $i < sizeof($array_Content) ; $i++ )
		{// 1-31
			//echo "<tr>\n";
			for( $j = 0 ; $j < 6 ; $j++ )
			{//1-6
			//$array_Type['BS'][0]
				if( $array_Content[$i][$j] == "大" OR $array_Content[$i][$j] == "單" )
				{	$tmp_Check_Index = 0 ;	}
				else
				{	$tmp_Check_Index = 1 ;	}

				$tmp_Td[$j] .= "<td class='{$sub_Type}_{$tmp_Check_Index}'>{$array_Content[$i][$j]}</td>\n" ;
				//echo "    <td>{$array_Content[$i][$j]}</td>\n";
				if($j == 100 )break;
			}
			//echo "</tr>\n";
			if($i == 100 )break;
		}
		for( $i = 0 ; $i < sizeof($tmp_Td) ; $i++ )
		{
			echo "<tr>$tmp_Td[$i]</tr>\n" ;
		}
		echo "</table>\n" ;

		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{	echo "沒有找到資料<br>" ;	}

}
//~@_@~// END 取得大小單雙牌路表-向右移 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 找出連莊球數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getBingo_Same_Num( $array_Now_Num , $array_Last_Num )
{
	global $link;
	/*
	範例			: $tmp_Same_Num = WinHappy_getBingo_Same_Num( $array_Now_Num , $array_Last_Num ) ;		// 找出連莊球數
	功能			: 找出連莊球數
	修改日期		: 20200715
	參數說明 :
		$array_Now_Num		本期開獎號碼陣列
		$array_Last_Num		上期開獎號碼陣列
	回傳參數 :
		$tmp_Same_Num		相同數目
	使用範例 :		:
		$tmp_Same_Num = WinHappy_getBingo_Same_Num( $array_Now_Num , $array_Last_Num ) ;		// 找出連莊球數
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// $array_Bingo_Num-本期獎號
	$tmp_Bingo_Super_Same= 0 ;
	foreach( $array_Now_Num as $key => $value )
	{
		//echo "$key1 => $value1<br>" ;
		if (in_array($value, $array_Last_Num, true))
		{
			//echo "上期找到相同資料-$value1<br>" ;
			$tmp_Bingo_Super_Same++ ;
		}
	}
	return $tmp_Bingo_Super_Same;
}
//~@_@~// END 找出連莊球數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 找出超級大小單雙連莊次數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getSuper_BS_SD_Info( $sub_Now_Bingo_Super_Num , $sub_Last_Bingo_Super_BS_Same , $sub_Last_Bingo_Super_SD_Same )
{
	global $link;
	/*
	範例			: $tmp_Same_Num = WinHappy_getSuper_BS_SD_Info( $sub_Now_Bingo_Super_Num , $sub_Last_Bingo_Super_BS_Same , $sub_Last_Bingo_Super_SD_Same ) ;		// 找出超級大小單雙連莊次數
	功能			: 找出超級大小單雙連莊次數
	修改日期		: 20200715
	參數說明 :
		$sub_Now_Bingo_Super_Num		本期超級獎號
		$sub_Last_Bingo_Super_BS_Same	上期超級大小連莊次數
		$sub_Last_Bingo_Super_SD_Same	上期超級單雙連莊次數
	回傳參數 :
		$array_Super_Same				超級連莊種類和次數
			$array_Super_Same['BS']		超級連莊大小和次數(大,1 , 小,2)
			$array_Super_Same['SD']		超級連莊單雙和次數(單,4 , 雙,4)
	使用範例 :		:
		$array_Super_Same = WinHappy_getSuper_BS_SD_Info( 35 , "大,5" , "單,2" ) ;		// 找出超級大小單雙連莊次數
		// BS : 超級連莊大小 , SD : 超級連莊單雙
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// 內定為1
	$tmp_Bingo_Super_BS_Same_Num = 1 ;
	$tmp_Bingo_Super_SD_Same_Num = 1 ;

	// 分析超級獎號 - 大小
	if( $sub_Now_Bingo_Super_Num <= 40 )
	{	$tmp_Bingo_Super_BS_Same_Value = "小" ;	}
	else
	{	$tmp_Bingo_Super_BS_Same_Value = "大" ;	}

	// 分析超級獎號 - 單雙
	if( $sub_Now_Bingo_Super_Num % 2 )
	{	$tmp_Bingo_Super_SD_Same_Value = "單" ;	}
	else
	{	$tmp_Bingo_Super_SD_Same_Value = "雙" ;	}

	// 有本期超級獎號
	if( $sub_Now_Bingo_Super_Num )
	{
		// 分析 超級大小連莊次數
		if( $sub_Last_Bingo_Super_BS_Same )
		{
			// 分析舊資料
			$array_Split_BS = str2array($sub_Last_Bingo_Super_BS_Same , ",");
			// 超級大小兩期相同
			if( $array_Split_BS[0] == $tmp_Bingo_Super_BS_Same_Value )
			{	$tmp_Bingo_Super_BS_Same_Num = $array_Split_BS[1] + 1 ;	}
		}
		
		// 分析 超級單雙連莊次數
		if( $sub_Last_Bingo_Super_SD_Same )
		{
			$array_Split_SD = str2array($sub_Last_Bingo_Super_SD_Same , ",");
			//echo "$array_Split[0] == $tmp_Bingo_Super_SD_Same_Value ";
			if( $array_Split_SD[0] == $tmp_Bingo_Super_SD_Same_Value )
			// 超級單雙相同
			{	$tmp_Bingo_Super_SD_Same_Num = $array_Split_SD[1] + 1 ;	}
		}
	}
	// 超級連莊大小和次數(大,1 , 小,2)
	$array_Super_Same['BS'] = $tmp_Bingo_Super_BS_Same_Value . "," . $tmp_Bingo_Super_BS_Same_Num ;
	// 超級連莊級單雙次數(單,4 , 雙,4)
	$array_Super_Same['SD'] = $tmp_Bingo_Super_SD_Same_Value . "," . $tmp_Bingo_Super_SD_Same_Num ;
	return $array_Super_Same ;
}
//~@_@~// END 找出超級大小單雙連莊次數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 找出一般大小連莊次數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_get_Size_Same_Info( $sub_Now_Bingo_Size_Same , $sub_Last_Bingo_Size_Same )
{
	global $link;
	/*
	範例			: $tmp_Size_Same = WinHappy_get_Size_Same_Info(  $sub_Now_Bingo_Size_Same , $sub_Last_Bingo_Size_Same ) ;		// 找出一般大小連莊次數
	功能			: 找出一般大小連莊次數
	修改日期		: 20200715
	參數說明 :
		$sub_Now_Bingo_Size_Same		本期一般大小連莊
		$sub_Last_Bingo_Size_Same		上期一般大小連莊
	回傳參數 :
		$tmp_Size_Same				一般大小種類和次數
	使用範例 :		:
		$tmp_Size_Same = WinHappy_get_Size_Same_Info( "大" , "大,2" ) ;		// 找出一般大小連莊次數
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// 內定為1
	$tmp_Bingo_Size_Same = 1 ;
	$array_Split = str2array($sub_Last_Bingo_Size_Same , ",");
	if( $sub_Now_Bingo_Size_Same != "－" )
	{
		// 是否為相同值 // 相同 值+1
		if( $array_Split[0] == $sub_Now_Bingo_Size_Same )
		{	$tmp_Bingo_Size_Same = $array_Split[1] + 1 ;	}
		//echo "開出新值 $value[3] $tmp_Bingo_Size_Same<br>" ;
	}
	return $sub_Now_Bingo_Size_Same . "," . $tmp_Bingo_Size_Same ;
}
//~@_@~// END 找出一般大小連莊次數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 把Bingo小於10的值補0 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_BingoNumAddFix0( $array_BingoNum )
{
	global $link;
	/*
	範例			: $array_NewBingoNum = WinHappy_BingoNumAddFix0( $array_BingoNum ) ;		// 把Bingo小於10的值補0
	功能			: 把Bingo小於10的值補0
	修改日期		: 20200730
	參數說明 :
		$array_BingoNum			Bingo陣列
	回傳參數 :
		$array_NewBingoNum		新補0的Bingo陣列
	使用範例 :		:
		$array_NewBingoNum = WinHappy_BingoNumAddFix0( $array_BingoNum ) ;		// 把Bingo小於10的值補0
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	foreach( $array_BingoNum as $key => $value )
	{
		if( $value < 10 )
		{	$array_NewBingoNum[$key] = "0$value";	}
		else
		{	$array_NewBingoNum[$key] = "$value";	}
	}
	return $array_NewBingoNum;
}
//~@_@~// END 把Bingo小於10的值補0 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 下注相關
//~@_@~// START 秀出投注單列表 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_htmlBetTickList()
{
	global $link;
	/*
	範例			: WinHappy_htmlBetTickList() ;		// 秀出投注單列表
	功能			: 秀出開獎號碼列表
	修改日期		: 20200515
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_htmlBetTickList() ;		// 秀出開獎號碼列表
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
	include($MAIN_BASE_ADDRESS . "Project/WinHappy/array/Array_Bet_Type.inc") ;        // 載入專案處理狀況
	
	echo "	<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"tickTable\">\n";
	echo "		<tbody>\n";
	echo "			<tr>\n";
	echo "				<th colspan=\"4\" style=\"color:#FFF;font-size:13px;background:#D2523C;letter-spacing:4px;\">目前投注單列表</th>\n";
	echo "			</tr>\n";
	echo "			<tr style=\"font-size:12px;\">\n";
	echo "				<td style=\"background:#FFFFDA\">期數</td>\n";
	echo "				<td style=\"background:#FFFFDA\">球號</td>\n";
	echo "				<td style=\"background:#FFFFDA\">賠率</td>\n";
	echo "				<td style=\"background:#FFFFDA\">點數</td>\n";
	echo "			</tr>\n";
	
	// 找出是否有新下注資料
	$SQL_Bet_New = "SELECT * FROM Bet WHERE Bet_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND Bet_Member_ID = '{$_SESSION['Member_ID']}'" ;
	//echo $SQL_Bet_New . "<br>" ; 
	$QUERY_Bet_New = mysqli_query($link , $SQL_Bet_New) ;
	
	$tmp_Bet_Money_Sum = 0 ;
	// 是否有資料
	if ( mysqli_num_rows($QUERY_Bet_New) )
	{
		$tmp_Index = 1 ;
		// 一條條獲取
		while ($LIST_Bet_New = mysqli_fetch_assoc($QUERY_Bet_New))
		{
			echo "			<tr style=\"font-size:10px;\">\n";
			echo "				<td id='NowBet{$tmp_Index}'>" . mb_substr( $LIST_Bet_New['Bet_Bingo_Period'] , -5 , 5 , "utf-8") . "</td>\n";
			// 星彩
			if( $LIST_Bet_New['Bet_Type'] == "3_0" OR $LIST_Bet_New['Bet_Type'] == "4_0" OR $LIST_Bet_New['Bet_Type'] == "5_0" OR $LIST_Bet_New['Bet_Type'] == "6_0" OR $LIST_Bet_New['Bet_Type'] == "7_0" )
			{	echo "				<td>" . mb_substr( $Array_Bet_Type[$LIST_Bet_New['Bet_Type']] , 0 , 2 , "utf-8") . "[{$LIST_Bet_New['Bet_Ball_List']}]</td>\n";	}
			else// 大小單雙
			{	echo "				<td>" . $Array_Bet_Type[$LIST_Bet_New['Bet_Type']] . "</td>\n";	}
			echo "				<td>{$LIST_Bet_New['Bet_Odds']}</td>\n";
			echo "				<td>{$LIST_Bet_New['Bet_AllMoney']}</td>\n";
			echo "			</tr>\n";
			$tmp_Bet_Money_Sum += $LIST_Bet_New['Bet_AllMoney'];
			$tmp_Index++ ;
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_Bet_New);
	}
	
	echo "			<tr>\n";
	echo "				<th colspan=\"2\" align=\"right\">合計</th>\n";
	echo "				<td colspan=\"2\">$tmp_Bet_Money_Sum</td>\n";
	echo "			</tr>\n";
	echo "			<tr>\n";
	echo "				<th colspan=\"4\" style=\"color:#FFF;font-size:13px;background:#D2523C;letter-spacing:4px;\">上期投注單結果</th>\n";
	echo "			</tr>\n";
	echo "			<tr style=\"font-size:12px;\">\n";
	echo "				<td style=\"background:#FFFFDA\">期數</td>\n";
	echo "				<td style=\"background:#FFFFDA\">球號</td>\n";
	echo "				<td style=\"background:#FFFFDA\">賠率</td>\n";
	echo "				<td style=\"background:#FFFFDA\">總計</td>\n";
	echo "			</tr>\n";
	
	// 找出是否有新下注資料
	$SQL_LastBet_New = "SELECT * FROM Bet WHERE Bet_Bingo_Period = '{$array_BingoPeriod['LastBingo']}' AND Bet_Member_ID = '{$_SESSION['Member_ID']}'" ;
	//echo $SQL_LastBet_New . "<br>" ; 
	$QUERY_LastBet_New = mysqli_query($link , $SQL_LastBet_New) ;
	
	$tmp_Bet_Money_Sum = 0 ;
	// 是否有資料
	if ( mysqli_num_rows($QUERY_LastBet_New) )
	{
		$tmp_Index = 1 ;
		// 一條條獲取
		while ($LIST_LastBet_New = mysqli_fetch_assoc($QUERY_LastBet_New))
		{
			echo "			<tr style=\"font-size:10px;\">\n";

			// 期數
			echo "				<td id='LastBet{$tmp_Index}'>" . mb_substr( $LIST_LastBet_New['Bet_Bingo_Period'] , -5 , 5 , "utf-8") . "</td>\n";

			// 球號
			if( $LIST_LastBet_New['Bet_Type'] == "3_0" OR $LIST_LastBet_New['Bet_Type'] == "4_0" OR $LIST_LastBet_New['Bet_Type'] == "5_0" OR $LIST_LastBet_New['Bet_Type'] == "6_0" OR $LIST_LastBet_New['Bet_Type'] == "7_0" )
			{	echo "				<td>" . mb_substr( $Array_Bet_Type[$LIST_LastBet_New['Bet_Type']] , 0 , 2 , "utf-8") . "[{$LIST_LastBet_New['Bet_Ball_List']}]</td>\n";	}
			else
			{	echo "				<td>" . $Array_Bet_Type[$LIST_LastBet_New['Bet_Type']] . "</td>\n";	}

			// 賠率
			echo "				<td>{$LIST_LastBet_New['Bet_Odds']}</td>\n";

			// 下注金額
			if( $LIST_LastBet_New['Bet_On'] == 1 )
			{// 已開獎
				echo "				<td>" . WinHappy_setMoneyCss( $LIST_LastBet_New['Bet_WinLost_AllMoney'] , "After" ) . "</td>\n";
				$tmp_Bet_Money_Sum += $LIST_LastBet_New['Bet_WinLost_AllMoney'];
			}
			else
			{// 未開獎
				echo "				<td>{$LIST_LastBet_New['Bet_AllMoney']}</td>\n";
				$tmp_Bet_Money_Sum = "開獎中";
			}
			echo "			</tr>\n";
			$tmp_Index++ ;
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_LastBet_New);
	}
	
	echo "			<tr>\n";
	echo "				<th colspan=\"2\" align=\"right\">合計</th>\n";
	if( $tmp_Bet_Money_Sum != "開獎中" )
	{	$tmp_Bet_Money_Sum = WinHappy_setMoneyCss( $tmp_Bet_Money_Sum , "After" ) ;	}
	echo "				<td colspan=\"2\" style=\"color:#090\">$tmp_Bet_Money_Sum</td>\n";
	echo "			</tr>\n";
	echo "		</tbody>\n";
	echo "	</table>\n";

}
//~@_@~// END 秀出投注單列表 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得下注賠率 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getBetOdds( $tmp_Bingo_Period , $tmp_i , $tmp_j )
{
	global $link;
	/*
	範例			: $tmp_BetOdds = WinHappy_getBetOdds($tmp_Bingo_Period , $tmp_i , $tmp_j ) ;		// 取得下注賠率
	功能			: 取得下注賠率
	修改日期		: 20200516
	參數說明 :
		$tmp_Bingo_Period	開獎Bingo期號
		$tmp_i				i
		$tmp_j				j
	回傳參數 :
		$tmp_BetOdds		下注賠率
	使用範例 :		:
		$tmp_BetOdds = WinHappy_getBetOdds( $tmp_Bingo_Period , $tmp_i , $tmp_j ) ;		// 取得下注賠率
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	//賠率呈現欄位名稱
	//odd_0_0	: 超級大 , odd_0_1 : 超級小
	//odd_1_0 : 超級單 , odd_1_1 : 超級雙
	//odd_2_0 : 一般大 , odd_2_1 : 一般小
	//odd_3_0 : 1星中1
	//odd_4_0 : 2星中1 , odd_4_1 : 2星中2
	//odd_5_0 : 3星中2 , odd_5_1 : 3星中3
	//odd_6_0 : 4星中2 , odd_6_1 : 4星中3 , odd_6_2 : 4星中4
	//odd_7_0 : 5星中3 , odd_7_1 : 5星中4 , odd_7_2 : 5星中5
	
	$array_GamePara = WinHappy_getGamePara() ;		// 取得遊戲相關參數

	//$array_GamePara['OddCount7'] = 3 ;			// 5星賠率數目
	//$array_GamePara['MoCount0'] = 2 ;			// 超級大小金額欄位數目

	$tmp_BetOdds = "" ;
	if( $tmp_i == 0 OR $tmp_i == 1 )
	{// 變動賠率
		// 找出最新一期的Bingo資料
		// 查詢資料
		$tmp_Bingo_SQL = "SELECT * FROM Bingo ORDER BY Bingo_Period DESC" ;
		$array_Bingo_Info = func_DatabaseGet( $tmp_Bingo_SQL , "SQL" , "" ) ;		// 取得資料庫資料
		if( $tmp_i == 0 )// 超級大小
		{
			$array_Value = str2array($array_Bingo_Info['Bingo_Super_BS_Same'] , ",");
			if( $tmp_j == 0 AND $array_Value[0] == "大" OR $tmp_j == 1 AND $array_Value[0] == "小" )
			{	$tmp_SameCount = ($array_Value[1] - 1) * 0.01 ;	}
			else
			{	$tmp_SameCount = 0 ;	}
		}
		else
		{// 超級單雙
			if( $tmp_j == 0 AND $array_Value[0] == "單" OR $tmp_j == 1 AND $array_Value[0] == "雙" )
			{	$tmp_SameCount = ($array_Value[1] - 1) * 0.01 ;	}
			else
			{	$tmp_SameCount = 0 ;	}
		}

		$tmp_BetOdds = $array_GamePara["odd_{$tmp_i}_{$tmp_j}"] - $tmp_SameCount;
	}
	else if( $tmp_i == 2 )
	{// 固定賠率
		// 
		$tmp_BetOdds = $array_GamePara["odd_{$tmp_i}_{$tmp_j}"] ;
	}
	else
	{// 固定賠率
		for( $i = 0 ; $i < $array_GamePara['OddCount'.$tmp_i] ; $i++ )
		{	$array_BetOdds[] = $array_GamePara["odd_{$tmp_i}_{$i}"] ;	}
		$tmp_BetOdds = array2str($array_BetOdds , "/");
	}
	
	return $tmp_BetOdds ;
	
}
//~@_@~// END 取得下注賠率 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定下注資料或回傳下注總金額 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_setBetInfo( $sub_Type = "Bet" )
{
	global $link;

	global $MAIN_BASE_ADDRESS ;
	global $Bet_Ball_List_Count ;
	global $MultBet ;
	global $Bet_Bingo_Period ;
	global $sum_3 ;
	global $sum_4 ;
	global $sum_5 ;
	global $sum_6 ;
	global $sum_7 ;
	global $Funct ;
	global $array_Bet_Ball_List ;
	/*
	範例			: $arrayReturn = WinHappy_setBetInfo( $sub_Type ) ;		// 設定下注資料或回傳下注總金額
	功能			: 設定下注資料或回傳下注總金額
	修改日期		: 20200702
	參數說明 :
		$sub_Type		要做的動作( Bet : 下注 , BetMoney : 回傳下注總金額 )
	回傳參數 :
		$arrayReturn	回傳資料
			$arrayReturn['Err_Code'] = "1" ;			// 設定回傳碼(1:成功,-1:失敗)
			$arrayReturn['Err_Msg'] = $tmp_ReturnMsg ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
			$arrayReturn['Err_Money'] = (int)$array_MemberNow_Info['Member_Money'] ;	// 剩下金額
			$arrayReturn['Err_AllMoney'] = 500 ;		// 下注總金額
	使用範例 :		:
		$arrayReturn = WinHappy_setBetInfo( $sub_Type ) ;		// 設定下注資料或回傳下注總金額
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// 判斷加入的多期期數是否大於本日最後一期
	$array_StratEnd_Bingo_Period = WinHappy_getStratEnd_Bingo_Period( date("Y-m-d") ) ;		// 取得某日開獎的第一期和最後一期號碼
	// Start : 第一期 , End : 最後一期
	// 測試上線值
	//$array_StratEnd_Bingo_Period['End'] = $Bet_Bingo_Period + 6 ;
	
	$arrMoIndex = array(2,2,2,1,1,1,1,1);	// 各金額欄位的數目-mo

	include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_get_ID.sub") ;	// 載入會員編號產生器
	include($MAIN_BASE_ADDRESS . "Project/WinHappy/array/Array_Bet_Type.inc") ;        // 載入專案處理狀況

	//賠率呈現欄位名稱
	//odd_0_0	: 超級大 , odd_0_1 : 超級小
	//odd_1_0 : 超級單 , odd_1_1 : 超級雙
	//odd_2_0 : 一般大 , odd_2_1 : 一般小
	//odd_3_0 : 1星中1
	//odd_4_0 : 2星中1 , odd_4_1 : 2星中2
	//odd_5_0 : 3星中2 , odd_5_1 : 3星中3
	//odd_6_0 : 4星中2 , odd_6_1 : 4星中3 , odd_6_2 : 4星中4
	//odd_7_0 : 5星中3 , odd_7_1 : 5星中4 , odd_7_2 : 5星中5
	//
	//下注欄位ID
	//mo_0_0 : 超級大 , mo_0_1 : 超級小
	//mo_1_0 : 超級單 , mo_1_1 : 超級雙
	//mo_2_0 : 一般大 , mo_2_1 : 一般小
	//mo_3_0 : 1星中1
	//mo_4_0 : 2星中1 , mo_4_1 : 2星中2
	//mo_5_0 : 3星中2 , mo_5_1 : 3星中3
	//mo_6_0 : 4星中2 , mo_6_1 : 4星中3 , mo_6_2 : 4星中4
	//mo_7_0 : 5星中3 , mo_7_1 : 5星中4 , mo_7_2 : 5星中5
	
	$tmp_SumMoney = 0 ;		// 下注總金額
	$tmp_ReturnMsg = "" ;	// 回傳訊息
	$tmp_BetMailMsg = "" ;	// 送給管理者Mail內容
	$tmp_Msg = "" ;			// 下注成功訊息
	$tmp_Bingo_5Start = 0 ;	// 五星彩獎金
	$tmp_Bingo_Super = 0 ;	// 總彩金獎金

	// 取得會員資料
	$array_Member_Info = WinHappy_getMemberInfo( $_SESSION['Member_ID'] ) ;		// 取得會員資料
	
	// 找出父ID
	$array_AgentInfo = WinHappy_getAgentInfo( $array_Member_Info['Member_Father_ID'] ) ;		// 取得代理人資料
	// 找出退水設定
	$array_BackWater_Info = func_DatabaseGet( "BackWater" , "*" , array("BackWater_Set_ID"=>$array_Member_Info['Member_Father_ID']) ) ;		// 取得資料庫資料

	// 找出下注限額設定
	//$array_BetLimit_Info = func_DatabaseGet( "BetLimit" , "*" , array("BetLimit_Set_ID"=>$array_Member_Info['Member_Father_ID']) ) ;		// 取得資料庫資料

	$array_SystemSet = WinHappy_getSystemSet() ;		// 取得系統設定值
	
	$tmp_LogInfo = "動作:會員下注 , 操作者 : {$_SESSION['Member_Name']} , 操作者ID : {$_SESSION['Member_ID']}<br>" ;		// LOG系統

	$tmp_BingoDate = WinHappy_subPeriod2Date($Bet_Bingo_Period) ;		// Bingo期號轉時間

	// 設定多期下注資料
	if( empty($MultBet) )
	{	$MultBet = 1 ;	}
	
	// 此遊戲是否可以下注
	$array_MemberBetLimitInfo = WinHappy_getMemberBetLimitInfo( $_SESSION['Member_ID'] ) ;		// 取得會員下注限額資訊

	// 輸入金額 : mo
	for( $i = 0 ; $i < sizeof($arrMoIndex) ; $i++ )
	{
		for( $j = 0 ; $j < $arrMoIndex[$i] ; $j++ )
		{
			if( $_POST["mo_{$i}_{$j}"])
			{// 有設金額,找出下注賠率(由系統中找)-超級大,超級小,超級單,超級雙
				if( $i <= 2 )
				{	${"sum_$i"} = 1 ;	}
				
				// xxx-----------------------------------
				// 取得賠率
				if( $sub_Type == "Bet" )
				{
					$tmp_BetOdds = WinHappy_getBetOdds( $Bet_Bingo_Period , $i , $j ) ;
					//if($i==1)$i++;
					
					// 如果會員關閉權限則無法下注
					// 如果會員投注關閉則無法下注-Member_Bingo_On
					if( $array_Member_Info['Member_Bingo_On'] == 0 )
					{	$tmp_ReturnMsg .= "<span style='color:#f00;'>" . $Array_Bet_Type_Msg["{$i}_{$j}"] . "-沒有權限可以下注</span>";continue;	}

					if( $array_MemberBetLimitInfo["{$i}_{$j}"]['On'] == 0 )
					{	$tmp_ReturnMsg .= "<span style='color:#f00;'>" . $Array_Bet_Type_Msg["{$i}_{$j}"] . "-沒有權限可以下注</span>";continue;	}
					
					// 是否小於下限
					//if( $array_MemberBetLimitInfo["{$i}_{$j}"]['Low'] > $_POST["mo_{$i}_{$j}"] * ${"sum_$i"} )
					if( $array_MemberBetLimitInfo["{$i}_{$j}"]['Low'] > $_POST["mo_{$i}_{$j}"] )
					{	$tmp_ReturnMsg .= "<span style='color:#f00;'>" . $Array_Bet_Type_Msg["{$i}_{$j}"] . "-金額小於單注最低限額</span>";continue;	}
					
					// 是否超過上限
					if( $array_MemberBetLimitInfo["{$i}_{$j}"]['Up'] < $_POST["mo_{$i}_{$j}"] )
					{	$tmp_ReturnMsg .= "<span style='color:#f00;'>" . $Array_Bet_Type_Msg["{$i}_{$j}"] . "-金額超過單注最高限額</span>";continue;	}
				}

				$tmp_Index = 0 ;
				// 多期投注
				for( $k = 0 ; $k < $MultBet ; $k++ )
				{
					if( $i <= 7 )
					{
						// 是否已超過單邊最高限額
						$bol_Side_Top = WinHappy_checkSide_Top( $Bet_Bingo_Period , "{$i}_{$j}" , $_POST["mo_{$i}_{$j}"] * ${"sum_$i"} ) ;		// 是否已超過單邊最高限額
						
						if( $bol_Side_Top )// 超過上限
						{	$tmp_ReturnMsg .= $bol_Side_Top;continue;	}
						//{	$tmp_ReturnMsg .= $Array_Bet_Type_Msg["{$i}_{$j}"] . "-$bol_Side_Top";continue;	}

						// 找出會員某期某類投注總金額
						//if( $bol_Side_Top == 1 )// 超過上限
						//{	$tmp_ReturnMsg .= $Array_Bet_Type_Msg["{$i}_{$j}"] . "-超過單邊最高限額";continue;	}
						//else if( $bol_Side_Top == 11 )// 超過注總金額
						//{	$tmp_ReturnMsg .= $Array_Bet_Type_Msg["{$i}_{$j}"] . "-超過單項最高限額";continue;	}
					}

					// 是否超過本日最後一期,超過則不新增下注
					if( $Bet_Bingo_Period + $k > $array_StratEnd_Bingo_Period['End'])
					{	break;	}

					if($tmp_Index > 100)// 防呆
					{	break;	}
					
					// xxx-----------------------------------
					if( $sub_Type == "Bet" )
					{// 下注
						// 找出下注ID
						$tempID = "Bet" . strtotime(date("Y-m-d H:i:s")) . mt_rand(10000 , 99999) ;
						// 先找出2位英文亂碼
						//$tmpStartCode = CreatRandomNum( "" , "" , "E" , "" , 2 ) ;	// 英(大)
						// 產生10碼數字亂碼
						//$tempID = CreatRandomNum( "Bet" , "MembeBet_ID" , "N" , "$tmpStartCode" , 10 ) ;	// 數,英(大),英(小)
			
						// xxx-----------------------------------
						// 建立訂單
						$arrayField['Bet_ID'] = $tempID ;							// 下注ID
						$arrayField['Bet_Agent_ID'] = $array_Member_Info['Member_Father_ID'] ;	// 代理人代號
						$arrayField['Bet_Father_Agent_ID'] = $array_AgentInfo['Agent_ID'] ;	// 父代理人代號
						$arrayField['Bet_Member_ID'] = $_SESSION['Member_ID'] ;		// 下注會員代號
						$arrayField['Bet_Bingo_Period'] = ($Bet_Bingo_Period + $k) ;		// 開獎Bingo期號
						$arrayField['Bet_Ball_List'] = array2str( $array_Bet_Ball_List,",") ;	// 下注球號
						$arrayField['Bet_Ball_Amount'] = $Bet_Ball_List_Count ;		// 下注球數量
						$arrayField['Bet_Odds'] = $tmp_BetOdds ;					// 下注賠率
						$arrayField['Bet_Type'] = "{$i}_{$j}" ;						// 下注種類
						$arrayField['Bet_Count'] = ${"sum_$i"} ;					// 下注注數
						$arrayField['Bet_Money'] = $_POST["mo_{$i}_{$j}"] ;			// 單注下注金額
						$arrayField['Bet_AllMoney'] = $_POST["mo_{$i}_{$j}"] * ${"sum_$i"} ;	// 下注總金額
						$arrayField['Bet_Draw_DT'] = "" ;							// 開獎日期
						$arrayField['Bet_Add_DT'] = date("Y-m-d H:i:s") ;			// 押注時間
						$arrayField['Bet_Content'] = "POST參數 : " . array2json($_POST) ;			// 備註

						$tmp_LogInfo .= " , 下注ID:$tempID , 開獎Bingo期號:{$arrayField['Bet_Bingo_Period']} , 下注球號:{$arrayField['Bet_Ball_List']} , 下注球數量:{$arrayField['Bet_Ball_Amount']}" ;		// LOG系統
						$tmp_LogInfo .= " , 下注賠率:{$arrayField['Bet_Odds']} , 下注種類:" . $Array_Bet_Type[$arrayField['Bet_Type']] . " , 下注注數:{$arrayField['Bet_Count']} , 單注下注金額:{$arrayField['Bet_Money']} , 下注總金額:{$arrayField['Bet_AllMoney']}<br>" ;		// LOG系統

						$array_AgentList = WinHappy_getAgentList( $arrayField['Bet_Agent_ID'] , "A" , $tmp_First_Type) ;
						//取得上線'名稱','分成比','返水比','id'資料
						$arrayField['Bet_Online_id'] = "," . array2str($array_AgentList['I'] , ",") . "," ;							// 上線id

						$arrayField['Bet_On'] = 0 ;									// 會員權限
			
						$arrayField['Bet_Member_Proportion'] = $array_AgentInfo['Agent_Share'] ;	// 會員占成
			
						if( $i < 2 )// 賓果超級退水
						{	$tmp_Field = "BackWater_Bingo_Super" ;	}
						else// 一般大小和12星球
						{	$tmp_Field = "BackWater_Bingo_Gen_12Start" ;	}
			
						$arrayField['Bet_Member_Backwater_Ratio'] = $array_BackWater_Info[$tmp_Field] ;	// 會員返水比
						// 會員返水金額
						$arrayField['Bet_Member_Backwater_Money'] = $arrayField['Bet_AllMoney'] * $array_BackWater_Info[$tmp_Field] / 100 ;
						
						// xxx-----------------------------------
						$Bol = func_DatabaseBase( "Bet" , "ADD" , $arrayField , "" ) ;					// 資料庫處理
						if( $Bol )
						{// 設定備援系統資料
							unset($arrayField['Bet_Content']);
							$arrayData = $arrayField ;
							$arrayData['TableName'] = "Bet" ;					// 表格名稱
							$arrayData['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
							$arrayData['WhereField'] = "Bet_ID" ;			// 操作判斷式欄位名稱(新增-判斷是否有重複)(Member_ID),不可以用id,因為兩台主機資料庫可能不同
							$arrayData['WhereKey'] = $tempID ;		// 操作判斷式關鍵字(新增-判斷是否有重複)(Member202007010001),不可以用id,因為兩台主機資料庫可能不同
							//WinHappy_setBackupInfo( array2json($arrayData) , $arrayData['Bet_Bingo_Period'] , $tmp_BingoDate ) ;
							WinHappy_setBackupInfo( array2json($arrayData) , "" , "" ) ;		// 設定備援系統資料
						}

						// 是否有5星投注
						if( $i == 7 )
						{	$tmp_Bingo_5Start += $arrayField['Bet_AllMoney'] * $array_SystemSet['SystemSet_5Start_BonusPool_Ratio'] / 100 ;	}
						// 是否有超級投注
						else if( $i == 0 OR $i == 1 )
						{	$tmp_Bingo_Super += $arrayField['Bet_AllMoney'] * $array_SystemSet['SystemSet_All_BonusPool_Ratio'] / 100 ;	}
					}
					else// 回傳下注總金額
					{	$Bol = 1;	}

					if( $Bol )
					{// 計算下注金額
						$tmp_SumMoney += ($_POST["mo_{$i}_{$j}"] * ${"sum_$i"}) ;
	
						// xxx-----------------------------------
						if( $sub_Type == "Bet" )
						{// 下注
							// 扣會員點數
							$tmpSQL_Money = "UPDATE Member SET Member_Money = Member_Money - {$arrayField['Bet_AllMoney']} WHERE Member_ID = '{$_SESSION['Member_ID']}'" ;	// 欄位值+1
							//$tmp_ReturnMsg .= $tmpSQL_Money ;
							$Bol_Money = func_DatabaseBase( $tmpSQL_Money , "SQL" , "" , "" ) ;									// 資料庫處理
							if ( $Bol_Money )
							{// 會員點數扣除成功
								// 取得會員資料
								$array_MemberAdd_Info = WinHappy_getMemberInfo( $_SESSION['Member_ID'] ) ;		// 取得會員資料
								// 加入金額Log
								$arrayField_MoneyLog['MoneyLog_Set_ID'] = $_SESSION['Member_ID'] ;			// 設定者ID
								$arrayField_MoneyLog['MoneyLog_Class'] = 1 ;									// 操作分類#::SELECT:2||1||會員||2||代理人::
								$arrayField_MoneyLog['MoneyLog_Type'] = 1 ;									// 操作動作#::SELECT:2||0||其它||1||遊戲投注||2||遊戲派彩||3||存入||4||提出||5||莊家派彩||6||五星彩獎金||7||總彩金獎金:
								$arrayField_MoneyLog['MoneyLog_Bet_ID'] = $arrayField['Bet_ID'] ;			// 下注訂單號
								$arrayField_MoneyLog['MoneyLog_Money'] = $arrayField['Bet_AllMoney'] ;		// 操作金額
								$arrayField_MoneyLog['MoneyLog_Original_Money'] = $array_MemberAdd_Info['Member_Money'] ;	// 操作前金額
								$arrayField_MoneyLog['MoneyLog_Operator_IP'] = $_SERVER['REMOTE_ADDR'] ;		// 操作者IP
								$arrayField_MoneyLog['MoneyLog_Operator_ID'] = $_SESSION['Member_ID']	 ;	// 操作者ID
								$arrayField_MoneyLog['MoneyLog_Operator_Name'] = $_SESSION['Member_Name'] ;	// 操作者名稱
								$arrayField_MoneyLog['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;				// 操作時間
								
								$Bol_MoneyLog = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField_MoneyLog , "" ) ;						// 資料庫處理
							}
							else
							{	echo "資料執行失敗" ;	}
							// 下注成功訊息
							$tmp_ReturnMsg .= "{$Array_Bet_Type_Msg[$arrayField['Bet_Type']]} 賠率 {$arrayField['Bet_Odds']} 遊戲點數 {$arrayField['Bet_AllMoney']}<br>" ;
							// 送給管理者Mail內容-下注ID,開獎Bingo期號,下注者名稱,下注賠率,下注者ID,下注種類,下注球數(1-5星),下注金額,下注筆數,下注總金額,下注時間,
							//$tmp_BetMailMsg .= "下注ID,開獎Bingo期號,下注者名稱,下注賠率,下注者ID,下注種類,下注球數(1-5星),下注金額,下注筆數,下注總金額,下注時間" ;

							$tmp_BetMailMsg .= "下注ID : $tempID<br>\n" ;
							$tmp_BetMailMsg .= "開獎Bingo期號 : {$arrayField['Bet_Bingo_Period']}<br>\n" ;
							$tmp_BetMailMsg .= "下注者名稱 : {$array_Member_Info['Member_Name']}<br>\n" ;
							$tmp_BetMailMsg .= "下注賠率 : {$tmp_BetOdds}<br>\n" ;
							$tmp_BetMailMsg .= "下注者ID : {$_SESSION['Member_ID']}<br>\n" ;
							$tmp_BetMailMsg .= "下注種類 : {$Array_Bet_Type_Msg[$arrayField['Bet_Type']]}<br>\n" ;
							$tmp_BetMailMsg .= "下注球數(1-5星) : " . array2str( $array_Bet_Ball_List,",") . "<br>\n" ;
							$tmp_BetMailMsg .= "下注金額 : " . $_POST["mo_{$i}_{$j}"] . "<br>\n" ;
							$tmp_BetMailMsg .= "下注注數 : " . ${"sum_$i"} . "<br>\n" ;
							$tmp_BetMailMsg .= "下注總金額 : " . $_POST["mo_{$i}_{$j}"] * ${"sum_$i"} . "<br><br>\n" ;
							$tmp_Index++ ;
						}
					}
				}
			}
		}
	}
	
	// xxx-----------------------------------
	if( $sub_Type == "Bet" )
	{// 下注
		// 是否有五星彩獎金
		if( $tmp_Bingo_5Start )
		{
			$tmpSQL_5Start = "UPDATE SystemSet SET SystemSet_5Start_BonusPool = SystemSet_5Start_BonusPool + $tmp_Bingo_5Start WHERE id_SystemSet = '1'" ;				// 欄位值+1
			$Bol_5Start = func_DatabaseBase( $tmpSQL_5Start , "SQL" , "" , "" ) ;									// 資料庫處理
			if ( $Bol_5Start )
			{// 加入LOG
			}
			//else
			//{	echo "資料執行失敗" ;	}
		}

		// 是否有總彩金獎金
		if( $tmp_Bingo_Super )
		{
			$tmpSQL_All = "UPDATE SystemSet SET SystemSet_All_BonusPool = SystemSet_All_BonusPool + $tmp_Bingo_Super WHERE id_SystemSet = '1'" ;				// 欄位值+1
			$Bol_All = func_DatabaseBase( $tmpSQL_All , "SQL" , "" , "" ) ;									// 資料庫處理
			if ( $Bol_All )
			{// 加入LOG
			}
			//else
			//{	echo "資料執行失敗" ;	}
		}

		// 有下注金額,扣會員金額
		if( $tmp_SumMoney OR $tmp_ReturnMsg )
		{
			// 加入操作LOG
			$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
			$array_LogInfo['OperatorID'] = $_SESSION['Member_ID'] ;		// 操作者ID
			$array_LogInfo['OperatorName'] = $_SESSION['Member_Name'] ;	// 操作者姓名
			$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
			$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
			$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
			$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
			// 參考 func_WriteLogFieldInfo()
			$array_LogInfo['Type'] = "下注" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
			$array_LogInfo['Info'] = "$tmp_LogInfo" ;			// 操作記錄 備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)
	
			// 會員操作-管理等級來判斷
			$tmpCode = func_WriteLogFieldInfo( "Member" , "Member_ID" , $_SESSION['Member_ID'] , "Member_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料

			// 取得會員資料
			$array_MemberNow_Info = WinHappy_getMemberInfo( $_SESSION['Member_ID'] ) ;		// 取得會員資料
			
			$arrayReturn['Err_Code'] = "1" ;		// 設定回傳碼(1:成功,-1:失敗)
			$arrayReturn['Err_Msg'] = $tmp_ReturnMsg ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
			$arrayReturn['Err_Money'] = (int)$array_MemberNow_Info['Member_Money'] ;	// 剩下金額

			$bol_BetMail = WinHappy_sentBetMail( $tmp_BetMailMsg ) ;		// 送出下注資料給管理者
		}
		else
		{
			$arrayReturn['Err_Code'] = "-1" ;		// 設定回傳碼(1:成功,-1:失敗)
			$arrayReturn['Err_Msg'] = "下注失敗" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
		}
	}
	else
	{
		if( $tmp_SumMoney > $array_Member_Info['Member_Money'] )
		{// 沒有足夠金額可以下注
			$arrayReturn['Err_Code'] = "-1" ;		// 設定回傳碼(1:成功,-1:失敗)
			$arrayReturn['Err_Msg'] = "沒有足夠金額可以下注" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
			$arrayReturn['Err_AllMoney'] = $tmp_SumMoney ;		// 下注總金額
		}
		else
		{// 有足夠金額可以下注
			$arrayReturn['Err_Code'] = "1" ;		// 設定回傳碼(1:成功,-1:失敗)
			$arrayReturn['Err_Msg'] = "有足夠金額可以下注" ;		// 設定錯誤訊息 , 成功則回傳回原來錢包的值
			$arrayReturn['Err_AllMoney'] = $tmp_SumMoney ;		// 下注總金額
		}
	}
	return $arrayReturn;
}
//~@_@~// END 設定下注資料或回傳下注總金額 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 某日是否已超過封頂值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_checkPeak_Value( $sub_Date )
{
	global $link;
	/*
	範例			: $bol_Peak_Value = WinHappy_checkPeak_Value( $sub_Bingo_Period ) ;		// 某日是否已超過封頂值
	功能			: 某日是否已超過封頂值
	修改日期		: 20200707
	參數說明 :
		$sub_Date				查詢日期
	回傳參數 :
		$bol_Peak_Value			是否超過封頂值(1 : 超過 , 0 : 沒超過)
	使用範例 :
		$bol_Peak_Value = WinHappy_checkPeak_Value( $sub_Bingo_Period ) ;		// 某日是否已超過封頂值
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	if( empty($sub_Date) )
	{	$sub_Date = date("Y-m-d");	}

	$array_Member_Info = WinHappy_getMemberInfo( $_SESSION['Member_ID'] ) ;		// 取得會員資料

	if( $array_Member_Info['Member_Peak_Value'] == 0 )
	{	return 0;	}
	else
	{
		// 找出某日輸贏值
		$tmpSQL = "SELECT sum(Bet_WinLost_AllMoney) as Bet_WinLost_AllMoney_Total FROM Bet WHERE Bet_Add_DT LIKE '%$sub_Date%' AND Bet_Member_ID = '{$_SRSSION['Member_ID']}'" ;				// 找出某欄位的總合
		$arrayInfo = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料
	
		//return $arrayInfo['Bet_WinLost_AllMoney_Total'] ;
		if( $array_Member_Info['Member_Peak_Value'] < $arrayInfo['Bet_WinLost_AllMoney_Total'] )
		{	return 1;	}
		else
		{	return 0;	}
	}
}
//~@_@~// END 某日是否已超過封頂值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 是否已超過單邊最高限額 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_checkSide_Top( $sub_Bingo_Period , $sub_Type , $sub_Money)
{
	global $link;
	global $MAIN_BASE_ADDRESS ;
	/*
	範例			: $bol_Side_Top = WinHappy_checkSide_Top( $sub_Bingo_Period , $sub_Type , $sub_Money ) ;		// 是否已超過單邊最高限額
	功能			: 是否已超過單邊最高限額
	修改日期		: 20200707
	參數說明 :
		$sub_Bingo_Period		查詢日期
		sub_Type				查詢類別(0_0 - 2_1)
		$sub_Money				本次下注金額
	回傳參數 :
		$bol_Side_Top			是否超過單邊最高限額(1 : 超過 , 0 : 沒超過)
	使用範例 :
		$bol_Side_Top = WinHappy_checkSide_Top( $sub_Bingo_Period , $sub_Type , $sub_Money ) ;		// 是否已超過單邊最高限額
	*/
	$tmpShowMsg = 0 ;

	include($MAIN_BASE_ADDRESS . "Project/WinHappy/array/Array_Bet_Type.inc") ;        // 載入專案處理狀況

	$array_Member_Info = WinHappy_getMemberInfo( $_SESSION['Member_ID'] ) ;		// 取得會員資料
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>取得會員資料-{$_SESSION['Member_ID']}</p>" ;print_r($array_Member_Info);echo "<br>" ;	}

	$array_AgentList = WinHappy_getAgentList( $array_Member_Info['Member_Father_ID'], "AI,N" , 2) ;		// 取得所有上線代理人資料
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>取得所有上線代理人資料</p>" ;print_r($array_AgentList);echo "<br>" ;	}

	// 設定內定沒有找過上限
	$tmp_Over = 0 ;
	
	// 下注種類 3_0||一星連碰||4_0||二星連碰||5_0||三星連碰||6_0||四星連碰||7_0||五星||0_0||超級號碼大小[大]||0_1||超級號碼大小[小]||1_0||超級號碼單雙[單]||1_1||超級號碼單雙[雙]||2_0||猜大小[大]||2_1||猜大小[小]:
	
	$array_Type_Name['0_0'] = "BetLimit_Super_BigSmall_Side";		// 超級號碼大小-單邊
	$array_Type_Name['0_1'] = "BetLimit_Super_BigSmall_Side";		// 超級號碼大小-單邊
	$array_Type_Name['1_0'] = "BetLimit_Super_SingleDouble_Side";	// 超級號碼單雙-單邊
	$array_Type_Name['1_1'] = "BetLimit_Super_SingleDouble_Side";	// 超級號碼單雙-單邊
	$array_Type_Name['2_0'] = "BetLimit_BigSmall_Side";				// 猜大小-單邊
	$array_Type_Name['2_1'] = "BetLimit_BigSmall_Side";				// 猜大小-單邊

	$array_Type_Name['3_0'] = "BetLimit_1Start_Side";				// 1星-單邊
	$array_Type_Name['4_0'] = "BetLimit_2Start_Side";				// 2星-單邊
	$array_Type_Name['5_0'] = "BetLimit_3Start_Side";				// 3星-單邊
	$array_Type_Name['6_0'] = "BetLimit_4Start_Side";				// 4星-單邊
	$array_Type_Name['7_0'] = "BetLimit_5Start_Side";				// 5星-單邊

	// 取出會員下注限額資料
	$array_Member_BetLimit_Info = func_DatabaseGet( "BetLimit" , "*" , array("BetLimit_Set_ID"=>"{$_SESSION['Member_ID']}") ) ;		// 取得資料庫資料

	// 找出會員某期某類投注總金額
	$tmpSQL_Member = "SELECT sum(Bet_AllMoney) as Bet_AllMoney_Total FROM Bet WHERE Bet_Bingo_Period = '$sub_Bingo_Period' AND Bet_Type = '$sub_Type' AND Bet_Member_ID = '{$_SESSION['Member_ID']}'" ;				// 找出某欄位的總合
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "找出會員某期某類投注總金額 : <br>$tmpSQL_Member<br>" ;	}
	$array_Member_Bet_Info = func_DatabaseGet( $tmpSQL_Member , "SQL" , "" ) ;		// 取得資料庫資料

	// 是否超過會員上限
	if( $array_Member_Bet_Info['Bet_AllMoney_Total'] + $sub_Money > $array_Member_BetLimit_Info[$array_Type_Name[$sub_Type]] )
	{	return "<span style='color:#f00;'>" . $Array_Bet_Type[$sub_Type] . "超過會員單項最高限額</span><br>";	}
	//{	return "超過會員單項最高限額 - 會員投注總金額({$array_Member_Bet_Info['Bet_AllMoney_Total']}) + 本次下注金額($sub_Money) > 會員下注限額({$array_Member_BetLimit_Info[$array_Type_Name[$sub_Type]]})";	}

	// 找出所有代理人上限資料
	for( $i = sizeof($array_AgentList["AI"])-1 ; $i >= 0 ; $i-- )
	{
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "-{$array_AgentList['AI'][$i]}<br>" ;	}

		// 找出代理下注限額
		$array_BetLimit_Info = func_DatabaseGet( "BetLimit" , "*" , array("BetLimit_Set_ID"=>$array_AgentList['AI'][$i]) ) ;		// 取得資料庫資料
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "<p>找出代理下注限額</p>" ;print_r($array_BetLimit_Info);echo "<br>" ;	}
		
		// 找出本代理人所有下線代理人資料

		// 找出某期某類某代理投注總金額
		$tmpSQL = "SELECT sum(Bet_AllMoney) as Bet_AllMoney_Total FROM Bet WHERE Bet_Bingo_Period = '$sub_Bingo_Period' AND Bet_Type = '$sub_Type' AND Bet_Online_id LIKE '%{$array_AgentList['I'][$i]}%'" ;				// 找出某欄位的總合
		//$tmpSQL = "SELECT sum(Bet_AllMoney) as Bet_AllMoney_Total FROM Bet WHERE Bet_Bingo_Period = '$sub_Bingo_Period' AND Bet_Type = '$sub_Type' AND Bet_Father_Agent_ID = '{$array_AgentList['AI'][$i]}'" ;				// 找出某欄位的總合
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "找出某期某類某代理投注總金額 : <br>$tmpSQL<br>" ;	}
		$arrayInfo = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料
		
		// 判斷資料
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "<p>代理人已投注總金額 : {$arrayInfo['Bet_AllMoney_Total']} + 本次下注金額 : $sub_Money > 代理人單邊最高限額 : {$array_BetLimit_Info[$array_Type_Name[$sub_Type]]}</p>" ;	}
		
		// 是否超過上限
		if( $arrayInfo['Bet_AllMoney_Total'] + $sub_Money > $array_BetLimit_Info[$array_Type_Name[$sub_Type]] )
		{	return "<span style='color:#f00;'>" . $Array_Bet_Type[$sub_Type] . "超過代理人單邊最高限額</span><br>";	}
		//{	return "超過代理人({$array_AgentList['N'][$i]})單邊最高限額 - 代理人已投注總金額({$arrayInfo['Bet_AllMoney_Total']}) + 本次下注金額($sub_Money) > 代理人單邊最高限額({$array_BetLimit_Info[$array_Type_Name[$sub_Type]]})";	}
	}

	// 沒有超過上限
	return 0;

}
//~@_@~// END 是否已超過單邊最高限額 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 送出下注資料給管理者 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_sentBetMail( $sub_Msg )
{
	global $link;
	/*
	範例			: $bol_BetMail = WinHappy_sentBetMail( $sub_Msg ) ;		// 送出下注資料給管理者
	功能			: 送出下注資料給管理者
	修改日期		: 20200711
	參數說明 :
		$sub_Msg		要送出的訊息
	回傳參數 :
		$bol_BetMail	是否送出成功(1 : 成功 , 0 : 失敗)
	使用範例 :
		$bol_BetMail = WinHappy_sentBetMail( $sub_Msg ) ;		// 送出下注資料給管理者
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	$array_Mail_Info = func_DatabaseGet( "SystemSet" , "*" , array("id_SystemSet"=>"1") ) ;		// 取得資料庫資料
	
	for( $i = 1 ; $i <= 5 ; $i++ )
	{
		if( $array_Mail_Info["SystemSet_Admin_Mail$i"] )
		{	$array_Mail[] = $array_Mail_Info["SystemSet_Admin_Mail$i"] ;	}
	}

	if( sizeof($array_Mail) )
	{
		$tmp_Mail = array2str($array_Mail , ",");
		
		//送信模組使用方法
		//1.設定參數
		//是否測試送信-1:送,0:不送(只秀出信件相關資訊)
		$mail_sent = "1" ;
		// 完成後跳出訊息和到某一指定頁,可以只填某一項
		$mail_alertgo_title = "" ;
		$mail_alertgo_url = "" ;
		//主機送信 mail
		$mail_service = "server@msa.hinet.net";
		//信件主旨
		$mail_subject = "贏家娛樂城-下注資料 :" . date("Y-m-d H:i:s");
		//收件人mail
		$mail_to      = $tmp_Mail;
		//信件內容
		$mail_message .= "$sub_Msg";
		include_once($MAIN_BASE_ADDRESS . "includes/sentmail/sentmail.php");
	}
}
//~@_@~// END 送出下注資料給管理者 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 開獎相關
//~@_@~// START 取得無重複的排列組合資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getCombinationToString( $subCombArray, $subCombSelectNum )
{
	global $link;
	/*
	範例			: $array_Comb = WinHappy_getCombinationToString( $subCombAllNum, $subCombSelectNum ) ;		// 取得無重複的排列組合資料
	功能			: 取得無重複的排列組合資料
	修改日期		: 20200522
	參數說明 :
		$subCombArray		要進行排列組合的資料
		$subCombSelectNum	要進行排列組合的個數
	回傳參數 :
		$array_Comb		無重複的排列組合資料
	使用範例 :
		// C5取3
		$array_CombArray = array(1,2,3,4,5);
		$subCombSelectNum = 3 ;
		$array_Comb = WinHappy_getCombinationToString( $array_CombArray , $subCombSelectNum ) ;		// 取得無重複的排列組合資料
		回傳結果:10種
	   [0] 1,2,3 [1] 1,2,4 [2] 1,2,5 [3] 1,3,4 [4] 1,3,5 [5] 1,4,5 [6] 2,3,4 [7] 2,3,5 [8] 2,4,5 [9] 3,4,5
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	//echo "$subCombAllNum $subCombSelectNum<br>";
	

	$result = array();
	if ( $subCombSelectNum == 1 )	// 只取1個
	{	return $subCombArray;	}
	
	if ($subCombSelectNum == count($subCombArray))
	{// 全選
		$result[] = implode(',' , $subCombArray);
		return $result;
	}
	// 第一個物件
	$temp_firstelement = $subCombArray[0];
	
	unset($subCombArray[0]);
	$subCombArray = array_values($subCombArray);
	$temp_list1 = WinHappy_getCombinationToString($subCombArray, ($subCombSelectNum-1));
	foreach ($temp_list1 as $s)
	{
		$s = $temp_firstelement.','.$s;
		$result[] = $s;
	}
	unset($temp_list1);
	$temp_list2 = WinHappy_getCombinationToString($subCombArray, $subCombSelectNum);
	foreach ($temp_list2 as $s)
	{
		$result[] = $s;
	}
	unset($temp_list2);
	return $result;
}
//~@_@~// END 取得無重複的排列組合資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 賓果開獎 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_BingoDraw()
{
	global $link;
	global $Array_Bet_Type;
	/*
	範例			: WinHappy_BingoDraw() ;		// 賓果開獎
	功能			: 賓果開獎
	修改日期		: 20200522
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :
		WinHappy_BingoDraw() ;		// 賓果開獎
	*/
	$tmpShowMsg = 1 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	// 找出所有未開獎的下注資料,且開獎Bingo期號已過

	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號

	$SQL_Bet = "SELECT * FROM Bet WHERE Bet_On = '0' AND Bet_Bingo_Period <= {$array_BingoPeriod['LastBingo']} LIMIT 90" ;
	echo "所有該開沒有開的下注資料 : " . $SQL_Bet . "<br>" ; 
	$QUERY_Bet = mysqli_query($link , $SQL_Bet) ;

	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "處理筆數 : " .mysqli_num_rows($QUERY_Bet) ;echo "<hr>" ;	}
	
	// 已讀取Bingo期數
	$array_Bingo_Period = array();
	// 已讀取Bingo資料
	$array_Bingo_Info = array();

	$tmp_5Start_Index = 0 ;		// 得到五星彩獎金的index
	$array_WinLost_5Start_ID = array();	// 初始中五星彩陣列
	
	// 找出五星彩得彩方式
	$array_SystemSet = WinHappy_getSystemSet() ;		// 取得系統設定值
	$array_5Start_Lottery_Way = str2array($array_SystemSet['SystemSet_5Start_Lottery_Way'] , ",");
	//echo "<p>五星彩得彩方式</p>" ;print_r($array_5Start_Lottery_Way);echo "<br>" ;

	// 求出系統中"五星彩得彩方式"
	for( $i = 0 ; $i < sizeof($array_5Start_Lottery_Way) ; $i = $i + 2 )
	{
		$tmp_Start = $i ;
		$tmp_End = $i + 1;
		//echo "$i $tmp_Start $tmp_End<br>" ;
		//$array_5Start_Way[$array_5Start_Lottery_Way[$tmp_Start]]['Ratio'] = $array_5Start_Lottery_Way[$tmp_End] ;
		$array_5Start_Way[$array_5Start_Lottery_Way[$tmp_Start]] = $array_5Start_Lottery_Way[$tmp_End] ;
	}
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>系統五星彩得彩方式</p>" ;print_r($array_5Start_Way);echo "<br>" ;	}
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY_Bet) )
	{
		// 一條條獲取
		while ($LIST_Bet = mysqli_fetch_assoc($QUERY_Bet))
		{
			// 星號中獎訊息
			$tmp_Bet_Start_Winning_Content = "" ;
			$sum_Bet_Start_Winning_Content = 0 ;

			// 取得該期Bingo開獎資訊
			// 是否已取得Bingo開獎資料
			if ( !in_array($LIST_Bet['Bet_Bingo_Period'], $array_Bingo_Period) )
			{// 還沒有取過Bingo開獎資訊,從資料庫中找
				$array_NowBingo = func_DatabaseGet( "Bingo" , "*" , array("Bingo_Period"=>$LIST_Bet['Bet_Bingo_Period']) ) ;		// 取得資料庫資料
				// 如果還沒有找到Bingo開獎資訊,要做相對應的動作,如通知管理者(Line)
				if( empty($array_NowBingo['Bingo_Num']) )
				{
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p>還沒有取得此期Bingo資料</p>" ;	}
					continue;
				}

				// 設定新取得的Bingo開獎資訊
				$array_Bingo_Period[] = $LIST_Bet['Bet_Bingo_Period'] ;
				$array_Bingo_Info[$LIST_Bet['Bet_Bingo_Period']] = $array_NowBingo ;
			}
			else// 已取過Bingo開獎資訊,從陣列中找
			{	$array_NowBingo = $array_Bingo_Info[$LIST_Bet['Bet_Bingo_Period']] ;	}

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<p>下注的開獎Bingo資料</p>" ;print_r($array_NowBingo);echo "<br>" ;	}

			// 初始值
			$tmp_Bet_Log = "" ;	// Log
			unset($arrayField);
			$arrayField['Bet_On'] = 0 ;							// 會員權限 1||已開獎:
			$arrayField['Bet_Winning_Type'] = "" ;				// 中獎類別-5星(中3),超級號碼大小[大]
			$arrayField['Bet_WinLost_Money'] = 0 ;				// 輸贏金額 = 贏 : 下注金額 * 賠率 , 輸 : 0
			$arrayField['Bet_WinLost_AllMoney'] = 0 ;			// 輸贏總金額 = 輸贏金額 - 下注金額
			$arrayField['Bet_Member_Proportion'] = 0;			// 會員占成
			$arrayField['Bet_Member_Backwater_Ratio'] = 0;		// 會員返水比
			$arrayField['Bet_Member_Backwater_Money'] = 0;		// 會員返水金額
			$arrayField['Bet_Member_Report_Money'] = 0;			// 會員報帳金額
			$arrayField['Bet_Online_WinLost_Money'] = "";		// 上線輸贏金額
			$arrayField['Bet_Online_Backwater_Money'] = "";		// 上線返水金額
			$arrayField['Bet_Online_AllMoney'] = "";			// 上線總金額
			$arrayField['Bet_Online_Reported_Money'] = "" ;		// 下線分成金額(50,12.05,23.01)
			$arrayField['Bet_Log'] = "" ;						// Log

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<h2>下注ID : {$LIST_Bet['Bet_ID']} , Bingo期號 : {$LIST_Bet['Bet_Bingo_Period']} , 投注種類編號 : {$LIST_Bet['Bet_Type']} , 投注種類名稱 : {$Array_Bet_Type[$LIST_Bet['Bet_Type']]}</h2>" ;	}

			// 取出訂單類別第一個字
			$tmp_First_Type = mb_substr( $LIST_Bet['Bet_Type'] , 0 , 1 , "utf-8");
			$tmp_Star_Num = $tmp_First_Type - 2;
			
			// 星號中獎訊息
			//$tmp_Bet_Start_Winning_Content .= "進行 {$tmp_Star_Num}星 派彩\n" ;
			
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{
				echo "<h2>進行 {$tmp_Star_Num}星 派彩</h2>" ;
				echo "<p>取出下注種類的第一個字({$LIST_Bet['Bet_Type']}) : <b>$tmp_First_Type</b> , 派彩星號為 : {$tmp_Star_Num}</p>" ;
			}

			// 取得所有上線代理人資料
			$array_AgentList = WinHappy_getAgentList( $LIST_Bet['Bet_Agent_ID'] , "A" , $tmp_First_Type) ;
			//取得上線'名稱','分成比','返水比','id'資料
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{
				echo "<h2>取得上線'名稱','分成比','返水比','id'資料</h2>" ;
				echo "<p>上線名稱</p>" ;print_r($array_AgentList['N']);echo "<br><br>" ;
				echo "<p>上線分成比</p>" ;print_r($array_AgentList['S']);echo "<br><br>" ;
				echo "<p>上線返水比</p>" ;print_r($array_AgentList['W']);echo "<br><br>" ;
				echo "<p>上線id</p>" ;print_r($array_AgentList['I']);echo "<br><br>" ;
			}

			//~@_@~// START 開獎設定 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			if( $tmp_First_Type <= 2 )
			{// 大小單雙開獎
				// Bingo欄位名稱 0->Bingo_Super_BS_Same , 1->Bingo_Super_SD_Same , 2->Bingo_Size_Same
				$array_Bingo_Field[0] = "Bingo_Super_BS_Same" ;
				$array_Bingo_Field[1] = "Bingo_Super_SD_Same" ;
				$array_Bingo_Field[2] = "Bingo_Size_Same" ;
				// 比對值 0_0->大 , 0_1->小 , 1_0->單 , 1_1->雙 , 2_0->大 , 2_1->小
				$array_Check_Key['0_0'] = "大" ;
				$array_Check_Key['0_1'] = "小" ;
				$array_Check_Key['1_0'] = "單" ;
				$array_Check_Key['1_1'] = "雙" ;
				$array_Check_Key['2_0'] = "大" ;
				$array_Check_Key['2_1'] = "小" ;
				
				// 找出"超級號碼大小"的值-Bingo_Super_BS_Same
				$array_Bingo_Super_BS_Same = str2array($array_NowBingo[$array_Bingo_Field[$tmp_First_Type]] , ",");
				//if( ($array_Bingo_Super_BS_Same[0] == "大" AND $LIST_Bet['Bet_Type'] == "0_0") OR ($array_Bingo_Super_BS_Same[0] == "小" AND $LIST_Bet['Bet_Type'] == "0_1") )
				// 比對開頭字是否相同
				if( $array_Bingo_Super_BS_Same[0] == $array_Check_Key[$LIST_Bet['Bet_Type']] )
				{// 是否選的值和開出的值相同
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p class='win'>你贏了oooo</p>" ;	}
					// 設定開獎資料
					// 中獎類別 5星(中3)
					$arrayField['Bet_Winning_Type'] = $Array_Bet_Type[$LIST_Bet['Bet_Type']] ;
					// 輸贏金額
					$arrayField['Bet_WinLost_Money'] = $LIST_Bet['Bet_Money'] * $LIST_Bet['Bet_Odds'] ;
				}
				else
				{
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p class='lost'>你輸了xxxx</p>" ;	}
					// 輸贏金額
					$arrayField['Bet_WinLost_Money'] = 0 ;
				}

				// 輸贏總金額 = 輸贏金額 - 下注總金額
				$arrayField['Bet_WinLost_AllMoney'] = $arrayField['Bet_WinLost_Money'] - $LIST_Bet['Bet_AllMoney'] ;

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "輸贏總金額({$arrayField['Bet_WinLost_AllMoney']}) = 輸贏金額({$arrayField['Bet_WinLost_Money']}) - 下注總金額({$LIST_Bet['Bet_AllMoney']})";	}
				$arrayField['Bet_On'] = 1 ;						// 會員權限 1||已開獎:
			}
			else
			{// 1-5星開獎
				$array_GamePara = WinHappy_getGamePara() ;		// 取得遊戲相關參數
				//$array_GamePara['odd_3_0']		5星中5賠率 n-2
				//$array_GamePara['odd_7_3']		5星中5賠率 n-2
				//$array_GamePara['OddCount0']		超級大小賠率數目
				//$array_GamePara["Pair_3_0"][1]	中幾星賠率設定

				// 配對成功奬號
				$array_Match_Number = WinHappy_Match_Number( $array_NowBingo['Bingo_Num'] , $LIST_Bet['Bet_Ball_List']) ;
				//$array_Match_Number['Num']		下注星彩選中號碼數字
				//$array_Match_Number['Mark']		標注配封成功獎號
				//$array_Match_Number['Match']		配對成功獎號

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{
					echo "開獎號碼 :{$array_NowBingo['Bingo_Num']}<br>" ;
					echo "下注球號(紅色號為選中號) :{$array_Match_Number['Mark']}<br>" ;
					echo "<p>選中號數 :{$array_Match_Number['Num']}</p>" ;
					echo "<p>中幾星賠率設定(星數=>賠率)</p>" ;print_r($array_GamePara["Pair_".$LIST_Bet['Bet_Type']]);echo "<br>" ;
				}
				
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "輸贏總金額({$arrayField['Bet_WinLost_AllMoney']}) = 輸贏金額({$arrayField['Bet_WinLost_Money']}) - 下注總金額({$LIST_Bet['Bet_AllMoney']})";	}

				// 投注總金額
				$tmp_SingleAamount = $LIST_Bet['Bet_Money'] ;	// 單注金額
				//$tmp_BetAllMoney = $LIST_Bet['Bet_AllMoney'] ;	// 投注總金額
				$tmp_subWinLostMoney = 0 ;		// 暫時輸贏金額
				$tmp_WinLost_Money = 0 ;	// 輸贏金額
				$tmp_WinLost_AllMoney = 0 ;	// 輸贏總金額

				// 是否有 下注星彩選中號碼數字
				if( $array_Match_Number['Num'] > 0 )
				{
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p>有 下注星彩選中號碼數字 {$array_Match_Number['Num']}</p>" ;	}
					// 產生下注球號陣列
					$array_CombArray = str2array($LIST_Bet['Bet_Ball_List'] , ",");

					// 把陣列補0
					$array_CombArray = WinHappy_BingoNumAddFix0( $array_CombArray ) ;		// 把Bingo小於10的值補0

					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p>產生下注球號陣列-array_CombArray</p>" ;print_r($array_CombArray);echo "<br>" ;	}

					// (單注金額 * 中星注數 * 賠率) - 投注總金額

					// $array_GamePara["Pair_".$LIST_Bet['Bet_Type']][$tmp_Star_Num]
					$subCombSelectNum = $tmp_Star_Num ;
					// 取得無重複的排列組合資料
					$array_Comb = WinHappy_getCombinationToString( $array_CombArray , $subCombSelectNum ) ;

					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p>無重複的排列組合資料-array_Comb</p>" ;print_r($array_Comb);echo "<br>" ;	}
					
					// 設定中獎號陣列
					$array_MatchKey = str2array($array_Match_Number['Match'] , ",");
					// 把陣列補0
					$array_MatchKey = WinHappy_BingoNumAddFix0( $array_MatchKey ) ;		// 把Bingo小於10的值補0

					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p>設定中獎號陣列-array_MatchKey</p>" ;print_r($array_MatchKey);echo "<br>" ;	}

					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p>比對中幾星</p>";	}
					// 設定 7(-2)-5 6(-2),4
					// OddCount3-OddCount7
					//$array_GamePara['OddCount3'] = 1 ;			// 1星賠率數目1( , )
					//$array_GamePara['OddCount4'] = 2 ;			// 2星賠率數目1,2( , )
					//$array_GamePara['OddCount5'] = 2 ;			// 3星賠率數目2,3( , )
					//$array_GamePara['OddCount6'] = 3 ;			// 4星賠率數目2,3,4( , )
					//$array_GamePara['OddCount7'] = 3 ;			// 5星賠率數目3,4,5( , )
					//echo "<h2>進行 {$tmp_Star_Num}星 派彩</h2>" ;
					//echo "<p>取出下注種類的第一個字3-7({$LIST_Bet['Bet_Type']}) : <b>$tmp_First_Type</b> , 派彩星號為 : {$tmp_Star_Num}</p>" ;
//					unset($array_MatchCount);
//					echo "<p>新找出中星數筆數</p>" ;
//					echo "選中數目 : {$array_Match_Number['Num']} , $tmp_Star_Num 星 - 星賠率數目 : " . $array_GamePara["OddCount$tmp_First_Type"] . " <br>" ;
//					$tmp_Index = 0 ;
//					for( $i = $tmp_Star_Num - $array_GamePara["OddCount$tmp_First_Type"] +1 ; $i <= $tmp_Star_Num ; $i++ )
//					{
//						//echo "$i<br>" ;
//						if( $array_Match_Number['Num'] >= $i )
//						{// 求出中注數目
//							$array_Comb = WinHappy_getCombinationToString( $array_MatchKey , $i ) ;
//							$array_MatchCount[$i] = count($array_Comb); ;
//						}
//						else// 沒有中
//						{	$array_MatchCount[$i] = 0 ;	}
//						
//						$tmp_Index++ ;
//						if( $tmp_Index > 10)break;
//					}



					unset($array_MatchValue);
					unset($array_MatchCount);
					
					// 比對中幾星-取得無重複的排列組合資料
					for( $i = 0 ; $i < sizeof($array_Comb) ; $i++ )
					{
						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<b>$i - {$array_Comb[$i]}</b> - ";	}
						
						for( $j = 0 ; $j < sizeof($array_MatchKey) ; $j++ )
						{
							if (preg_match("/$array_MatchKey[$j]/i", $array_Comb[$i]))
							//if ( (int)$array_MatchKey[$j] == (int)$array_Comb[$i] )
							{// 找到值,數值+1
								$array_MatchValue[$i]++ ;
								
								if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
								{	echo " {$array_MatchKey[$j]} <span style='color:#f00;'>Yes</span> " ;	}
							}
							else
							{
								if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
								{	echo " {$array_MatchKey[$j]} <span style='color:#00f;'>No</span> " ;	}
							}
						}
						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<br>" ;	}
					}// END for
					
					// 找出中星數筆數
					foreach( $array_MatchValue as $key2 => $value2 )
					{	$array_MatchCount[$value2]++;	}
					
					ksort($array_MatchCount);
					echo "<p>找出中星數筆數</p>" ;print_r($array_MatchCount);echo "<br>" ;

					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{
						echo '<p>無重複排列組合</p>';
						echo '<pre>';
						echo "本下注中獎號碼陣列<br>" ;
						print_r($array_MatchKey);
						
						echo "本星數所有排列資料<br>" ;
						print_r($array_Comb);

						echo "排列資料中星數陣列<br>" ;
						print_r($array_MatchValue);
						
						echo "中星注數陣列-array_MatchCount[1]=2<br>" ;
						print_r($array_MatchCount);
						echo '</pre>';
					}
					
					// 依賠率來計算"輸贏金額"
					foreach( $array_GamePara["Pair_".$LIST_Bet['Bet_Type']] as $keyPair => $valuePair )
					{
						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<h2>是否有人中五星投注 , 目前中 $keyPair 星</h2>" ;	}

						// 是否有人中5星
						if( $keyPair == 5 AND $array_MatchCount[$keyPair] > 0 )
						{// 值為5星,且有人中,發五星彩獎金
							// 初始彩金得獎所在範圍(No表示因為投注金額太低,沒有得到獎金)
							$tmp_5Start_NowRang = "No";
							// $array_5Start_Way[50] = 10;
							// 計算投注金額所在範圍
							foreach( $array_5Start_Way as $key => $value )
							{
								echo "\$key($key) => $value , {$LIST_Bet['Bet_Money']}<br>" ;
								if( $key > $LIST_Bet['Bet_Money'] )
								{	break;	}
								else// 設定彩金得獎所在範圍
								{	$tmp_5Start_NowRang = $key;	}
							}

							if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
							{	echo "<p>計算五星投注金額所在範圍 : $tmp_5Start_NowRang</p>" ;	}
							
							if( $tmp_5Start_NowRang != "No" )
							{
								// 中幾注建立幾次
								for( $i = 0 ; $i < $array_MatchCount[$keyPair] ; $i++ )
								{
									$array_WinLost_5Start_ID[$tmp_5Start_NowRang][] = $LIST_Bet['Bet_Member_ID'] ;
									$array_WinLost_5Start_Count[$tmp_5Start_NowRang]++ ;
								}

							}
							$tmp_5Start_Index++ ;
							
						}
						
						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "中{$keyPair}星 , 賠率 : $valuePair , 筆數 : " . (int)$array_MatchCount[$keyPair] . " , 單筆下注金額 :  $tmp_SingleAamount<br>";	}

						//$tmp_Key = $tmp_Star_Num + 2 ;
						// 計算輸贏金額 = 賠率 * 數量 * 單注金額
						$tmp_subWinLostMoney = $valuePair * $array_MatchCount[$keyPair] * $tmp_SingleAamount ;

						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<p>公式 : 暫時輸贏金額($tmp_subWinLostMoney) = $valuePair * " . (int)$array_MatchCount[$keyPair] . " * $tmp_SingleAamount </p>" ;	}

						// 星號中獎訊息
						//$tmp_Bet_Start_Winning_Content .= "進行 {$tmp_Star_Num}星 派彩\n" ;
						$tmp_Bet_Start_Winning_Content .= "中{$keyPair}星 , 賠率 : $valuePair, 筆數 : " . (int)$array_MatchCount[$keyPair] . " , 輸贏金額 : $tmp_subWinLostMoney \n" ;
						$sum_Bet_Start_Winning_Content += $tmp_subWinLostMoney ;

						$tmp_WinLost_Money += $tmp_subWinLostMoney ;
					}
					$arrayField['Bet_Winning_Type'] = $Array_Bet_Type[$LIST_Bet['Bet_Type']]."(中{$array_Match_Number['Num']})" ;	// 中獎類別 5星(中3)
					$tmp_Bet_Start_Winning_Content .= "<strong>小計 : " . $sum_Bet_Start_Winning_Content . "</strong>" ;
				}
				else
				{
					echo "沒有下注星彩選中號碼數字" ;
					$tmp_subWinLostMoney = 0 ;
				}
				// END 是否有 下注星彩選中號碼數字

				// 設定開獎資訊
				$arrayField['Bet_WinLost_Money'] = $tmp_WinLost_Money;		// 輸贏金額
				// 輸贏總金額 = 輸贏金額 + 下注總金額
				$arrayField['Bet_WinLost_AllMoney'] = $arrayField['Bet_WinLost_Money'] - $LIST_Bet['Bet_AllMoney'];

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "輸贏總金額({$arrayField['Bet_WinLost_AllMoney']}) = 輸贏金額({$arrayField['Bet_WinLost_Money']}) - 下注總金額({$LIST_Bet['Bet_AllMoney']})";	}
				//$arrayField['Bet_WinLost_AllMoney'] = $tmp_WinLost_AllMoney ;			// 輸贏金額

				$arrayField['Bet_On'] = 1 ;						// 會員權限 1||已開獎:
			}// 1-5星開獎
			//~@_@~// END 開獎設定 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			
			if( $arrayField['Bet_On'] == 1 )
			{// 開奬成功
				// 設定開獎資料
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>設定開獎資料</p>" ;	}
	
				// 計算"上線返水比","上線返水金額","上線占成比","上線占成金額","上線id"
				//$array_AgentList["N"]	名稱
				//$array_AgentList["S"]	分成比
				//$array_AgentList["W"]	返水比
				//$array_AgentList["I"]	id

				// 會員占成
				$arrayField['Bet_Member_Proportion'] = $array_AgentList["S"][sizeof($array_AgentList["S"])-1];
				// 會員返水比
				$arrayField['Bet_Member_Backwater_Ratio'] = $array_AgentList["W"][sizeof($array_AgentList["W"])-1];
				// 會員返水金額 = 投注金額 * 退水比例 / 100
				$arrayField['Bet_Member_Backwater_Money'] = $LIST_Bet['Bet_AllMoney'] * $arrayField['Bet_Member_Backwater_Ratio'] / 100 ;
				// 會員輸贏總金額 = 輸贏總金額 + 會員返水金額
				$arrayField['Bet_Member_WinLost_AllMoney'] = $arrayField['Bet_WinLost_AllMoney'] + $arrayField['Bet_Member_Backwater_Money'] ;
				// 會員報帳金額 = 會員輸贏總金額 * (100-占成)/100
				$arrayField['Bet_Member_Report_Money'] = $arrayField['Bet_Member_WinLost_AllMoney'] * (100-$arrayField['Bet_Member_Proportion']) / 100 ;

				$arrayField['Bet_Online_Backwater_Ratio'] = array2str($array_AgentList["W"] , "," );	// 上線返水比
				$arrayField['Bet_Online_Share_Ratio'] = array2str($array_AgentList["S"] , "," );	// 上線占成比
				$arrayField['Bet_Online_id'] = "," . array2str($array_AgentList["I"] , "," ) . "," ;	// 上線id

				unset($array_WinLost_Money);
				unset($array_Backwater_Money);
				unset($array_AllMoney);
				unset($array_Reported_Money);

				foreach( $array_AgentList["I"] as $key => $value )
				{
					echo "索引 : $key <br>" ;

					// 輸贏金額 = 輸贏金額 - 投注金額
					$array_WinLost_Money[$key] = $arrayField['Bet_WinLost_AllMoney'] ;

					// 返水金額 = 投注金額 * 會員返水比
					$array_Backwater_Money[$key] = $LIST_Bet['Bet_AllMoney'] * $array_AgentList["W"][$key] / 100 ;
					echo "<h1>返水金額 {$array_Backwater_Money[$key]} = 投注金額({$LIST_Bet['Bet_AllMoney']}) * 會員返水比(" . $array_AgentList["W"][$key] . ")</h1>" ;

					// 總金額 = 輸贏金額 + 返水金額
					$array_AllMoney[$key] = $array_WinLost_Money[$key] + $array_Backwater_Money[$key] ;
					echo "<h1>總金額 {$array_AllMoney[$key]} , 輸贏金額({$array_WinLost_Money[$key]}) + 返水金額({$array_Backwater_Money[$key]})</h1>" ;

					// 報帳金額 = 總金額 * ( 100 - 占成 )/100
					$array_Reported_Money[$key] = $array_AllMoney[$key] * ( 100 - $array_AgentList["S"][$key]) / 100;
					echo "<h1>報帳金額 {$array_Reported_Money[$key]} =  總金額($array_AllMoney[$key]) * ( 100 - {$array_AgentList['S'][$key]} ) / 100</h1>" ;
					echo "<br>" ;
				}
				
				$arrayField['Bet_Online_WinLost_Money'] = array2str($array_WinLost_Money , "," );		// 上線輸贏金額
				$arrayField['Bet_Online_Backwater_Money'] = array2str($array_Backwater_Money , "," );	// 上線返水金額
				$arrayField['Bet_Online_AllMoney'] = array2str($array_AllMoney , "," );					// 上線總金額
				$arrayField['Bet_Online_Reported_Money'] = array2str($array_Reported_Money , "," );		// 上線報帳金額

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{
					echo "<br>投注金額 : {$LIST_Bet['Bet_AllMoney']}<br>" ;

					echo "<p>上線返水比</p>" ;print_r($array_AgentList['W']);echo "<br><br>" ;
					echo "<p>上線返水金額</p>" ;print_r($array_Backwater_Money);echo "<br>" ;

					echo "<br>輸贏金額 :{$arrayField['Bet_WinLost_AllMoney']}<br>" ;
					
					echo "<p>上線輸贏金額</p>" ;print_r($array_WinLost_Money);echo "<br>" ;

					echo "<p>上線分成比</p>" ;print_r($array_AgentList['S']);echo "<br><br>" ;
					echo "<p>上線報帳金額</p>" ;print_r($array_Reported_Money);echo "<br>" ;
//						echo "<br>上線返水金額 : {$arrayField['Bet_Online_Backwater_Money']}<br>" ;
//						echo "上線輸贏金額 : {$arrayField['Bet_Online_WinLost_Money']}<br>" ;
//						echo "上線報帳金額 : {$arrayField['Bet_Online_Reported_Money']}<br>" ;
				}

				// 依"下線分成比"和"遊戲下線id"來計算每層的代理應負責的金額
				$arrayField['Bet_Draw_DT'] = date("Y-m-d H:i:s") ;						// 開獎日期
				// 輸贏金額
				//$arrayField['Bet_WinLost_AllMoney'] = $arrayField['Bet_WinLost_Money'] - $LIST_Bet['Bet_Money'] ;
				// Log
				$tmp_Bet_Log = "計算公式 : 輸贏金額({$arrayField['Bet_WinLost_AllMoney']}) = 贏得金額({$LIST_Bet['Bet_Money']} * {$LIST_Bet['Bet_Odds']}) - 投注金額({$LIST_Bet['Bet_Money']})" ;
				$arrayField['Bet_Log'] = $tmp_Bet_Log ;			// Log

				// 星號中獎訊息
				$arrayField['Bet_Start_Winning_Content'] = $tmp_Bet_Start_Winning_Content ;			// Log

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>開獎資訊</p><pre>" ;print_r($arrayField);echo "</pre><br>" ;	}

				// 暫時關閉功能
				if( $_GET["MODDB"] == 1 OR 1)
				{
					// 修改派彩資訊
					$Bol = func_DatabaseBase( "Bet" , "MOD" , $arrayField , " id_Bet = '{$LIST_Bet['id_Bet']}'" ) ;						// 資料庫處理
					if( $Bol )
					{
						// 設定備援系統資料
						//unset($arrayField['Bet_Content']);
						$arrayData = $arrayField ;
						$arrayData['TableName'] = "Bet" ;					// 表格名稱
						$arrayData['ActionName'] = "MOD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
						$arrayData['WhereField'] = "Bet_ID" ;			// 操作判斷式欄位名稱(新增-判斷是否有重複)(Member_ID),不可以用id,因為兩台主機資料庫可能不同
						$arrayData['WhereKey'] = $LIST_Bet['Bet_ID'] ;		// 操作判斷式關鍵字(新增-判斷是否有重複)(Member202007010001),不可以用id,因為兩台主機資料庫可能不同
						WinHappy_setBackupInfo( array2json($arrayData) , "" , "" ) ;

						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<p>修改派彩資訊-成功</p>" ;	}
						// 是否有贏錢
						if( $arrayField['Bet_Winning_Type'] )
						{
							// 取得會員資料
							$array_MemberAdd_Info = WinHappy_getMemberInfo( $LIST_Bet['Bet_Member_ID'] ) ;		// 取得會員資料
							if( $arrayField['Bet_WinLost_Money'] )
							{
								// 加會員點數
								$tmpSQL_Money = "UPDATE Member SET Member_Money = Member_Money + {$arrayField['Bet_WinLost_Money']} WHERE Member_ID = '{$LIST_Bet['Bet_Member_ID']}'" ;	// 欄位值+1
								
								if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
								{	echo "<h1>加會員點數 : $tmpSQL_Money</h1>" ;	}
								
								$Bol_Money = func_DatabaseBase( $tmpSQL_Money , "SQL" , "" , "" ) ;									// 資料庫處理
								if ( $Bol_Money )
								{// 會員點數扣除成功
									if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
									{	echo "<h1>扣會員點數-成功</h1>" ;	}
									// 加入金額Log
									$arrayField_MoneyLog['MoneyLog_Set_ID'] = $LIST_Bet['Bet_Member_ID'] ;			// 設定者ID
									$arrayField_MoneyLog['MoneyLog_Class'] = 1 ;									// 操作分類#::SELECT:2||1||會員||2||代理人::
									$arrayField_MoneyLog['MoneyLog_Type'] = 2 ;									// 操作動作#::SELECT:2||0||其它||1||遊戲投注||2||遊戲派彩||3||存入||4||提出||5||莊家派彩||6||五星彩獎金||7||總彩金獎金:
									$arrayField_MoneyLog['MoneyLog_Bet_ID'] = $LIST_Bet['Bet_ID'] ;			// 下注訂單號
									$arrayField_MoneyLog['MoneyLog_Money'] = $arrayField['Bet_WinLost_Money'] ;		// 操作金額
									$arrayField_MoneyLog['MoneyLog_Original_Money'] = $array_MemberAdd_Info['Member_Money'] ;	// 操作前金額
									$arrayField_MoneyLog['MoneyLog_Operator_IP'] = "" ;		// 操作者IP
									$arrayField_MoneyLog['MoneyLog_Operator_ID'] = ""	 ;	// 操作者ID
									$arrayField_MoneyLog['MoneyLog_Operator_Name'] = "系統排程" ;	// 操作者名稱
									$arrayField_MoneyLog['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;				// 操作時間
									
									$Bol_MoneyLog = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField_MoneyLog , "" ) ;						// 資料庫處理
								}
							}
						}
					}// END 是否有贏錢
				}// END 修改派彩資訊

				//echo "$Bol" ;
			}

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<hr>" ;	}
		}
		
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{
			echo "<p>五星彩中獎人ID</p>" ;print_r($array_WinLost_5Start_ID);echo "<br>" ;
			echo "<p>五星彩中獎人數</p>" ;print_r($array_WinLost_5Start_Count);echo "<br>" ;
		}

		// 是否有人中五星彩-依五星彩得彩方式來分類
		if( sizeof($array_WinLost_5Start_Count) )
		{
			// 求出目前獎金池資料-$array_SystemSet['SystemSet_5Start_BonusPool']
			foreach( $array_WinLost_5Start_Count as $key => $value )
			{// $key(金額值) => $value(比例值)
				unset($array_Member_Win_Count);
				// 算出此區每個會員中注數
				foreach( $array_WinLost_5Start_ID[$key] as $key1 => $value1 )
				{
					$array_Member_Win_Count[$value1]++;
				}
				// 本方式的總彩金 = 獎金池金額 * 百分比 / 100
				$tmp_Total_Bonus = $array_SystemSet['SystemSet_5Start_BonusPool'] * $array_5Start_Way[$key] / 100 ;
				// 算出每份獎金的金額 =  總彩金 / 總個數" ;
				$tmp_Each_Bonus = $tmp_Total_Bonus / $value;
				$tmp_Each_Bonus = func_Digital_Carry( $tmp_Each_Bonus , 2 , "floor" );
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{
					echo "<p>範圍 : $key , 個數 : $value </p>" ;print_r($array_Member_Win_Count);echo "<br>" ;
					echo "算出每份獎金的金額($tmp_Each_Bonus) = 獎金池金額({$array_SystemSet['SystemSet_5Start_BonusPool']}) * 百分比({$array_5Start_Way[$key]}) / 100 / 個數($value)<br>" ;
				}
				
				// 送出獎金給會員
				foreach( $array_Member_Win_Count as $key => $value )
				{
					// 取得會員資料
					$array_Bonus_Member_Info = WinHappy_getMemberInfo( $key ) ;		// 取得會員資料

					// 計算會員可以得到的彩金
					$tmp_Member_Bonus = $tmp_Each_Bonus * $value ;
					// 發出總彩全
					$tmp_Sum_Bonus += $tmp_Member_Bonus ;
					
					// 設定會員獎金
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p>會員 : $key 得到獎金 $value 份 共 $tmp_Member_Bonus </p>" ;	}

					// 加入會員奬金
					$tmpSQL_Bonus = "UPDATE Member SET Member_Money = Member_Money + $tmp_Member_Bonus WHERE Member_ID = '$key'" ;				// 欄位值+1
					$Bol_Bonus = func_DatabaseBase( $tmpSQL_Bonus , "SQL" , "" , "" ) ;									// 資料庫處理
					if ( $Bol_Bonus )
					{
						unset($arrayField_Bonus);
						// 找出上線ID
						$array_AgentList_Bonus = WinHappy_getAgentList( $array_Bonus_Member_Info['Member_Father_ID'] , "A" , 2) ;		// 取得所有上線代理人資料
						$arrayField_Bonus['MoneyLog_Online_id'] = array2str($array_AgentList_Bonus['I'] , ",") ;			// 設定者ID
						// 加入金額Log
						$arrayField_Bonus['MoneyLog_Set_ID'] = $key."1" ;			// 設定者ID
						$arrayField_Bonus['MoneyLog_Class'] = 1 ;									// 操作分類#::SELECT:2||1||會員||2||代理人::
						$arrayField_Bonus['MoneyLog_Type'] = 6 ;									// 操作動作#::SELECT:2||0||其它||1||遊戲投注||2||遊戲派彩||3||存入||4||提出||5||莊家派彩||6||五星彩獎金||7||總彩金獎金:
						$arrayField_Bonus['MoneyLog_Bet_ID'] = "" ;			// 下注訂單號
						$arrayField_Bonus['MoneyLog_Money'] = $tmp_Member_Bonus ;		// 操作金額
						$arrayField_Bonus['MoneyLog_Original_Money'] = $array_Bonus_Member_Info['Member_Money'] ;	// 操作前金額
						$arrayField_Bonus['MoneyLog_Operator_IP'] = "" ;		// 操作者IP
						$arrayField_Bonus['MoneyLog_Operator_ID'] = ""	 ;	// 操作者ID
						$arrayField_Bonus['MoneyLog_Operator_Name'] = "系統排程" ;	// 操作者名稱
						$arrayField_Bonus['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;				// 操作時間
						
						$Bol_Bonus = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField_Bonus , "" ) ;						// 資料庫處理
						
					}
					else
					{	echo "資料執行失敗" ;	}

				}
			}
			// 扣除獎金池金額-$tmp_Sum_Bonus
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<p>發出總彩全 $tmp_Sum_Bonus </p>" ;	}

			// 扣除獎金池金額
			$tmpSQL_SystemSetBonus = "UPDATE SystemSet SET SystemSet_5Start_BonusPool = SystemSet_5Start_BonusPool - $tmp_Sum_Bonus WHERE id_SystemSet = '1'" ;				// 欄位值+1
			$Bol_SystemSetBonus = func_DatabaseBase( $tmpSQL_SystemSetBonus , "SQL" , "" , "" ) ;									// 資料庫處理
			if ( $Bol_SystemSetBonus )
			{
				unset($arrayField_Bonus);
				// 加入金額Log
				$arrayField_Bonus['MoneyLog_Set_ID'] = "" ;			// 設定者ID
				$arrayField_Bonus['MoneyLog_Class'] = 1 ;									// 操作分類#::SELECT:2||1||會員||2||代理人::
				$arrayField_Bonus['MoneyLog_Type'] = 6 ;									// 操作動作#::SELECT:2||0||其它||1||遊戲投注||2||遊戲派彩||3||存入||4||提出||5||莊家派彩||6||五星彩獎金||7||總彩金獎金:
				$arrayField_Bonus['MoneyLog_Bet_ID'] = "" ;			// 下注訂單號
				$arrayField_Bonus['MoneyLog_Money'] = $tmp_Sum_Bonus ;		// 操作金額
				$arrayField_Bonus['MoneyLog_Original_Money'] = $array_SystemSet['SystemSet_5Start_BonusPool'] ;	// 操作前金額
				$arrayField_Bonus['MoneyLog_Operator_IP'] = "" ;		// 操作者IP
				$arrayField_Bonus['MoneyLog_Operator_ID'] = ""	 ;	// 操作者ID
				$arrayField_Bonus['MoneyLog_Operator_Name'] = "系統排程" ;	// 操作者名稱
				$arrayField_Bonus['MoneyLog_Log'] = "扣除獎金池金額" ;	// 操作Log
				$arrayField_Bonus['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;				// 操作時間
				
				$Bol_Bonus = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField_Bonus , "" ) ;						// 資料庫處理
			}

		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_Bet);
	}
	else
	{
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "沒有找到需開獎的下注資料<br>" ;	}
	}

	//echo "<p>已讀取Bingo期數 : </p>" ;print_r($array_Bingo_Period);echo "<br>" ;
	//echo "<p>已讀取Bingo資料 : </p>" ;print_r($array_Bingo_Info);echo "<br>" ;

}
//~@_@~// END 賓果開獎 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 配對成功奬號 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_Match_Number( $sunBingoNum , $subBetBall )
{
	/*
	範例			: $tmp_Match_Number = WinHappy_Match_Number( $sunBingoNum , $subBetBall ) ;		// 配對成功奬號
	功能			: 配對成功奬號
	修改日期		: 20200524
	參數說明 :
		$sunBingoNum	Bingo開獎球數
		$subBetBall		下注球數
	回傳參數 :
		$array_Match_Number	配對成功奬號資訊
		$array_Match_Number['Num']		下注星彩選中號碼數字
		$array_Match_Number['Mark']		標注配封成功獎號
		$array_Match_Number['Match']	配對成功獎號
	使用範例 :
		$array_Match_Number = WinHappy_Match_Number( $sunBingoNum , $subBetBall ) ;		// 配對成功奬號
	*/
	$tmpShowMsg = 0 ;
	unset($array_Match_Number);

	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "開獎號碼 : $sunBingoNum<br>" ;	}
	
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "下注球數 : $subBetBall<br>" ;	}

	// 開獎號碼轉陣列
	$array_Bingo_Num = str2array($sunBingoNum, ",");
	// 下注球號轉陣列
	$array_Bet_Ball_List = str2array($subBetBall, ",");
	$array_Match_Start_Num = 0 ;	// 配對中星數

	// 比對中幾星
	$array_Mark = array();
	foreach( $array_Bet_Ball_List as $key => $value )
	{
		// 是否有配對成功
		if(in_array(func_addFix0( $value , 2 ),$array_Bingo_Num, TRUE))
		{
			$array_Match_Start_Num++ ;	// 中幾星+1
			$array_Mark[$key] = "<span class='WinHappy_Match_Num'>$value</span>" ;	// 標注配封成功獎號
			$array_Match[] = $value ;	// 配對成功獎號
		}
		else// 配封失敗獎號
		{	$array_Mark[$key] = "$value" ;	}
		
	}
	// 回傳資料
	$array_Match_Number['Num'] = $array_Match_Start_Num ;
	$array_Match_Number['Mark'] = array2str($array_Mark , ",") ;
	$array_Match_Number['Match'] = array2str($array_Match , ",") ;
	return $array_Match_Number ;
}
//~@_@~// END 配對成功奬號 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
////~@_@~// START 計算財神九仔生計算值和倍數值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//function WinHappy_sumCalculate_Multiple( $subBingo_Draw_Order_Num )
//{
//	/*
//	範例			: $array_Calculate_Multiple = WinHappy_sumCalculate_Multiple( $sunBingo_Draw_Order_Num ) ;		// 計算財神九仔生計算值和倍數值
//	功能			: 計算財神九仔生計算值和倍數值
//	修改日期		: 20200608
//	參數說明 :
//		$subBingo_Draw_Order_Num		開獎順序號碼
//	回傳參數 :
//		$array_Calculate_Multiple					財神九仔生計算值和倍數值
//		$array_Calculate_Multiple['Calculate']		計算值
//		$array_Calculate_Multiple['Multiple']		倍數值
//	使用範例 :
//		$array_Calculate_Multiple = WinHappy_sumCalculate_Multiple( $subBingo_Draw_Order_Num ) ;		// 計算財神九仔生計算值和倍數值
//	*/
//	$tmpShowMsg = 0 ;
//
//	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
//	$array_Bingo_Draw_Order_Num = str2array( $subBingo_Draw_Order_Num , "," );
//	foreach( $array_Bingo_Draw_Order_Num as $key => $value )
//	{
//		// 求出10位數
//		$tmp10 = mb_substr( $value , 0 , 1 , "utf-8") ;
//		// 求出個位數
//		$tmp1 = mb_substr( $value , 1 , 1 , "utf-8") ;
//
//		$array_Calculate[$key] = ($tmp10 + $tmp1) % 10 ;
//		if( $tmp10 == $tmp1 )
//		{// 是否為配對
//			$tmp_Multiple = 3 ;
//			$array_Calculate[$key] = 10 ;// 設定為配對(10)
//		}
//		else if( $array_Calculate[$key] == 0 )// 0
//		{	$tmp_Multiple = 0 ;	}
//		else if( $array_Calculate[$key] <= 7 )// 1-7
//		{	$tmp_Multiple = 1 ;	}
//		else// 8,9
//		{	$tmp_Multiple = 2 ;	}
//		$array_Multiple[$key] = $tmp_Multiple ;
//	}
//	$array_Calculate_Multiple['Calculate'] = array2str($array_Calculate , ",") ;
//	$array_Calculate_Multiple['Multiple'] = array2str($array_Multiple , ",") ;
//	return $array_Calculate_Multiple ;
//
//}
////~@_@~// END 計算財神九仔生計算值和倍數值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 代理人相關
//~@_@~// START 取得代理人資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getAgentInfo( $tmp_Agent_ID )
{
	global $link;
	/*
	範例			: $array_AgentInfo = WinHappy_getAgentInfo( $tmp_Agent_ID ) ;		// 取得代理人資料
	功能			: 取得代理人資料
	修改日期		: 20200519
	參數說明 :
		$tmp_Agent_ID	代理人ID或id
	回傳參數 :
		$array_Agent_Info		代理人資料
	使用範例 :		:
		$array_Agent_Info = WinHappy_getAgentInfo( $tmp_Agent_ID ) ;		// 取得代理人資料
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	// 找出會員資料
	if( strlen($tmp_Agent_ID) == 15 )
	{	$array_Agent_Info = func_DatabaseGet( "Agent" , "*" , array("Agent_ID"=>$tmp_Agent_ID) ) ;	}
	else
	{	$array_Agent_Info = func_DatabaseGet( "Agent" , "*" , array("id_Agent"=>$tmp_Agent_ID) ) ;	}

	return $array_Agent_Info ;
}
//~@_@~// END 取得代理人資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得所有上線代理人資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getAgentList( $tmp_Agent_ID , $subType = "A" , $subBet_Type_First = 0 )
{
	global $link;
	/*
	範例			: $array_AgentList = WinHappy_getAgentList( $tmp_Agent_ID , $subType , $subBet_Type_First ) ;		// 取得所有上線代理人資料
	功能			: 取得所有上線代理人資料
	修改日期		: 20200728
	參數說明 :
		$tmp_Agent_ID		起頭代理人ID或id
		$subType				回傳資料類別(A:全部,N:名稱,S:分成比,I:id,O:權限,AI:代理人ID) 例:全部回傳-A,部分回傳S,I
		$subBet_Type_First	下注種類開頭編號-3||一星||4||二星||5||三星||6||四星||7||五星||0||超級大小||1||超級單雙||2||猜大小
	回傳參數 :
		$array_AgentList		所有上線代理人資料
		$array_AgentList["N"]	名稱
		$array_AgentList["S"]	分成比
		$array_AgentList["W"]	返水比
		$array_AgentList["I"]	id
		$array_AgentList["O"]	權限
		$array_AgentList["AI"]	代理人ID
	使用範例 :		:
		$array_AgentList = WinHappy_getAgentList( $_SESSION['AID'] , "A,N,S,I,O,W,AI" , "") ;		// 取得所有上線代理人資料
		// N : 名稱 , S : 分成比 , W : 返水比 , I : id  , O : 權限 , AI : 代理人ID
		$tmp_AgentList = array2str($array_AgentListN , " > ");

	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// 設定要參考的欄位名稱-
	if( $subBet_Type_First <= 1 )//0||超級大小||1||超級單雙
	{	$tmp_BackWater_Field = "BackWater_Bingo_Super" ;	}
	else if( $subBet_Type_First <= 6 )//2||猜大小||3||一星||4||二星||5||三星||6||四星||
	{	$tmp_BackWater_Field = "BackWater_Bingo_Gen_12Start" ;	}
	else if( $subBet_Type_First == 7 )//7||五星
	{	$tmp_BackWater_Field = "BackWater_Bingo_5Start" ;	}		// 新版
	//{	$tmp_BackWater_Field = "BackWater_Bingo_Gen_12Start" ;	}	// 舊版
	
	$tmp_Index = 0 ;
	$array_AgentListN = array();
	$array_AgentListS = array();
	$array_AgentListI = array();
	$array_AgentListO = array();
	$array_AgentListW = array();
	$array_AgentListAI = array();
	$tmp_Offline_Agent_Share = 0 ;	// 下層占成
	$tmp_Offline_Agent_BackWater = 0 ;	// 下層返水
	while(1)
	{
		unset($array_Agent_Info);
		// 找出會員資料
		if( strlen($tmp_Agent_ID) == 15 )
		{	$array_Agent_Info = func_DatabaseGet( "Agent" , "*" , array("Agent_ID"=>$tmp_Agent_ID) ) ;	}
		else
		{	$array_Agent_Info = func_DatabaseGet( "Agent" , "*" , array("id_Agent"=>$tmp_Agent_ID) ) ;	}

		// 是否要回傳名稱
		if ( $subType == "A" OR preg_match("/N/i",$subType) )
		{	$array_AgentListN[] = $array_Agent_Info['Agent_Name'] ;	}

		// 是否要回傳分成比
		if ( $subType == "A" OR preg_match("/S/i",$subType) )
		{
			// 自己該負責的占成 = 本身占成 - 下層占成
			$array_AgentListS[] = $array_Agent_Info['Agent_Share'] ;
			//$array_AgentListS[] = $array_Agent_Info['Agent_Share'] - $tmp_Offline_Agent_Share ;
			//$tmp_Offline_Agent_Share = $array_Agent_Info['Agent_Share'] ;
		}

		// 是否要回傳分成比
		if ( $subType == "A" OR preg_match("/W/i",$subType) )
		{
			unset($array_BackWater_Info);
			// 取得代理人的退水設定
			$array_BackWater_Info = func_DatabaseGet( "BackWater" , "*" , array("BackWater_Set_ID"=>$array_Agent_Info['Agent_ID']) ) ;		// 取得資料庫資料

			//echo "$tmp_BackWater_Field : $array_BackWater_Info[$tmp_BackWater_Field] - $tmp_Offline_Agent_BackWater<br>" ;
			// 自己該負責的占成 = 本身占成 - 下層占成
			$array_AgentListW[] = $array_BackWater_Info[$tmp_BackWater_Field] ;
			//$array_AgentListW[] = $array_BackWater_Info[$tmp_BackWater_Field] - $tmp_Offline_Agent_BackWater ;
			//$tmp_Offline_Agent_BackWater = $array_BackWater_Info[$tmp_BackWater_Field] ;
		}

		// 是否要回傳id
		if ( $subType == "A" OR preg_match("/I/i",$subType) )
		{	$array_AgentListI[] = $array_Agent_Info['id_Agent'] ;	}

		// 是否要回傳權限
		if ( $subType == "A" OR preg_match("/O/i",$subType) )
		{	$array_AgentListO[] = $array_Agent_Info['Agent_On'] ;	}

		// 是否要回傳
		if ( $subType == "A" OR preg_match("/AI/i",$subType) )
		{	$array_AgentListAI[] = $array_Agent_Info['Agent_ID'] ;	}

		if( empty($array_Agent_Info['Agent_Father_ID']) )	// 如果沒有父ID則結束
		{	break;	}
		else// 設定父ID
		{	$tmp_Agent_ID = $array_Agent_Info['Agent_Father_ID'] ;	}
		
		$tmp_Index++ ;
		if( $tmp_Index > 20 )
		{	break;	}
	}

	// 資料反轉
	$array_AgentList["N"] = array_reverse($array_AgentListN) ;
	$array_AgentList["S"] = array_reverse($array_AgentListS) ;
	$array_AgentList["I"] = array_reverse($array_AgentListI) ;
	$array_AgentList["O"] = array_reverse($array_AgentListO) ;
	$array_AgentList["W"] = array_reverse($array_AgentListW) ;
	$array_AgentList["AI"] = array_reverse($array_AgentListAI) ;
	return $array_AgentList ;
	
}
//~@_@~// END 取得所有上線代理人資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 會員相關
//~@_@~// START 取得會員資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getMemberInfo( $tmp_Member_ID )
{
	global $link;
	/*
	範例			: $array_AgentInfo = WinHappy_getMemberInfo( $tmp_Member_ID ) ;		// 取得會員資料
	功能			: 取得會員資料
	修改日期		: 20200519
	參數說明 :
		$tmp_Member_ID	會員ID或id
	回傳參數 :
		$array_Member_Info		取得會員資料
	使用範例 :		:
		$array_Member_Info = WinHappy_getMemberInfo( $tmp_Member_ID ) ;		// 取得會員資料
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	// 找出會員資料
	if( strlen($tmp_Member_ID) == 16 )
	{	$array_Member_Info = func_DatabaseGet( "Member" , "*" , array("Member_ID"=>$tmp_Member_ID) ) ;	}
	else
	{	$array_Member_Info = func_DatabaseGet( "Member" , "*" , array("id_Member"=>$tmp_Member_ID) ) ;	}

	return $array_Member_Info ;
}
//~@_@~// END 取得代理人資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得會員下注限額資訊 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getMemberBetLimitInfo( $tmp_Member_ID )
{
	global $link;
	/*
	範例			: $array_MemberBetLimitInfo = WinHappy_getMemberBetLimitInfo( $tmp_Member_ID ) ;		// 取得會員下注限額資訊
	功能			: 取得會員資料
	修改日期		: 20200729
	參數說明 :
		$tmp_Member_ID	會員ID
	回傳參數 :
		$array_MemberBetLimitInfo		取得會員下注限額資訊
	使用範例 :		:
		$array_MemberBetLimitInfo = WinHappy_getMemberBetLimitInfo( $_SESSION['Member_ID'] ) ;		// 取得會員下注限額資訊
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	if( empty($tmp_Member_ID))
	{	$tmp_Member_ID = $_SESSION['Member_ID'];	}
	
	$array_BetLimit = func_DatabaseGet( "BetLimit" , "*" , array("BetLimit_Set_ID"=>"$tmp_Member_ID") ) ;		// 取得資料庫資料

	// 下限
	$array_MemberBetLimitInfo['0_0']['Low'] = $array_BetLimit["BetLimit_Super_BigSmall_Low"] ;		// 超級號碼大小-下限
	$array_MemberBetLimitInfo['0_1']['Low'] = $array_BetLimit["BetLimit_Super_BigSmall_Low"];		// 超級號碼大小-下限
	$array_MemberBetLimitInfo['1_0']['Low'] = $array_BetLimit["BetLimit_Super_SingleDouble_Low"];	// 超級號碼單雙-下限
	$array_MemberBetLimitInfo['1_1']['Low'] = $array_BetLimit["BetLimit_Super_SingleDouble_Low"];	// 超級號碼單雙-下限
	$array_MemberBetLimitInfo['2_0']['Low'] = $array_BetLimit["BetLimit_BigSmall_Low"];				// 猜大小-下限
	$array_MemberBetLimitInfo['2_1']['Low'] = $array_BetLimit["BetLimit_BigSmall_Low"];				// 猜大小-下限
	$array_MemberBetLimitInfo['3_0']['Low'] = $array_BetLimit["BetLimit_1Start_Low"];				// 1星-下限
	$array_MemberBetLimitInfo['4_0']['Low'] = $array_BetLimit["BetLimit_2Start_Low"];				// 2星-下限
	$array_MemberBetLimitInfo['5_0']['Low'] = $array_BetLimit["BetLimit_3Start_Low"];				// 3星-下限
	$array_MemberBetLimitInfo['6_0']['Low'] = $array_BetLimit["BetLimit_4Start_Low"];				// 4星-下限
	$array_MemberBetLimitInfo['7_0']['Low'] = $array_BetLimit["BetLimit_5Start_Low"];				// 5星-下限

	// 上限
	$array_MemberBetLimitInfo['0_0']['Up'] = $array_BetLimit["BetLimit_Super_BigSmall"] ;		// 超級號碼大小-上限
	$array_MemberBetLimitInfo['0_1']['Up'] = $array_BetLimit["BetLimit_Super_BigSmall"];		// 超級號碼大小-上限
	$array_MemberBetLimitInfo['1_0']['Up'] = $array_BetLimit["BetLimit_Super_SingleDouble"];	// 超級號碼單雙-上限
	$array_MemberBetLimitInfo['1_1']['Up'] = $array_BetLimit["BetLimit_Super_SingleDouble"];	// 超級號碼單雙-上限
	$array_MemberBetLimitInfo['2_0']['Up'] = $array_BetLimit["BetLimit_BigSmall"];				// 猜大小-上限
	$array_MemberBetLimitInfo['2_1']['Up'] = $array_BetLimit["BetLimit_BigSmall"];				// 猜大小-上限
	$array_MemberBetLimitInfo['3_0']['Up'] = $array_BetLimit["BetLimit_1Start"];				// 1星-上限
	$array_MemberBetLimitInfo['4_0']['Up'] = $array_BetLimit["BetLimit_2Start"];				// 2星-上限
	$array_MemberBetLimitInfo['5_0']['Up'] = $array_BetLimit["BetLimit_3Start"];				// 3星-上限
	$array_MemberBetLimitInfo['6_0']['Up'] = $array_BetLimit["BetLimit_4Start"];				// 4星-上限
	$array_MemberBetLimitInfo['7_0']['Up'] = $array_BetLimit["BetLimit_5Start"];				// 5星-上限

	// 單邊
	$array_MemberBetLimitInfo['0_0']['Side'] = $array_BetLimit["BetLimit_Super_BigSmall_Side"] ;	// 超級號碼大小-單邊
	$array_MemberBetLimitInfo['0_1']['Side'] = $array_BetLimit["BetLimit_Super_BigSmall_Side"];		// 超級號碼大小-單邊
	$array_MemberBetLimitInfo['1_0']['Side'] = $array_BetLimit["BetLimit_Super_SingleDouble_Side"];	// 超級號碼單雙-單邊
	$array_MemberBetLimitInfo['1_1']['Side'] = $array_BetLimit["BetLimit_Super_SingleDouble_Side"];	// 超級號碼單雙-單邊
	$array_MemberBetLimitInfo['2_0']['Side'] = $array_BetLimit["BetLimit_BigSmall_Side"];			// 猜大小-單邊
	$array_MemberBetLimitInfo['2_1']['Side'] = $array_BetLimit["BetLimit_BigSmall_Side"];			// 猜大小-單邊
	//$array_MemberBetLimitInfo['3_0']['Side'] = $array_BetLimit["BetLimit_1Start_Side"];				// 1星-單邊
	//$array_MemberBetLimitInfo['4_0']['Side'] = $array_BetLimit["BetLimit_2Start_Side"];				// 2星-單邊
	//$array_MemberBetLimitInfo['5_0']['Side'] = $array_BetLimit["BetLimit_3Start_Side"];				// 3星-單邊
	//$array_MemberBetLimitInfo['6_0']['Side'] = $array_BetLimit["BetLimit_4Start_Side"];				// 4星-單邊
	//$array_MemberBetLimitInfo['7_0']['Side'] = $array_BetLimit["BetLimit_5Start_Side"];				// 5星-單邊

	// 狀態
	$array_MemberBetLimitInfo['0_0']['On'] = $array_BetLimit["BetLimit_Super_BigSmall_On"] ;	// 超級號碼大小-狀態
	$array_MemberBetLimitInfo['0_1']['On'] = $array_BetLimit["BetLimit_Super_BigSmall_On"];		// 超級號碼大小-狀態
	$array_MemberBetLimitInfo['1_0']['On'] = $array_BetLimit["BetLimit_Super_SingleDouble_On"];	// 超級號碼單雙-狀態
	$array_MemberBetLimitInfo['1_1']['On'] = $array_BetLimit["BetLimit_Super_SingleDouble_On"];	// 超級號碼單雙-狀態
	$array_MemberBetLimitInfo['2_0']['On'] = $array_BetLimit["BetLimit_BigSmall_On"];			// 猜大小-狀態
	$array_MemberBetLimitInfo['2_1']['On'] = $array_BetLimit["BetLimit_BigSmall_On"];			// 猜大小-狀態
	$array_MemberBetLimitInfo['3_0']['On'] = $array_BetLimit["BetLimit_1Start_On"];				// 1星-狀態
	$array_MemberBetLimitInfo['4_0']['On'] = $array_BetLimit["BetLimit_2Start_On"];				// 2星-狀態
	$array_MemberBetLimitInfo['5_0']['On'] = $array_BetLimit["BetLimit_3Start_On"];				// 3星-狀態
	$array_MemberBetLimitInfo['6_0']['On'] = $array_BetLimit["BetLimit_4Start_On"];				// 4星-狀態
	$array_MemberBetLimitInfo['7_0']['On'] = $array_BetLimit["BetLimit_5Start_On"];				// 5星-狀態
	
	return $array_MemberBetLimitInfo ;
}
//~@_@~// END 取得會員下注限額資訊 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 統計報表
//~@_@~// START 取得下注相關金額 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getBetMoney( $subSQL , $subID = "" )
{
	global $link;
	global $ShowDebug ;
	global $AID;
	global $Report_Start_Date ;
	global $Report_End_Date ;
	global $Report_Start_Hour ;
	global $Report_End_Hour ;
	/*
	範例			: $array_BetMoney = WinHappy_getBetMoney( $subSQL , $subID ) ;		// 取得下注相關金額
	功能			: 取得下注相關金額
	修改日期		: 20200528
	參數說明 :
		$subSQL		查詢相關下注SQL
		$subID		比對id(沒有設表示為會員下注查詢)
	回傳參數 :
		$array_BetMoney['Super']			賓果(超)
		$array_BetMoney['Gen']				賓果(一)	
			$array_BetMoney['Super']['Bet_Money']					投注金額
			$array_BetMoney['Super']['Bet_WinLost_AllMoney']			輸贏金額
			$array_BetMoney['Super']['Bet_Online_Backwater_Money']	會員返水
			$array_BetMoney['Super']['Bet_Online_WinLost_Money']		總金額
			$array_BetMoney['Super']['Bet_Online_Reported_Money']	報帳金額
	使用範例 :
		$tmp_SQL_Bet = "SELECT * FROM Bet WHERE Bet_Online_id LIKE '%,{$LIST_Agent['id_Agent']},%' AND Bet_Add_DT >= '$Report_Start_Date 00:00:00' AND Bet_Add_DT <= '$Report_End_Date 23:59:59'" ;
		$array_BetMoney = WinHappy_getBetMoney( $tmp_SQL_Bet , $LIST_Agent['id_Agent'] ) ;		// 取得下注相關金額
	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	$array_BetMoney = array();
	$array_BetMoney['Bet_Num'] = 0 ;								// 有下注筆數
	$array_BetMoney['Super']['Bet_Money'] = 0 ;						// 投注金額
	$array_BetMoney['Super']['Bet_Online_WinLost_Money'] = 0 ;		// 總金額
	$array_BetMoney['Super']['Bet_Online_Backwater_Money'] = 0 ;	// 會員返水
	$array_BetMoney['Super']['Bet_Online_AllMoney'] = 0 ;			// 輸贏金額
	$array_BetMoney['Super']['Bet_Online_Reported_Money'] = 0 ;		// 報帳金額

	$array_BetMoney['Gen']['Bet_Money'] = 0 ;						// 投注金額
	$array_BetMoney['Gen']['Bet_Online_WinLost_Money'] = 0 ;		// 總金額
	$array_BetMoney['Gen']['Bet_Online_Backwater_Money'] = 0 ;		// 會員返水
	$array_BetMoney['Gen']['Bet_Online_AllMoney'] = 0 ;				// 輸贏金額
	$array_BetMoney['Gen']['Bet_Online_Reported_Money'] = 0 ;		// 報帳金額
	
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "是否有下注資料 : $subSQL" ;	}
	
	$QUERY = mysqli_query($link , $subSQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		if ( $tmpShowMsg OR $ShowDebug  )	// 秀出除錯訊息 ██████████
		{
			$tmp_URL = "?AID=$AID&Report_Start_Date=$Report_Start_Date&Report_End_Date=$Report_End_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Hour=$Report_End_Hour" ;
			echo "<hr><a href='$tmp_URL&ShowDebug=WM'>輸贏金額(WM)</a> , <a href='$tmp_URL&ShowDebug=BM'>返水(BM)</a> , <a href='$tmp_URL&ShowDebug=AM'>總金額(AM)</a> , <a href='$tmp_URL&ShowDebug=RM'>報帳金額(RM)</a><br>";
		}
		$array_BetMoney['Bet_Num'] = mysqli_num_rows($QUERY) ;						// 有下注筆數
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			// 輸贏金額
			unset($array_Bet_Online_WinLost_Money);
			// 會員返水
			unset($array_Bet_Online_Backwater_Money);
			// 總金額
			unset($array_Bet_Online_AllMoney);
			// 總金額
			unset($array_Bet_Online_AllMoney);
			
			if( $LIST['Bet_Type'] == '0_0' OR $LIST['Bet_Type'] == '0_1' OR $LIST['Bet_Type'] == '1_0' OR $LIST['Bet_Type'] == '1_1' )
			{	$tmp_Bet_Type = "賓果(超)" ;	}
			else
			{	$tmp_Bet_Type = "賓果(一)" ;	}

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "下注ID : {$LIST['Bet_ID']}<br>" ;	}

			// 取出第一個字
			$tmp_First_Type = mb_substr( $LIST['Bet_Type'] , 0 , 1 , "utf-8");

			if( $tmp_First_Type < 2 )
			{	$tmp_Type_Name = "Super" ;	}
			else
			{	$tmp_Type_Name = "Gen" ;	}
			
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "取出第一個字 : $tmp_First_Type , 欄位名稱 : $tmp_Type_Name<br>" ;	}

			if ( $subID )
			{// 代理人資料
				// 找出會員index
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "上線id : {$LIST['Bet_Online_id']}<br>" ;	}
				
				$tmp_Bet_Online_id = mb_substr( $LIST['Bet_Online_id'] , 1 , -1 , "utf-8");
				$array_Bet_Online_id = str2array($tmp_Bet_Online_id , ",");
	
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>上線id陣列 , 原始參數 : {$tmp_Bet_Online_id}</h2>" ;	}
				//{	echo "<p>上線id陣列</p>" ;print_r($array_Bet_Online_id);echo "<br>" ;	}
	
				// 找出會員id的鍵字
				$tmp_Index = array_search($subID , $array_Bet_Online_id);
	
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>會員($subID)所在Index : $tmp_Index</p>" ;	}

				// 輸贏金額
				$array_Bet_Online_WinLost_Money = str2array( $LIST['Bet_Online_WinLost_Money'] , "," );
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>輸贏金額($tmp_Index) 值 : {$array_Bet_Online_WinLost_Money[$tmp_Index]} , 原始參數 : {$LIST['Bet_Online_WinLost_Money']}</h2>" ;	}
				//{	echo "<p>輸贏金額</p>" ;print_r($array_Bet_Online_WinLost_Money);echo "<br>" ;	}
				
				// 會員返水
				$array_Bet_Online_Backwater_Money = str2array( $LIST['Bet_Online_Backwater_Money'] , "," );
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>{$LIST['Bet_Type']}-會員返水($tmp_Index) 值 : {$array_Bet_Online_Backwater_Money[$tmp_Index]} , 原始參數 : {$LIST['Bet_Online_Backwater_Money']}</h2>" ;	}
				//{	echo "<p>會員返水</p>" ;print_r($array_Bet_Online_Backwater_Money);echo "<br>" ;	}
	
				// 總金額
				$array_Bet_Online_AllMoney = str2array( $LIST['Bet_Online_AllMoney'] , "," );
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>{$LIST['Bet_Type']}-總金額($tmp_Index) 值 : {$array_Bet_Online_AllMoney[$tmp_Index]} , 原始參數 : {$LIST['Bet_Online_AllMoney']}</h2>" ;	}
	
				// 報帳金額
				$array_Bet_Online_Reported_Money = str2array( $LIST['Bet_Online_Reported_Money'] , "," );
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>{$LIST['Bet_Type']}-報帳金額($tmp_Index) 值 : {$array_Bet_Online_Reported_Money[$tmp_Index]} , 原始參數 : {$LIST['Bet_Online_Reported_Money']}</h2>" ;	}
				//{	echo "<p>會員返水</p>" ;print_r($array_Bet_Online_Backwater_Money);echo "<br>" ;	}
			}
			else
			{// 會員查詢
				// 找出會員id的鍵字
				$tmp_Index = 0;
				// 輸贏金額 = 輸贏總金額
				$array_Bet_Online_WinLost_Money[$tmp_Index] = $LIST['Bet_WinLost_AllMoney'];
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>輸贏金額($tmp_Index) 值 : {$array_Bet_Online_WinLost_Money[$tmp_Index]} , 原始參數 : {$LIST['Bet_Online_WinLost_Money']}</h2>" ;	}
				//$array_Bet_Online_WinLost_Money[$tmp_Index] = $LIST['Bet_WinLost_AllMoney'] ;
				
				// 會員返水 = 輸贏總金額 * 返水比
				$array_Bet_Online_Backwater_Money[$tmp_Index] = $LIST['Bet_Member_Backwater_Money'] ;
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>{$LIST['Bet_Type']}-會員返水($tmp_Index) 值 : {$array_Bet_Online_Backwater_Money[$tmp_Index]} , 原始參數 : {$LIST['Bet_Online_Backwater_Money']}</h2>" ;	}
				//$array_Bet_Online_Backwater_Money[$tmp_Index] = $LIST['Bet_AllMoney'] * 1 ;

				// 總金額 = 輸贏金額 + 會員返水
				//$array_Bet_Online_AllMoney[$tmp_Index] = $array_Bet_Online_WinLost_Money[$tmp_Index] + $array_Bet_Online_Backwater_Money[$tmp_Index] ;
				$array_Bet_Online_AllMoney[$tmp_Index] = $LIST['Bet_Member_WinLost_AllMoney'] ;
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>{$LIST['Bet_Type']}-總金額($tmp_Index) 值 : {$array_Bet_Online_AllMoney[$tmp_Index]} , 原始參數 : {$LIST['Bet_Online_AllMoney']}</h2>" ;	}

				// 報帳金額 = 總金額 * (100-分成)/100
				//$array_Bet_Online_Reported_Money[$tmp_Index] = $array_Bet_Online_AllMoney[$tmp_Index] * (100 - $array_NowAgent_Info['Agent_Share']) / 100;
				$array_Bet_Online_Reported_Money[$tmp_Index] = $LIST['Bet_Member_Report_Money'];
				//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				//{	echo "<h2>{$LIST['Bet_Type']}-報帳金額($tmp_Index) 值 : {$array_Bet_Online_Reported_Money[$tmp_Index]} , 原始參數 : {$LIST['Bet_Online_Reported_Money']}</h2>" ;	}
			}
			
			// 投注金額(下注)
			$array_BetMoney[$tmp_Type_Name]['Bet_Money'] += $LIST['Bet_AllMoney'] ;

			// 輸贏金額
			$array_BetMoney[$tmp_Type_Name]['Bet_Online_WinLost_Money'] += $array_Bet_Online_WinLost_Money[$tmp_Index] ;
			if ( $tmpShowMsg OR $ShowDebug == "WM" )	// 秀出除錯訊息 ██████████
			{	echo "<h2>{$tmp_Bet_Type}-輸贏金額({$array_Bet_Online_WinLost_Money[$tmp_Index]})</h2>" ;	}

			// 會員返水			
			$array_BetMoney[$tmp_Type_Name]['Bet_Online_Backwater_Money'] += func_Digital_Carry( $array_Bet_Online_Backwater_Money[$tmp_Index] , 2 , "floor" ) ;
			if ( $tmpShowMsg OR $ShowDebug == "BM" )	// 秀出除錯訊息 ██████████
			{	echo "<h2>{$tmp_Bet_Type}-會員返水({$array_Bet_Online_Backwater_Money[$tmp_Index]})</h2>" ;	}

			// 總金額	 = 輸贏金額 + 會員返水
			//$tmp_Bet_Online_AllMoney = $array_Bet_Online_WinLost_Money[$tmp_Index] + $array_Bet_Online_Backwater_Money[$tmp_Index];
			$tmp_Bet_Online_AllMoney = $array_Bet_Online_WinLost_Money[$tmp_Index] + $array_Bet_Online_Backwater_Money[$tmp_Index];
			$array_BetMoney[$tmp_Type_Name]['Bet_Online_AllMoney'] += func_Digital_Carry( $tmp_Bet_Online_AllMoney , 2 , "floor" ) ;
			if ( $tmpShowMsg OR $ShowDebug == "AM" )	// 秀出除錯訊息 ██████████
			{	echo "<h2>{$tmp_Bet_Type}-總金額({$tmp_Bet_Online_AllMoney}) = 輸贏金額({$array_Bet_Online_WinLost_Money[$tmp_Index]}) + 會員返水({$array_Bet_Online_Backwater_Money[$tmp_Index]})</h2>" ;	}

			// 報帳金額 = 總金額 * ( 100-佔成 ) / 100
			$array_BetMoney[$tmp_Type_Name]['Bet_Online_Reported_Money'] += func_Digital_Carry( $array_Bet_Online_Reported_Money[$tmp_Index] , 2 , "floor" ) ;
			if ( $tmpShowMsg OR $ShowDebug == "RM" )	// 秀出除錯訊息 ██████████
			{	echo "<h2>{$tmp_Bet_Type}-總金額($array_Bet_Online_Reported_Money[$tmp_Index]) * ( 100-佔成 ) / 100</h2>" ;	}
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}

	
	return $array_BetMoney ;
}
//~@_@~// END 取得登入帳號的名字 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出報表內容 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_htmlReportInfo( $subType = "Agent" )
{
	global $link ;
	global $LIST_Agent ;
	global $array_NowAgent_Info ;
	global $LIST_Member ;
	global $array_BetMoney ;
	global $array_BackWater_Info ;
	global $sum_Bet_Money ;	// 投注金額
	global $sum_Bet_Online_WinLost_Money ;// 輸贏金額
	global $sum_Bet_Online_Backwater_Money ;	// 會員返水
	global $sum_Bet_Online_AllMoney ;				// 總金額
	global $sum_Bet_Online_Reported_Money ;	// 報帳金額
	global $Report_Start_Date  ;
	global $Report_End_Date  ;
	global $tmp_Report_Start_Hour  ;
	global $tmp_Report_End_Hour  ;
	global $tmp_Index ;
	global $array_5Start_Info;		// 五星彩
	global $array_All_Info;			// 總彩金

	/*
	範例			: WinHappy_htmlReportInfo() ;		// 秀出報表內容
	功能			: 秀出報表內容
	修改日期		: 20200529
	參數說明 :
		$subType 		呈現資料類別(Agent:代理人,Member:會員)
	回傳參數 :
		無
	使用範例 :
		WinHappy_htmlReportInfo() ;		// 秀出報表內容
	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	$tmp_Index % 2 ? $tmp_TR_CSS = "table_list_tr_bgdack" : $tmp_TR_CSS = "table_list_tr_bglight"  ;
	
	echo "					<tr class=\"$tmp_TR_CSS\">\n";

	$tmp_Member_Row = 3 ;
	// 五星彩 $array_5Start_Info['MoneyLog_Money_Total']
	if( $array_5Start_Info['MoneyLog_Money_Total'] )
	{	$tmp_Member_Row++ ;	}
	// 總彩金	 $array_All_Info['MoneyLog_Money_Total']
	if( $array_All_Info['MoneyLog_Money_Total'] )
	{	$tmp_Member_Row++ ;	}

	if( $subType == "Agent" )
	{// 代理
		echo "						<td rowspan=\"$tmp_Member_Row\" align=\"center\">代理</td>\n";
		echo "						<td rowspan=\"$tmp_Member_Row\" align=\"center\">{$LIST_Agent['Agent_Name']}</td>\n";
		echo "						<td rowspan=\"$tmp_Member_Row\" align=\"center\">{$LIST_Agent['Agent_Login_Name']}</td>\n";
	}
	else
	{// 會員
		echo "						<td rowspan=\"$tmp_Member_Row\" align=\"center\">會員</td>\n";
		echo "						<td rowspan=\"$tmp_Member_Row\" align=\"center\">{$LIST_Member['Member_Name']}</td>\n";
		echo "						<td rowspan=\"$tmp_Member_Row\" align=\"center\">{$LIST_Member['Member_Login_Name']}</td>\n";
	}
	

	echo "						<td align=\"right\">賓果(一)</td>\n";
	// 投注金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetMoney['Gen']['Bet_Money'] ) . "</td>\n";
	// 輸贏金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetMoney['Gen']['Bet_Online_WinLost_Money'] ) . "</font></td>\n";
	// 會員返水
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetMoney['Gen']['Bet_Online_Backwater_Money'] ) . "</font></td>\n";
	// 總金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( func_Digital_Carry( $array_BetMoney['Gen']['Bet_Online_AllMoney'] , 2 , "floor" ) ) . "</font></td>\n";

	if( $subType == "Agent" )// 代理
	{	echo "						<td align=\"right\">{$LIST_Agent['Agent_Share']}% / {$array_BackWater_Info['BackWater_Bingo_Gen_12Start']}%</td>\n";	}
	else//會員
	{	echo "						<td align=\"right\">{$array_NowAgent_Info['Agent_Share']}% / {$array_BackWater_Info['BackWater_Bingo_Gen_12Start']}%</td>\n";	}

	// 報帳金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetMoney['Gen']['Bet_Online_Reported_Money'] ) . "</font></td>\n";

	// 查看明細
	if( $subType == "Agent" )// 代理
	{	echo "						<td rowspan=\"$tmp_Member_Row\" align=\"center\"><a href=\"report.php?AID={$LIST_Agent['id_Agent']}&Report_Start_Date=$Report_Start_Date&Report_End_Date=$Report_End_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Hour=$Report_Start_Hour&ShowDebug=$ShowDebug\">查看明細</a></td>\n";	}
	else
	{	echo "						<td rowspan=\"$tmp_Member_Row\" align=\"center\"><a href=\"report_detail.php?MID={$LIST_Member['id_Member']}&Report_Start_Date=$Report_Start_Date&Report_End_Date=$Report_End_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Hour=$Report_Start_Hour&&ShowDebug=$ShowDebug\">查看明細</a></td>\n";	}

	echo "					</tr>\n";
	echo "					<tr class=\"$tmp_TR_CSS\">\n";
	echo "						<td align=\"right\">賓果(超)</td>\n";
	// 投注金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetMoney['Super']['Bet_Money'] ) . "</td>\n";
	// 輸贏金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetMoney['Super']['Bet_Online_WinLost_Money'] ) . "</td>\n";
	// 會員返水
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetMoney['Super']['Bet_Online_Backwater_Money'] ) . "</td>\n";
	// 總金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( func_Digital_Carry( $array_BetMoney['Super']['Bet_Online_AllMoney'] , 2 , "floor" ) ) . "</td>\n";
	if( $subType == "Agent" )// 代理
	{	echo "						<td align=\"right\">{$LIST_Agent['Agent_Share']}% / {$array_BackWater_Info['BackWater_Bingo_Super']}%</td>\n";	}
	else//會員
	{	echo "						<td align=\"right\">{$array_NowAgent_Info['Agent_Share']}% / {$array_BackWater_Info['BackWater_Bingo_Super']}%</td>\n";	}
	// 報帳金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( func_Digital_Carry( $array_BetMoney['Super']['Bet_Online_Reported_Money'] , 2 , "floor" ) ) . "</font></td>\n";
	echo "					</tr>\n";

	// 五星彩 $array_5Start_Info['MoneyLog_Money_Total']
	if(  $array_5Start_Info['MoneyLog_Money_Total'] )
	{
		echo "					<tr class=\"$tmp_TR_CSS\">\n";
		echo "						<td align=\"right\">五星彩</td>\n";
		// 投注金額
		echo "						<td align=\"right\">-</td>\n";
		// 輸贏金額
		echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_5Start_Info['MoneyLog_Money_Total'] , "After" ) . "</td>\n";
		// 會員返水
		echo "						<td align=\"right\">-</td>\n";
		// 總金額
		echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_5Start_Info['MoneyLog_Money_Total'] , "After" ) . "</td>\n";
		echo "						<td align=\"right\">-</td>\n";
		echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_5Start_Info['MoneyLog_Money_Total'] , "After" ) . "</td>\n";
		echo "					</tr>\n";
	}
	
	// 總彩金	 $array_All_Info['MoneyLog_Money_Total']
	if(  $array_All_Info['MoneyLog_Money_Total'] )
	{
		echo "					<tr class=\"$tmp_TR_CSS\">\n";
		echo "						<td align=\"right\">總彩金</td>\n";
		// 投注金額
		echo "						<td align=\"right\">-</td>\n";
		// 輸贏金額
		echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_All_Info['MoneyLog_Money_Total'] , "After" ) . "</td>\n";
		// 會員返水
		echo "						<td align=\"right\">-</td>\n";
		// 總金額
		echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_All_Info['MoneyLog_Money_Total'] , "After" ) . "</td>\n";
		echo "						<td align=\"right\">-</td>\n";
		echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_All_Info['MoneyLog_Money_Total'] , "After" ) . "</td>\n";
		echo "					</tr>\n";
	}
	

	// 合計
	echo "					<tr class=\"$tmp_TR_CSS\">\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>合計</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>" . WinHappy_setMoneyCss( $sum_Bet_Money , "After" ) . "</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>" . WinHappy_setMoneyCss( $sum_Bet_Online_WinLost_Money , "After" ) . "</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>" . WinHappy_setMoneyCss( $sum_Bet_Online_Backwater_Money , "After" ) . "</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>" . WinHappy_setMoneyCss( bcdiv($sum_Bet_Online_AllMoney * 100, 100 , 2) , "After" ) . "</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\">&nbsp;</td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\">" . WinHappy_setMoneyCss( $sum_Bet_Online_Reported_Money , "After" ) . "</td>\n";
	echo "					</tr>\n";
	
}
//~@_@~// END 秀出報表內容 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出首頁歷史報表內容 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_htmlPageReport( $sub_Type = "Old")
{
	global $link;
	global $page;
	global $Start_Year;
	global $Start_Month;
	global $Start_Day;
	global $End_Year;
	global $End_Month;
	global $End_Day;
	global $MAIN_BASE_ADDRESS ;
	/*
	範例			: WinHappy_htmlPageReport() ;		// 秀出首頁歷史報表內容
	功能			: 秀出首頁歷史報表內容
	修改日期		: 20200531
	參數說明 :
		$sub_Type	輸出類別(New : 下注明細 , Old : 歷史報表)
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_htmlPageReport( $sub_Type ) ;		// 秀出首頁歷史報表內容
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	include($MAIN_BASE_ADDRESS . "Project/WinHappy/array/Array_Bet_Type.inc") ;        // 載入專案處理狀況
	// 投注球號類別
    include($MAIN_BASE_ADDRESS . "Project/WinHappy/array/Array_Bet_Ball_List.inc") ;        // 載入專案處理狀況

	echo "<form name=\"form1\" id=\"form1\" method=\"post\">" ;
	echo "<input type='hidden' id='Funct' name='Funct' value=''>\n" ;
	// 查詢欄位-找出會員最早有資料的年份
	echo "	<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\n";
	if(  $sub_Type == "Old" )
	{//歷史報表
		echo "		<tr>\n";
		echo "			<td style=\"width:50px;\"></td>\n";
		// 起始年
		echo "			<td align=\"center\" style=\"background:#FFF;font-family:Verdana, Geneva, sans-serif;color:#000;\">查詢區間\n";
		echo "				<span id=\"date_s_y\">\n";
		echo "				<select class=\"setcss\" name='Start_Year' id='Start_Year' style=\"width:55px;\">\n";
		for( $i = 2018 ; $i <= 2020 ; $i++ )
		{
			$i == $Start_Year ? $tmp_Slecte = " selected" : $tmp_Slecte = "" ;
			echo "					<option value=\"$i\" $tmp_Slecte>$i</option>\n";
		}
		echo "				</select>\n";
		echo "				</span> -\n";
		// 起始月
		echo "				<span id=\"date_s_m\">\n";
		echo "				<select class=\"setcss\" name='Start_Month' id='Start_Month' style=\"width:40px;\">\n";
		for( $i = 1 ; $i <= 12 ; $i++ )
		{
			$i == (int)$Start_Month ? $tmp_Slecte = " selected" : $tmp_Slecte = "" ;
			$tmp_i = sprintf("%02s" , $i) ;
			echo "					<option value=\"$tmp_i\" $tmp_Slecte>$tmp_i</option>\n";
		}
		echo "				</select>\n";
		echo "				</span>-\n";
		// 起始日
		echo "				<span id=\"date_s_d\">\n";
		echo "				<select class=\"setcss\" name='Start_Day' id='Start_Day' style=\"width:40px;\">\n";
		for( $i = 1 ; $i <= 31 ; $i++ )
		{
			$i == $Start_Day ? $tmp_Slecte = " selected" : $tmp_Slecte = "" ;
			$tmp_i = sprintf("%02s" , $i) ;
			echo "					<option value=\"$tmp_i\" $tmp_Slecte>$tmp_i</option>\n";
		}
		echo "				</select>\n";
		echo "				</span> ~ \n";
		// 結束年
		echo "				<span id=\"date_e_y\">\n";
		echo "				<select class=\"setcss\" name='End_Year' id='End_Year' style=\"width:55px;\">\n";
		for( $i = 2018 ; $i <= 2020 ; $i++ )
		{
			$i == $End_Year ? $tmp_Slecte = " selected" : $tmp_Slecte = "" ;
			echo "					<option value=\"$i\" $tmp_Slecte>$i</option>\n";
		}
		echo "				</select>\n";
		echo "				</span> -\n";
		// 結束月
		echo "				<span id=\"date_e_m\">\n";
		echo "				<select class=\"setcss\" name='End_Month' id='End_Month' style=\"width:40px;\">\n";
		for( $i = 1 ; $i <= 12 ; $i++ )
		{
			$i == $End_Month ? $tmp_Slecte = " selected" : $tmp_Slecte = "" ;
			$tmp_i = sprintf("%02s" , $i) ;
			echo "					<option value=\"$tmp_i\" $tmp_Slecte>$tmp_i</option>\n";
		}
		echo "				</select>\n";
		echo "				</span>-\n";
		// 結束日
		echo "				<span id=\"date_e_d\">\n";
		echo "				<select class=\"setcss\" name='End_Day' id='End_Day' style=\"width:40px;\">\n";
		for( $i = 1 ; $i <= 31 ; $i++ )
		{
			$i == $End_Day ? $tmp_Slecte = " selected" : $tmp_Slecte = "" ;
			$tmp_i = sprintf("%02s" , $i) ;
			echo "					<option value=\"$tmp_i\" $tmp_Slecte>$tmp_i</option>\n";
		}
		echo "				</select>\n";
		// 特選日期
		echo "				</span>  \n";
		echo "				<input type=\"button\" class=\"alerttext_b BTN_setcss\" data-funct='today' style=\"width:40px;\" value=\"今日\" onclick=\"addDate1(0)\">\n";
		echo "				<input type=\"button\" class=\"alerttext_b BTN_setcss\" data-funct='yestoday' style=\"width:40px;\" value=\"昨日\" onclick=\"addDate1(1)\">\n";
		echo "				<input type=\"button\" class=\"alerttext_b BTN_setcss\" data-funct='week' style=\"width:40px;\" value=\"本週\" onclick=\"addDate1(2)\">\n";
		echo "				<input type=\"button\" class=\"alerttext_b BTN_setcss\" data-funct='prev_week' style=\"width:40px;\" value=\"上週\" onclick=\"addDate1(3)\">\n";
		echo "				<input type=\"button\" class=\"alerttext_b BTN_setcss\" data-funct='month' style=\"width:40px;\" value=\"本月\" onclick=\"addDate1(4)\">\n";
		echo "				<input type=\"button\" class=\"alerttext_b BTN_setcss\" data-funct='prev_month' style=\"width:40px;\" value=\"上月\" onclick=\"addDate1(5)\"></td>\n";
		echo "			<td style=\"width:50px;\"></td>\n";
		echo "		</tr>\n";
	}
	// 資料列
	echo "		<tr>\n";
	echo "			<td></td>\n";
	echo "				<td id=\"ticktable\">\n";
	echo "			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list\" width=\"100%\">\n";
	echo "				<tr class=\"table_header\" style=\"height:12px;\">\n";
	echo "					<td align=\"center\">序號</td>\n";
	echo "					<td align=\"center\">注單編號</td>\n";
	echo "					<td align=\"center\">期數</td>\n";
	echo "					<td align=\"center\">時間</td>\n";
	echo "					<td align=\"center\">遊戲內容</td>\n";
	echo "					<td align=\"center\">賠率</td>\n";
	echo "					<td align=\"center\">注數</td>\n";
	echo "					<td align=\"center\">單注金額</td>\n";
	echo "					<td align=\"center\">投注總計</td>\n";
	echo "					<td id=\"ww_0\" align=\"center\" style=\"display:none\">退水</td>\n";
	if( $sub_Type == "Old")
	{	echo "					<td align=\"center\" >輸贏結果</td>\n";	}
	echo "				</tr>\n";
	
	$tmp_WhereSQL = " AND Bet_Add_DT >= '{$Start_Year}-{$Start_Month}-{$Start_Day} 00:00:00' AND Bet_Add_DT <= '{$End_Year}-{$End_Month}-{$End_Day} 23:59:59'" ;
	
	if( $sub_Type == "New")
	{	$tmp_WhereSQL .= " AND Bet_On = '0'" ;	}
	else if( $sub_Type == "Old")
	{	$tmp_WhereSQL .= " AND Bet_On = '1'" ;	}

	// 找出所有下注資料
	$SQL_Bet = "SELECT * FROM Bet WHERE Bet_Member_ID = '{$_SESSION['Member_ID']}' $tmp_WhereSQL ORDER BY Bet_Bingo_Period DESC , Bet_Add_DT DESC" ;

	//echo $SQL_Bet . "<br>" ; 
	$QUERY_Bet = mysqli_query($link , $SQL_Bet) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY_Bet) )
	{
		$tmp_Index = 1 ;
		// 一條條獲取
		while ($LIST_Bet = mysqli_fetch_assoc($QUERY_Bet))
		{
			// 取得該期的Bingo獎號
			$array_Bingo_Info = func_DatabaseGet( "Bingo" , "*" , array("Bingo_Period"=>$LIST_Bet['Bet_Bingo_Period']) ) ;		// 取得資料庫資料

			// 配對成功奬號
			$array_Match_Number = WinHappy_Match_Number( $array_Bingo_Info['Bingo_Num'] , $LIST_Bet['Bet_Ball_List']) ;
			//$array_Match_Number['Num']		下注星彩選中號碼數字
			//$array_Match_Number['Mark']		標注配封成功獎號
			//$array_Match_Number['Match']		配對成功獎號

			$tmp_Index % 2 ? $tmp_TR_CSS = "table_list_tr_bgdack" : $tmp_TR_CSS = "table_list_tr_bglight"  ;
			echo "				<tr class=\"$tmp_TR_CSS\" style=\"height:12px;\">\n";
			echo "					<td align=\"center\">$tmp_Index</td>\n";	// 序號
			echo "					<td align=\"center\">{$LIST_Bet['Bet_ID']}</td>\n";	// 注單編號
			echo "					<td align=\"center\">{$LIST_Bet['Bet_Bingo_Period']}</td>\n";	// 期數
			echo "					<td align=\"center\">{$LIST_Bet['Bet_Add_DT']}</td>\n";	// 時間
			// 投注球號
			if( $Array_Bet_Ball_List[$LIST_Bet['Bet_Type']] )
			{	 $LIST_Bet['Bet_Ball_List'] = $Array_Bet_Ball_List[$LIST_Bet['Bet_Type']] ;	 }
			//echo "					<td align=\"center\">遊戲類別: " . $Array_Bet_Type[$LIST_Bet['Bet_Type']] . "<br>下注內容: " . $LIST_Bet['Bet_Ball_List'] . "</td>\n";	// 遊戲內容
			echo "					<td align=\"center\">遊戲類別: " . $Array_Bet_Type[$LIST_Bet['Bet_Type']] . "<br>下注內容: " . $array_Match_Number['Mark'] . "</td>\n";	// 遊戲內容
			echo "					<td align=\"center\">{$LIST_Bet['Bet_Odds']}</td>\n";	// 賠率
			echo "					<td align=\"center\">{$LIST_Bet['Bet_Count']}</td>\n";	// 注數
			echo "					<td align=\"center\">{$LIST_Bet['Bet_Money']}</td>\n";	// 單注金額
			$sum_Bet_AllMoney += $LIST_Bet['Bet_AllMoney'] ;
			echo "					<td align=\"center\">" . WinHappy_setMoneyCss( $LIST_Bet['Bet_AllMoney'] ) . "</td>\n";	// 遊戲點數
			//echo "					<td id=\"ww_0\" align=\"center\" style=\"display:none\">退水</td>\n";
			$sum_Bet_WinLost_AllMoney += $LIST_Bet['Bet_WinLost_AllMoney'] ;
			
			if( $sub_Type == "Old" )// 總計
			{	echo "					<td align=\"center\" >" . WinHappy_setMoneyCss( $LIST_Bet['Bet_WinLost_AllMoney'] ) . "</td>\n";	}

			echo "				</tr>\n";
			if( $LIST_Bet['Bet_Start_Winning_Content'] )
			{	echo "<tr class=\"$tmp_TR_CSS\"><td></td><td colspan='9'> " . nl2br($LIST_Bet['Bet_Start_Winning_Content']) . "</td></tr>" ;}
			$tmp_Index++;
			
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_Bet);
	}
	//else
	//{	echo "沒有找到資料<br>" ;	}
	
	// 統計
//	echo "				<tr style=\"background:#DDD;\">\n";
//	echo "					<td colspan=\"7\" align=\"right\" style=\"font-weight:900;color:#00F\">此頁</td>\n";
//	echo "					<td align=\"right\">" . WinHappy_setMoneyCss( $sum_Bet_AllMoney ) . "</td>\n";
//	echo "					<td align=\"right\" id=\"ww_1\" style=\"color:#999;display:none;\">0</td>\n";
//	if( $sub_Type == "Old")
//	{	echo "					<td align=\"right\">" . WinHappy_setMoneyCss( $sum_Bet_WinLost_AllMoney ) . "</td>\n";	}
//	echo "				</tr>\n";

	if( $sub_Type == "Old" )
	{
		$tmp_WhereSQL_MoneyLog = " AND MoneyLog_Add_DT >= '{$Start_Year}-{$Start_Month}-{$Start_Day} 00:00:00' AND MoneyLog_Add_DT <= '{$End_Year}-{$End_Month}-{$End_Day} 23:59:59'" ;
	
		// 杳詢五星彩彩金資料
		$SQL_5Start = "SELECT * FROM MoneyLog WHERE MoneyLog_Set_ID = '{$_SESSION['Member_ID']}' AND MoneyLog_Type = '6' $tmp_WhereSQL_MoneyLog" ;
		//echo $SQL_5Start . "<br>" ; 
		$QUERY_5Start = mysqli_query($link , $SQL_5Start) ;
		
		// 是否有資料
		if ( mysqli_num_rows($QUERY_5Start) )
		{
			// 一條條獲取
			while ($LIST_5Start = mysqli_fetch_assoc($QUERY_5Start))
			{
				$tmp_Index % 2 ? $tmp_TR_CSS = "table_list_tr_bgdack" : $tmp_TR_CSS = "table_list_tr_bglight"  ;
				echo "				<tr class=\"$tmp_TR_CSS\" style=\"height:12px;\">\n";
				echo "					<td align=\"center\">$tmp_Index</td>\n";	// 序號
				echo "					<td align=\"center\"></td>\n";	// 注單編號
				echo "					<td align=\"center\"></td>\n";	// 期數
				echo "					<td align=\"center\">{$LIST_5Start['MoneyLog_Add_DT']}</td>\n";	// 時間
				echo "					<td align=\"center\">五星彩彩金</td>\n";	// 遊戲內容
				echo "					<td align=\"center\"></td>\n";	// 賠率
				echo "					<td align=\"center\"></td>\n";	// 注數
				echo "					<td align=\"center\"></td>\n";	// 單注金額
				echo "					<td align=\"center\">" . WinHappy_setMoneyCss( $LIST_5Start['MoneyLog_Money'] ) . "</td>\n";	// 遊戲點數
				$sum_Bet_AllMoney += $LIST_5Start['MoneyLog_Add_DT'] ;
				$sum_Bet_WinLost_AllMoney += $LIST_5Start['MoneyLog_Money'] ;
				
				if( $sub_Type == "Old" )// 總計
				{	echo "					<td align=\"center\" >" . WinHappy_setMoneyCss( $LIST_5Start['MoneyLog_Money'] ) . "</td>\n";	}
	
				echo "				</tr>\n";
				if( $LIST_5Start['Bet_Start_Winning_Content'] )
				{	echo "<tr class=\"$tmp_TR_CSS\"><td></td><td colspan='9'> " . nl2br($LIST_5Start['Bet_Start_Winning_Content']) . "</td></tr>" ;}
				$tmp_Index++;
			}
			// 釋放結果集合
			mysqli_free_result($QUERY_5Start);
		}

		// 杳詢總彩金彩金資料
		$SQL_5Start = "SELECT * FROM MoneyLog WHERE MoneyLog_Set_ID = '{$_SESSION['Member_ID']}' AND MoneyLog_Type = '7' $tmp_WhereSQL_MoneyLog" ;
		//echo $SQL_5Start . "<br>" ; 
		$QUERY_5Start = mysqli_query($link , $SQL_5Start) ;
		
		// 是否有資料
		if ( mysqli_num_rows($QUERY_5Start) )
		{
			// 一條條獲取
			while ($LIST_5Start = mysqli_fetch_assoc($QUERY_5Start))
			{
				$tmp_Index % 2 ? $tmp_TR_CSS = "table_list_tr_bgdack" : $tmp_TR_CSS = "table_list_tr_bglight"  ;
				echo "				<tr class=\"$tmp_TR_CSS\" style=\"height:12px;\">\n";
				echo "					<td align=\"center\">$tmp_Index</td>\n";	// 序號
				echo "					<td align=\"center\"></td>\n";	// 注單編號
				echo "					<td align=\"center\"></td>\n";	// 期數
				echo "					<td align=\"center\">{$LIST_5Start['MoneyLog_Add_DT']}</td>\n";	// 時間
				echo "					<td align=\"center\">總彩金彩金</td>\n";	// 遊戲內容
				echo "					<td align=\"center\"></td>\n";	// 賠率
				echo "					<td align=\"center\"></td>\n";	// 注數
				echo "					<td align=\"center\"></td>\n";	// 單注金額
				echo "					<td align=\"center\">" . WinHappy_setMoneyCss( $LIST_5Start['MoneyLog_Money'] ) . "</td>\n";	// 遊戲點數
				$sum_Bet_AllMoney += $LIST_5Start['MoneyLog_Add_DT'] ;
				$sum_Bet_WinLost_AllMoney += $LIST_5Start['MoneyLog_Money'] ;
				
				if( $sub_Type == "Old" )// 總計
				{	echo "					<td align=\"center\" >" . WinHappy_setMoneyCss( $LIST_5Start['MoneyLog_Money'] ) . "</td>\n";	}
	
				echo "				</tr>\n";
				if( $LIST_5Start['Bet_Start_Winning_Content'] )
				{	echo "<tr class=\"$tmp_TR_CSS\"><td></td><td colspan='9'> " . nl2br($LIST_5Start['Bet_Start_Winning_Content']) . "</td></tr>" ;}
				$tmp_Index++;
			}
			// 釋放結果集合
			mysqli_free_result($QUERY_5Start);
		}
	}
	// 分頁
	echo "				<tr style=\"background:#DDD;\">\n";
	echo "					<td align=\"center\" colspan=\"7\" style=\"color:#000\">\n";
//	echo "					<select class=\"setcss\" name='page'\">\n";
//	echo "				<option value=0 selected>第1頁</option>\n";
	echo "					</td>\n";
	echo "					<td align=\"right\" style=\"font-weight:900;color:#00F\">\n";
	echo "					總計\n";
	echo "					</td>\n";
	echo "					<td align=\"right\">\n";
	echo "					" . WinHappy_setMoneyCss( $sum_Bet_AllMoney ) . "\n";
	echo "					</td>\n";
	echo "					<td align=\"right\" id=\"ww_2\" style=\"color:#999;display:none;\">\n";
	echo "					0\n";
	echo "					</td>\n";
	if( $sub_Type == "Old")
	{// 輸贏結果
		echo "					<td align=\"right\">\n";
		echo "					" . WinHappy_setMoneyCss( $sum_Bet_WinLost_AllMoney ) . "\n";
		echo "					</td>\n";
	}
	echo "					</tr>\n";
	echo "			</table>\n";
	echo "				</td>\n";
	echo "			<td></td>\n";
	echo "		</tr>\n";
	echo "	</table>\n";
}
//~@_@~// END 秀出首頁歷史報表內容 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定金額CSS ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_setMoneyCss( $sub_Money , $sub_Type = "After" )
{
	global $link;
	/*
	範例			: $tmp_MoneyCss = WinHappy_setMoneyCss( $sub_Money ) ;		// 設定金額CSS
	功能			: 設定金額CSS
	修改日期		: 20200530
	參數說明 :
		$sub_Money			輸入金額
		$sub_Type			前後台設定(前台 : Before , 後台 : After)
	回傳參數 :
		$tmp_MoneyCss		所有上線代理人資料
	使用範例 :		:
		$tmp_MoneyCss = WinHappy_setMoneyCss( $sub_Money , "After" ) ;		// 設定後台金額CSS
		$tmp_MoneyCss = WinHappy_setMoneyCss( $sub_Money , "Before" ) ;		// 設定前台金額CSS
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	if( $sub_Money > 0 )
	{	$tmp_MoneyCss = "<span class='WinHappy_Positive_$sub_Type'>$sub_Money</span>" ;	}
	else if( $sub_Money < 0 )
	{	$tmp_MoneyCss = "<span class='WinHappy_Negative_$sub_Type'>$sub_Money</span>" ;	}
	else
	{	$tmp_MoneyCss = (int)$sub_Money ;	}
	return $tmp_MoneyCss ;
}
//~@_@~// END 秀出報表內容 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得大盤表資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getLarge_Table_Info( $Direct_Member = "ONLY" , $sub_Show = "Web" )
{
	global $link;
	/*
	範例			: WinHappy_getLarge_Table_Info() ;		// 取得大盤表資料
	功能			: 取得大盤表資料
	修改日期		: 20200806
	參數說明 :
		$Direct_Member	查詢類別(ONLY:直屬會員 , ALL:旗下全部會員)
		$sub_Show		秀出模式(Web:網頁 , Ajax:Ajax)
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_getLarge_Table_Info("ONLY") ;		// 取得大盤表資料
		WinHappy_getLarge_Table_Info("ALL") ;		// 取得大盤表資料
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	$array_Agent_Info = WinHappy_getAgentInfo( $_SESSION['Agent_ID'] ) ;		// 取得會員資料
	//echo "<p>{$_SESSION['Agent_ID']}</p>" ;print_r($array_Agent_Info);echo "<br>" ;

	// 是否為Ajax模式
	if( $sub_Show == "Ajax" )
	{	echo "01," ;	}

	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
	//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
	
	//Direct_Member	ONLY:直屬會員 , ALL:旗下全部會員
	//$Direct_Member = "ALL" ;
	//echo $Direct_Member ;
	if( empty($Direct_Member) )
	{	$Direct_Member = "ONLY" ;	}
	
	if($Direct_Member == "ONLY")
	{
		$tmp_WhereDirect_Member = " AND Bet_Agent_ID = '{$array_Agent_Info['Agent_ID']}' " ;
		$tmp_Radio_ONLY = " checked" ;
		$tmp_Radio_ALL = "" ;
	}
	else
	{
		$tmp_WhereDirect_Member = " AND Bet_Online_id LIKE '%,{$array_Agent_Info['id_Agent']},%' " ;
		$tmp_Radio_ONLY = "" ;
		$tmp_Radio_ALL = " checked" ;
	}
	
	// Bet_Type	'下注種類' 3_0||一星連碰||4_0||二星連碰||5_0||三星連碰||6_0||四星連碰||7_0||五星||0_0||超級號碼大小[大]||0_1||超級號碼大小[小]||1_0||超級號碼單雙[單]||1_1||超級號碼單雙[雙]||2_0||猜大小[大]||2_1||猜大小[小]:
	$arrayType[] = "0_0" ;
	$arrayType[] = "0_1" ;
	$arrayType[] = "1_0" ;
	$arrayType[] = "1_1" ;
	$arrayType[] = "2_0" ;
	$arrayType[] = "2_1" ;
	$arrayType[] = "3_0" ;
	$arrayType[] = "4_0" ;
	$arrayType[] = "5_0" ;
	$arrayType[] = "6_0" ;
	$arrayType[] = "7_0" ;
	
	foreach( $arrayType as $key => $value )
	{
		$tmp_WhereType = " AND Bet_Type = '$value' " ;
		
		$tmp_Where = " Bet_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' $tmp_WhereDirect_Member $tmp_WhereType" ;
		
		$SQL_COUNT = "SELECT * FROM Bet WHERE $tmp_Where " ;
		
		//echo "找出數量 : $SQL_COUNT<br>" ;
		
		// 找出數量
		//$Count = func_DatabaseGet( $SQL_COUNT , "COUNT" , "" ) ;		// 取得資料庫資料
		$SQL_COUNT = "SELECT sum(Bet_Count) as Bet_Count_Total FROM Bet WHERE $tmp_Where" ;				// 找出某欄位的總合
		//echo "找出數量 : $SQL_COUNT<br>" ;
		$array_COUNT_Info = func_DatabaseGet( $SQL_COUNT , "SQL" , "" ) ;		// 取得資料庫資料
		
		// 找出金額
		$SQL_Sum = "SELECT sum(Bet_AllMoney) as Bet_AllMoney_Total FROM Bet WHERE $tmp_Where" ;				// 找出某欄位的總合
		//echo "找出金額 : $SQL_Sum<br>" ;
		$array_Sum_Info = func_DatabaseGet( $SQL_Sum , "SQL" , "" ) ;		// 取得資料庫資料
		
		$array_Large_Table[$value]['Count'] = (int)$array_COUNT_Info['Bet_Count_Total'];
		$array_Large_Table[$value]['Total_Point'] = (int)$array_Sum_Info['Bet_AllMoney_Total'];
	}
	//echo "<p>取得大盤表資料</p>" ;print_r($array_Large_Table);echo "<br>" ;
	
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"50%\" class='YSingle_Line_Table'>\n";
	echo "	<tr>\n";
	echo "		<td height=\"25\" colspan=4 align=\"center\" style=\"padding-left:10px\">大盤表</td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "		<td height=\"25\" colspan=4 align=\"center\" style=\"padding-left:10px\">\n";
	echo "		<input type=\"radio\" name=\"Direct_Member\" value=\"ONLY\" $tmp_Radio_ONLY class='Direct_Member'>直屬會員$Direct_Member\n";
	echo "		<input type=\"radio\" name=\"Direct_Member\" value=\"ALL\" $tmp_Radio_ALL class='Direct_Member'>旗下全部會員\n";
	echo "		</td>\n";
	echo "	</tr>\n";

	echo "	<tr>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\"></td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\"></td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">筆數</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">金額</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" rowspan=4 height=\"25\" align=\"left\" style=\"padding-left:10px\">超獎猜</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">大</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['0_0']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['0_0']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">小</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['0_1']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['0_1']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">單</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['1_0']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['1_0']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">雙</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['1_1']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['1_1']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" rowspan=2 height=\"25\" align=\"left\" style=\"padding-left:10px\">猜大小</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">大</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['2_0']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['2_0']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">小</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['2_1']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['2_1']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" rowspan=5 height=\"25\" align=\"left\" style=\"padding-left:10px\">號碼投注</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">1星</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['3_0']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['3_0']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">2星</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['4_0']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['4_0']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">3星</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['5_0']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['5_0']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">4星</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['6_0']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['6_0']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	
	echo "	<tr>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">5星</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['7_0']['Count']}</td>\n";
	echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$array_Large_Table['7_0']['Total_Point']}</td>\n";
	echo "	</tr>\n";
	echo "</table>\n";
}
//~@_@~// END 取得大盤表資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 系統相關
//~@_@~// START 取得系統設定值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getSystemSet()
{
	global $link;
	/*
	範例			: $array_SystemSet = WinHappy_getSystemSet() ;		// 取得系統設定值
	功能			: 取得系統設定值
	修改日期		: 20200702
	參數說明 :
		無
	回傳參數 :
		$array_SystemSet		所有上線代理人資料
	使用範例 :		:
		$Conn_Backup_URL = "top101.shoping.jjvk.com" ;	// 備源系統網域
		$Conn_Backup_State = "1" ;	// 備源系統網域(1:啟用,0關閉)
		$array_SystemSet = WinHappy_getSystemSet() ;		// 取得系統設定值
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	$array_SystemSet = func_DatabaseGet( "SystemSet" , "*" , array("id_SystemSet"=>"1") ) ;		// 取得資料庫資料
	return $array_SystemSet ;
}
//~@_@~// END 取得系統設定值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 判斷最低單注倍數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_checkBetMaxMinmultiple()
{
	global $link;
	global $Conn_Bet_Multiple ;
	global $BetLimit_Super_BigSmall;
	global $BetLimit_Super_BigSmall_Low;
	global $BetLimit_Super_SingleDouble;
	global $BetLimit_Super_SingleDouble_Low;
	global $BetLimit_BigSmall;
	global $BetLimit_BigSmall_Low;
	global $BetLimit_1Start;
	global $BetLimit_1Start_Low;
	global $BetLimit_2Start;
	global $BetLimit_2Start_Low;
	global $BetLimit_3Start;
	global $BetLimit_3Start_Low;
	global $BetLimit_4Start;
	global $BetLimit_4Start_Low;
	global $BetLimit_5Start;
	global $BetLimit_5Start_Low;
	/*
	範例			: $ReturnMsg = WinHappy_checkBetMaxMinmultiple() ;		// 判斷最低單注倍數
	功能			: 取得會員資料
	修改日期		: 20200519
	參數說明 :
		無
	回傳參數 :
		$ReturnMsg		判斷最低單注倍數
	使用範例 :		:
		$ReturnMsg = WinHappy_checkBetMaxMinmultiple() ;		// 判斷最低單注倍數
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	// 單注最低、單注最高相差不能超過50倍
	if( ($BetLimit_Super_BigSmall / $BetLimit_Super_BigSmall_Low) > $Conn_Bet_Multiple )
	{	$ReturnMsg = "超級號碼大小的單注最低和單注最高相差不能超過{$Conn_Bet_Multiple}倍" ;	}
	else if( ($BetLimit_Super_SingleDouble / $BetLimit_Super_SingleDouble_Low) > $Conn_Bet_Multiple )
	{	$ReturnMsg = "超級號碼單雙的單注最低和單注最高相差不能超過{$Conn_Bet_Multiple}倍" ;	}
	else if( ($BetLimit_BigSmall / $BetLimit_BigSmall_Low) > $Conn_Bet_Multiple )
	{	$ReturnMsg = "猜大小的單注最低和單注最高相差不能超過{$Conn_Bet_Multiple}倍" ;	}
	else if( ($BetLimit_1Start / $BetLimit_1Start_Low) > $Conn_Bet_Multiple )
	{	$ReturnMsg = "1星的單注最低和單注最高相差不能超過{$Conn_Bet_Multiple}倍" ;	}
	else if( ($BetLimit_2Start / $BetLimit_2Start_Low) > $Conn_Bet_Multiple )
	{	$ReturnMsg = "2星的單注最低和單注最高相差不能超過{$Conn_Bet_Multiple}倍" ;	}
	else if( ($BetLimit_3Start / $BetLimit_3Start_Low) > $Conn_Bet_Multiple )
	{	$ReturnMsg = "3星的單注最低和單注最高相差不能超過{$Conn_Bet_Multiple}倍" ;	}
	else if( ($BetLimit_4Start / $BetLimit_4Start_Low) > $Conn_Bet_Multiple )
	{	$ReturnMsg = "4星的單注最低和單注最高相差不能超過{$Conn_Bet_Multiple}倍" ;	}
	else if( ($BetLimit_5Start / $BetLimit_5Start_Low) > $Conn_Bet_Multiple )
	{	$ReturnMsg = "5星的單注最低和單注最高相差不能超過{$Conn_Bet_Multiple}倍" ;	}
	else
	{	$ReturnMsg = "" ;	}

	return $ReturnMsg ;
}
//~@_@~// END 判斷最低單注倍數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 備援系統
//~@_@~// START 設定備援系統資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_setBackupInfo( $sub_Json , $sub_Bingo_Period , $sub_Draw_DT )
{
	global $link;
	global $Conn_Backup_URL;	// 備源系統網域
	global $Conn_Backup_State ;	// 備源系統狀態(1:啟用,0關閉)
	/*
	範例			: WinHappy_setBackupInfo( $sub_Json , $sub_Bingo_Period , $sub_Draw_DT ) ;		// 設定備援系統資料
	功能			: 設定備援系統資料
	修改日期		: 200808
	參數說明 :
		$sub_Json			要儲存的備援資料
		$sub_Bingo_Period	開獎Bingo期號
		$sub_Draw_DT		開獎日期
	回傳參數 :
		無
	使用範例 :		:
		$arrayData['TableName'] = "Bet" ;					// 表格名稱
		$arrayData['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
		$arrayData['WhereField'] = "Member_ID" ;			// 操作判斷式欄位名稱(新增-判斷是否有重複)(Member_ID),不可以用id,因為兩台主機資料庫可能不同
		$arrayData['WhereKey'] = "Member202007010001" ;		// 操作判斷式關鍵字(新增-判斷是否有重複)(Member202007010001),不可以用id,因為兩台主機資料庫可能不同
		WinHappy_setBackupInfo( array2json($arrayData) , "" , "" ) ;
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	// 備源系統狀態(1:啟用,0關閉)
	if( $Conn_Backup_State == 1 )
	{
		if($sub_Bingo_Period == "" OR $sub_Draw_DT == "" )
		{// 以當期期數和時間為主
			$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
			//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
			$sub_Bingo_Period = $array_BingoPeriod['NowBingo'] ;
			$sub_Draw_DT = date("Y-m-d") . " " . $array_BingoPeriod['NowBingo_Time'] ;
		}
		// 是否已有該期資料
		$Count = func_DatabaseGet( "SELECT * FROM Backup WHERE Backup_Bingo_Period = '$sub_Bingo_Period'" , "COUNT" , "" ) ;		// 取得資料庫資料
		//echo "已有該期資料 : $Count<br>" ;
		if( $Count )
		{// 已有資料,加上備援資料
			$tmpSQL = "UPDATE Backup SET Backup_Json = CONCAT(Backup_Json, '$sub_Json|||') WHERE Backup_Bingo_Period = '$sub_Bingo_Period'" ;		// 欄位後面加資料
			$Bol = func_DatabaseBase( $tmpSQL , "SQL" , "" , "" ) ;									// 資料庫處理
			if ( $Bol )
			{}
			else
			{	echo "資料執行失敗" ;	}
		}
		else
		{// 沒有資料,建立備援資料
			$arrayField['Backup_Json'] = "$sub_Json|||" ;
			$arrayField['Backup_Bingo_Period'] = "$sub_Bingo_Period" ;
			$arrayField['Backup_Draw_DT'] = "$sub_Draw_DT" ;
			$arrayField['Backup_Add_DT'] = date("Y-m-d H:i:s") ;
			$arrayField['Backup_On'] = "0" ;
			
			$Bol = func_DatabaseBase( "Backup" , "ADD" , $arrayField , "" ) ;						// 資料庫處理
		}
	}
}
//~@_@~// END 設定備援系統資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 上傳備源資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_sentBackupData()
{
	global $link;
	global $Conn_Backup_URL;	// 備源系統網域
	global $Conn_Backup_State ;	// 備源系統狀態(1:啟用,0關閉)
	/*
	範例			: WinHappy_sentBackupData() ;		// 上傳備源資料
	功能			: 上傳備源資料
	修改日期		: 200808
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_sentBackupData() ;		// 設定備援系統資料
	*/
	$tmpShowMsg = 1 ;

	// 備源系統狀態(1:啟用,0關閉)
	if( $Conn_Backup_State == 1 )
	{
		$tmpURL = "http://$Conn_Backup_URL/api/api_Backup.php";
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "<p>送出API位置 : " . $tmpURL ."</p>";	}

		// 查詢是否有需備源的資料(大於20分)
		$tmpDate = funct_ChangTime( date("Y-m-d H:i:s") , "PM" , 6 ) ;		// 改變時間
		$SQL = "SELECT * FROM Backup WHERE Backup_Draw_DT < '$tmpDate' AND Backup_On = '0' " ;

		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "<p>查詢是否有需備源的資料 : $SQL </p><hr>" ; 	}
		
		$QUERY = mysqli_query($link , $SQL) ;
		
		// 是否有資料
		if ( mysqli_num_rows($QUERY) )
		{
			// 一條條獲取
			while ($LIST = mysqli_fetch_assoc($QUERY))
			{
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{
					echo "開獎Bingo期號 : {$LIST['Backup_Bingo_Period']} " ;
					echo "開獎日期 : {$LIST['Backup_Draw_DT']}<br>" ;
				}

				$arrayPara['Funct'] = "setBackup" ;	// 功能參數(必傳)
				$arrayPara['Data'] = $LIST['Backup_Json'] ;		// 要處理的欄位名稱和資料
				$arrayPara['Time'] = date("Y-m-d H:i:s") ;	// 送出時間(必傳)

				$tmpSentJson = getOutputJson( $arrayPara ) ;
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>傳過去JSON的資料 : <br>" . $tmpSentJson ."</p>";	}
				// 送出API位置

				$json = sentCURL_Post( $tmpURL , $tmpSentJson ) ;		// 送出CURL資料(POST)
				$arrayJson = json2array($json);

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>回傳資料 $json</p>" ;print_r($arrayJson);echo "<br>" ;	}
				
				echo "<h3>處理目前的資料{$arrayJson['Funct']}</h3>" ;

				if( $arrayJson['Funct'] == "oksetBackup" )
				{// 處理目前的資料
					
					$arrayField['Backup_On'] = "1" ;
					$Bol = func_DatabaseBase( "Backup" , "MOD" , $arrayField , " id_Backup = '{$LIST['id_Backup']}'" ) ;						// 資料庫處理
					if( $Bol )
					{
						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<p>資料處理完成,設定本資料已完成-成功</p>" ;	}
					}
					else
					{
						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<p>資料處理完成,設定本資料已完成-失敗</p>" ;	}
					}
					
				}
				if ( $tmpShowMsg or 1 )	// 秀出除錯訊息 ██████████
				{	echo "<hr><p>接收api回傳資料 : $json</p><hr><hr>" ;	}
			}
			
			// 釋放結果集合
			mysqli_free_result($QUERY);
		}
		//else
		//{	echo "沒有找到資料<br>" ;	}
	}
}
//~@_@~// END 上傳備源資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 手機用
//~@_@~// START 手機Bingo獎號 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_htmlMobileBingoNum()
{
	global $link;
	/*
	範例			: WinHappy_htmlMobileBingoNum() ;		// 手機Bingo獎號
	功能			: 取得系統設定值
	修改日期		: 20200712
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		WinHappy_htmlMobileBingoNum() ;		// 手機Bingo獎號
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// 最新一期球號
	$tmpSQL_Bingo = "SELECT * FROM Bingo ORDER BY id_Bingo DESC LIMIT 1" ;
	$array_Bingo_Info = func_DatabaseGet( $tmpSQL_Bingo , "SQL" , "" ) ;		// 取得資料庫資料

	// 開獎號轉陣列
	$array_Bingo_Num = str2array($array_Bingo_Info['Bingo_Num'] , ",");
	
	echo "		<table cellpadding=\"0\" id='Table_Bingo_Period' data-bingo_period='{$array_Bingo_Info['Bingo_Period']}' cellspacing=\"0\" border=\"0\">\n";
	foreach( $array_Bingo_Num as $key => $value )
	{
		if( $value == $array_Bingo_Info['Bingo_Super_Num'] )
		{	$tmp_Class = "bbr";	}
		else
		{	$tmp_Class = "bbd";	}
		echo "			<td class=\"$tmp_Class\" id=\"eey$key\">$value</td>\n";
	}

//	echo "			<td class=\"bbd\" id=\"eey0\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey1\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey2\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey3\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey4\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey5\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey6\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey7\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey8\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey9\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey10\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey11\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey12\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey13\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey14\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey15\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey16\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey17\"></td>\n";
//	echo "			<td class=\"bbd\" id=\"eey18\"></td>\n";
//	echo "			<td class=\"bbr\" id=\"eey19\"></td>\n";
	echo "		</table>\n";
}
//~@_@~// END 手機Bingo獎號 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 其它
//~@_@~// START 取得登入帳號的名字 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getLoginName( $sub_Login_Name )
{
	global $link;
	/*
	範例			: $tmp_Login_Name = WinHappy_getLoginName( $sub_Login_Name ) ;		// 取得登入帳號的名字
	功能			: 取得登入帳號的名字(帳號開頭後的字串)
	修改日期		: 20200519
	參數說明 :
		$sub_Login_Name		登入帳號
	回傳參數 :
		$tmp_Login_Name		所有上線代理人資料
	使用範例 :		:
		$tmp_Login_Name = WinHappy_getLoginName( $sub_Login_Name ) ;		// 取得登入帳號的名字
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	$tmp_Login_Name = mb_substr( $sub_Login_Name , 2 , strlen($sub_Login_Name)-2 , "utf-8");
	return $tmp_Login_Name ;
}
//~@_@~// END 取得登入帳號的名字 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得查詢日期區間 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function WinHappy_getSearchDateBlock( $subFunct )
{
	global $link;
	/*
	範例			: $array_SearchDateBlock = WinHappy_getSearchDateBlock( $subFunct ) ;		// 取得查詢日期區間
	功能			: 取得查詢日期區間
	修改日期		: 20200531
	參數說明 :
		$subFunct	區間類別(today:今 天,yestoday:昨天,week:本周,prev_week:上周,month:本月,prev_month:上月)
	回傳參數 :
		$array_SearchDateBlock		區間日期
			$array_SearchDateBlock['Start']	開始日期
			$array_SearchDateBlock['End']		結束日期
	使用範例 :		:
		$array_SearchDateBlock = WinHappy_getSearchDateBlock( $subFunct ) ;		// 取得查詢日期區間
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	if( $subFunct == "yestoday" )
	{// 昨 天
		$array_StartEndDate = func_getStartEndDate( "LD" , 0 , date("Y-m-d") ) ;		// 取得開始結束日期(包含時間) ;
		$array_SearchDateBlock['Start'] = $array_StartEndDate['Start'] ;
		$array_SearchDateBlock['End'] = $array_StartEndDate['End'] ;
	}
	else if( $subFunct == "week" )
	{// 本 周
		// 
		//$tmp_Day = "2020-07-06" ;
		$tmpWeek = getDay2Week( date("Y-m-d") ) ;	//	取得日期為星期幾
		//$tmpWeek = getDay2Week( $tmp_Day ) ;	//	取得日期為星期幾
		if( $tmpWeek == 0 )
		{	$tmp_Day = getChangDay( date("Y-m-d") , "LD" , 1 ) ;	}
		else
		{	$tmp_Day = date("Y-m-d") ;	}

		$array_StartEndDate = func_getStartEndDate( "W" , 0 , $tmp_Day ) ;		// 取得開始結束日期(包含時間) ;
		$array_SearchDateBlock['Start'] = getChangDay( $array_StartEndDate['Start'] , "ND" , 1 ) ;
		$array_SearchDateBlock['End'] = getChangDay( $array_StartEndDate['End'] , "ND" , 1 ) ;
	}
	else if( $subFunct == "prev_week" )
	{// 上 周
		$tmpWeek = getDay2Week( date("Y-m-d") ) ;	//	取得日期為星期幾
		//$tmpWeek = getDay2Week( $tmp_Day ) ;	//	取得日期為星期幾
		if( $tmpWeek == 0 )
		{	$tmp_Day = getChangDay( date("Y-m-d") , "LD" , 1 ) ;	}
		else
		{	$tmp_Day = date("Y-m-d") ;	}
		$array_StartEndDate = func_getStartEndDate( "LW" , 0 , $tmp_Day ) ;		// 取得開始結束日期(包含時間) ;
		$array_SearchDateBlock['Start'] = getChangDay( $array_StartEndDate['Start'] , "ND" , 1 ) ;
		$array_SearchDateBlock['End'] = getChangDay( $array_StartEndDate['End'] , "ND" , 1 ) ;
	}
	else if( $subFunct == "month" )
	{// 本 月
		$array_StartEndDate = func_getStartEndDate( "M" , 0 , date("Y-m-d") ) ;		// 取得開始結束日期(包含時間) ;
		$array_SearchDateBlock['Start'] = $array_StartEndDate['Start'] ;
		$array_SearchDateBlock['End'] = $array_StartEndDate['End'] ;
	}
	else if( $subFunct == "prev_month" )
	{// 上 月
		$array_StartEndDate = func_getStartEndDate( "LM" , 0 , date("Y-m-d") ) ;		// 取得開始結束日期(包含時間) ;
		$array_SearchDateBlock['Start'] = $array_StartEndDate['Start'] ;
		$array_SearchDateBlock['End'] = $array_StartEndDate['End'] ;
	}
	else
	{// 今 天
		$array_SearchDateBlock['Start'] = date("Y-m-d") ;
		$array_SearchDateBlock['End'] = date("Y-m-d") ;
	}
	return $array_SearchDateBlock ;
}
//~@_@~// END 取得查詢日期區間 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

?>

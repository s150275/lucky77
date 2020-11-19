<?php
// ############ ########## ########## ############
// ## 財神九仔生-專用函式							##
// ############ ########## ########## ############
/*
載入方式:
include_once($MAIN_BASE_ADDRESS . "Project/GodNine/func_GodNine.php");

//~@_@~// START 秀出陣列資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//~@_@~// END 秀出陣列資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

V0.1
	GodNine_getMember_LastWinLostPoints()	取得會員上期輸贏點數(200806)
	GodNine_setMemberINRoomInfo()			設定會員進入房間資訊(200805)
	GodNine_getMemberFreeMmoney()			取得會員還可以使用金額(200720)
	GodNine_htmlAccount_BankerList()		取得莊家列表(200627)
	GodNine_getRoomApplyPickNum()			取得每一個房間的排莊和參與人數(200624)
	GodNine_getRoomNum()					取得房間編號(200624)
	GodNine_htmlWeekAccountDetails()		取得星期歷史帳務(200619)
	GodNine_htmlAccount_DetailsList()		取得帳務明細(200619)
	GodNine_htmlOperationRecordList()		取得操作記錄(200619)
	GodNine_htmlBingoList()					取得開獎記錄(200619)
	GodNine_getBetGodnineMoney()			取得下注相關金額(200617)
	GodNine_htmlReportInfo()				秀出報表內容(200617)
	GodNine_getAgentList()					取得所有上線代理人資料(200616)
	GodNine_ModBankerMoney()				修改莊家輸贏資料庫(20200615)
	GodNine_htmlBankerArea()				取得排莊列表(200614)
	GodNine_getUserSeatNumber()				取得閒家的選位列表(200612)
	GodNine_getMember_LastPayoutPoints()	取得會員上期派彩點數(200612)
	GodNine_htmlMember_Account_Details()	取得會員帳務明細(200612)
	GodNine_getMember_Withhold_Points()		取得會員預扣點數(200612)
	GodNine_getOtherSeatNumber()			取得本期其他人的選位列表(200611)
	GodNine_BingoDraw()						賓果開獎(200611)
	GodNine_getBingoHistory()				取得Bingo獎號資訊(209611)
	GodNine_getMemberInfo()					取得會員資料(209609)
	GodNine_sumCalculate_Multiple()			求出計算值和倍數值(200609)
	GodNine_checkMember()					限制遊戲會員存取頁面20200609)
	GodNine_readyMemberLogin()				查詢遊戲會員是否已登入(20200609)
	GodNine_SetMemberSession()				設定登入遊戲會員的SESSION(20200609)
=======================================================================================
函式順序

遊戲會員控管
	GodNine_checkMember()					限制遊戲會員存取頁面20200609)
	GodNine_readyMemberLogin()				查詢遊戲會員是否已登入(20200609)
	GodNine_SetMemberSession()				設定登入遊戲會員的SESSION(20200609)

開獎相關
	GodNine_sumCalculate_Multiple()			求出計算值和倍數值(200609)
	GodNine_getBingoHistory()				取得Bingo獎號資訊(200611)
	GodNine_ModBankerMoney()				修改莊家輸贏資料庫(20200615)
	GodNine_BingoDraw()						賓果開獎(200611)

會員相關
	GodNine_getMemberInfo()					取得會員資料(200609)
	GodNine_getMemberFreeMmoney()			取得會員還可以使用金額(200720)
	GodNine_setMemberINRoomInfo()			設定會員進入房間資訊(200805)

遊戲相關
	GodNine_getRoomNum()					取得房間編號(200624)
	GodNine_getOtherSeatNumber()			取得本期其他人的選位列表(200611)
	GodNine_getUserSeatNumber()				取得閒家的選位列表(200612)
	GodNine_getMember_Withhold_Points()		取得會員預扣點數(200612)
	GodNine_getMember_LastPayoutPoints()	取得會員上期派彩點數(200612)
	GodNine_getMember_LastWinLostPoints()	取得會員上期輸贏點數(200806)
	GodNine_htmlBankerArea()				取得排莊列表(200614)

統計報表
	GodNine_getBetGodnineMoney()			取得下注相關金額(200617)
	GodNine_htmlReportInfo()				秀出報表內容(200617)
	GodNine_htmlMember_Account_Details()	取得會員帳務明細(200612)

代理人相關
	GodNine_getAgentList()					取得所有上線代理人資料(200616)

首頁相關
	GodNine_htmlBingoList()					取得開獎記錄(200619)
	GodNine_htmlOperationRecordList()		取得操作記錄(200619)
	GodNine_htmlAccount_DetailsList()		取得帳務明細(200619)
	GodNine_htmlAccount_BankerList()		取得莊家列表(200627)
	GodNine_htmlWeekAccountDetails()		取得星期歷史帳務(200619)

其它
	GodNine_getRoomApplyPickNum()			取得每一個房間的排莊和參與人數(200624)

*/
if(!isset($_SESSION))
{	session_start();	}
//echo session_id();

// 是否遊戲會員登出系統
if( $_GET['Funct'] == "GodNineMemberLOGOUT" )
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

	alertgo("登出成功" , "login.php");
}

// 遊戲會員控管
//~@_@~// START 限制遊戲會員存取頁面 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_checkMember()
{
	/*
	範例			: GodNine_checkMember() ;		// 限制遊戲會員存取頁面
	功能			: 限制遊戲會員存取頁面
	修改日期		: 20200609、20201015
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		GodNine_checkMember() ;		// 限制遊戲會員存取頁面
	*/
	global $Conn_Website_Name;
	global $link;
	
	//echo $_SESSION['Member_ID'];
	//alertgo("{$_SESSION['Website_Name']} != $Conn_Website_Name","");
	if ($_SESSION['Website_Name'] != $Conn_Website_Name)
	{
		$_SESSION['Website_Name'] = $Conn_Website_Name ;
		$_SESSION['Member_ID'] = "" ;
	}
	
	if( !isset($_SESSION['Member_ID']) OR $_SESSION['Member_ID'] == "" )
	{
		//頁面導向
		alertgo('請先登入系統','login.php');
	}
	else
	{
		
		// 設定Cookie
		setcookie("Agent_Last_Login_Time", date("Y-m-d H:i:s") , time()+60*60*24*365);
		
		//權限關閉時直接登出系統20201015
		if($_SESSION['Member_ID']!="")
		{
			//尋找會員權限是否被關閉
			$sql = "SELECT * FROM Member WHERE Member_ID='".$_SESSION['Member_ID']."'";
			$query = mysqli_query($link , $sql) ;
			if(mysqli_num_rows($query) > 0)
			{
				$LIST = mysqli_fetch_assoc($query);
				if($LIST['Member_On'] == 0)
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

					//頁面導向
					alertgo('權限已關閉,請連絡管理者','login.php');
				}

			}
		}
				
	}
	
	
	
	
}
//~@_@~// END 限制遊戲會員存取頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢遊戲會員是否已登入 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_readyMemberLogin()
{
	/*
	範例			: GodNine_readyMemberLogin() ;		// 查詢遊戲會員是否已登入
	功能			: 查詢遊戲會員是否已登入
	修改日期		: 20200609
	參數說明 :
		無
	回傳參數 :
		無
	使用範例 :		:
		GodNine_readyMemberLogin() ;		// 查詢遊戲會員是否已登入
	*/
	global $MAIN_FILE_NAME ;
	global $Conn_Website_Name;
	
	if($_SESSION['Website_Name'] != $Conn_Website_Name)
	{
		$_SESSION['Website_Name'] = $Conn_Website_Name ;
		$_SESSION['Member_ID'] = "" ;
	}
	if( $_SESSION['Member_ID'] != "" )
	{// 已登入
		//頁面導向
		if( $MAIN_FILE_NAME == "login.php" )
		{	alertgo('','money.php');	}
		//else
		//{	alertgo('','money.php');	}
	}
}
//~@_@~// END 查詢遊戲會員是否已登入 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定登入遊戲會員的SESSION ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_SetMemberSession($LIST)
{
	/*
	範例			: GodNine_SetMemberSession( $LIST ) ;		// 設定登入遊戲會員的SESSION
	功能			: 設定登入遊戲會員的SESSION
	修改日期		: 20200609
	參數說明 :
		$LIST	: 傳入的遊戲會員資料
	回傳參數 :
		無
	使用範例 :		:
		GodNine_SetMemberSession( $LIST ) ;		// 設定登入遊戲會員的SESSION
	*/
	//存入SESSION
	$_SESSION['Member_ID'] = $LIST['Member_ID'];
	$_SESSION['Member_Name'] = $LIST['Member_Name'];
	$_SESSION['Member_On'] = $LIST['Member_On'];
}
//~@_@~// END 設定登入遊戲會員的SESSION ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 開獎相關
//~@_@~// START 求出計算值和倍數值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_sumCalculate_Multiple( $subBingo_Draw_Order_Num )
{
	/*
	範例			: $array_Calculate_Multiple = GodNine_sumCalculate_Multiple( $sunBingo_Draw_Order_Num ) ;		// 求出計算值和倍數值
	功能			: 求出計算值和倍數值
	修改日期		: 20200609
	參數說明 :
		$subBingo_Draw_Order_Num		開獎順序號碼
	回傳參數 :
		$array_Calculate_Multiple					財神九仔生計算值和倍數值
		$array_Calculate_Multiple['Calculate']		計算值
		$array_Calculate_Multiple['Multiple']		倍數值
	使用範例 :
		$array_Calculate_Multiple = GodNine_sumCalculate_Multiple( $subBingo_Draw_Order_Num ) ;		// 求出計算值和倍數值
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	$array_Bingo_Draw_Order_Num = str2array( $subBingo_Draw_Order_Num , "," );
	foreach( $array_Bingo_Draw_Order_Num as $key => $value )
	{
		// 求出10位數
		$tmp10 = mb_substr( $value , 0 , 1 , "utf-8") ;
		// 求出個位數
		$tmp1 = mb_substr( $value , 1 , 1 , "utf-8") ;

		$array_Calculate[$key] = ($tmp10 + $tmp1) % 10 ;
		if( $tmp10 == $tmp1 )
		{// 是否為配對
			$tmp_Multiple = 3 ;
			$array_Calculate[$key] = 10 ;// 設定為配對(10)
		}
		else if( $array_Calculate[$key] == 0 )// 0
		{	$tmp_Multiple = 1 ;	}
		else if( $array_Calculate[$key] <= 7 )// 1-7
		{	$tmp_Multiple = 1 ;	}
		else// 8,9
		{	$tmp_Multiple = 2 ;	}
		$array_Multiple[$key] = $tmp_Multiple ;
	}
	$array_Calculate_Multiple['Calculate'] = array2str($array_Calculate , ",") ;
	$array_Calculate_Multiple['Multiple'] = array2str($array_Multiple , ",") ;
	return $array_Calculate_Multiple ;

}
//~@_@~// END 求出計算值和倍數值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得Bingo獎號資訊 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getBingoHistory( $sub_Page = 1 , $sub_Page_Num = 10 )
{
	global $link;
	/*
	範例			: GodNine_getBingoHistory( $sub_Page , $sub_Page_Num ) ;		// 取得Bingo獎號資訊
	功能			: 取得Bingo獎號資訊
	修改日期		: 20200611
	參數說明 :
		$sub_Page		開始頁數
		$sub_Page_Num	每頁筆數
	回傳參數 :
		無
	使用範例 :
		GodNine_getBingoHistory( 1 , 5 ) ;		// 取得Bingo獎號資訊
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	$tmp_Start = ($sub_Page - 1) * $sub_Page_Num ;

	$SQL = "SELECT * FROM Bingo ORDER BY Bingo_Period DESC LIMIT $tmp_Start , $sub_Page_Num" ;
	//$SQL = "SELECT * FROM Bingo ORDER BY id_Bingo DESC LIMIT $tmp_Start , $sub_Page_Num" ;
	// SELECT * FROM Bingo ORDER BY Bingo_Period DESC LIMIT 0 , 5
	//echo $SQL . "<br>" ; 
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			$tmp_BingoDate = WinHappy_subPeriod2Date($LIST['Bingo_Period']) ;		// Bingo期號轉時間
			//$array_BingoDate = str2array( $tmp_BingoDate , " ");
			// 把秒數去掉
			$tmp_BingoDateOpen = mb_substr($tmp_BingoDate , 0 , 16 , "utf-8");
			echo "				<ul class=\"bingoList\">\n";
			echo "					<li class=\"bingoList_title\"><strong>開獎時間 : {$tmp_BingoDateOpen} 開獎期數 : {$LIST['Bingo_Period']}</strong></li>\n";
			$array_Bingo_Draw_Order_Num = str2array( $LIST['Bingo_Draw_Order_Num'] , "," );
			$array_Bingo_Godnine_Calculate = str2array( $LIST['Bingo_Godnine_Calculate'] , "," );
			foreach( $array_Bingo_Draw_Order_Num as $key => $value )
			{
				echo "					<li class=\"bingoList_item\">\n";
				echo "						<span class=\"bingo_number\">{$array_Bingo_Draw_Order_Num[$key]}</span>\n";
				if( $array_Bingo_Godnine_Calculate[$key] == 10 )
				{	$array_Bingo_Godnine_Calculate[$key] = $array_Bingo_Draw_Order_Num[$key];}
				echo "						<span class=\"bingo_point\">{$array_Bingo_Godnine_Calculate[$key]}</span>\n";
				echo "					</li>\n";
			}
			echo "				</ul>\n";
					}
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
}
//~@_@~// END 取得Bingo獎號資訊 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 修改莊家輸贏資料庫 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_ModBankerMoney($array_ModBankerMoney)
{
	global $link;
	/*
	範例			: GodNine_ModBankerMoney() ;		// 修改莊家輸贏資料庫
	功能			: 修改莊家輸贏資料庫
	修改日期		: 20200615
	參數說明 :
		$array_ModBankerMoney		傳入的資料陣列
			$array_ModBankerMoney['Bamker_Withhold_Money']		預扣金額
			$array_ModBankerMoney['Bamker_AllMoney']			莊家最後需處理的金額
			$array_ModBankerMoney['Bamker_AllMoney_Banker_ID']	設定要處理的莊家ID
			$array_ModBankerMoney['Bamker_Log']					莊家處理金額Log,把每筆下注都加到Log中
			$array_ModBankerMoney['id_Banker']					當莊資料id
	回傳參數 :
		無
	使用範例 :
		GodNine_ModBankerMoney($array_ModBankerMoney) ;		// 修改莊家輸贏資料庫
	*/
	$tmpShowMsg = 1 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	// 要修改的會員金額-一定大於0
	
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>修改莊家輸贏資料庫-傳入的資料陣列({$array_ModBankerMoney['Bamker_AllMoney_Banker_ID']}) GodNine_ModBankerMoney()</p>" ;print_r($array_ModBankerMoney);echo "<br>" ;	}

	// 現在會員資料
	$array_Member_Now_Info = GodNine_getMemberInfo( $array_ModBankerMoney['Bamker_AllMoney_Banker_ID'] ) ;		// 取得會員資料
	
	$tmp_Member_Money = $array_ModBankerMoney['Bamker_Withhold_Money'] + $array_ModBankerMoney['Bamker_AllMoney'] ;

	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>設定莊家金額($tmp_Member_Money) = 預扣金額({$array_ModBankerMoney['Bamker_Withhold_Money']}) + 莊家最後需處理的金額({$array_ModBankerMoney['Bamker_AllMoney']})</p>" ;	}

	// 修改莊家點數
	$tmpSQL = "UPDATE Member SET Member_Money = Member_Money + $tmp_Member_Money WHERE Member_ID = '{$array_ModBankerMoney['Bamker_AllMoney_Banker_ID']}'" ;				// 欄位值+1
	$Bol = func_DatabaseBase( $tmpSQL , "SQL" , "" , "" ) ;									// 資料庫處理
	if ( $Bol )
	{
		$array_Member_Banker_Info = GodNine_getMemberInfo( $array_ModBankerMoney['Bamker_AllMoney_Banker_ID'] ) ;		// 取得會員資料
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "GodNine_ModBankerMoney()-修改莊家輸贏資料庫-資料執行成功<br>$tmpSQL" ;	}

		// 設定當莊輸贏資料
		$arrayField_Banker['Banker_WinLost_Money'] = $array_ModBankerMoney['Bamker_AllMoney'] ;		// 莊家輸贏金額
		$arrayField_Banker['Banker_WinLost_AllMoney'] = $tmp_Member_Money ;	// 輸贏總金額 = 預扣金額 + 莊家輸贏金額
		//$arrayField_Banker['Banker_Log'] = $array_ModBankerMoney['Bamker_Log'] ;				// 莊家Log
		$arrayField_Banker['Banker_Log'] = "會員原始點數:{$array_Member_Now_Info['Member_Money']}\n會員當莊後點數:{$array_Member_Banker_Info['Member_Money']}\n輸贏記錄\n" . $array_ModBankerMoney['Bamker_Log'] ;				// 莊家Log
		$arrayField_Banker['Banker_Return_State'] = 1 ;				// 還回狀態 0||未還回||1||已還回:
		$Bol_Banker = func_DatabaseBase( "Banker" , "MOD" , $arrayField_Banker , " id_Banker = '{$array_ModBankerMoney['id_Banker']}'" ) ;						// 資料庫處理

		if( $Bol_Banker )
		{
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<p>GodNine_ModBankerMoney()-設定當莊輸贏資料-成功{$array_ModBankerMoney['id_Banker']}</p>" ;print_r($arrayField_Banker);echo "<br>" ;	}
		}
		else
		{
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<p>GodNine_ModBankerMoney()-設定當莊輸贏資料-失敗</p>" ;print_r($arrayField_Banker);echo "<br>" ;	}
		}
		

		// 找出莊家會員資料
		//$array_Member_Info = GodNine_getMemberInfo( $array_ModBankerMoney['Bamker_AllMoney_Banker_ID'] ) ;		// 取得會員資料
		// 加入金額Log
		$arrayField_MoneyLog['MoneyLog_Set_ID'] = $array_ModBankerMoney['Bamker_AllMoney_Banker_ID'] ;			// 設定者ID
		$arrayField_MoneyLog['MoneyLog_Class'] = 1 ;									// 操作分類#::SELECT:2||1||會員||2||代理人::
		$arrayField_MoneyLog['MoneyLog_Type'] = 5 ;										// 操作動作#::SELECT:2||0||其它||1||遊戲投注||2||遊戲派彩||3||存入||4||提出||5||莊家派彩:
		$arrayField_MoneyLog['MoneyLog_Bet_ID'] = "" ;									// 下注訂單號
		$arrayField_MoneyLog['MoneyLog_Money'] = $tmp_Member_Money ;					// 操作金額
		$arrayField_MoneyLog['MoneyLog_Original_Money'] = $array_Member_Now_Info['Member_Money'] ;	// 操作前金額
		$arrayField_MoneyLog['MoneyLog_Operator_IP'] = "" ;								// 操作者IP
		$arrayField_MoneyLog['MoneyLog_Operator_ID'] = ""	 ;							// 操作者ID
		$arrayField_MoneyLog['MoneyLog_Operator_Name'] = "系統排程" ;						// 操作者名稱
		$arrayField_MoneyLog['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;					// 操作時間
		
		$Bol_MoneyLog = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField_MoneyLog , "" ) ;						// 資料庫處理
		if( $Bol_MoneyLog )
		{
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<p>GodNine_ModBankerMoney()-加入金額Log-成功</p>" ;print_r($arrayField_MoneyLog);echo "<br>" ;	}
		}
		else
		{
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<p>GodNine_ModBankerMoney()-加入金額Log-失敗</p>" ;print_r($arrayField_MoneyLog);echo "<br>" ;	}
		}

	}
	else
	{
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "修改莊家輸贏資料庫-資料執行失敗<br>$tmpSQL" ;	}
	}
	
}
//~@_@~// END 修改莊家輸贏資料庫 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 賓果開獎 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_BingoDraw( $subBankerNoPay = 1 )
{
	global $link;
	global $Conn_WebKey;
	/*
	範例			: GodNine_BingoDraw() ;		// 賓果開獎
	功能			: 賓果開獎
	修改日期		: 20200611
	參數說明 :
		$sub_Page		開始頁數
		$sub_Page_Num	每頁筆數
		$subBankerNoPay	給莊家錢(1:給,0:不給)
	回傳參數 :
		無
	使用範例 :
		GodNine_BingoDraw() ;		// 賓果開獎
	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>GodNine_BingoDraw() 賓果開獎 開始</p>" ;	}

	// 已讀過的開獎Bingo期號
	$array_Bingo_Period = array();
	// 目前處理的開獎Bingo期號
	$tmp_Now_Bingo_Period = "" ;
	// 目前處理的當莊房間
	$tmp_Now_Banker_Room = "" ;
	
	// 找出所有沒有開獎的下注資料,依
	$SQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Draw = '0' AND BetGodnine_On = '1' ORDER BY BetGodnine_Bingo_Period , BetGodnine_Room DESC , id_BetGodnine DESC" ;

	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>找出所有沒有開獎的下注資料<br>$SQL</p><hr>" ;	}
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		$tmp_Index = 0 ;	// 索引
		$tmp_Has_Data = 0 ;	// 是否要寫入資料庫,只有在改變Bingo期號和換房間時才要寫入資料庫
		$tmp_BankerLog = "" ;			// 初始莊家Log資料
		$tmp_BankerLog_Money = 0 ;		// 初始莊家小計

		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{// START while 找出所有未開獎的下注資料
			
			echo "<p>\$tmp_Index - $tmp_Index : {$LIST['id_BetGodnine']} , $Old_BetGodnine_Type , $Old_id_BetGodnine , $Old_BetGodnine_Bingo_Period , $Old_BetGodnine_Room</p>" ;
			// 初始資料
			$tmp_Banker_Backwater_Money = 0 ;	// 莊家返水金額
			$tmp_Banker_WinLost_AllMoney = 0 ;	// 莊家輸贏總金額
			$tmp_Banker_WinLost_Money = 0;		// 莊家輸贏金額
			$tmp_Banker_Proportion = 0 ;		// 莊家占成
			$tmp_Banker_Backwater_Ratio = 0 ;	// 莊家返水比
			$tmp_Banker_Report_Money = 0 ;		// 莊家報帳金額
			$tmp_User_WinLost_Money = 0 ;		// 閒家應付金額
			$tmp_Return_User_Money = 0 ;		// 閒家還回金額
			$tmp_Member_Proportion = 0;			// 會員下注占成 = 代理人占成
			$tmp_Member_Backwater_Ratio = 0 ;	// 會員下注返水比 = 代理人返水
			$tmp_Member_WinLost_Money = 0  ;	// 會員下注輸贏金額
			$tmp_Member_Backwater_Money = 0 ;	// 會員下注返水金額
			$tmp_Member_WinLost_AllMoney = 0 ;	// 會員下注總金額
			$tmp_Member_Report_Money = 0;		// 會員下注報帳金額

			// 取得會員資料
			$array_Member_Info = GodNine_getMemberInfo( $LIST['BetGodnine_Member_ID'] ) ;
			// 取得會員代理人資料
			$array_Agent_Info = WinHappy_getAgentInfo( $array_Member_Info['Member_Father_ID'] ) ;		// 取得代理人資料
			//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			//{	echo "<p>會員代理人資料</p>" ;print_r($array_Agent_Info);echo "<br>" ;	}
			

			// 取出該期Bingo資料
			$array_Bingo_Info = func_DatabaseGet( "Bingo" , "*", array("Bingo_Period"=>$LIST['BetGodnine_Bingo_Period']) ) ;		// 取得資料庫資料

			// 是否已取得Bingo資料
			if( empty($array_Bingo_Info['Bingo_Period']) )
			{
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "此期號還沒有Bingo開獎資料<br>" ;	}
				$tmp_Now_Bingo_Period = "" ;
				continue;
			}

			if ( $tmpShowMsg or 1 )	// 秀出除錯訊息 ██████████
			{	echo "<p>該期Bingo資料-\$array_Bingo_Info</p>" ;print_r($array_Bingo_Info);echo "<br>" ;	}

			// 設定新的Bingo參數
			unset($array_Bingo_Draw_Order_Num);
			unset($array_Bingo_Godnine_Calculate);
			unset($array_Bingo_Godnine_Multiple);
			$array_Bingo_Draw_Order_Num = str2array( $array_Bingo_Info['Bingo_Draw_Order_Num'] , "," );
			$array_Bingo_Godnine_Calculate = str2array( $array_Bingo_Info['Bingo_Godnine_Calculate'] , "," );
			$array_Bingo_Godnine_Multiple = str2array( $array_Bingo_Info['Bingo_Godnine_Multiple'] , "," );
			
			if ( $tmpShowMsg or 1 )	// 秀出除錯訊息 ██████████
			{
				echo "<p>開獎順序號碼-\$array_Bingo_Draw_Order_Num</p>" ;print_r($array_Bingo_Draw_Order_Num);echo "<br>" ;
				echo "<p>計算值-\$array_Bingo_Godnine_Calculate</p>" ;print_r($array_Bingo_Godnine_Calculate);echo "<br>" ;
				echo "<p>倍數值-\$array_Bingo_Godnine_Multiple</p>" ;print_r($array_Bingo_Godnine_Multiple);echo "<br>" ;
			}

			// 換一期開獎
			if( $tmp_Now_Bingo_Period != $LIST['BetGodnine_Bingo_Period'] )
			{
				echo "換一期開獎 : $tmp_Now_Bingo_Period != {$LIST['BetGodnine_Bingo_Period']}<br>" ;

				if( $tmp_Index != 0 ) $tmp_Has_Data = 1 ;	// 是否要寫入資料庫,只有在改變Bingo期號和換房間時才要寫入資料庫
				// 清空房間資料,重新計算
				$tmp_Now_Banker_Room = "" ;
				
				$tmp_Now_Bingo_Period = $LIST['BetGodnine_Bingo_Period'] ;

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "目前下注期號 : $tmp_Now_Bingo_Period<br>" ;	}

//				// 取出該期Bingo資料
//				$array_Bingo_Info = func_DatabaseGet( "Bingo" , "*", array("Bingo_Period"=>$tmp_Now_Bingo_Period) ) ;		// 取得資料庫資料
//
//				// 是否已取得Bingo資料
//				if( empty($array_Bingo_Info['Bingo_Period']) )
//				{
//					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
//					{	echo "此期號還沒有Bingo開獎資料<br>" ;	}
//					$tmp_Now_Bingo_Period = "" ;
//					continue;
//				}
//
//				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
//				{	echo "<p>該期Bingo資料-\$array_Bingo_Info</p>" ;print_r($array_Bingo_Info);echo "<br>" ;	}
//
//				// 設定新的Bingo參數
//				unset($array_Bingo_Draw_Order_Num);
//				unset($array_Bingo_Godnine_Calculate);
//				unset($array_Bingo_Godnine_Multiple);
//				$array_Bingo_Draw_Order_Num = str2array( $array_Bingo_Info['Bingo_Draw_Order_Num'] , "," );
//				$array_Bingo_Godnine_Calculate = str2array( $array_Bingo_Info['Bingo_Godnine_Calculate'] , "," );
//				$array_Bingo_Godnine_Multiple = str2array( $array_Bingo_Info['Bingo_Godnine_Multiple'] , "," );
//				
//				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
//				{
//					echo "<p>開獎順序號碼-\$array_Bingo_Draw_Order_Num</p>" ;print_r($array_Bingo_Draw_Order_Num);echo "<br>" ;
//					echo "<p>計算值-\$array_Bingo_Godnine_Calculate</p>" ;print_r($array_Bingo_Godnine_Calculate);echo "<br>" ;
//					echo "<p>倍數值-\$array_Bingo_Godnine_Multiple</p>" ;print_r($array_Bingo_Godnine_Multiple);echo "<br>" ;
//				}
			}
			//相同期號
			
			// 如果為長莊區-----------------------------
			if( $LIST['BetGodnine_Type'] == 1 )
			{
				$tmpSQL_Banker = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$LIST['BetGodnine_Bingo_Period']}' AND Banker_Room = '{$LIST['BetGodnine_Room']}'" ;
				echo "<h1>取得莊家資料 : $tmpSQL_Banker</h1>" ;
				$array_Banker_Info = func_DatabaseGet( $tmpSQL_Banker , "SQL" , "" ) ;		// 取得資料庫資料

				echo "<p>取得莊家資料</p>" ;print_r($array_Banker_Info);echo "<br>" ;

				// 莊家-預扣金額
				$tmp_Bamker_Withhold_Money = $array_Banker_Info['Banker_Withhold_Money'] ;
				// 莊家-設定此莊家輸贏金額
				$tmp_Bamker_AllMoney = 0 ;
				// 莊家-設定此莊家的Member_ID
				$tmp_Bamker_AllMoney_Banker_ID = $array_Banker_Info['Banker_Set_ID'] ;
				// 莊家-莊家處理點數Log,把每筆下注都加到Log中
				$tmp_Bamker_Log = "莊家資料:{$array_Banker_Info['Banker_Set_ID']}\n" ;
				// 設定此莊家設定的id
				$tmp_Bamker_id_Banker = $array_Banker_Info['id_Banker'] ;


				if ( $tmpShowMsg or 1)	// 秀出除錯訊息 ██████████
				{	echo "<h2>該期當莊資料-\$array_Banker_Info</h2><p>$tmpSQL_Banker</p>" ;print_r($array_Banker_Info);echo "<br><br>" ;	}

				// 莊家選取的桌號
				$tmp_Banker_Table = $array_Banker_Info['Banker_Banker_Table'] ;

				// 取出該期的莊主選位的計算值-內定20
				$tmp_Banker_Calculate = $array_Bingo_Godnine_Calculate[$tmp_Banker_Table-1];

				echo "莊家計算值 : {$array_Banker_Info['Banker_Banker_Table']} - $tmp_Banker_Calculate<br>" ;
			}

			// 是否相同房間
			if( $tmp_Now_Banker_Room != $LIST['BetGodnine_Room'] )
			{// START 不是相同房間-寫入莊家資料
				echo "不是相同房間 : $tmp_Now_Banker_Room != {$LIST['BetGodnine_Room']}<br>" ;
				if( empty($tmp_Now_Banker_Room) )
				{
					// 設定新房間
					$tmp_Now_Banker_Room = $LIST['BetGodnine_Room'] ;
				}
				
				// 求出該期當莊資料
				// 如果為長莊區-----------------------------
				if( $LIST['BetGodnine_Type'] == 2 )
				{// 長莊區-當莊資料
				if( $Old_BetGodnine_Type == 1 AND $LIST['BetGodnine_Type'] == 2 )
				{	$tmp_Has_Data = 1 ;	}
					// 取出該期的莊主選位的計算值-內定20
					$tmp_Banker_Calculate = $array_Bingo_Godnine_Calculate[13];
					// 莊家選取的桌號
					$tmp_Banker_Table = 14 ;
					// 設定長莊-手續費退水Key
					$tmp_Agent_Backwater_Key = "W2" ;
				}
				else// 如果為輸莊區
				{// 輸莊區-當莊資料
					// 設定輸莊-手續費退水Key
					$tmp_Agent_Backwater_Key = "W" ;

//				$Old_BetGodnine_Type = $LIST['BetGodnine_Type'] ;
//				$Old_id_BetGodnine = $LIST['id_BetGodnine'] ;
//				$Old_BetGodnine_Room = $LIST['BetGodnine_Room'] ;
//				$Old_BetGodnine_Bingo_Period = $LIST['BetGodnine_Bingo_Period'] ;
					// 取得莊家資料
//					$tmpSQL_Banker = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '$tmp_Now_Bingo_Period' AND Banker_Room = '$tmp_Now_Banker_Room'" ;
//					echo "<h1>取得莊家資料 : $tmpSQL_Banker</h1>" ;
//					$array_Banker_Info = func_DatabaseGet( $tmpSQL_Banker , "SQL" , "" ) ;		// 取得資料庫資料
//	
//					// 莊家-預扣金額
//					$tmp_Bamker_Withhold_Money = $array_Banker_Info['Banker_Withhold_Money'] ;
//					// 莊家-設定此莊家輸贏金額
//					$tmp_Bamker_AllMoney = 0 ;
//					// 莊家-設定此莊家的Member_ID
//					$tmp_Bamker_AllMoney_Banker_ID = $array_Banker_Info['Banker_Set_ID'] ;
//					// 莊家-莊家處理點數Log,把每筆下注都加到Log中
//					$tmp_Bamker_Log = "莊家資料:{$array_Banker_Info['Banker_Set_ID']}\n" ;
//					// 設定此莊家設定的id
//					$tmp_Bamker_id_Banker = $array_Banker_Info['id_Banker'] ;
//
					if( $tmp_Index != 0 )
					{// 非第一筆下注資料
						$tmp_Has_Data = 1 ;	// 是否要寫入資料庫,只有在改變Bingo期號和換房間時才要寫入資料庫
						// 設定要寫入閒家資料庫參數
						// 預扣金額-不預扣
						//$array_ModBankerMoney['Bamker_Withhold_Money'] = $tmp_Bamker_Withhold_Money;
						$array_ModBankerMoney['Bamker_Withhold_Money'] = 0;
						// 莊家最後需處理的點數(內定為每次做莊預扣點數)
						$array_ModBankerMoney['Bamker_AllMoney'] = $tmp_BankerLog_Money ;
						//$array_ModBankerMoney['Bamker_AllMoney'] = $sum_Banker_WinLost_Money ;
						// 設定要處理的莊家ID
						$array_ModBankerMoney['Bamker_AllMoney_Banker_ID'] = $tmp_Bamker_AllMoney_Banker_ID ;
						// 莊家處理點數Log,把每筆下注都加到Log中
						$array_ModBankerMoney['Bamker_Log'] = $tmp_BankerLog ;
						// 當莊資料id
						$array_ModBankerMoney['id_Banker'] = $tmp_Bamker_id_Banker ;
						
						//$tmp_BankerLog_Money = 0 ;		// 清空莊家小計

		
						// 莊家Log開始
						//$tmp_BankerLog = "做莊預扣金額 : {$array_Banker_Info['Banker_Withhold_Money']}\n" ;		// 莊家處理點數Log,把每筆下注都加到Log中
					}
//
//	
//					if ( $tmpShowMsg or 1)	// 秀出除錯訊息 ██████████
//					{	echo "<h2>該期當莊資料-\$array_Banker_Info</h2><p>$tmpSQL_Banker</p>" ;print_r($array_Banker_Info);echo "<br><br>" ;	}
//	
//					// 莊家選取的桌號
//					$tmp_Banker_Table = $array_Banker_Info['Banker_Banker_Table'] ;
//	
//					// 取出該期的莊主選位的計算值-內定20
//					$tmp_Banker_Calculate = $array_Bingo_Godnine_Calculate[$tmp_Banker_Table-1];
				}// END 輸莊區-當莊資料
				// 設定新房間
				$tmp_Now_Banker_Room = $LIST['BetGodnine_Room'] ;
			}// END 不是相同房間-寫入莊家資料

			// 寫入莊家資料-長莊區不用寫
			if( $tmp_Has_Data == 1 )
			{// 是否有資料要寫入莊家資料
				if ( $tmpShowMsg or 1 )	// 秀出除錯訊息 ██████████
				{
					echo "<p>{$LIST['BetGodnine_ID']}寫入莊家LOG資料-\$tmp_BankerLog</p>" . nl2br($tmp_BankerLog) ;
					echo "<p>寫入莊家資料</p>" ;print_r($array_ModBankerMoney);echo "<br>" ;
				}

				// 給莊家錢(1:給,0:不給)
				if( $subBankerNoPay )
				{
					if( empty($array_ModBankerMoney) or 1)
					{
						// 分析LOG
						$array_Banke_Log = str2array($tmp_BankerLog , "\n");

						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<p>分析LOG</p>" ;print_r($array_Banke_Log);echo "<br>" ;	}
						$array_LogField = str2array($array_Banke_Log[0] , ",");
						$array_LogField_id = str2array($array_LogField[0] , ":");

						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "id : {$array_LogField_id[1]}<br>" ;	}
	
						$array_BetGodnine_Info1 = func_DatabaseGet( "BetGodnine" , "*" , array("id_BetGodnine"=>"{$array_LogField_id[1]}") ) ;		// 取得資料庫資料

						$tmpSQL_Banker1 = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$array_BetGodnine_Info1['BetGodnine_Bingo_Period']}' AND Banker_Room = '{$array_BetGodnine_Info1['BetGodnine_Room']}'" ;

						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<h1>$Old_id_BetGodnine - 取得莊家資料1 : $tmpSQL_Banker1</h1>" ;	}
						$array_Banker_Info1 = func_DatabaseGet( $tmpSQL_Banker1 , "SQL" , "" ) ;		// 取得資料庫資料

						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<p>取得莊家資料1</p>" ;print_r($array_Banker_Info1);echo "<br>" ;	}
						
						$array_ModBankerMoney['Bamker_Withhold_Money'] = 0;
						// 莊家最後需處理的點數(內定為每次做莊預扣點數)
						$array_ModBankerMoney['Bamker_AllMoney'] = $tmp_BankerLog_Money ;
						//$array_ModBankerMoney['Bamker_AllMoney'] = $sum_Banker_WinLost_Money ;
						// 設定要處理的莊家ID
						$array_ModBankerMoney['Bamker_AllMoney_Banker_ID'] = $array_Banker_Info1['Banker_Set_ID'] ;
						// 莊家處理點數Log,把每筆下注都加到Log中
						$array_ModBankerMoney['Bamker_Log'] = $tmp_BankerLog ;
						// 當莊資料id
						$array_ModBankerMoney['id_Banker'] = $array_Banker_Info1['id_Banker'] ;

						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
						{	echo "<p>設定莊家資料</p>" ;print_r($array_ModBankerMoney);echo "<br>" ;	}
						
					}
//$Old_BetGodnine_Type = $LIST['BetGodnine_Type'] ;
//$Old_id_BetGodnine = $LIST['id_BetGodnine'] ;
//$Old_BetGodnine_Room = $LIST['BetGodnine_Room'] ;
//$Old_BetGodnine_Bingo_Period = $LIST['BetGodnine_Bingo_Period'] ;

					if( !empty($array_ModBankerMoney['Bamker_AllMoney']) )
					{
						 echo "<h1>修改莊家輸贏資料庫-------</h1>";
						// 修改莊家資料庫
						GodNine_ModBankerMoney( $array_ModBankerMoney ) ;		// 修改莊家輸贏資料庫

						$tmp_BankerLog_Money = 0 ;		// 清空莊家小計
					}
				}
				
				// 清空莊家金額
				$sum_Banker_WinLost_Money = 0 ;
				$tmp_BankerLog_Money = 0 ;		// 清空莊家小計
				$tmp_BankerLog = "" ;			// 清空莊家資料
				
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>修改莊家資料庫-\$array_ModBankerMoney</p>" ;echo Public_ShowArray( $array_ModBankerMoney );	}

				// 清空莊家資料庫
				if( $array_ModBankerMoney['Bamker_AllMoney_Banker_ID'] )
				{	unset($array_ModBankerMoney);	}
				$tmp_Has_Data = 0;
				
			}

			// 閒家下注計算值
			$tmp_Bet_Calculate = $array_Bingo_Godnine_Calculate[$LIST['BetGodnine_Table']-1] ;

			// 閒家Log開始
			$tmp_Log = "下注單號 : {$LIST['BetGodnine_ID']}\n" ;
			$tmp_Log .= "下注會員ID : {$LIST['BetGodnine_Member_ID']} , 下注會員名稱 : {$array_Member_Info['Member_Name']}\n" ;
			$tmp_Log .= "下注佔位號  : {$LIST['BetGodnine_Num']} , 下注下注桌號 : {$LIST['BetGodnine_Table']} , 下注佔位椅子 : {$LIST['BetGodnine_Chair']}\n" ;
			$tmp_Log .= "莊家選取值 : {$array_Bingo_Draw_Order_Num[$tmp_Banker_Table-1]} , 閒家選取值 : {$array_Bingo_Draw_Order_Num[$LIST['BetGodnine_Table']-1]}\n" ;
			$tmp_Log .= "莊計算值 : $tmp_Banker_Calculate , 下注計算值 : $tmp_Bet_Calculate\n" ;
			$tmp_Log .= "下注區 : {$LIST['BetGodnine_Type']}\n" ;

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<h2>下注相關資料:</h2>" . nl2br($tmp_Log) . "<br>" ;	}
			$tmp_UserLog = $tmp_Log ;

			// 找出莊家和閒家的index
			// 設定莊和閒的輸贏賠率
			if( $LIST['BetGodnine_Type'] == 2 )
			{// 長莊無數區
				$tmp_Multiple = 1 ;
				$array_Banker_Odds['Banker'] = 1 ;
				$array_Banker_Odds['User'] = 1 ;
				if( $Conn_WebKey == "asia17888" )
				{// 大陸九仔生
					$tmp_Backwater_Ratio = 0.03 ;	// 手續費比例 : 所嬴籌碼 3%
				}
				else
				{// 財神九仔生
					$tmp_Backwater_Ratio = 0.05 ;	// 手續費比例 : 所嬴籌碼 3%
				}

				$tmp_Log = "設定長莊無數區的輸贏賠率:\n" ;
				$tmp_Log .= "莊家輸贏賠率 : {$array_Banker_Odds['Banker']}\n" ;
				$tmp_Log .= "閒家輸贏賠率 : {$array_Banker_Odds['User']}\n" ;
				$tmp_Log .= "手續費比例 : $tmp_Backwater_Ratio\n" ;
			}
			else
			{// 輪莊有倍數區
				$tmp_Multiple = $array_Bingo_Godnine_Multiple[$tmp_Banker_Table-1] ;
				$array_Banker_Odds['Banker'] = $tmp_Multiple ;
				$array_Banker_Odds['User'] = $array_Bingo_Godnine_Multiple[$LIST['BetGodnine_Table']-1] ;
				$tmp_Backwater_Ratio = 0.03 ;	// 手續費比例 : 所嬴籌碼 5%

				$tmp_Log = "設定輪莊有倍數區的輸贏賠率:\n" ;
				$tmp_Log .= "莊家輸贏賠率({$array_Bingo_Draw_Order_Num[$tmp_Banker_Table-1]} / $tmp_Banker_Calculate) : {$array_Banker_Odds['Banker']}\n" ;
				$tmp_Log .= "閒家輸贏賠率({$array_Bingo_Draw_Order_Num[$LIST['BetGodnine_Table']-1]} / $tmp_Bet_Calculate) : {$array_Banker_Odds['User']}\n" ;
				$tmp_Log .= "手續費比例 : $tmp_Backwater_Ratio\n" ;
			}

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<h2>賠率,手續費設定:</h2>" . nl2br($tmp_Log) . "<br>" ;	}
			
			
			// 比對計算值的大小-計算莊閒輸贏
			if( $tmp_Bet_Calculate == 0 )
			{// 閒家輸 , 莊家贏
				$tmp_Log = "莊家贏($tmp_Banker_Calculate) , 閒家輸($tmp_Bet_Calculate)\n" ;
				$tmp_WinLost_Name = "Banker" ;	// 設定輸贏者
			}
			else if( $tmp_Bet_Calculate > $tmp_Banker_Calculate )
			{// 閒家贏 , 莊家輸
				$tmp_Log = "莊家輸($tmp_Banker_Calculate) , 閒家贏($tmp_Bet_Calculate)\n" ;
				$tmp_WinLost_Name = "User" ;	// 設定輸贏者
			}
			else if( $tmp_Bet_Calculate == $tmp_Banker_Calculate )
			{// 莊閒相同,比值
			// 如果計算值相同要比各自10位數和個位數取大值為勝,如果相同(如:45和54,則莊家勝)
				$tmp_Log = "莊($tmp_Banker_Calculate),閒($tmp_Bet_Calculate)相同,比選取值\n" ;

				// 求出莊閒的選球數值來比大小
				$tmp_Banker_Bingo_Num = $array_Bingo_Draw_Order_Num[$tmp_Banker_Table-1];

				// 分析位數
				if( $tmp_Banker_Bingo_Num < 10 )
				{	$Banker_TopNum = (int)$tmp_Banker_Bingo_Num ;	}
				else
				{
					$Banker_TopNum1 = mb_substr($tmp_Banker_Bingo_Num , 0 , 1,"utf-8") ;	// 10位
					$Banker_TopNum2 = mb_substr($tmp_Banker_Bingo_Num , 1 , 1,"utf-8") ;	// 個位

					$Banker_TopNum1 > $Banker_TopNum2 ? $Banker_TopNum = $Banker_TopNum1 : $Banker_TopNum = $Banker_TopNum2 ;
				}

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>莊家分析位數最大值 : $Banker_TopNum</p>" ;	}
				
				$tmp_Bet_Bingo_Num = $array_Bingo_Draw_Order_Num[$LIST['BetGodnine_Table']-1];
				// 分析位數
				if( $tmp_Bet_Bingo_Num < 10 )
				{	$Member_TopNum = (int)$tmp_Bet_Bingo_Num ;	}
				else
				{
					$Member_TopNum1 = mb_substr($tmp_Bet_Bingo_Num , 0 , 1,"utf-8") ;	// 10位
					$Member_TopNum2 = mb_substr($tmp_Bet_Bingo_Num , 1 , 1,"utf-8") ;	// 個位
					$Member_TopNum1 > $Member_TopNum2 ? $Member_TopNum = $Member_TopNum1 : $Member_TopNum = $Member_TopNum2 ;
				}
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>閒家分析位數最大值 : $Member_TopNum</p>" ;	}
				
				if( $Banker_TopNum >= $Member_TopNum )
				{// 閒家輸 , 莊家贏
					$tmp_Log .= "莊家贏($Banker_TopNum) , 閒家輸($Member_TopNum)\n" ;
					$tmp_WinLost_Name = "Banker" ;	// 設定輸贏者
				}
				else
				{// 閒家贏 , 莊家輸
					$tmp_Log .= "莊家輸($Banker_TopNum) , 閒家贏($Member_TopNum)\n" ;
					$tmp_WinLost_Name = "User" ;	// 設定輸贏者
				}
			}
			else
			{// 莊家贏 , 閒家輸
				$tmp_Log = "莊家贏($tmp_Banker_Calculate) , 閒家輸($tmp_Bet_Calculate)\n" ;
				$tmp_WinLost_Name = "Banker" ;	// 設定輸贏者
			}

			if ( $tmpShowMsg or 1)	// 秀出除錯訊息 ██████████
			{	echo "<h2>莊閒輸贏狀態:</h2><p>" . nl2br($tmp_Log) . "</p>" ;	}
			$tmp_UserLog = $tmp_Log ;
			
			// 求出贏家倍數值
			$tmp_Multiple = $array_Banker_Odds[$tmp_WinLost_Name] ;
			// 計算原始輸贏金額(中獎金額)
			$tmp_Original_WinLost_Money = $LIST['BetGodnine_Chips'] * $tmp_Multiple ;

			echo "計算原始輸贏金額(中獎金額) $tmp_Original_WinLost_Money = {$LIST['BetGodnine_Chips']} * $tmp_Multiple<br>" ;

			// 返水金額 = 原始輸贏金額 * 手續費比例(由贏家付)
			$tmp_Backwater_Money = $tmp_Original_WinLost_Money * $tmp_Backwater_Ratio ;
			// 計算真正輸贏金額
			$tmp_WinLost_Money = $tmp_Original_WinLost_Money - $tmp_Backwater_Money ;

			$tmp_Log = "下注籌碼 :{$LIST['BetGodnine_Chips']}\n" ;
			$tmp_Log .= "下注預扣金額 :{$LIST['BetGodnine_Withhold_Chips']}\n" ;
			$tmp_Log .= "輸贏倍數 : {$array_Banker_Odds[$tmp_WinLost_Name]}\n" ;
			$tmp_Log .= "原始輸贏金額(中獎金額)($tmp_Original_WinLost_Money) = 下注籌碼({$LIST['BetGodnine_Chips']}) * 輸贏倍數({$array_Banker_Odds[$tmp_WinLost_Name]})\n" ;
			$tmp_Log .= "手續費比例 : $tmp_Backwater_Ratio\n" ;
			$tmp_Log .= "返水金額(由贏家付)($tmp_Backwater_Money) = 原始輸贏金額($tmp_Original_WinLost_Money) * 手續費比例($tmp_Backwater_Ratio)\n" ;

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<h2>下注相關設定:</h2>" . nl2br($tmp_Log) . "<br>" ;	}
			$tmp_UserLog = $tmp_Log ;

			// 清空閒家上線資料
			unset($array_AgentList) ;
			unset($array_WinLost_Money) ;
			unset($array_AllMoney) ;
			unset($array_Backwater_Money) ;
			unset($array_Reported_Money) ;
			
			// 取得所有閒家上線代理人資料
			$array_AgentList = GodNine_getAgentList( $LIST['BetGodnine_Agent_ID'] , "A" ) ;		// 取得所有上線代理人資料
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{
				echo "<h2>取得閒家上線'名稱','返水比','分成比','id'資料</h2>" ;
				unset($array_Member_Info['Member_Log']);
				echo "<p>閒家資料:{$array_Member_Info['y_Member_ID']}</p>" ;print_r($array_Member_Info);echo "<br><br>" ;
				echo "<p>閒家代理人資料:{$LIST['BetGodnine_Agent_ID']}</p>" ;
				echo "<p>閒家上線名稱</p>" ;print_r($array_AgentList['N']);echo "<br><br>" ;
				echo "<p>閒家上線手續費退水比</p>" ;print_r($array_AgentList[$tmp_Agent_Backwater_Key]);echo "<br><br>" ;
				echo "<p>閒家上線長莊輸贏佔成比</p>" ;print_r($array_AgentList['S']);echo "<br><br>" ;
				echo "<p>閒家上線id</p>" ;print_r($array_AgentList['I']);echo "<br><br>" ;
			}

			// 清空莊家上線資料
			unset($array_Banker_AgentList) ;
			unset($array_Banker_WinLost_Money) ;
			unset($array_Banker_AllMoney) ;
			unset($array_Banker_Backwater_Money) ;
			unset($array_Banker_Reported_Money) ;

			// 如果為輸莊區
			if( $LIST['BetGodnine_Type'] == 1 )
			{
				// 取得所有莊家資料
				$array_Banker_Member = GodNine_getMemberInfo( $array_Banker_Info['Banker_Set_ID'] ) ;
				// 取得莊家所有上線代理人資料
				$array_Banker_AgentList = GodNine_getAgentList( $array_Banker_Member['Member_Father_ID'] , "A" ) ;		// 取得所有上線代理人資料
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{
					echo "<h2>取得莊家上線'名稱','返水比','分成比','id'資料</h2>" ;
					echo "<p>莊家資料:{$array_Banker_Info['Banker_Set_ID']}</p>" ;print_r($array_Banker_Info);echo "<br><br>" ;
					echo "<p>莊家代理人資料:{$array_Banker_Member['Member_Father_ID']}</p>" ;print_r($array_Banker_Member);echo "<br><br>" ;
					echo "<p>莊家上線名稱</p>" ;print_r($array_Banker_AgentList['N']);echo "<br><br>" ;
					echo "<p>莊家上線手續費退水比</p>" ;print_r($array_Banker_AgentList[$tmp_Agent_Backwater_Key]);echo "<br><br>" ;
					echo "<p>莊家上線長莊輸贏佔成比</p>" ;print_r($array_Banker_AgentList['S']);echo "<br><br>" ;
					echo "<p>莊家上線id</p>" ;print_r($array_Banker_AgentList['I']);echo "<br><br>" ;
				}
			}

			// 計算莊閒應付金額 : 輸贏金額 + 下注預扣籌碼(會員時)
			if( $tmp_WinLost_Name == "Banker" )
			{// 莊家贏
				// 輸贏狀態(1:閒家贏 , 2: 莊家贏)
				$tmp_BetGodnine_WinLost_Type = 2;
				
				$tmp_Banker_Action = "+" ;	// 莊家處理動作
				$tmp_User_Action = "-" ;	// 閒家處理動作

				//BetGodnine_Banker_WinLost_Money		莊家輸贏金額 = 輸贏金額 - 總手續費(莊家贏才要扣,輸為輸贏金額負值)
				//BetGodnine_Banker_Backwater_Money		莊家返水金額 = 總手續費 * 代理人手續費退水 / 100(莊家贏才有值)
				//BetGodnine_Banker_WinLost_AllMoney	莊家輸贏總金額 = 莊家輸贏金額 * (100-佔成)/100
				//BetGodnine_Banker_Report_Money		莊家報帳金額 = 莊家輸贏總金額 + 莊家返水金額

				// 如果為輪莊區
				if( $LIST['BetGodnine_Type'] == 1 )
				{
					// 莊家占成
					$tmp_Banker_Proportion = $array_Banker_AgentList['S'][sizeof($array_Banker_AgentList['S'])-1] ;
					// 莊家返水比
					$tmp_Banker_Backwater_Ratio = $array_Banker_AgentList[$tmp_Agent_Backwater_Key][sizeof($array_Banker_AgentList[$tmp_Agent_Backwater_Key])-1] ;
					// 莊家輸贏金額(莊家贏) = 輸贏金額 - 總手續費
					$tmp_Banker_WinLost_Money = $tmp_Original_WinLost_Money - $tmp_Backwater_Money ;
					// 莊家返水金額(莊家贏) = 總手續費 * 代理人手續費退水 / 100(莊家贏才有值)
					$tmp_Banker_Backwater_Money = $tmp_Backwater_Money * $tmp_Banker_Backwater_Ratio / 100 ;
				}

				// 莊家輸贏總金額(莊家贏)
				if( $LIST['BetGodnine_Type'] == 2 )// 長莊區 = 莊家輸贏金額 * (100-佔成)/100
				{	$tmp_Banker_WinLost_AllMoney = $tmp_Banker_WinLost_Money * ( 100 - $tmp_Banker_Proportion ) / 100 ;	}
				else// 輸莊區 = 莊家輸贏金額
				{	$tmp_Banker_WinLost_AllMoney = $tmp_Banker_WinLost_Money ;	}

				// 莊家報帳金額(莊家贏) = 莊家輸贏總金額 + 莊家返水金額
				$tmp_Banker_Report_Money = $tmp_Banker_WinLost_AllMoney + $tmp_Banker_Backwater_Money ;


				// 閒家應付金額(閒家輸) = -原始輸贏金額
				$tmp_User_WinLost_Money = -$tmp_Original_WinLost_Money  ;
				// 本下注還給閒家金額(閒家輸) = 下注預扣金額 + 閒家應付金額
				//$tmp_Return_User_Money = $LIST['BetGodnine_Withhold_Chips'] + $tmp_User_WinLost_Money ;		// 閒家還回金額
				// 本下注還給閒家金額(閒家輸) = 下注預扣金額(不預扣)
				$tmp_Return_User_Money = $tmp_User_WinLost_Money ;		// 閒家還回金額

				// 閒家下注設定
				$tmp_Index = array_search($array_Agent_Info['id_Agent'] , $array_AgentList['I']);
				if( $tmp_Index )
				{
					//echo "代理人id : {$array_Agent_Info['id_Agent']} , 找到index : $tmp_Index<br>" ;
					// 會員下注占成 = 代理人占成
					$tmp_Member_Proportion = $array_AgentList['S'][$tmp_Index] ;
					// 會員下注返水比 = 代理人返水
					$tmp_Member_Backwater_Ratio = $array_AgentList[$tmp_Agent_Backwater_Key][$tmp_Index] ;
				}

				// 會員下注輸贏金額(閒家輸) = -原始輸贏金額
				$tmp_Member_WinLost_Money = -$tmp_Original_WinLost_Money  ;
				// 會員下注返水金額(閒家輸) = 0
				$tmp_Member_Backwater_Money = 0 ;

				// 會員下注總金額(閒家輸)
				if( $LIST['BetGodnine_Type'] == 2 )// 長莊區 = 會員下注輸贏金額 * (100-會員下注占成)/100
				{	$tmp_Member_WinLost_AllMoney = $tmp_Member_WinLost_Money * (100 - $tmp_Member_Proportion ) / 100 ;	}
				else// 輸莊區 = 會員下注總金額
				{	$tmp_Member_WinLost_AllMoney = $tmp_Member_WinLost_Money ;	}

				// 會員下注報帳金額(閒家輸) = 會員下注總金額 + 會員下注返水金額
				$tmp_Member_Report_Money = $tmp_Member_WinLost_AllMoney + $tmp_Member_Backwater_Money;

				$tmp_MoneyLog_Log = "莊家贏 : $tmp_Banker_WinLost_Money" ;	// 金額記錄LOG

				// 設定LOG資料
				$tmp_Log = "莊家贏的設定\n" ;
				$tmp_Log .= "莊家處理動作 : $tmp_Banker_Action\n" ;
				$tmp_Log .= "閒家處理動作 : $tmp_User_Action\n\n" ;

				// 如果為輸莊區
				if( $LIST['BetGodnine_Type'] == 1 )
				{
					// 莊家占成
					$tmp_Log .= "莊家占成($tmp_Banker_Proportion)\n" ;
					// 莊家返水比
					$tmp_Log .= "莊家返水比($tmp_Banker_Backwater_Ratio)\n" ;
					// 莊家返水金額(莊家贏) = 總手續費 * 代理人手續費退水 / 100(莊家贏才有值)
					$tmp_Log .= "莊家返水金額(莊家贏)($tmp_Banker_Backwater_Money) = 總手續費($tmp_Backwater_Money) * 代理人手續費退水($tmp_Banker_Backwater_Ratio) / 100\n" ;
	
					// 莊家輸贏金額(莊家贏) = 輸贏金額 - 總手續費
					$tmp_Log .= "莊家輸贏金額(莊家贏)($tmp_Banker_WinLost_Money) = 輸贏金額($tmp_Original_WinLost_Money) - 總手續費($tmp_Backwater_Money)\n" ;
				}

				// 莊家輸贏總金額(莊家贏)
				if( $LIST['BetGodnine_Type'] == 2 )// 長莊區 = 莊家輸贏金額 * (100-會員下注占成)/100
				{	$tmp_Log .= "長莊區 -- 莊家輸贏總金額(莊家贏)($tmp_Banker_WinLost_AllMoney) = 莊家輸贏金額($tmp_Banker_WinLost_Money) * (100-佔成($tmp_Banker_Proportion))/100\n" ;	}
				else// 輪莊區 = 莊家輸贏金額
				{	$tmp_Log .= "輪莊區 -- 莊家輸贏總金額(莊家贏)($tmp_Banker_WinLost_AllMoney) = 莊家輸贏金額($tmp_Banker_WinLost_Money)\n" ;	}

				// 莊家報帳金額(莊家贏) = 莊家輸贏總金額 + 莊家返水金額
				$tmp_Log .= "莊家報帳金額(莊家贏)($tmp_Banker_Report_Money) = 莊家輸贏總金額($tmp_Banker_WinLost_AllMoney) + 莊家返水金額($tmp_Banker_Backwater_Money)\n\n" ;

				$tmp_Log .= "輸贏金額(閒家輸)($tmp_User_WinLost_Money) = -原始輸贏金額($tmp_Original_WinLost_Money)\n" ;
				//$tmp_Log .= "本下注還給閒家金額($tmp_Return_User_Money) = 下注預扣金額({$LIST['BetGodnine_Withhold_Chips']}) + 輸贏金額($tmp_User_WinLost_Money)\n\n" ;
				$tmp_Log .= "本下注還給閒家金額($tmp_Return_User_Money) = 輸贏金額($tmp_User_WinLost_Money)\n\n" ;

				// 會員下注占成 = 代理人占成
				$tmp_Log .= "會員下注占成($tmp_Member_Proportion)\n" ;
				// 會員下注返水比 = 代理人返水
				$tmp_Log .= "會員下注返水比($tmp_Member_Backwater_Ratio)\n" ;
				// 會員下注返水金額(閒家輸) = 0
				$tmp_Log .= "會員下注返水金額(閒家輸) = 0\n" ;

				// 會員下注輸贏金額(閒家輸) = -原始輸贏金額
				$tmp_Log .= "會員下注輸贏金額(閒家輸)($tmp_Member_WinLost_Money) = -原始輸贏金額($tmp_Original_WinLost_Money)\n" ;

				// 會員下注總金額(閒家輸)
				if( $LIST['BetGodnine_Type'] == 2 )// 長莊區 = 會員下注輸贏金額 * (100-會員下注占成)/100
				{	$tmp_Log .= "長莊區 -- 會員下注總金額(閒家輸)($tmp_Member_WinLost_AllMoney) =會員下注輸贏金額($tmp_Member_WinLost_Money) * (100-會員下注占成($tmp_Member_Proportion))/100\n" ;	}
				else// 輪莊區 = 會員下注輸贏金額
				{	$tmp_Log .= "輪莊區 -- 會員下注總金額(閒家輸)($tmp_Member_WinLost_AllMoney) =會員下注輸贏金額($tmp_Member_WinLost_Money)\n" ;	}
				
				// 會員下注報帳金額(閒家輸) = 會員下注總金額 + 會員下注返水金額
				$tmp_Log .= "會員下注報帳金額(閒家輸)($tmp_Member_Report_Money) = 會員下注總金額($tmp_Member_WinLost_AllMoney) + 會員下注返水金額($tmp_Member_Backwater_Money)\n" ;
			}
			else
			{// 閒家贏
				// 輸贏狀態(1:閒家贏 , 2: 莊家贏)
				$tmp_BetGodnine_WinLost_Type = 1;

				$tmp_Banker_Action = "-" ;	// 莊家處理動作
				$tmp_User_Action = "+" ;	// 閒家處理動作

				//BetGodnine_Banker_WinLost_Money		莊家輸贏金額 = 輸贏金額 - 總手續費(莊家贏才要扣,輸為輸贏金額負值)
				//BetGodnine_Banker_Backwater_Money		莊家返水金額 = 總手續費 * 代理人手續費退水 / 100(莊家贏才有值)
				//BetGodnine_Banker_WinLost_AllMoney	莊家輸贏總金額 = 莊家輸贏金額 * (100-佔成)/100
				//BetGodnine_Banker_Report_Money		莊家報帳金額 = 莊家輸贏總金額 + 莊家返水金額

				// 如果為輪莊區
				if( $LIST['BetGodnine_Type'] == 1 )
				{
					// 莊家占成
					$tmp_Banker_Proportion = $array_Banker_AgentList['S'][sizeof($array_Banker_AgentList['S'])-1] ;
					// 莊家返水比
					$tmp_Banker_Backwater_Ratio = $array_Banker_AgentList[$tmp_Agent_Backwater_Key][sizeof($array_Banker_AgentList[$tmp_Agent_Backwater_Key])-1] ;
					// 莊家輸贏金額(莊家輸) = -輸贏金額
					$tmp_Banker_WinLost_Money = -$tmp_Original_WinLost_Money ;
					// 計算莊家輸贏總金額
					//$tmp_BankerLog_Money -= $tmp_Original_WinLost_Money ;
					
					// 莊家返水金額(莊家輸) = 0(不用付)
					$tmp_Banker_Backwater_Money = 0 ;
					// 莊家輸贏總金額
					$tmp_Banker_WinLost_AllMoney = "" ;
				}

				// 莊家--------------------------------------------------
				// 莊家輸贏總金額(莊家輸)
				if( $LIST['BetGodnine_Type'] == 2 )// 長莊區 = 莊家輸贏金額 * (100-佔成)/100
				{
					$tmp_Banker_WinLost_AllMoney = $tmp_Banker_WinLost_Money * ( 100 - $tmp_Banker_Proportion ) / 100 ;
					echo "長莊區-莊家輸贏金額 : $tmp_Banker_WinLost_AllMoney = $tmp_Banker_WinLost_Money * ( 100 - $tmp_Banker_Proportion ) / 100<br>" ;
				}
				else// 輸莊區 = 莊家輸贏金額
				{
					$tmp_Banker_WinLost_AllMoney = $tmp_Banker_WinLost_Money ;
					echo "輸莊區-莊家輸贏金額 : $tmp_Banker_WinLost_AllMoney = $tmp_Banker_WinLost_Money<br>" ;
				}
				

				// 莊家報帳金額(莊家輸) = 莊家輸贏總金額 + 莊家返水金額
				$tmp_Banker_Report_Money = $tmp_Banker_WinLost_AllMoney + $tmp_Banker_Backwater_Money ;

				// 閒家應付金額(閒家贏) = -原始輸贏金額
				//$tmp_User_WinLost_Money = -$tmp_Original_WinLost_Money  ;
				// 本下注還給閒家金額(閒家贏) = 下注預扣金額 + 閒家應付金額-
				//$tmp_Return_User_Money = $LIST['BetGodnine_Withhold_Chips'] + $tmp_User_WinLost_Money ;		// 閒家還回金額

				// 閒家--------------------------------------------------
				// 閒家應得金額(閒家贏) = 原始輸贏金額 - 返水金額
				$tmp_User_WinLost_Money = $tmp_Original_WinLost_Money - $tmp_Backwater_Money ;
				// 本下注還給閒家金額 = 下注預扣金額 + 閒家應付金額
				//$tmp_Return_User_Money = $LIST['BetGodnine_Withhold_Chips'] + $tmp_User_WinLost_Money ;		// 閒家還回金額
				// 本下注還給閒家金額(閒家贏) = 閒家應付金額(不預扣)
				$tmp_Return_User_Money = $tmp_User_WinLost_Money ;		// 閒家還回金額

				$tmp_MoneyLog_Log = "閒家贏 : $tmp_Banker_WinLost_Money" ;	// 金額記錄LOG

				// 閒家下注設定
				$tmp_Index = array_search($array_Agent_Info['id_Agent'] , $array_AgentList['I']);
				if( $tmp_Index )
				{
					echo "代理人id : {$array_Agent_Info['id_Agent']} , 找到index : $tmp_Index<br>" ;
					// 會員下注占成 = 代理人占成
					$tmp_Member_Proportion = $array_AgentList['S'][$tmp_Index] ;
					// 會員下注返水比 = 代理人返水
					$tmp_Member_Backwater_Ratio = $array_AgentList[$tmp_Agent_Backwater_Key][$tmp_Index] ;
				}
				
				// 會員下注輸贏金額(閒家贏) = 原始輸贏金額 -  總手續費
				$tmp_Member_WinLost_Money = $tmp_Original_WinLost_Money - $tmp_Backwater_Money ;
				// 會員下注返水金額(閒家贏) = 總手續費 * 代理人返水 / 100
				$tmp_Member_Backwater_Money = $tmp_Backwater_Money * $tmp_Member_Backwater_Ratio / 100 ;

				// 閒家輸贏總金額(莊家輸)
				if( $LIST['BetGodnine_Type'] == 2 )// 長莊區 = 會員下注輸贏金額 * (100-會員下注占成)/100
				//{	$tmp_Banker_WinLost_AllMoney = $tmp_Banker_WinLost_Money * ( 100 - $tmp_Banker_Proportion ) / 100 ;	}
				{	$tmp_Member_WinLost_AllMoney = $tmp_Member_WinLost_Money * (100 - $tmp_Member_Proportion ) / 100  ;	}
				else// 輸莊區 = 莊家輸贏金額
				{	$tmp_Member_WinLost_AllMoney = $tmp_Member_WinLost_Money  ;	}
				
				// 會員下注報帳金額(閒家贏) = 會員下注輸贏金額 + 會員下注返水金額
				$tmp_Member_Report_Money = $tmp_Member_WinLost_AllMoney + $tmp_Member_Backwater_Money;

				// 設定LOG資料
				$tmp_Log = "閒家贏的設定\n" ;
				$tmp_Log .= "莊家處理動作 : $tmp_Banker_Action\n" ;
				$tmp_Log .= "閒家處理動作 : $tmp_User_Action\n\n" ;

				// 如果為輸莊區
				if( $LIST['BetGodnine_Type'] == 1 )
				{
					// 莊家占成
					$tmp_Log .= "莊家占成($tmp_Banker_Proportion)\n" ;
					// 莊家返水比
					$tmp_Log .= "莊家返水比($tmp_Banker_Backwater_Ratio)\n" ;
					// 莊家返水金額(莊家輸) = 0
					$tmp_Log .= "莊家返水金額(莊家輸)($tmp_Banker_Backwater_Money) = 0\n" ;
	
					// 莊家輸贏金額(莊家輸) = -輸贏金額
					$tmp_Log .= "莊家輸贏金額(莊家輸)($tmp_Banker_WinLost_Money) = -輸贏金額(-$tmp_Original_WinLost_Money)\n" ;
				}
				
				// 莊家輸贏總金額(莊家輸)
				if( $LIST['BetGodnine_Type'] == 2 )// 長莊區 = 莊家輸贏金額 * (100-佔成)/100
				{	$tmp_Log .= "長莊區 -- 莊家輸贏總金額(莊家輸)($tmp_Banker_WinLost_AllMoney) = 莊家輸贏金額($tmp_Banker_WinLost_Money) * (100-佔成($tmp_Banker_Proportion))/100\n" ;	}
				else// 輪莊區 = 莊家輸贏金額
				{	$tmp_Log .= "輪莊區 -- 莊家輸贏總金額(莊家輸)($tmp_Banker_WinLost_AllMoney) = 莊家輸贏金額($tmp_Banker_WinLost_Money)\n" ;	}
				
				// 莊家報帳金額(莊家輸) = 莊家輸贏總金額 + 莊家返水金額
				$tmp_Log .= "莊家報帳金額(莊家輸)($tmp_Banker_Report_Money) = 莊家輸贏總金額($tmp_Banker_WinLost_AllMoney) + 莊家返水金額($tmp_Banker_Backwater_Money)\n\n" ;


				$tmp_Log .= "閒家(贏)輸贏金額($tmp_User_WinLost_Money) = 原始輸贏金額($tmp_Original_WinLost_Money) - 返水金額($tmp_Backwater_Money)\n" ;
				//$tmp_Log .= "本下注還給閒家金額($tmp_Return_User_Money) = 下注預扣金額({$LIST['BetGodnine_Withhold_Chips']}) + 閒家應付金額($tmp_User_WinLost_Money)\n\n" ;
				$tmp_Log .= "本下注還給閒家金額($tmp_Return_User_Money) = 閒家應付金額($tmp_User_WinLost_Money)\n\n" ;

				// 會員下注占成 = 代理人占成
				$tmp_Log .= "會員下注占成($tmp_Member_Proportion)\n" ;
				// 會員下注返水比 = 代理人返水
				$tmp_Log .= "會員下注返水比($tmp_Member_Backwater_Ratio)\n" ;
				// 會員下注返水金額(閒家贏) = 總手續費 * 代理人返水 / 100
				$tmp_Log .= "會員下注返水金額(閒家贏)($tmp_Member_Backwater_Money) = 總手續費($tmp_Backwater_Money) * 代理人返水($tmp_Member_Backwater_Ratio)\n" ;

				// 會員下注輸贏金額(閒家贏) = 輸贏金額 -  總手續費
				$tmp_Log .= "會員下注輸贏金額(閒家贏)($tmp_Member_WinLost_Money) = 輸贏金額($tmp_Original_WinLost_Money) -  總手續費($tmp_Backwater_Money)\n" ;
				
				// 會員下注輸贏金額(閒家贏)
				if( $LIST['BetGodnine_Type'] == 2 )// 長莊區 = 會員下注輸贏金額(閒家贏) * (100-佔成)/100
				{	$tmp_Log .= "長莊區 -- 會員下注輸贏金額(閒家贏)($tmp_Member_WinLost_AllMoney) = 會員下注輸贏金額($tmp_Member_WinLost_Money) * (100-會員下注占成($tmp_Member_Proportion))/100\n" ;	}
				else// 輪莊區 = 會員下注輸贏金額(閒家贏)
				{	$tmp_Log .= "輪莊區 -- 會員下注輸贏金額(閒家贏)($tmp_Member_WinLost_AllMoney) = 會員下注輸贏金額($tmp_Member_WinLost_Money)\n" ;	}

				// 會員下注報帳金額(閒家贏) = 會員下注輸贏金額 + 會員下注返水金額
				$tmp_Log .= "會員下注報帳金額(閒家贏)($tmp_Member_Report_Money) = 會員下注輸贏金額($tmp_Member_WinLost_AllMoney) + 會員下注返水金額($tmp_Member_Backwater_Money)\n" ;
			}

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<h2>莊閒輸贏相關設定:</h2>" . nl2br($tmp_Log) . "<br>" ;	}
			$tmp_UserLog = $tmp_Log ;
			
			// 設定莊家輸贏金額 $tmp_Banker_WinLost_Money
			$sum_Banker_WinLost_Money += $tmp_Banker_WinLost_Money ;
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<p>設定莊家輸贏金額 : $sum_Banker_WinLost_Money += $tmp_Banker_WinLost_Money</p>" ;	}


			// 計算閒家上線資料
			foreach( $array_AgentList["I"] as $key => $value )
			{
				// 莊家應得金額 $tmp_Banker_WinLost_Money
				// 閒家應付金額 $tmp_User_WinLost_Money

				// 上線輸贏總金額 = 上線輸贏金額
				$array_WinLost_Money[$key] = $tmp_Member_WinLost_Money ;

				// 上線總金額
				if( $LIST['BetGodnine_Type'] == 2 )// 長莊區 = 上線輸贏金額 * (100-佔比)/100
				{	$array_AllMoney[$key] = $tmp_Member_WinLost_Money * (100 - $array_AgentList['S'][$key]) / 100; ;	}
				else// 輪莊有倍數區 = 上線輸贏金額 
				{	$array_AllMoney[$key] = $tmp_Member_WinLost_Money ;	}

				// 上線返水金額(閒輸設為0)
				if( $tmp_WinLost_Name == "Banker" )
				{	$array_Backwater_Money[$key] = 0 ;	}
				else// 上線返水金額(閒贏) = 返水金額 * 手續費退水佔比
				{	$array_Backwater_Money[$key] = $tmp_Backwater_Money * $array_AgentList[$tmp_Agent_Backwater_Key][$key] / 100;	}

				// 上線報帳金額 = 上線輸贏金額 + 上線返水金額
				$array_Reported_Money[$key] = $array_AllMoney[$key] + $array_Backwater_Money[$key] ;
			}

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{
				echo "<h2>取得閒家上線'名稱','返水比','分成比','id'資料</h2>" ;
				echo "<h2>記算上線資料</h2>" ;

				echo "<p>閒家資料:{$array_Member_Info['y_Member_ID']}</p>" ;print_r($array_Member_Info);echo "<br><br>" ;
				echo "<p>閒家代理人資料:{$LIST['BetGodnine_Agent_ID']}</p>" ;
				echo "<p>閒家上線名稱</p>" ;print_r($array_AgentList['N']);echo "<br><br>" ;

				echo "<p>上線輸贏金額(原始輸贏金額)</p>" ;print_r($array_WinLost_Money);echo "<br><br>" ;

				echo "<p>閒家上線手續費退水比</p>" ;print_r($array_AgentList[$tmp_Agent_Backwater_Key]);echo "<br><br>" ;
				echo "<p>上線返水金額(閒輸設為0)-(返水金額 * 手續費退水佔比)</p>" ;print_r($array_Backwater_Money);echo "<br><br>" ;

				echo "<p>閒家上線長莊輸贏佔成比</p>" ;print_r($array_AgentList['S']);echo "<br><br>" ;
				echo "<p>上線總金額(計算真正輸贏金額)</p>" ;print_r($array_AllMoney);echo "<br><br>" ;
				echo "<p>上線報帳金額 = 上線輸贏金額 + 上線返水金額</p>" ;print_r($array_Reported_Money);echo "<br><br>" ;

				echo "<p>閒家上線id</p>" ;print_r($array_AgentList['I']);echo "<br><br>" ;

			}

			// 如果為輪莊區
			if( $LIST['BetGodnine_Type'] == 1 )
			{
				// 記算莊家上線資料
				foreach( $array_Banker_AgentList["I"] as $key => $value )
				{
					// 莊家應得金額 $tmp_Banker_WinLost_Money
					// 上線總金額 = 上線輸贏金額
					//$array_Banker_AllMoney[$key] = $array_Banker_WinLost_Money[$key] ;
					$array_Banker_WinLost_Money[$key] = $tmp_Banker_WinLost_Money ;
	
					if( $LIST['BetGodnine_Type'] == 2 )
					{// 長莊無倍數區-輸贏金額和報帳金額要依佔比來計算
						// 上線輸贏金額 = 上線輸贏金額 * (1-佔比)
						$array_Banker_AllMoney[$key] = $tmp_Banker_WinLost_Money * (100 - $array_Banker_AgentList['S'][$key]) / 100; ;
					}
					else
					{// 輪莊有倍數區-輸贏金額和報帳金額不要依佔比來計算
						// 上線輸贏金額 = 上線輸贏金額 
						$array_Banker_AllMoney[$key] = $tmp_Banker_WinLost_Money ;
					}
	
	
					// 上線返水金額
					if( $tmp_WinLost_Name == "Banker" )// 上線返水金額(莊贏) = 返水金額 * 手續費退水佔比
					{	$array_Banker_Backwater_Money[$key] = $tmp_Backwater_Money * $array_Banker_AgentList[$tmp_Agent_Backwater_Key][$key] / 100;	}
					else// 上線返水金額(閒輸)
					//{	$array_Banker_Backwater_Money[$key] = $tmp_Backwater_Money * $array_Banker_AgentList[$tmp_Agent_Backwater_Key][$key] / 100;	}
					{	$array_Banker_Backwater_Money[$key] = 0 ;	}
	
					// 上線報帳金額 = 上線輸贏金額 + 上線返水金額
					$array_Banker_Reported_Money[$key] = $array_Banker_AllMoney[$key] + $array_Banker_Backwater_Money[$key] ;
	
				}
				
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{
					echo "<h2>記算上線資料</h2>" ;
					echo "<p>莊家上線名稱</p>" ;print_r($array_Banker_AgentList['N']);echo "<br><br>" ;
					echo "<p>莊家上線輸贏金額(原始輸贏金額)</p>" ;print_r($array_Banker_WinLost_Money);echo "<br><br>" ;
	
					echo "<p>莊家上線手續費退水比</p>" ;print_r($array_Banker_AgentList[$tmp_Agent_Backwater_Key]);echo "<br><br>" ;
					echo "<p>莊家上線返水金額(莊輸設為0)(返水金額 * 手續費退水佔比)</p>" ;print_r($array_Banker_Backwater_Money);echo "<br><br>" ;
	
					echo "<p>莊家上線長莊輸贏佔成比</p>" ;print_r($array_Banker_AgentList['S']);echo "<br><br>" ;
					echo "<p>莊家上線總金額(原始輸贏金額 * ( 100 - 占成比例 )% + 代理人返水金額)</p>" ;print_r($array_Banker_AllMoney);echo "<br><br>" ;
	
					echo "<p>莊家上線報帳金額(計算真正輸贏金額 + 莊家上線返水金額)</p>" ;print_r($array_Banker_Reported_Money);echo "<br><br>" ;
	
					echo "<p>莊家上線id</p>" ;print_r($array_Banker_AgentList['I']);echo "<br><br>" ;
				}
			}

			
			unset($arrayField_WinLost);
			// 設定下注資料
			$arrayField_WinLost['BetGodnine_Member_Proportion'] = $tmp_Member_Proportion ;				// 會員下注占成
			$arrayField_WinLost['BetGodnine_Member_Backwater_Ratio'] = $tmp_Member_Backwater_Ratio ;	// 會員下注返水比
			$arrayField_WinLost['BetGodnine_Member_WinLost_Money'] = $tmp_Member_WinLost_Money ;	// 會員下注輸贏金額
			$arrayField_WinLost['BetGodnine_Member_Backwater_Money'] = $tmp_Member_Backwater_Money ;	// 會員下注返水金額
			$arrayField_WinLost['BetGodnine_Member_WinLost_AllMoney'] = $tmp_Member_WinLost_AllMoney ;			// 會員下注總金額
			$arrayField_WinLost['BetGodnine_Member_Report_Money'] = $tmp_Member_Report_Money ;			// 會員下注報帳金額

			$arrayField_WinLost['BetGodnine_Odds'] = $tmp_Multiple ;		// 輸贏賠率
			$arrayField_WinLost['BetGodnine_WinLost_Money'] = $tmp_User_WinLost_Money ;		// 輸贏金額
			$arrayField_WinLost['BetGodnine_WinLost_AllMoney'] = $tmp_Return_User_Money ;			// 閒家輸贏總金額
			$arrayField_WinLost['BetGodnine_Handling_Fee'] = $tmp_Backwater_Money ;			// 手續費

			$arrayField_WinLost['BetGodnine_Online_WinLost_Money'] = array2str($array_WinLost_Money , ",") ;			// 上線輸贏金額
			$arrayField_WinLost['BetGodnine_Online_Backwater_Ratio'] = array2str($array_AgentList[$tmp_Agent_Backwater_Key] , ",") ;			// 上線手續費退水比
			$arrayField_WinLost['BetGodnine_Online_Backwater_Money'] = array2str($array_Backwater_Money , ",") ;		// 上線返水金額
			$arrayField_WinLost['BetGodnine_Online_AllMoney'] = array2str($array_AllMoney , ",") ;						// 上線總金額
			$arrayField_WinLost['BetGodnine_Online_Share_Ratio'] = array2str($array_AgentList['S'] , ",") ;				// 上線長莊輸贏佔成比
			$arrayField_WinLost['BetGodnine_Online_Reported_Money'] = array2str($array_Reported_Money , ",") ;			// 上線報帳金額
			$arrayField_WinLost['BetGodnine_Online_id'] = "," . array2str($array_AgentList['I'] , ",") . "," ;						// 上線id

			// 如果為輸莊區
			if( $LIST['BetGodnine_Type'] == 1 )
			{
				echo "<h1>輸莊區加入資料</h1>" ;
				$arrayField_WinLost['BetGodnine_Banker_Proportion'] = $tmp_Banker_Proportion ;			// 莊家占成
				$arrayField_WinLost['BetGodnine_Banker_Backwater_Ratio'] = $tmp_Banker_Backwater_Ratio ;			// 莊家返水比
				$arrayField_WinLost['BetGodnine_Banker_WinLost_Money'] = $tmp_Banker_WinLost_Money ;			// 莊家輸贏金額
				$arrayField_WinLost['BetGodnine_Banker_Backwater_Money'] = $tmp_Banker_Backwater_Money ;		// 莊家返水金額
				$arrayField_WinLost['BetGodnine_Banker_WinLost_AllMoney'] = $tmp_Banker_WinLost_AllMoney ;		// 莊家輸贏總金額
				$arrayField_WinLost['BetGodnine_Banker_Report_Money'] = $tmp_Banker_Report_Money ;		// 莊家報帳金額
	
				$arrayField_WinLost['BetGodnine_Banker_Online_WinLost_Money'] = array2str($array_Banker_WinLost_Money , ",") ;	// 莊家代理人上線輸贏金額' ,	#::CHAR::50,12.05-莊家輸贏總金額 * 長莊輸贏佔成 (長莊才要算)
				$arrayField_WinLost['BetGodnine_Banker_Online_Backwater_Ratio'] = array2str($array_Banker_AgentList[$tmp_Agent_Backwater_Key] , ",") ;	// 莊家代理人上線返水比' ,	#::CHAR::10,9
				$arrayField_WinLost['BetGodnine_Banker_Online_Backwater_Money'] = array2str($array_Banker_Backwater_Money , ",") ;	// 莊家代理人上線返水金額' ,	#::CHAR::50,12.05-莊家贏時才算
				$arrayField_WinLost['BetGodnine_Banker_Online_AllMoney'] = array2str($array_Banker_AllMoney , ",") ;			// 莊家代理人上線總金額' ,	#::CHAR::50,12.05-莊家上線輸贏金額+上線返水金額(莊家贏時才算)
				$arrayField_WinLost['BetGodnine_Banker_Online_Share_Ratio'] = array2str($array_Banker_AgentList['S'] , ",") ;		// 莊家代理人上線占成比' ,	#::CHAR::10,20
				$arrayField_WinLost['BetGodnine_Banker_Online_Reported_Money'] = array2str($array_Banker_Reported_Money , ",") ;	// 莊家上線報帳金額' ,		#::CHAR::50,12.05-長莊區"總金額" * (100-佔成),輪莊區"總金額" * (100-100) = 0
				if( $array_Banker_AgentList['I'] )
				{	$arrayField_WinLost['BetGodnine_Banker_Online_id'] = "," . array2str($array_Banker_AgentList['I'] , ",") . "," ;	}				// 莊家上線id' ,				#::CHAR::,1,2,	
			}

			$arrayField_WinLost['BetGodnine_WinLost_Type'] = $tmp_BetGodnine_WinLost_Type ;				// 輸贏狀態 0||未開獎||1||閒家贏||2||莊家贏
			$arrayField_WinLost['BetGodnine_Log'] = $tmp_UserLog ;							// Log
			$arrayField_WinLost['BetGodnine_Draw'] = "1" ;							// 是否已開獎
			
			echo "<p>加入開獎資料  id_BetGodnine = '{$LIST['id_BetGodnine']}</p>" ;print_r($arrayField_WinLost);echo "<br>" ;
			
			$Bol_BetGodnine = func_DatabaseBase( "BetGodnine" , "MOD" , $arrayField_WinLost , " id_BetGodnine = '{$LIST['id_BetGodnine']}'" ) ;						// 資料庫處理
			if( $Bol_BetGodnine )
			{
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>設定下注資料-成功</p>" ;echo Public_ShowArray( $arrayField_WinLost );	}
			}
			else
			{
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<p>設定下注資料-失敗</p>" ;echo Public_ShowArray( $arrayField_WinLost );	}
			}

			// 此訂單是否已給過-會員ID,訂單ID,操作動作(2)
			$Count_MoneyLog = func_DatabaseGet( "SELECT * FROM MoneyLog WHERE MoneyLog_Set_ID = '{$LIST['BetGodnine_Member_ID']}' AND MoneyLog_Type = '2' AND MoneyLog_Bet_ID = '{$LIST['BetGodnine_ID']}'" , "COUNT" , "" ) ;		// 取得資料庫資料

			if( empty($Count_MoneyLog) )
			{// 沒有給過點數時給點數
				// 現在會員資料
				$array_Member_Now_Info = GodNine_getMemberInfo( $LIST['BetGodnine_Member_ID'] ) ;		// 取得會員資料
				
				// 設定閒家點數
				$tmpSQL_User_Money = "UPDATE Member SET Member_Money = Member_Money + $tmp_Return_User_Money WHERE Member_ID = '{$LIST['BetGodnine_Member_ID']}'" ;				// 欄位值+1
				$Bol_User_Money = func_DatabaseBase( $tmpSQL_User_Money , "SQL" , "" , "" ) ;									// 資料庫處理
				if ( $Bol_User_Money )
				{
					//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					//{	echo "<h2>$tmp_BankerLog</h2>" ;	}
	
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{
						echo "<p>設定閒家點數-成功<br>$tmpSQL_User_Money</p>" ;
					}
					// 加入金額Log
					unset($arrayField_MoneyLog);
					$arrayField_MoneyLog['MoneyLog_Set_ID'] = $LIST['BetGodnine_Member_ID'] ;	// 設定者ID
					$arrayField_MoneyLog['MoneyLog_Class'] = 1 ;								// 操作分類#::SELECT:2||1||會員||2||代理人::
					$arrayField_MoneyLog['MoneyLog_Type'] = 2 ;									// 操作動作#::SELECT:2||0||其它||1||遊戲投注||2||遊戲派彩||3||存入||4||提出||5||莊家派彩:
					$arrayField_MoneyLog['MoneyLog_Bet_ID'] = $LIST['BetGodnine_ID'] ;			// 下注訂單號
					$arrayField_MoneyLog['MoneyLog_Money'] = $tmp_Return_User_Money ;	// 操作金額
					$arrayField_MoneyLog['MoneyLog_Original_Money'] = $array_Member_Now_Info['Member_Money'] ;	// 操作前金額
					$arrayField_MoneyLog['MoneyLog_Operator_IP'] = "" ;				// 操作者IP
					$arrayField_MoneyLog['MoneyLog_Operator_ID'] = ""	 ;			// 操作者ID
					$arrayField_MoneyLog['MoneyLog_Operator_Name'] = "系統排程" ;		// 操作者名稱
					$arrayField_MoneyLog['MoneyLog_Log'] = "設定閒家點數-成功\n".$tmp_MoneyLog_Log ;		// Log
					$arrayField_MoneyLog['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;	// 操作時間
					
					$Bol_MoneyLog = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField_MoneyLog , "" ) ;						// 資料庫處理
	
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{
						echo "<p>加入金額Log</p>" ;echo Public_ShowArray( $arrayField_MoneyLog );
					}
	
					$tmp_Bamker_Money = 0 ;
				}
				else
				{
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "<p>設定閒家點數-失敗</p>" ;	}
				}
			}// 沒有給過點數時給點數
			

			// 把閒家Log加到莊家Log中
			//$tmp_BankerLog .= $tmp_UserLog ;
			
			$tmp_BankerLog_Money += $tmp_Banker_WinLost_Money ;
			$tmp_BankerLog .= "訂單id:{$LIST['id_BetGodnine']},訂單ID:{$LIST['BetGodnine_ID']},閒家ID:{$LIST['BetGodnine_Member_ID']},閒家名稱:{$LIST['BetGodnine_Member_Name']},莊家輸贏金額:$tmp_Banker_WinLost_Money,莊家小計:$tmp_BankerLog_Money\n" ;

			// 秀出閒家Log資料
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<p>秀出閒家Log資料</p>" . nl2br($tmp_UserLog);	}

			echo "<hr>" ;
			$tmp_Index++ ;

			if( $LIST['BetGodnine_Type'] == 1 )
			{
				$Old_BetGodnine_Type = $LIST['BetGodnine_Type'] ;
				$Old_id_BetGodnine = $LIST['id_BetGodnine'] ;
				$Old_BetGodnine_Room = $LIST['BetGodnine_Room'] ;
				$Old_BetGodnine_Bingo_Period = $LIST['BetGodnine_Bingo_Period'] ;
			}
			
		}// END while 找出所有未開獎的下注資料
		
		// 釋放結果集合
		mysqli_free_result($QUERY);

		// 加入最後一筆莊家資料
		if( $tmp_Bamker_AllMoney_Banker_ID )
		{// 寫入最後一筆資料
			// 設定要寫入資料庫參數-舊資料
			// 預扣金額-不預扣
			//$array_ModBankerMoney['Bamker_Withhold_Money'] = $tmp_Bamker_Withhold_Money;
			$array_ModBankerMoney['Bamker_Withhold_Money'] = 0;
			// 莊家最後需處理的點數(內定為每次做莊預扣點數)
			$array_ModBankerMoney['Bamker_AllMoney'] = $tmp_BankerLog_Money ;
			// 設定要處理的莊家ID
			$array_ModBankerMoney['Bamker_AllMoney_Banker_ID'] = $tmp_Bamker_AllMoney_Banker_ID ;
			// 莊家處理點數Log,把每筆下注都加到Log中
			$array_ModBankerMoney['Bamker_Log'] = $tmp_BankerLog ;
			// 當莊資料id
			$array_ModBankerMoney['id_Banker'] = $tmp_Bamker_id_Banker ;

			if ( $tmpShowMsg or 1)	// 秀出除錯訊息 ██████████
			{	echo "<p>寫入最後一筆資料</p>" ;print_r($array_ModBankerMoney);echo "<br>" ;	}
			// echo "<p>莊家Log</p>" . nl2br($tmp_BankerLog) ;

			// 給莊家錢(1:給,0:不給)
			if( $subBankerNoPay )
			{
				// 修改莊家資料庫
				GodNine_ModBankerMoney( $array_ModBankerMoney ) ;		// 修改莊家輸贏資料庫
			}
			// 清空莊家金額
			$sum_Banker_WinLost_Money = 0 ;
			$tmp_BankerLog_Money = 0 ;		// 清空莊家小計
			$tmp_BankerLog = "" ;			// 清空莊家資料
		}
	}
	else
	{	echo "沒有找到資料<br>" ;	}

	// 還回沒有閒家的莊家預扣點數,且已取得開獎資料
	// 如果為輸莊區
	//if( $LIST['BetGodnine_Type'] == 1 )
	//{
		// 

	// 找出前前Bingo期數
	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
	//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
	
	// 找出莊家還沒有還回點數的資料
	$SQL_Banker = "SELECT * FROM Banker WHERE Banker_Bingo_Period <= '{$array_BingoPeriod['LastBingo']}' AND Banker_Return_State = '0'" ;
	echo "找出莊家還沒有還回點數的資料 : <br>$SQL_Banker <br>" ; 
	$QUERY_Banker = mysqli_query($link , $SQL_Banker) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY_Banker) )
	{
		// 一條條獲取
		while ($LIST_Banker = mysqli_fetch_assoc($QUERY_Banker))
		{
			// 本莊家的閒家是否已有下注成功資料,有則無法直接還回金額
			$tmp_Banker_BetGodnine_Count = "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$LIST_Banker['Banker_Bingo_Period']}' AND BetGodnine_Room = '{$LIST_Banker['Banker_Room']}' AND BetGodnine_On = '1' " ;
			$Banker_BetGodnine_Count = func_DatabaseGet( $tmp_Banker_BetGodnine_Count , "COUNT" , "" ) ;		// 取得資料庫資料
			if( $Banker_BetGodnine_Count )
			{	continue;	}

			
			// 把莊家設成已還回金額
			$arrayField_Return_Banker['Banker_Return_State'] = 1 ;
			$arrayField_Return_Banker['Banker_WinLost_AllMoney'] = $LIST_Banker['Banker_Withhold_Money'] ;
			$Bol = func_DatabaseBase( "Banker" , "MOD" , $arrayField_Return_Banker , " id_Banker = '{$LIST_Banker['id_Banker']}'" ) ;						// 資料庫處理

//			$tmpSQL_Return_Banker_Money = "UPDATE Member SET Member_Money = Member_Money + {$LIST_Banker['Banker_Withhold_Money']} WHERE Member_ID = '{$LIST_Banker['Banker_Set_ID']}'" ;				// 欄位值+1
//			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
//			{	echo "<p>還回莊家點數 : <br>$tmpSQL_Return_Banker_Money</p>" ;	}
//			
//			$Bol_Return_Banker_Money = func_DatabaseBase( $tmpSQL_Return_Banker_Money , "SQL" , "" , "" ) ;									// 資料庫處理
//			if ( $Bol_Return_Banker_Money )
//			{// 成功
//				// 把莊家設成已還回金額
//				$arrayField_Return_Banker['Banker_Return_State'] = 1 ;
//				$arrayField_Return_Banker['Banker_WinLost_AllMoney'] = $LIST_Banker['Banker_Withhold_Money'] ;
//				$Bol = func_DatabaseBase( "Banker" , "MOD" , $arrayField_Return_Banker , " id_Banker = '{$LIST_Banker['id_Banker']}'" ) ;						// 資料庫處理
//
//			}
//			else
//			{// 失敗
//				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
//				{	echo "<p>把莊家沒閒家金額還回-失敗 : $tmpSQL_Return_Banker_Money</p>" ;	}
//			}
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_Banker);
	}

	//}
}
//~@_@~// END 賓果開獎 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲


// 會員相關
//~@_@~// START 取得會員資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getMemberInfo( $tmp_Member_ID )
{
	global $link;
	/*
	範例			: $array_AgentInfo = GodNine_getMemberInfo( $tmp_Member_ID ) ;		// 取得會員資料
	功能			: 取得會員資料
	修改日期		: 200609
	參數說明 :
		$tmp_Member_ID	會員ID或id
	回傳參數 :
		$array_Member_Info		取得會員資料
	使用範例 :		:
		$array_Member_Info = GodNine_getMemberInfo( $tmp_Member_ID ) ;		// 取得會員資料
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
//~@_@~// END 取得會員資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得會員還可以使用金額 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getMemberFreeMmoney( $tmp_Member_ID )
{
	global $link;
	/*
	範例			: $tmp_MemberFreePoint = GodNine_getMemberFreeMmoney( $tmp_Member_ID ) ;		// 取得會員還可以使用金額
	功能			: 取得會員還可以使用金額 = 會員目前接有金額 - 當莊預回金額(還沒有還) - 下注預扣金額(還沒有還)
	修改日期		: 200720
	參數說明 :
		$tmp_Member_ID	會員ID或id
	回傳參數 :
		$tmp_MemberFreePoint		會員還可以使用金額
	使用範例 :		:
		$tmp_MemberFreePoint = GodNine_getMemberFreeMmoney( $tmp_Member_ID ) ;		// 取得會員還可以使用金額
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	// 找出會員資料
	if( empty($tmp_Member_ID) )
	{	$tmp_Member_ID = $_SESSION['Member_ID'] ;	}

	if( strlen($tmp_Member_ID) == 16 )
	{
	}

	// 取得會員資料
	$array_Member_Info = WinHappy_getMemberInfo( $tmp_Member_ID ) ;		// 取得會員資料
	// 會員目前擁有金額
	$tmp_Member_Money = $array_Member_Info['Member_Money'] ;
	
	$tmpSQL_Banker = "SELECT sum(Banker_Withhold_Money) as Banker_Withhold_Money_Total FROM Banker WHERE Banker_Return_State = '0' AND Banker_Set_ID = '{$tmp_Member_ID}' " ;				// 找出某欄位的總合
	$arrayInfo_Banker = func_DatabaseGet( $tmpSQL_Banker , "SQL" , "" ) ;		// 取得資料庫資料
	// 當莊預扣金額(還沒有還)
	$tmp_Banker_Withhold_Money = (int)$arrayInfo_Banker['Banker_Withhold_Money_Total'] ;
	
	$tmpSQL_BetGodnine = "SELECT sum(BetGodnine_Withhold_Chips) as BetGodnine_Withhold_Chips_Total FROM BetGodnine WHERE BetGodnine_Draw = '0' AND BetGodnine_Member_ID = '{$tmp_Member_ID}' AND BetGodnine_On = '1'" ;				// 找出某欄位的總合
	$arrayInfo_BetGodnine = func_DatabaseGet( $tmpSQL_BetGodnine , "SQL" , "" ) ;		// 取得資料庫資料
	// 下注預扣金額(還沒有還)
	$tmp_Bet_Withhold_Money = (int)$arrayInfo_BetGodnine['BetGodnine_Withhold_Chips_Total'] ;

	// 會員還可以使用金額 = 會員目前擁有金額 - 當莊預扣金額(還沒有還) - 下注預扣金額(還沒有還)
	$tmp_MemberFreePoint = $tmp_Member_Money - $tmp_Banker_Withhold_Money - $tmp_Bet_Withhold_Money ;
	//echo "會員還可以使用金額($tmp_MemberFreePoint) = 會員目前擁有金額($tmp_Member_Money) - 當莊預扣金額($tmp_Banker_Withhold_Money) - 下注預扣金額($tmp_Bet_Withhold_Money)<br>" ;
	
	return $tmp_MemberFreePoint ;
}
//~@_@~// END 取得會員還可以使用金額 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定會員進入房間資訊 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_setMemberINRoomInfo( $sub_Member_ID = "" , $sub_Room_Num = "" )
{
	global $link;
	/*
	範例			: GodNine_setMemberINRoomInfo( $sub_Member_ID ) ;		// 設定會員進入房間資訊
	功能			: 設定會員進入房間資訊
	修改日期		: 200805
	參數說明 :
		$sub_Member_ID	會員ID
		$sub_Room_Num	房間編號
	回傳參數 :
	使用範例 :		:
		GodNine_setMemberINRoomInfo( $sub_Member_ID ) ;		// 設定會員進入房間資訊
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	// 找出會員資料
	if( empty($sub_Member_ID) )
	{	$sub_Member_ID = $_SESSION['Member_ID'] ;	}
	// 房間編號
	if( empty($sub_Room_Num) )
	{	$sub_Room_Num = GodNine_getRoomNum() ;	}

	$arrayField['Member_INRoom_Num'] = $sub_Room_Num ;			// 進入房間號
	$arrayField['Member_INRoom_DT'] = date("Y-m-d H:i:s") ;	// 進入房間時間
	$Bol = func_DatabaseBase( "Member" , "MOD" , $arrayField , " Member_ID = '$sub_Member_ID'" ) ;						// 資料庫處理

}
//~@_@~// END 設定會員進入房間資訊 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 遊戲相關
//~@_@~// START 取得房間編號 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getRoomNum( $sub_Room_Type  = "N" )
{
	global $link;
	global $MAIN_BASE_ADDRESS ;
	/*
	範例			: $tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號
	功能			: 取得房間編號
	修改日期		: 200624
	參數說明 :
		$sub_Room_Type	房間秀出模式( N : 數字 , E : 英文)
	回傳參數 :
		$tmp_RoomNum		房間編號
	使用範例 :		:
		$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號
		$tmp_RoomNum = GodNine_getRoomNum("E") ;		// 取得房間編號(: 英文)
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	// 設定房間的籌碼編號
//	if( $_SESSION['Chips'] == 50 )
//	{	$tmp_Chips = "050" ;	}
//	else
//	{	$tmp_Chips = $_SESSION['Chips'] ;	}
	if( $sub_Room_Type == "E" )
	{
	    include_once($MAIN_BASE_ADDRESS . "Project/GodNine/array/Array_Room_Type.inc") ;        // 房間編號
		$tmp_Chips = func_addFix0( $_SESSION['Chips'] , 4 ) ;
		$tmp_Chips = $Array_Room_Type[$tmp_Chips] ;
		return "{$tmp_Chips}{$_SESSION['zone_code']}{$_SESSION['Room']}";
	}
	else
	{
		$tmp_Chips = func_addFix0( $_SESSION['Chips'] , 4 ) ;
		return "R{$tmp_Chips}{$_SESSION['zone_code']}{$_SESSION['Room']}";
	}
}
//~@_@~// END 取得房間編號 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 轉換房間編號 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_chnageRoomNum( $sub_Room_Num )
{
	global $link;
	global $MAIN_BASE_ADDRESS ;
	global $Array_Room_Type ;
	/*
	範例			: $tmp_RoomNum = GodNine_chnageRoomNum( $sub_Room_Num ) ;		// 轉換房間編號
	功能			: 轉換房間編號
	修改日期		: 200624
	參數說明 :
		$sub_Room_Num	房間編號
	回傳參數 :
		$tmp_RoomNum	轉換後房間編號
	使用範例 :		:
	include_once($MAIN_BASE_ADDRESS . "Project/GodNine/array/Array_Room_Type.inc") ;        // 房間編號
		global $Array_Room_Type;
		$tmp_RoomNum = GodNine_chnageRoomNum( $sub_Room_Num ) ;		// 轉換房間編號
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	include_once($MAIN_BASE_ADDRESS . "Project/GodNine/array/Array_Room_Type.inc") ;        // 房間編號

	// 取出金額資料
	$tmp_Chips = mb_substr( $sub_Room_Num , 1 , 4 , "utf-8");
	$tmp_Num = mb_substr( $sub_Room_Num , 5 , 2 , "utf-8");
	//echo "$sub_Room_Num -> $tmp_Chips - $tmp_Num<br>" ;
	
	$tmp_Chips = $Array_Room_Type[$tmp_Chips] ;
	return "{$tmp_Chips}$tmp_Num";
}
//~@_@~// END 轉換房間編號 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得本期其他人的選位列表 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getOtherSeatNumber( $sub_Bingo_Period = "" , $sub_RoomNum = "" )
{
	global $link;
	/*
	範例			: $array_OtherSeatInfo = GodNine_getOtherSeatNumber() ;		// 取得本期其他人的選位列表
	功能			: 取得本期其他人的選位列表
	修改日期		: 200611
	參數說明 :
		$sub_Bingo_Period		要查詢的期數(沒設為當期)
		$sub_RoomNum			要查詢的房間(沒設為SESSION中設定)
	回傳參數 :
		$array_OtherSeatInfo		其他人的選位列表
			$array_OtherSeatInfo['Num']		其他人的選位列表
			$array_OtherSeatInfo['Name']	其他人的名稱列表
	使用範例 :		:
		$array_OtherSeatInfo = GodNine_getOtherSeatNumber() ;		// 取得本期其他人的選位列表
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// 找出查詢的期數
	if( empty($sub_Bingo_Period) )
	{
		$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
		//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
		$sub_Bingo_Period = $array_BingoPeriod['NowBingo'] ;
	}

	// 找出要查詢的房間
	if( empty($sub_Room) )
	{
		$sub_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號
	}
	
	$array_BetGodnine_Num = array();
	
	$SQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period = '$sub_Bingo_Period' AND BetGodnine_Member_ID != '{$_SESSION['Member_ID']}' AND BetGodnine_Room = '$sub_RoomNum' AND BetGodnine_On = '1' ORDER BY BetGodnine_Num" ;
	//echo $SQL . "<br>" ; 
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			$array_BetGodnine_Num[] = $LIST['BetGodnine_Num'];
			$array_BetGodnine_Name[] = $LIST['BetGodnine_Member_Name'];
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}

	$array_OtherSeatInfo['Num'] = array2str( $array_BetGodnine_Num , "," ); 		// 其他人的選位列表
	$array_OtherSeatInfo['Name'] = array2str( $array_BetGodnine_Name , "," );		// 其他人的名稱列表

	return $array_OtherSeatInfo ;
}
//~@_@~// END 取得本期其他人的選位列表 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得閒家的選位列表 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getUserSeatNumber( $sub_Bingo_Period = "" , $sub_RoomNum = "" , $sub_WinLost_Money = 0 )
{
	global $link;
	/*
	範例			: $tmp_UserSeatNumber = GodNine_getUserSeatNumber() ;		// 取得閒家的選位列表
	功能			: 取得閒家的選位列表
	修改日期		: 200612
	參數說明 :
		$sub_Bingo_Period		要查詢的期數(沒設為當期)
		$sub_RoomNum			要查詢的房間(沒設為SESSION中設定)
		$sub_WinLost_Money		回傳輸贏金額(0:選位列表,1:輸贏金額)
	回傳參數 :
		$tmp_UserSeatNumber		閒家的選位列表
	使用範例 :		:
		$tmp_UserSeatNumber = GodNine_getUserSeatNumber() ;		// 取得閒家的選位列表
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	// 找出查詢的期數
	if( empty($sub_Bingo_Period) )
	{
		$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
		//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
		$sub_Bingo_Period = $array_BingoPeriod['NowBingo'] ;
	}

	// 找出要查詢的房間
	if( empty($sub_Room) )
	{
		$sub_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號
	}
	
	$array_BetGodnine_Num = array();
	if( $sub_WinLost_Money == 1 )
	{
		for( $i = 0 ; $i < 40 ; $i++ )
		{// unset()
			$array_BetGodnine_Num[$i] = "" ;
		}

	}
	
	$SQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period = '$sub_Bingo_Period' AND BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' AND BetGodnine_Room = '$sub_RoomNum' AND BetGodnine_On = '1' ORDER BY BetGodnine_Num" ;
	//echo $SQL . "<br>" ; 
	//return $SQL ;
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			if( $sub_WinLost_Money == 1 )
			{	$array_BetGodnine_Num[$LIST['BetGodnine_Num']-1] = $LIST['BetGodnine_Member_WinLost_Money'];	}
			else
			{	$array_BetGodnine_Num[] = $LIST['BetGodnine_Num'];	}
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}

	return array2str( $array_BetGodnine_Num , "," ) ;
}
//~@_@~// END 取得閒家的選位列表 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得會員預扣點數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getMember_Withhold_Points( $sub_Member_ID = 0 )
{
	global $link;
	/*
	範例			: $tmp_Member_Withhold_Points = GodNine_getMember_Withhold_Points($sub_Member_ID) ;		// 取得會員預扣點數
	功能			: 取得會員預扣點數
	修改日期		: 200612
	參數說明 :
		$sub_Member_ID		會員ID
	回傳參數 :
		$tmp_Member_Withhold_Points		會員預扣點數
	使用範例 :		:
		$tmp_Member_Withhold_Points = GodNine_getMember_Withhold_Points( $_SESSION['Member_ID'] ) ;		// 取得會員預扣點數
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	if( empty($sub_Member_ID) )
	{	$sub_Member_ID = $_SESSION['Member_ID'];	}

	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
	//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
	
	// 求出當莊預扣金額
	$tmp_Banker_Withhold_Money = 0 ;

	// 找出本房間排莊人數
	$tmpSQL = "SELECT sum(Banker_Withhold_Money) as Banker_Withhold_Money_Total FROM Banker WHERE Banker_Set_ID = '{$_SESSION['Member_ID']}' AND Banker_Bingo_Period >= '{$array_BingoPeriod['NowBingo']}' " ;				// 找出某欄位的總合
	$array_Banker_Info = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料

	$tmp_Banker_Withhold_Money += $array_Banker_Info['Banker_Withhold_Money_Total'] ;

	// 求出下注預扣點數
	$tmpSQL_BetGodnine = "SELECT sum(BetGodnine_Withhold_Chips) as BetGodnine_Withhold_Chips_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND BetGodnine_Member_ID = '$sub_Member_ID' AND BetGodnine_On = '1'" ;				// 找出某欄位的總合
	$array_BetGodnine_Info = func_DatabaseGet( $tmpSQL_BetGodnine , "SQL" , "" ) ;		// 取得資料庫資料
	
	return ($array_BetGodnine_Info['BetGodnine_Withhold_Chips_Total'] + $tmp_Banker_Withhold_Money) ;
}
//~@_@~// END 取得會員預扣點數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得會員上期派彩點數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getMember_LastPayoutPoints( $sub_Member_ID = 0 )
{
	global $link;
	/*
	範例			: $tmp_Member_LastPayoutPoints = GodNine_getMember_LastPayoutPoints($sub_Member_ID) ;		// 取得會員上期派彩點數
	功能			: 取得會員上期派彩點數
	修改日期		: 200612
	參數說明 :
		$sub_Member_ID		會員ID
	回傳參數 :
		$tmp_Member_LastPayoutPoints		會員預扣點數
	使用範例 :		:
		$tmp_Member_LastPayoutPoints = GodNine_getMember_LastPayoutPoints( $_SESSION['Member_ID'] ) ;		// 取得會員上期派彩點數
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	if( empty($sub_Member_ID) )
	{	$sub_Member_ID = $_SESSION['Member_ID'];	}

	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
	//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
	
	$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號

	// 求出當莊預扣金額
	$tmp_Banker_Withhold_Money = 0 ;

	// 求出莊家上期派彩點數
	$tmpSQL_Babker_BetGodnine = "SELECT sum(BetGodnine_Banker_WinLost_Money) as BetGodnine_Banker_WinLost_Money_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['LastBingo']}' AND BetGodnine_Room = '$tmp_RoomNum' AND BetGodnine_Banker_ID = '$sub_Member_ID' AND BetGodnine_On = '1'" ;				// 找出某欄位的總合
	$array_BetGodnine_Babker_Info = func_DatabaseGet( $tmpSQL_Babker_BetGodnine , "SQL" , "" ) ;		// 取得資料庫資料

// SELECT sum(BetGodnine_Banker_WinLost_Money) as BetGodnine_Banker_WinLost_Money_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '109036672' AND BetGodnine_Room = 'R010011' BetGodnine_Banker_ID = 'Member2005220007' AND BetGodnine_On = '1'

	// 求出閒家上期派彩點數
	$tmpSQL_BetGodnine = "SELECT sum(BetGodnine_Member_WinLost_Money) as BetGodnine_Member_WinLost_Money_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['LastBingo']}' AND BetGodnine_Room = '$tmp_RoomNum' AND BetGodnine_Member_ID = '$sub_Member_ID' AND BetGodnine_On = '1'" ;				// 找出某欄位的總合
	$array_BetGodnine_Member_Info = func_DatabaseGet( $tmpSQL_BetGodnine , "SQL" , "" ) ;		// 取得資料庫資料
//array_BetGodnine_Babker_Info
	// SELECT sum(BetGodnine_WinLost_Money) as BetGodnine_WinLost_Money_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '109033131' AND BetGodnine_Member_ID = 'Member2005100001' AND BetGodnine_On = '1'
	// SELECT sum(BetGodnine_WinLost_Money) as BetGodnine_WinLost_Money_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '109033131'

	//return $tmpSQL_BetGodnine ;
	return ($array_BetGodnine_Member_Info['BetGodnine_Member_WinLost_Money_Total'] + $array_BetGodnine_Babker_Info['BetGodnine_Banker_WinLost_Money_Total']) ;
	//return 500 ;
}
//~@_@~// END 取得會員上期派彩點數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得會員上期輸贏點數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getMember_LastWinLostPoints( $sub_Member_ID = "" )
{
	global $link;
	/*
	範例			: $array_LastWinLostPoints = GodNine_getMember_LastWinLostPoints($sub_Member_ID) ;		// 取得會員上期輸贏點數
	功能			: 取得會員上期輸贏點數
	修改日期		: 200806
	參數說明 :
		$sub_Member_ID		會員ID
	回傳參數 :
		$array_LastWinLostPoints		會員上期輸贏點數
			$array_LastWinLostPoints['WinLost_Area1_Points']		// 上期輪莊區金額
			$array_LastWinLostPoints['WinLost_Area2_Points']		// 上期長莊區金額
			$array_LastWinLostPoints['WinLost_Total_Points']		// 上期輸贏總計
			
	使用範例 :		:
		$array_LastWinLostPoints = GodNine_getMember_LastWinLostPoints( $_SESSION['Member_ID'] ) ;		// 取得會員上期輸贏點數
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	if( empty($sub_Member_ID) )
	{	$sub_Member_ID = $_SESSION['Member_ID'];	}

	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
	//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
	
	//$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號

	// 求出當莊預扣金額
	$array_LastWinLostPoints['WinLost_Area1_Points'] = 0 ;		// 上期輪莊區金額
	$array_LastWinLostPoints['WinLost_Area2_Points'] = 0 ;		// 上期長莊區金額
	$array_LastWinLostPoints['WinLost_Total_Points'] = 0 ;		// 上期輸贏總計

	// 求出莊家上期派彩點數
	$tmpSQL_Babker_BetGodnine = "SELECT sum(BetGodnine_Banker_WinLost_Money) as BetGodnine_Banker_WinLost_Money_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['LastBingo']}' AND BetGodnine_Banker_ID = '$sub_Member_ID' AND BetGodnine_On = '1'" ;				// 找出某欄位的總合
	$array_BetGodnine_Babker_Info = func_DatabaseGet( $tmpSQL_Babker_BetGodnine , "SQL" , "" ) ;		// 取得資料庫資料

	// 求出閒家上期輪莊派彩點數
	$tmpSQL_BetGodnine1 = "SELECT sum(BetGodnine_Member_WinLost_Money) as BetGodnine_Member_WinLost_Money_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['LastBingo']}' AND BetGodnine_Member_ID = '$sub_Member_ID' AND BetGodnine_Type = '1' AND BetGodnine_On = '1'" ;				// 找出某欄位的總合
	$array_BetGodnine_Member_Info1 = func_DatabaseGet( $tmpSQL_BetGodnine1 , "SQL" , "" ) ;		// 取得資料庫資料

	$array_LastWinLostPoints['WinLost_Area1_Points'] = (int)($array_BetGodnine_Babker_Info['BetGodnine_Banker_WinLost_Money_Total'] + $array_BetGodnine_Member_Info1['BetGodnine_Member_WinLost_Money_Total']) ;		// 上期輪莊區金額

	// 求出閒家上期長莊派彩點數
	$tmpSQL_BetGodnine2 = "SELECT sum(BetGodnine_Member_WinLost_Money) as BetGodnine_Member_WinLost_Money_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['LastBingo']}' AND BetGodnine_Member_ID = '$sub_Member_ID' AND BetGodnine_Type = '2' AND BetGodnine_On = '1'" ;				// 找出某欄位的總合
	$array_BetGodnine_Member_Info2 = func_DatabaseGet( $tmpSQL_BetGodnine2 , "SQL" , "" ) ;		// 取得資料庫資料

	$array_LastWinLostPoints['WinLost_Area2_Points'] = (int)$array_BetGodnine_Member_Info2['BetGodnine_Member_WinLost_Money_Total'] ;		// 上期長莊區金額
	$array_LastWinLostPoints['WinLost_Total_Points'] = (int)($array_LastWinLostPoints['WinLost_Area1_Points'] + $array_LastWinLostPoints['WinLost_Area2_Points']) ;		// 上期輸贏總計

	return $array_LastWinLostPoints ;
}
//~@_@~// END 取得會員上期輸贏點數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得排莊列表 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_htmlBankerArea()
{
	global $link;
	/*
	範例			: $tmp_htmlBankerArea = GodNine_htmlBankerArea() ;		// 取得排莊列表
	功能			: 取得排莊列表
	修改日期		: 200612
	參數說明 :
		無
	回傳參數 :
		$tmp_htmlBankerArea		排莊列表資料
	使用範例 :		:
		$tmp_htmlBankerArea = GodNine_htmlBankerArea() ;		// 取得排莊列表
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	$tmp_htmlBankerArea = "" ;

	$tmp_Real_Time = $tmpDate = funct_ChangTime( date("Y-m-d H:i:s") , "PS" , 9 ) ;		// 改變時間
	$array_BingoPeriod = WinHappy_checkBingoPeriod($tmp_Real_Time = $tmpDate) ;		// 判斷Bingo期號
	//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
	
	$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號
	// 1031修改排莊顯示
	// 如果為長莊區內定為系統作莊
	if( $_SESSION['zone_code'] == 2 )
	{
		$tmp_htmlBankerArea = "							<p id='N' class='BankerInfo'>系統</p>\n";
		
		//找出莊家為值切換資料並將json解回Array
		$tmp_BankerList_SQL = "SELECT ApplyBanker_Set_Array FROM Agent WHERE id_Agent=1" ; 
		$array_BankerList_Info = func_DatabaseGet( $tmp_BankerList_SQL , "SQL" , "" )['ApplyBanker_Set_Array'];		// 取得資料庫資料
		$array_BankerList_Info = json_decode($array_BankerList_Info,true);
		
		//判斷若第一次設定預設名稱
		if((!$array_BankerList_Info['Now_Banker_Seat'])||(!$array_BankerList_Info['Now_Period'])||($array_BankerList_Info['Next_Period']<$array_BingoPeriod['NowBingo']))
		{
			$tmp_htmlBankerArea = "							<p id='N' class='BankerInfo'>系統</p>\n";
		}
		else
		{
			$tmp_htmlBankerArea = "";
			//尋找桌次
			for($i=0;$i<count($array_BankerList_Info['Banker_Info']);$i++)
			{
				if($array_BankerList_Info['Banker_Info'][$i]['Banker']==$array_BankerList_Info['Next_Banker_Seat'])
				{
					$tmp_htmlBankerArea .= "							<p id='N' class='BankerInfo'>系統({$array_BankerList_Info['Banker_Info'][$i]['Banker_Name']})</p>\n";
				}
			}
			
			//$tmp_htmlBankerArea .= "							<p id='N' class='BankerInfo'>系統({$array_BankerList_Info['Now_Banker_Seat']})</p>\n";
			//$tmp_htmlBankerArea .= "							<p id='N' class='BankerInfo'>系統({$array_BankerList_Info['Next_Banker_Seat']})</p>\n";
			
		}
		
	}
	else
	{
		$SQL_ApplyBanker = "SELECT * FROM ApplyBanker WHERE ( ApplyBanker_Bingo_Period_Start >= '{$array_BingoPeriod['NowBingo']}' OR ApplyBanker_Bingo_Period_End >= '{$array_BingoPeriod['NowBingo']}' ) AND ApplyBanker_Room = '$tmp_RoomNum' AND ApplyBanker_On = '1'" ;
		//echo $SQL_ApplyBanker . "<br>" ; 
		//SELECT * FROM ApplyBanker WHERE ApplyBanker_Bingo_Period >= '109032880' AND ApplyBanker_Room = 'R05012' AND ApplyBanker_On = '1'
		$QUERY_ApplyBanker = mysqli_query($link , $SQL_ApplyBanker) ;
		
		// 是否有資料
		if ( mysqli_num_rows($QUERY_ApplyBanker) )
		{
			$tmp_Index = 0 ;
			// 一條條獲取
			while ($LIST_ApplyBanker = mysqli_fetch_assoc($QUERY_ApplyBanker))
			{
				// 是否本期有人當莊,沒有則秀出流局
//				if( !($LIST_ApplyBanker['ApplyBanker_Bingo_Period_Start'] == $array_BingoPeriod['NowBingo'] OR $LIST_ApplyBanker['ApplyBanker_Bingo_Period_End'] == $array_BingoPeriod['NowBingo'] ) AND $tmp_Index == 0 )
//				{
//					$tmp_htmlBankerArea .= "							<p id='N' class='BankerInfo'>流局</p>\n";
//				}
				if($tmp_Index == 0 AND $tmp_htmlBankerArea == "" )
				//{	$tmp_Banker_Style = "background-color:#FCEE21;color:#000;font-weight:bold;" ;	}
				{	$tmp_Banker_Style = "" ;	}
				else
				{	$tmp_Banker_Style = "" ;	}
				
				$tmp_htmlBankerArea .= "							<p id='{$LIST_ApplyBanker['ApplyBanker_Set_ID']}' class='BankerInfo' style='$tmp_Banker_Style'>" . mb_substr($LIST_ApplyBanker['ApplyBanker_Operator_Name'] , 0 , 3 , "utf-8") . "</p>\n";
				$tmp_Index++ ;
			}
			
			// 釋放結果集合
			mysqli_free_result($QUERY_ApplyBanker);
		}
		else
		{// 沒有任何人當莊則流局
		//	echo "							<p id='N' class='BankerInfo'>系統</p>\n";
		//	$tmp_htmlBankerArea .= "							<p id='N' class='BankerInfo'>流局</p>\n";
		//	echo "							<button class=\"button-orange\" id='Apply_Banker' @click=\"FApply_Banker\">申請排莊</button>\n";
		}
	}
	return $tmp_htmlBankerArea ;
}
//~@_@~// END 取得排莊列表 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 統計報表
//~@_@~// START 取得下注相關金額 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getBetGodnineMoney( $subSQL , $subID = "" )
{
	global $link;
	global $ShowDebug ;
	/*
	範例			: $array_BetGodnineMoney = GodNine_getBetGodnineMoney( $subSQL , $subID ) ;		// 取得下注相關金額
	功能			: 取得下注相關金額
	修改日期		: 20200617
	參數說明 :
		$subSQL		查詢相關下注SQL
		$subID		比對id(會員ID或代理人id)
	回傳參數 :
		$array_BetGodnineMoney[1]				輪莊有倍數
		$array_BetGodnineMoney[2]				長莊無倍數	
			$array_BetGodnineMoney[1]['BetGodnine_Money']						投注金額
			$array_BetGodnineMoney[1]['BetGodnine_WinLost_AllMoney']			輸贏金額
			$array_BetGodnineMoney[1]['BetGodnine_Online_Backwater_Money']	會員返水
			$array_BetGodnineMoney[1]['BetGodnine_Online_WinLost_Money']		總金額
			$array_BetGodnineMoney[1]['BetGodnine_Online_Reported_Money']		報帳金額
	使用範例 :
		$tmp_SQL_BetGodnine = "SELECT * FROM BetGodnine WHERE BetGodnine_Online_id LIKE '%,{$LIST_Agent['id_Agent']},%' AND BetGodnine_Add_DT >= '$Report_Start_Date 00:00:00' AND BetGodnine_Add_DT <= '$Report_End_Date 23:59:59'" ;
		$array_BetGodnineMoney = GodNine_getBetGodnineMoney( $tmp_SQL_BetGodnine , $LIST_Agent['id_Agent'] ) ;		// 取得下注相關金額
		// $array_BetGodnineMoney['BetGodnine_Num'] : 有下注筆數
		// $array_BetGodnineMoney[1][]
		// 一維陣列 -> 1 : 輪莊有倍數 , 2 : 長莊無倍數
		// 二維陣列 ->
		// BetGodnine_Money : 投注金額 , BetGodnine_WinLost_AllMoney : 輸贏金額 , BetGodnine_Online_Backwater_Money : 會員返水
		// BetGodnine_Online_WinLost_Money : 總金額 , BetGodnine_Online_Reported_Money : 報帳金額
	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	$array_BetGodnineMoney = array();
	$array_BetGodnineMoney['BetGodnine_Num'] = 0 ;							// 有下注筆數
	$array_BetGodnineMoney[1]['BetGodnine_Money'] = 0 ;						// 投注金額
	$array_BetGodnineMoney[1]['BetGodnine_Online_WinLost_Money'] = 0 ;		// 總金額
	$array_BetGodnineMoney[1]['BetGodnine_Online_Backwater_Money'] = 0 ;		// 會員返水
	$array_BetGodnineMoney[1]['BetGodnine_Online_AllMoney'] = 0 ;				// 輸贏金額
	$array_BetGodnineMoney[1]['BetGodnine_Online_Reported_Money'] = 0 ;		// 報帳金額

	$array_BetGodnineMoney[2]['BetGodnine_Money'] = 0 ;						// 投注金額
	$array_BetGodnineMoney[2]['BetGodnine_Online_WinLost_Money'] = 0 ;		// 總金額
	$array_BetGodnineMoney[2]['BetGodnine_Online_Backwater_Money'] = 0 ;		// 會員返水
	$array_BetGodnineMoney[2]['BetGodnine_Online_AllMoney'] = 0 ;				// 輸贏金額
	$array_BetGodnineMoney[2]['BetGodnine_Online_Reported_Money'] = 0 ;		// 報帳金額
	
	$z = 0;
	
	
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "是否有下注資料 : $subSQL" ;	}
	
	$QUERY = mysqli_query($link , $subSQL) ;
	/*
	print_r($QUERY);
	
	echo "<br>";
	
	echo "是否有資料:".mysqli_num_rows($QUERY)."<br>";
	*/
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		if ( $tmpShowMsg OR $ShowDebug )	// 秀出除錯訊息 ██████████
		{
			
			//echo "我有進來這1<br>";
			
			global $AID ;
			global $Report_Start_Date;
			global $Report_End_Date;
			global $Report_Start_Hour;
			global $Report_End_Hour;
			$tmp_URL = "?AID=$AID&Report_Start_Date=$Report_Start_Date&Report_End_Date=$Report_End_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Hour=$Report_End_Hour" ;
			echo "<hr><a href='$tmp_URL&ShowDebug=WM'>輸贏金額(WM)</a> , <a href='$tmp_URL&ShowDebug=BM'>返水(BM)</a> , <a href='$tmp_URL&ShowDebug=AM'>總金額(AM)</a> , <a href='$tmp_URL&ShowDebug=RM'>報帳金額(RM)</a><br>";
		}

		$array_BetGodnineMoney['BetGodnine_Num'] = mysqli_num_rows($QUERY) ;						// 有下注筆數
		
		//echo "資料來源:".$array_BetGodnineMoney['BetGodnine_Num']."<br>";
		
		
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			
			//echo "我有進來這2<br>";
			
			// 初始資料
			$tmp_BetGodnine_Money = 0 ;
			$tmp_BetGodnine_Online_WinLost_Money = 0 ;
			$tmp_BetGodnine_Online_Backwater_Money = 0 ;
			$tmp_BetGodnine_Online_AllMoney = 0 ;
			$tmp_BetGodnine_Online_Reported_Money = 0 ;
			//echo "{$LIST['BetGodnine_ID']}<br>" ;

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "下注ID : {$LIST['BetGodnine_ID']}<br>" ;	}

			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "下注區 : {$LIST['BetGodnine_Type']}<br>" ;	}

			// id前6字是否為Member
			if ( mb_substr($subID , 0 , 6 , "utf-8") == "Member" )
			{// 會員查詢
				
				//echo "我有進來這3<br>";
				
				// 是否為閒家
				if( $LIST['BetGodnine_Member_ID'] == $subID )// 閒家欄位
				{
					$tmp_Field = "Member" ;
					
					// 輸贏金額
					//$array_BetGodnine_Banker_Online_WinLost_Money = str2array( $LIST['BetGodnine_WinLost_Money'] , "," );
					$tmp_BetGodnine_Online_WinLost_Money += $LIST['BetGodnine_' . $tmp_Field . '_WinLost_Money'] ;
					if ( $tmpShowMsg OR $ShowDebug == "WM"  )	// 秀出除錯訊息 ██████████
					{	echo "<h2>會員($tmp_Field)輸贏金額($tmp_BetGodnine_Online_WinLost_Money) + " . $LIST['BetGodnine_' . $tmp_Field . '_WinLost_Money'] . "</h2>" ;	}
					
					// 會員返水
					//$array_BetGodnine_Banker_Online_Backwater_Money = str2array( $LIST['BetGodnine_Banker_Online_Backwater_Money'] , "," );
					$tmp_BetGodnine_Online_Backwater_Money += $LIST['BetGodnine_' . $tmp_Field . '_Backwater_Money'] ;
					if ( $tmpShowMsg OR $ShowDebug == "BM"  )	// 秀出除錯訊息 ██████████
					{	echo "<h2>會員($tmp_Field)返水($tmp_BetGodnine_Online_Backwater_Money) + " . $LIST['BetGodnine_' . $tmp_Field . '_Backwater_Money'] . "</h2>" ;	}
		
					// 總金額
					//$array_BetGodnine_Banker_Online_AllMoney = str2array( $LIST['BetGodnine_Banker_Online_AllMoney'] , "," );
					$tmp_BetGodnine_Online_AllMoney += $LIST['BetGodnine_' . $tmp_Field . '_WinLost_AllMoney'] ;
					if ( $tmpShowMsg OR $ShowDebug == "AM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>會員($tmp_Field)總金額($tmp_BetGodnine_Online_AllMoney) + " . $LIST['BetGodnine_' . $tmp_Field . '_WinLost_AllMoney'] . "</h2>" ;	}
		
					// 報帳金額
					//$array_BetGodnine_Banker_Online_Reported_Money = str2array( $LIST['BetGodnine_Banker_Online_Reported_Money'] , "," );
					$tmp_BetGodnine_Online_Reported_Money += $LIST['BetGodnine_' . $tmp_Field . '_Report_Money'] ;
					if ( $tmpShowMsg OR $ShowDebug == "RM"  )	// 秀出除錯訊息 ██████████
					{	echo "<h2>會員($tmp_Field)報帳金額($tmp_BetGodnine_Online_Reported_Money) + " . $LIST['BetGodnine_' . $tmp_Field . '_Report_Money'] . "</h2>" ;	}
				}

				// 查詢莊家是否也為自己
				// 是否為閒家
				if( $LIST['BetGodnine_Banker_ID'] == $subID )// 閒家欄位
				{
					$tmp_Field = "Banker" ;
					
					// 輸贏金額
					//$array_BetGodnine_Banker_Online_WinLost_Money = str2array( $LIST['BetGodnine_WinLost_Money'] , "," );
					$tmp_BetGodnine_Online_WinLost_Money += $LIST['BetGodnine_' . $tmp_Field . '_WinLost_Money'] ;
					if ( $tmpShowMsg OR $ShowDebug == "WM"  )	// 秀出除錯訊息 ██████████
					{	echo "<h2>會員($tmp_Field)輸贏金額($tmp_BetGodnine_Online_WinLost_Money) + " . $LIST['BetGodnine_' . $tmp_Field . '_WinLost_Money'] . "</h2>" ;	}
					
					// 會員返水
					//$array_BetGodnine_Banker_Online_Backwater_Money = str2array( $LIST['BetGodnine_Banker_Online_Backwater_Money'] , "," );
					$tmp_BetGodnine_Online_Backwater_Money += $LIST['BetGodnine_' . $tmp_Field . '_Backwater_Money'] ;
					if ( $tmpShowMsg OR $ShowDebug == "BM"  )	// 秀出除錯訊息 ██████████
					{	echo "<h2>會員($tmp_Field)返水($tmp_BetGodnine_Online_Backwater_Money) + " . $LIST['BetGodnine_' . $tmp_Field . '_Backwater_Money'] . "</h2>" ;	}
		
					// 總金額
					//$array_BetGodnine_Banker_Online_AllMoney = str2array( $LIST['BetGodnine_Banker_Online_AllMoney'] , "," );
					$tmp_BetGodnine_Online_AllMoney += $LIST['BetGodnine_' . $tmp_Field . '_WinLost_AllMoney'] ;
					if ( $tmpShowMsg OR $ShowDebug == "AM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>會員($tmp_Field)總金額($tmp_BetGodnine_Online_AllMoney) + " . $LIST['BetGodnine_' . $tmp_Field . '_WinLost_AllMoney'] . "</h2>" ;	}
		
					// 報帳金額
					//$array_BetGodnine_Banker_Online_Reported_Money = str2array( $LIST['BetGodnine_Banker_Online_Reported_Money'] , "," );
					$tmp_BetGodnine_Online_Reported_Money += $LIST['BetGodnine_' . $tmp_Field . '_Report_Money'] ;
					if ( $tmpShowMsg OR $ShowDebug == "RM"  )	// 秀出除錯訊息 ██████████
					{	echo "<h2>會員($tmp_Field)報帳金額($tmp_BetGodnine_Online_Reported_Money) + " . $LIST['BetGodnine_' . $tmp_Field . '_Report_Money'] . "</h2>" ;	}
				}
				
			}
			else
			{// 代理人資料
				// 找出上線id
				if ( $tmpShowMsg OR $ShowDebug )	// 秀出除錯訊息 ██████████
				{	echo "上線{{$LIST['BetGodnine_Member_Name']} - id($subID) : {$LIST['BetGodnine_Online_id']}<br>" ;	}
				
				
				
				// 上線id去掉前後,再轉成陣列
				$tmp_BetGodnine_Online_id = mb_substr( $LIST['BetGodnine_Online_id'] , 1 , -1 , "utf-8");
				$array_BetGodnine_Online_id = str2array($tmp_BetGodnine_Online_id , ",");
				
				//echo $LIST['BetGodnine_Online_id']."<br>";
				
				//print_r($array_BetGodnine_Online_id);
				
				//echo "subID:".$subID." Online:".$array_BetGodnine_Online_id."<br>";
				
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				//{	echo "<h2>上線id陣列 , 原始參數 : {$tmp_BetGodnine_Online_id}</h2>" ;	}
				{	echo "<p>閒家上線id陣列</p>" ;print_r($array_BetGodnine_Online_id);echo "<br>" ;	}
	
				// 找出上線id的Key值
				$tmp_Index = array_search($subID , $array_BetGodnine_Online_id);
				
				//print_r(in_array($subID,$array_BetGodnine_Online_id));
				
				if(in_array($subID,$array_BetGodnine_Online_id))
				{// 閒家中有代理人資料
					if ( $tmpShowMsg OR $ShowDebug )	// 秀出除錯訊息 ██████████
					{	echo "<p>閒家代理人($subID) , 所在Index : $tmp_Index , 上線id : $tmp_BetGodnine_Online_id</p>" ;	}
		
					// 輸贏金額
					unset($array_BetGodnine_Online_WinLost_Money);
					$array_BetGodnine_Online_WinLost_Money = str2array( $LIST['BetGodnine_Online_WinLost_Money'] , "," );
					$tmp_BetGodnine_Online_WinLost_Money += $array_BetGodnine_Online_WinLost_Money[$tmp_Index] ;
					if ( $tmpShowMsg OR $ShowDebug == "WM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>閒家上線輸贏金額($tmp_Index) 值($tmp_BetGodnine_Online_WinLost_Money) + {$array_BetGodnine_Online_WinLost_Money[$tmp_Index]} , 原始參數 : {$LIST['BetGodnine_Online_WinLost_Money']}</h2>" ;	}
					
					//echo "<h2>閒家上線輸贏金額($tmp_Index) 值($tmp_BetGodnine_Online_WinLost_Money) + {$array_BetGodnine_Online_WinLost_Money[$tmp_Index]} , 原始參數 : {$LIST['BetGodnine_Online_WinLost_Money']}</h2><br>";
					
					// 會員返水
					unset($array_BetGodnine_Online_Backwater_Money);
					$array_BetGodnine_Online_Backwater_Money = str2array( $LIST['BetGodnine_Online_Backwater_Money'] , "," );
					$tmp_BetGodnine_Online_Backwater_Money += $array_BetGodnine_Online_Backwater_Money[$tmp_Index] ;
					if ( $tmpShowMsg OR $ShowDebug == "BM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>閒家上線會員返水($tmp_Index) 值($tmp_BetGodnine_Online_Backwater_Money) + {$array_BetGodnine_Online_Backwater_Money[$tmp_Index]} , 原始參數 : {$LIST['BetGodnine_Online_Backwater_Money']}</h2>" ;	}
		
					// 總金額
					unset($array_BetGodnine_Online_AllMoney);
					$array_BetGodnine_Online_AllMoney = str2array( $LIST['BetGodnine_Online_AllMoney'] , "," );
					$tmp_BetGodnine_Online_AllMoney += $array_BetGodnine_Online_AllMoney[$tmp_Index] ;
					if ( $tmpShowMsg OR $ShowDebug == "AM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>閒家上線總金額($tmp_Index) 值($tmp_BetGodnine_Online_AllMoney) + {$array_BetGodnine_Online_AllMoney[$tmp_Index]} , 原始參數 : {$LIST['BetGodnine_Online_AllMoney']}</h2>" ;	}
		
					// 報帳金額
					unset($array_BetGodnine_Online_Reported_Money);
					$array_BetGodnine_Online_Reported_Money = str2array( $LIST['BetGodnine_Online_Reported_Money'] , "," );
					$tmp_BetGodnine_Online_Reported_Money += $array_BetGodnine_Online_Reported_Money[$tmp_Index] ;
					if ( $tmpShowMsg OR $ShowDebug == "RM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>閒家上線報帳金額($tmp_Index) 值($tmp_BetGodnine_Online_Reported_Money) + {$array_BetGodnine_Online_Reported_Money[$tmp_Index]} , 原始參數 : {$LIST['BetGodnine_Online_Reported_Money']}</h2>" ;	}
				}

				// 找出莊家上線id資料
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "莊家上線id : {$LIST['BetGodnine_Banker_Online_id']}<br>" ;	}
				
				// 上線id去掉前後,再轉成陣列
				$tmp_BetGodnine_Banker_Online_id = mb_substr( $LIST['BetGodnine_Banker_Online_id'] , 1 , -1 , "utf-8");
				$array_BetGodnine_Banker_Online_id = str2array($tmp_BetGodnine_Banker_Online_id , ",");
	
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				//{	echo "<h2>上線id陣列 , 原始參數 : {$tmp_BetGodnine_Banker_Online_id}</h2>" ;	}
				{	echo "<p>莊家上線id陣列</p>" ;print_r($array_BetGodnine_Banker_Online_id);echo "<br>" ;	}
	
				// 找出莊家上線id的Key值
				$tmp_Banker_Index = array_search($subID , $array_BetGodnine_Banker_Online_id);
				if(in_array($subID,$array_BetGodnine_Banker_Online_id))
				{// 莊家中有代理人資料
					if ( $tmpShowMsg OR $ShowDebug )	// 秀出除錯訊息 ██████████
					{	echo "<p>莊家代理人($subID) , 所在Index : $tmp_Banker_Index , 上線id : $tmp_BetGodnine_Online_id</p>" ;	}
		
					// 清空陣列資料
					unset($array_BetGodnine_Banker_Online_WinLost_Money);
					unset($array_BetGodnine_Banker_Online_Backwater_Money);
					unset($array_BetGodnine_Banker_Online_AllMoney);
					unset($array_BetGodnine_Online_Reported_Money);

					// 輸贏金額
					$array_BetGodnine_Banker_Online_WinLost_Money = str2array( $LIST['BetGodnine_Banker_Online_WinLost_Money'] , "," );
					$tmp_BetGodnine_Online_WinLost_Money += $array_BetGodnine_Banker_Online_WinLost_Money[$tmp_Banker_Index] ;
					if ( $tmpShowMsg OR $ShowDebug == "WM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>莊家輸贏金額($tmp_Banker_Index) 值($tmp_BetGodnine_Online_WinLost_Money) + {$array_BetGodnine_Banker_Online_WinLost_Money[$tmp_Banker_Index]} , 原始參數 : {$LIST['BetGodnine_Banker_Online_WinLost_Money']}</h2>" ;	}
					
					// 會員返水
					$array_BetGodnine_Banker_Online_Backwater_Money = str2array( $LIST['BetGodnine_Banker_Online_Backwater_Money'] , "," );
					$tmp_BetGodnine_Online_Backwater_Money += $array_BetGodnine_Banker_Online_Backwater_Money[$tmp_Banker_Index] ;
					if ( $tmpShowMsg OR $ShowDebug == "BM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>莊家會員返水($tmp_Banker_Index) 值($tmp_BetGodnine_Online_Backwater_Money) + {$array_BetGodnine_Banker_Online_Backwater_Money[$tmp_Banker_Index]} , 原始參數 : {$LIST['BetGodnine_Banker_Online_Backwater_Money']}</h2>" ;	}
		
					// 總金額
					$array_BetGodnine_Banker_Online_AllMoney = str2array( $LIST['BetGodnine_Banker_Online_AllMoney'] , "," );
					$tmp_BetGodnine_Online_AllMoney += $array_BetGodnine_Banker_Online_AllMoney[$tmp_Banker_Index] ;
					if ( $tmpShowMsg OR $ShowDebug == "AM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>莊家總金額($tmp_Banker_Index) 值($tmp_BetGodnine_Online_AllMoney) + {$array_BetGodnine_Banker_Online_AllMoney[$tmp_Banker_Index]} , 原始參數 : {$LIST['BetGodnine_Banker_Online_AllMoney']}</h2>" ;	}
		
					// 報帳金額
					$array_BetGodnine_Banker_Online_Reported_Money = str2array( $LIST['BetGodnine_Banker_Online_Reported_Money'] , "," );
					$tmp_BetGodnine_Online_Reported_Money += $array_BetGodnine_Banker_Online_Reported_Money[$tmp_Banker_Index] ;
					if ( $tmpShowMsg OR $ShowDebug == "RM" )	// 秀出除錯訊息 ██████████
					{	echo "<h2>莊家報帳金額($tmp_Banker_Index) 值($tmp_BetGodnine_Online_Reported_Money) + {$array_BetGodnine_Banker_Online_Reported_Money[$tmp_Banker_Index]} , 原始參數 : {$LIST['BetGodnine_Banker_Online_Reported_Money']}</h2>" ;	}
				}
			}

			// 投注金額(下注)
			$array_BetGodnineMoney[$LIST['BetGodnine_Type']]['BetGodnine_Money'] += $LIST['BetGodnine_Chips'] ;

			// 輸贏金額
			$array_BetGodnineMoney[$LIST['BetGodnine_Type']]['BetGodnine_Online_WinLost_Money'] += $tmp_BetGodnine_Online_WinLost_Money ;
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "輸贏金額({$LIST['BetGodnine_Type']}) : {$array_BetGodnineMoney[$LIST['BetGodnine_Type']]['BetGodnine_Online_WinLost_Money']} += {$tmp_BetGodnine_Online_WinLost_Money}($tmp_Index)<br>" ;	}

			// 會員返水			
			$array_BetGodnineMoney[$LIST['BetGodnine_Type']]['BetGodnine_Online_Backwater_Money'] += $tmp_BetGodnine_Online_Backwater_Money ;

			// 總金額	
			$array_BetGodnineMoney[$LIST['BetGodnine_Type']]['BetGodnine_Online_AllMoney'] += $tmp_BetGodnine_Online_AllMoney ;

			// 報帳金額
			$array_BetGodnineMoney[$LIST['BetGodnine_Type']]['BetGodnine_Online_Reported_Money'] += $tmp_BetGodnine_Online_Reported_Money ;
			//echo "報帳金額 : {$array_BetGodnineMoney[$LIST['BetGodnine_Type']]['BetGodnine_Online_Reported_Money']} += $tmp_BetGodnine_Online_Reported_Money<br>" ;
			
			//echo $z."<br>";
			//$z++;
			
		}
		
		//echo "最後數量:".$z;
		//print_r($array_BetGodnineMoney['BetGodnine_Num']);
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}

	
	
	return $array_BetGodnineMoney ;
}
//~@_@~// END 取得登入帳號的名字 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出報表內容 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_htmlReportInfo( $subType = "Agent" )
{
	global $link ;
	global $LIST_Agent ;
	global $LIST_Member ;
	global $array_BetGodnineMoney ;
	global $array_BackWater_Info ;
	global $sum_BetGodnine_Money ;	// 投注金額
	global $sum_BetGodnine_Online_WinLost_Money ;// 輸贏金額
	global $sum_BetGodnine_Online_Backwater_Money ;	// 會員返水
	global $sum_BetGodnine_Online_AllMoney ;				// 總金額
	global $sum_BetGodnine_Online_Reported_Money ;	// 報帳金額
	global $Report_Start_Date  ;
	global $Report_End_Date  ;
	global $tmp_Report_Start_Hour  ;
	global $tmp_Report_End_Hour  ;
	global $tmp_Index ;
	global $array_NowAgent_Info ;
	global $array_AgentReport_Info ;
	global $Report_Start_Date ;
	global $Report_Start_Hour ;
	global $Report_End_Date ;
	global $Report_End_Hour ;

	/*
	範例			: GodNine_htmlReportInfo() ;		// 秀出報表內容
	功能			: 秀出報表內容
	修改日期		: 20200529
	參數說明 :
		$subType 		呈現資料類別(Agent:代理人,Member:會員)
	回傳參數 :
		無
	使用範例 :
		GodNine_htmlReportInfo() ;		// 秀出報表內容
	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	$tmp_Index % 2 ? $tmp_TR_CSS = "table_list_tr_bgdack" : $tmp_TR_CSS = "table_list_tr_bglight"  ;
	
	echo "					<tr class=\"$tmp_TR_CSS\">\n";
	if( $subType == "Agent" )
	{// 代理
		echo "						<td rowspan=\"3\" align=\"center\">代理</td>\n";
		echo "						<td rowspan=\"3\" align=\"center\">{$LIST_Agent['Agent_Name']}</td>\n";
		echo "						<td rowspan=\"3\" align=\"center\">{$LIST_Agent['Agent_Login_Name']}</td>\n";
	}
	else
	{// 會員
		echo "						<td rowspan=\"3\" align=\"center\">會員</td>\n";
		echo "						<td rowspan=\"3\" align=\"center\">{$LIST_Member['Member_Name']}</td>\n";
		echo "						<td rowspan=\"3\" align=\"center\">{$LIST_Member['Member_Login_Name']}</td>\n";
	}
	
	if( $subType == "Agent" )// 代理
	{	$tmp_report_List1_Para = "report_List.php?Funct=report_List&Agent_ID={$LIST_Agent['id_Agent']}&BetGodnine_Type=1&Report_Start_Date=$Report_Start_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Date=$Report_End_Date&Report_End_Hour=$Report_End_Hour" ;	}
	else
	//{	$tmp_report_List1_Para = "report_List.php?Funct=report_List&MID={$LIST_Member['Member_ID']}&BetGodnine_Type=1&Report_Start_Date=$Report_Start_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Date=$Report_End_Date&Report_End_Hour=$Report_End_Hour" ;	}
	{	$tmp_report_List1_Para = "javascript:;" ;	}
	echo "						<td align=\"right\">輪莊有倍數區</td>\n";
	// 投注金額
	echo "						<td align=\"right\"><a href='$tmp_report_List1_Para'>" . WinHappy_setMoneyCss( $array_BetGodnineMoney[1]['BetGodnine_Money'] ) . "</td>\n";
	// 輸贏金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetGodnineMoney[1]['BetGodnine_Online_WinLost_Money'] ) . "</font></td>\n";
	// 會員返水
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetGodnineMoney[1]['BetGodnine_Online_Backwater_Money'] ) . "</font></td>\n";
	// 總金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetGodnineMoney[1]['BetGodnine_Online_AllMoney'] ) . "</font></td>\n";

	// 占成/退水
	if( $subType == "Agent" )// 代理
	{	echo "						<td align=\"right\">0%/{$LIST_Agent['Agent_Backwater']}%</td>\n";	}
	else
	{	echo "						<td align=\"right\">0%/{$array_NowAgent_Info['Agent_Backwater']}%</td>\n";	}

	// 報帳金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( func_Digital_Carry( $array_BetGodnineMoney[1]['BetGodnine_Online_Reported_Money'] , 2 , "round" ) ) . "</font></td>\n";

	// 查看明細
	if( $subType == "Agent" )// 代理
	{	echo "						<td rowspan=\"3\" align=\"center\"><a href=\"report.php?AID={$LIST_Agent['id_Agent']}&Report_Start_Date=$Report_Start_Date&Report_End_Date=$Report_End_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Hour=$Report_Start_Hour\">查看明細</a></td>\n";	}
	else
	{	echo "						<td rowspan=\"3\" align=\"center\"><a href=\"report_detail.php?MID={$LIST_Member['id_Member']}&Report_Start_Date=$Report_Start_Date&Report_End_Date=$Report_End_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Hour=$Report_Start_Hour\">查看明細</a></td>\n";	}

	echo "					</tr>\n";

	if( $subType == "Agent" )// 代理-
	{	$tmp_report_List2_Para = "report_List.php?Funct=report_List&Agent_ID={$LIST_Agent['id_Agent']}&BetGodnine_Type=2&Report_Start_Date=$Report_Start_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Date=$Report_End_Date&Report_End_Hour=$Report_End_Hour" ;	}
	else
	//{	$tmp_report_List2_Para = "report_List.php?Funct=report_List&MID=&MID={$LIST_Member['Member_ID']}&BetGodnine_Type=2&Report_Start_Date=$Report_Start_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Date=$Report_End_Date&Report_End_Hour=$Report_End_Hour" ;	}
	{	$tmp_report_List2_Para = "javascript:;" ;	}
	echo "					<tr class=\"$tmp_TR_CSS\">\n";
	echo "						<td align=\"right\">長莊無倍數區</td>\n";
	// 投注金額
	echo "						<td align=\"right\"><a href='$tmp_report_List2_Para'>" . WinHappy_setMoneyCss( $array_BetGodnineMoney[2]['BetGodnine_Money'] ) . "</a></td>\n";
	// 輸贏金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetGodnineMoney[2]['BetGodnine_Online_WinLost_Money'] ) . "</td>\n";
	// 會員返水
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetGodnineMoney[2]['BetGodnine_Online_Backwater_Money'] ) . "</td>\n";
	// 總金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( $array_BetGodnineMoney[2]['BetGodnine_Online_AllMoney'] ) . "</td>\n";

	// 占成/退水
	if( $subType == "Agent" )// 代理
	{	echo "						<td align=\"right\">{$LIST_Agent['Agent_Share']}%/{$LIST_Agent['Agent_Backwater2']}%</td>\n";	}
	else
	{	echo "						<td align=\"right\">{$array_AgentReport_Info['Agent_Share']}%/{$array_AgentReport_Info['Agent_Backwater2']}%</td>\n";	}

	// 報帳金額
	echo "						<td align=\"right\">" . WinHappy_setMoneyCss( func_Digital_Carry( $array_BetGodnineMoney[2]['BetGodnine_Online_Reported_Money'] , 2 , "round" ) ) . "</td>\n";
	echo "					</tr>\n";

	// 合計
	echo "					<tr class=\"$tmp_TR_CSS\">\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>合計</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>" . WinHappy_setMoneyCss( $sum_BetGodnine_Money ) . "</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>" . WinHappy_setMoneyCss( $sum_BetGodnine_Online_WinLost_Money ) . "</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>" . WinHappy_setMoneyCss( $sum_BetGodnine_Online_Backwater_Money ) . "</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\"><strong>" . WinHappy_setMoneyCss( $sum_BetGodnine_Online_AllMoney ) . "</strong></td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\">&nbsp;</td>\n";
	echo "						<td align=\"right\" bgcolor=\"#CCE6E1\">" . WinHappy_setMoneyCss( func_Digital_Carry( $sum_BetGodnine_Online_Reported_Money , 2 , "round" ) ) . "</td>\n";
	echo "					</tr>\n";
	
}
//~@_@~// END 秀出報表內容 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得會員帳務明細 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_htmlMember_Account_Details( $sub_Member_ID = 0 )
{
	global $link;
	/*
	範例			: GodNine_htmlMember_Account_Details($sub_Member_ID) ;		// 取得會員帳務明細
	功能			: 取得會員帳務明細
	修改日期		: 200612
	參數說明 :
		$sub_Member_ID		會員ID
	回傳參數 :
		無
	使用範例 :		:
		GodNine_htmlMember_Account_Details( $_SESSION['Member_ID'] ) ;		// 取得會員帳務明細
	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	if( empty($sub_Member_ID) )
	{	$sub_Member_ID = $_SESSION['Member_ID'];	}

	$SQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Member_ID = '$sub_Member_ID' AND BetGodnine_On = '1' ORDER BY BetGodnine_Bingo_Period DESC" ;
	echo $SQL . "<br>" ; 
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}

}
//~@_@~// END 取得會員帳務明細 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 代理人相關
//~@_@~// START 取得所有上線代理人資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getAgentList( $tmp_Agent_ID , $subType = "A" )
{
	global $link;
	/*
	範例			: $array_AgentList = GodNine_getAgentList( $tmp_Agent_ID , $subType ) ;		// 取得所有上線代理人資料
	功能			: 取得所有上線代理人資料
	修改日期		: 200616
	參數說明 :
		$tmp_Agent_ID		起頭代理人ID或id
		subType				回傳資料類別(A:全部,N:名稱,S:分成比,W:輪莊-返水比,W2:長莊-返水比,I:id) 例:全部回傳-A,部分回傳S,I
		//$subBet_Type_First	下注種類開頭編號-3||一星||4||二星||5||三星||6||四星||7||五星||0||超級大小||1||超級單雙||2||猜大小
	回傳參數 :
		$array_AgentList		所有上線代理人資料
		$array_AgentList["N"]	名稱
		$array_AgentList["S"]	分成比-只有長莊無倍數區有設,把輪莊設成每個代理都100%
		$array_AgentList["W"]	輪莊-返水比
		$array_AgentList["W2"]	長莊-返水比
		$array_AgentList["I"]	id
	使用範例 :		:
		$array_AgentList = GodNine_getAgentList( $_SESSION['AID'] , "A,N,S,I,W,W2" ) ;		// 取得所有上線代理人資料
		$tmp_AgentList = array2str($array_AgentListN , " > ");

	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	
	$tmp_Index = 0 ;
	$array_AgentListN = array();
	$array_AgentListS = array();
	$array_AgentListI = array();
	$array_AgentListW = array();
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

		// 是否要回 傳長莊-手續費退水
		if ( $subType == "A" OR preg_match("/W2/i",$subType) )
		{
			// 自己該負責的占成 = 本身占成 - 下層占成
			$array_AgentListW2[] = $array_Agent_Info['Agent_Backwater2'] ;
		}

		// 是否要回傳 輪莊-手續費退水
		if ( $subType == "A" OR preg_match("/W/i",$subType) )
		{
			// 自己該負責的占成 = 本身占成 - 下層占成
			$array_AgentListW[] = $array_Agent_Info['Agent_Backwater'] ;
		}

		// 是否要回傳id
		if ( $subType == "A" OR preg_match("/I/i",$subType) )
		{	$array_AgentListI[] = $array_Agent_Info['id_Agent'] ;	}

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
	$array_AgentList["W"] = array_reverse($array_AgentListW) ;
	$array_AgentList["W2"] = array_reverse($array_AgentListW2) ;
	return $array_AgentList ;
	
}
//~@_@~// END 取得所有上線代理人資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 首頁相關
//~@_@~// START 取得開獎記錄 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_htmlBingoList( $tmp_Funct , $subPara )
{
	global $link;
	/*
	範例			: GodNine_htmlBingoList( $tmp_Funct , $subPara ) ;		// 取得開獎記錄
	功能			: 取得開獎記錄
	修改日期		: 200619
	參數說明 :
		$tmp_Funct	查詢類別
		$subPara	查詢關鍵字
	回傳參數 :
		無
	使用範例 :		:
		GodNine_getAgentList( $tmp_Funct , $subPara ) ;		// 取得開獎記錄

	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// 是否查詢本日
	if( $subPara == "ToDay" )
	{	$subPara = date("Y-m-d") ;	}

	if( $subPara )
	{
		// 查詢日期
		if( $tmp_Funct == "Search_Date" )
		{	$tmpSQL = "SELECT * FROM Bingo WHERE Bingo_DrawDate = '$subPara' ORDER BY Bingo_Period DESC" ;	}
		// 查詢期數
		else if( $tmp_Funct == "Search_Bingo_Period" )
		{	$tmpSQL = "SELECT * FROM Bingo WHERE Bingo_Period = '$subPara'" ;	}
		else
		{
			echo "-1,查詢類別有誤,請重新查詢!!!" ;
			exit;
		}
	}
	else
	{
		echo "-1,請設定查詢相關資料!!!" ;
		exit;
	}

	$QUERY = mysqli_query($link , $tmpSQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		echo "01,<div class=\"table bingoHistory\">\n";
		echo "<table cellpadding=\"0\" cellspacing=\"0\">\n";
//		echo "	<tr>\n";
//		echo "		<th>日期/期數</th>\n";
//		echo "		<th>開獎號碼</th>\n";
//		echo "	</tr>\n";

		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			echo "	<tr>\n";
			echo "		<td>\n";
			echo "		<p>開獎日期 : {$LIST['Bingo_DrawDate']} {$LIST['Bingo_DrawDT']}</p>\n";
			echo "		<p>開獎期數 : {$LIST['Bingo_Period']}</p>\n";
			echo "		<p>開獎號碼 : <br>{$LIST['Bingo_Draw_Order_Num']}</p>\n";
			echo "		</td>\n";
			echo "	</tr>\n";
		}
		
		echo "</table>\n";
		echo "</div>\n";
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{	echo "-1,沒有找到相關資料<br>" ;	}
}
//~@_@~// END 取得開獎記錄 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得操作記錄 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_htmlOperationRecordList( $tmp_Funct , $subPara )
{
	global $link;
	/*
	範例			: GodNine_htmlOperationRecordList( $tmp_Funct , $subPara ) ;		// 取得操作記錄
	功能			: 取得操作記錄
	修改日期		: 200619
	參數說明 :
		$tmp_Funct	查詢類別
		$subPara	查詢關鍵字
	回傳參數 :
		無
	使用範例 :		:
		GodNine_htmlOperationRecordList( $tmp_Funct , $subPara ) ;		// 取得操作記錄

	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	// 是否查詢本日
	if( $subPara == "ToDay" )
	{	$subPara = date("Y-m-d") ;	}

	if( $subPara )
	{
		// 查詢日期
		if( $tmp_Funct == "Search_Date" )
		{
			$tmpSQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' AND BetGodnine_Add_DT LIKE '%$subPara%' ORDER BY BetGodnine_Add_DT DESC" ;
			$tmpSQL_Banker = "SELECT * FROM Banker WHERE Banker_Set_ID = '{$_SESSION['Member_ID']}' AND Banker_Add_DT LIKE '%$subPara%' AND Banker_On = '1' ORDER BY Banker_Add_DT DESC" ;
		}
		//SELECT * FROM BetGodnine WHERE BetGodnine_Member_ID = 'Member2005220007' AND BetGodnine_Add_DT LIKE '%2020-06-19%' ORDER BY BetGodnine_Add_DT DESC
		else
		{
			echo "-1,查詢類別有誤,請重新查詢!!!" ;
			exit;
		}
	}
	else
	{
		echo "-1,請設定查詢相關資料!!!" ;
		exit;
	}

	// 找出當莊資料
	$QUERY_Banker = mysqli_query($link , $tmpSQL_Banker) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY_Banker) )
	{
		$tmp_HasBanker = 1 ;
		echo "01,		<div class=\"table\">\n";
		echo "			<table cellpadding=\"0\" cellspacing=\"0\">\n";
		echo "				<tr>\n";
		echo "					<th>類型</th>\n";
		echo "					<th>明細</th>\n";
		echo "					<th>時間</th>\n";
		echo "				</tr>\n";

		// 一條條獲取
		while ($LIST_Banker = mysqli_fetch_assoc($QUERY_Banker))
		{
			
			echo "				<tr>\n";
			echo "					<td>會員當莊</td>\n";
			echo "					<td>\n";
			echo "					<p>房間編號:" . GodNine_chnageRoomNum( $LIST_Banker['Banker_Room'] ) . "</p>\n";
			echo "					<p>莊家桌號:{$LIST_Banker['Banker_Banker_Table']}</p>\n";
			echo "					<p>預扣點數:{$LIST_Banker['Banker_Withhold_Money']}</p>\n";
			echo "					<p>期號:{$LIST_Banker['BetGodnine_Bingo_Period']}</p>\n";
			echo "					</td>\n";
			echo "					<td>{$LIST_Banker['Banker_Add_DT']}</td>\n";
			echo "				</tr>\n";
		}
		//echo "			</table>\n";
		//echo "		</div>\n";
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	//else
	//{	echo "-1,沒有找到相關資料" ;	}


	$QUERY = mysqli_query($link , $tmpSQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		if( $tmp_HasBanker != 1 )
		{
			echo "01,		<div class=\"table\">\n";
			echo "			<table cellpadding=\"0\" cellspacing=\"0\">\n";
			echo "				<tr>\n";
			echo "					<th>類型</th>\n";
			echo "					<th>明細</th>\n";
			echo "					<th>時間</th>\n";
			echo "				</tr>\n";
		}

		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			echo "				<tr>\n";
			if( $LIST['BetGodnine_On'] == 0 )
			{	$tmp_BetGodnine_On = "(無效)" ;	}
			else
			{	$tmp_BetGodnine_On = "" ;	}
			echo "					<td>會員下注{$tmp_BetGodnine_On}</td>\n";
			echo "					<td>\n";
			echo "					<p>房間編號:" . GodNine_chnageRoomNum( $LIST['BetGodnine_Room'] ) . "</p>\n";
			echo "					<p>下注位子:{$LIST['BetGodnine_Num']}</p>\n";
			echo "					<p>預扣點數:{$LIST['BetGodnine_Withhold_Chips']}</p>\n";
			echo "					<p>期號:{$LIST['BetGodnine_Bingo_Period']}</p>\n";
			echo "					</td>\n";
			echo "					<td>{$LIST['BetGodnine_Add_DT']}</td>\n";
			echo "				</tr>\n";
		}
		echo "			</table>\n";
		echo "		</div>\n";
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	//else
	//{	echo "-1,沒有找到相關資料" ;	}


}
//~@_@~// END 取得操作記錄 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得帳務明細 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_htmlAccount_DetailsList( $tmp_Funct , $sub_Para , $sub_Type , $sub_Model = "Ajax" )
{
	global $link;
	global $Array_Room_Type;
	/*
	範例			: GodNine_htmlAccount_DetailsList( $tmp_Funct , $sub_Para , $sub_Type ) ;		// 取得帳務明細
	功能			: 取得帳務明細
	修改日期		: 200619
	參數說明 :
		$tmp_Funct	查詢類別
		$sub_Para	查詢關鍵字
		$sub_Type	查詢模式(Banker : 莊家 , User : 閒家)
		$sub_Model	秀出模式( Ajax : Ajax用 , Funct : 函式用 )
	回傳參數 :
		無
	使用範例 :		:
		GodNine_htmlAccount_DetailsList( $tmp_Funct , $sub_Para , $sub_Type ) ;		// 取得帳務明細

	*/
	$tmpShowMsg = 0 ;

	// 設定房間的籌碼編號
	include_once($MAIN_BASE_ADDRESS . "Project/GodNine/array/Array_Room_Type.inc") ;        // 房間編號

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	// 是否查詢本日
	if( $sub_Para == "ToDay" OR $sub_Para == "" )
	{	$sub_Para = date("Y-m-d") ;	}

	if( $sub_Para )
	{
		// 查詢日期
		if( $tmp_Funct == "Search_Date" )
		{
			if( $sub_Type == "Banker_List" )
			{
				$tmpSQL = "SELECT * FROM BetGodnine WHERE ( BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' OR BetGodnine_Banker_ID = '{$_SESSION['Member_ID']}' ) AND BetGodnine_Draw_DT LIKE '%$sub_Para%' AND BetGodnine_On = '1' ORDER BY BetGodnine_Bingo_Period DESC, BetGodnine_Room , BetGodnine_Add_DT DESC" ;
			}
			else if( $sub_Type == "Banker" )
			{
				$tmpSQL = "SELECT * FROM BetGodnine WHERE ( BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' OR BetGodnine_Banker_ID = '{$_SESSION['Member_ID']}' ) AND BetGodnine_Draw_DT LIKE '%$sub_Para%' AND BetGodnine_On = '1' ORDER BY BetGodnine_Bingo_Period DESC, BetGodnine_Room , BetGodnine_Add_DT DESC" ;
			}
			else
			{
				//$tmpSQL = "SELECT * FROM BetGodnine WHERE ( BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' OR BetGodnine_Banker_ID = '{$_SESSION['Member_ID']}' ) AND BetGodnine_Draw_DT LIKE '%$sub_Para%' AND BetGodnine_On = '1' ORDER BY BetGodnine_Bingo_Period DESC, BetGodnine_Room , BetGodnine_Add_DT DESC" ;
				$tmpSQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' AND BetGodnine_Draw_DT LIKE '%$sub_Para%' AND BetGodnine_On = '1' ORDER BY BetGodnine_Bingo_Period DESC, BetGodnine_Room , BetGodnine_Add_DT DESC" ;
			}
		}
		else
		{
			echo "-1,查詢類別有誤,請重新查詢!!!" ;
			exit;
		}
	}
	else
	{
		echo "-1,請設定查詢相關資料!!!" ;
		exit;
	}

	$QUERY = mysqli_query($link , $tmpSQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		if( $sub_Model == "Ajax" )
		{	echo "01," ;	}
		echo "		<div class=\"table\">\n";
		echo "			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
		echo "			<tr>\n";
		echo "				<th>單號 / 房間 / 期號</th>\n";
		echo "				<th>結單時間</th>\n";
		echo "				<th>輸贏金額</th>\n";
		echo "			</tr>\n";

		$tmp_Banker = "" ;	// 目前莊的ID
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			echo "			<tr>\n";

			if( $LIST['BetGodnine_Banker_ID'] == $_SESSION['Member_ID'] AND 0 )
			{// 當家資料
				// 是否為相同莊家
				if( $tmp_Banker != $_SESSION['Member_ID'] )
				{
				}
				echo "				<td style='font-size:12px;'>\n";
				echo "					<a class=\"strong\" href=\"reportDetail.php?ID={$LIST['id_BetGodnine']}&Type=Banker\">\n";
				echo "					<span>{$LIST['BetGodnine_ID']}</span><br>\n";
				echo "					<span>" . GodNine_chnageRoomNum( $LIST['BetGodnine_Room'] ) . "</span><br>\n";
				echo "					<span>{$LIST['BetGodnine_Bingo_Period']}</span>\n";
				echo "				</a>\n";
				echo "				</td>\n";
				echo "				<td>\n";
				echo "					<span style='font-size:12px;'>" . mb_substr( $LIST['BetGodnine_Draw_DT'] , 0 , 10 , "utf-8") . "</span><br>\n";
				echo "					<span style='font-size:12px;'>" . mb_substr( $LIST['BetGodnine_Draw_DT'] , 11 , 5 , "utf-8") . "</span>\n";
				echo "				</td>\n";
				echo "				<td>\n";
				echo "					<p style='font-size:14px;text-align:right;'><span style='border:1px solid #fff;padding:5px;background-color:#aaa;color:#000;'><a class=\"strong\" href=\"reportDetail.php?ID={$LIST['id_BetGodnine']}&Type=Banker\" style='color:#000;'>查莊明細--</a></span></p>\n";
				echo "				</td>\n";
				$tmp_Banker = $_SESSION['Member_ID'] ;
				//$tmp_WinLost_Money_Total += $LIST['BetGodnine_WinLost_Money'] ;
			}
			else
			{// 閒家下注資料
				echo "				<td style='font-size:12px;'>\n";
				echo "					<a class=\"strong\" href=\"reportDetail.php?ID={$LIST['id_BetGodnine']}&Type=User\">\n";
				echo "					<span>{$LIST['BetGodnine_ID']}</span><br>\n";
				echo "					<span>" . GodNine_chnageRoomNum( $LIST['BetGodnine_Room'] ) . "</span><br>\n";
				echo "					<span>{$LIST['BetGodnine_Bingo_Period']}</span>\n";
				echo "				</a>\n";
				echo "				</td>\n";
				echo "				<td>\n";
				echo "					<span style='font-size:12px;'>" . mb_substr( $LIST['BetGodnine_Draw_DT'] , 0 , 10 , "utf-8") . "</span><br>\n";
				echo "					<span style='font-size:12px;'>" . mb_substr( $LIST['BetGodnine_Draw_DT'] , 11 , 5 , "utf-8") . "</span>\n";
				echo "				</td>\n";
				echo "				<td>\n";
				echo "					<p style='font-size:12px;text-align:right;'>" . WinHappy_setMoneyCss( $LIST['BetGodnine_WinLost_Money'] , "Before" ) . "</p>\n";
				echo "				</td>\n";
				$tmp_WinLost_Money_Total += $LIST['BetGodnine_WinLost_Money'] ;
			}
			//if( $LIST['BetGodnine_Banker_ID'] == $_SESSION['Member_ID'])
			//{	echo "					<span>莊家</span>\n";	}

			echo "			</tr>\n";
		}

		// 秀出總計
		echo "" ;
		echo "			<tr>\n";
		echo "				<td></td>\n";
		echo "				<td>總計</td>\n";
		echo "				<td><p style='font-size:12px;text-align:right;'>" . WinHappy_setMoneyCss( $tmp_WinLost_Money_Total , "Before" ) . "</p></td>\n";
		echo "			</tr>\n";

		echo "			</table>\n";
		echo "		</div>\n";
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{
		if( $sub_Model == "Ajax" )
		{	echo "-1,沒有找到{$sub_Para}相關資料" ;	}
	}
}
//~@_@~// END 取得帳務明細 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得莊家列表 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_htmlAccount_BankerList( $tmp_Funct , $sub_Para , $sub_Type , $sub_Model = "Ajax" )
{
	global $link;
	global $MAIN_BASE_ADDRESS ;
	global $Array_Room_Type;
	/*
	範例			: GodNine_htmlAccount_BankerList( $tmp_Funct , $sub_Para , $sub_Type ) ;		// 取得莊家列表
	功能			: 取得莊家列表
	修改日期		: 200627
	參數說明 :
		$tmp_Funct	查詢類別
		$sub_Para	查詢關鍵字
		$sub_Type	查詢模式(Banker : 莊家 , User : 閒家)
		$sub_Model	秀出模式( Ajax : Ajax用 , Funct : 函式用 )
	回傳參數 :
		無
	使用範例 :		:
		GodNine_htmlAccount_BankerList( $tmp_Funct , $sub_Para , $sub_Type ) ;		// 取得莊家列表

	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	// 設定房間的籌碼編號
	include_once($MAIN_BASE_ADDRESS . "Project/GodNine/array/Array_Room_Type.inc") ;        // 房間編號

	// 是否查詢本日
	if( $sub_Para == "ToDay" OR $sub_Para == "")
	{	$sub_Para = date("Y-m-d") ;	}

	if( $sub_Para )
	{
		// 查詢日期
		if( $tmp_Funct == "Search_Date" )
		{
			if( $sub_Type == "Banker_List" )
			{
				$tmpSQL = "SELECT * FROM Banker WHERE Banker_Add_DT LIKE '%$sub_Para%' AND Banker_Set_ID = '{$_SESSION['Member_ID']}' ORDER BY Banker_Bingo_Period DESC" ;
			}
		}
		else
		{
			echo "-1,查詢類別有誤,請重新查詢!!!" ;
			exit;
		}
	}
	else
	{
		echo "-1,$sub_Para 請設定查詢相關資料!!!" ;
		exit;
	}

	$QUERY = mysqli_query($link , $tmpSQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		if( $sub_Model == "Ajax" )
		{	echo "01," ;	}
		echo "		<div class=\"table\">\n";
		echo "			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
		echo "			<tr>\n";
		echo "				<th>房間 / 期號</th>\n";
		echo "				<th>結單時間</th>\n";
		echo "				<th>輸贏金額</th>\n";
		echo "			</tr>\n";

		$tmp_Banker = "" ;	// 目前莊的ID
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			echo "			<tr>\n";

			echo "				<td style='font-size:12px;'>\n";
			echo "					<a class=\"strong\" href=\"reportDetail.php?ID={$LIST['id_Banker']}&Type=Banker&Para=$sub_Para\">\n";
			echo "					<span>" . GodNine_chnageRoomNum( $LIST['Banker_Room'] ) . "</span><br>\n";
			echo "					<span>{$LIST['Banker_Bingo_Period']}</span>\n";
			echo "				</a>\n";
			echo "				</td>\n";
			// 找出本期的結束時間
			$tmp_BingoDate = WinHappy_subPeriod2Date($LIST['Banker_Bingo_Period']) ;		// Bingo期號轉時間
			echo "				<td>\n";
			echo "					<span style='font-size:12px;'>" . mb_substr( $tmp_BingoDate , 0 , 10 , "utf-8") . "</span><br>\n";
			echo "					<span style='font-size:12px;'>" . mb_substr( $tmp_BingoDate , 11 , 5 , "utf-8") . "</span>\n";
			echo "				</td>\n";

			// 找出本期的輸贏金額
			$tmpSQL_BetGodnine = "SELECT sum(BetGodnine_Banker_WinLost_Money) as BetGodnine_Banker_WinLost_Money_Total FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$LIST['Banker_Bingo_Period']}' AND BetGodnine_Room = '{$LIST['Banker_Room']}' AND BetGodnine_On = '1'" ;				// 找出某欄位的總合
			$array_BetGodnine_Info = func_DatabaseGet( $tmpSQL_BetGodnine , "SQL" , "" ) ;		// 取得資料庫資料

			echo "				<td>\n";
			//echo "					<p style='font-size:14px;text-align:right;'><span class='BTN-Banker_List' style='border:1px solid #fff;padding:5px;background-color:#aaa;color:#000;'>" . (int)$LIST['Banker_WinLost_Money'] . "</span></p>\n";
			echo "					<p style='font-size:14px;text-align:right;'><span class='BTN-Banker_List' style='border:1px solid #fff;padding:5px;background-color:#999;'>" . WinHappy_setMoneyCss( (int)$array_BetGodnine_Info['BetGodnine_Banker_WinLost_Money_Total'] , "Before" ) . "</span></p>\n";
			echo "				</td>\n";
			$tmp_Banker = $_SESSION['Member_ID'] ;
			echo "			</tr>\n";
			
			$tmp_WinLost_Money_Total += $array_BetGodnine_Info['BetGodnine_Banker_WinLost_Money_Total'] ;
		}

		// 秀出總計
		echo "" ;
		echo "			<tr>\n";
		echo "				<td></td>\n";
		echo "				<td>總計</td>\n";
		echo "				<td><p style='font-size:14px;text-align:right;'>" . WinHappy_setMoneyCss( (int)$tmp_WinLost_Money_Total , "Before" ) . "</p></td>\n";
		echo "			</tr>\n";

		echo "			</table>\n";
		echo "		</div>\n";
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{	echo "-1,沒有找到相關資料" ;	}
	
}
//~@_@~// END 取得莊家列表 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得星期歷史帳務 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_htmlWeekAccountDetails( $sub_Date , $sub_Title , $sub_Member_ID )
{
	global $link;
	/*
	範例			: GodNine_htmlWeekAccountDetails( $sub_Date , $sub_Title , $sub_Member_ID ) ;		// 取得歷史帳務
	功能			: 取得歷史帳務
	修改日期		: 200619
	參數說明 :
		$sub_Date		查詢日期
		$sub_Title		標題文字(上週,本週)
		$sub_Member_ID	查詢會員ID
	回傳參數 :
		無
	使用範例 :		:
		GodNine_htmlWeekAccountDetails( $sub_Date , $sub_Title , $sub_Member_ID ) ;		// 取得歷史帳務

	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	$array_Week[0] = "星期一" ;
	$array_Week[1] = "星期二" ;
	$array_Week[2] = "星期三" ;
	$array_Week[3] = "星期四" ;
	$array_Week[4] = "星期五" ;
	$array_Week[5] = "星期六" ;
	$array_Week[6] = "星期日" ;

	if( empty($sub_Date) )
	{	$sub_Date = date("Y-m-d");	}

	if( empty($sub_Member_ID) )
	{	$sub_Member_ID = $_SESSION['Member_ID'];	}
	
	$arrayDateRange_Now = func_getThisWeek( $sub_Date, 1 ) ;	//	取得給定日期所在週的開始日期和結束日期
	//echo "<p>本周日期</p>" ;print_r($arrayDateRange_Now);echo "<br>" ;

	echo "		<div class=\"table\">\n";
	echo "			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
	echo "			<tr>\n";
	echo "				<th>帳務日期</th>\n";
	echo "				<th>筆數</th>\n";
	echo "				<th>輸贏</th>\n";
	echo "				<th>總結</th>\n";
	echo "			</tr>\n";

	$sum_Count = 0 ;	// 合計-筆數
	$sum_WinLost = 0 ;	// 合計-輸贏
	$sum_Total = 0 ;	// 合計-總結

	foreach( $arrayDateRange_Now as $key => $value )
	{
		$sum_Count += $array_DayBetInfo['Count'] ;	// 合計-筆數
		$sum_WinLost += $array_DayBetInfo['WinLost'] ;	// 合計-輸贏
		$sum_Total += $array_DayBetInfo['Total'] ;	// 合計-總結
		// 求出某日的下注資料統計
		$array_DayBetInfo = GodNine_DayBetInfo( $value , $sub_Member_ID ) ;
		// Count : 筆數 , WinLost : 輸贏 , Total 總結
		// 取出日期
		$tmp_Date = mb_substr($value , 5 , 5 , "utf-8");
		echo "			<tr>\n";
		echo "				<td>$tmp_Date {$array_Week[$key]}</td>\n";
		echo "				<td>{$array_DayBetInfo['Count']}</td>\n";
		echo "				<td num=\"0\">" . WinHappy_setMoneyCss( $array_DayBetInfo['WinLost'] , "Before" ) . "</td>\n";
		echo "				<td num=\"0\"><a href=\"reportToday.php?Search_Date=$value\">" . WinHappy_setMoneyCss( $array_DayBetInfo['Total'] , "Before" ) . "</a></td>\n";
		echo "			</tr>\n";
	}
	echo "			<tr class=\"strong\">\n";
	echo "				<td>{$sub_Title}合計</td>\n";
	echo "				<td>$sum_Count 筆</td>\n";
	echo "				<td num=\"0\">" . WinHappy_setMoneyCss( $sum_WinLost , "Before" ) . "</td>\n";
	echo "				<td num=\"0\">" . WinHappy_setMoneyCss( $sum_Total , "Before" ) . "</td>\n";
	echo "			</tr>\n";
	echo "			</table>\n";
}

//~@_@~// END 取得帳務明細 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 求出某日的下注資料統計 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_DayBetInfo( $sub_Date , $sub_Member_ID )
{
	global $link;
	/*
	範例			: $array_DayBetInfo = GodNine_DayBetInfo( $sub_Date , $sub_Member_ID ) ;		// 求出某日的下注資料統計
	功能			: 求出某日的下注資料統計
	修改日期		: 200619
	參數說明 :
		$sub_Date		查詢日期
		$sub_Member_ID	查詢會員ID
	回傳參數 :
		$array_DayBetInfo		回傳參數
			$array_DayBetInfo['Count']		筆數
			$array_DayBetInfo['WinLost']	輸贏
			$array_DayBetInfo['Total']		總結
	使用範例 :		:
		$array_DayBetInfo = GodNine_DayBetInfo( $sub_Date , $sub_Member_ID ) ;		// 求出某日的下注資料統計
		// Count : 筆數 , WinLost : 輸贏 , Total 總結
	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	$array_DayBetInfo['Count'] = 0 ;		// 筆數
	$array_DayBetInfo['WinLost'] = 0 ;		// 輸贏
	$array_DayBetInfo['Total'] = 0 ;		// 總結

	if( empty($sub_Date) )
	{	$sub_Date = date("Y-m-d");	}

	if( empty($sub_Member_ID) )
	{	$sub_Member_ID = $_SESSION['Member_ID'];	}

	// 筆數	輸贏	總結
	$SQL = "SELECT * FROM BetGodnine WHERE ( BetGodnine_Member_ID = '$sub_Member_ID' OR BetGodnine_Banker_ID = '$sub_Member_ID' ) AND BetGodnine_Draw_DT LIKE '%$sub_Date%' AND BetGodnine_On = '1'" ;
	//echo $SQL . "<br>" ; 
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		$array_DayBetInfo['Count'] = mysqli_num_rows($QUERY) ;		// 筆數
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			if( $LIST['BetGodnine_Member_ID'] == $_SESSION['Member_ID'] )
			{// 是否為莊家
				$array_DayBetInfo['WinLost'] += $LIST['BetGodnine_Member_WinLost_Money'] ;		// 輸贏
				$array_DayBetInfo['Total'] += $LIST['BetGodnine_Member_WinLost_Money'] ;		// 總結
			}
			else if( $LIST['BetGodnine_Banker_ID'] == $_SESSION['Member_ID'] )
			{// 是否為閒家
				$array_DayBetInfo['WinLost'] += $LIST['BetGodnine_Banker_WinLost_Money'] ;		// 輸贏
				$array_DayBetInfo['Total'] += $LIST['BetGodnine_Banker_WinLost_Money'] ;		// 總結
			}
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	return $array_DayBetInfo ;
}
//~@_@~// END 取得帳務明細 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 其它
//~@_@~// START 取得每一個房間的排莊和選號人數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function GodNine_getRoomApplyPickNum()
{
	global $link;
	global $MAIN_BASE_ADDRESS;
	/*
	範例			: $arraygetRoomApplyPickNum = GodNine_getRoomApplyPickNum() ;		// 取得每一個房間的排莊和參與人數
	功能			: 取得每一個房間的排莊和參與人數
	修改日期		: 200624
	參數說明 :
		無
	回傳參數 :
		$array_getRoomApplyPickNum	回傳每個房間的人數
			$array_getRoomApplyPickNum['R005011']['Banker']	回傳房間中排莊的人數
			$array_getRoomApplyPickNum['R005011']['User']	回傳房間中選號的人數
	使用範例 :		:
		$arraygetRoomApplyPickNum = GodNine_getRoomApplyPickNum() ;		// 取得每一個房間的排莊和參與人數

	*/
	$tmpShowMsg = 0 ;
	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	//$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號	
	//return "R{$tmp_Chips}{$_SESSION['zone_code']}{$_SESSION['Room']}";
	//include_once($MAIN_BASE_ADDRESS . "Project/GodNine/array/Array_Room_Type.inc") ;        // 房間編號

	// 求出目前的Bingo獎號資料
	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
	//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)

	$tmp_Chips = func_addFix0( $_SESSION['Chips'] , 4 ) ;

	// 找出20分鐘後時間
	$tmpTime = funct_ChangTime( date("Y-m-d H:i:s") , "PM" , 20 ) ;		// 改變時間

	// 如果為長莊區只有一個房間
	if( $_SESSION['zone_code'] == 1 )
	{// 輪莊區
		for( $i = 1 ; $i <= 8 ; $i++ )
		{
			//$tmp_RoomNum = $Array_Room_Type[$tmp_Chips] . "{$_SESSION['zone_code']}1" ;
			$tmp_RoomNum = "R{$tmp_Chips}{$_SESSION['zone_code']}{$i}"; ;	// 房間編號

			// 找出該房間莊家人數
			$tmpSQL_Banker = "SELECT * FROM ApplyBanker WHERE ApplyBanker_Room = '$tmp_RoomNum' AND (ApplyBanker_Bingo_Period_Start >= '{$array_BingoPeriod['NowBingo']}' OR ApplyBanker_Bingo_Period_End >= '{$array_BingoPeriod['NowBingo']}' )" ;
			$Count_Banker = func_DatabaseGet( $tmpSQL_Banker , "COUNT" , "" ) ;		// 取得資料庫資料
			//echo "$tmpSQL_Banker<br>" ;

			// 找出該房間選號人數
			//$tmpSQL_User = "SELECT * FROM BetGodnine WHERE BetGodnine_Room = '$tmp_RoomNum' AND BetGodnine_Bingo_Period >= '{$array_BingoPeriod['NowBingo']}' AND BetGodnine_On = '1'" ;

			$tmpSQL_User = "SELECT * FROM Member WHERE Member_INRoom_Num = '$tmp_RoomNum' AND Member_INRoom_DT >= '{$tmpTime}' AND Member_On = '1'" ;
			$Count_User = func_DatabaseGet( $tmpSQL_User , "COUNT" , "" ) ;		// 取得資料庫資料

			$array_getRoomApplyPickNum[$tmp_RoomNum]['Banker'] = (int)$Count_Banker ;	// 房間中排莊的人數
			$array_getRoomApplyPickNum[$tmp_RoomNum]['User'] = (int)$Count_User ;		// 房間中選號的人數
		}
	}
	else
	{// 長莊區
		$tmp_RoomNum = "R{$tmp_Chips}{$_SESSION['zone_code']}1"; ;	// 房間編號

		// 找出該房間選號人數
		//$tmpSQL_User = "SELECT * FROM BetGodnine WHERE BetGodnine_Room = '$tmp_RoomNum' AND BetGodnine_Bingo_Period >= '{$array_BingoPeriod['NowBingo']}' AND BetGodnine_On = '1'" ;
		$tmpSQL_User = "SELECT * FROM Member WHERE Member_INRoom_Num = '$tmp_RoomNum' AND Member_INRoom_DT >= '{$tmpTime}' AND Member_On = '1'" ;
		$Count_User = func_DatabaseGet( $tmpSQL_User , "COUNT" , "" ) ;		// 取得資料庫資料

		$array_getRoomApplyPickNum[$tmp_RoomNum]['Banker'] = $Count_Banker ;	// 房間中排莊的人數
		$array_getRoomApplyPickNum[$tmp_RoomNum]['User'] = $Count_User ;		// 房間中選號的人數
	}

	return $array_getRoomApplyPickNum ;
}
//~@_@~// END 取得每一個房間的排莊和參與人數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

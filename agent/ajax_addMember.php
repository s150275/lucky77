<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "新增會員" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Member" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "ajax_addMember.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// ############ ########## ########## ############
// ## 載入模組									##
// ############ ########## ########## ############

include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
include_once($MAIN_BASE_ADDRESS . "Project/WinHappy/func_WinHappy.php");
include_once($MAIN_BASE_ADDRESS . "Project/GodNine/func_GodNine.php");

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############
//echo "<p></p>" ;print_r($_POST);echo "<br>" ;
/*
Array ( [Member_Login_Title] => A1 [Member_Login_Title2] => 2222 [Member_Login_Passwd] => 222222 
[Member_Name] => 22 [Member_Peak_Value] => 222 [Member_General_Bet_Min] => 25 [Member_Super_Bet_Min] => 25 
[Member_On] => 1 [Member_Bingo_On] => 0 
[BetLimit_Super_BigSmall] => 60000 [BetLimit_Super_BigSmall_Side] => 200000 [BetLimit_Super_BigSmall_On] => 1 
[BetLimit_Super_SingleDouble] => 60000 [BetLimit_Super_SingleDouble_Side] => 200000 [BetLimit_Super_SingleDouble_On] => 1 
[BetLimit_BigSmall] => 20000 [BetLimit_BigSmall_Side] => 200000 [BetLimit_BigSmall_On] => 1 
[BetLimit_1Start] => 10000 [BetLimit_1Start_On] => 1 
[BetLimit_2Start] => 10000 [BetLimit_2Start_On] => 1 
[BetLimit_3Start] => 5000 [BetLimit_3Start_On] => 1 
[BetLimit_4Start] => 2000 [BetLimit_4Start_On] => 1 
[BetLimit_5Start] => 1000 [BetLimit_5Start_On] => 1 
[point_max_trans] => 500000 
[mode] => edit-save [sid] => 86980 [agent_id] => 19996 
[Funct] => [ID] => [AID] => 2 )
*/
//exit;
WinHappy_checkAgent();	// 限制代理人管理後台存取頁面

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;			// 動作代理人(會員)的ID
$ARRAY_POST_GET_PARA[] = "AID||*" ;			// 目前操作代理人的ID
$ARRAY_POST_GET_PARA[] = "PID||*" ;			// 目前操作代理人的父ID
$ARRAY_POST_GET_PARA[] = "MID||*" ;			// 目前操作會員的ID

$ARRAY_POST_GET_PARA[] = "Member_Login_Title||*" ;					// 帳號開頭
$ARRAY_POST_GET_PARA[] = "Member_Login_Title2||*" ;					// 帳號名稱
$ARRAY_POST_GET_PARA[] = "Member_Name||*" ;							// 代理人名稱
$ARRAY_POST_GET_PARA[] = "Member_Login_Passwd||*" ;					// 密碼1
$ARRAY_POST_GET_PARA[] = "Member_Money||*" ;							// 金額
$ARRAY_POST_GET_PARA[] = "Member_General_Bet_Min||*" ;				// 一般玩法-最小押注金額
$ARRAY_POST_GET_PARA[] = "Member_Super_Bet_Min||*" ;					// 超級玩法-最小押注金額
$ARRAY_POST_GET_PARA[] = "Member_Peak_Value||*" ;					// 峰頂值

$ARRAY_POST_GET_PARA[] = "Member_On||*" ;						// 登入狀態
$ARRAY_POST_GET_PARA[] = "Member_Bingo_On||*" ;					// 賓果投注狀態

//$ARRAY_POST_GET_PARA[] = "Member_Open_Offline||*" ;					// 開設下級代理權限
//$ARRAY_POST_GET_PARA[] = "Member_Open_Member||*" ;					// 開設下線會員權限
//$ARRAY_POST_GET_PARA[] = "Member_Share||*" ;							// 佔成比

//$ARRAY_POST_GET_PARA[] = "BackWater_Bingo_Gen_12Start||*" ;				// 賓果一般退水
//$ARRAY_POST_GET_PARA[] = "BackWater_Bingo_Super||*" ;				// 賓果超級退水

$ARRAY_POST_GET_PARA[] = "BetLimit_Super_BigSmall||*" ;				// 超級號碼大小
$ARRAY_POST_GET_PARA[] = "BetLimit_Super_BigSmall_Side||*" ;		// 超級號碼大小-單邊
$ARRAY_POST_GET_PARA[] = "BetLimit_Super_BigSmall_On||*" ;			// 超級號碼大小-狀態
$ARRAY_POST_GET_PARA[] = "BetLimit_Super_SingleDouble||*" ;			// 超級號碼單雙
$ARRAY_POST_GET_PARA[] = "BetLimit_Super_SingleDouble_Side||*" ;	// 超級號碼單雙-單邊
$ARRAY_POST_GET_PARA[] = "BetLimit_Super_SingleDouble_On||*" ;		// 超級號碼單雙-狀態
$ARRAY_POST_GET_PARA[] = "BetLimit_BigSmall||*" ;					// 猜大小
$ARRAY_POST_GET_PARA[] = "BetLimit_BigSmall_Side||*" ;				// 猜大小-單邊
$ARRAY_POST_GET_PARA[] = "BetLimit_BigSmall_On||*" ;				// 猜大小-狀態
$ARRAY_POST_GET_PARA[] = "BetLimit_1Start||*" ;						// 1星
$ARRAY_POST_GET_PARA[] = "BetLimit_1Start_On||*" ;					// 1星-狀態
$ARRAY_POST_GET_PARA[] = "BetLimit_2Start||*" ;						// 2星
$ARRAY_POST_GET_PARA[] = "BetLimit_2Start_On||*" ;					// 2星-狀態
$ARRAY_POST_GET_PARA[] = "BetLimit_3Start||*" ;						// 3星
$ARRAY_POST_GET_PARA[] = "BetLimit_3Start_On||*" ;					// 3星-狀態
$ARRAY_POST_GET_PARA[] = "BetLimit_4Start||*" ;						// 4星
$ARRAY_POST_GET_PARA[] = "BetLimit_4Start_On||*" ;					// 4星-狀態
$ARRAY_POST_GET_PARA[] = "BetLimit_5Start||*" ;						// 5星
$ARRAY_POST_GET_PARA[] = "BetLimit_5Start_On||*" ;					// 5星-狀態

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

//echo "<p></p>" ;print_r($_POST);echo "<br>" ;

// 找出目前操作者資料
if( $AID )
{	$array_NowAgent_Info = WinHappy_getAgentInfo( $AID ) ;	}
else
{	$array_NowAgent_Info = WinHappy_getAgentInfo( $_SESSION['id_Agent'] ) ;	}


//~@_@~// START 加入資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
if ( $Funct == "ADDOK" )
{
	// 其它SQL參數
	$tmpSQL = "" ;
	// 錯誤訊息
	$errMsg = "" ;
	$Global_ADDSQL = " Member_On = '$Member_On'" ;

	$Member_Login_Title = strtoupper($Member_Login_Title) ;	// 轉成大寫
	// 帳號姓名的長度
	if( strlen($Member_Login_Title) != 2 )
	{	$errMsg = "帳號姓名的長度不為2,請重新設定..." ;	}
	else if( strlen($Member_Login_Title2) < 1 OR strlen($Member_Login_Title2) > 18 )
	{	$errMsg = "代理姓名的長度為1-18個文字,請重新設定..." ;	}
	// 查詢帳號是否已存在
	else if ( CheckFieldExist( "Member" , "Member_Login_Name" , "$Member_Login_Title$Member_Login_Title2" ) )
	{	$errMsg = "帳號已存在,請重新設定..." ;	}
	else
	{
		// 設定帳號
		$tmpSQL .= " Member_Login_Name = '$Member_Login_Title$Member_Login_Title2' , " ;
		$tmpSQL .= " Member_Login_Title = '$Member_Login_Title' , " ;
	}

	if ( $Member_Login_Passwd == "" )
	{	$errMsg = "密碼要設定..." ;	}
	//elseif ( $Member_Login_Passwd1 != $Member_Login_Passwd2 )
	//{	$errMsg = "兩個密碼不相同,請重新設定..." ;	}
	else
	{
		if ( strlen($Member_Login_Passwd) < 5 OR strlen($Member_Login_Passwd) > 12 )
		{	$errMsg = "密碼長度為5-12..." ;	}
		else
		{	$tmpSQL .= " Member_Login_Passwd = '" . crypt("$Member_Login_Passwd" , $Member_Login_Title.$Member_Login_Title2) . "' , " ;	}
	}

	// 密碼設定OK
	if ( $errMsg == "" )
	{
		// 找出ID
		include($MAIN_BASE_ADDRESS . "includes/sub/sub_get_ID.sub") ;	// 載入會員編號產生器
		$tempID = getID ( "4" , "ymd" , "Member" , "Member_ID" , "Member") ;
		$tmpSQL .= " Member_ID = '$tempID' , " ;

		$tmpSQL .= " Member_Father_ID = '{$array_NowAgent_Info['Agent_ID']}' , " ;	// 代理人名稱
		$tmpSQL .= " Member_Name = '$Member_Name' , " ;	// 會員名稱
		$tmpSQL .= " Member_General_Bet_Min = '$Member_General_Bet_Min' , " ;	// 一般玩法-最小押注金額
		$tmpSQL .= " Member_Super_Bet_Min = '$Member_Super_Bet_Min' , " ;	// 超級玩法-最小押注金額
		$tmpSQL .= " Member_Peak_Value = '$Member_Peak_Value' , " ;	// 峰頂值
		$tmpSQL .= " Member_Bingo_On = '$Member_Bingo_On' , " ;	// 賓果投注權限
		$tmpSQL .= " Member_Layers = '" . $array_NowAgent_Info['Agent_Layers'] . "' , " ;	// 所在層數

		// 加入秀出時間
		$tmpSQL .= " Member_Add_DT = '" . $MAIN_NOW_TIME . "' , " ;

		$array_AgentList = WinHappy_getAgentList( $array_NowAgent_Info['Agent_ID'] , "A" , 2) ;		// 取得所有上線代理人資料
		// N : 名稱 , S : 分成比 , W : 返水比 , I : id 
		$tmp_Online_id = "," . array2str($array_AgentList['I'] , ",") . "," ;
		// 上線id
		$tmpSQL .= " Member_Online_id = '$tmp_Online_id' , " ;

		//寫入資料庫
		$insertSQL="INSERT INTO $MAIN_DATABASE_NAME SET 
		$tmpSQL 
		$Global_ADDSQL
		";
		//echo "$insertSQL<br>" ;
//		新增失敗INSERT INTO Member SET Member_Login_Name = 'A1111111' , Member_Login_Title = 'A1' , Member_Login_Passwd = 'A1VA6FBo1uRMQ' , Member_ID = 'Member2005190001' , Member_Name = '222222' , Member_General_Bet_Min = '25' , Member_Super_Bet_Min = '25' , Member_Open_Offline = '1' , Member_Open_Member = '1' , Member_Share = '100' , Member_Add_DT = '2020-05-19 20:55:34' ,
		if(mysqli_query($link , $insertSQL))
		{
			$id = mysqli_insert_id($link) ;

			// 加入操作LOG
			$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
			$array_LogInfo['OperatorID'] = $_SESSION['Agent_ID'] ;		// 操作者ID
			$array_LogInfo['OperatorName'] = $_SESSION['Agent_Name'] ;	// 操作者姓名
			$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
			$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
			$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
			$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
			// 參考 func_WriteLogFieldInfo()
			$array_LogInfo['Type'] = "新增" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
			$array_LogInfo['Info'] = "動作:新增會員 , 操作者:{$_SESSION['Agent_Name']} , 新增ID:$id , 新會員姓名:$Member_Name , 新會員ID:$tempID , 新會員帳號:$Member_Login_Title$Member_Login_Title2 , 上線代理人ID:{$array_NowAgent_Info['Agent_ID']}" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)

			// 管理者操作-管理等級來判斷
			$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
		}
		else
		{	$errMsg = "新增代理人失敗" ;	}
	}
}
//~@_@~// E N D 加入資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 修改資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
else if ( $Funct == "MODOK" )
{
	// 其它SQL參數
	$tmpSQL = "" ;
	// 錯誤訊息
	$errMsg = "" ;

	if ( $Member_Login_Passwd == "" )
	{		}
	//else if ( $Member_Login_Passwd1 != $Member_Login_Passwd2 )
	//{	$errMsg = "兩個密碼不相同,請重新設定..." ;	}
	else
	{
		if ( strlen($Member_Login_Passwd) < 5 OR strlen($Member_Login_Passwd) > 12 )
		{	$errMsg = "密碼長度為5-12..." ;	}
		else
		//{	$tmpSQL .= " Member_Login_Passwd = '" . crypt("$Member_Login_Passwd1" , $Member_Login_Title.$Member_Login_Title2) . "' , " ;	}
		{	$arrayField['Member_Login_Passwd'] = crypt("$Member_Login_Passwd" , $Member_Login_Title.$Member_Login_Title2) ;	}
	}

	$arrayField['Member_Name'] = $Member_Name ;
	$arrayField['Member_General_Bet_Min'] = $Member_General_Bet_Min ;
	$arrayField['Member_Super_Bet_Min'] = $Member_Super_Bet_Min ;

	$arrayField['Member_Peak_Value'] = $Member_Peak_Value ;		//峰頂值
	$arrayField['Member_On'] = $Member_On ;
	$arrayField['Member_Bingo_On'] = $Member_Bingo_On ;
	//$arrayField['Member_Share'] = $Member_Share ;

	$Bol_Member = func_DatabaseBase( "Member" , "MOD" , $arrayField , " id_Member = '$ID'" ) ;						// 資料庫處理
	if( $Bol_Member )
	{
		// 加入操作LOG
		$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
		$array_LogInfo['OperatorID'] = $_SESSION['Agent_ID'] ;		// 操作者ID
		$array_LogInfo['OperatorName'] = $_SESSION['Agent_Name'] ;	// 操作者姓名
		$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
		$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
		$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
		$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
		// 參考 func_WriteLogFieldInfo()
		$array_LogInfo['Type'] = "修改" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
		$array_LogInfo['Info'] = "動作:修改會員 , 操作者:{$_SESSION['Agent_Name']} , 修改會員ID:$ID" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
		$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)

		// 管理者操作-管理等級來判斷
		$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料

		$array_MemberInfo = WinHappy_getMemberInfo( $ID ) ;		// 取得代理人資料
	}
	else
	{	$errMsg = "修改代理人資料失敗" ;	}
}
//~@_@~// E N D 修改資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 刪除資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
else if ( $Funct == "DELOK" )
{
	// 其它SQL參數
	$tmpSQL = "" ;
	// 錯誤訊息
	$errMsg = "" ;

	$array_MemberInfo = WinHappy_getMemberInfo( $ID ) ;		// 取得會員資料
	// 會員是否已有進入遊戲有輸贏
	$Count_BetGodnine = func_DatabaseGet( "SELECT * FROM BetGodnine WHERE BetGodnine_Member_ID = '{$array_MemberInfo['Member_ID']}' AND BetGodnine_On = '1'" , "COUNT" , "" ) ;		// 取得資料庫資料
	if( $Count_BetGodnine )
	{	$errMsg = "會員{$array_MemberInfo['Member_Name']}已有報表資料,不可進行刪除" ;	}

	
	if( $ID AND $errMsg == "" )
	{
		$Bol_Member = func_DatabaseBase( "Member" , "DEL" , "" , " id_Member = '$ID'" ) ;
	
		if( $Bol_Member )
		{
			// 加入操作LOG
			$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
			$array_LogInfo['OperatorID'] = $_SESSION['Agent_ID'] ;		// 操作者ID
			$array_LogInfo['OperatorName'] = $_SESSION['Agent_Name'] ;	// 操作者姓名
			$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
			$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
			$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
			$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
			// 參考 func_WriteLogFieldInfo()
			$array_LogInfo['Type'] = "刪除" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
			$array_LogInfo['Info'] = "動作:刪除會員 , 操作者:{$_SESSION['Agent_Name']} , 刪除會員ID:$ID" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)
	
			// 管理者操作-管理等級來判斷
			$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
		}
		else
		{	$errMsg = "刪除會員資料失敗" ;	}
	}

}
//~@_@~// E N D 刪除資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

if( $errMsg )
{
	$arrayReturn['Err_Code'] = "-1" ;		// 設定回傳碼(1:成功,-1:失敗)
	$arrayReturn['Err_Msg'] = $errMsg . $insertSQL ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
}
else
{
	$arrayReturn['Err_Code'] = "1" ;		// 設定回傳碼(1:成功,-1:失敗)
	if ( $Funct == "ADDOK" )
		$arrayReturn['Err_Msg'] = "新增會員成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
	else if ( $Funct == "MODOK" )
		$arrayReturn['Err_Msg'] = "修改資料成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
	else
		$arrayReturn['Err_Msg'] = "刪除資料成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
}

echo json_encode($arrayReturn);
exit;

?>

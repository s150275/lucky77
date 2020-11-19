<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "新增代理" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Agent" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "ajax_addAgent.php" ;			// 設定本程式的檔名
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

WinHappy_checkAgent();	// 限制代理人管理後台存取頁面

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;			// 動作代理人(會員)的ID
$ARRAY_POST_GET_PARA[] = "AID||*" ;			// 目前操作代理人的ID
$ARRAY_POST_GET_PARA[] = "PID||*" ;			// 目前操作代理人的父ID
$ARRAY_POST_GET_PARA[] = "MID||*" ;			// 目前操作會員的ID

$ARRAY_POST_GET_PARA[] = "Agent_Login_Title||*" ;					// 帳號開頭
$ARRAY_POST_GET_PARA[] = "Agent_Login_Title2||*" ;					// 帳號名稱
$ARRAY_POST_GET_PARA[] = "Agent_Name||*" ;							// 代理人名稱
$ARRAY_POST_GET_PARA[] = "Agent_Login_Passwd1||*" ;					// 密碼1
$ARRAY_POST_GET_PARA[] = "Agent_Login_Passwd2||*" ;					// 密碼2
$ARRAY_POST_GET_PARA[] = "Agent_Level||*" ;							// 帳號權限
$ARRAY_POST_GET_PARA[] = "Agent_Money||*" ;							// 金額
$ARRAY_POST_GET_PARA[] = "Agent_General_Bet_Min||*" ;				// 一般玩法-最小押注金額
$ARRAY_POST_GET_PARA[] = "Agent_Super_Bet_Min||*" ;					// 超級玩法-最小押注金額
$ARRAY_POST_GET_PARA[] = "Agent_Open_Offline||*" ;					// 開設下級代理權限
$ARRAY_POST_GET_PARA[] = "Agent_Open_Member||*" ;					// 開設下線會員權限
$ARRAY_POST_GET_PARA[] = "Agent_Backwater||*" ;						// 輪莊-手續費退水
$ARRAY_POST_GET_PARA[] = "Agent_Backwater2||*" ;					// 長莊-手續費退水
$ARRAY_POST_GET_PARA[] = "Agent_Share||*" ;							// 長莊輸贏佔成

$ARRAY_POST_GET_PARA[] = "BackWater_Bingo_Gen_12Start||*" ;			// 賓果一般退水
$ARRAY_POST_GET_PARA[] = "BackWater_Bingo_Super||*" ;				// 賓果超級退水

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

$ARRAY_POST_GET_PARA[] = "Over_Period_Set||*" ;						// 達到連續幾期未投注
$ARRAY_POST_GET_PARA[] = "Bet_Again_Period||*" ;					// 需要間隔幾期才能再次下注

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

//echo "<p></p>" ;print_r($_POST);echo "<br>" ;
//echo "Over_Period_Set:".$Over_Period_Set."<br>";

if( $AID )
{
	$array_NowAgent_Info = WinHappy_getAgentInfo( $AID ) ;
}
else
{
	$array_NowAgent_Info = WinHappy_getAgentInfo( $_SESSION['id_Agent'] ) ;
}


//~@_@~// START 加入資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
if ( $Funct == "ADDOK" )
{
	// 其它SQL參數
	$tmpSQL = "" ;
	// 錯誤訊息
	$errMsg = "" ;
	$Global_ADDSQL = " Agent_On = '1'" ;

	$Agent_Login_Title = strtoupper($Agent_Login_Title) ;	// 轉成大寫
	$Agent_Login_Title2 = strtoupper($Agent_Login_Title2) ;	// 轉成大寫
	// 帳號姓名的長度
	if( strlen($Agent_Login_Title) != 2 )
	{	$errMsg = "帳號姓名的長度不為2,請重新設定..." ;	}
	else if( strlen($Agent_Login_Title2) < 1 OR strlen($Agent_Login_Title2) > 18 )
	{	$errMsg = "代理姓名的長度為1-18個文字,請重新設定..." ;	}
	// 查詢帳號是否已存在
	else if ( CheckFieldExist( "Agent" , "Agent_Login_Name" , "$Agent_Login_Title$Agent_Login_Title2" ) )
	{	$errMsg = "帳號已存在,請重新設定..." ;	}
	else
	{
		// 設定帳號
		$tmpSQL .= " Agent_Login_Name = '$Agent_Login_Title$Agent_Login_Title2' , " ;
		$tmpSQL .= " Agent_Login_Title = '$Agent_Login_Title' , " ;
	}

	if ( $Agent_Login_Passwd1 == "" )
	{	$errMsg = "密碼要設定..." ;	}
	elseif ( $Agent_Login_Passwd1 != $Agent_Login_Passwd2 )
	{	$errMsg = "兩個密碼不相同,請重新設定..." ;	}
	else
	{
		if ( strlen($Agent_Login_Passwd1) < 5 OR strlen($Agent_Login_Passwd1) > 12 )
		{	$errMsg = "密碼長度為5-12..." ;	}
		else
		{	$tmpSQL .= " Agent_Login_Passwd = '" . crypt("$Agent_Login_Passwd1" , $Agent_Login_Title.$Agent_Login_Title2) . "' , " ;	}
	}

	// 密碼設定OK
	if ( $errMsg == "" )
	{
		// 找出ID
		include($MAIN_BASE_ADDRESS . "includes/sub/sub_get_ID.sub") ;	// 載入會員編號產生器
		$tempID = getID ( "4" , "ymd" , "Agent" , "Agent_ID" , "Agent") ;
		$tmpSQL .= " Agent_ID = '$tempID' , " ;
		$tmpSQL .= " Agent_Father_ID = '{$array_NowAgent_Info['Agent_ID']}' , " ;	// 上線代理人ID
		$tmpSQL .= " Agent_Name = '$Agent_Name' , " ;	// 代理人名稱
		$tmpSQL .= " Agent_Level = '$Agent_Level' , " ;	// 帳號權限
		$tmpSQL .= " Agent_General_Bet_Min = '$Agent_General_Bet_Min' , " ;	// 一般玩法-最小押注金額
		$tmpSQL .= " Agent_Super_Bet_Min = '$Agent_Super_Bet_Min' , " ;	// 超級玩法-最小押注金額
		$tmpSQL .= " Agent_Open_Offline = '$Agent_Open_Offline' , " ;	// 開設下級代理權限
		$tmpSQL .= " Agent_Open_Member = '$Agent_Open_Member' , " ;	// 開設下線會員權限
		$tmpSQL .= " Agent_Layers = '" . ($array_NowAgent_Info['Agent_Layers']+1) . "' , " ;	// 所在層數
		$tmpSQL .= " Agent_Backwater = '$Agent_Backwater' , " ;	// 長莊-手續費退水
		$tmpSQL .= " Agent_Backwater2 = '$Agent_Backwater2' , " ;	// 輪莊-手續費退水
		$tmpSQL .= " Agent_Share = '$Agent_Share' , " ;	// 長莊輸贏佔成

		// 加入秀出時間
		$tmpSQL .= " Agent_Add_DT = '" . $MAIN_NOW_TIME . "' , " ;

		$array_AgentList = WinHappy_getAgentList( $array_NowAgent_Info['Agent_ID'] , "A" , 2) ;		// 取得所有上線代理人資料
		// N : 名稱 , S : 分成比 , W : 返水比 , I : id 
		$tmp_Online_id = "," . array2str($array_AgentList['I'] , ",") . "," ;
		// 上線id
		$tmpSQL .= " Agent_Online_id = '$tmp_Online_id' ," ;

		//寫入資料庫
		$insertSQL="INSERT INTO $MAIN_DATABASE_NAME SET 
		$tmpSQL 
		$Global_ADDSQL
		";
		if(mysqli_query($link , $insertSQL))
		{
			$id = mysqli_insert_id($link) ;

//			// 加入操作LOG
//			$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
//			$array_LogInfo['OperatorID'] = $_SESSION['Agent_ID'] ;		// 操作者ID
//			$array_LogInfo['OperatorName'] = $_SESSION['Agent_Name'] ;	// 操作者姓名
//			$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
//			$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
//			$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
//			$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
//			// 參考 func_WriteLogFieldInfo()
//			$array_LogInfo['Type'] = "新增" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
//			$array_LogInfo['Info'] = "操作者 : {$_SESSION['Agent_Name']} , 動作:新增代理人 , 新增ID:$id , 上線代理人ID : {$array_NowAgent_Info['Agent_ID']} , 新代理人ID : $tempID , 新代理人名稱 : $Agent_Name , 新代理人帳號 : $Agent_Login_Title$Agent_Login_Title2" ;			// 操作記錄 備註(可記錄新增會員ID,刪除ID)
//			$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)
			
			// 加入退水
			$arrayField_BackWater['BackWater_Set_ID'] = $tempID ;
			$arrayField_BackWater['BackWater_Bingo_Gen_12Start'] = $BackWater_Bingo_Gen_12Start ;
			$arrayField_BackWater['BackWater_Bingo_Super'] = $BackWater_Bingo_Super ;
			
			$Bol_BackWater = func_DatabaseBase( "BackWater" , "ADD" , $arrayField_BackWater , "" ) ;						// 資料庫處理

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
			$array_LogInfo['Info'] = "動作:新增代理人 , 操作者:{$_SESSION['Agent_Name']} , 新增ID:$id , 上線代理人ID : {$array_NowAgent_Info['Agent_ID']} , 新代理人姓名:$Agent_Name , 新代理人ID:$tempID , 新代理人帳號:$Agent_Login_Title$Agent_Login_Title2" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
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

	// 找出原來代理人的資料
	$array_AgentInfo = WinHappy_getAgentInfo( $ID ) ;		// 取得代理人資料

	$array_SplitDate = getSplitDate( date("Y-m-d H:i:s") , "A") ;			// 全部分析
	//$array_SplitDate = getSplitDate( "2020-07-16 00:30:00" , "A") ;			// 全部分析
	// 在00:30到6:30為可以修改
	$tmp_NowTime = $array_SplitDate[3].$array_SplitDate[4];

	if( $tmp_NowTime < 30 OR $tmp_NowTime > 630 )
	//if( $array_SplitDate[3] != 1 )
	{// 不可修改佔成或退水
		if(	$array_AgentInfo['Agent_Share'] != (int)$Agent_Share )
		{	$errMsg = "佔成只可以在00:30~06:30中設定" ;	}
		else
		{
			
			if( $array_AgentInfo['Agent_Backwater2'] != (int)$Agent_Backwater2 )
			{	$errMsg = "退水只可以在00:30~06:30中設定" ;	}
			else if( $array_AgentInfo['Agent_Backwater'] != $Agent_Backwater )
			{	$errMsg = "退水只可以在00:30~06:30中設定-$BackWater_Bingo_Super" ;	}
		}

		if( $errMsg AND strlen($_SESSION['SystemUser_ID']) != 10)
		{
			$arrayReturn['Err_Code'] = "-1" ;		// 設定回傳碼(1:成功,-1:失敗)
			$arrayReturn['Err_Msg'] = $errMsg ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
			echo json_encode($arrayReturn);
			exit;
		}
		else
		{	$errMsg = "" ;	}
	}

	if ( $Agent_Login_Passwd1 == "" )
	{		}
	else if ( $Agent_Login_Passwd1 != $Agent_Login_Passwd2 )
	{	$errMsg = "兩個密碼不相同,請重新設定..." ;	}
	else
	{
		if ( strlen($Agent_Login_Passwd1) < 5 OR strlen($Agent_Login_Passwd1) > 12 )
		{	$errMsg = "密碼長度為5-12..." ;	}
		else
		//{	$tmpSQL .= " Agent_Login_Passwd = '" . crypt("$Agent_Login_Passwd1" , $Agent_Login_Title.$Agent_Login_Title2) . "' , " ;	}
		{	$arrayField['Agent_Login_Passwd'] = crypt("$Agent_Login_Passwd1" , $Agent_Login_Title.$Agent_Login_Title2) ;	}
	}

	$arrayField['Agent_Name'] = $Agent_Name ;
	$arrayField['Agent_General_Bet_Min'] = $Agent_General_Bet_Min ;
	$arrayField['Agent_Super_Bet_Min'] = $Agent_Super_Bet_Min ;
	$arrayField['Agent_Open_Offline'] = $Agent_Open_Offline ;
	$arrayField['Agent_Open_Member'] = $Agent_Open_Member ;
	$arrayField['Agent_Backwater'] = $Agent_Backwater ;
	$arrayField['Agent_Backwater2'] = $Agent_Backwater2 ;
	$arrayField['Agent_Share'] = $Agent_Share ;
	$arrayField['Over_Period_Set'] = $Over_Period_Set ;
	$arrayField['Bet_Again_Period'] = $Bet_Again_Period ;
	
	//echo "<p></p>" ;print_r($arrayField);echo "<br>" ;
	
	$Bol_Agent = func_DatabaseBase( "Agent" , "MOD" , $arrayField , " id_Agent = '$ID'" ) ;						// 資料庫處理
	if( $Bol_Agent )
	{
		$array_AgentInfo = WinHappy_getAgentInfo( $ID ) ;		// 取得代理人資料
		//echo "<p></p>" ;print_r($array_AgentInfo);echo "<br>" ;
		// 加入退水
		$arrayField_BackWater['BackWater_Bingo_Gen_12Start'] = $BackWater_Bingo_Gen_12Start ;
		$arrayField_BackWater['BackWater_Bingo_Super'] = $BackWater_Bingo_Super ;
		//echo "<p>加入退水-{$array_AgentInfo['Agent_ID']}</p>" ;print_r($arrayField_BackWater);echo "<br>" ;
		$Bol_BackWater = func_DatabaseBase( "BackWater" , "MOD" , $arrayField_BackWater , " BackWater_Set_ID = '{$array_AgentInfo['Agent_ID']}'" ) ;						// 資料庫處理

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
		$array_LogInfo['Info'] = "動作:修改代理人 , 操作者:{$_SESSION['Agent_Name']} , 修改代理人ID:$ID" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
		$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)

		// 管理者操作-管理等級來判斷
		$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
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
	// 其它SQL參數
	$tmpSQL = "" ;
	// 錯誤訊息
	$errMsg = "" ;

	$array_AgentInfo = WinHappy_getAgentInfo( $ID ) ;		// 取得代理人資料
	// 有下線代理人或會員不能刪除
	$Count_Agent = func_DatabaseGet( "SELECT * FROM Agent WHERE Agent_Father_ID = '{$array_AgentInfo['Agent_ID']}'" , "COUNT" , "" ) ;		// 取得資料庫資料
	if( $Count_Agent )
	{	$errMsg = "下線有代理人無法刪除" ;	}

	// 有下線代理人或會員不能刪除
	$Count_Member = func_DatabaseGet( "SELECT * FROM Member WHERE Member_Father_ID = '{$array_AgentInfo['Agent_ID']}'" , "COUNT" , "" ) ;		// 取得資料庫資料
	if( $Count_Member )
	{	$errMsg = "下線有會員無法刪除" ;	}

	if( $ID AND $errMsg == "" )
	{
		$Bol_Agent = func_DatabaseBase( "Agent" , "DEL" , "" , " id_Agent = '$ID'" ) ;
	
		if( $Bol_Agent )
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
			$array_LogInfo['Info'] = "動作:刪除代理人 , 操作者:{$_SESSION['Agent_Name']} , 刪除代理人ID:$ID" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)
	
			// 管理者操作-管理等級來判斷
			$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
		}
		else
		{	$errMsg = "刪除代理人資料失敗" ;	}
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
		$arrayReturn['Err_Msg'] = "新增代理人成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
	else if ( $Funct == "MODOK" )
		$arrayReturn['Err_Msg'] = "修改資料成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
	else
		$arrayReturn['Err_Msg'] = "刪除資料成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
}

echo json_encode($arrayReturn);
exit;

?>

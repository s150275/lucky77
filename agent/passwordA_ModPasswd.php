<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "修改代理人密碼" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Agent" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "passwordA_ModPasswd.php" ;			// 設定本程式的檔名
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

$ARRAY_POST_GET_PARA[] = "Old_Agent_Login_Passwd||*" ;			// 原始密碼
$ARRAY_POST_GET_PARA[] = "Agent_Login_Passwd1||*" ;			// 新設密碼1
$ARRAY_POST_GET_PARA[] = "Agent_Login_Passwd2||*" ;			// 新設密碼2

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

//echo "<p></p>" ;print_r($_POST);echo "<br>" ;

//~@_@~// START 修改代理人密碼 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
if ( $Funct == "ModPassword" )
{
	// 其它SQL參數
	$tmpSQL = "" ;
	// 錯誤訊息
	$errMsg = "" ;

	if( $Old_Agent_Login_Passwd == "" AND strlen($_SESSION['SystemUser_ID']) != 10 )
	{	echo "-1,原始密碼要設定";exit;	}
	else if ( $Agent_Login_Passwd1 == "" )
	{	echo "-1,密碼要設定";exit;	}
	elseif ( $Agent_Login_Passwd1 != $Agent_Login_Passwd2 )
	{	echo "-1,兩個密碼不相同,請重新設定";exit;	}
	else
	{
		if ( strlen($Agent_Login_Passwd1) < 5 OR strlen($Agent_Login_Passwd1) > 20 )
		{	echo "-1,密碼長度為6-20";exit;	}
		else
		{// 修改密碼
			$array_Agent_Info = WinHappy_getAgentInfo( $_SESSION['Agent_ID'] ) ;		// 取得代理人資料

			$tmp_OldPasswd = crypt("$Old_Agent_Login_Passwd" , $array_Agent_Info['Agent_Login_Name']) ;
			if( $tmp_OldPasswd != $array_Agent_Info['Agent_Login_Passwd'] AND strlen($_SESSION['SystemUser_ID']) != 10)
			{	echo "-1,原始密碼錯誤,請重新設定";exit;	}
			else
			{
				$arrayField['Agent_Login_Passwd'] = crypt("$Agent_Login_Passwd1" , $array_Agent_Info['Agent_Login_Name']) ;
				$Bol = func_DatabaseBase( "Agent" , "MOD" , $arrayField , " Agent_ID = '{$array_Agent_Info['Agent_ID']}'" ) ;						// 資料庫處理
				if( $Bol )
				{	echo "01,修改密碼成功";exit;	}
				else
				{	echo "-1,修改密碼失敗";exit;	}
			}
		}
	}
}
//~@_@~// E N D 修改代理人密碼 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
exit;

?>

<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "處理系統公告" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Bulletin" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "BulletinA.setData.php" ;			// 設定本程式的檔名
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

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

WinHappy_checkAgent();	// 限制代理人管理後台存取頁面

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;					// ID
$ARRAY_POST_GET_PARA[] = "Bulletin_Title||*" ;			// 公告標題
$ARRAY_POST_GET_PARA[] = "Bulletin_Content||*" ;	// 公告內容
$ARRAY_POST_GET_PARA[] = "Bulletin_On||*" ;				// 公告狀態

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

//echo "<p></p>" ;print_r($_POST);echo "<br>" ;

//echo "$Funct , $ID" ;
//exit;

// 是否為管理代理人
if( empty( WinHappy_IsAdminAgent() ))		// 是否為管理代理人
{	alertgo("只有管理員可以處理","index.php");exit;	}

//~@_@~// START 加入資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
if ( $Funct == "ADDOK" )
{
	// 其它SQL參數
	$tmpSQL = "" ;
	// 錯誤訊息
	$errMsg = "" ;
	$Global_ADDSQL = " Bulletin_On = '$Bulletin_On'" ;

	// 密碼設定OK
	if ( $errMsg == "" )
	{
		$tmpSQL .= " Bulletin_Title = '$Bulletin_Title' , " ;				// 公告標題
		$tmpSQL .= " Bulletin_Content = '$Bulletin_Content' , " ;	// 公告內容
		$tmpSQL .= " Bulletin_Add_DT = '" . $MAIN_NOW_TIME . "' , " ;	// 新增日期
		$tmpSQL .= " Bulletin_Mod_DT = '" . $MAIN_NOW_TIME . "' , " ;	// 修改日期

		//寫入資料庫
		$insertSQL="INSERT INTO $MAIN_DATABASE_NAME SET 
		$tmpSQL 
		$Global_ADDSQL
		";
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
			$array_LogInfo['Info'] = "動作:新增系統公告 , 操作者:{$_SESSION['Agent_Name']} , 公告標題:$Bulletin_Title , 新增ID:$id" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)

			// 管理者操作-管理等級來判斷
			$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
		}
		else
		{	$errMsg = "新增資料-失敗" ;	}
	}
}
//~@_@~// E N D 加入資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 修改資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
else if ( $Funct == "MODOK" )
{
	$arrayField['Bulletin_On'] = $Bulletin_On ;
	$arrayField['Bulletin_Title'] = $Bulletin_Title ;
	$arrayField['Bulletin_Content'] = $Bulletin_Content ;
	$arrayField['Bulletin_Mod_DT'] = $MAIN_NOW_TIME ;

	$Bol_Bulletin = func_DatabaseBase( "Bulletin" , "MOD" , $arrayField , " id_Bulletin = '$ID'" ) ;						// 資料庫處理
	if( $Bol_Bulletin )
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
		$array_LogInfo['Info'] = "動作:修改系統公告 , 操作者:{$_SESSION['Agent_Name']} , 修改ID:$ID" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
		$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)

		// 管理者操作-管理等級來判斷
		$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
	}
	else
	{	$errMsg = "修改資料失敗" ;	}
}
//~@_@~// E N D 修改資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 刪除資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
else if ( $Funct == "DELOK" )
{
	// 其它SQL參數
	$tmpSQL = "" ;
	// 錯誤訊息
	$errMsg = "" ;

	if( $ID )
	{
		$Bol_Agent = func_DatabaseBase( "Bulletin" , "DEL" , "" , " id_Bulletin = '$ID'" ) ;

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
		$array_LogInfo['Info'] = "動作:刪除系統公告 , 操作者:{$_SESSION['Agent_Name']} , 刪除ID:$ID" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
		$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)

		// 管理者操作-管理等級來判斷
		$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
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
		$arrayReturn['Err_Msg'] = "新增成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
	else if ( $Funct == "MODOK" )
		$arrayReturn['Err_Msg'] = "修改資料成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
	else
		$arrayReturn['Err_Msg'] = "刪除資料成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
}

echo json_encode($arrayReturn);
exit;

?>

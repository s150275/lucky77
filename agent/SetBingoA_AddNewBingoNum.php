<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "新增獎號" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Agent" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "SetBingoA_AddNewBingoNum.php" ;			// 設定本程式的檔名
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

$ARRAY_POST_GET_PARA[] = "Bingo_Period||*" ;			// 開獎號碼
$ARRAY_POST_GET_PARA[] = "Bingo_Super_Num||*" ;			// 超級獎號
$ARRAY_POST_GET_PARA[] = "Bingo_Size_Same||*" ;			// 一般大小

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
if( empty( WinHappy_IsAdminAgent() ))		// 是否為管理代理人
{	exit;	}

// 錯誤訊息
$errMsg = "" ;

// 期數長度為9
if( strlen($Bingo_Period) != 9 )
{	$errMsg = "期數資料不對,請重新輸入" ;	}
else if( $Bingo_Super_Num > 80 )
{	$errMsg = "超級獎號資料不對,請重新輸入" ;	}

//echo "<p></p>" ;print_r($_POST);echo "<br>" ;
//$tmp = array2str($_POST,",");
//新增獎號-成功~!109040022,50,小,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,ADDOK


//echo "<p></p>" ;print_r($_POST);echo "<br>" ;

//~@_@~// START 新增資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
if ( $Funct == "ADDOK" AND $errMsg == "" )
{
	// 其它SQL參數
	$tmpSQL = "" ;

	// 是否已有本期資料
	$Count_Bingo = func_DatabaseGet( "SELECT * FROM Bingo WHERE Bingo_Period = '$Bingo_Period'" , "COUNT" , "" ) ;		// 取得資料庫資料
	if( $Count_Bingo )
	{	$errMsg = "該{$Bingo_Period}已存在,不可再新增" ;	}
	else
	{
		// 求出上期獎號
		$tmp_Last_Bingo_Period = $Bingo_Period-1 ;
		$array_Last_Bingo_Info = func_DatabaseGet( "Bingo" , "*" , array("Bingo_Period"=>$tmp_Last_Bingo_Period) ) ;		// 取得資料庫資料
		if( $array_Last_Bingo_Info["id_Bingo"] )
		{
			// 求出 開獎號碼
			for( $i = 1 ; $i <= 20 ; $i++ )
			{	$array_Bingo_Num[] = func_addFix0( $_POST["Bingo_Num$i"] , 2 ) ;	}
			// 進行開獎號碼排序
			//asort($array_Bingo_Num);

			// 求出 開獎時間
			$tmp_BingoDate = WinHappy_subPeriod2Date($Bingo_Period) ;		// Bingo期號轉時間
			
			// 求出 連莊球數
			$array_Last_Num = str2array($array_Last_Bingo_Info['Bingo_Num'] , ",") ;
			$tmp_Same_Num = WinHappy_getBingo_Same_Num( $array_Bingo_Num , $array_Last_Num ) ;		// 找出連莊球數

			// 求出 超級大小連莊次數
			// 求出 超級單雙連莊次數
			$array_Super_Same = WinHappy_getSuper_BS_SD_Info( $Bingo_Super_Num , $array_Last_Bingo_Info['Bingo_Super_BS_Same'] , $array_Last_Bingo_Info['Bingo_Super_SD_Same'] ) ;		// 找出超級大小單雙連莊次數
			// BS : 超級連莊大小 , SD : 超級連莊單雙

			// 求出 一般大小連莊次數
			$tmp_Size_Same = WinHappy_get_Size_Same_Info( $Bingo_Size_Same , $array_Last_Bingo_Info['Bingo_Size_Same'] ) ;		// 找出一般大小連莊次數
			
			$arrayField['Bingo_Period'] = $Bingo_Period ;		// 期數
			$arrayField['Bingo_Super_Num'] = $Bingo_Super_Num ;	// 超級獎號
			$arrayField['Bingo_Add_DT'] = date("Y-m-d H:i:s") ;	// 新增日期
			$arrayField['Bingo_On'] = 1 ;	// 參數狀態

			$arrayField['Bingo_Num'] = array2str($array_Bingo_Num , ",") ;	// 開獎號碼(1,2,3..20)
			$arrayField['Bingo_Draw_Order_Num'] = array2str($array_Bingo_Num , ",") ;	// 開獎號碼(1,2,3..20)
			$arrayField['Bingo_DrawDate'] = mb_substr($tmp_BingoDate , 0,10,"utf-8") ;					// 開獎日期
			$arrayField['Bingo_DrawDT'] = mb_substr($tmp_BingoDate , 11,5,"utf-8") ;					// 開獎時間(09:10)
			$arrayField['Bingo_Super_Same'] = $tmp_Same_Num ;				// 連莊球數
			$arrayField['Bingo_Super_BS_Same'] = $array_Super_Same['BS'] ;			// 超級大小連莊次數(小,2)
			$arrayField['Bingo_Super_SD_Same'] = $array_Super_Same['SD'] ;			// 超級單雙連莊次數(單,1)
			$arrayField['Bingo_Size_Same'] = $tmp_Size_Same ;				// 一般大小連莊次數(大,1)

//$tmp = array2str($arrayField," ");
//// 新增獎號-成功~!109040030 20 2020-07-16 10:16:20 1 01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20 10:15 6 小,2 雙,1 小,1
//$arrayReturn['Err_Code'] = "1" ;		// 設定回傳碼(1:成功,-1:失敗)
//$arrayReturn['Err_Msg'] = "新增獎號-成功~!$tmp" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
//echo json_encode($arrayReturn);
//exit;
			$array_Calculate_Multiple = GodNine_sumCalculate_Multiple( $arrayField['Bingo_Draw_Order_Num'] ) ;		// 計算財神九仔生計算值和倍數值
			//echo "計算財神九仔生計算值和倍數值<br><p>{$array_NewBingo_Info['Bingo_Draw_Order_Num']}</p>" ;print_r($array_Calculate_Multiple);echo "<br>" ;

			// 設定財神九仔生計算值
			$arrayField['Bingo_Godnine_Calculate'] = $array_Calculate_Multiple['Calculate'] ;				// 財神九仔生計算值
			
			// 設定財神九仔生倍數值
			$arrayField['Bingo_Godnine_Multiple'] = $array_Calculate_Multiple['Multiple'] ;				// 財神九仔生倍數值

			$Bol = func_DatabaseBase( "Bingo" , "ADD" , $arrayField , "" ) ;						// 資料庫處理
			if( $Bol )
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
				$array_LogInfo['Type'] = "新增" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
				$array_LogInfo['Info'] = "動作:手動加入獎號 , 操作者:{$_SESSION['Agent_Name']} , 新增ID:$Bol , 期號:$Bingo_Period , 超級獎號:$Bingo_Super_Num , 開獎號碼:{$arrayField['Bingo_Num']}" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
				$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)

				// 管理者操作-管理等級來判斷
				$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
			}
			else
			{	$errMsg = "新增獎號-失敗~!" ;	}
		}
		else
		{	$errMsg = "上期{$tmp_Last_Bingo_Period}不存在,不可新增" ;	}
	}

}
//~@_@~// E N D 新增資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

if( $errMsg )
{
	$arrayReturn['Err_Code'] = "-1" ;		// 設定回傳碼(1:成功,-1:失敗)
	$arrayReturn['Err_Msg'] = $errMsg ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
}
else
{
	$arrayReturn['Err_Code'] = "1" ;		// 設定回傳碼(1:成功,-1:失敗)
	$arrayReturn['Err_Msg'] = "新增獎號-成功~!" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
}

echo json_encode($arrayReturn);
exit;

?>

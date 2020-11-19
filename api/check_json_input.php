<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "測試JSON" ;	// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;			// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "api" ;				// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Member" ;			// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "check_Sex.php" ;	// 設定本程式的檔名
$MAIN_CHECK_FIELD       = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;				// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_PROGRAM_TYPE	= "A1" ;				// 設定此網頁是否為管理模式-0:不管制,A:一般管制(1111),P:程式權限管制(根據System_LevelP的設定),程式模式(0:一般模式,1:管理模式...)
$MAIN_NOW_TIME          = date("Y-m-d H:i:s") ;		// 取得現在的時間
$MAIN_NOW_DATE          = date("Y-m-d") ;		// 取得現在的日期

$tmp_Show_Msg = "0" ;		// 1:秀出除錯資料,0:不秀出除錯資料
$tmp_Add_Database = "1" ;		// 1:加入資料庫,0:不加入資料庫

// 是否有輸入內定值
if ( $_GET['key'] != "wostory" )
exit;
// 是否有設定內定ID index
if( $_GET['LID'] ){	$LID = $_GET['LID'] ;	}else{	$LID = 0 ;	}
// 是否有外送參數
if( $_GET['Type'] ){	$tmpType = $_GET['Type'] ;	}else
{	// 使用內定參數
	$tmpType = "setBackup" ;		// 商品類別新增資料
}
// 是否有外送參數
// https://godnine.shoping.jjvk.com/api/check_json_input.php?key=wostory&Type=setBackup&LID=1	// 加入資料

// ############ ########## ########## ############
// ## 載入模組					##
// ############ ########## ########## ############
include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
include_once($MAIN_BASE_ADDRESS . "includes/bot.php");
//include_once($MAIN_BASE_ADDRESS . "includes/func_wostory.php");
?>
<style>
.ylduShowMsg
{
	color:#f00;
}
</style>
<?
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";

// 會員 ================================================================================================

// 取得會員ID
if( $tmpType == "setBackup" )
{
//	// 1.最原始傳送資料
//	$arrayPara['Funct'] = "setBackup" ;	// 功能參數(必傳)
//	$arrayPara['Data']['TableName'] = "Member" ;					// 表格名稱
//	$arrayPara['Data']['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
//	$arrayPara['Data']['WhereString'] = " Member_ID = 'Member202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
//	$arrayPara['Data']['Member_Name'] = "yldu" ;					// 要處理的欄位名稱和資料
//	$arrayPara['Data']['Member_ID'] = "Member202007010001" ;		// 要處理的欄位名稱和資料
//	$arrayPara['Time'] = date("Y-m-d H:i:s") ;	// 送出時間(必傳)


//	// 2.資料陣列-一筆資料
//	$arrayData['TableName'] = "Member" ;					// 表格名稱
//	$arrayData['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
//	$arrayData['WhereString'] = " Member_ID = 'Member202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
//	$arrayData['Member_Name'] = "yldu" ;					// 要處理的欄位名稱和資料
//	$arrayData['Member_ID'] = "Member202007010001" ;		// 要處理的欄位名稱和資料
//
//	// 轉成Json
//	$tmp_JsonData = array2json($arrayData);
//
//	$arrayPara['Funct'] = "setBackup" ;	// 功能參數(必傳)
//	$arrayPara['Data'] = $tmp_JsonData ;		// 要處理的欄位名稱和資料
//	$arrayPara['Time'] = date("Y-m-d H:i:s") ;	// 送出時間(必傳)

//	// 3.資料陣列-多筆資料
//	$arrayData[0]['TableName'] = "Member" ;					// 表格名稱
//	$arrayData[0]['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
//	$arrayData[0]['WhereString'] = " Member_ID = 'Member202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
//	$arrayData[0]['Member_Name'] = "yldu" ;					// 要處理的欄位名稱和資料
//	$arrayData[0]['Member_ID'] = "Member202007010001" ;		// 要處理的欄位名稱和資料
//
//	$arrayData[1]['TableName'] = "Admin" ;					// 表格名稱
//	$arrayData[1]['ActionName'] = "MOD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
//	$arrayData[1]['WhereString'] = " Admin_ID = 'Admin202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
//	$arrayData[1]['Admin_Name'] = "admin" ;					// 要處理的欄位名稱和資料
//	$arrayData[1]['Admin_ID'] = "Admin202007010001" ;		// 要處理的欄位名稱和資料
//
//	// 轉成Json
//	$tmp_JsonData = array2json($arrayData);
//
//	$arrayPara['Funct'] = "setBackup" ;	// 功能參數(必傳)
//	$arrayPara['Data'] = $tmp_JsonData ;		// 要處理的欄位名稱和資料
//	$arrayPara['Time'] = date("Y-m-d H:i:s") ;	// 送出時間(必傳)


	// 4.資料陣列-多筆資料-單筆Json組合
	$tmp_JsonStr = "" ;
	unset($arrayData);
	$arrayData['TableName'] = "Member" ;					// 表格名稱
	$arrayData['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
	$arrayData['WhereString'] = " Member_ID = 'Member202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
	$arrayData['Member_Name'] = "yldu" ;					// 要處理的欄位名稱和資料
	$arrayData['Member_ID'] = "Member202007010001" ;		// 要處理的欄位名稱和資料

	// 轉成Json
	$tmp_JsonData = array2json($arrayData);
	$tmp_JsonStr .= "$tmp_JsonData|||" ;

	unset($arrayData);
	$arrayData['TableName'] = "Admin" ;					// 表格名稱
	$arrayData['ActionName'] = "MOD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
	$arrayData['WhereString'] = " Admin_ID = 'Admin202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
	$arrayData['Admin_Name'] = "admin" ;					// 要處理的欄位名稱和資料
	$arrayData['Admin_ID'] = "Admin202007010001" ;		// 要處理的欄位名稱和資料

	// 轉成Json
	$tmp_JsonData = array2json($arrayData);
	$tmp_JsonStr .= "$tmp_JsonData|||" ;
	
	
	$arrayPara['Funct'] = "setBackup" ;	// 功能參數(必傳)
	$arrayPara['Data'] = $tmp_JsonStr ;		// 要處理的欄位名稱和資料
	$arrayPara['Time'] = date("Y-m-d H:i:s") ;	// 送出時間(必傳)


	$tmpSentJson = getOutputJson( $arrayPara ) ;
	echo "傳過去JSON的資料 : " . $tmpSentJson ."<br>";
	// 會員
	$tmpURL = "http://" . $_SERVER['HTTP_HOST'] . "/api/check_Member.php";
}
else
{
	exit;
}

$json = sentCURL_Post( $tmpURL , $tmpSentJson ) ;		// 送出CURL資料(POST)
echo "$json" ;
//$ch = curl_init($tmpURL);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS,  $tmpSentJson );
////	curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
////	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
////		'Content-Type: application/json',
////		'Authorization: Bearer '.$Conn_access_token
////	));
//
//$result = curl_exec($ch);
//curl_close($ch);
//
////	echo "<br>" ;
//echo "$result" ;


?>

<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "時間API" ;	// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;			// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "api" ;				// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Member" ;			// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "TimeApi.php" ;	// 設定本程式的檔名
$MAIN_CHECK_FIELD       = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;				// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_PROGRAM_TYPE	= "A1" ;				// 設定此網頁是否為管理模式-0:不管制,A:一般管制(1111),P:程式權限管制(根據System_LevelP的設定),程式模式(0:一般模式,1:管理模式...)
$MAIN_NOW_TIME          = date("Y-m-d H:i:s") ;		// 取得現在的時間
$MAIN_NOW_DATE          = date("Y-m-d") ;		// 取得現在的日期

$tmp_Show_Msg = "0" ;		// 1:秀出除錯資料,0:不秀出除錯資料
$tmp_Add_Database = "1" ;		// 1:加入資料庫,0:不加入資料庫

// 是否有輸入內定值
//if ( $_GET['key'] != "godnine" )
//exit;
// 是否有外送參數
// https://godnine.shoping.jjvk.com/api/TimeApi.php?key=godnine	// 加入資料
// http://bingo77.net/api/TimeApi.php?key=godnine	// 加入資料
// http://godnine.shoping.jjvk.com//api/TimeApi.php?key=godnine	// 加入資料

// ############ ########## ########## ############
// ## 載入模組					##
// ############ ########## ########## ############
//include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
//include_once($MAIN_BASE_ADDRESS . "includes/bot.php");
//include_once($MAIN_BASE_ADDRESS . "includes/func_wostory.php");

//echo Response.AddHeader("Access-Control-Allow-Origin", "*");

header("Access-Control-Allow-Origin: *");
// Cross-Origin Resource Sharing Header
//header('Access-Control-Allow-Origin: http://godnine.shoping.jjvk.com/');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
 
//if( $_SERVER['REMOTE_ADDR'] == "103.233.11.242" OR $_SERVER['REMOTE_ADDR'] == "155.94.159.25" OR $_SERVER['REMOTE_ADDR'] == "123.204.49.232" )
//echo date("Y-m-d H:i:s") ;

echo strtotime(date("Y-m-d H:i:s")) ;

//$array['unixtime'] = strtotime(date("Y-m-d H:i:s")) ;
//echo array2json($array) ;
//  header('Content-Type: text/html');
//  echo "<html>";
//  echo "<head>";
//  echo "   <title>Another Resource</title>";
//  echo "</head>";
//  echo "<body>";
//echo '{"abbreviation":"CST","client_ip":"123.204.49.232","datetime":"2020-08-08T20:51:15.087061+08:00","day_of_week":6,"day_of_year":221,"dst":false,"dst_from":null,"dst_offset":0,"dst_until":null,"raw_offset":28800,"timezone":"Asia/Taipei","unixtime":1596891075,"utc_datetime":"2020-08-08T12:51:15.087061+00:00","utc_offset":"+08:00","week_number":32}';
// echo "</body>";
//   "</html>";
?>


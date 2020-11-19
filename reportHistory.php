<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "歷史帳務" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "reportHistory.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "reportHistory" ;				// 主要程式名稱

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

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "Room||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

// 載入首頁
include($MAIN_BASE_ADDRESS . "header.php") ;        // 載入首頁

echo "<main>\n";
echo "	<div class=\"mainWrap\">\n";

echo "		<h4>歷史帳務</h4>\n";

$tmp_NowDay = date("Y-m-d") ;
//$tmp_NowDay = "2020-06-29" ;
GodNine_htmlWeekAccountDetails( $tmp_NowDay , "本周" , $_SESSION['Member_ID'] ) ;		// 取得歷史帳務
//GodNine_htmlWeekAccountDetails( date("Y-m-d") , "本周" , $_SESSION['Member_ID'] ) ;		// 取得歷史帳務

// 7天前日期
$tmpDate = getChangDay( $tmp_NowDay , "LD" , 7 ) ;		// 改變日期
GodNine_htmlWeekAccountDetails( $tmpDate , "上周" , $_SESSION['Member_ID'] ) ;		// 取得歷史帳務

echo "	</div>\n";
echo "</main>\n";


// 載入版權
include($MAIN_BASE_ADDRESS . "footer.php") ;        // 載入版權
?>

<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "選擇區" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "zone.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "zone" ;				// 主要程式名稱

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
$ARRAY_POST_GET_PARA[] = "Chips||*" ;
$ARRAY_POST_GET_PARA[] = "zone_code||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

include($MAIN_BASE_ADDRESS . "Project/GodNine/array/Array_Room_Type.inc") ;        // 房間編號

sub_post_get($ARRAY_POST_GET_PARA) ;

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

// 載入首頁
include($MAIN_BASE_ADDRESS . "header.php") ;        // 載入首頁

$tmp_Chips = func_addFix0( $_SESSION['Chips'] , 4 ) ;

$arraygetRoomApplyPickNum = GodNine_getRoomApplyPickNum() ;		// 取得每一個房間的排莊和參與人數

echo "<main>\n";
echo "	<div class=\"mainWrap\">\n";
echo "	<h4>選擇區</h4>\n";

echo "	<p style=\"text-align:center;\">\n";
echo "		<span class=\"list_img\"><img src=\"/static/img/chips-{$_SESSION['Chips']}.png\" width=100></span>\n";
echo "	</p>\n";

echo "	<div class=\"zoneList\">\n";
echo "		<ul class=\"list\">\n";
echo "		<li class=\"list_item\">\n";
$_SESSION['zone_code'] = 1;
$tmp_RoomNum_Name = "R{$tmp_Chips}{$_SESSION['zone_code']}1" ;
$tmp_RoomNum = $Array_Room_Type[$tmp_Chips] . "{$_SESSION['zone_code']}1" ;
echo "			<a class=\"list_link\" href=\"game.php?zone_code={$_SESSION['zone_code']}&Room=1\"><span class=\"list_text\">輪莊有倍數區</span></a>\n";
echo "		</li>\n";
echo "		<li class=\"list_item\">\n";
$_SESSION['zone_code'] = 2;
$tmp_RoomNum1_Name = "R{$tmp_Chips}{$_SESSION['zone_code']}1" ;
$tmp_RoomNum1 = $Array_Room_Type[$tmp_Chips] . "{$_SESSION['zone_code']}1" ;
echo "			<a class=\"list_link\" href=\"game.php?zone_code={$_SESSION['zone_code']}&Room=1\"><span class=\"list_text\">長莊無倍數區</span></a>\n";
echo "		</li>\n";
echo "		</ul>\n";
echo "	</div>\n";

echo "	</div>\n";
echo "</main>\n";
echo "\n";

// 載入版權
include($MAIN_BASE_ADDRESS . "footer.php") ;        // 載入版權
?>

<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "選遊戲幣" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "money.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "money" ;				// 主要程式名稱

// ############ ########## ########## ############
// ## 載入模組									##
// ############ ########## ########## ############
include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
include_once($MAIN_BASE_ADDRESS . "Project/WinHappy/func_WinHappy.php");
include_once($MAIN_BASE_ADDRESS . "Project/GodNine/func_GodNine.php");
/*include_once("includes/conn.php");
include_once("includes/func.php");
include_once("Project/WinHappy/func_WinHappy.php");
include_once("Project/GodNine/func_GodNine.php");*/

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "Member_Login_Name||*" ;
$ARRAY_POST_GET_PARA[] = "Member_Login_Passwd||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數
//include_once("includes/sub/sub_post_get.sub") ;

sub_post_get($ARRAY_POST_GET_PARA) ;

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

// 載入首頁
include($MAIN_BASE_ADDRESS."header.php") ;        // 載入首頁

if( $Conn_WebKey == "asia17888" )
{// 大陸九仔生
	$array_Chips[] = "5" ;
	$array_Chips[] = "20" ;
	$array_Chips[] = "50" ;
	$array_Chips[] = "100" ;
	$array_Chips[] = "500" ;
}
else
{// 財神九仔生
	$array_Chips[] = "50" ;
	$array_Chips[] = "100" ;
	$array_Chips[] = "300" ;
	$array_Chips[] = "500" ;
	$array_Chips[] = "1000" ;
}
echo "<main>\n";
echo "  <div class=\"mainWrap\">\n";
echo "	<h4>選擇遊戲幣</h4>\n";
echo "	<div class=\"moneyList\">\n";
echo "	  <ul class=\"list\">\n";

// 找出20分鐘後時間
$tmpTime = funct_ChangTime( date("Y-m-d H:i:s") , "PM" , 20 ) ;		// 改變時間

foreach( $array_Chips as $key => $value )
{
	$tmp_Chips = func_addFix0( $value , 4 ) ;
	// 找出目前籌碼裡所有房間之總人數
	$tmpSQL_User = "SELECT * FROM Member WHERE Member_INRoom_Num LIKE '%R$tmp_Chips%' AND Member_INRoom_DT >= '{$tmpTime}' AND Member_On = '1'" ;
	$Count_User = func_DatabaseGet( $tmpSQL_User , "COUNT" , "" ) ;		// 取得資料庫資料

	echo "		<li class=\"list_item\">\n";
	echo "	  <a href=\"zone.php?Chips=$value\" class=\"list_link\">\n";
	//echo "	  	  <a href=\"javascript:void(0);\" class=\"list_link\">\n";
	echo "			<span class=\"list_img\"><img src=\"$MAIN_BASE_ADDRESS/static/img/chips-$value.png\"></span>\n";
	echo "		  </a>\n";
	echo "		  <p style='text-align:center;'>會員:$Count_User</p>\n";
	echo "		</li>\n";
}

//echo "		<li class=\"list_item\">\n";
//echo "		  <a href=\"zone.php?Chips=50\" class=\"list_link\">\n";
//echo "			<span class=\"list_img\"><img src=\"/static/img/chips-50.aadcf6e.png\"></span>\n";
//echo "		  </a>\n";
//echo "		</li>\n";
//
//echo "		<li class=\"list_item\">\n";
//echo "		  <a href=\"zone.php?Chips=100\" class=\"list_link\">\n";
//echo "			<span class=\"list_img\"><img src=\"/static/img/chips-100.c7bb681.png\"></span>\n";
//echo "		  </a>\n";
//echo "		</li>\n";
//
//echo "		<li class=\"list_item\">\n";
//echo "		  <a href=\"zone.php?Chips=300\" class=\"list_link\">\n";
//echo "			<span class=\"list_img\"><img src=\"/static/img/chips-300.8a62bd0.png\"></span>\n";
//echo "		  </a>\n";
//echo "		</li>\n";
//
//echo "		<li class=\"list_item\">\n";
//echo "		  <a href=\"zone.php?Chips=500\" class=\"list_link\">\n";
//echo "			<span class=\"list_img\"><img src=\"/static/img/chips-500.dae8831.png\"></span>\n";
//echo "		  </a>\n";
//echo "		</li>\n";
//
//echo "		<li class=\"list_item\">\n";
//echo "		  <a href=\"zone.php?Chips=1000\" class=\"list_link\">\n";
//echo "			<span class=\"list_img\"><img src=\"/static/img/chips-1000.369661f.png\"></span>\n";
//echo "		  </a>\n";
//echo "		</li>\n";

echo "	  </ul>\n";
echo "	</div>\n";

echo "  </div>\n";
echo "</main>\n";


// 載入版權
include($MAIN_BASE_ADDRESS ."footer.php") ;        // 載入版權

?>

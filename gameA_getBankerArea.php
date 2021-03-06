<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "取得排莊列表" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "gameA_getBankerArea.php" ;			// 設定本程式的檔名
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

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "table_number||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

echo GodNine_htmlBankerArea() ;		// 取得排莊列表

//$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
////(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
//
//$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號
//
//$SQL_ApplyBanker = "SELECT * FROM ApplyBanker WHERE ApplyBanker_Bingo_Period_Start >= '{$array_BingoPeriod['NowBingo']}' AND ApplyBanker_Room = '$tmp_RoomNum' AND ApplyBanker_On = '1'" ;
////echo $SQL_ApplyBanker . "<br>" ; 
////SELECT * FROM ApplyBanker WHERE ApplyBanker_Bingo_Period >= '109032880' AND ApplyBanker_Room = 'R05012' AND ApplyBanker_On = '1'
//$QUERY_ApplyBanker = mysqli_query($link , $SQL_ApplyBanker) ;
//
//// 是否有資料
//if ( mysqli_num_rows($QUERY_ApplyBanker) )
//{
//	$tmp_Index = 0 ;
//    // 一條條獲取
//    while ($LIST_ApplyBanker = mysqli_fetch_assoc($QUERY_ApplyBanker))
//    {
//		// 是否本期有人當莊,沒有則秀出流局
//		if( !($LIST_ApplyBanker['ApplyBanker_Bingo_Period_Start'] == $array_BingoPeriod['NowBingo'] OR $LIST_ApplyBanker['ApplyBanker_Bingo_Period_Start'] == $array_BingoPeriod['NowBingo'] ) AND $tmp_Index == 0 )
//		{
//			echo "							<p id='N' class='BankerInfo'>流局</p>\n";
//		}
//		echo "							<p id='{$LIST_ApplyBanker['ApplyBanker_Set_ID']}' class='BankerInfo'>{$LIST_ApplyBanker['ApplyBanker_Operator_Name']}</p>\n";
//		$tmp_Index++ ;
//    }
//    
//    // 釋放結果集合
//    mysqli_free_result($QUERY_ApplyBanker);
//}
//else
//{// 沒有任何人當莊則流局
////	echo "							<p id='N' class='BankerInfo'>系統</p>\n";
//	echo "							<p id='N' class='BankerInfo'>流局</p>\n";
////	echo "							<button class=\"button-orange\" id='Apply_Banker' @click=\"FApply_Banker\">申請排莊</button>\n";
//}


// 找出莊家設定資料-最新4期
// 是否為本期莊家
//echo "							<p id='N' class='BankerInfo'>流局1</p>\n";
//echo "							<p id='Member202005010002' class='BankerInfo'>排莊1</p>\n";
//echo "							<p id='Member202005010003' class='BankerInfo'>排莊2</p>\n";
//echo "							<p id='Member202005010004' class='BankerInfo'>排莊3</p>\n";
//echo "							<button class=\"button-orange\" id='Apply_Banker' @click=\"FApply_Banker\">申請排莊</button>\n";

exit;

?>

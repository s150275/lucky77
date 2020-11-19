<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "詳細資料" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "info.php" ;			// 設定本程式的檔名
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

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "Member_Login_Name||*" ;
$ARRAY_POST_GET_PARA[] = "Member_Login_Passwd||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
//unset($_SESSION['Member_ID']);
//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面
// 載入首頁
include($MAIN_BASE_ADDRESS . "agent/header.php") ;        // 載入首頁

echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
echo "	<tr>\n";
echo "		<td height=\"55\" colspan=\"2\">\n";
echo "			<table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "					<td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 詳細資料</td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"14\" colspan=\"2\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=2 style=\"padding-left:10px\">\n";
echo "			<table width=\"99%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list\">\n";
echo "				<tr class=\"table_header\">\n";
echo "					<td height=\"20\" align=\"center\"><b>類別</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>佔成</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>返水</b></td>\n";
echo "				</tr>\n";
echo "				\n";
echo "				<tr>\n";
echo "					<td height=\"20\" align=\"center\"><b>輪莊有倍數區</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>0%</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>{$array_Agent_Info['Agent_Backwater']}%</b></td>\n";

echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"20\" align=\"center\"><b>長莊無倍率區</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>{$array_Agent_Info['Agent_Share']}%</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>{$array_Agent_Info['Agent_Backwater2']}%</b></td>\n";

echo "				</tr>\n";
echo "				\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"20\" align=\"center\"><b>長莊有倍率區</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>{$array_Agent_Info['Agent_Share3']}%</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>{$array_Agent_Info['Agent_Backwater3']}%</b></td>\n";

echo "				</tr>\n";
echo "				\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";


// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>

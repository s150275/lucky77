<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "子帳號" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "agent_account.php" ;			// 設定本程式的檔名
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

$array_On[0] = "關閉" ;
$array_On[1] = "正常" ;

// 載入首頁
include($MAIN_BASE_ADDRESS . "agent/header.php") ;        // 載入首頁
/*
header.php已處理參數

$array_Agent_Info		登入代理人資料
$array_NowAgent_Info	目前操作代理人資料
$array_NowMember_Info	目前操作會員資料

$_SESSION['AID']		目前操作代理人ID
$_SESSION['AAgent_ID']	目前操作代理人Agent_ID
$_SESSION['MID']		目前操作會員ID

*/

//~@_@~// START 列表資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" height=\"110\">\n";
echo "	<tr>\n";
echo "		<td height=\"55\" colspan=\"2\">\n";
echo "			<table width=\"100%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "					<td width=\"49%\" align=\"left\" class=\"blue_text\">首頁 &gt; 子帳號列表</td>\n";
echo "					<td width=\"50%\" align=\"right\" class=\"blue_text\" style=\"color:#FF0000\">\n";
//echo "						各層代理如要修改佔成或退水，必須於每日01:00~02:00時段內。\n";
echo "					</td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"14\" colspan=\"3\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td height=\"25\" align=\"left\" colspan=2>\n";
echo "			<table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td height=\"25\" align=\"left\" width=\"120\">\n";
echo "						<a href=\"agents_add.php?Funct=ADD&AID={$_SESSION['AID']}&Agent_Level=2\"><img border=\"0\"\n";
echo "																  src=\"images/add_icon.gif\"\n";
echo "																  align=\"absmiddle\" style=\"padding-right:5px\">新增子帳號</a>\n";
echo "					</td>\n";
echo "					<td width=\"10%\" align=\"right\">關鍵字元：</td>\n";
echo "					<td width=\"15%\" align=\"center\"><input type=\"text\" name=\"keyword\" size=\"16\"\n";
echo "														  value=\"\">\n";
echo "						<input type=\"hidden\" name=\"mode\" value=\"\"></td>\n";
echo "					<td width=\"90\" align=\"left\">&nbsp;</td>\n";
echo "					<td width=\"55%\" align=\"left\"><input type=\"image\" src=\"images/search_button.jpg\"/></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "	<tr class=\"table_header\">\n";
echo "		<td height=\"20\" colspan=\"2\" align=\"center\">\n";
echo "			<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list\">\n";
echo "				<tr class=\"table_header\">\n";
echo "					<td width=\"20%\" height=\"20\" align=\"center\"><b>會員</b></td>\n";
echo "					<td width=\"20%\" height=\"20\" align=\"center\"><b>別名</b></td>\n";
echo "					<td width=\"20%\" height=\"20\" align=\"center\"><b>狀態</b></td>\n";
echo "					<td width=\"20%\" height=\"20\" align=\"center\"><b>開戶日期</b></td>\n";
echo "					<td width=\"20%\" height=\"20\" align=\"center\"><b>帳戶</b></td>\n";
echo "				</tr>\n";

// 設定每頁筆數
$row = $PUBLIC_DB_PAGE_NUM ;

// 找出代理人資料
$countSQL = "SELECT * FROM Agent WHERE Agent_Father_ID = '{$_SESSION['AAgent_ID']}' AND Agent_Level = '2' ORDER BY id_Agent DESC" ;
//echo $countSQL . "<br>" ; 
//$QUERY_Agent = mysqli_query($link , $SQL_Agent) ;

// 找出總筆數
$result = mysqli_query($link , $countSQL);  
//查詢時返回查詢到數據行數：mysqli_num_rows
$total = mysqli_num_rows($result);
$totalpage = ceil( $total / $PUBLIC_DB_PAGE_NUM );	// 取得總頁數
include_once("../includes/database/database_page.php");		// 計算資料庫筆數
$start = ($page-1) * $row;

$SQL_Agent = $countSQL . " LIMIT $start , $row";
//echo $SQL_Agent . "<br>" ; 
$QUERY_Agent = mysqli_query($link , $SQL_Agent) ;

// 是否有資料
if ( mysqli_num_rows($QUERY_Agent) )
{
	$tmp_Index = 0 ;
	// 一條條獲取
	while ($LIST_Agent = mysqli_fetch_assoc($QUERY_Agent))
	{
		$tmp_Index % 2 ? $tmp_Mouseout_CSS = "table_list_tr_bglight" : $tmp_Mouseout_CSS = "table_list_tr_bgdack" ;

		echo "				<tr class=\"$tmp_Mouseout_CSS\">\n";
		echo "					<td height=\"20\" align=\"center\">{$LIST_Agent['Agent_Name']}</td>\n";
		echo "					<td height=\"20\" align=\"center\"><a href=\"agents_add.php?ID={$LIST_Agent['id_Agent']}&Funct=MOD&AID={$_SESSION['AID']}&Agent_Level=2\">{$LIST_Agent['Agent_Name']}</a></td>\n";
		echo "					<td height=\"20\" align=\"center\">{$array_On[$LIST_Agent['Agent_On']]}</td>\n";
		echo "					<td height=\"20\" align=\"center\">{$LIST_Agent['Agent_Add_DT']}</td>\n";
		echo "					<td height=\"20\" align=\"center\">{$LIST_Agent['Agent_Login_Name']}</td>\n";
		echo "				</tr>\n";

		$tmp_Index++ ;
	}
	
	// 釋放結果集合
	mysqli_free_result($QUERY_Agent);
}
else
{	echo "<tr class='table_list_tr_bglight'><td colspan='5' align='center'>目前沒有任何子帳號資料</td></tr><br>" ;	}

echo "				<tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";
//~@_@~// E N D 列表資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲


// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>

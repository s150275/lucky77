<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "首頁" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "index.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "ID||*" ;
$ARRAY_POST_GET_PARA[] = "Member_Login_Passwd||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
//unset($_SESSION['Member_ID']);
//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面
// 載入首頁
include($MAIN_BASE_ADDRESS . "agent/header.php") ;        // 載入首頁

echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" height=\"110\">\n";
echo "	<tr>\n";
echo "		<td height=\"55\" colspan=\"2\">\n";
echo "			<table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "					<td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 公告列表</td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"14\" colspan=\"2\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";

if( $Funct == "SHOW" AND $ID )
{
	// 找出資料
	$array_Bulletin_Info = func_DatabaseGet( "Bulletin" , "*" , array("id_Bulletin"=>"$ID") ) ;		// 取得資料庫資料

	echo "				<tr class=\"$tmp_Class\">\n";
	echo "					<td align=\"\">\n";
	echo "					<p style='color:#f00;'>{$array_Bulletin_Info['Bulletin_Title']}</p>\n";
	echo "					<p>" . nl2br($array_Bulletin_Info['Bulletin_Content']) . "</p>\n";
	echo "					</td>\n";
	echo "				</tr>\n";
	
}
else
{
	echo "	<tr>\n";
	echo "		<td height=\"20\" colspan=\"2\" align=\"center\" style=\"padding-left:10px;height:350px\" valign=top>\n";
	echo "			<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list\">\n";
	echo "				<tr class=\"table_header\">\n";
	echo "					<td width=\"85%\" height=\"20\" align=\"center\"><b>公告主題</b></td>\n";
	echo "					<td width=\"15%\" height=\"20\" align=\"center\"><b>創建日期</b></td>\n";
	echo "				</tr>\n";

	$SQL_Bulletin = "SELECT * FROM Bulletin WHERE Bulletin_On = '1' ORDER BY Bulletin_Add_DT" ;
	//echo $SQL_Bulletin . "<br>" ; 
	$QUERY_Bulletin = mysqli_query($link , $SQL_Bulletin) ;

	$tmp_Index=0 ;

	// 是否有資料
	if ( mysqli_num_rows($QUERY_Bulletin) )
	{
		// 一條條獲取
		while ($LIST_Bulletin = mysqli_fetch_assoc($QUERY_Bulletin))
		{
			$tmp_Index % 2 ? $tmp_Class = "table_list_tr_bgdack" : $tmp_Class = "table_list_tr_bglight" ;
			echo "				<tr class=\"$tmp_Class \">\n";
			echo "					<td height=\"25\" align=\"left\"><a href=\"?Funct=SHOW&ID={$LIST_Bulletin['id_Bulletin']}\">{$LIST_Bulletin['Bulletin_Title']}</a>\n";
			echo "					</td>\n";
			echo "					<td align=\"center\">{$LIST_Bulletin['Bulletin_Add_DT']}</td>\n";
			echo "				</tr>\n";
			$tmp_Index++ ;
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_Bulletin);
	}

//	echo "				<tr>\n";
//	echo "					<td align=\"center\" height=\"30\" colspan=\"2\" class=\"table_footer\">共有 <b>12</b> 筆記錄 / 共計 <b>2</b> 頁<br>[ 第一頁 << 上10頁 <  <B>01</B>  <a href='?orderby=&page=2'>02</a> > 下10頁 >>  <a href='?orderby=&page=2'>最後頁</a> ] </td>\n";
//	echo "				</tr>\n";
	echo "			</table>\n";
	echo "		</td>\n";
	echo "	</tr>\n";
}
echo "</table>\n";
echo "\n";

// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>

<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "最新消息" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "news.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "news" ;				// 主要程式名稱

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
echo "		<h4>最新消息</h4>\n";
echo "		<div class=\"newsList\">\n";
echo "			<ul>\n";

$SQL = "SELECT * FROM News WHERE News_On = '1' ORDER BY News_Add_DT DESC" ;
//echo $SQL . "<br>" ; 
$QUERY = mysqli_query($link , $SQL) ;

// 是否有資料
if ( mysqli_num_rows($QUERY) )
{
    // 一條條獲取
    while ($LIST = mysqli_fetch_assoc($QUERY))
    {
		echo "				<li>\n";
		echo "					<label>\n";
		echo "					<span><i class=\"fas fa-rss\"></i>{$LIST['News_Title']}</span>\n";
		echo "					</label>\n";
		echo "					" . $LIST['News_Content'] . "\n";
		echo "					<p class='News_Add_DT'>時間 : {$LIST['News_Add_DT']}</p>\n";
		echo "				</li>\n";
    }

    // 釋放結果集合
    mysqli_free_result($QUERY);
}
else
{
	echo "				<li>\n";
	//echo "					<label>\n";
	//echo "					<span><i class=\"fas fa-rss\"></i>系統公告</span>\n";
	//echo "					<span>2020-02-1</span>\n";
	//echo "					</label>\n";
	echo "					<p>目前沒有相關資料</p>\n";
	echo "				</li>\n";
}

//echo "				<li>\n";
//echo "					<label>\n";
//echo "						<span> <i class=\"fas fa-rss\"></i>系統公告</span>\n";
//echo "						<span>2020-02-1</span>\n";
//echo "					</label>\n";
//echo "					<p>每人每桌最多可下注隨機位置4個。</p>\n";
//echo "				</li>\n";
//echo "				<li>\n";
//echo "					<label>\n";
//echo "						<span> <i class=\"fas fa-rss\"></i>系統公告</span>\n";
//echo "						<span>2020-02-1</span>\n";
//echo "					</label>\n";
//echo "					<p>每人每桌最多可下注隨機位置4個。</p>\n";
//echo "				</li>\n";
echo "			</ul>\n";
echo "		</div>\n";

echo "	</div>\n";
echo "</main>\n";

// 載入版權
include($MAIN_BASE_ADDRESS . "footer.php") ;        // 載入版權
?>

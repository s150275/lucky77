<?php
// ############ ########## ########## ############
// ## 設定基本變數				##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "Json" ;	// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;			// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "api" ;				// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Member" ;			// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "Register.php" ;	// 設定本程式的檔名
$MAIN_CHECK_FIELD       = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;				// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_PROGRAM_TYPE	= "0" ;				// 設定此網頁是否為管理模式-0:不管制,A:一般管制(1111),P:程式權限管制(根據System_LevelP的設定),程式模式(0:一般模式,1:管理模式...)
$MAIN_NOW_TIME          = date("Y-m-d H:i:s") ;		// 取得現在的時間
$MAIN_NOW_DATE          = date("Y-m-d") ;		// 取得現在的日期

$tmp_Show_Msg = "0" ;		// 1:秀出除錯資料,0:不秀出除錯資料
$tmp_Add_Database = "1" ;		// 1:加入資料庫,0:不加入資料庫

// IP是否為自己
if( $_SERVER['REMOTE_ADDR'] != "123.204.49.232" )
{	exit;	}

// ############ ########## ########## ############
// ## 載入模組					##
// ############ ########## ########## ############
include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
include_once($MAIN_BASE_ADDRESS . "includes/bot.php");

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "Funct_Value||*" ;
$ARRAY_POST_GET_PARA[] = "LineID||*" ;
$ARRAY_POST_GET_PARA[] = "LineID_Value||*" ;
$ARRAY_POST_GET_PARA[] = "Code||*" ;
$ARRAY_POST_GET_PARA[] = "Code_Value||*" ;
$ARRAY_POST_GET_PARA[] = "Other1||*" ;
$ARRAY_POST_GET_PARA[] = "Other_Value1||*" ;
$ARRAY_POST_GET_PARA[] = "Other2||*" ;
$ARRAY_POST_GET_PARA[] = "Other_Value2||*" ;
$ARRAY_POST_GET_PARA[] = "Other3||*" ;
$ARRAY_POST_GET_PARA[] = "Other_Value3||*" ;
$ARRAY_POST_GET_PARA[] = "json_content||*" ;
$ARRAY_POST_GET_PARA[] = "key||*" ;

include($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

// 使用方法-http://ww160002.linebot.net/api/Json.php?key=yldu


// 秀出註冊頁
function showForm( $tmp_msg )
{
global $PUBLIC_DB_HOST ;
global $PUBLIC_DB_USER ;
global $PUBLIC_DB_PASSWD ;
global $PUBLIC_DB_DATABASE ;
global $key;

	echo "<html lang='zh-TW' dir='ltr'><meta charset=\"utf-8\" />\n" ;
	echo "<form method=\"post\" action=\"Json.php\">\n";
	echo "<input type=\"hidden\" name=\"Funct\" value=\"json\" />\n";
	echo "<input type=\"hidden\" name=\"key\" value=\"$key\" />\n";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "<tr>\n";
	echo "	<td class=\"put_center\" colspan=2><h1>固定格式</h1></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td class=\"put_left\">功能參數</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td><input type=\"text\" value=\"Funct\" name=\"Json\" required=\"required\" /></td>\n";
	echo "	<td><input type=\"text\" value=\"\" name=\"Funct_Value\" required=\"required\" /></td>\n";
	echo "</tr>\n";

	echo "<tr>\n";
	echo "	<td class=\"put_left\" colspan=2>會員Line內部ID和會員代碼二選一</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td class=\"put_left\">會員Line內部ID</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td><input type=\"text\" value=\"Member_LineID\" name=\"LineID\" /></td>\n";
	echo "	<td><input type=\"text\" value=\"\" name=\"LineID_Value\" /></td>\n";
	echo "</tr>\n";

	echo "<tr>\n";
	echo "	<td class=\"put_left\">會員代碼</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td><input type=\"text\" value=\"Member_Code\" name=\"Code\" /></td>\n";
	echo "	<td><input type=\"text\" value=\"\" name=\"Code_Value\" /></td>\n";
	echo "</tr>\n";

	echo "<tr>\n";
	echo "	<td class=\"put_left\">其它參數1</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td><input type=\"text\" value=\"\" name=\"Other1\" /></td>\n";
	echo "	<td><input type=\"text\" value=\"\" name=\"Other_Value1\" /></td>\n";
	echo "</tr>\n";

	echo "<tr>\n";
	echo "	<td class=\"put_left\">其它參數2</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td><input type=\"text\" value=\"\" name=\"Other2\" /></td>\n";
	echo "	<td><input type=\"text\" value=\"\" name=\"Other_Value2\" /></td>\n";
	echo "</tr>\n";

	echo "<tr>\n";
	echo "	<td class=\"put_left\">其它參數3</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td><input type=\"text\" value=\"\" name=\"Other3\" /></td>\n";
	echo "	<td><input type=\"text\" value=\"\" name=\"Other_Value3\" /></td>\n";
	echo "</tr>\n";

	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td colspan=\"2\" class=\"put_center\"><input type=\"submit\" value=\"產生Json碼\" class=\"sent_btn\"></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</form>	\n";


	echo "<form method=\"post\" action=\"Json.php\">\n";
	echo "<input type=\"hidden\" name=\"Funct\" value=\"json_content\" />\n";
	echo "<input type=\"hidden\" name=\"key\" value=\"$key\" />\n";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "<tr>\n";
	echo "	<td class=\"put_left\"><h1>文字大量設定</h1></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td>\n";
	echo "	<textarea name='json_content' style='width:100%;height:200px;'></textarea>";
	echo "	</td>\n";
	echo "</tr>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td colspan=\"2\" class=\"put_left\"><input type=\"submit\" value=\"產生Json碼\" class=\"sent_btn\"><br>
	設定說明:<br>每一行為一個參數<br>奇數行為名稱,偶數行為內容,<br>如果偶數行設為NowTime,表示現在的時間<br>
	例如:<br>Funct<br>Show<br>Member_LineID<br>11111<br>Time<br>NowTime</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</form>	\n";

	echo "<form method=\"post\" action=\"Json.php\">\n";
	echo "<input type=\"hidden\" name=\"Funct\" value=\"json_URL\" />\n";
	echo "<input type=\"hidden\" name=\"key\" value=\"$key\" />\n";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "<tr>\n";
	echo "	<td class=\"put_left\"><h1>進入後台網址</h1></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td>\n";
	echo "	<textarea name='json_content' style='width:100%;height:200px;'></textarea>";
	echo "	</td>\n";
	echo "</tr>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "	<td colspan=\"2\" class=\"put_left\"><input type=\"submit\" value=\"產生網址\" class=\"sent_btn\"><br>
	設定說明:<br>
	每一行為一個參數<br>
	URL			// 執行網址<br>
	Member		// 執行檔案所在路徑<br>
	index.php	// 執行檔名<br>
	Funct		// 功能<br>
	Member_ID	// 會員ID<br><br>
	
	例如:<br>
	http://w100001.auction.jjvk.com<br>
	Member<br>
	index.php<br>
	Member<br>
	Member9826490824<br><br>
	
	產生<br>
	http://w100001.auction.jjvk.com/Member/index.php?Funct=Member&Member_ID=Member9826490824&Time=20170101000000&hash=5464<br><br>
	";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</form>	\n";
}

//include($MAIN_BASE_ADDRESS . "includes/header.php") ;	// 載入

if($key != "yldu" )
{
	exit;
}

echo "<div id=\"register_form\">\n"; 
//~@_@~// START 秀出Json資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
if( $Funct == "json" )
{
	// 產生陣列
	$ArrayInput[$Funct] = $Funct_Value ;
	// 是否為LineID
	if( $LineID AND $LineID_Value )
	{	$ArrayInput[$LineID] = $LineID_Value ;	}

	// 是否為會員代碼
	if( $Code AND $Code_Value )
	{	$ArrayInput[$Code] = $Code_Value ;	}
	
	$ArrayInput['Time'] = date("Y-m-d H:i:s") ;

	// 是否有設定其它參數1
	if( $Other1 AND $Other_Value1 )
	{	$ArrayInput[$Other1] = $Other_Value1 ;	}

	// 是否有設定其它參數2
	if( $Other2 AND $Other_Value2 )
	{	$ArrayInput[$Other2] = $Other_Value2 ;	}

	// 是否有設定其它參數3
	if( $Other3 AND $Other_Value3 )
	{	$ArrayInput[$Other3] = $Other_Value3 ;	}
	// 秀出陣列
	//print_r($ArrayInput);

	$tmpSentJson = getOutputJson( $ArrayInput ) ;
	echo "產生Json<br>" ;
	echo "<textarea style='width:100%;height:200px;'>?Json=$tmpSentJson</textarea>";
}
//~@_@~// END 秀出Json資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出區域Json資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
elseif( $Funct == "json_content" )
{
	// 用多行轉換
	//echo "$json_content<br>" ;
	$array = str2array( $json_content , "\r\n" );
	//print_r($array);
	for ( $i = 0 ; $i < sizeof($array) ; $i = $i + 2 )
	{
		$key = $array[$i];
		
		if ( empty($key) )
		continue;
		
		$value = $array[$i+1];
		// 如果為設定時間
		if ( $value == "NowTime")
		{	$value = date("Y-m-d H:i:s");	}
		$ArrayInput[$key] = $value;
	}
	$tmpSentJson = getOutputJson( $ArrayInput ) ;
	
	echo "產生Json<br>" ;
	echo "<textarea style='width:100%;height:200px;'>?Json=$tmpSentJson</textarea>";
}
//~@_@~// END 秀出區域Json資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出進入網頁網址 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
elseif( $Funct == "json_URL" )
{
	/*
	基本參數
	URL			// 執行網址
	Member		// 路徑
	index.php	// 執行檔名
	Member		// 功能
	Member_ID	// 會員ID
	*/
	// 用多行轉換
	//echo "$json_content<br>" ;

	// textarea設定
	if ( $json_content )
	{
		// http://ww110001.linebot.net/api/Json.php?key=yldu
		//參數:
		//http://ww110001.linebot.net		要執行的URL
		//Member							檔案所在目錄
		//Member_Score.php					執行檔名
		//Score								執行功能
		//Member3563945347					會員ID

		$array = str2array( $json_content , "\r\n" );

		$Para_URL = $array[0] ;			// 要執行的URL
		$Para_Addess = $array[1] ;			// 檔案所在目錄
		$Para_File = $array[2] ;			// 執行檔名
		$Para_Funct = $array[3] ;			// 執行功能
		$Para_Member_ID = $array[4] ;			// 會員ID

		$ArrayInput['Funct'] = $Para_Funct;
		$ArrayInput['Member_ID'] = $Para_Member_ID;
		$ArrayInput['Time'] = getSplitDate( date("Y-m-d H:i:s") , "DS");
	}
	// get url設定
	else
	{
		//http://ww110001.linebot.net/api/Json.php?key=yldu&Funct=json_URL&Para_URL=http://ww110001.linebot.net&Para_Addess=Member&Para_File=Member_Score.php&Para_Funct=Score&Para_Member_ID=Member3563945347
		//參數:
		//&Funct=json_URL							主要功能(不變)
		//&Para_URL=http://ww110001.linebot.net		要執行的URL
		//&Para_Addess=Member						檔案所在目錄
		//&Para_File=Member_Score.php				執行檔名
		//&Para_Funct=Score							執行功能
		//&Para_Member_ID=Member3563945347			會員ID

		$Para_URL = $_GET['Para_URL'] ;			// 要執行的URL
		$Para_Addess = $_GET['Para_Addess'] ;			// 檔案所在目錄
		$Para_File = $_GET['Para_File'] ;			// 執行檔名
		$Para_Funct = $_GET['Para_Funct'] ;			// 執行功能
		$Para_Member_ID = $_GET['Para_Member_ID'] ;			// 會員ID

//echo "$Para_URL - $Para_Addess - $Para_File - $Para_Funct - $Para_Member_ID<br>";

		$ArrayInput['Funct'] = $Para_Funct;
		$ArrayInput['Member_ID'] = $Para_Member_ID;
		$ArrayInput['Time'] = getSplitDate( date("Y-m-d H:i:s") , "DS");
	}
	$tmphash = getInputHash( $ArrayInput ) ;

	$tmpURL = $Para_URL . "/" . $Para_Addess . "/" .$Para_File . "?Funct=" . $Para_Funct . "&Member_ID=" . $Para_Member_ID . "&Time=" . $ArrayInput['Time'] . "&hash=" . $tmphash ;
//http://w100001.auction.jjvk.com/Member/index.php?Funct=Member&Member_ID=Member9826490824&Time=20170101000000&hash=5464
//http://w100001.auction.jjvk.com/Member/index.php?Funct=Member&Member_ID=Member9826490824&Time=20180502100727&hash=58e9a1b13685515e11acaabc7aaca725

//http://w100001.auction.jjvk.com
//Member
//index.php
//Member
//Member9826490824

	echo "產生Json<br>" ;
	echo "<textarea style='width:100%;height:200px;'>$tmpURL</textarea>";
	echo "<a href='$tmpURL' target='_new'>前往URL</a>" ;
}
//~@_@~// END 秀出進入網頁網址 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

//~@_@~// START 秀出填寫Json頁面 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
else
{
	// 秀出畫面
	showForm("");
}
//~@_@~// END 秀出填寫Json頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

echo "  </div>\n";


//include($MAIN_BASE_ADDRESS . "includes/footer.php") ;	// 載入
?>

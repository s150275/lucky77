<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "最新消息" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "admin/" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "News" ;		// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "m_News.php" ;			// 設定本程式的檔名
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
//include_once($MAIN_BASE_ADDRESS . "includes/bot.php");
include_once($MAIN_BASE_ADDRESS . "includes/func_wostory.php");

checkSystemUser();

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;
$ARRAY_POST_GET_PARA[] = "page||*" ;
$ARRAY_POST_GET_PARA[] = "DESC||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_FIELD||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_KEY||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

// 內定設定參數-----------------------------------------
// 功能啟用設定
$array_On[0] = "下架";
$array_On[1] = "上架";
//$array_On[2] = "垃圾桶";

// 置頂狀態
$array_News_PutTop[0] = "一般";
$array_News_PutTop[1] = "置頂";

// 功能啟用顏色
$array_On_Label[0] = "label label-warning";
$array_On_Label[1] = "label label-info";

// 設定查詢欄位
$array_Search_Field['News_Title'] = "最新消息標題" ;
$array_Search_Field['News_Content'] = "最新消息內容" ;

// 設定子類別選項
$array_subType[] = "下架||SEARCH_FIELD=News_On&SEARCH_KEY=0" ;
$array_subType[] = "上架||SEARCH_FIELD=News_On&SEARCH_KEY=1" ;
$array_subType[] = "置頂||SEARCH_FIELD=News_PutTop&SEARCH_KEY=1" ;
$array_subType[] = "一般||SEARCH_FIELD=News_PutTop&SEARCH_KEY=0" ;

include_once("admin_header.php") ;	// 快速請取網頁傳來的參數

// 取得傳入的參數
function getPara()
{
	global $Global_Get ;	// GET用參數
	global $Global_Post ;	// POST參數(input隱藏欄位)
	global $Global_ADDSQL ;	// 新增SQL
	global $Global_MODSQL ;	// 修改SQL

	// 格式說明
	// 參數一 : 欄位名稱
	// 參數二 : GET和POST欄位設定(*)
	// 參數三 : 新增SQL欄位設定(ADD)
	// 參數四 : 修改SQL欄位設定(MOD)
	// 參數五 : 變數格式(INT)
	//不用可以設成"-"即可
	$ARRAY_POST_GET_PARA1[] = "News_Title||*||-||MOD||-" ;	// 消息標題
	$ARRAY_POST_GET_PARA1[] = "News_Pict_Name||*||-||-||-" ;	// 消息圖片名稱
	$ARRAY_POST_GET_PARA1[] = "News_Content||*||ADD||MOD||-" ;	// 消息內容

	$ARRAY_POST_GET_PARA1[] = "News_PutTop||*||ADD||MOD||INT" ;	// 置頂
	$ARRAY_POST_GET_PARA1[] = "News_On||*||ADD||MOD||INT" ;

	sub_post_get($ARRAY_POST_GET_PARA1) ;

//	echo "GET參數 :　$Global_Get<br><br>" ;
//	echo "ADDSQL參數 :　$Global_ADDSQL<br><br>" ;
//	echo "MODSQL參數 :　$Global_MODSQL<br><br>" ;
}

// 秀出form資料
function showForm( $subLIST , $subFUNCT )
{
	global $MAIN_FILE_NAME ;
	global $MAIN_BASE_ADDRESS ;
	global $MAIN_CHECK_FIELD ;
	global $MAIN_SHOWTYPE ;
	global $array_Funct_Txet ;
	global $errMsg ;
	global $array_On ;
	global $link ;

	// 外加變數
	global $array_News_Category ;
	global $array_News_PutTop ;
	echo "<div class=\"row\">\n";
	echo "	<div class=\"col-lg-12\">\n";
	echo "\n";
				
	//showBackListButton() ;	// 秀出上一頁和回列表按鈕
	//$arrayNewsStateInfo = wostory_getNews_StateInfo( $subLIST ) ;	// 取得目前優惠券狀態

	echo "<form action=\"$MAIN_FILE_NAME\" method=\"post\" id=\"insertform\" name=\"insertform\" role=\"form\" enctype=\"multipart/form-data\" onsubmit='hide_mloading_Form()'>\n";
	echo "<input name=\"Funct\" type=\"hidden\" id=\"Funct\" value=\"$subFUNCT\">\n";
	echo "<input name=\"ID\" type=\"hidden\" id=\"ID\" value=\"" . $subLIST['id_News'] . "\">\n";
	echo "<input name=\"SHOWTYPE\" type=\"hidden\" id=\"SHOWTYPE\" value=\"$MAIN_SHOWTYPE\">\n";
	if ( $errMsg )
	{
		echo "<div class=\"form-group\">\n";
		echo "	<p style=\"color:#f00;font-size:16px;text-align:center;\">$errMsg</p>\n";
		echo "</div>\n";
	}
	// 開始加入欄位
//News_Title			VARCHAR(50)		NOT NULL COMMENT '消息標題' ,			#::CHAR::
//News_Pict			VARCHAR(50)		NOT NULL COMMENT '消息圖片' ,			#::PICT::
//News_Content		TEXT			NOT NULL COMMENT '消息內容' ,			#::TEXT::
//News_Count			INT				NOT NULL COMMENT '瀏覽次數' ,			#::INT::
//News_PutTop			TINYINT			DEFAULT 0 NOT NULL COMMENT '置頂' ,		#**||15::SELECT:2||0||一般||1||置頂:
//News_Mod_DT			DATETIME		NOT NULL COMMENT '修改日期' ,			#::ADDDATETIME::
//News_Add_DT			DATETIME		NOT NULL COMMENT '新增日期' ,			#::ADDDATETIME::
//News_On				TINYINT			DEFAULT 0 NOT NULL COMMENT '消息狀態' 	#::SELECT:2||0||下架||1||上架:
			
	echo "<div class=\"form-group\">\n";
	echo "    <label>消息標題</label>\n";
	if ( $subFUNCT != "SHOW" )
	{	echo "<input type=\"text\" name=\"News_Title\" id=\"News_Title\" class=\"form-control\" value=\"" . $subLIST['News_Title'] . "\" required>\n";	}
	else
	{	echo $subLIST['News_Title'] . "\n";	}
	echo "</div>\n";
	
	echo "<div class=\"form-group\">\n";
	echo "    <label>消息圖片(圖檔大小請勿大於2M)</label>\n";
	if ( $subFUNCT != "SHOW" )
	{	echo "<input type=\"file\" name=\"News_Pict\" id=\"News_Pict\" class=\"form-control\">\n";	}

	// 圖檔是否存在
	if ( $subLIST['News_Pict'] )
	{	echo "   網址 : https://{$_SERVER['HTTP_HOST']}/images/News/" . $subLIST["News_Pict"] . "<br><img src='../images/News/" . $subLIST["News_Pict"] . "' width='200'>\n";	}
	//else
	//{	echo $subLIST['News_Pict'] . "\n";	}
	echo "<input type=\"hidden\" name=\"News_Pict_Name\" id=\"News_Pict_Name\" value=\"{$subLIST['News_Pict']}\">\n";

	echo "</div>\n";
	
	echo "<div class=\"form-group\">\n";
	echo "    <label>消息內容</label>\n";
	if ( $subFUNCT != "SHOW" )
	{	echo "<textarea id=\"e-News_Content\" name=\"News_Content\" class='form-control' style=\"background-color:#f00!important;\">" . $subLIST['News_Content'] . "</textarea>\n";	}
	else
	{	echo nl2br($subLIST['News_Content']) . "\n";	}
	echo "</div>\n";
	include_once "../ckeditor/ckeditor.php";
	$CKEditor = new CKEditor();
	$CKEditor->basePath = '../ckeditor/';
	$CKEditor->config['width'] = '100%';
	$CKEditor->config['height'] = '310';
	$CKEditor->replace("e-News_Content");

	// 結束加入欄位

	echo "<div class=\"form-group abgne-menu-20140101-1\">\n";
	echo "<label>置頂狀態</label>\n";
	if ( $subFUNCT != "SHOW")
	{
		echo "<input type=\"radio\" name=\"News_PutTop\" id=\"News_PutTop1\" value=\"1\"" . checksCheckBox($subLIST['News_PutTop'], 1) . "><label for=\"News_PutTop1\">" . $array_News_PutTop[1] . "</label>\n";
		echo "<input type=\"radio\" name=\"News_PutTop\" id=\"News_PutTop0\" value=\"0\"" . checksCheckBox($subLIST['News_PutTop'], 0) . "><label for=\"News_PutTop0\">" . $array_News_PutTop[0] . "</label>\n";
	}
	else
	{
		echo $array_On[(int)$subLIST['News_PutTop']] . "\n";
	}
	echo "</div>\n";

	echo "<div class=\"form-group abgne-menu-20140101-1\">\n";
	echo "<label>狀態</label>\n";
	if ( $subFUNCT != "SHOW")
	{
		echo "<input type=\"radio\" name=\"News_On\" id=\"News_On1\" value=\"1\"" . checksCheckBox($subLIST['News_On'], 1) . "><label for=\"News_On1\">" . $array_On[1] . "</label>\n";
		echo "<input type=\"radio\" name=\"News_On\" id=\"News_On0\" value=\"0\"" . checksCheckBox($subLIST['News_On'], 0) . "><label for=\"News_On0\">" . $array_On[0] . "</label>\n";
	}
	else
	{	echo $array_On[(int)$subLIST['News_On']] . "\n";	}
	echo "</div>\n";

	if ( $subFUNCT != "SHOW")
	{
		echo "<button type=\"submit\" class=\"btn btn-default\">送出</button>\n";
		echo "<button type=\"reset\" class=\"btn btn-default\">重設</button>\n";
		echo "<a href=\"#\" class=\"btn btn-default\" onclick=\"window.parent.location.reload();\">關閉</a>\n";
	}
	else
	{
		echo "<a href=\"$MAIN_FILE_NAME?Funct=MOD&ID=" . $subLIST['id_News'] . "\" class=\"btn btn-default\">修改</a>\n";
//				echo "<a href=\"$MAIN_FILE_NAME?Funct=DELOK&ID=" . $subLIST['id_HostInfo'] . "\" class=\"btn btn-default\" onclick=\"return isok(this,'是否要刪除資料')\">刪除</a>\n";
	}
	echo "</form>\n";
}

echo "<style>\n";
echo "table\n";
echo "{\n";
echo "	border: 1px solid #000;\n";
echo "	border-collapse: collapse;\n";
echo "}\n";
echo "tr , td\n";
echo "{\n";
echo "	border: 1px solid #000;\n";
echo "	padding:10px;\n";
echo "	font-size:18px;\n";
echo "}\n";
echo "</style>\n";
echo "\n";

echo "<div id=\"page-wrapper\">\n";
echo "	<div class=\"row\">\n";
echo "		<div class=\"col-lg-12\">\n";
echo "			<h1 class=\"page-header\"><a href=\"$MAIN_FILE_NAME\">{$_SESSION['Store_Name']}-$MAIN_PROGRAM_TITLE</a><a href=\"$MAIN_FILE_NAME?Funct=ADD\" class=\"btn btn-primary\" style='float:right;'>新增</a></h1>\n";
echo "		</div>\n";
echo "		<!-- /.col-lg-12 -->\n";
echo "	</div>\n";
echo "	<!-- /.row -->\n";
echo "\n";

if ( $Funct == "ADD" )
{
	$LIST = array();
	showForm( $LIST , "ADDOK" );
}
elseif ( $Funct == "ADDOK" )
{
	// 取得傳入的參數
	getPara();
	// 其它SQL參數
	$tmpSQL = "" ;
	// 錯誤訊息
	$errMsg = "" ;

	// 查詢商品類別名稱否已存在
	if ( CheckFieldExist( "News" , "News_Title" , "$News_Title" ) )
	{	$errMsg = "消息標題已存在,請重新設定..." ;	}
	else
	{	$tmpSQL .= " News_Title = '" . $News_Title . "' , " ;	}

	// 找出ID
	//include($MAIN_BASE_ADDRESS . "includes/sub/sub_get_ID.sub") ;	// 載入會員編號產生器
	//$tempID = getID ( "4" , "ymd" , "News" , "News_ID" , "News") ;
	//$tmpSQL .= " News_ID = '$tempID' , " ;

	// 密碼設定OK
	if ( $errMsg == "" )
	{
		if( $_FILES['News_Pict']['error'] == 0 )
		{	// 上傳成功
			$extension = strtolower(pathinfo($_FILES['News_Pict']['name'] , PATHINFO_EXTENSION));		//取得檔案副檔名
			
			if( in_array( $extension , array( 'jpg' , 'jpeg' , 'png' , 'gif' ) ) )
			{//檢查檔案副檔名
				$tmp_News_Pict_UPOK = "1" ;
			}
			else
			{
				echo '不允許該檔案格式';
			}
		}


		// 加入秀出時間
		$tmpSQL .= " News_Add_DT = '" . $MAIN_NOW_TIME . "' , " ;
		$tmpSQL .= " News_Mod_DT = '" . $MAIN_NOW_TIME . "' , " ;

		//寫入資料庫
		$insertSQL="INSERT INTO $MAIN_DATABASE_NAME SET 
		$tmpSQL 
		$Global_ADDSQL
		";
		//echo "$insertSQL<br>" ;

		if(mysqli_query($link , $insertSQL))
		{
			if( $tmp_News_Pict_UPOK )
			{// 有圖片上傳
				$id = mysqli_insert_id($link) ;
				$tmpNowDate = getSplitDate( $MAIN_NOW_TIME , "DS") ;			// 日期去掉分隔符號
				$tmp_News_Pict = "News_{$id}_{$tmpNowDate}.$extension" ;
				// 移到新增完成再設定
				move_uploaded_file($_FILES['News_Pict']['tmp_name'] , "../images/News/" . $tmp_News_Pict );	//複製檔案
				$Bol = func_DatabaseBase( "News" , "MOD" , array("News_Pict"=>$tmp_News_Pict) , " id_News = '$id'" ) ;		// 資料庫處理
			}

			alertgo("資料新增成功...." , $MAIN_FILE_NAME );
		}
		else
		{	$errMsg = "新增失敗" ;	}
	}
	showForm( $_POST , "ADDOK" );
	
}
elseif ( $Funct == "MOD" )
{
	$modSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE id_News = '$ID'" ;
	//echo "$modSQL<br>" ;
	$QUERY_Mod = mysqli_query($link , $modSQL) ;
	
	// 有資料時執行
	if ( mysqli_num_rows($QUERY_Mod) )
	{	$LIST = mysqli_fetch_assoc($QUERY_Mod) ;	}
	showForm( $LIST , "MODOK" );
}
elseif ( $Funct == "MODOK" )
{
	// 取得傳入的參數
	getPara();
	
	// 是否有圖片
	if( $_FILES['News_Pict']['error'] == 0 )
	{	// 上傳成功
		$extension = strtolower(pathinfo($_FILES['News_Pict']['name'] , PATHINFO_EXTENSION));		//取得檔案副檔名
		
		if( in_array( $extension , array( 'jpg' , 'jpeg' , 'png' , 'gif' ) ) )
		{//檢查檔案副檔名
			$tmp_News_Pict_UPOK = "1" ;
		}
		else
		{
			echo '不允許該檔案格式';
		}
	}

	if ( $errMsg == "" )
	{
		$modSQL = "UPDATE $MAIN_DATABASE_NAME SET
		$tmpSQL
		$Global_MODSQL
		WHERE id_News = '$ID'" ;
		//echo "$modSQL<br>" ;
		
		if ( mysqli_query($link , $modSQL) )
		{
			if( $tmp_News_Pict_UPOK )
			{// 有圖片上傳
				if( $News_Pict_Name )
				{// 原來已有上傳檔案
					$array_News_Pict_Name = str2array($News_Pict_Name , ".");
					$tmp_News_Pict = "{$array_News_Pict_Name[0]}.$extension" ;
				}
				else
				{//新上傳檔案
					$tmpNowDate = getSplitDate( $MAIN_NOW_TIME , "DS") ;			// 日期去掉分隔符號
					$tmp_News_Pict = "News_{$ID}_{$tmpNowDate}.$extension" ;
				}
				// 移到新增完成再設定
				move_uploaded_file($_FILES['News_Pict']['tmp_name'] , "../images/News/" . $tmp_News_Pict );	//複製檔案
				$Bol = func_DatabaseBase( "News" , "MOD" , array("News_Pict"=>$tmp_News_Pict) , " id_News = '$ID'" ) ;		// 資料庫處理
			}
			alertgo( "資料修改完成" , $MAIN_FILE_NAME ) ;
		}
		else
		{	echo "修改資料失敗!!" ;	}
	}
	showForm( $_POST , "MODOK" );
}
// 刪險資料
elseif ( $Funct == "DEL" )
{
	$modSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $MAIN_CHECK_FIELD = '$ID'" ;
	//echo "$SQL_Member<br>" ;
	$QUERY_Mod = mysqli_query($link , $modSQL) ;
	
	// 有資料時執行
	if ( mysqli_num_rows($QUERY_Mod) )
	{	$LIST = mysqli_fetch_assoc($QUERY_Mod) ;	}
	showForm( $LIST , "DELOK" );
}
elseif ( $Funct == "DELOK" )
{
	$_POST['SELECT_ID'] ? $SELECT_ID = $_POST['SELECT_ID'] : $SELECT_ID = $_GET['SELECT_ID'] ;
	//print_r($SELECT_ID);
	// 求出所傳入要從資料庫中刪除的個數
	$COUNT_SELECT_ID = sizeof($SELECT_ID) ;
	
	//~@_@~// START 是否有要集體刪除的動作 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
	if( $COUNT_SELECT_ID )
	{
		// 清空資料
		$HAS_DATA = 0 ;
		$TEMP_DATA = "" ;
	
		// 把所有勾選的選項加入SQL中
		for( $FOR_COUNT = 0 ; $FOR_COUNT < $COUNT_SELECT_ID ; $FOR_COUNT++ )
		{
			// 判斷是否已加過資料,已有資料就先加入,再加入新資料
			if( $HAS_DATA )
			{    $TEMP_DATA = $TEMP_DATA . " OR " ;    }
			else
			{    $HAS_DATA = 1 ;    }
	
			// 加入資料
			$TEMP_DATA = $TEMP_DATA . $MAIN_CHECK_FIELD . " = " . $SELECT_ID[$FOR_COUNT] ;
		}
		//echo "$TEMP_DATA<br>" ;
	}
	//~@_@~// END 是否有要集體刪除的動作 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
	//~@_@~// START 單一刪除動作 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
	else
	{	$TEMP_DATA = "$MAIN_CHECK_FIELD = '$ID'" ;	}
	//~@_@~// END 單一刪除動作 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
	
	// 把SQL參數組合起來
	$delSQL = "DELETE FROM $MAIN_DATABASE_NAME WHERE $TEMP_DATA" ;
	//echo "$delSQL" ;
	if ( mysqli_query($link , $delSQL) )
	//	if ( 0 )
	{
		if ( $MAIN_SHOWTYPE == "POP" AND !($MAIN_DELCHECK == 1 OR $COUNT_SELECT_ID ) )
		{
			echo "<script>\n" ;
			echo "window.parent.location.reload();\n" ;
			echo "</script>\n" ;
		}
		else
		{	alertgo( "資料刪除完成" , $MAIN_FILE_NAME ) ;	}
	}
	else
	{	echo "刪除資料失敗!!" ;	}
}
elseif ( $Funct == "SHOW" )
{
	$modSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE id_News = '$ID'" ;
	//echo "$SQL_News<br>" ;
	$QUERY_Mod = mysqli_query($link , $modSQL) ;
	
	// 有資料時執行
	if ( mysqli_num_rows($QUERY_Mod) )
	{	$LIST = mysqli_fetch_assoc($QUERY_Mod) ;	}
	showForm( $LIST , "SHOW" );
}
elseif  ( $Funct == "ON" OR $Funct == "DOWN")
{
	$_POST['SELECT_ID'] ? $SELECT_ID = $_POST['SELECT_ID'] : $SELECT_ID = $_GET['SELECT_ID'] ;
	//print_r($SELECT_ID);
	// 讀取發表資料
	if ( $Funct == "ON" )
	{
		$News_on = "1" ;
		$News_on_str = $array_On[$News_on] ;
	}
	else
	{
		$News_on = "0" ;
		$News_on_str = $array_On[$News_on] ;
	}

	// 求出所傳入要從資料庫中刪除的個數
	$COUNT_SELECT_ID = sizeof($SELECT_ID) ;

	//~@_@~// START 是否有要集體刪除的動作 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
	if( $COUNT_SELECT_ID )
	{
		// 清空資料
		$HAS_DATA = 0 ;
		$TEMP_ID_DATA = "" ;

		// 把所有勾選的選項加入SQL中
		for( $FOR_COUNT = 0 ; $FOR_COUNT < $COUNT_SELECT_ID ; $FOR_COUNT++ )
		{
			// 判斷是否已加過資料,已有資料就先加入,再加入新資料
			if( $HAS_DATA )
			{    $TEMP_ID_DATA = $TEMP_ID_DATA . " OR " ;    }
			else
			{    $HAS_DATA = 1 ;    }

			// 加入資料
			$TEMP_ID_DATA = $TEMP_ID_DATA . "$MAIN_CHECK_FIELD = '$SELECT_ID[$FOR_COUNT]'" ;
		}
	}
//echo "$TEMP_ID_DATA" ;

	//~@_@~// END 是否有要集體刪除的動作 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

	// 設定所要秀改資料的SQL字串(正常下是不修改System_LevelP_ID)7
	$SQL = "UPDATE $MAIN_DATABASE_NAME SET
	News_On = '$News_on'
	WHERE $TEMP_ID_DATA" ;
	//echo "$SQL<br>" ;

	if ( mysqli_query($link , $SQL) )
	{
		alertgo( "$News_on_str 資料修改完成" , $MAIN_FILE_NAME ) ;
	}
	else
	{
		$errMsg = "$News_on_str 修改資料失敗!!" ;
	}
}
else
{
	echo "<form action=\"Store_News.php\" method=\"post\" name=\"searchform\" id=\"searchform\" class=\"form-inline\" style=\"margin:10px;\">\n";
	echo "            <div class=\"row\">\n";
	echo "                <div class=\"col-lg-12\">\n";
	echo "<div class=\"form-group\">\n";
	echo "    <label>查詢欄位</label>\n";
	echo "    <select name=\"SEARCH_FIELD\" class=\"browser-default custom-select\">\n";
	foreach ( $array_Search_Field as $key => $value )
	{	echo "<option value=\"$key\">$value</option>" ;	}
	echo "	</select>\n";
	echo "</div>\n";

	echo "<div class=\"form-group\">\n";
	echo "	<label>關鍵字</label>\n";
	echo "	<input type='text' name=\"SEARCH_KEY\" id=\"SEARCH_KEY\" class=\"form-control\">\n";
	echo "</div>\n";
	echo "<button type=\"submit\" class=\"btn btn-default YFont14\">搜尋</button>\n";

	if( sizeof($array_subType) )
	{
		if ( $SEARCH_FIELD == "" AND $SEARCH_KEY == "" )
		{	$tmp_BtnClass = " btn-danger" ;	}
		else
		{	$tmp_BtnClass = " btn-success" ;	}
		echo "<a href='$MAIN_FILE_NAME' class='btn $tmp_BtnClass YFont14'>全部</a> " ;

		foreach ( $array_subType as $key => $value )
		{
			// 分析字串
			$split_subType = explode("||" , $value );
			// 找出查項目的值-SEARCH_FIELD=QA_On&SEARCH_KEY=0
			$split_Para = preg_split("/[=&]+/", $split_subType[1]);
			
			// 設定查詢按鈕顏色
			if ( $SEARCH_FIELD == $split_Para[1] AND $SEARCH_KEY == $split_Para[3] )
			{	$tmp_BtnClass = " btn-danger" ;	}
			else
			{	$tmp_BtnClass = " btn-success" ;	}

			echo "<a href='$MAIN_FILE_NAME?" . $split_subType[1] . "' class='btn $tmp_BtnClass YFont14'>" . $split_subType[0] . "</a> " ;
//					// 分析字串
//					$split_subType = explode("||" , $value );
//					echo "<a href='Store_News.php?" . $split_subType[1] . "' class='btn btn-success'>" . $split_subType[0] . "</a> " ;
		}
	}

//				echo "                </div>\n";
//				echo "            </div>\n";
	echo "</form>\n";

	// 設定每頁筆數
	$row = $PUBLIC_DB_PAGE_NUM ;

	// 設定排序方法
	$tmpSQLOrder = " ORDER BY News_PutTop DESC , News_Mod_DT DESC , id_News DESC" ;
					
	// 是否為多欄位查詢(|),先分析$SEARCH_FIELD是否有
	$arraySEARCH_FIELD = str2array($SEARCH_FIELD , "|") ;
	$arraySEARCH_KEY = str2array($SEARCH_KEY , "|") ;
	if( sizeof($arraySEARCH_FIELD) == sizeof($arraySEARCH_FIELD) AND sizeof($arraySEARCH_FIELD) > 1 )
	{
		unset($tmpSEARCH_SQL) ;
		// 把陣列轉成SQL
		foreach( $arraySEARCH_FIELD as $key => $value)
		{
			if ( is_numeric($SEARCH_KEY[$key]))
			{	$arraySEARCH_SQL[] = $arraySEARCH_FIELD[$key] . " LIKE '%" . (int)$arraySEARCH_KEY[$key] . "%'" ;	}
			else
			{	$arraySEARCH_SQL[] = $arraySEARCH_FIELD[$key] . " LIKE '%" . $arraySEARCH_KEY[$key] . "%'" ;	}
		}
		$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE " . implode( $arraySEARCH_SQL , " AND " ) . "$tmpSQLOrder";
	}
	elseif ( $SEARCH_FIELD AND is_numeric($SEARCH_KEY))
	{	$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $SEARCH_FIELD LIKE '%" . (int)$SEARCH_KEY . "%' $tmpSQLOrder";	}
	elseif ( $SEARCH_FIELD AND $SEARCH_KEY)
	{	$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $SEARCH_FIELD LIKE '%$SEARCH_KEY%' $tmpSQLOrder";	}
	else
	{	$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME $tmpSQLOrder";	}
	//echo "$countSQL<br>" ;

	// 找出總筆數
	$result = mysqli_query($link , $countSQL);  
	//查詢時返回查詢到數據行數：mysqli_num_rows
	$total = mysqli_num_rows($result);
	$totalpage = ceil( $total / $PUBLIC_DB_PAGE_NUM );	// 取得總頁數
	include_once("../includes/database/database_page.php");		// 計算資料庫筆數
	$start = ($page-1) * $row;

	if ( $total )
	{
		echo "<form action=\"\" method=\"post\" name=\"form_list\" id=\"form_list\">\n";
		echo "<input type=\"hidden\" name=\"Funct\" value=\"DELOK\">\n";
		echo "<input type=\"hidden\" name=\"CHECKBOX_TYPE\" value=\"1\">\n";
		echo "\n";

		echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\n";
		echo "<tr>\n";
		echo "    <td align=\"left\">\n";
		echo "    <input type=button name=\"Submit2\" value=\"全部選取\" onclick='chkall(\"form_list\")' class=\"btn btn-default YFont14\">\n";
//			echo "    <input type=\"button\" name=\"Submit2\" value=\"垃圾桶\" onclick=\"return chk_Conf_Checkbox('form_list','GARBAGE_SET')\" class=\"btn btn-default YFont14\">\n";
		echo "    <input type=\"button\" name=\"Submit2\" value=\"" . $array_On[1] ."\" onclick=\"return chk_Conf_Checkbox('form_list','ON')\" class=\"btn btn-default YFont14\">\n";
		echo "    <input type=\"button\" name=\"Submit2\" value=\"" . $array_On[0] ."\" onclick=\"return chk_Conf_Checkbox('form_list','DOWN')\" class=\"btn btn-default YFont14\">\n";
//				echo "    <input type=\"button\" name=\"Submit2\" value=\"刪除\" onclick=\"return chk_Conf_Checkbox('form_list','DELOK')\" class=\"btn btn-default YFont14\">\n";
		echo "    </td>\n";
		echo "</tr>\n";
		echo "</table>\n";

		echo "<table id='Wosmart_list_table' class=\"table table-striped table-bordered table-hover\">\n";
		echo "<thead>\n";
		echo "<tr>\n";
		echo "    <th>#</th>\n";

		echo "    <th>消息標題</th>\n";
		echo "    <th>消息圖片</th>\n";
		echo "    <th>瀏覽次數</th>\n";
		echo "    <th>置頂狀態</th>\n";
		echo "    <th>修改日期</th>\n";

		echo "    <th>狀態</th>\n";
		echo "    <th>修改</th>\n";
		echo "    <th>刪除</th>\n";
		echo "</tr>\n";
		echo "</thead>\n";
		echo "<tbody>\n";
		echo "\n";

		$i = 1 ; 
		$sql = $countSQL . " LIMIT $start , $row";
		//echo "$sql" ;
		
		$query = mysqli_query($link , $sql) ;
		while( $LIST = mysqli_fetch_assoc($query))
		{
			//$arrayNewsStateInfo = wostory_getNews_StateInfo( $LIST ) ;	// 取得目前優惠券狀態
			//print_r($arrayNewsStateInfo);
			echo "<tr>\n";
			echo "    <td><input type=\"checkbox\" name=\"SELECT_ID[]\" value=\"" . $LIST['id_News'] . "\">" . $LIST["id_News"] . "</td>\n";
//				echo "	<td><a href=\"m_News.php?FUNCT=SHOW&ID=" . $LIST['id_News'] . "\">" . $LIST['News_ID'] . "</a> [<a href=\"/Memo.php?Funct=Memo&News_ID=" . $LIST['News_ID'] . "&Time=20171129144200&hash=e26e4bb495fc56d89630b8e5ff8b3c95&yldu=1\" target=\"_blank\">Ｖ</a>]</td>\n";
			echo "    <td>\n";
			echo "    " . $LIST["News_Title"] . "\n";
			echo "    </td>\n";

			if ( $LIST['News_Pict'] )
			{	echo "    <td><img src='../images/News/{$LIST['News_Pict']}' width='100'></td>\n";	}
			else
			{	echo "    <td>沒上傳圖片</td>\n";	}

		
			// 瀏覽次數
			echo "    <td>\n";
			echo "    " . $LIST["News_Count"] . "\n";
			echo "    </td>\n";

			// 置頂狀態
			echo "    <td>\n";
			if( $LIST["News_PutTop"] == 1 )
			echo "    <span style='color:#00f;'>" . $array_News_PutTop[$LIST["News_PutTop"]] . "</span>\n";
			else
			echo "    " . $array_News_PutTop[$LIST["News_PutTop"]] . "\n";

			echo "    </td>\n";

			echo "    <td>" . $LIST["News_Mod_DT"] . "</td>\n";

			// 功能啟用
			echo "    <td><span class=\"" . $array_On_Label[(int)$LIST[$MAIN_DATABASE_NAME . "_On"]] . "\">" . $array_On[(int)$LIST[$MAIN_DATABASE_NAME . "_On"]] . "</span></td>\n";

			echo "    <td>\n";
			// 是否為跳出視窗
			if ( $MAIN_SHOWTYPE == "POP" )
			{	echo "    <input type=\"button\" value=\"修改\" class='btn btn-default' onclick=\"openWin('$MAIN_FILE_NAME?Funct=MOD&SHOWTYPE=$MAIN_SHOWTYPE&ID=" . $LIST["id_News"]. "');\" /></td>\n" ;	}
			else
			{	echo "    <a href=\"$MAIN_FILE_NAME?Funct=MOD&ID=" . $LIST["id_News"] . "\" class=\"btn btn-default\">修改</a>\n" ;	}
			echo "    </td>\n" ;

			echo "    <td>\n" ;
			// 是否為跳出視窗
			if ( $MAIN_DELCHECK OR 1 )
			{	echo "    <a href=\"$MAIN_FILE_NAME?Funct=DELOK&ID=" . $LIST["id_News"] . "\" class=\"btn btn-default\" onclick=\"return isok(this,'是否要刪除資料')\">刪除</a>\n" ;	}
			elseif ( $MAIN_SHOWTYPE == "POP" )
			{	echo "    <input type=\"button\" value=\"刪除\" class='btn btn-default' onclick=\"openWin('$MAIN_FILE_NAME?Funct=DEL&SHOWTYPE=$MAIN_SHOWTYPE&ID=" . $LIST["id_News"] . "');\" />\n" ;	}
			else
			{	echo "    <a href=\"$MAIN_FILE_NAME?Funct=DEL&ID=" . $LIST["id_News"] . "\" class=\"btn btn-default\">刪除</a>\n" ;	}
			echo "    </td>\n" ;
			echo "</tr>\n" ;
			$i++;
		}
		echo "</tbody>\n" ;
		echo "</table>\n" ;
		echo "</form>\n";
		if( $total )
		{
			include_once("../includes/database/database_page_item.php");
			include_once("../includes/database/database_page_button.php");
		}
	}
	else
	{
		echo "<p class='yldu_font18 text-center'>沒有找到相關資料</p>" ;
	}
}

echo "  </div>\n";
echo "  </div>\n";
echo "  <div>\n";
echo "\n";
echo "<div class=\"row\">\n";
echo "	<div class=\"col-lg-12\">\n";
echo "	\n";
echo "	</div>\n";
echo "</div>\n";
echo "\n";
echo "<div class=\"row\">\n";
echo "	<div class=\"col-lg-12\">\n";
echo "	</div>\n";
echo "</div>\n";
echo "\n";
echo "<div class=\"row\"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->\n";
echo "</div>\n";
echo "<!-- /.row -->\n";
echo "<div class=\"row\"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->\n";
echo "</div>\n";
echo "<!-- /.row -->\n";
echo "<div class=\"row\"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->\n";
echo "</div>\n";
echo "<!-- /.row -->\n";
echo "\n";

// 回上一頁
if( $MAIN_FILE_NAME != "index.php" )
{
	showBackListButton() ;	// 秀出上一頁和回列表按鈕
}
echo "</div>\n" ;

include_once("admin_footer.php") ;
?>

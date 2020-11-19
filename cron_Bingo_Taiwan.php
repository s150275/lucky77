<?php
/*
★ 程式開始 , ★ 建立資料庫連線 
*/

//$data .= "hello " . date("Y-m-d H:i:s") . "\r\n"; //要寫入txt的資料 
////#註解: \r\n 可用來換行
//$dir="/home/shopingm/public_html/casino/";  //設定文件路徑
////$dir="./";  //設定文件路徑
//$filename = $dir.'test.txt'; //設定路徑加上要輸出的名稱 (此處以 test.txt 為例)
//if(@$fp = fopen($filename, 'a+'))
//{
////寫入資料
//fwrite($fp, $data);
//fclose($fp);
// 
//}
//
//file_put_contents($dir."test1.txt", date("Y-m-d H:i:s") . "\r\n", FILE_APPEND);  

// http://linebot.wolong.bixone.com/cron_Bot_ChatInfo.php

// ############ ########## ########## ############
// ## 設定基本變數				##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "每天排程-Bingo獎號-台灣彩卷" ;	// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "./" ;			// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;				// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Bingo" ;			// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "cron_Bingo_Taiwan.php" ;	// 設定本程式的檔名
$MAIN_CHECK_FIELD       = "id_OrderInfo" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;				// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_PROGRAM_TYPE	= "A1" ;				// 設定此網頁是否為管理模式-0:不管制,A:一般管制(1111),P:程式權限管制(根據System_LevelP的設定),程式模式(0:一般模式,1:管理模式...)
$MAIN_NOW_TIME          = date("Y-m-d H:i:s") ;		// 取得現在的時間
$MAIN_NOW_DATE          = date("Y-m-d") ;		// 取得現在的日期

$tmpShowMsg = 1 ;		// 是否要在網頁秀出除錯資料(1:秀出,0:不秀)
//if ( $tmpShowMsg ){echo "<p class='ylduShowMsg'>$tmp_Database_Funct<p>";print_r($LIST_return);}	// 秀出除錯訊息 ██████████
//if ( $tmpShowMsg ){echo "<p class='ylduShowMsg'>$tmp_Database_Funct<p>";}	// 秀出除錯訊息 ██████████
//if ( $tmpShowMsg ){echo "<span>$tmp_Database_Funct</span>";}	// 秀出除錯訊息 ██████████
$tmp_Add_Database = "1" ;		// 1:加入資料庫,0:不加入資料庫

$BasePath = dirname(dirname(__FILE__)) ;
$NowPath = dirname(__FILE__) ;
if ( $tmpShowMsg or 1 ) {	"完整路徑 : " . $NowPath . "<br>";	}	// 秀出除錯訊息 ██████████

// ############ ########## ########## ############
// ## 載入模組					##
// ############ ########## ########## ############
include( $NowPath . "/includes/conn.php") ;
include( $NowPath . "/includes/func.php") ;
include( $NowPath . "/Project/WinHappy/func_WinHappy.php") ;
include( $NowPath . "/Project/GodNine/func_GodNine.php");

//$array['NowPath'] = dirname( __FILE__ ) ;
//echo "完整路徑 : " . $NowPath . "<br>";
//$array['LastPath'] = dirname(dirname( __FILE__ )) ;
////echo "上層路徑 : " . $array['LastPath'] . "<br>";
//$array['NowDir'] = str_replace ( $array['LastPath'] . "/" , "" , $array['NowPath']);
//print_r($array);
//echo "1111" ;

// 測試訊息用
//$LIST_OrderInfo_Reward_Day['OrderInfo_ID'] = "Order123456" ;
//$tmp_Recommend_Reward_Point = "100" ;
//$value = "100001" ;
//$Store_Name = "測試1" ;
//
//// 送給line的資料
//$arrayFormatText[] = array(
//	"type" => "text",
//	"text" => "非常感謝您本次於 $Store_Name 線上消費\n\n".
//		"訂單號碼 : " . $LIST_OrderInfo_Reward_Day['OrderInfo_ID'] . "\n\n".
//		"獲得點數 : " . $tmp_Recommend_Reward_Point . "點\n\n".
//		date("Y-m-d H:i:s") . "\n\n".
//
//		"為提昇本公司之服務品質及售後服務滿意度，請您撥空填寫以下連結之滿意度調查表。\n\n".
//		"http://w" . $value . "." . $Conn_Base_URL ."/link/question/" . $LIST_OrderInfo_Reward_Day['OrderInfo_ID'] . "/2.html\n\n".
//		"有您的建議，我們會盡力改善並不斷的改進。謝謝您\n\n"
//);
////echo "<p>推播內容</p>" ;
//print_r($arrayFormatText);
//
//// 設定訂購者LineID
//$arrayLineId[] = "U88d84d7cf2d4a3a37da63dea2e59fde8" ;
//$arrayLineId[] = "U4f3aa4385b23a9cf38595812c30e39a4" ;	// ruby
//// 暫時關閉
//sentOneLineMsg( $arrayFormatText , $arrayLineId );
//exit;

$PUBLIC_DB_PAGE_NUM		= "10" ;			// 每頁秀出的筆數
$PUBLIC_DB_SPLIT_CHAR	= "\|\|" ;			// 設定"分頁"時欄位之間的分隔符號，怕以後會有衝
date_default_timezone_set('Asia/Taipei');//指定主機時區

$MAIN_NOW_DATE = date("Y-m-d");
$MAIN_NOW_TIME = date("Y-m-d H:i:s");

// ############ ########## ########## ############
// ## 程式開始									##
// ############ ########## ########## ############
// 是否由cron來執行 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//if($argv[1]=="wosmarty" && $argv[2]=="8c4e5026521414162f474c7d92097579da36" && $argv[3]=="go")

// 是否可以抓取資料,小時>=7
$tmpSplitDate = getSplitDate( date("Y-m-d H:i:s") , "A") ;			// 全部分析
if( $tmpSplitDate[3] < 7 )
{	exit;	}

// 是否已有抓到上一期獎號
$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
echo "<p></p>" ;print_r($array_BingoPeriod);echo "<br>" ;

$array_NewBingo_Info = func_DatabaseGet( "Bingo" , "*" , array("Bingo_Period"=>$array_BingoPeriod['LastBingo']) ) ;		// 取得資料庫資料
if( $array_NewBingo_Info['id_Bingo'] )
{
	$array_Calculate_Multiple = GodNine_sumCalculate_Multiple( $array_NewBingo_Info['Bingo_Draw_Order_Num'] ) ;		// 計算財神九仔生計算值和倍數值
	echo "計算財神九仔生計算值和倍數值<br><p>{$array_NewBingo_Info['Bingo_Draw_Order_Num']}</p>" ;print_r($array_Calculate_Multiple);echo "<br>" ;
	
	//echo "<p></p>" ;print_r($array_NewBingo_Info);echo "<br>" ;
	//exit;
}

// 建立本期的莊家,如果沒有人排莊-不用建立

include( $NowPath . "/simple_html_dom.php") ;

if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
{	echo "<p>依號碼大小</p>" ;	}

$html = file_get_html('http://www.taiwanlottery.com.tw/lotto/BINGOBINGO/drawing.aspx');
//$html = file_get_html('http://www.google.com/');

foreach($html->find('table.tableFull') as $e)

$tmp_Index = 0;
// 單數獎號
foreach($e->find('td.tdA_4') as $t)
{
	// 取得相關資料
	$tmp_Val = $t->innertext ;
	if( $tmp_Val )
	{
		// 找出期號資料
		if( strlen($tmp_Val) == 9 )
		{
			// 設定期號資料
			$tmp_Bingo_Period = $tmp_Val ;
			//echo "找出期號資料 : $tmp_Val<br>" ;
			if( $array_Bingo_Size )
			{	$tmp_Index++ ;	}
			$array_Bingo_Size[$tmp_Bingo_Period][] = $tmp_Val ;
		}
		else// 設定其它資料
		{	$array_Bingo_Size[$tmp_Bingo_Period][] = $tmp_Val ;	}
		//echo "$tmp_Index - " . strlen($tmp_Val) . " - " . $t->innertext . '<br>';
	}
}

// 雙數獎號
foreach($e->find('td.tdA_3') as $t)
{
	$tmp_Val = $t->innertext ;
	//echo $tmp_Val ;
	if( $tmp_Val )
	{
		if( strlen($tmp_Val) == 9 )
		{
			// 設定期號資料
			$tmp_Bingo_Period = $tmp_Val ;
			if( $array_Bingo_Size )
			{	$tmp_Index++ ;	}
			$array_Bingo_Size[$tmp_Bingo_Period][] = $tmp_Val ;
		}
		else
		{	$array_Bingo_Size[$tmp_Bingo_Period][] = $tmp_Val ;	}
		//echo "$tmp_Index - " . strlen($tmp_Val) . " - " . $t->innertext . '<br>';
	}
}
ksort($array_Bingo_Size);

//echo "<p>依號碼大小排序</p>" ;print_r($array_Bingo_Size);echo "<br>" ;


$nodes = $html->find("input[type=hidden]");

foreach ($nodes as $node)
{
	$val = $node->value;
	$name = $node->name;
	$array_Input[$name] = $val ;
	//echo $name . " => " . $val . "<br />";
}

//echo "<p></p>" ;print_r($array_Input);echo "<br>" ;	

$Year = date("Y") ;
$Monet = date("m") ;

$DropDownList1 = "$Year/" . (int)$Monet ;

$data['__EVENTTARGET'] = "" ;
$data['__EVENTARGUMENT'] = "DropDownList2" ;
$data['__LASTFOCUS'] = "" ;
$data['__VIEWSTATE'] = $array_Input['__VIEWSTATE'] ;

$data['__VIEWSTATEGENERATOR'] = $array_Input['__VIEWSTATEGENERATOR'] ;
$data['__EVENTVALIDATION'] = $array_Input['__EVENTVALIDATION'] ;

$data['DropDownList1'] = $DropDownList1 ;
//$data['DropDownList1'] = "2020/4" ;
$data['DropDownList2'] = "1" ;

//echo "<p></p>" ;print_r($data);echo "<br>" ;

//POST 的資料
$data_url = http_build_query($data);
$data_len = strlen ($data_url);
$request = array(
    'http' => array (
	    'method' => 'POST',
		'content' => $data_url,
		'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . $data_len . "\r\n"
    )
);

$context = stream_context_create($request);
$html = file_get_html('https://www.taiwanlottery.com.tw/Lotto/BINGOBINGO/drawing.aspx', false, $context);
//echo $html ;

if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
{	echo "<p>依開出順序排序</p>" ;	}

//unset($array_Bingo_Size);
unset($e);

foreach($html->find('table.tableFull') as $e)

$tmp_Index = 0;
foreach($e->find('td.tdA_4') as $t)
{
	$tmp_Val = $t->innertext ;
	//echo $tmp_Val ;
	if( $tmp_Val )
	{
		if( strlen($tmp_Val) == 9 )
		{
			// 設定期號資料
			$tmp_Bingo_Period = $tmp_Val ;
			if( $array_Bingo_Sort )
			{	$tmp_Index++ ;	}
			$array_Bingo_Sort[$tmp_Bingo_Period][] = $tmp_Val ;
		}
		else
		{	$array_Bingo_Sort[$tmp_Bingo_Period][] = $tmp_Val ;	}
		//echo "$tmp_Index - " . strlen($tmp_Val) . " - " . $t->innertext . '<br>';
	}
}
//echo "<p></p>" ;print_r($array_Bingo_Sort);echo "<br>" ;
//echo $t->innertext . '<br>';


foreach($e->find('td.tdA_3') as $t)
{
	$tmp_Val = $t->innertext ;
	//echo $tmp_Val ;
	if( $tmp_Val )
	{
		if( strlen($tmp_Val) == 9 )
		{
			// 設定期號資料
			$tmp_Bingo_Period = $tmp_Val ;
			if( $array_Bingo_Sort )
			{	$tmp_Index++ ;	}
			$array_Bingo_Sort[$tmp_Bingo_Period][] = $tmp_Val ;
		}
		else
		{	$array_Bingo_Sort[$tmp_Bingo_Period][] = $tmp_Val ;	}
		//echo "$tmp_Index - " . strlen($tmp_Val) . " - " . $t->innertext . '<br>';
	}
}
// 按照鍵名進行降序排序
ksort($array_Bingo_Sort);
//krsort($array_Bingo_Sort);

// 找出資料庫最新一期資料
$tmpSQL = "SELECT * FROM Bingo ORDER BY Bingo_Period DESC" ;
$array_Last_Bingo_Info = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料

// 把開獎資料加到資料庫中
foreach( $array_Bingo_Sort as $key => $value )
{
/*
$array_Bingo_Sort陣列欄位
[0] => 期號
[1] => 開獎號碼
[2] => 超級獎號
[3] => 一般大小
[4] => 猜單雙
[5] => 開獎順序號碼
*/
	
	$array_Bingo_Info = func_DatabaseGet( "Bingo" , "*" , array("Bingo_Period"=>$value[0]) ) ;		// 取得資料庫資料
	
	// 是否大於資料庫最新一期
	if( $array_Last_Bingo_Info['Bingo_Period'] >= $value[0] && ($array_Bingo_Info['Bingo_Num']!=""))
	{
		if ( $tmpShowMsg AND 0 )	// 秀出除錯訊息 ██████████
		{	echo "已有Bingo期號<br>" ;	}
		continue;
	}

	// 是否已有此期數
	if( $array_Bingo_Info['Bingo_Period'] == "" )
	{// 沒有資料則加入資料

		$tmp_BingoDate = WinHappy_subPeriod2Date($value[0]) ;		// Bingo期號轉時間

		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "Key : $key , Bingo期號 : {$value[0]} 開獎時間 : $tmp_BingoDate , " . mb_substr( $tmp_BingoDate , 11 , 5 , "utf-8") . "<br>" ;	}

		$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
		$arrayField['Bingo_Period'] = $array_Bingo_Sort[$key][0] ;				// 期數

		echo "開獎號碼 : {$array_Bingo_Size[$key][1]}<br>" ;
		$array_Bingo_Num = str2array( $array_Bingo_Size[$key][1] , " ");
		// 清除空值
		$array_Bingo_Num = array_filter($array_Bingo_Num);
		echo "<p>開獎號碼陣列</p>" ;print_r($array_Bingo_Num);echo "<br>" ;
		$arrayField['Bingo_Num'] = array2str( $array_Bingo_Num , "," ) ;					// 開獎號碼

		echo "開獎順序號碼 : {$value[1]}<br>" ;
		$array_Bingo_Draw_Order_Num = str2array( $value[1] , " ");
		// 清除空值
		$array_Bingo_Draw_Order_Num = array_filter($array_Bingo_Draw_Order_Num);
		echo "<p>開獎順序號碼陣列</p>" ;print_r($array_Bingo_Draw_Order_Num);echo "<br>" ;
		$arrayField['Bingo_Draw_Order_Num'] = array2str( $array_Bingo_Draw_Order_Num , "," ) ;						// 開獎順序號碼

		$arrayField['Bingo_DrawDate'] = mb_substr( $tmp_BingoDate , 0 , 10 , "utf-8");			// 開獎時間
		$arrayField['Bingo_DrawDT'] = mb_substr( $tmp_BingoDate , 11 , 5 , "utf-8");			// 開獎時間
		$arrayField['Bingo_Super_Num'] = $array_Bingo_Sort[$key][2] ;				// 超級獎號
		//$arrayField['Bingo_Super_Same'] = $array_Bingo_Sort['DrawContinuously'] ;	// 連莊球數
		
		$array_Calculate_Multiple = GodNine_sumCalculate_Multiple( $arrayField['Bingo_Draw_Order_Num'] ) ;		// 計算財神九仔生計算值和倍數值
		
		// 計算-財神九仔生計算值-兩個位數相加
		$arrayField['Bingo_Godnine_Calculate'] = $array_Calculate_Multiple['Calculate'] ;
		// 計算-財神九仔生倍數值 0(1倍) ,  1-7(1倍) , 8-9(2倍) , 對子(3倍)
		$arrayField['Bingo_Godnine_Multiple'] = $array_Calculate_Multiple['Multiple'] ;
		
//		// 內定為1
//		$tmp_Bingo_Size_Same = 1 ;
//		$array_Split = str2array($array_Last_Bingo_Info['Bingo_Size_Same'] , ",");
//		if( $array_Split[0] != "－" )
//		{
//			// 是否為相同值 // 相同 值+1
//			if( $array_Split[0] == $array_Bingo_Sort['Period'] )
//			{	$tmp_Bingo_Size_Same = $array_Split[1] + 1 ;	}
//		}
//		$arrayField['Bingo_Size_Same'] = $array_Bingo_Sort['DrawBigSmall'] . ",$tmp_Bingo_Size_Same" ;		// 一般大小連莊次數(大,1)

//		// 內定為1
//		$tmp_Bingo_Super_BS_Same_Num = 1 ;
//		$tmp_Bingo_Super_SD_Same_Num = 1 ;
//
//		// 分析超級獎號 - 大小
//		if( $arrayField['Bingo_Super_Num'] <= 40 )
//		{	$tmp_Bingo_Super_BS_Same_Value = "小" ;	}
//		else
//		{	$tmp_Bingo_Super_BS_Same_Value = "大" ;	}
//
//		// 分析超級獎號 - 單雙
//		if( $arrayField['Bingo_Super_Num'] % 2 )
//		{	$tmp_Bingo_Super_SD_Same_Value = "單" ;	}
//		else
//		{	$tmp_Bingo_Super_SD_Same_Value = "雙" ;	}
//
//		// 有本期超級獎號
//		if( $arrayField['Bingo_Super_Num'] )
//		{
//			// 分析 超級大小連莊次數
//			if( $array_Last_Bingo_Info['Bingo_Super_BS_Same'] )
//			{
//				unset($array_Split);
//				$array_Split = str2array($array_Last_Bingo_Info['Bingo_Super_BS_Same'] , ",");
//				echo "$array_Split[0] == $tmp_Bingo_Super_BS_Same_Value " ;
//				if( $array_Split[0] == $tmp_Bingo_Super_BS_Same_Value )
//				{	$tmp_Bingo_Super_BS_Same_Num = $array_Split[1] + 1 ;echo "超級大小相同 - $tmp_Bingo_Super_BS_Same_Num<br>" ;	}
//				else
//				{	echo "超級大小不 - $tmp_Bingo_Super_BS_Same_Num<br>" ;	}
//			}
//			
//			// 分析 超級單雙連莊次數
//			if( $array_Last_Bingo_Info['Bingo_Super_SD_Same'] )
//			{
//				unset($array_Split);
//				$array_Split = str2array($array_Last_Bingo_Info['Bingo_Super_SD_Same'] , ",");
//				echo "$array_Split[0] == $tmp_Bingo_Super_SD_Same_Value ";
//				if( $array_Split[0] == $tmp_Bingo_Super_SD_Same_Value )
//				{	$tmp_Bingo_Super_SD_Same_Num = $array_Split[1] + 1 ;echo " 超級單雙相同 - $tmp_Bingo_Super_SD_Same_Num<br>" ;	}
//				else
//				{	echo " 超級單雙不同 - $tmp_Bingo_Super_SD_Same_Num<br>" ;		}
//			}
//		}
//		$arrayField['Bingo_Super_BS_Same'] = $tmp_Bingo_Super_BS_Same_Value . ",$tmp_Bingo_Super_BS_Same_Num" ;			// 超級大小連莊次數(小,2)
//		$arrayField['Bingo_Super_SD_Same'] = $tmp_Bingo_Super_SD_Same_Value . ",$tmp_Bingo_Super_SD_Same_Num" ;		// 超級單雙連莊次數(單,1)

		$arrayField['Bingo_Add_DT'] = date("Y-m-d H:i:s") ;
		//echo "<p>第 $i 筆 </p>" ;print_r($arrayField);echo "<br>" ;
		$Bol = func_DatabaseBase( "Bingo" , "ADD" , $arrayField , "" ) ;						// 資料庫處理

		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "<p>寫入資料庫</p>" ;print_r($arrayField);echo "<br>" ;	}
	}
	else if( $array_Bingo_Info['Bingo_Draw_Order_Num'] == "" )
	{// 沒有開獎順序號碼則修改資料
	}
	else if( !$array_Bingo_Info['Bingo_Num'])
	{// 沒有開獎號碼則修改資料
		
		$arrayField = [];
		
		echo "開獎期號:".$value[0]." 開獎號碼 : {$array_Bingo_Size[$key][1]}<br>" ;
		$array_Bingo_Num = str2array( $array_Bingo_Size[$key][1] , " ");
		
		$array_Bingo_Num = array_filter($array_Bingo_Num);
		echo "<p>開獎號碼陣列</p>" ;print_r($array_Bingo_Num);echo "<br>" ;
		$arrayField['Bingo_Num'] = array2str( $array_Bingo_Num , "," ) ;					// 開獎號碼
		
		$Bol = func_DatabaseBase( "Bingo" , "MOD" , $arrayField , " Bingo_Period = '{$value[0]}'" ) ;
		
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "<p>寫入資料庫</p>" ;print_r($arrayField);echo "<br>" ;	}
		
	}
}
//echo "<p></p>" ;print_r($array_Bingo_Size);echo "<br>" ;

GodNine_BingoDraw() ;		// 賓果開獎

// 是否由cron來執行  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

?>

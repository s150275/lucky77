<?php
session_start();
//echo session_id() ."<br>";

/*
############
# 獨立方案 #
############
*/

$tmpConnModel = 1 ;	// 資料庫模式 - 1 : 正式模式 , 0 : 測試模式
$Conn_NoWriteLogFieldInfo = 0 ;	// 是否要寫入管理者LOG - 1 : 不寫入管理者LOG , 0 : 寫入管理者LOG

// 找出上層目錄
$array_Upper_Path = explode( "/" , dirname(dirname( __FILE__ )) ) ;
//echo "<p></p>" ;print_r($array_Upper_Path);echo "<br>" ;
$tmp_Upper_Path = $array_Upper_Path[sizeof($array_Upper_Path)-1];
//echo $tmp_Upper_Path . "<br>" ;

// 關閉錯誤輸出
//ini_set('display_errors','off');

if ( $tmp_Upper_Path == "public_html" OR $tmpConnModel )
{
	// 店家基本資訊
	$Conn_Website_Name = "財神九仔生" ;	// 網站名稱

	// 資料庫設定
	$host		= "localhost";	// 連線主機
	$database	= "lucky77" ;		// 資料庫名稱
	$user		= "lucky77";		// 資料庫帳號
	$password	= "lucky77-77lk-1117";	// 資料庫密碼
	
	$link = mysqli_connect($host, $user, $password , $database) or die("Unable to connect to MySQL");  
	mysqli_set_charset($link,'utf8mb4');
}
else
{
	// 店家基本資訊
	$Conn_Website_Name = "財神九仔生-測試" ;	// 網站名稱

	// 資料庫設定
	$host		= "localhost";	// 連線主機

	// 測試2
    $database	= "lucky77" ;		// 資料庫名稱
    $user		= "lucky77";		// 資料庫帳號
    $password	= "lucky77-77lk-1117";	// 資料庫密碼

	$link = mysqli_connect($host, $user, $password , $database) or die("Unable to connect to MySQL");  
	mysqli_set_charset($link,'utf8mb4');

}

$PUBLIC_DB_PAGE_NUM		= "10" ;			// 每頁秀出的筆數
$PUBLIC_DB_SPLIT_CHAR	= "\|\|" ;			// 設定"分頁"時欄位之間的分隔符號，怕以後會有衝
date_default_timezone_set('Asia/Taipei');//指定主機時區

?>
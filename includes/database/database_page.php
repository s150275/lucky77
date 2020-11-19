<?php
// ############ ########## ########## ############
// ## 計算資料庫筆數								##
// ############ ########## ########## ############
// 使用方法
// include_once("../../php/database_page.php");		// 計算資料庫筆數

// 判斷頁數資料
if( $page < 1 )	// 輸入的頁數是否小於0
{	$page = 1 ;	}
else if ( $page > $totalpage )	// 輸入的頁數是否大於總頁數
{	$page = $totalpage ;	}
else	// 正確範圍
{	$page = $page ;	}

// 求出SQL開始筆數(由0開始)
$start = ( $page - 1 ) * $PUBLIC_DB_PAGE_NUM;

// 判斷是否還有上一頁
if ( $page != 1 )
{
	$next_page = $page - 1 ;
	$next_page_disable = "" ;
}
else
{	
	$next_page = "" ;
	$next_page_disable = "disable" ;
}

// 判斷是否還有下一頁
if ( $page != $totalpage)
{
	$prev_page = $page + 1 ;
	$prev_page_disable = "" ;
}
else
{
	$prev_page = "" ;
	$prev_page_disable = "disable" ;
}
?>
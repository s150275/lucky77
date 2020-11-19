<?php
// ############ ########## ########## ############
// ## 秀出資料庫頁數資訊							##
// ############ ########## ########## ############
// 使用方法
// include_once("file://///192.168.100.102/www/php/database_page_item.php");		// 秀出資料庫頁數資訊
if ( $totalpage )
{
?>
<p>目前第<span id='ThisNowPage'><?php echo $page ?></span>頁，共<?php echo $totalpage ?>頁，全部<?php echo $total?>筆</p>
<?php
}
?>
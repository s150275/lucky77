<?php
// ############ ########## ########## ############
// ## 秀出資料庫頁數按鈕							##
// ############ ########## ########## ############
// 使用方法
// include_once("../../php/database_page_button.php");		// 秀出資料庫頁數按鈕

// $tmp_PageBTN_Para = "&Para=value" ;	// 上下頁後面要加的參數

if ( $SEARCH_FIELD )
{	$tmpSearch = "&SEARCH_FIELD=" . $SEARCH_FIELD . "&SEARCH_KEY=" . $SEARCH_KEY ;	}

if( $SEARCH_Start_Date AND $SEARCH_End_Date )
{	$tmpSearch .= "&SEARCH_Start_Date=" . $SEARCH_Start_Date . "&SEARCH_End_Date=" . $SEARCH_End_Date ;	}

if ( $totalpage )
{
	// 是否為第一頁
	if ( $page == 1 )
	//{	echo "<a href='$MAIN_FILE_NAME?page=1$tmpSearch$tmp_PageBTN_Para' class='btn btn-default btn-sm $next_page_disable Wosmart_Cray_Button' disabled>首頁</a>" ;	}
	{	echo "<a href='javascript:;' class='btn btn-default btn-sm $next_page_disable Wosmart_Cray_Button disabled' role=\"button\" disabled style='background-color:#aaa!important;'>首頁</a>" ;	}
	else
	{	echo "<a href='$MAIN_FILE_NAME?page=1$tmpSearch$tmp_PageBTN_Para' class='btn btn-default btn-sm $next_page_disable Wosmart_Cray_Button'>首頁</a>" ;	}
	
	// 是否要秀出上一頁按鈕
	if ( $page == 1 )
	//if ( $next_page )
	//{	echo "<a href='$MAIN_FILE_NAME?page=$next_page$tmpSearch$tmp_PageBTN_Para' class='btn btn-default btn-sm Wosmart_Cray_Button' disabled>上頁</a>" ;	}
	{	echo "<a href='javascript:;' class='btn btn-default btn-sm Wosmart_Cray_Button disabled' role=\"button\" disabled style='background-color:#aaa!important;'>上頁</a>" ;	}
	else
	{	echo "<a href='$MAIN_FILE_NAME?page=$next_page$tmpSearch$tmp_PageBTN_Para' class='btn btn-default btn-sm Wosmart_Cray_Button'>上頁</a>" ;	}
	?>
	<select name="" class='btn btn-default' onchange="window.location=('<?php echo $MAIN_FILE_NAME?>?page=' + this.options[this.selectedIndex].value) + '<?php echo $tmpSearch.$tmp_PageBTN_Para;?>'">
	<?php
	for( $i = 1 ; $i <= $totalpage ; $i++)
	{
		if ( $i == $page )
		{	echo "<option value='$i' selected>$i</option>\n" ;	}
		else
		{	echo "<option value='$i'>$i</option>\n" ;	}
	}
	?>
	</select>
	<?php
	// 是否要秀出下一頁按鈕
	if ( $page == $totalpage )
	//if ( $prev_page )
	//{	echo "<a href='$MAIN_FILE_NAME?page=$prev_page$tmpSearch$tmp_PageBTN_Para' class='btn btn-default btn-sm Wosmart_Cray_Button' disabled>下頁</a>" ;	}
	{	echo "<a href='javascript:;' class='btn btn-default btn-sm Wosmart_Cray_Button disabled' role=\"button\" disabled style='background-color:#aaa!important;'>下頁</a>" ;	}
	else
	{	echo "<a href='$MAIN_FILE_NAME?page=$prev_page$tmpSearch$tmp_PageBTN_Para' class='btn btn-default btn-sm Wosmart_Cray_Button'>下頁</a>" ;	}
	
	// 是否為第最後頁
	if ( $page == $totalpage )
	//{	echo "<a href='$MAIN_FILE_NAME?page=$totalpage$tmpSearch$tmp_PageBTN_Para' class='btn btn-default btn-sm $next_page_disable Wosmart_Cray_Button' disabled>末頁</a>" ;	}
	{	echo "<a href='javascript:;' class='btn btn-default btn-sm $next_page_disable Wosmart_Cray_Button disabled' role=\"button\" disabled style='background-color:#aaa!important;'>末頁</a>" ;	}
	else
	{	echo "<a href='$MAIN_FILE_NAME?page=$totalpage$tmpSearch$tmp_PageBTN_Para' class='btn btn-default btn-sm $next_page_disable Wosmart_Cray_Button'>末頁</a>" ;	}
}
?>
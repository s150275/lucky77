<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "前台最新消息" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "News" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "News.php" ;			// 設定本程式的檔名
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

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;			// 動作代理人(會員)的ID
$ARRAY_POST_GET_PARA[] = "AID||*" ;			// 目前操作代理人的ID
$ARRAY_POST_GET_PARA[] = "PID||*" ;			// 目前操作代理人的父ID
$ARRAY_POST_GET_PARA[] = "MID||*" ;			// 目前操作會員的ID

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
//unset($_SESSION['Member_ID']);
//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面

// 消息狀態 0||下架||1||上架:
$array_News_On[0] = "下架" ;
$array_News_On[1] = "上架" ;

//$tmp_Login_Name = WinHappy_getLoginName( $sub_Login_Name ) ;		// 取得登入帳號的名字

// 載入首頁
include($MAIN_BASE_ADDRESS . "agent/header.php") ;        // 載入首頁
// 是否為管理代理人
if( empty( WinHappy_IsAdminAgent() ))		// 是否為管理代理人
{	alertgo("只有管理員可以處理","index.php");exit;	}

/*
header.php已處理參數

$array_Agent_Info		登入代理人資料
$array_NowAgent_Info	目前操作代理人資料
$array_NowMember_Info	目前操作會員資料

$_SESSION['AID']		目前操作代理人ID
$_SESSION['AAgent_ID']	目前操作代理人Agent_ID
$_SESSION['MID']		目前操作會員ID

*/

// 秀出form資料
function showForm( $LIST , $subFUNCT )
{
	global $MAIN_FILE_NAME ;
	global $MAIN_BASE_ADDRESS ;
	
	if( $subFUNCT == "ADDOK" )
	{	$tmp_FunctType = "新增" ;	}
	else if( $subFUNCT == "MODOK" )
	{	$tmp_FunctType = "修改" ;	}
	
	
	echo "<input type='hidden' name='Funct' value='$subFUNCT'>\n" ;
	echo "<input type='hidden' name='ID' value='{$LIST['id_News']}'>\n" ;
	echo "	<tr>\n";
	echo "		<td colspan=2 style=\"padding-left:10px\">\n";
	echo "			<table width=\"99%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list\">\n";
	echo "				<tr>\n";
	echo "					<td width=10% align=\"center\"><b>消息標題</b></td>\n";
	echo "					<td width=90% align=\"left\"><input type='text' name='News_Title' value='{$LIST['News_Title']}' style='width:100%;'></td>\n";
	echo "				</tr>\n";
	echo "				<tr>\n";
	echo "					<td width=10% align=\"center\"><b>消息狀態</b></td>\n";
	echo "					<td width=90% align=\"left\"><input type='radio' name='News_On' value='1' " . checksCheckBox($LIST['News_On'] , 1) . ">上架 <input type='radio' name='News_On' value='0' " . checksCheckBox($LIST['News_On'] , 0) . ">下架</td>\n";
	echo "				</tr>\n";
	echo "				<tr>\n";
	echo "					<td align=\"center\" colspan=2><a class='BTN-SaveData' data-type='$tmp_FunctType'><img  src=\"images/enter_save.jpg\"></a></td>\n";
	echo "				</tr>\n";

	echo "			</table>\n";
	echo "		</td>\n";
	echo "	</tr>\n";
}

//~@_@~// START 列表資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
echo "	<tr>\n";
echo "		<td height=\"55\" colspan=\"2\">\n";
echo "			<table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "					<td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 前台最新消息 </td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"14\" colspan=\"2\" align=\"left\" background=\"./img/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td height=\"25\" align=\"left\" colspan=2>\n";
echo "			<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=left>\n";
echo "				<tr>\n";
echo "					<td height=\"25\" align=\"left\" width=\"120\">\n";
echo "						<a href=\"News.php?Funct=ADD\"><img border=\"0\" src=\"images/add_icon.gif\" align=\"absmiddle\" style=\"padding-right:5px\">新增最新消息</a>\n";
echo "					</td>\n";
echo "					<td width=\"10%\" align=\"right\">關鍵字元：</td>\n";
echo "					<td width=\"15%\" align=\"center\"><input type=\"text\" name=\"keyword\" size=\"16\"\n";
echo "														  value=\"\"></td>\n";
echo "					<td width=\"90\" align=\"left\">&nbsp;</td>\n";
echo "					<td width=\"55%\" align=\"left\"><input type=\"image\" src=\"images/search_button.jpg\"/></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";

if( $Funct == "SHOW" )
{
}
else if( $Funct == "ADD" )
{
	$LIST = array();
	$LIST['News_On'] = 1 ;
	showForm( $LIST , "ADDOK" );
}
else if( $Funct == "MOD" )
{
	$modSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $MAIN_CHECK_FIELD = '$ID'" ;
	//echo "$modSQL<br>" ;
	$QUERY_Mod = mysqli_query($link , $modSQL) ;
	
	// 有資料時執行
	if ( mysqli_num_rows($QUERY_Mod) )
	{	$LIST = mysqli_fetch_assoc($QUERY_Mod) ;	}
	showForm( $LIST , "MODOK" );
}
else if( $Funct == "DEL" )
{
	$modSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $MAIN_CHECK_FIELD = '$ID'" ;
	//echo "$SQL_Member<br>" ;
	$QUERY_Mod = mysqli_query($link , $modSQL) ;
	
	// 有資料時執行
	if ( mysqli_num_rows($QUERY_Mod) )
	{	$LIST = mysqli_fetch_assoc($QUERY_Mod) ;	}
	showForm( $LIST , "DELOK" );
}
else
{
	echo "	<tr>\n";
	echo "		<td colspan=2 style=\"padding-left:10px\">\n";
	echo "			<table width=\"99%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list\">\n";
	echo "				<tr class=\"table_header\">\n";
	echo "					<td width=20% height=\"20\" align=\"center\"><b>新增日期</b></td>\n";
	echo "					<td width=60% height=\"20\" align=\"center\"><b>消息標題</b></td>\n";
	echo "					<td width=10% height=\"20\" align=\"center\"><b>狀態</b></td>\n";
	echo "					<td width=10% height=\"20\" align=\"center\"><b>操作</b></td>\n";
	echo "				</tr>\n";
	
	// 設定每頁筆數
	$row = $PUBLIC_DB_PAGE_NUM ;
	
	// 找出人資料
	$countSQL = "SELECT * FROM News ORDER BY News_On DESC , News_Mod_DT DESC" ;
	//echo $countSQL . "<br>" ; 
	//$QUERY_Agent = mysqli_query($link , $SQL_Agent) ;
	
	// 找出總筆數
	$result = mysqli_query($link , $countSQL);  
	//查詢時返回查詢到數據行數：mysqli_num_rows
	$total = mysqli_num_rows($result);
	$totalpage = ceil( $total / $PUBLIC_DB_PAGE_NUM );	// 取得總頁數
	include_once("../includes/database/database_page.php");		// 計算資料庫筆數
	$start = ($page-1) * $row;
	
	$SQL_News = $countSQL . " LIMIT $start , $row";
	//echo $SQL_News . "<br>" ; 
	$QUERY_News = mysqli_query($link , $SQL_News) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY_News) )
	{
		$tmp_Index = 0 ;
		// 一條條獲取
		while ($LIST_News = mysqli_fetch_assoc($QUERY_News))
		{
			$tmp_Index % 2 ? $tmp_Mouseout_CSS = "table_list_tr_bglight" : $tmp_Mouseout_CSS = "table_list_tr_bgdack" ;
	
			echo "				<tr class=\"$tmp_Mouseout_CSS\" onmousemove=\"this.className='table_list_tr_hour'\"\n";
			echo "					onmouseout=\"this.className='$tmp_Mouseout_CSS'\">\n";
			echo "					<td height=\"25\" align=\"center\">{$LIST_News['News_Add_DT']}</td>\n";
			echo "					<td align=\"left\"><a href=\"News.php?ID={$LIST_News['id_News']}&Funct=MOD\">{$LIST_News['News_Title']}</a></td>\n";
			echo "					<td align=\"center\">{$array_News_On[$LIST_News['News_On']]}</td>\n";
			echo "					<td align=\"center\">\n";
			//echo "						<a href=\"News.php?ID={$LIST_News['id_News']}&Funct=MOD\">修改</a>\n";
			echo "						<a class='BTN-SaveData' data-type='刪除' data-id='{$LIST_News['id_News']}'>刪除</a>\n";
			echo "					</td>\n";
			echo "				</tr>\n";
			$tmp_Index++ ;
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_Agent);
	}
	else
	{	echo "<tr><td colspan='11' align='center'>沒有找到資料</td></tr><br>" ;	}
	
	echo "				<tr>\n";
	
	if( $total )
	{
		echo "<td align=\"center\" height=\"30\" colspan=\"4\" class=\"table_footer\">\n";
		include_once("../includes/database/database_page_item.php");
	//	echo "</td>\n";
	//	echo "<td align=\"center\" height=\"30\" colspan=\"2\" class=\"table_footer\">\n";
		include_once("../includes/database/database_page_button.php");
		echo "</td>\n";
	}
	else
	{
	//	echo "					<td align=\"center\" height=\"30\" colspan=\"14\" class=\"table_footer\">共有 <b>2</b> 記錄 / 共計 <b>1</b> 頁<br></td>\n";
	}
	
	echo "				</tr>\n";
	echo "			</table>\n";
	echo "		</td>\n";
	echo "	</tr>\n";
}
echo "</table>\n";
echo "\n";
//~@_@~// E N D 列表資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>
<script>
var toastr_Debug = 0 ;
// 處理資料(click.BTN-SaveData)
$('.BTN-SaveData').on('click', function() {
	// type: "GET",
	//  data: [a11="1"],		自行設定參數
	var Type = $(this).data("type");

	if(!confirm("是否要" + Type + "資料"))
	{	return false;	}

	$("body").mLoading("show");

	
	if( Type == "刪除" )
	{
		var ID = $(this).data("id");
		var tmp_data = {};
		tmp_data['ID'] = ID;	// 刪除會員ID
		//tmp_data['AID'] = AID;	// 目前操作代理人的ID
		tmp_data['Funct'] = "DELOK";	// 刪除代理人
	}
	else
	{
		tmp_data = $("#form1").serialize();
	}

	$.ajax({
		type: 'POST',
		url: 'NewsA.setData.php', 
		data: tmp_data,
	})
	.done(function(data){
		data = $.trim(data);
		// 完成後
		//toastr.success("回傳資料 : " + data);
		
		var retMsg = JSON.parse(data);
		if( retMsg.Err_Code == 1 )
		{
			toastr.success(retMsg.Err_Msg);
			setTimeout(function() {
				location.replace("News.php");
				$("body").mLoading("hide");
			}, 2000);
		}
		else
		{
			toastr.error(retMsg.Err_Msg);
			
		}
	})
	.fail(function() {
		// 執行失敗後
		toastr.error("刪除代理失敗");
	});
});

</script>
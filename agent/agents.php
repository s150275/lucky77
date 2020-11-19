<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "首頁" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "agents.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "page||*" ;
$ARRAY_POST_GET_PARA[] = "DESC||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_FIELD||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_KEY||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;			// 動作代理人(會員)的ID
$ARRAY_POST_GET_PARA[] = "AID||*" ;			// 目前操作代理人的ID
$ARRAY_POST_GET_PARA[] = "PID||*" ;			// 目前操作代理人的父ID
$ARRAY_POST_GET_PARA[] = "MID||*" ;			// 目前操作會員的ID

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
//unset($_SESSION['Member_ID']);
//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面

$array_On[0] = "關閉" ;
$array_On[1] = "正常" ;

$array_On_CSS[0] = "red" ;
$array_On_CSS[1] = "green" ;

$array_On_Set[0] = "啟用" ;
$array_On_Set[1] = "關閉" ;

//$tmp_Login_Name = WinHappy_getLoginName( $sub_Login_Name ) ;		// 取得登入帳號的名字

// 載入首頁
include($MAIN_BASE_ADDRESS . "agent/header.php") ;        // 載入首頁
/*
header.php已處理參數

$array_Agent_Info		登入代理人資料
$array_NowAgent_Info	目前操作代理人資料
$array_NowMember_Info	目前操作會員資料

$_SESSION['AID']		目前操作代理人ID
$_SESSION['AAgent_ID']	目前操作代理人Agent_ID
$_SESSION['MID']		目前操作會員ID

*/

//~@_@~// START 列表資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
echo "	<tr>\n";
echo "		<td height=\"55\" colspan=\"2\">\n";
echo "			<table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "					<td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 代理列表 &gt; [{$array_NowAgent_Info['Agent_Name']}] 的代理列表 </td>\n";
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

if( $_SESSION['Agent_Level'] == 1 )
{	echo "						<a href=\"agents_add.php?Funct=ADD&AID={$_SESSION['AID']}&Agent_Level=1\"><img border=\"0\" src=\"images/add_icon.gif\" align=\"absmiddle\" style=\"padding-right:5px\">新增代理</a>\n";	}

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
echo "	<tr>\n";
echo "		<td colspan=2 style=\"padding-left:10px\">\n";
echo "			<table width=\"99%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list\">\n";
echo "				<tr class=\"table_header\">\n";
echo "					<td height=\"20\" align=\"center\"><b>帳號</b></td>\n";
echo "					<td height=\"20\" width='150' align=\"center\"><b>姓名</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>狀態</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>現有點數</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>長莊輸<br>贏佔成</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>輪莊手<br>續費退水</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>長莊手<br>續費退水</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>長莊有<br>倍輸贏佔成</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>長莊有<br>倍手續費退水</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>創建日期</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>提&nbsp;存</b></td>\n";
echo "					<td height=\"20\" align=\"center\"><b>下線</b></td>\n";
//echo "					<td height=\"20\" align=\"center\"><b>操作</b></td>\n";
echo "				</tr>\n";

// 設定每頁筆數
$row = $PUBLIC_DB_PAGE_NUM ;

// 找出代理人資料
$countSQL = "SELECT * FROM Agent WHERE Agent_Father_ID = '{$_SESSION['AAgent_ID']}' AND Agent_Level = '1' ORDER BY id_Agent DESC" ;
//echo $countSQL . "<br>" ; 
//$QUERY_Agent = mysqli_query($link , $SQL_Agent) ;

// 找出總筆數
$result = mysqli_query($link , $countSQL);  
//查詢時返回查詢到數據行數：mysqli_num_rows
$total = mysqli_num_rows($result);
$totalpage = ceil( $total / $PUBLIC_DB_PAGE_NUM );	// 取得總頁數
include_once("../includes/database/database_page.php");		// 計算資料庫筆數
$start = ($page-1) * $row;

$SQL_Agent = $countSQL . " LIMIT $start , $row";
//echo $SQL_Agent . "<br>" ; 
$QUERY_Agent = mysqli_query($link , $SQL_Agent) ;

// 是否有資料
if ( mysqli_num_rows($QUERY_Agent) )
{
	$tmp_Index = 0 ;
	// 一條條獲取
	while ($LIST_Agent = mysqli_fetch_assoc($QUERY_Agent))
	{
		$tmp_Index % 2 ? $tmp_Mouseout_CSS = "table_list_tr_bglight" : $tmp_Mouseout_CSS = "table_list_tr_bgdack" ;
		// 找出退水設定
		$array_BackWater_Info = func_DatabaseGet( "BackWater" , "*" , array("BackWater_Set_ID"=>$LIST_Agent['Agent_ID']) ) ;		// 取得資料庫資料

		echo "				<tr class=\"$tmp_Mouseout_CSS\" onmousemove=\"this.className='table_list_tr_hour'\"\n";
		echo "					onmouseout=\"this.className='$tmp_Mouseout_CSS'\" id='Agent{$LIST_Agent['id_Agent']}'>\n";
		echo "					<td height=\"20\" width='50' align=\"center\">{$LIST_Agent['Agent_Login_Name']}</td>\n";
		echo "					<td style=\"width: 20px;\" align=\"center\"><a href=\"agents_add.php?ID={$LIST_Agent['id_Agent']}&Funct=MOD&AID={$_SESSION['AID']}&Agent_Level=1\">{$LIST_Agent['Agent_Name']}</a></td>\n";
		// 狀態
		echo "					<td align=\"center\">\n";
		if( $_SESSION['Agent_Level'] == 1 )
		{	echo "					<a href=\"javascript:;\" class='BTN_SetOn' data-id='{$LIST_Agent['id_Agent']}' data-val='{$LIST_Agent['Agent_On']}' data-field='Agent_On' data-msg='{$array_On_Set[$LIST_Agent['Agent_On']]}帳號權限' style='color:{$array_On_CSS[$LIST_Agent['Agent_On']]}'>{$array_On[$LIST_Agent['Agent_On']]}</a>\n";	}
		echo "					</td>\n";
		echo "					<td align=\"right\">" . (int)$LIST_Agent['Agent_Money'] . "</td>\n";

		// 長莊輸贏佔成,輪莊-手續費退水,長莊-手續費退水
		echo "					<td align=\"right\">" . (int)$LIST_Agent['Agent_Share'] . "%</td>\n";
		echo "					<td align=\"right\">" . (int)$LIST_Agent['Agent_Backwater'] . "%</td>\n";
		echo "					<td align=\"right\">" . (int)$LIST_Agent['Agent_Backwater2'] . "%</td>\n";
        echo "					<td align=\"right\">" . (int)$LIST_Agent['Agent_Share3'] . "%</td>\n";
        echo "					<td align=\"right\">" . (int)$LIST_Agent['Agent_Backwater3'] . "%</td>\n";
		echo "					<td align=\"center\">{$LIST_Agent['Agent_Add_DT']}</td>\n";

		if( $_SESSION['Agent_Level'] == 1 )
		{
			echo "					<td align=\"center\">\n";
			echo "						<a href=\"setMoney.php?ID={$LIST_Agent['id_Agent']}&Funct=Recharge&AID={$_SESSION['AID']}&Type=Agent&page=$page\">存入</a><br/>\n";
			echo "						<a href=\"setMoney.php?ID={$LIST_Agent['id_Agent']}&Funct=Collect&AID={$_SESSION['AID']}&Type=Agent&page=$page\">提取</a>\n";
			echo "					</td>\n";
		}
		else
		{	echo "					<td align=\"center\"></td>\n";	}

		echo "					<td align=\"center\"><a href=\"agents.php?AID={$LIST_Agent['id_Agent']}\">代理列表</a><br/><a href=\"users.php?AID={$LIST_Agent['id_Agent']}\">會員列表</a></td>\n";

//		if( $_SESSION['Agent_Level'] == 1 )
//		{	echo "					<td align=\"center\"><a href=\"javascript:;\" data-id=\"{$LIST_Agent['id_Agent']}\" data-aid=\"{$_SESSION['AID']}\" class='BTN_DEL_Agent'\">刪除</a></td>\n";	}
//		else
//		{	echo "					<td align=\"center\"></td>\n";	}

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
	$tmp_PageBTN_Para = "&AID=$AID" ;	// 上下頁後面要加的參數

	echo "<td align=\"center\" height=\"30\" colspan=\"9\" class=\"table_footer\">\n";
	include_once("../includes/database/database_page_item.php");
	echo "</td>\n";
	echo "<td align=\"center\" height=\"30\" colspan=\"9\" class=\"table_footer\">\n";
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
echo "</table>\n";
echo "\n";
//~@_@~// E N D 列表資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>
<script>
var toastr_Debug = 0 ;
// 刪除代理人
//BTN_DEL_Agent
// 刪除代理人(click#BTN_DEL_Agent)
$('.BTN_DEL_Agent').on('click', function() {
	// type: "GET",
	//  data: [a11="1"],		自行設定參數
	if(!confirm("是否要刪除代理人資料"))
	{	return false;	}
	
	var tmp_data = {} ;			// 傳送資料
	var id = $(this).data("id");
	var AID = $(this).data("aid");

	tmp_data['ID'] = id;	// 刪除會員ID
	tmp_data['AID'] = AID;	// 目前操作代理人的ID
	tmp_data['Funct'] = "DELOK";	// 刪除代理人
	//alert(id);
	$.ajax({
		type: 'POST',
		url: 'ajax_addAgent.php', 
		data: tmp_data,
	})
	.done(function(data){
		data = $.trim(data);
		// 完成後
		if( toastr_Debug == 1 )// 除錯訊息
		{	toastr.success("回傳資料 : " + data);	}
		
		var retMsg = JSON.parse(data);
		if( retMsg.Err_Code == 1 )
		{
			toastr.success(retMsg.Err_Msg);
			setTimeout(function() {
				location.replace("agents.php?AID=" + AID);
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

// 設定會員權限(綁定)(click#ID)
$('body').on('click','.BTN_SetOn',function(){
	var ID = $(this).data("id");		// ID
	var Msg = $(this).data("msg");		// 確認訊息
	var Val = $(this).data("val");		// 設定值
	var Field = $(this).data("field");	// 修改欄位
	//alert(ID + Field + Val);
	if( Val == 1 )
	{	Msg += ",請注意會連同下線一起關閉權限";	}

	if(!confirm("是否要" + Msg ))
	{	return false;	}

	var tmp_data = {};
	tmp_data['Funct'] = "ModOn";	// 修改權限
	tmp_data['ID'] = ID;			// 修改會員ID
	tmp_data['Val'] = Val;			// 要修改的值
	tmp_data['Field'] = Field;	// 要修改的欄位
	//alert(id);
	$.ajax({
		type: 'POST',
		url: 'ajax_setAgentOn.php', 
		data: tmp_data,
	})
	.done(function(data){
		data = $.trim(data);
		// 完成後
		//toastr.success("回傳資料 : " + data);
		var State = data.substr(0,2) ;
		if( State == "1,")
		{
			toastr.success("設定權限成功");
			$("#Agent"+ID).html(data.substr(2));
		}
		
		var retMsg = JSON.parse(data);
		if( retMsg.Err_Code == 1 )
		{
			toastr.success(retMsg.Err_Msg);
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
<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "會員資料" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "users.php" ;			// 設定本程式的檔名
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

$array_On_Set_CSS[0] = "green" ;
$array_On_Set_CSS[1] = "red" ;

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

echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" height=\"110\">\n";
echo "	<tr>\n";
echo "		<td height=\"55\" colspan=\"2\">\n";
echo "			<table width=\"100%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "					<td width=\"49%\" align=\"left\" class=\"blue_text\">首頁 &gt; 會員列表</td>\n";
echo "					<td width=\"50%\" align=\"right\" class=\"blue_text\" style=\"color:#FF0000\">\n";
echo "						<!--各層代理如要修改佔成或退水，必須於每日01:00~02:00時段內。-->\n";
echo "					</td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"14\" colspan=\"3\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td height=\"25\" align=\"left\" colspan=2>\n";
echo "			<table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td height=\"25\" align=\"left\" width=\"120\">\n";

if( $_SESSION['Agent_Level'] == 1 )
{	echo "						<a href=\"users_add.php?Funct=ADD&AID={$_SESSION['AID']}\"><img border=\"0\" src=\"images/add_icon.gif\" align=\"absmiddle\" style=\"padding-right:5px\">新增會員</a>\n";	}

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
echo "	<tr class=\"table_header\">\n";
echo "		<td height=\"20\" colspan=\"2\" align=\"center\">\n";
echo "			<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list\">\n";
echo "				<tr class=\"table_header\">\n";
echo "					<td width=\"10%\" height=\"20\" align=\"center\"><b>帳號</b></td>\n";
echo "					<td width=\"8%\" height=\"20\" align=\"center\"><b>姓名</b></td>\n";
echo "					<td width=\"6%\" height=\"20\" align=\"center\"><b>點數</b></td>\n";
echo "					<!--  <td width=\"7%\" height=\"20\" align=\"center\"><b>遊戲下線<br>\n";
echo "					  分成比</b></td>\n";
echo "				   <td width=\"7%\" height=\"20\" align=\"center\"><b>一般玩法<br>佣金</b></td>\n";
echo "					<td width=\"7%\" height=\"20\" align=\"center\"><b>超級玩法<br>佣金</b></td> -->\n";
echo "					<td width=\"5%\" height=\"20\" align=\"center\"><b>狀態</b></td>\n";
echo "					<td width=\"5%\" align=\"center\"><b>賓果<br>投注</br></td>\n";
echo "					<td width=\"10%\" height=\"20\" align=\"center\"><b>開戶日期</b></td>\n";
echo "					<td width=\"8%\" height=\"20\" align=\"center\">提存</td>\n";
echo "					<td width=\"6%\" height=\"20\" align=\"center\"><b>帳號</b></td>\n";
echo "					<td width=\"5%\" align=\"center\"><b>投注</b></td>\n";
//echo "					<td width=\"5%\" height=\"20\" align=\"center\"><b>峰頂值</b></td>\n";

echo "					<td width=\"8%\" height=\"20\" align=\"center\"><b>上次登入<br>日期</b></td>\n";
echo "					<td width=\"8%\" height=\"20\" align=\"center\"><b>上次登入<br>IP</b></td>\n";
//echo "					<td width=\"5%\" align=\"center\"><b>操作</b></td>\n";
echo "				</tr>\n";
echo "				<!--<td align=\"center\">[[DATA.profit_percent_normal]]%</td>\n";
echo "				<td align=\"center\">[[DATA.profit_percent_superball]]%</td>-->\n";
echo "				\n";

//$PUBLIC_DB_PAGE_NUM = 2 ;

$row = $PUBLIC_DB_PAGE_NUM ;

// 取得直屬會員資料
if( $array_Agent_Info['Agent_ID'] == $array_NowAgent_Info['Agent_ID'] AND 0)
{	$SQL_Member = "SELECT * FROM Member WHERE Member_Online_id LIKE '%{$array_Agent_Info['id_Agent']}%' ORDER BY Member_Add_DT DESC " ;	}
//{	$SQL_Member = "SELECT * FROM Member WHERE Member_Login_Title = '{$array_Agent_Info['Agent_Login_Title']}' AND Member_Layers >= '{$array_NowAgent_Info['Agent_Layers']}' " ;	}
else
{	$SQL_Member = "SELECT * FROM Member WHERE Member_Father_ID = '{$array_NowAgent_Info['Agent_ID']}' ORDER BY Member_Add_DT DESC" ;	}
//{	$SQL_Member = "SELECT * FROM Member WHERE Member_Login_Title = '{$array_Agent_Info['Agent_Login_Title']}' AND Member_Father_ID = '{$array_NowAgent_Info['Agent_ID']}' " ;	}

// 找出總筆數
$result = mysqli_query($link , $SQL_Member);  
//查詢時返回查詢到數據行數：mysqli_num_rows
$total = mysqli_num_rows($result);
$totalpage = ceil( $total / $PUBLIC_DB_PAGE_NUM );	// 取得總頁數
include_once("../includes/database/database_page.php");		// 計算資料庫筆數
$start = ($page-1) * $row;

$SQL_Member = $SQL_Member . " LIMIT $start , $row";

//echo $SQL_Member . "<br>" ;
$QUERY_Member = mysqli_query($link , $SQL_Member) ;

// 是否有資料
if ( mysqli_num_rows($QUERY_Member) )
{
	$tmp_Index = 0 ;
    // 一條條獲取
    while ($LIST_Member = mysqli_fetch_assoc($QUERY_Member))
    {
		$tmp_Index % 2 ? $tmp_Mouseout_CSS = "table_list_tr_bglight" : $tmp_Mouseout_CSS = "table_list_tr_bgdack" ;
		echo "				<tr class=\"$tmp_Mouseout_CSS\" id='Member{$LIST_Member['id_Member']}'>\n";
		echo "					<td height=\"25\" align=\"center\"><a href=\"users_add.php?ID={$LIST_Member['id_Member']}&AID={$_SESSION['AID']}&Funct=MOD\">{$LIST_Member['Member_Login_Name']}</a>\n";
		echo "					</td>\n";
		echo "					<td align=\"center\">{$LIST_Member['Member_Name']}</td>\n";
		echo "					<td align=\"right\">" . (int)$LIST_Member['Member_Money'] . "</td>\n";
		echo "					<!--<td align=\"center\">%</td>-->\n";
		echo "					<td align=\"center\"><font color='{$array_On_CSS[$LIST_Member['Member_On']]}'>{$array_On[$LIST_Member['Member_On']]}</a></td>\n";
		echo "					<td align=\"center\"><font color='{$array_On_CSS[$LIST_Member['Member_Bingo_On']]}'>{$array_On[$LIST_Member['Member_Bingo_On']]}</a></td>\n";
		echo "					<td align=\"center\">" . mb_substr($LIST_Member['Member_Add_DT'] , 0 , 10 , "utf-8") . "</td>\n";

		if( $_SESSION['Agent_Level'] == 1 )
		{
			echo "					<td align=\"center\">\n";
			echo "						<a href=\"setMoney.php?ID={$LIST_Member['id_Member']}&Funct=Recharge&AID={$_SESSION['AID']}&Type=Member&page=$page\">存入</a>&nbsp;\n";
			echo "						<a href=\"setMoney.php?ID={$LIST_Member['id_Member']}&Funct=Collect&AID={$_SESSION['AID']}&Type=Member&page=$page\">提出</a>\n";
			echo "					</td>\n";
			echo "					<td align=\"center\"><a href=\"javascript:;\" class='BTN_SetOn' data-id='{$LIST_Member['id_Member']}' data-val='{$LIST_Member['Member_On']}' data-field='Member_On' data-msg='{$array_On_Set[$LIST_Member['Member_On']]}帳號權限' style='color:{$array_On_Set_CSS[$LIST_Member['Member_On']]}'>{$array_On_Set[$LIST_Member['Member_On']]}</a></td>\n";
			echo "					<td align=\"center\"><a href=\"javascript:;\" class='BTN_SetOn' data-id='{$LIST_Member['id_Member']}' data-val='{$LIST_Member['Member_Bingo_On']}' data-field='Member_Bingo_On' data-msg='{$array_On_Set[$LIST_Member['Member_Bingo_On']]}賓果權限' style='color:{$array_On_Set_CSS[$LIST_Member['Member_Bingo_On']]}'>{$array_On_Set[$LIST_Member['Member_Bingo_On']]}</a></td>\n";
			//echo "					<td align=\"center\"><a href=\"users_addPeak_Value.php?Funct=Peak_Value&ID={$LIST_Member['id_Member']}&AID={$_SESSION['AID']}\">設定</a></td>\n";
//			echo "					<td align=\"center\"></td>\n";
		}
		else
		{
			echo "					<td align=\"center\"></td>\n";
			echo "					<td align=\"center\"></td>\n";
			echo "					<td align=\"center\"></td>\n";
//			echo "					<td align=\"center\"></td>\n";
		}
		
		echo "					<td align=\"center\">" .  func_clearDefaultDate( $LIST_Member['Member_Login_DT'] , "" ) . "</td>\n";
		echo "					<td align=\"center\">{$LIST_Member['Member_Login_IP']}</td>\n";

//		if( $_SESSION['Agent_Level'] == 1 )
//		{	echo "					<td align=\"center\"><a href=\"javascript:;\" data-id=\"{$LIST_Member['id_Member']}\" data-aid=\"{$_SESSION['AID']}\" class='BTN_DEL_Member'\">刪除</a>\n";	}
//		else
//		{	echo "					<td align=\"center\"></td>\n";	}
		
		echo "					</td>\n";
		echo "				</tr>\n";
		$tmp_Index++ ;
    }
    
    // 釋放結果集合
    mysqli_free_result($QUERY_Member);
}
if( $total )
{
	$tmp_PageBTN_Para = "&AID=$AID" ;	// 上下頁後面要加的參數
	echo "<td align=\"center\" height=\"30\" colspan=\"6\" class=\"table_footer\">\n";
	include_once("../includes/database/database_page_item.php");
	echo "</td>\n";
	echo "<td align=\"center\" height=\"30\" colspan=\"7\" class=\"table_footer\">\n";
	include_once("../includes/database/database_page_button.php");
	echo "</td>\n";
}
//else
//{	echo "沒有找到資料<br>" ;	}

//echo "				<tr>\n";
//echo "					<td align=\"center\" height=\"30\" colspan=\"14\" class=\"table_footer\">共有 <b>12</b> 記錄 / 共計 <b>1</b> 頁<br></td>\n";
//echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "\n";

// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>
<script>
var toastr_Debug = 0 ;
// 刪除會員(click#BTN_DEL_Member)
$('.BTN_DEL_Member').on('click', function() {
	if(!confirm("是否要刪除會員資料"))
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
		url: 'ajax_addMember.php', 
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
				location.replace("users.php?AID=" + AID);
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
		url: 'ajax_setMemberOn.php', 
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
			$("#Member"+ID).html(data.substr(2));
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
<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "點數設定" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "setMoney.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "page||*" ;			// page
$ARRAY_POST_GET_PARA[] = "ID||*" ;			// 動作代理人(會員)的ID
$ARRAY_POST_GET_PARA[] = "AID||*" ;			// 目前操作代理人的ID
$ARRAY_POST_GET_PARA[] = "PID||*" ;			// 目前操作代理人的父ID
$ARRAY_POST_GET_PARA[] = "MID||*" ;			// 目前操作會員的ID
$ARRAY_POST_GET_PARA[] = "Type||*" ;		// 目前操作人員類別(Agent:代理人,Member:會員)
$ARRAY_POST_GET_PARA[] = "Money||*" ;		// 操作金額

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
//unset($_SESSION['Member_ID']);
//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;

// 是否有設目前代理人ID
if ( $AID )
{
	$array_NowAgent_Info = WinHappy_getAgentInfo( $AID ) ;
	$_SESSION['AID'] = $array_NowAgent_Info['Agent_ID'] ;
}

//$array_NowAgent_Info = WinHappy_getAgentInfo( $_SESSION['AID'] ) ;		// 取得代理人資料

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面
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

if( $Funct == "RechargeOK" OR $Funct == "CollectOK" AND 0)
{
	// 錯誤訊息
	$tmp_ErrMSG = "" ;

	// 找出設定金額的代理人資料
	$array_Agent_Info = WinHappy_getAgentInfo( $_SESSION['Agent_ID'] ) ;		// 取得目前操作代理人
	
	// 操作分類
	if( $Type == "Agent" )
	{// 代理人
		$tmp_MoneyLog_Class = "2";
		$array_Info = WinHappy_getAgentInfo( $ID ) ;		// 取得代理人資料
		// 被操作人金額
		$tmp_MoneyLog_Original_Money = $array_Info['Agent_Money'] ;
		$tmp_URL = "agents.php?AID=$AID" ;
		$tmp_LogInfo_Type = "代理人" ;
	}
	else
	{// 會員
		$tmp_MoneyLog_Class = "1" ;
		$array_Info = WinHappy_getMemberInfo( $ID ) ;		// 取得會員資料
		// 被操作人金額
		$tmp_MoneyLog_Original_Money = $array_Info['Member_Money'] ;
		$tmp_URL = "users.php?AID=$AID" ;
		$tmp_LogInfo_Type = "會員" ;

		// 會員在線上，代理不可以提出或存入會員點數
		$tmp_OnLineState = func_checkOnLineState( $array_Info['Member_ID'] , 5 , "OnLine_DT" ) ;		// 取得會員是否在線
		if( $tmp_OnLineState == 1 )
		{
			toastrMsg( "會員還在線上，不可以提出或存入會員點數" , "E" ) ;		// 秀出toastr訊息
			Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
			exit;
		}
	}

	// 設定執行動作
	if( $Funct == "RechargeOK" )
	{
		$tmp_Action = "存入" ;
		$tmp_MoneyAction = "+" ;
		$tmp_Main_MoneyAction = "-" ;
		$MoneyLog_Type = 3 ;

		// 是否有足夠的金額可以轉移-判斷轉入人金額是否足夠
		if( $array_NowAgent_Info['Agent_Money'] < $Money )
		{	$tmp_ErrMSG = "{$array_NowAgent_Info['Agent_Name']}沒有足夠的金額可以轉移" ;	}
	}
	else
	{
		$tmp_Action = "提出" ;
		$tmp_MoneyAction = "-" ;
		$tmp_Main_MoneyAction = "+" ;
		$MoneyLog_Type = 4 ;

		// 是否有足夠的金額可以轉移-判斷提出人金額是否足夠
		if( $tmp_MoneyLog_Original_Money < $Money )
		{	$tmp_ErrMSG = "對方沒有足夠的金額可以轉移" ;	}
	}

	// 是否有足夠點數扣
	if ( $tmp_ErrMSG )
	{
		toastrMsg( $tmp_ErrMSG , "E" ) ;		// 秀出toastr訊息
		//alertgo("您沒有足夠的金額可以轉移","");
		Time2URL( 1, $tmp_URL ) ;		// 固定時間前往某個頁面
	}
	else
	{
		if($Type AND $ID)
		{
	
			// 設定被設定人金額
			$tmpSQL = "UPDATE $Type SET {$Type}_Money = {$Type}_Money $tmp_MoneyAction $Money WHERE id_{$Type} = '$ID'" ;				// 欄位值+1
			//$tmpSQL = "UPDATE Agent SET Agent_Money = Agent_Money + 100 WHERE id_Agent = '34'" ;				// 欄位值+1
			//echo $tmpSQL ;
			//exit;
			$Bol = func_DatabaseBase( $tmpSQL , "SQL" , "" , "" ) ;									// 資料庫處理
			if( $Bol )
			{
				// 加入操作LOG
				$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
				$array_LogInfo['OperatorID'] = $_SESSION['Agent_ID'] ;		// 操作者ID
				$array_LogInfo['OperatorName'] = $_SESSION['Agent_Name'] ;	// 操作者姓名
				$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
				$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
				$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
				$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
				// 參考 func_WriteLogFieldInfo()
				$array_LogInfo['Type'] = "$tmp_Action" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
				$array_LogInfo['Info'] = "動作:{$tmp_LogInfo_Type}{$tmp_Action} , 操作者:{$_SESSION['Agent_Name']} , 目地{$tmp_LogInfo_Type}ID:$ID , 來源代理人ID:{$array_NowAgent_Info['Agent_ID']} , 操作金額:$Money" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
				$array_LogInfo['SQL'] = str_replace ("'","’",$tmpSQL) ;		// SQL內容(有才需填-只給管理者看)
		
				// 管理者操作-管理等級來判斷
				$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料

				// 加入被設定人金額Log
				$arrayField['MoneyLog_Set_ID'] = $array_Info[$Type.'_ID'] ;	// 設定者ID
				$arrayField['MoneyLog_Class'] = $tmp_MoneyLog_Class ;		// 操作對像#::SELECT:2||1||會員||2||代理人::
				$arrayField['MoneyLog_Type'] = $MoneyLog_Type ;				// 操作動作#::SELECT:2||0||其它||1|遊戲投注|||2||遊戲派彩||3||存入||4||提出||提出||5||莊家派彩||6||五星彩獎金||7||總彩金獎金:
				$arrayField['MoneyLog_Bet_ID'] = "" ;						// 下注訂單號
				$arrayField['MoneyLog_Money'] = $Money ;					// 操作金額
				$arrayField['MoneyLog_Original_Money'] = $tmp_MoneyLog_Original_Money ;			// 操作前金額
				$arrayField['MoneyLog_Operator_IP'] = $_SERVER['REMOTE_ADDR']	 ;	// 操作者IP
				$arrayField['MoneyLog_Operator_ID'] = $_SESSION['AAgent_ID']	 ;	// 操作者ID
				$arrayField['MoneyLog_Operator_Name'] = $array_NowAgent_Info['Agent_Name']	 ;	// 操作者名稱
				$arrayField['MoneyLog_Log'] = "操作者名稱:{$array_NowAgent_Info['Agent_Name']} , 操作者ID:{$array_NowAgent_Info['id_Agent']}"	 ;	// 操作者名稱
				$arrayField['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;		// 操作時間
				
				$Bol = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField , "" ) ;						// 資料庫處理
				if( !$Bol )
				{// 加入被設定人金額Log失敗
					toastrMsg( "加入被設定人{$tmp_Action}Log失敗" , "E" ) ;		// 秀出toastr訊息
					Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
				}

				// 如果為管理者則不用扣
				if( $array_NowAgent_Info['Agent_ID'] != "Agent2005100001" )
				{
					// 扣掉操作代理人金額
					$tmpSQL_Agent = "UPDATE Agent SET Agent_Money = Agent_Money $tmp_Main_MoneyAction $Money WHERE Agent_ID = '{$_SESSION['AAgent_ID']}'" ;				// 欄位值+1
					//echo $tmpSQL ;
					$Bol_Agent = func_DatabaseBase( $tmpSQL_Agent , "SQL" , "" , "" ) ;		// 資料庫處理
					if ( !$Bol_Agent )
					{
						toastrMsg( "扣掉操作代理人{$tmp_Action}金額失敗" , "E" ) ;		// 秀出toastr訊息
						Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
					}
					else
					{
						toastrMsg( "{$tmp_Action}金額成功" , "S" ) ;		// 秀出toastr訊息
						// 成功 , Agent , + , 100 , 34
						Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
					}
				}
				else
				{
					toastrMsg( "{$tmp_Action}金額成功" , "S" ) ;		// 秀出toastr訊息
					// 成功 , Agent , + , 100 , 34
					Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
				}
			}
			else
			{// 存入失敗
				toastrMsg( "被設定人{$tmp_Action}金額失敗" , "E" ) ;		// 秀出toastr訊息
			}
	}
	}
}
else
{
	// 取得設定者資料
	if ( $ID )
	{
		if( $Type == "Agent" )
		{
			$array_Info = WinHappy_getAgentInfo( $ID ) ;
			$tmp_Name = $Type."_Name";
		}
		else
		{
			$array_Info = WinHappy_getMemberInfo( $ID ) ;
			$tmp_Name = $Type."_Name";
		}
	}
	//echo "<p>$ID</p>" ;print_r($array_Info);echo "<br>" ;
	// 設定執行動作
	if( $Funct == "Recharge" )
	{	$tmp_MoneyLog_Type = 3 ;	}
	else
	{	$tmp_MoneyLog_Type = 4 ;	}
	
	// 設定執行動作
	$Funct == "Recharge" ? $tmp_Action = "存入" : $tmp_Action = "提出" ;
	
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "	<tr>\n";
	echo "		<td height=\"55\" colspan=\"2\">\n";
	echo "			<table width=\"100%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "				<tr>\n";
	echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
	echo "					<td width=\"49%\" align=\"left\" class=\"blue_text\">首頁 &gt; 會員列表 &gt; 存入會員點數</td>\n";
	echo "					<td width=\"50%\" align=\"right\" class=\"blue_text\" style=\"color:#FF0000\">\n";
	echo "						各層代理如要修改佔成或退水，必須於每日01:00~02:00時段內。\n";
	echo "					</td>\n";
	echo "				</tr>\n";
	echo "				<tr>\n";
	echo "					<td height=\"14\" colspan=\"3\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
	echo "				</tr>\n";
	echo "			</table>\n";
	echo "		</td>\n";
	echo "	</tr>\n";
	echo "\n";
	echo "</table>\n";
	echo "<fieldset>\n";
	echo "	<legend>&nbsp;帳號基本資料&nbsp;</legend>\n";
	echo "	<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "		<tr>\n";
	echo "			<td height=\"25\" align=\"left\" style=\"padding-left:10px\">會員登入帳號：</td>\n";
	echo "			<td width=\"88%\" height=\"14\">\n";
	echo "				<a href=\"./users.php?sid=86980&mode=edit\">" . $array_Info[$Type.'_Login_Name'] . "</a></td>\n";
	echo "		</tr>\n";
	echo "		<tr>\n";
	echo "			<td height=\"25\" align=\"left\" style=\"padding-left:10px\">會員暱稱：</td>\n";
	echo "			<td height=\"15\">" . $array_Info[$Type.'_Name'] . "</td>\n";
	echo "		</tr>\n";
	if( $Type != "Agent" )
	{
		echo "		<tr>\n";
		echo "			<td width=\"12%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">\n";
		echo "				峰頂值：\n";
		echo "			</td>\n";
		echo "			<td height=\"15\">\n";
		echo "				" . $array_Info[$Type.'_Peak_Value'] . "\n";
		echo "			</td>\n";
		echo "		</tr>\n";
	}
	echo "		<tr>\n";
	echo "			<td height=\"25\" align=\"left\" style=\"padding-left:10px\">現有點數：</td>\n";
	echo "			<td height=\"15\">" . (int)$array_Info[$Type.'_Money'] . "</td>\n";
	echo "		</tr>\n";
	echo "		<tr>\n";
	echo "			<td width=\"12%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">{$tmp_Action}點數：</td>\n";
	echo "			<td height=\"15\">\n";
	echo "				<input name=\"Money\" id='Money' type=\"text\" value='0' onkeyup=\"this.value=this.value.replace(/[^\d]/g,'')\" size=\"10\" maxlength=\"8\" class=\"money\"><!--&nbsp;(只能輸入整數,最大存入點數為：[[MAX_AMOUNT]])-->\n";
	echo "			</td>\n";
	echo "		</tr>\n";
	echo "		<tr>\n";
	echo "			<td height=\"55\" align=\"center\" colspan=\"2\">\n";
	
	if( $Funct == "Recharge" )
	{	echo "                <img class='BTN_SaveMoney' data-page='$page' src=\"images/enter_save.jpg\">\n";	}
	//{	echo "				<input type=\"image\"  class='BTN_SaveMoney' src=\"images/save_diao.jpg\" value=\"存入點數\">&nbsp;&nbsp;\n";	}
	else
	{	echo "                <img class='BTN_SaveMoney' data-page='$page' src=\"images/tichu_diao.jpg\">\n";	}
	//{	echo "				<input type=\"image\"  class='BTN_SaveMoney' src=\"images/tichu_diao.jpg\" value=\"提出點數\">&nbsp;&nbsp;\n";	}
	
	echo "				<a href=\"./users.php?sid=86980&mode=edit\"><img src=\"images/back.jpg\" border=0 name=\"返回上一頁\" style=\"cursor:pointer\"></a>\n";
	echo "			</td>\n";
	echo "		</tr>\n";
	echo "	</table>\n";
	echo "</fieldset>\n";
	
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "	<tr>\n";
	echo "		<td colspan=\"2\" height=\"25\" style=\"padding-left:10px\">\n";
	echo "			<font color=\"#CC0000\"><strong>以下為最近的３０筆存入記錄：</strong></font></td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "		<td colspan=2 align=\"left\" style=\"padding-left:10px\">\n";
	echo "			<table width=\"561\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\" class=\"table_list\">\n";
	echo "				<tr class=\"table_header\">\n";
	echo "					<td width=\"120\" height=\"25\" align=\"center\"><p align=\"center\"><font\n";
	echo "							color=\"#FFFFFF\"><b>{$tmp_Action}時間</b></font></p></td>\n";
	echo "					<td align=\"center\"><p align=\"center\"><font\n";
	echo "							color=\"#FFFFFF\"><b>{$tmp_Action}前點數</b></font></p></td>\n";
	echo "					<td align=\"center\"><p align=\"center\"><font\n";
	echo "							color=\"#FFFFFF\"><b>{$tmp_Action}點數</b></font></p></td>\n";
	echo "					<td align=\"center\"><p align=\"center\"><font\n";
	echo "							color=\"#FFFFFF\"><b>操作人員</b></font></p></td>\n";
	echo "				</tr>\n";

	// 找出資料
	$SQL_MoneyLog = "SELECT * FROM MoneyLog WHERE MoneyLog_Set_ID = '" . $array_Info[$Type.'_ID'] . "' AND MoneyLog_Type = '$tmp_MoneyLog_Type' ORDER BY id_MoneyLog DESC LIMIT 0,30" ;
	//echo $SQL_MoneyLog . "<br>" ; 
	$QUERY_MoneyLog = mysqli_query($link , $SQL_MoneyLog) ;

	// 是否有資料
	if ( mysqli_num_rows($QUERY_MoneyLog) )
	{
		// 一條條獲取
		while ($LIST_MoneyLog = mysqli_fetch_assoc($QUERY_MoneyLog))
		{
			echo "				<tr class=\"table_list_tr_bglight\">\n";
			echo "					<td height=\"25\" align=\"center\">{$LIST_MoneyLog['MoneyLog_Add_DT']}</td>\n";
			echo "					<td align=\"right\">" . (int)$LIST_MoneyLog['MoneyLog_Original_Money'] . "</td>\n";
			echo "					<td align=\"right\">" . (int)$LIST_MoneyLog['MoneyLog_Money'] . "&nbsp;</td>\n";
			echo "					<td align=\"right\">{$LIST_MoneyLog['MoneyLog_Operator_Name']}&nbsp;</td>\n";
			echo "				</tr>\n";
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_MoneyLog);
	}
	//else
	//{	echo "沒有找到資料<br>" ;	}

	
	echo "				\n";
	echo "			</table>\n";
	echo "		</td>\n";
	echo "	</tr>\n";
	echo "</table>\n";
	echo "</div>\n";
	echo "<input type=\"hidden\" name=\"mode\" value=\"recharge-save\">\n";
	echo "<input type=\"hidden\" name=\"Funct\" value=\"{$Funct}OK\">\n";
	echo "<input type=\"hidden\" name=\"ID\" value=\"$ID\">\n";
	echo "<input type=\"hidden\" id='AID' name=\"AID\" value=\"$AID\">\n";
	echo "<input type=\"hidden\" id='Type' name=\"Type\" value=\"$Type\">\n";
	echo "\n";
}
?>

<script language="javascript">
function check()
{
	frm = document.form1;
	if (frm.amount.value == '') {
		alert("請輸入存入點數值!");
		frm.amount.focus();
		return false;
	}
	if (frm.amount.value == '' || parseInt(frm.amount.value) <= 0) {
		alert("請輸入存入點數值!");
		return false;
	}
	/*if(frm.amount.value > [[MAX_AMOUNT]]) {
	 alert("最大存入點數不能超過：[[MAX_AMOUNT]]");
	 return false;
	 }*/
	if (confirm("您確定存入點數嗎？")) {
		return true;
	}
	else return false;
}

// (click.BTN_SaveMoney)
$('.BTN_SaveMoney').on('click', function() {
	var Money = $("#Money").val();
	if( Number(Money) <= 0 )
	{
		toastr.error("設定金額不正確");
		return false;
	}
	$("body").mLoading("show") ;		// 資料上傳中
	//alert(Money_Val);
	var AID = $("#AID").val();
	var Type = $("#Type").val();
	var page = $(".BTN_SaveMoney").data("page");
	//alert(page);
	//return false;

	$.ajax({
		type: 'POST',
		url: 'setMoneyA_Set.php', 
		data: $("#form1").serialize(),
	})
	.done(function(data){
		data = $.trim(data);
		// 完成後
		//toastr.success("回傳資料 : " + data);
		
		// 直接設定判斷碼
		var RetState = Number(data.substr(0,2));
		//console.log(RetState);

		var RetMsg = data.substr(3) ;
		// 成功
		if( RetState > 0 )
		{	toastr.success( RetMsg );	}
		// 失敗
		else if( RetState < 0 )
		{	toastr.error( RetMsg );	}
		
		// agents.php?AID=86
		
		setTimeout(function() {
			if( Type == "Agent" )
			{	location.replace("agents.php?page=" + page + "&AID=" + AID);	}
			else
			{	location.replace("users.php?page=" + page + "&AID=" + AID);	}
		}, 2000);

	})
	.fail(function() {
		// 執行失敗後
		toastr.error("新增代理失敗");
	});
	setTimeout(function() {
		$("body").mLoading("hide");	// 取消畫面
	}, 2000);

});

</script>
<?php
// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>

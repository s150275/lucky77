<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "加入會員" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "users_add.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "ID||*" ;			// 動作代理人(會員)的ID
$ARRAY_POST_GET_PARA[] = "AID||*" ;			// 目前操作代理人的ID
$ARRAY_POST_GET_PARA[] = "PID||*" ;			// 目前操作代理人的父ID
$ARRAY_POST_GET_PARA[] = "MID||*" ;			// 目前操作會員的ID

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

if ( $ID )
{
	$array_Member_Info = WinHappy_getMemberInfo( $ID ) ;
}

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面


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

// 秀出form資料
function showForm( $LIST , $subFUNCT )
{
	global $link ;
	global $MAIN_FILE_NAME ;
	global $MAIN_BASE_ADDRESS ;
	global $MAIN_CHECK_FIELD ;
	global $MAIN_SHOWTYPE ;
	global $errMsg ;
	global $array_NowAgent_Info;	// 目前操作者代理人ID

	// 外加變數
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "    <tr>\n";
	echo "        <td height=\"55\" colspan=\"2\">\n";
	echo "            <table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "                <tr>\n";
	echo "                    <td width=\"1%\" align=\"left\">\n";
	echo "                        <img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/>\n";
	echo "                    </td>\n";
	echo "                    <td width=\"49%\" align=\"left\" class=\"blue_text\">首頁 &gt; 會員列表 &gt; 修改會員資料</td>\n";
	echo "                    <td width=\"50%\" align=\"right\" class=\"blue_text\" style=\"color:#FF0000\">\n";
	echo "                        各層代理如要修改佔成或退水，必須於每日01:00~02:00時段內。\n";
	echo "                    </td>\n";
	echo "                </tr>\n";
	echo "                <tr>\n";
	echo "                    <td height=\"14\" colspan=\"3\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
	echo "                </tr>\n";
	echo "            </table>\n";
	echo "        </td>\n";
	echo "    </tr>\n";
	echo "</table>\n";

	$array_AgentList = WinHappy_getAgentList( $_SESSION['AID'] , "N" ) ;		// 取得所有上線代理人資料
	$array_AgentListN = $array_AgentList["N"];
	//$array_AgentListN = array_reverse($array_AgentListN);
	//echo "<p>{$_SESSION['AID']}</p>" ;print_r($array_AgentList);echo "<br>" ;
	$tmp_AgentList = array2str($array_AgentListN , " > ");

	echo "<fieldset>\n";
	echo "    <legend>&nbsp;帳號基本資料&nbsp;</legend>\n";
	echo "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "        <tr>\n";
	echo "            <td width=\"150\" height=\"25\" align=\"left\" style=\"padding-left:10px\">層階顯示：</td>\n";
	echo "            <td height=\"14\">$tmp_AgentList</td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">會員登入帳號：</td>\n";
	echo "            <td height=\"14\">\n";
//	echo "                <select name=\"flag_char\" disabled style=\"text-align:center;width:60px; height:22px;\">\n";
//	echo "                    <option value='C2'>C2</option>\n";
//	echo "                </select>\n";
	echo "                <input type=\"text\" size=\"2\" name=\"Member_Login_Title\" value=\"{$LIST['Member_Login_Title']}\" readonly style=\"text-align:center;width:60px; height:22px;\">\n";

	$subFUNCT == "MODOK" ? $tmp_Readonly = " readonly" : $tmp_Readonly = "" ;
	echo "                <input type=\"text\" name=\"Member_Login_Title2\" size=\"20\" value=\"{$LIST['Member_Login_Title2']}\" $tmp_Readonly/>\n";
//	echo "                <a href=\"users.php?sid=86980&agent_id=19996&mode=collect\" class=\"btn_s\">提領</a>\n";
//	echo "                <a href=\"users.php?sid=86980&agent_id=19996&mode=recharge\" class=\"btn_s\">存入</a>\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">登入密碼：</td>\n";
	echo "            <td height=\"14\">\n";
	echo "                <input type=\"password\" name=\"Member_Login_Passwd\" size=\"20\" value=\"\" id=\"Member_Login_Passwd1\" autocomplete=\"off\"/>\n";
	echo "                (密碼必須使用數字或字母而且至少為5 或至多 12 個字元)\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">會員暱稱：</td>\n";
	echo "            <td height=\"15\">\n";
	echo "                <input type=\"text\" name=\"Member_Name\" value=\"{$LIST['Member_Name']}\" >\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">\n";
	echo "                現況餘額：\n";
	echo "            </td>\n";
	echo "            <td height=\"15\">\n";
	echo "                " . (int)$LIST['Member_Money'] . "\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "    </table>\n";
	echo "<div id=\"pointRe\" style=\"display: none\"><a style=\"color:navy;font-weight:bolder;text-decoration:underline;\"><img src=\"images/loading_icon_small.gif\">載入中... </a></div>\n";
	
	echo "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "        <tr>\n";
	echo "            <td height=\"25\" width=\"150\" align=\"left\" style=\"padding-left:10px\">登入狀態：</td>\n";
	echo "            <td height=\"15\"><input type='radio' name='Member_On' value='1' " . checksCheckBox($LIST['Member_On'] , 1) . ">開權　<input type='radio' name='Member_On' value='0'" . checksCheckBox($LIST['Member_On'] , 0) . ">停權</td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">\n";
	echo "                賓果投注狀態：\n";
	echo "            </td>\n";
	echo "            <td height=\"15\">\n";
	echo "                <input type='radio' name='Member_Bingo_On' value='1' " . checksCheckBox($LIST['Member_Bingo_On'] , 1) . ">開權　<input type='radio' name='Member_Bingo_On' value='0'" . checksCheckBox($LIST['Member_Bingo_On'] , 0) . ">停權\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "    </table>\n";
	echo "<p style='color:#f00;text-align:left;margin:3px 10px'>算式：總存入-總提出-餘額=輸贏金額</p>" ;
	echo "</fieldset>\n";


	if( $subFUNCT == "ADDOK" )
	{// 如果為新增代理人資料,取出內定值
		$array_BetLimit = WinHappy_getBetLimit() ;		// 取得內定下注限額
	}
	else
	{// 修改代理人下注限額資料
		$array_BetLimit = func_DatabaseGet( "BetLimit" , "*" , array("BetLimit_Set_ID"=>$LIST['Member_ID']) ) ;		// 取得資料庫資料
	}


	echo "</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "    <td align=\"right\" colspan=\"2\">\n";
	echo "        <p align=\"center\">\n";
	//echo "            <input type=\"image\" src=\"images/enter_save.jpg\" name=\"儲存變更\">\n";

	if( $_SESSION['Agent_Level'] == 1 )
	{	echo "                <a id='addMember'><img  src=\"images/enter_save.jpg\"></a>\n";	}

	echo "    </td>\n";
	echo "</tr>\n";
	
	echo "<tr>\n";
	echo "    <td>\n";

	// 操作記錄
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "    <tr>\n";
	echo "        <td colspan=\"2\">\n";
	echo "            <table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"2\" class='table_list'>\n";
	echo "                <tr>\n";
	echo "                    <td colspan=\"8\">\n";
	echo "                        <font color=\"#CC0000\">\n";
	echo "                            <strong>以下為最近的３０筆轉點記錄：</strong>\n";
	echo "                        </font>\n";
	echo "                    </td>\n";
	echo "                </tr>\n";

	echo "                <tr class=\"table_header\">\n";
	echo "                                <td width=\"80\" height=\"25\" align=\"center\">\n";
	echo "                                    <p align=\"center\">\n";
	echo "                                        <font color=\"#FFFFFF\">\n";
	echo "                                            <b>存入時間</b>\n";
	echo "                                        </font>\n";
	echo "                                    </p>\n";
	echo "                                </td>\n";
	echo "                                <td align=\"center\">\n";
	echo "                                    <p align=\"center\">\n";
	echo "                                        <font color=\"#FFFFFF\">\n";
	echo "                                            <b>存入前點數</b>\n";
	echo "                                        </font>\n";
	echo "                                    </p>\n";
	echo "                                </td>\n";
	echo "                                <td align=\"center\">\n";
	echo "                                    <p align=\"center\">\n";
	echo "                                        <font color=\"#FFFFFF\">\n";
	echo "                                            <b>存入點數</b>\n";
	echo "                                        </font>\n";
	echo "                                    </p>\n";
	echo "                                </td>\n";
	echo "                                <td align=\"center\">\n";
	echo "                                    <strong>操作人員</strong>\n";
	echo "                                </td>\n";
	echo "                                <td width=\"80\" height=\"25\" align=\"center\">\n";
	echo "                                    <p align=\"center\">\n";
	echo "                                        <font color=\"#FFFFFF\">\n";
	echo "                                            <b>提出時間</b>\n";
	echo "                                        </font>\n";
	echo "                                    </p>\n";
	echo "                                </td>\n";
	echo "                                <td align=\"center\">\n";
	echo "                                    <p align=\"center\">\n";
	echo "                                        <font color=\"#FFFFFF\">\n";
	echo "                                            <b>提出前點數</b>\n";
	echo "                                        </font>\n";
	echo "                                    </p>\n";
	echo "                                </td>\n";
	echo "                                <td align=\"center\">\n";
	echo "                                    <p align=\"center\">\n";
	echo "                                        <font color=\"#FFFFFF\">\n";
	echo "                                            <b>提出點數</b>\n";
	echo "                                        </font>\n";
	echo "                                    </p>\n";
	echo "                                </td>\n";
	echo "                                <td align=\"center\">\n";
	echo "                                    <strong>操作人員</strong>\n";
	echo "                                </td>\n";
	echo "                            </tr>\n";
	$SQL_MoneyLog = "SELECT * FROM MoneyLog WHERE MoneyLog_Set_ID = '{$LIST['Member_ID']}' AND ( MoneyLog_Type = '3' OR MoneyLog_Type = '4') ORDER BY MoneyLog_Add_DT DESC " ;
	//$SQL_MoneyLog = "SELECT * FROM MoneyLog  LIMIT 0,30" ;
	//echo $SQL_MoneyLog . "<br>" ; 
	$QUERY_MoneyLog = mysqli_query($link , $SQL_MoneyLog) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY_MoneyLog) )
	{
		$sum_In_MoneyLog_Money = 0 ;						// 提出點數
		$sum_Out_MoneyLog_Money = 0 ;					// 提出點數

		// 一條條獲取
		while ($LIST_MoneyLog = mysqli_fetch_assoc($QUERY_MoneyLog))
		{// unset()
			if( $LIST_MoneyLog['MoneyLog_Type'] == 3 )
			{// 存入
				$tmp_In_MoneyLog_Add_DT = $LIST_MoneyLog['MoneyLog_Add_DT'] ;					// 存入時間
				$tmp_In_MoneyLog_Original_Money = $LIST_MoneyLog['MoneyLog_Original_Money'] ;	// 存入前點數
				$tmp_In_MoneyLog_Money = $LIST_MoneyLog['MoneyLog_Money'] ;						// 存入點數
				$tmp_In_MoneyLog_Operator_Name = $LIST_MoneyLog['MoneyLog_Operator_Name'] ;		// 存入操作人員

				$tmp_Out_MoneyLog_Add_DT = "" ;					// 提出時間
				$tmp_Out_MoneyLog_Original_Money = "" ;			// 提出前點數
				$tmp_Out_MoneyLog_Money = "" ;					// 提出點數
				$tmp_Out_MoneyLog_Operator_Name = "" ;			// 提出操作人員

				$sum_In_MoneyLog_Money += $tmp_In_MoneyLog_Money ;					// 小計存入提出點數
			}
			else
			{// 提出
				$tmp_In_MoneyLog_Add_DT = "" ;				// 存入時間
				$tmp_In_MoneyLog_Original_Money = "" ;		// 存入前點數
				$tmp_In_MoneyLog_Money = "" ;				// 存入點數
				$tmp_In_MoneyLog_Operator_Name = "" ;		// 存入操作人員

				$tmp_Out_MoneyLog_Add_DT = $LIST_MoneyLog['MoneyLog_Add_DT'] ;					// 提出時間
				$tmp_Out_MoneyLog_Original_Money = $LIST_MoneyLog['MoneyLog_Original_Money'] ;	// 提出前點數
				$tmp_Out_MoneyLog_Money = $LIST_MoneyLog['MoneyLog_Money'] ;					// 提出點數
				$tmp_Out_MoneyLog_Operator_Name = $LIST_MoneyLog['MoneyLog_Operator_Name'] ;	// 提出操作人員

				$sum_Out_MoneyLog_Money += $tmp_Out_MoneyLog_Money ;					// 小計提出提出點數
			}
			echo "                            <tr class=\"\">\n";
			echo "                                <td height=\"25\" align=\"center\">$tmp_In_MoneyLog_Add_DT</td>\n";
			echo "                                <td align=\"right\">$tmp_In_MoneyLog_Original_Money</td>\n";
			echo "                                <td align=\"right\">$tmp_In_MoneyLog_Money</td>\n";
			echo "                                <td align=\"right\">$tmp_In_MoneyLog_Operator_Name</td>\n";

			echo "                                <td height=\"25\" align=\"center\">$tmp_Out_MoneyLog_Add_DT</td>\n";
			echo "                                <td align=\"right\">$tmp_Out_MoneyLog_Original_Money</td>\n";
			echo "                                <td align=\"right\">$tmp_Out_MoneyLog_Money</td>\n";
			echo "                                <td align=\"right\">$tmp_Out_MoneyLog_Operator_Name</td>\n";
			echo "                            </tr>\n";
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_MoneyLog);
	}

	// 小計
	echo "                            <tr style='background-color:#eee;'>\n";
	echo "                                <td height=\"25\">小計</td>\n";
	echo "                                <td align=\"right\"></td>\n";
	echo "                                <td align=\"right\">$sum_In_MoneyLog_Money</td>\n";
	echo "                                <td align=\"right\"></td>\n";

	echo "                                <td height=\"25\">小計</td>\n";
	echo "                                <td align=\"right\"></td>\n";
	echo "                                <td align=\"right\">$sum_Out_MoneyLog_Money</td>\n";
	echo "                                <td align=\"right\"></td>\n";
	echo "                            </tr>\n";

	echo "                        </table>\n";
	echo "                    </td>\n";
	echo "                </tr>\n";
	echo "            </table>\n";
	echo "        </td>\n";
	echo "    </tr>\n";
	echo "</table>\n";

	echo "    </td>\n";
	echo "</tr>\n";
	echo "</table>\n";

}

//~@_@~// START 加入資料表單 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
if ( $Funct == "ADD" )
{

//	$array_AgentInfo =  WinHappy_getAgentInfo( $_SESSION['AID'] ) ;		// 取得目前操作的代理人資料
	//echo "<p></p>" ;print_r($array_NowAgent_Info);echo "<br>" ;
	
	// 設定新增代理人資料
	$LIST['Member_Login_Title'] = $array_NowAgent_Info['Agent_Login_Title'] ;		// 帳號開頭
	$LIST['Member_General_Bet_Min'] = 25 ;						// 一般玩法-最小押注金額
	$LIST['Member_Super_Bet_Min'] = 25 ;						// 超級玩法-最小押注金額
	$LIST['Member_On'] = 1 ;									// 登入狀態
	$LIST['Member_Bingo_On'] = 1 ;								// 賓果投注狀態
	//$LIST['Member_Share'] = $array_NowAgent_Info['Agent_Share'] ;	// 佔成比-設成目前操作的代理人資料
	showForm( $LIST , "ADDOK" );
}
//~@_@~// E N D 加入資料表單 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 加入資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
elseif ( $Funct == "ADDOK" )
{
}
//~@_@~// E N D 加入資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 修改資料表單 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
elseif ( $Funct == "MOD" )
{
	$LIST = WinHappy_getMemberInfo( $ID ) ;		// 取得修改代理人資料
	$LIST['Member_Login_Title2'] = WinHappy_getLoginName( $LIST['Member_Login_Name'] ) ;	// 登入名稱
	showForm( $LIST , "MODOK" );
}
//~@_@~// E N D 修改資料表單 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 修改資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
elseif ( $Funct == "MODOK" )
{
}
//~@_@~// E N D 修改資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 刪險資料表單 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
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
//~@_@~// E N D 刪險資料表單 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 刪險資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
elseif ( $Funct == "DELOK" )
{
}
//~@_@~// E N D 刪險資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

echo "</div>\n";
echo "<input type=\"hidden\" name=\"mode\" value=\"edit-save\">\n";
echo "<input type=\"hidden\" name=\"sid\" value=\"86980\">\n";
echo "<input type=\"hidden\" name=\"agent_id\" value=\"19996\">\n";

echo "<input type=\"hidden\" name=\"Funct\" id='Funct' value=\"{$Funct}OK\">\n";
echo "<input type=\"hidden\" name=\"ID\" id='ID' value=\"{$ID}\">\n";
echo "<input type=\"hidden\" name=\"AID\" id='AID' value=\"{$_SESSION['AID']}\">\n";
?>



<script language="javascript">
var toastr_Debug = 0 ;

$img=$("<img src='images/small_loader.gif?"+Math.random()+"'>");

	$('p[id$=_point]').click(function() {
		var game ;
		$("#"+this.id).html($img);
		game = this.id.split("_")[0];
		getPoint(game);
	});
function getPoint(game) {
	var url = "/ajax_get_point.php";
	setTimeout(function(){
		$.ajax({
			type: 'GET',
			url: url,
			data: {game:game,login_name:"c2b1688"},
			dataType: "text",
			success: function (result) {
				var data ;
				switch (result){
					case 'e':
						data = 'e';
						break;
					case null:
					case '':
						data = '$0.00';
						break;
					default:
						data = "$"+result;
				}

				$("#"+game+"_point").html(data);
			},

			timeout:10000,
			error: function(jqXHR, textStatus, errorThrown) {
				if(textStatus==="timeout") {
					//do something on timeout
					$("#"+game+"_point").html(textStatus);
				}
			}
		})
	}, 200);
}


function check() {
	frm = document.form1;
	if (frm.username1.value == '') {
		alert("請輸入會員登入帳號!");
		frm.username1.focus();
		return false;
	}
//        if (frm.password.value == '') {
//            alert("請輸入登入密碼!");
//            frm.username.focus();
//            return false;
//        }
	if (frm.nickname.value == '') {
		alert("請輸入會員暱稱!");
		frm.nickname.focus();
		return false;
	}
	if (frm.password.value != '' && (frm.password.value.length < 5 || frm.password.value.length > 12)) {
		alert("密碼必須使用數字或字母而且至少為 5 或至多 12 個字元");
		return false;
	}
	/*if(frm.credit_amount.value == '' || parseInt(frm.credit_amount.value) == 'NaN') {
	 alert("請輸入交收額度!");
	 return false;
	 }*/
	if (frm.top_amount.value == '' || parseInt(frm.top_amount.value) == 'NaN') {
		alert("請輸入峰頂值!");
		return false;
	}
}
function check_num(obj, val) {
	var v = isNaN(parseInt(obj.value)) ? 0 : parseInt(obj.value);
	if (v > val) {
		alert("最大值不能大於" + val);
		obj.value = val;
	}
}

function check_min_num(obj, val) {
	var v = isNaN(parseInt(obj.value)) ? 0 : parseInt(obj.value);
	if (v < val) {
		alert("最小值不能小於" + val);
		obj.value = val;
	}
}

// 新增會員(click#addMember)
$('#addMember').on('click', function() {
	// type: "GET",
	//  data: [a11="1"],		自行設定參數
	var AID = $("#AID").val();
	//alert("AID : " + AID);
	//return false;
	$.ajax({
		type: 'POST',
		url: 'ajax_addMember.php', 
		data: $("#form1").serialize(),
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
		toastr.error("新增代理失敗");
	});
});
</script>

<?php
// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>

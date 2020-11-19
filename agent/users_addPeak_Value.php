<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "會員資料" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "users_addPeak_Value.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "Type||*" ;		// 目前操作人員類別(Agent:代理人,Member:會員)
$ARRAY_POST_GET_PARA[] = "Member_Peak_Value||*" ;		// 操作金額

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
//unset($_SESSION['Member_ID']);
//echo "<p></p>" ;print_r($_POST);echo "<br>" ;

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

if( $Funct == "Peak_ValueOK" )
{
	if($ID)
	{
		$tmp_MoneyLog_Class = "1" ;
		$array_Info = WinHappy_getMemberInfo( $ID ) ;		// 取得會員資料
		$tmp_MoneyLog_Original_Money = $array_Info['Member_Money'] ;
		$tmp_URL = "users.php?AID=$AID" ;

		$tmpSQL = "UPDATE Member SET Member_Peak_Value = $Member_Peak_Value WHERE id_Member = '$ID'" ;				// 欄位值+1
		//echo $tmpSQL ;
		$Bol = func_DatabaseBase( $tmpSQL , "SQL" , "" , "" ) ;									// 資料庫處理
		if( $Bol )
		{
			toastrMsg( "修改成功" , "S" ) ;		// 秀出toastr訊息
			Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
		}
		else
		{// 存入失敗
			toastrMsg( "{$tmp_Action}金額失敗" , "E" ) ;		// 秀出toastr訊息
		}
	}
}
else
{
	// 取得設定者資料
	if ( $ID )
	{
		$array_Info = WinHappy_getMemberInfo( $ID ) ;
	}

	echo "<input type='hidden' name='Funct' value='Peak_ValueOK'>" ;
	echo "<input type='hidden' name='ID' value='$ID'>" ;
	echo "        <table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "            <tr>\n";
	echo "                <td height=\"55\" colspan=\"2\">\n";
	echo "                    <table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "                        <tr>\n";
	echo "                            <td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
	echo "                            <td width=\"49%\" align=\"left\" class=\"blue_text\">首頁 &gt; 會員列表 &gt; 變更會員峰頂值</td>\n";
	echo "                            <td width=\"50%\" align=\"right\" class=\"blue_text\" style=\"color:#FF0000\">\n";
	echo "                                各層代理如要修改佔成或退水，必須於每日01:00~02:00時段內。\n";
	echo "                            </td>\n";
	echo "                        </tr>\n";
	echo "                        <tr>\n";
	echo "                            <td height=\"14\" colspan=\"3\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
	echo "                        </tr>\n";
	echo "                    </table>\n";
	echo "                </td>\n";
	echo "            </tr>\n";
	echo "            <tr>\n";
	echo "                <td height=\"25\" align=\"left\" style=\"padding-left:10px\">會員登入帳號：</td>\n";
	echo "                <td width=\"86%\" height=\"14\">\n";
	echo "                    <a href=\"users.php?ID={$array_Info['id_Member']}\">{$array_Info['Member_Login_Name']}</a></td>\n";
	echo "            </tr>\n";
	echo "            <tr>\n";
	echo "                <td height=\"25\" align=\"left\" style=\"padding-left:10px\">會員暱稱：</td>\n";
	echo "                <td height=\"15\">{$array_Info['Member_Name']}</td>\n";
	echo "            </tr>\n";
	echo "            <tr style=\"display:none\">\n";
	echo "                <td height=\"25\" align=\"left\" style=\"padding-left:10px\">信用額度：</td>\n";
	echo "                <td height=\"15\">{$array_Info['Member_Money']}</td>\n";
	echo "            </tr>\n";
	echo "            <tr>\n";
	echo "                <td height=\"25\" align=\"left\" style=\"padding-left:10px\">現有點數：</td>\n";
	echo "                <td height=\"15\">" . (int)$array_Info['Member_Money'] . "</td>\n";
	echo "            </tr>\n";
	echo "            <tr>\n";
	echo "                <td width=\"14%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">\n";
	echo "                    峰頂值：\n";
	echo "                </td>\n";
	echo "                <td height=\"15\">\n";
	echo "                    <input name=\"Member_Peak_Value\" type=\"text\" onkeyup=\"this.value=this.value.replace(/[^\d]/g,'')\" size=\"10\"\n";
	echo "                           maxlength=\"8\" value=\"{$array_Info['Member_Peak_Value']}\">&nbsp;(會員當日中獎總金額數超過峰頂值，系統自動暫停該會員的投注權限；如不限制請輸入0)\n";
	echo "                </td>\n";
	echo "            </tr>\n";
	echo "            <tr>\n";
	echo "                <td height=\"55\" align=\"right\" colspan=\"2\">\n";
	echo "                    <p align=\"center\">\n";
	echo "                        <input type=\"image\" src=\"images/enter_save.jpg\" name=\"儲存變更\">\n";
	echo "                </td>\n";
	echo "            </tr>\n";
	echo "        </table>\n";
	echo "\n";
}

// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>
<script language="javascript">
    function check() {
        frm = document.form1;
        if (frm.credit_amount.value == '') {
            alert("請輸入會員峰頂值!");
            frm.amount.focus();
            return false;
        }
        if (frm.top_amount.value == '' || parseInt(frm.top_amount.value) <= 0) {
            alert("請輸入會員峰頂值!");
            return false;
        }
        if (confirm("您確定變更會員的峰頂值嗎？")) {
            return true;
        }
        else return false;
    }
</script>

<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "首頁" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "agents_add.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "Agent_Level||*" ;			// 帳號權限-1||代理人||2||子帳號

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

//echo $array_NowAgent_Info['id_Agent'];

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

// 是否有後台管理權限
if( strlen($_SESSION['SystemUser_ID']) == 10 AND 0 )
{	echo "<p></p>" ;print_r($array_NowAgent_Info);echo "<br>" ;	}

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
	global $array_NowBackWater ;	// 目前操作者代理人退水設定
	global $Agent_Level ;			// 帳號權限
	// 外加變數

	// 麵包屑
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "    <tr>\n";
	echo "        <td height=\"55\" colspan=\"2\">\n";
	echo "            <table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "                <tr>\n";
	echo "                    <td width=\"1%\" align=\"left\">\n";
	echo "                        <img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/>\n";
	echo "                    </td>\n";
	// // 代理人
	if( $Agent_Level == 1 )
	{	echo "                    <td width=\"49%\" align=\"left\" class=\"blue_text\">首頁 &gt; 新增代理資料</td>\n";	}
	else// 
	{	echo "                    <td width=\"49%\" align=\"left\" class=\"blue_text\">首頁 &gt; 新增子帳號資料</td>\n";	}

	echo "                    <td width=\"50%\" align=\"right\" class=\"blue_text\" style=\"color:#FF0000\">\n";
	echo "                        各層代理如要修改佔成或退水，必須於每日00:30~06:30時段內。\n";
	echo "                    </td>\n";
	echo "                </tr>\n";
	echo "                <tr>\n";
	echo "                    <td height=\"14\" colspan=\"3\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
	echo "                </tr>\n";
	echo "            </table>\n";
	echo "        </td>\n";
	echo "    </tr>\n";
	echo "</table>\n";

	$array_AgentList = WinHappy_getAgentList( $_SESSION['AID'] , "N") ;		// 取得所有上線代理人資料
	$array_AgentListN = $array_AgentList["N"] ;
	//$array_AgentListN = array_reverse($array_AgentListN);
	//echo "<p>{$_SESSION['AID']}</p>" ;print_r($array_AgentList);echo "<br>" ;
	$tmp_AgentList = array2str($array_AgentListN , " > ");
	
	// 帳號基本資料
	echo "<fieldset>\n";
	echo "    <legend>&nbsp;帳號基本資料&nbsp;</legend>\n";
	echo "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "        <tr>\n";
	echo "            <td width=\"14%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">層階顯示：</td>\n";
	echo "            <td width=\"86%\" height=\"14\">$tmp_AgentList</td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td width=\"16%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">登入帳號：</td>\n";
	echo "            <td width=\"84%\" height=\"14\">\n";
	echo "                <input type=\"text\" size=\"2\" name=\"Agent_Login_Title\" value=\"{$LIST['Agent_Login_Title']}\" readonly style=\"text-align:center;width:60px; height:22px;\">\n";
	
	$subFUNCT == "MODOK" ? $tmp_Readonly = " readonly" : $tmp_Readonly = "" ;
	echo "                <input type=\"text\" name=\"Agent_Login_Title2\" size=\"20\" value=\"{$LIST['Agent_Login_Title2']}\" autocomplete=\"off\"/ $tmp_Readonly>\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td height=\"25\" align=\"left\">\n";
	echo "                <span id=\"lblUserDesc\" style=\"padding-left:10px\">代理姓名：</span>\n";
	echo "            </td>\n";
	echo "            <td height=\"14\">\n";
	echo "                <input type=\"text\" name=\"Agent_Name\" value=\"{$LIST['Agent_Name']}\">\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">登入密碼：</td>\n";
	echo "            <td height=\"14\">\n";
	echo "                <input type=\"password\" name=\"Agent_Login_Passwd1\" size=\"20\" value=\"\" autocomplete=\"off\"/>(密碼必須使用數字或字母而且至少為\n";
	echo "                5 或至多 12 個字元)\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">驗證密碼：</td>\n";
	echo "            <td height=\"15\">\n";
	echo "                <input type=\"password\" name=\"Agent_Login_Passwd2\" size=\"20\" value=\"\"/>\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	//echo "        <tr style=\"display:none\">\n";
	//echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">現有點數：</td>\n";
	//echo "            <td height=\"15\">\n";
	//echo "                <input type=\"text\" name=\"Agent_Money\" size=\"15\" value=\"0\"/>\n";
	//echo "            </td>\n";
	//echo "        </tr>\n";
	if( $Agent_Level == 1 AND 0 )
	{// 代理人
		echo "        <tr>\n";
		echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">每筆最小押注金額：</td>\n";
		echo "            <td height=\"15\">\n";
		echo "                <input type=\"text\" name=\"Agent_General_Bet_Min\" id=\"Agent_General_Bet_Min\" value=\"{$LIST['Agent_General_Bet_Min']}\" size=\"6\"\n";
		echo "                       onkeyup=\"this.value=this.value.replace(/[^\d]/g,'')\"\n";
		echo "                       onblur=\"check_min_num(this,{$LIST['Agent_General_Bet_Min']})\" class=\"money\"/>(BingoBingo\n";
		echo "                <font style='color:#FF0000'>一般</font>玩法)\n";
		echo "            </td>\n";
		echo "        </tr>\n";
		echo "        <tr>\n";
		echo "            <td width=\"16%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">&nbsp;</td>\n";
		echo "            <td height=\"15\">\n";
		echo "                <input type=\"text\" name=\"Agent_Super_Bet_Min\" id=\"Agent_Super_Bet_Min\" value=\"{$LIST['Agent_Super_Bet_Min']}\" size=\"6\"\n";
		echo "                       onkeyup=\"this.value=this.value.replace(/[^\d]/g,'')\"\n";
		echo "                       onblur=\"check_min_num(this,{$LIST['Agent_Super_Bet_Min']})\" class=\"money\"/>(BingoBingo\n";
		echo "                <font style='color:#FF0000'>超级</font>玩法)\n";
		echo "            </td>\n";
		echo "        </tr>\n";
	}
	echo "    </table>\n";
	echo "</fieldset>\n";
	echo "\n";
	
	if( $subFUNCT == "ADDOK" )
	{// 如果為新增代理人資料,取出內定值
		$array_BetLimit = WinHappy_getBetLimit() ;		// 取得內定下注限額
		$array_BackWater['BackWater_Bingo_Gen_12Start'] = 10 ;	// 賓果一般退水
		$array_BackWater['BackWater_Bingo_Super'] = 1.5 ;	// 賓果超級退水
	}
	else
	{// 修改代理人下注限額資料
		$array_BetLimit = func_DatabaseGet( "BetLimit" , "*" , array("BetLimit_Set_ID"=>$LIST['Agent_ID']) ) ;		// 取得資料庫資料
		$array_BackWater = func_DatabaseGet( "BackWater" , "*" , array("BackWater_Set_ID"=>$LIST['Agent_ID']) ) ;		// 取得資料庫資料
		//BackWater_Bingo_Gen_12Start
		if( !$array_BetLimit['BetLimit_Set_ID'] )
		{// 取出內定值
			$array_BetLimit = WinHappy_getBetLimit() ;		// 取得內定下注限額
		}
	}

	if( $_SESSION['Agent_Level'] == 1 )
	{// 代理人
		// 下級代理設置
		echo "<p></p>\n";
		echo "\n";
		echo "<fieldset>\n";
		echo "<legend>&nbsp;下級代理設置&nbsp;</legend>\n";
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
		echo "<tr>\n";
		echo "    <td width=\"110\" height=\"25\" align=\"left\" style=\"padding-left:10px\">開設下級代理：</td>\n";
		echo "    <td width=\"330\" height=\"25\"><input type='radio' name='Agent_Open_Offline' value='1' " . checksCheckBox($LIST['Agent_Open_Offline'] , 1) . ">開權　<input type='radio' name='Agent_Open_Offline' value='0' " . checksCheckBox($LIST['Agent_Open_Offline'] , 0) . ">停權</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "    <td height=\"25\" align=\"left\" style=\"padding-left:10px\">開設下線會員：</td>\n";
		echo "    <td height=\"25\"><input type='radio' name='Agent_Open_Member' value='1' " . checksCheckBox($LIST['Agent_Open_Member'] , 1) . ">開權　<input type='radio' name='Agent_Open_Member' value='0' " . checksCheckBox($LIST['Agent_Open_Member'] , 0) . ">停權</td>\n";
		echo "</tr>\n";
		echo "<tr height=\"25\">\n";
		echo "    <td colspan=\"2\" style=\"padding-left:10px\">【佔成及水錢相關設定】</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "    <td colspan=\"2\" align=\"left\" valign=\"top\">\n";
		echo "        <table width=\"430\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_list\">\n";
		echo "            <tr height=\"25\">\n";
		echo "                <td style=\"width:120px\" align=\"right\" rowspan=\"2\" bgcolor=\"#ffffff\">調整全部佔成：</td>\n";
		echo "                <td style=\"width:90px\"  align=\"center\">\n";
		echo "                    <input type=\"text\" id=\"resetZ\" size=\"5\">\n";
		echo "                </td>\n";
		echo "                <td style=\"width:120px\" align=\"right\" rowspan=\"2\" bgcolor=\"#ffffff\">調整全部退水：</td>\n";
		echo "                <td style=\"width:90px\"  align=\"center\">\n";
		echo "                    <input type=\"text\" id=\"resetW\" size=\"5\">\n";
		echo "                </td>\n";
		echo "            </tr>\n";
		echo "            <tr height=\"25\">\n";
		echo "                <td height=\"25\" align=\"center\">\n";
		echo "                    <a style=\"color:navy;font-weight: bolder;text-decoration:underline;cursor: pointer;\" id=\"reZ\">\n";
		echo "                        修改\n";
		echo "                    </a>\n";
		echo "                </td>\n";
		echo "                <td height=\"25\" align=\"center\">\n";
		echo "                    <a style=\"color:navy;font-weight: bolder;text-decoration:underline;cursor: pointer;\" id=\"reW\">\n";
		echo "                        修改\n";
		echo "                    </a>\n";
		echo "                </td>\n";
		echo "            </tr>\n";
		echo "            <tr height=\"25\">\n";
		echo "                <td style=\"width:120px\" rowspan=\"2\" align=\"right\">長莊輸贏佔成：</td>\n";
		echo "                <td style=\"width:90px\" rowspan=\"2\" align=\"center\">\n";
		// 長莊輸贏佔成值是否大於上線值
		// 是否有後台管理權限
		if( strlen($_SESSION['SystemUser_ID']) == 10 AND 0 )
		{	echo "代理人長莊輸贏佔成值 : {$LIST['Agent_Share']}<br>" ;	}
		// 長莊輸贏佔成大於上線設定
		if( $LIST['Agent_Share'] > $array_NowAgent_Info['Agent_Share'] )
		{
			// 修改所有大於設定值的下線資料
			$tmpSQL_Agent_Share = "UPDATE Agent SET Agent_Share = '{$array_NowAgent_Info['Agent_Share']}' WHERE Agent_Online_id LIKE '%,{$array_NowAgent_Info['id_Agent']},%' AND Agent_Share > '{$array_NowAgent_Info['Agent_Share']}'" ;	// 修改
			$Bol_Agent_Share = func_DatabaseBase( $tmpSQL_Agent_Share , "SQL" , "" , "" ) ;									// 資料庫處理
			/*if ( $Bol_Agent_Share )
			{	alertgo( "修改所有大於設定值的下線資料-完成" , "" ) ;	}
			else
			{	alertgo( "修改所有大於設定值的下線資料-失敗" , "" ) ;	}*/
		}

		// 退水設定 BackWater-
		echo "                    <select name=\"Agent_Share\" class=\"select_percent\">\n";
		for( $i = (int)$array_NowAgent_Info['Agent_Share'] ; $i >= 0 ; $i-- )
		{
			$LIST['Agent_Share'] == $i ? $tmp_Selected = " selected" : $tmp_Selected = "" ; 
			echo "<option value='$i' $tmp_Selected>$i%</option>\n" ;
		}
		echo "                    </select>\n";
		echo "                </td>\n";
		echo "                <td style=\"width:120px\" height=\"25\" align=\"right\">輪莊-手續費退水：</td>\n";
		echo "                <td style=\"width:90px\" align=\"center\">\n";

		// 長莊輸贏佔成值是否大於上線值
		// 是否有後台管理權限
		if( strlen($_SESSION['SystemUser_ID']) == 10 AND 0)
		{	echo "輪莊-手續費退水 : {$LIST['Agent_Backwater']}<br>" ;	}
		// 長莊輸贏佔成大於上線設定
		if( $LIST['Agent_Backwater'] > $array_NowAgent_Info['Agent_Backwater'] )
		{
			// 修改所有大於設定值的下線資料
			$tmpSQL_Agent_Backwater = "UPDATE Agent SET Agent_Backwater = '{$array_NowAgent_Info['Agent_Backwater']}' WHERE Agent_Online_id LIKE '%,{$array_NowAgent_Info['id_Agent']},%' AND Agent_Backwater > '{$array_NowAgent_Info['Agent_Backwater']}'" ;	// 修改
			$Bol_Agent_Backwater = func_DatabaseBase( $tmpSQL_Agent_Backwater , "SQL" , "" , "" ) ;									// 資料庫處理
			/*if ( $Bol_Agent_Backwater )
			{	alertgo( "修改輪莊-手續費退水-完成" , "" ) ;	}
			else
			{	alertgo( "修改輪莊-手續費退水-失敗" , "" ) ;	}*/
		}

		// 手續費退水 BackWater-
		echo "                    <select name=\"Agent_Backwater\" class=\"select_percent\">\n";
		for( $i = (int)$array_NowAgent_Info['Agent_Backwater'] ; $i >= 0 ; $i-- )
		{
			$LIST['Agent_Backwater'] == $i ? $tmp_Selected = " selected" : $tmp_Selected = "" ; 
			echo "<option value='$i' $tmp_Selected>$i%</option>\n" ;
		}
	
		echo "                    </select>\n";
		echo "                </td>\n";
		echo "            </tr>\n";

		echo "            <tr>\n";
		echo "                <td style=\"width:120px\" height=\"25\" align=\"right\">長莊-手續費退水：</td>\n";
		echo "                <td style=\"width:90px\" align=\"center\">\n";
		// 是否有後台管理權限
		if( strlen($_SESSION['SystemUser_ID']) == 10 AND 0)
		{	echo "長莊-手續費退水 : {$LIST['Agent_Backwater2']}<br>" ;	}
		// 長莊輸贏佔成大於上線設定
		if( $LIST['Agent_Backwater2'] > $array_NowAgent_Info['Agent_Backwater2'] )
		{
			// 修改所有大於設定值的下線資料
			$tmpSQL_Agent_Backwater2 = "UPDATE Agent SET Agent_Backwater2 = '{$array_NowAgent_Info['Agent_Backwater2']}' WHERE Agent_Online_id LIKE '%,{$array_NowAgent_Info['id_Agent']},%' AND Agent_Backwater2 > '{$array_NowAgent_Info['Agent_Backwater2']}'" ;	// 修改
			$Bol_Agent_Backwater2 = func_DatabaseBase( $tmpSQL_Agent_Backwater2 , "SQL" , "" , "" ) ;									// 資料庫處理
			/*if ( $Bol_Agent_Backwater2 )
			{	alertgo( "修改長莊-手續費退水-完成" , "" ) ;	}
			else
			{	alertgo( "修改長莊-手續費退水-失敗" , "" ) ;	}*/
		}
		// 手續費退水 BackWater-
		echo "                    <select name=\"Agent_Backwater2\" class=\"select_percent\">\n";
		for( $i = (int)$array_NowAgent_Info['Agent_Backwater2'] ; $i >= 0 ; $i-- )
		{
			$LIST['Agent_Backwater2'] == $i ? $tmp_Selected = " selected" : $tmp_Selected = "" ; 
			echo "<option value='$i' $tmp_Selected>$i%</option>\n" ;
		}
	
		echo "                    </select>\n";
		echo "                </td>\n";
		echo "            </tr>\n";

		//202001115新增長莊有倍率佔成
        echo "            <tr height=\"25\">\n";
        echo "                <td style=\"width:120px\" align=\"right\">長莊有倍輸贏佔成：</td>\n";
        echo "                <td style=\"width:90px\"  align=\"center\">\n";
        // 長莊輸贏佔成值是否大於上線值
        // 是否有後台管理權限
        if( strlen($_SESSION['SystemUser_ID']) == 10 AND 0 )
        {	echo "代理人長莊輸贏佔成值 : {$LIST['Agent_Share3']}<br>" ;	}
        // 長莊輸贏佔成大於上線設定
        if( $LIST['Agent_Share3'] > $array_NowAgent_Info['Agent_Share3'] )
        {
            // 修改所有大於設定值的下線資料
            $tmpSQL_Agent_Share3 = "UPDATE Agent SET Agent_Share3 = '{$array_NowAgent_Info['Agent_Share3']}' WHERE Agent_Online_id LIKE '%,{$array_NowAgent_Info['id_Agent']},%' AND Agent_Share3 > '{$array_NowAgent_Info['Agent_Share3']}'" ;	// 修改
            $Bol_Agent_Share3 = func_DatabaseBase( $tmpSQL_Agent_Share3 , "SQL" , "" , "" ) ;									// 資料庫處理
            /*if ( $Bol_Agent_Share )
            {	alertgo( "修改所有大於設定值的下線資料-完成" , "" ) ;	}
            else
            {	alertgo( "修改所有大於設定值的下線資料-失敗" , "" ) ;	}*/
        }

        // 退水設定 BackWater-
        echo "                    <select name=\"Agent_Share3\" class=\"select_percent\">\n";
        for( $i = (int)$array_NowAgent_Info['Agent_Share3'] ; $i >= 0 ; $i-- )
        {
            $LIST['Agent_Share3'] == $i ? $tmp_Selected = " selected" : $tmp_Selected = "" ;
            echo "<option value='$i' $tmp_Selected>$i%</option>\n" ;
        }
        echo "                    </select>\n";
        echo "                </td>\n";
        echo "                <td style=\"width:120px\" height=\"25\" align=\"right\">長莊有倍-手續費退水：</td>\n";
        echo "                <td style=\"width:90px\"  align=\"center\">\n";
        // 是否有後台管理權限
        if( strlen($_SESSION['SystemUser_ID']) == 10 AND 0)
        {	echo "長莊-手續費退水 : {$LIST['Agent_Backwater3']}<br>" ;	}
        // 長莊輸贏佔成大於上線設定
        if( $LIST['Agent_Backwater3'] > $array_NowAgent_Info['Agent_Backwater3'] )
        {
            // 修改所有大於設定值的下線資料
            $tmpSQL_Agent_Backwater3 = "UPDATE Agent SET Agent_Backwater3 = '{$array_NowAgent_Info['Agent_Backwater3']}' WHERE Agent_Online_id LIKE '%,{$array_NowAgent_Info['id_Agent']},%' AND Agent_Backwater3 > '{$array_NowAgent_Info['Agent_Backwater3']}'" ;	// 修改
            $Bol_Agent_Backwater3 = func_DatabaseBase( $tmpSQL_Agent_Backwater3 , "SQL" , "" , "" ) ;									// 資料庫處理
            /*if ( $Bol_Agent_Backwater3 )
            {	alertgo( "修改長莊-手續費退水-完成" , "" ) ;	}
            else
            {	alertgo( "修改長莊-手續費退水-失敗" , "" ) ;	}*/
        }
        // 手續費退水 BackWater-
        echo "                    <select name=\"Agent_Backwater3\" class=\"select_percent\">\n";
        for( $i = (int)$array_NowAgent_Info['Agent_Backwater3'] ; $i >= 0 ; $i-- )
        {
            $LIST['Agent_Backwater3'] == $i ? $tmp_Selected = " selected" : $tmp_Selected = "" ;
            echo "<option value='$i' $tmp_Selected>$i%</option>\n" ;
        }

        echo "                    </select>\n";
        echo "                </td>\n";
        echo "            </tr>\n";
	
		echo "        </table>\n";
		echo "    </td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</fieldset>\n";
		echo "\n";
	}
	
	//if($tmp_AgentList=='admin')//控制參數設定開始
	//{
	
	echo "<p></p>\n";
	echo "\n";
	// 長莊區會員超過兩期或多期未下注逞罰規則設定
	echo "<fieldset>\n";
	echo "    <legend>&nbsp;遊戲參數控制&nbsp;</legend>\n";
	echo "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "        <tr>\n";
	echo "            <td width=\"30%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">超過幾期未下注開啟設定：(預設2期)</td>\n";
	echo "            <td width=\"70%\" height=\"14\">\n";
	echo "                <input type=\"text\" size=\"8\" name=\"Over_Period_Set\" value=\"{$LIST['Over_Period_Set']}\" style=\"text-align:center;width:60px; height:22px;\">\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td width=\"30%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">隔幾期才能再下注：(預設1期)</td>\n";
	echo "            <td width=\"70%\" height=\"14\">\n";
	echo "                <input type=\"text\" size=\"8\" name=\"Bet_Again_Period\" value=\"{$LIST['Bet_Again_Period']}\" style=\"text-align:center;width:60px; height:22px;\">\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "    </table>\n";
	echo "</fieldset>\n";
	echo "\n";
	
	//}//控制參數設定結束
	
	// 確定儲存
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
	echo "    <tr>\n";
	echo "        <td height=\"25\" align=\"left\" style=\"padding-left:10px\">&nbsp;</td>\n";
	echo "        <td height=\"15\">&nbsp;</td>\n";
	echo "    </tr>\n";
	echo "    <tr>\n";
	echo "        <td height=\"55\" align=\"right\" colspan=\"2\">\n";
	echo "            <p align=\"center\">\n";
	//echo "                <input type=\"image\" id='addAgent' src=\"images/enter_save.jpg\" value=\"新增代理\">\n";

	if( $_SESSION['Agent_Level'] == 1 )
	{	echo "                <a id='addAgent' data-agent_level='$Agent_Level'><img  src=\"images/enter_save.jpg\"></a>\n";	}

	echo "        </td>\n";
	echo "    </tr>\n";

	echo "    </tr>\n";
	echo "</table>\n";

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
	$SQL_MoneyLog = "SELECT * FROM MoneyLog WHERE MoneyLog_Set_ID = '{$LIST['Agent_ID']}' AND ( MoneyLog_Type = '3' OR MoneyLog_Type = '4') ORDER BY MoneyLog_Add_DT DESC " ;
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
	echo "                                <td height=\"25\" align=\"center\">小計</td>\n";
	echo "                                <td align=\"right\"></td>\n";
	echo "                                <td align=\"right\">$sum_In_MoneyLog_Money</td>\n";
	echo "                                <td align=\"right\"></td>\n";

	echo "                                <td height=\"25\" align=\"center\">小計</td>\n";
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
	echo "</div>\n";
	echo "<input type=\"hidden\" name=\"mode\" value=\"add-save\">\n";
	echo "<input type=\"hidden\" name=\"Funct\" id='Funct' value=\"$subFUNCT\">\n";
	echo "<input type=\"hidden\" name=\"ID\" id='Funct' value=\"{$LIST['id_Agent']}\">\n";
	echo "<input type=\"hidden\" name=\"AID\" id='AID' value=\"{$_SESSION['AID']}\">\n";
	echo "<input type=\"hidden\" name=\"Agent_Level\" id='Agent_Level' value=\"{$Agent_Level}\">\n";
	echo "\n";
}

//~@_@~// START 加入資料表單 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
if ( $Funct == "ADD" )
{

//	$array_AgentInfo =  WinHappy_getAgentInfo( $_SESSION['AID'] ) ;		// 取得目前操作的代理人資料
	//echo "<p></p>" ;print_r($array_NowAgent_Info);echo "<br>" ;
	
	// 設定新增代理人資料
	$LIST['Agent_Login_Title'] = $array_NowAgent_Info['Agent_Login_Title'] ;		// 帳號開頭
	$LIST['Agent_General_Bet_Min'] = 25 ;						// 一般玩法-最小押注金額
	$LIST['Agent_Super_Bet_Min'] = 25 ;							// 超級玩法-最小押注金額
	$LIST['Agent_Open_Offline'] = 1 ;							// 開設下級代理權限
	$LIST['Agent_Open_Member'] = 1 ;							// 開設下線會員權限
	$LIST['Agent_Share'] = $array_NowAgent_Info['Agent_Share'] ;	// 佔成比-設成目前操作的代理人資料
    $LIST['Agent_Share3'] = $array_NowAgent_Info['Agent_Share3'] ;	// 有倍佔成比-設成目前操作的代理人資料
	$LIST['Agent_BackWater'] = $array_NowAgent_Info['Agent_BackWater'] ;	// 輪莊-手續費退水
	$LIST['Agent_BackWater2'] = $array_NowAgent_Info['Agent_BackWater2'] ;	// 長莊-手續費退水
    $LIST['Agent_BackWater3'] = $array_NowAgent_Info['Agent_BackWater3'] ;	// 長莊-手續費退水
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
	$LIST = WinHappy_getAgentInfo( $ID ) ;		// 取得修改代理人資料
	$LIST['Agent_Login_Title2'] = WinHappy_getLoginName( $LIST['Agent_Login_Name'] ) ;	// 登入名稱
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

?>



<script language="javascript">
toastr_Debug = 0 ;

// 調整全部佔成
$(document).on('click', '#reZ', function() {
	change('resetZ');
});
// 調整全部退水
$(document).on('click', '#reW', function() {
	change('resetW');
});

// 調整全部
function change(mode){
	var old_value   = '';
	var new_value   = document.getElementById(mode).value;
	var after_value = '';
 
	var game_list = JSON.parse('["bingo","sport","keno","hg","allbet","og","gg","ttg","qt","laxino","kuma","salon","hill","hy","ebet","haba","leho","super","booongo","wm","wm_tip","bjpk10","dg","dg_tip","xlsports","ameba","evo","ph","k3"]');
	if(mode == 'resetW') {
		game_list.splice(0, 1,'normal', 'superball');
		game_list.splice(3, 1,'normal_keno', 'superball_keno');
	}else{

	}

	if (new_value != '') {
		game_list.forEach(function (list) {
			var type        = mode=='resetZ'?list+'_equity_ratio':'profit_percent_'+list;
			var obj = document.getElementsByName(type)[0];
			old_value = obj.value;
			obj.value = new_value;
			after_value = obj.value;
			if(after_value =='') {
				obj.value = old_value;
			}
		});
	}
}




function check() {
	frm = document.form1;
	if (frm.username1.value == '') {
		alert("請輸入登入帳號!");
		frm.username1.focus();
		return false;
	}
	if (frm.nickname.value == '') {
		alert("請輸入代理姓名!");
		frm.nickname.focus();
		return false;
	}
	if (frm.password.value == '') {
		alert("請輸入登入密碼!");
		frm.password.focus();
		return false;
	}
	if (frm.password.value.length < 5 || frm.password.value.length > 12) {
		alert("密碼必須使用數字或字母而且至少為 5 或至多 12 個字元");
		return false;
	}
	if (frm.password.value != frm.password2.value) {
		alert("密碼驗證失敗!");
		frm.password.focus();
		return false;
	}
	/*if(frm.credit_amount.value == '' || parseInt(frm.credit_amount.value) == 'NaN' || frm.credit_amount.value<=0) {
	 alert("請輸入現有點數!");
	 return false;
	 }*/
	return true;
}
function set_agent_percent() {
	var pcrent = $("#agent_percent").val();
	if (pcrent >= 0)
		if ([
			[ORG_PREV_PERCENT]
		] - pcrent >= 0)
			$("#agent_percent_prev").val([
				[ORG_PREV_PERCENT]
			] - pcrent);
		else
			$("#agent_percent").val([
				[AGENT_PERCENT_PREV]
			]);
	else
		$("#agent_percent").val([
			[AGENT_PERCENT_PREV]
		]);
}

function check_min_num(obj, val) {
	var v = isNaN(parseInt(obj.value)) ? 0 : parseInt(obj.value);
	if (v < val) {
		alert("最小值不能小於" + val);
		obj.value = val;
	}
}

// 新增代理(click#addAgent)
$('#addAgent').on('click', function() {
	// type: "GET",
	//  data: [a11="1"],		自行設定參數
	var AID = $("#AID").val();
	var agent_level = $(this).data("agent_level");
	//alert(AID);
	//return false;
	$.ajax({
		type: 'POST',
		url: 'ajax_addAgent.php', 
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
			if( agent_level == 1 )
			{	var FileName = "agents.php";	}
			else
			{	var FileName = "agent_account.php";	}

			setTimeout(function() {
				location.replace(FileName + "?AID=" + AID);
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

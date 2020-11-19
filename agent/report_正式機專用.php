<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "統計報表" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "report.php" ;			// 設定本程式的檔名
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

$ARRAY_POST_GET_PARA[] = "Report_Start_Date||*" ;	// 開始日期
$ARRAY_POST_GET_PARA[] = "Report_End_Date||*" ;		// 結束日期
$ARRAY_POST_GET_PARA[] = "Report_Start_Hour||*" ;	// 開始小時
$ARRAY_POST_GET_PARA[] = "Report_End_Hour||*" ;		// 結束小時

$ARRAY_POST_GET_PARA[] = "ShowDebug||*" ;		// 除錯莫式
// ShowDebug == WM : 輸贏金額 , BM : 返水 , AM : 總金額 , RM : 報帳金額


include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
//unset($_SESSION['Member_ID']);
//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;

if( $Report_Start_Date AND $Report_End_Date )
{// 直接設日期-不作動作
}
else
{
	$array_SearchDateBlock = WinHappy_getSearchDateBlock( $Funct ) ;		// 取得查詢日期區間
	$Report_Start_Date = $array_SearchDateBlock['Start'] ;
	$Report_End_Date = $array_SearchDateBlock['End'] ;
}

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面
// 載入首頁
include($MAIN_BASE_ADDRESS . "agent/header.php") ;        // 載入首頁

echo "<link rel=\"stylesheet\" href=\"css/report.css\">\n";

echo "<!--script language=\"javascript\" src='/libs/js/jquery.js'></script-->\n";
echo "<script language=\"javascript\" src='js/datepicker.js?v=2017'></script>\n";
echo "<link href=\"css/datepicker.css\" rel=\"stylesheet\" type=\"text/css\"/>\n";
echo "<style type=\"text/css\">\n";
echo "    <!--\n";
echo "    .STYLE2 {\n";
echo "        color: #CC0000;\n";
echo "        font-weight: bold;\n";
echo "        font-size: 14px\n";
echo "    }\n";

echo "    .STYLE4 {\n";
echo "        color: #333399;\n";
echo "        font-weight: bold;\n";
echo "        font-size: 14px\n";
echo "    }\n";

echo "    -->\n";
echo "</style>\n";


echo "<TABLE WIDTH=\"1002\" BORDER=\"0\" CELLSPACING=\"1\" cellpadding=\"0\" bordercolor=\"#000000\" bgcolor=\"#FFFFFF\">\n";
echo "<TBODY>\n";
echo "<TR>\n";
echo "	<TD vAlign=top aling=\"center\">\n";
echo "	<div align=\"center\">\n";
echo "	<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
echo "		<tr>\n";
echo "			<td height=\"55\" colspan=\"2\">\n";
echo "				<table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "					<tr>\n";
echo "						<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "						<td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 統計報表</td>\n";
echo "					</tr>\n";
echo "					<tr>\n";
echo "						<td height=\"14\" colspan=\"2\" align=\"left\" background=\"./img/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "					</tr>\n";
echo "				</table>\n";
echo "			</td>\n";
echo "		</tr>\n";

$array_AgentList = WinHappy_getAgentList( $_SESSION['AID'] , "N" , 0) ;		// 取得所有上線代理人資料
$tmp_AgentList = array2str($array_AgentList["N"] , " > ");

echo "		<tr>\n";
echo "			<td height=\"25\" colspan=\"2\" align=\"left\" style=\"padding-left:10px;color:#cc0000\">根報表  > $tmp_AgentList</td>\n";
echo "		</tr>\n";
echo "		<tr>\n";
echo "			<td height=\"25\" align=\"left\" style=\"padding-left:10px\">\n";
echo "				<form method=\"get\" action=\"report.php\">\n";
echo "					開始日期 <input type=\"text\" id=\"Report_Start_Date\" name=\"Report_Start_Date\" size=\"10\" style=\"height:20px\" value=\"$Report_Start_Date\" readonly>\"";
//echo "					<select name=\"Report_Start_Date\" style=\"height:20px\"><option value=\"00\" selected>00</option><option value=\"01\">01</option><option value=\"02\">02</option><option value=\"03\">03</option><option value=\"04\">04</option><option value=\"05\">05</option><option value=\"06\">06</option><option value=\"07\">07</option><option value=\"08\">08</option><option value=\"09\">09</option><option value=\"10\">10</option><option value=\"11\">11</option><option value=\"12\">12</option><option value=\"13\">13</option><option value=\"14\">14</option><option value=\"15\">15</option><option value=\"16\">16</option><option value=\"17\">17</option><option value=\"18\">18</option><option value=\"19\">19</option><option value=\"20\">20</option><option value=\"21\">21</option><option value=\"22\">22</option><option value=\"23\">23</option></select>:00:00\n";
echo "					<select name=\"Report_Start_Hour\" style=\"height:20px\">\n" ;
if ( empty($Report_Start_Hour) )
{	$Report_Start_Hour = 0 ;	}

for( $i = 0 ; $i <= 23 ; $i++ )
{
	$Report_Start_Hour == $i ? $tmp_select = " selected" : $tmp_select = "" ;
	$tmp_i = sprintf("%02s" , $i) ;
	echo "<option value=\"$i\" $tmp_select>$tmp_i</option>\n" ;
}
echo "</select>:00:00\n";

echo "					~\n";
echo "					結束日期 <input type=\"text\" id=\"Report_End_Date\" name=\"Report_End_Date\" size=\"10\" style=\"height:20px\" value=\"$Report_End_Date\" readonly>\n";

echo "					<select name=\"Report_End_Hour\" style=\"height:20px\">\n";

if ( empty($Report_End_Hour) )
{	$Report_End_Hour = 23 ;	}

for( $i = 0 ; $i <= 23 ; $i++ )
{
	$Report_End_Hour == $i ? $tmp_select = " selected" : $tmp_select = "" ;
	$tmp_i = sprintf("%02s" , $i) ;
	echo "<option value=\"$i\" $tmp_select>$tmp_i</option>\n" ;
}
echo "</select>:59:59　\n" ;

echo "					會員帳號 : <input type=\"text\" name='Member_Login_Name' id=\"Member_Login_Name\" size=\"6\"  value=\"$Member_Login_Name\">　\n";

echo "					<input type=\"submit\" value=\"立即查詢\">\n";
echo "					<input type=\"hidden\" name=\"mode\" value=\"search\">\n";
echo "					<input type=\"hidden\" name=\"self\" value=\"1\">&#160;&#160;<a href=\"agent_report.php\" target=\"_blank\" style=\"display: none;\">舊式報表</a>\n";
echo "				</form>\n";
echo "			</td>\n";
echo "			<td align=\"left\" style=\"padding-right:10px;font-size:18px\"></td>\n";
echo "		</tr>\n";
echo "		<tr>\n";
echo "			<td colspan=\"2\" align=\"left\" style=\"padding: 10px;\">\n";
echo "				<style>\n";
echo "					.waring-msg{ box-sizing: border-box; padding: 15px; background-color: #fcf8e3; border-radius: 10px; line-height: 1.5em;}\n";
echo "				</style>\n";
echo "				<div class=\"waring-msg\">\n";
echo "					注意事項:<br>\n";
echo "					1、【今日】報表部份因批次作業原因會有約30分鐘的延遲<br>\n";
echo "					2、由於每日00:00 ~ 00:20為系統結算時間，該時段內無法查看【昨日】帳務報表！<br>\n";
echo "					3、統計訂單中的【賓果遊戲】 是依據【結算時間】來查詢<br>\n";
//echo "					4、帳務最後更新日期 : 【<a style=\"color: #1B82D2\">2020-04-30 21:12:40</a>】<a style=\"color:navy;font-weight: bolder;text-decoration:underline;cursor: pointer;\" id=\"refresh\" >手動執行</a>\n";
echo "				</div>\n";
echo "			</td>\n";
echo "		</tr>\n";
echo "		<tr>\n";
echo "			<td colspan=\"2\">\n";
echo "				<div class=\"date-set-nav\">\n";
echo "					<span onclick='window.location.href=\"report.php?Funct=today&self=1\"'>今 天</span>\n";
echo "					<span onclick='window.location.href=\"report.php?Funct=yestoday&self=1\"'>昨 天</span>\n";
echo "					<span onclick='window.location.href=\"report.php?Funct=week&self=1\"'>本 周</span>\n";
echo "					<span onclick='window.location.href=\"report.php?Funct=prev_week&self=1\"'>上 周</span>\n";
echo "					<span onclick='window.location.href=\"report.php?Funct=month&self=1\"'>本 月</span>\n";
echo "					<span onclick='window.location.href=\"report.php?Funct=prev_month&self=1\"'>上 月</span>\n";
echo "				</div>\n";
echo "			</td>\n";
echo "		</tr>\n";

echo "		<tr>\n";
echo "			<td height=\"20\" colspan=\"2\" align=\"center\" style=\"padding-left:10px;height:20px\">\n";
echo "				<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list\">\n";
echo "					<tr class=\"table_header\">\n";
echo "						<td width=\"6%\" height=\"20\" align=\"center\"><b>級別</b></td>\n";
echo "						<td width=\"8%\" height=\"20\" align=\"center\"><b>名稱</b></td>\n";
echo "						<td width=\"8%\" height=\"20\" align=\"center\"><b>帳戶</b></td>\n";
echo "						<td width=\"11%\" height=\"20\" colspan=\"2\" align=\"center\"><b>投注金額</b></td>\n";
echo "						<td width=\"10%\" height=\"20\" align=\"center\"><b>輸贏金額</b></td>\n";
echo "						<td width=\"8%\" height=\"20\" align=\"center\"><b>會員返水</b></td>\n";
echo "						<td width=\"10%\" height=\"20\" align=\"center\"><b>總金額</b></td>\n";
echo "						<td width=\"4%\" align=\"center\">占成/退水</td>\n";
echo "						<td width=\"3%\" height=\"20\" align=\"center\"><b>報帳金額</b></td>\n";
echo "						<td width=\"10%\" height=\"20\" align=\"center\"><b>查看明細</b></td>\n";
echo "					</tr>\n";

// 設定查詢小時資料
$tmp_Report_Start_Hour = sprintf("%02s" , $Report_Start_Hour) ; ;
$tmp_Report_End_Hour = sprintf("%02s" , $Report_End_Hour) ; ;

if( $Funct == "today" OR $Funct == "yestoday" OR $Funct == "week" OR $Funct == "prev_week" OR $Funct == "month" OR $Funct == "prev_month" )
{	$Funct = "Self" ;}

// 統計結果
$all_BetGodnine_Money = 0 ;					// 投注金額
$all_BetGodnine_WinLost_AllMoney = 0 ;			// 輸贏金額
$all_BetGodnine_Online_Backwater_Money = 0 ;	// 會員返水
$all_BetGodnine_Online_WinLost_Money = 0 ;		// 總金額
$all_BetGodnine_Online_Reported_Money = 0 ;	//報帳金額

// 列出代理人資料
if( $Funct == "Self" )
{	$SQL_Agent = "SELECT * FROM Agent WHERE Agent_ID = '{$array_Agent_Info['Agent_ID']}' AND Agent_Level = '1'" ;	}
else
{	$SQL_Agent = "SELECT * FROM Agent WHERE Agent_Father_ID = '{$_SESSION['AAgent_ID']}' AND Agent_Level = '1'" ;	}

//echo "列出代理人資料 : $SQL_Agent <br>" ; 
$QUERY_Agent = mysqli_query($link , $SQL_Agent) ;

// 是否有資料
if ( mysqli_num_rows($QUERY_Agent) )
{
	$tmp_Index= 0 ;
    // 一條條獲取
    while ($LIST_Agent = mysqli_fetch_assoc($QUERY_Agent))
    {
		// 取出代理人退水設定
		//$array_BackWater_Info = func_DatabaseGet( "BackWater" , "*" , array("BackWater_Set_ID"=>$LIST_Agent['Agent_ID']) ) ;		// 取得資料庫資料
		// 合計-輪莊區
		$sum_BetGodnine_Money = 0 ;					// 投注金額
		$sum_BetGodnine_Online_AllMoney = 0 ;			// 輸贏金額
		$sum_BetGodnine_Online_Backwater_Money = 0 ;	// 會員返水
		$sum_BetGodnine_Online_WinLost_Money = 0 ;		// 總金額
		$sum_BetGodnine_Online_Reported_Money = 0 ;	//報帳金額

		
		//echo "代理人名稱 : {$LIST_Agent['Agent_Name']}<br>" ;
		
		// SELECT sum(MoneyLog_Money) as MoneyLog_Money_Total FROM MoneyLog WHERE MoneyLog_Set_ID = 'Member2009070001'
		
		// 找出上線id或莊家上線id有代理人的下注資料
		$tmp_SQL_BetGodnine = "SELECT * FROM BetGodnine WHERE ( BetGodnine_Online_id LIKE '%,{$LIST_Agent['id_Agent']},%' OR BetGodnine_Banker_Online_id LIKE '%,{$LIST_Agent['id_Agent']},%' ) AND BetGodnine_Add_DT >= '$Report_Start_Date {$tmp_Report_Start_Hour}:00:00' AND BetGodnine_Add_DT <= '$Report_End_Date {$tmp_Report_End_Hour}:59:59' AND BetGodnine_On = '1'" ;
		
		$array_BetGodnineMoney = GodNine_getBetGodnineMoney( $tmp_SQL_BetGodnine , $LIST_Agent['id_Agent'] ) ;		// 取得下注相關金額
		//echo "代理人id : {$LIST_Agent['id_Agent']}<br>" ;
		//echo "<p>取得代理人下注相關金額 , 代理人 : {$LIST_Agent['Agent_Name']}</p>" ;print_r($array_BetGodnineMoney);echo "<br>" ;
		if( $array_BetGodnineMoney['BetGodnine_Num'] <= 0 )
		{	continue;	}
		//echo "{$array_BetGodnineMoney['BetGodnine_Num']} - 是否有下注資料 : $tmp_SQL_BetGodnine<br>" ;

		// 合計-輪莊區
		// 投注金額
		$sum_BetGodnine_Money += $array_BetGodnineMoney[1]['BetGodnine_Money'] ;
		// 輸贏金額
		$sum_BetGodnine_Online_WinLost_Money += $array_BetGodnineMoney[1]['BetGodnine_Online_WinLost_Money'] ;
		// 會員返水
		$sum_BetGodnine_Online_Backwater_Money += $array_BetGodnineMoney[1]['BetGodnine_Online_Backwater_Money'] ;
		// 總金額
		$sum_BetGodnine_Online_AllMoney += $array_BetGodnineMoney[1]['BetGodnine_Online_AllMoney'] ;
		// 報帳金額
		$sum_BetGodnine_Online_Reported_Money += $array_BetGodnineMoney[1]['BetGodnine_Online_Reported_Money'] ;
		
		// 合計-長莊區
		// 投注金額
		$sum_BetGodnine_Money += $array_BetGodnineMoney[2]['BetGodnine_Money'] ;
		// 輸贏金額
		$sum_BetGodnine_Online_WinLost_Money += $array_BetGodnineMoney[2]['BetGodnine_Online_WinLost_Money'] ;
		// 會員返水
		$sum_BetGodnine_Online_Backwater_Money += $array_BetGodnineMoney[2]['BetGodnine_Online_Backwater_Money'] ;
		// 總金額
		$sum_BetGodnine_Online_AllMoney += $array_BetGodnineMoney[2]['BetGodnine_Online_AllMoney'] ;
		// 報帳金額
		$sum_BetGodnine_Online_Reported_Money += $array_BetGodnineMoney[2]['BetGodnine_Online_Reported_Money'] ;

		// 結果
		$all_BetGodnine_Money += $sum_BetGodnine_Money ;					// 投注金額
		$all_BetGodnine_WinLost_AllMoney += $sum_BetGodnine_Online_AllMoney ;			// 輸贏金額
		$all_BetGodnine_Online_Backwater_Money += $sum_BetGodnine_Online_Backwater_Money ;	// 會員返水
		$all_BetGodnine_Online_WinLost_Money += $sum_BetGodnine_Online_WinLost_Money ;		// 總金額
		$all_BetGodnine_Online_Reported_Money += $sum_BetGodnine_Online_Reported_Money ;	//報帳金額

		GodNine_htmlReportInfo("Agent") ;		// 秀出報表內容
		$tmp_Index++ ;
    }
    
    // 釋放結果集合
    mysqli_free_result($QUERY_Agent);
}

// 列出直屬會員資料 echo "{$_SESSION['AID']}<br>" ;
if( $Funct != "Self" )
{
	$SQL_Member = "SELECT * FROM Member WHERE Member_Father_ID = '{$_SESSION['AAgent_ID']}'" ;

	//echo $SQL_Member . "$Funct<br>" ;
	$QUERY_Member = mysqli_query($link , $SQL_Member) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY_Member) )
	{
	
		// 一條條獲取
		while ($LIST_Member = mysqli_fetch_assoc($QUERY_Member))
		{
			// 取出代理人退水設定
			//$array_BackWater_Info = func_DatabaseGet( "BackWater" , "*" , array("BackWater_Set_ID"=>$LIST_Member['Agent_ID']) ) ;		// 取得資料庫資料
			// 合計
			$sum_BetGodnine_Money = 0 ;					// 投注金額
			$sum_BetGodnine_Online_AllMoney = 0 ;			// 輸贏金額
			$sum_BetGodnine_Online_Backwater_Money = 0 ;	// 會員返水
			$sum_BetGodnine_Online_WinLost_Money = 0 ;		// 總金額
			$sum_BetGodnine_Online_Reported_Money = 0 ;	//報帳金額
	
			//echo "代理人名稱 : {$LIST_Agent['Agent_Name']}<br>" ;
			// 是否有下注資料
	
			// 找出會員資料
			$tmp_SQL_BetGodnine = "SELECT * FROM BetGodnine WHERE ( BetGodnine_Member_ID = '{$LIST_Member['Member_ID']}' OR BetGodnine_Banker_ID = '{$LIST_Member['Member_ID']}' ) AND BetGodnine_Add_DT >= '$Report_Start_Date {$tmp_Report_Start_Hour}:00:00' AND BetGodnine_Add_DT <= '$Report_End_Date {$tmp_Report_End_Hour}:59:59' AND BetGodnine_On = '1'" ;
			
			$array_BetGodnineMoney = GodNine_getBetGodnineMoney( $tmp_SQL_BetGodnine , $LIST_Member['Member_ID'] ) ;		// 取得下注相關金額
			//echo "{$LIST_Agent['id_Agent']}<br>" ;
			if( $array_BetGodnineMoney['BetGodnine_Num'] <= 0 )
			{	continue;	}
			//echo "<p>取得會員下注相關金額 , 會員 : {$LIST_Member['Member_Name']}</p>" ;print_r($array_BetGodnineMoney);echo "<br>" ;
			//echo "{$array_BetGodnineMoney['BetGodnine_Num']} - 是否有下注資料 : $tmp_SQL_BetGodnine<br>" ;
	
			// 輪莊區合計
			// 投注金額
			$sum_BetGodnine_Money += $array_BetGodnineMoney[1]['BetGodnine_Money'] ;
			// 輸贏金額
			$sum_BetGodnine_Online_WinLost_Money += $array_BetGodnineMoney[1]['BetGodnine_Online_WinLost_Money'] ;
			// 會員返水
			$sum_BetGodnine_Online_Backwater_Money += $array_BetGodnineMoney[1]['BetGodnine_Online_Backwater_Money'] ;
			// 總金額		
			$sum_BetGodnine_Online_AllMoney += $array_BetGodnineMoney[1]['BetGodnine_Online_AllMoney'] ;
			// 報帳金額		
			$sum_BetGodnine_Online_Reported_Money += $array_BetGodnineMoney[1]['BetGodnine_Online_Reported_Money'] ;
			
			// 長莊區合計
			// 投注金額
			$sum_BetGodnine_Money += $array_BetGodnineMoney[2]['BetGodnine_Money'] ;
			// 輸贏金額
			$sum_BetGodnine_Online_WinLost_Money += $array_BetGodnineMoney[2]['BetGodnine_Online_WinLost_Money'] ;
			// 會員返水
			$sum_BetGodnine_Online_Backwater_Money += $array_BetGodnineMoney[2]['BetGodnine_Online_Backwater_Money'] ;
			// 總金額
			$sum_BetGodnine_Online_AllMoney += $array_BetGodnineMoney[2]['BetGodnine_Online_AllMoney'] ;
			// 報帳金額
			$sum_BetGodnine_Online_Reported_Money += $array_BetGodnineMoney[2]['BetGodnine_Online_Reported_Money'] ;
	
			// 輪莊區結果
			$all_BetGodnine_Money += $sum_BetGodnine_Money ;					// 投注金額
			$all_BetGodnine_Online_WinLost_Money += $sum_BetGodnine_Online_WinLost_Money ;		// 輸贏金額
			$all_BetGodnine_Online_Backwater_Money += $sum_BetGodnine_Online_Backwater_Money ;	// 會員返水
			$all_BetGodnine_WinLost_AllMoney += $sum_BetGodnine_Online_AllMoney ;			// 總金額
			$all_BetGodnine_Online_Reported_Money += $sum_BetGodnine_Online_Reported_Money ;	//報帳金額
	
			// 找出會員代理人資料
			$array_AgentReport_Info = WinHappy_getAgentInfo( $LIST_Member['Member_Father_ID'] ) ;		// 取得代理人資料
			//echo "<p>找出會員代理人資料</p>" ;print_r($array_AgentReport_Info);echo "<br>" ;
			
			GodNine_htmlReportInfo( "Member" ) ;		// 秀出報表內容
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY_Agent);
	}
}


// 結果
echo "					<tr class=\"[[DATA.class]]\">\n";
echo "						<td colspan=\"3\" align=\"right\" bgcolor=\"#EFF979\"><strong><span class=\"STYLE1\">結果：</span></strong></td>\n";
echo "						<td colspan=\"2\" align=\"right\" bgcolor=\"#EFF979\"><strong>" . WinHappy_setMoneyCss( $all_BetGodnine_Money ) . "</strong></td>\n";
echo "						<td align=\"right\" bgcolor=\"#EFF979\"><strong>" . WinHappy_setMoneyCss( $all_BetGodnine_Online_WinLost_Money ) . "</strong></td>\n";
echo "						<td align=\"right\" bgcolor=\"#EFF979\" style='color:#006600'><strong>" . WinHappy_setMoneyCss( $all_BetGodnine_Online_Backwater_Money ) . "</strong></td>\n";
echo "						<td align=\"right\" bgcolor=\"#EFF979\"><strong>" . WinHappy_setMoneyCss( $all_BetGodnine_WinLost_AllMoney ) . "</strong></td>\n";
echo "						<td align=\"right\" bgcolor=\"#EFF979\">&nbsp;</td>\n";
echo "						<td align=\"right\" bgcolor=\"#EFF979\"><strong>" . WinHappy_setMoneyCss( func_Digital_Carry( $all_BetGodnine_Online_Reported_Money , 2 , "round" ) ) . "</strong></td>\n";
echo "						<td align=\"center\" bgcolor=\"#EFF979\">&nbsp;</td>\n";
echo "					</tr>\n";
echo "				</table>\n";
echo "			</td>\n";
echo "		</tr>\n";
//echo "		<tr>\n";
//echo "			<td colspan=\"2\" style=\"padding-top:20px\">\n";
//echo "				快速查詢   &nbsp;&nbsp;&nbsp;&nbsp;       \n";
//echo "			</td>\n";
//echo "		</tr>\n";
echo "		<tr>\n";
echo "			<td height=\"14\" colspan=\"2\" align=\"center\" background=\"images/bgx3.jpg\"></td>\n";
echo "		</tr>\n";
echo "		<tr>\n";
echo "			<td colspan=\"2\" style='color:#cc0000;height:40px'>\n";
echo "				本系統此報表只保留兩個月的數據！\n";
echo "			</td>\n";
echo "		</tr>\n";
echo "	</table>\n";
echo "</div>\n";

?>

<script language='javascript'>
    $(function () {
        $('#Report_Start_Date').DatePicker({
            format: 'Y-m-d',
            date: $('#Report_Start_Date').val(),
            current: $('#Report_Start_Date').val(),
            starts: 1,
            position: 'right',
            onBeforeShow: function () {
                $('#Report_Start_Date').DatePickerSetDate($('#Report_Start_Date').val(), true);
            },
            onChange: function (formated, dates) {
                $('#Report_Start_Date').val(formated);
                $('#Report_Start_Date').DatePickerHide();
            }
        });
        $('#Report_End_Date').DatePicker({
            format: 'Y-m-d',
            date: $('#Report_End_Date').val(),
            current: $('#Report_End_Date').val(),
            starts: 1,
            position: 'right',
            onBeforeShow: function () {
                $('#Report_End_Date').DatePickerSetDate($('#Report_End_Date').val(), true);
            },
            onChange: function (formated, dates) {
                $('#Report_End_Date').val(formated);
                $('#Report_End_Date').DatePickerHide();
            }
        });

    });

    $(refresh).click(function(){
        $.ajax({
            url: 'report.php?mode=refresh',
            type: 'GET',
            dataType: 'html',
            timeout: 20000,
            data: '',
            error: function () {
                //alert('載入開獎頁面時發生逾時錯誤，請按重新整理頁面！');
            },
            success: function (data) {
                location.reload();
            }
        });
    });

</script>
<?php
// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>

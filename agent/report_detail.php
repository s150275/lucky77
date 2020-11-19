<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "訂單查詢" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "report_detail.php" ;			// 設定本程式的檔名
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

$ARRAY_POST_GET_PARA[] = "Report_Start_Date||*" ;	// 開始日期
$ARRAY_POST_GET_PARA[] = "Report_End_Date||*" ;		// 結束日期
$ARRAY_POST_GET_PARA[] = "Report_Start_Hour||*" ;	// 開始小時
$ARRAY_POST_GET_PARA[] = "Report_End_Hour||*" ;		// 結束小時

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

//if( $Report_Start_Date AND $Report_End_Date )
//{// 直接設日期-不作動作
//}
//else if( $Funct == "yestoday" )
//{// 昨 天
//	$array_StartEndDate = func_getStartEndDate( "LD" , 0 , date("Y-m-d") ) ;		// 取得開始結束日期(包含時間) ;
//	$Report_Start_Date = $array_StartEndDate['Start'] ;
//	$Report_End_Date = $array_StartEndDate['End'] ;
//}
//else if( $Funct == "week" )
//{// 本 周
//	$array_StartEndDate = func_getStartEndDate( "W" , 0 , date("Y-m-d") ) ;		// 取得開始結束日期(包含時間) ;
//	$Report_Start_Date = $array_StartEndDate['Start'] ;
//	$Report_End_Date = $array_StartEndDate['End'] ;
//}
//else if( $Funct == "prev_week" )
//{// 上 周
//	$array_StartEndDate = func_getStartEndDate( "LW" , 0 , date("Y-m-d") ) ;		// 取得開始結束日期(包含時間) ;
//	$Report_Start_Date = $array_StartEndDate['Start'] ;
//	$Report_End_Date = $array_StartEndDate['End'] ;
//}
//else if( $Funct == "month" )
//{// 本 月
//	$array_StartEndDate = func_getStartEndDate( "M" , 0 , date("Y-m-d") ) ;		// 取得開始結束日期(包含時間) ;
//	$Report_Start_Date = $array_StartEndDate['Start'] ;
//	$Report_End_Date = $array_StartEndDate['End'] ;
//}
//else if( $Funct == "prev_month" )
//{// 上 月
//	$array_StartEndDate = func_getStartEndDate( "LM" , 0 , date("Y-m-d") ) ;		// 取得開始結束日期(包含時間) ;
//	$Report_Start_Date = $array_StartEndDate['Start'] ;
//	$Report_End_Date = $array_StartEndDate['End'] ;
//}
//else
//{// 今 天
//	$Report_Start_Date = date("Y-m-d") ;
//	$Report_End_Date = date("Y-m-d") ;
//}

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面

// 輸贏狀態 0||未開獎||1||閒家贏||2||莊家贏:
$array_BetGodnine_WinLost_Type[0] = "未開獎" ;
$array_BetGodnine_WinLost_Type[1] = "閒家贏" ;
$array_BetGodnine_WinLost_Type[2] = "莊家贏" ;

// 載入首頁
include($MAIN_BASE_ADDRESS . "agent/header.php") ;        // 載入首頁

echo "<!--script language=\"javascript\" src='../libs/js/jquery.js'></script-->\n";
echo "<script language=\"javascript\" src='js/datepicker.js?v=2017'></script>\n";
echo "<style type=\"text/css\">\n";
echo "    <!--\n";
echo "    .STYLE2 {\n";
echo "        color: #CC0000;\n";
echo "        font-weight: bold;\n";
echo "        font-size: 14px\n";
echo "    }\n";
echo "\n";
echo "    .STYLE4 {\n";
echo "        color: #333399;\n";
echo "        font-weight: bold;\n";
echo "        font-size: 14px\n";
echo "    }\n";
echo "\n";
echo "    -->\n";
echo "</style>\n";
echo "<link rel=\"stylesheet\" href=\"css/report.css\">\n";
echo "<script language=\"javascript\" src='../js/datepicker.js'></script>\n";
echo "\n";

echo "<TABLE WIDTH=\"1002\" BORDER=\"0\" CELLSPACING=\"1\" cellpadding=\"0\" bordercolor=\"#000000\"\n";
echo "	   bgcolor=\"#FFFFFF\">\n";
echo "	<TBODY>\n";
echo "	<TR>\n";
echo "		<TD vAlign=top aling=\"center\"><link href=\"css/datepicker.css\" rel=\"stylesheet\" type=\"text/css\"/>\n";

echo "	<div align=\"center\">\n";
echo "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
echo "        <tr>\n";
echo "            <td height=\"55\">\n";
echo "                <table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "                    <tr>\n";
echo "                        <td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "                        <td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 統計報表明細</td>\n";
echo "                    </tr>\n";
echo "                    <tr>\n";
echo "                        <td height=\"14\" colspan=\"2\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "                    </tr>\n";
echo "                </table>\n";
echo "            </td>\n";
echo "        </tr>\n";
echo "        <tr>\n";
echo "            <td style=\"padding-top:20px\">快速查詢 (指定時間段查詢股東統計報表)\n";
echo "            </td>\n";
echo "        </tr>\n";

echo "        <tr>\n";
echo "            <td align=\"center\">\n";

echo "			<div class=\"date-set-nav\">\n";
echo "					<span onclick='window.location.href=\"report_detail.php?Funct=today&self=1\"'>今 天</span>\n";
echo "					<span onclick='window.location.href=\"report_detail.php?Funct=yestoday&self=1\"'>昨 天</span>\n";
echo "					<span onclick='window.location.href=\"report_detail.php?Funct=week&self=1\"'>本 周</span>\n";
echo "					<span onclick='window.location.href=\"report_detail.php?Funct=prev_week&self=1\"'>上 周</span>\n";
echo "					<span onclick='window.location.href=\"report_detail.php?Funct=month&self=1\"'>本 月</span>\n";
echo "					<span onclick='window.location.href=\"report_detail.php?Funct=prev_month&self=1\"'>上 月</span>\n";
echo "			</div>\n";

echo "			<div>\n";
echo "				<div style=\"width: 20%\"></div>\n";
echo "				<div style=\"width: 60%\" align=\"left\">\n";
echo "				<form action=\"?\">\n";
echo "					起始時間 : <input type=\"text\" id=\"s\" name=\"Report_Start_Date\"  value=\"$Report_Start_Date 00:00:00\" size=\"16\" readonly> ~\n";
echo "					結束時間 : <input type=\"text\" id=\"e\" name=\"Report_End_Date\"  value=\"$Report_End_Date 23:59:59\"   size=\"16\" readonly>\n";
echo "					<br>\n";
echo "					會員帳號 : <input type=\"text\" id=\"username\" name=\"username\"  value=\"\"   size=\"16\" >\n";
echo "					<br>\n";
echo "					<div align=\"center\">\n";
echo "					<input type=\"submit\" value=\"查詢\" >&nbsp;&nbsp;\n";
echo "					全部注單<input type=\"checkbox\"   name=\"getAll\">\n";
echo "					<input type=\"hidden\" name=\"game_type\" value=\"bingo\">\n";
echo "					</div>\n";
echo "				</form>\n";
echo "				</div>\n";
echo "				<div style=\"width: 20%\"></div>\n";
echo "			</div>\n";

echo "            </td>\n";
echo "        </tr>\n";
echo "        <tr>\n";
echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px;color:#cc0000\">根報表 </td>\n";
echo "        </tr>\n";
//echo "        <tr>\n";
//echo "            <td height=\"25\" align=\"left\" style=\"padding-left:10px\">\n";
//echo "                統計時間：<font color='#cc0000'>2020-04-30 00:00:00</font> ~ <font color='#cc0000'>2020-04-30 23:59:59&nbsp;本系統此報表只保留兩個月的數據！</font>\n";
//echo "        </tr>\n";
echo "        <tr>\n";
echo "            <td height=\"20\" align=\"center\" style=\"padding-left:10px;height:20px\">\n";
echo "                <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list2\">\n";
echo "                    <tr class=\"table_header\">\n";
echo "                        <td width=\"80\" align=\"center\"><b>投注單號</b></td>\n";
echo "                        <td width=\"75\" align=\"center\"><b>會員<br>名稱</b></td>\n";
echo "                        <td width=\"50\" align=\"center\"><b>投注期數</b></td>\n";
echo "                        <td width=\"75\" align=\"center\"><b>房間<br>類別</b></td>\n";
//echo "                        <td width=\"140\" align=\"center\"><b>投注球號</b></td>\n";
echo "                        <td width=\"140\" align=\"center\"><b>投注桌次</b></td>\n";
echo "                        <td width=\"140\" align=\"center\"><b>開獎號碼</b></td>\n";
echo "                        <td width=\"140\" align=\"center\"><b>莊家桌次</b></td>\n";
echo "                        <td width=\"140\" align=\"center\"><b>莊家開獎號碼</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>投注<br>金額</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>中獎<br>金額</b></td>\n";
echo "                        <td width=\"140\" align=\"center\"><b>中獎<br>類別</b></td>\n";
echo "                        <td width=\"150\" align=\"center\"><b>押注<br>時間</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>輸嬴<br>金額</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>會員<br>返水</b></td>\n";
echo "                        <!--<td width=\"60\" align=\"center\"><b>代理<br>占成比</b></td>-->\n";
echo "                        <td width=\"90\" align=\"center\"><b>總金額</b></td>\n";
echo "                    </tr>\n";

$PUBLIC_DB_PAGE_NUM = 300 ;

$row = $PUBLIC_DB_PAGE_NUM ;

if((!$Funct)&&(!$Report_Start_Date)&&(!$Report_End_Date))
{
	//echo $Report_Start_Date;
	$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
	$now_peroid = "AND BetGodnine_Bingo_Period=".$array_BingoPeriod['NowBingo'];
}


// 設定查詢時間
$tmp_SQL = " AND BetGodnine_Add_DT >= '$Report_Start_Date 00:00:00' AND BetGodnine_Add_DT <= '$Report_End_Date 23:59:59' $now_peroid" ;
$tmp_Join = " LEFT JOIN Member ON Member.Member_ID = BetGodnine.BetGodnine_Member_ID " ;
//$tmp_Order = " ORDER BY BetGodnine_Member_ID , BetGodnine_Bingo_Period DESC , BetGodnine_Add_DT DESC" ;
$tmp_Order = " ORDER BY BetGodnine_Add_DT DESC" ;

//echo $tmp_SQL;

if( $MID )
{// 找出會員資料
	$array_Member_Info = WinHappy_getMemberInfo( $MID ) ;		// 取得會員資料
	$SQL_BetGodnine = "SELECT * FROM BetGodnine $tmp_Join WHERE ( BetGodnine_Member_ID = '{$array_Member_Info['Member_ID']}' OR BetGodnine_Banker_ID = '{$array_Member_Info['Member_ID']}' ) AND BetGodnine_On = '1' $tmp_SQL $tmp_Order" ;
	//echo "<p></p>" ;print_r($array_Member_Info);echo "<br>" ;
}
else
{// 沒有設定會員ID則以代理人ID為主
	$SQL_BetGodnine = "SELECT * FROM BetGodnine $tmp_Join WHERE BetGodnine_Online_id LIKE '%,{$_SESSION['AID']},%' AND BetGodnine_On = '1' $tmp_SQL $tmp_Order" ;
}
// 找出總筆數
$result = mysqli_query($link , $SQL_BetGodnine);  
//查詢時返回查詢到數據行數：mysqli_num_rows
$total = mysqli_num_rows($result);
$totalpage = ceil( $total / $PUBLIC_DB_PAGE_NUM );	// 取得總頁數
include_once("../includes/database/database_page.php");		// 計算資料庫筆數
$start = ($page-1) * $row;

$SQL_BetGodnine = $SQL_BetGodnine . " LIMIT $start , $row";

//if( strlen($_SESSION['SystemUser_ID']) == 10 )
//{echo $SQL_BetGodnine . "<br>" ; }

//echo $SQL_BetGodnine . "<br>" ; 
$QUERY_BetGodnine = mysqli_query($link , $SQL_BetGodnine) ;

$sum_BetGodnine_Chips = 0 ;						// 投注金額
$sum_BetGodnine_WinLost_Money = 0 ;				// 中獎金額
$sum_BetGodnine_Member_WinLost_Money = 0 ;		// 輸嬴金額
$sum_BetGodnine_Member_Backwater_Money = 0 ;	// 會員返水
$sum_BetGodnine_Member_WinLost_AllMoney = 0 ;	// 總金額

//所有桌資訊
$Table=array(array("Id"=>0,"Name"=>"A桌","Set"=>"1,2"),array("Id"=>1,"Name"=>"B桌","Set"=>"3,4"),array("Id"=>2,"Name"=>"C桌","Set"=>"5,6"),array("Id"=>3,"Name"=>"D桌","Set"=>"7,8"),array("Id"=>4,"Name"=>"E桌","Set"=>"9,10"),array("Id"=>5,"Name"=>"F桌","Set"=>"11,12"),array("Id"=>6,"Name"=>"G桌","Set"=>"13,14"),array("Id"=>7,"Name"=>"H桌","Set"=>"15,16"),array("Id"=>8,"Name"=>"I桌","Set"=>"17,18"),array("Id"=>9,"Name"=>"J桌","Set"=>"19,20"),array("Id"=>10,"Name"=>"K桌","Set"=>"21,22"),array("Id"=>11,"Name"=>"L桌","Set"=>"23,24"),array("Id"=>12,"Name"=>"M桌","Set"=>"25,26"),array("Id"=>13,"Name"=>"N桌","Set"=>"27,28"),array("Id"=>14,"Name"=>"O桌","Set"=>"29,30"),array("Id"=>15,"Name"=>"P桌","Set"=>"31,32"),array("Id"=>16,"Name"=>"Q桌","Set"=>"33,34"),array("Id"=>17,"Name"=>"R桌","Set"=>"35,36"),array("Id"=>18,"Name"=>"S桌","Set"=>"37,38"),array("Id"=>19,"Name"=>"T桌","Set"=>"39,40"));

// 是否有資料
if ( mysqli_num_rows($QUERY_BetGodnine) )
{
	// 投注球號類別
    include($MAIN_BASE_ADDRESS . "Project/WinHappy/array/Array_Bet_Ball_List.inc") ;        // 載入專案處理狀況

	$tmp_Index = 0 ;
    while ($LIST_BetGodnine = mysqli_fetch_assoc($QUERY_BetGodnine))
    {

        $Type_name = "";

        if($LIST_BetGodnine['BetGodnine_Type'] == 1)
        {
            $Type_name = "輪莊";
        }
        if($LIST_BetGodnine['BetGodnine_Type'] == 2)
        {
            $Type_name = "長無";
        }
        if($LIST_BetGodnine['BetGodnine_Type'] == 3)
        {
            $Type_name = "長有";
        }


		//查詢桌號對應開獎號碼
		if($LIST_BetGodnine['Banker_Table']!="")
		{
			
			$Banker_TopNum = "";
			$Member_TopNum = "";
			
			$SQL_Bingo_info = "SELECT Bingo_Draw_Order_Num FROM Bingo WHERE Bingo_Period = ".$LIST_BetGodnine['BetGodnine_Bingo_Period'];
			// 找出總筆數
			$Bingo_result = mysqli_query($link , $SQL_Bingo_info);  
			//查詢時返回查詢到數據行數：mysqli_num_rows
			$Bingo_info = mysqli_fetch_assoc($Bingo_result);
			
			$Bingo_Draw_Order = explode(",",$Bingo_info['Bingo_Draw_Order_Num']);
			
			//分析莊家桌次對應號碼
			$tmp_Banker_Bingo_Num = $Bingo_Draw_Order[($LIST_BetGodnine['Banker_Table'])];
			
			//echo $tmp_Banker_Bingo_Num."<br>";
			
			// 分析位數
			if( $tmp_Banker_Bingo_Num < 10 )
			{	$Banker_TopNum = (int)$tmp_Banker_Bingo_Num ;	}
			else
			{
				$Banker_TopNum1 = mb_substr($tmp_Banker_Bingo_Num , 0 , 1,"utf-8") ;	// 10位
				$Banker_TopNum2 = mb_substr($tmp_Banker_Bingo_Num , 1 , 1,"utf-8") ;	// 個位
				
				if(($Banker_TopNum1+$Banker_TopNum2)<10)
				{
					$B_Num = (int)$Banker_TopNum1+(int)$Banker_TopNum2;
				}
				if(($Banker_TopNum1+$Banker_TopNum2)>=10)
				{
					$B_Num = mb_substr(($Banker_TopNum1+$Banker_TopNum2) , 1 , 1,"utf-8");
				}
				

				$Banker_TopNum1 != $Banker_TopNum2 ? $Banker_TopNum = $B_Num : $Banker_TopNum = $tmp_Banker_Bingo_Num ;
			}
			//echo $Bingo_Draw_Order[0]."<br>";
			
			//分析閒家桌次對應號碼
			$tmp_Bet_Bingo_Num = $Bingo_Draw_Order[($LIST_BetGodnine['BetGodnine_Table']-1)];
			// 分析位數
			if( $tmp_Bet_Bingo_Num < 10 )
			{	$Member_TopNum = (int)$tmp_Bet_Bingo_Num ;	}
			else
			{
				$Member_TopNum1 = mb_substr($tmp_Bet_Bingo_Num , 0 , 1,"utf-8") ;	// 10位
				$Member_TopNum2 = mb_substr($tmp_Bet_Bingo_Num , 1 , 1,"utf-8") ;	// 個位
				
				if(($Member_TopNum1+$Member_TopNum2)<10)
				{
					$M_Num = (int)$Member_TopNum1+(int)$Member_TopNum2;
				}
				if(($Member_TopNum1+$Member_TopNum2)>=10)
				{
					$M_Num = mb_substr(($Member_TopNum1+$Member_TopNum2) , 1 , 1,"utf-8");
				}
				
			
				$Member_TopNum1 != $Member_TopNum2 ? $Member_TopNum = $M_Num : $Member_TopNum = $tmp_Bet_Bingo_Num ;
			}
			
			
		}
		
		
		// 查詢為莊或閒家
		if( $array_Member_Info['Member_ID'] )
		{// 查詢會員訂單資料
			// 查詢是閒或莊
			if( $array_Member_Info['Member_ID'] == $LIST_BetGodnine['BetGodnine_Member_ID'] )
			{	$tmp_Field = "Member_" ;	}
			else
			{	$tmp_Field = "Banker_" ;	}
		}
		else
		{	$tmp_Field = "" ;	}

		//$sum_BetGodnine_Chips = 0 ;						// 投注金額
		//$sum_BetGodnine_WinLost_Money = 0 ;				// 中獎金額
		//$sum_BetGodnine_Member_WinLost_Money = 0 ;		// 輸嬴金額
		//$sum_BetGodnine_Member_Backwater_Money = 0 ;		// 會員返水
		//$sum_BetGodnine_Member_WinLost_AllMoney = 0 ;		// 總金額

		$sum_BetGodnine_Chips += $LIST_BetGodnine['BetGodnine_Chips'] ;							// 投注金額
		$sum_BetGodnine_WinLost_Money += $LIST_BetGodnine["BetGodnine_{$tmp_Field}WinLost_Money"] ;			// 中獎金額
		$sum_BetGodnine_Member_Backwater_Money += $LIST_BetGodnine["BetGodnine_{$tmp_Field}Backwater_Money"] ;					// 會員返水
		//$sum_BetGodnine_Member_WinLost_AllMoney += $LIST_BetGodnine['BetGodnine_Member_WinLost_AllMoney'] ;	// 輸嬴金額
		//$sum_BetGodnine_Member_WinLost_AllMoney += $LIST_BetGodnine['BetGodnine_Member_WinLost_AllMoney'] ;	// 會員返水

		// 總金額 = 輸嬴金額 + 會員返水(進位整數)
		//$tmp_TotalMoney = $LIST_BetGodnine['BetGodnine_WinLost_Money'];
		//$sum_TotalMoney += $LIST_BetGodnine['BetGodnine_WinLost_Money'] ;
		
		// 是否有中獎
		if( $LIST_BetGodnine['BetGodnine_Winning_Type'] )
		{
			// 投注球號
			if( $Array_BetGodnine_Ball_List[$LIST_BetGodnine['BetGodnine_Type']] )
			{	 $LIST_BetGodnine['BetGodnine_Ball_List'] = $Array_BetGodnine_Ball_List[$LIST_BetGodnine['BetGodnine_Type']] ;	 }
			
			// 中獎類別
			// 未中獎 , 猜大小 [超級] , 猜單雙 [超級] , 猜大小
			// 1星 , 2星(中1) , 3星(中2) , 3星(中3) , 4星(中2)
			$LIST_BetGodnine['BetGodnine_Type'] = "<font color=blue><b>{$LIST_BetGodnine['BetGodnine_Type']}</b></font>" ;
		}
		else
		{	$LIST_BetGodnine['BetGodnine_Type'] = "<font color=gray>未中獎</font>" ;	}


		
		
		//echo "{$LIST_BetGodnine['BetGodnine_ID']}<br>" ;
		$tmp_Index % 2 ? $tmp_BG_CSS = "table_list_tr_bglight" : $tmp_BG_CSS = "table_list_tr_bgdack" ;
		echo "                    <tr class=\"$tmp_BG_CSS\">\n";
		echo "                        <td align=\"center\">{$LIST_BetGodnine['BetGodnine_ID']}</td>\n";	// 投注單號
		echo "                        <td align=\"center\">{$LIST_BetGodnine['Member_Name']}</td>\n";	// 會員名稱
		echo "                        <td align=\"center\">{$LIST_BetGodnine['BetGodnine_Bingo_Period']}</td>\n";	// 投注期數
        echo "                        <td align=\"center\">{$Type_name}</td>\n";	// 投注房間型態
		//echo "                        <td align=\"center\">下注號 : {$LIST_BetGodnine['BetGodnine_Num']}</td>\n";	// 投注球號
		echo "                        <td align=\"center\">{$Table[($LIST_BetGodnine['BetGodnine_Table']-1)]['Name']}</td>\n";	// 投注桌次
		echo "                        <td align=\"center\">{$Member_TopNum}</td>\n";	// 開獎號碼
		echo "                        <td align=\"center\">{$Table[$LIST_BetGodnine['Banker_Table']]['Name']}</td>\n";	// 莊家桌號
		echo "                        <td align=\"center\">{$Banker_TopNum}</td>\n";	// 開獎號碼
		echo "                        <td align=\"right\">{$LIST_BetGodnine['BetGodnine_Chips']}</td>\n";	// 投注金額
		echo "                        <td align=center>" . WinHappy_setMoneyCss( $LIST_BetGodnine["BetGodnine_{$tmp_Field}WinLost_Money"] ) . "</td>\n";	// 中獎金額
		
		//echo "                        <td align=center><font color=blue><b>{$LIST_BetGodnine['BetGodnine_Type']}</b></font></td>\n";	// 中獎類別
		echo "                        <td align=center>{$array_BetGodnine_WinLost_Type[$LIST_BetGodnine['BetGodnine_WinLost_Type']]}</td>\n";	// 中獎類別
		
		echo "                        <td align=center>{$LIST_BetGodnine['BetGodnine_Add_DT']}</td>\n";	// 押注時間
		echo "                        <td align=\"right\">" . WinHappy_setMoneyCss( $LIST_BetGodnine["BetGodnine_{$tmp_Field}WinLost_Money"] ) . "</td>\n";	// 輸嬴金額
		echo "                        <td align=\"right\" style='color:#006600'>" . $LIST_BetGodnine["BetGodnine_{$tmp_Field}Backwater_Money"] . "</td>\n";	// 會員返水
		echo "                        <td align=\"right\">" . WinHappy_setMoneyCss( $LIST_BetGodnine["BetGodnine_{$tmp_Field}WinLost_Money"] ) . "</td>\n";	// 總金額 = 輸嬴金額 + 會員返水(進位整數)
		echo "                    </tr>\n";
		$tmp_Index++ ;
    }
    
    // 釋放結果集合
    mysqli_free_result($QUERY_BetGodnine);
}

echo "                    <tr class=\"[[DATA.class]]\">\n";
echo "                        <td colspan=\"8\" align=\"right\"><span class=\"STYLE1\">結果：</span></td>\n";
echo "                        <td align=\"right\">" . WinHappy_setMoneyCss( $sum_BetGodnine_Chips ) . "</td>\n";	// 投注金額
echo "                        <td align=center>" . WinHappy_setMoneyCss( $sum_BetGodnine_WinLost_Money ) . "</td>\n";	// 中獎金額
echo "                        <td align=center>&nbsp;</td>\n";
echo "                        <td align=\"right\">&nbsp;</td>\n";
echo "                        <td align=\"right\">" . WinHappy_setMoneyCss( $sum_BetGodnine_WinLost_Money ) . "</td>\n";	// 輸嬴金額
echo "                        <td align=\"right\" style='color:#006600'>$sum_BetGodnine_Member_Backwater_Money</td>\n";	// 會員返水
echo "                        <td align=\"right\">" . WinHappy_setMoneyCss( $sum_BetGodnine_WinLost_Money ) . "</td>\n";	// 總金額 = 輸嬴金額 + 會員返水(進位整數)
echo "                    </tr>\n";

if( $total )
{
	$tmp_PageBTN_Para = "&MID=$MID&AID=$AID&Report_Start_Date=$Report_Start_Date&Report_End_Date=$Report_End_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Hour=$Report_End_Hour&ShowDebug=$ShowDebug" ;	// 上下頁後面要加的參數
	
	//echo $tmp_PageBTN_Para;
	
	echo "<td align=\"center\" height=\"30\" colspan=\"8\" class=\"table_footer\">\n";
	include_once("../includes/database/database_page_item.php");
	echo "</td>\n";
	echo "<td align=\"center\" height=\"30\" colspan=\"8\" class=\"table_footer\">\n";
	include_once("../includes/database/database_page_button.php");
	echo "</td>\n";
}

echo "                </table>\n";
echo "            </td>\n";
echo "        </tr>\n";
echo "    </table>\n";
echo "</div>\n";

?>

<script language='javascript'>
    $(function () {
        $('#start_date').DatePicker({
            format: 'Y-m-d',
            date: $('#start_date').val(),
            current: $('#start_date').val(),
            starts: 1,
            position: 'right',
            onBeforeShow: function () {
                $('#start_date').DatePickerSetDate($('#start_date').val(), true);
            },
            onChange: function (formated, dates) {
                $('#start_date').val(formated);
                $('#start_date').DatePickerHide();
            }
        });
        $('#end_date').DatePicker({
            format: 'Y-m-d',
            date: $('#end_date').val(),
            current: $('#end_date').val(),
            starts: 1,
            position: 'right',
            onBeforeShow: function () {
                $('#end_date').DatePickerSetDate($('#end_date').val(), true);
            },
            onChange: function (formated, dates) {
                $('#end_date').val(formated);
                $('#end_date').DatePickerHide();
            }
        });

    });
</script>
<?php
// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>
<script language='javascript'>
    $(function () {
        $('#s').DatePicker({
            format: 'Y-m-d',
            date: $('#s').val(),
            current: $('#s').val(),
            starts: 1,
            position: 'right',
            onBeforeShow: function () {
                $('#s').DatePickerSetDate($('#s').val(), true);
            },
            onChange: function (formated, dates) {
                $('#s').val(formated + ' 00:00:00');
                $('#s').DatePickerHide();
            }
        });
        $('#e').DatePicker({
            format: 'Y-m-d',
            date: $('#e').val(),
            current: $('#e').val(),
            starts: 1,
            position: 'right',
            onBeforeShow: function () {
                $('#e').DatePickerSetDate($('#e').val(), true);
            },
            onChange: function (formated, dates) {
                $('#e').val(formated + ' 23:59:59');
                $('#e').DatePickerHide();
            }
        });

    });
</script>

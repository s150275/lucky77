<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "訂單細項列表查詢" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "report_List.php" ;			// 設定本程式的檔名
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

$ARRAY_POST_GET_PARA[] = "Agent_ID||*" ;			// 查詢代理人id
$ARRAY_POST_GET_PARA[] = "BetGodnine_Type||*" ;		// 查詢模式(1:輪莊,2:長莊)

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

// 輸贏狀態 0||未開獎||1||閒家贏||2||莊家贏:
$array_BetGodnine_WinLost_Type[0] = "未開獎" ;
$array_BetGodnine_WinLost_Type[1] = "閒家贏" ;
$array_BetGodnine_WinLost_Type[2] = "莊家贏" ;

// 下注區 1||輪莊有倍數區||2||長莊無數區:
$array_BetGodnine_Type[1] = "輪莊有倍數區" ;
$array_BetGodnine_Type[2] = "長莊無數區" ;

include_once($MAIN_BASE_ADDRESS . "Project/GodNine/array/Array_Room_Type.inc") ;        // 房間編號

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
echo "                        <td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 訂單細項列表查詢</td>\n";
echo "                    </tr>\n";
echo "                    <tr>\n";
echo "                        <td height=\"14\" colspan=\"2\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "                    </tr>\n";
echo "                </table>\n";
echo "            </td>\n";
echo "        </tr>\n";

echo "        <tr>\n";
echo "            <td height=\"20\" align=\"center\" style=\"padding-left:10px;height:20px\">\n";
echo "                <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table_list2\">\n";
echo "                    <tr class=\"table_header\">\n";
//▽投注資訊(投注單號,會員名稱,投注期數,投注球號,投注金額,中獎類別,押注時間)	投注身份(閒家莊家)	輸贏金額	會員返水	總金額	報帳金額
//▽沒有用-代表
echo "                        <td width=\"180\" align=\"left\"><b>投注資訊</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>付款點數</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>投注身份</b></td>\n";
echo "                        <td width=\"120\" align=\"center\"><b>投注位置</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>輸贏金額</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>會員返水</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>總金額</b></td>\n";
echo "                        <td width=\"80\" align=\"center\"><b>報帳金額</b></td>\n";
echo "                    </tr>\n";

// Agent_ID				查詢代理人id
// BetGodnine_Type		查詢模式(1:輪莊,2:長莊)

$PUBLIC_DB_PAGE_NUM = 300 ;

$row = $PUBLIC_DB_PAGE_NUM ;

// 設定查詢時間
$tmp_SQL = " AND BetGodnine_Add_DT >= '$Report_Start_Date 00:00:00' AND BetGodnine_Add_DT <= '$Report_End_Date 23:59:59'" ;
$tmp_Join = " LEFT JOIN Member ON Member.Member_ID = BetGodnine.BetGodnine_Member_ID " ;
//$tmp_Order = " ORDER BY BetGodnine_Member_ID , BetGodnine_Bingo_Period DESC , BetGodnine_Add_DT DESC" ;
$tmp_Order = " ORDER BY BetGodnine_Add_DT DESC" ;

if( $MID )
{// 找出會員資料
	$array_Member_Info = WinHappy_getMemberInfo( $MID ) ;		// 取得會員資料
	$SQL_BetGodnine = "SELECT * FROM BetGodnine $tmp_Join WHERE ( BetGodnine_Member_ID = '$MID' OR BetGodnine_Banker_ID = '$MID' ) AND BetGodnine_On = '1' $tmp_SQL $tmp_Order" ;
	//echo "<p></p>" ;print_r($array_Member_Info);echo "<br>" ;
}
else
{// 沒有設定會員ID則以代理人ID為主
	$SQL_BetGodnine = "SELECT * FROM BetGodnine $tmp_Join WHERE ( BetGodnine_Online_id LIKE '%,{$Agent_ID},%' OR BetGodnine_Banker_Online_id LIKE '%,{$Agent_ID},%' ) AND BetGodnine_On = '1' AND BetGodnine_Type = '$BetGodnine_Type' $tmp_SQL $tmp_Order" ;
}

// 找出總筆數
$result = mysqli_query($link , $SQL_BetGodnine);  
//查詢時返回查詢到數據行數：mysqli_num_rows
$total = mysqli_num_rows($result);
$totalpage = ceil( $total / $PUBLIC_DB_PAGE_NUM );	// 取得總頁數
include_once("../includes/database/database_page.php");		// 計算資料庫筆數
$start = ($page-1) * $row;

$SQL_BetGodnine = $SQL_BetGodnine . " LIMIT $start , $row";

//echo $SQL_BetGodnine . "<br>" ; 
$QUERY_BetGodnine = mysqli_query($link , $SQL_BetGodnine) ;

$sum_BetGodnine_Chips = 0 ;						// 投注金額
$sum_BetGodnine_WinLost_Money = 0 ;				// 中獎金額
$sum_BetGodnine_Member_WinLost_Money = 0 ;		// 輸嬴金額
$sum_BetGodnine_Member_Backwater_Money = 0 ;	// 會員返水
$sum_BetGodnine_Member_WinLost_AllMoney = 0 ;	// 總金額

// 是否有資料
if ( mysqli_num_rows($QUERY_BetGodnine) )
{
	// 投注球號類別
    include($MAIN_BASE_ADDRESS . "Project/WinHappy/array/Array_Bet_Ball_List.inc") ;        // 載入專案處理狀況

	$tmp_Css_Index = 0 ;
    while ($LIST_BetGodnine = mysqli_fetch_assoc($QUERY_BetGodnine))
    {
		// 閒家資料
		$array_BetGodnine_Member_Info = WinHappy_getMemberInfo( $LIST_BetGodnine['BetGodnine_Member_ID'] ) ;		// 取得會員資料

		// 投注位置-桌號-計算值-倍數值
		//$array_Bingo_Godnine_Calculate = str2array($array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Calculate'] , ",");
		//$array_Bingo_Godnine_Multiple = str2array($array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Multiple'] , ",") ;
		//$array_Bingo_Draw_Order_Num = str2array($array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Draw_Order_Num'] , ",")  ;

		//unset($LIST_BetGodnine['BetGodnine_Log']);
		//unset($LIST_BetGodnine['Member_Log']);
		//echo "<p></p>" ;print_r($LIST_BetGodnine);echo "<br>" ;

		// 求出Bingo資料
		$array_Bingo_Info = func_DatabaseGet( "Bingo" , "*" , array("Bingo_Period"=>"{$LIST_BetGodnine['BetGodnine_Bingo_Period']}") ) ;		// 取得資料庫資料
		// 開獎號
		$array_Bingo_Draw_Order_Num = str2array($array_Bingo_Info['Bingo_Draw_Order_Num'] , ",")  ;
		// 計算值
		$array_Bingo_Godnine_Calculate = str2array($array_Bingo_Info['Bingo_Godnine_Calculate'] , ",")  ;
		// 倍數值
		$array_Bingo_Godnine_Multiple = str2array($array_Bingo_Info['Bingo_Godnine_Multiple'] , ",")  ;

		//echo "{$array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Calculate']}<br>" ;
		if( empty($array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Calculate']) )
		{// 沒有設定則加上資料
			$array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Calculate'] = $array_Bingo_Info['Bingo_Godnine_Calculate'];
			$array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Multiple'] = $array_Bingo_Info['Bingo_Godnine_Multiple'];
			$array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Draw_Order_Num'] = $array_Bingo_Info['Bingo_Draw_Order_Num'];
		}
		
		// 找出莊家資料
		$tmpSQL_Banker = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$LIST_BetGodnine['BetGodnine_Bingo_Period']}' AND Banker_Room = '{$LIST_BetGodnine['BetGodnine_Room']}'" ;
		//echo "$tmpSQL_Banker" ;
		$array_Banker_Info = func_DatabaseGet( $tmpSQL_Banker , "SQL" , "" ) ;		// 取得資料庫資料
		//echo "<p>找出莊家資料</p>" ;print_r($array_Banker_Info);echo "<br>" ;

		// 莊家選號
		$array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Banker_Table'] = $array_Banker_Info['Banker_Banker_Table'];
		//echo "<p>Bingo</p>" ;print_r($array_Bingo_List);echo "<br>" ;
		$tmp_Banker_Num = $array_Banker_Info['Banker_Banker_Table'] ;

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

		$sum_BetGodnine_Chips += $LIST_BetGodnine['BetGodnine_Chips'] ;							// 投注金額
		$sum_BetGodnine_WinLost_Money += $LIST_BetGodnine["BetGodnine_{$tmp_Field}WinLost_Money"] ;			// 中獎金額
		$sum_BetGodnine_Member_Backwater_Money += $LIST_BetGodnine["BetGodnine_{$tmp_Field}Backwater_Money"] ;					// 會員返水
		
		$tmp_RoomNum = GodNine_chnageRoomNum( $LIST_BetGodnine['BetGodnine_Room'] ) ;		// 轉換房間編號
		
		$tmp_Css_Index % 2 ? $tmp_BG_CSS = "table_list_tr_bglight" : $tmp_BG_CSS = "table_list_tr_bgdack" ;
		echo "                    <tr class=\"$tmp_BG_CSS\">\n";
		// 投注資訊
		echo "                        <td align=\"center\" rowspan=2>\n";
		echo "                        投注單號 : {$LIST_BetGodnine['BetGodnine_ID']} , 投注期數 : {$LIST_BetGodnine['BetGodnine_Bingo_Period']} , 下注籌碼 : {$LIST_BetGodnine['BetGodnine_Chips']}<br>\n";
		echo "                        下注區 : {$array_BetGodnine_Type[$LIST_BetGodnine['BetGodnine_Type']]} , 下注房間 : {$tmp_RoomNum} , 下注號 : {$LIST_BetGodnine['BetGodnine_Num']} , 押注時間 : {$LIST_BetGodnine['BetGodnine_Add_DT']}<br>\n";
		echo "                        總手續費 : {$LIST_BetGodnine['BetGodnine_Handling_Fee']} , 輸贏賠率 : {$LIST_BetGodnine['BetGodnine_Odds']} <br>\n";
		echo "                        </td>\n";

		// 是否有莊家資料
		if ( preg_match("/,{$Agent_ID},/i" , $LIST_BetGodnine['BetGodnine_Banker_Online_id'] ) )
		{// 有莊家資料

			// 付款點數
			//$tmpSQL_MoneyLog = "SELECT * FROM MoneyLog WHERE MoneyLog_Bet_ID = '{$LIST_BetGodnine['BetGodnine_ID']}' AND MoneyLog_Type = '2'" ;
			//$arrayInfo_MoneyLog = func_DatabaseGet( $tmpSQL_MoneyLog , "SQL" , "" ) ;		// 取得資料庫資料
			//echo "                        <td>{$arrayInfo_MoneyLog['MoneyLog_Money']}</td>\n";
			//$sum_MoneyLog_Money += $arrayInfo_MoneyLog['MoneyLog_Money'];
			echo "                        <td></td>\n";

			// 找出莊家資料
			$array_Member_Banker_Info = GodNine_getMemberInfo( $LIST_BetGodnine['BetGodnine_Banker_ID'] ) ;		// 取得會員資料

			// 上線id去掉前後,再轉成陣列
			$tmp_BetGodnine_Banker_Online_id = mb_substr( $LIST_BetGodnine['BetGodnine_Banker_Online_id'] , 1 , -1 , "utf-8");
			$array_BetGodnine_Banker_Online_id = str2array($tmp_BetGodnine_Banker_Online_id , ",");

			// 找出莊家上線id的Key值
			$tmp_Banker_Index = array_search($Agent_ID , $array_BetGodnine_Banker_Online_id);
			if( $tmp_Banker_Index )
			{// 莊家中有代理人資料
				if ( $tmpShowMsg OR $ShowDebug )	// 秀出除錯訊息 ██████████
				{	echo "<p>莊家代理人($subID) , 所在Index : $tmp_Banker_Index , 上線id : $tmp_BetGodnine_Online_id</p>" ;	}
	
				// 清空陣列資料
				unset($array_BetGodnine_Banker_Online_WinLost_Money);
				unset($array_BetGodnine_Banker_Online_Backwater_Money);
				unset($array_BetGodnine_Banker_Online_AllMoney);
				unset($array_BetGodnine_Online_Reported_Money);

				// 莊家代理人上線占成比
				$array_BetGodnine_Banker_Online_Share_Ratio = str2array( $LIST_BetGodnine['BetGodnine_Banker_Online_Share_Ratio'] , "," );
				// --{$array_BetGodnine_Banker_Online_Share_Ratio[$tmp_Banker_Index]}

				// 輸贏金額
				$array_BetGodnine_Banker_Online_WinLost_Money = str2array( $LIST_BetGodnine['BetGodnine_Banker_Online_WinLost_Money'] , "," );
				$tmp_BetGodnine_Online_WinLost_Money += $array_BetGodnine_Banker_Online_WinLost_Money[$tmp_Banker_Index] ;
				if ( $tmpShowMsg OR $ShowDebug == "WM" )	// 秀出除錯訊息 ██████████
				{	echo "<h2>莊家輸贏金額($tmp_Banker_Index) 值($tmp_BetGodnine_Online_WinLost_Money) + {$array_BetGodnine_Banker_Online_WinLost_Money[$tmp_Banker_Index]} , 原始參數 : {$LIST_BetGodnine['BetGodnine_Banker_Online_WinLost_Money']}</h2>" ;	}
		
				// 會員返水
				$array_BetGodnine_Banker_Online_Backwater_Money = str2array( $LIST_BetGodnine['BetGodnine_Banker_Online_Backwater_Money'] , "," );
				$tmp_BetGodnine_Online_Backwater_Money += $array_BetGodnine_Banker_Online_Backwater_Money[$tmp_Banker_Index] ;
				if ( $tmpShowMsg OR $ShowDebug == "BM" )	// 秀出除錯訊息 ██████████
				{	echo "<h2>莊家會員返水($tmp_Banker_Index) 值($tmp_BetGodnine_Online_Backwater_Money) + {$array_BetGodnine_Banker_Online_Backwater_Money[$tmp_Banker_Index]} , 原始參數 : {$LIST_BetGodnine['BetGodnine_Banker_Online_Backwater_Money']}</h2>" ;	}
	
				// 總金額
				$array_BetGodnine_Banker_Online_AllMoney = str2array( $LIST_BetGodnine['BetGodnine_Banker_Online_AllMoney'] , "," );
				$tmp_BetGodnine_Online_AllMoney += $array_BetGodnine_Banker_Online_AllMoney[$tmp_Banker_Index] ;
				if ( $tmpShowMsg OR $ShowDebug == "AM" )	// 秀出除錯訊息 ██████████
				{	echo "<h2>莊家總金額($tmp_Banker_Index) 值($tmp_BetGodnine_Online_AllMoney) + {$array_BetGodnine_Banker_Online_AllMoney[$tmp_Banker_Index]} , 原始參數 : {$LIST_BetGodnine['BetGodnine_Banker_Online_AllMoney']}</h2>" ;	}
	
				// 報帳金額
				$array_BetGodnine_Banker_Online_Reported_Money = str2array( $LIST_BetGodnine['BetGodnine_Banker_Online_Reported_Money'] , "," );
				//$tmp_BetGodnine_Online_Reported_Money += $array_BetGodnine_Banker_Online_Reported_Money[$tmp_Banker_Index] ;
				$tmp_BetGodnine_Online_Reported_Money = bcadd($tmp_BetGodnine_Online_Reported_Money, $array_BetGodnine_Banker_Online_Reported_Money[$tmp_Banker_Index], 2) ;
				if ( $tmpShowMsg OR $ShowDebug == "RM" )	// 秀出除錯訊息 ██████████
				{	echo "<h2>莊家報帳金額($tmp_Banker_Index) 值($tmp_BetGodnine_Online_Reported_Money) + {$array_BetGodnine_Banker_Online_Reported_Money[$tmp_Banker_Index]} , 原始參數 : {$LIST_BetGodnine['BetGodnine_Banker_Online_Reported_Money']}</h2>" ;	}
			}

			// Bingo_Godnine_Calculate	VARCHAR(255)	NOT NULL COMMENT '財神九仔生計算值' ,	#*||15::CHAR::(1,2,3,4...)
			// Bingo_Godnine_Multiple	VARCHAR(255)	NOT NULL COMMENT '財神九仔生倍數值' ,	#*||15::CHAR::(1,2,3,1...)

			//$array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Calculate'] = $array_Bingo_Info['Bingo_Godnine_Calculate'];
			//$array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Multiple'] = $array_Bingo_Info['Bingo_Godnine_Multiple'];

			// 投注身份(莊家)
			echo "                        <td align=\"center\">莊家-{$array_Member_Banker_Info['Member_Name']}</td>\n";
			echo "                        <td align=\"center\">{$tmp_Banker_Num}桌 {$array_Bingo_Draw_Order_Num[$tmp_Banker_Num-1]}號<br>計算值({$array_Bingo_Godnine_Calculate[$tmp_Banker_Num-1]}) 倍數值({$array_Bingo_Godnine_Multiple[$tmp_Banker_Num-1]})</td>\n";
			// 輸贏金額
			echo "                        <td align=center>" . WinHappy_setMoneyCss( $array_BetGodnine_Banker_Online_WinLost_Money[$tmp_Banker_Index] ) . "</td>\n";
			// 會員返水
			echo "                        <td align=center>" . WinHappy_setMoneyCss( $array_BetGodnine_Banker_Online_Backwater_Money[$tmp_Banker_Index] ) . "</td>\n";
			// 總金額
			echo "                        <td align=center>" . WinHappy_setMoneyCss( $array_BetGodnine_Banker_Online_AllMoney[$tmp_Banker_Index] ) . "</td>\n";
			// 報帳金額
			echo "                        <td align=center>" . WinHappy_setMoneyCss( $array_BetGodnine_Banker_Online_Reported_Money[$tmp_Banker_Index] ) . "</td>\n";
		}// 有莊家資料
		else
		{// 投注身份(莊家)
			// 找出莊家資料-只秀選取資料
			//$arrayInfo = func_DatabaseGet( "Member" , array("Member_Name" , "Member_ID") , array("id_Member"=>"1") ) ;		// 取得資料庫資料
			//echo "<p></p>" ;print_r($array_Banker_Info);echo "<br>" ;
			// 桌
			//$tmp_Banker_Num = $array_Banker_Info['Banker_Banker_Table'] ;

			// 如果為系統-內定-19
			if( $LIST_BetGodnine['BetGodnine_Type'] == 2 )
			{
				$tmp_Banker_Num = 20 ;
				$array_Banker_Info['Banker_Operator_Name'] = "系統" ;
			}
			
			// 付款點數
			echo "                        <td align=\"center\"></td>\n";
			echo "                        <td align=\"center\">莊家-{$array_Banker_Info['Banker_Operator_Name']}</td>\n";
			// 投注位置-桌號-計算值-倍數值
			echo "                        <td align=\"center\">{$tmp_Banker_Num}桌 {$array_Bingo_Draw_Order_Num[$tmp_Banker_Num-1]}號<br>計算值({$array_Bingo_Godnine_Calculate[$tmp_Banker_Num-1]}) 倍數值({$array_Bingo_Godnine_Multiple[$tmp_Banker_Num-1]})</td>\n";
			//echo "                        <td align=\"center\"></td>\n";
			// 輸贏金額
			echo "                        <td align=center>-</td>\n";
			// 會員返水
			echo "                        <td align=center>-</td>\n";
			// 總金額
			echo "                        <td align=center>-</td>\n";
			// 報帳金額
			echo "                        <td align=center>-</td>\n";
		}
		echo "                    </tr>\n";

		echo "                    <tr class=\"$tmp_BG_CSS\">\n";

		// 是否有閒家資料
		if ( preg_match("/,{$Agent_ID},/i" , $LIST_BetGodnine['BetGodnine_Online_id'] ) )
		//if( stristr( ",{$Agent_ID}," , $LIST_BetGodnine['BetGodnine_Online_id']) )
		{// 有閒家資料
			// 付款點數
			$tmpSQL_MoneyLog = "SELECT * FROM MoneyLog WHERE MoneyLog_Bet_ID = '{$LIST_BetGodnine['BetGodnine_ID']}' AND MoneyLog_Type = '2'" ;
			$arrayInfo_MoneyLog = func_DatabaseGet( $tmpSQL_MoneyLog , "SQL" , "" ) ;		// 取得資料庫資料
			echo "                        <td>{$arrayInfo_MoneyLog['MoneyLog_Money']}</td>\n";
			$sum_MoneyLog_Money += $arrayInfo_MoneyLog['MoneyLog_Money'];

			// 找出閒家資料
			$array_Member_Info = GodNine_getMemberInfo( $LIST_BetGodnine['BetGodnine_Member_ID'] ) ;		// 取得會員資料

			// 上線id去掉前後,再轉成陣列
			$tmp_BetGodnine_Online_id = mb_substr( $LIST_BetGodnine['BetGodnine_Online_id'] , 1 , -1 , "utf-8");
			$array_BetGodnine_Online_id = str2array($tmp_BetGodnine_Online_id , ",");
	
			// 找出上線id的Key值
			$tmp_Index = array_search($Agent_ID , $array_BetGodnine_Online_id);

			if( $tmp_Index )
			{// 閒家中有代理人資料
				// 莊家代理人上線占成比
				$array_BetGodnine_Online_Share_Ratio = str2array( $LIST_BetGodnine['BetGodnine_Online_Share_Ratio'] , "," );
				// --{$array_BetGodnine_Online_Share_Ratio[$tmp_Banker_Index]}

				// 輸贏金額
				unset($array_BetGodnine_Online_WinLost_Money);
				$array_BetGodnine_Online_WinLost_Money = str2array( $LIST_BetGodnine['BetGodnine_Online_WinLost_Money'] , "," );
				$tmp_BetGodnine_Online_WinLost_Money += $array_BetGodnine_Online_WinLost_Money[$tmp_Index] ;
				if ( $tmpShowMsg OR $ShowDebug == "WM" )	// 秀出除錯訊息 ██████████
				{	echo "<h2>閒家上線輸贏金額($tmp_Index) 值($tmp_BetGodnine_Online_WinLost_Money) + {$array_BetGodnine_Online_WinLost_Money[$tmp_Index]} , 原始參數 : {$LIST_BetGodnine['BetGodnine_Online_WinLost_Money']}</h2>" ;	}
				
				// 會員返水
				unset($array_BetGodnine_Online_Backwater_Money);
				$array_BetGodnine_Online_Backwater_Money = str2array( $LIST_BetGodnine['BetGodnine_Online_Backwater_Money'] , "," );
				$tmp_BetGodnine_Online_Backwater_Money += $array_BetGodnine_Online_Backwater_Money[$tmp_Index] ;
				if ( $tmpShowMsg OR $ShowDebug == "BM" )	// 秀出除錯訊息 ██████████
				{	echo "<h2>閒家上線會員返水($tmp_Index) 值($tmp_BetGodnine_Online_Backwater_Money) + {$array_BetGodnine_Online_Backwater_Money[$tmp_Index]} , 原始參數 : {$LIST_BetGodnine['BetGodnine_Online_Backwater_Money']}</h2>" ;	}
	
				// 總金額
				unset($array_BetGodnine_Online_AllMoney);
				$array_BetGodnine_Online_AllMoney = str2array( $LIST_BetGodnine['BetGodnine_Online_AllMoney'] , "," );
				$tmp_BetGodnine_Online_AllMoney += $array_BetGodnine_Online_AllMoney[$tmp_Index] ;
				if ( $tmpShowMsg OR $ShowDebug == "AM" )	// 秀出除錯訊息 ██████████
				{	echo "<h2>閒家上線總金額($tmp_Index) 值($tmp_BetGodnine_Online_AllMoney) + {$array_BetGodnine_Online_AllMoney[$tmp_Index]} , 原始參數 : {$LIST_BetGodnine['BetGodnine_Online_AllMoney']}</h2>" ;	}
	
				// 報帳金額
				unset($array_BetGodnine_Online_Reported_Money);
				$array_BetGodnine_Online_Reported_Money = str2array( $LIST_BetGodnine['BetGodnine_Online_Reported_Money'] , "," );
				//$tmp_BetGodnine_Online_Reported_Money += $array_BetGodnine_Online_Reported_Money[$tmp_Index] ;
				$tmp_BetGodnine_Online_Reported_Money = bcadd($tmp_BetGodnine_Online_Reported_Money, $array_BetGodnine_Online_Reported_Money[$tmp_Index], 2) ;
				if ( $tmpShowMsg OR $ShowDebug == "RM" )	// 秀出除錯訊息 ██████████
				{	echo "<h2>閒家上線報帳金額($tmp_Index) 值($tmp_BetGodnine_Online_Reported_Money) + {$array_BetGodnine_Online_Reported_Money[$tmp_Index]} , 原始參數 : {$LIST_BetGodnine['BetGodnine_Online_Reported_Money']}</h2>" ;	}
			}

			// 投注身份(閒家)
			echo "                        <td align=\"center\">閒家-{$array_BetGodnine_Member_Info['Member_Name']}</td>\n";
			// 投注位置-桌號-計算值-倍數值
			$array_Bingo_Godnine_Calculate = str2array($array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Calculate'] , ",");
			$array_Bingo_Godnine_Multiple = str2array($array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Godnine_Multiple'] , ",") ;
			$array_Bingo_Draw_Order_Num = str2array($array_Bingo_List[$LIST_BetGodnine['BetGodnine_Bingo_Period']]['Bingo_Draw_Order_Num'] , ",")  ;
			$tmp_BetGodnine_Table = $LIST_BetGodnine['BetGodnine_Table'] ;
			// 投注位置-桌號-計算值-倍數值
			echo "                        <td align=\"center\">{$tmp_BetGodnine_Table}桌 {$array_Bingo_Draw_Order_Num[$tmp_BetGodnine_Table-1]}號<br>計算值({$array_Bingo_Godnine_Calculate[$tmp_BetGodnine_Table-1]}) 倍數值({$array_Bingo_Godnine_Multiple[$tmp_BetGodnine_Table-1]})</td>\n";
			//echo "                        <td align=\"center\">{$tmp_BetGodnine_Table}桌</td>\n";
			// 輸贏金額
			echo "                        <td align=center>" . WinHappy_setMoneyCss( $array_BetGodnine_Online_WinLost_Money[$tmp_Index] ) . "</td>\n";
			// 會員返水
			echo "                        <td align=center>" . WinHappy_setMoneyCss( $array_BetGodnine_Online_Backwater_Money[$tmp_Index] ) . "</td>\n";
			// 總金額
			echo "                        <td align=center>" . WinHappy_setMoneyCss( $array_BetGodnine_Online_AllMoney[$tmp_Index] ) . "</td>\n";
			// 報帳金額
			echo "                        <td align=center>" . WinHappy_setMoneyCss( $array_BetGodnine_Online_Reported_Money[$tmp_Index] ) . "</td>\n";
		}// 有閒家資料
		else
		{
			$tmp_BetGodnine_Table = $LIST_BetGodnine['BetGodnine_Table'] ;
			// 
			// 付款點數
			echo "                        <td align=\"center\"></td>\n";
			// 投注身份(莊家)
			echo "                        <td align=\"center\">閒家--{$array_BetGodnine_Member_Info['Member_Name']}</td>\n";
			// 投注位置-桌號-計算值-倍數值
			echo "                        <td align=\"center\">{$tmp_BetGodnine_Table}桌 {$array_Bingo_Draw_Order_Num[$tmp_BetGodnine_Table-1]}號<br>計算值({$array_Bingo_Godnine_Calculate[$tmp_BetGodnine_Table-1]}) 倍數值({$array_Bingo_Godnine_Multiple[$tmp_BetGodnine_Table-1]})</td>\n";
			// 輸贏金額
			echo "                        <td align=center>-</td>\n";
			// 會員返水
			echo "                        <td align=center>-</td>\n";
			// 總金額
			echo "                        <td align=center>-</td>\n";
			// 報帳金額
			echo "                        <td align=center>-</td>\n";
		}
		echo "                    </tr>\n";
		$tmp_Css_Index++ ;
    }
    
    // 釋放結果集合
    mysqli_free_result($QUERY_BetGodnine);
}

echo "                    <tr class=\"[[DATA.class]]\">\n";
echo "                        <td align=\"right\"><span class=\"STYLE1\">結果：</span></td>\n";
echo "                        <td align=center>" . WinHappy_setMoneyCss( $sum_MoneyLog_Money ) . "</td>\n";	// 中獎金額
echo "                        <td align=\"right\"></td>\n";
echo "                        <td align=\"right\"></td>\n";
// 輸贏金額
echo "                        <td align=center>" . WinHappy_setMoneyCss( $tmp_BetGodnine_Online_WinLost_Money ) . "</td>\n";	// 中獎金額
echo "                        <td align=\"right\">" . WinHappy_setMoneyCss( $tmp_BetGodnine_Online_Backwater_Money ) . "</td>\n";	// 輸嬴金額
echo "                        <td align=\"right\" style='color:#006600'>$tmp_BetGodnine_Online_AllMoney</td>\n";	// 會員返水
echo "                        <td align=\"right\">" . WinHappy_setMoneyCss( $tmp_BetGodnine_Online_Reported_Money ) . "</td>\n";	// 總金額 = 輸嬴金額 + 會員返水(進位整數)
echo "                    </tr>\n";

if( $total )
{
//http://godnine List.php?Funct=report_List&Agent_ID=97&BetGodnine_Type=1&Report_Start_Date=2020-09-07&Report_Start_Hour=0&Report_End_Date=2020-09-07&Report_End_Hour=23
	$tmp_PageBTN_Para = "&Funct=$Funct&Agent_ID=$Agent_ID&BetGodnine_Type=$BetGodnine_Type&MID=$MID&AID=$AID&Report_Start_Date=$Report_Start_Date&Report_End_Date=$Report_End_Date&Report_Start_Hour=$Report_Start_Hour&Report_End_Hour=$Report_End_Hour&ShowDebug=$ShowDebug" ;	// 上下頁後面要加的參數

	echo "<td align=\"center\" height=\"30\" colspan=\"1\" class=\"table_footer\">\n";
	include_once("../includes/database/database_page_item.php");
	echo "</td>\n";
	echo "<td align=\"center\" height=\"30\" colspan=\"5\" class=\"table_footer\">\n";
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

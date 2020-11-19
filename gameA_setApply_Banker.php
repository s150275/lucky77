<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "進行排莊" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "gameA_setApply_Banker.php" ;			// 設定本程式的檔名
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

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "table_number||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

$Bol = func_setOnLineInfo( $_SESSION['Member_ID'] , 1  , "OnLine_Bet_DT" ) ;		// 記錄會員在線資訊和下注時間

GodNine_setMemberINRoomInfo() ;		// 設定會員進入房間資訊

if( $Funct == "ClearBanker" AND 0 )
{// 清除排莊資料和當莊資料
	$tmpSQL = 'TRUNCATE TABLE ApplyBanker' ;
	$arrayInfo = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料

	$tmpSQL = 'TRUNCATE TABLE Banker' ;
	$arrayInfo = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料

	exit;
}

$tmpShowMsg = 0 ;

if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
{	echo "<a href='?Funct=ClearBanker' target='_new'>清除排莊資料和當莊資料</a><br>" ;	}

// 23:55以後不能排莊
$tmpSplitDate = getSplitDate( date("Y-m-d H:i:s") , "A") ;			// 全部分析
if( $tmpSplitDate[3] == 23 AND $tmpSplitDate[4] >= 55 )
{
	echo "-1,23:55以後不能排莊" ;
	exit;
}

// 07:00以前不能排莊
$tmpSplitDate = getSplitDate( date("Y-m-d H:i:s") , "A") ;			// 全部分析
if( $tmpSplitDate[3] < 7 )
{
	echo "-1,07:00以前不能排莊" ;
	exit;
}

$tmp_MemberFreePoint = GodNine_getMemberFreeMmoney( $tmp_Member_ID ) ;		// 取得會員還可以使用金額

$array_Member_Info = GodNine_getMemberInfo( $_SESSION['Member_ID'] ) ;		// 取得會員資料

// 所需點數-如果只剩下一期只扣100倍
$tmp_Nee_Points = $_SESSION['Chips'] * 70 ;
//if( $array_Member_Info['Member_Money'] < $tmp_Nee_Points )
if( $tmp_MemberFreePoint < $tmp_Nee_Points )
{// 點數不足
	echo "-1,排莊所需點數為$tmp_Nee_Points" ;
	exit;
}

// 是否為本日最後一期判斷
$array_StratEnd_Bingo_Period = WinHappy_getStratEnd_Bingo_Period( date("Y-m-d") ) ;		// 取得某日開獎的第一期和最後一期號碼
// Start : 第一期 , End : 最後一期
if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
{echo "<p>某日開獎的第一期和最後一期號碼</p>" ;print_r($array_StratEnd_Bingo_Period);echo "<br>" ;}

// 求出當莊的最後一筆-要加上房間數判斷
$tmpSQL = "SELECT * FROM Banker ORDER BY Banker_Bingo_Period DESC" ;
$array_LastBanker_Info = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料

if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
{echo "<p>當莊的最後一筆 : {$array_LastBanker_Info['Banker_Bingo_Period']}</p>" ;	}

// 是否有已到本日最後一期
if( $array_LastBanker_Info['Banker_Bingo_Period'] >= $array_StratEnd_Bingo_Period['End'] )
{
	echo "-1,本日已無法排莊了" ;
	exit;
}

$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)
$tmp_Now_Banker_Bingo = $array_BingoPeriod['NowBingo'] ;	// 現在期號

$tmp_Withhold_Points = 0 ;					// 預扣金額
$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號

$tmp_HasApplyBankerCount = 0 ;				// 之前已排莊人數
$array_Banker_Bingo_Period[0] = $array_BingoPeriod['NowBingo'] + 1 ;	// 排莊Bingo開始期號-內定沒有排莊
$array_Banker_Bingo_Period[1] = $array_Banker_Bingo_Period[0]+1 ;			// 排莊Bingo結束期號-開始+1

// 找出莊家設定資料-最新8期,每人2期
// 是否為本期莊家
// 是否還有空間排莊

// 找出本房間排莊人數
$SQL_ApplyBanker = "SELECT * FROM ApplyBanker WHERE ( ApplyBanker_Bingo_Period_Start >= '{$array_BingoPeriod['NowBingo']}' OR  ApplyBanker_Bingo_Period_End >= '{$array_BingoPeriod['NowBingo']}' ) AND ApplyBanker_Room = '$tmp_RoomNum'" ;

$SQL_ApplyBanker_Count = $SQL_ApplyBanker . " AND ApplyBanker_On = '1' " ;
//$SQL_ApplyBanker_Count = $SQL_ApplyBanker . " AND ApplyBanker_Bingo_Period_Start != '999999999' " ;
//$SQL_ApplyBanker_Count = $SQL_ApplyBanker ;

$Count_ApplyBanker_Count = func_DatabaseGet( $SQL_ApplyBanker_Count , "COUNT" , "" ) ;		// 取得資料庫資料

if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
{	echo "<p>找出目前正式排莊人數($Count_ApplyBanker_Count)</p> : $SQL_ApplyBanker_Count<br>" ; 	}

// 是否還可以排莊
if( $Count_ApplyBanker_Count < 4 )
{// 還可以排莊
	// 加入排莊資料
	$arrayField_ApplyBanker['ApplyBanker_Set_ID'] = $_SESSION['Member_ID'] ;			// 排莊ID
	$arrayField_ApplyBanker['ApplyBanker_Operator_Name'] = $_SESSION['Member_Name'] ;	// 排莊名稱
	$arrayField_ApplyBanker['ApplyBanker_Bingo_Period_Start'] = 999999999 ;				// 排莊Bingo開始期號-先填一個大值
	$arrayField_ApplyBanker['ApplyBanker_Bingo_Period_End'] = 0 ;						// 排莊Bingo結束期號
	$arrayField_ApplyBanker['ApplyBanker_Room'] = $tmp_RoomNum ;						// 排莊房間
	$arrayField_ApplyBanker['ApplyBanker_Chips_Money'] = $_SESSION['Chips'] ;			// 籌碼金額
	$arrayField_ApplyBanker['ApplyBanker_Withhold_Money'] = 0 ;							// 預扣金額
	$arrayField_ApplyBanker['ApplyBanker_Add_DT'] = date("Y-m-d H:i:s") ;				// 排莊時間
	$arrayField_ApplyBanker['ApplyBanker_On'] = "0" ;									// 排莊狀態
	$Bol_ApplyBanker = func_DatabaseBase( "ApplyBanker" , "ADD" , $arrayField_ApplyBanker , "" ) ;		// 資料庫處理
	//Array ( [ApplyBanker_Set_ID] => Member2005100001 [ApplyBanker_Operator_Name] => 會員01 [ApplyBanker_Bingo_Period_Start] => 0 [ApplyBanker_Bingo_Period_End] => 0 [ApplyBanker_Room] => R05012 [ApplyBanker_Chips_Money] => 50 [ApplyBanker_Withhold_Money] => 0 [ApplyBanker_Add_DT] => 2020-06-10 21:59:31 [ApplyBanker_On] => 0 )

	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "<p>加入排莊資料</p>" ;print_r($arrayField_ApplyBanker);echo "<br>" ;	}
	
	if( !$Bol_ApplyBanker )
	{
		echo "-1,加入排莊資料失敗" ;
		exit;
		// 是否還可以加入當莊資料
		// 本期還不足4人
		// 本日還有2期
	}
	else
	{
		if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
		{	echo "<p>加入排莊資料成功</p>" ;	}
	}
}
else
{// 不可以排莊
	echo "-1,排莊人數已滿" ;
	exit;
}

//$SQL_ApplyBanker = $SQL_ApplyBanker . " AND ApplyBanker_On = '1'" ;
//echo "$SQL_ApplyBanker<br>" ;

if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
{	echo "<h3>查詢此加入資料是否在4位內</h3>$SQL_ApplyBanker<br>" ;	}

// 查詢此加入資料是否在4位內
$QUERY_ApplyBanker = mysqli_query($link , $SQL_ApplyBanker) ;

// 是否有資料
if ( mysqli_num_rows($QUERY_ApplyBanker) )
{// START 有會員排莊資料
	$tmp_Count = mysqli_num_rows($QUERY_ApplyBanker) ;
	if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	{	echo "有會員排莊資料 $tmp_Count 筆<br>" ;	}

	$tmp_Index = 1;	// 索引值
    // 一條條獲取
    while ($LIST_ApplyBanker = mysqli_fetch_assoc($QUERY_ApplyBanker))
    {
		$tmp_Index++ ;	// 索引值
		if( $LIST_ApplyBanker['id_ApplyBanker'] == $Bol_ApplyBanker )
		{// START 找到剛才加入的排莊的資料
		
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "找到剛才加入的排莊資料<br>" ;	}
			
			if( $tmp_Index <= 5 )
			{// START 新加入當莊資料有效
				// 把資料設成有效

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>新加入排莊資料有效</h2>" ;	}

				// 把新加的排莊資料設成有效和可當莊期數
				$arrayField['ApplyBanker_Withhold_Money'] = $_SESSION['Chips'] * 70 ;		// 預扣金額
				$arrayField['ApplyBanker_Bingo_Period_Start'] = $array_Banker_Bingo_Period[0] + ($tmp_HasApplyBankerCount * 2) ;	// 排莊Bingo開始期號
				// 一次只加一期當莊資料
				$arrayField['ApplyBanker_Bingo_Period_End'] = $arrayField['ApplyBanker_Bingo_Period_Start'] ;	// 排莊Bingo開始期號
				//$arrayField['ApplyBanker_Bingo_Period_End'] = $array_Banker_Bingo_Period[1] + ($tmp_HasApplyBankerCount * 2) ;	// 排莊Bingo結束期號
				$arrayField['ApplyBanker_On'] = 1 ;

				// 判斷結束期號是否超過本日最後一期
				$Bol_SetOn = func_DatabaseBase( "ApplyBanker" , "MOD" , $arrayField , " id_ApplyBanker = '$Bol_ApplyBanker'" ) ;						// 資料庫處理
				if( $Bol_SetOn )
				{// 加入當莊資料
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "把新加的排莊資料設成有效和可當莊期數-成功<br>" ;	}
					
					// 加入2期當莊資料
					for( $i = 0 ; $i < 1 ; $i++ )
					{
						if( $i == 0 )	// 當莊類型
						{	$tmp_Banker_Wave_Type = "Start" ;	}
						else
						{	$tmp_Banker_Wave_Type = "End" ;	}

						//$tmp_Bingo = $tmp_Now_Banker_Bingo + $i;		// 開獎Bingo期號
						
						$arrayField_Banker['Banker_id_ApplyBanker'] = $Bol_ApplyBanker ;		// 排莊id
						$arrayField_Banker['Banker_Set_ID'] = $_SESSION['Member_ID'] ;			// 當莊ID
						$arrayField_Banker['Banker_Operator_Name'] = $_SESSION['Member_Name'] ;	// 當莊名稱
						$arrayField_Banker['Banker_Bingo_Period'] = $array_Banker_Bingo_Period[$i] ;	// 開獎Bingo期號
						$arrayField_Banker['Banker_Room'] = $tmp_RoomNum ;				// 當莊房間
						$arrayField_Banker['Banker_Banker_Table'] = "1" ;						// 莊家桌號
						$arrayField_Banker['Banker_Banker_Seats'] = "1,2" ;					// 莊家位子
						$arrayField_Banker['Banker_Withhold_Money'] = ($_SESSION['Chips']*70) ;	// 預扣金額
						$arrayField_Banker['Banker_Add_DT'] = date("Y-m-d H:i:s") ;				// 當莊時間
						$arrayField_Banker['Banker_On'] = "1" ;									// 排莊狀態
						$arrayField_Banker['Banker_Wave_Type'] = $tmp_Banker_Wave_Type ;	// 當莊類型
						$Bol_Banker = func_DatabaseBase( "Banker" , "ADD" , $arrayField_Banker , "" ) ;						// 資料庫處理
						if( $Bol_Banker )
						{
							$tmp_Banker_Bingo_Period_Log .= " $array_Banker_Bingo_Period[$i] " ;
							if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
							{	echo "<p>加入 $i {$array_Banker_Bingo_Period[$i]} 期當莊資料</p>" ;	}

							// 預扣金額-100倍-不預扣金額
							//$tmp_Withhold_Points += ($_SESSION['Chips'] * 100) ;
						}
						else
						{
							if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
							{	echo "<p>加入當莊資料</p>" ;print_r($arrayField_Banker);echo "<br>" ;	}
// Array ( [Banker_id_ApplyBanker] => 52 [Banker_Set_ID] => Member2005100001 [Banker_Operator_Name] => 會員01 [Banker_Bingo_Period] => 109033453 [Banker_Room] => 50 [Banker_Banker_Seats] => 39,40 [Banker_Add_DT] => 2020-06-13 20:21:19 [Banker_On] => 1 )
							echo "-1,加入當莊資料($i) - 加入失敗" ;
							exit;
						}
					}
					
					if( $tmp_Withhold_Points AND 0 )
					{// 不預扣點數
						// 扣會員點數
						$tmpSQL = "UPDATE Member SET Member_Money = Member_Money - $tmp_Withhold_Points WHERE Member_ID = '{$_SESSION['Member_ID']}'" ;				// 欄位值+1
						$Bol = func_DatabaseBase( $tmpSQL , "SQL" , "" , "" ) ;									// 資料庫處理
						if ( $Bol )
						{
							if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
							{	echo "扣會員點數($tmp_Withhold_Points 點)-成功<br>" ;	}
							//alertgo( "資料庫執行完成" , $MAIN_FILE_NAME ) ;

							// 加入金額Log
							$arrayField_MoneyLog['MoneyLog_Set_ID'] = $_SESSION['Member_ID'] ;			// 設定者ID
							$arrayField_MoneyLog['MoneyLog_Class'] = 1 ;									// 操作分類#::SELECT:2||1||會員||2||代理人::
							$arrayField_MoneyLog['MoneyLog_Type'] = 1 ;									// 操作動作#::SELECT:2||0||其它||1||遊戲投注||2||遊戲派彩||3||存入||4||提出||5||莊家派彩:
							$arrayField_MoneyLog['MoneyLog_Bet_ID'] = "" ;			// 下注訂單號
							$arrayField_MoneyLog['MoneyLog_Money'] = $tmp_Withhold_Points ;		// 操作金額
							$arrayField_MoneyLog['MoneyLog_Original_Money'] = $array_Member_Info['Member_Money'] ;	// 操作前金額
							$arrayField_MoneyLog['MoneyLog_Operator_IP'] = $_SERVER['REMOTE_ADDR'] ;		// 操作者IP
							$arrayField_MoneyLog['MoneyLog_Operator_ID'] = ""	 ;	// 操作者ID
							$arrayField_MoneyLog['MoneyLog_Operator_Name'] = $array_Member_Info['Member_Name'] ;	// 操作者名稱
							$arrayField_MoneyLog['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;				// 操作時間
							
							$Bol_MoneyLog = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField_MoneyLog , "" ) ;						// 資料庫處理
						}
						else
						{
							if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
							{	echo "扣會員點數-失敗<br>" ;	}
							echo "-1,扣會員點數-失敗" ;
							exit;
						}
					}//END 扣會員點數
				}
				else
				{
					if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
					{	echo "設定排莊資料失敗<br>" ;	}

					echo "-1,設定排莊資料失敗" ;
					exit;
				}

			}// END 新加入當莊資料有效
			else
			{// 新加入當莊資料無效
				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "排莊人數已滿<br>" ;	}

				// 把排莊資料設成無效
				// 把新加的排莊資料設成有效和可當莊期數
				$arrayField['ApplyBanker_Withhold_Money'] = 0 ;		// 預扣金額
				$arrayField['ApplyBanker_Bingo_Period_Start'] = 0 ;	// 排莊Bingo開始期號
				$arrayField['ApplyBanker_Bingo_Period_End'] = 0 ;	// 排莊Bingo結束期號
				$arrayField['ApplyBanker_On'] = 0 ;

				// 判斷結束期號是否超過本日最後一期
				$Bol_SetOn = func_DatabaseBase( "ApplyBanker" , "MOD" , $arrayField , " id_ApplyBanker = '$Bol_ApplyBanker'" ) ;						// 資料庫處理
				
				echo "-1,排莊人數已滿" ;
				exit;
			}
		}// END 找到剛才加入的排莊的資料
		else
		{// 不是剛才加入的排莊的資料
			if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
			{	echo "<p>不是剛才加入的排莊的資料</p>" ;	}

			if( $LIST_ApplyBanker['ApplyBanker_Bingo_Period_End'] != 999999999)
			{// 正式排莊資料
				$array_Banker_Bingo_Period[0] = $LIST_ApplyBanker['ApplyBanker_Bingo_Period_End']+1 ;	// 排莊Bingo開始期號-內定沒有排莊
				$array_Banker_Bingo_Period[1] = $LIST_ApplyBanker['ApplyBanker_Bingo_Period_End']+2 ;	// 排莊Bingo結束期號-開始+1

				if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
				{	echo "<h2>排莊Bingo開始期號 : {$array_Banker_Bingo_Period[0]} , 排莊Bingo結束期號 : $array_Banker_Bingo_Period[1]</h2>" ;	}
				
			}
			else
			{// 申請排莊資料
				$tmp_HasApplyBankerCount++ ;	// 設定之前申請排莊人數
			}
		}
    }// END while 取得排莊資料
    
    // 釋放結果集合
    mysqli_free_result($QUERY_ApplyBanker);
	// 找出會員剩下點數回傳
	//$arrayInfo = func_DatabaseGet( "Member" , "*" , array("id_Member"=>"1") ) ;		// 取得資料庫資料
	// 剩下點數
	$tmp_Remain_Money = (int)($array_Member_Info['Member_Money']  - $tmp_Withhold_Points) ; 

	if( $array_Member_Info['Member_Money'] != $array_Member_Info['Member_BetRegMoney'] )
	{
		// 設定下注後金額
		$tmpSQL_User_Money = "UPDATE Member SET Member_BetRegMoney = {$array_Member_Info['Member_Money']} WHERE Member_ID = '{$_SESSION['Member_ID']}'" ;				// 欄位值+1
		$Bol_User_Money = func_DatabaseBase( $tmpSQL_User_Money , "SQL" , "" , "" ) ;									// 資料庫處理
	}

	// 加入操作LOG
	$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
	$array_LogInfo['OperatorID'] = $_SESSION['Member_ID'] ;		// 操作者ID
	$array_LogInfo['OperatorName'] = $_SESSION['Member_Name'] ;	// 操作者姓名
	$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
	$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
	$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
	$array_LogInfo['Type'] = "當莊" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
	$array_LogInfo['Info'] = "操作者 : {$_SESSION['Member_Name']} , 動作 : 當莊 , 開獎Bingo期號 : $tmp_Banker_Bingo_Period_Log , 下注房間 : " . GodNine_getRoomNum("E") ;			// 操作記錄 備註(可記錄新增會員ID,刪除ID)
	$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)
	$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP

	// 會員操作-管理等級來判斷
	$tmpCode = func_WriteLogFieldInfo( "Member" , "Member_ID" , $_SESSION['Member_ID'] , "Member_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料

	echo "01,$tmp_Remain_Money" ;
	exit;
}// END 有會員排莊資料
//else
//{// START 沒有會員排莊資料
//	exit;
//	//沒有資料加入當莊資料有效 -1,加入當莊資料0 - 加入失敗
//
//	//回傳資料 : SELECT DISTINCT * FROM ApplyBanker WHERE ApplyBanker_Bingo_Period_Start >= '109032877' AND ApplyBanker_Room = 'R05012'
//	//沒有資料
//	//Array ( [Banker_id_ApplyBanker] => 15 [Banker_Set_ID] => Member2005100001 [Banker_Operator_Name] => 會員01 [Banker_Bingo_Period] => 0 [Banker_Room] => 50 [Banker_Banker_Seats] => 39,40 [Banker_Add_DT] => 2020-06-10 23:05:46 [Banker_On] => 1 )
//	//-1,加入當莊資料0 - 加入失敗
//
//	//echo "沒有資料<br>" ;
//	// 加新當莊資料
//
//	$arrayField['ApplyBanker_On'] = 1 ;
//	$Bol_SetOn = func_DatabaseBase( "ApplyBanker" , "MOD" , $arrayField , " id_ApplyBanker = '$Bol_ApplyBanker'" ) ;						// 資料庫處理
//	if( $Bol_SetOn )
//	{// 加入當莊資料-之後加上是否為本日最後一期判斷
//		// 加入2期當莊資料
//		for( $i = 0 ; $i <= 1 ; $i++ )
//		{
//			$tmp_Bingo = $tmp_Now_Banker_Bingo + $i;		// 開獎Bingo期號
//			unset($arrayField_Banker);
//			$arrayField_Banker['Banker_id_ApplyBanker'] = $Bol_ApplyBanker ;		// 排莊id
//			$arrayField_Banker['Banker_Set_ID'] = $_SESSION['Member_ID'] ;			// 當莊ID
//			$arrayField_Banker['Banker_Operator_Name'] = $_SESSION['Member_Name'] ;	// 當莊名稱
//			$arrayField_Banker['Banker_Bingo_Period'] = $tmp_Bingo ;				// 開獎Bingo期號
//			$arrayField_Banker['Banker_Room'] = $tmp_RoomNum ;				// 當莊房間
//			$arrayField_Banker['Banker_Banker_Seats'] = "39,40" ;					// 莊家位子
//			$arrayField_Banker['Banker_Add_DT'] = date("Y-m-d H:i:s") ;				// 當莊時間
//			$arrayField_Banker['Banker_On'] = "1" ;									// 排莊狀態
//			$Bol_Banker = func_DatabaseBase( "Banker" , "ADD" , $arrayField_Banker , "" ) ;						// 資料庫處理
//
//			//echo "<p></p>" ;print_r($arrayField_Banker);echo "<br>" ;
//
//			if( $Bol_Banker )
//			{
//				
//				// 加入要設排莊Bingo開始和結束期號
//				if( $i == 1 )
//				{
//					$tmp_ApplyBanker_Bingo_Period_Start = $array_BingoPeriod['NowBingo'] ;
//					$tmp_ApplyBanker_Bingo_Period_End = $array_BingoPeriod['NowBingo'] ;
//				}
//				else
//				{
//					$tmp_ApplyBanker_Bingo_Period_End = $array_BingoPeriod['NowBingo']+1 ;
//				}
//				
//				// 預扣金額-100倍
//				$tmp_Withhold_Points += ($_SESSION['Chips'] * 100) ;
//			}
//			else
//			{
//				echo "-1,加入當莊資料$i - 加入失敗" ;
//				exit;
//			}
//		}
//		
//		if( $tmp_ApplyBanker_Bingo_Period_Start )
//		{// 設定排莊資料-設排莊Bingo開始和結束期號
//			$arrayField['ApplyBanker_Bingo_Period_Start'] = $tmp_ApplyBanker_Bingo_Period_Start ;
//			$arrayField['ApplyBanker_Bingo_Period_End'] = $tmp_ApplyBanker_Bingo_Period_End ;
//			$Bol_SetOn = func_DatabaseBase( "ApplyBanker" , "MOD" , $arrayField , " id_ApplyBanker = '$Bol_ApplyBanker'" ) ;						// 資料庫處理
//			if( !$Bol_SetOn )
//			{
//				echo "-1,設排莊Bingo開始和結束期號-執行失敗" ;
//				exit;
//			}
//		}
//		
//		if( $tmp_Withhold_Points )
//		{
//			// 扣會員點數
//			$tmpSQL = "UPDATE Member SET Member_Money = Member_Money - $tmp_Withhold_Points WHERE Member_ID = '{$_SESSION['Member_ID']}'" ;				// 欄位值+1
//			$Bol = func_DatabaseBase( $tmpSQL , "SQL" , "" , "" ) ;									// 資料庫處理
//			if ( $Bol )
//			{
//				//alertgo( "資料庫執行完成" , $MAIN_FILE_NAME ) ;	
//			}
//			else
//			{
//				echo "-1,扣會員點數-執行失敗" ;
//				exit;
//			}
//			
//		}
//	}
//	else
//	{
//		echo "-1,設定排莊資料失敗" ;
//		exit;
//	}
//}
echo "ok" ;

exit;

?>

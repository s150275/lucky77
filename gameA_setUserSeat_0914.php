<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "設定閒家座位資料" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "gameA_setUserSeat.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "table_number||*" ;		// 選取桌數
$ARRAY_POST_GET_PARA[] = "chair_number||*" ;		// 選取椅子
$ARRAY_POST_GET_PARA[] = "seat_number||*" ;			// 選取座位
$ARRAY_POST_GET_PARA[] = "seat_number_State||*" ;	// 選取座位狀態
$ARRAY_POST_GET_PARA[] = "Now_Game_Start||*" ;		// 本日開始秒數

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

$Bol = func_setOnLineInfo( $_SESSION['Member_ID'] , 1  , "OnLine_Bet_DT" ) ;		// 記錄會員在線資訊和下注時間

GodNine_setMemberINRoomInfo() ;		// 設定會員進入房間資訊

$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)

$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號

// 查詢是否還有點數可以下注

// 取得會員資料
$array_Member_Info = WinHappy_getMemberInfo( $_SESSION['Member_ID'] ) ;		// 取得會員資料

if( $seat_number_State == "true" )
{// 取消選取
	$tmp_SQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND BetGodnine_Room = '$tmp_RoomNum' AND BetGodnine_Num = '$seat_number' AND BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' AND BetGodnine_On = '1'" ;
	$array_BetGodnine_Info = func_DatabaseGet( $tmp_SQL , "SQL" , "" ) ;		// 取得資料庫資料
	if( $array_BetGodnine_Info['BetGodnine_On'] == 1 )
	{
		// 設定選取
		$arrayField['BetGodnine_On'] = 0 ;
		$Bol = func_DatabaseBase( "BetGodnine" , "MOD" , $arrayField , " id_BetGodnine = '{$array_BetGodnine_Info['id_BetGodnine']}'" ) ;						// 資料庫處理

		// 還回員點點數
		//$tmpSQL = "UPDATE Member SET Member_Money = Member_Money + {$array_BetGodnine_Info['BetGodnine_Withhold_Chips']} WHERE Member_ID = '{$_SESSION['Member_ID']}'" ;				// 欄位值+1
		//$Bol = func_DatabaseBase( $tmpSQL , "SQL" , "" , "" ) ;									// 資料庫處理
		//if ( $Bol )
		//{
		//}
		
		//$tmp_Remain_Money = $array_Member_Info['Member_Money'] + $array_BetGodnine_Info['BetGodnine_Withhold_Chips'] ; 

		// 加入操作LOG
		$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
		$array_LogInfo['OperatorID'] = $_SESSION['Member_ID'] ;		// 操作者ID
		$array_LogInfo['OperatorName'] = $_SESSION['Member_Name'] ;	// 操作者姓名
		$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
		$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
		$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
		$array_LogInfo['Type'] = "取消下注" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
		$array_LogInfo['Info'] = "操作者 : {$_SESSION['Member_Name']} , 動作 : 取消下注 , 取消下注ID : {$array_BetGodnine_Info['id_BetGodnine']}" ;			// 操作記錄 備註(可記錄新增會員ID,刪除ID)
		$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)
		$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP

		// 會員操作-管理等級來判斷
		$tmpCode = func_WriteLogFieldInfo( "Member" , "Member_ID" , $_SESSION['Member_ID'] , "Member_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料

		$tmp_Remain_Money = (int)$array_Member_Info['Member_Money'] ; 
		echo "01,$tmp_Remain_Money" ;
		exit;
	}

}
else
{// 加入選取
}

// 是否超過最後三秒
if ( $Now_Game_Start % 300 > 267 )
{
	echo "-1,選位失敗" ;
	exit;
}

// 找出莊家選位
$tmpSQL_Banker = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND Banker_Room = '$tmp_RoomNum'" ;
$array_Banker_Info = func_DatabaseGet( $tmpSQL_Banker , "SQL" , "" ) ;		// 取得資料庫資料
// $seat_number = Banker_Banker_Seats
$array_Banker_Banker_Seats = str2array( $array_Banker_Info['Banker_Banker_Seats'] , "," );
if( in_array($seat_number, $array_Banker_Banker_Seats) )
{
	echo "-1,對不起,此位為莊家座位" ;
	exit;
}

// 莊家是否為自己
if( $array_Banker_Info['Banker_Set_ID'] == $_SESSION['Member_ID'] )
{
	//echo "-1,對不起,莊家不能選座 $tmpSQL_Banker {$array_Banker_Info['Banker_Set_ID']} == {$_SESSION['Member_ID']}" ;
	echo "-1,對不起,莊家不能選座" ;
	exit;
}
// SELECT * FROM Banker WHERE Banker_Bingo_Period = '{109051274}' AND Banker_Room = 'R010011'
// == Member2009040002

// 此座位是否為莊家選位
//if( $Count_Banker )

// 此座位是否已有人選取-BetGodnine
$Count_BetGodnine = func_DatabaseGet( "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND BetGodnine_Room = '$tmp_RoomNum' AND BetGodnine_Num = '$seat_number' AND BetGodnine_On = '1'" , "COUNT" , "" ) ;		// 取得資料庫資料
if( $Count_BetGodnine )
{	echo "-1,對不起,已有人先選取本座位" ;	}
else
{// START 此座位是否已有人選取
	// 記算預扣的倍數
	if( $_SESSION['zone_code'] == 1 )
	{	$tmp_Withhold_Mult = 3 ;	}
	else
	{	$tmp_Withhold_Mult = 1 ;	}

	// 取得會員還可以使用金額
	$tmp_MemberFreePoint = GodNine_getMemberFreeMmoney( $tmp_Member_ID ) ;
	// 下注預扣籌碼
	$tmp_Withhold_Chips = $_SESSION['Chips'] * $tmp_Withhold_Mult ;
	if( $tmp_Withhold_Chips > $tmp_MemberFreePoint )
	{	echo "-1,點數不足,下注失敗" ;exit;	}
	//else
	//{	echo "-1,$tmp_MemberFreePoint,$tmp_Withhold_Chips" ;exit;	}
	
	
	// 找出父ID
	$array_AgentInfo = WinHappy_getAgentInfo( $array_Member_Info['Member_Father_ID'] ) ;		// 取得代理人資料
	// 找出退水設定
	$array_BackWater_Info = func_DatabaseGet( "BackWater" , "*" , array("BackWater_Set_ID"=>$array_Member_Info['Member_Father_ID']) ) ;		// 取得資料庫資料
	
	// 找出莊家資料
	$tmpSQL_Banker = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND Banker_Room = '$tmp_RoomNum'" ;
	$array_Banker_Info = func_DatabaseGet( $tmpSQL_Banker , "SQL" , "" ) ;		// 取得資料庫資料

	// 求出莊家會員資料
	$array_Banker_Member_Info = GodNine_getMemberInfo( $array_Banker_Info['Banker_Set_ID'] ) ;		// 取得會員資料

	// 求出莊家代理人資料
	$array_Banker_Agent_Info = WinHappy_getAgentInfo( $array_Banker_Member_Info['Member_Father_ID'] ) ;		// 取得代理人資料

	// 找出ID
	//include($MAIN_BASE_ADDRESS . "includes/sub/sub_get_ID.sub") ;	// 載入會員編號產生器
	//$tempID = getID ( "4" , "ymd" , "BetGodnine" , "BetGodnine_ID" , "Bet") ;
	$tempID = "Bet" . strtotime(date("Y-m-d H:i:s")) . mt_rand(10000 , 99999) ;

	// 加入新訂單
	$arrayField_BetGodnine['BetGodnine_ID'] = $tempID ;				// 下注單號
	$arrayField_BetGodnine['BetGodnine_Agent_ID'] = $array_Member_Info['Member_Father_ID'];		// 代理人代號
	$arrayField_BetGodnine['BetGodnine_Member_ID'] = $_SESSION['Member_ID'] ;		// 下注會員代號
	$arrayField_BetGodnine['BetGodnine_Member_Name'] = $_SESSION['Member_Name'] ;		// 下注會員代號
	
	$arrayField_BetGodnine['BetGodnine_Bingo_Period'] = $array_BingoPeriod['NowBingo'] ;	// 開獎Bingo期號
	$arrayField_BetGodnine['BetGodnine_Chips'] = $_SESSION['Chips'] ;			// 下注籌碼
	$arrayField_BetGodnine['BetGodnine_Withhold_Chips'] = $tmp_Withhold_Chips ;		// 下注預扣籌碼
	$arrayField_BetGodnine['BetGodnine_Type'] = $_SESSION['zone_code'] ;			// 下注區
	$arrayField_BetGodnine['BetGodnine_Room'] = $tmp_RoomNum ;			// 下注房間
	$arrayField_BetGodnine['BetGodnine_Table'] = $table_number ;		// 佔位桌
	$arrayField_BetGodnine['BetGodnine_Chair'] = $chair_number ;		// 佔位椅子
	$arrayField_BetGodnine['BetGodnine_Num'] = $seat_number ;			// 佔位號
	$arrayField_BetGodnine['BetGodnine_Banker_Agent_ID'] = $array_Banker_Agent_Info['Agent_ID'] ;			// 莊家代理人代號ID
	$arrayField_BetGodnine['BetGodnine_Banker_ID'] = $array_Banker_Info['Banker_Set_ID'] ;			// 莊家代號ID
	$arrayField_BetGodnine['BetGodnine_Banker_Name'] = $array_Banker_Info['Banker_Operator_Name'] ;			// 莊家名稱
	$arrayField_BetGodnine['BetGodnine_Operate_IP'] = $_SERVER['REMOTE_ADDR'] ;				// 操作IP

	$tmp_BingoDate = WinHappy_subPeriod2Date($array_BingoPeriod['NowBingo']) ;		// Bingo期號轉時間
	
	$arrayField_BetGodnine['BetGodnine_Draw_DT'] = $tmp_BingoDate ;					// 開獎日期
	$arrayField_BetGodnine['BetGodnine_Add_DT'] = date("Y-m-d H:i:s") ;	// 押注時間
	$arrayField_BetGodnine['BetGodnine_On'] = "1" ;						// 權限

	// 設定閒家上線id
	$array_AgentList = WinHappy_getAgentList( $arrayField_BetGodnine['BetGodnine_Agent_ID'] , "A" , $tmp_First_Type) ;
	//取得上線'名稱','分成比','返水比','id'資料
	$arrayField_BetGodnine['BetGodnine_Online_id'] = "," . array2str($array_AgentList['I'] , ",") . "," ;							// 上線id
	//Bet_Online_id
	
	// 設定莊家上線id
	$array_AgentList_Banker = WinHappy_getAgentList( $array_Banker_Info['Banker_Set_ID'] , "A" , $tmp_First_Type) ;
	//取得上線'名稱','分成比','返水比','id'資料
	$arrayField_BetGodnine['BetGodnine_Banker_Online_id'] = "," . array2str($array_AgentList_Banker['I'] , ",") . "," ;							// 上線id
	//Bet_Online_id

	$Bol_BetGodnine = func_DatabaseBase( "BetGodnine" , "ADD" , $arrayField_BetGodnine , "" ) ;						// 資料庫處理
	if( $Bol_BetGodnine )
	{// STSRT 加入新訂單
		// 判斷訂單是否為第一筆
		$SQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND BetGodnine_Room = '$tmp_RoomNum' AND BetGodnine_Num = '$seat_number' AND BetGodnine_On = '1' ORDER BY id_BetGodnine" ;
		//echo $SQL . "<br>" ; 
		$QUERY = mysqli_query($link , $SQL) ;
		
		// 是否有資料
		if ( mysqli_num_rows($QUERY) )
		{
			// 一條條獲取
			while ($LIST = mysqli_fetch_assoc($QUERY))
			{
				if( $Bol_BetGodnine == $LIST['id_BetGodnine'] )
				{// 是第一筆
					// 查看下注後金額和金額否相同
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
					$array_LogInfo['Type'] = "下注" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
					$array_LogInfo['Info'] = "操作者 : {$_SESSION['Member_Name']} , 動作 : 下注 , 下注單號 : $tempID , 開獎Bingo期號 : {$array_BingoPeriod['NowBingo']} , 下注籌碼 : {$_SESSION['Chips']} , 下注房間 : " . GodNine_getRoomNum("E") . " , 佔位號 : $seat_number" ;			// 操作記錄 備註(可記錄新增會員ID,刪除ID)
					$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)
					$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
			
					// 會員操作-管理等級來判斷
					$tmpCode = func_WriteLogFieldInfo( "Member" , "Member_ID" , $_SESSION['Member_ID'] , "Member_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料
					$tmp_Remain_Money = (int)$array_Member_Info['Member_Money'] ; 
					
					echo "01,$tmp_Remain_Money" ;
					// 設定閒家點數
//					$tmpSQL_User_Money = "UPDATE Member SET Member_Money = Member_Money - {$arrayField_BetGodnine['BetGodnine_Withhold_Chips']} WHERE Member_ID = '{$_SESSION['Member_ID']}'" ;				// 欄位值+1
//					$Bol_User_Money = func_DatabaseBase( $tmpSQL_User_Money , "SQL" , "" , "" ) ;									// 資料庫處理
//					if ( $Bol_User_Money )
//					{
//						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
//						{	echo "<p>設定閒家點數-成功</p>" ;	}
//						// 加入金額Log
//						$arrayField_MoneyLog['MoneyLog_Set_ID'] = $_SESSION['Member_ID'] ;			// 設定者ID
//						$arrayField_MoneyLog['MoneyLog_Class'] = 1 ;									// 操作分類#::SELECT:2||1||會員||2||代理人::
//						$arrayField_MoneyLog['MoneyLog_Type'] = 1 ;									// 操作動作#::SELECT:2||0||其它||1||遊戲投注||2||遊戲派彩||3||存入||4||提出:
//						$arrayField_MoneyLog['MoneyLog_Bet_ID'] = $tempID ;			// 下注訂單號
//						$arrayField_MoneyLog['MoneyLog_Money'] = $arrayField_BetGodnine['BetGodnine_Withhold_Chips'] ;		// 操作金額
//						$arrayField_MoneyLog['MoneyLog_Original_Money'] = $array_Member_Info['Member_Money'] ;	// 操作前金額
//						$arrayField_MoneyLog['MoneyLog_Operator_IP'] = "" ;		// 操作者IP
//						$arrayField_MoneyLog['MoneyLog_Operator_ID'] = ""	 ;	// 操作者ID
//						$arrayField_MoneyLog['MoneyLog_Operator_Name'] = $array_Member_Info['Member_Name'] ;	// 操作者名稱
//						$arrayField_MoneyLog['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;				// 操作時間
//						
//						$Bol_MoneyLog = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField_MoneyLog , "" ) ;						// 資料庫處理
//
//						$tmp_Remain_Money = $array_Member_Info['Member_Money'] - $arrayField_BetGodnine['BetGodnine_Withhold_Chips'] ; 
//						echo "01,$tmp_Remain_Money" ;
//						
//					}
//					else
//					{
//						if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
//						{	echo "<p>設定閒家點數-失敗</p>" ;	}
//					}
					
				}
				else
				{// 不是第一筆則設為無效
					// 把"權限"改成無效或刪除
					$arrayField_SetOn['BetGodnine_On'] = 0 ;
					$Bol_SetOn = func_DatabaseBase( "BetGodnine" , "MOD" , $arrayField_SetOn , " id_BetGodnine = '$Bol_BetGodnine'" ) ;						// 資料庫處理
					if( $Bol_SetOn )
					{	echo "-1,對不起,已有人先選取本座位" ;	}
				}
			}
			
			// 釋放結果集合
			mysqli_free_result($QUERY);
		}
	}// END 加入新訂單-成功
	else// 加入新訂單-失敗
	{
		echo "-1,加入新訂單-失敗" ;
		echo "<p></p>" ;print_r($arrayField_BetGodnine);echo "<br>" ;
	}
}// END 此座位是否已有人選取

exit;

?>

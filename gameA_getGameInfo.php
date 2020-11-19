<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "取得目前遊戲資訊" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "gameA_getGameInfo.php" ;			// 設定本程式的檔名
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

// 是否已被別人後登入
$arrayModel["ID"] = $_SESSION['Member_ID'] ;					// 登入帳號ID
$arrayModel["ClearSession"] = "Member_ID,Member_Name" ;			// 需清空的SESSION值,用","來區別多個欄位
$arrayModel["AlertMsg"] = "此帳號已有人登入,你必須登出了" ;		// 需強制登出時秀出訊息
$arrayModel["AlertLink"] = "index.php?FUNCT=MemberLOGOUT" ;						// 需強制登出時前往Link
$arrayModel["Model"] = "Ajax" ;						// 處理模式(Alert:直接登出,Ajax:回傳參數)
func_checkRepeatLogin( $arrayModel ) ;		// 查詢是否重複登入

//echo "房間:".$_SESSION['zone_code'];

if( $_SESSION['zone_code'] == 2 OR $_SESSION['zone_code'] == 3 )
{
	// 長莊區會員10分鐘未下注,請重新登入系統
	$tmp_OnLineState = func_checkOnLineState( $_SESSION['Member_ID'] , 30 ) ;		// 取得會員是否在線
	if( $tmp_OnLineState == 0 AND $_SESSION['Member_ID'] != "" )
	{
		unset($_SESSION);
		echo  "-3,game.php?Funct=GodNineMemberLOGOUT" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
		exit;
	}
}
if( $_SESSION['zone_code'] == 1 )
{
	// 會員30分鐘未下注,請重新登入系統
	$tmp_OnLineState = func_checkOnLineState( $_SESSION['Member_ID'] , 30 ) ;		// 取得會員是否在線
	if( $tmp_OnLineState == 0 AND $_SESSION['Member_ID'] != "" )
	{
		unset($_SESSION);
		echo  "-3,game.php?Funct=GodNineMemberLOGOUT" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
		exit;
	}
}


GodNine_checkMember() ;		// 限制遊戲會員存取頁面

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "action||*" ;
$ARRAY_POST_GET_PARA[] = "countdown||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

// 當莊類型
$array_Banker_Wave_Type["Start"] = "";
$array_Banker_Wave_Type["End"] = "";
//$array_Banker_Wave_Type["Start"] = "頭波";
//$array_Banker_Wave_Type["End"] = "尾波";

//echo date("Y-m-d H:i:s") ;
/*
需回傳資料

位置設定
其他人的選位列表 : $array_Return['Other']
其他人的名稱列表 : $array_Return['Other_Name']
會員選位列表	:	$array_Return['User']
設定莊家是否可以選位 : $array_Return['Banker_Choose_Chair']
設定閒家是否可以選位 : $array_Return['Player_Choose_Chair']

點數相關
預扣點數-已不預扣 : $array_Return['Withhold_Money']
上期派彩點數 : $array_Return['Payout_Money']
上期輪莊區金額 : $array_Return['WinLost_Area1_Points']
上期長莊區金額 : $array_Return['WinLost_Area2_Points']
上期輸贏總計 : $array_Return['WinLost_Total_Points']
會員點數 : $array_Return['Member_Money']

莊家相關
設定近4期排莊資料 : $array_Return['Banker_List']
當莊類型(依當期為主)資料 : $array_Return['Banker_Wave_Type']
莊家選位 : $array_Return['Banker']
尾波提示文字-內定 : $array_Return['Banker_Wave_Type_Msg']
是否可以進行排莊 : $array_Return['Apply_Banker']

進行中
現在莊家名稱-X : $array_Return['Now_Banker_Name']

*/
// 把名稱改成金額-在派彩時用
$array_Return['User_WinLost_Money'] = "";
// 除錯訊息
$array_Return['Return_Msg'] = "";

$tmp_Real_Time = funct_ChangTime( date("Y-m-d H:i:s") , "PS" , 7 ) ;		// 改變時間

$array_BingoPeriod = WinHappy_checkBingoPeriod($tmp_Real_Time) ;		// 判斷Bingo期號
//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)

// 如果"等待開獎"和"派彩中"要秀出上期選位資料-設定期號欄位名稱
if( $action == "wait" OR $action == "payout" )
{	$tmp_Bingo_Period = $array_BingoPeriod['LastBingo'] ;	}
else if( $action == "banker" OR $action == "player" OR $action == "close" )
{
	$tmp_Bingo_Period = $array_BingoPeriod['NowBingo'] ;
}

$array_Return['Return_Msg'] = "改變時間 :$tmp_Real_Time , 本期期數 : {$array_BingoPeriod['NowBingo']} , 上一期期數 : {$array_BingoPeriod['LastBingo']} , 動作 : $action , 取得期數 : $tmp_Bingo_Period";


//20201021新增代理設定玩家連續期數未投注時鎖住再次投注期數
//每期閒家投注後關盤時開始設定會員無法投注設定
if( $action == "close" )
{
	
	//echo "取得期數:".$tmp_Bingo_Period." 本期期數:".$array_BingoPeriod['NowBingo']."<br>";
	
	$array_Member_Info = WinHappy_getMemberInfo( $_SESSION['Member_ID'] ) ;	// 取得會員資料
	$array_AgentInfo = WinHappy_getAgentInfo( $array_Member_Info['Member_Father_ID'] ) ; // 取得代理人資料
	
	//echo "會員Start_Count_Period:".$array_Member_Info['Start_Count_Period']." 會員Again_BetGodnine_Period:".$array_Member_Info['Again_BetGodnine_Period']." 會員代理超過期數開啟設定:".$array_AgentInfo['Over_Period_Set']." 會員代理隔幾期再下注設定:".$array_AgentInfo['Bet_Again_Period']."<br>";
	
	//確認會員有無投注
	$tmpSQL = "SELECT BetGodnine_Member_ID FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$tmp_Bingo_Period}' AND BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' AND BetGodnine_On = '1'" ;
	$Check_User_BetCount = func_DatabaseGet( $tmpSQL , "COUNT" , "" ) ;	// 取得資料庫資料
	//若沒有投注且沒有開始記錄期數
	if(($Check_User_BetCount<=0))
	{
		//登入後一開始當期就沒有投注
		if(!($array_Member_Info['Start_Count_Period']))
		{
			$array_Member_Info['Start_Count_Period'] = (int)$tmp_Bingo_Period + (int)$array_AgentInfo['Over_Period_Set']; //設定沒下注後哪一期後無法下注
			// 紀錄代理設定哪一期開始無法下注
			$tmpSQL_User_Start_Period = "UPDATE Member SET Start_Count_Period = {$array_Member_Info['Start_Count_Period']}, Again_BetGodnine_Period = '' WHERE Member_ID = '{$_SESSION['Member_ID']}'"; //欄位值填入期數
			$Bol_User_Start_Period = func_DatabaseBase( $tmpSQL_User_Start_Period , "SQL" , "" , "" ) ;	//資料庫處理
			//echo "沒有資料哦~<br>";
		}
		else if($array_Member_Info['Start_Count_Period']!="")
		{
			$New_BingoPeriod_OverSet = (int)$tmp_Bingo_Period + (int)$array_AgentInfo['Over_Period_Set']; //設定沒下注後哪一期後無法下注
			$New_BingoPeriod_BetAgain = (int)$tmp_Bingo_Period + (int)$array_AgentInfo['Bet_Again_Period']; //監隔下注期數相加
			
			$Old_BingoPeriod_OverSet = (int)$array_Member_Info['Start_Count_Period'] + (int)$array_AgentInfo['Over_Period_Set']; //計算資料庫期數與監隔下注期數相加
			$Old_BingoPeriod_BetAgain = (int)$array_Member_Info['Start_Count_Period'] + (int)$array_AgentInfo['Bet_Again_Period']; //計算資料庫期數與監隔下注期數相加
			
			//echo "現在期數:".$tmp_Bingo_Period." 相加後結果OverSet:".$array_Member_Info['Start_Count_Period']." 相加後結果BetAgain:".$Old_BingoPeriod_BetAgain."<br>";
			
			//若玩家開始記錄期數小於設定總期數代表登出很久玩家或是已滿足可下注玩家，則重新紀錄
			if($tmp_Bingo_Period>$Old_BingoPeriod_BetAgain)
			{
				// 紀錄代理設定哪一期開始無法下注
				$tmpSQL_User_ReStart_Period = "UPDATE Member SET Start_Count_Period = {$New_BingoPeriod_OverSet}, Again_BetGodnine_Period = '' WHERE Member_ID = '{$_SESSION['Member_ID']}'"; //欄位值填入期數
				$Bol_User_Start_Period = func_DatabaseBase( $tmpSQL_User_ReStart_Period , "SQL" , "" , "" ) ; //資料庫處理
				
			}
			else if($tmp_Bingo_Period==$array_Member_Info['Start_Count_Period']) //玩家未投注期數等於代理設定期數時
			{
				// 紀錄會員哪幾期無法下注
				$tmpSQL_User_Again_BetPeriod = "UPDATE Member SET Again_BetGodnine_Period = '{$New_BingoPeriod_BetAgain}' WHERE Member_ID = '{$_SESSION['Member_ID']}'"; //欄位值填入期數
				$Bol_User_Start_Period = func_DatabaseBase( $tmpSQL_User_Again_BetPeriod , "SQL" , "" , "" ) ; //資料庫處理
			}
			
			
			//清空加總資料
			$New_BingoPeriod_OverSet = '';
			$New_BingoPeriod_BetAgain = '';
			$Old_BingoPeriod_OverSet = '';
			$Old_BingoPeriod_BetAgain = '';
			
		}
		
	}
	else //若有投注的情況下
	{
		
		$array_Member_Info['Start_Count_Period'] = (int)$tmp_Bingo_Period + (int)$array_AgentInfo['Over_Period_Set']; //設定沒下注後哪一期後無法下注
		// 紀錄代理設定哪一期開始無法下注
		$tmpSQL_User_Start_Period = "UPDATE Member SET Start_Count_Period = {$array_Member_Info['Start_Count_Period']}, Again_BetGodnine_Period = '' WHERE Member_ID = '{$_SESSION['Member_ID']}'"; //欄位值填入期數
		$Bol_User_Start_Period = func_DatabaseBase( $tmpSQL_User_Start_Period , "SQL" , "" , "" ) ;	//資料庫處理
		
	}


	if($countdown >= 10)
	{
		//關盤時確認有無未來投注
		$tmpSQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period > '{$array_BingoPeriod['NowBingo']}' AND BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' AND BetGodnine_On = '1'" ;
		$Check_BetCount = func_DatabaseGet( $tmpSQL , "COUNT" , "" ) ;	// 取得資料庫資料

		//如果有未來投注則將投注權限變更為0
		if($Check_BetCount>=1)
		{
			$tmpSQL_User_Edit_Period = "UPDATE BetGodnine SET BetGodnine_On = '0',	BetGodnine_Bingo_NowPeriod = '{$array_BingoPeriod['NowBingo']}' WHERE BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' AND BetGodnine_Bingo_Period > '{$array_BingoPeriod['NowBingo']}'"; //欄位值填入期數
			$Bol_User_Edit_Period = func_DatabaseBase( $tmpSQL_User_Edit_Period , "SQL" , "" , "" ) ;	//資料庫處理
		}

	}


}
	
//echo $action." 本期期數:{$array_BingoPeriod['NowBingo']}<br>";

// 在莊家選位和等待是不要秀出其它和自己選位
if( !($action == "banker" OR $action == "close") )
{
	// 其他人選位資料
	$array_OtherSeatInfo = GodNine_getOtherSeatNumber($tmp_Bingo_Period) ;		// 取得本期其他人的選位列表
	$array_Return['Other'] = $array_OtherSeatInfo['Num'] ;		// 其他人的選位列表 1,2,3...40
	$array_Return['Other_Name'] = $array_OtherSeatInfo['Name'] ;		// 其他人的名稱列表 會員1,會員2...會員40
	
	// 會員自己選位資料
	//$array_User = srt2array(GodNine_getUserSeatNumber($tmp_Bingo_Period) , "|") ;		// 會員選位1,2,3...40
	//$array_Return['User'] = $array_User[0] ;		// 會員選位1,2,3...40
	$array_Return['User'] = GodNine_getUserSeatNumber($tmp_Bingo_Period) ;		// 會員選位1,2,3...40
	
	//echo "-4," . $array_Return['User'] ;
	//exit;
}
else
{// 清空會員資料
	$array_Return['Other'] = "" ;		// 其他人的選位列表 1,2,3...40
	$array_Return['Other_Name'] = "" ;		// 其他人的名稱列表 會員1,會員2...會員40
	
	// 會員自己選位資料
	$array_Return['User'] = "" ;		// 會員選位1,2,3...40
}
// 預扣點數-已不預扣
$array_Return['Withhold_Money'] = GodNine_getMember_Withhold_Points( $_SESSION['Member_ID'] ) ;

// 派彩最後10秒秀出-派彩金額,把座子改成金額
if( $action == "payout" AND $countdown <= 10 )
{
	// 會員自己選位資料
	//$array_Return['User'] = GodNine_getUserSeatNumber($tmp_Bingo_Period) ;		// 會員選位1,2,3...40
	if( $array_Return['User'] )
	{// 把名稱改成金額
		$array_Return['User_WinLost_Money'] = GodNine_getUserSeatNumber($tmp_Bingo_Period , "" , 1);
	}

	// 上期派彩點數
	$array_Return['Payout_Money'] = GodNine_getMember_LastPayoutPoints( $_SESSION['Member_ID'] ) ;

	// 取得會員上期輸贏點數
	$array_LastWinLostPoints = GodNine_getMember_LastWinLostPoints("") ;		// 取得會員上期輸贏點數
	
	// 上期輪莊區金額
	$array_Return['WinLost_Area1_Points'] = $array_LastWinLostPoints['WinLost_Area1_Points'] ;
	// 上期長莊區金額
	$array_Return['WinLost_Area2_Points'] = $array_LastWinLostPoints['WinLost_Area2_Points'] ;
	// 上期長莊區有倍率金額
	$array_Return['WinLost_Area3_Points'] = $array_LastWinLostPoints['WinLost_Area3_Points'] ;
	// 上期輸贏總計
	$array_Return['WinLost_Total_Points'] = $array_LastWinLostPoints['WinLost_Total_Points'] ;

}
else
{
	// 上期派彩點數
	$array_Return['Payout_Money'] = 0;
	// 上期輪莊區金額
	$array_Return['WinLost_Area1_Points'] = 0 ;
	// 上期長莊區金額
	$array_Return['WinLost_Area2_Points'] = 0 ;
	// 上期長莊區有倍率金額
	$array_Return['WinLost_Area3_Points'] = 0 ;
	// 上期輸贏總計
	$array_Return['WinLost_Total_Points'] = 0 ;
}

// 設定近4期排莊資料
$array_Return['Banker_List'] = GodNine_htmlBankerArea($action) ;

$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號

// 找出該時段莊家資料(依執行時間來判斷)
//$tmpSQL = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$tmp_Bingo_Period}' AND Banker_Room = '$tmp_RoomNum' AND Banker_Set_ID = '{$_SESSION['Member_ID']}'" ;
$tmpSQL = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$tmp_Bingo_Period}' AND Banker_Room = '$tmp_RoomNum'" ;
$array_Banker_Step_Info = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料

// 找出本期莊家資料
$tmpSQL = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND Banker_Room = '$tmp_RoomNum'" ;
$array_Now_Banker_Info = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料

// 如果莊家在果"等待開獎"和"派彩中"要秀出上期位置
// "當莊類型(依當期為主)"資料
$array_Return['Banker_Wave_Type'] = "排莊" ;

// 是否有莊家資料(依執行時間來判斷)
if( $array_Banker_Step_Info['Banker_Set_ID'] )
{// 有莊家
	//$array_Return['Banker'] = $array_Now_Banker_Info['Banker_Banker_Seats'] ;		// 莊家選位1,2
	$array_Return['Banker'] = $array_Banker_Step_Info['Banker_Banker_Seats'] ;		// 莊家選位1,2
}
else
{// 沒有莊家
	// 如果為長莊區則內定39,40
	if( $_SESSION['zone_code'] == 2 OR $_SESSION['zone_code'] == 3 )
	{	
		
		//找出莊家排莊資訊，若無則顯示Ｔ,有則顯示莊家資訊
		$Bankset_Info = "SELECT * FROM `Banker2` WHERE Banker_Bingo_Period = '{$array_BingoPeriod['NowBingo']}'";
		$array_Bankset_Info = func_DatabaseGet( $Bankset_Info , "SQL" , "" );		// 取得資料庫資料
		
		if(!$array_Bankset_Info['Banker_Bingo_Period'] OR $array_Bankset_Info['Banker_Bingo_Period']==0)
		{
			$array_Return['Banker'] = "39,40"; //莊家初始值
			$tmp_Now_Banker_Name = "T桌";
		}
		else
		{
			if(($action == "wait")||($action == "payout"))
			{
				$Back_Bankset_Info = "SELECT * FROM `Banker2` WHERE Banker_Bingo_Period = '{$array_BingoPeriod['LastBingo']}'";
				$array_Back_Bankset_Info = func_DatabaseGet( $Back_Bankset_Info , "SQL" , "" );		// 取得資料庫資料
				
				if(!$array_Back_Bankset_Info['Banker_Bingo_Period'] OR $array_Back_Bankset_Info['Banker_Bingo_Period']==0)
				{
					$array_Return['Banker'] = "39,40"; //莊家初始值
					$tmp_Now_Banker_Name = "T桌";
				}
				else
				{
					$array_Return['Banker'] = $array_Back_Bankset_Info['Banker_Banker_Seats']; //莊家初始值
					$tmp_Now_Banker_Name = $array_Back_Bankset_Info['Banker_Banker_Table'];
				}
			}
			else
			{
				$array_Return['Banker'] = $array_Bankset_Info['Banker_Banker_Seats']; //莊家初始值
				$tmp_Now_Banker_Name = $array_Bankset_Info['Banker_Banker_Table'];
			}		
		}
		
		/*
		$array_Return['Banker'] = "39,40"; //莊家初始值
		
		//找出莊家為值切換資料並將json解回Array
		$tmp_BankerList_SQL = "SELECT ApplyBanker_Set_Array FROM Agent WHERE id_Agent=1" ; 
		$array_BankerList_Info = func_DatabaseGet( $tmp_BankerList_SQL , "SQL" , "" )['ApplyBanker_Set_Array'];		// 取得資料庫資料
		$array_BankerList_Info = json_decode($array_BankerList_Info,true);
		
		//當資料庫是NULL時不啟動這些切換方法開始
		if($array_BankerList_Info!="")
		{
		
		//長莊位置切換狀態關閉時
		if($array_BankerList_Info['State']=="-1")
		{
			
			//判斷若第一次設定或設定期數小於目前期數則重置(長莊位置切換為隨機或依序)
			if((!$array_BankerList_Info['Now_Banker_Seat'])||(!$array_BankerList_Info['Now_Period'])||($array_BankerList_Info['Next_Period']<$array_BingoPeriod['NowBingo']))
			{
				if(!$array_BankerList_Info['last_Period'])
				{
					$array_Return['Banker'] = "39,40";
				}
				else
				{
					$array_Return['Banker'] = $array_BankerList_Info['last_Banker_Seat'];
				}

				$array_BankerList_Info['last_Period'] = $array_BingoPeriod['NowBingo'];
				$array_BankerList_Info['last_Banker_Seat'] = $array_Return['Banker'];


				$array_BankerList_Info['Now_Period'] = $array_BingoPeriod['NowBingo'];
				$array_BankerList_Info['Now_Banker_Seat'] = $array_Return['Banker'];

				$array_BankerList_Info['Next_Period'] = $array_BingoPeriod['NowBingo']+1;
				$array_BankerList_Info['Next_Banker_Seat'] = $array_BankerList_Info['Banker_Info'][0]['Banker'];

			}
			else
			{

				if($array_BankerList_Info['Now_Period']==$array_BingoPeriod['NowBingo'])
				{

					if(($action == "wait")||($action == "payout"))
					{
						if(!$array_BankerList_Info['last_Period'])
						{
							//莊家初始值
							$array_Return['Banker'] = "39,40";

						}
						else
						{
							//擺放上一期莊家位置
							$array_Return['Banker'] = $array_BankerList_Info['last_Banker_Seat'];
						}
					}

					//紀錄當期莊家位置
					if(($action == "banker")||($action == "player")||($action == "close"))
					{

						//擺放現在莊家位置
						$array_Return['Banker'] = $array_BankerList_Info['Now_Banker_Seat'];

						//現在莊家位置資訊
						$array_BankerList_Info['Now_Period'] = $array_BingoPeriod['NowBingo'];
						$array_BankerList_Info['Now_Banker_Seat'] = $array_BankerList_Info['Now_Banker_Seat'];

						//上一期莊家位置資訊
						$array_BankerList_Info['last_Period'] = $array_BingoPeriod['NowBingo'];
						$array_BankerList_Info['last_Banker_Seat'] = $array_BankerList_Info['Now_Banker_Seat'];

						//下一期莊家位置資訊
						$array_BankerList_Info['Next_Period'] = $array_BingoPeriod['NowBingo']+1;
						$array_BankerList_Info['Next_Banker_Seat'] = "39,40";

					}

				}


				//下一期等於本期期數時把現有狀態全部+1
				if($array_BankerList_Info['Next_Period']==$array_BingoPeriod['NowBingo'])
				{

					if(($action == "wait")||($action == "payout"))
					{

						//$array_BankerList_Info['last_Period'] = $array_BingoPeriod['NowBingo']-1;
						//$array_BankerList_Info['last_Banker_Seat'] = $array_BankerList_Info['Now_Banker_Seat'];

						$array_BankerList_Info['Now_Period'] = $array_BingoPeriod['NowBingo'];
						$array_BankerList_Info['Now_Banker_Seat'] = "39,40";

						//擺放上一期莊家位置
						$array_Return['Banker'] = $array_BankerList_Info['last_Banker_Seat'];

					}
					else
					{


						//$array_BankerList_Info['last_Period'] = $array_BingoPeriod['NowBingo']-1;
						//$array_BankerList_Info['last_Banker_Seat'] = $array_BankerList_Info['Now_Banker_Seat'];
						if($countdown <= 2)
						{
							//擺放上一期莊家位置
							$array_Return['Banker'] = $array_BankerList_Info['last_Banker_Seat'];
						}
						else
						{
							$array_BankerList_Info['Now_Period'] = $array_BingoPeriod['NowBingo'];
							$array_BankerList_Info['Now_Banker_Seat'] = "39,40";

							//擺放上一期莊家位置
							$array_Return['Banker'] = $array_BankerList_Info['Now_Banker_Seat'];
						}

					}

				}


			}
			
			
			
		}
		else
		{
			
			//判斷若第一次設定或設定期數小於目前期數則重置(長莊位置切換為隨機或依序)
			if((!$array_BankerList_Info['Now_Banker_Seat'])||(!$array_BankerList_Info['Now_Period'])||($array_BankerList_Info['Next_Period']<$array_BingoPeriod['NowBingo']))
			{
				if(!$array_BankerList_Info['last_Period'])
				{
					$array_Return['Banker'] = "39,40";
				}
				else
				{
					$array_Return['Banker'] = $array_BankerList_Info['last_Banker_Seat'];
				}
				
				$array_BankerList_Info['last_Period'] = $array_BingoPeriod['NowBingo'];
				$array_BankerList_Info['last_Banker_Seat'] = $array_Return['Banker'];

				$array_BankerList_Info['Now_Period'] = $array_BingoPeriod['NowBingo'];
				$array_BankerList_Info['Now_Banker_Seat'] = $array_Return['Banker'];

				$array_BankerList_Info['Next_Period'] = $array_BingoPeriod['NowBingo']+1;
				$array_BankerList_Info['Next_Banker_Seat'] = $array_BankerList_Info['Banker_Info'][0]['Banker'];

			}
			else
			{

				if($array_BankerList_Info['Now_Period']==$array_BingoPeriod['NowBingo'])
				{

					if(($action == "wait")||($action == "payout"))
					{
						if(!$array_BankerList_Info['last_Period'])
						{
							//莊家初始值
							$array_Return['Banker'] = "39,40";

						}
						else
						{
							//擺放上一期莊家位置
							$array_Return['Banker'] = $array_BankerList_Info['last_Banker_Seat'];
						}
						
						//上一期莊家位置資訊
						$array_BankerList_Info['last_Period'] = $array_BingoPeriod['LastBingo'];
						$array_BankerList_Info['last_Banker_Seat'] = $array_Return['Banker'];
						
						
					}

					//紀錄當期莊家位置
					if(($action == "banker")||($action == "player")||($action == "close"))
					{

						//擺放現在莊家位置
						$array_Return['Banker'] = $array_BankerList_Info['Now_Banker_Seat'];

						//現在莊家位置資訊
						$array_BankerList_Info['Now_Period'] = $array_BingoPeriod['NowBingo'];
						$array_BankerList_Info['Now_Banker_Seat'] = $array_BankerList_Info['Now_Banker_Seat'];
					
						//更新上一期莊家位置資訊
						$array_BankerList_Info['last_Period'] = $array_BingoPeriod['NowBingo'];
						$array_BankerList_Info['last_Banker_Seat'] = $array_BankerList_Info['Now_Banker_Seat'];
						
						//下一期依序輪位判斷
						for($i=0;$i<count($array_BankerList_Info['Banker_Info']);$i++)
						{

							if($array_BankerList_Info['Banker_Info'][$i]['Banker']==$array_BankerList_Info['Now_Banker_Seat'])
							{

								if($i==(count($array_BankerList_Info['Banker_Info'])-1))
								{
									//下一期莊家位置資訊
									$array_BankerList_Info['Next_Period'] = $array_BingoPeriod['NowBingo']+1;
									$array_BankerList_Info['Next_Banker_Seat'] = $array_BankerList_Info['Banker_Info'][0]['Banker'];
								}
								else
								{
									$i++;
									//下一期莊家位置資訊
									$array_BankerList_Info['Next_Period'] = $array_BingoPeriod['NowBingo']+1;
									$array_BankerList_Info['Next_Banker_Seat'] = $array_BankerList_Info['Banker_Info'][$i]['Banker'];
								}

							}

						}

					}

				}

				
				//下一期等於本期期數時把現有狀態全部+1
				if($array_BankerList_Info['Next_Period']==$array_BingoPeriod['NowBingo'])
				{

					if(($action == "wait")||($action == "payout"))
					{

						//$array_BankerList_Info['last_Period'] = $array_BingoPeriod['NowBingo']-1;
						//$array_BankerList_Info['last_Banker_Seat'] = $array_BankerList_Info['Now_Banker_Seat'];
						
						//擺放上一期莊家位置
						$array_Return['Banker'] = $array_BankerList_Info['last_Banker_Seat'];
						
						$array_BankerList_Info['Now_Period'] = $array_BingoPeriod['NowBingo'];
						$array_BankerList_Info['Now_Banker_Seat'] = $array_BankerList_Info['Next_Banker_Seat'];

						

					}
					else
					{


						//$array_BankerList_Info['last_Period'] = $array_BingoPeriod['NowBingo']-1;
						//$array_BankerList_Info['last_Banker_Seat'] = $array_BankerList_Info['Now_Banker_Seat'];
						if($countdown <= 2)
						{
							//擺放上一期莊家位置
							$array_Return['Banker'] = $array_BankerList_Info['last_Banker_Seat'];
						}
						else
						{
							$array_BankerList_Info['Now_Period'] = $array_BingoPeriod['NowBingo'];
							$array_BankerList_Info['Now_Banker_Seat'] = $array_BankerList_Info['Next_Banker_Seat'];

							//擺放上一期莊家位置
							$array_Return['Banker'] = $array_BankerList_Info['Now_Banker_Seat'];
						}

					}

				}
				

			}
		
		}
			
		$array_BankerList_Info = json_encode($array_BankerList_Info,JSON_UNESCAPED_UNICODE);
		
		$Update_BankerList_Info = "UPDATE Agent SET ApplyBanker_Set_Array = '".$array_BankerList_Info."' WHERE id_Agent=1"; //欄位值填入期數
		$Bol_Update_BankerList = func_DatabaseBase( $Update_BankerList_Info , "SQL" , "" , "" ) ;	//資料庫處理
		
		
		}//當資料庫是NULL時不啟動這些切換方法結束
		*/
		//print_r($array_BankerList_Info);
		
	}
	else
	{	$array_Return['Banker'] = "" ;	}
}

// 設定是否可以選位
$array_Return['Banker_Choose_Chair'] = false ;	// 設定莊家是否可以選位
$array_Return['Player_Choose_Chair'] = false ;	// 設定閒家是否可以選位
$array_Return['Banker_Wave_Type_Msg'] = "" ;	// 尾波提示文字-內定

if( $_SESSION['zone_code'] == 2 OR $_SESSION['zone_code'] == 3 )
{// 長莊區
	if( $action == "player" )
	{
		$array_Return['Banker_Choose_Chair'] = false ;	// 設定莊家是否可以選位
		$array_Return['Player_Choose_Chair'] = true ;	// 設定閒家是否可以選位
	}
}
else if( $action == "banker" AND $array_Now_Banker_Info['Banker_Set_ID'] == $_SESSION['Member_ID'] )
{// 莊家選號,且為自己當莊
	$array_Return['Player_Choose_Chair'] = false ;	// 設定閒家是否可以選位
	// -如果為尾波,莊家不能選位
	if( $array_Banker_Step_Info['Banker_Wave_Type'] == "End" )
	{
		$array_Return['Banker_Choose_Chair'] = false ;		// 設定莊家是否可以選位
		$array_Return['Banker_Wave_Type_Msg'] = "尾波莊家不得換位" ;	// 尾波提示文字
	}
	else// 設定莊家是否可以選位
	{	$array_Return['Banker_Choose_Chair'] = true ;	}

}
else if( $action == "player" AND $array_Now_Banker_Info['Banker_Set_ID'] AND $array_Now_Banker_Info['Banker_Set_ID'] != $_SESSION['Member_ID'] )
{// 閒家選號,且沒有流局,且不是自己當莊
	$array_Return['Banker_Choose_Chair'] = false ;	// 設定莊家是否可以選位
	//$array_Return['Player_Choose_Chair'] = false ;	// 設定閒家是否可以選位
	$array_Return['Player_Choose_Chair'] = true ;	// 設定閒家是否可以選位
}

// 找出本房間排莊人數
$SQL_ApplyBanker_Count = "SELECT * FROM ApplyBanker WHERE ( ApplyBanker_Bingo_Period_Start >= '{$array_BingoPeriod['NowBingo']}' OR  ApplyBanker_Bingo_Period_End >= '{$array_BingoPeriod['NowBingo']}' ) AND ApplyBanker_Room = '$tmp_RoomNum' AND ApplyBanker_On = '1'" ;
$Count_ApplyBanker_Count = func_DatabaseGet( $SQL_ApplyBanker_Count , "COUNT" , "" ) ;		// 取得資料庫資料

// 是否可以排莊,最後一期已有人當,已有4人排莊中
// 已有4人排莊中
if( $Count_ApplyBanker_Count >= 4 )
{	$array_Return['Apply_Banker'] = false ;	}
else
{// 排莊人數少於4
	// 是否還有當莊期數
	$array_StratEnd_Bingo_Period = WinHappy_getStratEnd_Bingo_Period( date("Y-m-d") ) ;		// 取得某日開獎的第一期和最後一期號碼
	// Start : 第一期 , End : 最後一期
	
	// 查詢當莊資料
	$tmp_BankerList_SQL = "SELECT * FROM Banker ORDER BY Banker_Bingo_Period DESC" ;
	$array_BankerList_Info = func_DatabaseGet( $tmp_BankerList_SQL , "SQL" , "" ) ;		// 取得資料庫資料

	$tmpSplitDate = getSplitDate( date("Y-m-d H:i:s") , "A") ;			// 全部分析
	
	// 是否已超過23:55
	if( $tmpSplitDate[3] == 23 AND $tmpSplitDate[4] >= 55 )
	{	$array_Return['Apply_Banker'] = false ;	}
	// 當莊資料的最後一期是否為今日最後一期
	else if( $array_BankerList_Info['Banker_Bingo_Period'] >= $array_StratEnd_Bingo_Period['End'] )
	{	$array_Return['Apply_Banker'] = false ;	}
	else
	{	$array_Return['Apply_Banker'] = true ;	}
}

// 取得會員資料
$array_Member_Info = GodNine_getMemberInfo( $_SESSION['Member_ID'] ) ;

// 設定會員目前的點數欄位名稱-在莊家選位前秀出開獎前金額-Member_BetRegMoney
$tmp_Money_Name = "Member_Money" ;

if( $action == "wait" OR $action == "payout" )	// 等待開獎,派彩
{
	if( $array_Banker_Step_Info['Banker_Banker_Seats'] )
	{	$array_Return['Banker'] = $array_Banker_Step_Info['Banker_Banker_Seats'] ;	}
	
//	// 是否有上期投注資料
//	$Count_BetGodnine = func_DatabaseGet( "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BingoPeriod['LastBingo']}' AND BetGodnine_Member_ID = '{$_SESSION['Member_ID']}' AND BetGodnine_On = '1'" , "COUNT" , "" ) ;		// 取得資料庫資料
//
//	// 是否有上期當莊資料
//	//$Count_Banker = func_DatabaseGet( "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$array_BingoPeriod['LastBingo']}' AND Banker_Set_ID = '{$_SESSION['Member_ID']}'" , "COUNT" , "" ) ;		// 取得資料庫資料
//	if( $Count_BetGodnine > 0 OR $array_BankerEnd_Info['id_Banker'] )
//	{	$tmp_Money_Name = "Member_BetRegMoney" ;	}
	$tmp_Money_Name = "Member_BetRegMoney" ;
}
else
{
	// 如果點數不相同則設定-下注後金額-Member_BetRegMoney
		// 如果下注後金額設成現有金額不相同則設成相同
		if( $array_Member_Info['Member_BetRegMoney'] != $array_Member_Info['Member_Money'] )
		{
			$arrayField['Member_BetRegMoney'] = $array_Member_Info['Member_Money'] ;
			$Bol = func_DatabaseBase( "Member" , "MOD" , $arrayField , " Member_ID = '{$_SESSION['Member_ID']}'" ) ;						// 資料庫處理
		}
	
}

// 會員點數
$array_Return['Member_Money'] = (int)$array_Member_Info[$tmp_Money_Name] ;	// 

// 現在莊家名稱
if( $_SESSION['zone_code'] == 2 OR $_SESSION['zone_code'] == 3 )
{	
	/*
	$tmp_Now_Banker_Name = "T桌";	
	
	//找出莊家為值切換資料並將json解回Array
	$tmp_BankerList_SQL = "SELECT ApplyBanker_Set_Array FROM Agent WHERE id_Agent=1" ; 
	$array_BankerList_Info = func_DatabaseGet( $tmp_BankerList_SQL , "SQL" , "" )['ApplyBanker_Set_Array'];		// 取得資料庫資料
	$array_BankerList_Info = json_decode($array_BankerList_Info,true);
		
	//判斷若第一次設定或設定期數小於目前期數則重置
	if((!$array_BankerList_Info['Now_Banker_Seat'])||(!$array_BankerList_Info['Now_Period'])||($array_BankerList_Info['Next_Period']<$array_BingoPeriod['NowBingo']))
	{			
		$tmp_Now_Banker_Name = "T桌";
	}
	else
	{
		if($array_BankerList_Info['Now_Period']==$array_BingoPeriod['NowBingo'])
		{
		
			if(($action == "wait")||($action == "payout"))
			{
				if(!$array_BankerList_Info['last_Period'])
				{
					//莊家初始值
					$tmp_Now_Banker_Name = "T桌";
				}
				else
				{
					
					//尋找桌次
					for($i=0;$i<count($array_BankerList_Info['Banker_Info']);$i++)
					{

						if($array_BankerList_Info['Banker_Info'][$i]['Banker']==$array_BankerList_Info['last_Banker_Seat'])
						{

							//擺放上一期莊家位置
							$tmp_Now_Banker_Name = $array_BankerList_Info['Banker_Info'][$i]['Banker_Name'];
						}

					}

				}
			}
			
			//紀錄當期莊家位置
			if(($action == "banker")||($action == "player")||($action == "close"))
			{
				
				//尋找桌次
				for($i=0;$i<count($array_BankerList_Info['Banker_Info']);$i++)
				{

					if($array_BankerList_Info['Banker_Info'][$i]['Banker']==$array_BankerList_Info['Now_Banker_Seat'])
					{
						//擺放上一期莊家位置
						$tmp_Now_Banker_Name = $array_BankerList_Info['Banker_Info'][$i]['Banker_Name'];
					}

				}

			}
			
		}
		
		
		//下一期等於本期期數時把現有狀態全部+1
		if($array_BankerList_Info['Next_Period']==$array_BingoPeriod['NowBingo'])
		{
				
			if(($action == "wait")||($action == "payout"))
			{
				//尋找桌次
				for($i=0;$i<count($array_BankerList_Info['Banker_Info']);$i++)
				{

					if($array_BankerList_Info['Banker_Info'][$i]['Banker']==$array_BankerList_Info['last_Banker_Seat'])
					{

						//擺放上一期莊家位置
						$tmp_Now_Banker_Name = $array_BankerList_Info['Banker_Info'][$i]['Banker_Name'];
					}

				}
			}
			else
			{

				if($countdown <= 2)
				{
					//尋找桌次
					for($i=0;$i<count($array_BankerList_Info['Banker_Info']);$i++)
					{

						if($array_BankerList_Info['Banker_Info'][$i]['Banker']==$array_BankerList_Info['last_Banker_Seat'])
						{

							//擺放上一期莊家位置
							$tmp_Now_Banker_Name = $array_BankerList_Info['Banker_Info'][$i]['Banker_Name'];
						}

					}
				}
				else
				{
					//尋找桌次
					for($i=0;$i<count($array_BankerList_Info['Banker_Info']);$i++)
					{

						if($array_BankerList_Info['Banker_Info'][$i]['Banker']==$array_BankerList_Info['Now_Banker_Seat'])
						{
							//擺放上一期莊家位置
							$tmp_Now_Banker_Name = $array_BankerList_Info['Banker_Info'][$i]['Banker_Name'];
						}

					}
				}
					
			}
				
		}
		
	}
	*/

}
else if( $array_Banker_Step_Info['Banker_Set_ID'] )
{
	$array_Member_Banker_Info = GodNine_getMemberInfo( $array_Banker_Step_Info['Banker_Set_ID'] ) ;		// 取得會員資料

	// 找出頭尾波
	if( $array_Banker_Step_Info['Banker_Wave_Type'] )
	{	$tmp_Banker_Wave_Type = "<span style='color:#7E0003;'>{$array_Banker_Wave_Type[$array_Banker_Step_Info['Banker_Wave_Type']]}</span>" ;	}

	$tmp_Now_Banker_Name = "<span class='Now_Banker_Name_Span'>{$tmp_Banker_Wave_Type}" . mb_substr($array_Member_Banker_Info['Member_Name'] , 0 , 3 , "utf-8") . "</span>" ;
}
else
{	$tmp_Now_Banker_Name = "流局" ;	}

//$array_Return['Now_Banker_Name'] = $tmp_Now_Banker_Name.$action."-".$countdown."<br>".$tmp_Bingo_Period."<br>".$array_Banker_Step_Info['Banker_Set_ID'] ;	// 
$array_Return['Now_Banker_Name'] = $tmp_Now_Banker_Name ;	// 

echo json_encode($array_Return);
exit;

?>

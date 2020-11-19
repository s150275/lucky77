<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "設定莊家選號" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "gameA_setBankerSeat.php" ;			// 設定本程式的檔名
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

GodNine_setMemberINRoomInfo() ;		// 設定會員進入房間資訊

$Bol = func_setOnLineInfo( $_SESSION['Member_ID'] , 1  , "OnLine_Bet_DT" ) ;		// 記錄會員在線資訊和下注時間

$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
//(NowBingo:本期期數,NowBingo_Time:本期期數開獎日期,LastBingo:上一期期數,LastBingo_Time:上一期期數開獎日期)

$tmp_RoomNum = GodNine_getRoomNum() ;		// 取得房間編號

// 找出本期莊家設定資料
//$tmpSQL_Banker = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND Banker_Room = '$tmp_RoomNum' AND Banker_Set_ID = '{$_SESSION['Member_ID']}'" ;
$tmpSQL_Banker = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$array_BingoPeriod['NowBingo']}' AND Banker_Room = '$tmp_RoomNum'" ;
$array_Banker_Info = func_DatabaseGet( $tmpSQL_Banker , "SQL" , "" ) ;		// 取得資料庫資料

// 是否為本期莊家
if( $array_Banker_Info['Banker_Set_ID'] == $_SESSION['Member_ID'] )
{
	// 求出要設定的莊家位置
	$tmp_Banker_First_Seats = ($table_number-1)*2 +1 ;
	$tmp_Banker_Second_Seats = $tmp_Banker_First_Seats+1 ;
	$tmp_Banker_Seats = $tmp_Banker_First_Seats . "," . $tmp_Banker_Second_Seats ;
	$arrayField['Banker_Banker_Table'] = $table_number ;
	$arrayField['Banker_Banker_Seats'] = $tmp_Banker_Seats ;
	$Bol = func_DatabaseBase( "Banker" , "MOD" , $arrayField , " id_Banker = '{$array_Banker_Info['id_Banker']}'" ) ;						// 資料庫處理
	
	// 加入操作LOG
	$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
	$array_LogInfo['OperatorID'] = $_SESSION['Member_ID'] ;		// 操作者ID
	$array_LogInfo['OperatorName'] = $_SESSION['Member_Name'] ;	// 操作者姓名
	$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
	$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
	$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
	$array_LogInfo['Type'] = "莊家選位" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
	$array_LogInfo['Info'] = "操作者 : {$_SESSION['Member_Name']} , 操作者ID : {$_SESSION['id_Member']} , 動作 : 莊家選位 , 莊家選位ID : {$array_Banker_Info['id_Banker']} , 莊家Bingo期號 : {$array_Banker_Info['Banker_Bingo_Period']} , 下注房間 : " . GodNine_chnageRoomNum( $array_Banker_Info['Banker_Room'] ) . " , 選擇桌號 : $table_number" ;			// 操作記錄 備註(可記錄新增會員ID,刪除ID)
	$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)
	$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP

	// 會員操作-管理等級來判斷
	$tmpCode = func_WriteLogFieldInfo( "Member" , "Member_ID" , $_SESSION['Member_ID'] , "Member_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料
	
	// 如果為首波莊家選位,則要把尾波莊家也改成相同位置
	if( $array_Banker_Info['Banker_Wave_Type'] == "Start" )
	{
		$tmp_Last_BingoPeriod = $array_BingoPeriod['NowBingo'] + 1 ;
		// 找出下期莊家設定資料
		//$tmpSQL_Next_Banker = "SELECT * FROM Banker WHERE Banker_Bingo_Period = '{$tmp_Last_BingoPeriod}' AND Banker_Wave_Type = 'END' AND Banker_Set_ID = '{$_SESSION['Member_ID']}'" ;

		$tmpSQL_Next_Banker = "UPDATE Banker SET Banker_Banker_Table = '$table_number', Banker_Banker_Seats = '$tmp_Banker_Seats' WHERE  Banker_Bingo_Period = '{$tmp_Last_BingoPeriod}' AND Banker_Wave_Type = 'END' AND Banker_Set_ID = '{$_SESSION['Member_ID']}'" ;	// 修改
		$Bol_Next_Banker = func_DatabaseBase( $tmpSQL_Next_Banker , "SQL" , "" , "" ) ;									// 資料庫處理
		if ( $Bol_Next_Banker )
		{	echo "01,新設定莊家選位已成功";	}
		else
		{	echo "-11,新設定尾波莊家選位-失敗";	}
	}
	
}
else
{
	echo "-1,本期非您當莊,不可進行選位";
}
exit;

?>

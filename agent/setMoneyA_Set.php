<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "修改點數" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Agent" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "setMoneyA_Set.php" ;			// 設定本程式的檔名
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

WinHappy_checkAgent();	// 限制代理人管理後台存取頁面

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;			// 動作代理人(會員)的ID
$ARRAY_POST_GET_PARA[] = "AID||*" ;			// 目前操作代理人的ID
$ARRAY_POST_GET_PARA[] = "PID||*" ;			// 目前操作代理人的父ID
$ARRAY_POST_GET_PARA[] = "MID||*" ;			// 目前操作會員的ID

$ARRAY_POST_GET_PARA[] = "Type||*" ;		// 目前操作人員類別(Agent:代理人,Member:會員)
$ARRAY_POST_GET_PARA[] = "Money||*" ;			// 金額

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

func_setOnLineInfo( $_SESSION['Agent_ID'] , ""  , "" ) ;		// 記錄代理人在線資訊

// 是否有設目前代理人ID
if ( $AID )
{
	$array_NowAgent_Info = WinHappy_getAgentInfo( $AID ) ;
	$_SESSION['AID'] = $array_NowAgent_Info['Agent_ID'] ;
}

$array_Agent_Info = WinHappy_getAgentInfo( $_SESSION['Agent_ID'] ) ;		// 取得登入代理人資料

// 取得目前操作代理人資料
if( $AID )
{
	$array_NowAgent_Info = WinHappy_getAgentInfo( $AID ) ;
	$_SESSION['AID'] = $AID ;
	$_SESSION['AAgent_ID'] = $array_NowAgent_Info['Agent_ID'] ;
}
else
{
	$array_NowAgent_Info = WinHappy_getAgentInfo( $_SESSION['id_Agent'] ) ;
	$_SESSION['AID'] = $_SESSION['id_Agent'] ;
	$_SESSION['AAgent_ID'] = $_SESSION['Agent_ID'] ;
}

//echo "-1,$AID - {$_SESSION['AID']} - $Type" ;
//exit;

//echo "<p></p>" ;print_r($_POST);echo "<br>" ;
	// 錯誤訊息
	$tmp_ErrMSG = "" ;

	// 找出設定金額的代理人資料
	$array_Agent_Info = WinHappy_getAgentInfo( $_SESSION['Agent_ID'] ) ;		// 取得目前操作代理人
	
	// 操作分類
	if( $Type == "Agent" )
	{// 代理人
		$tmp_MoneyLog_Class = "2";
		$array_Info = WinHappy_getAgentInfo( $ID ) ;		// 取得代理人資料
		// 被操作人金額
		$tmp_MoneyLog_Original_Money = $array_Info['Agent_Money'] ;
		$tmp_URL = "agents.php?AID=$AID" ;
		$tmp_LogInfo_Type = "代理人" ;
	}
	else
	{// 會員
		$tmp_MoneyLog_Class = "1" ;
		$array_Info = WinHappy_getMemberInfo( $ID ) ;		// 取得會員資料
		// 被操作人金額
		$tmp_MoneyLog_Original_Money = $array_Info['Member_Money'] ;
		$tmp_URL = "users.php?AID=$AID" ;
		$tmp_LogInfo_Type = "會員" ;

		// 會員在線上，代理不可以提出或存入會員點數
		$tmp_OnLineState = func_checkOnLineState( $array_Info['Member_ID'] , 5 , "OnLine_DT" ) ;		// 取得會員是否在線
		if( $tmp_OnLineState == 1 )
		{
			echo "-1,會員還在線上，不可以提出或存入會員點數" ;
			exit;
			//toastrMsg( "會員還在線上，不可以提出或存入會員點數" , "E" ) ;		// 秀出toastr訊息
			//Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
			//exit;
		}
	}

	// 設定執行動作
	if( $Funct == "RechargeOK" )
	{
		$tmp_Action = "存入" ;
		$tmp_MoneyAction = "+" ;
		$tmp_Main_MoneyAction = "-" ;
		$MoneyLog_Type = 3 ;

		// 是否有足夠的金額可以轉移-判斷轉入人金額是否足夠
		if( $array_NowAgent_Info['Agent_Money'] < $Money )
		{	$tmp_ErrMSG = "{$array_NowAgent_Info['Agent_Name']}沒有足夠的金額可以轉移" ;	}
	}
	else
	{
		$tmp_Action = "提出" ;
		$tmp_MoneyAction = "-" ;
		$tmp_Main_MoneyAction = "+" ;
		$MoneyLog_Type = 4 ;

		// 是否有足夠的金額可以轉移-判斷提出人金額是否足夠
		if( $tmp_MoneyLog_Original_Money < $Money )
		{	$tmp_ErrMSG = "對方沒有足夠的金額可以轉移" ;	}
	}
//echo "01,ok$Funct , $tmp_Action , $tmp_MoneyAction , $tmp_Main_MoneyAction , $MoneyLog_Type" ;
//exit;

	// 是否有足夠點數扣
	if ( $tmp_ErrMSG )
	{
		echo "-1,$tmp_ErrMSG" ;
		exit;
		//toastrMsg( $tmp_ErrMSG , "E" ) ;		// 秀出toastr訊息
		//alertgo("您沒有足夠的金額可以轉移","");
		//Time2URL( 1, $tmp_URL ) ;		// 固定時間前往某個頁面
	}
	else
	{
		if($Type AND $ID)
		{
	
			// 設定被設定人金額
			$tmpSQL = "UPDATE $Type SET {$Type}_Money = {$Type}_Money $tmp_MoneyAction $Money WHERE id_{$Type} = '$ID'" ;				// 欄位值+1
			//$tmpSQL = "UPDATE Agent SET Agent_Money = Agent_Money + 100 WHERE id_Agent = '34'" ;				// 欄位值+1
			//echo "-1," .$tmpSQL ;
			//exit;
			// UPDATE Agent SET Agent_Money = Agent_Money + WHERE id_Agent = '86'
			$Bol = func_DatabaseBase( $tmpSQL , "SQL" , "" , "" ) ;									// 資料庫處理
			if( $Bol )
			{
				// 加入操作LOG
				$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
				$array_LogInfo['OperatorID'] = $_SESSION['Agent_ID'] ;		// 操作者ID
				$array_LogInfo['OperatorName'] = $_SESSION['Agent_Name'] ;	// 操作者姓名
				$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
				$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
				$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
				$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
				// 參考 func_WriteLogFieldInfo()
				$array_LogInfo['Type'] = "$tmp_Action" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
				$array_LogInfo['Info'] = "動作:{$tmp_LogInfo_Type}{$tmp_Action} , 操作者:{$_SESSION['Agent_Name']} , 目地{$tmp_LogInfo_Type}ID:$ID , 來源代理人ID:{$array_NowAgent_Info['Agent_ID']} , 來源代理人:{$array_NowAgent_Info['Agent_Name']} , 操作金額:$Money" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
				$array_LogInfo['SQL'] = str_replace ("'","’",$tmpSQL) ;		// SQL內容(有才需填-只給管理者看)
		
				// 管理者操作-管理等級來判斷
				$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料

				// 加入被設定人金額Log
				$arrayField['MoneyLog_Set_ID'] = $array_Info[$Type.'_ID'] ;	// 設定者ID
				$arrayField['MoneyLog_Class'] = $tmp_MoneyLog_Class ;		// 操作對像#::SELECT:2||1||會員||2||代理人::
				$arrayField['MoneyLog_Type'] = $MoneyLog_Type ;				// 操作動作#::SELECT:2||0||其它||1|遊戲投注|||2||遊戲派彩||3||存入||4||提出||提出||5||莊家派彩||6||五星彩獎金||7||總彩金獎金:
				$arrayField['MoneyLog_Bet_ID'] = "" ;						// 下注訂單號
				$arrayField['MoneyLog_Money'] = $Money ;					// 操作金額
				$arrayField['MoneyLog_Original_Money'] = $tmp_MoneyLog_Original_Money ;			// 操作前金額
				$arrayField['MoneyLog_Operator_IP'] = $_SERVER['REMOTE_ADDR']	 ;	// 操作者IP
				$arrayField['MoneyLog_Operator_ID'] = $_SESSION['AAgent_ID']	 ;	// 操作者ID
				$arrayField['MoneyLog_Operator_Name'] = $array_NowAgent_Info['Agent_Name']	 ;	// 操作者名稱
				$arrayField['MoneyLog_Log'] = "操作者名稱:{$array_NowAgent_Info['Agent_Name']} , 操作者ID:{$array_NowAgent_Info['id_Agent']} , 操作者:{$array_NowAgent_Info['Agent_Name']}"	 ;	// 操作者名稱
				$arrayField['MoneyLog_Add_DT'] = date("Y-m-d H:i:s") ;		// 操作時間
				
				$Bol = func_DatabaseBase( "MoneyLog" , "ADD" , $arrayField , "" ) ;						// 資料庫處理
				if( !$Bol )
				{// 加入被設定人金額Log失敗
					echo "-1,加入被設定人{$tmp_Action}Log失敗" ;
					exit;
					//toastrMsg( "加入被設定人{$tmp_Action}Log失敗" , "E" ) ;		// 秀出toastr訊息
					//Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
				}

				// 如果為管理者則不用扣
				if( $array_NowAgent_Info['Agent_ID'] != "Agent2005100001" )
				{
					// 扣掉操作代理人金額
					$tmpSQL_Agent = "UPDATE Agent SET Agent_Money = Agent_Money $tmp_Main_MoneyAction $Money WHERE Agent_ID = '{$_SESSION['AAgent_ID']}'" ;				// 欄位值+1
					//echo "-1," .$tmpSQL_Agent ;
					//exit;
					// UPDATE Agent SET Agent_Money = Agent_Money - 100 WHERE Agent_ID = 'Agent2009040010'
					//echo $tmpSQL ;
					$Bol_Agent = func_DatabaseBase( $tmpSQL_Agent , "SQL" , "" , "" ) ;		// 資料庫處理
					if ( !$Bol_Agent )
					{
						echo "-1,扣掉操作代理人{$tmp_Action}金額失敗" ;
						exit;
						//toastrMsg( "扣掉操作代理人{$tmp_Action}金額失敗" , "E" ) ;		// 秀出toastr訊息
						//Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
					}
					else
					{
						echo "01,{$tmp_Action}金額成功" ;
						exit;
						//toastrMsg( "{$tmp_Action}金額成功" , "S" ) ;		// 秀出toastr訊息
						// 成功 , Agent , + , 100 , 34
						//Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
					}
				}
				else
				{
					echo "01,{$tmp_Action}金額成功" ;
					exit;
					//toastrMsg( "{$tmp_Action}金額成功" , "S" ) ;		// 秀出toastr訊息
					// 成功 , Agent , + , 100 , 34
					//Time2URL( 2, $tmp_URL ) ;		// 固定時間前往某個頁面
				}
			}
			else
			{// 存入失敗
				echo "-1,被設定人{$tmp_Action}金額失敗" ;
				exit;
				//toastrMsg( "被設定人{$tmp_Action}金額失敗" , "E" ) ;		// 秀出toastr訊息
			}
		}
	}


exit;

?>

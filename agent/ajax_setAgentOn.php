<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "設定代理人權限" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Agent" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "ajax_setAgentOn.php" ;			// 設定本程式的檔名
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

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############
$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;			// ID
$ARRAY_POST_GET_PARA[] = "Val||*" ;			// 設定值
$ARRAY_POST_GET_PARA[] = "Field||*" ;		// 修改欄位

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面

$array_On[0] = "關閉" ;
$array_On[1] = "正常" ;

$array_On_CSS[0] = "red" ;
$array_On_CSS[1] = "green" ;

$array_On_Set[0] = "啟用" ;
$array_On_Set[1] = "關閉" ;

$array_On_Set_CSS[0] = "green" ;
$array_On_Set_CSS[1] = "red" ;

// 	tmp_data['Funct'] = "ModOn";	// 修改權限
$Val ? $tmp_Val = 0 : $tmp_Val = 1 ;

//echo "$Funct - $ID - $Val - $Field - $tmp_Val" ;
//exit;

// 如果開啟權限,查上線代理人是否有人闗閉
if( $tmp_Val == 1 )
{
	$array_AgentList = WinHappy_getAgentList( $_SESSION['AID'] , "A" , 2) ;		// 取得所有上線代理人資料
	// N : 名稱 , S : 分成比 , W : 返水比 , I : id  , O : 權限 , AI : 代理人ID
	foreach( $array_AgentList['O'] as $key => $value )
	{
		if( $value == 0 AND $array_AgentList['I'][$key] != $ID)
		{
			$arrayReturn['Err_Code'] = "-1" ;		// 設定回傳碼(1:成功,-1:失敗)
			$arrayReturn['Err_Msg'] = "上線代理人 {$array_AgentList['N'][$key]} 的權限關閉中,無法開啟權限" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
			echo json_encode($arrayReturn);
			exit;
		}
	}
}

$arrayField[$Field] = $tmp_Val ;
$Bol = func_DatabaseBase( "Agent" , "MOD" , $arrayField , " id_Agent = '$ID'" ) ;						// 資料庫處理

if( $Bol )
{
	if( $Val == 1 AND $Field == "Agent_On")
	{
		// 關閉下線代理人權限
		$tmpSQL_AgentOn = "UPDATE Agent SET Agent_On = '0' WHERE Agent_Online_id LIKE '%,$ID,%'" ;	// 修改
		$Bol_AgentOn = func_DatabaseBase( $tmpSQL_AgentOn , "SQL" , "" , "" ) ;									// 資料庫處理
		if ( !$Bol_AgentOn )
		{	$ErrMSG .= " , 關閉下線代理人權限-失敗" ;	}
	
		// 關閉下線會員權限-Member_Online_id
		$tmpSQL_MemberOn = "UPDATE Member SET Member_On = '0' WHERE Member_Online_id LIKE '%,$ID,%'" ;	// 修改
		$Bol_MemberOn = func_DatabaseBase( $tmpSQL_MemberOn , "SQL" , "" , "" ) ;									// 資料庫處理
		if ( !$Bol_MemberOn )
		{	$ErrMSG .= " , 關閉下線會員權限-失敗" ;	}
	}

	// 加入操作LOG
	$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
	$array_LogInfo['OperatorID'] = $_SESSION['Agent_ID'] ;		// 操作者ID
	$array_LogInfo['OperatorName'] = $_SESSION['Agent_Name'] ;	// 操作者姓名
	$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
	$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
	$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
	$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
	// 參考 func_WriteLogFieldInfo()
	$array_LogInfo['Type'] = "設定權限" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
	$array_LogInfo['Info'] = "動作:設定代理人權限 , 操作者:{$_SESSION['Agent_Name']} , 修改ID:$ID , 欄位:" . $Field . " , 狀態:" . $array_On_Set[(int)$Val] . "$ErrMSG" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
	$array_LogInfo['SQL'] = str_replace ("'","’",$tmpSQL) ;		// SQL內容(有才需填-只給管理者看)

	// 管理者操作-管理等級來判斷
	$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料

	echo "1," ;
	$arrayReturn['Err_Code'] = "1" ;		// 設定回傳碼(1:成功,-1:失敗)
	$arrayReturn['Err_Msg'] = "設定權限成功" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值

	// 取出要替換的資料
	$LIST_Agent = func_DatabaseGet( "Agent" , "*" , array("id_Agent"=>"$ID") ) ;		// 取得資料庫資料
	
		echo "					<td height=\"25\" align=\"center\">{$LIST_Agent['Agent_Login_Name']}</td>\n";
		echo "					<td style=\"width: 20px;\" align=\"center\"><a href=\"agents_add.php?ID={$LIST_Agent['id_Agent']}&Funct=MOD&AID={$_SESSION['AID']}\">{$LIST_Agent['Agent_Name']}</a></td>\n";
		// 狀態
		echo "					<td align=\"center\">\n";
		echo "					<a href=\"javascript:;\" class='BTN_SetOn' data-id='{$LIST_Agent['id_Agent']}' data-val='{$LIST_Agent['Agent_On']}' data-field='Agent_On' data-msg='{$array_On_Set[$LIST_Agent['Agent_On']]}帳號權限' style='color:{$array_On_CSS[$LIST_Agent['Agent_On']]}'>{$array_On[$LIST_Agent['Agent_On']]}</a>\n";
		echo "					</td>\n";
		echo "					<td align=\"right\">" . (int)$LIST_Agent['Agent_Money'] . "</td>\n";
		echo "					<td align=\"right\"></td>\n";
		echo "					<td align=\"right\">" . (int)$array_BackWater_Info['BackWater_Bingo_Gen_12Start'] . "%</td>\n";
		echo "					<td align=\"right\">{$array_BackWater_Info['BackWater_Bingo_Super']}%</td>\n";
//		echo "					<td align=\"right\">10%</td>\n";
//		echo "					<td align=\"right\">4%</td>\n";
//		echo "					<td align=\"right\">0.8% / 0.8% / 0% / 6% / 1.5%</td>\n";
		echo "					<td align=\"center\">{$LIST_Agent['Agent_Add_DT']}</td>\n";
		echo "					<td align=\"center\">\n";
		echo "						<a href=\"setMoney.php?ID={$LIST_Agent['id_Agent']}&Funct=Recharge&AID={$_SESSION['AID']}&Type=Agent\">存入</a><br/>\n";
		echo "						<a href=\"setMoney.php?ID={$LIST_Agent['id_Agent']}&Funct=Collect&AID={$_SESSION['AID']}&Type=Agent\">提取</a>\n";
		echo "					</td>\n";
		echo "					<td align=\"center\"><a href=\"agents.php?AID={$LIST_Agent['id_Agent']}\">代理列表</a><br/><a href=\"users.php?AID={$LIST_Agent['id_Agent']}\">會員列表</a></td>\n";
		echo "					<td align=\"center\"><a href=\"javascript:;\" data-id=\"{$LIST_Agent['id_Agent']}\" data-aid=\"{$_SESSION['AID']}\" class='BTN_DEL_Agent'\">刪除</a></td>\n";
}
else
{
	$arrayReturn['Err_Code'] = "-1" ;		// 設定回傳碼(1:成功,-1:失敗)
	$arrayReturn['Err_Msg'] = "設定權限失敗 $Funct - $ID - $Val - $Field - $tmp_Val" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
	echo json_encode($arrayReturn);
}

exit;

?>

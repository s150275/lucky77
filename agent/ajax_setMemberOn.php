<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "設定會員權限" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Member" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "ajax_setMemberOn.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "ID||*" ;			// ID
$ARRAY_POST_GET_PARA[] = "Val||*" ;			// 設定值
$ARRAY_POST_GET_PARA[] = "Field||*" ;		// 修改欄位

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

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

// 操作權限欄位名稱
$array_Field['Member_On'] = "帳號權限" ;
$array_Field['Member_Bingo_On'] = "賓果權限" ;
//echo "$Funct - $ID - $Val - $Field - $tmp_Val" ;
//exit;

$arrayField[$Field] = $tmp_Val ;
$Bol = func_DatabaseBase( "Member" , "MOD" , $arrayField , " id_Member = '$ID'" ) ;						// 資料庫處理

if( $Bol )
{
	echo "1," ;
	$arrayReturn['Err_Code'] = "1" ;		// 設定回傳碼(1:成功,-1:失敗)
	$arrayReturn['Err_Msg'] = "設定權限成功" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值

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
	$array_LogInfo['Info'] = "動作:設定會員權限 , 操作者:{$_SESSION['Agent_Name']} , 修改ID:$ID , 欄位:" . $array_Field[$Field] . " , 狀態:" . $array_On_Set[(int)$Val] . "" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
	$array_LogInfo['SQL'] = str_replace ("'","’",$tmpSQL) ;		// SQL內容(有才需填-只給管理者看)

	// 管理者操作-管理等級來判斷
	$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料

	// 取出要替換的資料
	$LIST_Member = func_DatabaseGet( "Member" , "*" , array("id_Member"=>"$ID") ) ;		// 取得資料庫資料
	echo "					<td height=\"25\" align=\"center\"><a href=\"users_add.php?ID={$LIST_Member['id_Member']}&AID={$_SESSION['AID']}&Funct=MOD\">{$LIST_Member['Member_Login_Name']}</a>\n";
	echo "					</td>\n";
	echo "					<td align=\"center\">{$LIST_Member['Member_Name']}</td>\n";
	echo "					<td align=\"right\">" . (int)$LIST_Member['Member_Money'] . "</td>\n";
	echo "					<!--<td align=\"center\">%</td>-->\n";
	echo "					<td align=\"center\"><font color='{$array_On_CSS[$LIST_Member['Member_On']]}'>{$array_On[$LIST_Member['Member_On']]}</a></td>\n";
	echo "					<td align=\"center\"><font color='{$array_On_CSS[$LIST_Member['Member_Bingo_On']]}'>{$array_On[$LIST_Member['Member_Bingo_On']]}</a></td>\n";
	echo "					<td align=\"center\">" . mb_substr($LIST_Member['Member_Add_DT'] , 0 , 10 , "utf-8") . "</td>\n";
	echo "					<td align=\"center\">\n";
	echo "						<a href=\"setMoney.php?ID={$LIST_Member['id_Member']}&Funct=Recharge&AID={$_SESSION['AID']}&Type=Member\">存入</a>&nbsp;\n";
	echo "						<a href=\"setMoney.php?ID={$LIST_Member['id_Member']}&Funct=Collect&AID={$_SESSION['AID']}&Type=Member\">提出</a>\n";
	echo "					</td>\n";
	echo "					<td align=\"center\"><a href=\"javascript:;\" class='BTN_SetOn' data-id='{$LIST_Member['id_Member']}' data-val='{$LIST_Member['Member_On']}' data-field='Member_On' data-msg='{$array_On_Set[$LIST_Member['Member_On']]}帳號權限' style='color:{$array_On_Set_CSS[$LIST_Member['Member_On']]}'>{$array_On_Set[$LIST_Member['Member_On']]}</a></td>\n";
	echo "					<td align=\"center\"><a href=\"javascript:;\" class='BTN_SetOn' data-id='{$LIST_Member['id_Member']}' data-val='{$LIST_Member['Member_Bingo_On']}' data-field='Member_Bingo_On' data-msg='{$array_On_Set[$LIST_Member['Member_Bingo_On']]}賓果權限' style='color:{$array_On_Set_CSS[$LIST_Member['Member_Bingo_On']]}'>{$array_On_Set[$LIST_Member['Member_Bingo_On']]}</a></td>\n";
	echo "					<td align=\"center\"></td>\n";
	echo "					<td align=\"center\">{$LIST_Member['Member_Login_DT']}</td>\n";
	echo "					<td align=\"center\">{$LIST_Member['Member_Login_IP']}</td>\n";
	echo "					<td align=\"center\"><a href=\"javascript:;\" data-id=\"{$LIST_Member['id_Member']}\" data-aid=\"{$_SESSION['AID']}\" class='BTN_DEL_Member'\">刪除</a>\n";
	echo "					</td>\n";
}
else
{
	$arrayReturn['Err_Code'] = "-1" ;		// 設定回傳碼(1:成功,-1:失敗)
	$arrayReturn['Err_Msg'] = "設定權限失敗" ;	// 設定錯誤訊息 , 成功則回傳回原來錢包的值
	echo json_encode($arrayReturn);
}

exit;

?>

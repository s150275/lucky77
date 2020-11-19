<?php
// ############ ########## ########## ############
// ## 設定基本變數				##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "會員API" ;	// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;			// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "api" ;				// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Member" ;			// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "check_Memo.php" ;	// 設定本程式的檔名
$MAIN_CHECK_FIELD       = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;				// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_PROGRAM_TYPE	= "A1" ;				// 設定此網頁是否為管理模式-0:不管制,A:一般管制(1111),P:程式權限管制(根據System_LevelP的設定),程式模式(0:一般模式,1:管理模式...)
$MAIN_NOW_TIME          = date("Y-m-d H:i:s") ;		// 取得現在的時間
$MAIN_NOW_DATE          = date("Y-m-d") ;		// 取得現在的日期

$tmp_Show_Msg = "0" ;		// 1:秀出除錯資料,0:不秀出除錯資料
$tmp_Add_Database = "1" ;		// 1:加入資料庫,0:不加入資料庫

// ############ ########## ########## ############
// ## 載入模組					##
// ############ ########## ########## ############
include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
include_once($MAIN_BASE_ADDRESS . "includes/bot.php");
//include_once($MAIN_BASE_ADDRESS . "includes/func_wostory.php");

// 接收json
$data = json_decode(file_get_contents('php://input'), true);
echo "<p>接收的Json資料</p>" ;
print_r($data);
echo "<br><br>" ;

//if ($data['Member_LineID'])
//$Member_LineID = $data['Member_LineID'] ;

// 基本參數名稱設定
// 設定基本回傳參數陣列
$arrayReturn['Funct'] = "" ;			// 功能
$arrayReturn['Time'] = "" ;				// 時間

//Array ( [Funct] => errInput [Member_LineID] => U88d84d7cf2d4a3a37da63dea2e59fde8 [Store_Code] => 110001 [Member_Name] => [Member_FatherID] => [Time] => 2018-04-24 12:45:15 [hash] => 8e4eb5e4422a86f509dc1530447b6a99 ) 

$bol_InputOK = "1" ;
// 判斷基本參數是否有輸入完整
foreach( $arrayReturn as $key => $value )
{
	// 是否有值
	if ( empty($data[$key]) )
	{
		$bol_InputOK = 0 ;
		break;
	}
}

// 特別加入功能-需要才要設
// 加入會員
if( $data['Funct'] == "addMember" )
{
	$arrayReturn['Member_Name'] = "" ;
	$arrayReturn['Member_FatherID_Temp'] = "" ;
}
// 設定會員要到的豐富選單
elseif( $data['Funct'] == "setMember_RichMenu" )
{	$arrayReturn['Store_RichMenu'] = "" ;	}
// 一對一客服資訊
elseif( $data['Funct'] == "setServiceInfo" )
{	$arrayReturn['Member_Service'] = "" ;	}


$arrayReturn['Time'] = date("Y-m-d H:i:s") ;				// 時間

// 取得現在時間的秒數
$tmp_Now = strtotime('now') ;
// 取得輸入時間的秒數
$tmp_Time = strtotime($data['Time']) ;
// 求出相差分鐘
$tmp_Diff = (int)((($tmp_Now - $tmp_Time)) / 60) ;

//echo "<p>相差分鐘 : $tmp_Diff</p>" ;

// 算出hash值
$tmp_md5 = getInputHash( $data ) ;
echo "<p>算出hash值 : $tmp_md5 , 送入hash : {$data['hash']}</p>";

// 功能不存在
if( $bol_InputOK == 0 )
{
	$arrayReturn['Funct'] = "errInput" ;
}
// 沒有輸入hash或值不對
elseif ( empty( $data['hash'] ) or $tmp_md5 != $data['hash'] )
{
	$arrayReturn['Funct'] = "errhash" ;
}
// 時間格式不對
elseif( !is_numeric($tmp_Time) )
{
	$arrayReturn['Funct'] = "errTime" ;
}
// 時間超過時間
elseif( !is_numeric($tmp_Time) or $tmp_Diff > 5 )
{
	$arrayReturn['Funct'] = "overTime" ;
}
// 備份資料 setBackup oksetBackup
else if( $data['Funct'] == "setBackup" )
{
	// 1.最原始傳送資料
	/*
	$arrayPara['Funct'] = "setBackup" ;	// 功能參數(必傳)
	$arrayPara['Data']['TableName'] = "Member" ;					// 表格名稱
	$arrayPara['Data']['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
	$arrayPara['Data']['WhereString'] = " Member_ID = 'Member202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
	$arrayPara['Data']['Member_Name'] = "yldu" ;					// 要處理的欄位名稱和資料
	$arrayPara['Data']['Member_ID'] = "Member202007010001" ;		// 要處理的欄位名稱和資料
	$arrayPara['Time'] = date("Y-m-d H:i:s") ;	// 送出時間(必傳)
	*/

//	// 最原始傳送資料
//	foreach( $data['Data'] as $key => $value )
//	{
//		echo "$key => $value<br>" ;
//		if( $key == "TableName" )// 表格名稱
//		{	$tmp_TableName = $value ;	}
//		else if( $key == "ActionName" )// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
//		{	$tmp_ActionName = $value ;	}
//		else if( $key == "WhereString" )// 操作判斷式
//		{	$tmp_WhereString = $value ;	}
//		else// 要處理的欄位名稱和資料
//		{
//			$arrayField[$key] = $value ;
//		}
//	}
//	// 操作相關參數
//	echo "表格名稱 : $tmp_TableName , 操作動作 : $tmp_ActionName  , 操作判斷式 : $tmp_WhereString<br>" ;
//	echo "<p>要處理的欄位名稱和資料</p>" ;print_r($arrayField);echo "<br>" ;

	// 2.資料陣列-一筆資料
	/*
	$arrayData['TableName'] = "Member" ;					// 表格名稱
	$arrayData['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
	$arrayData['WhereString'] = " Member_ID = 'Member202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
	$arrayData['Member_Name'] = "yldu" ;					// 要處理的欄位名稱和資料
	$arrayData['Member_ID'] = "Member202007010001" ;		// 要處理的欄位名稱和資料

	// 轉成Json
	$tmp_JsonData = array2json($arrayData);

	$arrayPara['Funct'] = "setBackup" ;	// 功能參數(必傳)
	$arrayPara['Data'] = $tmp_JsonData ;		// 要處理的欄位名稱和資料
	$arrayPara['Time'] = date("Y-m-d H:i:s") ;	// 送出時間(必傳)
	*/

//	// 把Json轉成陣列
//	$array_Data = json2array($data['Data']);
//	echo "<p>把Json轉成陣列</p>" ;print_r($array_Data);echo "<br>" ;
//
//	// 一筆資料
//	foreach( $array_Data as $key => $value )
//	{
//		echo "$key => $value<br>" ;
//		if( $key == "TableName" )// 表格名稱
//		{	$tmp_TableName = $value ;	}
//		else if( $key == "ActionName" )// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
//		{	$tmp_ActionName = $value ;	}
//		else if( $key == "WhereString" )// 操作判斷式
//		{	$tmp_WhereString = $value ;	}
//		else// 要處理的欄位名稱和資料
//		{
//			$arrayField[$key] = $value ;
//		}
//	}
//	// 操作相關參數
//	echo "表格名稱 : $tmp_TableName , 操作動作 : $tmp_ActionName  , 操作判斷式 : $tmp_WhereString<br>" ;
//	echo "<p>要處理的欄位名稱和資料</p>" ;print_r($arrayField);echo "<br>" ;

	// 3.資料陣列-多筆資料
	/*
	$arrayData[0]['TableName'] = "Member" ;					// 表格名稱
	$arrayData[0]['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
	$arrayData[0]['WhereString'] = " Member_ID = 'Member202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
	$arrayData[0]['Member_Name'] = "yldu" ;					// 要處理的欄位名稱和資料
	$arrayData[0]['Member_ID'] = "Member202007010001" ;		// 要處理的欄位名稱和資料

	$arrayData[1]['TableName'] = "Admin" ;					// 表格名稱
	$arrayData[1]['ActionName'] = "MOD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
	$arrayData[1]['WhereString'] = " Admin_ID = 'Admin202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
	$arrayData[1]['Admin_Name'] = "admin" ;					// 要處理的欄位名稱和資料
	$arrayData[1]['Admin_ID'] = "Admin202007010001" ;		// 要處理的欄位名稱和資料

	// 轉成Json
	$tmp_JsonData = array2json($arrayData);

	$arrayPara['Funct'] = "setBackup" ;	// 功能參數(必傳)
	$arrayPara['Data'] = $tmp_JsonData ;		// 要處理的欄位名稱和資料
	$arrayPara['Time'] = date("Y-m-d H:i:s") ;	// 送出時間(必傳)
	*/
	
//	// 把Json轉成陣列
//	$array_Data = json2array($data['Data']);
//	echo "<p>把Json轉成陣列</p>" ;print_r($array_Data);echo "<br>" ;
//
//	// 多筆資料
//	foreach( $array_Data as $key => $value )
//	{
//		foreach( $value as $key1 => $value1 )
//		{
//			echo "$key1 => $value1<br>" ;
//			if( $key1 == "TableName" )// 表格名稱
//			{	$tmp_TableName = $value ;	}
//			else if( $key1 == "ActionName" )// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
//			{	$tmp_ActionName = $value1 ;	}
//			else if( $key1 == "WhereString" )// 操作判斷式
//			{	$tmp_WhereString = $value1 ;	}
//			else// 要處理的欄位名稱和資料
//			{
//				$arrayField[$key1] = $value1 ;
//			}
//		}
//		// 操作相關參數
//		echo "表格名稱 : $tmp_TableName , 操作動作 : $tmp_ActionName  , 操作判斷式 : $tmp_WhereString<br>" ;
//		echo "<p>要處理的欄位名稱和資料</p>" ;print_r($arrayField);echo "<br>" ;
//	}
	

	// 4.資料陣列-多筆資料-單筆Json組合
	/*
	$tmp_JsonStr = "" ;
	unset($arrayData);
	$arrayData['TableName'] = "Member" ;					// 表格名稱
	$arrayData['ActionName'] = "ADD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
	$arrayData['WhereString'] = " Member_ID = 'Member202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
	$arrayData['Member_Name'] = "yldu" ;					// 要處理的欄位名稱和資料
	$arrayData['Member_ID'] = "Member202007010001" ;		// 要處理的欄位名稱和資料

	// 轉成Json
	$tmp_JsonData = array2json($arrayData);
	$tmp_JsonStr .= "$tmp_JsonData|||" ;

	unset($arrayData);
	$arrayData['TableName'] = "Admin" ;					// 表格名稱
	$arrayData['ActionName'] = "MOD" ;					// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
	$arrayData['WhereString'] = " Admin_ID = 'Admin202007010001' " ;	// 操作判斷式(新增不用)( Member_ID = 'Member202007010001' ),不可以用id,因為兩台主機資料庫可能不同
	$arrayData['Admin_Name'] = "admin" ;					// 要處理的欄位名稱和資料
	$arrayData['Admin_ID'] = "Admin202007010001" ;		// 要處理的欄位名稱和資料

	// 轉成Json
	$tmp_JsonData = array2json($arrayData);
	$tmp_JsonStr .= "$tmp_JsonData|||" ;

	$arrayPara['Funct'] = "setBackup" ;	// 功能參數(必傳)
	$arrayPara['Data'] = $tmp_JsonStr ;		// 要處理的欄位名稱和資料
	$arrayPara['Time'] = date("Y-m-d H:i:s") ;	// 送出時間(必傳)
	*/
	
	echo "<hr>" ;
	
	// 分析字串
	$arrayData = str2array($data['Data'] , "|||");
	//echo "<p>分析字串{$data['Data']}</p>" ;print_r($arrayData);echo "<br>" ;
	
	foreach( $arrayData as $key => $value )
	{
		if( $value )
		{
			unset($array_Json);
			$array_Json = json2array($value);
			//echo "<p>Json資料</p>" ;print_r($array_Json);echo "<br>" ;
			// 一筆資料
			foreach( $array_Json as $key1 => $value1 )
			{
				echo "$key1 => $value1<br>" ;
				if( $key1 == "TableName" )// 表格名稱
				{	$tmp_TableName = $value1 ;	}
				else if( $key1 == "ActionName" )// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
				{	$tmp_ActionName = $value1 ;	}
				else if( $key1 == "WhereString" )// 操作判斷式
				{	$tmp_WhereString = $value1 ;	}
				else// 要處理的欄位名稱和資料
				{
					$arrayField[$key1] = $value1 ;
				}
			}
			// 操作相關參數
			echo "表格名稱 : $tmp_TableName , 操作動作 : $tmp_ActionName  , 操作判斷式 : $tmp_WhereString<br>" ;
			echo "<p>要處理的欄位名稱和資料</p>" ;print_r($arrayField);echo "<br><hr>" ;
		}
	}

//	// 多筆資料
//	foreach( $array_Data as $key => $value )
//	{
//		foreach( $value as $key1 => $value1 )
//		{
//			echo "$key1 => $value1<br>" ;
//			if( $key1 == "TableName" )// 表格名稱
//			{	$tmp_TableName = $value ;	}
//			else if( $key1 == "ActionName" )// 操作動作(ADD : 新增 , MOD : 修改 , DEL : 刪除)
//			{	$tmp_ActionName = $value1 ;	}
//			else if( $key1 == "WhereString" )// 操作判斷式
//			{	$tmp_WhereString = $value1 ;	}
//			else// 要處理的欄位名稱和資料
//			{
//				$arrayField[$key1] = $value1 ;
//			}
//		}
//		// 操作相關參數
//		echo "表格名稱 : $tmp_TableName , 操作動作 : $tmp_ActionName  , 操作判斷式 : $tmp_WhereString<br>" ;
//		echo "<p>要處理的欄位名稱和資料</p>" ;print_r($arrayField);echo "<br>" ;
//	}
	

	//if( $tmp_ActionName == "DEL" )
	//{	$Bol = func_DatabaseBase( $tmp_TableName , $tmp_ActionName , $arrayField , " $tmp_WhereString" ) ;	}
	//else if( $tmp_ActionName == "ADD" OR $tmp_ActionName == "MOD" )
	//{	$Bol = func_DatabaseBase( $tmp_TableName , $tmp_ActionName , $arrayField , " $tmp_WhereString" ) ;	}

	if( $Bol )
	{// 成功
		$arrayReturn['Funct'] = "oksetBackup" ;			// 功能
		$arrayReturn['Msg'] = "操作資料庫成功" ;				// 時間
	}
	else
	{// 失敗
		$arrayReturn['Funct'] = "errsetBackup" ;			// 功能
		$arrayReturn['Msg'] = "操作資料庫失敗" ;				// 時間
	}
	$arrayReturn['Time'] = date("Y-m-d H:i:s") ;				// 時間
}
// 功能不存在
else
{
	$arrayReturn['Funct'] = "errFunct" ;
}

$tmpReturnJson = getOutputJson( $arrayReturn ) ;
//echo "運算結果:<br>" ;
echo "$tmpReturnJson" ;

?>
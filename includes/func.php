<?php
//~@_@~// START 秀出陣列資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//~@_@~// END 秀出陣列資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//	func_DatabaseBase()							資料庫基本處理 ▼▼▼
//	function func_DatabaseGet()					取得資料庫資料 ▼▼▼
/*
V0.19
	func_checkOnLineState()						查詢人員是否還在線上(200814)
	func_getOnLineCount()						取得在線人數(200812)
	func_setOnLineInfo()						記錄在線資訊(200811)
	consoleLogMsg()								秀出Log訊息(20200809)
	func_getStartEndDate()						取得開始結束日期(200528)
	toastrMsg()									秀出toastr訊息(200523)
	func_getCartCount()							計算購物車的商品數量(200322)
	confirmgo()									詢問視窗(200321)

=======================================================================================
網頁功能
	alertgo()									提示視窗返回頁面//無訊息則$msg輸入"",無網址$url則輸入"",不回上層$type輸入1
	toastrMsg()									秀出toastr訊息(200522)
	consoleLogMsg()								秀出Log訊息(20200809)
	showArray()									秀出陣列中的資料(180213)
	Public_ShowArray()							秀出陣列資料(180119)
	func_ShowArray()							秀出陣列資料(190304)
	confirmgo()									詢問視窗(200321)
	checksSelect()								查詢此select是否有被選取
	checksCheckBox()							查詢此CheckBox或Radio是否有被選取
	showBackListButton()						秀出上一頁和回列表按鈕(180518)
	changeHtmlTitle()							修改網頁Title內容(180727)
	func_changeString()							替換部份文字(180817)
	func_getSubTypeCount()						求出子類別選項的個數(190509)
	func_showDashboard()						秀出資訊區域(190510)

登入相閞
	checkSystemUser()							限制後台存取頁面
	readySystemUserLogin()						查詢已登入管理者後台
	SetSystemUserSession()						設定登入管理者的SESSION
	
	checkMember()								限制會員存取頁面
	readyMemberLogin()							查詢已登入會員後台
	SetMemberSession()							設定登入會員的SESSION
	
	checkStore()								限制店家存取頁面
	readyStoreLogin()							查詢已登入店家後台
	SetStoreSession()							設定登入店家的SESSION

	getMemberInfo()								取出登入會員資料

重複登入管制
	func_setLoginInfo()							設定登入資訊(190612)
	func_checkRepeatLogin()						查詢是否重複登入(190612)

資料庫相關
	func_DatabaseBase()							資料庫基本處理(181112)
	func_DatabaseGet()							取得資料庫資料(181112)
	array2SQL( $arraySQL )						欄位陣列轉成SQL欄位
	array2WhereSQL()							欄位陣列轉成WhereSQL欄位
	str2INSQL( $subStr)							陣列轉成IN SQL欄位
	getSystemSet()								取得系統設定資料
	CheckFieldExist()							查詢欄位值是否存在(180119)
	CreatRandomNum()							產生資料庫中不重複的亂碼(180403)
	func_getDatabase2Value()					把傳入的值找出資料庫中相對應的值(190320)
	func_getSQLSearchDate()						轉換查詢日期SQL字串(190703)
	func_getDBFieldValue()						取得資料庫中相對應的值(190710)-等同func_DatabaseGet中的LOOP

系統資料
	getModelSetInfo();							找出參數設定資料(180611)
	

資料轉換
	array2str()									把陣列轉成字串(180403)
	str2array()									把字串轉成陣列(180409)
	json2array()								把JSON字串轉成陣列
	array2json()								把陣列轉成JSON字串
	func_Json_Stringify()						把Json字串去掉特別字串(191030)
	CreatCheckValue()							產生日期驗証字串
	func_addFix0()								在數字前面加上固定長度的0(181128)
	func_generateQRwithGoogle()					把網址轉成QRCode(190301)
	func_Digital_Carry()						設定數字進位(190723)
	func_Change_Text()							替換文字(190927)

資料判斷
	func_checkArraySame()						判斷陣列是否相同(181217)
	func_check_Str_Match()						判斷字串是否有包含其中(191023)

日期相關
	getSplitDate()								切割日期中的值(180201)
	get_chinese_weekday()						日期轉中文星期(180418)
	getChangDay()								改變日期(180514)
	funct_ChangTime()							改變時間(190111)
	getMinDiff()								比較時間差
	getDay2Week()								取得日期為星期幾(180607)
	func_getMonthRange()						列出日期區間的所有月份清單(190116)
	func_getDateRange()							列出日期區間的所有日期清單(180905)
	func_getThisWeek()							取得給定日期所在週的開始日期和結束日期(180905)
	func_getMonthStartEndDate()					取出本月的開始和最後一天資料(181106)
	func_getStartEndDate()						取得開始結束日期(200528)
	func_clearDefaultDate()						清除日期內定值為空(181107)
	func_FormatDateTime()						格式化日期時間(181220)
	func_isDate()								是否為有效日期資料(190116)
	func_chnageYear1911()						西元民國互換(20191101)

安全相關
	func_WriteLogFieldInfo()					寫入LogField資料(190705)
	func_WriteLogInfo()							寫入LOG系統(190430)
	func_AnalysisLogInfo()						分析LOG資料(1904300
	func_checkLoginLock()						查詢IP登入失敗次數(180703)
	func_checkLoginControl()					查詢登入管制系統(180703)

目錄檔案
	checkWherePathDir()							找出所在目錄路徑相對資料(180119)
	checkFileExist ()							檢查檔案是否存在(180309)
	func_UpFile2Imgur ()						上傳檔案到Imgur(190214)
	func_Del_Path_File ()						刪除一個路徑下的所有資料夾和檔案(191119)
	

購物車相關
	ClearCart()									清除購物車(180430)
	func_getCartCount()							計算購物車的商品數量(200323)
	func_getECPay_CheckMacValue()				產生綠界金流檢查碼(20190514)

紅包相關
	func_getRedEnvelopeValue()					產生紅包每包可以抽值(190312)

網路相關
	func_sentCURL_Post()						START 送出CURL資料(POST)
	func_sentCURL_Get()							送出GET資料(GET)

文字編碼
	funct_getControlCode()						取得編碼規則(190723)
	func_ReverseArray()							反轉陣列(190723)
	func_ReverseStr()							反轉字串(190723)
	func_Encoder_Str2Ascii()					編碼-文字轉成ASCII數字(190723)
	func_Decoder_Ascii2Str()					解碼-ASCII數字轉成字串(190723)

ID編碼
	func_Encoder_ID()							把輸入的ID進行亂數編碼()
	func_Decoder_ID()							編碼過的字串進行ID解碼

線上人數系統
	func_setOnLineInfo()						記錄在線資訊(200811)
	func_getOnLineCount()						取得在線人數(200812)
	func_checkOnLineState()						查詢人員是否還在線上(200814)

Hash轉換-每個網站要個別設安全參數和不用順序,以所要複製到另一個函式中去改
	checkInputHash()							判斷傳入的hash是否正確
	getOutputJson()								由陣列產生含有hash的Json字串

*/

// 是否為管理IP
if ( strcmp($_SERVER["REMOTE_ADDR"] ,"155.94.159.17") )
{
	$Conn_isAdmin = 0 ;
	//echo "不相同" ;
}
else
{
	$Conn_isAdmin = 1 ;
	//echo "相同" ;
}

if(!isset($_SESSION))
{
	session_start();
}
//echo session_id();

// 是否登出管理系統
if( $_GET['FUNCT'] == "LOGOUT" )
{
	ClearSystemUserSession();
	//$_SESSION['SystemUser_ID'] = "" ;
	//unset($_SESSION['SystemUser_ID']);
	alertgo("登出成功" , "m_Login.php");
}
// 是否店家登出系統
if( $_GET['FUNCT'] == "StoreLOGOUT" )
{
	$_SESSION['Store_ID'] = "" ;
	unset($_SESSION['Store_ID']);
	alertgo("店家登出成功" , "Store_Login.php");
}

// 是否會員登出系統
if( $_GET['FUNCT'] == "MemberLOGOUT" )
{
	$_SESSION['Member_ID'] = "" ;
	unset($_SESSION['Member_ID']);

	alertgo("會員登出成功" , $MAIN_BASE_ADDRESS . "index.php");
}

// 設定點數
if($_GET["method"]=='setPoint')
{
	$_SESSION['Point'] = $_GET['point'];
}

/*商城購物車*/
// 清除購物車
if($_GET["method"]=='ClearCart')
{

	ClearCart();
//	alertgo("已清除購物車" , "index.php");
	alertgo("" , "index.php");
}

// 刪除購物車
if( $_GET["method"] == 'delCart' )
{
	// 只修改某筆商品中數量
	$pidAry = $_SESSION['pidAry'];
	$jsonAry = $_SESSION['jsonAry'];
	
	$newPidAry = array();
	$newJsonAry = array();
	
	//echo "<p>要改變ID : " . $_GET['ID'] . "</p>" ;
	for($i = 0 ; $i < count($pidAry) ; $i++)
	{
		// 是否為要改的商品
		if($pidAry[$i] != $_GET['ID'])
		{
			array_push( $newPidAry , $pidAry[$i] ) ;
			array_push( $newJsonAry , $jsonAry[$i] ) ;
		}
	}	
	$_SESSION['pidAry'] = $newPidAry;
	$_SESSION['jsonAry'] = $newJsonAry;
}

// 修改購物車數量
if( $_GET["method"] == 'modCart' )
{
//	echo "改變後陣列<br>" ;
//	echo "pidAry<br>" ;
//	print_r($_SESSION['pidAry']);
//	echo "<br>jsonAry<br>" ;
//	print_r($_SESSION['jsonAry']);
//	echo "<br>" ;

	// 只修改某筆商品中數量
	$pidAry = $_SESSION['pidAry'];
	$jsonAry = $_SESSION['jsonAry'];
	
	$newPidAry = array();
	$newJsonAry = array();
	
	//echo "<p>要改變ID : " . $_GET['ID'] . "</p>" ;
	for($i = 0 ; $i < count($pidAry) ; $i++)
	{
		// 是否為要改的商品
		if($pidAry[$i] == $_GET['ID'])
		{
			$jsonAry[$i]['p_qty'] = $_GET['num'];
//			array_push( $newJsonAry , $jsonAry[$i] ) ;
		}
	}	
//	$_SESSION['pidAry'] = $newPidAry;
	$_SESSION['jsonAry'] = $jsonAry;

//	echo "改變後陣列" ;
//	echo "pidAry<br>" ;
//	print_r($_SESSION['pidAry']);
//	echo "<br>jsonAry<br>" ;
//	print_r($_SESSION['jsonAry']);
//	echo "<br>" ;
}

//~@_@~// START 提示視窗返回頁面 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function alertgo($msg , $url , $type = "" )
{
	// 範例			: alertgo("跳出訊息" , "index.php" , "")
	// 功能			: 提示視窗返回頁面//無訊息則$msg輸入"",無網址$url則輸入"",不回上層$type輸入1
	// 修改日期		: 180523
	// $msg			: 跳出訊息
	// $url			: 完成後要到的頁面
	// $type		: 轉址模式("" : 一般轉址 , "1" : 不能再回到上一頁)
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
	echo "<script type='text/javascript'>";
	if($msg != "")
	{
		echo "alert('$msg');";
	}
	if($url != "")
	{
		if( $type == 1 )
		{	echo "location.replace(\"$url\");";	}
		else
		{	echo "location.href='$url';";	}
	}
	echo "</script>";
}
//~@_@~// END 提示視窗返回頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出toastr訊息 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function toastrMsg($subMsg , $subType = "S" )
{
	/*
	範例			: toastrMsg( $subType ) ;		// 秀出toastr訊息
	功能			: 秀出toastr訊息
	修改日期		: 20200522
	參數說明 :
		$subMsg		要秀的訊息(可以加入HTML標籤)
		$subType	呈現的狀態(S:成功 , E:失敗 , W:錯誤 , I:訊息)
	回傳參數 :
		無
	使用範例 :		:
		toastrMsg( "秀出訊息" , "S" ) ;		// 秀出toastr訊息
		toastrMsg( "秀出訊息" , "E" ) ;		// 秀出toastr訊息
		toastrMsg( "秀出訊息" , "W" ) ;		// 秀出toastr訊息
		toastrMsg( "秀出訊息" , "I" ) ;		// 秀出toastr訊息
	*/
	//echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
	echo "<script type='text/javascript'>";
	if($subMsg != "")
	{
		if( $subType == "S" )
		{	echo "toastr.success('$subMsg');" ;	}
		else if( $subType == "E" )
		{	echo "toastr.error('$subMsg');" ;	}
		else if( $subType == "W" )
		{	echo "toastr.warning('$subMsg');" ;	}
		else if( $subType == "I" )
		{	echo "toastr.info('$subMsg');" ;	}
	}
	echo "</script>";
}
//~@_@~// END 提示視窗返回頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出Log訊息 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function consoleLogMsg( $subMsg )
{
	/*
	範例			: consoleLogMsg( $subType ) ;		// 秀出Log訊息
	功能			: 秀出Log訊息
	修改日期		: 20200809
	參數說明 :
		$subMsg		要秀的訊息
	回傳參數 :
		無
	使用範例 :		:
		consoleLogMsg( "秀出訊息" ) ;		// 秀出Log訊息
	*/
	echo "<script type='text/javascript'>";
	if($subMsg != "")
	{
		echo "console.log(\"$subMsg\");";
	}
	echo "</script>";
}
//~@_@~// END 秀出Log訊息 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 固定時間前往某個頁面 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function Time2URL($subTime , $subURL )
{
	/*
	範例			: Time2URL($subTime , $subURL ) ;		// 固定時間前往某個頁面
	功能			: 固定時間前往某個頁面
	修改日期		: 20200522
	參數說明 :
		$subTime	要等待的秒數
		$subURL		要前往的URL
	回傳參數 :
		無
	使用範例 :		:
		Time2URL( 2, "https://tw.yahoo.com" ) ;		// 固定時間前往某個頁面
	*/
	if($subTime AND $subURL)
	{
		$subTime = $subTime * 1000 ;
		echo "<script type='text/javascript'>";
		echo "setTimeout(function() {";
		echo "		location.replace(\"$subURL\");";
		echo "}, $subTime);";
		echo "</script>";
	}
}
//~@_@~// END 提示視窗返回頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出陣列中的資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function showArray( $subArray , $subFieldNum = 2 , $subType = "T" )
{
	// 範例			: showArray( $subArray , "T");
	// 功能			: 秀出陣列中的資料
	// $subArray	: 要秀出的陣列
	// $subFieldNum	: 欄位數目
	// $subType		: 秀出格式( T : 表格 , L : 列表 )
	
	if ( $subType == "T" )
	{	// 表格
		$tmpindex = 0 ;
		$tmpWidth = (int)(100 / 2 / $subFieldNum) ;
		echo $tmpWidth ;
		echo "<div><table border=1 width=100%>";
		echo "    <tr>";
		foreach ( $subArray as $key => $value )
		{
			if( $tmpindex % $subFieldNum == 0 AND $tmpindex != 0 )
			{
				echo "        </tr>";
				echo "        <tr>";
			}
			echo "        <td width=" . $tmpWidth . "% style='background-color:#eee;padding:3px;'>$key</td><td width=" . $tmpWidth . "%>$value</td>";
			$tmpindex++ ;
		}
		echo "    </tr>";
		echo "</table></div>";
	}
	elseif ( $subType == "L" )
	{	// 列表
		foreach ( $subArray as $key => $value )
		{
			// 判斷是否為陣列
			if(is_array($value))
			{
				echo "$key<br>" ;
				foreach ($value as $key1 => $value1)
				{
					echo "&nbsp;&nbsp;&nbsp;&nbsp;$key1 => $value1 <br>\n";
				}
				echo "<br>" ;
			}
			else
			{
				echo "$key => $value <br>\n";
			}
//			echo "<p>&nbsp;&nbsp;$key => $value</p>" ;
		}
	}
}
//~@_@~// END 秀出陣列中的資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出陣列資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function Public_ShowArray( $tmpArray )
{
	// 範例			: Public_ShowArray( $tmpArray );
	// 功能			: 秀出陣列資料
	// 修改日期		:
	// $tmpArray	: 要秀出的陣列資料
	foreach ($tmpArray as $key => $value)
	{
		// 判斷是否為陣列
		if(is_array($value))
		{
			echo "$key<br>" ;
			foreach ($value as $key1 => $value1)
			{
				echo "&nbsp;&nbsp;&nbsp;&nbsp;$key1 => $value1 <br>\n";
			}
			echo "<br>" ;
		}
		else
		{
			echo "$key => $value <br>\n";
		}
	}
	echo "<br>" ;
}
//~@_@~// END 秀出陣列資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出陣列資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_ShowArray( $subArray , $subType = "P")
{
	/*
	範例			: func_ShowArray(  $subArray , $subType  ) ;		// 秀出陣列資料<pre>
	功能			: 秀出陣列資料
	修改日期		: 20190304
	參數說明		:
	$subArray	: 要秀出的陣列
	$subType	: 秀出陣列的模式( P : 沒有秀出長度資料-print_r , V : 有秀出長度資料-var_dump)
	使用範例		:
	func_ShowArray(  $subArray , "P"  ) ;		// 秀出陣列資料
	func_ShowArray(  $subArray , "V"  ) ;		// 秀出陣列資料
	*/
	
	print "<pre>\n";
	if( $subType == "P" )
	{	print_r($subArray);	}
	else
	{	var_dump($subArray);	}
	print "</pre>";
}
//~@_@~// END 秀出陣列資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 詢問視窗 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function confirmgo($msg , $url1 = "" , $url0 = "" )
{
	// 範例			: confirmgo("跳出訊息" , "index.php" , "#")
	// 功能			: 詢問視窗//無訊息則$msg輸入"",$url:確定後要到的網址,url0:取消後要到的網址
	// 修改日期		: 200321
	// $msg			: 跳出訊息
	// $url1		: 確定後要到的網址
	// $url0		: 取消後要到的網址
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
	echo "<script type='text/javascript'>";
	if($msg != "")
	{
		echo "if(confirm(\"$msg\"))\n" ;
		echo "{	location.href=\"$url1\";	}\n" ;
		echo "else\n" ;
		echo "{	location.href=\"$url0\";	}\n" ;
	}
	echo "</script>";
}
//~@_@~// END 詢問視窗 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

//~@_@~// START 查詢此select是否有被選取 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function checksSelect( $source , $val )
{
	// 範例			: echo  checksSelect($LIST['Select'] , 1) ;
	// 範例			: echo "<option value='" . $LIST_Settlement['Settlement_DT'] . "'" . checksSelect($LIST_Settlement['Settlement_DT'] , $Settlement_DT) . ">" . $LIST_Settlement['Settlement_DT'] . "</option>\n" ;
	/* 範例			: <option value="0" <?php echo checksSelect($Bonus_Type , 0) ?>>統計中</option>*/
	// 功能			: 查詢此select是否有被選取
	// 修改日期		:
	// $source		: 比對資訊
	// $val			: 項目資料
	if( $source == $val ) return " selected";
}
//~@_@~// END 查詢此select是否有被選取 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢此CheckBox或Radio是否有被選取 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function checksCheckBox($source , $val)
{
	// 範例			: echo checksCheckBox("項目一,項目二", "項目一") ;
	// 功能			: 查詢此CheckBox或Radio是否有被選取
	// 修改日期		:
	// $source		: 比對資訊(項目1,項目2)
	// $val			: 項目資料
	$array_source = explode("," ,$source );
	foreach( $array_source as $key => $value )
	{
//		echo "$key  - $value<br>" ;
		if( $value == $val )
		{	return " checked";	}
	}
}
//~@_@~// END 查詢此CheckBox或Radio是否有被選取 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出上一頁和回列表按鈕 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function showBackListButton()
{
	// 範例			: showBackListButton() ;	// 秀出上一頁和回列表按鈕
	// 功能			: 秀出上一頁和回列表按鈕
	// 修改日期		:
	global $Funct ;
	global $SEARCH_FIELD ;
	global $MAIN_FILE_NAME ;

	echo "    <!--Start 秀出上一頁和回列表按鈕-->\n";
	echo "    <div class=\"row\">\n";
	echo "        <div class=\"col-lg-12\">\n" ;
	echo "        <p class='text-center'>\n" ;
	if( $Funct != "" OR $SEARCH_FIELD != "" )
	{ echo "        <a href=\"$MAIN_FILE_NAME\" class=\"btn btn-default signup\">回列表頁</a>\n" ;	}
	echo "        <button type=\"button\" class=\"btn btn-default signup\" onclick=\"javascript:history.back();\">回上一頁</button>\n" ;
	echo "        </p>\n" ;
	echo "        </div>\n";
	echo "    </div>\n";
	echo "    <!--End 秀出上一頁和回列表按鈕-->\n";
}
//~@_@~// END 秀出上一頁和回列表按鈕 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 修改網頁Title內容 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function changeHtmlTitle( $subTitle )
{
	// 範例			: changeHtmlTitle( $subTitle ) ;	// 修改網頁Title內容
	// 功能			: 修改網頁Title內容
	// 修改日期		: 180727
	// $subTitle	: 要改的title文字
	echo "<script>\n";
	echo "document.title = '$subTitle' ;\n";
	echo "</script>\n";

}
//~@_@~// END 秀出上一頁和回列表按鈕 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 替換部份文字 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_changeString( $subString , $subLength , $subHideChar = "" )
{
	// 範例			: $tmpCutString = func_changeString( "ABCDEFG" , 20 , "*" ) ;	// 替換部份文字
	// 功能			: 取出部份文字
	// 修改日期		: 180814
	// $subString	: 被替换的文字
	// $subLength	: 替换開始的位置
	// $subHideChar : 要加密碼保護的符號
	//					""  : 切除文字模式		沒設表示直接切除
	// 					"O" : 個資保護模式		只取代第二個字為O
	//					"*" : 密碼保護模式		把密碼後面文字(英文)改成*
	//					"." : 內容縮編模式		把內容密碼後面文字改成...
	// 範例 :
	// 1.個資保護模式 , 結果 : 王O明
	// $tmpCutString = func_changeString( "王小明" , 1 , "O" ) ;	// 替換部份文字
	// 2.密碼保護模式 , 結果 : ABC****
	// $tmpCutString = func_changeString( "ABCDEFG" , 3 , "*" ) ;	// 替換部份文字
	// 3.內容縮編模式 , 結果 : ABC...
	// $tmpCutString = func_changeString( "ABCDEFG" , 3 , "." ) ;	// 替換部份文字
	// 4.切除文字模式 , 結果 : ABC
	// $tmpCutString = func_changeString( "ABCDEFG" , 3 , "" ) ;	// 切除部份文字
	
	if ( $subHideChar == "O" )
	{	// 是否要用個資保護模式
		//$tmpchangeString = substr_replace($subString, 'O', $subLength , 1) ;
		$tmpchangeString = mb_substr($subString, 0 , 1 , "utf-8") . $subHideChar . mb_substr($subString, 2 , strlen($subString) , "utf-8") ;
		
	}
	elseif ( $subHideChar == "*" )
	{	// 是否要用密碼保護模式
		$tmpchangeString = mb_substr($subString, 0 , $subLength , "utf-8") ;
		for( $i = $subLength+1 ; $i <= mb_strlen($subString) ; $i++ )
		{	$tmpchangeString .= $subHideChar ;	}
		//$tmpchangeString = substr_replace($subString ,  str_pad( "" , strlen($subString)-$subLength , "*") , $subLength) ;
	}
	elseif ( $subHideChar == "." )
	{	// 是否要用內容縮編模式
		$tmpchangeString = mb_substr($subString, 0 , $subLength , "utf-8") ;
		if ( $subLength <= mb_strlen($subString) )
		{	$tmpchangeString .= "..." ;	}
		//$tmpchangeString = substr_replace($subString ,  str_pad( "" , strlen($subString)-$subLength , "*") , $subLength) ;
	}
	else
	{	// 切除字串
		$tmpchangeString = mb_substr( $subString , 0 , $subLength , "utf-8") ;
	}
	return $tmpchangeString ;
}
//~@_@~// END 替換部份文字 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 求出子類別選項的個數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getSubTypeCount( $array_subType , $subTableName , $subSQLWhere )
{
	$tmpShowMsg = 0 ;		// 是否要在網頁秀出除錯資料(1:秀出,0:不秀)
	global $link ;
	/*
	範例			: $arraySubTypeCount = func_getSubTypeCount( $array_subType , "" , "" ) ;		// 求出子類別選項的個數
	功能			: 求出子類別選項的個數
	修改日期		: 190509
	參數說明		:
	$array_subType	: 已設定子類別選項陣列
	回傳參數		:
	$arraySubTypeCount	: 回傳的個數資料(依SEARCH_FIELD尚成Key)
	$subTableName		: 查詢資料表名稱
	$subSQLWhere		: 固定要執行的WHERE
	
	設定範例		:
	$array_subType[] = "下架||SEARCH_FIELD=Coupon_On&SEARCH_KEY=0" ;
	$array_subType[] = "上架||SEARCH_FIELD=Coupon_On&SEARCH_KEY=1" ;

	// 設定共同Where方法(AND,OR要加在前面)
	$tmpSQLWhere = "" ;

	$arraySubTypeCount = func_getSubTypeCount( $array_subType , $MAIN_DATABASE_NAME , $tmpSQLWhere ) ;		// 求出子類別選項的個數

	回傳
	$array_subType['ALL']	全部筆數
	$array_subType[N]		某索引的筆數,N為$array_subType的索引值
	秀出方式
	<span class='badge'>{$arraySubTypeCount['ALL']}</span>
	*/
	$tmpIndex = 0 ;
	foreach( $array_subType as $key => $value )
	{
		if ( $tmpShowMsg ){echo "<p>子類別選項 : $value</p>" ;}
		// 分析字串
		$split_subType = explode("||" , $value );
		if ( $tmpShowMsg ){echo "<p>分析字串</p>" ;print_r($split_subType);echo "<br>" ;}
		
		// 找出查項目的值-SEARCH_FIELD=QA_On&SEARCH_KEY=0
		$split_Para = preg_split("/[=&]+/", $split_subType[1]);
		if ( $tmpShowMsg ){echo "<p>查項目的值</p>" ;print_r($split_Para);echo "<br>" ;}

		// 是否有設定參數
		if ( isset($split_Para[1]) AND isset($split_Para[3]) )
		{
			// 
			if( $split_Para[3] == "NotNull" )
			{	$tmpSQL = "SELECT * FROM $subTableName WHERE {$split_Para[1]} != '' $subSQLWhere" ;	}
			else
			{	$tmpSQL = "SELECT * FROM $subTableName WHERE {$split_Para[1]} LIKE '%{$split_Para[3]}%' $subSQLWhere" ;	}
			
			if ( $tmpShowMsg ){echo "<p>{$split_subType[0]} - 找出個數SQL : $tmpSQL</p>" ;}
			$arraySubTypeCount[$tmpIndex] = func_DatabaseGet( $tmpSQL , "COUNT" , "" ) ;		// 取得資料庫資料

		}
		if ( $tmpShowMsg ){echo "<hr>" ;}
		$tmpIndex++ ;
	}
	// 找出所有的數量
	$tmpSQL = "SELECT * FROM $subTableName WHERE 1 $subSQLWhere" ;
	if ( $tmpShowMsg ){echo "<p>全部 - 找出個數SQL : $tmpSQL</p>" ;}
	$arraySubTypeCount['ALL'] = func_DatabaseGet( $tmpSQL , "COUNT" , "" ) ;		// 取得資料庫資料

	return $arraySubTypeCount ;

}
//~@_@~// END 求出子類別選項的個數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 秀出資訊區域 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_showDashboard( $subClass = "primary" , $subIcon = "fa fa-comments fa-5x" , $subCount = 0 , $subTitle = "標題文字" , $subLink = "javascript:;" , $subLinkName = "查詢資料" , $subLg = 3 , $subMd = 6 )
{
	$tmpShowMsg = 0 ;		// 是否要在網頁秀出除錯資料(1:秀出,0:不秀)
	global $link ;
	/*
	範例			: func_showDashboard( $subClass , $subIcon , $subCount , $subTitle , $subLink  , $subLinkName ) ;		// 求出子類別選項的個數
	功能			: 求出子類別選項的個數
	修改日期		: 190509
	參數說明		:
	$subClass		: 要套用的Class名稱(primary , info , success , warning , danger , default)
	$subIcon		: 要套用的Icon Class
	$subCount		: 數字
	$subTitle		: 名稱
	$subLink		: 前往的URL
	$subLinkName	: 前往的說明文字
	$subLg			: 設定lg的大小
	$subMd			: 設定md的大小
	回傳參數		:
	無
	設定範例		:
	func_showDashboard( "primary" , "fa fa-comments fa-5x" , "100" , "標題文字" , "javascript:;"  , "查詢資料" ) ;		// 求出子類別選項的個數
	*/
	echo "<div class=\"col-lg-{$subLg} col-md-{$subMd}\">\n";
	echo "	<div class=\"panel panel-{$subClass}\">\n";
	echo "		<div class=\"panel-heading\">\n";
	echo "			<div class=\"row\">\n";
	echo "				<div class=\"col-xs-3\">\n";
	echo "					<i class=\"{$subIcon}\"></i>\n";
	echo "				</div>\n";
	echo "				<div class=\"col-xs-9 text-right\">\n";
	echo "					<div class=\"huge\">{$subCount}</div>\n";
	echo "					<div>{$subTitle}</div>\n";
	echo "				</div>\n";
	echo "			</div>\n";
	echo "		</div>\n";
	if( $subLink != "javascript:;" )
	{
		echo "		<a href=\"{$subLink}\">\n";
		echo "			<div class=\"panel-footer\">\n";
		echo "				<span class=\"pull-left\">{$subLinkName}</span>\n";
		echo "				<span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>\n";
		echo "				<div class=\"clearfix\"></div>\n";
		echo "			</div>\n";
		echo "		</a>\n";
	}
	echo "	</div>\n";
	echo "</div>\n";
	echo "\n";
}
//~@_@~// END 求出子類別選項的個數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲


// 登入相閞
// 後台系統管理員
//~@_@~// START 限制後台存取頁面 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function checkSystemUser()
{
	global $Conn_Website_Name;

	if ($_SESSION['Website_Name'] != $Conn_Website_Name)
	{
		$_SESSION['Website_Name'] = $Conn_Website_Name ;
		$_SESSION['SystemUser_ID'] = "" ;
	}
	if( $_SESSION['SystemUser_ID'] == "" )
	{
		//頁面導向
//		alertgo('請先登入或註冊會員' , 'm_Login.php');
		alertgo('' , 'm_Login.php');
	}
}
//~@_@~// END 限制後台存取頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢已登入管理者後台 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function readySystemUserLogin()
{
	global $Conn_Website_Name;

	if($_SESSION['Website_Name'] != $Conn_Website_Name )
	{
		$_SESSION['Website_Name'] = $Conn_Website_Name ;
		$_SESSION['SystemUser_ID'] = "" ;
	}
	//echo "{$_SESSION['Website_Name']} != $Conn_Website_Name - {$_SESSION['SystemUser_ID']}" ;
	//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;
	if( $_SESSION['SystemUser_ID'] != "" )
	{
		//頁面導向
		alertgo('','index.php');
	}
}
//~@_@~// END 查詢已登入管理者後台 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定登入管理者的SESSION ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function SetSystemUserSession()
{
	global $Conn_Website_Name;
	//存入SESSION
	$_SESSION['SystemUser_ID'] = $LIST['SystemUser_ID'];
	$_SESSION['SystemUser_Level'] = $LIST['SystemUser_Level'];
	$_SESSION['Website_Name'] = $Conn_Website_Name;
}
//~@_@~// END 設定登入管理者的SESSION ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 清除登入管理者的SESSION ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function ClearSystemUserSession()
{
	//存入SESSION
	$_SESSION['SystemUser_ID'] = "";
	$_SESSION['SystemUser_Level'] = "";
	$_SESSION['Website_Name'] = "";
	unset($_SESSION['SystemUser_ID']);
	unset($_SESSION['SystemUser_Level']);
	unset($_SESSION['Website_Name']);
}
//~@_@~// END 清除登入管理者的SESSION ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 會員
//~@_@~// START 限制會員存取頁面 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function checkMember()
{
	global $Conn_Website_Name;

	$array_Store_Info = getStore_Info($subStore_Code) ;	// 取得店家資訊
	if ($_SESSION['Website_Name'] != $array_Store_Info['Store_Name'])
	{
		$_SESSION['Website_Name'] = $array_Store_Info['Store_Name'] ;
		$_SESSION['Member_ID'] = "" ;
	}
	if( !isset($_SESSION['Member_ID']) OR $_SESSION['Member_ID'] == "" )
	{
		//頁面導向
//		alertgo('請先登入或註冊會員','Member_Login.php');
		alertgo('','Member_Login.php');
	}
}
//~@_@~// END 限制會員存取頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢已登入會員後台 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function readyMemberLogin()
{
	global $Conn_Website_Name;

	$array_Store_Info = getStore_Info($subStore_Code) ;	// 取得店家資訊
	if($_SESSION['Website_Name'] != $array_Store_Info['Store_Name'])
	{
		$_SESSION['Website_Name'] = $array_Store_Info['Store_Name'] ;
		$_SESSION['Member_ID'] = "" ;
	}
	if(isset($_SESSION['Member_ID']) AND $_SESSION['Member_ID'] != "")
	{
		//頁面導向
		alertgo('','index.php');
	}
}
//~@_@~// END 查詣已登入會員後台 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定登入會員的SESSION ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function SetMemberSession( $arraySession )
{
	global $link;
	// 範例			: SetMemberSession( $arraySession );
	// 功能			: 存入SESSION
	// 修改日期		: 180412
	// $arraySession	: 加入的會員SESSION陣列
	// 設定方式
	// $arraySession['Member_ID'] = "Member0000000001" ;
	// SetMemberSession( $arraySession );
	foreach( $arraySession as $key => $value )
	{	$_SESSION[$key] = $value ;	}
}
//~@_@~// END 設定登入會員的SESSION ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 店家管理
//~@_@~// START 限制店家存取頁面 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function checkStore()
{
	global $Conn_Website_Name;

	$array_Store_Info = getStore_Info($subStore_Code) ;	// 取得店家資訊
	if ($_SESSION['Website_Name'] != $array_Store_Info['Store_Name'])
	{
		//alertgo("{$_SESSION['Website_Name']} != $Conn_Website_Name","");
		$_SESSION['Website_Name'] = $array_Store_Info['Store_Name'] ;
		$_SESSION['Store_ID'] = "" ;
	}
	if( !isset($_SESSION['Store_ID']) OR $_SESSION['Store_ID'] == "")
	{
		//頁面導向
//		alertgo('請先登入或申請店家','Store_Login.php');
		alertgo('','Store_Login.php');
	}
}
//~@_@~// END 限制店家存取頁面 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢已登入店家後台 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function readyStoreLogin()
{
	global $Conn_Website_Name;

	$array_Store_Info = getStore_Info($subStore_Code) ;	// 取得店家資訊
	//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;
	if ($_SESSION['Website_Name'] != $array_Store_Info['Store_Name'])
	{
		//alertgo("{$_SESSION['Website_Name']} != $Conn_Website_Name","");
		$_SESSION['Website_Name'] = $array_Store_Info['Store_Name'] ;
		$_SESSION['Store_ID'] = "" ;
	}
	if(isset($_SESSION['Store_ID']) AND $_SESSION['Store_ID'] != "")
	{
		//頁面導向
		alertgo('','index.php');
	}
}
//~@_@~// END 查詢已登入店家後台 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定登入店家的SESSION ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function SetStoreSession($LIST)
{
	global $Conn_Website_Name;
	//存入SESSION
	$_SESSION['Store_ID'] = $LIST['Store_ID'];
	$_SESSION['Store_Code'] = $LIST['Store_Code'];
	$_SESSION['Store_Name'] = $LIST['Store_Name'];
	$_SESSION['Store_RichMenu'] = $LIST['Store_RichMenu'];
	$_SESSION['Website_Name'] = $LIST['Store_Name'];
}
//~@_@~// END 設定登入店家的SESSION ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

//~@_@~// START 取出登入會員資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getMemberInfo( $subMemberID )
{
	global $link;
	// 範例			: $arrayMemberInfo = getMemberInfo( $subMemberID );
	// 功能			: 取得會員資料
	// 修改日期		:
	// $subMemberID	: 會員的ID(代碼,Line內部ID)
	
	if ( strlen($subMemberID) == "33" )
	{
		$tmpWhereSQL = " Member_LineID = '$subMemberID'" ;
	}
	elseif ( strlen($subMemberID) == "14" )
	{
		$tmpWhereSQL = " Member_ID = '$subMemberID'" ;
	}
	else
	{
		return "" ;
	}

	$SQL = "SELECT * FROM Member WHERE $tmpWhereSQL" ;
	//echo "$SQL<br>" ;
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 有資料時執行
	if ( mysqli_num_rows( $QUERY ) )
	{
		// 找出一筆資料
		$LIST = mysqli_fetch_assoc( $QUERY ) ;
		return $LIST ;
	}
	else
	{
		return "" ;
	}
}
//~@_@~// END 取出登入會員資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 重複登入管制
//~@_@~// START 設定登入資訊 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_setLoginInfo( $subID )
{
	global $link;
	/*
	★範例			$Bol = func_setLoginInfo( "Member1905010001" ) ;		// 設定登入資訊
	★功能			設定登入資訊
	★修改日期		190612
	★參數說明
		$subID			登入帳號ID
	★回傳參數
		$Bol			 回傳的資料(1 : 成功 , 0 : 失敗 )
	★設定範例
		$Bol = func_setLoginInfo( $_SESSION['Member_ID'] ) ;		// 設定登入資訊
	*/
	// 登入帳號ID是否存在
	$arrayLoginInfoInfo = func_DatabaseGet( "LoginInfo" , "*" , array("LoginInfo_ID"=>$subID) ) ;		// 取得資料庫資料
	//echo "<p>登入帳號ID是否存在 $subID : </p>" ;print_r($arrayLoginInfoInfo);echo "<br>" ;
	if( $arrayLoginInfoInfo )
	{// 已有資料
		//echo "已有資料";
		// 設定新登入資料
		$arrayField['LoginInfo_IP'] = $_SERVER['REMOTE_ADDR'] ;		// 登入IP
		$arrayField['LoginInfo_Session_ID'] = session_id() ;		// 登入SESSION ID
		$arrayField['LoginInfo_Login_DT'] = date("Y-m-d H:i:s") ;	// 登入時間
		$Bol = func_DatabaseBase( "LoginInfo" , "MOD" , $arrayField , " LoginInfo_ID = '$subID'" ) ;						// 資料庫處理
		if( $Bol )
		{	return 1 ;	}
		else
		{	return 0 ;	}
	}
	else
	{// 沒有資料
		//echo "沒有資料";
		// 新增登入資料
		$arrayField['LoginInfo_ID'] = $subID ;						// 登入帳號ID
		$arrayField['LoginInfo_IP'] = $_SERVER['REMOTE_ADDR'] ;		// 登入IP
		$arrayField['LoginInfo_Session_ID'] = session_id() ;		// 登入SESSION ID
		$arrayField['LoginInfo_Login_DT'] = date("Y-m-d H:i:s") ;	// 登入時間
		$Bol = func_DatabaseBase( "LoginInfo" , "ADD" , $arrayField , "" ) ;						// 資料庫處理
		if( $Bol )
		{	return 1 ;	}
		else
		{	return 0 ;	}
	}
}
//~@_@~// END 設定登入資訊 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢是否重複登入 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_checkRepeatLogin( $arrayModel )
{
	global $link;
	/*
	★範例			func_checkRepeatLogin( $arrayModel ) ;		// 查詢是否重複登入
	★功能			查詢是否重複登入,已有人登入則強制登出
	★修改日期		190612
	★參數說明
		$arrayModel						設定的參數
		$arrayModel["ID"]				登入帳號ID
		$arrayModel["ClearSession"]		需清空的SESSION值
		$arrayModel["AlertMsg"]			需強制登出時秀出訊息
		$arrayModel["AlertLink"]		需強制登出時前往Link
		$arrayModel["Model"]			處理模式(Alert:直接登出,Return:回傳參數)
	★回傳參數
		無
	★設定範例
		if( $_SESSION['Member_ID'] )
		{
			// 是否已被別人後登入
			$arrayModel["ID"] = $_SESSION['Member_ID'] ;				// 登入帳號ID
			$arrayModel["ClearSession"] = "Member_ID,Member_Name" ;		// 需清空的SESSION值,用","來區別多個欄位
			$arrayModel["AlertMsg"] = "此帳號已有人登入,你必須登出了" ;		// 需強制登出時秀出訊息
			$arrayModel["AlertLink"] = "m_Login.php" ;					// 需強制登出時前往Link,在Ajax模式為要執行的程式
			$arrayModel["Model"] = "Alert" ;							// 處理模式(Alert:直接登出,Ajax:回傳參數)
			func_checkRepeatLogin( $arrayModel ) ;						// 查詢是否重複登入
		}
	*/
	if( empty($arrayModel["Model"]) )
	{	$arrayModel["Model"] = "Alert" ;	}
	$arrayLoginInfoInfo = func_DatabaseGet( "LoginInfo" , "*" , array("LoginInfo_ID"=>$arrayModel['ID']) ) ;		// 取得資料庫資料
	
	if( $arrayLoginInfoInfo AND $arrayLoginInfoInfo['LoginInfo_Session_ID'] != session_id() )
	{	// 有人登入,需強制登出
		// 清空SESSION
		$arraySession = str2array( $arrayModel["ClearSession"] , ",");
		//echo "<p>清空SESSION</p>" ;print_r($arraySession);echo "<br>" ;
		
		foreach( $arraySession as $key => $value )
		{	$_SESSION[$value] = "" ;	}
		
		if( $arrayModel["Model"] == "Alert" )
		{
			if ( $arrayModel["AlertMsg"] OR $arrayModel["AlertLink"] )
			{	alertgo( $arrayModel["AlertMsg"] , $arrayModel["AlertLink"] );	}
		}
		else if( $arrayModel["Model"] == "Ajax" )
		{
			echo "-2," . $arrayModel["AlertLink"] ;
			exit;
		}
	}
	

}
//~@_@~// END 查詢是否重複登入 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

//~@_@~// START 資料庫基本處理 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_DatabaseBase( $subDatabase , $sunFunct , $arrayField , $subWhere )
{
	global $link ;
	/*
	範例			: $ret = func_DatabaseBase( "Member" , "ADD" , $arrayField , " id_Member = '1'" ) ;		// 資料庫基本處理
	功能			: 資料庫基本處理
	修改日期		:
	參數說明		:
	$subDatabase	: 要操作的資料庫名稱或完整SQL語法(ADD,MOD,DEL : 資料庫名稱 , SQL : 直接帶入完整SQL)
	$sunFunct		: 操作功能(ADD : 新增 , MOD : 修改 , DEL : 刪除 , SQL : 直接設SQL )
	$arrayField		: 要操作的欄位(ADD , MOD : 要設 , DEL : 不用設 , SQL : 不用設 )
	$subWhere		: 要比對的欄位(MOD , DEL : 要設 , ADD : 不用設 , SQL : 不用設 )
	回傳參數		:
	$ret			: 回傳的資料(ADD : 回傳新增的ID , MOD,DEL : 回傳執行是否成功 - 1 : 成功 , 0 : 失敗 )
	設定範例		:
	// 設定操作的欄位
	$arrayField['Member_Name'] = "yldu" ;
	$arrayField['Member_ID'] = "Member0001" ;

	$Bol = func_DatabaseBase( "Member" , "ADD" , $arrayField , "" ) ;						// 資料庫處理
	$Bol = func_DatabaseBase( "Member" , "MOD" , $arrayField , " id_Member = '1'" ) ;		// 資料庫處理
	$Bol = func_DatabaseBase( "Member" , "DEL" , "" , " id_Member = '1'" ) ;				// 資料庫處理
	或陣列設在欄位中
	$Bol = func_DatabaseBase( "Member" , "ADD" , array("Member_Name"=>"yldu","Member_ID"=>"Member0001") , "" ) ;						// 資料庫處理
	$Bol = func_DatabaseBase( "Member" , "MOD" , array("Member_Name"=>"yldu","Member_ID"=>"Member0001") , " id_Member = '1'" ) ;		// 資料庫處理
	$Bol = func_DatabaseBase( "Member" , "DEL" , "" , " id_Member = '1'" ) ;				// 資料庫處理
	或直接設SQL
	$tmpSQL = "INSERT INTO Member SET Member_Name = 'yldu', Member_ID = 'Member0001'" ;
	$tmpSQL = "UPDATE Member SET Member_Name = 'yldu', Member_ID = 'Member0001' WHERE id_Member = '$id_Member'" ;
	$tmpSQL = "UPDATE table_name SET email=CONCAT(email, ':me@email.com') WHERE id = '1'";
	$Bol = func_DatabaseBase( $tmpSQL , "SQL" , "" , "" ) ;									// 資料庫處理
	if ( $Bol )
	{	alertgo( "資料庫執行完成" , $MAIN_FILE_NAME ) ;	}
	else
	{	echo "資料修執行失敗" ;	}
	*/
	
	// 找出資料庫功能
	switch( $sunFunct )
	{
		case "ADD" :
			// 找出欄位SQL
			$tmpFieldSQL = array2SQL( $arrayField );
			$tmpSQL = "INSERT INTO $subDatabase SET $tmpFieldSQL" ;
			break;
		case "MOD" :
			// 找出欄位SQL
			$tmpFieldSQL = array2SQL( $arrayField );
			$tmpSQL = "UPDATE $subDatabase SET $tmpFieldSQL WHERE $subWhere" ;
			break;
		case "DEL" :
			$tmpSQL = "DELETE FROM $subDatabase WHERE $subWhere" ;
			break;
		case "SQL" :
			$tmpSQL = $subDatabase ;
			break;
		default :
			return 0 ;
	}

	//echo "<p>$tmpSQL</p>" ;
	if ( mysqli_query($link , $tmpSQL) )
	{
		// 是否為新增
		if ( $sunFunct == "ADD" )
		{	return mysqli_insert_id($link) ;	}
		else
		{	return 1 ;	}
	}
	else
	{	return 0 ;	}
}
//~@_@~// END 資料庫基本處理 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得資料庫資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_DatabaseGet( $subDatabase , $arrayField , $arrayWhere )
{
	global $link ;
	/*
	範例			: $arrayInfo = func_DatabaseGet( $subDatabase , $arrayField , $arrayWhere ) ;		// 取得資料庫資料
	功能			: 取得系統設定資料
	修改日期		: 20190708
	參數說明		:
		$subDatabase	: 資料庫名稱或SQL字串
		$arrayField		: 秀出欄位陣列(* : 所有欄位 , SQL : 查詢$subDatabaseL資料 , COUNT : 回傳資料個數 , LOOP : 回傳相對應欄位的值)
		$arrayWhere		: Where資料(如果$arrayField設為"LOOP",則參數則要設定要回傳欄位名稱陣列,如會員名稱-Member_Name)
	修改記錄		:
		20190227	加入資料個數功能
	
	使用範例		:
	1-1.多欄位查詢
	// 設定秀出欄位
	$arrayField[] = "Member_Name" ;
	$arrayField[] = "Member_ID" ;
	// 設定查詢欄位
	$arrayWhere['id_Member'] = "1" ;
	$arrayWhere['Member_On'] = "1" ;
	
	$arrayInfo = func_DatabaseGet( "Member" , $arrayField , $arrayWhere ) ;		// 取得資料庫資料
	
	1-2.單欄位查詢
	$arrayInfo = func_DatabaseGet( "Member" , array("Member_Name" , "Member_ID") , array("id_Member"=>"1") ) ;		// 取得資料庫資料

	2.查詢所有欄位
	$arrayInfo = func_DatabaseGet( "Member" , "*" , array("id_Member"=>"1") ) ;		// 取得資料庫資料

	3.自訂SQL-找資料個數
	$Count = func_DatabaseGet( "SELECT * FROM Member" , "COUNT" , "" ) ;		// 取得資料庫資料

	4.自訂SQL
	$tmpSQL = "SELECT * FROM Member WHERE id_Member = '1'" ;
	$tmpSQL = "SELECT sum(Member_Points) as Member_Points_Total FROM Member" ;				// 找出某欄位的總合
	$arrayInfo = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料

	4.回傳相對應欄位的值
	$tmpSQL = "SELECT * FROM Store WHERE Store_On = '1' LIMIT 0,20" ;
	$arrayWhere[] = "Store_Name" ;
	$arrayWhere[] = "Store_ID" ;
	$arrayStoreInfo = func_DatabaseGet( $tmpSQL , "LOOP" , $arrayWhere ) ;		// 取得資料庫資料
	// echo "<p></p>" ;print_r($arrayStoreInfo);echo "<br>" ;
	// 回傳20筆店家資料的名字和ID
	if( $arrayStoreInfo )
	{
		echo "		<select name='Business_Store_ID' class=\"form-control\">\n";
		foreach( $arrayStoreInfo as $key => $value )
		{
			$value['Store_ID'] == $LIST['Business_Store_ID'] ? $tmpSeleted = " selected" : $tmpSeleted = "" ;
			echo "		<option value='{$value['Store_ID']}' $tmpSeleted>{$value['Store_Name']}</option>\n";
		}
		echo "		</select>\n";
	}
	else
	{	echo "沒有資料<br>" ;	}
	*/

	if( $arrayField  == "SQL" )			// 自訂SQL
	{	$SQL = $subDatabase ;	}
	elseif( $arrayField  == "COUNT" )	// 找資料個數
	{	$SQL = $subDatabase ;	}
	elseif( $arrayField  == "LOOP" )	// 回傳相對應欄位的值
	{	$SQL = $subDatabase ;	}
	else
	{
		// 找出所有欄位
		if( $arrayField  == "*" )
		{	$tmpFieldSQL = "*";	}
		else	// 找出特定欄位
		{	$tmpFieldSQL = array2str( $arrayField , "," );	}
	
		// 找出欄位SQL
		$tmpWhereSQL = array2SQL( $arrayWhere , " AND " );
	
		$SQL = "SELECT $tmpFieldSQL FROM $subDatabase WHERE $tmpWhereSQL" ;
	}

	//echo "$SQL<br>" ;
	$QUERY = mysqli_query($link , $SQL) ;

	if( $arrayField  == "COUNT" )	// 找資料個數
	{	return mysqli_num_rows( $QUERY ) ;	}
	elseif( $arrayField  == "LOOP" )	// 回傳相對應欄位的值
	{
		// 是否有資料
		if ( mysqli_num_rows($QUERY) )
		{
			$tmpIndex = 0 ;
			// 一條條獲取
			while ($LIST = mysqli_fetch_assoc($QUERY))
			{
				foreach( $arrayWhere as $key => $value )
				{	$arrayInfo[$tmpIndex][$value] = $LIST[$value] ;	}
				$tmpIndex++ ;
			}
			
			// 釋放結果集合
			mysqli_free_result($QUERY);
			return $arrayInfo ;
		}
		else
		{	return "" ;	}
	}
	else
	{
		// 有資料時執行
		if ( mysqli_num_rows( $QUERY ) )
		{	return mysqli_fetch_assoc( $QUERY ) ;	}
		else
		{	return "" ;	}
	}
}
//~@_@~// END 取得資料庫資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 欄位陣列轉成SQL欄位 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function array2SQL( $arraySQL , $subChar = "," )
{
	// 範例	$tmpSQL = array2SQL( $arraySQL , "," );		//  欄位陣列轉成SQL欄位
	// 功能				欄位陣列轉成SQL欄位,用來新增,修改資料用
	// $arraySQL		要轉成SQL的陣列
	// $subChar 		區隔字元(,)
	// 設定方法 :
	// 	$arraySQL['Name'] = "yldu" ;
	// 	$arraySQL['Member_ID'] = "201701010001" ;
	//	$tmpSQL = array2SQL( $arraySQL , "," );		//  欄位陣列轉成SQL欄位
	// SQL結果 $tmpSQL = " Name = 'yldu' , Member_ID = '201701010001'"
	$tmpSQL = "" ;
	foreach( $arraySQL as $key => $value)
	{	$tmpSQL[] .= " $key = '" . $value . "'" ;	}
	return implode($subChar , $tmpSQL) ;
}
//~@_@~// END 欄位陣列轉成SQL欄位 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 欄位陣列轉成WhereSQL欄位 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function array2WhereSQL( $arraySQL , $subChar = " " )
{
	/*
	範例	$tmpWhereSQL = array2WhereSQL( $arraySQL , "," );		//  欄位陣列轉成WhereSQL欄位
	功能				欄位陣列轉成WhereSQL欄位
	$arraySQL		要轉成WhereSQL的陣列
	$subChar 		區隔字元( )

	設定方法 :
	$arraySQL[] = "CateringOrder_PickUP_Method = '1'" ;
	$arraySQL[] = " AND CateringOrder_Hope_Take_Day LIKE '%" . date("Y-m-d") . "%'" ;
	$tmpWhereSQL = " WHERE " . array2WhereSQL( $array2WhereSQL , " " );		//  欄位陣列轉成WhereSQL欄位

	WhereSQL結果 $WhereSQL = " CateringOrder_PickUP_Method = '1' AND CateringOrder_Hope_Take_Day LIKE '%" . date("Y-m-d") . "%'"
	*/
	return implode($subChar , $arraySQL) ;
}
//~@_@~// END 欄位陣列轉成SQL欄位 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 陣列轉成IN SQL欄位 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function str2INSQL( $arrayStr )
{
	/*
	範例			: $tmpINSQL = str2INSQL( $arrayStr );		// 陣列轉成IN SQL欄位
	功能			: 陣列轉成IN SQL欄位
	修改日期		: 20190316
	參數說明		:
		$subStr		: 要轉換的陣列
	使用範例		:
		$arrayStr[] = "台中" ;
		$arrayStr[] = "台北" ;
		$tmpINSQL = str2INSQL( $arrayStr );		// 陣列轉成IN SQL欄位
	結果			:
		$tmpINSQL = "IN ('台中','台北')" ;
	*/

	return "IN ( '" . implode($arrayStr , "','") . "')";
}
//~@_@~// END 陣列轉成IN SQL欄位 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

//~@_@~// START 取得系統設定資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getSystemSet()
{
	global $link ;
	// 範例			: $LIST_SystemSet = getSystemSet() ;		// 取得系統設定資料
	// 功能			: 取得系統設定資料
	// 修改日期		:
	$SQL = "SELECT * FROM SystemSet WHERE id_SystemSet = '1'" ;
	//echo "$SQL<br>" ;
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 有資料時執行
	if ( mysqli_num_rows( $QUERY ) )
	{
		// 找出一筆資料
		$LIST = mysqli_fetch_assoc( $QUERY ) ;
		return $LIST ;
	}
	else
	{
		return "" ;
	}
}
//~@_@~// END 取得系統設定資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢欄位值是否存在 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function CheckFieldExist( $subDatabase , $subField , $subKey  )
{
	global $link ;
	// 範例			: $bol = CheckFieldExist( "Member" , "Member_Login_Name" , "wolong" );
	// 功能			: 查詢欄位值是否存在
	// 修改日期		: 180104
	// $subArray	: 要轉成字串的陣列
	// $subChar		: 區隔字元(,)
	$SQL = "SELECT $subField FROM $subDatabase WHERE $subField = '$subKey'" ;
	//echo "$SQL<br>" ;
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 有資料時執行
	if ( mysqli_num_rows( $QUERY ) )
	{	return true ;	}
	else
	{	return false ;	}
}
//~@_@~// END 查詢欄位值是否存在 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 產生資料庫中不重複的亂碼 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function CreatRandomNum( $subDatabase , $subField , $subType = "N" , $subStartKey = "" , $subLength = 4)
{
	global $link ;
	/*
	範例			: $tmpCode = CreatRandomNum( "Member" , "Member_ID" , "N,E-,e" , "Start" , 5 ) ;
	功能			: 產生資料庫中不重複的亂碼
	修改日期		: 180105
	$subDatabase	: 資料表名稱(不填則不比對資料庫)
	$subField		: 欄位名稱(不填則不比對資料庫)
	$subType		: 亂數模式,用,分開,如:N,E-,e (N:數字,N4:不含4的數字,e小寫英文,:E:大寫英文,E-:不含不好分別的大寫英文IJL,e-:不含不好分別的大寫英文ijl)
	$subStartKey	: 開頭文字(數英皆可,可空白)
	$subLength		: 亂數長度
	範例
	$tmpCode = CreatRandomNum( "Member" , "Member_ID" , "N,E,e" , "" , 6 ) ;	// 數,英(大),英(小)
	$tmpCode = CreatRandomNum( "Member" , "Member_ID" , "N4,E-,e-" , "" , 6 ) ;	// 數少4,英(大省),英(小省)
	*/
	//echo "$subDatabase , $subField , $subType , $subStartKey , $subLength = 4<br>";// 初始值
	$tmp_has = 1 ;
	$pattern = "" ;

	$tmpTypeValue['N'] = "1234567890";		// 數
	$tmpTypeValue['N4'] = "123567890";		// 數少4
	$tmpTypeValue['e'] = "abcdefghijklmnopqrstuvwxyz";	// 英(小)
	$tmpTypeValue['E'] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";	// 英(大)
	$tmpTypeValue['e-'] = "abcdefghkmnopqrstuvwxyz";	// 英(小省)
	$tmpTypeValue['E-'] = "ABCDEFGHKMNOPQRSTUVWXYZ";	// 英(大省)

	$arrayType = explode(",", $subType);
	//print_r($arrayType);
	foreach($arrayType as $key => $value )
	{
		$pattern .= $tmpTypeValue[$value] ;
	}
	//echo "$pattern<br>" ;

	// 找到資料庫中沒有值為止
	while( $tmp_has )
	{
//		$pattern = "012356789";	// 英(大小)+數
		$key = "" ;

		// 產生要的數目
		for( $i=0 ; $i < $subLength ; $i++ )
		{	$key .= $pattern{rand(0 , strlen($pattern)-1 )};	}
//			echo $key ."<br>";
		// 設定此次經銷商編號
		$tmpStr = $subStartKey . $key ;

		// 測試用
//			$tmp_Member_ID = "TW20000" . $this->db->escape($data['firstname']) ;

		if( $subDatabase AND $subField)
		{
			// 查詢此經銷商編號是否已有人設過
			$SQL = "SELECT * FROM $subDatabase WHERE $subField = '" . $tmpStr . "'";
	
			$QUERY = mysqli_query($link , $SQL) ;
			
			// 沒有資料時離開
			if ( !mysqli_num_rows( $QUERY ) )
			{
				// 離開while
				$tmp_has = 0 ;
				return $tmpStr ;
			}
		}
		else
		{
			$tmp_has = 0 ;
			return $tmpStr ;
		}
	}
}
//~@_@~// END 產生資料庫中不重複的亂碼 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 把傳入的值找出資料庫中相對應的值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getDatabase2Value( $subInput , $subDatabase , $subCheckField , $subOutput , $subOrderBy = "" )
{
	global $link ;
	/*
	範例			: $arrayReturn = func_getDatabase2Value( $subInput , $subDatabase , $subCheckField , $subOutput );	// 把傳入的值找出資料庫中相對應的值
	功能			: 把傳入的值找出資料庫中相對應的值
	修改日期		: 20190320
	參數說明		:
	$subInput		: 輸入要找出的欄位值(用,來區隔) 例 : 1,2,3
	$subDatabase	: 要找的資料庫名稱 例 : Member
	$subCheckField	: 輸入值要比對的欄位名稱 例 : id_Member
	$subOutput		: 回傳的欄位名稱 例 : Member_Name 或全部回傳"*"
	$subOrderBy		: 排序資料(ORDER BY id DESC)
	使用範例		:
	$arrayReturn = func_getDatabase2Value( "1,2,3" , "Member" , "id_Member" , "Member_Name" , "ORDER BY id_Member DESC" );	// 把傳入的值找出資料庫中相對應的值
	*/
	$arrayInput = str2array($subInput , ",");
	$tmpInput = "'" . array2str($arrayInput , "','") . "'";
	//echo "$tmpInput";

	$SQL = "SELECT * FROM $subDatabase WHERE $subCheckField IN ($tmpInput) $subOrderBy" ;
	//echo $SQL . "<br>" ; 
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		//echo mysqli_num_rows($QUERY) ;
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			if( $subOutput == "*" )
			{	$arrayReturn[] = $LIST ;	}
			else
			{	$arrayReturn[$LIST[$subCheckField]] = $LIST[$subOutput] ;	}
		}

		//print_r($arrayReturn);
		// 釋放結果集合
		mysqli_free_result($QUERY);
		return $arrayReturn ;
	}
	else
	{
		//echo "沒有找到資料<br>" ;
		return "" ;
	}
	// 有資料時執行
}
//~@_@~// END 把傳入的值找出資料庫中相對應的值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 轉換查詢日期SQL字串 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getSQLSearchDate( $subStart_Date , $subEnd_Date , $subSeach_Field , $subDateType = "DT" )
{
	global $link ;
	/*
	★範例			$tmpSQLSearchDate = func_getSQLSearchDate( $subStart_Date , $subEnd_Date , $subSeach_Field );	// 轉換查詢日期SQL字串
	★功能			轉換查詢日期SQL字串
					設定說明 : 
					如果只設開始日期,則尋找開始日期的該月資料
					如果只設結束日期,則找出結束日期以後的資料
					如果設定開始和結束日期,則找出此日期區間的資料
	★修改日期		20190703
	★參數說明
		$subStart_Date	查詢開始日期
		$subEnd_Date	查詢結束日期
		$subSeach_Field	查詢欄位名稱
		$subDateType	日期格式( D : 只有日期 , DT : 日期和時間-內定 )
	★使用範例
		查詢一定範圍日期資料
		$tmpSQLSearchDate = func_getSQLSearchDate( "2019-01-01" , "2019-02-01" , "Member_Add_DT" );	// 轉換查詢日期SQL字串

		查詢某月資料-只設開始日期
		$tmpSQLSearchDate = func_getSQLSearchDate( "2019-01-01" , "" , "Member_Add_DT" );	// 轉換查詢日期SQL字串

		查詢某日資料-只設結束日期
		$tmpSQLSearchDate = func_getSQLSearchDate( "" , "2019-01-01" , "Member_Add_DT" );	// 轉換查詢日期SQL字串
	*/
	if( $subStart_Date AND $subEnd_Date )
	{	return " $subSeach_Field >= '$subStart_Date 00:00:00' AND $subSeach_Field <= '$subEnd_Date 23:59:59'" ;	}
	elseif( $subStart_Date )
	{
		$arrayMonthStartEndDate = func_getMonthStartEndDate( $subStart_Date , $subDateType ) ;		// 取出本月的開始和最後一天資料
		return " $subSeach_Field >= '{$arrayMonthStartEndDate['Start_Date']}' AND $subSeach_Field <= '{$arrayMonthStartEndDate['End_Date']}'" ;
	}
	elseif( $subEnd_Date )
	{	return " $subSeach_Field LIKE '%$subEnd_Date%'" ;	}
	else
	{	return "" ;	}
	
}
//~@_@~// END 轉換查詢日期SQL字串 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得資料庫中相對應的值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getDBFieldValue( $subSQL , $arrayField )
{
	global $link ;
	/*
	★範例			$arrayDBFieldValue = func_getDBFieldValue( $subSQL , $arrayField );	// 取得資料庫中相對應的值
	★功能			只回傳資料庫中某些欄位的值
	★修改日期		201907010
	★參數說明
		$subSQL			查詢的SQL
		$arrayField		回傳的欄位名稱
	★使用範例
		$arrayField[] = "Member_Name" ;
		$arrayField[] = "Member_ID" ;
		$arrayDBFV = func_getDBFieldValue( "SELECT * FROM Member Limit 0,10" , $arrayField );	// 取得資料庫中相對應的值
		或
		$arrayDBFV = func_getDBFieldValue( "SELECT * FROM Member Limit 0,10" , array("Member_Name","Member_ID") );	// 取得資料庫中相對應的值
		回傳
		Array ( [0] => Array ( [Member_Name] => yldu12 [Member_ID] => Member1906250001 ) [1] => Array ( [Member_Name] => yldu2 [Member_ID] => Member1906260001 )  ) 
	*/
	$arrayFieldValue = array();
	//echo $subSQL . "<br>" ; 
	$QUERY = mysqli_query($link , $subSQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		$tmpIndex = 0 ; 
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			foreach( $arrayField as $key => $value )
			{	$arrayFieldValue[$tmpIndex][$value] = $LIST[$value] ;	}
			$tmpIndex++ ; 
		}
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{	}
	return $arrayFieldValue ;
}
//~@_@~// END 取得資料庫中相對應的值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

//系統資料
//~@_@~// START 找出模組參數設定資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getModelSetInfo( $subModelSet_Group )
{
	global $link;
	// 範例					: $arraytModelSetInfo = getModelSetInfo( "Model" );	// 找出模組參數設定資料
	// 功能					: 找出參數設定資料
	// 修改日期				: 180604
	// $subModelSet_Group	: 參數群組名
	$SQL = "select * from ModelSet WHERE ModelSet_Group = '$subModelSet_Group'" ;
	$QUERY = mysqli_query($link , $SQL) ;

	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		while( $LIST = mysqli_fetch_assoc($QUERY) )
		{
			// Content有設就用此資料
			if ( $LIST['ModelSet_Content'] )
			{	$array_Return[$LIST['ModelSet_Key']] = $LIST['ModelSet_Content'] ;	}
			else
			{	$array_Return[$LIST['ModelSet_Key']] = $LIST['ModelSet_Value'] ;	}
		}

		return $array_Return ;
	}
	else
	{
		return "err" ;
	}

}
//~@_@~// END 找出模組參數設定資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲


//~@_@~// START 把陣列轉成字串 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function array2str( $subArray , $subChar = "," , $subType = "DEF" )
{
	// 範例			: $tmpStr = array2str( $array , ","  , "DEF");
	// 功能			: 把陣列轉成字串
	// 修改日期		:
	// $subArray	: 要轉成字串的陣列
	// $subChar		: 區隔字元(,)
	// subType		: 轉換格式(DEF : 內定只加區隔字元 , SQL : 字資料前後要加' , AMB : 前中後加入區隔字元)
	// $array[] = "欄位1" ;
	// $array[] = "欄位2" ;
	// $tmpStr = array2str( $array , ","  , "DEF");
	// 結果 : 欄位1,欄位2
	// $tmpStr = array2str( $array , ","  , "SQL");
	// 結果 : '欄位1','欄位2'
	if ( $subType == "SQL" )
	{	return "'" . implode( "'" . $subChar . "'" , $subArray) . "'" ;		}
	else if ( $subType == "AMB" )
	{	return $subChar . implode( $subChar , $subArray) . $subChar ;		}
	else
	{	return implode( $subChar , $subArray) ;		}
}
//~@_@~// END 把陣列轉成字串 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 把字串轉成陣列 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function str2array( $subStr , $subChar )
{
	// 範例			: $tmpArray = str2array( $array , "," );
	// 功能			: 把字串轉成陣列
	// 修改日期		:
	// $subArray	: 要轉成陣列的字串
	// $subChar		: 區隔字元(,)
	
	return explode( $subChar , $subStr) ;
}
//~@_@~// END 把字串轉成陣列 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 把JSON字串轉成陣列 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function json2array( $subJson )
{
	// 範例			: $arrayJson = json2array( $subJson );
	// 功能			: 把JSON字串轉成陣列
	// 修改日期		:
	// $subJson		: 要轉成陣列的JSON字串
	return json_decode($subJson , true) ;
}
//~@_@~// END 把JSON字串轉成陣列 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 把陣列轉成JSON字串 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function array2json( $subArray )
{
	// 範例			: $array2json = array2json( $subArray );
	// 功能			: 把陣列轉成JSON字串
	// 修改日期		:
	// $subArray	: 要轉成JSON字串的陣列
	return json_encode($subArray, JSON_UNESCAPED_UNICODE) ;
}
//~@_@~// END 把陣列轉成JSON字串 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 把Json字串去掉特別字串 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_Json_Stringify($array_Json)
{
	/*
	範例			: $tmp_Json = func_Json_Stringify( $array1 , $array2 ) ;		// 把Json字串去掉特別字串
	功能			: 把Json字串去掉特別字串
	修改日期		: 20191030
	參數說明		:
		$array_Json		要轉換的Json字串
	使用範例		:
		$tmp_Json = func_Json_Stringify( $array_Json ) ;		// 把Json字串去掉特別字串
	*/
    if (is_array($array_Json)) $tmp_Json = json_encode($array_Json);
    $search = array('\\', "\n", "\r", "\f", "\t", "\b", "'") ;
    $replace = array('\\\\', "\\n", "\\r","\\f","\\t","\\b", "'");
    return str_replace($search, $replace, $tmp_Json);
}
//~@_@~// END 把Json字串去掉特別字串 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 產生日期驗証字串 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function CreatCheckValue( $Settlement )
{
	// 範例 $tmp = CreatCheckValue( $Settlement ) ;
	// 功能				產生日期驗証字串
	// 回傳
	// $tmp				驗証字串
	// 變數
	// $Settlement		要產生驗証字串的結算日(20170812)
	// 運算規則
	// 結算日開頭			結算日(國曆)-1060812+(亂數-56)-反轉)-652180601
	// +今日日期-反轉		20171023 => 32017102
	// +編碼				(絕對值)(結算日開頭-結算日開頭-反轉):abs(106081256-652180601)-補到10位數
	// 結算日年份
	$tmp_Year = mb_substr($Settlement , 0 , 4 , "utf8")  - 1911 ;
	// 結算日月份
	$tmp_Month = mb_substr($Settlement , 4 , 2 , "utf8")  ;
	// 結算日日期
	$tmp_Day = mb_substr($Settlement , 6 , 2 , "utf8")  ;
	// 今日日期
	$tmp_NowDay = strrev(date("Ymd"))  ;

	// 開始亂數
	srand((double)microtime()*1000000) ;
	$tmp_rand = sprintf("%02s" , rand(0,99)) ;
	// 開頭字串
	$tmp_Title =  $tmp_Year . $tmp_Month . $tmp_Day . $tmp_rand ;
//	echo "開頭字串 : $tmp_Title<br>" ;
	$tmp_RevTitle =  strrev($tmp_Title) ;
//	echo "反轉開頭字串 : $tmp_RevTitle<br>" ;

	$tmp_Value = abs($tmp_Title - $tmp_RevTitle) ;
	$tmp_Value =  sprintf("%010s" , $tmp_Value) ;
//	echo "驗証字串 : $tmp_Value<br>" ;
	
	return $tmp_RevTitle . $tmp_NowDay . $tmp_Value ;
}
//~@_@~// END 產生日期驗証字串 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 在數字前面加上固定長度的0 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_addFix0( $subInt , $subLen )
{
	/*
	範例			: $tmpStr = func_addFix0( $subInt , 2 ) ;		// 在數字前面加上固定長度的0
	功能			: 在數字前面加上固定長度的0
	修改日期		: 20181128
	參數說明		:
	$subInt			: 要加0的數字
	$subLen			: 加0的長度
	使用範例		:
	*/
	$tmpStr = sprintf("%0" . $subLen . "s" , $subInt) ;
	
	return $tmpStr ;
}
//~@_@~// END 在數字前面加上固定長度的0 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 把網址轉成QRCode ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_generateQRwithGoogle($url , $widthHeight = '150' , $EC_level = 'L' , $margin = '0')
{
	/*
	範例			: func_generateQRwithGoogle( $url ) ;		// 把網址轉成QRCode
	功能			: 把網址轉成QRCode
	修改日期		: 20181128
	參數說明		:
	$subInt			: 要加0的數字
	$subLen			: 加0的長度
	使用範例		:
	$url = "https://tw.yahoo.com" ;
	func_generateQRwithGoogle( $url ) ;		// 把網址轉成QRCode
	*/
	$url = urlencode($url); 
	echo '<img src="http://chart.apis.google.com/chart?chs='.$widthHeight.
	'x'.$widthHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.
	'&chl='.$url.'" alt="QR code" widthHeight="'.$widthHeight.
	'" widthHeight="'.$widthHeight.'"/>';
}
//~@_@~// END 把網址轉成QRCode ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定數字進位 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_Digital_Carry( $subNum , $subDecimal , $subType = "round" )
{
	/*
	★範例			$tmpDigital_Carry = func_Digital_Carry( $subNum , $subDecimal , $subType );	// 設定數字進位
	★功能			設定數字進位
	★修改日期		20190723
	★參數說明
		$subNum			進位數字
		$subDecimal		小數位數(如果為整數則設為0)
		$subType		進位模式(ceil : 無條件進位 , floor : 無條件捨去 , round : 四捨五入 )
	★使用範例
		$tmpDigital_Carry = func_Digital_Carry( "5.2354" , 2 , "round" );	// 設定數字進位
		$tmpDigital_Carry = func_Digital_Carry( "5.2354" , 2 , "ceil" );	// 設定數字進位
		$tmpDigital_Carry = func_Digital_Carry( "5.2354" , 2 , "floor" );	// 設定數字進位
	*/
	// 設定判斷進位的位數
	$tmpDrecision = pow(10 , $subDecimal);
	switch ($subType)
	{
	case "round":	// 四捨五入
		return round($subNum * $tmpDrecision) / $tmpDrecision ;
		break;  
	case "ceil":	// 無條件進位
		return ceil($subNum * $tmpDrecision) / $tmpDrecision ;
		break;
	case "floor":	// 無條件捨去
		return floor($subNum * $tmpDrecision) / $tmpDrecision ;
		break;
	default:
	}
}
//~@_@~// END 設定數字進位 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 替換文字 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_Change_Text( $subSource , $subClear_Str , $subSymble = "" )
{
	global $link;
	/*
	★範例			: $tmp_Change_Text = func_Change_Text( $subArray_Name , $subField_Name , $subKey_Field_Name , $subValue_Field_Name , $subValue ) ;		// 替換文字
	★功能			: 替換文字
	★修改日期		: 190927
	★參數說明		:
		$subSource			比對原始資料
		$subClear_Str		比對字串(NULL : 空值)
		$subSymble			取代符號
	★回傳參數		:
		要秀出的資料
	★設定範例		:
		$tmp_Change_Text = func_Change_Text( $LIST['Object_Use'] , "請選擇" , "" ) ;		// 替換文字
		// 空值
		$tmp_Change_Text = func_Change_Text( $LIST['Object_Use'] , "NULL" , "0" ) ;		// 替換文字
	*/
	// 空值
	if( $subClear_Str == "NULL" )
	{
		if( empty($subSource) )
		{	return "$subSymble" ;	}
		else
		{	return "$subSource" ;	}
	}
	else if( $subSource == $subClear_Str )
	{	return "$subSymble" ;	}
	else
	{	return "$subSource" ;	}
}
//~@_@~// END 替換文字 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

//資料判斷
//~@_@~// START 判斷陣列是否相同 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_checkArraySame( $array1 , $array2 )
{
	/*
	範例			: $Bol = func_checkArraySame( $array1 , $array2 ) ;		// 判斷陣列是否相同
	功能			: 在數字前面加上固定長度的0
	修改日期		: 20181217
	參數說明		:
	$array1		: 要判斷的陣列1
	$array2		: 要判斷的陣列2
	使用範例		:
	*/
	if (!array_diff($array1,$array2) && !array_diff($array2,$array1))
	{	return 1;	}
	else
	{	return 0;	}
}
//~@_@~// END 判斷陣列是否相同 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 判斷字串是否有包含其中 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_check_Str_Match( $subSourceStr , $subCheckStr , $subType = "i" )
{
	/*
	範例			: $Bol_Match = func_check_Str_Match( $array1 , $array2 ) ;		// 判斷字串是否包含
	功能			: 在數字前面加上固定長度的0
	修改日期		: 20191023
	參數說明		:
		$subSourceStr		原始要判斷的字串
		$subCheckStr		要比對的字串
		$subType			是否要區分大小寫( "i" : 不區分大小寫 , "" : 要區分大小寫)
	使用範例		:
		$Bol_Match = func_check_Str_Match( "abcdefg" , "abc" , "i" ) ;		// 判斷字串是否有包含其中
	*/
	if( $subType == "i" )
	{// 不區分大小寫
		if (  stristr( $subSourceStr, $subCheckStr) )
		{	return 1 ;	}
		else
		{	return 0 ;	}
	}
	else
	{// 要區分大小寫
		if (  strstr( $subSourceStr, $subCheckStr) )
		{	return 1 ;	}
		else
		{	return 0 ;	}
	}
}
//~@_@~// END 判斷字串是否有包含其中 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲


//日期相關
//~@_@~// START 切割日期中的值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getSplitDate( $subDate , $subType = "A" )
{
	// 範例 $tmpSplitDate = getSplitDate( date("Y-m-d H:i:s") , "A") ;			// 全部分析
	// 範例 $tmpSplitDate = getSplitDate( date("Y-m-d H:i:s") , "DS") ;			// 日期去掉分隔符號
	// 範例 $tmpSplitDate = getSplitDate( date("Y-m-d H:i:s") , "RE") ;			// 日期還原分隔符號
	// 功能				切割日期中的值
	// 回傳
	// $tmp				取得日期細項,如果$subType沒有設,回傳時間總分割
	// 變數
	// $subDate			要分割的時間
	// $subType			要取出的資料(A:全分割,DS(Del Symbol):日期去掉分隔符號(20170101000000),RE(Return):日期還原分隔符號,Y:年,m:月,d:日,H:小時,i:分,s:秒)
	$splitTime = preg_split("/[: -]/" , $subDate);
	//print_r($splitTime);
	switch( $subType )
	{
		case "A":
			$tmpReturn = $splitTime ;
			break;
		case "DS":	// 去掉分隔符號
			$tmpReturn = implode("", $splitTime) ;
			break;
		case "RE":	// 還原時間
			$tmpReturn = mb_substr($subDate , "0" , "4" , "utf-8" ) . "-" . mb_substr($subDate , "4" , "2" , "utf-8" ) . "-". mb_substr($subDate , "6" , "2" , "utf-8" ) . " ". mb_substr($subDate , "8" , "2" , "utf-8" ) . ":". mb_substr($subDate , "10" , "2" , "utf-8" ) . ":". mb_substr($subDate , "12" , "2" , "utf-8" ) ;
			break;
		case "Y":
			$tmpReturn = $splitTime[0] ;
			break;
		case "m":
			$tmpReturn = $splitTime[1] ;
			break;
		case "d":
			$tmpReturn = $splitTime[2] ;
			break;
		case "H":
			$tmpReturn = $splitTime[3] ;
			break;
		case "i":
			$tmpReturn = $splitTime[4] ;
			break;
		case "s":
			$tmpReturn = $splitTime[5] ;
			break;
		default:
			$tmpReturn = "" ;
			break;
	}
	return $tmpReturn ;
}
//~@_@~// END 切割日期中的值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 日期轉中文星期 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function get_chinese_weekday( $subDatetime , $subType = "A" )
{
	/*
	範例 $weeklist = get_chinese_weekday( $datetime , "S" ) ;
	$subDatetime		: 判斷日期
	$subType			: 輸出格式(A : 完整(星期一) , S : 簡寫(一))
	
	$weeklist = get_chinese_weekday( date("Y-m-d H:i:s") , "A" ) ;		// 轉成完整星期
	$weeklist = get_chinese_weekday( $datetime , "S" ) ;	// 只取最後一個字
	*/
	$weekday = date('w', strtotime($subDatetime));
	if( $subType == "A" )
	{	$weeklist = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');	}
	else
	{	$weeklist = array('日', '一', '二', '三', '四', '五', '六');	}
	return $weeklist[$weekday];
}
//~@_@~// END 日期轉中文星期 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 改變日期 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getChangDay( $subDate , $subType , $subNum )
{
	/*
	範例 $tmpDate = getChangDay( date("Y-m-d") , "NM" , 1 ) ;		// 改變日期
	$subDate			: 基本日期
	$subType			: 格式
		LD : 前N天 , LW : 前Ｎ週 , LM : 前Ｎ個月 , LY : 前Ｎ個年
		ND : 後N天 , NW : 後Ｎ週 , NM : 後Ｎ個月 , NY : 後Ｎ個年
	$subNum			: 改變數字

	範例 :
	// 1天後
	$tmpDate = getChangDay( date("Y-m-d") , "ND" , 1 ) ;		// 改變日期
	// 1天前
	$tmpDate = getChangDay( date("Y-m-d") , "LD" , 1 ) ;		// 改變日期
	*/
	
	// 把之前錯的參數改正( 上一個 : Last , 下一個 : Next )
	
	$unix_time = strtotime( $subDate ) ;		//轉換成格林威治時間格式
	switch( $subType )
	{
		case "LD" :		// 前N天
			$tmp_Type = "-$subNum day" ;
			break;
		case "LW" :		// 前Ｎ週
			$tmp_Type = "-$subNum week" ;
			break;
		case "LM" :		// 前Ｎ個月
			$tmp_Type = "-$subNum month" ;
			break;
		case "LY" :		// 前Ｎ個年
			$tmp_Type = "-$subNum year" ;
			break;
		case "ND" :		// 後N天
			$tmp_Type = "$subNum day" ;
			break;
		case "NW" :		// 後Ｎ週
			$tmp_Type = "$subNum week" ;
			break;
		case "NM" :		// 後Ｎ個月
			$tmp_Type = "$subNum month" ;
			break;
		case "NY" :		// 後Ｎ個年
			$tmp_Type = "$subNum year" ;
			break;
		default:
	}
	if( strlen($subDate) == 10)
	{	return date( 'Y-m-d', strtotime($tmp_Type, $unix_time ) );	}
	elseif( strlen($subDate) == 19)
	{	return date( 'Y-m-d H:i:s', strtotime($tmp_Type, $unix_time ) );	}
}
//~@_@~// END 改變日期 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 改變時間 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function funct_ChangTime( $subDateTime , $subType , $subNum )
{
	/*
	範例 $tmpDate = funct_ChangTime( date("Y-m-d H:i:s") , "PH" , 1 ) ;		// 改變時間
	修改日期			: 20190111
	參數說明			:
	$subDateTime		: 基本日期
	$subType			: 格式(PH : 前N小時 , PM : 前Ｎ分鐘 , PS : 前Ｎ秒鐘 , LH : 後N小時 , LM : 後Ｎ分鐘 , LS , 後Ｎ秒鐘 )
	$subNum				: 改變數字
	
	echo "<p>現在時間 : " . date("Y-m-d H:i:s") . "</p>" ;

	$tmpDate = funct_ChangTime( date("Y-m-d H:i:s") , "PH" , 1 ) ;		// 改變時間
	echo "<p>1小時前 : $tmpDate</p>" ;
	
	$tmpDate = funct_ChangTime( date("Y-m-d H:i:s") , "PM" , 10 ) ;		// 改變時間
	echo "<p>10分鐘前 : $tmpDate</p>" ;
	
	$tmpDate = funct_ChangTime( date("Y-m-d H:i:s") , "PS" , 10 ) ;		// 改變時間
	echo "<p>10秒鐘前 : $tmpDate</p>" ;

	$tmpDate = funct_ChangTime( date("Y-m-d H:i:s") , "LH" , 1 ) ;		// 改變時間
	echo "<p>1小時後 : $tmpDate</p>" ;
	
	$tmpDate = funct_ChangTime( date("Y-m-d H:i:s") , "LM" , 10 ) ;		// 改變時間
	echo "<p>10分鐘後 : $tmpDate</p>" ;

	$tmpDate = funct_ChangTime( date("Y-m-d H:i:s") , "LS" , 10 ) ;		// 改變時間
	echo "<p>10秒鐘後 : $tmpDate</p>" ;
	*/
	
	$unix_time = strtotime( $subDate ) ;		//轉換成格林威治時間格式
	switch( $subType )
	{
		case "PH" :		// 前N小時
			$tmp_Sec = -($subNum * 3600) ;
			break;
		case "PM" :		// 前Ｎ分鐘
			$tmp_Sec = -($subNum * 60) ;
			break;
		case "PS" :		// 前Ｎ秒鐘
			$tmp_Sec = -($subNum) ;
			break;
		case "LH" :		// 後N小時
			$tmp_Sec = ($subNum * 3600) ;
			break;
		case "LM" :		// 後Ｎ分鐘
			$tmp_Sec = ($subNum * 60) ;
			break;
		case "LS" :		// 後Ｎ秒鐘
			$tmp_Sec = ($subNum) ;
			break;
		default:
	}
	return date("Y-m-d H:i:s",strtotime($subDateTime) + $tmp_Sec);
}
//~@_@~// END 改變日期 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 比較時間差 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getMinDiff( $subDate1 , $subDate2 , $subType )
{
	// 範例 $tmpDiff = getMinDiff( date("Y-m-d H:i:s") , $subDate2 , $subType ) ;
	// $subDate1		比較時間1
	// $subDate2		比較時間2
	// $subType			比較格式(Y:年,M:月,D:日,H:小時,I:分,S:秒)
	// $tmpDiff = getMinDiff( date("Y-m-d H:i:s") , $subDate2 , "I" ) ;		// 比較分鐘差
	// $tmpDiff = getMinDiff( date("Y-m-d H:i:s") , $subDate2 , "Y" ) ;		// 比較年差

	//echo "<p>傳入日期 : $subDate1 , $subDate2</p>" ;
	// 如果日期沒有輸入則不計算
	if( !($subDate1 AND $subDate2) )
	{	return "" ;	}
	
	// 取得時間1的秒數
	$tmp_Time1 = strtotime($subDate1) ;
	// 取得時間2的秒數
	$tmp_Time2 = strtotime($subDate2) ;
	
	$tmpDiffSec = abs($tmp_Time1 - $tmp_Time2) ;

	switch($subType)
	{
		case "Y" :	// 年
		case "M" :	// 月
			// 如果第一參數大於第二參數,互換
			if( $tmp_Time1 > $tmp_Time2 )
			{
				$tmp_Date = $subDate1 ;
				$subDate1 = $subDate2 ;
				$subDate2 = $tmp_Date ;
			}
			//echo "<p>傳入日期 : $subDate1 , $subDate2</p>" ;
			// 分析字串
			list($y1, $m1, $d1) = explode('-', $subDate1);
			list($y2, $m2, $d2) = explode('-', $subDate2);
			//echo "<p>$y1, $m1, $d1 $y2, $m2, $d2</p>" ;
			$y = $m = $d = $_m = 0; 
			$math = ($y2 - $y1) * 12 + $m2 - $m1; 
			//echo "<p>月份 : $math<p>";
			$y = floor($math / 12); 
			$m = intval($math % 12); 
			$d = (mktime(0, 0, 0, $m2, $d2, $y2) - mktime(0, 0, 0, $m2, $d1, $y2)) / 86400; 
			if ($d < 0)
			{ 
				$m -= 1; 
				$d  = date('j', mktime(0, 0, 0, $m2, 0, $y2)); 
			} 
			$m < 0 && $y -= 1; 
			//echo "<p>年 : $y , 月 : $m , 日 : $d</p>" ;
			//return array($y, $m, $d); 
			
			if( $subType == "Y" )
			{	return $y;	}
			else if( $subType == "M" )
			{	return $m;	}
			break;

		case "D" :	// 日
			$tmpSec = 86400 ;
			break;

		case "H" :	// 小時
			$tmpSec = 3600 ;
			break;

		case "I" :	// 分
			$tmpSec = 60 ;
			break;

		case "I" :	// 秒
			$tmpSec = 0 ;
			break;

		default:
	}
	return (int)($tmpDiffSec / $tmpSec) ;
}
//~@_@~// END 比較時間差 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得日期為星期幾 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getDay2Week( $subDate )
{
	// 範例 $tmpWeek = getDay2Week( date("Y-m-d") ) ;	//	取得日期為星期幾
	// $subDate		比較時間
	// 回傳值 : 0 : 星期日 , 1-6 : 星期一到星期六

	$arrDate = explode( "-" , $subDate );
	$week = date("w" , mktime( 0 , 0 , 0 , $arrDate[1] , $arrDate[2] , $arrDate[0] ) ); 
	return $week ;
}
//~@_@~// END 取得日期為星期幾 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 列出日期區間的所有月份清單 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getMonthRange( $subStartDay, $subEndDay )
{
	/*
	範例 $arrayMonthRange = func_getMonthRange( '2014-06-22', '2014-07-02' ) ;	//	列出日期區間的所有月份清單
	功能				: 列出日期區間的所有月份清單
	修改日期			: 190116
	參數說明			:
	$subStartDay		: 區間開始日期
	$subEndDay			: 區間結束日期
	設定開始和結束日期
	$tmpStartDate = "2018-01-01" ;
	$tmpEndDate = date("Y-m-d") ;
	$arrayMonthRange = func_getMonthRange( $tmpStartDate , $tmpEndDate ) ;	//	列出日期區間的所有月份清單
	echo "<p>月份區間</p>" ;print_r($arrayMonthRange);echo "<br>";
	*/
	// 測試日期
	//$subStartDay = "2017-05-02" ;
	//$subEndDay = date("Y-m-d") ;
	
	// 分析日期
	$split_StartDay = str2array( $subStartDay , "-" );
	$split_EndDay = str2array( $subEndDay , "-" );
	//echo "<p>開始日期</p>" ;print_r($split_StartDay);echo "<br>" ;
	//echo "<p>結束日期</p>" ;print_r($split_EndDay);echo "<br>" ;
	
	for( $i = $split_StartDay[0] ; $i <= $split_EndDay[0] ; $i++ )
	{
		if( $i == $split_StartDay[0] )
		{	// 是否和開始年份相同
			for( $j = $split_StartDay[1] ; $j <= 12 ; $j++ )
			{	$arrayMonthRange[] = $i . "-" . func_addFix0( $j , 2 ) ;	}
		}
		elseif( $i == $split_EndDay[0] )
		{	// 是否和結束年份相同
			for( $j = 1 ; $j <= (int)$split_EndDay[1] ; $j++ )
			{	$arrayMonthRange[] = $i . "-" . func_addFix0( $j , 2 ) ;	}
		}
		else
		{	// 其它年份
			for( $j = 1 ; $j <= 12 ; $j++ )
			{	$arrayMonthRange[] = $i . "-" . func_addFix0( $j , 2 ) ;	}
		}
	}

	//echo "<p>回傳日期</p>" ;print_r($arrayMonthRange);echo "<br>" ;

	return $arrayMonthRange;
}
//~@_@~// END 列出日期區間的所有月份清單 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
///~@_@~// START 列出日期區間的所有日期清單 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getDateRange( $subStartDay, $subEndDay )
{
	/*
	範例 $arrayDateRange = func_getDateRange( '2014-06-22', '2014-07-02' ) ;	//	列出日期區間的所有日期清單
	$subStartDay		區間開始日期
	$subEndDay		區間結束日期
	設定開始和結束日期
	$tmpStartDate = date("Y-m-d") ;
	$tmpEndDate = $tmpDate = getChangDay( date("Y-m-d") , "ND" , $tmpOrdering_Date ) ;		// 改變日期
	$arrayDateRange = func_getDateRange( $tmpStartDate , $tmpEndDate ) ;	//	列出日期區間的所有日期清單
	echo "<p>區間日期</p>" ;
	print_r($arrayDateRange);
	echo "<br>";
	*/

	$period = new DatePeriod(
		new DateTime($subStartDay),
		new DateInterval('P1D'),
		new DateTime($subEndDay)
	);
	
	foreach ($period as $date)
	{	$dates[] = $date->format('Y-m-d');	}
	$dates[] = $subEndDay ;
	
	return $dates;
}
//~@_@~// END 列出日期區間的所有日期清單 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得給定日期所在週的開始日期和結束日期 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getThisWeek( $subDate = "", $subFirstDay = 0)
{
	// 範例 $arrayDateRange = func_getThisWeek( date("Y-m-d"), 0 ) ;	//	取得給定日期所在週的開始日期和結束日期
	// $subDate			某周的日期
	// $subFirstDay		一周開始日,0為星期天，1為星期一

	if(!$subDate)
	{	$subDate = date("Y-m-d");	}
	
	// 取得傳入日期為一周的第幾天,星期天開始0-6
	$weekday = date("w", strtotime($subDate));
	
	// 要減去的天數
	if( $weekday == 0 AND $subFirstDay == 1 )
	{	$del_day = 6;	}
	else
	{	$del_day = $weekday - $subFirstDay;	}
	//echo "傳入日期 : $weekday , 要減去的天數 : $del_day<br>" ;

	//本週開始日期
	$week_start_day = date("Y-m-d", strtotime("$subDate -".$del_day." days"));

	//本週結束日期
	$week_end_day = date("Y-m-d", strtotime("$week_start_day +6 days"));

	//echo "本週開始日期 : $week_start_day , 本週結束日期 : $week_end_day<br>" ;

	$arrayDateRange = func_getDateRange( $week_start_day, $week_end_day ) ;	//	列出日期區間的所有日期清單

	//返回開始和結束日期
	return $arrayDateRange;
}
//~@_@~// END 取得給定日期所在週的開始日期和結束日期 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取出本月的開始和最後一天資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getMonthStartEndDate( $subStartDate , $subType  = "D" )
{
	/*
	作用 : 取出本月的開始和最後一天資料
	範例 : $arrayMonthStartEndDate = func_getMonthStartEndDate( "2018-01-01" , "DT" ) ;		// 取出本月的開始和最後一天資料
	參數說明 :
	$subStartDate	要查詢的日期
	$subType		回傳日期格式(D : 只有日期-2019-01-01 , DT : 日期加時間-2019-01-01 10:10:10)
	使用方法:
	// 如果只有設開始時間,表示查詢本月資料
	if( $Start_Date != "" AND empty($End_Date) )
	{
		$arrayMonthStartEndDate = func_getMonthStartEndDate( $Start_Date , "DT") ;		// 取出本月的開始和最後一天資料
		$Start_Date = $arrayMonthStartEndDate['Start_Date'] ;							// 設定本月第一天
		$End_Date = $arrayMonthStartEndDate['End_Date'] ;								// 設定本月最後一天
	}

	回傳 : 
	$arrayMonthStartEndDate['Start_Date']	本月第一天
	$arrayMonthStartEndDate['End_Date']		本月最後一天
	*/
	// 找出本月第一天
	if( $subType == "D" )
	{	$arrayMonthStartEndDate['Start_Date'] = mb_substr( $subStartDate , 0 , 7 , "utf-8" ) . "-01" ;	}
	elseif( $subType == "DT" )
	{	$arrayMonthStartEndDate['Start_Date'] = mb_substr( $subStartDate , 0 , 7 , "utf-8" ) . "-01 00:00:00";	}

	// 找出本月最後一天
	$DAYS_IN_MONTH = date(  "t", mktime(0, 0, 0, mb_substr( $subStartDate , 5 , 2 , "utf-8" ) , 1 , mb_substr( $subStartDate , 0 , 4 , "utf-8" ) )) ;	

	if( $subType == "D" )
	{	$arrayMonthStartEndDate['End_Date'] = mb_substr( $subStartDate , 0 , 7 , "utf-8" ) . "-" . $DAYS_IN_MONTH . "";	}
	elseif( $subType == "DT" )
	{	$arrayMonthStartEndDate['End_Date'] = mb_substr( $subStartDate , 0 , 7 , "utf-8" ) . "-" . $DAYS_IN_MONTH . " 23:59:59";	}

	return $arrayMonthStartEndDate ;
}
//~@_@~// END 取出本月的開始和最後一天資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得開始結束日期 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getStartEndDate( $subType , $subTime = 0  , $subDate = "" )
{
	/*
	範例			: $array_StartEndDate = func_getStartEndDate( $subType , $subTime , $subDate ) ;		// 取得開始結束日期
	功能			: 取得開始結束日期
	修改日期		: 20200528
	參數說明 :
		$subType	查詢類別(D:本日,LD:昨天,ND:明天,W:本周,LW:上一周,NW:下一周,M:本月,LM:上一月,NM:下一月,Y:本年,LY:上一年,NY:下一年)
		$subTime	是否包含時間(0:不包含,1:包含-00:00:00-23:59:59)
		$subDate	要判斷的日期(沒有輸入以今天為準)
	回傳參數 :
		$array_StartEndDate["Start"]		開始日期
		$array_StartEndDate["End"]			結束日期
	使用範例 :		:
		$array_StartEndDate = func_getStartEndDate( "D" , 1 , date("Y-m-d") ) ;		// 取得開始結束日期(包含時間)
		$array_StartEndDate = func_getStartEndDate( "W" , 0 , date("Y-m-d") ) ;		// 取得開始結束日期(不包含時間)
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████

	// 是否有指定日期	
	$subDate ? $tmp_NowDate = $subDate : $tmp_NowDate = date("Y-m-d") ;
	
	// D:本日,LD:昨天,ND:明天,W:本周,LW:上一周,NW:下一周,M:本月,LM:上一月,NM:下一月,Y:本年,LY:上一年,NY:下一年
	// 比對要回傳的日期查詢類別
	if( $subType == "D" )
	{// 本日
		$array_StartEndDate["Start"] = $tmp_NowDate ;		// 開始日期
		$array_StartEndDate["End"] = $tmp_NowDate ;		// 結束日期
	}
	else if( $subType == "LD" )
	{// 昨天
		$array_StartEndDate["Start"] = getChangDay( $tmp_NowDate , "LD" , 1 ) ;		// 開始日期
		$array_StartEndDate["End"] = getChangDay( $tmp_NowDate , "LD" , 1 ) ;		// 結束日期
	}
	else if( $subType == "ND" )
	{// 明天
		$array_StartEndDate["Start"] = getChangDay( $tmp_NowDate , "ND" , 1 ) ;		// 開始日期
		$array_StartEndDate["End"] = getChangDay( $tmp_NowDate , "ND" , 1 ) ;		// 結束日期
	}
	else if( $subType == "W" )
	{// 本周
		$arrayDateRange = func_getThisWeek( $tmp_NowDate, 0 ) ;	//	取得給定日期所在週的開始日期和結束日期
		$array_StartEndDate["Start"] = $arrayDateRange[0] ;		// 開始日期
		$array_StartEndDate["End"] = $arrayDateRange[6] ;		// 結束日期
	}
	else if( $subType == "LW" )
	{// 上一周
		$tmp_NowDate = getChangDay( $tmp_NowDate , "LD" , 7 ) ;		// 找出7天前日期
		$arrayDateRange = func_getThisWeek( $tmp_NowDate, 0 ) ;	//	取得給定日期所在週的開始日期和結束日期
		$array_StartEndDate["Start"] = $arrayDateRange[0] ;		// 開始日期
		$array_StartEndDate["End"] = $arrayDateRange[6] ;		// 結束日期
	}
	else if( $subType == "NW" )
	{// 下一周
		$tmp_NowDate = getChangDay( $tmp_NowDate , "ND" , 7 ) ;		// 找出7天前日期
		$arrayDateRange = func_getThisWeek( $tmp_NowDate, 0 ) ;	//	取得給定日期所在週的開始日期和結束日期
		$array_StartEndDate["Start"] = $arrayDateRange[0] ;		// 開始日期
		$array_StartEndDate["End"] = $arrayDateRange[6] ;		// 結束日期
	}
	else if( $subType == "M" )
	{// 本月
		$arrayMonthStartEndDate = func_getMonthStartEndDate( $tmp_NowDate , "D" ) ;		// 取出本月的開始和最後一天資料
		$array_StartEndDate["Start"] = $arrayMonthStartEndDate['Start_Date'] ;		// 開始日期
		$array_StartEndDate["End"] = $arrayMonthStartEndDate['End_Date'] ;		// 結束日期
	}
	else if( $subType == "LM" )
	{// 上一月
		$tmp_NowDate = getChangDay( $tmp_NowDate , "LM" , 1 ) ;		// 找出日期
		$arrayMonthStartEndDate = func_getMonthStartEndDate( $tmp_NowDate , "D" ) ;		// 取出本月的開始和最後一天資料
		$array_StartEndDate["Start"] = $arrayMonthStartEndDate['Start_Date'] ;		// 開始日期
		$array_StartEndDate["End"] = $arrayMonthStartEndDate['End_Date'] ;		// 結束日期
	}
	else if( $subType == "NM" )
	{// 下一月
		$tmp_NowDate = getChangDay( $tmp_NowDate , "NM" , 1 ) ;		// 找出日期
		$arrayMonthStartEndDate = func_getMonthStartEndDate( $tmp_NowDate , "D" ) ;		// 取出本月的開始和最後一天資料
		$array_StartEndDate["Start"] = $arrayMonthStartEndDate['Start_Date'] ;		// 開始日期
		$array_StartEndDate["End"] = $arrayMonthStartEndDate['End_Date'] ;		// 結束日期
	}
	else if( $subType == "Y" )
	{// 本年
		// 分析日期
		$tmpSplitDate = getSplitDate( $tmp_NowDate , "A") ;			// 全部分析
		$array_StartEndDate["Start"] = $tmpSplitDate[0] . "-01-01" ;		// 開始日期
		$array_StartEndDate["End"] = $tmpSplitDate[0] . "-12-31" ;		// 結束日期
	}
	else if( $subType == "LY" )
	{// 上一年
		$tmp_NowDate = getChangDay( $tmp_NowDate , "LY" , 1 ) ;		// 找出日期
		$tmpSplitDate = getSplitDate( $tmp_NowDate , "A") ;			// 全部分析
		$array_StartEndDate["Start"] = $tmpSplitDate[0] . "-01-01" ;		// 開始日期
		$array_StartEndDate["End"] = $tmpSplitDate[0] . "-12-31" ;		// 結束日期
	}
	else if( $subType == "NY" )
	{// 下一年
		$tmp_NowDate = getChangDay( $tmp_NowDate , "NY" , 1 ) ;		// 找出日期
		$tmpSplitDate = getSplitDate( $tmp_NowDate , "A") ;			// 全部分析
		$array_StartEndDate["Start"] = $tmpSplitDate[0] . "-01-01" ;		// 開始日期
		$array_StartEndDate["End"] = $tmpSplitDate[0] . "-12-31" ;		// 結束日期
	}

	// 是否包含時間
	if( $subTime )
	{
		$array_StartEndDate["Start"] .= " 00:00:00" ;
		$array_StartEndDate["End"] .= " 23:59:59" ;
	}

	return $array_StartEndDate ;
}
//~@_@~// END 取得開始結束日期 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 清除日期內定值為空 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_clearDefaultDate( $subDate , $subReplace = "" )
{
	/*
	作用 : 清除日期內定值為空
	範例 : $tmpDate = func_clearDefaultDate( "0000-00-00" , "" ) ;		// 清除日期內定值為空
	參數說明 :
	$subDate	: 要查詢的日期
	$subReplace	: 替代文字(---)
	使用方法:
	*/
	// 比對是否為內定值
	if( $subDate == "0000-00-00" )
	{	 $subDate = $subReplace ;	}
	elseif( $subDate == "0000-00-00 00:00:00" )
	{	 $subDate = $subReplace ;	}

	return $subDate ;
}
//~@_@~// END 清除日期內定值為空 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 格式化日期時間 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_FormatDateTime( $subDate  , $subModel = "Y" , $subTimeModel = "A" )
{
	/*
	範例			: $arrayReturnDate = func_FormatDateTime( date("Y-m-d H:i:s")  , "Y" , "A" ) ;		// 格式化日期時間
	功能			: 格式化日期時間
	修改日期		: 20181220
	參數說明		:
	$subDate		: 要格式化的日期(2018-01-01 10:10:10)
	$subDateModel	: 要格式化的日期模式 - N : 不秀 , D : 原始日期 , Y : 西元(2018年1月1日) , C : 國曆(107年1月1日)
	$subTimeModel	: 要格式化的時間模式 - N : 不秀 , A : 全部(10點10分10秒) , HM : 小時和分(10點10分) , H : 小時(10點)
	$subTimeModel	: 要格式化的時間模式 - DA : 原始時間(10:10:10) , DHM : 小時和分(10:10) , DH : 小時(10)
	使用範例		:
	秀西元日期和時間 (2018年12月27日 17點32分28秒)
	$arrayReturnDate = func_FormatDateTime( date("Y-m-d H:i:s")  , "Y" , "HM" ) ;		// 格式化日期時間
	只秀西元日期 (2018年12月27日)
	$arrayReturnDate = func_FormatDateTime( date("Y-m-d H:i:s")  , "Y" , "N" ) ;		// 格式化日期時間
	只秀國曆日期 (107年12月27日)
	$arrayReturnDate = func_FormatDateTime( date("Y-m-d H:i:s")  , "Y" , "N" ) ;		// 格式化日期時間

	只秀原始日期和時間 (2018-12-27 10:10:10)
	$arrayReturnDate = func_FormatDateTime( date("Y-m-d H:i:s")  , "D" , "DA" ) ;		// 格式化日期時間

	只秀時間(全部)(17點32分28秒)
	$arrayReturnDate = func_FormatDateTime( date("Y-m-d H:i:s")  , "N" , "A" ) ;		// 格式化日期時間
	只秀時間(小時和分)(17點32分)
	$arrayReturnDate = func_FormatDateTime( date("Y-m-d H:i:s")  , "N" , "HM" ) ;		// 格式化日期時間
	只秀時間(小時)(17:32)
	$arrayReturnDate = func_FormatDateTime( date("Y-m-d H:i:s")  , "N" , "DHM" ) ;		// 格式化日期時間
	
	$arrayReturnDate['Date']	日期
	$arrayReturnDate['Time']	時間
	*/
	// 分析時間格式
	$tmpSplitDate = getSplitDate( $subDate , "A") ;		// 取出日期中的某個欄位
	$arrayReturnDate = "" ;
	// 求出格式化後日期資料
	switch ( $subModel )
	{
		case "D" :
			$arrayReturnDate['Date'] = $tmpSplitDate[0] . "-" . $tmpSplitDate[1] . "-" . $tmpSplitDate[2] ;
			break;
		case "Y" :
			$arrayReturnDate['Date'] = $tmpSplitDate[0] . "年" . $tmpSplitDate[1] . "月" . $tmpSplitDate[2] .  "日" ;
			break;
		case "C" :
			$arrayReturnDate['Date'] = ( $tmpSplitDate[0] - 1911 ) . "年" . $tmpSplitDate[1] . "月" . $tmpSplitDate[2] .  "日" ;
			break;
		default:
	}

	// 求出格式化後日期資料
	switch ( $subTimeModel )
	{
		case "A" :
			$arrayReturnDate['Time'] .= $tmpSplitDate[3] . "點" . $tmpSplitDate[4] . "分" . $tmpSplitDate[5] .  "秒" ;
			break;
		case "HM" :
			$arrayReturnDate['Time'] .= $tmpSplitDate[3] . "點" . $tmpSplitDate[4] . "分" ;
			break;
		case "H" :
			$arrayReturnDate['Time'] .= $tmpSplitDate[3] . "點" ;
			break;
		case "DA" :
			$arrayReturnDate['Time'] .= $tmpSplitDate[3] . ":" . $tmpSplitDate[4] . ":" . $tmpSplitDate[5] ;
			break;
		case "DHM" :
			$arrayReturnDate['Time'] .= $tmpSplitDate[3] . ":" . $tmpSplitDate[4] ;
			break;
		case "DH" :
			$arrayReturnDate['Time'] .= $tmpSplitDate[3] . ":" ;
			break;
		default:
	}

	return $arrayReturnDate ;
}
//~@_@~// END 格式化日期 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 是否為有效日期資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_isDate( $subDate )
{
	/*
	範例			: $Bol_Date = func_isDate( date("Y-m-d H:i:s") ) ;		// 是否為有效日期資料
	功能			: 格式化日期時間
	修改日期		: 20190116
	參數說明		:
	*/
	//echo $subDate ;
    if(!preg_match("/^[0-9]{4}-[1-12]{2}-[1-31]{2}$/", $subDate))
	{
		//echo "  555555" ;
        //return false;
    }
    $__y = substr($subDate, 0, 4);
    $__m = substr($subDate, 5, 2);
    $__d = substr($subDate, 8, 2);
    return checkdate($__m, $__d, $__y);
}
//~@_@~// END 是否為有效日期資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 西元民國互換 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_chnageYear1911( $subDate , $subSegmentation = "-" , $subType = "CUT" , $subShow = "B")
{
	/*
	範例			: $Return_Date = func_chnageYear1911( $subDate , $subSegmentation , $subType ) ;		// 西元民國互換
	功能			: 西元民國互換
	修改日期		: 20191101
	參數說明		:
		$subDate			轉換日期
		$subSegmentation	分割符號或要加的符號(/,-)-民國換西元 : 要加的符號
		$subType			作用(ADD : 民國換西元 , CUT : 西元換民國)
		$subShow			秀出日期格式(B : 基本-2019-01-01 1080101 , C : 中文-2019年01月01日 民國108年01月01日)
	回傳
		日期
	範例
		$Return_Date = func_chnageYear1911( date("Y-m-d") , "-" , "CUT" , "B") ;		// 西元換民國
		$Return_Date = func_chnageYear1911( "1081009" , "-" , "ADD" , "B") ;		// 民國換西元
	*/
	if( empty(func_clearDefaultDate($subDate)) )
	{	return "" ;	}
	
	if( $subType == "CUT" )
	{// 西元換民國
		//echo "西元換民國" ;
		$array_Date = str2array($subDate , $subSegmentation);
		//echo "<p>$subDate</p>" ;print_r($array_Date);echo "<br>" ;
		$tmp_Year = $array_Date[0]-1911 ;
		if( strlen($tmp_Year) == 1 )
		{	$tmp_Year = "00$tmp_Year";	}
		else if( strlen($tmp_Year) == 2 )
		{	$tmp_Year = "0$tmp_Year";	}
		$tmp_Month = $array_Date[1] ;
		$tmp_Day = $array_Date[2] ;
		if( $subShow == "B" )
		{	return $tmp_Year . $tmp_Month . $tmp_Day ;	}
		else
		{	return "民國{$tmp_Year}年{$tmp_Month}月{$tmp_Day}日" ;	}
	}
	else
	{// 民國換西元
		//echo "民國換西元" ;
		// 取出年分(前3個字)
		$tmp_Year = mb_substr($subDate , 0 , 3 , "utf-8") ;
		$tmp_Year += 1911;
		$tmp_Month = mb_substr($subDate , 3 , 2 , "utf-8") ; ;
		$tmp_Day = mb_substr($subDate , 5 , 2 , "utf-8") ; ;
		if( $subShow == "B" )
		{	return $tmp_Year . $subSegmentation . $tmp_Month . $subSegmentation . $tmp_Day ;	}
		else
		{	return "{$tmp_Year}年{$tmp_Month}月{$tmp_Day}日" ;	}
	}
}
//~@_@~// END 西元民國互換 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 安全相關
//~@_@~// START 寫入LogField資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_WriteLogFieldInfo( $subOperatorDB , $subOperatorField , $subOperatorID , $subLogField , $arrayLogInfo , $subLogType = "LogInfo" )
{
	global $link ;
	global $Conn_NoWriteLogFieldInfo ;	// 是否要寫入管理者LOG 1 : 不寫入管理者LOG , 0 : 寫入管理者LOG
	/*
	★範例			$tmpCode = func_WriteLogFieldInfo( "Member" , "Member_ID" , $_SESSION['Member_ID'] , "Member_Log" , $array_LogInfo ) ;	// 寫入LogField資料
	★功能			先把操作者的資料寫入自己的Log欄位中,等到快滿時再移到統一Log中
					同時把資料也寫入系統記錄中
	★修改日期		190705
		$subOperatorDB		操作者資料表名稱
		$subOperatorField	操作者ID欄位名稱
		$subOperatorID		操作者ID
		$subLogField		要儲存記錄的Log欄位名稱
		$arrayLogInfo		要寫入Log資料
		$subLogType			系統儲存記錄寫入的表格名稱( LogInfo : 一般操作(內定) , LogAdmin : 管理者操作 )
		如果為系統產生動作可以寫到-SystemSet中(+欄位 : )
		█ INSERT INTO `ModelSet` (`ModelSet_Name`, `ModelSet_Key`, `ModelSet_Value`, `ModelSet_Group`, `ModelSet_Content`, `ModelSet_Sort`, `ModelSet_Add_DT`, `ModelSet_On`) VALUES ('系統操作Log', 'System_Log', '', '', '', '', '', '1');
	★使用範例
		// 加入LOG
		$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
		$array_LogInfo['OperatorID'] = $_SESSION['Member_ID'] ;			// 操作者ID
		$array_LogInfo['OperatorName'] = $_SESSION['Member_Name'] ;		// 操作者姓名
		$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
		$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
		$array_LogInfo['ID'] = $ID ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
		$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP

			$array_LogInfo['Type'] = "新增" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
			$array_LogInfo['Info'] = "動作:新增會員 , 操作者:{$_SESSION['Member_Name']} , 新會員姓名:$Member_Name , 新會員ID:$tempID , 新會員帳號:$Member_Login_Name , 父ID:$Member_Father_ID" ;	// 操作記錄 備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)

			$array_LogInfo['Type'] = "修改" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
			$array_LogInfo['Info'] = "動作:修改會員 , 操作者:{$_SESSION['Member_Name']} , 會員ID:$ID" ;		// 操作記錄 備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = str_replace ("'","’",$modSQL) ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)

			$array_LogInfo['Type'] = "刪除" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
			$array_LogInfo['Info'] = "動作:刪除會員 , 操作者:{$_SESSION['Member_Name']}" ;		// 操作記錄 備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = "" ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)

			$array_LogInfo['Type'] = "查詢" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
			$array_LogInfo['Info'] = "動作:查詢資料 , 操作者:{$_SESSION['Member_Name']}" ;			// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = str_replace ("'","’",$SQL) ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)

			$array_LogInfo['Type'] = "登入" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
			$array_LogInfo['Info'] = "{$_SESSION['Member_Name']}-由系統登入" ;		// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['Info'] = "{$_SESSION['Member_Name']}-登入系統" ;		// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = "" ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)

			$array_LogInfo['Type'] = "登出" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
			$array_LogInfo['Info'] = "{$_SESSION['Member_Name']}-登出系統" ;		// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
			$array_LogInfo['SQL'] = "" ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)


		// 會員操作-管理等級來判斷
		$tmpCode = func_WriteLogFieldInfo( "Member" , "Member_ID" , $_SESSION['Member_ID'] , "Member_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料
	
		// 管理者操作-管理等級來判斷
		$tmpCode = func_WriteLogFieldInfo( "SystemUser" , "SystemUser_ID" , $_SESSION['SystemUser_ID'] , "SystemUser_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
		
		// 系統操作Log(排程,金流...)
		$tmpCode = func_WriteLogFieldInfo( "ModelSet" , "ModelSet_Key" , "System_Log" , "ModelSet_Content" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料
	*/
//echo "---------------------------------$subOperatorDB , $subOperatorField , $subOperatorID , $subLogField , $arrayLogInfo , $subLogType = LogInfo";
	// 現在時間
	$tmpNowDT = date("Y-m-d H:i:s") ;
	// 如果為公司測試則不用加入Log
	if ( strlen($_SESSION['SystemUser_ID']) == 10 AND $Conn_NoWriteLogFieldInfo )
	{	return 1;	}

	// 取得操作者Log資料
	$arrayInfo = func_DatabaseGet( $subOperatorDB , array($subLogField) , array($subOperatorField=>$subOperatorID) ) ;

	// 找到操作者資料
	if ( $arrayInfo )
	{
		// 轉換要記錄的Log資料
		$tmpLog = "" ;
		$arrayLog = array() ;

		// 把要儲存的資料轉成字串
		foreach( $arrayLogInfo as $key => $value )
		{
			if( $key == "SQL" )
			{// 如果為SQL.把\n去掉
				//$value = nl2br($value);
				$value = str_replace ("\r\n","",$value);
				$value = str_replace ("\n","",$value);
				//$value = preg_replace("\r\n","",$value);
				//$value = preg_replace("\n","",$value);
			}
			$arrayLog[] =  "$key|$value" ;
		}
		// 把所有資料串起來
		$tmpLog = "|" . array2str($arrayLog , "|,|") . "|";
		//echo "<p>要記錄的資料 : $tmpLog</p>" ;

		// 設定第一筆資料時的LOG資料
		$tmpLogField = "'$tmpLog'" ;

		//~@_@~// START 寫入LOG系統資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
		// 找出最新一筆LOG系統資料(LogAdmin或LogInfo)
		$tmpSQL_System_Log = "SELECT * FROM $subLogType WHERE {$subLogType}_Database = 'System_Log' ORDER BY id_$subLogType DESC" ;
		$arraySystem_LogInfo = func_DatabaseGet( $tmpSQL_System_Log , "SQL" , "" , "" ) ;									// 資料庫處理
		if ( $arraySystem_LogInfo["{$subLogType}_Msg"] )
		{// 已有LOG系統資料
			// 如果資料量太大,轉到Log資料庫中,並把原來的資料清空
			if ( strlen( $arraySystem_LogInfo["{$subLogType}_Msg"] ) + strlen( $tmpLog ) > 60000 )
			{// 新增一筆資料
				$tmpSystem_Log_Funct = "ADD" ;	// 設定要做的動作
			}
			else// 已有資料,前面要加換行
			{
				$tmpSystem_LogField = "CONCAT({$subLogType}_Msg, '\n$tmpLog')" ;
				$tmpSystem_Log_Funct = "MOD" ;	// 設定要做的動作
			}
		}
		else// 沒有系統流程資料,新增一筆資料
		{	$tmpSystem_Log_Funct = "ADD" ;	}

		// LOG要做的動作
		if( $tmpSystem_Log_Funct == "ADD" )
		{// 新增一筆LOG資料
			$arrayLogInfoField["{$subLogType}_OperatorID"] = $subOperatorID ;
			$arrayLogInfoField["{$subLogType}_Database"] = "System_Log" ;
			$arrayLogInfoField["{$subLogType}_Msg"] = $tmpLog ;
			$arrayLogInfoField["{$subLogType}_Start_DT"] = $tmpNowDT ;
			$arrayLogInfoField["{$subLogType}_End_DT"] = $tmpNowDT ;
			$arrayLogInfoField["{$subLogType}_Add_DT"] = $tmpNowDT ;
			$Bol = func_DatabaseBase( $subLogType , "ADD" , $arrayLogInfoField , "" ) ;						// 資料庫處理
			// echo "<p>新增一筆LOG資料 - $Bol</p>" ;print_r($arrayLogInfoField);echo "<br>" ;
		}
		else
		{// 修改LOG資料
			// 寫入操作LOG
			$modSQL_System_Log = "UPDATE $subLogType SET
			{$subLogType}_Msg = $tmpSystem_LogField ,
			{$subLogType}_End_DT = '$tmpNowDT'
			WHERE id_{$subLogType} = '" . $arraySystem_LogInfo["id_$subLogType"] . "'" ;
			//echo "<p>記錄SQL : $modSQL_System_Log</p>" ;
			
			if ( mysqli_query($link , $modSQL_System_Log) )
			{		}
			else
			{		}
		}

		//~@_@~// END 寫入系統流程資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

		//~@_@~// START 寫入操作者資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
		// 已有Log資料
		if ( $arrayInfo[$subLogField] )
		{
			// 如果資料量太大,轉到Log資料庫中,並把原來的資料清空
			if ( strlen( $arrayInfo[$subLogField] ) + strlen( $tmpLog ) > 60000 )
			{// 資料量太大
				//alertgo("資料量太大","");
				//$tmpCode = func_WriteLogInfo( $_SESSION['SystemUser_ID'] , "Operator_Log" , $arrayInfo[$subLogField] ) ;	// 寫入LOG系統

				// 找出資料的第一筆和最後一筆日期
				$arrayLogInfo = str2array($arrayInfo[$subLogField] , "\n");
				if($tmpShowMsg){echo "<p>分析Log資料</p>" ;print_r($arrayLogInfo);echo "<br>" ;}
				// 第一筆
				$arrayFirstLog = str2array($arrayLogInfo[0] , "|,|");
				// 時間在最前面一筆資料
				$arrayLogInfo_Start_DT = str2array($arrayFirstLog[0] , "|");

				// 最後一筆
				$arrayLastLog = str2array($arrayLogInfo[sizeof($arrayLogInfo)-1] , "|,|");
				// 時間在最前面一筆資料
				$arrayLogInfo_End_DT = str2array($arrayLastLog[0] , "|");

				// $subLogType			系統流程記錄寫入的表格( LogInfo : 一般操作(內定) , LogAdmin : 管理者操作 )
				$arrayLogInfoField["{$subLogType}_OperatorID"] = $subOperatorID ;
				$arrayLogInfoField["{$subLogType}_Database"] = "Operator_Log" ;
				$arrayLogInfoField["{$subLogType}_Msg"] = $arrayInfo[$subLogField] ;
				$arrayLogInfoField["{$subLogType}_Start_DT"] = $arrayLogInfo_Start_DT[1] ;
				$arrayLogInfoField["{$subLogType}_End_DT"] = $arrayLogInfo_End_DT[1] ;
				$arrayLogInfoField["{$subLogType}_Add_DT"] = $tmpNowDT ;
				$Bol = func_DatabaseBase( $subLogType , "ADD" , $arrayLogInfoField , "" ) ;						// 資料庫處理
			}
			else// 已有資料,前面要加換行
			{	$tmpLogField = "CONCAT($subLogField, '\n$tmpLog')" ;	}
		}
		else	// 沒有LOG資料
		{}

		//$subLogType
		// 寫入操作LOG
		$modSQL = "UPDATE $subOperatorDB SET
		$subLogField = $tmpLogField
		WHERE $subOperatorField = '$subOperatorID'" ;
		//echo "<p>記錄SQL : $modSQL</p>" ;
		if ( mysqli_query($link , $modSQL) )
		{	return 1 ;	}
		else
		{	return "" ;	}
		//~@_@~// END 寫入操作者資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
	}
	else
	{
		// 寫入系統流程資料-沒有操作者,把參數記錄下來

		return "" ;
	}
}
//~@_@~// END 寫入LogField資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 寫入LOG系統 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_WriteLogInfo( $subUserID , $subOperatorDB , $subLogMsg )
{
	global $link ;
	/*
	範例			: $tmpCode = func_WriteLogInfo( $subSystemUserID , $subOperatorDB , $subLogMsg ) ;	// 寫入LOG系統
	功能			: 寫入LOG系統
	修改日期		: 190430
		$subUserID		: 操作人ID
		$subOperatorDB	: 資料庫名稱
		$subLogMsg		: Log內容
	使用範例		:

	配合func_WriteLogFieldInfo()使用
	*/

	// 找出資料的最早時間
	//寫入資料庫
	$insertSQL="INSERT INTO LogInfo SET 
	LogInfo_UserID = '$subUserID' , 
	LogInfo_Database = '$subOperatorDB' ,
	LogInfo_Msg = '$subLogMsg' , 
	LogInfo_Add_DT = '" . date("Y-m-d H:i:s") . "' ,
	LogInfo_On = '1'
	";
	//echo "$insertSQL<br>" ;
	if(mysqli_query($link , $insertSQL))
	{	return "OK" ;	}
	else
	{	echo "func_WriteLogInfo() LOG系統資料 新增失敗" ;	}

}
//~@_@~// END 寫入LOG系統 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 分析LOG資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_AnalysisLogInfo( $arrayLogInfo )
{
	global $link ;
	/*
	範例			: $arrayConvLog = func_AnalysisLogInfo( $arrayLogInfo ) ;	// 分析LOG資料
	功能			: 分析LOG資料
	修改日期		: 190430
		$arrayLogInfo		: Log內容

	使用範例		:
	
	$arrayMemberInfo = func_DatabaseGet( "Member" , array("Member_Log") , array("Member_ID"=>"Member9600307845") ) ;		// 取得資料庫資料
	echo "<p>Log資料</p>" ;print_r($arrayMemberInfo);echo "<br>" ;
	$arrayConvLog = func_AnalysisLogInfo( $arrayMemberInfo['Member_Log'] ) ;	// 分析LOG資料
	echo "<p>分析Log資料</p>" ;print_r($arrayConvLog);echo "<br>" ;
	記錄欄位名稱 :
		時間 : [Time] => 2019-07-10 10:27:21 , 操作者ID : [OperatorID] => Member0001 , 操作者名稱 : [OperatorName] => yldu12
		操作資料欄位 : [FileName] => , 操作資料表 : [Table] => , 操作id : [ID] => 
		記錄格式 : [Type] => 新增 , 記錄資訊 : [Info] => yldu12-轉換管理分店 , 分店:體育場 , ID:Store1906260001
		執行SQL : [SQL] => , 執行IP : [IP] => 36.236.53.31
	*/
	$tmpShowMsg = 0 ;		// 是否要在網頁秀出除錯資料(1:秀出,0:不秀)

	$arrayLogInfo = str2array($arrayLogInfo , "\n");
	//if($tmpShowMsg){echo "<p>分析Log資料</p>" ;print_r($arrayLogInfo);echo "<br>" ;}

	foreach( $arrayLogInfo as $key => $value )
	{
		//echo "<p>第 $key 筆 $value</p>";
		// 分析欄位
		$arrayLogField = str2array($value , "|,|");
		foreach( $arrayLogField as $keyField => $valueField )
		{
			// 分析內容
			$arrayLogContent = str2array($valueField , "|");
			if( $arrayLogContent[0] == "" )
			{// 因為前面多出|,要去掉
				$arrayLogContent[0] = $arrayLogContent[1] ;
				$arrayLogContent[1] = $arrayLogContent[2] ;
			}
			$arrayConvLog[$key][$arrayLogContent[0]] = $arrayLogContent[1] ;
			//echo "<p>{$arrayLogContent[0]} => {$arrayLogContent[1]}</p>" ;
		}
	}
	if($tmpShowMsg){echo "<p>轉換後的Log資料</p>" ;print_r($arrayConvLog);echo "<br>" ;}
	return $arrayConvLog;
}
//~@_@~// END 分析LOG資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢登入失敗次數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_checkLoginLock( $subIP , $subUnlockTime )
{
	global $link ;
	// 範例			: $tmpNum = func_checkLoginLock( $_SERVER['REMOTE_ADDR'] , 10 ) ;	// 查詢登入失敗次數
	// 功能			: 查詢登入失敗次數
	// 修改日期		: 180703
	// $subIP			: 登入IP
	// $subUnlockTime	: 解禁時間(分鐘)

	// 查詢IP是否已封鎖
	$SQL = "SELECT * FROM LoginControl WHERE LoginControl_IP = '" . $subIP . "'" ;
	//echo "<p>查詢IP登入失敗次數 : $SQL</p>" ;
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		// 求出一筆資料
		$LIST = mysqli_fetch_assoc($QUERY) ;
		// 是否已被封鎖
		if( $LIST['LoginControl_On'] == 0 )
		{
			// 是否已超過限制時間,解禁
			$tmpDiff = getMinDiff( date("Y-m-d H:i:s") , $LIST['LoginControl_LastLogin_DT'] , "I" ) ;		// 比較分鐘差
			if( $tmpDiff >= $subUnlockTime )
			{
				//echo "解禁 : $tmpDiff<br>" ;
				$tmp_Database_Funct = "IP解禁" ;
				$modSQL_LoginControl = "UPDATE LoginControl SET
				LoginControl_Name = '' ,
				LoginControl_Failed_Num = '0' ,
				LoginControl_Log = CONCAT(LoginControl_Log, '時間超過-解禁:" . date("Y-m-d H:i:s") . "\n') ,
				LoginControl_Lock_Key = '' ,
				LoginControl_On = '1' ,
				LoginControl_LastLogin_DT = '" . date("Y-m-d H:i:s") . "'
				WHERE LoginControl_IP = '" . $subIP . "'" ;
				//echo "$modSQL_LoginControl<br>" ;
				if ( mysqli_query($link , $modSQL_LoginControl) )
				{
					return 0 ;
				}
				else
				{	echo $tmp_Database_Funct . "-修改失敗!!<br>" ;	}
			}
		}
		elseif( $LIST['LoginControl_Failed_Num'] > 0 )
		{
			// 是否已超過限制時間,清空資料
			$tmpDiff = getMinDiff( date("Y-m-d H:i:s") , $LIST['LoginControl_LastLogin_DT'] , "I" ) ;		// 比較分鐘差
			if( $tmpDiff >= $subUnlockTime )
			{
				echo "清空資料 : $tmpDiff<br>" ;
				$tmp_Database_Funct = "IP清空資料" ;
				$modSQL_LoginControl = "UPDATE LoginControl SET
				LoginControl_Name = '' ,
				LoginControl_Failed_Num = '0' ,
				LoginControl_Lock_Key = '' ,
				LoginControl_LastLogin_DT = '" . date("Y-m-d H:i:s") . "'
				WHERE LoginControl_IP = '" . $subIP . "'" ;
				//echo "$modSQL_LoginControl<br>" ;
				if ( mysqli_query($link , $modSQL_LoginControl) )
				{
					return 0 ;
				}
				else
				{	echo $tmp_Database_Funct . "-修改失敗!!<br>" ;	}
			}
		}
		return $LIST['LoginControl_Failed_Num'] ;
	}
	else
	{
		return 0;
	}
}
//~@_@~// END 查詢登入失敗次數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 設定登入管制次數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_checkLoginControl( $subIP , $subLoginName , $subLockNum , $subUnlockTime )
{
	global $link ;
	// 範例			: $tmpNum = func_checkLoginControl( $_SERVER['REMOTE_ADDR']  , $_SESSION['Member_ID'] , 10 , 10 ) ;	// 設定登入管制次數
	// 功能			: 設定登入管制次數
	// 修改日期		: 180703
	// $subIP			: 登入失敗IP
	// $subLoginName	: 登入失敗帳號
	// $subLockNum		: 封銷失敗次數
	// $subUnlockTime	: 解禁時間(分鐘)

	// 查詢IP是否已封鎖
	$SQL = "SELECT * FROM LoginControl WHERE LoginControl_IP = '" . $subIP . "'" ;
	//echo "<p>查詢IP登入失敗次數 : $SQL</p>" ;
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		// 求出一筆資料
		$LIST = mysqli_fetch_assoc($QUERY) ;
		// 是否已被封鎖
		if( $LIST['LoginControl_On'] == 0 )
		{
			// 是否已超過限制時間,解禁
			$tmpDiff = getMinDiff( date("Y-m-d H:i:s") , $LIST['LoginControl_LastLogin_DT'] , "I" ) ;		// 比較分鐘差
			if( $tmpDiff >= $subUnlockTime )
			{
				$tmp_Database_Funct = "IP解禁" ;
				$modSQL_LoginControl = "UPDATE LoginControl SET
				LoginControl_Name = '$subLoginName' ,
				LoginControl_Failed_Num = '1' ,
				LoginControl_Log = CONCAT(LoginControl_Log, '時間超過-解禁:" . date("Y-m-d H:i:s") . "\n') ,
				LoginControl_On = '1' ,
				LoginControl_LastLogin_DT = '" . date("Y-m-d H:i:s") . "'
				WHERE LoginControl_IP = '" . $subIP . "'" ;
				//echo "$modSQL_LoginControl<br>" ;
				if ( mysqli_query($link , $modSQL_LoginControl) )
				{
				}
				else
				{	echo $tmp_Database_Funct . "-修改失敗!!<br>" ;	}
				return 1 ;
			}
			else
			{	// 設定登入失敗次數和最後登入失敗時間,如果帳號不同再加入資料庫
				$tmp_Database_Funct = "封鎖IP" ;
				$modSQL_LoginControl = "UPDATE LoginControl SET
				LoginControl_Failed_Num = LoginControl_Failed_Num + 1 ,
				LoginControl_LastLogin_DT = '" . date("Y-m-d H:i:s") . "'
				WHERE LoginControl_IP = '" . $subIP . "'" ;
				//echo "$modSQL_LoginControl<br>" ;
				if ( mysqli_query($link , $modSQL_LoginControl) )
				{
				}
				else
				{	echo $tmp_Database_Funct . "-修改失敗!!<br>" ;	}
				return ($LIST['LoginControl_Failed_Num'] + 1) ;
			}
		}
		else
		{	// 還沒有封鎖
			// 如果到封鎖次數,封鎖並寫入LOG
			if( $LIST['LoginControl_Failed_Num'] >= ($subLockNum-1) )
			{
				$tmp_Database_Funct = "封鎖IP" ;
				$modSQL_LoginControl = "UPDATE LoginControl SET
				LoginControl_Name = '' ,
				LoginControl_Failed_Num = LoginControl_Failed_Num + 1 ,
				LoginControl_Log = CONCAT(LoginControl_Log, '封鎖IP:" . date("Y-m-d H:i:s") . "|登入帳號:" . $LIST['LoginControl_Name'] . "\n') ,
				LoginControl_Lock_Key = '" . session_id() . "' ,
				LoginControl_On = '0' ,
				LoginControl_LastLogin_DT = '" . date("Y-m-d H:i:s") . "'
				WHERE LoginControl_IP = '" . $subIP . "'" ;
				//echo "$modSQL_LoginControl<br>" ;
				if ( mysqli_query($link , $modSQL_LoginControl) )
				{
				}
				else
				{	echo $tmp_Database_Funct . "-修改失敗!!<br>" ;	}
			}
			else
			{	// 還沒到封銷次數
				// 如果為第一筆則不用加,
				if( $LIST['LoginControl_Failed_Num'] == 0 )
				{	$tmpLoginControl_Name = "$subLoginName" ;	}
				else
				{	$tmpLoginControl_Name = ",$subLoginName" ;	}
				
				$tmp_Database_Funct = "加登入失敗次數" ;
				$modSQL_LoginControl = "UPDATE LoginControl SET
				LoginControl_Name = CONCAT(LoginControl_Name , '$tmpLoginControl_Name' ) ,
				LoginControl_Failed_Num = LoginControl_Failed_Num + 1 ,
				LoginControl_LastLogin_DT = '" . date("Y-m-d H:i:s") . "'
				WHERE LoginControl_IP = '" . $subIP . "'" ;
				//echo "$modSQL_LoginControl<br>" ;
				if ( mysqli_query($link , $modSQL_LoginControl) )
				{
				}
				else
				{	echo $tmp_Database_Funct . "-修改失敗!!<br>" ;	}
			}
			return ($LIST['LoginControl_Failed_Num'] + 1) ;
		}
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{	// 第一次登入失敗
		echo "沒有找到資料<br>" ;
		// 加入新資料
		$tmp_Database_Funct = "登入管制系統" ;
		$addSQL_LoginControl = "INSERT INTO LoginControl SET
		LoginControl_IP = '$subIP' ,
		LoginControl_Name = '$subLoginName' ,
		LoginControl_Failed_Num = '1' ,
		LoginControl_On = '1' ,
		LoginControl_LastLogin_DT = '" . date("Y-m-d H:i:s"). "'
		" ;
		//echo "$addSQL_LoginControl<br>" ;
		if ( mysqli_query($link , $addSQL_LoginControl) )
		{
			// 求出ID
			//$id = mysqli_insert_id($link) ;
			//alertgo( "新增完成" , "index.php" ) ;
		}
		else
		{	echo $tmp_Database_Funct . "-新增失敗!!<br>" ;	}
		return 1 ;
	}
}
//~@_@~// END 設定登入管制次數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 目錄檔案
//~@_@~// START 找出所在目錄路徑相對資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function checkWherePathDir( $subDir )
{
	/*
	範例 $arrayDir = checkdir( __FILE__ );
	功能			: 找出所在目錄路徑相對資料
	$subDir		: 要比對的目錄
	回傳參數
	$array['NowPath']	: 完整路徑
	$array['LastPath']	: 上層路徑
	$array['NowDir']	: 所在目錄
	*/
	
	$array['NowPath'] = dirname( $subDir ) ;
	//echo "完整路徑 : " . $array['NowPath'] . "<br>";
	$array['LastPath'] = dirname(dirname( $subDir )) ;
	//echo "上層路徑 : " . $array['LastPath'] . "<br>";
	$array['NowDir'] = str_replace ( $array['LastPath'] . "/" , "" , $array['NowPath']);
	//echo "所在目錄 : " . $array['NowDir'] . "<br>";
	return $array ;
}
//~@_@~// END 找出所在目錄路徑相對資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 檢查檔案是否存在 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function checkFileExist ( $subDir )
{
	/*
	範例 $Bol = checkFileExist( $MAIN_BASE_ADDRESS . "image/1.jpg" );
	功能			: 檢查檔案是否存在
	$subDir		: 要判斷的檔案路徑(相對路徑)
	回傳參數
	1 : 檔案存在
	0 : 檔案不存在
	*/
	// 設定檔案路徑
	//echo $subDir . "<br>" ;
	$tmpDir = urldecode($subDir) ;
	//echo $subDir . "---" . $tmpDir;

	if( file_exists($tmpDir) )
	{    return 1 ;    }
	else
	{    return 0 ;    }
}
//~@_@~// END 檢查檔案是否存在 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 上傳檔案到Imgur ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_UpFile2Imgur ( $subUpFieldName )
{
	/*
	範例 $arrayUpFileInfo = func_UpFile2Imgur( "Member_Pict" );
	功能			: 上傳檔案到Imgur
	修改日期		: 20190116
	參數說明		:
	$subUpFieldName	: 上傳檔案的欄位名稱
	$subExtension	: 副檔名設定(以後寫)
	回傳參數
		$arrayUpFileInfo['State']	: 執行狀態( OK : 上傳成功 , ERR : 有錯誤 )
		$arrayUpFileInfo['URL']		: 上傳成功時回傳的URL
		$arrayUpFileInfo['ErrMsg']	: 錯誤的訊息

	實際範例:
	// 上傳檔案到Imgur
	$arrayUpFileInfo = func_UpFile2Imgur( "Member_Pict" );
	if( $arrayUpFileInfo['State'] == "OK" )
	{
		// 加入資料庫欄位
		$tmpSQL .= " Member_Pict = '" . $arrayUpFileInfo['URL'] . "' , " ;
		echo "回傳的URL : {$arrayUpFileInfo['URL']}" ;
	}
	else
	{	echo "錯誤的訊息 : {$arrayUpFileInfo['ErrMsg']}" ;	}
	*/
	if( $_FILES[$subUpFieldName]['error'] == 0 )
	{	// 上傳成功
		$extension = strtolower(pathinfo($_FILES[$subUpFieldName]['name'] , PATHINFO_EXTENSION));		//取得檔案副檔名
		//echo "<p>檔案副檔名 : $extension</p>" ;
		
		if( in_array( strtolower($extension) , array( 'jpg' , 'jpeg' , 'png' , 'gif' ) ) )
		{//檢查檔案副檔名
			//move_uploaded_file($_FILES[$subUpFieldName]['tmp_name'] , './' . $_FILES[$subUpFieldName]['name'] );	//複製檔案
			//echo '<a href="./'.$_FILES[$subUpFieldName]['name'].'">./'.$_FILES[$subUpFieldName]['name'].'</a>';	//顯示檔案路徑
			// 上傳檔案到imgur
			$filename = $_FILES[$subUpFieldName]['tmp_name'];	// 上傳圖檔
			$client_id = f547c03532e7add;		// ID
			$handle = fopen($filename, "r");
			$data = fread($handle, filesize($filename));
			$pvars = array('image' => base64_encode($data));
			
			//echo $pvars ;
			
			$timeout = 30;
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
			curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
			$out = curl_exec($curl);
			curl_close ($curl);
			
			//echo "$out" ;
			
			$pms = json_decode($out,true);
			//print_r($pms);
			
			$arrayUpFileInfo['State'] = "OK";
			$arrayUpFileInfo['URL'] = $pms['data']['link'];
			return $arrayUpFileInfo ;
			//echo "<p>圖片URL : $PushLog_Pict</p>" ;
			
			// 加入資料庫欄位
			//$tmpSQL .= " PushLog_Pict = '" . $url . "' , " ;
			
			// 刪除上傳檔案-會自動刪除
			//unlink($file_delete);
		}
		else
		{
			$arrayUpFileInfo['State'] = "ERR";
			$arrayUpFileInfo['ErrMsg'] = "不允許該檔案格式";
			return $arrayUpFileInfo ;
		}
	}
	else
	{
		$arrayUpFileInfo['State'] = "ERR";
		$arrayUpFileInfo['ErrMsg'] = $_FILES[$subUpFieldName]['error'];
		return $arrayUpFileInfo ;
	}
}
//~@_@~// END 上傳檔案到Imgur ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 刪除一個路徑下的所有資料夾和檔案 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_Del_Path_File ( $subPath , $subDel_Path = 0 )
{
	/*
	範例 $Bol = func_Del_Path_File( "/home/" );
	功能			: 刪除一個路徑下的所有資料夾和檔案
	修改日期		: 20190116
	參數說明		:
		$subPath		: 要刪除的目錄
		$subDel_Path	: 把本目錄也刪除(1 : 刪除 , 0 : 保留)
	回傳參數

	實際範例:
		$Bol = func_Del_Path_File( "home/" );
	*/
	//echo "開始刪除目錄 : $subPath<br>" ;
	if( $subPath == "/" )
	{	return "" ;	}

	//如果是目錄則繼續
	if(is_dir($subPath))
	{
		//echo "目錄存在<br>" ;
		//掃描一個資料夾內的所有資料夾和檔案並返回陣列
		$p = scandir($subPath);
		//echo "<p></p>" ;print_r($p);echo "<br>" ;
		foreach($p as $val)
		{
			//echo "目錄 $val<br>" ;
			//排除目錄中的.和..
			if($val !="." && $val !="..")
			{
				//echo "----$val<br>" ;
				//如果是目錄則遞迴子目錄，繼續操作
				if(is_dir($subPath.$val))
				{
					//子目錄中操作刪除資料夾和檔案
					deldir($subPath.$val.'/');
					//目錄清空後刪除空資料夾
					@rmdir($subPath.$val.'/');
				}
				else
				{
					//如果是檔案直接刪除
					unlink($subPath.$val);
				}
			}
		}
		// 是否刪除本目錄
		if( $subDel_Path )
		{	@rmdir($subPath);	}
		return 1;
	}
	else
	{
		return "目錄不存在 $subPath<br>" ;
	}
}
//~@_@~// END 刪除一個路徑下的所有資料夾和檔案 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 購物車相關
//~@_@~// START 清除購物車 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function ClearCart ()
{
	/*
	範例 ClearCart();
	功能			: 清除購物車
	*/
	$_SESSION['pidAry'] = "";
	unset($_SESSION['pidAry']);

	$_SESSION['jsonAry'] = "";
	unset($_SESSION['jsonAry']);

	$_SESSION['Point'] = "";
	unset($_SESSION['Point']);
}
//~@_@~// END 清除購物車 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 計算購物車的商品數量 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getCartCount( $subType = 1 )
{
	/*
	範例			: $tmpCarCount = func_getCartCount( $subType ) ;		// 計算購物車的商品數量
	功能			: 計算購物車的商品數量
	修改日期		: 20200323
	參數說明 :
		$subType	: 計算總類(1 : 購物車商品類別數量(內定) , 2 : 購物車商品總數量)
	回傳參數 :
		$tmpCarCount	計算後的數量
	使用範例 :		:
		$tmpCarCount = func_getCartCount( 1 ) ;		// 計算購物車的商品數量
	*/

	$jsonAry = $_SESSION['jsonAry'];
	$tmpCount = 0 ;
	if( $subType == 1 )
	{// 購物車商品類別數量
		$tmpCount = sizeof($jsonAry);
	}
	else
	{//  購物車商品總數量
		foreach( $jsonAry as $key => $value )
		{// p_qty
			$tmpCount += $value['p_qty'] ;
		}
	}
	
	return $tmpCount ;
}
//~@_@~// END 計算購物車的商吅數量 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 產生綠界金流檢查碼 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getECPay_CheckMacValue( $subPara )
{
	/*
	範例			: $tmpCheckMacValue = func_getECPay_CheckMacValue( $subPara ) ;		// 產生綠界金流檢查碼
	功能			: 產生綠界金流檢查碼
	修改日期		: 20190514
	參數說明		:
	$subPara		: 金流公司傳入POST參數
	使用範例		:
	require_once 'ECPay.Payment.Integration.php';

	$CheckMacValue = func_getECPay_CheckMacValue( $_POST ) ;		// 產生綠界金流檢查碼
	*/
	$CheckMacValue = ECPay_CheckMacValue::generate( $subPara, ECPay_HashKey, ECPay_HashIV );
	return $CheckMacValue ;
}
//~@_@~// END 產生綠界金流檢查碼 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 紅包相關
//~@_@~// START 產生紅包每包可以抽值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getRedEnvelopeValue( $subRedEnvelope_Point , $subRedEnvelope_Num , $subSortModel = 1 , $subMinValue = 1 )
{
	/*
	範例			: $arrayRedEnvelopePayPoint = func_getRedEnvelopeValue( $subRedEnvelope_Point , $subRedEnvelope_Num , $subSortModel ) ;		// 產生紅包每包可以抽值
	功能			: 產生紅包每包可以抽值
	修改日期		: 20190423
	參數說明		:
	$subRedEnvelope_Point	: 要發出的金額
	$subRedEnvelope_Num		: 要分出的紅包數量
	$subSortModel	: 排列模式(0.不排列 , 1:亂數排列(內定) , 2.亂數排列加第一個為最大值 , 3.由大到小排列 , 4.由小到大排列 , 5.由平均值上下調 )
	$subMinValue	: 亂數的最小值(內定為1),如果為"5:由平均值上下調",本值為上下變動範圍
	使用範例		:
	$arrayRedEnvelopePayPoint = func_getRedEnvelopeValue( 500 , 30 , 1 , 2 ) ;		// 產生紅包每包可以抽值

	// 由平均值上下調
	$arrayRedEnvelopePayPoint = func_getRedEnvelopeValue( 500 , 30 , 5 , 2 ) ;		// 產生紅包每包可以抽值
	*/
	
	$tmpShowMsg = 0 ;		// 是否要在網頁秀出除錯資料(1:秀出,0:不秀)

	// 產生值的方法
	if( $subSortModel == 5 )	// 由平均值上下調
	{
		// 如果金額和人數無法整除則最後一個要全部給

		// 求出平均值
		$tmpAverage = (int)( $subRedEnvelope_Point / $subRedEnvelope_Num );
		// 上下調幅的值為平均值的一半
		$tmpShift = (int)($tmpAverage / 2) ;
		if ( $tmpShowMsg ){echo "<p>基本平均值 : $tmpAverage , 上下調幅值 : $tmpShift<p>" ;}

		// 算出每包紅包的值
		for ($i = 1 ; $i < $subRedEnvelope_Num ; $i = $i + 2)
		{
			// 取得亂數
			srand((double)microtime()*1000000) ;
			$INPUT_CHECK_KEY = rand($subMinValue , $tmpShift) ;
			if ( $tmpShowMsg ){echo "<p>index : $i , 亂數值 : $INPUT_CHECK_KEY</p>" ;}
			
			$arrayRedEnvelopePayPoint[] = $tmpAverage + $INPUT_CHECK_KEY ;
			$tmpSum = $tmpSum + $tmpAverage + $INPUT_CHECK_KEY ;

			if( $i + 1 <= $subRedEnvelope_Num )
			{
				$arrayRedEnvelopePayPoint[] = $tmpAverage - $INPUT_CHECK_KEY ;
				$tmpSum = $tmpSum + $tmpAverage - $INPUT_CHECK_KEY ;
			}
		}
		// 陣列大小不等於要分出的紅包數量則把剩下值加到最後一個
		if( sizeof($arrayRedEnvelopePayPoint) != $subRedEnvelope_Num )
		{
			$arrayRedEnvelopePayPoint[] = $subRedEnvelope_Point - $tmpSum ;
			if ( $tmpShowMsg ){echo "<p>剩下金額 : {$arrayRedEnvelopePayPoint[sizeof($arrayRedEnvelopePayPoint)-1]}</p>" ;}
			$tmpSum += $arrayRedEnvelopePayPoint[sizeof($arrayRedEnvelopePayPoint)-1] ; 
			$subSortModel = 2 ;
		}
		// 設定發出M幣列表
		if ( $tmpShowMsg ){echo "<p>購物金總合 : $tmpSum</p>" ;}
		// 是否還有沒有發完的點數,把剩下的點數加到最小的值中
		if( $tmpSum < $subRedEnvelope_Point )
		{
			// 由小到大排列
			asort($arrayRedEnvelopePayPoint);
			// 求出第一欄的index值
			foreach( $arrayRedEnvelopePayPoint as $key => $value )
			{
				$tmpIndex= $key ;
				break;
			}

			$arrayRedEnvelopePayPoint[$tmpIndex] = $arrayRedEnvelopePayPoint[$tmpIndex] + $subRedEnvelope_Point - $tmpSum ;
			// 最小值加上剩下值
			if ( $tmpShowMsg ){echo "<p>最小值加剩下值 - 索引 : $tmpIndex : 加後值 : {$arrayRedEnvelopePayPoint[$tmpIndex]}</p>" ;}
			// 改成第2模式-亂數排列加第一個為最大值
			$subSortModel = 2 ;
			// 亂數排列
			//shuffle($arrayRedEnvelopePayPoint);
		}
		// 求出總合
		foreach( $arrayRedEnvelopePayPoint as $key => $value )
		{	$tmpToal += $value ;	}

		if ( $tmpShowMsg ){echo "<p>最後購物金總合 : $tmpToal</p>" ;print_r($arrayRedEnvelopePayPoint);echo "<br>" ;}
	}
	else
	{
		// 算出每包紅包的值
		for ($i = 1 ; $i < $subRedEnvelope_Num ; $i++)
		{
			// 亂數大小
			$tmp_NewNum = floor( $subRedEnvelope_Point / 7) ;
			// 取得亂數
			srand((double)microtime()*1000000) ;
			$INPUT_CHECK_KEY = rand($subMinValue , $tmp_NewNum) ;
			$arrayBouns[] = $INPUT_CHECK_KEY;
			
			// 是否發完紅包,包含未發的也要算
			if( ($subRedEnvelope_Point - $INPUT_CHECK_KEY - ($subRedEnvelope_Num - $i) ) < 0 )
			{	$INPUT_CHECK_KEY = 1 ;	}
			// 設定發出M幣列表
			$arrayRedEnvelopePayPoint[] = $INPUT_CHECK_KEY ;
			
			//echo "$i - 剩下紅包 : $subRedEnvelope_Point - 取半值 : $tmp_NewNum - 發出紅包值 : $INPUT_CHECK_KEY<br>" ;
			$subRedEnvelope_Point = $subRedEnvelope_Point - $INPUT_CHECK_KEY ;
		}
		//echo "$subRedEnvelope_Num - 發出紅包值 : $subRedEnvelope_Point<br>" ;
		// 設定發出M幣列表
		$arrayRedEnvelopePayPoint[] = $subRedEnvelope_Point ;
	}
	

	if( $subSortModel == 1 OR $subSortModel == 2 )	// 亂數排列
	{	shuffle($arrayRedEnvelopePayPoint);	}

	if( $subSortModel == 2 AND sizeof($arrayRedEnvelopePayPoint) > 2 )	// 第一值為最大值,且陣列大於2
	{
		$tmpMaxIndex = 0 ;	// 最大值的index
		$tmpMaxValue = 0 ;	// 最大值
		foreach( $arrayRedEnvelopePayPoint as $key => $value )
		{
			if ( $value > $tmpMaxValue )	// 是否為最大值
			{
				$tmpMaxIndex = $key ;	// 最大值的index
				$tmpMaxValue = $value ;	// 最大值
			}
		}
		// 把最大值移到第一位
		if ( $tmpMaxIndex != 0 )
		{
			// 暫存0的值
			$tmpIndex0 = $arrayRedEnvelopePayPoint[0] ;
			$arrayRedEnvelopePayPoint[0] = $arrayRedEnvelopePayPoint[$tmpMaxIndex] ;
			$arrayRedEnvelopePayPoint[$tmpMaxIndex] = $tmpIndex0 ;
		}
	}

	if( $subSortModel == 3 )	// 由大到小排列
	{	arsort($arrayRedEnvelopePayPoint);	}

	if( $subSortModel == 4 )	// 由小到大排列
	{	asort($arrayRedEnvelopePayPoint);	}

	return $arrayRedEnvelopePayPoint ;
}
//~@_@~// END 產生紅包每包可以抽值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 網路相關
//~@_@~// START 送出CURL資料(POST) ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_sentCURL_Post( $subURL , $subSentJson )
{
	global $link ;
	// 範例 			: $json = func_sentCURL_Post( $subURL , $subSentJson ) ;		// 送出CURL資料(POST)
	// $$subURL			: API網址
	// $subSentJson		: 要傳送的資料

	$ch = curl_init($subURL);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,  $subSentJson );
	//	curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
	//	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	//		'Content-Type: application/json',
	//		'Authorization: Bearer '.$Conn_access_token
	//	));
	
	$result = curl_exec($ch);
	curl_close($ch);
	
	//	echo "<br>" ;
	return "$result" ;
}
//~@_@~// END 送出CURL資料(POST) ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 送出GET資料(GET) ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_sentCURL_Get( $subURL , $subSentJson )
{
	// http://www.runoob.com/php/php-ref-curl.html
	
	global $link ;
	// 範例 			: $json = func_sentCURL_Get( $subURL , $subSentJson ) ;		// 送出CURL資料(POST)
	// $$subURL			: API網址
	// $subSentJson		: 要傳送的資料

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $subURL);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($url,CURLOPT_HTTPHEADER,$headerArray);
	$output = curl_exec($ch);
	curl_close($ch);
	$output = json_decode($output,true);
	return $output;
}
//~@_@~// END 送出CURL資料(GET) ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 文字編碼
/*
編碼(加密方法)方法:
1 : 外加安全位移值,在轉成ASCII後執行(必選)
2 : 原始字串反轉-以字串(abc->cba)為單位進行反轉(2和3選一種執行),在還沒有執行轉ASCII前執行
3 : ASCII字串反轉-把整個轉成ASCII的字串反轉,不包含控制碼,在轉ASCII後執行

第1數字(位移值)和最後數字(編碼方式)為控制碼
	為設定方式:
	第一組數字(位移碼)-(510),共三碼-表示位移值為10
		第1個數字為亂碼,由系統自動產生,可以不用管
		後2個數字為"位移值"(5-15),在文字轉成ASCII值後,每個數字都要自動加上的數字,解碼時要扣回
	最後一組數字(編碼方式)-(724),共三碼
		數字為亂碼,由系統自動產生
		如果為"編碼方式"第1個數字為奇數則使用"原始字串反轉" - 找出7 -> 要反轉
		如果為"編碼方式"第2個數字為奇數則使用"ASCII字串反轉" - 找出2 -> 不要反轉
範例
$str = 'Wel大字元轉ASCII碼';

// 內容進行編碼
$tmpEncoder = func_Encoder_Str2Ascii($str);		// 編碼-文字轉成ASCII數字
echo "<p>編碼 : 文字轉ASCII碼</p>" ;print_r($tmpEncoder);echo "<br>" ;

// 資料進行解碼
$tmpDecoder = func_Decoder_Ascii2Str( $tmpEncoder );	// 解碼-ASCII數字轉成字串
echo "<p>解碼 : ASCII碼轉文字 : <br>$tmpDecoder</p>" ;
*/
//~@_@~// START 取得編碼規則 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function funct_getControlCode()
{
	/*
	功能 :
		取得編碼規則,要進行文字編碼前先取得設定資料
	參數說明 :
		無
	範例 :
		$arrayControlCode =  funct_getControlCode();

	*/
	// 控制碼-第一組數字
	// 產生控制碼-第一組數字(二次亂數)
	srand((double)microtime()*1000000) ;
	$tmpFirstCode1 = rand(0,9) ;
	$tmpFirstCode2 = rand(5,15) ;
	$tmpFirstCode2 = sprintf("%02s" , $tmpFirstCode2);
	$arrayControlCode['FirstCode'] = $tmpFirstCode1 . $tmpFirstCode2;
	//echo "<p>產生控制碼-第一組數字(位移值) : {$arrayCode['FirstCode']}</p>" ;
	
	// 產生控制碼-最後一組數字(二次亂數)
	$arrayControlCode['LastCode'] = $tmpFirstCode2 = rand(100,999) ;
	//echo "<p>產生控制碼-最後一組數字(編碼方式) : {$arrayCode['LastCode']}</p>" ;
	return $arrayControlCode ;
}
//~@_@~// END 取得編碼規則 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 反轉陣列 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_ReverseArray( $arrayStr )
{
	/*
	功能 :
		把輸入的陣列進行反轉
	參數說明 :
		$arrayStr	要反轉的陣列
	範例 :
		$ReverseArray =  func_ReverseArray($str, $encoding = 'utf-8');
	*/
	//echo "<p>原始文字陣列</p>" ;print_r($arrayStr);echo "<br>" ;
	
	$ReverseArray = array_reverse($arrayStr);
	//echo "<p>反轉後文字陣列</p>" ;print_r($reverseStr);echo "<br>" ;
	return $ReverseArray ;
}
//~@_@~// END 反轉陣列 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 反轉字串 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_ReverseStr( $subStr , $encoding = 'utf-8' )
{
	/*
	功能 :
		把輸入的字串進行反轉
	參數說明 :
		$subStr		反轉的字串
		$encoding	字串編碼(utf-8)
	範例 :
		$arrayReverseStr = func_ReverseStr($str, $encoding = 'utf-8');
	*/
	$len = mb_strlen($subStr);
	$arrayReverseStr = '';
	for ($i = $len - 1 ; $i>=0 ; $i--)
	{	$arrayReverseStr .= mb_substr( $subStr , $i , 1 , $encoding);	}
	return $arrayReverseStr;
}
//~@_@~// END 反轉字串 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 編碼-文字轉成ASCII數字 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_Encoder_Str2Ascii( $subStr )
{
	/*
	功能 :
		把輸入的字串轉成ASCII數字
	參數說明 :
		$subStr			要進行轉換的文字
	範例 :
		$tmpEncoder = func_Encoder_Str2Ascii( $subStr );	// 編碼-文字轉成ASCII數字
	*/
	// 取得編碼規則
	$arrayControlCode = funct_getControlCode();
	//echo "<p>取得編碼規則</p>" ;print_r($arrayControlCode);echo "<br>" ;
	
	// 編碼規則中取得位移值
	$subShiftNum = mb_substr( $arrayControlCode["FirstCode"]  , -2 , 2 , "utf-8");
	//echo "<p>位移值 : $subShiftNum</p>";

	// 設定開始字串加入"位移值"
	//$tmpASCIIStartNum = $arrayControlCode["FirstCode"] . " ";
	
	// 如果為"編碼方式"第1個數字為奇數則使用"原始字串反轉"
	if( mb_substr( $arrayControlCode["LastCode"]  , 0 , 1 , "utf-8") % 2 )
	{
		echo "<p>func_Encoder_Str2Ascii() - 原始字串反轉</p>";
		$subStr = func_ReverseStr($subStr, $encoding = 'utf-8');
	}
	
	$tmpIndex = 0;	// 文字索引值
	//$tmpNum = "";
	$subStr = urlencode($subStr);	// 把中文轉成網頁編碼
	//echo "<p>把中文轉成網頁編碼 : $subStr</p>";
	
	// 把文字轉成ASCII並加上位移值
	while (isset($subStr[$tmpIndex]))
	{
		// 把文字轉成數字且後方加上空白
        $tmpEncoder .= ord($subStr[$tmpIndex]) + $subShiftNum . " ";
        $tmpIndex++ ;
    }
	//echo "<p>還沒有加控制碼的字串 : $tmpEncoder</p>";
	//$tmpLeng = strlen($tmpEncoder) ;
	//echo "<p>還沒有加控制碼的字串長度 : $tmpLeng</p>";
	
	//$tmpFirst = mb_substr( $tmpEncoder  , 0 , 1 , "utf-8");
	//echo "<p>第一個字 : $tmpFirst</p>";
	//$tmpLast = mb_substr( $tmpEncoder  , -1 , 1 , "utf-8");
	//echo "<p>最後一個字 : $tmpLast</p>";

	// 把"編碼規則"和轉成ASCII的資料整合在一起
	$tmpEncoder = $arrayControlCode["FirstCode"] . " " . $tmpEncoder . $arrayControlCode["LastCode"] . " " ;
	
	//echo "<p>編碼 : 文字轉ASCII碼</p>" ;print_r($tmpEncoder);echo "<br>" ;
	
	// 如果為"編碼方式"第2個數字為奇數則使用"ASCII字串反轉"
	if( mb_substr( $arrayControlCode["LastCode"]  , 1 , 1 , "utf-8") % 2 )
	{
		//echo "<p>func_Encoder_Str2Ascii() - ASCII字串反轉</p>";
		$tmpEncoder = func_ReverseStr($tmpEncoder, $encoding = 'utf-8');
	}
	// 回傳編碼後的字串
    return $tmpEncoder;
}
//~@_@~// END 編碼-文字轉成ASCII數字 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 解碼-ASCII數字轉成字串 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_Decoder_Ascii2Str( $subNum )
{
	/*
	功能 :
		把輸入的ASCII數字轉成字串
	參數說明 :
		$subNum		要進行解碼的數字字串
	範例 :
		$tmpDecoder = func_Decoder_Ascii2Str( $subNum );	// 解碼-ASCII數字轉成文字
	*/
	
	//echo "<p>傳入字串 : $subNum</p>";
	// 如果第一個字為空白,表示有執行"ASCII字串反轉"的功能
	if( mb_substr( $subNum  , 0 , 1 , "utf-8") == " " )
	{
		//echo "<p>func_Decoder_Ascii2Str() - ASCII字串反轉</p>";
		$subNum = func_ReverseStr($subNum, $encoding = 'utf-8');
	}

	// 取出位移值
	$subShiftNum = mb_substr( $subNum  , 1 , 2 , "utf-8");
	//echo "<p>位移值 : $subShiftNum</p>";

	// 取出"編碼方式"-後3個字,從最後第4個起
	$tmpLastCode = mb_substr( $subNum  , -4 , 3 , "utf-8");
	//echo "<p>編碼方式 : $tmpLastCode</p>";

	//$tmpLeng = strlen($subNum) ;
	//echo "<p>有控制碼的字串長度 : $tmpLeng</p>";

	// 取出ASCII字串-從第5個到到倒數第5個字
	$tmpRealNum = mb_substr( $subNum  , 4 , -4 , "utf-8");

	//echo "<p>沒有控制碼的字串 : $tmpRealNum</p>";
	//$tmpRealLeng = strlen($tmpRealNum) ;
	//echo "<p>沒有控制碼的字串長度 : $tmpRealLeng</p>";

	// ASCII文字轉陣列
    $arrayNum = explode(" ", $tmpRealNum);
	
	// 把ASCII轉回文字
    $string = "";
    foreach ($arrayNum as $value)
	{
		// 有值則把數字扣掉位移值再轉回文字
		if( $value )
        {	$string .= chr($value - $subShiftNum);	}
    }

	//echo "<p>把中文轉成網頁編碼 : $string</p>";
	// 轉成中文
	$string = urldecode($string);

	//$tmpStrLeng = strlen($string) ;
	//echo "<p>轉回字串長度 : $tmpStrLeng</p>";

	// 文字是否有反轉
	if( mb_substr( $tmpLastCode  , 0 , 1 , "utf-8") % 2 )
	{
		echo "<p>func_Decoder_Ascii2Str() - 原始字串反轉</p>";
		$string = func_ReverseStr($string, $encoding = 'utf-8');
	}
	
    return $string;
}
//~@_@~// END 解碼-ASCII數字轉成字串 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// ID編碼
/*
◇編碼組成
	1.設定碼(4碼)
	。第一個數字表示"放置前後值" -> (id+無效字串)是放在前面或後面
		單數 : 無效字串 -> 放前面 , 物件亂數 -> 放後面(範例1)
		複數 : 無效字串 -> 放後面 , 物件亂數 -> 放前面(範例2)
	。第二個數字表示"無效字串"的長度(1-4) : abcd
	。第三個數字表示"物件亂數"的長度(2-6) : 123456
	。第四個數字表示id的長度-2

	範例(ID : 15)
	3462 . abcd . 15 . 123456
	6462 . 123456 . 15 . abcd
	
	作法:
	1.產生亂數或長度值
		.放置前後值 -> 0-9 : 3
		.無效字串長度 -> 1-4 : 4
		.物件亂數的長度 -> 2-6 : 6
	2.求出業務員ID(15)
	3.依產生的"無效字串"和"物件亂數"來取出相對應的亂數值
		.無效字串 : abcd
		.物件亂數 : 123456
	4.產生"設定碼" -> 放置前後值 . 無效字串長度 . 物件亂數長度 . 業務員id長度
	5.依"放置前後值"的值來決定"無效字串"和"物件亂數"是要放在"業務員id"的前面或後面
	6.把所有值組合起來
	
	取出ID值
	1.先判斷"單數"或"複數"
	2.用mb_substr直接取出ID值

// 使用方法:	
$ID = 19 ;

// 編碼-Encoder
$tmpEncoder = func_Encoder_ID( $ID );	// 把輸入的ID進行亂數編碼
$tmpDecoder = func_Decoder_ID( $tmpEncoder );	// 把編碼過的字串進行ID解碼
echo "<p>ID : $ID , 編碼後文字 : $tmpEncoder , 取出ID : $tmpDecoder</p>";
	
*/
//~@_@~// START 把輸入的ID進行亂數編碼 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_Encoder_ID( $subID )
{
	/*
	功能 :
		把輸入的ID進行亂數編碼
	參數說明 :
		$subID		要進行解碼的數字字串
	範例 :
		$tmpEncoder = func_Encoder_ID( $subID );	// 把輸入的ID進行亂數編碼
	*/
	
	$tmp_ID_Length = strlen($subID);
	//echo "<p>ID : $subID , ID長度 : $tmp_ID_Length</p>" ;
	
	$tmp_Place = mt_rand(0 , 9) ;	// 放置前後值(單數-放前面,複數:放後面)
	$tmp_Invalid_Word_Length = mt_rand(1 , 4) ;	// 無效字串長度
	$tmp_Object_Rand_Length = mt_rand(2 , 6) ;	// 物件亂數長度
	
	$tmp_Invalid_Word = CreatRandomNum( "Member" , "Member_ID" , "N,E,e" , "" , $tmp_Invalid_Word_Length ) ;// 無效字串
	$tmp_Object_Rand = CreatRandomNum( "Member" , "Member_ID" , "N,E,e" , "" , $tmp_Object_Rand_Length ) ;	// 物件亂數
	
	//echo "<p>放置前後值 : $tmp_Place , 無效字串長度 : $tmp_Invalid_Word_Length , 物件亂數長度 : $tmp_Object_Rand_Length</p>" ;
	//echo "<p>無效字串 : $tmp_Invalid_Word</p>" ;
	//echo "<p>物件亂數 : $tmp_Object_Rand</p>" ;
	
	// 組合文字
	// 設定碼(3碼)
	$tmp_Set_Code = $tmp_Place . $tmp_Invalid_Word_Length . $tmp_Object_Rand_Length . $tmp_ID_Length ;
	//echo "<p>設定碼(4碼) :　$tmp_Set_Code</p>" ;
	
	//ID Code (id+無效字串)
	if( $tmp_Place % 2 )
	{// 單數 : 無效字串 -> 放前面 , 物件亂數 -> 放後面
		$tmpEncoder = $tmp_Set_Code . $tmp_Invalid_Word . $subID . $tmp_Object_Rand ;
	}
	else
	{// 複數 : 無效字串 -> 放後面 , 物件亂數 -> 放前面
		$tmpEncoder = $tmp_Set_Code . $tmp_Object_Rand . $subID . $tmp_Invalid_Word ;
	}
	//echo "<p>編碼後文字 : $tmpEncoder<p>" ;
    return $tmpEncoder;
}
//~@_@~// END 把輸入的ID進行亂數編碼 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 編碼過的字串進行ID解碼 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_Decoder_ID( $subID_Value )
{
	/*
	功能 :
		把編碼過的字串進行ID解碼
	參數說明 :
		$subID_Value		要進行解碼的數字字串
	範例 :
		$tmpDecoder = func_Decoder_ID( $subID_Value );	// 把編碼過的字串進行ID解碼
	*/
	$tmp_Place = mb_substr($subID_Value , 0 , 1 , "utf-8");
	if( $tmp_Place % 2 )
	{// 單數 : 
		$tmp_Start_Index = 4 + mb_substr($subID_Value , 1 , 1 , "utf-8") ;
	}
	else
	{// 複數 : 
		$tmp_Start_Index = 4 + mb_substr($subID_Value , 2 , 1 , "utf-8") ;
	}
	
	// 取出ID值
	$tmpDecoder = mb_substr($subID_Value , $tmp_Start_Index , mb_substr($subID_Value , 3 , 1 , "utf-8") , "utf-8");
	//echo "取出ID值 : $tmpDecoder" ;
    return $tmpDecoder;
}
//~@_@~// END 編碼過的字串進行ID解碼 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 線上人數系統
/*
模組所在地 : D:\工作資料\0-專案開發過程\模組開發\線上人數系統
$SQL_DATABASE[0]="模組開發" ;
$SQL_MEANING[0]="線上人數系統" ;
$SQL_STRING[0]="CREATE TABLE OnLine (
id_OnLine INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
OnLine_Set_ID			CHAR(16)		NOT NULL COMMENT '設定者ID' ,	 	#::CHAR::
OnLine_IP				VARCHAR(15)		NOT NULL COMMENT '登入IP' ,		 	#::CHAR::
OnLine_Bet_DT			DATETIME		NOT NULL COMMENT '下注時間'	,		#::DATETIME::
OnLine_DT				DATETIME		NOT NULL COMMENT '有效時間'			#::DATETIME::
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; ";

*/
//~@_@~// START 記錄在線資訊 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_setOnLineInfo( $subID , $subSetIP = 1 , $subDTField = "" )
{
	global $link;
	/*
	範例			: $Bol = func_setOnLineInfo( $subID , $subIP , $subField ) ;		// 記錄在線資訊
	功能			: 記錄在線資訊
	修改日期		: 200811
	參數說明 :
		$subID			操作ID
		$subSetIP		是否寫入登入IP(1:寫入,0:不寫入)
		$subDTField		另外要寫入時間的欄位,以,分隔(額外要寫入時間的欄位:OnLine_Bet_DT)
	回傳參數 :
		$Bol			是否成功
	使用範例 :		:
		$Bol = func_setOnLineInfo( "Member202008010001" , 1  , "" ) ;		// 記錄會員在線資訊
		$Bol = func_setOnLineInfo( "Store202008010001" , 1  , "" ) ;		// 記錄店家在線資訊
		$Bol = func_setOnLineInfo( "Agent202008010001" , 1  , "" ) ;		// 記錄代理人在線資訊
		$Bol = func_setOnLineInfo( "Member202008010001" , 1  , "OnLine_Bet_DT" ) ;	// 記錄會員在線資訊和下注時間
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	
	if( empty($subID))
	{	return 0;	}
	
	if( $subSetIP )
	{	$tmp_IP = $_SERVER['REMOTE_ADDR'] ;	}
	else
	{	$tmp_IP = "" ;	}
	
	// 另外要寫入時間的欄位
	if( $subDTField )
	{
		$array_DTField = str2array($subDTField , ",");
		foreach( $array_DTField as $key => $value )
		{	$arrayField[$value] = date("Y-m-d H:i:s") ;	}
	}
	
	// 是否已有此ID
	$Count = func_DatabaseGet( "SELECT * FROM OnLine WHERE OnLine_Set_ID = '$subID'" , "COUNT" , "" ) ;		// 取得資料庫資料
	if( $Count )
	{
		$arrayField['OnLine_IP'] = $tmp_IP ;						// 登入IP
		$arrayField['OnLine_DT'] = date("Y-m-d H:i:s") ;			// 有效時間
		$Bol = func_DatabaseBase( "OnLine" , "MOD" , $arrayField , " OnLine_Set_ID = '$subID'" ) ;						// 資料庫處理
	}
	else
	{
		$arrayField['OnLine_Set_ID'] = $subID ;					// 設定者ID
		$arrayField['OnLine_IP'] = $tmp_IP ;					// 登入IP
		$arrayField['OnLine_DT'] = date("Y-m-d H:i:s") ;		// 有效時間
		$Bol = func_DatabaseBase( "OnLine" , "ADD" , $arrayField , "" ) ;						// 資料庫處理
	}
	return 1;
}
//~@_@~// END 記錄在線資訊 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得在線人數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_getOnLineCount( $subIDKey , $subMin = 20 )
{
	global $link;
	/*
	範例			: $tmp_OnLineCount = func_getOnLineCount( $subIDKey , $subMin ) ;		// 取得在線人數
	功能			: 取得在線人數
	修改日期		: 200811
	參數說明 :
		$subIDKey	比對ID開頭
		$subMin		比對時間(內定20分鐘有效)
	回傳參數 :
		$OnLineCount	在線人數
	使用範例 :		:
		$tmp_OnLineCount = func_getOnLineCount( "Member" , 20 ) ;		// 取得會員在線人數
		$tmp_OnLineCount = func_getOnLineCount( "Store" , 20 ) ;		// 取得店家在線人數
		$tmp_OnLineCount = func_getOnLineCount( "Agent" , 20 ) ;		// 取得代理人在線人數
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	// 找出有效時間
	$tmpTime = funct_ChangTime( date("Y-m-d H:i:s") , "PM" , $subMin ) ;		// 改變時間

	$tmpSQL_OnLineCount = "SELECT * FROM OnLine WHERE OnLine_Set_ID LIKE '%$subIDKey%' AND OnLine_DT >= '{$tmpTime}'" ;
	//echo $tmpSQL_OnLineCount;
	$Count_User = func_DatabaseGet( $tmpSQL_OnLineCount , "COUNT" , "" ) ;		// 取得資料庫資料
	return (int)$Count_User ;
}
//~@_@~// END 取得在線人數 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 查詢人員是否還在線上 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function func_checkOnLineState( $subID , $subMin = 20 , $subField = "OnLine_DT" )
{
	global $link;
	/*
	範例			: $tmp_OnLineState = func_checkOnLineState( $subID , $subMin ) ;		// 查詢人員是否還在線上
	功能			: 查詢人員是否還在線上
	修改日期		: 200814
	參數說明 :
		$subID		比對ID
		$subMin		比對時間(內定20分鐘有效)
		$subField	比對欄位(OnLine_DT:有效欄位 , OnLine_Bet_DT:下注時間)
	回傳參數 :
		$OnLineCount	在線人數
	使用範例 :		:
		$tmp_OnLineState = func_checkOnLineState( "Member2008010001" , 20 , "OnLine_DT" ) ;		// 取得會員是否在線
		$tmp_OnLineState = func_checkOnLineState( "Store2008010001" , 20 , "OnLine_DT" ) ;		// 取得店家是否在線
		$tmp_OnLineState = func_checkOnLineState( "Agent2008010001" , 20 , "OnLine_DT" ) ;		// 取得代理人是否在線
		$tmp_OnLineState = func_checkOnLineState( "Member2008010001" , 20 , "OnLine_Bet_DT" ) ;		// 取得代會員下注時間是否在線
	*/
	$tmpShowMsg = 0 ;

	//if ( $tmpShowMsg )	// 秀出除錯訊息 ██████████
	// 找出有效時間
	$tmpTime = funct_ChangTime( date("Y-m-d H:i:s") , "PM" , $subMin ) ;		// 改變時間

	$tmpSQL_OnLineCount = "SELECT * FROM OnLine WHERE OnLine_Set_ID = '$subID' AND OnLine_DT >= '{$tmpTime}'" ;
	//echo $tmpSQL_OnLineCount;
	$Count_User = func_DatabaseGet( $tmpSQL_OnLineCount , "COUNT" , "" ) ;		// 取得資料庫資料
	return (int)$Count_User ;
}
//~@_@~// END 查詢人員是否還在線上 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲


////~@_@~// START 判斷傳入的hash是否正確 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//function checkInputHash( $subJson )
//{
//	// 範例 $tmp_md5 = getInputHash( $json ) ;
//	// 作用 : 把JSON
//	// $subJson		接收的Json資料
//	/*
//	// 驗証Json資料是否正確方法 :
//	// 1.先把Json轉成array
//	$array_json = $this->merino->merino_json2array( $_GET['Json'] );
//	// 2.把轉成array的值傳入本函式去產生hash值,去和傳來的Hash值比對是否相同,同時也比對時間是否超過
//	// 驗証Hash是否OK
//	if ( getInputHash( $array_json ) == $array_json['hash'] )
//	{
//		$tmpDiff = getMinDiff( date("Y-m-d H:i:s") , $array_json['Time'] , "I" ) ;
//	//	echo $tmpDiff ;
//		// 時間是否超過
//		if( $tmpDiff > 5 )
//		{
//			echo "時間超過,為了安全,請重新載入原網頁,重設參數" ;
//			exit;
//		}
//	}
//	else
//	{
//		echo "Hash有誤" ;
//		exit;
//	}
//	*/
//
//	// 把JSON字串轉成陣列
//	$arrayJson = json2array( $subJson );
//	// 傳入的hash資料,用來比對用
//	$tmpInputHash = $arrayJson['hash'] ;
//	// 把hash去掉
//	unset($array_json['hash']);
//	
//	// 陣列排序
//	ksort($array_json);
//
//	// 陣列轉json
//	$array_hash = array2json( $array_json ) ;
//	// 產生hash
//	$tmp_md5 = md5($array_hash);
//	return $tmp_md5;
//}
////~@_@~// END 判斷傳入的hash是否正確 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
////~@_@~// START 由陣列產生含有hash的Json字串 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//function getOutputJson( $arrayJson )
//{
//	// 範例 $tmpJson = getOutputJson( $arrayJson ) ;
//	// 作用 : 把陣列轉成含有hash的Json字串
//	// $arrayJson		要產生Hash和轉成Json的陣列
//	/*
//	// 產生傳出去的Json方法 :
//	// 1.先建立一個要傳送的陣列資料
//	$subarray['key1'] = 'value1';
//	$subarray['key2'] = 'value2';
//	$subarray['Time'] = date("Y-m-d H:i:s");
//	// 2.再由本函式產生一個包含hash的Json字串
//	// 其中有加入一個自訂的安全參數(每個網站都要自行修改)comp=>wolong
//	$tmpJson = $this->merino->merino_getOutputJson( $subarray ) ;
//	// 3.把產生的Json傳出去即可,在a中的href要用''包起來,因為Json中有"
//	test.php?Json=$tmpJson
//	*/
//
//	// 複製產生hash 陣列
//	$tmpHashArray = $arrayJson ;
//
//	// 排序過的陣列(ksort)
//	ksort($tmpHashArray);
//	// 把排序過的陣列Json成字串
//	$tmp_json = array2json( $tmpHashArray ) ;
//	// 再把字串 md5 編碼,產生hash值
//	$tmp_md5 = md5($tmp_json);
//	// 原始陣列加入hash
//	$arrayJson['hash'] = $tmp_md5 ;
//
//	// 轉成要傳出的Json字串
//	$array_json = array2json( $arrayJson ) ;
//	return $array_json ;
//}
////~@_@~// END 由陣列產生含有hash的Json字串 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>
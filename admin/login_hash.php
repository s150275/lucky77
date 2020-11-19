<?php
/*
模組名稱 :
管理者自動登入系統

檢查傳入的參數是否正確
?Funct=Admin_Login&Login_Name=admin&Time=201804062330&hash=****

在getInputHash()和getOutputJson()中的comp值要能設參數,因為每一個站會不相同
$array_json['comp'] = "wostory" ;
改成

$subComp = "Admin_Login" ;
getInputHash( $array_json , $subComp )
getOutputJson( $subarray , $subComp )

// 是否有設安全碼
if ( $subComp == "" )
{	$subComp = "wostory" ;	}
$array_json['comp'] = $subComp ;

使用方法
1.載入程式
//include_once($MAIN_BASE_ADDRESS . "admin/login_hash.php") ;

更改方法:
上傳
admin/login_hash.php
admin/Member_Login.php
includes/bot.php

wolong
上傳
includes/bot.php
includes/func_wolong.php
admin/WosmartInfo.php

*/ 

// 是否要查參數是否正確(1:不用檢查,0:要檢查)
$yldu = 0 ;

// 讀取自動登入參數
$ARRAY_POST_GET_PARA_Login[] = "Funct||*||-||-||-" ;
$ARRAY_POST_GET_PARA_Login[] = "Login_Name||*||-||-||-" ;
$ARRAY_POST_GET_PARA_Login[] = "Time||*||-||-||-" ;
$ARRAY_POST_GET_PARA_Login[] = "hash||*||-||-||-" ;
sub_post_get($ARRAY_POST_GET_PARA_Login) ;

//echo "$Funct AND $Login_Name AND $Time AND $hash" ;
//exit;
//http://ww150001.linebot.net/admin/m_Login.php?Funct=Admin_Login&Login_Name=admin&Time=20200328190206&hash=db1d13cfcf0a205ae2a220bb92fcc3b8

// 判斷是否要自動Login,有傳入相關參數則表示要登入,把Member_ID改成Login_Name
if( $Funct AND $Login_Name AND $Time AND $hash )
{
	// 把傳入的資料設成陣列
	$arrayJson['Funct'] = $Funct ;				// 功能設定
	$arrayJson['Login_Name'] = $Login_Name ;		// 店員ID
	$arrayJson['Time'] = $Time ;				// 時間
	
	// 取得hash值
	$tmp_md5 = getInputHash( $arrayJson ) ;

	if ( $tmpShowMsg AND $Conn_isAdmin )	// 秀出除錯訊息 ██████████
	{
		echo __FILE__ ."<br>";
		echo "<p>傳入參數 : </p>" ;
		echo "<p>功能(Funct) : " . $arrayJson['Funct'] . "</p>" ;
		echo "<p>店員ID(Login_Name) : " . $arrayJson['Login_Name'] . "</p>" ;
		echo "<p>時間(Time) : " . $arrayJson['Time'] . "</p>" ;
		echo "<p>傳入hash值(hash) : " . $hash . "</p>" ;
		echo "<p>編輯後的hash值 : " . $tmp_md5 . "</p>" ;
		echo "<br>" ;
		echo "<p>Json內容:</p>" ;
		print_r($arrayJson);
		echo "<p>Session內容:</p>" ;
		print_r($_SESSION);
		echo "<br><br>" ;
	}
	
	$tmpURL = "http://" . $_SERVER['HTTP_HOST'] . "/Member/index.php?Funct=" . $arrayJson['Funct'] . "&Member_ID=" . $arrayJson['Member_ID'] . "&Time=" . $arrayJson['Time'] . "&hash=" . $tmp_md5 ;

	// 取得現在時間的秒數
	$tmp_Now = strtotime('now') ;
	// 取得輸入時間的秒數
	$tmp_Time = strtotime( getSplitDate($arrayJson['Time'] ,  "RE") ) ;
	// 求出相差分鐘
	$tmp_Diff = (int)((($tmp_Now - $tmp_Time)) / 60) ;

	//print_r($arrayJson);
	//echo "<br>" ;
	//echo "$tmp_md5 - $hash";
	//exit;
	
	// 如果宥輸入參數才要判斷
	// 參數輸入錯誤
	if( $bol_InputOK == 0 AND 0)
	{	$errMSG = "參數輸入錯誤" ;	}
	// 沒有輸入hash,$yldu為測試不要hash的功能
	elseif ( ( $tmp_md5 != $hash ) and !$yldu )
	{
		if ( $tmpShowMsg AND $Conn_isAdmin )	// 秀出除錯訊息 ██████████
		{	echo "hash比對<br>$hash<br>$tmp_md5<br>" ;	}
		
		$errMSG = "Hash輸入錯誤<br>" ;
		$arrayJson['Funct'] = $Funct ;				// 功能設定
		$arrayJson['Member_ID'] = $Member_ID ;	// 會員ID
		$arrayJson['Time'] =  getSplitDate( date("Y-m-d H:i:s") , "DS") ;			// 送出時間(必傳)
		//print_r($arrayJson);
		//echo "<br>" ;
		$tmp_md5 = getInputHash( $arrayJson ) ;
		//echo "$tmp_md5<br>";
		$tmpURL = "http://" . $_SERVER['HTTP_HOST'] . "/" . $arrayJson['Funct'] . "/index.php?Funct=" . $arrayJson['Funct'] . "&Member_ID=" . $arrayJson['Member_ID'] . "&Time=" . $arrayJson['Time'] . "&hash=" . $tmp_md5 ;
		//echo $tmpURL ."<br>";
	}
	// 時間格式不對
	elseif( !is_numeric($tmp_Time) and !$yldu )
	{	$errMSG = "時間參數輸入錯誤" ;	}
	// 時間超過時間
	elseif( !is_numeric($tmp_Time) or $tmp_Diff > 10 and !$yldu )
	{	$errMSG = "時間超過時限-$tmp_Time-$tmp_Diff" ;	}
	// Member_LineID長度不對
	//elseif( strlen($arrayJson['Member_ID']) != 16 )
	//{	$errMSG = "會員代碼輸入錯誤" ;	}
	// 查詢會員代碼 getMember_ID okgetMember_ID
	else if( $arrayJson['Funct'] != $MAIN_Funct )
	{	$errMSG = "功能選項輸入錯誤" ;	}
	else
	{	// 參數正確,加入會員SESSION
		// 查詢付款會員是否有此會員
		$SQL_SystemUser = "SELECT * FROM SystemUser WHERE SystemUser_Login_Name = '" . $arrayJson['Login_Name'] . "'" ;
		
		if ( $tmpShowMsg AND $Conn_isAdmin )	// 秀出除錯訊息 ██████████
		{	echo "<p>bot_check_hash.php 查詢是否有此會員 : $SQL_SystemUser</p>" ;	}
		
		$QUERY_SystemUser = mysqli_query($link , $SQL_SystemUser) ;
		
		// 是否有資料
		if ( mysqli_num_rows($QUERY_SystemUser) )
		{
			// 求出一筆資料
			$LIST_SystemUser = mysqli_fetch_assoc($QUERY_SystemUser) ;
			//$Member_ID = $arrayJson['Login_Name'] ;
	
			$tmpStore_Info = getStore_Info() ;	// 取得店家資訊
			$_SESSION['Store_Name'] = $tmpStore_Info['Store_Name'];
			$_SESSION['Website_Name'] = $tmpStore_Info['Store_Name'];
			$_SESSION['Store_Code'] = $tmpStore_Info['Store_Code'];

			$_SESSION['SystemUser_ID'] = $LIST_SystemUser['SystemUser_ID'];
			$_SESSION['SystemUser_Level'] = $LIST_SystemUser['SystemUser_Level'];
			//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;exit;
			
			alertgo("" , "index.php" , 1);	

//			// 是否有其它參數要一起編碼
//			if( $Funct == "MemberPay" )
//			{	// 點數增加
//				if ( $tmpShowMsg AND $Conn_isAdmin )	// 秀出除錯訊息 ██████████
//				{	echo "<p>設定付款會員ID : $Funct</p>" ;	}
//				// 取得付款會員ID
//				$_SESSION['Member_Pay_Member_ID'] = $Member_Pay_Member_ID ;
//			}
	
		}
		else
		{
			$_SESSION['Member_ID'] = "" ;
			$Member_ID = "" ;
			$errMSG = "沒有此會員" ;
		}
	}
}
else
{	// 沒有傳入值
}


if ( $tmpShowMsg AND $Conn_isAdmin )	// 秀出除錯訊息 ██████████
{
	echo "<p>錯誤訊息(errMSG) : $errMSG</p>" ;
	echo "<p>新SESSION內容</p>" ;
	print_r($_SESSION);
}

?>

<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "修改密碼" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "password.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "password" ;				// 主要程式名稱

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

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "Old_Password||*" ;
$ARRAY_POST_GET_PARA[] = "New_Password1||*" ;
$ARRAY_POST_GET_PARA[] = "New_Password2||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

// 載入首頁
include($MAIN_BASE_ADDRESS . "header.php") ;        // 載入首頁

if( $Funct == "ChangePW" )
{
	if( !($Old_Password OR $New_Password1 OR $New_Password2) )
	{
		$ErrMsg = "資料沒有輸入完整" ;
		//toastrMsg( $ErrMsg , "E" ) ;
	}
	else if( $New_Password1 != $New_Password2 )
	{
		$ErrMsg = "二個新密碼不相同,請重新輸入" ;
		//toastrMsg( $ErrMsg , "E" ) ;
	}
	else if( strlen($New_Password1) < 6 OR strlen($New_Password1) > 20 )
	{
		$ErrMsg = "新密碼長度要在6-20個字,請重新輸入" ;
		//toastrMsg( $ErrMsg , "E" ) ;
	}
	else
	{
		// 舊密碼是否相同
		$sql = "SELECT * FROM Member WHERE Member_Login_Name='{$_SESSION['Member_Login_Name']}' AND Member_Login_Passwd = '".crypt( $Old_Password , $_SESSION['Member_Login_Name'] )."'";
		//echo "$sql" ;
		//exit;
		$query = mysqli_query($link , $sql) ;
		if(mysqli_num_rows($query) > 0)
		{// 舊密碼相同
			$LIST = mysqli_fetch_assoc($query) ;
			// 設定新密碼
			$arrayField['Member_Login_Passwd'] = crypt( $New_Password1 , $_SESSION['Member_Login_Name'] ) ;
			$Bol = func_DatabaseBase( "Member" , "MOD" , $arrayField , " id_Member = '{$LIST['id_Member']}'" ) ;						// 資料庫處理
			
			//toastrMsg( "新密碼設定成功" , "S" ) ;
			if( $Bol )
			{	alertgo("新密碼設定成功","$MAIN_FILE_NAME");	}
		}
		else
		{// 舊密碼錯誤
			//alertgo("舊密碼錯誤","");
			$ErrMsg = "舊密碼錯誤,請重新輸入" ;
			//toastrMsg( "舊密碼錯誤,請重新輸入" , "E" ) ;
		}
		
	}
}

echo "<main>\n";
echo "	<div class=\"mainWrap\">\n";
echo "		<h4>修改密碼</h4>\n";
echo "		<div class=\"form\">\n";
echo "			<form action=\"$MAIN_FILE_NAME\" method='POST'>\n";
echo "			<input type=\"hidden\" name='Funct' value='ChangePW'>\n";
if( $ErrMsg )
{
	echo "			<div class=\"form-item\">\n";
	echo "				<p>$ErrMsg</p>\n";
	echo "			</div>\n";
}

echo "			<div class=\"form-item\">\n";
echo "				<input type=\"password\" name='Old_Password' placeholder=\"舊密碼\" value='$Old_Password' required>\n";
echo "			</div>\n";
echo "			<div class=\"form-item\">\n";
echo "				<input type=\"password\" name='New_Password1' placeholder=\"新密碼\" value='$New_Password1' required>\n";
echo "			</div>\n";
echo "			<div class=\"form-item\">\n";
echo "				<input type=\"password\" name='New_Password2' placeholder=\"確認新密碼\" value='$New_Password2' required>\n";
echo "			</div>\n";
echo "			<div class=\"form-item\">\n";
echo "				<p align=\"center\"><button>確認修改</button></p>\n";
echo "			</div>\n";
echo "			</form>\n";
echo "		</div>\n";
echo "	</div>\n";
echo "</main>\n";

// 載入版權
include($MAIN_BASE_ADDRESS . "footer.php") ;        // 載入版權
?>

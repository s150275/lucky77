<?php
// 是否已被別人後登入
$arrayModel["ID"] = $_SESSION['Member_ID'] ;					// 登入帳號ID
$arrayModel["ClearSession"] = "Member_ID" ;					// 需清空的SESSION值,用","來區別多個欄位
$arrayModel["AlertMsg"] = "此帳號已有人登入,你必須登出了" ;		// 需強制登出時秀出訊息
$arrayModel["AlertLink"] = "{$MAIN_BASE_ADDRESS}index.php?FUNCT=MemberLOGOUT" ;	// 需強制登出時前往Link
func_checkRepeatLogin( $arrayModel ) ;		// 查詢是否重複登入

$Bol = func_setOnLineInfo( $_SESSION['Member_ID'] , 1  , "" ) ;		// 記錄會員在線資訊

$array_Member_Info = GodNine_getMemberInfo( $_SESSION['Member_ID'] ) ;		// 取得會員資料

if ( $MAIN_INCLUDE_NAME == "zone" OR $MAIN_INCLUDE_NAME == "room" OR $MAIN_INCLUDE_NAME == "game" )
{
	if( $Conn_WebKey == "asia17888" )
	{// 大陸九仔生
		if( $Chips == 5 OR $Chips == 20 OR $Chips == 50 OR $Chips == 100 OR $Chips == 500 )
		{	$_SESSION['Chips'] = $Chips ;	}
		//else if( empty($_SESSION['Chips']) )
		else if( !($_SESSION['Chips'] == 5 OR $_SESSION['Chips'] == 20 OR $_SESSION['Chips'] == 50 OR $_SESSION['Chips'] == 100 OR $_SESSION['Chips'] == 500) )
		{	alertgo("選擇籌碼的相關資料有錯,請重新選擇","money.php");	}
	}
	else
	{// 財神九仔生
		if( $Chips == 50 OR $Chips == 100 OR $Chips == 300 OR $Chips == 500 OR $Chips == 1000 )
		{	$_SESSION['Chips'] = $Chips ;	}
		//else if( empty($_SESSION['Chips']) )
		else if( !($_SESSION['Chips'] == 50 OR $_SESSION['Chips'] == 100 OR $_SESSION['Chips'] == 300 OR $_SESSION['Chips'] == 500 OR $_SESSION['Chips'] == 1000) )
		{	alertgo("選擇籌碼的相關資料有錯,請重新選擇","money.php");	}
	}
}

if ( $MAIN_INCLUDE_NAME == "game" )
{
	if( $Room >= 1 AND $Room <= 8 )
	{	$_SESSION['Room'] = $Room ;	}
	//else if( empty($_SESSION['Chips']) )
	else if( $_SESSION['Room'] < 1 OR $_SESSION['Room'] > 8 )
	{	alertgo("選擇房間的相關資料有錯,請重新選擇","money.php");	}
}

if ( $MAIN_INCLUDE_NAME == "room" OR $MAIN_INCLUDE_NAME == "game" )
{
	if( $zone_code == 1 OR $zone_code == 2 )
	{	$_SESSION['zone_code'] = $zone_code ;	}
	//else if( empty($_SESSION['Chips']) )
	else if( !($_SESSION['zone_code'] == 1 OR $_SESSION['zone_code'] == 2) )
	{	alertgo("選擇區的相關資料有錯,請重新選擇","money.php");	}

	$tmp_RoomNum = GodNine_getRoomNum("E") ;		// 取得房間編號
//	
//	// 設定房間編號
//	$tmp_Room = "R{$tmp_Chips}{$_SESSION['zone_code']}{$_SESSION['Room']}" ;
}


$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號

// 查詢資料
$tmpSQL_Bingo = "SELECT * FROM Bingo ORDER BY Bingo_Period DESC" ;
$array_Bingo_Info = func_DatabaseGet( $tmpSQL_Bingo , "SQL" , "" ) ;		// 取得資料庫資料


echo "<!DOCTYPE html>\n";
echo "<html lang=\"en\">\n";
echo "<head>\n";
echo "	<meta charset=\"UTF-8\">\n";
echo "	<title>$MAIN_PROGRAM_TITLE</title>\n";
echo "	<meta name=\"viewport\" content=\"width=device-width,minimum-scale=1,maximum-scale=1,user-scalable=no\">\n";
echo "<meta name=\"description\" content=\"財神九仔生\">\n";

echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css\">\n";

echo "<link href=\"/static/css/common.css\" rel=\"stylesheet\">\n";
echo "<link href=\"/static/css/{$MAIN_INCLUDE_NAME}.css\" rel=\"stylesheet\">\n";

echo "<link href=\"{$MAIN_BASE_ADDRESS}Project/WinHappy/WinHappy.css\" rel=\"stylesheet\" type=\"text/css\">\n";
//echo "<link href=\"{$MAIN_BASE_ADDRESS}Project/GodNine/GodNine.css\" rel=\"stylesheet\" type=\"text/css\">\n";

// 載入中模組
echo "<link rel=\"stylesheet\" href=\"{$MAIN_BASE_ADDRESS}includes/mloading/jquery.mloading.css\">\n";
echo "<script src=\"{$MAIN_BASE_ADDRESS}includes/mloading/jquery.mloading.js\"></script>\n";


// 音樂
//echo "<audio controls autoplay=\"autoplay\" loop=\"loop\" id='myaudio'>\n";
echo "<audio loop=\"loop\" id='myaudio'>\n";
echo "<source src=\"Project/GodNine/1.mp3\" type=\"audio/mpeg\" />\n";
echo "如果不播放，說明你的瀏覽器不支持！\n";
echo "</audio>\n";

echo "<audio id='doorbell'>\n";
echo "<source src=\"static/2.mp3\" type=\"audio/mpeg\" />\n";
echo "如果不播放，說明你的瀏覽器不支持！\n";
echo "</audio>\n";

echo "</head>\n";
echo "<body data-page=\"index\" data-conn_webkey='$Conn_WebKey'>\n";
//echo "<body data-page=\"index\" data-conn_webkey='asia17888'>\n";
echo "	<header>\n";
echo "  <!-- TOP MENU -->\n";
echo "  <div class=\"topMenu mainWrap\" :active=\"active\">\n";
echo "    <a href=\"javascript:;\" class=\"hamburger\" @click=\"hamburgerHandler\">\n";
echo "      <i class=\"icon fas fa-bars\"></i>\n";
echo "    </a>\n";
echo "    <a href=\"/\" class=\"logo\">\n";
echo "      <img src=\"/static/img/logo.483b4cb.png\">\n";
echo "    </a>\n";
echo "    <a href=\"javascript:;\" class=\"back\" @click=\"goBack\">\n";
echo "      <i class=\"icon fas fa-arrow-left\"></i>\n";
echo "    </a>\n";
echo "  </div>\n";

echo "  <!-- SIDE MENU -->\n";
echo "  <div class=\"mainMenu\" :active=\"active\">\n";
echo "    <div class=\"mainMenu_content\">\n";
echo "      <div class=\"userInfo\">\n";
echo "        <div class=\"userImage\">\n";
echo "          <img src=\"/static/img/head.39a8e7a.png\" width=\"40\">\n";
echo "        </div>\n";
echo "        <div class=\"userText\">\n";
echo "          <p class=\"userID\">{$array_Member_Info['Member_Login_Name']}</p>\n";
echo "          <p id='UserName' class=\"userName\">{$array_Member_Info['Member_Name']}</p>\n";
echo "        </div>\n";
echo "      </div>\n";
echo "      <div class=\"userPoint\">\n";
echo "        <span>目前點數</span>\n";
echo "        <spang id='Header_Member_Money' class=\"count Member_Money\">" . (int)$array_Member_Info['Member_Money'] . "</span>\n";
echo "      </div>\n";
echo "      <nav>\n";
echo "		<ul>\n";
echo "			<li><a href=\"money.php\"><i class=\"fas fa-edit\"></i>返回大廳</a></li>\n";
echo "			<li><a href=\"password.php\"><i class=\"fas fa-edit\"></i>修改密碼</a></li>\n";
echo "			<li><a href=\"reportToday.php\"><i class=\"far fa-copy\"></i>帳務明細</a></li>\n";
echo "			<li><a href=\"reportHistory.php\"><i class=\"far fa-calendar-alt\"></i>歷史帳務</a></li>\n";
echo "			<li><a href=\"reportLog.php\"><i class=\"far fa-copy\"></i>操作紀錄</a></li>\n";
echo "			<li><a href=\"bingoHistory.php\"><i class=\"fas fa-search\"></i>開獎記錄</a></li>\n";
echo "			<li><a href=\"news.php\"><i class=\"fab fa-audible\"></i>最新消息</a></li>\n";
echo "			<li><a href=\"rule.php\"><i class=\"fas fa-indent\"></i>遊戲規則</a></li>\n";
echo "			<li><a href=\"javascript:;\"><i class=\"fas fa-music\"></i><span id='BTN_ControlMusic' class=\"\" data-state='0' onclick=\"autoPlay();\">音樂開啟</span></a></li>\n";
echo "			<li><a href=\"http://www.taiwanlottery.com.tw/lotto/BINGOBINGO/drawing.aspx\" target=\"_blank\"><i class=\"fas fa-link\"></i>台彩官網</a></li>\n";
echo "			<li><a href=\"?Funct=GodNineMemberLOGOUT\"><i class=\"fas fa-sign-out-alt\"></i>安全退出</a></li>\n";
echo "		</ul>\n";
echo "      </nav>\n";
echo "    </div>\n";
echo "    <a href=\"javascript:;\" class=\"close\" @click=\"hamburgerHandler\"><i class=\"fas fa-times\"></i></a>\n";
echo "  </div>\n";
echo "</header>\n";

echo "<!-- USER COUNT & MARQUEE -->\n";
echo "<div class=\"infoBlock\">\n";
echo "  <div class=\"mainWrap\">\n";
echo "    <div class=\"userCount\">\n";
echo "      <i class=\"icon fas fa-user-friends\"></i>\n";
echo "      <span id='Online_Count'>" . mb_substr($_SESSION['Member_Name'] , 0 , 5 , "utf-8") . "</span>\n";
echo "    </div>\n";

$tmp_News = "" ;

// 找出跑馬燈訊息
$SQL_News = "SELECT * FROM News WHERE News_On = '1' ORDER BY News_Mod_DT DESC" ;
//echo $SQL_News . "<br>" ; 
$QUERY_News = mysqli_query($link , $SQL_News) ;

// 是否有資料
if ( mysqli_num_rows($QUERY_News) )
{
    // 一條條獲取
    while ($LIST_News = mysqli_fetch_assoc($QUERY_News))
    {
		$tmp_News .= $LIST_News['News_Title'] . "　　　　" ;
    }
    
    // 釋放結果集合
    mysqli_free_result($QUERY_News);
}

echo "    <marquee behavior=\"\" direction=\"\">$tmp_News</marquee>\n";
echo "  </div>\n";
echo "</div>\n";
echo "\n";

?>

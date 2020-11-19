<?php
/*
header.php已處理參數

$array_Agent_Info		登入代理人資料
$array_NowAgent_Info	目前操作代理人資料
$array_NowMember_Info	目前操作會員資料

$_SESSION['AID']		目前操作代理人ID
$_SESSION['AAgent_ID']	目前操作代理人Agent_ID
$_SESSION['MID']		目前操作會員ID

*/

func_setOnLineInfo( $_SESSION['Agent_ID'] , ""  , "" ) ;		// 記錄代理人在線資訊

$tmp_OnLineCount = func_getOnLineCount( "Agent" , 20 ) ;		// 取得代理人在線人數

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
// 取得目前會員資料
if( $MID )
{
	$array_NowMember_Info = WinHappy_getMemberInfo( $MID ) ;
	$_SESSION['MID'] = $MID ;
	$_SESSION['MMember_ID'] = $_SESSION['Member_ID'] ;
}


echo "<HTML>\n";
echo "<HEAD>\n";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
echo "<TITLE>$Conn_Website_Name</TITLE>\n";
echo "<link rel=\"shortcut icon\" href=\"images/favicon.ico\">\n";
echo "<link rel='stylesheet' href='css/admin.css' type='text/css'>\n";

echo "<link rel='stylesheet' href='../css/yldu_button1.css' type='text/css'>\n";

echo "<script language='javascript' src='../js/jquery.js' ></script>\n";
echo "</HEAD>\n";
echo "<script language='JavaScript' src='js/admin.js'></script>\n";

echo "<link href=\"{$MAIN_BASE_ADDRESS}Project/WinHappy/WinHappy.css\" rel=\"stylesheet\" type=\"text/css\">\n";

echo "<link href=\"{$MAIN_BASE_ADDRESS}includes/toastr/toastr.min.css\" rel=\"stylesheet\"  />\n";
echo "<script src=\"{$MAIN_BASE_ADDRESS}includes/toastr/toastr.min.js\"></script>\n";

echo "<link rel=\"stylesheet\" href=\"{$MAIN_BASE_ADDRESS}includes/mloading/jquery.mloading.css\">\n" ;
echo "<script src=\"{$MAIN_BASE_ADDRESS}includes/mloading/jquery.mloading.js\"></script>\n" ;

?>
<?php
echo "<body onLoad=\"ShowTime()\">\n";
echo "\n";
echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"all_bg\">\n";
echo "    <tr>\n";
echo "        <td height=\"988\" align=\"center\" valign=\"top\">\n";
echo "            <table width=\"1200\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "                <tr>\n";
echo "                    <td class=\"side-nav-td\" width=\"198\" valign=\"top\">\n";
echo "                        <div class=\"ag-logo\">\n";
echo "                            -<img src=\"/static/img/logo.png\" alt=\"\">\n";
echo "                        </div>\n";
echo "                        <ul class=\"side-nav\">\n";
echo "                            <li><a href=\"./index.php\"><i class=\"fas fa-home\"></i><span>首　　頁</span></a></li>\n";
echo "                            <li><a href=\"./info.php\"><i class=\"fas info\"></i><span>詳細資料</span></a></li>\n";
echo "                            <li><a href=\"./agents.php\"><i class=\"fas fa-handshake\"></i><span>代理管理</span></a></li>\n";
echo "                            <li><a href=\"./users.php\"><i class=\"fas fa-user\"></i><span>會員管理</span></a></li>\n";
if( $_SESSION['Agent_Level'] == 1 )
{	echo "                            <li><a href=\"./agent_account.php\"><i class=\"fa fa-user-circle\"></i><span>開子帳號</span></a></li>\n";	}
echo "                            <li><a href=\"./report.php?Funct=Self\"><i class=\"fas fa-calendar-alt\"></i><span>統計報表</span></a></li>\n";
echo "                            <li><a href=\"./report_detail.php\"><i class=\"fas fa-search\"></i><span>訂單查詢</span></a></li>\n";
echo "                            <li><a href=\"./password.php\"><i class=\"fas fa-unlock-alt\"></i><span>修改密碼</span></a></li>\n";
if( $_SESSION['id_Agent'] == 1 )
{
//	echo "                            <li><a href=\"./System_Set.php\"><i class=\"fas fa-unlock-alt\"></i><span>設定系統參數</span></a></li>\n";
	echo "                            <li><a href=\"./News.php\"><i class=\"fas fa-unlock-alt\"></i><span>前台最新消息</span></a></li>\n";
	echo "                            <li><a href=\"./Bulletin.php\"><i class=\"fas fa-unlock-alt\"></i><span>後台系統公告</span></a></li>\n";
	echo "                            <li><a href=\"./SetBingo.php\"><i class=\"fas fa-unlock-alt\"></i><span>手動加獎號</span></a></li>\n";
	echo "                            <li><a href=\"./LogInfo.php\"><i class=\"fas fa-unlock-alt\"></i><span>LOG系統</span></a></li>\n";
}
echo "                        </ul>\n";
echo "                    </td>\n";
echo "                    <td width=\"1002\" height=\"844\" valign=\"top\">\n";
echo "                        <table width=\"1002\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "                            <tr>\n";
echo "                                <td width=\"1002\" height=\"4\" class=\"green_line\"></td>\n";
echo "                            </tr>\n";
echo "                        </table>\n";
echo "                        <table width=\"1002\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "                            <tr>\n";
echo "                                <td width=\"1002\" height=\"29\" align=\"center\" class=\"gray_bg\">\n";
echo "                                    <div id=\"scr1\"></div>\n";
echo "                                </td>\n";
echo "                            </tr>\n";
echo "                        </table>\n";
echo "                        <table width=\"1002\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "                            <tr>\n";
echo "                                <td width=\"1002\" height=\"29\" align=\"center\" class=\"gray_bg\">\n";
echo "                                    <table width=\"982\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "                                        <tr>\n";
echo "                                            <td width=\"20\" align=\"left\"><img src=\"images/time_icon.gif\" width=\"13\"\n";
echo "                                                                             height=\"13\"/></td>\n";
echo "                                            <td width=\"200\" align=\"left\" class=\"time\" id=\"Clocks\">現在時間：2010年09月20日 星期四\n";
echo "                                                17:48:51\n";
echo "                                            </td>\n";
echo "                                            <td width=\"152\" align=\"left\" class=\"time\">目前線上人數：$tmp_OnLineCount\n";
echo "                                                <!-- <a href=\"online_list.php\">[查看]</a> --></td>\n";
echo "                                            <td align=\"right\">登入身份：<font color=\"blue\">{$_SESSION['Agent_Name']}</font>　登入帳號：<font\n";

// 子帳號點數為0
if( $_SESSION['Agent_Level'] == 2 )
{	$array_Agent_Info['Agent_Money'] = 0 ;	}

echo "                                                    color=#cc0000>{$_SESSION['Agent_Login_Name']}</font></a>  &nbsp; 現有點數：<font color=#cc0000>" . (int)$array_Agent_Info['Agent_Money'] . "點</font>　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a\n";
echo "                                                    href=\"?Funct=AgentLOGOUT\"\n";
echo "                                                    style=\"color:#009900;font-weight:bold;\">[登出系統]</a></td>\n";
echo "                                        </tr>\n";
echo "                                    </table>\n";
echo "                                </td>\n";
echo "                            </tr>\n";
echo "                        </table>\n";
echo "                        <div align=\"center\">\n";
echo "                            <TABLE WIDTH=\"1002\" BORDER=\"0\" CELLSPACING=\"1\" cellpadding=\"0\" bordercolor=\"#000000\"\n";
echo "                                   bgcolor=\"#FFFFFF\">\n";
echo "                                <TBODY>\n";
echo "                                <TR>\n";
echo "                                    <TD vAlign=top aling=\"center\">\n";
echo "									<form name=\"form1\" id=\"form1\" action=\"$MAIN_FILE_NAME\" method=\"post\">\n";
echo "    <div align=\"center\">\n";
echo "\n";
?>

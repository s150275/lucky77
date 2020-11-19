
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>鑫城娛樂</TITLE>
<link rel="shortcut icon" href="images/favicon.ico">
<link rel='stylesheet' href='css/admin.css' type='text/css'>
<script language='javascript' src='../js/jquery.js' ></script>
</HEAD>
<!--script language='JavaScript' src='/libs/js/jquery.js'></script-->
<script language='JavaScript' src='js/admin.js'></script>
<script type="text/javascript">
    <!--
    function MM_preloadImages() { //v3.0
        var d = document;
        if (d.images) {
            if (!d.MM_p) d.MM_p = new Array();
            var i, j = d.MM_p.length, a = MM_preloadImages.arguments;
            for (i = 0; i < a.length; i++)
                if (a[i].indexOf("#") != 0) {
                    d.MM_p[j] = new Image;
                    d.MM_p[j++].src = a[i];
                }
        }
    }
    function ShowTime() {
        var timeValue = '';
        Times = new Date();
        Dates = Times.getYear() + "/" + Times.getMonth() + "/" + Times.getDay();
        hours = Times.getHours();
        minutes = Times.getMinutes();
        seconds = Times.getSeconds();
        timeValue = "現在時間 2020-04-30 ";
        timeValue += ((hours < 10) ? "0" : "") + hours + ":";
        timeValue += ((minutes < 10) ? "0" : "") + minutes + ":";
        timeValue += ((seconds < 10) ? "0" : "") + seconds;

        $("#Clocks").html(" " + timeValue + " ");
        setTimeout("ShowTime()", 1000);
    }
    //-->
</script>
<body onLoad="ShowTime()">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="all_bg">
    <tr>
        <td height="988" align="center" valign="top">
            <table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="side-nav-td" width="198" valign="top">
                        <div class="ag-logo">
                            -<img src="images/logo.jpg" alt="">
                        </div>
                        <ul class="side-nav">
                            
                            <li><a href="./home.php"><i class="fas fa-home"></i><span>首　　頁</span></a></li>
                            
                            <li><a href="./info.php"><i class="fas info"></i><span>詳細資料</span></a></li>
                            
                            <li><a href="./agents.php"><i class="fas fa-handshake"></i><span>代理管理</span></a></li>
                            
                            <li><a href="./users.php"><i class="fas fa-user"></i><span>會員管理</span></a></li>
                            
                            <li><a href="./agent_account.php"><i class="fa fa-user-circle"></i><span>開子帳號</span></a></li>
                            
                            <li><a href="./report.php"><i class="fas fa-calendar-alt"></i><span>統計報表</span></a></li>
                            
                            <li><a href="./report_detail.php?role_class=1"><i class="fas fa-search"></i><span>訂單查詢</span></a></li>
                            
                            <li><a href="./password.php"><i class="fas fa-unlock-alt"></i><span>修改密碼</span></a></li>
                            
                        </ul>
                    </td>
                    <td width="1002" height="844" valign="top">
                        <table width="1002" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="1002" height="4" class="green_line"></td>
                            </tr>
                        </table>
                        <table width="1002" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="1002" height="29" align="center" class="gray_bg">
                                    <div id="scr1"></div>
                                </td>
                            </tr>
                        </table>
                        <table width="1002" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="1002" height="29" align="center" class="gray_bg">
                                    <table width="982" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="20" align="left"><img src="images/time_icon.gif" width="13"
                                                                             height="13"/></td>
                                            <td width="200" align="left" class="time" id="Clocks">現在時間：20100920 17:48:51
                                            </td>
                                            <td width="152" align="left" class="time">目前線上人數：92415
                                                <!-- <a href="online_list.php">[查看]</a> --></td>
                                            <td align="right">登入身份：<font color="blue">a1688</font>　登入帳號：<font
                                                    color=#cc0000>c2a1688</font></a>  &nbsp; 現有點數：<font color=#cc0000>0點</font>　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                    href="./logout.php"
                                                    style="color:#009900;font-weight:bold;">[登出系統]</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div align="center">
                            <TABLE WIDTH="1002" BORDER="0" CELLSPACING="1" cellpadding="0" bordercolor="#000000"
                                   bgcolor="#FFFFFF">
                                <TBODY>
                                <TR>
                                    <TD vAlign=top aling="center"><form name="form1" action="agent_users.php" method="get">
    <div align="center">
        <table border="0" cellpadding="0" cellspacing="1" width="100%" height="110">
            <tr>
                <td height="55" colspan="2">
                    <table width="98%" border="0" align="center" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="1%" align="left"><img src="images/blue_icon.jpg" width="5" height="8"/></td>
                            <td width="99%" align="left" class="blue_text">首頁 &gt; 公告列表</td>
                        </tr>
                        <tr>
                            <td height="14" colspan="2" align="left" background="images/bgx1.jpg" class="blue_line"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="20" colspan="2" align="center" style="padding-left:10px;height:350px" valign=top>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_list">
                        <tr class="table_header">
                            <td width="85%" height="20" align="center"><b>公告主題</b></td>
                            <td width="15%" height="20" align="center"><b>創建日期</b></td>
                        </tr>
                        
                        <tr class="table_list_tr_bglight">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1470112000655948793">近日系統運行不穩定相關說明公告</a>
                            </td>
                            <td align="center">2016/08/02</td>
                        </tr>
                        
                        <tr class="table_list_tr_bgdack">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1451029602368836217">【真人2館】系統更新</a>
                            </td>
                            <td align="center">2015/12/25</td>
                        </tr>
                        
                        <tr class="table_list_tr_bglight">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1446444103744349451">首創多國賓果 讓你24小時 上線即玩 11/3正式上線</a>
                            </td>
                            <td align="center">2015/11/02</td>
                        </tr>
                        
                        <tr class="table_list_tr_bgdack">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1441278161774450249">【真人二館新功能】</a>
                            </td>
                            <td align="center">2015/09/03</td>
                        </tr>
                        
                        <tr class="table_list_tr_bglight">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1439891574765391415">德州撲克《週四萬元賞金賽》</a>
                            </td>
                            <td align="center">2015/08/18</td>
                        </tr>
                        
                        <tr class="table_list_tr_bgdack">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1438575218307139609">真人二館臨時維護通知</a>
                            </td>
                            <td align="center">2015/08/03</td>
                        </tr>
                        
                        <tr class="table_list_tr_bglight">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1438336651200271260">德州撲克封測開跑！</a>
                            </td>
                            <td align="center">2015/07/31</td>
                        </tr>
                        
                        <tr class="table_list_tr_bgdack">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1438337206290075065">德州撲克《奪寶賞金錦標賽》</a>
                            </td>
                            <td align="center">2015/07/31</td>
                        </tr>
                        
                        <tr class="table_list_tr_bglight">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1405790390160183339">系統大改版注意事項</a>
                            </td>
                            <td align="center">2014/07/20</td>
                        </tr>
                        
                        <tr class="table_list_tr_bgdack">
                            <td height="25" align="left"><a href="?mode=detail&news_id=N1399912845520154154">2014 5/13 01:30 系統維護</a>
                            </td>
                            <td align="center">2014/05/13</td>
                        </tr>
                        
                        <tr>
                            <td align="center" height="30" colspan="2" class="table_footer">共有 <b>12</b> 筆記錄 / 共計 <b>2</b> 頁<br>[ 第一頁 << 上10頁 <  <B>01</B>  <a href='?orderby=&page=2'>02</a> > 下10頁 >>  <a href='?orderby=&page=2'>最後頁</a> ] </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
	</td><td valign=top ></td>
</tr>
</table>
<SCRIPT LANGUAGE="JavaScript">
    <!--
    try {
        scroll1.scroll();
    }
    catch (e) {
    }
    //-->
</SCRIPT>
</body>
</html>

<!-- Page Load 0.020704030990601 seconds -->

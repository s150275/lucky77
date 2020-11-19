
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
                                            <td width="200" align="left" class="time" id="Clocks">現在時間：2010年09月20日 星期四
                                                17:48:51
                                            </td>
                                            <td width="152" align="left" class="time">目前線上人數：92175
                                                <!-- <a href="online_list.php">[查看]</a> --></td>
                                            <td align="right">登入身份：<font color="blue">安</font>　登入帳號：<font
                                                    color=#cc0000>c2c1688</font></a>  &nbsp; 現有點數：<font color=#cc0000>420,000點</font>　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
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
                                    <TD vAlign=top aling="center"><div align="center">
    <table border="0" cellpadding="0" cellspacing="1" width="100%" height="110">
        <tr>
            <td height="55" colspan="2">
                <table width="98%" border="0" align="center" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="1%" align="left"><img src="images/blue_icon.jpg" width="5" height="8"/></td>
                        <td width="99%" align="left" class="blue_text">首頁 &gt; IP紀錄</td>
                    </tr>
                    <tr>
                        <td height="14" colspan="2" align="left" background="images/bgx1.jpg" class="blue_line"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td height="20" colspan="2" align="center" style="padding-left:0px;height:350px" valign=top>
                <table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_list">
                    <tr class="table_header">
                        <td width="50%" height="20" align="center"><b>登入時間</b></td>
                        <!--<td width="40%" height="20" align="center"><b>最後操作時間</b></td>-->
                        <td width="50%" height="20" align="center"><b>IP</b></td>
                    </tr>
                    
                    <tr class="">
                        <td height="25" align="center">2020-04-19 20:08:53</td>
                        <!--<td height="25" align="center"></td>-->
                        <td align="center">162.158.243.157</td>
                    </tr>
                    
                    <tr class="">
                        <td height="25" align="center">2020-04-14 16:12:38</td>
                        <!--<td height="25" align="center"></td>-->
                        <td align="center">162.158.243.137</td>
                    </tr>
                    
                    <tr class="">
                        <td height="25" align="center">2020-04-14 15:45:37</td>
                        <!--<td height="25" align="center"></td>-->
                        <td align="center">162.158.243.137</td>
                    </tr>
                    

                </table>
            </td>
        </tr>
    </table>
</div></td><td valign=top ></td>
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

<!-- Page Load 0.021059036254883 seconds -->

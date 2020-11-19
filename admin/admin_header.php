<?php
echo "<!DOCTYPE html>\n";
echo "<html lang=\"zh-hant-tw\">\n";

echo "<head>\n";
echo "    <meta charset=\"utf-8\">\n";
echo "    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
echo "    <meta name=\"description\" content=\"\">\n";
echo "    <meta name=\"author\" content=\"\">\n";

echo "    <title>$MAIN_PROGRAM_TITLE</title>\n";

echo "    <!-- Bootstrap Core CSS -->\n";
echo "    <link href=\"{$MAIN_BASE_ADDRESS}admin/bower_components/bootstrap/dist/css/bootstrap.min.css\" rel=\"stylesheet\">\n";

echo "    <!-- MetisMenu CSS -->\n";
echo "    <link href=\"{$MAIN_BASE_ADDRESS}admin/bower_components/metisMenu/dist/metisMenu.min.css\" rel=\"stylesheet\">\n";

echo "    <!-- DataTables CSS -->\n";
echo "    <link href=\"{$MAIN_BASE_ADDRESS}admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css\" rel=\"stylesheet\">\n";

echo "    <!-- DataTables Responsive CSS -->\n";
echo "    <link href=\"{$MAIN_BASE_ADDRESS}admin/bower_components/datatables-responsive/css/dataTables.responsive.css\" rel=\"stylesheet\">\n";

echo "    <!-- Custom CSS -->\n";
echo "    <link href=\"{$MAIN_BASE_ADDRESS}admin/dist/css/sb-admin-2.css\" rel=\"stylesheet\">\n";

echo "    <!-- Custom Fonts -->\n";
echo "    <link href=\"{$MAIN_BASE_ADDRESS}admin/bower_components/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">\n";

echo "    <!-- yldu.css -->\n";
echo "    <link href=\"{$MAIN_BASE_ADDRESS}css/yldu.css\" rel=\"stylesheet\">\n";

echo "    <!-- yldu_button1.css.css -->\n";
echo "    <link href=\"{$MAIN_BASE_ADDRESS}css/yldu_button1.css\" rel=\"stylesheet\">\n";

echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"{$MAIN_BASE_ADDRESS}css/yldu_form1.css\">\n";
echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"{$MAIN_BASE_ADDRESS}css/custom.css\">\n";

echo "    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->\n";
echo "    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n";
echo "    <!--[if lt IE 9]>\n";
echo "        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>\n";
echo "        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>\n";
echo "    <![endif]-->\n";

echo "</head>\n";

echo "<body>\n";

echo "    <div id=\"wrapper\">\n";
echo "		<!-- Navigation -->\n";
echo "        <nav class=\"navbar navbar-default navbar-static-top\" role=\"navigation\" style=\"margin:0;background-color:#cFF;border:none;\">\n";
echo "            <div class=\"navbar-header\">\n";
echo "                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">\n";
echo "                    <span class=\"sr-only\">Toggle navigation</span>\n";
echo "                    <span class=\"icon-bar\"></span>\n";
echo "                    <span class=\"icon-bar\"></span>\n";
echo "                    <span class=\"icon-bar\"></span>\n";
echo "                </button>\n";
echo "                <a class=\"navbar-brand\" href=\"index.php\">{$_SESSION['Store_Name']}-系統管理後台</a>\n";
echo "            </div>\n";
echo "            <!-- /.navbar-header -->\n";

echo "            \n";
echo "            <!-- /.navbar-top-links -->\n";

echo "            <div class=\"navbar-default sidebar\" role=\"navigation\">\n";
echo "                <div class=\"sidebar-nav navbar-collapse\">\n";

if( $_SESSION['SystemUser_ID'] )
{
	echo "<ul class=\"nav\" id=\"side-menu\">\n";
	echo "    <li>\n";
	echo "        <a href=\"#\"><i class=\"fa fa-cog fa-lg\"></i>　系統管理<span class=\"fa arrow\"></span></a>\n";
	echo "        <ul class=\"nav nav-second-level\">\n";
	echo "            <!--li><a href=\"Admin_User.php\"><i class=\"fa fa-copyright fa-lg\"></i> 版權設定</a></li-->\n";
	echo "            <li><a href=\"{$MAIN_BASE_ADDRESS}admin/m_SystemUser.php\"><i class=\"fa fa-anchor fa-lg\"></i>　管理員資料</a></li>\n";
	echo "            <li><a href=\"{$MAIN_BASE_ADDRESS}admin/m_SystemSet.php\"><i class=\"fa fa-dashboard fa-fw\"></i>　系統參數設定</a></li>\n";
	echo "        </ul>\n";
	echo "    </li>\n";
	
	echo "    <li>\n";
	echo "        <a href=\"#\"><i class=\"fa fa-building fa-lg\"></i>　遊戲專區<span class=\"fa arrow\"></span></a>\n";
	echo "        <ul class=\"nav nav-second-level\">\n";
	echo "            <li><a href=\"{$MAIN_BASE_ADDRESS}admin/m_News.php\"><i class=\"fa fa-dashboard fa-fw\"></i>　最新消息管理</a></li>\n";
	echo "            <li><a href=\"{$MAIN_BASE_ADDRESS}admin/m_Agent.php\"><i class=\"fa fa-dashboard fa-fw\"></i>　代理人管理</a></li>\n";
	echo "            <li><a href=\"{$MAIN_BASE_ADDRESS}admin/m_Member.php\"><i class=\"fa fa-dashboard fa-lg\"></i>　會員管理</a></li-->\n";
	echo "        </ul>\n";
	echo "    </li>\n";
	
	echo "    <li>\n";
	echo "        <a href=\"#\"><i class=\"fa fa-cog fa-lg\"></i>　操作資訊<span class=\"fa arrow\"></span></a>\n";
	echo "        <ul class=\"nav nav-second-level\">\n";
	echo "            <li><a href=\"{$MAIN_BASE_ADDRESS}admin/m_LogInfo_Member.php\"><i class=\"fa fa-anchor fa-lg\"></i>　會員操作資訊</a></li>\n";
	echo "            <li><a href=\"{$MAIN_BASE_ADDRESS}admin/m_LogInfo_Agent.php\"><i class=\"fa fa-dashboard fa-fw\"></i>　代理人操作記錄</a></li>\n";
	echo "        </ul>\n";
	echo "    </li>\n";

	echo "    <li>\n";
	echo "        <a href=\"{$MAIN_BASE_ADDRESS}admin/m_Login.php?FUNCT=LOGOUT\"><i class=\"fa fa-dashboard fa-fw\"></i>　登出</a>\n";
	echo "    </li>\n";
	echo "</ul>\n";
}

echo "                </div>\n";
echo "                <!-- /.sidebar-collapse -->\n";
echo "            </div>\n";
echo "            <!-- /.navbar-static-side -->\n";
echo "        </nav>\n";

?>


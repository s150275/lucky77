<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "登入頁" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "Agent_Login.php" ;			// 設定本程式的檔名
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

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "Agent_Login_Name||*" ;
$ARRAY_POST_GET_PARA[] = "Agent_Login_Passwd||*" ;
$ARRAY_POST_GET_PARA[] = "checkword||*" ;
$ARRAY_POST_GET_PARA[] = "Login_Name||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
//unset($_SESSION['Agent_ID']);
//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;

// 後台管理者登入
if( $Login_Name != "" && strlen($_SESSION['SystemUser_ID']) == 10 && $Funct == "LOGIN" )
{
	$sql = "SELECT * FROM Agent WHERE Agent_Login_Name='$Login_Name'";
	//echo "$sql" ;
	$query = mysqli_query($link , $sql) ;
	if(mysqli_num_rows($query) > 0)
	{
		$LIST = mysqli_fetch_assoc($query) ;
		if ( $LIST['Agent_On'] == 1 )
		{
			//存入SESSION
			$_SESSION['id_Agent'] = $LIST['id_Agent'];		// 登入代理人id

			if( $LIST['Agent_Level'] == 1 )
			{
				$_SESSION['Agent_ID'] = $LIST['Agent_ID'];				// 登入代理人ID
				$_SESSION['Agent_NowID'] = $LIST['Agent_ID'];	// 目前操作的代理人ID
				$_SESSION['Agent_Login_Name'] = $LIST['Agent_Login_Name'];
				$_SESSION['Agent_Name'] = $LIST['Agent_Name'];
			}
			else if( $LIST['Agent_Level'] == 2 )
			{
				$_SESSION['Agent_ID'] = $LIST['Agent_Father_ID'];				// 登入代理人ID
				$_SESSION['Agent_NowID'] = $LIST['Agent_Father_ID'];	// 目前操作的代理人ID
				$_SESSION['Agent_Level_ID'] = $LIST['Agent_ID'];	// 子帳號ID
				$_SESSION['Agent_Login_Name'] = $LIST['Agent_Login_Name'];
				$_SESSION['Agent_Name'] = $LIST['Agent_Name'];
			}
			//$_SESSION['Agent_ID'] = $LIST['Agent_ID'];		// 登入代理人ID
			//$_SESSION['Agent_NowID'] = $LIST['Agent_ID'];	// 目前操作的代理人ID
			$_SESSION['Agent_Level'] = $LIST['Agent_Level'];		// 帳號權限-1||代理人||2||子帳號
			$_SESSION['Agent_Login_Title'] = (int)$LIST['Agent_Login_Title'];

			alertgo("" , "index.php");
		}
		else
		{
			alertgo("權限已關閉,請連絡管理者" , $MAIN_FILE_NAME);
		}
	}
	else
	{
		alertgo("登入失敗" , "$MAIN_FILE_NAME");	
	}
}
else if( $Funct == "Login" AND $Agent_Login_Name AND $Agent_Login_Passwd )
{// 是否要登入系統

	//echo "登入系統 {$_SESSION['check_word']} - {$_POST['checkword']}<br>" ;
	if((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword'])))  //判斷此兩個變數是否為空
	{// 驗證碼有輸入
		//echo "驗證碼有輸入<br>" ;
		// 不管大小寫
		if( strtolower($_SESSION['check_word']) == strtolower($_POST['checkword']) )
		{
			$sql = "SELECT * FROM Agent WHERE Agent_Login_Name='$Agent_Login_Name' AND Agent_Login_Passwd = '".crypt($Agent_Login_Passwd , strtoupper($Agent_Login_Name) )."'";
			//echo "$sql" ;
			//exit;
			//echo "<br>";
			$query = mysqli_query($link , $sql) ;
			//print_r($query);
			//exit;
			if(mysqli_num_rows($query) > 0)
			{
				$LIST = mysqli_fetch_assoc($query) ;
				if ( $LIST['Agent_On'] == 1 )
				{
					$_SESSION['Store_Name'] = $Conn_Website_Name;
					
					//存入SESSION
					$_SESSION['id_Agent'] = $LIST['id_Agent'];		// 登入代理人id

					if( $LIST['Agent_Level'] == 1 )
					{
						$_SESSION['Agent_ID'] = $LIST['Agent_ID'];				// 登入代理人ID
						$_SESSION['Agent_NowID'] = $LIST['Agent_ID'];	// 目前操作的代理人ID
					}
					else if( $LIST['Agent_Level'] == 2 )
					{
						$_SESSION['Agent_ID'] = $LIST['Agent_Father_ID'];				// 登入代理人ID
						$_SESSION['Agent_NowID'] = $LIST['Agent_Father_ID'];	// 目前操作的代理人ID
						$_SESSION['Agent_Level_ID'] = $LIST['Agent_ID'];	// 子帳號ID
					}
					
					$_SESSION['Agent_Login_Name'] = $LIST['Agent_Login_Name'];
					$_SESSION['Agent_Name'] = $LIST['Agent_Name'];
					$_SESSION['Agent_Level'] = $LIST['Agent_Level'];		// 帳號權限-1||代理人||2||子帳號
					$_SESSION['Agent_Login_Title'] = (int)$LIST['Agent_Login_Title'];

					// 加入操作LOG
					$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
					$array_LogInfo['OperatorID'] = $_SESSION['Agent_ID'] ;		// 操作者ID
					$array_LogInfo['OperatorName'] = $_SESSION['Agent_Name'] ;	// 操作者姓名
					$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
					$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
					$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
					$array_LogInfo['Type'] = "登入" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
					$array_LogInfo['Info'] = "{$_SESSION['Agent_Name']}-登入管理後台系統" ;		// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
					$array_LogInfo['SQL'] = "" ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)
					$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP

					// 管理者操作-管理等級來判斷
					$tmpCode = func_WriteLogFieldInfo( "Agent" , "Agent_ID" , $_SESSION['Agent_ID'] , "Agent_Log" , $array_LogInfo , "LogAdmin" ) ;	// 寫入LogField資料

					alertgo("登入成功" , "index.php");
				}
				else
				{
					alertgo("權限已關閉,請連絡管理者" , "index.php");
				}
			}
			else
			{
				alertgo("登入失敗","");
			}
		}
		else
		{
			alertgo("驗證碼錯誤請重新輸入","");
		}
	}
}

WinHappy_readyAgentLogin() ;		// 查詢已登入代理人後台
// 載入首頁

echo "<HTML>\n";
echo "<HEAD>\n";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
echo "<TITLE>$Conn_Website_Name</TITLE>\n";
echo "<link rel=\"shortcut icon\" href=\"images/favicon.ico\">\n";
echo "<link rel='stylesheet' href='css/admin.css' type='text/css'>\n";
echo "<script language='javascript' src='../js/jquery.js' ></script>\n";
// toastr
echo "<link href=\"$MAIN_BASE_ADDRESS/includes/toastr/toastr.min.css\" rel=\"stylesheet\" />\n";
echo "<script src=\"$MAIN_BASE_ADDRESS/includes/toastr/toastr.min.js\"></script>\n";
echo "</HEAD>\n";
echo "<!--script language='JavaScript' src='/libs/js/jquery.js'></script-->\n";
echo "<script language='JavaScript' src='js/admin.js'></script>\n";
echo "</HEAD>\n";
echo "\n";

?>

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
    //-->
</script>

<?php
echo "<body class=\"all_bg\">\n";
echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "    <tr>\n";
echo "        <td valign=\"top\">\n";
echo "		<form id=\"login\" name=\"login\" action=\"Agent_Login.php\" method=\"post\">\n";
echo "		<input type=\"hidden\" id=\"Funct\" name=\"Funct\" value=\"Login\">\n";
echo "<table width=\"900\" border=\"0\" align=\"center\">\n";
echo "<tr>\n";
echo "<td height=\"522\" align=\"center\" valign=\"top\">\n";
echo "<table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"os1717_padding_bottom\">\n";
echo "    <tr>\n";
echo "        <td>\n";
echo "            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"ht_title\">\n";
echo "                <tr>\n";
echo "                    <td height=\"132\">&nbsp;</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "    </tr>\n";
echo "</table>\n";
echo "<table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"197\" height=\"259\">&nbsp;</td>\n";
echo "<td width=\"703\" height=\"325\" align=\"left\" valign=\"top\">\n";
echo "<table width=\"518\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"center_bg\">\n";
echo "<tr>\n";
echo "<td height=\"363\" align=\"center\" valign=\"top\">\n";
echo "<table width=\"518\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "    <tr>\n";
echo "        <td height=\"76\" align=\"center\"></td>\n";
echo "    </tr>\n";
echo "</table>\n";
echo "\n";
echo "<table width=\"518\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"form-table\">\n";
echo "    <tr>\n";
echo "        <td width=\"78\">&nbsp;</td>\n";
echo "        <td width=\"80\" height=\"26\" align=\"left\" class=\"yhm\"></td>\n";
echo "        <td colspan=\"3\" align=\"left\"><input name=\"Agent_Login_Name\" type=\"text\" id=\"user\" size=\"30\" value='$Agent_Login_Name'\n";
echo "                                           onclick=\"$('#currentObjId').val('user')\" style=\"font-size:14px\" required /></td>\n";
echo "    </tr>\n";
echo "    <tr>\n";
echo "        <td height=\"8\" colspan=\"5\"></td>\n";
echo "    </tr>\n";
echo "    <tr>\n";
echo "        <td height=\"33\">&nbsp;</td>\n";
echo "        <td height=\"26\" class=\"mm\"></td>\n";
echo "        <td colspan=\"3\" align=\"left\"><input name=\"Agent_Login_Passwd\" type=\"password\" id=\"passport\" size=\"30\" value='$Agent_Login_Passwd'\n";
echo "                                            onclick=\"$('#currentObjId').val('passport')\" style=\"font-size:14px\" required /></td>\n";
echo "    </tr>\n";
echo "    <tr>\n";
echo "        <td height=\"8\" colspan=\"5\"></td>\n";
echo "    </tr>\n";
echo "    <tr>\n";
echo "        <td height=\"33\">&nbsp;</td>\n";
echo "        <td height=\"26\" class=\"yzm\"></td>\n";
echo "        <td width=\"131\" align=\"left\"><input name='checkword' type=\"text\" id=\"checkword\" size=\"18\"\n";
echo "                                            onclick=\"$('#currentObjId').val('checkword')\" title=\"請輸入右方圖片中4位阿拉伯數字\" autocomplete='off' required/>\n";
echo "        </td>\n";
echo "        <td width=\"110\" align=\"left\"><img id=\"imgcode\" src=\"{$MAIN_BASE_ADDRESS}includes/captcha/captcha.php\" onclick=\"refresh_code()\"/></td>\n";
echo "        <td width=\"111\" align=\"left\"></td>\n";
echo "    </tr>\n";
echo "</table>\n";
echo "\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "    <tr>\n";
echo "        <td height=\"9\"></td>\n";
echo "    </tr>\n";
echo "</table>\n";
echo "<table width=\"410\" height=\"144\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "    <tr>\n";
echo "        <td width=\"41\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">0</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td width=\"41\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">1</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td width=\"41\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">2</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td width=\"41\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">3</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td width=\"41\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">4</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td width=\"41\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">5</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td width=\"44\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">6</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td width=\"41\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">7</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td width=\"41\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">8</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td width=\"41\" align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"sz_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">9</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "    </tr>\n";
echo "    <tr>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">a</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">b</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">c</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">d</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">e</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">f</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">g</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">h</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">i</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">j</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "    </tr>\n";
echo "    <tr>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">k</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">l</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">m</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">n</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">o</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">p</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">q</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">r</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">s</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">t</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "    </tr>\n";
echo "    <tr>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">u</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">v</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">w</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">x</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">y</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td align=\"center\" valign=\"middle\">\n";
echo "            <table width=\"32\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"zm_bg\">\n";
echo "                <tr>\n";
echo "                    <td height=\"32\" align=\"center\" style=\"cursor:pointer\" onclick=\"set_char(this)\">z</td>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </td>\n";
echo "        <td colspan=\"2\" align=\"center\" valign=\"middle\">\n";
echo "            <img class=\"gz_icon\" width=\"72\" height=\"32\" style=\"cursor:pointer\" onclick=\"clearInput()\"/>\n";
echo "        </td>\n";
echo "        <td colspan=\"2\" align=\"center\" valign=\"middle\">\n";
echo "            <img id='BTN_Logn' class=\"login_icon\" width=\"72\" height=\"32\" style=\"cursor:pointer\" />\n";
//echo "            <img class=\"login_icon\" width=\"72\" height=\"32\" style=\"cursor:pointer\" onclick=\"document.getElementById('login').submit();\"/>\n";
echo "            <input type=\"image\" src=\"images/login_icon.jpg\" style=\"display: none\" /></a>\n";
echo "        </td>\n";
echo "    </tr>\n";
echo "</table>\n";
echo "\n";
echo "</td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "</td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "<table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "    <tr>\n";
echo "        <td colspan=\"2\" align=\"center\" style=\"font-size:13px;color:#ffffff;text-align: center\">版權所有 &copy;財神九仔生\n";
echo "            \n";
echo "        </td>\n";
echo "    </tr>\n";
echo "</table>\n";
echo "</td>\n";
echo "</tr>\n";
echo "</table>\n";
?>
<input type="hidden" id="currentObjId" name="currentObjId" value="user">


<script language="javascript">
    show_msg();

    function clearInput() {
        var objId = $("#currentObjId").val();
        $("#" + objId).val('');
    }

    function set_char(obj) {
        var objId = $("#currentObjId").val();
        var s = $("#" + objId).val();
        $("#" + objId).val(s + obj.innerHTML);
    }

    function show_msg() {
        var msg = "";
        if (msg != "") alert(msg);
        document.getElementById("user").focus();
    }
</script></td><td valign=top ></td>
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

<!-- Page Load 0.010206937789917 seconds -->
<script>
function refresh_code(){ 
	document.getElementById("imgcode").src="../includes/captcha/captcha.php"; 
} 

// ID被按時執行(click#ID)
// 
$('#BTN_Logn').click(function() {
	//alert(1111);
	if( !$("#user").val() )
	{	toastr.error('請輸入帳號');return false; }
	if( !$("#passport").val() )
	{	toastr.error('請輸入密碼');return false; }
	if( !$("#checkword").val() )
	{	toastr.error('請輸入驗證碼');return false; }
	$('#login').submit();
})

</script>

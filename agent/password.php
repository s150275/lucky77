<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "首頁" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "index.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "Member_Login_Name||*" ;
$ARRAY_POST_GET_PARA[] = "Member_Login_Passwd||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
//unset($_SESSION['Member_ID']);
//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;

WinHappy_checkAgent() ;		// 限制代理人管理後台存取頁面
// 載入首頁
include($MAIN_BASE_ADDRESS . "agent/header.php") ;        // 載入首頁

echo "<form action='' method='post' id='form1'>\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" height=\"110\">\n";
echo "	<tr>\n";
echo "		<td height=\"55\" colspan=\"2\">\n";
echo "			<table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "					<td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 修改登入密碼</td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"14\" colspan=\"2\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td width=\"10%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">原始密碼:</td>\n";
echo "		<td width=\"90%\" height=\"25\">\n";
echo "			<input type=\"password\" name=\"Old_Agent_Login_Passwd\" size=\"20\" required></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td height=\"25\" align=\"left\" style=\"padding-left:10px\">新設密碼:</td>\n";
echo "		<td height=\"25\"><input type=\"password\" name=\"Agent_Login_Passwd1\" size=\"20\" value=\"\" required/> (密碼必須使用數字或字母而且至少為 5 或至多 12\n";
echo "			個字元)\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td height=\"25\" align=\"left\" style=\"padding-left:10px\">確認密碼:</td>\n";
echo "		<td height=\"25\"><input type=\"password\" name=\"Agent_Login_Passwd2\" size=\"20\" value=\"\"/ required></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td height=\"55\" align=\"left\" colspan=\"2\" style=\"padding-left:10px\">\n";
echo "			<a id='ModPasswd'><img src=\"images/enter_save.jpg\" value=\"確定儲存\"></a>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "\n";
echo "<input type=\"hidden\" name=\"Funct\" value=\"ModPassword\">\n";

?>

<script language="javascript">
    function check() {
        frm = document.form1;
        if (frm.old_password.value == '') {
            alert("請輸入原始密碼!");
            frm.old_password.focus();
            return false;
        }
        if (frm.password.value == '') {
            alert("請輸入新設密碼!");
            frm.password.focus();
            return false;
        }
        if (frm.password2.value == '') {
            alert("請輸入驗證密碼!");
            frm.password2.focus();
            return false;
        }
        if (frm.password.value != frm.password2.value) {
            alert("密碼驗證與新設密碼不一致!");
            return false;
        }
        if (frm.password.value.length < 5 || frm.password.value.length > 12) {
            alert("密碼必須使用數字或字母而且至少為 5 或至多 12 個字元");
            return false;
        }
    }

</script>
<?php
// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>
<script>
// 新增代理(click#ModPasswd)
$('#ModPasswd').on('click', function() {
	var Old_Agent_Login_Passwd = $('input[name="Old_Agent_Login_Passwd"]').val();
	if( Old_Agent_Login_Passwd == "" )
	{	toastr.error("原始密碼為必填");
		return false;
	}

	var Agent_Login_Passwd1 = $('input[name="Agent_Login_Passwd1"]').val();
	if( Agent_Login_Passwd1 == "" )
	{
		toastr.error("新設密碼為必填");
		return false;
	}

	var Agent_Login_Passwd2 = $('input[name="Agent_Login_Passwd2"]').val();
	if( Agent_Login_Passwd2 == "" )
	{
		toastr.error("確認密碼為必填");
		return false;
	}
	$.ajax({
		type: 'POST',
		url: 'passwordA_ModPasswd.php', 
		data: $("#form1").serialize(),
	})
	.done(function(data){
		data = $.trim(data);
		// 完成後
		//toastr.success("回傳資料 : " + data);
		
		// 直接設定判斷碼
		var RetState = Number(data.substr(0,2));
		//console.log(RetState);

		var RetMsg = data.substr(3) ;
		// 成功
		if( RetState > 0 )
		{	toastr.success( RetMsg );	}
		// 失敗
		else if( RetState < 0 )
		{	toastr.error( RetMsg );	}

		//setTimeout(function() {
		//	location.replace(FileName + "?AID=" + AID);
		//}, 2000);
	})
	.fail(function() {
		// 執行失敗後
		toastr.error("新增代理失敗");
	});
});
</script>

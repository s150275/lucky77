<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "手動加獎號" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "SetBingo.php" ;			// 設定本程式的檔名
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

// 是否為管理代理人
if( empty( WinHappy_IsAdminAgent() ))		// 是否為管理代理人
{	alertgo("只有管理員可以處理","index.php");exit;	}

$array_SystemSet = WinHappy_getSystemSet() ;		// 取得系統設定值

echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
echo "	<tr>\n";
echo "		<td height=\"55\" colspan=\"2\">\n";
echo "			<table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "					<td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 手動加獎號</td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"14\" colspan=\"2\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";

echo "<fieldset>\n";
echo "    <legend>&nbsp;新增獎號&nbsp;</legend>\n";
echo "    <p style='color:#f00;font-size:20px;'>請依開出的序順填入,否則開獎會出錯</p>\n";

echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" height=\"110\">\n";
echo "	<tr>\n";
echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">期號:</td>\n";
echo "		<td height=\"25\" colspan=10><input type=\"text\" name=\"Bingo_Period\" value=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">超級獎號:</td>\n";
echo "		<td height=\"25\" colspan=10><input type=\"text\" name=\"Bingo_Super_Num\" value=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">一般大小:</td>\n";
echo "		<td height=\"25\" colspan=10><input type=\"text\" name=\"Bingo_Size_Same\" value=\"\"></td>\n";
echo "	</tr>\n";

echo "	<tr>\n";
echo "		<td height=\"25\" align=\"left\" style=\"padding-left:10px\">開獎號碼:</td>\n";
for( $i = 1 ; $i <= 10 ; $i++ )
{	echo "		<td height=\"25\">號碼" . func_addFix0( $i , 2 ) . " <input type=\"text\" name=\"Bingo_Num$i\" value=\"\" style='width:30px;'></td>\n";	}
echo "	</tr>\n";

echo "	<tr>\n";
echo "		<td height=\"25\" align=\"left\" style=\"padding-left:10px\"></td>\n";
for( $i = 11 ; $i <= 20 ; $i++ )
{	echo "		<td height=\"25\">號碼$i <input type=\"text\" name=\"Bingo_Num$i\" value=\"\" style='width:30px;'></td>\n";	}
echo "	</tr>\n";

echo "	<tr>\n";
echo "		<td height=\"55\" align=\"left\" colspan=\"2\" style=\"padding-left:10px\">\n";
echo "                <a id='BTN-AddNewBingoNum'><img  src=\"images/enter_save.jpg\"></a>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "<input type=\"hidden\" name=\"Funct\" value=\"ADDOK\">\n";
echo "</fieldset>\n";

//echo "</form>\n" ;
//
//echo "<form id='ModBingoNum_Form'>";
//echo "<fieldset>\n";
//echo "    <legend>&nbsp;修改獎號&nbsp;</legend>\n";
//
//echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" height=\"110\">\n";
//echo "	<tr>\n";
//echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">修改期號:</td>\n";
//echo "		<td height=\"25\" colspan=10><input type=\"text\" name=\"Bingo_Period\" value=\"\"></td>\n";
//echo "	</tr>\n";
//echo "	<tr>\n";
//echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">正確超級獎號:</td>\n";
//echo "		<td height=\"25\" colspan=10><input type=\"text\" name=\"Bingo_Super_Num\" value=\"\"></td>\n";
//echo "	</tr>\n";
//echo "	<tr>\n";
//echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">正確一般大小:</td>\n";
//echo "		<td height=\"25\" colspan=10><input type=\"text\" name=\"Bingo_Size_Same\" value=\"\"></td>\n";
//echo "	</tr>\n";
//
//echo "	<tr>\n";
//echo "		<td height=\"25\" align=\"left\" style=\"padding-left:10px\">正確號碼:</td>\n";
//for( $i = 1 ; $i <= 10 ; $i++ )
//{	echo "		<td height=\"25\">號碼" . func_addFix0( $i , 2 ) . " <input type=\"text\" name=\"Bingo_Num$i\" value=\"\" style='width:30px;'></td>\n";	}
//echo "	</tr>\n";
//
//echo "	<tr>\n";
//echo "		<td height=\"25\" align=\"left\" style=\"padding-left:10px\"></td>\n";
//for( $i = 11 ; $i <= 20 ; $i++ )
//{	echo "		<td height=\"25\">號碼$i <input type=\"text\" name=\"Bingo_Num$i\" value=\"\" style='width:30px;'></td>\n";	}
//echo "	</tr>\n";
//
//echo "	<tr>\n";
//echo "		<td height=\"55\" align=\"left\" style=\"padding-left:10px\">\n";
//echo "                <a id='BTN-ModBingoNum'><img  src=\"images/enter_save.jpg\"></a>\n";
//echo "		</td>\n";
//echo "		<td height=\"55\" colspan=10 align=\"left\" style=\"padding-left:10px\">\n";
//echo "      <span style='color:#f00;font-size:16px;'>使用本功能修改獎號時,會把該期的下注資料全部重新開奬</span>\n";
//echo "		</td>\n";
//echo "	</tr>\n";
//echo "</table>\n";
//echo "<input type=\"hidden\" name=\"Funct\" value=\"MODOK\">\n";
//echo "</fieldset>\n";

// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>
<script>
// 新增獎號(click#BTN-AddNewBingoNum)
$('#BTN-AddNewBingoNum').on('click', function() {
	if(confirm("是否要新增獎號"))
	{
		$.ajax({
			type: 'POST',
			url: 'SetBingoA_AddNewBingoNum.php', 
			data: $("#form1").serialize(),
		})
		.done(function(data){
			data = $.trim(data);
			// 完成後
			// toastr.success("回傳資料 : " + data);
			
			var retMsg = JSON.parse(data);
			if( retMsg.Err_Code == 1 )
			{
				toastr.success(retMsg.Err_Msg);
	//			setTimeout(function() {
	//				location.replace("agents.php?AID=" + AID);
	//			}, 2000);
			}
			else
			{
				toastr.error(retMsg.Err_Msg);
				
			}
		})
		.fail(function() {
			// 執行失敗後
			toastr.error("新增獎號-失敗");
		});
	}
	else
	{	return false;	}
});

// 修改獎號(click#BTN-ModBingoNum)
$('#BTN-ModBingoNum').on('click', function() {
	
	if(confirm("是否要修改獎號"))
	{
		$.ajax({
			type: 'POST',
			url: 'SetBingoA_ModBingoNum.php', 
			data: $("#ModBingoNum_Form").serialize(),
		})
		.done(function(data){
			data = $.trim(data);
			// 完成後
			// toastr.success("回傳資料 : " + data);
			
			var retMsg = JSON.parse(data);
			if( retMsg.Err_Code == 1 )
			{
				toastr.success(retMsg.Err_Msg);
	//			setTimeout(function() {
	//				location.replace("agents.php?AID=" + AID);
	//			}, 2000);
			}
			else
			{
				toastr.error(retMsg.Err_Msg);
				
			}
		})
		.fail(function() {
			// 執行失敗後
			toastr.error("儲存系統參數設定-失敗");
		});
	}
	else
	{	return false;	}
});

</script>

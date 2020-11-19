<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "LOG系統" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "LogInfo.php" ;			// 設定本程式的檔名
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
$ARRAY_POST_GET_PARA[] = "ID||*" ;
$ARRAY_POST_GET_PARA[] = "Type||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;
if( empty($Type) )
{	$Type = "LogAdmin" ;	}
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
echo "					<td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; LOG系統</td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"14\" colspan=\"2\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";

echo "<p><a href='?Type=LogAdmin' class=\"YB2 YB2_large YB2_regular YB2_blue\">系統LOG</a> <a href='?Type=LogInfo' class=\"YB2 YB2_large YB2_regular YB2_blue\">會員LOG</a></p>" ;

echo "<fieldset>\n";
echo "    <legend>&nbsp;LOG系統&nbsp;</legend>\n";

// 是否有輸入資料
if ( $Funct == "Log" AND $ID )
{// 秀出某區間的所有資料
	$array_Log_Info = func_DatabaseGet( "$Type" , "*" , array("id_{$Type}"=>"$ID ") ) ;		// 取得資料庫資料
	//echo "<p>Log內容</p>" ;print_r($array_Log_Info);echo "<br>" ;
	
	$arrayConvLog = func_AnalysisLogInfo( $array_Log_Info[$Type.'_Msg'] ) ;	// 分析LOG資料

	// 返轉陣列
	$arrayConvLog = array_reverse($arrayConvLog);
	
	echo "<table class='WinHappy_TB_COLLAPSE'>\n" ;
	echo "<thead>\n" ;
	echo "<tr>\n" ;
	echo "    <th>#</th>\n" ;
	echo "    <th>操作日期</th>\n" ;
	echo "    <th>操作者ID</th>\n" ;
	echo "    <th>操作者</th>\n" ;
	echo "    <th>資料表</th>\n" ;
	echo "    <th>資料ID</th>\n" ;
	echo "    <th>操作記錄</th>\n" ;
	echo "    <th>操作者IP</th>\n" ;
	echo "</tr>\n" ;

	foreach( $arrayConvLog as $key => $value )
	{
		//if ( preg_match("/youtu/i",$str) )
		//{    echo "有找到" ;    }
		//else
		//{    echo "沒有找到" ;    }

// 會員存入
// 會員提出
// 代理人存入
// 代理人存入
		//if (  !( stristr( $value['Info'], "會員存入") OR stristr( $value['Info'], "會員提出") OR stristr( $value['Info'], "代理人存入") OR stristr( $value['Info'], "代理人存入")) )
		//{    continue;    }

		echo "<tr>\n" ;
		echo "    <td>" . ($key+1) . "</td>\n" ;
		echo "    <td>{$value['Time']}</td>\n" ;
		echo "    <td>{$value['OperatorID']}</td>\n" ;
		echo "    <td>{$value['OperatorName']}</td>\n" ;
		echo "    <td>{$array_Table_Info[$value['Table']]}</td>\n" ;
		echo "    <td>{$value['ID']}</td>\n" ;
		echo "    <td>{$value['Info']}</td>\n" ;
		echo "    <td>{$value['IP']}</td>\n" ;
		echo "</tr>\n" ;
	}
	echo "</thead>\n" ;
	echo "<table>\n" ;

}
else
{// 秀出目前最新10筆記錄資料
	$SQL = "SELECT * FROM $Type WHERE {$Type}_Database = 'System_Log' ORDER BY id_{$Type} DESC LIMIT 0 , 40" ;
	//echo $SQL . "<br>" ; 
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		$tmp_Index = 0 ;
		echo "<table class='table1'>" ;
		echo "<tr>" ;
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			//echo "<p></p>" ;print_r($LIST);echo "<br>" ;
			if( $tmp_Index AND $tmp_Index % 4 == 0 )
			{
				echo "</tr>" ;
				echo "<tr>" ;
			}
			echo "    <td><a href='$MAIN_FILE_NAME?Funct=Log&ID=" . $LIST['id_'.$Type] . "&Type=$Type' class=\"YB2 YB2_large YB2_regular YB2_blue\">" . $LIST[$Type.'_Start_DT'] . "<br>" . $LIST[$Type.'_End_DT'] . "</a></td>" ;

			$tmp_Index++ ;
		}
		echo "</tr>" ;
		echo "</table>" ;
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{	echo "沒有找到資料<br>" ;	}

}

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

<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "長莊位置設定" ;		// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "agent" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "SetApplyBankerSeat.php" ;			// 設定本程式的檔名
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

$Table=array(array("Id"=>0,"Name"=>"A桌","Set"=>"1,2"),array("Id"=>1,"Name"=>"B桌","Set"=>"3,4"),array("Id"=>2,"Name"=>"C桌","Set"=>"5,6"),array("Id"=>3,"Name"=>"D桌","Set"=>"7,8"),array("Id"=>4,"Name"=>"E桌","Set"=>"9,10"),array("Id"=>5,"Name"=>"F桌","Set"=>"11,12"),array("Id"=>6,"Name"=>"G桌","Set"=>"13,14"),array("Id"=>7,"Name"=>"H桌","Set"=>"15,16"),array("Id"=>8,"Name"=>"I桌","Set"=>"17,18"),array("Id"=>9,"Name"=>"J桌","Set"=>"19,20"),array("Id"=>10,"Name"=>"K桌","Set"=>"21,22"),array("Id"=>11,"Name"=>"L桌","Set"=>"23,24"),array("Id"=>12,"Name"=>"M桌","Set"=>"25,26"),array("Id"=>13,"Name"=>"N桌","Set"=>"27,28"),array("Id"=>14,"Name"=>"O桌","Set"=>"29,30"),array("Id"=>15,"Name"=>"P桌","Set"=>"31,32"),array("Id"=>16,"Name"=>"Q桌","Set"=>"33,34"),array("Id"=>17,"Name"=>"R桌","Set"=>"35,36"),array("Id"=>18,"Name"=>"S桌","Set"=>"37,38"),array("Id"=>19,"Name"=>"T桌","Set"=>"39,40"));

//print_r($Table);
$array_bankerseat_info = func_DatabaseGet( "Agent" , "*" , array("id_Agent"=>$_SESSION['id_Agent']) ) ;		// 取得資料庫資料

$array_bankerseat_info = json_decode($array_bankerseat_info['ApplyBanker_Set_Array'],true);

//print_r($array_bankerseat_info['Banker_Info'][0]['Banker_Id']);

//echo "數量:".count($array_bankerseat_info['Banker_Info']);

echo "<form id='form1'>";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n";
echo "	<tr>\n";
echo "		<td height=\"55\" colspan=\"2\">\n";
echo "			<table width=\"98%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"1%\" align=\"left\"><img src=\"images/blue_icon.jpg\" width=\"5\" height=\"8\"/></td>\n";
echo "					<td width=\"99%\" align=\"left\" class=\"blue_text\">首頁 &gt; 長莊位置設定</td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td height=\"14\" colspan=\"2\" align=\"left\" background=\"images/bgx1.jpg\" class=\"blue_line\"></td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";

echo "<fieldset>\n";
echo "    <legend>&nbsp;位置設定&nbsp;</legend>\n";
echo "    <p style='color:#f00;font-size:20px;'>請先選擇切換狀態，再選擇切換位置</p>\n";

echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" height=\"110\">\n";
if(!$array_bankerseat_info['State'])
{
echo "	<tr>\n";
echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">位置切換狀態:</td>\n";
echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='1'>隨機</td>\n";
echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='2'>依序</td>\n";
echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='-1'>關閉</td>\n";
echo "	</tr>\n";
}
else
{
	if($array_bankerseat_info['State']=="-1")
	{
		echo "	<tr>\n";
		echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">位置切換狀態:</td>\n";
		echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='1'>隨機</td>\n";
		echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='2'>依序</td>\n";
		echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='-1' checked>關閉</td>\n";
		echo "	</tr>\n";
	}
	if($array_bankerseat_info['State']=="1")
	{
		echo "	<tr>\n";
		echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">位置切換狀態:</td>\n";
		echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='1' checked>隨機</td>\n";
		echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='2'>依序</td>\n";
		echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='-1'>關閉</td>\n";
		echo "	</tr>\n";
	}
	if($array_bankerseat_info['State']=="2")
	{
		echo "	<tr>\n";
		echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">位置切換狀態:</td>\n";
		echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='1'>隨機</td>\n";
		echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='2' checked>依序</td>\n";
		echo "  	<td width=\"25\" height=\"25\"><input type='radio' name='ApplyBanker_Seat_State' value='-1'>關閉</td>\n";
		echo "	</tr>\n";
	}
}
/*
echo "	<tr>\n";
echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">超級獎號:</td>\n";
echo "		<td height=\"25\" colspan=10><input type=\"text\" name=\"Bingo_Super_Num\" value=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td width=\"15%\" height=\"25\" align=\"left\" style=\"padding-left:10px\">一般大小:</td>\n";
echo "		<td height=\"25\" colspan=10><input type=\"text\" name=\"Bingo_Size_Same\" value=\"\"></td>\n";
echo "	</tr>\n";
*/
echo "	<tr>\n";
echo "		<td height=\"25\" align=\"left\" style=\"padding-left:10px\">莊家位置:</td>\n";
if(!$array_bankerseat_info['State'])
{
	for( $i = 0 ; $i <= 9 ; $i++ )
	{	
			echo "		<td height=\"25\"><input type=\"checkbox\" name=\"Banker_Num[]\" value=".$Table[$i]['Id']." style='width:30px;'>".$Table[$i]['Name']."</td>\n";
	}
}
else
{
	$type = 1;
	for( $i = 0 ; $i <= 9 ; $i++ )
	{
		for( $x = 0 ; $x < count($array_bankerseat_info['Banker_Info']) ; $x++ )
		{	
			if($array_bankerseat_info['Banker_Info'][$x]['Banker_Id']==$Table[$i]['Id'])
			{
				if(($array_bankerseat_info['Banker_Info'][$x]['Banker']==$array_bankerseat_info['last_Banker_Seat'])||($array_bankerseat_info['Banker_Info'][$x]['Banker']==$array_bankerseat_info['Now_Banker_Seat'])||($array_bankerseat_info['Banker_Info'][$x]['Banker']==$array_bankerseat_info['Next_Banker_Seat']))
				{
					echo "		<td height=\"25\"><input type=\"checkbox\" name=\"Banker_Num[]\" value=".$Table[$i]['Id']." style='width:30px;' checked onclick='return false;'>".$Table[$i]['Name']."</td>\n";
				}
				else
				{
					echo "		<td height=\"25\"><input type=\"checkbox\" name=\"Banker_Num[]\" value=".$Table[$i]['Id']." style='width:30px;' checked>".$Table[$i]['Name']."</td>\n";
				}
				
				$type = 2;
			}
		}
		if($type==1)
		{
			echo "		<td height=\"25\"><input type=\"checkbox\" name=\"Banker_Num[]\" value=".$Table[$i]['Id']." style='width:30px;'>".$Table[$i]['Name']."</td>\n";	
		}
		else
		{
			$type = 1;
		}
	}
}
echo "	</tr>\n";

echo "	<tr>\n";
echo "		<td height=\"25\" align=\"left\" style=\"padding-left:10px\"></td>\n";
if(!$array_bankerseat_info['State'])
{
	for( $i = 10 ; $i <= 19 ; $i++ )
	{	
			echo "		<td height=\"25\"><input type=\"checkbox\" name=\"Banker_Num[]\" value=".$Table[$i]['Id']." style='width:30px;'>".$Table[$i]['Name']."</td>\n";
	}
}
else
{
	$type = 1;
	for( $i = 10 ; $i <= 19 ; $i++ )
	{
		for( $x = 0 ; $x < count($array_bankerseat_info['Banker_Info']) ; $x++ )
		{	
			if($array_bankerseat_info['Banker_Info'][$x]['Banker_Id']==$Table[$i]['Id'])
			{
				
				if(($array_bankerseat_info['Banker_Info'][$x]['Banker']==$array_bankerseat_info['last_Banker_Seat'])||($array_bankerseat_info['Banker_Info'][$x]['Banker']==$array_bankerseat_info['Now_Banker_Seat'])||($array_bankerseat_info['Banker_Info'][$x]['Banker']==$array_bankerseat_info['Next_Banker_Seat']))
				{
					echo "		<td height=\"25\"><input type=\"checkbox\" name=\"Banker_Num[]\" value=".$Table[$i]['Id']." style='width:30px;' checked onclick='return false;'>".$Table[$i]['Name']."</td>\n";
				}
				else
				{
					echo "		<td height=\"25\"><input type=\"checkbox\" name=\"Banker_Num[]\" value=".$Table[$i]['Id']." style='width:30px;' checked>".$Table[$i]['Name']."</td>\n";
				}
				
				$type = 2;
			}
		}
		if($type==1)
		{
			echo "		<td height=\"25\"><input type=\"checkbox\" name=\"Banker_Num[]\" value=".$Table[$i]['Id']." style='width:30px;'>".$Table[$i]['Name']."</td>\n";	
		}
		else
		{
			$type = 1;
		}
	}
}
echo "	</tr>\n";

echo "	<tr>\n";
echo "		<td height=\"55\" align=\"left\" colspan=\"2\" style=\"padding-left:10px\">\n";
echo "                <a id='SetApplyBanker'><img  src=\"images/enter_save.jpg\"></a>\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "<input type=\"hidden\" name=\"Funct\" value=\"BANKERMODOK\">\n";
echo "</fieldset>\n";
echo "</form>\n" ;

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

?>
<script>
// 新增代理(click#addAgent)
$('#SetApplyBanker').on('click', function() {
	// type: "GET",
	//  data: [a11="1"],		自行設定參數
	var divs = $("input[name='Banker_Num[]']:checked").map(function() { return $(this).val(); }).get();
	var method = $("input[name='ApplyBanker_Seat_State']:checked").val(); 
	//alert(method);
	
	if((divs=='')||(!divs))
	{
		alert("請選擇莊家位置");
		return false;
	}
	//return false;
	else
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_addAgent.php', 
			data: $("#form1").serialize(),
		})
		.done(function(data){
			data = $.trim(data);
			// 完成後
			/*if( toastr_Debug == 1 )// 除錯訊息
			{	toastr.success("回傳資料 : " + data);	}*/

			var retMsg = JSON.parse(data);
			if( retMsg.Err_Code == 1 )
			{
				//toastr.success(retMsg.Err_Msg);
				alert(retMsg.Err_Msg);
				location.replace("SetApplyBankerSeat.php");
				
				if( agent_level == 1 )
				{	var FileName = "SetApplyBankerSeat.php";	}
				else
				{	var FileName = "SetApplyBankerSeat.php";	}

				setTimeout(function() {
					location.replace(FileName);
				}, 2000);
			}
			else
			{
				alert(retMsg.Err_Msg);
				//toastr.error(retMsg.Err_Msg);

			}
		})
		.fail(function() {
			// 執行失敗後
			toastr.error("編輯莊家位置失敗");
		});
	}
});

</script>

<?php
// 載入
include($MAIN_BASE_ADDRESS . "agent/footer.php") ;        // 載入首頁
?>

<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "開獎記錄" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "bingoHistory.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "bingoHistory" ;				// 主要程式名稱

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
$ARRAY_POST_GET_PARA[] = "Room||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

// 載入首頁
include($MAIN_BASE_ADDRESS . "header.php") ;        // 載入首頁

echo "<main>\n";
echo "	<div class=\"mainWrap\">\n";
echo "		<h4>開獎記錄</h4>\n";
echo "		<div class=\"form\">\n";
//echo "			<form>\n";
echo "			<div class=\"form-item\" col=\"2\">\n";
echo "				<div class=\"group\">\n";
echo "					<input type=\"date\" name='Search_Date' placeholder=\"輸入日期\" value='" . date("Y-m-d") . "' />\n";
echo "					<a id='Search_Date'>搜尋</a>\n";
echo "				</div>\n";
echo "				<div class=\"group\">\n";
echo "					<input type=\"text\" name='Search_Bingo_Period' placeholder=\"輸入獎號\" />\n";
echo "					<a id='Search_Bingo_Period'>搜尋</a>\n";
echo "				</div>\n";
echo "			</div>\n";
//echo "			</form>\n";
echo "		</div>\n";

echo "		<div id='BingoHistoryArea' class=\"bingoHistory\">\n";
echo "		</div>\n";

echo "	</div>\n";
echo "</main>\n";

// 載入版權
include($MAIN_BASE_ADDRESS . "footer.php") ;        // 載入版權
?>

<script>
function ajax_htmlBingoList( Funct , Para )
{
	// 設定要傳的POST參數
	var tmp_PostData = {};
	tmp_PostData['Funct'] = Funct;	// 功能參數
	tmp_PostData['Para'] = Para;		// 查詢參數

	$.ajax({
		type: 'POST',
		url: 'bingoHistoryA_htmlBingoList.php', 
		data: tmp_PostData ,
	})
	.done(function(data){
		data = $.trim(data);
		var RetState = Number(data.substr(0,2));
		//console.log(RetState);

		var RetMsg = data.substr(3) ;
		// 成功
		if( RetState > 0 )
		{
			//toastr.success( RetMsg );
			$("#BingoHistoryArea").html(RetMsg);
		}
		// 失敗
		else if( RetState < 0 )
		{	toastr.error( RetMsg );	}

		//toastr.success("回傳資料 : " + data);
	})
	.fail(function() {
		// 執行失敗後
		toastr.error("秀出開獎記錄失敗");
		 
	});
}
// 取得開獎記錄(clickSearch_Date,#Search_Bingo_Period
$("#Search_Date , #Search_Bingo_Period").click(function() {
	var Para = $("input[name='" + this.id + "']").val();
	//alert("按下ID : " + this.id + " , 設定資料 : " + Para);
	if( Para == "" )
	{
		if( this.id == "Search_Date" )
		{	toastr.warning( "請設定查詢日期相關資料!!!" );	}
		else if( this.id == "Search_Bingo_Period" )
		{	toastr.warning( "請設定查詢獎號相關資料!!!" );		}
		return false;
	}
	ajax_htmlBingoList( this.id , Para );
})
// 先載入今日資料
ajax_htmlBingoList( "Search_Date" , "ToDay" );

</script>

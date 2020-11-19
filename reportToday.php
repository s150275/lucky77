<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "帳務明細" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "reportToday.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "reportToday" ;				// 主要程式名稱

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
$ARRAY_POST_GET_PARA[] = "Search_Date||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

if( empty($Search_Date) )
{	$Search_Date = date("Y-m-d");	}

// 載入首頁
include($MAIN_BASE_ADDRESS . "header.php") ;        // 載入首頁

echo "<main>\n";
echo "	<div class=\"mainWrap\">\n";
echo "		<h4>帳務明細</h4>\n";
echo "		<div class=\"form\">\n";
echo "			<div class=\"form-item\">\n";
echo "				<div class=\"group\">\n";
echo "					<input type=\"date\" name='Search_Date' placeholder=\"日期\" value='$Search_Date' \>\n";
echo "					<a id='Search_Date' data-type='User'>搜尋</a>\n";
echo "				</div>\n";
echo "			</div>\n";
echo "		</div>\n";

echo "		<p style='text-align:center;'><span id='User_Report' data-type='User' class='BTN-Report'>閒家帳務</span> <span id='User_Report' data-type='Banker_List' class='BTN-Report'>莊家帳務</span></p>" ;

echo "		<div id='reportTodayArea' class=\"bingoHistory\">\n";

if( $_GET['Funct'] AND $_GET['Para'] AND $_GET['Type'] )
{
	GodNine_htmlAccount_BankerList( $_GET['Funct'] , $_GET['Para'] , $_GET['Type'] , "Funct" ) ;		// 取得莊家列表
}
else
{
	GodNine_htmlAccount_DetailsList( "Search_Date" , $_GET['Para'] , "User" , "Funct" ) ;		// 取得帳務明細
}

echo "		</div>\n";

echo "	</div>\n";
echo "</main>\n";

// 載入版權
include($MAIN_BASE_ADDRESS . "footer.php") ;        // 載入版權
?>

<script>
function ajax_htmlAccount_DetailsList( Funct , Para , Type = "User")
{
	// 設定要傳的POST參數
	var tmp_PostData = {};
	tmp_PostData['Funct'] = Funct;	// 功能參數
	tmp_PostData['Para'] = Para;		// 查詢參數
	tmp_PostData['Type'] = Type;		// 查詢模式
	//toastr.success( Funct + Para + Type);

	$.ajax({
		type: 'POST',
		url: 'reportTodayA_htmlAccount_DetailsList.php', 
		data: tmp_PostData ,
	})
	.done(function(data){
		data = $.trim(data);
		var RetState = Number(data.substr(0,2));
		//toastr.success( "回傳資料 : " + data );
		//console.log(RetState);

		var RetMsg = data.substr(3) ;
		// 成功
		if( RetState > 0 )
		{
			//toastr.success( RetMsg );
			$("#reportTodayArea").html(RetMsg);
		}
		// 失敗
		else if( RetState < 0 )
		{	toastr.error( RetMsg );	}

		//toastr.success("回傳資料 : " + data);
	})
	.fail(function() {
		// 執行失敗後
		toastr.error("秀出帳務明細失敗");
		 
	});
}
// 取得開獎記錄(clickSearch_Date,#Search_Bingo_Period
$("#Search_Date , #Search_Bingo_Period").click(function() {
	var Para = $("input[name='" + this.id + "']").val();
	var Type = $(this).data("type");
	//alert("按下ID : " + this.id + " , 設定資料 : " + Para + " , 查詢格式 : " + Type);

	if( Para == "" )
	{
		if( this.id == "Search_Date" )
		{	toastr.warning( "請設定查詢日期相關資料!!!" );	}
		return false;
	}
	ajax_htmlAccount_DetailsList( this.id , Para , Type );
})

$(".BTN-Report").click(function() {
	var Para = $("input[name='Search_Date']").val();
	var Type = $(this).data("type");
	// 設定查詢的Type
	$("#Search_Date").data("type" , Type) ;
	//alert("按下ID : " + this.id + " , 設定日期資料 : " + Para + " , 查詢格式 : " + Type);
	if( Para == "" )
	{
		if( this.id == "Search_Date" )
		{	toastr.warning( "請設定查詢日期相關資料!!!" );	}
		return false;
	}
	ajax_htmlAccount_DetailsList( "Search_Date" , Para , Type );
})

// 先載入今日資料
//ajax_htmlAccount_DetailsList( "Search_Date" , "<?php echo $Search_Date?>" , "User" );

</script>

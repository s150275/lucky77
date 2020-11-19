<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "會員操作記錄" ;					// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;						// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "admin/" ;				// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Member" ;						// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "m_LogInfo_Member.php" ;				// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;							// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;			// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;				// 取得現在的日期
$MAIN_SHOWTYPE		= "" ;							// 是否為跳出視窗(跳出:"POP",不跳出:"")
$MAIN_DELCHECK 		= "1" ;							// 是否直接刪除,不秀資料,如果有設則不會秀出資料

// ############ ########## ########## ############
// ## 載入模組									##
// ############ ########## ########## ############
include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
//include_once($MAIN_BASE_ADDRESS . "Project/bchiayi/func_bchiayi.php");

$ARRAY_POST_GET_PARA[] = "Funct||*" ;			// 功能
$ARRAY_POST_GET_PARA[] = "ID||*" ;				// ID
$ARRAY_POST_GET_PARA[] = "Report_Year||*" ;		// 查詢年度
$ARRAY_POST_GET_PARA[] = "Report_Store||*" ;	// 店家
$ARRAY_POST_GET_PARA[] = "Report_Group||*" ;	// 組別

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數
sub_post_get($ARRAY_POST_GET_PARA) ;

if( $Report_Store == "" )
{	$Report_Store = "ALL";	}
//echo "Report_Store $Report_Store Report_Group $Report_Group<br>" ;

// 設定資表料名稱
$array_Table_Info["Customer"] = "客戶資料" ;
$array_Table_Info["Business"] = "人員資料" ;
$array_Table_Info["Object"] = "物件資料" ;

$array_Table_Info["BuildingMark"] = "建物謄本-標示部" ;
$array_Table_Info["BuildingOwnership"] = "建物謄本-所有權部" ;
$array_Table_Info["BuildingOther"] = "建物謄本-他項權利部" ;
$array_Table_Info["LandMark"] = "土地謄本-標示部" ;
$array_Table_Info["LandOwnership"] = "土地謄本-所有權部" ;
$array_Table_Info["LandOther"] = "土地謄本-他項權利部" ;

//[] => Time
//[OperatorID] => Business1911090005
//[OperatorName] => 王嘉麗
//[FileName] => Manage_Object_Form.php
//[Table] => Object
//[ID] => 16
//[Type] => 修改
//[Info] => 操作者:王嘉麗 , 動作:修改資料 , ID:16
//[SQL] => UPDATE Object SET

// 限制管理後台存取頁面
checkSystemUser();

include_once("admin_header.php") ;	// 快速請取網頁傳來的參數

// 選擇分店SQL
$_SESSION['Store_SQL'] = " AND {$MAIN_DATABASE_NAME}_Store_ID = '{$_SESSION['Store_ID']}' " ;
//$_SESSION['Store_SQL'] = " AND {$MAIN_DATABASE_NAME}_Store_ID = 'Store1906260003' " ;

// 載入內定Style
include_once($MAIN_BASE_ADDRESS . "includes/Template/html_Style_Template.php");

// 網頁內容開頭
echo "<div id=\"page-wrapper\">\n" ;
echo "    <div class=\"row\">\n" ;
echo "        <div class=\"col-lg-12\">\n" ;
echo "            <h1 class=\"page-header\">\n";
// 網頁名稱
echo "            <a href=\"$MAIN_FILE_NAME\">{$Conn_Website_Name}-$MAIN_PROGRAM_TITLE</a>\n";
//echo "            <a href=\"#notice\" class=\"button btn btn-primary Ylightbox_ADD\" id='Ylightbox_ADD' data-dataurl='Manage_Business_Form.php?Funct=ADD' style='float:right;'>新增</a>\n";
echo "            </h1>\n";
echo "        </div>\n" ;
echo "    </div>\n" ;

echo "    <form action=\"$MAIN_FILE_NAME\" method=\"POST\" id=\"Search_Form\" name=\"Search_Form\" role=\"form\" enctype=\"multipart/form-data\" onsubmit='hide_mloading_Form()'>\n";
echo "    <input name=\"Funct\" type=\"hidden\" id=\"Funct\" value=\"Search\">\n";

echo "    <div class=\"row\">\n" ;
echo "        <div class=\"col-lg-12 text-center\">\n" ;

echo "        <table class='bchiayi_Report_Search_Table'>\n";
echo "        <tr>\n";
echo "            <td>\n";
echo "			  <a class=\"btn btn-default btn-xs\" data-container=\"body\" data-toggle=\"popover\" data-placement=\"left\" data-content=\"如果只輸入開始日期,表示查詢輸入日期的當月資料,如果只輸入結束日,表示只查詢輸入日期資料.\">?</a>\n";
echo "			  建立日期 : \n";
echo "			  <input name='Customer_Add_DT_Start' id='Customer_Add_DT_Start' class='flatpickr' data-default-date='' placeholder='開始日期'>\n";
echo "			  <a id='Customer_Add_DT_Start-Clear' class='btn btn-danger btn-xs flatpickr_Clear'>X</a>\n";
echo "			  - <input name='Customer_Add_DT_End' id='Customer_Add_DT_End' class='flatpickr' data-default-date='' placeholder='結束日期'>\n";
echo "			  <a id='Customer_Add_DT_End-Clear' class='btn btn-danger btn-xs flatpickr_Clear'>X</a>\n";
echo "            </td>\n";

echo "            <td>\n";
echo "			  <a id='' data-month_type='Prev_Month' data-search_date='" . getChangDay( date("Y-m-d") , "LM" , 1 ) . "' class='btn btn-info btn-xs Btn_Show_Month'>上月</a>\n\n";
echo "			  <a id='' data-month_type='This_Month' data-search_date='" . date("Y-m-d") . "' class='btn btn-info btn-xs Btn_Show_Month'>本月</a>\n\n";
echo "            </td>\n";

// 查詢
echo "            <td>\n";
echo "				  <input type='submit' value='查詢'>\n";
echo "            </td>\n";

// 產生Excel
//echo "            <td>\n";
//echo "				  <a href='javascript:;' class='btn btn-primary Btn_Report_Business'>產生Excel</a>\n";
//echo "            </td>\n";
echo "        </tr>\n";
echo "     </table>\n";

echo "    </div>\n" ;
echo "    </form>\n";

//加盟店(Store),業務名稱(Name),年度業績目標(Target)
//月業績金額(Month1-12) : 一月,二月,三月,四月,五月,六月,七月,八月,九月,十月,十一月,十二月
//季業績金額(Season1-4) : 第一季,第二季,第三季,第四季
//已達成總業績(Total_Performance)
//已達成率(Achieving_Rate)

// 是否有輸入資料
if ( $Funct == "Log" AND $ID )
{// 秀出某區間的所有資料
	$array_LogAdmin_Info = func_DatabaseGet( "LogInfo" , "*" , array("id_LogInfo"=>"$ID ") ) ;		// 取得資料庫資料
	//echo "<p>Log內容</p>" ;print_r($array_LogAdmin_Info);echo "<br>" ;
	
	$arrayConvLog = func_AnalysisLogInfo( $array_LogAdmin_Info['LogInfo_Msg'] ) ;	// 分析LOG資料

	// 返轉陣列
	$arrayConvLog = array_reverse($arrayConvLog);
	
	echo "<table class='table'>" ;
	echo "<tr>" ;
	echo "    <th>#</th>" ;
	echo "    <th>操作日期</th>" ;
	echo "    <th>操作者ID</th>" ;
	echo "    <th>操作者姓名</th>" ;
	echo "    <th>操作資料表</th>" ;
	echo "    <th>操作資料ID</th>" ;
	echo "    <th>操作記錄</th>" ;
	echo "    <th>操作者IP</th>" ;
	echo "</tr>" ;
	//echo "<p></p>" ;print_r($arrayConvLog);echo "<br>" ;
	foreach( $arrayConvLog as $key => $value )
	{
//		$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
//		$array_LogInfo['OperatorID'] = $_SESSION['Business_ID'] ;		// 操作者ID
//		$array_LogInfo['OperatorName'] = $_SESSION['Business_Name'] ;	// 操作者姓名
//		$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
//		$array_LogInfo['Table'] = $MAIN_DATABASE_NAME ;					// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
//		$array_LogInfo['ID'] = $id ;									// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
//		$array_LogInfo['Type'] = "新增" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
//		$array_LogInfo['Info'] = "操作者 : {$_SESSION['Business_Name']} , 動作:新增資料 , 聯賣編號:$Object_JointSaleNumber" ;			// 操作記錄 備註(可記錄新增會員ID,刪除ID)
//		$array_LogInfo['SQL'] = str_replace ("'","’",$insertSQL) ;		// SQL內容(有才需填-只給管理者看)
//		$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP

		echo "<tr>" ;
		echo "    <td>" . ($key+1) . "</td>" ;
		echo "    <td>{$value['Time']}</td>" ;
		echo "    <td>{$value['OperatorID']}</td>" ;
		echo "    <td>{$value['OperatorName']}</td>" ;
		echo "    <td>{$array_Table_Info[$value['Table']]}</td>" ;
		echo "    <td>{$value['ID']}</td>" ;
		echo "    <td>{$value['Info']}</td>" ;
		echo "    <td>{$value['IP']}</td>" ;
		echo "</tr>" ;
//		echo "<p>第 " . ($key+1) . " 筆 操作日期 : {$value['Time']} , 操作者ID : {$value['OperatorID']} , 操作者姓名 : {$value['OperatorName']} " ;
//		//if( $value['FileName'] )echo " , 執行程式 : {$value['FileName']} " ;
//		if( $value['Table'] )echo " , 操作資料表 : {$array_Table_Info[$value['Table']]} " ;
//		if( $value['ID'] )echo " , 操作資料ID : {$value['ID']} " ;
//		if( $value['Type'] )echo " , 操作動作 : {$value['Type']} " ;
//		if( $value['Info'] )echo " , 操作記錄 : {$value['Info']} " ;
//		//if( $value['SQL'] )echo " , SQL內容 : {$value['SQL']} " ;
//		if( $value['IP'] )echo " , 操作者IP : {$value['IP']} " ;
//		echo "</p>" ;
	}
	echo "<table>" ;

}
else
{// 秀出目前最新10筆記錄資料
	$SQL = "SELECT * FROM LogInfo WHERE LogInfo_Database = 'System_Log' ORDER BY id_LogInfo DESC LIMIT 0 , 10" ;
	//echo $SQL . "<br>" ; 
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		$tmp_Index = 0 ;
		echo "    <div class=\"row\">\n" ;
		// 一條條獲取
		while ($LIST = mysqli_fetch_assoc($QUERY))
		{
			if( $tmp_Index AND $tmp_Index % 3 == 0 )
			{
				echo "    </div>\n" ;
				echo "    <div class=\"row\">\n" ;
			}
			echo "        <div class=\"col-lg-4 mt-1 YC\">\n" ;
			echo "        <a href='$MAIN_FILE_NAME?Funct=Log&ID={$LIST['id_LogInfo']}' class='btn btn-primary'>記錄日期 : {$LIST['LogInfo_Start_DT']} - {$LIST['LogInfo_End_DT']}</a><br>" ;
			echo "        </div>\n" ;

			$tmp_Index++ ;
		}
		echo "    </div>\n" ;
		
		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{	echo "沒有找到資料<br>" ;	}

}

include_once("admin_footer.php") ;

?>
<script>
// 說明視窗
$("[data-toggle=popover]")
	.popover()
</script>

<script>
// 產生Excel
$('body').on('click','.Btn_Report_Business',function(){
	//alert(1111);
	var Funct = "Excel" ;
	var Report_Year = $("#Report_Year").val() ;
	var Report_Store = $("#Report_Store").val() ;
	var Report_Group = $("#Report_Group").val() ;
	//alert("Funct : " + Funct + " Report_Year : " + Report_Year +  " Report_Store : " + Report_Store  + " Report_Group : " + Report_Group);
	
	location.replace('Excel_Report_Business.php?Funct=' + Funct + '&Report_Year=' + Report_Year + '&Report_Store=' + Report_Store + "&Report_Group=" + Report_Group);
	
});
// 改變店家切換組別(change#Report_Store)
$("#Report_Store").change(function() {
	//alert("改變店家切換組別(change#Report_Store)");
	var Report_Store = $("#Report_Store").val();
	//alert("改變店家ID : " + Report_Store);
	$.post("Manage_Report_ObjectA_Get_Group.php", {Funct : "Report" , Report_Store: Report_Store , First_Select: "ALL,不限組別"}, function(data){
		data = $.trim(data);
		//alert(data);
		if (data === '-1'){
			toastr.error(result.Err_Msg);
			return;
			$('#loginmodal').modal();
			return;
		}
		$("#Report_Group").html(data);
	});
	return false;
})
</script>
<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "縣市設定" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "admin/" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "City" ;		// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "m_$MAIN_DATABASE_NAME.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期
$MAIN_SHOWTYPE = "" ;					// 是否為跳出視窗(跳出:"POP",不跳出:"")
$MAIN_DELCHECK = "1" ;						// 是否直接刪除,不秀資料,如果有設則不會秀出資料

// ############ ########## ########## ############
// ## 載入模組									##
// ############ ########## ########## ############
include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
include_once($MAIN_BASE_ADDRESS . "includes/bot.php");
//include_once($MAIN_BASE_ADDRESS . "includes/func_wostory.php");

// 限制後台存取頁面
checkSystemUser();

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;
$ARRAY_POST_GET_PARA[] = "page||*" ;
$ARRAY_POST_GET_PARA[] = "DESC||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_FIELD||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_KEY||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

// 內定設定參數-----------------------------------------
// 功能啟用設定
$array_On[0] = "停用";
$array_On[1] = "開啟";
$array_On[2] = "垃圾桶";

// 表單功能設定
$array_Funct_Txet["ADDOK"] = "新增資料" ;
$array_Funct_Txet["MODOK"] = "修改資料" ;
$array_Funct_Txet["DELOK"] = "刪除資料" ;

// 功能啟用顏色
$array_On_Label[0] = "label label-warning";
$array_On_Label[1] = "label label-info";

// 設定查詢欄位
$array_Search_Field['City_Name'] = "縣市名稱" ;
$array_Search_Field['City_ID'] = "縣市ID" ;
$array_Search_Field['City_Title'] = "主標題" ;
$array_Search_Field['City_SubTitle'] = "副標題" ;
$array_Search_Field['City_Pict'] = "圖片" ;

// 設定子類別選項
$array_subType[] = "開啟||SEARCH_FIELD=SystemUser_On&SEARCH_KEY=1" ;
$array_subType[] = "停用||SEARCH_FIELD=SystemUser_On&SEARCH_KEY=0" ;

// 載入內定ARRAY模組

// 設定的陣列

// 參數狀態陣列
$array_City_On['0'] = "請選擇" ;
$array_City_On['0'] = "下架" ;
$array_City_On['1'] = "上架" ;

include_once("admin_header.php") ;	// 快速請取網頁傳來的參數

// 取得傳入的參數
function getPara()
{
	global $Global_Get ;	// GET用參數
	global $Global_Post ;	// POST參數(input隱藏欄位)
	global $Global_ADDSQL ;	// 新增SQL
	global $Global_MODSQL ;	// 修改SQL

	// 格式說明
	// 參數一 : 欄位名稱
	// 參數二 : GET和POST欄位設定(*)
	// 參數三 : 新增SQL欄位設定(ADD)
	// 參數四 : 修改SQL欄位設定(MOD)
	// 參數五 : 變數格式(INT)
	//不用可以設成"-"即可

	// 傳入的參數
	$ARRAY_POST_GET_PARA1[] = "City_Name||*||ADD||MOD||-" ;		// 縣市名稱
	$ARRAY_POST_GET_PARA1[] = "City_ID||*||ADD||MOD||-" ;		// 縣市ID
	$ARRAY_POST_GET_PARA1[] = "City_Title||*||ADD||MOD||-" ;		// 主標題
	$ARRAY_POST_GET_PARA1[] = "City_SubTitle||*||ADD||MOD||-" ;		// 副標題
	$ARRAY_POST_GET_PARA1[] = "City_Pict||*||ADD||MOD||-" ;		// 圖片
	$ARRAY_POST_GET_PARA1[] = "City_Sort||*||ADD||MOD||-" ;		// 排序(由小到大排序)
	$ARRAY_POST_GET_PARA1[] = "City_Add_DT||*||ADD||MOD||-" ;		// 新增日期
	$ARRAY_POST_GET_PARA1[] = "City_On||*||ADD||MOD||-" ;		// 參數狀態

	sub_post_get($ARRAY_POST_GET_PARA1) ;

//	echo "GET參數 :　$Global_Get<br><br>" ;
//	echo "ADDSQL參數 :　$Global_ADDSQL<br><br>" ;
//	echo "MODSQL參數 :　$Global_MODSQL<br><br>" ;
}

// 秀出form資料
function showForm( $subLIST , $subFUNCT )
{
	global $MAIN_FILE_NAME ;
	global $MAIN_BASE_ADDRESS ;
	global $MAIN_CHECK_FIELD ;
	global $MAIN_SHOWTYPE ;
	global $array_Funct_Txet ;
	global $errMsg ;
	global $array_On ;

	// 外加變數
	global $array_City_On ;

?>
    <div class="row">
    <?php echo showBackListButton() ;	// 秀出上一頁和回列表按鈕 ?>
    </div>
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading"> <?php echo $array_Funct_Txet[$subFUNCT];?> </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
			<?php
			echo "<form action=\"$MAIN_FILE_NAME\" method=\"post\" id=\"insertform\" name=\"insertform\" role=\"form\">\n";
			echo "<input name=\"Funct\" type=\"hidden\" id=\"Funct\" value=\"$subFUNCT\">\n";
			echo "<input name=\"ID\" type=\"hidden\" id=\"ID\" value=\"" . $subLIST[$MAIN_CHECK_FIELD] . "\">\n";
			echo "<input name=\"SHOWTYPE\" type=\"hidden\" id=\"SHOWTYPE\" value=\"$MAIN_SHOWTYPE\">\n";
			if ( $errMsg )
			{
				echo "<div class=\"form-group\">\n";
				echo "	<p style=\"color:#f00;font-size:16px;text-align:center;\">$errMsg</p>\n";
				echo "</div>\n";
			}
			// 開始加入欄位

			echo "<div class=\"form-group\">\n";
			echo "    <label>縣市名稱</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"City_Name\" id=\"City_Name\" class=\"form-control\" value=\"" . $subLIST["City_Name"] . "\" required>\n";	}
			else
			{	echo $subLIST["City_Name"] . "\n";	}
			echo "</div>\n";
						
			echo "<div class=\"form-group\">\n";
			echo "    <label>縣市ID</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"City_ID\" id=\"City_ID\" class=\"form-control\" value=\"" . $subLIST["City_ID"] . "\" required>\n";	}
			else
			{	echo $subLIST["City_ID"] . "\n";	}
			echo "</div>\n";
						
			echo "<div class=\"form-group\">\n";
			echo "    <label>主標題</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"City_Title\" id=\"City_Title\" class=\"form-control\" value=\"" . $subLIST["City_Title"] . "\" required>\n";	}
			else
			{	echo $subLIST["City_Title"] . "\n";	}
			echo "</div>\n";
						
			echo "<div class=\"form-group\">\n";
			echo "    <label>副標題</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"City_SubTitle\" id=\"City_SubTitle\" class=\"form-control\" value=\"" . $subLIST["City_SubTitle"] . "\" required>\n";	}
			else
			{	echo $subLIST["City_SubTitle"] . "\n";	}
			echo "</div>\n";
						
			echo "<div class=\"form-group\">\n";
			echo "    <label>圖片</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"City_Pict\" id=\"City_Pict\" class=\"form-control\" value=\"" . $subLIST["City_Pict"] . "\" required>\n";	}
			else
			{	echo $subLIST["City_Pict"] . "\n";	}
			echo "</div>\n";
						
			echo "<div class=\"form-group\">\n";
			echo "    <label>排序(由小到大排序)</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"City_Sort\" id=\"City_Sort\" class=\"form-control\" value=\"" . (int)$subLIST["City_Sort"] . "\" required>\n";	}
			else
			{	echo (int)$subLIST["City_Sort"] . "\n";	}
			echo "</div>\n";
						
			echo "<div class=\"form-group\">\n";
			echo "    <label>新增日期</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"date\" name=\"City_Add_DT\" id=\"City_Add_DT\" class=\"form-control\" value=\"" . $subLIST["City_Add_DT"] . "\">\n";	}
			else
			{	echo $subLIST["City_Add_DT"] . "\n";	}
			echo "</div>\n";
						
			echo "<div class=\"form-group\">\n";
			echo "<label>參數狀態</label>\n";
			if ( $subFUNCT != "SHOW" )
			{
				echo "<select name=\"City_On\" class=\"form-control\">\n";
				foreach( $array_City_On as $key => $value )
				{
					if ( $key == $subLIST['City_On'] )
					{	echo "<option value=\"$key\" selected>$value</option>\n";	}
					else
					{	echo "<option value=\"$key\">$value</option>\n";	}
				}
				echo "</select>\n";
			}
			else
			{	echo $City_On[$subLIST['City_On']] . "\n";	}
			echo "</div>\n";
						
			// 結束加入欄位

//			echo "<div class=\"form-group\">\n";
//            echo "<label>置頂</label>\n";
//            if ( $subFUNCT != "SHOW")
//			{
//				echo "<input type=\"radio\" name=\"News_PutTop\" value=\"1\"" . checksCheckBox($subLIST['News_PutTop'], 1) . ">" . $array_News_PutTop[1] . "\n";
//				echo "<input type=\"radio\" name=\"News_PutTop\" value=\"0\"" . checksCheckBox($subLIST['News_PutTop'], 0) . ">" . $array_News_PutTop[0] . "\n";
//            }
//			else
//			{
//	            echo $array_On[(int)$subLIST['News_On']] . "\n";
//            }
//            echo "</div>\n";

            echo "<div class=\"form-group abgne-menu-20140101-1\">\n";
            echo "<label>會員權限</label>\n";
            if ( $subFUNCT != "SHOW")
			{
				echo "<input type=\"radio\" name=\"SystemUser_On\" id=\"SystemUser_On1\" value=\"1\"" . checksCheckBox($subLIST['SystemUser_On'], 1) . "><label for=\"SystemUser_On1\">" . $array_On[1] . "</label>\n";
				echo "<input type=\"radio\" name=\"SystemUser_On\" id=\"SystemUser_On0\" value=\"0\"" . checksCheckBox($subLIST['SystemUser_On'], 0) . "><label for=\"SystemUser_On0\">" . $array_On[0] . "</label>\n";
            }
			else
			{	echo $array_On[(int)$subLIST['SystemUser_On']] . "\n";	}
            echo "</div>\n";

			if ( $subFUNCT != "SHOW")
			{
				echo "<button type=\"submit\" class=\"btn btn-default\">" . $array_Funct_Txet[$subFUNCT] . "</button>\n";
				echo "<button type=\"reset\" class=\"btn btn-default\">重設</button>\n";
				echo "<a href=\"#\" class=\"btn btn-default\" onclick=\"window.parent.location.reload();\">關閉</a>\n";
			}
			else
			{
				echo "<a href=\"$MAIN_FILE_NAME?Funct=MOD&ID=" . $subLIST[$MAIN_CHECK_FIELD] . "\" class=\"btn btn-default\">修改</a>\n";
			}
            echo "</form>\n";
            ?>
            </form>
          <div></div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
                
<?php	
}
?>
<style>
table
{
	border: 1px solid #000;
	border-collapse: collapse;
}
tr , td
{
	border: 1px solid #000;
	padding:10px;
	font-size:18px;
}
</style>

		<div id="page-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header"><a href="<?php echo $MAIN_FILE_NAME?>"><?php echo $Conn_Website_Name . "-" .  $MAIN_PROGRAM_TITLE?></a><a href="<?php echo $MAIN_FILE_NAME?>?Funct=ADD" class="btn btn-default" style='float:right;'>新增</a></h1>
                    <br style="clear:both;">
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<?php
			//~@_@~// START 加入資料表單 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			if ( $Funct == "ADD" )
			{
				$LIST = array();
				showForm( $LIST , "ADDOK" );
			}
			//~@_@~// E N D 加入資料表單 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			//~@_@~// START 加入資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			elseif ( $Funct == "ADDOK" )
			{
				// 取得傳入的參數
				getPara();
			
				// 其它SQL參數
				$tmpSQL = "" ;
				// 錯誤訊息
				$errMsg = "" ;

				// 是否要判斷欄位值是否存在
				//<!--##FIELD_DATA_EXIT##-->
				
				// 查詢帳號是否已存在
				if ( CheckFieldExist( "SystemUser" , "SystemUser_Login_Name" , "$SystemUser_Login_Name" ) )
				{	$errMsg = "帳號已存在,請重新設定..." ;	}
			
				// 是否有密碼欄位
				//<!--##FIELD_PASSWD##-->
				if ( $SystemUser_Login_Passwd1 == "" )
				{	$errMsg = "密碼要設定..." ;	}
				elseif ( $SystemUser_Login_Passwd1 != $SystemUser_Login_Passwd2 )
				{	$errMsg = "兩個密碼不相同,請重新設定..." ;	}
				else
				{
					if ( strlen($SystemUser_Login_Passwd1) < 6 OR strlen($SystemUser_Login_Passwd1) > 12 )
					{	$errMsg = "密碼長度為6-12..." ;	}
					else
					{	$tmpSQL .= " SystemUser_Login_Passwd = '" . crypt($SystemUser_Login_Passwd1 , $SystemUser_Login_Name). "' , " ;	}
				}
			
				// 密碼設定OK
				if ( $errMsg == "" )
				{
					// 載入編號產生器
					//<!--##ARRAY_SUB_GET_ID##-->
					include($MAIN_BASE_ADDRESS . "includes/sub/sub_get_ID.sub") ;	// 載入會員編號產生器
					$tempID = getID ( "4" , "ymd" , "SystemUser" , "SystemUser_ID" ) ;
					$tmpSQL .= " SystemUser_ID = '$tempID' , " ;
			
					// 加入時間
					$tmpSQL .= " SystemUser_Add_DT = '" . $MAIN_NOW_TIME . "' , " ;
			
					//寫入資料庫
					$insertSQL="INSERT INTO $MAIN_DATABASE_NAME SET 
					$tmpSQL 
					$Global_ADDSQL
					";
					//echo "$insertSQL<br>" ;
					if(mysqli_query($link , $insertSQL))
					{
						if ( $MAIN_SHOWTYPE == "POP" )
						{
							echo "<script>\n" ;
							echo "window.parent.location.reload();\n" ;
							echo "</script>\n" ;
						}
						else
						{	alertgo("資料新增成功...." , $MAIN_FILE_NAME );	}
					}
					else
					{	$errMsg = "新增失敗" ;	}
				}
				showForm( $_POST , "ADDOK" );
			}
			//~@_@~// E N D 加入資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			//~@_@~// START 修改資料表單 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			elseif ( $Funct == "MOD" )
			{
				$modSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $MAIN_CHECK_FIELD = '$ID'" ;
				//echo "$modSQL<br>" ;
				$QUERY_Mod = mysqli_query($link , $modSQL) ;
				
				// 有資料時執行
				if ( mysqli_num_rows($QUERY_Mod) )
				{	$LIST = mysqli_fetch_assoc($QUERY_Mod) ;	}
				showForm( $LIST , "MODOK" );
			}
			//~@_@~// E N D 修改資料表單 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			//~@_@~// START 修改資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			elseif ( $Funct == "MODOK" )
			{
				// 取得傳入的參數
				getPara();
				
				// 是否有密碼欄位
				//<!--##FIELD_PASSWD##-->
				if ( $SystemUser_Login_Passwd1 == "" )
				{	}
				elseif ( $SystemUser_Login_Passwd1 != $SystemUser_Login_Passwd2 )
				{	$errMsg = "兩個密碼不相同,請重新設定..." ;	}
				else
				{
					if ( strlen($SystemUser_Login_Passwd1) < 6 OR strlen($SystemUser_Login_Passwd1) > 12 )
					{	$errMsg = "密碼長度為6-12,請重新設定..." ;	}
					else
					{	$tmpSQL .= " SystemUser_Login_Passwd = '" . crypt($SystemUser_Login_Passwd1 , $SystemUser_Login_Name). "' , " ;	}
				}

				if ( $errMsg == "" )
				{
					$modSQL = "UPDATE $MAIN_DATABASE_NAME SET
					$tmpSQL
					$Global_MODSQL
					WHERE $MAIN_CHECK_FIELD = '$ID'" ;
					//echo "$modSQL<br>" ;
				
					if ( mysqli_query($link , $modSQL) )
					{
						alertgo( "資料修改完成" , $MAIN_FILE_NAME ) ;
					}
					else
					{	echo "修改資料失敗!!" ;	}
				}
				showForm( $_POST , "MODOK" );
			}
			//~@_@~// E N D 修改資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			//~@_@~// START 刪險資料表單 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			elseif ( $Funct == "DEL" )
			{
				$modSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $MAIN_CHECK_FIELD = '$ID'" ;
				//echo "$SQL_Member<br>" ;
				$QUERY_Mod = mysqli_query($link , $modSQL) ;
				
				// 有資料時執行
				if ( mysqli_num_rows($QUERY_Mod) )
				{	$LIST = mysqli_fetch_assoc($QUERY_Mod) ;	}
				showForm( $LIST , "DELOK" );
			}
			//~@_@~// E N D 刪險資料表單 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			//~@_@~// START 刪險資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			elseif ( $Funct == "DELOK" )
			{
				$_POST['SELECT_ID'] ? $SELECT_ID = $_POST['SELECT_ID'] : $SELECT_ID = $_GET['SELECT_ID'] ;
				//print_r($SELECT_ID);
				// 求出所傳入要從資料庫中刪除的個數
				$COUNT_SELECT_ID = sizeof($SELECT_ID) ;
				
				//~@_@~// START 是否有要集體刪除的動作 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
				if( $COUNT_SELECT_ID )
				{
					// 清空資料
					$HAS_DATA = 0 ;
					$TEMP_DATA = "" ;
				
					// 把所有勾選的選項加入SQL中
					for( $FOR_COUNT = 0 ; $FOR_COUNT < $COUNT_SELECT_ID ; $FOR_COUNT++ )
					{
						// 判斷是否已加過資料,已有資料就先加入,再加入新資料
						if( $HAS_DATA )
						{    $TEMP_DATA = $TEMP_DATA . " OR " ;    }
						else
						{    $HAS_DATA = 1 ;    }
				
						// 加入資料
						$TEMP_DATA = $TEMP_DATA . $MAIN_CHECK_FIELD . " = " . $SELECT_ID[$FOR_COUNT] ;
					}
					//echo "$TEMP_DATA<br>" ;
				}
				//~@_@~// END 是否有要集體刪除的動作 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
				//~@_@~// START 單一刪除動作 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
				else
				{	$TEMP_DATA = "$MAIN_CHECK_FIELD = '$ID'" ;	}
				//~@_@~// END 單一刪除動作 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
				
				// 把SQL參數組合起來
				$delSQL = "DELETE FROM $MAIN_DATABASE_NAME WHERE $TEMP_DATA" ;
				//echo "$delSQL" ;
				if ( mysqli_query($link , $delSQL) )
				//	if ( 0 )
				{
					if ( $MAIN_SHOWTYPE == "POP" AND !($MAIN_DELCHECK == 1 OR $COUNT_SELECT_ID ) )
					{
						echo "<script>\n" ;
						echo "window.parent.location.reload();\n" ;
						echo "</script>\n" ;
					}
					else
					{	alertgo( "資料修改完成" , $MAIN_FILE_NAME ) ;	}
				}
				else
				{	echo "刪除資料失敗!!" ;	}
			}
			//~@_@~// E N D 刪險資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			//~@_@~// START 秀出資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			elseif ( $Funct == "SHOW" )
			{
				$modSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $MAIN_CHECK_FIELD = '$ID'" ;
				//echo "$SQL_SystemUser<br>" ;
				$QUERY_Mod = mysqli_query($link , $modSQL) ;
				
				// 有資料時執行
				if ( mysqli_num_rows($QUERY_Mod) )
				{	$LIST = mysqli_fetch_assoc($QUERY_Mod) ;	}
				showForm( $LIST , "SHOW" );
			}
			//~@_@~// E N D 秀出資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			//~@_@~// START 上下架資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			elseif ( $Funct == "ON" OR $Funct == "DOWN")
			{
				$_POST['SELECT_ID'] ? $SELECT_ID = $_POST['SELECT_ID'] : $SELECT_ID = $_GET['SELECT_ID'] ;
				//print_r($SELECT_ID);
				// 讀取發表資料
				if ( $Funct == "ON" )
				{
					$SystemUser_on = "1" ;
					$SystemUser_on_str = $array_On[$SystemUser_on] ;
				}
				else
				{
					$SystemUser_on = "0" ;
					$SystemUser_on_str = $array_On[$SystemUser_on] ;
				}
			
				// 求出所傳入要從資料庫中刪除的個數
				$COUNT_SELECT_ID = sizeof($SELECT_ID) ;
			
				//~@_@~// START 是否有要集體刪除的動作 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
				if( $COUNT_SELECT_ID )
				{
					// 清空資料
					$HAS_DATA = 0 ;
					$TEMP_ID_DATA = "" ;
			
					// 把所有勾選的選項加入SQL中
					for( $FOR_COUNT = 0 ; $FOR_COUNT < $COUNT_SELECT_ID ; $FOR_COUNT++ )
					{
						// 判斷是否已加過資料,已有資料就先加入,再加入新資料
						if( $HAS_DATA )
						{    $TEMP_ID_DATA = $TEMP_ID_DATA . " OR " ;    }
						else
						{    $HAS_DATA = 1 ;    }
			
						// 加入資料
						$TEMP_ID_DATA = $TEMP_ID_DATA . "$MAIN_CHECK_FIELD = '$SELECT_ID[$FOR_COUNT]'" ;
					}
				}
				//echo "$TEMP_ID_DATA" ;
			
				//~@_@~// END 是否有要集體刪除的動作 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			
				// 設定所要秀改資料的SQL字串(正常下是不修改System_LevelP_ID)7
				$SQL = "UPDATE $MAIN_DATABASE_NAME SET
				SystemUser_On = '$SystemUser_on'
				WHERE $TEMP_ID_DATA" ;
				//echo "$SQL<br>" ;
			
				if ( mysqli_query($link , $SQL) )
				{
					alertgo( "$SystemUser_on_str 資料修改完成" , $MAIN_FILE_NAME ) ;
				}
				else
				{
					$errMsg = "$SystemUser_on_str 修改資料失敗!!" ;
				}
			}
			//~@_@~// E N D 上下架資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
			//~@_@~// START 列表資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			else
			{
				echo "<form action=\"$MAIN_FILE_NAME\" method=\"post\" name=\"searchform\" id=\"searchform\" class=\"form-inline\" style=\"margin:10px;\">\n";
				echo "    <div class=\"row\">\n";
				echo "        <div class=\"col-lg-12\">\n";
				echo "		      <div class=\"form-group\">\n";
				echo "            <label>查詢欄位</label>\n";
				echo "            <select name=\"SEARCH_FIELD\" class=\"form-control\">\n";
				foreach ( $array_Search_Field as $key => $value )
				{	echo "            <option value=\"$key\">$value</option>" ;	}
				echo "           </select>\n";
				echo "           </div>\n";
		
				echo "<div class=\"form-group\">\n";
				echo "<label>關鍵字</label>\n";
				echo "    <input name=\"SEARCH_KEY\" id=\"SEARCH_KEY\" class=\"form-control\">\n";
				echo "</div>\n";
				echo "<button type=\"submit\" class=\"btn btn-default\">搜尋</button>\n";

				if( sizeof($array_subType) )
				{
					if ( $SEARCH_FIELD == "" AND $SEARCH_KEY == "" )
					{	$tmp_BtnClass = " btn-danger" ;	}
					else
					{	$tmp_BtnClass = " btn-success" ;	}
					echo "<a href='$MAIN_FILE_NAME' class='btn $tmp_BtnClass'>全部</a> " ;
	
					foreach ( $array_subType as $key => $value )
					{
						// 分析字串
						$split_subType = explode("||" , $value );
						// 找出查項目的值-SEARCH_FIELD=QA_On&SEARCH_KEY=0
						$split_Para = preg_split("/[=&]+/", $split_subType[1]);
						
						// 設定查詢按鈕顏色
						if ( $SEARCH_FIELD == $split_Para[1] AND $SEARCH_KEY == $split_Para[3] )
						{	$tmp_BtnClass = " btn-danger" ;	}
						else
						{	$tmp_BtnClass = " btn-success" ;	}
	
						echo "<a href='$MAIN_FILE_NAME?" . $split_subType[1] . "' class='btn $tmp_BtnClass'>" . $split_subType[0] . "</a> " ;
					}
				}
				echo "</form>\n";

				// 設定每頁筆數
				$row = $PUBLIC_DB_PAGE_NUM ;
				
				if ( $SEARCH_FIELD AND is_numeric($SEARCH_KEY))
				{	$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $SEARCH_FIELD Like '%" . (int)$SEARCH_KEY . "%' OR $SEARCH_FIELD LIKE '$SEARCH_KEY%' ORDER BY SystemUser_Sort , $MAIN_CHECK_FIELD DESC";	}
				elseif ( $SEARCH_FIELD AND $SEARCH_KEY)
				{	$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE $SEARCH_FIELD LIKE '%$SEARCH_KEY%' ORDER BY SystemUser_Sort , $MAIN_CHECK_FIELD DESC";	}
				else
				{	$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME ORDER BY SystemUser_Sort , $MAIN_CHECK_FIELD DESC";	}
				//echo "$countSQL<br>" ;

				// 找出總筆數
				$result = mysqli_query($link , $countSQL);  
				//查詢時返回查詢到數據行數：mysqli_num_rows
				$total = mysqli_num_rows($result);
				$totalpage = ceil( $total / $PUBLIC_DB_PAGE_NUM );	// 取得總頁數
				include_once($MAIN_BASE_ADDRESS . "includes/database/database_page.php");		// 計算資料庫筆數
				$start = ($page-1) * $row;

				echo "<form action=\"\" method=\"post\" name=\"form_list\" id=\"form_list\">\n";
				echo "<input type=\"hidden\" name=\"Funct\" value=\"DELOK\">\n";
				echo "<input type=\"hidden\" name=\"CHECKBOX_TYPE\" value=\"1\">\n";
				echo "\n";
	
				echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\n";
				echo "<tr>\n";
				echo "    <td align=\"left\">\n";
				echo "    <input type=button name=\"Submit2\" value=\"全部選取\" onclick='chkall(\"form_list\")' class=\"btn btn-default\">\n";
				//echo "    <input type=\"button\" name=\"Submit2\" value=\"垃圾桶\" onclick=\"return chk_Conf_Checkbox('form_list','GARBAGE_SET')\" class=\"btn btn-default\">\n";
				echo "    <input type=\"button\" name=\"Submit2\" value=\"" . $array_On[1] ."\" onclick=\"return chk_Conf_Checkbox('form_list','ON')\" class=\"btn btn-default\">\n";
				echo "    <input type=\"button\" name=\"Submit2\" value=\"" . $array_On[0] ."\" onclick=\"return chk_Conf_Checkbox('form_list','DOWN')\" class=\"btn btn-default\">\n";
				//echo "    <input type=\"button\" name=\"Submit2\" value=\"刪除\" onclick=\"return chk_Conf_Checkbox('form_list','DELOK')\" class=\"btn btn-default\">\n";
				echo "    </td>\n";
				echo "</tr>\n";
				echo "</table>\n";
	
				echo "<table class=\"table table-striped table-bordered table-hover\">\n";
				echo "<thead>\n";
				echo "<tr>\n";
				echo "    <th>#</th>\n";
				// 列表Title
				echo "    <th>縣市名稱/th>\n";
				echo "    <th>縣市ID/th>\n";
				echo "    <th>主標題/th>\n";
				echo "    <th>副標題/th>\n";
				echo "    <th>圖片/th>\n";
				echo "    <th>排序(由小到大排序)/th>\n";

				echo "    <th>發表狀態</th>\n";
				echo "    <th>修改</th>\n";
				echo "    <th>刪除</th>\n";
				echo "</tr>\n";
				echo "</thead>\n";
				echo "<tbody>\n";
				echo "\n";
	
				$sql = $countSQL . " LIMIT $start , $row";
				//echo "$sql" ;
				
				$query = mysqli_query($link , $sql) ;
				while( $LIST = mysqli_fetch_assoc($query))
				{		  
					echo "<tr>\n";
					echo "    <td><input type=\"checkbox\" name=\"SELECT_ID[]\" value=\"" . $LIST[$MAIN_CHECK_FIELD] . "\">" . $LIST[$MAIN_CHECK_FIELD] . "</td>\n";

					// 列表內容
					echo "    <td><a href=\"?Funct=SHOW&ID=" . $LIST[$MAIN_CHECK_FIELD] . "\">" . $LIST["City_Name"] . "</a></td>\n";
					echo "    <td>" . $LIST["City_ID"] . "</td>\n";
					echo "    <td>" . $LIST["City_Title"] . "</td>\n";
					echo "    <td>" . $LIST["City_SubTitle"] . "</td>\n";
					echo "    <td>" . $LIST["City_Pict"] . "</td>\n";
					echo "    <td>" . (int)$LIST["City_Sort"] . "</td>\n";

					// 功能啟用
					echo "    <td><span class=\"" . $array_On_Label[(int)$LIST[$MAIN_DATABASE_NAME . "_On"]] . "\">" . $array_On[(int)$LIST[$MAIN_DATABASE_NAME . "_On"]] . "</span></td>\n";

					echo "    <td>\n";
					// 是否為跳出視窗
					if ( $MAIN_SHOWTYPE == "POP" )
					{	echo "    <input type=\"button\" value=\"修改\" class='btn btn-default' onclick=\"openWin('$MAIN_FILE_NAME?Funct=MOD&SHOWTYPE=$MAIN_SHOWTYPE&ID=" . $LIST[$MAIN_CHECK_FIELD]. "');\" /></td>\n" ;	}
					else
					{	echo "    <a href=\"$MAIN_FILE_NAME?Funct=MOD&ID=" . $LIST[$MAIN_CHECK_FIELD] . "\" class=\"btn btn-default\">修改</a>\n" ;	}
					echo "    </td>\n" ;
					echo "    <td>\n" ;
					
					// 是否為跳出視窗
					if ( $MAIN_DELCHECK )
					{	echo "    <a href=\"$MAIN_FILE_NAME?Funct=DELOK&ID=" . $LIST[$MAIN_CHECK_FIELD] . "\" class=\"btn btn-default\" onclick=\"return isok(this,'是否要刪除資料')\">刪除</a>\n" ;	}
					elseif ( $MAIN_SHOWTYPE == "POP" )
					{	echo "    <input type=\"button\" value=\"刪除\" class='btn btn-default' onclick=\"openWin('$MAIN_FILE_NAME?Funct=DEL&SHOWTYPE=$MAIN_SHOWTYPE&ID=" . $LIST[$MAIN_CHECK_FIELD] . "');\" />\n" ;	}
					else
					{	echo "    <a href=\"$MAIN_FILE_NAME?Funct=DEL&ID=" . $LIST[$MAIN_CHECK_FIELD] . "\" class=\"btn btn-default\">刪除</a>\n" ;	}
					echo "    </td>\n" ;
					echo "</tr>\n" ;
				}
				echo "</tbody>\n" ;
				echo "</table>\n" ;
				echo "</form>\n";
				if( $total )
				{
					include_once("../includes/database/database_page_item.php");
					include_once("../includes/database/database_page_button.php");
				}
				else
				{
					echo "<p class='yldu_font18 text-center'>沒有找到相關資料</p>" ;
				}
			}
			//~@_@~// E N D 列表資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

			?>
			  </div>
			  </div>
			  <div>

            <div class="row">
                <div class="col-lg-12">
				
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                </div>
            </div>

            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>

		<?php
        // 回上一頁
        if( $MAIN_FILE_NAME != "index.php" )
        {
            showBackListButton() ;	// 秀出上一頁和回列表按鈕
        }
        ?>
<?php include_once("admin_footer.php") ; ?>

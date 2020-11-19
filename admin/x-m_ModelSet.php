<?php
// ############ ########## ########## ############
// ## 設定基本變數								##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "管理者系統" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "admin/" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "ModelSet" ;		// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "m_ModelSet.php" ;			// 設定本程式的檔名
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
include_once($MAIN_BASE_ADDRESS . "includes/func_wostory.php");

// 限制後台存取頁面(System_User)
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
$array_Funct[0] = "選購功能";
$array_Funct[1] = "基本功能";

// 功能啟用顏色
$array_Funct_Label[0] = "label label-warning btn_color0";
$array_Funct_Label[1] = "label label-info btn_color1";

// 表單功能設定
$array_Funct_Txet["ADDOK"] = "新增資料" ;
$array_Funct_Txet["MODOK"] = "修改資料" ;
$array_Funct_Txet["DELOK"] = "刪除資料" ;

// 設定查詢欄位
$array_Search_Field['ModelSet_Name'] = "參數名稱" ;
$array_Search_Field['ModelSet_Key'] = "參數關鍵字" ;
$array_Search_Field['ModelSet_Value'] = "參數功能字" ;
$array_Search_Field['ModelSet_Group'] = "參數群組名" ;
$array_Search_Field['ModelSet_Content'] = "參數說明" ;

// 設定子類別選項
$array_subType[] = "開啟||SEARCH_FIELD=ModelSet_Value&SEARCH_KEY=1" ;
$array_subType[] = "停用||SEARCH_FIELD=ModelSet_Value&SEARCH_KEY=0" ;

// 性別
$array_ModelSet_Sex['M'] = "男" ;
$array_ModelSet_Sex['F'] = "女" ;

// 參數功能字
$array_ModelSet_Value[0] = "不使用" ;
$array_ModelSet_Value[1] = "使用" ;

// 功能啟用設定
$array_On[0] = "停用";
$array_On[1] = "開啟";

// 按鈕顏色
$array_On_Label[0] = "label label-warning";
$array_On_Label[1] = "label label-info";

include($MAIN_BASE_ADDRESS . "includes/array/Array_City.inc") ;        // 載入城市資料

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
	$ARRAY_POST_GET_PARA1[] = "ModelSet_Name||*||ADD||MOD||-" ;	// 參數名稱
	$ARRAY_POST_GET_PARA1[] = "ModelSet_Key||*||ADD||MOD||-" ;	// 參數關鍵字
	$ARRAY_POST_GET_PARA1[] = "ModelSet_Value||*||ADD||MOD||-" ;	// 參數功能字
	$ARRAY_POST_GET_PARA1[] = "ModelSet_Group||*||ADD||MOD||-" ;	// 參數群組名
	$ARRAY_POST_GET_PARA1[] = "ModelSet_Content||*||ADD||MOD||-" ;	// 參數說明

	$ARRAY_POST_GET_PARA1[] = "ModelSet_Sort||*||ADD||MOD||INT" ;	// 排序
//	$ARRAY_POST_GET_PARA1[] = "ModelSet_PutTop||*||ADD||MOD||INT" ;	// 置頂
	$ARRAY_POST_GET_PARA1[] = "ModelSet_On||*||-||MOD||INT" ;

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
	global $array_ModelSet_Sex ;
	global $Array_City ;
	global $Array_Week ;
	global $array_ModelSet_Value ;
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
			echo "    <label>模組名稱</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"ModelSet_Name\" id=\"ModelSet_Name\" class=\"form-control\" value=\"" . $subLIST['ModelSet_Name'] . "\" required>\n";	}
			else
			{	echo $subLIST['ModelSet_Name'] . "\n";	}
			echo "</div>\n";
			
			echo "<div class=\"form-group\">\n";
			echo "    <label>模組關鍵字</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"ModelSet_Key\" id=\"ModelSet_Key\" class=\"form-control\" value=\"" . $subLIST['ModelSet_Key'] . "\" required>\n";	}
			else
			{	echo $subLIST['ModelSet_Key'] . "\n";	}
			echo "</div>\n";
			
//			echo "<div class=\"form-group\">\n";
//			echo "<label>模組功能</label>\n";
//			if ( $subFUNCT != "SHOW")
//			{
//				echo "<select name=\"ModelSet_Value\" class=\"form-control\">\n";
//				foreach( $array_ModelSet_Value as $key => $value )
//				{
//					if ( $key == $subLIST['ModelSet_Value'] )
//					{	echo "<option value=\"$key\" selected>$value</option>\n";	}
//					else
//					{	echo "<option value=\"$key\">$value</option>\n";	}
//				}
//				echo "</select>\n";
//			}
//			else
//			{	echo $Array_City[$subLIST['ModelSet_Value']] . "\n";	}
//			echo "</div>\n";
			
			echo "<div class=\"form-group\">\n";
			echo "    <label>模組群組名</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"ModelSet_Group\" id=\"ModelSet_Group\" class=\"form-control\" value=\"Model\" readonly required>\n";	}
			else
			{	echo $subLIST['ModelSet_Group'] . "\n";	}
			echo "</div>\n";
			
			echo "<div class=\"form-group\">\n";
			echo "    <label>排序(由小到大排序)</label>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<input type=\"text\" name=\"ModelSet_Sort\" id=\"ModelSet_Sort\" class=\"form-control\" value=\"" . $subLIST['ModelSet_Sort'] . "\" required>\n";	}
			else
			{	echo $subLIST['ModelSet_Sort'] . "\n";	}
			echo "</div>\n";

			echo "<div class=\"form-group\">\n";
			echo "    <label>模組說明</label><br>\n";
			if ( $subFUNCT != "SHOW" )
			{	echo "<textarea id=\"ModelSet_Content\" name=\"ModelSet_Content\" cols=100 rows=10>" . $subLIST['ModelSet_Content'] . "</textarea>\n";	}
			else
			{	echo nl2br($subLIST['ModelSet_Content']) . "\n";	}
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
			echo "<label>模組功能</label>\n";
			if ( $subFUNCT != "SHOW" AND $subLIST['ModelSet_On'] != 1 )
			{
				echo "<input type=\"radio\" name=\"ModelSet_Value\" id=\"ModelSet_Value1\" value=\"1\"" . checksCheckBox($subLIST['ModelSet_Value'], 1) . "><label for=\"ModelSet_Value1\">" . $array_On[1] . "</label>\n";
				echo "<input type=\"radio\" name=\"ModelSet_Value\" id=\"ModelSet_Value0\" value=\"0\"" . checksCheckBox($subLIST['ModelSet_Value'], 0) . "><label for=\"ModelSet_Value0\">" . $array_On[0] . "</label>\n";
			}
			else
			{
				echo $array_On[(int)$subLIST['ModelSet_Value']] . "\n";
				echo "<input type=\"hidden\" name=\"ModelSet_Value\" id=\"ModelSet_Value\" value=\"1\">\n";
				echo "<input type=\"hidden\" name=\"ModelSet_On\" id=\"ModelSet_On\" value=\"1\">\n";
			}
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
                    <h1 class="page-header"><a href="<?php echo $MAIN_FILE_NAME?>"><?php echo $Conn_Website_Name . "-" .  $MAIN_PROGRAM_TITLE?></a><a href="<?php echo $MAIN_FILE_NAME?>?Funct=ADD" class="btn btn-primary" style='float:right;'>新增</a></h1>
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
			
				// 密碼設定OK
				if ( $errMsg == "" )
				{
					// 加入秀出時間
					$tmpSQL .= " ModelSet_Add_DT = '" . $MAIN_NOW_TIME . "' , " ;
			
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
				
				if ( $ModelSet_Login_Passwd1 == "" )
				{	}
				elseif ( $ModelSet_Login_Passwd1 != $ModelSet_Login_Passwd2 )
				{	$errMsg = "兩個密碼不相同,請重新設定..." ;	}
				else
				{
					if ( strlen($ModelSet_Login_Passwd1) < 6 OR strlen($ModelSet_Login_Passwd1) > 12 )
					{	$errMsg = "密碼長度為6-12,請重新設定..." ;	}
					else
					{	$tmpSQL .= " ModelSet_Login_Passwd = '" . crypt($ModelSet_Login_Passwd1 , $ModelSet_Login_Name). "' , " ;	}
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
				//echo "$SQL_ModelSet<br>" ;
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
					$ModelSet_on = "1" ;
					$ModelSet_on_str = $array_On[$ModelSet_on] ;
				}
				else
				{
					$ModelSet_on = "0" ;
					$ModelSet_on_str = $array_On[$ModelSet_on] ;
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
				ModelSet_Value = '$ModelSet_on'
				WHERE $TEMP_ID_DATA" ;
				//echo "$SQL<br>" ;
			
				if ( mysqli_query($link , $SQL) )
				{
					alertgo( "$ModelSet_on_str 資料修改完成" , $MAIN_FILE_NAME ) ;
				}
				else
				{
					$errMsg = "$ModelSet_on_str 修改資料失敗!!" ;
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

				$PUBLIC_DB_PAGE_NUM = 100;
				// 設定每頁筆數
				$row = $PUBLIC_DB_PAGE_NUM ;
				
				if ( $SEARCH_FIELD AND is_numeric($SEARCH_KEY))
				{	$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE ModelSet_Group = 'Model' AND $SEARCH_FIELD Like '%" . (int)$SEARCH_KEY . "%' OR $SEARCH_FIELD LIKE '$SEARCH_KEY%' ORDER BY ModelSet_Sort, $MAIN_CHECK_FIELD DESC";	}
				elseif ( $SEARCH_FIELD AND $SEARCH_KEY)
				{	$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE ModelSet_Group = 'Model' AND $SEARCH_FIELD LIKE '%$SEARCH_KEY%' ORDER BY ModelSet_Sort, $MAIN_CHECK_FIELD DESC";	}
				else
				{	$countSQL = "SELECT * FROM $MAIN_DATABASE_NAME WHERE ModelSet_Group = 'Model' ORDER BY ModelSet_Sort, $MAIN_CHECK_FIELD DESC";	}
				//echo "$countSQL<br>" ;

				// 找出總筆數
				$result = mysqli_query($link , $countSQL);  
				//查詢時返回查詢到數據行數：mysqli_num_rows
				$total = mysqli_num_rows($result);
				$totalpage = ceil( $total / $PUBLIC_DB_PAGE_NUM );	// 取得總頁數
				include_once("../includes/database/database_page.php");		// 計算資料庫筆數
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

				echo "    <th>參數名稱</th>\n";
				echo "    <th>參數關鍵字</th>\n";
				echo "    <th>模組啟用</th>\n";
				echo "    <th>模組群組名</th>\n";

				echo "    <th>排序</th>\n";

				echo "    <th>模組模式</th>\n";
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
					// 是否為內定模組
					if( $LIST['ModelSet_On'] )
					{	echo "    <td>" . $LIST[$MAIN_CHECK_FIELD] . "</td>\n";	}
					else
					{	echo "    <td><input type=\"checkbox\" name=\"SELECT_ID[]\" value=\"" . $LIST[$MAIN_CHECK_FIELD] . "\">" . $LIST[$MAIN_CHECK_FIELD] . "</td>\n";	}
					echo "    <td><a href=\"$MAIN_FILE_NAME?Funct=SHOW&ID=" . $LIST[$MAIN_CHECK_FIELD] . "\">" . $LIST["ModelSet_Name"] . "</a></td>\n";

					echo "    <td>" . $LIST["ModelSet_Key"] . "</td>\n";
					echo "    <td><span class=\"" . $array_On_Label[(int)$LIST["ModelSet_Value"]] . "\">" . $array_On[(int)$LIST["ModelSet_Value"]] . "</span></td>\n";
//					echo "    <td>" . $array_ModelSet_Value[(int)$LIST["ModelSet_Value"]] . "</td>\n";
					echo "    <td>" . $LIST["ModelSet_Group"] . "</td>\n";
					echo "    <td>" . (int)$LIST["ModelSet_Sort"] . "</td>\n";

//					echo "    <td>"
//					. $LIST["ModelSet_Login_Name"]
//					. "</td>\n";

					// 功能啟用
					echo "    <td><span class=\"" . $array_Funct_Label[(int)$LIST[$MAIN_DATABASE_NAME . "_On"]] . "\">" . $array_Funct[(int)$LIST[$MAIN_DATABASE_NAME . "_On"]] . "</span></td>\n";

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
//					include_once("../includes/database/database_page_item.php");
//					include_once("../includes/database/database_page_button.php");
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

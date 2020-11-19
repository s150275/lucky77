<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "清空資料庫" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "admin/" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "SystemUser" ;		// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "m_ClearDatabase.php" ;			// 設定本程式的檔名
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
include_once($MAIN_BASE_ADDRESS . "includes/bot.php");

checkSystemUser();

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;
$ARRAY_POST_GET_PARA[] = "PAGE||*" ;
$ARRAY_POST_GET_PARA[] = "DESC||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_FIELD||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_KEY||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

// 可以清空的資料庫
$arrayDatabaseType[0] = "店家基本" ;
$arrayDatabaseType[1] = "髮型模組" ;
$arrayDatabaseType[2] = "商城模組" ;
$arrayDatabaseType[3] = "互動專區" ;

// 店家基本
$array_Database[0]['Member'] = "會員資料";
$array_Database[0]['Stronghold'] = "據點資料";
$array_Database[0]['PointLog'] = "點數Log";
$array_Database[0]['QAType'] = "常見問題類別";
$array_Database[0]['QA'] = "常見問題資訊";
$array_Database[0]['Question'] = "問卷題目";
$array_Database[0]['Answer'] = "問卷答案";

// 髮型模組
$array_Database[1]['Designer'] = "設計師資料";
$array_Database[1]['DesignerWorks'] = "設計師作品";
$array_Database[1]['DesignerWD'] = "設計師上班日";
$array_Database[1]['DesignerScore'] = "評分系統";

// 商城模組
$array_Database[2]['GoodsType'] = "商品類別";
$array_Database[2]['Goods'] = "商品資訊";
$array_Database[2]['OrderInfo'] = "訂單管理";
$array_Database[2]['OrderGoods'] = "訂單商品資訊";

// 互動專區
$array_Database[3]['Contact'] = "官網留言";
$array_Database[3]['LineContact'] = "會員留言";
$array_Database[3]['ReserveInfo'] = "會員預約資訊";
$array_Database[3]['RedEnvelope'] = "紅包系統";
$array_Database[3]['RedEnvelopeList'] = "搶紅包名單";
$array_Database[3]['PushLog'] = "推播訊息";

include_once("admin_header.php") ;	// 快速請取網頁傳來的參數

// 會員點數歸0
if( $Funct == "Point2Zero" )
{
	$tmp_Database_Funct = "會員點數歸0" ;
	$modSQL_Member = "UPDATE Member SET Member_Points = '0'" ;
	//echo "$modSQL_Member<br>" ;
	if ( mysqli_query($link , $modSQL_Member) )
	{
		alertgo("會員點數歸0成功" , "$MAIN_FILE_NAME" , 1);
	}
	else
	{	echo $tmp_Database_Funct . "-修改失敗!!<br>" ;	}
}
// 設定店家內定密碼
elseif( $Funct == "StoreDefalutPasswd" )
{
	// 最得密碼
	$tmpStore_Login_Passwd = "" ;
	$tmp_Database_Funct = "設定店家內定密碼" ;
	$modSQL_Member = "UPDATE Store SET Store_Login_Passwd = '".crypt($Conn_Store_Code . "-line" , $Conn_Store_Code)."' WHERE id_Store = '1'" ;
	//echo "$modSQL_Member<br>" ;
	if ( mysqli_query($link , $modSQL_Member) )
	{
		alertgo("設定店家內定密碼成功" , "$MAIN_FILE_NAME" , 1);
	}
	else
	{	echo $tmp_Database_Funct . "-修改失敗!!<br>" ;	}
	
}
// 清空資料庫
elseif( $Funct == "ClearDatabase" )
{
	if( $_POST['ClearPasswd'] == "enil" )
	{
		$DatabaseName = $_POST['DatabaseName'];
		foreach($DatabaseName as $key => $value )
		{
			//print_r($DatabaseName);
			$clearSQL = "truncate table `" . $value . "`;" ;
			//echo "$clearSQL<br>" ;
			if ( mysqli_query($link , $clearSQL) )
			{
				//alertgo("清空資料庫成功" , "$MAIN_FILE_NAME" , 1);
			}
			else
			{	echo $tmp_Database_Funct . "-修改失敗!!<br>" ;	}
		}
	}
	else
	{
		alertgo("安全碼錯誤" , "$MAIN_FILE_NAME" , 1);
	}
	
}
else
{
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
                <div class="col-lg-12">
                    <h1 class="page-header"><a href="<?php echo $MAIN_FILE_NAME?>"><?php echo $MAIN_PROGRAM_TITLE?></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
					<?php
					echo "<form action=\"$MAIN_FILE_NAME\" method=\"post\" onsubmit=\"return isok(this,'是否要清空資料庫,清空後無法復原')\">\n";
					echo "<input type=\"hidden\" name=\"Funct\" value=\"ClearDatabase\">\n";
					echo "<table width=100%>\n";
					echo "\n";
					$tmpIndex = "D" ;
					foreach( $array_Database as $key => $value )
					{
						echo "<tr><td colspan='8' style='background-color:#D0FFD0;'>{$arrayDatabaseType[$key]}</td></tr>\n" ;
						foreach( $value as $key1 => $value1)
						{
							echo "<td><input type='checkbox' name='DatabaseName[]' value='$key1' style='width:18px;height:18px;'> $value1</td>\n";
						}
					}
					echo "<tr><td colspan='8'><input type='password' name='ClearPasswd' value='' placeholder=\"請輸入安全碼\"></td></tr>\n" ;
					echo "<tr><td colspan='8'><input type='submit' value='清空資料庫'></td></tr>\n" ;
                    echo "</table>\n" ;
					echo "</form>\n" ;
					?>
                </div>
            </div>

            <div class="row"><br>
                <div class="col-lg-12">
				<?php
				echo "<table width=100%>\n";
				echo "<tr><td style='background-color:#D0FFD0;'>設定特別參數</td></tr>\n";
				echo "<tr><td><a href='?Funct=Point2Zero' class=\"btn btn-primary\" onclick=\"return isok(this,'是否要會員點數歸0')\">會員點數歸0</a></td></tr>\n";
				echo "<tr><td><a href='?Funct=StoreDefalutPasswd' class=\"btn btn-primary\" onclick=\"return isok(this,'是否要設定店家內定密碼')\">設定店家內定密碼({$Conn_Store_Code}-line)</a></td></tr>\n";
				echo "</table>\n";
				echo "\n";
				?>
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
}
?>
<?php include_once("admin_footer.php") ; ?>
<script type="text/javascript">
// 開啟確認INPUT的網頁
function isok(form,tmpMsg)
{
	if (confirm(tmpMsg))
	{	return true;	}
	else
	{	return false;	}
}
</script>

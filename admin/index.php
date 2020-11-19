<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "管理首頁" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "admin/" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "SystemUser" ;		// 設定本程式所使用的基本資料庫
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
//include_once($MAIN_BASE_ADDRESS . "includes/bot.php");
//echo "<p>11</p>" ;print_r($_SESSION);echo "<br>" ;exit;
checkSystemUser();

//scandir('./');
//$handle=opendir('C:UserslinroexDropboxmusic');
//while(false!==($file=readdir($handle))){
//	echo $file . '';
//}
//
//closedir($handle);


//// 使用方法
//$Main_LockNum = 10 ;		// 封鎖失敗次數
//$Main_UnlockTime = 10 ;		// 解禁時間(分鐘)
//
//$tmpFailedNum = func_checkLoginLock( $_SERVER['REMOTE_ADDR'] ,$Main_UnlockTime ) ;
//
//// 查詢登入失敗次數
//if( $tmpFailedNum >= $Main_LockNum )
//{
//	echo "登入失敗" . $tmpFailedNum . "次,已被封鎖,請耐心等" . $Main_UnlockTime . "分鐘後再重新登入或由Mail去解鎖" ;
//}
//else
//{
//	echo "<p>開始登入動作</p>" ;
//	// 登入失敗執行設定登入管制次數
//	$tmpNum = func_checkLoginControl( $_SERVER['REMOTE_ADDR']  , "yldu" , $Main_LockNum , $Main_UnlockTime ) ;	// 設定登入管制次數
//	echo "<p>登入失敗次數 : $tmpNum</p>" ;
//}

//$tmpNum = func_checkLoginLock( $_SERVER['REMOTE_ADDR'] , 10 ) ;	// 查詢登入失敗次數
//echo "登入失敗次數 : $tmpNum" ;
//
//$tmpNum = func_checkLoginControl( $_SERVER['REMOTE_ADDR']  , "yldu" , 10 , 10 ) ;	// 設定登入管制次數
//echo "登入失敗次數 : $tmpNum" ;

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

$ARRAY_POST_GET_PARA[] = "FUNCT||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;
$ARRAY_POST_GET_PARA[] = "PAGE||*" ;
$ARRAY_POST_GET_PARA[] = "DESC||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_FIELD||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_KEY||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

include_once("admin_header.php") ;	// 快速請取網頁傳來的參數

//// 會員總人數 :
//$tmpMember_Count = getMember_Count("A") ;
//// 本年加入人數
//$tmpMember_Year_Count = getMember_Count("Y") ;
//// 本月加入人數
//$tmpMember_Month_Count = getMember_Count("M") ;
//// 本星期加入人數
//$tmpMember_Week_Count = getMember_Count("W") ;
//// 本日加入人數
//$tmpMember_Day_Count = getMember_Count("D") ;
//
//// 聊聊總人數 :
//$tmpChat_Count = getChat_Count("A") ;
//// 聊聊本年使用人數
//$tmpChat_Year_Count = getChat_Count("Y") ;
//// 聊聊本月使用人數
//$tmpChat_Month_Count = getChat_Count("M") ;
//// 聊聊本星期使用人數
//$tmpChat_Week_Count = getChat_Count("W") ;
//// 聊聊本日使用人數
//$tmpChat_Day_Count = getChat_Count("D") ;
//
//// 聊聊使用次數統計
//$arrayChat_Count = getChat_UseCount() ;
//print_r($arrayChat_Count);
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
					 <a href="../Store/Store_Login.php?FUNCT=LOGIN&Login_Name=<?php echo $Conn_Store_Code?>" class='btn btn-primary' target=\"_blank\">登入店家後台</a>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!--div class="row">
                <div class="col-lg-12">
                	<table width=100%>
                    <tr><td colspan="5">會員資訊</td></tr>
                    <tr>
                    	<td>總人數( <span class="yldu_color_red"><?php echo $tmpMember_Count; ?></span> )</td>
                    	<td>本年加入人數( <span class="yldu_color_red"><?php echo $tmpMember_Year_Count; ?></span> )</td>
                        <td>本月加入人數( <span class="yldu_color_red"><?php echo $tmpMember_Month_Count; ?></span> )</td>
                        <td>本星期加入人數( <span class="yldu_color_red"><?php echo $tmpMember_Week_Count; ?></span> )</td>
                        <td>本日加入人數( <span class="yldu_color_red"><?php echo $tmpMember_Day_Count; ?></span> )</td>
                    </tr>
                    <tr><td colspan="5">聊聊資訊</td></tr>
                    <tr>
                    	<td>配對成功次數( <span class="yldu_color_red"><?php echo $tmpChat_Count; ?></span> )</td>
                    	<td>本年配對成功次數( <span class="yldu_color_red"><?php echo $tmpChat_Year_Count; ?></span> )</td>
                        <td>本月配對成功次數( <span class="yldu_color_red"><?php echo $tmpChat_Month_Count; ?></span> )</td>
                        <td>本星期配對成功次數( <span class="yldu_color_red"><?php echo $tmpChat_Week_Count; ?></span> )</td>
                        <td>本日配對成功次數( <span class="yldu_color_red"><?php echo $tmpChat_Day_Count; ?></span> )</td>
                    </tr>
                    </table>
                </div>
            </div-->

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

<?php include_once("admin_footer.php") ; ?>

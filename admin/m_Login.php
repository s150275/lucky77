<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "後台登入" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "admin/" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "index" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "m_Login.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期
$MAIN_Funct		    = "Admin_Login" ;		// Funct設定-login_hash.php用

// ############ ########## ########## ############
// ## 載入模組									##
// ############ ########## ########## ############
include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
//include_once($MAIN_BASE_ADDRESS . "includes/bot.php");
//include_once($MAIN_BASE_ADDRESS . "includes/public_db.func") ;
//include_once($MAIN_BASE_ADDRESS . "includes/public_db.var") ;
//include_once($MAIN_BASE_ADDRESS . "includes/public_main.func") ;
//include_once($MAIN_BASE_ADDRESS . "includes/public_main.var") ;
//include_once($MAIN_BASE_ADDRESS . "includes/public_form.var") ;

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

$ARRAY_POST_GET_PARA[] = "FUNCT||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;
$ARRAY_POST_GET_PARA[] = "PAGE||*" ;
$ARRAY_POST_GET_PARA[] = "DESC||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_FIELD||*" ;
$ARRAY_POST_GET_PARA[] = "SEARCH_KEY||*" ;
$ARRAY_POST_GET_PARA[] = "Login_Name||*" ;
$ARRAY_POST_GET_PARA[] = "Login_Passwd||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

include_once("admin_header.php") ;	// 快速請取網頁傳來的參數

include_once($MAIN_BASE_ADDRESS . "admin/login_hash.php") ;

// 是否已登入後台
readySystemUserLogin();

//if( $_SESSION["SystemUser_ID"] )
//{	alertgo("","index.php");	}

if( $Login_Name != "" && $Login_Passwd != "" )
{
	$sql = "SELECT * FROM SystemUser WHERE SystemUser_Login_Name='$Login_Name' AND SystemUser_Login_Passwd = '".crypt($Login_Passwd , $Login_Name)."'";
	//echo "$sql" ;
	$query = mysqli_query($link , $sql) ;
	if(mysqli_num_rows($query) > 0)
	{
		$LIST = mysqli_fetch_assoc($query) ;
		if ( $LIST['SystemUser_On'] == 1 )
		{
			$_SESSION['Store_Name'] = $Conn_Website_Name;
			
			//存入SESSION
			$_SESSION['SystemUser_ID'] = $LIST['SystemUser_ID'];
			$_SESSION['SystemUser_Level'] = $LIST['SystemUser_Level'];

			alertgo("登入成功" , "index.php");
		}
		else
		{
			alertgo("管理權限已關閉,請連絡管理者" , "index.php");
		}
	}
	else
	{
		alertgo("登入失敗" , "m_Login.php");	
	}
}
?>

		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><a href="<?php echo $MAIN_FILE_NAME?>"><?php echo $MAIN_PROGRAM_TITLE?></a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<?php
// 登入
if ( $FUNCT == "LOGIN" )
{
}
else
{
?>
	<div class="row">
    <div class="col-md-6 col-md-offset-3">
    <h1>管理員登入</h1>
     <form action="m_Login.php" method="post" id="loginform" name="loginform" role="form">
      <input name="FUNCT" type="hidden" id="FUNCT" value="LOGIN">
      <div class="form-group">
        <label>帳號</label>
          <input name="Login_Name" type="text" class="form-control" id="m_mail">
      </div>
      <div class="form-group">
        <label>密碼</label>
        <input name="Login_Passwd" type="password" class="form-control" id="m_pd">
      </div>
        <button type="submit" class="btn btn-default">登入</button>
    </form>   
    </div>
    </div>


<?php } ?>

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

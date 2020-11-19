<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "系統參數設定" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "../" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "admin/" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "SystemSet" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "m_SystemSet.php" ;			// 設定本程式的檔名
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
checkSystemUser();

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
?>
<?php
// 秀出form資料
function showForm( $subLIST , $subFUNCT )
{
	global $MAIN_FILE_NAME ;
	global $MAIN_CHECK_FIELD ;
	global $errMsg ;
//	echo $subFUNCT;
?>
<script type="text/javascript">
// 檢驗證書1
function BrowseSystemSet_Certificate1()
{
    var finder = new CKFinder();	// 產生class
    finder.basePath = '../../';	// The path for the installation of CKFinder (default = "/ckfinder/").
    finder.selectActionFunction = SetFileFieldMediate1;
    finder.popup();
}
function SetFileFieldMediate1( fileUr1 )
{	document.getElementById( 'xSystemSet_Certificate1' ).value = fileUr1;	}


</script>
<script type="text/javascript" src="../ckfinder/ckfinder.js"></script>
<?php

?>
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading"> 新增 </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <form action="<?php echo $MAIN_FILE_NAME?>" method="post" id="insertform" name="insertform" role="form" Enctype="multipart/form-data">
            <input name="FUNCT" type="hidden" id="FUNCT" value="<?php echo $subFUNCT ?>">
            <input name="ID" type="hidden" id="ID" value="<?php echo $subLIST['id_SystemSet'] ?>">
			<?php if ( $errMsg ){ //?>
                <div class="form-group">
                    <p style="color:#f00;font-size:16px;text-align:center;"><?php echo $errMsg ?></p>
                </div>
            <?php } ?>
                <div class="form-group">
                    <label>主機送信Email</label>
                    <?php if ( $subFUNCT != "SHOW" ) {?>
	                    <input type="email" name="SystemSet_SentMail" id="SystemSet_SentMail" class="form-control" value="<?php echo $subLIST['SystemSet_SentMail']?>" required>
                    <?php }else{?>
                    	<?php echo $subLIST['SystemSet_SentMail'] ?>
                    <?php }?>
                </div>
                
                <div class="form-group">
                    <label>管理者Email1</label>
                    <?php if ( $subFUNCT != "SHOW" ) {?>
	                    <input type="email" name="SystemSet_Admin_Mail1" id="SystemSet_Admin_Mail1" class="form-control" value="<?php echo $subLIST['SystemSet_Admin_Mail1']?>" required>
                    <?php }else{?>
                    	<?php echo $subLIST['SystemSet_Admin_Mail1']?>
                    <?php }?>
                </div>
                
                <div class="form-group">
                    <label>管理者Email2</label>
                    <?php if ( $subFUNCT != "SHOW" ) {?>
	                    <input type="email" name="SystemSet_Admin_Mail2" id="SystemSet_Admin_Mail2" class="form-control" value="<?php echo $subLIST['SystemSet_Admin_Mail2']?>">
                    <?php }else{?>
                    	<?php echo $subLIST['SystemSet_Admin_Mail2']?>
                    <?php }?>
                </div>

                <div class="form-group">
                    <label>管理者Email3</label>
                    <?php if ( $subFUNCT != "SHOW" ) {?>
	                    <input type="email" name="SystemSet_Admin_Mail3" id="SystemSet_Admin_Mail3" class="form-control" value="<?php echo $subLIST['SystemSet_Admin_Mail3']?>">
                    <?php }else{?>
                    	<?php echo $subLIST['SystemSet_Admin_Mail3']?>
                    <?php }?>
                </div>

                <div class="form-group">
                    <label>管理者Line內部ID1</label>
                    <?php if ( $subFUNCT != "SHOW" ) {?>
	                    <input type="text" name="SystemSet_Admin_ID1" id="SystemSet_Admin_ID1" class="form-control" value="<?php echo $subLIST['SystemSet_Admin_ID1']?>">
                    <?php }else{?>
                    	<?php echo $subLIST['SystemSet_Admin_ID1']?>
                    <?php }?>
                </div>

                <div class="form-group">
                    <label>管理者Line內部ID2</label>
                    <?php if ( $subFUNCT != "SHOW" ) {?>
	                    <input type="text" name="SystemSet_Admin_ID2" id="SystemSet_Admin_ID2" class="form-control" value="<?php echo $subLIST['SystemSet_Admin_ID2']?>">
                    <?php }else{?>
                    	<?php echo $subLIST['SystemSet_Admin_ID2']?>
                    <?php }?>
                </div>

                <div class="form-group">
                    <label>管理者Line內部ID3</label>
                    <?php if ( $subFUNCT != "SHOW" ) {?>
	                    <input type="text" name="SystemSet_Admin_ID3" id="SystemSet_Admin_ID3" class="form-control" value="<?php echo $subLIST['SystemSet_Admin_ID3']?>">
                    <?php }else{?>
                    	<?php echo $subLIST['SystemSet_Admin_ID13']?>
                    <?php }?>
                </div>

                <div class="form-group">
                    <label>關鍵字</label>
                    <?php if ( $subFUNCT != "SHOW" ) {?>
	                    <input type="text" name="SystemSet_Keywords" id="SystemSet_Keywords" class="form-control" value="<?php echo $subLIST['SystemSet_Keywords']?>" required>
                    <?php }else{?>
                    	<?php echo $subLIST['SystemSet_Keywords']?>
                    <?php }?>
                </div>

                <div class="form-group">
                    <label>描述</label>
                    <?php if ( $subFUNCT != "SHOW" ) {?>
	                    <input type="text" name="SystemSet_Description" id="SystemSet_Description" class="form-control" value="<?php echo $subLIST['SystemSet_Description']?>" required>
                    <?php }else{?>
                    	<?php echo $subLIST['SystemSet_Description']?>
                    <?php }?>
                </div>


                <?php if ( $subFUNCT != "SHOW") {?>
	                <button type="submit" class="btn btn-default">送出</button>
	                <button type="reset" class="btn btn-default">重設</button>
                <?php }else{?>
	                <a href="<?php echo $MAIN_FILE_NAME ?>?FUNCT=MOD" class="btn btn-default">修改</a>
                <?php }?>
                
            </form>
          <div></div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
<?php
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
if ( $FUNCT == "MODOK" )
{
	$ARRAY_POST_GET_PARA1[] = "SystemSet_SentMail||*" ;
	$ARRAY_POST_GET_PARA1[] = "SystemSet_Admin_Mail1||*" ;
	$ARRAY_POST_GET_PARA1[] = "SystemSet_Admin_Mail2||*" ;
	$ARRAY_POST_GET_PARA1[] = "SystemSet_Admin_Mail3||*" ;
	$ARRAY_POST_GET_PARA1[] = "SystemSet_Admin_ID1||*" ;
	$ARRAY_POST_GET_PARA1[] = "SystemSet_Admin_ID2||*" ;
	$ARRAY_POST_GET_PARA1[] = "SystemSet_Admin_ID3||*" ;

	$ARRAY_POST_GET_PARA1[] = "SystemSet_Keywords||*" ;
	$ARRAY_POST_GET_PARA1[] = "SystemSet_Description||*" ;

	sub_post_get($ARRAY_POST_GET_PARA1) ;

	$modSQL = "UPDATE SystemSet SET
	SystemSet_SentMail = '$SystemSet_SentMail' ,
	SystemSet_Admin_Mail1 = '$SystemSet_Admin_Mail1' ,
	SystemSet_Admin_Mail2 = '$SystemSet_Admin_Mail2' ,
	SystemSet_Admin_Mail3 = '$SystemSet_Admin_Mail3' ,
	SystemSet_Admin_ID1 = '$SystemSet_Admin_ID1' ,
	SystemSet_Admin_ID2 = '$SystemSet_Admin_ID2' ,
	SystemSet_Admin_ID3 = '$SystemSet_Admin_ID3' ,
	SystemSet_Keywords = '$SystemSet_Keywords' ,
	SystemSet_Description = '$SystemSet_Description'
	WHERE id_SystemSet = '1'" ;
//	echo "$modSQL" ;ylRl7wjs1vj/I

	if ( mysqli_query($link , $modSQL) )
	{
		alertgo( "資料修改完成" , "m_SystemSet.php" ) ;
	}
	else
	{
		echo "修改資料失敗!!" ;

	}
}
else
{
	$modSQL = "SELECT * FROM SystemSet WHERE id_SystemSet = '1'" ;
//	echo "$modSQL<br>" ;
	$QUERY_Mod = mysqli_query($link , $modSQL) ;
	
	// 有資料時執行
	if ( mysqli_num_rows($QUERY_Mod) )
	{
		// 找出一筆資料
		$LIST = mysqli_fetch_assoc($QUERY_Mod) ;
//		print_r();
	}
	showForm( $LIST , "MODOK" );
}
?>

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

<?php include_once("../../php/conn.php");?>
<?php
if(isset($_GET["p_id"]))
{
	$sql="SELECT * FROM product WHERE p_id='".$_GET["p_id"]."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query)>0)
	{
		$data=mysql_fetch_assoc($query);
	}
}
$classary="";
$classsql="SELECT * FROM proclass ORDER BY c_id DESC";
$classquery=mysql_query($classsql) or die(mysql_error());
while($classdata=mysql_fetch_assoc($classquery))
{
	$classary["c".$classdata["c_id"]]=$classdata["c_name"];
}
if($_POST['p_name']!='' && $_POST['modify']=='yes')
{
	$p_id        =  trim($_POST['p_id']);
	$p_name      =  trim($_POST['p_name']);
	$p_class     =  trim($_POST['p_class']);
	$p_price     =  trim($_POST['p_price']);
	$p_Stock     =  trim($_POST['p_Stock']);
	$p_content   =  trim($_POST['p_content']);
	$p_img       =  trim($_POST['oldPic']);
	if ($_FILES["p_img"]["error"]>0)
	{
		echo "Error:".$_FILES["file"]["error"];
	}
	else
	{
		unlink("../../imgFile/".$_POST['oldPic']);
		echo "檔案名稱: " .$_FILES["p_img"]["name"]."<br/>"; 
		echo "檔案類型: ".$_FILES["p_img"]["type"]."<br/>";
		echo "檔案大小: ".($_FILES["p_img"]["size"] / 1024)." Kb<br />";
		echo "暫存名稱: ".$_FILES["p_img"]["tmp_name"]; 
		move_uploaded_file($_FILES["p_img"]["tmp_name"],"../../imgFile/".$_FILES["p_img"]["name"]);//移動檔案
		$p_img=$_FILES["p_img"]["name"];		
	}
	$modifySQL="UPDATE product set
				p_name='$p_name',p_class='$p_class',
				p_price='$p_price',p_Stock='$p_Stock',
				p_img='$p_img',p_content='$p_content'
				WHERE p_id='$p_id'";
	if(mysql_query($modifySQL))
	{
		header("Location:product.php");	
	}
	else
	{
		echo "失敗";
	}
}
?>
<!DOCTYPE html>
<html lang="zh-hant-tw">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>管理後台</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

    <?php include_once("../temppage/head.php");?>       

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                  <h1 class="page-header">商品管理</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel panel-default">
                <div class="panel-heading"> 新增</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
    <form action="" method="post" enctype="multipart/form-data" name="insertform" id="insertform" role="form">
        <div class="form-group">
            <label>類別</label>
            <select class="form-control" id="p_class" name="p_class">
            <option value="<?php echo $data["p_class"];?>"><?php echo $classary["c".$data["p_class"]];?></option>
			<?php
              $csql="SELECT * FROM proclass ORDER BY c_id DESC";
              $cquery=mysql_query($csql);
              while($cdata=mysql_fetch_assoc($cquery))
              {
            ?>
                <option value="<?php echo $cdata["c_id"];?>"><?php echo $cdata["c_name"];?></option>
            <?php
              }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label>名稱</label>
            <input name="p_name" class="form-control" id="p_name" value="<?php echo $data["p_name"];?>">
        </div>
        <div class="form-group">
            <label>庫存</label>
            <input name="p_Stock" class="form-control" id="p_Stock" value="<?php echo $data["p_Stock"];?>">
        </div>
        <div class="form-group">
            <label>價格</label>
            <input name="p_price" class="form-control" id="p_price" value="<?php echo $data["p_price"];?>">
        </div> 
        <div>
        	<img src="../../imgFile/<?php echo $data["p_img"];?>" width="300"/>
        </div>
        <input type="hidden" name="oldPic" id="oldPic" value="<?php echo $data["p_img"];?>">
        <div class="form-group">
            <label>圖片</label>
            <input type="file" name="p_img" class="form-control" id="p_img">
        </div>                       
        <div class="form-group">
            <label>內容</label>
            <textarea name="p_content" id="p_content" class="form-control" rows="3"><?php echo $data["p_content"];?></textarea>
        </div>
        <button type="submit" class="btn btn-default">送出</button>
        <button type="reset" class="btn btn-default">重設</button>
        <input name="modify" type="hidden" id="modify" value="yes">
        <input type="hidden" name="p_id" id="p_id" value="<?php echo $data["p_id"];?>">

    </form>
  <div></div>
</div>
                <!-- /.panel-body -->
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>

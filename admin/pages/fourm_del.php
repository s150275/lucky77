<?php include_once("../../php/conn.php");?>
<?php
if($_POST['f_id']!='' && $_POST['delete']=='yes')
{
	$f_id        =  trim($_POST['f_id']);
	$DELETERESQL="DELETE FROM refourm WHERE f_id='$f_id'";
	mysql_query($DELETERESQL);
	$DELETESQL="DELETE FROM fourm WHERE f_id='$f_id'";
	if(mysql_query($DELETESQL))
	{
		header("Location:fourm.php");	
	}
	else
	{
		echo "失敗";
	}
}
if(isset($_GET["f_id"]))
{
	$sql="SELECT * FROM fourm WHERE f_id='".$_GET["f_id"]."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query)>0)
	{
		$data=mysql_fetch_assoc($query);
	}
	$resql="SELECT * FROM refourm WHERE f_id='".$_GET["f_id"]."'";
	$requery=mysql_query($resql);
	if(mysql_num_rows($requery)>0)
	{
		$redata=mysql_fetch_assoc($requery);
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
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel panel-default">
                <div class="panel-heading"> Kitchen Sink </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <form action="" method="post" id="showform" name="showform" role="form">
                      <div class="form-group">
                          <label>標題</label>
                          <input name="f_subject" disabled class="form-control" id="f_subject" value="<?php echo $data["f_subject"];?>">
                      </div>
                      <div class="form-group">
                          <label>時間</label>
                          <input name="f_time" disabled class="form-control" id="f_time" value="<?php echo $data["f_time"];?>">
                      </div>
                      <div class="form-group">
                          <label>內容</label>
                          <textarea name="f_content" rows="3" disabled class="form-control" id="f_content"><?php echo $data["f_content"];?></textarea>
                      </div>
                </form>
                <form action="fourm_del.php" method="post" id="insertform" name="insertform" role="form">
                      <fieldset>
                      <legend>回覆</legend>
                      <div class="form-group">
                        <label>時間</label>
                          <input name="r_time" class="form-control" id="r_time" value="<?php echo $redata["r_time"]?>" readonly>
                      </div>
                      <div class="form-group">
                          <label>內容</label>
                          <textarea name="r_content" id="r_content" class="form-control" rows="3"><?php echo $redata["r_content"]?></textarea>
                      </div>
                      <button type="submit" class="btn btn-default">送出</button>
                      <button type="reset" class="btn btn-default">重設</button>
                     <input name="delete" type="hidden" id="delete" value="yes">
                     <input name="f_id" type="hidden" id="f_id" value="<?php echo $data["f_id"];?>">
                     </fieldset>
                </form>
                  <div></div>
                  <!-- /.table-responsive -->
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

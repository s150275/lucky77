<?php include_once("../../php/conn.php");?>
<?php
if($_POST['m_id']!='' && $_POST['modify']=='yes')
{
	$m_id        =  trim($_POST['m_id']);
	$m_enable     =  trim($_POST['m_enable']);
	$modifySQL="UPDATE member set
				m_enable='$m_enable'
				WHERE m_id='$m_id'";
	if(mysql_query($modifySQL))
	{
		header("Location:member.php");	
	}
	else
	{
		echo "失敗";
	}
}
if($_GET['m_id']!='' && $_GET['delete']=='yes')
{
	$m_id        =  trim($_GET['m_id']);
	$DELETESQL="DELETE FROM member WHERE m_id='$m_id'";
	if(mysql_query($DELETESQL))
	{
		header("Location:member.php");	
	}
	else
	{
		echo "失敗";
	}
}
if(isset($_GET["m_id"]))
{
	$sql="SELECT * FROM member WHERE m_id='".$_GET["m_id"]."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query)>0)
	{
		$data=mysql_fetch_assoc($query);
	}
}
function checks($c,$v)
{
	if($c=="$v")
	{
		echo "selected";	
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
                    <h1 class="page-header">會員資料</h1>
                    <div style="margin-bottom:10px;">
                    <a href="javascript:history.back();" class="btn btn-default btn-lg">返回</a>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel panel-default">
                <div class="panel-heading"> 刪除 </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="table-responsive">
                    <form action="mdetail.php" method="post" id="insertform" name="insertform" role="form">
                        <div class="form-group">
                            <label>姓名</label>
                            <input name="m_name" disabled class="form-control" id="m_name" value="<?php echo $data["m_name"]?>">
                        </div>
                        <div class="form-group">
                          <label>帳號</label>
                            <input name="m_mail" disabled class="form-control" id="m_mail" value="<?php echo $data["m_mail"]?>">
                        </div>
                       <div class="form-group">
                          <label>電話</label>
                            <input name="m_phone" disabled class="form-control" id="m_phone" value="<?php echo $data["m_phone"]?>">
                        </div>
                        <div class="form-group">
                          <label>住址</label>
                            <input name="m_address" disabled class="form-control" id="m_address" value="<?php echo $data["m_address"]?>">
                        </div>
                        <div class="form-group">
                            <label>驗證</label>
                            <select class="form-control" name="m_enable" id="m_enable">
                                <option value="Y"
                                <?php
								checks($data["m_enable"],"Y");
								?>
                                >啟用</option>
                                <option value="N"
                                <?php
								checks($data["m_enable"],"N");
								?>
                                >未啟用</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">修改</button>
                        <button type="button" id="del" class="btn btn-default">刪除</button>
                        <button type="reset" class="btn btn-default">重設</button>
                      <input name="modify" type="hidden" id="modify" value="yes">
                      <input name="m_id" type="hidden" id="m_id" value="<?php echo $data["m_id"]?>">
					</form>
                  </div>
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
		$("#del").click(function(){
			if(confirm("確定"))
			{
			id=$("#m_id").val();
			//alert(id);
			location.href="mdetail.php?delete=yes&m_id=" + id;
			}
		});
    });
    </script>

</body>

</html>

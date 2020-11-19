<?php include_once("../../php/conn.php");?>
<?php
$row=10;
$countsql="SELECT * FROM product";
$countquery=mysql_query($countsql) or die(mysql_error());	
$total=mysql_num_rows($countquery);
$totalpage=ceil($total/$row);	
if($_GET["page"]!="")
{
  $page= $_GET["page"];
}
else
{
   $page=0; 
}
$start=$page*$row;
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
                    <div style="margin-bottom:10px;">
                    <a href="product_add.php" class="btn btn-default btn-lg">新增</a>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel panel-default">
                <div class="panel-heading"> 列表</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>名稱</th>
              <th>類別</th>
              <th>庫存</th>
              <th>修改</th>
              <th>刪除</th>
            </tr>
          </thead>
          <tbody>
          <?php	
		  $classary=[];
		  $classsql="SELECT * FROM proclass"; 
		  $classquery=mysql_query($classsql) or die(mysql_error());
		  while($classdata=mysql_fetch_assoc($classquery))
		  {
			 $classary["c".$classdata["c_id"]]=$classdata["c_name"]; 
		  }
		  $sql="SELECT * FROM product ORDER BY p_id DESC LIMIT $start,$row";
		  $query=mysql_query($sql) or die(mysql_error());		  
		  while($data=mysql_fetch_assoc($query))
		  {		  
		  ?>
            <tr>
              <td><?php echo $data["p_id"];?></td>
              <td><?php echo $data["p_name"];?></td>
              <td><?php echo $classary["c".$data["p_class"]];?></td>
              <td><?php echo $data["p_Stock"];?></td>
              <td><a href="product_mod.php?p_id=<?php echo $data["p_id"];?>">修改</a></td>
              <td><a href="product_del.php?p_id=<?php echo $data["p_id"];?>">刪除</a></td>
            </tr>
          <?php
		  }
		  ?>
          </tbody>
        </table>
      </div>
    				<div>
    <?php
	if($page>0)
	{
	?>
    <a href="fourm.php?page=<?php echo $page-1?>" class="btn btn-default">上一頁</a>
    <?php
	}
	?>
    <?php
	if($page<$totalpage-1)
	{
	?>
    <a href="fourm.php?page=<?php echo $page+1?>" class="btn btn-default">下一頁</a>
    <?php
	}
	?>
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
    });
    </script>

</body>

</html>

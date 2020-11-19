<?php include_once("../../php/conn.php");?>
<?php
$row=3;
if($_POST["keyword"]!='')
{
	$keyword=$_POST["keyword"];
	$countsql="SELECT * FROM orderlist WHERE o_sn LIKE '%$keyword%' OR o_status LIKE '%$keyword%' ORDER BY o_id DESC";
}
else if($_GET["keyword"]!='')
{
	$keyword=$_GET["keyword"];
	$countsql="SELECT * FROM orderlist WHERE o_sn LIKE '%$keyword%' OR o_status LIKE '%$keyword%' ORDER BY o_id DESC";
}
else
{
	$countsql="SELECT * FROM orderlist ORDER BY o_id DESC";
}
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
                    <h1 class="page-header">訂單查詢</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel panel-default">
                <div class="panel-heading">歷史訂單</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                 <form method="post" name="searchform" id="searchform" class="form-inline" style="margin:10px;">
                 <div class="form-group">
                    <label>狀態</label>
                    <select class="form-control" id="p_class" name="p_class">
                    <option value="確認中">確認中</option>
                    <option value="已收款">已收款</option>
                    <option value="已寄出">已寄出</option>
                    </select>
                </div>
                 <div class="form-group">
                      <label>關鍵字</label>
                      <input name="keyword" id="keyword" class="form-control">
                </div>
                <button type="submit" class="btn btn-default">搜尋</button>
                </form>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>日期</th>
                          <th>編號</th>
                          <th>運費</th>
                          <th>金額</th>
                          <th>合計</th>
                          <th>姓名</th>
                          <th>狀態</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php	
					  $i=1;	  
                      $sql="SELECT * FROM orderlist LEFT JOIN member ON m_id=o_mid WHERE o_sn LIKE '%$keyword%' OR o_status LIKE '%$keyword%' ORDER BY o_id DESC LIMIT $start,$row";
                      $query=mysql_query($sql) or die(mysql_error());		  
                      while($data=mysql_fetch_assoc($query))
                      {		  
                      ?>
                        <tr>
                          <td><?php echo $i+$page*$row;?></td>
                          <td><?php echo $data["o_time"];?></td>
                          <td><a href="orderdetail.php?o_id=<?php echo $data["o_id"];?>"><?php echo $data["o_sn"];?></a></td>
                          <td><?php echo $data["o_ship"];?></td>
                          <td><?php echo $data["o_total"];?></td>
                          <td><?php echo $data["o_total"]+$data["o_ship"];?></td>
                          <td><?php echo $data["m_name"];?></td>
                          <td>
						   <select class="form-control status" name="o_status" id="o_status" rel="<?php echo $data["o_id"];?>">
                                <option value="確認中"
                                <?php
								checks($data["o_status"],"確認中");
								?>
                                >確認中</option>
                                <option value="已收款"
                                <?php
								checks($data["o_status"],"已收款");
								?>
                                >已收款</option>
                                <option value="已寄出"
                                <?php
								checks($data["o_status"],"已寄出");
								?>
                                >已寄出</option>
                            </select>
                          </td>
                        </tr>
                      <?php
					  $i++;
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
                    <a href="order.php?page=<?php echo $page-1?>&keyword=<?php echo $keyword?>" class="btn btn-default">上一頁</a>
                    <?php
                    }
                    ?>
                    <?php
                    if($page<$totalpage-1)
                    {
                    ?>
                    <a href="order.php?page=<?php echo $page+1?>&keyword=<?php echo $keyword?>" class="btn btn-default">下一頁</a>
                    <?php
                    }
                    ?>

                  </div>
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
		$(".status").change(function(){
			status=$(this).val();
			o_id=$(this).attr("rel");
			//alert(o_id);
			location.href="order.php?status="+status+"&o_id="+o_id;
			});
    });
    </script>

</body>

</html>

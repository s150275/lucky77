    <!-- jQuery -->
    <script src="<?php echo $MAIN_BASE_ADDRESS;?>admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $MAIN_BASE_ADDRESS;?>admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo $MAIN_BASE_ADDRESS;?>admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo $MAIN_BASE_ADDRESS;?>admin/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $MAIN_BASE_ADDRESS;?>admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo $MAIN_BASE_ADDRESS;?>admin/dist/js/sb-admin-2.js"></script>

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

<script src="<?php echo $MAIN_BASE_ADDRESS;?>js/popwin.js"></script>
<script type="text/javascript">
function openWin(tmpUrl)
{
	tmp_width = screen.width * 85 / 100;
	tmp_height = screen.height * 85 / 100;
//	if ( screen.width < 990 )
	new1=popWin.showWin(tmpUrl,tmp_width,tmp_height,function(){
		//alert("关闭并执行回调函数");
	});
//	else
//	new1=popWin.showWin(tmpUrl,tmp_width,tmp_height,function(){
		//alert("关闭并执行回调函数");
//	});
	
}

// 全部選取
function chkall(input1)
{
    var objForm = document.forms[input1];
    var objLen = objForm.length;
    var objCheckboxType = "false";
    // 判斷目前的設定值
    if ( document.form_list.CHECKBOX_TYPE.value == "1" )
    {
        objCheckboxType = true;
        form_list.CHECKBOX_TYPE.value = "0";
    }
    else
    {
        objCheckboxType = false;
        form_list.CHECKBOX_TYPE.value = "1";
    }
    for (var iCount = 0; iCount < objLen; iCount++)
    {
        if (objForm.elements[iCount].type == "checkbox")
            objForm.elements[iCount].checked = objCheckboxType;
    }
}


// 大量更改狀態
function chk_Conf_Checkbox(input1,temp_type)
{
	// 判斷資料格式
	if ( temp_type == "GARBAGE_SET" )
	{
		temp_str = "垃圾桶";
		form_list.Funct.value='GARBAGE_SET';
	}
	else if ( temp_type == "ON" )
	{
		temp_str = '<?php echo $array_On[1] ;?>';
		form_list.Funct.value='ON';
	}
	else if ( temp_type == "DOWN" )
	{
		temp_str = '<?php echo $array_On[1] ;?>';
		form_list.Funct.value='DOWN';
	}
	else if ( temp_type == "DELOK" )
	{
		temp_str = "清除";
		form_list.Funct.value='DELOK';
	}
	else if ( temp_type == "GARBAGE_RETURN" )
	{
		temp_str = "回復";
		form_list.Funct.value='GARBAGE_RETURN';
	}
	
    var objForm = document.forms[input1];
    var objLen = objForm.length;
    var isCheck = "0" ;
    for (var iCount = 0; iCount < objLen; iCount++)
    {
        if (objForm.elements[iCount].type == "checkbox")
        {
            if (objForm.elements[iCount].checked == true)
            {
                var isCheck = "1" ;
            }
        }
    }
    if (isCheck == "1")
    {
        if (confirm("是否要執行" + temp_str + "的動作!!!"))
        {    document.form_list.submit();    }
        else
        {    return false ;    }
    }
    else
    {
        alert("請勾選任一資料!!!");
        return false ;    
    }
}


// 開啟確認INPUT的網頁
function isok(form,tmpMsg)
{
	if (confirm(tmpMsg))
	{	return true;	}
	else
	{	return false;	}
}
</script>

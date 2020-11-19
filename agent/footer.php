<?php

?>
    </div>
</td><td valign=top ></td>
</tr>
</table>
</form>
</body>
</html>
<script type="text/javascript">

//// 取得系統時間 API
//const API_GET_TIME = "http://worldtimeapi.org/api/timezone/Asia/Taipei"; // TODO: 取得系統時間
//
// $.ajax({
//url: "http://worldtimeapi.org/api/timezone/Asia/Taipei",   //存取Json的網址             
//type: "GET",
//cache:false,
//dataType: 'json',
//data:{},
////contentType: "application/json",
//success: function (data) {
//	var NowTime = data.unixtime ;
//	toastr.success("回傳資料 : " + NowTime);
//	//var aaa = new Date(1593090580000) ;//1472048779952
//	//toastr.success("回傳資料 : " + aaa);
//	//Thu Jun 25 2020 21:07:06 GMT+0800 (台北標準時間)
//	//Mon Jan 19 1970 18:31:30 GMT+0800 (台北標準時間)
//},
//
//error: function (xhr, ajaxOptions, thrownError) {
//	alert(xhr.status);
//	alert(thrownError);
//}
//});
    <!--
    function MM_preloadImages() { //v3.0
        var d = document;
        if (d.images) {
            if (!d.MM_p) d.MM_p = new Array();
            var i, j = d.MM_p.length, a = MM_preloadImages.arguments;
            for (i = 0; i < a.length; i++)
                if (a[i].indexOf("#") != 0) {
                    d.MM_p[j] = new Image;
                    d.MM_p[j++].src = a[i];
                }
        }
    }
    function ShowTime() {
        var timeValue = '';
		// NowTime
		//toastr.success("回傳資料 : " + NowTime);
        //Times = new Date(NowTime*1000);
        Times = new Date();
		//toastr.success("回傳資料 : " + Times);
		
        Dates = Times.getFullYear() + "-" + Number(Times.getMonth()+1) + "-" + Times.getDate();
        hours = Times.getHours();
        minutes = Times.getMinutes();
        seconds = Times.getSeconds();
        //timeValue = "現在時間 2020-04-30 ";
        timeValue = "現在時間 " + Dates + " ";
        timeValue += ((hours < 10) ? "0" : "") + hours + ":";
        timeValue += ((minutes < 10) ? "0" : "") + minutes + ":";
        timeValue += ((seconds < 10) ? "0" : "") + seconds;

        $("#Clocks").html(" " + timeValue + " ");
        setTimeout("ShowTime()", 1000);
    }
    //-->
</script>

<script language="javascript">
    function del(sid, name) {
        if (confirm("您確定要刪除『" + name + "』嗎?")) {
            window.location.href = "agents.php?sid=" + sid + "&mode=del";
        }
    }

    function StopRecord(id, name) {
        if (confirm("您確定要關閉代理『" + name + "』的權限嗎?")) {
            window.location.href = "agents.php?sid=" + id + "&mode=stop";
        }
    }


    function RecoveryRecord(id, name) {
        if (confirm("您確定要重啟代理『" + name + "』的權限嗎?")) {
            window.location.href = "agents.php?sid=" + id + "&mode=recovery";
        }
    }

    function JumpPage(keyword, search_type, orderby, sortmode) {
        frm = document.form1;
        window.location.href = "agents.php?shareholder_id=[[SHAREHOLDER_ID]]&keyword=" + keyword;
    }

    function form_clear() {
        frm = document.form1;
        frm.keyword.value = '';
    }
</script>
<SCRIPT LANGUAGE="JavaScript">
    <!--
    try {
        scroll1.scroll();
    }
    catch (e) {
    }
    //-->
</SCRIPT>

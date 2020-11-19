<?php
echo "\n";
echo "<footer>\n";
if( $MAIN_FILE_NAME	== "game.php" )
{	echo "  <span style='padding-top:5px;color:#650004;'>長有:<strong id='WinLost_Area3_Points'>0</strong><br>長無:<strong id='WinLost_Area2_Points'>0</strong></span>\n";	}

echo "  <div>\n";
echo "    <p><span>點數：</span><strong id='Footer_Member_Money' class='Member_Money'>" . (int)$array_Member_Info['Member_Money'] . "</strong></p>\n";
if( $MAIN_FILE_NAME	== "game.php" )
{	echo "    <p><strong>上期派彩:<span id='Payout_Money' class='Payout_Money'>0</strong></p>\n";	}

echo "  </div>\n";
if( $MAIN_FILE_NAME	== "game.php" )
{	echo "  <span style='padding-top:5px;color:#650004;'>輪莊:<strong id='WinLost_Area1_Points'>0</strong><br>輸贏總計:<strong id='WinLost_Total_Points'>0</strong></span>\n";	}
//{	echo "  <span style='padding-top:5px;color:#650004'>輸贏總計:<br> <strong id='WinLost_Total_Points'>0</strong></span>\n";	}
echo "</footer>\n";

echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>\n";
echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js\"></script>\n";
echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js\"></script>\n";
echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js\"></script>\n";

// toastr
echo "<link href=\"$MAIN_BASE_ADDRESS/includes/toastr/toastr.min.css\" rel=\"stylesheet\" />\n";
echo "<script src=\"$MAIN_BASE_ADDRESS/includes/toastr/toastr.min.js\"></script>\n";

// 載入中模組
echo "<script src=\"{$MAIN_BASE_ADDRESS}includes/mloading/jquery.mloading.js\"></script>\n";

echo "<script type=\"text/javascript\" src=\"$MAIN_BASE_ADDRESS/static/js/common.js\"></script>\n";
echo "<script type=\"text/javascript\" src=\"$MAIN_BASE_ADDRESS/static/js/{$MAIN_INCLUDE_NAME}.js\"></script></body>\n";
echo "</html>\n";

//echo "<script src=\"https://kit.fontawesome.com/de742a6872.js\" crossorigin=\"anonymous\"></script>\n";

?>
<script>
// ID被按時執行(click#ID)
// 
$('#BTN_ControlMusic').click(function() {
	var state = $(this).data("state");
	//alert("目前狀態 : " + state);
	if( state == 1 )
	{// 開啟中
		var myAuto = document.getElementById('myaudio');
		myAuto.pause();
		//alert("開啟中 : " + state);
		$(this).data("state" , 0) ;
		$(this).html("音樂關閉") ;
	}
	else
	{// 關閉中
		var myAuto = document.getElementById('myaudio');
		myAuto.play();
		//alert("關閉中 : " + state);
		$(this).html("音樂開啟") ;
		$(this).data("state" , 1) ;
	}
})
</script>

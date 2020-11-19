<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "首頁" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "login.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "index" ;				// 主要程式名稱

// ############ ########## ########## ############
// ## 載入模組									##
// ############ ########## ########## ############
include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
include_once($MAIN_BASE_ADDRESS . "Project/WinHappy/func_WinHappy.php");
include_once($MAIN_BASE_ADDRESS . "Project/GodNine/func_GodNine.php");

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "Member_Login_Name||*" ;
$ARRAY_POST_GET_PARA[] = "Member_Login_Passwd||*" ;
$ARRAY_POST_GET_PARA[] = "Login_Name||*" ;
$ARRAY_POST_GET_PARA[] = "CheckRule||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

// 是否登入系統
// 後台管理者登入
if( $Login_Name != "" && strlen($_SESSION['SystemUser_ID']) == 10 && $Funct == "LOGIN" )
{
	$sql = "SELECT * FROM Member WHERE Member_Login_Name='$Login_Name'";
	//echo "$sql" ;
	$query = mysqli_query($link , $sql) ;
	if(mysqli_num_rows($query) > 0)
	{
		$LIST = mysqli_fetch_assoc($query) ;
		if ( $LIST['Member_On'] == 1 )
		{
			$_SESSION['Website_Name'] = $Conn_Website_Name;
			
			//存入SESSION
			$_SESSION['Member_ID'] = $LIST['Member_ID'];
			$_SESSION['Member_Login_Name'] = $LIST['Member_Login_Name'];
			$_SESSION['Member_Name'] = $LIST['Member_Name'];
			$_SESSION['Member_Level'] = $LIST['Member_Level'];
			$_SESSION['Member_Money'] = (int)$LIST['Member_Money'];

			$Bol = func_setLoginInfo( $_SESSION['Member_ID'] ) ;		// 設定登入資訊

			$Bol = func_setOnLineInfo( $_SESSION['Member_ID'] , 1  , "OnLine_Bet_DT" ) ;		// 記錄會員在線資訊和下注時間

			alertgo("" , "money.php");
		}
		else
		{
			alertgo("權限已關閉,請連絡管理者" , $MAIN_FILE_NAME);
		}
	}
	else
	{
		alertgo("登入失敗" , "$MAIN_FILE_NAME");	
	}
}
else if( $Funct == "Login" AND $Member_Login_Name AND $Member_Login_Passwd )
{// 是否要登入系統
	//if( $CheckRule != 1 )
	//{	alertgo("請勾選同意規則協議","login.php",1);exit;	//}
	//alertgo("因系統維護中,無法提供相關服務,不方便的地方,敬請原諒","404.php");
	//echo "登入系統 {$_SESSION['check_word']} - {$_POST['checkword']}<br>" ;
	if((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword'])))  //判斷此兩個變數是否為空
	{// 驗證碼有輸入
		//echo "驗證碼有輸入<br>" ;
		// 不管大小寫
		if( strtolower($_SESSION['check_word']) == strtolower($_POST['checkword']) )
		{
			$sql = "SELECT * FROM Member WHERE Member_Login_Name='$Member_Login_Name' AND Member_Login_Passwd = '".crypt($Member_Login_Passwd , strtoupper($Member_Login_Name))."'";
			//echo "$sql" ;
			//exit;
			$query = mysqli_query($link , $sql) ;
			if(mysqli_num_rows($query) > 0)
			{
				$LIST = mysqli_fetch_assoc($query) ;
				if ( $LIST['Member_On'] == 1 )
				{
					$_SESSION['check_word'] = ''; //比對正確後，清空將check_word值
					
					$_SESSION['Website_Name'] = $Conn_Website_Name;
					
					//存入SESSION
					$_SESSION['Member_ID'] = $LIST['Member_ID'];
					$_SESSION['Member_Login_Name'] = $LIST['Member_Login_Name'];
					$_SESSION['Member_Name'] = $LIST['Member_Name'];
					$_SESSION['Member_Level'] = $LIST['Member_Level'];
					$_SESSION['Member_Money'] = (int)$LIST['Member_Money'];
		
					// 加入登入IP
					$arrayField['Member_Login_IP'] = $_SERVER['REMOTE_ADDR'] ;
					$arrayField['Member_Login_DT'] = date("Y-m-d H:i:s") ;
					$Bol = func_DatabaseBase( "Member" , "MOD" , $arrayField , " Member_ID = '{$LIST['Member_ID']}'" ) ;						// 資料庫處理

					// 加入操作LOG
					$array_LogInfo['Time'] = date("Y-m-d H:i:s") ;					// 操作日期
					$array_LogInfo['OperatorID'] = $_SESSION['Member_ID'] ;			// 操作者ID
					$array_LogInfo['OperatorName'] = $_SESSION['Member_Name'] ;		// 操作者姓名
					$array_LogInfo['FileName'] = $MAIN_FILE_NAME ;					// 執行程式
					$array_LogInfo['Table'] = "" ;									// 操作資料表(有操作到資料庫時才需填入),如果為登入(出)則不用設定
					$array_LogInfo['ID'] = "" ;										// 操作資料ID-只有在有對某資料作動時才需記錄,配合Table欄位
					$array_LogInfo['IP'] = $_SERVER["REMOTE_ADDR"] ;				// 操作者IP
					$array_LogInfo['Type'] = "登入" ;								// 操作動作 SELECT:2||其它,新增,修改,刪除,秀出,上下架,查詢,登入,登出
					$array_LogInfo['Info'] = "{$_SESSION['Member_Name']}-登入系統" ;		// 操作記錄 SQL內容或備註(可記錄新增會員ID,刪除ID)
					$array_LogInfo['SQL'] = "" ;		// SQL內容-刪除資料不用(有才需填-只給管理者看)

					// 會員操作-管理等級來判斷
					$tmpCode = func_WriteLogFieldInfo( "Member" , "Member_ID" , $_SESSION['Member_ID'] , "Member_Log" , $array_LogInfo , "LogInfo" ) ;	// 寫入LogField資料

					$Bol = func_setLoginInfo( $_SESSION['Member_ID'] ) ;		// 設定登入資訊

					$Bol = func_setOnLineInfo( $_SESSION['Member_ID'] , 1  , "OnLine_Bet_DT" ) ;		// 記錄會員在線資訊和下注時間

					alertgo("登入成功" , "money.php");
				}
				else
				{
					alertgo("權限已關閉,請連絡管理者" , "index.php");
				}
			}
			else
			{
				alertgo("登入失敗","");
			}
		}
		else
		{
			alertgo("驗證碼錯誤請重新輸入","");
		}
	}
	else
	{// 驗證碼沒有輸入
	}
	

}

GodNine_readyMemberLogin();		// 查詢遊戲會員是否已登入

//echo "<p></p>" ;print_r($_SESSION);echo "<br>" ;

echo "<!DOCTYPE html>\n";
echo "<html lang=\"en\">\n";
echo "  <head>\n";
echo "    <meta charset=\"UTF-8\">\n";
echo "    <title>會員登入</title>\n";
echo "    <meta name=\"viewport\" content=\"width=device-width,minimum-scale=1,maximum-scale=1,user-scalable=no\">\n";
echo "<meta name=\"description\" content=\"財神九仔生\">\n";

echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css\">\n";

echo "  <link href=\"/static/css/common.css\" rel=\"stylesheet\">\n";
echo "  <link href=\"/static/css/login.css\" rel=\"stylesheet\">\n";

// toastr
echo "<link href=\"$MAIN_BASE_ADDRESS/includes/toastr/toastr.min.css\" rel=\"stylesheet\" />\n";
echo "<script src=\"$MAIN_BASE_ADDRESS/includes/toastr/toastr.min.js\"></script>\n";

echo "  </head>\n";
echo "  <body data-page=\"login\">\n";
echo "    <main>\n";
echo "      <div class=\"mainWrap\">\n";
echo "        <div class=\"loginForm\">\n";
echo "  <img src=\"/static/img/logo.483b4cb.png\" class=\"login-logo\" alt=\"\">\n";
echo "  <form action='login.php' method='post' id=\"loginform\" name=\"loginform\">\n";
echo "  <input type=\"hidden\" name='Funct' value='Login'>\n";
echo "    <div class=\"formItem\">\n";
echo "      <label for=\"\"><i class=\"fas fa-user\"></i> </label>\n";
echo "      <div>\n";
echo "        <input type=\"text\" id='Member_Login_Name' name='Member_Login_Name' placeholder=\"帳號\" value='$Member_Login_Name' required>\n";
echo "      </div>\n";
echo "    </div>\n";
echo "    <div class=\"formItem\">\n";
echo "      <label for=\"\"><i class=\"fas fa-lock\"></i> </label>\n";
echo "      <div>\n";
echo "        <input type=\"password\" id='Member_Login_Passwd' name='Member_Login_Passwd' placeholder=\"密碼\" value='$Member_Login_Passwd' required>\n";
echo "      </div>\n";
echo "    </div>\n";
//echo "	  <div style='text-align:right;'><input type='checkbox' id=\"CheckRule\" name='CheckRule' value='1' style='width:15px;height:15px;'>同意規則協議</div><br>\n";
echo "    <div class=\"formItem\">\n";
echo "      <label for=\"\"> <i class=\"fas fa-key\"></i> </label>\n";
echo "      <div class=\"captchaItem\">\n";
echo "        <input class=\"short\" type=\"text\" id='checkword' name='checkword' placeholder=\"驗證碼\" autocomplete='off' required>\n";
echo "        <span class=\"captchaImage\">\n";
echo "          <img id=\"imgcode\" src=\"{$MAIN_BASE_ADDRESS}includes/captcha/captcha.php\" onclick=\"refresh_code()\" />\n";
echo "        </span>\n";
echo "      </div>\n";
echo "    </div>\n";
echo "    <div class=\"formItem\">\n";
echo "      <button id=\"check_fromval\">登入</button>\n";
echo "    </div>\n";
echo "  </form>\n";
echo "</div>\n";

echo "      </div>\n";
echo "    </main>\n";
echo "<script type=\"text/javascript\" src=\"/static/js/common.js\"></script>\n";
echo "<script type=\"text/javascript\" src=\"/static/js/login.js\"></script></body>\n";
echo "</html>\n";


?>
<script>
function refresh_code(){ 
	document.getElementById("imgcode").src="includes/captcha/captcha.php"; 
}



	
</script>

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="includes/magnific-popup/magnific-popup.css">

<a class="popup-with-move-anim" id="news" href="#small-dialog" style="display: none;">Open with fade-slide animation</a>

<div id="small-dialog" class="zoom-anim-dialog mfp-hide" style="background: radial-gradient(#b90000, #4c0006); max-width: 100%;">
        <!--<header style="text-align: center;">
			<h2>測試官方公告</h2>
		</header>-->
        <section class="body">
			<h3>本站線上協議規則：</h3>
			<p>
				本站線上協議規則<br>
				| 致會員 |<br>
				1.	為避免爭議，請會員於開始投注前，詳細閱讀本公司所定之各項規則。會員一經『我同意』進入本網站進行投注時，即被視為已接受所有之規定。 <br>
				2.	為確保雙方權益，若有發生不可抗拒之災害導致網站故障、硬體損壞等情況，本公司將以最後備份之資料及會員投注後所儲存的資料網站內"下注明細"所記載，作為最後處理的依據。 <br>
				3.	會員在投注完成後，到"下注明細"中確認該筆注單是否"下注成功"，且應仔細核對該筆注單之下注內容與金額．本公司僅以會員"下注明細"的內容為計算結果之依據。 <br>
				4.	所有賠率受多種因素影響調整變動漲跌。所有注單將以顯示"下注成功"後的注單為準。 <br>
				5.	公佈賠率時，出現任何的打字錯誤或非故意人為疏失，本公司將保留刪除任何錯誤賠率注單之權利，並以"跑馬燈"公佈之，不個別另行通知。 <br>
				6.	如因系統錯誤，而造成異常不合理注單，本公司有刪除任何錯誤注單的權利並追溯公司之前之損失。 <br>
				7.	經公司發現於該注單為「獎號開出後」下注之注單一率取消，不便之處，敬請見諒。 <br>
				8.	任何的投訴必須在開獎之前提出，本站不會受理任何開獎後的投訴。 <br>
				9.	本公司若公告之文字訊息輸入錯誤將有權修正錯誤。<br>

				| 投注重要須知 |<br>
				1.	本系統適用於 Google Chrome 或 IE( IE 8以上)瀏覽器，使用其它瀏覽器可能會造成部份功能無法運作。 <br>
				2.	建議使用 Google Chrome 操作，可取得較佳效能。 <br>
				3.	所有投注皆含本金。 <br>
				4.	當您在投注之後，請等待"下注成功"的顯示。 <br>
				5.	本系統之所有賠率(價位)皆為浮動，請於下注前點選詳細內容之查看賠率(價位)調整，派彩結果將以確認投注時之注單賠率(價位)為依據。 <br>
				6.	會員已投注注單，如超過公司規定"下注撤單時間"，本公司將不接受「刪單」。 <br>
				7.	本公司一概不接受任何刪單或修改之要求，請各位會員按照正常程序下注。 <br>
				8.	客戶有責任確保自己的帳戶及登入資料的保密性。在本網站上以個人的使用者帳號及密碼進行的任何網上投注將被視為有效。 <br>
				9.	如因在本網站投注觸犯當地法律，本公司概不負責。 <br>
				10.	若遭駭客入侵破壞或發生不可抗拒之災害導致網站故障或資料遺失等情況，本公司將以備份資料為最後處理依據。 為確保雙方利益，公司只接受投注後有列印下注明細的會員作投訴並會盡速處理。<br>
				對於以上由本站所明列的協議和規則本人已詳細閱讀<br>

			</p>

		</section>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<script src="includes/sweetalert2/sweetalert2.min.js"></script>
<script src="includes/magnific-popup/jquery.magnific-popup.js"></script>

<script type="text/javascript">
	
$("#check_fromval").click(function() {
	
	//alert("進來了");
	var Member_Login_Name = $("#Member_Login_Name").val();
	var Member_Login_Passwd = $("#Member_Login_Passwd").val();
	var checkword = $("#checkword").val();
	
	if( Member_Login_Name == "" )
	{	
		alert("登入帳號為必填");
	 	$("#Member_Login_Name").focus();
		return false;	
	}
	else if( Member_Login_Passwd == "" )
	{	
		alert("登入密碼為必填");
		$("#Member_Login_Passwd").focus();
		return false;	
	}
	else if( checkword == "" )
	{	
		alert("驗證碼為必填");
		$("#checkword").focus();
		return false;	
	}
	else
	{
		/*
		swal({
			title: "本站線上協議規則：",
			text: "",
			html:"本站線上協議規則\n| 致會員 |\n1.為避免爭議，請會員於開始投注前，詳細閱讀本公司所定之各項規則。會員一經『我同意』進入本網站進行投注時，即被視為已接受所有之規定。\n2.為確保雙方權益，若有發生不可抗拒之災害導致網站故障、硬體損壞等情況，本公司將以最後備份之資料及會員投注後所儲存的資料網站內'下注明細'所記載，作為最後處理的依據。\n3.會員在投注完成後，到'下注明細'中確認該筆注單是否'下注成功'，且應仔細核對該筆注單之下注內容與金額．本公司僅以會員'下注明細'的內容為計算結果之依據。\n4.所有賠率受多種因素影響調整變動漲跌。所有注單將以顯示'下注成功'後的注單為準。\n5.公佈賠率時，出現任何的打字錯誤或非故意人為疏失，本公司將保留刪除任何錯誤賠率注單之權利，並以'跑馬燈'公佈之，不個別另行通知。\n6.如因系統錯誤，而造成異常不合理注單，本公司有刪除任何錯誤注單的權利並追溯公司之前之損失。\n7.經公司發現於該注單為「獎號開出後」下注之注單一率取消，不便之處，敬請見諒。\n8.任何的投訴必須在開獎之前提出，本站不會受理任何開獎後的投訴。\n9.本公司若公告之文字訊息輸入錯誤將有權修正錯誤。\n\n| 投注重要須知 |\n1.本系統適用於 Google Chrome 或 IE( IE 8以上)瀏覽器，使用其它瀏覽器可能會造成部份功能無法運作。\n2.建議使用 Google Chrome 操作，可取得較佳效能。\n3.所有投注皆含本金。\n4.當您在投注之後，請等待'下注成功'的顯示。\n5.本系統之所有賠率(價位)皆為浮動，請於下注前點選詳細內容之查看賠率(價位)調整，派彩結果將以確認投注時之注單賠率(價位)為依據。\n6.會員已投注注單，如超過公司規定'下注撤單時間'，本公司將不接受「刪單」。\n7.本公司一概不接受任何刪單或修改之要求，請各位會員按照正常程序下注。\n8.客戶有責任確保自己的帳戶及登入資料的保密性。在本網站上以個人的使用者帳號及密碼進行的任何網上投注將被視為有效。\n9.如因在本網站投注觸犯當地法律，本公司概不負責。\n10.若遭駭客入侵破壞或發生不可抗拒之災害導致網站故障或資料遺失等情況，本公司將以備份資料為最後處理依據。 為確保雙方利益，公司只接受投注後有列印下注明細的會員作投訴並會盡速處理。\n\n對於以上由本站所明列的協議和規則本人已詳細閱讀。",
			icon: "info",
			//buttons: true,
			buttons:[
            '不同意',
            '我同意 本站線上協議規則'
            ],
			dangerMode: false,
		})
		.then((willDelete) => {
			if (willDelete) {
				$("#loginform").submit();
				return false;
			} else {
				//swal("Your imaginary file is safe!");
			}
		});
		*/
		Swal.fire({
		  title: '本站線上協議規則',
		  text: "",
		  html: "<div style='text-align: left;'>| 致會員 |<br>1. 為避免爭議，請會員於開始投注前，詳細閱讀本公司所定之各項規則。會員一經『我同意』進入本網站進行投注時，即被視為已接受所有之規定。<br>2. 為確保雙方權益，若有發生不可抗拒之災害導致網站故障、硬體損壞等情況，本公司將以最後備份之資料及會員投注後所儲存的資料網站內'下注明細'所記載，作為最後處理的依據。<br>3. 會員在投注完成後，到'下注明細'中確認該筆注單是否'下注成功'，且應仔細核對該筆注單之下注內容與金額．本公司僅以會員'下注明細'的內容為計算結果之依據。<br>4. 所有賠率受多種因素影響調整變動漲跌。所有注單將以顯示'下注成功'後的注單為準。<br>5. 公佈賠率時，出現任何的打字錯誤或非故意人為疏失，本公司將保留刪除任何錯誤賠率注單之權利，並以'跑馬燈'公佈之，不個別另行通知。<br>6. 如因系統錯誤，而造成異常不合理注單，本公司有刪除任何錯誤注單的權利並追溯公司之前之損失。<br>7. 經公司發現於該注單為「獎號開出後」下注之注單一率取消，不便之處，敬請見諒。<br>8. 任何的投訴必須在開獎之前提出，本站不會受理任何開獎後的投訴。<br>9. 本公司若公告之文字訊息輸入錯誤將有權修正錯誤。<br><br>| 投注重要須知 |<br>1. 本系統適用於 Google Chrome 或 IE( IE 8以上)瀏覽器，使用其它瀏覽器可能會造成部份功能無法運作。<br>2. 建議使用 Google Chrome 操作，可取得較佳效能。<br>3. 所有投注皆含本金。<br>4. 當您在投注之後，請等待'下注成功'的顯示。<br>5. 本系統之所有賠率(價位)皆為浮動，請於下注前點選詳細內容之查看賠率(價位)調整，派彩結果將以確認投注時之注單賠率(價位)為依據。<br>6. 會員已投注注單，如超過公司規定'下注撤單時間'，本公司將不接受「刪單」。<br>7. 本公司一概不接受任何刪單或修改之要求，請各位會員按照正常程序下注。<br>8. 客戶有責任確保自己的帳戶及登入資料的保密性。在本網站上以個人的使用者帳號及密碼進行的任何網上投注將被視為有效。<br>9. 如因在本網站投注觸犯當地法律，本公司概不負責。<br>10. 若遭駭客入侵破壞或發生不可抗拒之災害導致網站故障或資料遺失等情況，本公司將以備份資料為最後處理依據。 為確保雙方利益，公司只接受投注後有列印下注明細的會員作投訴並會盡速處理。<br>對於以上由本站所明列的協議和規則本人已詳細閱讀<br></div>",
		  icon: 'info',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: '我同意',
		  cancelButtonText: '不同意'
		}).then((result) => {
		  if (result.isConfirmed) {
			/*
			Swal.fire(
			  'Deleted!',
			  'Your file has been deleted.',
			  'success'
			)*/
			 
			$("#loginform").submit();
			  
		  }
		})
		
	}
	/*
	var Member_Login_Name = $("#Member_Login_Name").val();
	var Member_Login_Passwd = $("#Member_Login_Passwd").val();
	var checkword = $("#checkword").val();
	//var CheckRule = $("#CheckRule").val();
	//var CheckRule = $('input[name="CheckRule"]').prop("checked");
	
	if( Member_Login_Name == "" )
	{	
		alert("登入帳號為必填");
	 	$("#Member_Login_Name").focus();
		return false;	
	}
	else if( Member_Login_Passwd == "" )
	{	
		alert("登入密碼為必填");
		$("#Member_Login_Passwd").focus();
		return false;	
	}
	else if( checkword == "" )
	{	
		alert("驗證碼為必填");
		$("#checkword").focus();
		return false;	
	}
	else
	{
		
		

		
		
		//$('.popup-with-move-anim').get(0).click();
		return false;
	}
	*/
	return false;
	
});
	
//判斷與更改checkbok選取狀態
/*
$("#CheckRule").click(function() {
      
     if($(this).prop("checked")) {
             
          
     }

});

	
$('.popup-with-move-anim').magnificPopup({
          
	type: 'inline',

    fixedContentPos: false,
    fixedBgPos: true,

    overflowY: 'auto',
    closeBtnInside: true,
    preloader: false,
          
    midClick: true,
    removalDelay: 300,
    mainClass: 'my-mfp-slide-bottom',
	callbacks: {
    open: function() {
      
      
     // this part overrides "close" method in MagnificPopup object
      $.magnificPopup.instance.close = function () {
      
          if (!confirm("是否同意本站線上協議規則?")) {
              
			  $.magnificPopup.proto.close.call(this);
			  return;
			  
          }
		  else
		  {
			  $("#loginform").submit();
			  
		  }
      
           // "proto" variable holds MagnificPopup class prototype
           // The above change that we did to instance is not applied to the prototype, 
           // which allows us to call parent method:
           $.magnificPopup.proto.close.call(this);
      }; 
      // you may override any method like so, just note that it's applied globally
      
    }
  }
	
	
});
*/		
	
</script>



<!---->
<style type="text/css">
      /* Styles for dialog window */
      #small-dialog {
        background: white;
        padding: 20px 30px;
        text-align: left;
        max-width: 400px;
        margin: 40px auto;
        position: relative;
      }


      /**
       * Fade-zoom animation for first dialog
       */
      
      /* start state */
      .my-mfp-zoom-in .zoom-anim-dialog {
        opacity: 0;

        -webkit-transition: all 0.2s ease-in-out; 
        -moz-transition: all 0.2s ease-in-out; 
        -o-transition: all 0.2s ease-in-out; 
        transition: all 0.2s ease-in-out; 



        -webkit-transform: scale(0.8); 
        -moz-transform: scale(0.8); 
        -ms-transform: scale(0.8); 
        -o-transform: scale(0.8); 
        transform: scale(0.8); 
      }

      /* animate in */
      .my-mfp-zoom-in.mfp-ready .zoom-anim-dialog {
        opacity: 1;

        -webkit-transform: scale(1); 
        -moz-transform: scale(1); 
        -ms-transform: scale(1); 
        -o-transform: scale(1); 
        transform: scale(1); 
      }

      /* animate out */
      .my-mfp-zoom-in.mfp-removing .zoom-anim-dialog {
        -webkit-transform: scale(0.8); 
        -moz-transform: scale(0.8); 
        -ms-transform: scale(0.8); 
        -o-transform: scale(0.8); 
        transform: scale(0.8); 

        opacity: 0;
      }

      /* Dark overlay, start state */
      .my-mfp-zoom-in.mfp-bg {
        opacity: 0;
        -webkit-transition: opacity 0.3s ease-out; 
        -moz-transition: opacity 0.3s ease-out; 
        -o-transition: opacity 0.3s ease-out; 
        transition: opacity 0.3s ease-out;
      }
      /* animate in */
      .my-mfp-zoom-in.mfp-ready.mfp-bg {
        opacity: 0.8;
      }
      /* animate out */
      .my-mfp-zoom-in.mfp-removing.mfp-bg {
        opacity: 0;
      }



      /**
       * Fade-move animation for second dialog
       */
      
      /* at start */
      .my-mfp-slide-bottom .zoom-anim-dialog {
        opacity: 0;
        -webkit-transition: all 0.2s ease-out;
        -moz-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        transition: all 0.2s ease-out;

        -webkit-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
        -moz-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
        -ms-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
        -o-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
        transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );

      }
      
      /* animate in */
      .my-mfp-slide-bottom.mfp-ready .zoom-anim-dialog {
        opacity: 1;
        -webkit-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
        -moz-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
        -ms-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
        -o-transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
        transform: translateY(0) perspective( 600px ) rotateX( 0 ); 
      }

      /* animate out */
      .my-mfp-slide-bottom.mfp-removing .zoom-anim-dialog {
        opacity: 0;

        -webkit-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
        -moz-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
        -ms-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
        -o-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
        transform: translateY(-10px) perspective( 600px ) rotateX( 10deg ); 
      }

      /* Dark overlay, start state */
      .my-mfp-slide-bottom.mfp-bg {
        opacity: 0;

        -webkit-transition: opacity 0.3s ease-out; 
        -moz-transition: opacity 0.3s ease-out; 
        -o-transition: opacity 0.3s ease-out; 
        transition: opacity 0.3s ease-out;
      }
      /* animate in */
      .my-mfp-slide-bottom.mfp-ready.mfp-bg {
        opacity: 0.8;



      }
      /* animate out */
      .my-mfp-slide-bottom.mfp-removing.mfp-bg {
        opacity: 0;
      }
	
	
	.mfp-close-btn-in .mfp-close {
		color: #fff;
	}
	
</style>

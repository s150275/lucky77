<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "遊戲" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "game.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "game" ;				// 主要程式名稱

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
$ARRAY_POST_GET_PARA[] = "Room||*" ;
$ARRAY_POST_GET_PARA[] = "zone_code||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

//print_r($ARRAY_POST_GET_PARA);

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

// 載入首頁
include($MAIN_BASE_ADDRESS . "header.php") ;        // 載入首頁

GodNine_setMemberINRoomInfo() ;		// 設定會員進入房間資訊

echo "<main>\n";
echo "	<div class=\"mainWrap\">\n";
echo "		<div id=\"gameBlock\" class=\"gameBlock\">\n";
echo "			<div class=\"topBlock\"> \n";
echo "				<!-- 左 -->\n";
echo "				<div class=\"leftBlock\">\n";
echo "					<div class=\"blockContent\">\n";
echo "						<div id='Banker_Wave_Type' class=\"blockTitle\">排莊</div>\n";
echo "						<div id='BankerArea' class=\"bankerList\" v-html='BankerArea'>\n";
echo "							<p id='N' class='BankerInfo'></p>\n";
echo "						</div>\n";
echo "						<div v-if=\"zone_code == 1 && Apply_Banker == true\">\n";
echo "							<button class=\"button-orange\" id='Apply_Banker' @click=\"FApply_Banker\">申請排莊</button>\n";
echo "						</div>\n";
echo "					</div>\n";
// 現在莊家名稱
echo "					現在莊家<br><div id='Now_Banker_Name'></div>\n" ;
echo "				</div>\n";
echo "				<!-- 中間區域-倒數時間訊息,動畫 -->\n";
echo "				<div class=\"centerBlock\"> \n";
echo "					<!--目前倒數時間訊息-->\n";
echo "					<div class=\"countdownBlock\">\n";
echo "						<div class=\"title\"> <span> {{ Fcountdown_status.text }} </span> </div>\n";
echo "						<div class=\"number\"> <span> {{ Fcountdown_status.countdown }} </span> </div>\n";
echo "					</div>\n";
echo "					\n";
echo "					<!-- 開獎動畫 -->\n";
echo "					<div v-show=\"now_action == 'wait'\" class=\"openVideo\">\n";
echo "						<div class=\"openVideo_iframe\">\n";
echo "							<video muted autoplay loop poster=\"\" playsinline>\n";
echo "								<source src=\"static/video.mp4\">\n";
echo "							</video>\n";
echo "						</div>\n";
echo "					</div>\n";
echo "					<div v-if=\"now_action !== 'wait'\"> \n";
echo "						<!-- 倍率說明 -->\n";
echo "						<div v-if=\"zone_code == 1 || zone_code == 3\" class=\"bonusBlock\">\n";
echo "							<div class=\"point\">\n";
echo "								<span>1-7點<br>1倍</span>\n";
echo "								<span>8-9點<br>2倍</span>\n";
echo "								<span>對子<br>3倍</span>\n";
echo "							</div>\n";
echo "						</div>\n";
echo "						\n";
echo "						<!-- 標題 -->\n";
echo "						<div v-else class=\"zoneTitle\">\n";
							if($_SESSION['zone_code'] == 2)
							{
echo "							<h4>長莊無倍數區</h4>\n";
							}
echo "						</div>\n";
echo "					</div>\n";
echo "				</div>\n";

echo "				<!-- 右 -->\n";
echo "				<div class=\"rightBlock\">\n";
echo "					<div class=\"blockContent\">\n";
echo "						<div class=\"blockTitle\">本期期號</div>\n";
echo "						<p>財神九仔生</p>\n";
echo "						<p class=\"dark_block\"> <span>{$_SESSION['Chips']}底注</span><br>\n";
echo "							<span>{$tmp_RoomNum}廳</span> </p>\n";
echo "						<p> <span id='NewBingo_Period_Game' class=\"yellow NewBingo_Period\">{$array_BingoPeriod['NowBingo']}</span> </p>\n";
echo "						<p> <span>{{ sys_now }}</span> </p>\n";
echo "					</div>\n";
// 尾波不能選位
echo "					<div id='Banker_Wave_Type_Msg'></div>\n" ;
echo "				</div>\n";
echo "			</div>\n";

echo "			<!--  說明 -->\n";
echo "			<div v-if=\"(zone_code == 1 || zone_code == 3) &&　now_action !== 'wait'\" class=\"bonusInfo\" :active=\"open_bonus_info\">\n";
echo "				<p class=\"toggleBlock\" v-if=\"open_bonus_info\">\n";
echo "				一、假設球號69，6+9＝15，5點(尾數5為其點數)。此時如遇點數相同如05同點，以獎號十位數及個位數大者為勝作為判定標準。<br>\n";
echo "				二、如十位數及個位數相同，上面例子莊家69牌面數字大於05，莊家勝。<br>\n";
echo "				三、0點→無條件為莊贏。<br>\n";

//echo "				假設球號31、28，3+1+2+8＝14，4點(尾數4為其點數)。<br>\n";
//echo "				閒1點→無條件為莊贏；2點以上莊、閒點數相同，雙方各以2球中之球號較大者為勝\n";
echo "				</p>\n";
echo "				<a href=\"javascript:;\" class=\"button-orange\" @click=\"open_bonus_info = !open_bonus_info\">{{ open_bonus_info ? \"收起說明\" : \"打開說明\"}}</a> </div>\n";

echo "			<transition name=\"slide-fade\" mode=\"out-in\">\n";
echo "				<div v-if=\"now_action !== 'close'\" key=\"open\"> \n";
echo "					<!-- 座位區 -->\n";
echo "					<div class=\"bottomBlock\">\n";
echo "						<div class=\"pointBlock\"> <!--span> <span>預扣點數:</span> <strong id='Withhold_Money1'>0</strong> </span--> <!--span> <span>上期派彩:</span> <strong id='Payout_Money1'>0</strong> </span--> </div>\n";
echo "						<ul class=\"tableList\">\n";
echo "							<li class=\"tableList_item\" :loading=\"wait_loading\" v-for=\"table_number in table_count\">\n";
echo "								<div class=\"ball_area\">\n";
echo "									<label class=\"ball_number\"> <span> \n";
echo "										<!--新開獎號碼-分10位和個位--> \n";

echo "										<span> {{ \$ball_number(ball_number[table_number - 1])[0] }} </span> <span> {{ \$ball_number(ball_number[table_number - 1])[1] }} </span> </span> </label>\n";
echo "									<label class=\"ball_point\" :number=\"ball_number[table_number - 1]\" :point=\"ball_point[table_number - 1]\"> \n";
echo "										<!--開獎號碼處理過的值--> \n";
echo "										<span> {{ ball_point[table_number - 1] }}</span> </label>\n";
echo "								</div>\n";
echo "								<div class=\"table_area\"> \n";
echo "									<!-- 桌號 -->\n";
//echo "									<label class=\"table_number\">{{ `${table_number}桌` }}</label>\n";
echo "									<label class=\"table_number\">{{Table_Char[table_number]}}桌</label>\n";
echo "									\n";
echo "									<!-- 椅子 -->\n";
echo "									<label class=\"table_space\" v-for=\"chair_number in chair_count\">\n";
echo "										<input v-bind:id=\"'Char_'+table_number+'_'+chair_number\" class=\"space_checkbox\" type=\"checkbox\" :value=\"FgetSeatNumber(table_number, chair_number)\" v-model=\"player_seats\" :disabled=\"FdisabledSeat(table_number, chair_number)\" @change=\"setPlayerSeat(table_number , chair_number)\">\n";
echo "										<span class=\"space_chair\" :other=\"FisOtherPlayer(table_number, chair_number)\" :banker=\"FisBankerSeat(table_number, chair_number)\"> <span class=\"space_text\"> {{ getSeatStatus(table_number, chair_number).text }} </span> </span> </label>\n";
echo "								</div>\n";
echo "							</li>\n";
echo "						</ul>\n";
echo "					</div>\n";
echo "				</div>\n";
echo "			</transition>\n";

echo "			<!-- 開獎記錄 -->\n";
echo "			<h5>近五期開獎記錄</h5>\n";
echo "			<div id='BingoHistoryArea' class=\"bingoHistory\">\n";
echo "			</div>\n";
echo "			<p align=\"center\"><a href=\"bingoHistory.php\" class=\"button-orange\">查看更多</a></p>\n";
echo "		</div>\n";
echo "	</div>\n";
echo "</main>\n";
echo "\n";

// 載入版權
include($MAIN_BASE_ADDRESS . "footer.php") ;        // 載入版權
?>

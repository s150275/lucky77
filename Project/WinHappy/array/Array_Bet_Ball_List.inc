<?
// ############ ########## ########## ############
// ## 贏家娛樂城-投注球號類別							##
// ############ ########## ########## ############
// 程式功能 : 投注球號類別
// 版    本 : V0.1
// 作    者 : 杜宇龍
// 修改時間 : 2020/05/15
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 先載入下面程式
//    include($MAIN_BASE_ADDRESS . "Project/WinHappy/array/Array_Bet_Ball_List.inc") ;        // 載入專案處理狀況
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Bet_Ball_List)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Bet_Ball_List[$COUNT_ARRAY] == $LIST[] ? $TEMP = "    <option value=\"$Array_Bet_Ball_List[$COUNT_ARRAY]\" selected>$Array_Bet_Ball_List[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Bet_Ball_List[$COUNT_ARRAY]\">$Array_Bet_Ball_List[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "    <option value=\"$COUNT_ARRAY\" selected>$Array_Bet_Ball_List[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Bet_Ball_List[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Bet_Ball_List ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Bet_Ball_List[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>專案處理狀況:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

	// 投注球號類別-Array_Bet_Ball_List
	// 大小【超級】 , 單雙【超級】 , 大小
	// 3_0||一星連碰||4_0||二星連碰||5_0||三星連碰||6_0||四星連碰||7_0||五星||0_0||超級號碼大小[大]||0_1||超級號碼大小[小]||1_0||超級號碼單雙[單]||1_1||超級號碼單雙[雙]||2_0||猜大小[大]||2_1||猜大小[小]:
//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Bet_Ball_List['0_0'] = "大<span class='WinHappy_Bet_Ball_List_Green'>【超級】</span>" ;
$Array_Bet_Ball_List['0_1'] = "小<span class='WinHappy_Bet_Ball_List_Green'>【超級】</span>" ;
$Array_Bet_Ball_List['1_0'] = "單<span class='WinHappy_Bet_Ball_List_Green'>【超級】</span>" ;
$Array_Bet_Ball_List['1_1'] = "雙<span class='WinHappy_Bet_Ball_List_Green'>【超級】</span>" ;
$Array_Bet_Ball_List['2_0'] = "大" ;
$Array_Bet_Ball_List['2_1'] = "小" ;
$Array_Bet_Ball_List['3_0'] = "" ;
$Array_Bet_Ball_List['4_0'] = "" ;
$Array_Bet_Ball_List['5_0'] = "" ;
$Array_Bet_Ball_List['6_0'] = "" ;
$Array_Bet_Ball_List['7_0'] = "" ;
//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

<?
// ############ ########## ########## ############
// ## 財神九仔生-房間編號							##
// ############ ########## ########## ############
// 程式功能 : 房間編號
// 版    本 : V0.1
// 作    者 : 杜宇龍
// 修改時間 : 2020/07/31
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 先載入下面程式
//    include($MAIN_BASE_ADDRESS . "Project/GodNine/array/Array_Room_Type.inc") ;        // 房間編號
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Bet_Type)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Room_Type[$COUNT_ARRAY] == $LIST[] ? $TEMP = "    <option value=\"$Array_Room_Type[$COUNT_ARRAY]\" selected>$Array_Room_Type[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Room_Type[$COUNT_ARRAY]\">$Array_Room_Type[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "    <option value=\"$COUNT_ARRAY\" selected>$Array_Room_Type[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Room_Type[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Room_Type ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Room_Type[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>專案處理狀況:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

// 房間編號
//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Room_Type['0050'] = "A" ;
$Array_Room_Type['0100'] = "B" ;
$Array_Room_Type['0300'] = "C" ;
$Array_Room_Type['0500'] = "D" ;
$Array_Room_Type['1000'] = "E" ;
//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

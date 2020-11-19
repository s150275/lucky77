<?
// ############ ########## ########## ############
// ## 常用的陣列-字母				##
// ############ ########## ########## ############
// 程式功能 : 字母
// 版    本 : V0.2
// 作    者 : 杜宇龍
// 修改時間 : 2009/08/25
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 在程式一開始先載入設定資料
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Char.inc") ;        // 載入字母資料
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Char)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Char[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$Array_Char[$COUNT_ARRAY]\" selected>$Array_Char[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Char[$COUNT_ARRAY]\">$Array_Char[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "     <option value=\"$COUNT_ARRAY\" selected>$Array_Char[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Char[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Char ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Char[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>字母:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Char[0] = "請選擇" ;
$Array_Char[1] = "A" ;
$Array_Char[2] = "B" ;
$Array_Char[3] = "C" ;
$Array_Char[4] = "D" ;
$Array_Char[5] = "E" ;
$Array_Char[6] = "F" ;
$Array_Char[7] = "G" ;
$Array_Char[8] = "H" ;
$Array_Char[9] = "I" ;
$Array_Char[10] = "J" ;
$Array_Char[11] = "K" ;
$Array_Char[12] = "L" ;
$Array_Char[13] = "M" ;
$Array_Char[14] = "N" ;
$Array_Char[15] = "O" ;
$Array_Char[16] = "P" ;
$Array_Char[17] = "Q" ;
$Array_Char[18] = "R" ;
$Array_Char[19] = "S" ;
$Array_Char[20] = "T" ;
$Array_Char[21] = "U" ;
$Array_Char[22] = "V" ;
$Array_Char[23] = "W" ;
$Array_Char[24] = "X" ;
$Array_Char[25] = "Y" ;
$Array_Char[26] = "Z" ;
//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

<?
// ############ ########## ########## ############
// ## 常用的陣列-課程架構-選別			##
// ############ ########## ########## ############
// 程式功能 : 課程架構-選別
// 版    本 : V0.1
// 作    者 : 杜宇龍
// 修改時間 : 2011/06/10
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 先載入下面程式
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Classification.inc") ;        // 載入課程架構-選別
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Classification)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Classification[$COUNT_ARRAY] == $LIST[] ? $TEMP = "    <option value=\"$Array_Classification[$COUNT_ARRAY]\" selected>$Array_Classification[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Classification[$COUNT_ARRAY]\">$Array_Classification[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "    <option value=\"$COUNT_ARRAY\" selected>$Array_Classification[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Classification[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Classification ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Classification[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>專案處理狀況:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Classification[1] = "所必修" ;
$Array_Classification[2] = "組必修" ;
$Array_Classification[3] = "組選修" ;
$Array_Classification[4] = "選修" ;
$Array_Classification[5] = "補修" ;
$Array_Classification[6] = "總結" ;
//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

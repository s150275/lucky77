<?
// ############ ########## ########## ############
// ## 常用的陣列-社區資訊			##
// ############ ########## ########## ############
// 程式功能 : 社區資訊
// 版    本 : V0.2
// 作    者 : 杜宇龍
// 修改時間 : 2009/08/25
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 先載入下面程式
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Community.inc") ;        // 載入社區資訊
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Community)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Community[$COUNT_ARRAY] == $LIST[] ? $TEMP = "    <option value=\"$Array_Community[$COUNT_ARRAY]\" selected>$Array_Community[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Community[$COUNT_ARRAY]\">$Array_Community[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $Array_Community[$COUNT_ARRAY] == $LIST[] ? $TEMP = "    <option value=\"$COUNT_ARRAY\" selected>$Array_Community[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Community[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Community ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Community[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>社區資訊:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

// 要參考"臺灣城市資料"來作設定
//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Community[0] = "請選擇" ;
$Array_Community[C05001] = "夏目漱石" ;
$Array_Community[C05002] = "百溱觀" ;
$Array_Community[C05003] = "天尊" ;
$Array_Community[C05004] = "百溱觀" ;
$Array_Community[C05005] = "層峰" ;
//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

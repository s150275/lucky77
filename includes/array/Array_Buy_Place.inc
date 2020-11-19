<?
// ############ ########## ########## ############
// ## 常用的陣列-購買地點			##
// ############ ########## ########## ############
// 程式功能 : 購買地點
// 版    本 : V0.1
// 作    者 : 杜宇龍
// 修改時間 : 2010/04/14
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 在程式一開始先載入設定資料
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Buy_Place.inc") ;        // 購買地點
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Buy_Place)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Buy_Place[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$Array_Buy_Place[$COUNT_ARRAY]\" selected>$Array_Buy_Place[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Buy_Place[$COUNT_ARRAY]\">$Array_Buy_Place[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $Array_Buy_Place[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$COUNT_ARRAY\" selected>$Array_Buy_Place[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Buy_Place[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Buy_Place ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Buy_Place[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>資產類別:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Buy_Place[] = "請選擇" ;
$Array_Buy_Place[] = "其它" ;
$Array_Buy_Place[] = "贈品" ;
$Array_Buy_Place[] = "大買場" ;
$Array_Buy_Place[] = "傳統市場" ;
$Array_Buy_Place[] = "超市" ;
$Array_Buy_Place[] = "10商店" ;
$Array_Buy_Place[] = "書局" ;
$Array_Buy_Place[] = "超商水果行" ;
//$Array_Buy_Place[] = "" ;


//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

<?
// ############ ########## ########## ############
// ## 常用的陣列-資產類別			##
// ############ ########## ########## ############
// 程式功能 : 資產類別
// 版    本 : V0.2
// 作    者 : 杜宇龍
// 修改時間 : 2009/08/25
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 在程式一開始先載入設定資料
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Assets_Type.inc") ;        // 載入資產類別
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Assets_Type)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Assets_Type[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$Array_Assets_Type[$COUNT_ARRAY]\" selected>$Array_Assets_Type[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Assets_Type[$COUNT_ARRAY]\">$Array_Assets_Type[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "     <option value=\"$COUNT_ARRAY\" selected>$Array_Assets_Type[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Assets_Type[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Assets_Type ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Assets_Type[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>資產類別:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Assets_Type[0] = "請選擇" ;
$Array_Assets_Type[1] = "其它" ;
$Array_Assets_Type[2] = "電腦產品" ;
$Array_Assets_Type[3] = "電腦週邊" ;
$Array_Assets_Type[4] = "網路設備" ;
$Array_Assets_Type[5] = "電話設備" ;
$Array_Assets_Type[6] = "辨公用品" ;
$Array_Assets_Type[7] = "攝影器材" ;
$Array_Assets_Type[8] = "電子產品" ;
$Array_Assets_Type[9] = "保全產品" ;
$Array_Assets_Type[10] = "檢測器材" ;
$Array_Assets_Type[11] = "電源設備" ;
$Array_Assets_Type[12] = "工具用品" ;
$Array_Assets_Type[13] = "家具" ;
//$Array_Assets_Type[] = "" ;


//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

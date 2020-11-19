<?
// ############ ########## ########## ############
// ## 常用的陣列-臺灣城市資料(簡單版)		##
// ############ ########## ########## ############
// 程式功能 : 設定臺灣的縣市資料
// 版    本 : V0.2
// 作    者 : 杜宇龍
// 修改時間 : 2009/08/25
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 在程式一開始先載入設定資料
//    include($MAIN_BASE_ADDRESS . "includes/inc/array/Array_City_Sample.inc") ;        // 載入臺灣城市資料(簡單版)
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "    <td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_City_Sample)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_City_Sample[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$Array_City_Sample[$COUNT_ARRAY]\" selected>$Array_City_Sample[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_City_Sample[$COUNT_ARRAY]\">$Array_City_Sample[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "     <option value=\"$COUNT_ARRAY\" selected>$Array_City_Sample[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_City_Sample[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "    </td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_City_Sample ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_City_Sample[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>臺灣城市:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_City_Sample[0] = "請選擇" ;
$Array_City_Sample[1] = "其他" ;
$Array_City_Sample[2] = "基隆" ;
$Array_City_Sample[3] = "台北" ;
$Array_City_Sample[4] = "桃園" ;
$Array_City_Sample[5] = "新竹" ;
$Array_City_Sample[6] = "苗栗" ;
$Array_City_Sample[7] = "南投" ;
$Array_City_Sample[8] = "台中" ;
$Array_City_Sample[9] = "彰化" ;
$Array_City_Sample[10] = "雲林" ;
$Array_City_Sample[11] = "嘉義" ;
$Array_City_Sample[12] = "台南" ;
$Array_City_Sample[13] = "高雄" ;
$Array_City_Sample[14] = "屏東" ;
$Array_City_Sample[15] = "宜蘭" ;
$Array_City_Sample[16] = "花蓮" ;
$Array_City_Sample[17] = "台東" ;
$Array_City_Sample[18] = "澎湖" ;
$Array_City_Sample[19] = "金門" ;
$Array_City_Sample[20] = "連江" ;
//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

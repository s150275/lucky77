<?
// ############ ########## ########## ############
// ## 常用的陣列-臺灣城市資料			##
// ############ ########## ########## ############
// 程式功能 : 設定臺灣的縣市資料
// 版    本 : V0.2
// 作    者 : 杜宇龍
// 修改時間 : 2009/08/25
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 在程式一開始先載入設定資料
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_City.inc") ;        // 載入城市資料
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_City)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_City[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$Array_City[$COUNT_ARRAY]\" selected>$Array_City[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_City[$COUNT_ARRAY]\">$Array_City[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "     <option value=\"$COUNT_ARRAY\" selected>$Array_City[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_City[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_City ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_City[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>臺灣城市:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//$Array_City[0] = "請選擇" ;
//$Array_City[1] = "基隆市" ;
//$Array_City[2] = "台北市" ;
//$Array_City[3] = "台北縣" ;
//$Array_City[4] = "桃園縣" ;
//$Array_City[5] = "新竹市" ;
//$Array_City[6] = "新竹縣" ;
//$Array_City[7] = "苗栗縣" ;
//$Array_City[8] = "台中市" ;
//$Array_City[9] = "台中縣" ;
//$Array_City[10] = "南投縣" ;
//$Array_City[11] = "彰化縣" ;
//$Array_City[12] = "雲林縣" ;
//$Array_City[13] = "嘉義市" ;
//$Array_City[14] = "嘉義縣" ;
//$Array_City[15] = "台南市" ;
//$Array_City[16] = "台南縣" ;
//$Array_City[17] = "高雄市" ;
//$Array_City[18] = "高雄縣" ;
//$Array_City[19] = "屏東縣" ;
//$Array_City[20] = "宜蘭縣" ;
//$Array_City[21] = "花蓮縣" ;
//$Array_City[22] = "台東縣" ;
//$Array_City[23] = "澎湖縣" ;
//$Array_City[24] = "金門縣" ;
//$Array_City[25] = "連江縣" ;
//$Array_City[26] = "其他" ;
//
$Array_City['A'] = "臺北市" ;
$Array_City['B'] = "臺中市" ;
$Array_City['C'] = "基隆市" ;
$Array_City['D'] = "臺南市" ;
$Array_City['E'] = "高雄市" ;
$Array_City['F'] = "新北市" ;
$Array_City['G'] = "宜蘭縣" ;
$Array_City['H'] = "桃園市" ;
$Array_City['I'] = "嘉義市" ;
$Array_City['J'] = "新竹縣" ;
$Array_City['K'] = "苗栗縣" ;
$Array_City['M'] = "南投縣" ;
$Array_City['N'] = "彰化縣" ;
$Array_City['O'] = "新竹市" ;
$Array_City['P'] = "雲林縣" ;
$Array_City['Q'] = "嘉義縣" ;
$Array_City['T'] = "屏東縣" ;
$Array_City['U'] = "花蓮縣" ;
$Array_City['V'] = "臺東縣" ;
$Array_City['W'] = "金門縣" ;
$Array_City['X'] = "澎湖縣" ;
$Array_City['Z'] = "連江縣" ;

//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

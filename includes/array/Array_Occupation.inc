<?
// ############ ########## ########## ############
// ## 常用的陣列-職業資料			##
// ############ ########## ########## ############
// 程式功能 : 設定職業資料
// 版    本 : V0.2
// 作    者 : 杜宇龍
// 修改時間 : 2009/08/25
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 先載入下面程式
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Occupation.inc") ;        // 載入職業資料
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Occupation)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Occupation[$COUNT_ARRAY] == $LIST[] ? $TEMP = "    <option value=\"$Array_Occupation[$COUNT_ARRAY]\" selected>$Array_Occupation[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Occupation[$COUNT_ARRAY]\">$Array_Occupation[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "    <option value=\"$COUNT_ARRAY\" selected>$Array_Occupation[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Occupation[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Occupation ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Occupation[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>職業:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Occupation[0] = "請選擇" ;
$Array_Occupation[1] = "學生" ;
$Array_Occupation[2] = "自由業" ;
$Array_Occupation[3] = "金融業" ;
$Array_Occupation[4] = "軍公教" ;
$Array_Occupation[5] = "資訊業" ;
$Array_Occupation[6] = "服務業" ;
$Array_Occupation[7] = "傳播業" ;
$Array_Occupation[8] = "零售業" ;
$Array_Occupation[9] = "製造業" ;
$Array_Occupation[10] = "其他" ;
//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

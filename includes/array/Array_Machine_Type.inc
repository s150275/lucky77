<?
// ############ ########## ########## ############
// ## 常用的陣列-機器屬性資料			##
// ############ ########## ########## ############
// 程式功能 : 設定機器屬性資料
// 版    本 : V0.2
// 作    者 : 杜宇龍
// 修改時間 : 2009/08/25
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 先載入下面程式
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Machine_Type.inc") ;        // 載入機器屬性資料
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Machine_Type)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Machine_Type[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$Array_Machine_Type[$COUNT_ARRAY]\" selected>$Array_Machine_Type[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Machine_Type[$COUNT_ARRAY]\">$Array_Machine_Type[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "     <option value=\"$COUNT_ARRAY\" selected>$Array_Machine_Type[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Machine_Type[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Machine_Type ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Machine_Type[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>機器屬性:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Machine_Type[0] = "請選擇" ;
$Array_Machine_Type[1] = "社區" ;
$Array_Machine_Type[2] = "私人" ;
$Array_Machine_Type[3] = "公司" ;
$Array_Machine_Type[4] = "IS2000" ;
$Array_Machine_Type[5] = "乙太網路" ;
$Array_Machine_Type[6] = "DGI" ;
$Array_Machine_Type[7] = "KGB" ;
$Array_Machine_Type[8] = "網路影音系統" ;
//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

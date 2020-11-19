<?
// ############ ########## ########## ############
// ## 常用的陣列-Log狀態			##
// ############ ########## ########## ############
// 程式功能 : Log狀態
// 版    本 : V0.1
// 作    者 : 杜宇龍
// 修改時間 : 2009/09/24
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 在程式一開始先載入設定資料
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Log_State.inc") ;        // 載入Log狀態
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Log_State)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Log_State[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$Array_Log_State[$COUNT_ARRAY]\" selected>$Array_Log_State[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Log_State[$COUNT_ARRAY]\">$Array_Log_State[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $Array_Log_State[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$COUNT_ARRAY\" selected>$Array_Log_State[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Log_State[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Log_State ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Log_State[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>Log狀態:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Log_State[] = "請選擇" ;
$Array_Log_State[] = "登入成功" ;
$Array_Log_State[] = "登入失敗" ;
$Array_Log_State[] = "登出成功" ;
$Array_Log_State[] = "登出失敗" ;
$Array_Log_State[] = "查詢成功" ;
$Array_Log_State[] = "查詢失敗" ;
$Array_Log_State[] = "新增成功" ;
$Array_Log_State[] = "新增失敗" ;
$Array_Log_State[] = "修改成功" ;
$Array_Log_State[] = "修改失敗" ;
$Array_Log_State[] = "刪除成功" ;
$Array_Log_State[] = "刪除失敗" ;
//$Array_Log_State[] = "" ;

//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

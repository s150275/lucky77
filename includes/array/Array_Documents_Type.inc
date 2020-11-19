<?
// ############ ########## ########## ############
// ## 常用的陣列-文件格式			##
// ############ ########## ########## ############
// 程式功能 : 資產類別
// 版    本 : V0.2
// 作    者 : 杜宇龍
// 修改時間 : 2009/08/25
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 先載入下面程式
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Documents_Type.inc") ;        // 載入文件格式
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Documents_Type)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Documents_Type[$COUNT_ARRAY] == $LIST[] ? $TEMP = "    <option value=\"$Array_Documents_Type[$COUNT_ARRAY]\" selected>$Array_Documents_Type[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Documents_Type[$COUNT_ARRAY]\">$Array_Documents_Type[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $Array_Documents_Type[$COUNT_ARRAY] == $LIST[] ? $TEMP = "    <option value=\"$COUNT_ARRAY\" selected>$Array_Documents_Type[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Documents_Type[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Documents_Type ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Documents_Type[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>文件格式:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Documents_Type[0] = "請選擇" ;
$Array_Documents_Type[] = "其它" ;
$Array_Documents_Type[] = "公司重要文件" ;
$Array_Documents_Type[] = "技術文件" ;
$Array_Documents_Type[] = "操作手冊" ;
$Array_Documents_Type[] = "會議記錄" ;
$Array_Documents_Type[] = "出貨記錄" ;
$Array_Documents_Type[] = "進貨記錄" ;
$Array_Documents_Type[] = "完工報告" ;
$Array_Documents_Type[] = "借貨單" ;
$Array_Documents_Type[] = "產品維修" ;
$Array_Documents_Type[] = "資產盤點" ;
$Array_Documents_Type[] = "報價單" ;
$Array_Documents_Type[] = "換貨單" ;
//$Array_Documents_Type[] = "" ;

//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

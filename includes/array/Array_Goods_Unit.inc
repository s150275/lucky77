<?
// ############ ########## ########## ############
// ## 常用的陣列-產品單位			##
// ############ ########## ########## ############
// 程式功能 : 產品單位
// 版    本 : V0.1
// 作    者 : 杜宇龍
// 修改時間 : 2010/04/14
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 在程式一開始先載入設定資料
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Goods_Unit.inc") ;        // 產品單位
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Goods_Unit)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Goods_Unit[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$Array_Goods_Unit[$COUNT_ARRAY]\" selected>$Array_Goods_Unit[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Goods_Unit[$COUNT_ARRAY]\">$Array_Goods_Unit[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "     <option value=\"$COUNT_ARRAY\" selected>$Array_Goods_Unit[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Goods_Unit[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Goods_Unit ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Goods_Unit[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>資產類別:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Goods_Unit[0] = "請選擇" ;
$Array_Goods_Unit[1] = "個" ;
$Array_Goods_Unit[2] = "100g" ;
$Array_Goods_Unit[3] = "100cc" ;
//包,罐,台,盒,組,粒,箱,瓶,串,條,尾,件,顆,袋,支,桶,杯,把,片,隻,塊,份,本,張,雙
//$Array_Goods_Unit[] = "" ;


//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

<?
// ############ ########## ########## ############
// ## 常用的陣列-站肉查詢			##
// ############ ########## ########## ############
// 程式功能 : 站肉查詢
// 版    本 : V0.1
// 作    者 : 杜宇龍
// 修改時間 : 2012/12/15
// 相關檔案 : 無
// 發現問題 : 沒發現
// 設定方法 :
//    // 在程式一開始先載入設定資料
//    include($MAIN_BASE_ADDRESS . "includes/array/Array_Search_Info.inc") ;        // 載入站肉查詢
// 使用方法 :
//    // 需要有SELECT欄位時
//    echo "<td>\n" ;
//    echo "    <select name=\"INPUT_\">\n" ;
//    for($COUNT_ARRAY = 0 ; $COUNT_ARRAY < sizeof($Array_Search_Info)  ; $COUNT_ARRAY++)
//    {
//        // 以說明文字來寫入資料庫
//        $Array_Search_Info[$COUNT_ARRAY] == $LIST[] ? $TEMP = "     <option value=\"$Array_Search_Info[$COUNT_ARRAY]\" selected>$Array_Search_Info[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$Array_Search_Info[$COUNT_ARRAY]\">$Array_Search_Info[$COUNT_ARRAY]</option>\n" ;
//        // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//        $COUNT_ARRAY == $LIST[] ? $TEMP = "     <option value=\"$COUNT_ARRAY\" selected>$Array_Search_Info[$COUNT_ARRAY]</option>\n" : $TEMP = "    <option value=\"$COUNT_ARRAY\">$Array_Search_Info[$COUNT_ARRAY]</option>\n" ;
//        echo "$TEMP" ;
//    }
//    echo "    </select>\n" ;
//    echo "</td>\n" ;
//    PS : 如果是在新增,刪除,修改副程式中的話,需要加上global $Array_Search_Info ;
//
//    // 只需秀出資料時
//    // 以說明文字來寫入資料庫
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $LIST[] ;
//    // 以陣列位置來寫入資料庫(如果有修改說明文字或順序的話,有可能會造成資料錯亂)
//    empty($LIST[]) ? $MAIN_DATA = "　" : $MAIN_DATA = $Array_Search_Info[$LIST[]] ;
//    echo "<tr bgcolor=\"\">\n" ;
//    echo "    <td valign=\"top\" width=\"20%\"><font color=\"0000FF\"><b>資產類別:</b></font></td>\n" ;
//    echo "    <td valign=\"top\" width=\"80%\">$MAIN_DATA</td>\n" ;
//    echo "</tr>\n" ;

// 格式:查詢名稱||查詢檔名||資料庫名稱||主要欄位||其它欄位...
//~@_@~// START  ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
$Array_Search_Info[0] = "請選擇" ;
$Array_Search_Info[1] = "全部" ;
$Array_Search_Info[2] = "最新公告||c-news.php||news||news_Subject||news_Content||news_Subject_e||news_Content_e" ;
$Array_Search_Info[3] = "師資人員||c-teacher.php||teacher||teacher_Subject||teacher_Content||teacher_Field_Title||teacher_Field_professional||teacher_Field_Field||teacher_Field_Degrees||teacher_Field_From||teacher_Field_Other||teacher_Subject_e||teacher_Content_e||teacher_Field_Title_e||teacher_Field_professional_e||teacher_Field_Field_e||teacher_Field_Degrees_e||teacher_Field_From_e||teacher_Field_Other_e" ;
$Array_Search_Info[4] = "近年校友||c-alumni.php||alumni||alumni_Student||alumni_Subject||alumni_teacher1||alumni_teacher2||alumni_Student_e||alumni_Subject_e||alumni_teacher1_e||alumni_teacher2_e" ;
$Array_Search_Info[5] = "入學資訊||c-matriculation.php||matriculation||matriculation_Subject||matriculation_Content||matriculation_Subject_e||matriculation_Content_e" ;
$Array_Search_Info[6] = "錄取榜單||f-enrollment-e.php||enrollment||enrollment_Subject||enrollment_Content||enrollment_Subject_e||enrollment_Content_e" ;
$Array_Search_Info[7] = "國際生入學||f-foreign_student.php||foreign_student||foreign_student_Subject||foreign_student_Content||foreign_student_Subject_e||foreign_student_Content_e" ;
$Array_Search_Info[8] = "音樂論壇||c-forum.php||forum||forum_Subject||forum_Speaking||forum_Title||forum_Place1||forum_Place2||forum_Content||forum_Subject_e||forum_Speaking_e||forum_Title_e||forum_Place1_e||forum_Place2_e||forum_Content_e" ;
$Array_Search_Info[9] = "表格資料||c-download.php||download||download_Subject||download_Subject_e" ;
$Array_Search_Info[10] = "學生榮譽||c-honor.php||honor||honor_Subject||honor_Subject_e" ;
$Array_Search_Info[11] = "活動記錄||c-record.php||record||record_Subject||record_Content||record_Subject_e||record_Content_e" ;
$Array_Search_Info[12] = "學期課程介紹||f-course.php||course||course_Subject||course_Content||course_Detail||course_Subject_e||course_Content_e||course_Detail_e||course_Teacher" ;
$Array_Search_Info[13] = "課程規劃表||f-courseList.php||courseList||courseList_Subject||courseList_PS||courseList_Subject_e||courseList_PS_e" ;
$Array_Search_Info[14] = "修業規章||f-rules.php||rules||rules_Subject||rules_Content||rules_Subject_e||rules_Content_e" ;
$Array_Search_Info[15] = "課程架構||f-framework.php||framework||framework_Subject||framework_PS||framework_Subject_e||framework_PS_e" ;
//$Array_Search_Info[] = "" ;


//~@_@~// END  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
?>

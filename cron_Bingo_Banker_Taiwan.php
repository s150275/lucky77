<?php
/*
★ 程式開始 , ★ 建立資料庫連線 
*/

//$data .= "hello " . date("Y-m-d H:i:s") . "\r\n"; //要寫入txt的資料 
////#註解: \r\n 可用來換行
//$dir="/home/shopingm/public_html/casino/";  //設定文件路徑
////$dir="./";  //設定文件路徑
//$filename = $dir.'test.txt'; //設定路徑加上要輸出的名稱 (此處以 test.txt 為例)
//if(@$fp = fopen($filename, 'a+'))
//{
////寫入資料
//fwrite($fp, $data);
//fclose($fp);
// 
//}
//
//file_put_contents($dir."test1.txt", date("Y-m-d H:i:s") . "\r\n", FILE_APPEND);  

// http://linebot.wolong.bixone.com/cron_Bot_ChatInfo.php

// ############ ########## ########## ############
// ## 設定基本變數				##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "每天排程-長莊位置-台灣彩卷" ;	// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "./" ;			// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;				// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "Banker2" ;			// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "cron_Bingo_Banker_Taiwan.php" ;	// 設定本程式的檔名
$MAIN_CHECK_FIELD       = "id_Banker" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;				// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_PROGRAM_TYPE	= "A1" ;				// 設定此網頁是否為管理模式-0:不管制,A:一般管制(1111),P:程式權限管制(根據System_LevelP的設定),程式模式(0:一般模式,1:管理模式...)
$MAIN_NOW_TIME          = date("Y-m-d H:i:s") ;		// 取得現在的時間
$MAIN_NOW_DATE          = date("Y-m-d") ;		// 取得現在的日期

$tmpShowMsg = 1 ;		// 是否要在網頁秀出除錯資料(1:秀出,0:不秀)
//if ( $tmpShowMsg ){echo "<p class='ylduShowMsg'>$tmp_Database_Funct<p>";print_r($LIST_return);}	// 秀出除錯訊息 ██████████
//if ( $tmpShowMsg ){echo "<p class='ylduShowMsg'>$tmp_Database_Funct<p>";}	// 秀出除錯訊息 ██████████
//if ( $tmpShowMsg ){echo "<span>$tmp_Database_Funct</span>";}	// 秀出除錯訊息 ██████████
$tmp_Add_Database = "1" ;		// 1:加入資料庫,0:不加入資料庫

$BasePath = dirname(dirname(__FILE__)) ;
$NowPath = dirname(__FILE__) ;
if ( $tmpShowMsg or 1 ) {	"完整路徑 : " . $NowPath . "<br>";	}	// 秀出除錯訊息 ██████████

// ############ ########## ########## ############
// ## 載入模組					##
// ############ ########## ########## ############
include( $NowPath . "/includes/conn.php") ;
include( $NowPath . "/includes/func.php") ;
include( $NowPath . "/Project/WinHappy/func_WinHappy.php") ;
include( $NowPath . "/Project/GodNine/func_GodNine.php");

//$array['NowPath'] = dirname( __FILE__ ) ;
//echo "完整路徑 : " . $NowPath . "<br>";
//$array['LastPath'] = dirname(dirname( __FILE__ )) ;
////echo "上層路徑 : " . $array['LastPath'] . "<br>";
//$array['NowDir'] = str_replace ( $array['LastPath'] . "/" , "" , $array['NowPath']);
//print_r($array);
//echo "1111" ;

// 測試訊息用
//$LIST_OrderInfo_Reward_Day['OrderInfo_ID'] = "Order123456" ;
//$tmp_Recommend_Reward_Point = "100" ;
//$value = "100001" ;
//$Store_Name = "測試1" ;
//
//// 送給line的資料
//$arrayFormatText[] = array(
//	"type" => "text",
//	"text" => "非常感謝您本次於 $Store_Name 線上消費\n\n".
//		"訂單號碼 : " . $LIST_OrderInfo_Reward_Day['OrderInfo_ID'] . "\n\n".
//		"獲得點數 : " . $tmp_Recommend_Reward_Point . "點\n\n".
//		date("Y-m-d H:i:s") . "\n\n".
//
//		"為提昇本公司之服務品質及售後服務滿意度，請您撥空填寫以下連結之滿意度調查表。\n\n".
//		"http://w" . $value . "." . $Conn_Base_URL ."/link/question/" . $LIST_OrderInfo_Reward_Day['OrderInfo_ID'] . "/2.html\n\n".
//		"有您的建議，我們會盡力改善並不斷的改進。謝謝您\n\n"
//);
////echo "<p>推播內容</p>" ;
//print_r($arrayFormatText);
//
//// 設定訂購者LineID
//$arrayLineId[] = "U88d84d7cf2d4a3a37da63dea2e59fde8" ;
//$arrayLineId[] = "U4f3aa4385b23a9cf38595812c30e39a4" ;	// ruby
//// 暫時關閉
//sentOneLineMsg( $arrayFormatText , $arrayLineId );
//exit;

$PUBLIC_DB_PAGE_NUM		= "10" ;			// 每頁秀出的筆數
$PUBLIC_DB_SPLIT_CHAR	= "\|\|" ;			// 設定"分頁"時欄位之間的分隔符號，怕以後會有衝
date_default_timezone_set('Asia/Taipei');//指定主機時區

$MAIN_NOW_DATE = date("Y-m-d");
$MAIN_NOW_TIME = date("Y-m-d H:i:s");

// ############ ########## ########## ############
// ## 程式開始									##
// ############ ########## ########## ############
// 是否由cron來執行 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//if($argv[1]=="wosmarty" && $argv[2]=="8c4e5026521414162f474c7d92097579da36" && $argv[3]=="go")


// 是否已有抓到上一期獎號
$array_BingoPeriod = WinHappy_checkBingoPeriod() ;		// 判斷Bingo期號
echo "<p></p>" ;print_r($array_BingoPeriod);echo "<br>" ;

$tmp_array_Banker_Seat = array();
$array_Banker_Seat = array();
$State_Name = "";
$Table=array(array("Id"=>0,"Name"=>"A桌","Set"=>"1,2"),array("Id"=>1,"Name"=>"B桌","Set"=>"3,4"),array("Id"=>2,"Name"=>"C桌","Set"=>"5,6"),array("Id"=>3,"Name"=>"D桌","Set"=>"7,8"),array("Id"=>4,"Name"=>"E桌","Set"=>"9,10"),array("Id"=>5,"Name"=>"F桌","Set"=>"11,12"),array("Id"=>6,"Name"=>"G桌","Set"=>"13,14"),array("Id"=>7,"Name"=>"H桌","Set"=>"15,16"),array("Id"=>8,"Name"=>"I桌","Set"=>"17,18"),array("Id"=>9,"Name"=>"J桌","Set"=>"19,20"),array("Id"=>10,"Name"=>"K桌","Set"=>"21,22"),array("Id"=>11,"Name"=>"L桌","Set"=>"23,24"),array("Id"=>12,"Name"=>"M桌","Set"=>"25,26"),array("Id"=>13,"Name"=>"N桌","Set"=>"27,28"),array("Id"=>14,"Name"=>"O桌","Set"=>"29,30"),array("Id"=>15,"Name"=>"P桌","Set"=>"31,32"),array("Id"=>16,"Name"=>"Q桌","Set"=>"33,34"),array("Id"=>17,"Name"=>"R桌","Set"=>"35,36"),array("Id"=>18,"Name"=>"S桌","Set"=>"37,38"),array("Id"=>19,"Name"=>"T桌","Set"=>"39,40"));
	
//找出莊家為值切換資料並將json解回Array
$tmp_BankerList_SQL = "SELECT ApplyBanker_Set_Array FROM Agent WHERE id_Agent=1" ; 
$array_BankerList_Info = func_DatabaseGet( $tmp_BankerList_SQL , "SQL" , "" )['ApplyBanker_Set_Array'];		// 取得資料庫資料
$array_BankerList_Info = json_decode($array_BankerList_Info,true);

$BankerList_State = $array_BankerList_Info['State'];

if($BankerList_State == "1")
{
	$tmp_array_Banker_Seat = array_values(shuffle_assoc($array_BankerList_Info['Banker_Info']));
}
else
{
	$tmp_array_Banker_Seat = $array_BankerList_Info['Banker_Info'];
}


//找出當日目前開獎期數
$tmp_BankerList_SQL1 = "SELECT * FROM `Banker2` ORDER BY Banker_Bingo_Period DESC" ; 
$array_BankerList_Info1 = func_DatabaseGet( $tmp_BankerList_SQL1 , "SQL" , "" );		// 取得資料庫資料
$Count_Banker = func_DatabaseGet( $tmp_BankerList_SQL1 , "COUNT" , "" ) ;		// 取得資料庫資料


$tamp_bs = 0;
	
for($z=0;$z<=203;$z++)
{	
	
	
	$New_banker_Start = $array_BankerList_Info1['Banker_Bingo_Period']+$z;
	$Bankset_Info = "SELECT * FROM `Banker2` WHERE Banker_Bingo_Period = '{$New_banker_Start}'";
	$array_Bankset_Info = func_DatabaseGet( $Bankset_Info , "SQL" , "" );		// 取得資料庫資料
	$Count_Bankset = func_DatabaseGet( $Bankset_Info , "COUNT" , "" ) ;		// 取得資料庫資料
	
	$arrayField1['Banker_Operator_Name'] = "系統";
	$arrayField1['Banker_Bingo_Period'] = $New_banker_Start;
	$arrayField1['Banker_Add_DT'] = date("Y-m-d H:i:s");
	
	if($z<=1)
	{
			
		if($BankerList_State=="-1")
		{
			//位置切換關閉的時候
			$arrayField1['Banker_Banker_Id'] = 19 ;
			$arrayField1['Banker_Banker_Table'] = "T桌" ;
			$arrayField1['Banker_Banker_Seats'] = "39,40" ;
				
		}
		else
		{
				
			//echo "數量測試:".$Bankset_Info."<br>";
			if($tamp_bs!=count($tmp_array_Banker_Seat))
			{
				$arrayField1['Banker_Banker_Id'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker_Id'] ;
				$arrayField1['Banker_Banker_Table'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker_Name'] ;
				$arrayField1['Banker_Banker_Seats'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker'] ;

				//echo $z."第".($array_BingoPeriod['NowBingo']+($z))."位置:".$tmp_array_Banker_Seat[$tamp_bs]['Banker_Name']."<br>";

			}
			else
			{
				if($tamp_bs==count($tmp_array_Banker_Seat))
				{
					$tamp_bs = 0;
				}

				$arrayField1['Banker_Banker_Id'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker_Id'] ;
				$arrayField1['Banker_Banker_Table'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker_Name'] ;
				$arrayField1['Banker_Banker_Seats'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker'] ;
				//echo $z."第".($array_BingoPeriod['NowBingo']+($z))."位置:".$tmp_array_Banker_Seat[$tamp_bs]['Banker_Name']."<br>";

			}
		}
			
			
		if($Count_Bankset<=0)
		{
			func_DatabaseBase( "Banker2" , "ADD" , $arrayField1, "") ;						// 資料庫處理
			//$tamp_bs = $z;
			echo "INSERT1 期數:".($New_banker_Start)."<br>";
			print_r($arrayField1);
			echo "<br>";
			
		}
		else
		{
			$tamp_bs = -1;
		}
			
			
	}
	else
	{
		if($BankerList_State=="-1")
		{
			//位置切換關閉的時候
			$arrayField1['Banker_Banker_Id'] = 19 ;
			$arrayField1['Banker_Banker_Table'] = "T桌" ;
			$arrayField1['Banker_Banker_Seats'] = "39,40" ;
			
		}
		else
		{
			//依序排序的時候
			if($tamp_bs!=count($tmp_array_Banker_Seat))
			{

				$arrayField1['Banker_Banker_Id'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker_Id'] ;
				$arrayField1['Banker_Banker_Table'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker_Name'] ;
				$arrayField1['Banker_Banker_Seats'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker'] ;
				//echo $z."第".($array_BingoPeriod['NowBingo']+($z))."位置:".$tmp_array_Banker_Seat[$tamp_bs]['Banker_Name']."<br>";

			}
			else
			{
				$tamp_bs = 0;

				$arrayField1['Banker_Banker_Id'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker_Id'] ;
				$arrayField1['Banker_Banker_Table'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker_Name'] ;
				$arrayField1['Banker_Banker_Seats'] = $tmp_array_Banker_Seat[$tamp_bs]['Banker'] ;
				//echo $z."第".($array_BingoPeriod['NowBingo']+($z))."位置:".$tmp_array_Banker_Seat[$tamp_bs]['Banker_Name']."<br>";

			}
			
		}
			
		//該期期數若無資料則新增莊家資訊，若有則更新該期莊家位置資訊
		if($Count_Bankset<=0)
		{
			func_DatabaseBase( "Banker2" , "ADD" , $arrayField1, "") ;						// 資料庫處理
			echo "INSERT2 期數:".($New_banker_Start)."<br>";
			print_r($arrayField1);
			echo "<br>";
		}
		else
		{
			
			echo "UPDATE 期數:".($New_banker_Start)."<br>";
			print_r($arrayField1);
			echo "<br>";	
			$Bankset_Update = "UPDATE `Banker2` SET Banker_Bingo_Period = '{$nowbank}', Banker_Banker_Id= '{$arrayField1['Banker_Banker_Id']}', Banker_Banker_Table= '{$arrayField1['Banker_Banker_Table']}', Banker_Banker_Seats= '{$arrayField1['Banker_Banker_Seats']}', Banker_Add_DT= '{$arrayField1['Banker_Add_DT']}' WHERE Banker_Bingo_Period = '{$New_banker_Start}'";
			$Bol_Agent = func_DatabaseGet( $Bankset_Update , "SQL" , "" );// 資料庫處理				
				
			//print_r($Bol_Agent);
				
		}
			
	}
	
	
	$tamp_bs++;
	
}
//print_r($New_banker_Start);

// 是否由cron來執行  ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

//打亂陣列排序
function shuffle_assoc($list) {  
	if (!is_array($list)) return $list;  
        $keys = array_keys($list);  
        shuffle($keys);  
        $random = array();  
        foreach ($keys as $key)  {
                $random[$key] = shuffle_assoc($list[$key]);  
    }
    return $random;  
}

?>

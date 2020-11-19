<?php
// ############ ########## ########## ############
// ## 設定基本變數									##
// ############ ########## ########## ############

$MAIN_PROGRAM_TITLE	= "帳務明細-詳細資料" ;			// 設定程式的TITLE文字
$MAIN_BASE_ADDRESS	= "" ;				// 設定檔案和首頁的相對位置
$MAIN_FILE_NAME_ADDRESS	= "" ;		// 設定本程式所在的路徑
$MAIN_DATABASE_NAME	= "" ;				// 設定本程式所使用的基本資料庫
$MAIN_FILE_NAME		= "reportDetail.php" ;			// 設定本程式的檔名
$MAIN_CHECK_FIELD   = "id_$MAIN_DATABASE_NAME" ;	// 設定資料庫的index
$MAIN_FILE_TYPE		= "c" ;					// 設定網頁的語系(c:中文,e:英文)
$MAIN_IMAGE_TITLE	= "$MAIN_DATABASE_NAME.gif" ;	// 設定本網頁的TITLE圖形
$MAIN_NOW_TIME      = date("Y-m-d H:i:s") ;	// 取得現在的時間
$MAIN_NOW_DATE      = date("Y-m-d") ;		// 取得現在的日期

// 財神九仔生
$MAIN_INCLUDE_NAME	= "reportDetail" ;				// 主要程式名稱

// ############ ########## ########## ############
// ## 載入模組									##
// ############ ########## ########## ############
include_once($MAIN_BASE_ADDRESS . "includes/conn.php");
include_once($MAIN_BASE_ADDRESS . "includes/func.php");
include_once($MAIN_BASE_ADDRESS . "Project/WinHappy/func_WinHappy.php");
include_once($MAIN_BASE_ADDRESS . "Project/GodNine/func_GodNine.php");

// ############ ########## ########## ############
// ## 讀取傳入參數									##
// ############ ########## ########## ############

$ARRAY_POST_GET_PARA[] = "Funct||*" ;
$ARRAY_POST_GET_PARA[] = "ID||*" ;
$ARRAY_POST_GET_PARA[] = "Type||*" ;
$ARRAY_POST_GET_PARA[] = "Para||*" ;

include_once($MAIN_BASE_ADDRESS . "includes/sub/sub_post_get.sub") ;	// 快速請取網頁傳來的參數

sub_post_get($ARRAY_POST_GET_PARA) ;

GodNine_checkMember() ;		// 限制遊戲會員存取頁面

// 載入首頁
include($MAIN_BASE_ADDRESS . "header.php") ;        // 載入首頁

// 輸贏狀態' ,		#::SELECT:2||0||未開獎||1||閒家贏||2||莊家贏:
$array_BetGodnine_WinLost_Type[0] = "未開獎" ;
$array_BetGodnine_WinLost_Type[1] = "閒家贏" ;
$array_BetGodnine_WinLost_Type[2] = "莊家贏" ;

echo "<main>\n";
echo "	<div class=\"mainWrap\">\n";
echo "		<h4>帳務明細-詳細資料</h4>\n";

echo "		<div class=\"table\">\n";
if( $Type == "Banker" )
{
	// Search_Date2020-07-27Banker_List
	// Funct + Para + Type
	// Funct=Search_Date&Para=$Para&Type=Banker_List
	echo "				<p style='text-align:center;'><a href='reportToday.php?Funct=Search_Date&Para=$Para&Search_Date=$Para&Type=' class='BTN-Report'>閒家帳務</a> <a href='reportToday.php?Funct=Search_Date&Para=$Para&Type=Banker_List' class='BTN-Report'>莊家帳務</a></p>" ;
}

echo "			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "			<tr>\n";
echo "				<th>投注時間</th>\n";
echo "				<th>選位/球號/結算</th>\n";
echo "				<th>贏家</th>\n";
echo "				<th>小計</th>\n";
echo "			</tr>\n";

$tmpSQL = "SELECT * FROM BetGodnine WHERE id_BetGodnine = '$ID'" ;
//$array_BetGodnine_Info = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料

if( $Type == "User" )
{// 查詢單一資料
	$tmpSQL = "SELECT * FROM BetGodnine WHERE id_BetGodnine = '$ID'" ;
	$array_BetGodnine_Info = func_DatabaseGet( $tmpSQL , "SQL" , "" ) ;		// 取得資料庫資料
	
	// 找出莊家資料
	$array_Banker_Info = func_DatabaseGet( "Banker" , "*" , array("Banker_Bingo_Period"=>$array_BetGodnine_Info['BetGodnine_Bingo_Period']) ) ;		// 取得資料庫資料
	
	// 找出Bingo資料
	$array_Bingo_Info = func_DatabaseGet( "Bingo" , "*" , array("Bingo_Period"=>$array_BetGodnine_Info['BetGodnine_Bingo_Period']) ) ;		// 取得資料庫資料
	// 開獎號碼
	$array_Bingo_Draw_Order_Num = str2array($array_Bingo_Info['Bingo_Draw_Order_Num'] , ",") ;
	// 開獎計算值
	$array_Bingo_Godnine_Calculate = str2array($array_Bingo_Info['Bingo_Godnine_Calculate'] , ",") ;
	// 開獎倍數值
	$array_Bingo_Godnine_Multiple = str2array($array_Bingo_Info['Bingo_Godnine_Multiple'] , ",") ;
	// 把10改成對子
	foreach( $array_Bingo_Godnine_Calculate as $key => $value )
	{
		if( $value == 10 )
		{	$array_Bingo_Godnine_Calculate[$key] = "對子" ;	}
	}


	$tmpSQL = "SELECT * FROM BetGodnine WHERE id_BetGodnine = '$ID' AND BetGodnine_On = '1' ORDER BY BetGodnine_Add_DT DESC" ;
	//$tmpSQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_BetGodnine_Info['BetGodnine_Bingo_Period']}'" ;
}
else
{// 查詢莊家資料
	// 找出莊家資料
	$array_Banker_Info = func_DatabaseGet( "Banker" , "*" , array("id_Banker"=>"$ID") ) ;		// 取得資料庫資料

	// 找出Bingo資料
	$array_Bingo_Info = func_DatabaseGet( "Bingo" , "*" , array("Bingo_Period"=>$array_Banker_Info['Banker_Bingo_Period']) ) ;		// 取得資料庫資料
	// 開獎號碼
	$array_Bingo_Draw_Order_Num = str2array($array_Bingo_Info['Bingo_Draw_Order_Num'] , ",") ;
	// 開獎計算值
	$array_Bingo_Godnine_Calculate = str2array($array_Bingo_Info['Bingo_Godnine_Calculate'] , ",") ;
	// 開獎倍數值
	$array_Bingo_Godnine_Multiple = str2array($array_Bingo_Info['Bingo_Godnine_Multiple'] , ",") ;

	// 把10改成對子
	foreach( $array_Bingo_Godnine_Calculate as $key => $value )
	{
		if( $value == 10 )
		{	$array_Bingo_Godnine_Calculate[$key] = "對子" ;	}
	}

	$tmpSQL = "SELECT * FROM BetGodnine WHERE BetGodnine_Bingo_Period = '{$array_Banker_Info['Banker_Bingo_Period']}' AND BetGodnine_Room = '{$array_Banker_Info['Banker_Room']}' AND BetGodnine_On = '1' ORDER BY BetGodnine_Add_DT DESC" ;
}

$Table = "";

$Table_info=array(array("Id"=>0,"Name"=>"A桌","Set"=>"1,2"),array("Id"=>1,"Name"=>"B桌","Set"=>"3,4"),array("Id"=>2,"Name"=>"C桌","Set"=>"5,6"),array("Id"=>3,"Name"=>"D桌","Set"=>"7,8"),array("Id"=>4,"Name"=>"E桌","Set"=>"9,10"),array("Id"=>5,"Name"=>"F桌","Set"=>"11,12"),array("Id"=>6,"Name"=>"G桌","Set"=>"13,14"),array("Id"=>7,"Name"=>"H桌","Set"=>"15,16"),array("Id"=>8,"Name"=>"I桌","Set"=>"17,18"),array("Id"=>9,"Name"=>"J桌","Set"=>"19,20"),array("Id"=>10,"Name"=>"K桌","Set"=>"21,22"),array("Id"=>11,"Name"=>"L桌","Set"=>"23,24"),array("Id"=>12,"Name"=>"M桌","Set"=>"25,26"),array("Id"=>13,"Name"=>"N桌","Set"=>"27,28"),array("Id"=>14,"Name"=>"O桌","Set"=>"29,30"),array("Id"=>15,"Name"=>"P桌","Set"=>"31,32"),array("Id"=>16,"Name"=>"Q桌","Set"=>"33,34"),array("Id"=>17,"Name"=>"R桌","Set"=>"35,36"),array("Id"=>18,"Name"=>"S桌","Set"=>"37,38"),array("Id"=>19,"Name"=>"T桌","Set"=>"39,40"));

//$SQL = "SELECT * FROM Member WHERE id_Member = '1'" ;
//echo $tmpSQL . "<br>" ; 
$QUERY = mysqli_query($link , $tmpSQL) ;

// 小計總合
$tmp_WinLost_Money_Total = 0 ;
// 是否有資料
if ( mysqli_num_rows($QUERY) )
{
    // 一條條獲取
    while ($LIST = mysqli_fetch_assoc($QUERY))
    {
		
		
		
		echo "			<tr>\n";
		echo "				<td>\n";
		echo "				<span>{$LIST['id_BetGodnine']}-" . mb_substr( $LIST['BetGodnine_Add_DT'] , 0 , 10 , "utf-8") . "</span><br>\n";
		echo "				<span>" . mb_substr( $LIST['BetGodnine_Add_DT'] , 11 , 8 , "utf-8") . "</span>\n";
		echo "				</td>\n";
		echo "				<td>\n";
		echo "				<span>閒:{$Table_info[($LIST['BetGodnine_Table']-1)]['Name']} / {$array_Bingo_Draw_Order_Num[$LIST['BetGodnine_Table']-1]} 、{$array_Bingo_Godnine_Calculate[$LIST['BetGodnine_Table']-1]} / ({$array_Bingo_Godnine_Multiple[$LIST['BetGodnine_Table']-1]})</span><br>\n";
		
		if( $LIST['BetGodnine_Type'] == 1 )// 輪莊有倍數區
		{	echo "				<span>莊:{$array_Banker_Info['Banker_Banker_Table']}桌 / {$array_Bingo_Draw_Order_Num[$array_Banker_Info['Banker_Banker_Table']-1]} 、 {$array_Bingo_Godnine_Calculate[$array_Banker_Info['Banker_Banker_Table']-1]} / ({$array_Bingo_Godnine_Multiple[$array_Banker_Info['Banker_Banker_Table']-1]}) </span>\n";	}
		else// 長莊無數區
		{	

			if((!$LIST['Banker_Table'])&&($LIST['Banker_Table']!=0))
			{
				$LIST['Banker_Table'] = 19;
				$Table = "T桌";
			}
			
			echo "				<span>莊:{$Table_info[$LIST['Banker_Table']]['Name']} / {$array_Bingo_Draw_Order_Num[$LIST['Banker_Table']]} 、 {$array_Bingo_Godnine_Calculate[$LIST['Banker_Table']]} / (1) </span>\n";	
		}
		
		echo "				</td>\n";
		echo "				<td>{$array_BetGodnine_WinLost_Type[$LIST['BetGodnine_WinLost_Type']]}</td>\n";
		if( $Type == "User" )
		{
			echo "				<td num=\"-500\">" . WinHappy_setMoneyCss( $LIST['BetGodnine_WinLost_Money'] , "Before" ) . "</td>\n";
			$tmp_WinLost_Money_Total += $LIST['BetGodnine_WinLost_Money'] ;
		}
		else
		{
			echo "				<td num=\"-500\">" . WinHappy_setMoneyCss( $LIST['BetGodnine_Banker_WinLost_Money'] , "Before" ) . "</td>\n";
			$tmp_WinLost_Money_Total += $LIST['BetGodnine_Banker_WinLost_Money'] ;
		}
		
		echo "			</tr>\n";
    }

	// 秀出總計
	echo "" ;
	echo "			<tr>\n";
	echo "				<td></td>\n";
	echo "				<td></td>\n";
	echo "				<td>總計</td>\n";
	echo "				<td>" . WinHappy_setMoneyCss( $tmp_WinLost_Money_Total , "Before" ) . "</td>\n";
	echo "			</tr>\n";
    
    // 釋放結果集合
    mysqli_free_result($QUERY);
}
//else
//{	echo "沒有找到資料<br>" ;	}

echo "			</table>\n";
echo "		</div>\n";

echo "	</div>\n";
echo "</main>\n";


// 載入版權
include($MAIN_BASE_ADDRESS . "footer.php") ;        // 載入版權
?>

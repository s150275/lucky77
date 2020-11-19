<?php
/*
V0.1
	180423
	sentRedEnvelopeMsg( $arrayFormatText , $arrayLineId )	送出紅包訊息(180423)
	180405
	加入
	// getOutputUEL( $subarray )						找出Output URL值(180405)
*/
// 機器人函式庫-已設到conn.php中
//$Conn_access_token ='ICRyjL+TVkHCW4bTvfJTfNRiyawSCDhQwQ8lUuFEqlYzxRAR6EBxWMMsfz1RX2EUDNsi4YgpgwX2t8k2K2/bRgwWe+y7OB0Sm7Md7HohpcykYhkx2pLmWNu+YwT/0RwR73WOj/nn+FnSsQ4aGF01NQdB04t89/1O/w1cDnyilFU=';
//$Conn_access_token = 'ljOLqkVj6DuJ7jZLzV7ZP1PPd02b0gMFXU0bxJD3ufRGaOqX+bRrti3yH5/uWdATccx3k3JE8BIF7nlQI2phExFph3qSysfWUCNVhUq2ZNOl2U9A99wTX14m1vhjgNbi44aL6gTBqa0RT891x425QAdB04t89/1O/w1cDnyilFU=' ;
//$line_id = "U3311dd676ab1bc141ef6fcbf3d66f16e" ;

// Line資料
// sentOneLineMsg( $tmpArray , $line_id )			送資料給一個line
// sentMultLineMsg( $arrayFormatText , $arrayLineId )	送資料給多個line
// sentRedEnvelopeMsg( $arrayFormatText , $arrayLineId )	送出紅包訊息(180423)
// getLineMemberInfo( $arrayLineId )				取得line會員訊息

// Hash轉換
// getInputHash( $array_json )						取得hash資料
// getOutputJson( $subarray )						找出OutputJson值
// getOutputUEL( $subarray )						找出Output URL值(180405)

// 店家資料
// getStore_Info( $subStore_Code )					取得店家資訊

// 會員資料
// addMember( $subMember_LineID )					新增會員
// getMember_Info( $subMember_LineID )				取得會員資訊
// getMember_ID()									取得新會員代碼
// getMember_Count( $subType )						取得會員人數
// getChat_Count( $subType )						取得聊聊人數

//~@_@~// START 送資料給Line ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function sentOneLineMsg( $arrayMessage , $arrayLineId )
{
	global $Conn_access_token ;
	// 範例				: sentOneLineMsg( $arrayFormatText , $arrayLineId );
	// 功能				: 送資料給一個line
	// 修改日期			:
	// $arrayMessage	: 要送出的訊息內容
	// $arrayLineId		: Line內部ID陣列
	/*
	// 設定方法

	// 送給line的文字資料
	if ( $LIST['PushInfo_Content'] )
	{
		$arrayFormatMessage[] = array(
			"type" => "text",
			"text" => $LIST['PushInfo_Content']
		);
	}
	// 送給line的圖片資料
	if( $LIST['PushInfo_PictURL'] )
	{
		$arrayFormatMessage[] = array(
			"type" => "image",
			"originalContentUrl" => $LIST['PushInfo_PictURL'],
			"previewImageUrl" => $LIST['PushInfo_PictURL']
		);
	}
	//print_r($arrayFormatMessage);

	// 設定要送出的Line內部ID陣列
	//$arrayLineId[] = $LIST_Memo_Member['Member_LineID'] ;
	sentOneLineMsg( $arrayFormatText , $arrayLineId );		// 送資料給Line
	*/

//echo "$subLineId<br>" ;

	if ( sizeof($arrayLineId) == 1 )
	{
		$tmpURL = "https://api.line.me/v2/bot/message/push" ;
		$tmpLineId = $arrayLineId[0] ;
		//print_r($tmpLineId);
	}
	else
	{
		$tmpURL = "https://api.line.me/v2/bot/message/multicast" ;
		$tmpLineId = $arrayLineId ;
		//	print_r($tmpLineId);
	}
	//echo "<br>" . $tmpURL ."<br>" ;
	
	$post_data = array(
		"to" => $tmpLineId,
		"messages" => $arrayMessage
	);
	//print_r($post_data); 
	//echo "<br><br>" ;
	 
	$header = array(
		'Content-Type: application/json',
		'Authorization: Bearer ' . $Conn_access_token
	);
//	print_r($header); 
//	echo "<br><br>" ;
	
	$ch = curl_init($tmpURL);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($post_data) );
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: Bearer '.$Conn_access_token
	));

	$result = curl_exec($ch);
	curl_close($ch);

	// Line回傳值 :
	//push API(推播)回傳的狀態碼
	//200 成功
	//400 資料格式有誤
	//403 沒有push API權限
	//429 超過流量限制(每分鐘一萬次)
	//500 line內部出問題

//	echo "<br>" ;
	//echo "$result" ;
}
//~@_@~// END 送資料給Line ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 送資料給多個line ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function sentMultLineMsg( $arrayFormatText , $arrayLineId )
{
	global $Conn_access_token ;
	// 範例				: sentMultLineMsg( $arrayFormatText , $array_line_id );
	// 功能				: 送資料給多個line
	// 修改日期			:
	// $arrayFormatText	: 要送出的訊息內容
	// $arrayLineId		: Line內部ID
}
//~@_@~// END 送資料給一個line ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 送出紅包訊息 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function sentRedEnvelopeMsg( $arrayFormatText , $arrayLineId )
{
	global $Conn_access_token ;
	// 範例				: sentRedEnvelopeMsg( $arrayFormatText , $arrayLineId );
	// 功能				: 送資料給一個line
	// 修改日期			:
	/*
	// 送出殺價滑滑,在前後加上[]
	$arrayFormatText = '
	[{"type": "template","altText":"殺價","template":{"type": "carousel",
	"columns":[
	{"thumbnailImageUrl":"https://i.imgur.com/EKrQGTp.jpg","title":"我要殺價","text": "點擊下面發起按鈕，並請好友幫忙殺價為0元，即可獲得免費商品。","actions":[{"type":"postback","label":" ","data":" "},{"type":"postback","label":" ","data":" "},{"type":"uri","label":"發起殺價","uri":"line://app/1650224012-ObQGdWXV?F=Bargain"}]},
	{"thumbnailImageUrl":"https://i.imgur.com/SklS1Hu.jpg","title":"正在殺價的進度","text":"可查看自己發起的殺價商品目前被殺價的進度，努力追蹤到最後吧!我相信幸運得主絕對是你!","actions":[{"type":"postback","label":" ","data":" "},{"type":"postback","label":" ","data":" "},{"type":"postback","label":"繼續找朋友幫你殺價","data":"殺價|所有發起殺價"}]},
	{"thumbnailImageUrl":"https://i.imgur.com/G7cdac2.jpg","title":"我參與的殺價","text":"可查看自己參與哪一個商品紀錄。","actions":[{"type":"postback","label":" ","data":" "},{"type":"postback","label":" ","data":" "},{"type":"uri","label":"參與紀錄","uri":"line://app/1650224012-Gy7M0BZ4"}]}
	]}}]
	';
	//echo "<p>要送出的訊息 $arrayFormatText: </p>" ;
	$arrayFormatMessageBtn = json2array($arrayFormatText) ;
	//echo "<p>要送出的訊息陣列</p>" ;print_r($arrayFormatMessageBtn);echo "<br>" ;

	// 找出會員ID
	$arrayMemberInfo = func_DatabaseGet( "Member" , "*" , array("Member_ID"=>$_SESSION['Member_ID']) ) ;		// 取得資料庫資料
	//$arrayLineId[] = "Ub345c55a1d236c35409c1b83af50f8c8" ;
	$arrayLineId[] = $arrayMemberInfo['Member_LineID'] ;

	//sentRedEnvelopeMsg( $arrayFormatMessageBtn , $arrayLineId );		// 送資料給Line
	*/

	if ( sizeof($arrayLineId) == 1 )
	{
		$tmpURL = "https://api.line.me/v2/bot/message/push" ;
		$tmpLineId = $arrayLineId[0] ;
		//print_r($tmpLineId);
	}
	else
	{
		$tmpURL = "https://api.line.me/v2/bot/message/multicast" ;
		$tmpLineId = $arrayLineId ;
		//	print_r($tmpLineId);
	}
	//echo "<br>" . $tmpURL ."<br>" ;
	
//	$post_data = array(
//		"to" => $tmpLineId,
//		"messages" => $array
//	);

	$post_data = array(
		"to" => $tmpLineId,
		"messages" => $arrayFormatText
	);
	//print_r($post_data); 
//	echo "<br><br>" ;
	 
	$header = array(
		'Content-Type: application/json',
		'Authorization: Bearer ' . $Conn_access_token
	);
//	print_r($header); 
//	echo "<br><br>" ;
	
	//echo "送出去的json : " . json_encode($post_data) . "<br>" ;
	
	$ch = curl_init($tmpURL);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($post_data) );
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: Bearer '.$Conn_access_token
	));

	$result = curl_exec($ch);
	curl_close($ch);

//	echo "<br>" ;
	//echo "$result" ;
}
//~@_@~// END 送出紅包訊息 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

//~@_@~// START 取得line會員訊息 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getLineMemberInfo( $subLineId )
{
	global $Conn_access_token ;
	
	// 範例				: $jsonMemberInfo = getLineMemberInfo( $subLineId );
	// 功能				: 取得line會員訊息Json
	// 修改日期			:
	// $subLineId		: Line內部ID
	// 使用方法			: 把json轉成陣列
	// 使用方法
	// $jsonMemberInfo = getLineMemberInfo( $subLineId );
	// $arrayMemberInfo = json2array( $jsonMemberInfo );
	// $Member_Name = $arrayMemberInfo['displayName'] ;

	$header="{'Authorization' : 'Bearer $Conn_access_token'}";
	
	$options = "{
		'method': 'get',
	  }";
	
	$url = "https://api.line.me/v2/bot/profile/" . $subLineId;
	//echo "$url" ;
	$ch = curl_init("$url");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'get');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: Bearer '.$Conn_access_token
		//'Authorization: Bearer '. TOKEN
	));
	
	$result = curl_exec($ch);
	curl_close($ch);
	
//	echo "<br>" ;
//	echo "$result" ;
	return $result ;
}
//~@_@~// END 取得line會員訊息 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得傳入hash資料 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getInputHash( $array_json, $subComp = "" )
{
	/*
	範例 $tmp_md5 = getInputHash( $array_json ) ;
	if ( getInputHash( $array_json ) == $array_json['hash'] ){}

	$array_json		: 由傳入JSON傳成的陣列
		$arrayJson['Funct'] = $Funct ;				// 功能設定
		$arrayJson['Login_Name'] = $Login_Name ;		// 店員ID
		$arrayJson['Time'] = $Time ;				// 時間
	$subComp			: 安全碼
	*/

	// 把hash去掉
	unset($array_json['hash']);
//	// 陣列排序
//	ksort($array_json);

	// 是否有設安全碼
	if ( $subComp == "" )
	{	$subComp = "wostory" ;	}
	$array_json['comp'] = $subComp ;
	
	// 陣列轉json
	$array_hash = array2json( $array_json ) ;
	// 產生hash
	$tmp_md5 = md5($array_hash);
	return $tmp_md5;
	//echo "$tmp_md5_3" ;
}
//~@_@~// END 取得傳入hash資料 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 找出OutputJson值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getOutputJson( $subarray , $subComp = "" )
{
	/*
	範例 $tmpJson = getOutputJson( $subarray ) ;
	$subarray			: 由傳入JSON傳成的陣列
		$arrayHash['Funct'] = "getMember_ID" ;				// 功能參數(必傳)-(addProductType-新增資料,modProductType-修改資料,delProductType-刪除資料,getProductType-取得資料)
		$arrayHash['Member_LineID'] = $arrayLineId[$LID] ;	// LineID
		$arrayHash['Time'] = date("Y-m-d H:i:s") ;			// 送出時間(必傳)
		$tmpJson = getOutputJson( $arrayHash ) ;
	$subComp			: 安全碼
	*/

	// 新產生一個要求出hash的陣列
	$tmpHashArray = $subarray ;
//	// 排序新陣列(ksort)
//	ksort($tmpHashArray);

	// 是否有設安全碼
	if ( $subComp == "" )
	{	$subComp = "wostory" ;	}
	$tmpHashArray['comp'] = $subComp ;
	
	// 把排序過的陣列Json成字串
	$tmp_json = array2json( $tmpHashArray ) ;
	// 再把字串 md5 編碼,產生hash值
	$tmp_md5 = md5($tmp_json);
	// 原始陣列加入hash
	$subarray['hash'] = $tmp_md5 ;

	$array_json = array2json( $subarray ) ;
	return $array_json ;
}
//~@_@~// END 找出OutputJson值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 找出Output URL值 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getOutputUEL( $subarray )
{
	// 範例 $tmpURL = getOutputUEL( $subarray ) ;
	// 需要先建立一個陣列
	/*
	$arrayHash['Funct'] = "getMember_ID" ;				// 功能參數(必傳)-(addProductType-新增資料,modProductType-修改資料,delProductType-刪除資料,getProductType-取得資料)
	$arrayHash['Member_LineID'] = $arrayLineId[$LID] ;	// LineID
	$arrayHash['Time'] = date("Y-m-d H:i:s") ;			// 送出時間(必傳)
	$tmpURL = getOutputUEL( $arrayHash ) ;
	*/
	// 新產生一個要求出hash的陣列
	$tmpHashArray = $subarray ;
//	// 排序新陣列(ksort)
//	ksort($tmpHashArray);
	$tmpHashArray['comp'] = "wostory" ;
	// 把排序過的陣列Json成字串
	$tmp_json = array2json( $tmpHashArray ) ;
	// 再把字串 md5 編碼,產生hash值
	$tmp_md5 = md5($tmp_json);

	// 原始陣列加入hash
	$subarray['hash'] = $tmp_md5 ;
	
	if(  isset($subarray['Time']) )
	{
		// 去掉分隔符號
//		$subarray['Time'] = getSplitDate( $subarray['Time'] , "DS") ;
	}
	
	// URL暫存
	$array_URL = array() ;
	// 把陣列轉成URL
	foreach ( $subarray as $key => $value)
	{
		$array_URL[] = $key . "=" . $value;
	}
	// 把陣列轉字串
	return array2str( $array_URL , "&") ;
}
//~@_@~// END 找出Output URL值 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 店家資料
//~@_@~// START 取得店家資訊 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getStore_Info( $subStore_Code = "")
{
	global $link ;
	// 範例 $array_Store_Info = getStore_Info($subStore_Code) ;	// 取得店家資訊
	// $subStore_Code	// 商店代碼,ID,或取第一筆資料

	if ( $subStore_Code == "" )
	{	$SQL = "select * from Store WHERE id_Store = '1'" ;	}
	elseif ( strlen($subStore_Code) == 6 )
	{	$SQL = "select * from Store WHERE Store_Code = '$subStore_Code'" ;	}
	elseif ( strlen($subStore_Code) == 15 )
	{	$SQL = "select * from Store WHERE Store_ID = '$subStore_Code'" ;	}

	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		// 求出一筆資料
		$LIST = mysqli_fetch_assoc($QUERY) ;
		return $LIST ;

		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{
		return "" ;
	}
	
}
//~@_@~// END 取得店家資訊 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

// 會員資料
//~@_@~// START 新增會員 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function addMember( $subMember_LineID )
{
	global $link ;
	// 範例 $newMember_ID = addMember( $subMember_LineID ) ;
	// $subMember_LineID	// Line內部ID
	// 是否已有此ID
	$arrayInfo = func_DatabaseGet( "Member" , "*" , array("Member_LineID"=>$subMember_LineID) ) ;		// 取得資料庫資料
	if( $arrayInfo )
	{	return "" ;	}

	$newMember_ID = getMember_ID() ;
	// 取得會員Line名稱
	$jsonMemberInfo = getLineMemberInfo( $subMember_LineID );
	$arrayMemberInfo = json2array( $jsonMemberInfo );
	$Member_Name = $arrayMemberInfo['displayName'] ;

	// 登錄帳號使用會員ID的後10碼
	$tmpMember_Login_Name = mb_substr($newMember_ID , 6 , 10 , "UTF-8");

	// 建立新會員資料
	$addSQL_Member = "INSERT INTO Member SET
	Member_LineID = '" . $subMember_LineID . "' ,
	Member_ID = '$newMember_ID' ,
	Member_RichMenu = '" . $tmpStore_Info['Store_RichMenu'] . "' ,
	Member_Login_Name = '$tmpMember_Login_Name' ,
	Member_Login_Passwd = '" . crypt($tmpMember_Login_Name , $tmpMember_Login_Name). "' ,
	Member_Name = '$Member_Name' ,
	Member_On = '1' ,
	Member_Add_DT = '" . date("Y-m-d H:i:s") . "'
	" ;
	// echo "$addSQL_Member<br>" ;
	if ( mysqli_query($link , $addSQL_Member) )
	{
		// 求出ID
		$id = mysqli_insert_id($link) ;
		return $newMember_ID ;
	}
	else
	{
		return "" ;
		echo $tmp_Database_Funct . "新增資料失敗!!<br>" ;
	}
}
//~@_@~// END 新增會員 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得會員資訊 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getMember_Info( $subMember_ID )
{
	global $link ;
	// 範例 $tmpMember_Info = getMember_Info($subMember_ID) ;	// 取得會員資訊
	// $subMember_ID	// 長度16 : LineID ,長度34 : Line內部ID
	
	if ( strlen($subMember_ID) == 16 )
	{	$SQL = "select * from Member WHERE Member_ID = '$subMember_ID'" ;	}
	elseif ( strlen($subMember_ID) == 33 )
	{	$SQL = "select * from Member WHERE Member_LineID = '$subMember_ID'" ;	}
	
	$QUERY = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	if ( mysqli_num_rows($QUERY) )
	{
		// 求出一筆資料
		$LIST = mysqli_fetch_assoc($QUERY) ;
		return $LIST ;

		// 釋放結果集合
		mysqli_free_result($QUERY);
	}
	else
	{
		return "" ;
	}
	
}
//~@_@~// END 取得會員資訊 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得新會員代碼 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getMember_ID()
{
	global $link ;
	// 範例 $newMember_ID = getMember_ID() ;	// 取得新會員代碼
	$tmp_has = 1 ;
	// 產生經銷商編號
	while( $tmp_has )
	{
		$pattern = "0123456789";	// 數字
		$key = "" ;

		// 產生要的數目
		for( $i=0 ; $i < 10 ; $i++ )
		{	$key .= $pattern{rand(0 , strlen($pattern)-1 )};	}
//			echo $key ."<br>";

		// 產生會員ID
		$Member_ID = "Member". $key ;

		// 查詢此經銷商編號是否已有人設過
		$SQL_Member_ID = "SELECT * FROM  Member WHERE Member_ID = '" . $Member_ID . "'" ;

		// 是否為除錯模式
		if ( $isDebug )
		{
			echo "<br>查訊經銷商編號是否存在 : $SQL_Member_ID<br><br>" ;
		}

		$result_Member_ID = mysqli_query($link , $SQL_Member_ID) ;

		if ( !mysqli_num_rows($result_Member_ID) )
		{
			// 離開while
			return $Member_ID ;
			$tmp_has = 0 ;
		}
	}

}
//~@_@~// END 取得新會員代碼 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
//~@_@~// START 取得會員人數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getMember_Count( $subType )
{
	global $link ;
	// 範例 $tmpMember_Count = getMember_Count($subType) ;
	// $subType 格式(A:總人數,Y:本年加入人數,M:本月加入人數,W:本星期加入人數,D:本日加入人數)
	// 取得本年資料
	$TODAY = date("d") ;		// 本日
	$THIS_M = date("m") ;		// 本月
	$THIS_Y = date("Y") ;		// 本年
	if ( $subType == "A" )
	{
		$SQL = "select * from Member" ;
	}
	elseif ( $subType == "Y" )
	{
		$SQL = "select * from Member WHERE Member_Add_DT BETWEEN '" . $THIS_Y . "-01-01' AND '" . $THIS_Y . "-12-31'" ;
	}
	elseif ( $subType == "M" )
	{
		// 求出查詢月份有幾天
		$DAYS_IN_MONTH = date(  "t", mktime(0, 0, 0, $THIS_M, 1, $THIS_Y)) ;
		$tmp_Month_Start = $THIS_Y . "-" . $THIS_M . "-01";
		$tmp_Month_End = $THIS_Y . "-" . $THIS_M . "-" . $DAYS_IN_MONTH;
		$SQL = "select * from Member WHERE Member_Add_DT BETWEEN '$tmp_Month_Start' AND '$tmp_Month_End'" ;
	}
	elseif ( $subType == "W" )
	{
		$tmp_WeeK_Star =  date("Y-m-d",mktime(0, 0, 0,date("m"),date("d")-date("w")+1));
		$tmp_WeeK_End =  date("Y-m-d",mktime(0, 0, 0,date("m"),date("d")-date("w")+7));
		$SQL = "select * from Member WHERE Member_Add_DT BETWEEN '$tmp_WeeK_Star' AND '$tmp_WeeK_End'" ;
	}
	elseif ( $subType == "D" )
	{
		$SQL = "select * from Member WHERE Member_Add_DT LIKE '%" . date("Y-m-d") . "%'" ;
	}
	else
	{
		return "" ;
	}
	//echo "$SQL<br>" ;
	
	$result = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	return mysqli_num_rows($result) ;
}
//~@_@~// START 取得會員人數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//~@_@~// START 取得聊聊人數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getChat_Count( $subType )
{
	global $link ;
	// 範例 $tmpChat_Count = getChat_Count($subType) ;
	// $subType 格式(A:總人數,Y:本年使用人數,M:本月使用人數,W:本星期使用人數,D:本日使用人數)
	// 取得本年資料
	$TODAY = date("d") ;		// 本日
	$THIS_M = date("m") ;		// 本月
	$THIS_Y = date("Y") ;		// 本年
	if ( $subType == "A" )
	{
		$SQL = "select * from ChatInfo" ;
	}
	elseif ( $subType == "Y" )
	{
		$SQL = "select * from ChatInfo WHERE ChatInfo_Add_DT BETWEEN '" . $THIS_Y . "-01-01' AND '" . $THIS_Y . "-12-31'" ;
	}
	elseif ( $subType == "M" )
	{
		// 求出查詢月份有幾天
		$DAYS_IN_MONTH = date(  "t", mktime(0, 0, 0, $THIS_M, 1, $THIS_Y)) ;
		$tmp_Month_Start = $THIS_Y . "-" . $THIS_M . "-01";
		$tmp_Month_End = $THIS_Y . "-" . $THIS_M . "-" . $DAYS_IN_MONTH;
		$SQL = "select * from ChatInfo WHERE ChatInfo_Add_DT BETWEEN '$tmp_Month_Start' AND '$tmp_Month_End'" ;
	}
	elseif ( $subType == "W" )
	{
		$tmp_WeeK_Star =  date("Y-m-d",mktime(0, 0, 0,date("m"),date("d")-date("w")+1));
		$tmp_WeeK_End =  date("Y-m-d",mktime(0, 0, 0,date("m"),date("d")-date("w")+7));
		$SQL = "select * from ChatInfo WHERE ChatInfo_Add_DT BETWEEN '$tmp_WeeK_Star' AND '$tmp_WeeK_End'" ;
	}
	elseif ( $subType == "D" )
	{
		$SQL = "select * from ChatInfo WHERE ChatInfo_Add_DT LIKE '%" . date("Y-m-d") . "%'" ;
	}
	else
	{
		return "" ;
	}
	//echo "$SQL<br>" ;
	
	$result = mysqli_query($link , $SQL) ;
	
	// 是否有資料
	$tmp = mysqli_num_rows($link , $result) ;
	return $tmp;
}
//~@_@~// START 取得聊聊人數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//~@_@~// START 取得聊聊使用次數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function getChat_UseCount()
{
	global $link ;
	// 範例 $arrayChat_Count = getChat_UseCount() ;
	
	// 求出配對成功申請者次數
	$SQL = "select ChatInfo_Member_ID1,COUNT(*) as Num from ChatInfo GROUP BY ChatInfo_Member_ID1 HAVING COUNT(*) > 1 ORDER BY Num DESC" ;
//	echo "$SQL<br>" ;
	$result = mysqli_query($link , $SQL) ;

	// 是否有資料
	if ( mysqli_num_rows($result) )
	{
		// 求出一筆資料
		while ( $LIST = mysqli_fetch_assoc($result) )
		{
//			echo $LIST['ChatInfo_Member_ID1'] . "-" . $LIST['Num'] . "<br>" ;
			if ( $LIST['ChatInfo_Member_ID1'] )
			{
				
				$arrayChat_Count[$LIST['ChatInfo_Member_ID1']]['Name'] = $LIST['Member_Name'] ;
				$arrayChat_Count[$LIST['ChatInfo_Member_ID1']]['Count'] = $LIST['Num'] ;
			}
		}
	}

	// 求出被配對成功者次數
	$SQL2 = "select ChatInfo_Member_ID2,COUNT(*) as Num from ChatInfo GROUP BY ChatInfo_Member_ID2 HAVING COUNT(*) > 1" ;
//	echo "$SQL<br>" ;
	$result2 = mysqli_query($link , $SQL2) ;

	// 是否有資料
	if ( mysqli_num_rows($result2) )
	{
		// 求出一筆資料
		while ( $LIST2 = mysqli_fetch_assoc($result2) )
		{
			if ( $LIST2['ChatInfo_Member_ID1'] )
			{
				if ( $arrayChat_Count[$LIST2['ChatInfo_Member_ID1']]['Count'] )
				{
					$arrayChat_Count[$LIST2['ChatInfo_Member_ID1']]['Count'] += $LIST2['Num'] ;
				}
				else
				{
					$arrayChat_Count[$LIST2['ChatInfo_Member_ID1']]['Name'] = $LIST2['Member_Name'] ;
					$arrayChat_Count[$LIST2['ChatInfo_Member_ID1']]['Count'] = $LIST2['Num'] ;
				}
			}
		}
	}
	arsort($arrayChat_Count) ;
	$tmp_index=0;
	// 取出前10名資料
	foreach ($arrayChat_Count as $key => $value)
	{
		$arrayMember_ID[] = $key;
		if ( $tmp_index >= 10)
		break;
		
		$tmp_index++;
	}
	$tmpSQL = "'" . implode("','" , $arrayMember_ID) . "'";
	//echo $tmpSQL ;
//	print_r($arrayMember_ID);
	
	// 找出會員名稱
	$SQL_Member = "select * from Member WHERE Member_ID IN ($tmpSQL)";
//	echo $SQL_Member; 
	$result_Member = mysqli_query($link , $SQL_Member) ;
	
	// 是否有資料
	if ( mysqli_num_rows($result_Member) )
	{
		// 一條條獲取
		while ($LIST_Member = mysqli_fetch_assoc($result_Member))
		{
			//echo $LIST_Member['Member_Name'] ."<br>";
			$arrayChat_Count[$LIST_Member['Member_ID']]['Name'] = $LIST_Member['Member_Name'] ;
			
		}
		
		// 釋放結果集合
		mysqli_free_result($result_Member);
	}
	else
	{	echo "沒有找到資料<br>" ;	}
	//print_r($arrayChat_Count);
	return $arrayChat_Count;
}
//~@_@~// START 取得聊聊使用次數 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
//~@_@~// START 送出CURL資料(POST) ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function sentCURL_Post( $subURL , $subSentJson )
{
	global $link ;
	// 範例 			: $json = sentCURL_Post( $subURL , $subSentJson ) ;		// 送出CURL資料(POST)
	// $$subURL			: API網址
	// $subSentJson		: 要傳送的資料

	$ch = curl_init($subURL);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,  $subSentJson );
	//	curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
	//	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	//		'Content-Type: application/json',
	//		'Authorization: Bearer '.$Conn_access_token
	//	));
	
	$result = curl_exec($ch);
	curl_close($ch);
	
	//	echo "<br>" ;
	return "$result" ;
}
//~@_@~// START 送出CURL資料(POST) ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
?>

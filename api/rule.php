<style>
p
{
	color:#f00;
	font-size:20px;
}
</style>
<?php
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
//http://loveall.twmall.bixone.com/api/rule.php?key=wolong

// 陣列編輯成Json(陣列變字串)-防中文亂碼-php 5.4
function array2json( $array )
{
	// 範例 $tmp_json = array2json( $array ) ;
	$tmp_array2 = json_encode($array, JSON_UNESCAPED_UNICODE) ;
	return $tmp_array2 ;
}

// Json編輯成陣列(字串變陣列)-防中文亂碼-php 5.4
function json2array( $json )
{
	// 範例 $array_json = json2array( $json ) ;
	$array_json2array = json_decode($json , true);
	return $array_json2array ;
}


$_POST['Json_Info'] ? $Json_Info = $_POST['Json_Info'] : $Json_Info = $_GET['Json_Info'] ;
$_POST['key'] ? $key = $_POST['key'] : $key = $_GET['key'] ;

// 是否為正式輸入
if ($key != "bot" )
exit;

// 設定陣列
$json = array(
"Funct" => "Get_MemberID" ,
"Member_LineID" => "123456789",
"Time" => "2017-01-01 00:00:00",
"Key" => "BOT"
) ;
//"hash" => ""

// 建立一個要產生hash的陣列
$array_hash = $json ;


// 開始說明規則▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼

echo "<p>原始陣列資料,其中'Key'是由客戶自行設定5-10個字,每次都設不相同,我會把值再傳回去讓客戶去確認是否為自己送出的</p>" ;
echo "<p>Funct為功能設定(非一定要填)</p>" ;

echo "Get_MemberID : 查詢會員代碼" ;

// 秀出原始陣列資料
echo "<p>原始陣列資料,每一個欄位值為要傳送的名稱(Member_ID),其中的'key'為用來比對次JSON是否我所傳的資料,傳過去會再傳回來,可以每次都不同</p>" ;

print_r($json);


// START 編碼 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼

// 對hash陣列的key做排序
//ksort($array_hash);

echo "<p>第一步 : 把原來的陣列複複製一個新的陣列來產生hash值,用新複製的陣列以欄位值來排序的陣列(ksort)(先不用)</p>" ;
print_r($array_hash);

echo "<p>第二步 : 在排序的陣列中加入一個我們設定的變數欄位'comp':'wolong',此欄位只有我們知道,不用加到傳送JSON中</p>" ;

$array_hash['comp'] = "wolong" ;

print_r($array_hash);

echo "<p>第三步 : 把排序過和加入變數欄位的陣列Json成字串</p>" ;

// 編輯(陣列變字串)
$tmp_array_hash_encode = array2json( $array_hash ) ;

echo "Json內容 : " . $tmp_array_hash_encode . "<br>";
echo "Json字串長度 : " . strlen($tmp_array_hash_encode) . "<br>";

echo "<p>第四步 : 把JSON字串 md5 編碼,產生hash值 : </p>" ;

$tmp_md51 = md5($tmp_array_hash_encode);

echo "$tmp_md51<br>" ;

// 原始陣列加入hash
$json['hash'] = $tmp_md51 ;

echo "<p>第五步 : 把hash值加入原來的陣列中</p>" ;

print_r($json);
echo "<br>" ;

// 編輯(陣列變字串)-防中文亂碼-php 5.4
$tmp_array_json_encode = array2json( $json ) ;

echo "<p>第六步 : 把加入hash的陣列轉成json資料傳出,用GET,名稱設為Json_Info</p>" ;

echo "http://linebot.wolong.bixone.com/api/check_user.php?Json_Info=$tmp_array_json_encode" ;

echo "<hr>" ;

// END 編碼 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
// START 解碼 ▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼

echo "<p>收到資料的解碼方法:</p>" ;

// 傳入值解碼
$array_json_decode = json2array( $tmp_array_json_encode ) ;
//$array_json_decode = json_decode($tmp_array_json_encode , true);

echo "<p>第一步 : 把接數的json轉成陣列</p>" ;
print_r($array_json_decode);
echo "<br>" ;

// 複製產生hash陣列
$array_hash1 = $array_json_decode ;

// 把hash去掉
unset($array_hash1['hash']);

// 去除hash陣列
echo "<p>第二步 : 陣列去除hash資料(unset)</p>" ;
print_r($array_hash1);

echo "<p>第三步 : 在陣列中加入一個我們設定的變數欄位'comp':'wolong',此欄位只有我們知道</p>" ;

$array_hash1['comp'] = "wolong" ;

print_r($array_hash1);

echo "<p>第四步 : 重新排列陣列(ksort)(先不用)</p>" ;

//ksort($array_hash1);

print_r($array_hash1);

echo "<p>第五步 : 把陣列進行Json編碼</p>" ;
$array_hash1 = array2json( $array_hash1 ) ;

echo "$array_hash1<br>" ;

echo "<br>字串長度 : " . strlen($array_hash1) . "<br>";

$tmp_md5_3 = md5($array_hash1);

echo "<p>第六步 : 把Json進行 md5 編碼 </p>" ;

echo "$tmp_md5_3" ;

echo "<p>第七步 : 比對產生的md5和傳來的hash做比對是否相同,相同表示沒有被改過,此資料就可以使用</p>" ;

// END 解碼 ▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲

?>
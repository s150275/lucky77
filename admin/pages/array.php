<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<?php
$fruit=["f1"=>"Apple","f2"=>"Banana","f3"=>"Orange"];
foreach($fruit as $key=>$value)
{
	echo $key."是".$value."/";	
}
?>
</body>
</html>
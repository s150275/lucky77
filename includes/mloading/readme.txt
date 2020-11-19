1.載入程式
	<!--載入中模組-->
	<link rel="stylesheet" href="mloading/jquery.mloading.css">


	<!--載入中模組,-->
	<script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>

	<script src="mloading/jquery.mloading.js"></script>


2.在網頁最後加上下列程式
	<script>
	// 重新啟動網頁
	function show_mloading_Form()
	{
		$("body").mLoading("hide")
	}

	// 暫停網頁
	$("body").mLoading("show")


	$(function(){
		$("#btnTest").click(function(){
			$("body").mLoading({
				text:"資料上傳中,請等候...",//加载文字，默认值：加载中...
				//icon:"",//加载图标，默认值：一个小型的base64的gif图片
				//html:false,//设置加载内容是否是html格式，默认值是false
				//content:"",//忽略icon和text的值，直接在加载框中显示此值
				//mask:true//是否显示遮罩效果，默认显示
			});
			//$("body").mLoading();
		});
	});
	// 啟動網頁
	setTimeout(show_mloading_Form()",5000);

	</script>

3.可以在form中加入  onsubmit='hide_mloading_Form()' 來執行

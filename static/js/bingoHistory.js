//var page = {
//  init() {
//    // console.log("init);
//  }
//};
//
	//toastr.success( "取得排莊列表 : " );

var vm = new Vue({
	el: '#BingoHistoryArea',	// 執行的ID
	data: {			// 設定的參數和初始資料
	},
	methods:
	{		// 可執行的函式
		FgetBingoHistory()
		{// 取得Bingo獎號資訊
			//toastr.success( "取得排莊列表 : " );
			axios
			.get('ajax_getBingoHistory.php')
			.then(response => 
			{
				//toastr.success( "取得排莊列表 : " + response.data );
				//this.BankerArea = response.data ;
				document.getElementById("BingoHistoryArea").innerHTML = response.data ;
			})
			.catch(function (error)
			{ // 請求失敗處理
				console.log(error);
			});

//			this.$nextTick().then(() => {
//				  $('#Apply_Banker').on('click',function(){
//					// 接下來看你了
//					toastr.success( "取得排莊列表 : " );
//				 })
//			})
		},
	}
})
//toastr.success( "取得排莊列表 : " );
vm.FgetBingoHistory();
//page.init();

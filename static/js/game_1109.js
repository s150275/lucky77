/*
getGameInfo() ★遊戲基本資料 , setPlayerSeat() ★莊閒家選擇佔位 , ★FApply_Banker() 進行排莊
getTime() 取得時間

countAction() 倒數觸發的動作

FgetSeatNumber() 計算坐位 , FdisabledSeat() 判斷閒家是否可選位 , FisBankerSeat() 判斷是否為莊家的位子
FisOtherPlayer() 判斷是否為其他玩家 , getSeatStatus() 取得坐位狀態 , setEmptySeat() 取得空位
initSeatStatus() 初始化坐位表 , FsetOtherSeat() 設定其他玩家資料
FsetBankerSeat() 取得莊家資料 , FgetNewResult() 取得開獎結果
FgetBankerArea() 取得排莊列表 , FgetBingoHistory() 取得Bingo獎號資訊

FgetRandom() 取亂數(正式應該用不到) , getURLQuery() 取得url query(正式應該用不到)

---------------------------------------------------------------------------------------------------

// Ajax範例

axios
.get('gameA_getBankerArea.php')
.then(response => 
{
	this.BankerArea = response.data ;
	document.getElementById("BankerArea").innerHTML = response.data ;
})
.catch(function (error)
{ // 請求失敗處理
	console.log(error);
});

------------------------------------

// 取出回傳的參數
this.GameInfo.State

------------------------------------

// 字串轉陣列
this.GameInfo = JSON.parse(this.banker_seats);

// 陣列轉字串
this.GameInfo = JSON.stringify(this.banker_seats) ;

------------------------------------

// 分析Ajax回傳文字資料 : 01,回傳訊息
// 求出回傳狀態,前2個字( >0成功 , <0失敗 )
let State = Number(response.data.substr(0,2));
console.log(State);

// 求出回傳訊息(第3個字以後)
let RetMsg = response.data.substr(3) ;
if( State < 0 )
{	toastr.error( RetMsg );	}
if( State > 0 )
{	toastr.success( RetMsg );	}

------------------------------------

// 送出除錯訊息-網頁(success , error , warning , info)
toastr.success( "目前狀態-Fcountdown_index() : " +this.idx );

// 除錯訊息-把陣列轉成Json字串-除錯訊息
console.log("自選資料 : " + JSON.stringify(this.player_seats));

------------------------------------

// 把文字轉成陣列-19,20
let banker_seats = this.GameInfo.Banker.split(",") ;

*/

// 取得系統時間 API
//const API_GET_TIME = "http://worldtimeapi.org/api/timezone/Asia/Taipei"; // TODO: 取得系統時間
const API_GET_TIME = "http://bingo77.net/api/TimeApi.php?key=godnine"; // TODO: 取得系統時間
//const API_GET_TIME = "http://godnine.shoping.jjvk.com/api/TimeApi.php"; // TODO: 取得系統時間

// 每日開始時間 HH:mm:ss
const START_TIME = "07:05:00";

// 每日結束時間 HH:mm:ss
const END_TIME = "23:57:30"; // TODO: 要做結束判斷

// 狀態資料-130,20,40,60,50
// 正式-輪莊區
const COUNTDOWN_DATA = [
  {count: 130, text: "等待開獎", action: "wait"},
  {count: 30, text: "派彩", action: "payout"},
  {count: 10, text: "莊家選位", action: "banker"},
  {count: 100, text: "閒家投注", action: "player"},
  {count: 30, text: "關盤時間", action: "close"},
];

// 長莊區
const COUNTDOWN_DATA2 = [
  {count: 130, text: "等待開獎", action: "wait"},
  {count: 30, text: "派彩", action: "payout"},
  {count: 10, text: "莊家選位", action: "banker"},
  {count: 100, text: "閒家投注", action: "player"},
  {count: 30, text: "關盤時間", action: "close"},
];

// 莊家選位
//const COUNTDOWN_DATA = [
//  {count: 2, text: "等待開獎", action: "wait"},
//  {count: 2, text: "派彩", action: "payout"},
//  {count: 292, text: "莊家選位", action: "banker"},
//  {count: 2, text: "閒家投注", action: "player"},
//  {count: 2, text: "關盤時間", action: "close"},
//];

// 閒家投注
//const COUNTDOWN_DATA = [
//  {count: 2, text: "等待開獎", action: "wait"},
//  {count: 2, text: "派彩", action: "payout"},
//  {count: 22, text: "莊家選位", action: "banker"},
//  {count: 272, text: "閒家投注", action: "player"},
//  {count: 2, text: "關盤時間", action: "close"},
//];

;(function () {
  const gameBlock = "#gameBlock";
  const $gameBlock = document.querySelector(gameBlock);

  Vue.prototype.$ball_number = function(value) {
    if(!value) return ["",""];
    let result = `0${value}`.slice(-2).split("");
    return result;
  }

  if ($gameBlock) {
    new Vue({
      el: gameBlock,
      data() {
        return {
          zone_code: 1, // 1: 輪莊有倍數區, 2: 長莊無倍數區, 3: 長莊有倍數區
          room_id: 30, // TODO: 房間id
          user_id: 12, // TODO: 使用者id (如有需要)
          user_name: "展示用", // TODO: 使用者名稱 (如有需要)

          table_count: 20, // 幾張桌子
          chair_count: 2, // 每桌幾個椅子

          sys_unixtime: 0, // 系統時間 (unix timestamp)
          get_time_times: 0, // 已取得系統時間次數
          reload_time: 10, // 每10秒校正
          open_bonus_info: false, // 打開說明
          now_action: "", // 目前動作
          wait_loading: true, // 等待開獎
          choose_chair: false, // 是否可選坐位
		  
		  Apply_Banker: true,

          seat_status: [], // 所有坐位資料
          banker_seats: [], // 莊家選的位子, 第1桌第1張椅子=1; 第2桌第1張椅子=3...
          player_seats: [], // 閒家選的位子, 第1桌第1張椅子=1; 第2桌第1張椅子=3...
          other_seats: [], // 其他玩家選的位子, 第1桌第1張椅子=1; 第2桌第1張椅子=3...
          empty_seats: [], // 空位,  第1桌第1張椅子=1; 第2桌第1張椅子=3...

          ball_number: [], // 開獎球號結果
          ball_point: [], // 開獎點數結果
          Table_Char: [], // 設定桌號轉成英文
        };
      },
		computed:
		{
			// 系統時間
			sys_now() {
			return moment.unix(this.sys_unixtime).format("HH:mm:ss");
		},
		// 距離遊戲開始時間 (秒)
		today_game_start()
		{
			let start = moment(START_TIME, "HH:mm:ss").unix();
			let sys_now = this.sys_unixtime;
			let result = parseInt(sys_now) - parseInt(start);
			//console.log(result);
			return result;
		},
		// 倒數狀態資料
		countdown_data()
		{
			if( this.zone_code == 1 )
			{// 輸莊區
				// 求出設定總秒數
				let total = [...COUNTDOWN_DATA].reduce((acc, cur) => acc + cur.count, 0);
	
				return [...COUNTDOWN_DATA].reduce((acc, cur, idx, arr) =>
				{
					let second = cur.count;
					//console.log(acc[idx - 1]);
					
					let countdown = 0;
					if (idx > 0) second += acc[idx - 1].second;
					if (this.today_game_start > -1) countdown = second - ((this.today_game_start + total) % total);
					
					cur.second = second;
					cur.countdown = countdown;
					
					return [].concat(acc, cur);
				}, []);
			}
			else
			{// 長莊區
				// 求出設定總秒數
				let total = [...COUNTDOWN_DATA2].reduce((acc, cur) => acc + cur.count, 0);
	
				return [...COUNTDOWN_DATA2].reduce((acc, cur, idx, arr) =>
				{
					let second = cur.count;
					//console.log(acc[idx - 1]);
					
					let countdown = 0;
					if (idx > 0) second += acc[idx - 1].second;
					if (this.today_game_start > -1) countdown = second - ((this.today_game_start + total) % total);
					
					cur.second = second;
					cur.countdown = countdown;
					
					return [].concat(acc, cur);
				}, []);
			}
		},
		// 找出目前時間狀態-------
		Fcountdown_status()
		{
			// index : 0 等待開獎 , 1 派彩 , 2 莊家選位 , 3 閒家投注 , 4 關盤時間
			let index = this.Fcountdown_index;
			//console.log("找出目前時間狀態-Fcountdown_status() : " + index);
	
			//toastr.success( "找出目前時間狀態-Fcountdown_status() : " + index );
			
			if (index < 0) index = 0;
			// 如果時間在23:57和7點前呈現-關盤時間

			var Today = new Date();
			
			let Now_CheckDate = Today.getFullYear() + "-" + (Today.getMonth()+1) + "-" + Today.getDate() + " " + Today.getHours() + ":" + Today.getMinutes() + ":" + Today.getSeconds() ;
			// 早上0700
			let Set_CheckDate1 = Today.getFullYear() + "-" + (Today.getMonth()+1) + "-" + Today.getDate() + " 7:0:0";
			// 晚上2355
			let Set_CheckDate2 = Today.getFullYear() + "-" + (Today.getMonth()+1) + "-" + Today.getDate() + " 23:57:30";
			//toastr.success( "Fcountdown_status() : 比系統目前時間小 : " + Now_CheckDate );
			if(Date.parse(Now_CheckDate).valueOf() < Date.parse(Set_CheckDate1).valueOf())
			{
				index = 4;
				//toastr.success( "Fcountdown_status() : 比系統目前時間小 : " + Now_CheckDate + " " + Set_CheckDate1 );
				//alert("ScheduleDate比系統目前時間小");
			}
			else if(Date.parse(Now_CheckDate).valueOf() > Date.parse(Set_CheckDate2).valueOf())
			{
				index = 4;
				//toastr.success( "Fcountdown_status() : 比系統目前時間大 : " + Now_CheckDate + " " + Set_CheckDate2 );
			}

			


			// 18:16:43
			//var aa= moment.unix(this.sys_unixtime).format("HH:mm:ss");
			//console.log("找出目前時間狀態-Fcountdown_status() : " + aa);
			return this.countdown_data[index];
		},
		// 目前狀態index-------------
		Fcountdown_index()
		{
			let idx = this.countdown_data.findIndex((i) => i.countdown > 0);
			//toastr.success( "目前狀態-Fcountdown_index() : " + idx );
			return idx;
		},
	},
	methods:
	{
		// 取得時間
		getTime()
		{
			let self = this;
			this.get_time_times += 1;	// 已取得系統時間次數
			this.sys_unixtime += 1;		// 系統時間
			
			// 判斷是否要校正-每10秒校正
			let doGetTime = (this.get_time_times + this.reload_time) % this.reload_time;
			
			// 校正: 取得系統時間
			if (doGetTime === 1)
			{
				axios
				.post(API_GET_TIME)
				.then((res) =>
				{
					//alert(res.data);
					//self.sys_unixtime = res.data.unixtime-7;
					self.sys_unixtime = res.data-7;
				})
				.catch((e) => {
					console.log(e);
				});
			}
			this.countAction();
			
			setTimeout(() =>
			{
				this.getTime();
			}, 1000);
		},
		// 設定桌號轉成英文
		set_Table_Char_E()
		{
			this.Table_Char[1] = "A";
			this.Table_Char[2] = "B";
			this.Table_Char[3] = "C";
			this.Table_Char[4] = "D";
			this.Table_Char[5] = "E";
			this.Table_Char[6] = "F";
			this.Table_Char[7] = "G";
			this.Table_Char[8] = "H";
			this.Table_Char[9] = "I";
			this.Table_Char[10] = "J";
			this.Table_Char[11] = "K";
			this.Table_Char[12] = "L";
			this.Table_Char[13] = "M";
			this.Table_Char[14] = "N";
			this.Table_Char[15] = "O";
			this.Table_Char[16] = "P";
			this.Table_Char[17] = "Q";
			this.Table_Char[18] = "R";
			this.Table_Char[19] = "S";
			this.Table_Char[20] = "T";
		},
		// 設定桌號轉成英文
		set_Table_Char_N()
		{
			this.Table_Char[1] = "1";
			this.Table_Char[2] = "2";
			this.Table_Char[3] = "3";
			this.Table_Char[4] = "4";
			this.Table_Char[5] = "5";
			this.Table_Char[6] = "6";
			this.Table_Char[7] = "7";
			this.Table_Char[8] = "8";
			this.Table_Char[9] = "9";
			this.Table_Char[10] = "10";
			this.Table_Char[11] = "11";
			this.Table_Char[12] = "12";
			this.Table_Char[13] = "13";
			this.Table_Char[14] = "14";
			this.Table_Char[15] = "15";
			this.Table_Char[16] = "16";
			this.Table_Char[17] = "17";
			this.Table_Char[18] = "18";
			this.Table_Char[19] = "19";
			this.Table_Char[20] = "20";
		},
		// 遊戲基本資料
		getGameInfo()
		{
			// 找出目前時間狀態
			let { countdown, count, text, action } = this.Fcountdown_status;

			//console.log("遊戲基本資料 getGameInfo : " + countdown + "-" + count + "-" + text + "-" + action);

			axios
			.get('gameA_getGameInfo.php?action=' + action + "&countdown=" + countdown)
			.then(response =>
			{

				// 找出目前時間狀態
				let { countdown, count, text, action } = this.Fcountdown_status;

				//Banker				莊家選位1,2
				//Other					其它選位1,2,3...40
				//User					自己選位
				//Withhold_Money		id:Withhold_Money	預扣點數300
				//Payout_Money			id:Payout_Money		上期派彩點數500
				//Banker_List			近4期排莊資料
				
				// 是否已有人登入-2,URL
				//console.log("遊戲基本資料11 : 會員自己選位資料 " + action + " - " +countdown + " - " + response.data);
				//return false;

				// 直接設定判斷碼
				var dataType = typeof(response.data);
				if( dataType == "string")
				{
					var RetData = response.data ;
					//toastr.error( "回傳資料 : " + RetData );

					var RetState = Number(RetData.substr(0,2));
					//console.log("回傳的判斷碼 : "+RetState);
			
					//toastr.error( "text" );
					var RetMsg = RetData.substr(3) ;
					if( RetState == -2 )
					{
						toastr.error( "此帳號已有人登入,你必須登出了" );
						setTimeout(function() {
							location.replace(RetMsg);
						}, 3000);
					}
					else if( RetState == -3 )
					{
						toastr.error( "會員30分鐘未下注，系統登出" );
						setTimeout(function() {
							location.replace(RetMsg);
						}, 3000);
					}
				}
			
				this.GameInfo = JSON.parse(JSON.stringify(response.data));
				//console.log("遊戲基本資料 getGameInfo : " + this.GameInfo.User );
				console.log("遊戲基本資料 : 會員自己選位資料 " + action + " - " +countdown + " - " + this.GameInfo["User"]);
				// Return_Msg - 回傳訊息
				console.log("除錯訊息 : " + this.GameInfo["Return_Msg"]);

				// 現在莊家 :this.GameInfo.Now_Banker_Name
				document.getElementById("Now_Banker_Name").innerHTML = this.GameInfo.Now_Banker_Name ;
				

				// 是否可以排莊 Apply_Banker
				this.Apply_Banker = this.GameInfo.Apply_Banker ;
				//console.log( "是否可以排莊 : " + this.GameInfo.Apply_Banker + this.Apply_Banker );
				//console.log( "目前莊態 : " + this.GameInfo.action );
				//console.log( "是否可以選位 : " + this.GameInfo.Banker_Choose_Chair + this.GameInfo.Player_Choose_Chair );

				// 是否可以選位
				if( this.GameInfo.Banker_Choose_Chair == true || this.GameInfo.Player_Choose_Chair == true)
				{
					this.choose_chair = true;	// 是否可選坐位
				}

				// 排莊列表
				this.BankerArea = this.GameInfo.Banker_List ;
				//toastr.success( "排莊列表 : " + this.GameInfo.Banker_List);

				// 設定剩下點數
				document.getElementById("Header_Member_Money").innerHTML = this.GameInfo.Member_Money ;
				document.getElementById("Footer_Member_Money").innerHTML = this.GameInfo.Member_Money ;

				// 預扣點數
				//document.getElementById("Withhold_Money").innerHTML = this.GameInfo.Withhold_Money ;
				// 上期派彩點數
				document.getElementById("Payout_Money").innerHTML = this.GameInfo.Payout_Money ;
				// 上期輪莊區金額
				document.getElementById("WinLost_Area1_Points").innerHTML = this.GameInfo.WinLost_Area1_Points ;
				// 上期長莊區金額
				document.getElementById("WinLost_Area2_Points").innerHTML = this.GameInfo.WinLost_Area2_Points ;
				// 上期輸贏總計
				document.getElementById("WinLost_Total_Points").innerHTML = this.GameInfo.WinLost_Total_Points ;

				// 設定派彩點數CSS
				if( Number(this.GameInfo.Payout_Money) > 0 )
				{	$("#Payout_Money").css({'color':"#64e664"}) ;	}
				else if( Number(this.GameInfo.Payout_Money) < 0 )
				{	$("#Payout_Money").css({'color':"#F00"}) ;	}
				else
				{	$("#Payout_Money").css({'color':"#FCEE21"}) ;	}
				
				// 設定派彩點數CSS
				if( Number(this.GameInfo.WinLost_Area1_Points) > 0 )
				{	$("#WinLost_Area1_Points").css({'color':"#64e664"}) ;	}
				else if( Number(this.GameInfo.WinLost_Area1_Points) < 0 )
				{	$("#WinLost_Area1_Points").css({'color':"#F00"}) ;	}
				else
				{	$("#WinLost_Area1_Points").css({'color':"#FCEE21"}) ;	}

				// 設定派彩點數CSS
				if( Number(this.GameInfo.WinLost_Area2_Points) > 0 )
				{	$("#WinLost_Area2_Points").css({'color':"#64e664"}) ;	}
				else if( Number(this.GameInfo.WinLost_Area2_Points) < 0 )
				{	$("#WinLost_Area2_Points").css({'color':"#F00"}) ;	}
				else
				{	$("#WinLost_Area2_Points").css({'color':"#FCEE21"}) ;	}

				// 設定派彩點數CSS
				if( Number(this.GameInfo.WinLost_Total_Points) > 0 )
				{	$("#WinLost_Total_Points").css({'color':"#64e664"}) ;	}
				else if( Number(this.GameInfo.WinLost_Total_Points) < 0 )
				{	$("#WinLost_Total_Points").css({'color':"#F00"}) ;	}
				else
				{	$("#WinLost_Total_Points").css({'color':"#FCEE21"}) ;	}

				// 莊家選位

				// 當莊類型
				document.getElementById("Banker_Wave_Type").innerHTML = this.GameInfo.Banker_Wave_Type ;

				// 尾波提示文字
				document.getElementById("Banker_Wave_Type_Msg").innerHTML = this.GameInfo.Banker_Wave_Type_Msg ;
				
				
				// START 設定資料
				if( action == "player" || action == "banker" || action == "wait" || action == "payout" )
				{
					//console.log("莊家座位 : " + this.GameInfo.Banker );

					// 設定別的玩家資料
					this.banker_seats = this.seat_status.map(i=> 
					{
						if(i.is_banker === true)
						{
							//toastr.success( "原來有佔位 : " + i );
							i.is_banker = false;
							i.is_user = false;
							i.is_other = false;
							i.text = "";
						}
						return i;
					});

					this.banker_seats = [] ;
					let banker_seats = this.GameInfo.Banker.split(",") ;
					//console.log("莊家選位 getGameInfo : " + this.GameInfo.Banker );
	
					// 設定新莊家資料
					banker_seats.forEach((i) =>
					{
						this.seat_status[i - 1].text = "莊";
						this.seat_status[i - 1].is_banker = true;
						this.seat_status[i - 1].is_user = false;
						this.seat_status[i - 1].is_other = false;
					});
					// 存結果
					this.banker_seats = this.seat_status.filter((i) => i.is_banker === true).map((i) => i.seat_number);
					// END 設定莊家資料
//				}
//				// START 設定其它選位資料-在閒家選號時秀出
//				if( action == "player" || action == "banker" || action == "wait" || action == "payout" )
//				{
					//console.log("其它玩家資料 : " + this.GameInfo.Other );
					// 設定別的玩家資料
					this.others_seats = this.seat_status.map(i=> 
					{
						if(i.is_other === true)
						{
							//toastr.success( "原來有佔位 : " + i );
							i.is_banker = false;
							i.is_user = false;
							i.is_other = false;
							i.text = "";
						}
						return i;
					});

					this.others_seats = [] ;
					if ( this.GameInfo.Other )
					{
						//console.log("回傳別的玩家資料 getGameInfo : " + this.GameInfo.Other );
						let others_seats = this.GameInfo.Other.split(",") ; // 別的玩家 chair number
						let others_seats_Name = this.GameInfo.Other_Name.split(",") ; // 別的玩家 名稱
						//toastr.success( "名稱 : " + this.GameInfo.Other_Name + " , " + others_seats_Name[1]);
						let tmpIndex = 0 ;
						others_seats.forEach((i) =>
						{
							//this.seat_status[i - 1].text = "其他"+i;
							this.seat_status[i - 1].text = others_seats_Name[tmpIndex].substring(0,3);
							this.seat_status[i - 1].is_banker = false;
							this.seat_status[i - 1].is_user = false;
							this.seat_status[i - 1].is_other = true;
							tmpIndex++ ;
						});
						//toastr.success( "設定自己資料 : " );
					}
					else
					{
					}
					// 存設定
					this.other_seats = this.seat_status.filter((i) => i.is_other === true).map((i) => i.seat_number);

					//toastr.success( "設定自己資料 : " );
					//console.log("設定自己資料 getGameInfo : " + this.player_seats );
					// 設定自己資料
					this.player_seats = this.seat_status.map(i=> 
					{
						if(i.is_user === true)
						{
							i.is_banker = false;
							i.is_user = false;
							i.is_other = false;
							i.text = "";
						}
						return i;
					});



					//this.User_WinLost_Money = "1,2,3" ;
					//let User_WinLost_Money = "1,2,3" ;
					// 把名稱改成金額
					let User_WinLost_Money = this.GameInfo.User_WinLost_Money ;
					if( this.User_WinLost_Money != "")
					{
						this.array_User_WinLost_Money = User_WinLost_Money.split(",");
						//console.log(array_User_WinLost_Money[1] + "," );
						//for(var j = 0 ; j < array_User_WinLost_Money.length ; j++)
						//{
						//	console.log(array_User_WinLost_Money[j] + "(" + j + ")," );
						//}
						//toastr.success( "把名稱改成金額 : " + array_User_WinLost_Money[2] + " - " + array_User_WinLost_Money[3] );
					}

					this.player_seats = [] ;
					this.player_seats = this.GameInfo.User.split(",") ; // 別的玩家 chair number
					//console.log("自己座位 : " + this.GameInfo.User );
					// 閒家選的位子
					this.player_seats.forEach((num) => 
					{
						// 已選的位置
						//toastr.success( "自己的位置 : " + num );
						let seat_index = this.seat_status.findIndex((i) => i.seat_number == num);
						//toastr.success( "選取的index值-setPlayerSeat() : " + seat_index );
						
						//console.log("閒家選的位子 : " + num + ", index : " + seat_index );

						if( User_WinLost_Money == "")
						{
							this.seat_status[seat_index].text = this.user_name;
						}
						else
						//{	this.seat_status[seat_index].text = "王"+array_User_WinLost_Money[3].substring(0,3);	}
						{
							this.tmp_Name = this.array_User_WinLost_Money[seat_index] ;
							this.seat_status[seat_index].text = String(this.tmp_Name) ;
						}
						this.seat_status[seat_index].is_banker = false;
						this.seat_status[seat_index].is_user = true;
						this.seat_status[seat_index].is_other = false;
					});
				}
				//this.setEmptySeat();	// 取得空的位-可以選位
			})
			.catch(function (error)
			{ // 請求失敗處理
				//console.log(error);
			});

			setTimeout(() =>
			{
				this.getGameInfo();
			}, 2000);
		},// END getGameInfo()

		// 倒數觸發的動作
		countAction()
		{
			let { countdown, count, text, action } = this.Fcountdown_status;
			//toastr.success( "狀態資料-countAction() : countdown : " + countdown + " , count : " + count + " , text : " + " , text : " + text + " , action : " + action);
			// 狀態資料 : countdown : 22 , count : 40 , text : , text : 莊家選位 , action : banker
			
			let doAction = action !== this.now_action;	// now_action : 目前動作
			//toastr.success( "狀態資料-countAction() : " +  doAction + " , 目前動作" + this.now_action);
			// 轉場為true,其它為false
			
			if (!doAction) return;
			//console.log(text, action);
			
			// TODO: 設定目前動作
			this.now_action = action;
			
			// 130秒： 等待開獎
			if (action === "wait")
			{
				//toastr.success( "等待開獎");
				var doorbell = document.getElementById('doorbell');
				doorbell.play();

				// 取得新bingo號
				axios
				.get('gameA_getNewBingo_Period.php')
				.then(response => 
				{
					//toastr.success( "新bingo號() : " +  response.data);
					//document.getElementById("NewBingo_Period_Footer").innerHTML = response.data ;
					document.getElementById("NewBingo_Period_Game").innerHTML = response.data ;
					
				})
				.catch(function (error)
				{ // 請求失敗處理
					console.log(error);
				});
				this.wait_loading = true;	// 等待開獎
				this.choose_chair = false;	// 是否可選坐位
				this.ball_number = [];		// 開獎球號結果
				//if( countdown == 0 )
				//this.getGameInfo();
			}
			// 20秒： 派彩
			else if (action === "payout")
			{
				//toastr.success( "派彩");
				var doorbell = document.getElementById('doorbell');
				doorbell.play();

				this.wait_loading = false;	// 等待開獎
				this.choose_chair = false;	// 是否可選坐位
				this.FgetNewResult();		// 取得開獎結果
				this.FgetBingoHistory();	// 取得Bingo獎號資訊
				//if( countdown == 0 )
				//this.getGameInfo();
			}
			// 40秒： 莊家選位
			else if (action === "banker")
			{
				this.initSeatStatus();		// 初始化坐位表

				//this.getGameInfo();
				//toastr.success( "莊家選位");
				var doorbell = document.getElementById('doorbell');
				doorbell.play();

				// 清空閒家位置
				this.player_seats = [] ;
				// 閒家選的位子
				this.player_seats.forEach((num) => 
				{
					// 已選的位置
					//toastr.success( "自己的位置 : " + num );
					let seat_index = this.seat_status.findIndex((i) => i.seat_number == num);
					//toastr.success( "選取的index值-setPlayerSeat() : " + seat_index );
					
					//console.log("閒家選的位子 : " + num + ", index : " + seat_index );

					this.seat_status[seat_index].text = "";
					this.seat_status[seat_index].is_banker = false;
					this.seat_status[seat_index].is_user = true;
					this.seat_status[seat_index].is_other = false;
				});
				// 清空其它位置
				this.others_seats = [] ;
				
				// 是否是莊家
				this.wait_loading = false;	// 等待開獎
				this.choose_chair = false;	// 是否可選坐位
				this.initSeatStatus();		// 初始化坐位表
				//this.FsetBankerSeat();		// 取得莊家資料
				this.setEmptySeat();	// 取得空的位-可以選位
				// 只有莊家可以選位,一次兩個位置
				//if( countdown == 0 )
			}
			// 60秒： 閒家投注
			else if (action === "player")
			{
				//toastr.success( "閒家投注");

				var doorbell = document.getElementById('doorbell');
				doorbell.play();

				this.wait_loading = false;	// 等待開獎
				this.choose_chair = false;	// 是否可選坐位
				//if(!this.banker_seats.length) this.FsetBankerSeat();	//取得莊家資料
				//this.FsetOtherSeat();	// 其他玩家
				this.initSeatStatus();		// 初始化坐位表
				this.setEmptySeat();	// 取得空的位-可以選位
				//if( countdown == 0 )
				//this.getGameInfo();
			}
			// 50秒： 關盤時間
			else if (action === "close")
			{
				//toastr.success( "關盤時間");
				var doorbell = document.getElementById('doorbell');
				doorbell.play();

				this.wait_loading = false;	// 等待開獎
				this.choose_chair = false;	// 是否可選坐位
				//if( countdown == 0 )
				//this.getGameInfo();
			}
			else
			{
				this.wait_loading = true;	// 等待開獎
				this.choose_chair = false;	// 是否可選坐位
				return;
			}
		},

		// 計算坐位
		FgetSeatNumber(table_number, chair_number)
		{
			return 2 * (table_number - 1) + chair_number;
		},

		// 判斷閒家是否可選位-可選和為空位
		FdisabledSeat(table_number, chair_number)
		{
			// 計算坐位
			let seat_number = this.FgetSeatNumber(table_number, chair_number);	// 計算坐位
			//toastr.success( "計算坐位-FdisabledSeat() : " + seat_number );

			// 是否為空位
			let isEmptySeat = this.empty_seats.find((i) => i == seat_number);
			return !this.choose_chair || !isEmptySeat;
		},

		// 判斷是否為莊家的位子
		FisBankerSeat(table_number, chair_number)
		{
			// 取得坐位資料狀態
			let result = this.getSeatStatus(table_number, chair_number);
			//toastr.success( "是否為莊家的位子-FisBankerSeat() : " + table_number + chair_number + result.is_banker );
			return result.is_banker;
		},

		// 判斷是否為其他玩家
		FisOtherPlayer(table_number, chair_number)
		{
			let result = this.getSeatStatus(table_number, chair_number);
			return result.is_other;
		},

		// 取得坐位狀態
		getSeatStatus(table_number, chair_number)
		{
			// 計算坐位
			let seat_number = this.FgetSeatNumber(table_number, chair_number);
			let seat = this.seat_status.find((i) => i.seat_number == seat_number);
			//toastr.success( "計算坐位-getSeatStatus() : " + seat );
			return seat ? seat : {};
		},

		// [DEMO] 取亂數 (正式應該用不到)
		FgetRandom(min, max, array = false, exclude = [])
		{
			// 單一 return number
			if (array === false) return Math.floor(Math.random() * (max - min + 1)) + min;
			
			// 多個亂數 return []
			let result = [];
			for (let index = 0; index < array; index++)
			{
				let new_number = false;
				let pass = false;
				while (pass == false)
				{
					new_number = this.FgetRandom(min, max);
					// concat 字串串接 , ... 指定括號中的子字符串匹配項的只讀元素
					pass = [].concat(...result,...exclude).every((i) => i !== new_number);
				}
			
				result.push(new_number);
			}
			return result;
		},

		// 取得空位
		setEmptySeat()
		{
			this.empty_seats = this.seat_status.filter((i) => !i.text).map((i) => i.seat_number);
		},

		// 初始化坐位表----------------
		initSeatStatus()
		{
			// seat_status(40個座位目前狀態)參數
			// seat_number	座位index值
			// text			顯示文字
			// is_banker	是否為莊家
			// is_user		是否為自己選取
			// is_other		其他玩家
			// this.seat_status[0].seat_number
			this.seat_status = Array(40)
			.fill("")	// 使用固定值填充數組
			.map((i, idx) => ({ seat_number: idx + 1, text: "", is_banker: false, is_user: false, is_other: false }));

			this.player_seats = [];		// 閒家選的位子
			this.others_seats = [];		// 其他玩家
			this.banker_seats = [];		// 莊家選的位子
			this.empty_seats = [];		// 空位
		},

        // TODO: 莊閒家選擇佔位
        setPlayerSeat( sub_table_number , sub_chair_number )
		{
			$("body").mLoading("show") ;
			// sub_table_number : 按下的桌數位置
			// sub_chair_number : 按下的椅子位置

			let { countdown, count, text, action } = this.Fcountdown_status;

			// 計算坐位
			let seat_number = this.FgetSeatNumber(sub_table_number, sub_chair_number) ;
			//toastr.success( "setPlayerSeat() 坐位 : " + seat_number + " , 按下的桌數位置 : " + sub_table_number + " , 按下的椅子位置 : " + sub_chair_number );

			var player_seats_Num = this.player_seats.length ;
			//toastr.success( "setPlayerSeat() 閒家投注數目 : " + player_seats_Num );

			// 40秒： 莊家選位
			if (action === "banker")
			{
				// 清空剛才選的checked
				document.getElementById("Char_" + sub_table_number + "_" + sub_chair_number).checked=false

				this.player_seats = [];		// 閒家選的位子
				// 設定莊家選號
				axios
				.get('gameA_setBankerSeat.php?table_number=' + sub_table_number)
				.then(response => 
				{
					let State = Number(response.data.substr(0,2));
					//console.log(State);
					
					// 求出回傳訊息(第3個字以後)
					let RetMsg = response.data.substr(3) ;
					if( State < 0 )
					{	toastr.error( RetMsg );	}
					if( State > 0 )
					{	toastr.success( RetMsg );	}
					
				})
				.catch(function (error)
				{ // 請求失敗處理
					console.log(error);
				});

				// 清空舊莊家資料
				//toastr.success( "setPlayerSeat() 清空舊莊家資料 : " +  JSON.stringify(this.banker_seats)  );
				this.banker_seats.forEach((i) =>
				{
					this.seat_status[i - 1].text = "";
					this.seat_status[i - 1].is_banker = false;
					this.seat_status[i - 1].is_user = false;
					//toastr.success( "i : " + i + " : " + this.seat_status[i - 1].is_user );
				});

				// 存結果
				this.banker_seats = this.seat_status.filter((i) => i.is_banker === true).map((i) => i.seat_number);

				// 清空舊莊家資料
				this.banker_seats = [];
				
				// 設定舊莊家資料
				this.banker_seats = [sub_table_number * 2, sub_table_number * 2 - 1]; // 莊家 chair number
				//toastr.info( "setPlayerSeat() 莊家選位 : action : " + action + " , 莊家選取數目 : " + JSON.stringify(this.banker_seats) );

				this.banker_seats.forEach((i) =>
				{
					//toastr.success( "莊家選位 : i : " + i );

					this.seat_status[i - 1].text = "莊";
					this.seat_status[i - 1].is_banker = true;
				});
				
				//this.player_seats = [];
				// 存結果
				this.banker_seats = this.seat_status.filter((i) => i.is_banker === true).map((i) => i.seat_number);
				//toastr.info( "banker_seats : " + JSON.stringify(this.banker_seats) + " \n player_seats : " + JSON.stringify(this.player_seats) );

			}
			// 60秒： 閒家投注
			else if (action === "player")
			{
				//console.log("自選資料 : " + JSON.stringify(this.player_seats));

				let player_seats_lenth = Number(this.player_seats.length) ;
				//toastr.success( "setPlayerSeat() 閒家投注 " + action + " , 投注數目 : " + player_seats_lenth);
				// 最多只有4個
				if( player_seats_lenth > 40 )
				{
//					// 清除新選的位置
//					this.player_seats.pop();
//					// sub_table_number , sub_chair_number
//					// 清空剛才選的checked
//					document.getElementById("Char_" + sub_table_number + "_" + sub_chair_number).checked=false
//					//this.player_seats = [];
//					//console.log("自選資料-pop() : " + JSON.stringify(this.player_seats) + " , 長度 : " + Number(this.player_seats.length));
//					toastr.warning( "setPlayerSeat() 閒家最多只能投注4注 " );
//					// 完成後要把player_seats資料取消
//					this.seat_status = this.seat_status.map(i=> 
//					{
//						if(i.is_user === true)
//						{
//							i.is_user = false;
//							i.text = "";
//						}
//						return i;
//					});
//					// 閒家選的位子
//					this.player_seats.forEach((num) => 
//					{
//						// 已選的位置
//						//toastr.success( "自己已選的位置-setPlayerSeat() : " + num );
//						let seat_index = this.seat_status.findIndex((i) => i.seat_number == num);
//						//toastr.success( "選取的index值-setPlayerSeat() : " + seat_index );
//						
//						//console.log("閒家選的位子 : " + num + ", index : " + seat_index );
//
//						this.seat_status[seat_index].text = this.user_name;
//						this.seat_status[seat_index].is_user = true;
//					});
//					//console.log("自選資料 : " + JSON.stringify(this.player_seats));
//					//console.log("座位資料 : " + JSON.stringify(this.seat_status));
				}
				else
				{
					// 求出此位址是否已有選過
					// 設定閒家座位資料-sub_table_number + " , 按下的椅子位置 : " + sub_chair_number
					//toastr.success( "選取的位置值狀態 : " + seat_status['seat_number']['is_user'] );
					
					// 取出目前此座位是否已被我選取
					let seat_number_State = this.seat_status[seat_number-1].is_user;
					//toastr.success( "閒家投注 : " + seat_number_State );

					// 本日開始秒數					
					var Now_Game_Start = this.today_game_start;
					//alert(Now_Game_Start);

					axios
					.get('gameA_setUserSeat.php?seat_number=' + seat_number + "&table_number=" + sub_table_number + "&chair_number=" + sub_chair_number + "&seat_number_State=" + seat_number_State + "&Now_Game_Start=" + Now_Game_Start)
					//.get('gameA_setUserSeat.php?seat_number=' + seat_number + "&table_number=" + sub_table_number + "&chair_number=" + sub_chair_number + "&seat_number_State=" + seat_number_State )
					.then(response => 
					{
						//toastr.success( "回傳資料 : " + response.data );
						let State = Number(response.data.substr(0,2));
						console.log("閒家投注 - 回傳資料 : " + response.data);
		
						let RetMsg = response.data.substr(3) ;
						if( State < 0 )
						{	toastr.error( RetMsg );	}
						if( State > 0 )
						{// 取消選取成功
							if( seat_number_State == true )
							{	toastr.success( "取消選位成功" );	}
							else
							{	toastr.success( "選位成功" );	}
							// 設定剩下點數
							document.getElementById("Header_Member_Money").innerHTML = RetMsg ;
							document.getElementById("Footer_Member_Money").innerHTML = RetMsg ;
						}
					})
					.catch(function (error)
					{ // 請求失敗處理
						console.log(error);
					});

					setTimeout(function() {
						//alert(1111);
						$("body").mLoading("hide") ;
					}, 1000);
					// 反轉選取狀態
					this.seat_status = this.seat_status.map(i=> 
					{
						//toastr.success( "反轉選取狀態 : " + JSON.stringify(i) + " - " + i.is_user );
						// 反轉選取狀態 : {"seat_number":40,"text":"","is_banker":false,"is_user":false,"is_other":false} - false
						if(i.is_user === true)
						{
							i.is_user = false;
							i.text = "";
						}
						return i;
					});
					// 閒家選的位子
					this.player_seats.forEach((num) => 
					{
						// 已選的位置
						//toastr.success( "自己已選的位置-setPlayerSeat() : " + num );
						let seat_index = this.seat_status.findIndex((i) => i.seat_number == num);
						//toastr.success( "選取的index值-setPlayerSeat() : " + seat_index );
						
						this.seat_status[seat_index].text = this.user_name;
						this.seat_status[seat_index].is_user = true;
					});
				}
				//toastr.info( "player_seats() 自選資料 : " +  JSON.stringify(this.player_seats)  );
				//console.log("自選資料 : " + JSON.stringify(this.player_seats));

			}
			
			setTimeout(function() {
				//alert(1111);
				$("body").mLoading("hide") ;
			}, 2000);
			//sleep(1);
			//$("body").mLoading("hide") ;
        },

		// TODO: 設定其他玩家資料
		FsetOtherSeat()
		{
			// [DEMO] 亂數產生其他玩家
			let others_seats = this.FgetRandom(1, this.table_count * this.chair_count, 6, this.banker_seats); // 別的玩家 chair number
			//toastr.success( "其他玩家-FsetOtherSeat() : " + JSON.stringify(others_seats) );
			//其他玩家 : [11,5,10,40,35,16]
			//others_seats = [11,5,10,40,35,16];
			others_seats.forEach((i) =>
			{
				this.seat_status[i - 1].text = "其他"+i;
				this.seat_status[i - 1].is_other = true;
			});

 			// 存設定
			this.other_seats = this.seat_status.filter((i) => i.is_other === true).map((i) => i.seat_number);
		},

		// TODO: 取得莊家資料
		FsetBankerSeat()
		{
			// [DEMO] 亂數產生莊家位子
			let banker_table = this.FgetRandom(1, this.table_count); // 產生桌號
			//toastr.success( "取得莊家資料-FsetBankerSeat() : " + JSON.stringify(banker_table) );
			// [16]
			let banker_seats = [banker_table * 2, banker_table * 2 - 1]; // 莊家 chair number
			banker_seats.forEach((i) =>
			{
				this.seat_status[i - 1].text = "莊";
				this.seat_status[i - 1].is_banker = true;
			});
			
			// 存結果
			this.banker_seats = this.seat_status.filter((i) => i.is_banker === true).map((i) => i.seat_number);
		},

		// TODO: 取得開獎結果
		FgetNewResult()
		{
			let ball_number = [];
			let ball_point = [];
			
			axios
			.get('gameA_getNewBingoNum.php')
			.then(response => {
				let NewBingo = response.data ;
				//toastr.success( "取得開獎結果-FgetNewResult() : \n" + NewBingo );
				// 字串轉陣列
				this.ball_number = NewBingo.split(",");
				//toastr.success( "取得開獎結果1 : " + this.ball_number.length );
				
				this.ball_point = this.ball_number.map((num) =>
				{
					let char = (num + "").split("");
					if(char.length > 1 && char[0] === char[1]) return num; // 對子返回數字
					return char.reduce((acc, cur) => acc + parseInt(cur), 0).toString().slice(-1); // 返回加總後個位數
				});
				
			})
			.catch(function (error) { // 請求失敗處理
				console.log(error);
			});
			
			
			//ball_number = this.FgetRandom(1, 80, 20); // [DEMO] 亂數模擬
			//ball_number = [65,49,56,59,38,7,42,8,39,76,31,22,37,58,1,41,55,25,62,54];
			//toastr.success( "取得開獎結果3 : " + this.ball_number.length );
			//toastr.success( "取得開獎結果2 : " + ball_number.join(",") );
			// 取得開獎結果 : [65,49,56,59,38,7,42,8,39,76,31,22,37,58,34,41,55,25,62,54]
			/*
			ball_point = ball_number.map((num) =>
			{
				let char = (num + "").split("");
				if(char.length > 1 && char[0] === char[1]) return num; // 對子返回數字
				return char.reduce((acc, cur) => acc + parseInt(cur), 0).toString().slice(-1); // 返回加總後個位數
			});
			
			this.ball_number = ball_number; // 球號
			this.ball_point = ball_point; // 計算每顆球的值
			*/
		},

		FApply_Banker()
		{// 進行排莊
			//toastr.success( "進行排莊 : " );
			axios
			.get('gameA_setApply_Banker.php')
			.then(response => 
			{
				//toastr.success( "回傳資料 : " + response.data);
				let State = Number(response.data.substr(0,2));
				//console.log(State);

				let RetMsg = response.data.substr(3) ;
				//toastr.success( "回傳狀態 : " + State + " , 回傳訊息 : " + RetMsg);
				if( State < 0 )
				{	toastr.error( RetMsg );	}
				if( State > 0 )
				{
					toastr.success( "加入排莊成功" );
					// 設定剩下點數
					document.getElementById("Header_Member_Money").innerHTML = RetMsg ;
					document.getElementById("Footer_Member_Money").innerHTML = RetMsg ;
				}
				
				//toastr.success( "回傳資料 : " + response.data );
				//this.info = response.data
			})
			.catch(function (error)
			{ // 請求失敗處理
				console.log(error);
			});
			
		},
//		FApply_Banker1:function (event)
//		{
//			toastr.success( "進行排莊 : " );
//			//toastr.success( "取得排莊列表 : " );
//			axios
//			.get('gameA_getBankerArea.php')
//			.then(response => 
//			{
//				this.BankerArea = response.data ;
//				//document.getElementById("BankerArea").innerHTML = response.data ;
//			})
//			.catch(function (error)
//			{ // 請求失敗處理
//				console.log(error);
//			});
////			if(event.target.nodeName === 'BUTTON'){
////			// 获取触发事件对象的属性
////			alert("a");
////			}
//		},
		FgetBankerArea()
		{// 取得排莊列表
			//toastr.success( "取得排莊列表 : " );
			axios
			.get('gameA_getBankerArea.php')
			.then(response => 
			{
				this.BankerArea = response.data ;
				//document.getElementById("BankerArea").innerHTML = response.data ;
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

		FgetBingoHistory()
		{// 取得Bingo獎號資訊
			//toastr.success( "取得排莊列表 : " );
			axios
			.get('../../gameA_getBingoHistory.php')
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

		// [DEMO] 取得url query (DEMO用，為了抓是否為長莊無倍數區)
		getURLQuery()
		{
			let query = location.search.split("?");
			if (query.length > 1)
			{
				query = query[1].split("&").reduce((acc, cur) =>
					{
						let value = cur.split("=");
						acc[value[0]] = value[1];
						return acc;
					}, {});
					
					return query;
				}
			}
		},
		

		mounted()
		{// 一開始會執行的程式
			$("body").mLoading("show") ;
			this.getTime();				// 取得時間
			this.getGameInfo();			// 遊戲基本資料
			this.initSeatStatus();		// 初始化坐位表
			this.FgetNewResult();		// 取得開獎結果
			//this.FgetBankerArea();		// 取得排莊列表
			this.FgetBingoHistory();	// 取得Bingo獎號資訊
			let UserName = document.getElementById("UserName").innerHTML ;		// 找出會員名稱-UserName
			this.user_name = UserName.substring(0,3);
			
			// 取得目前網站關鍵字-不是大陸用數字
			var conn_webkey = $("body").data("conn_webkey")
			if( conn_webkey == "asia17888" )
			{	this.set_Table_Char_N();	}	// 設定桌號轉成數字
			else
			{	this.set_Table_Char_E();	}	// 設定桌號轉成英文

			this.BankerArea = "" ;
			setTimeout(function() {
				$("body").mLoading("hide") ;
			}, 2000);

			// [DEMO] 設定是否為長莊無倍數區
			let query = this.getURLQuery();
			console.log("query : " + query);
			this.zone_code = query.zone_code ? (query.zone_code)  : 1; // 設定區 1=輪莊有倍數區 2=長莊無倍數區 (長莊無倍數區=申請排莊和BONUS會隱藏)
		},

    });
  }
})();

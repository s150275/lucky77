-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2020 年 11 月 19 日 14:51
-- 伺服器版本: 5.6.49-log
-- PHP 版本： 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `lucky77`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Agent`
--

CREATE TABLE IF NOT EXISTS `Agent` (
  `id_Agent` int(10) unsigned NOT NULL,
  `Agent_ID` char(15) NOT NULL COMMENT '代理人ID',
  `Agent_Father_ID` char(15) NOT NULL COMMENT '代理人父ID',
  `Agent_Online_id` varchar(255) NOT NULL COMMENT '上線id',
  `Agent_Name` varchar(50) NOT NULL COMMENT '代理人名稱',
  `Agent_Login_Name` varchar(20) NOT NULL COMMENT '帳號',
  `Agent_Login_Passwd` char(20) NOT NULL COMMENT '密碼',
  `Agent_Login_Title` varchar(5) NOT NULL COMMENT '帳號開頭',
  `Agent_Login_NChar` int(11) NOT NULL COMMENT '子帳號開頭字母值',
  `Agent_Login_NIndex` int(11) NOT NULL COMMENT '子帳號開頭Index值',
  `Agent_Level` tinyint(4) NOT NULL DEFAULT '1' COMMENT '帳號權限',
  `Agent_Layers` tinyint(4) NOT NULL COMMENT '所在層數',
  `Agent_Email` varchar(50) NOT NULL COMMENT 'Email',
  `Agent_Birthday` date NOT NULL COMMENT '生日',
  `Agent_Sex` char(1) NOT NULL DEFAULT 'M' COMMENT '性別',
  `Agent_Mobile` varchar(15) NOT NULL COMMENT '手機',
  `Agent_City` char(1) NOT NULL COMMENT '縣市',
  `Agent_Money` float(16,2) NOT NULL COMMENT '金額',
  `Agent_General_Bet_Min` int(11) NOT NULL COMMENT '一般玩法-最小押注金額',
  `Agent_Super_Bet_Min` int(11) NOT NULL COMMENT '超級玩法-最小押注金額',
  `Agent_Backwater` int(11) NOT NULL COMMENT '輪莊-手續費退水',
  `Agent_Backwater2` int(11) NOT NULL COMMENT '長莊-手續費退水',
  `Agent_Share` int(11) NOT NULL COMMENT '長莊輸贏佔成',
  `Agent_Backwater3` int(11) NOT NULL DEFAULT '100' COMMENT '長莊有倍-手續費退水',
  `Agent_Share3` int(11) NOT NULL DEFAULT '100' COMMENT '長莊有倍輸贏佔成',
  `Agent_Login_DT` datetime NOT NULL COMMENT '上次登入日期',
  `Agent_Login_IP` varchar(15) NOT NULL COMMENT '上次登入IP',
  `Agent_Content` text NOT NULL COMMENT '備註',
  `Agent_Sort` int(11) NOT NULL COMMENT '排序',
  `Agent_Log` text NOT NULL COMMENT 'Log',
  `Agent_Add_DT` datetime NOT NULL COMMENT '新增日期',
  `Agent_Mod_DT` datetime NOT NULL COMMENT '修改日期',
  `Agent_Open_Offline` tinyint(4) NOT NULL COMMENT '開設下級代理權限',
  `Agent_Open_Member` tinyint(4) NOT NULL COMMENT '開設下線會員權限',
  `Agent_On` tinyint(4) NOT NULL COMMENT '會員權限',
  `Over_Period_Set` int(3) NOT NULL DEFAULT '0' COMMENT '會員超過期數投注設定',
  `Bet_Again_Period` int(3) NOT NULL DEFAULT '0' COMMENT '會員隔幾期才可投注設定',
  `ApplyBanker_Set_Array` text COMMENT '長莊位置切換'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `ApplyBanker`
--

CREATE TABLE IF NOT EXISTS `ApplyBanker` (
  `id_ApplyBanker` int(10) unsigned NOT NULL,
  `ApplyBanker_Set_ID` char(16) NOT NULL COMMENT '排莊ID',
  `ApplyBanker_Operator_Name` varchar(20) NOT NULL COMMENT '排莊名稱',
  `ApplyBanker_Bingo_Period_Start` int(11) NOT NULL COMMENT '排莊Bingo開始期號',
  `ApplyBanker_Bingo_Period_End` int(11) NOT NULL COMMENT '排莊Bingo結束期號',
  `ApplyBanker_Room` varchar(7) NOT NULL COMMENT '排莊房間',
  `ApplyBanker_Chips_Money` int(11) NOT NULL COMMENT '籌碼金額',
  `ApplyBanker_Withhold_Money` int(11) NOT NULL COMMENT '預扣金額',
  `ApplyBanker_Add_DT` datetime NOT NULL COMMENT '排莊時間',
  `ApplyBanker_On` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排莊狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `BackWater`
--

CREATE TABLE IF NOT EXISTS `BackWater` (
  `id_BackWater` int(10) unsigned NOT NULL,
  `BackWater_Set_ID` char(16) NOT NULL COMMENT '設定者ID',
  `BackWater_Bingo_Gen_12Start` float(8,2) NOT NULL COMMENT '一般大小和12星球',
  `BackWater_Bingo_Super` float(8,1) NOT NULL COMMENT '賓果超級退水',
  `BackWater_Bingo_345Start` float(8,1) NOT NULL COMMENT '345星球退水'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `Banker`
--

CREATE TABLE IF NOT EXISTS `Banker` (
  `id_Banker` int(10) unsigned NOT NULL,
  `Banker_id_ApplyBanker` int(11) NOT NULL COMMENT '排莊id',
  `Banker_Set_ID` char(16) NOT NULL COMMENT '當莊ID',
  `Banker_Operator_Name` varchar(20) NOT NULL COMMENT '當莊名稱',
  `Banker_Bingo_Period` int(11) NOT NULL COMMENT '開獎Bingo期號',
  `Banker_Room` varchar(7) NOT NULL COMMENT '當莊房間',
  `Banker_Banker_Table` tinyint(4) NOT NULL COMMENT '莊家桌號',
  `Banker_Banker_Seats` varchar(20) NOT NULL COMMENT '莊家位子',
  `Banker_Withhold_Money` int(11) NOT NULL COMMENT '預扣金額',
  `Banker_WinLost_Money` float(16,2) NOT NULL COMMENT '輸贏金額',
  `Banker_WinLost_AllMoney` float(16,2) NOT NULL COMMENT '輸贏總金額',
  `Banker_Wave_Type` varchar(5) NOT NULL COMMENT '當莊類型',
  `Banker_Log` text NOT NULL COMMENT 'Log',
  `Banker_Add_DT` datetime NOT NULL COMMENT '當莊時間',
  `Banker_Return_State` tinyint(4) NOT NULL DEFAULT '0' COMMENT '還回狀態',
  `Banker_On` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排莊狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `Banker2`
--

CREATE TABLE IF NOT EXISTS `Banker2` (
  `id_Banker` int(10) unsigned NOT NULL,
  `Banker_Operator_Name` varchar(20) NOT NULL COMMENT '當莊名稱',
  `Banker_Bingo_Period` int(11) NOT NULL COMMENT '開獎Bingo期號',
  `Banker_Banker_Id` tinyint(3) NOT NULL COMMENT '座位編號',
  `Banker_Banker_Table` varchar(15) NOT NULL COMMENT '莊家桌號',
  `Banker_Banker_Seats` varchar(20) NOT NULL COMMENT '莊家位子',
  `Banker_Add_DT` datetime NOT NULL COMMENT '後台新增時間'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='長莊每日每期排裝表';

-- --------------------------------------------------------

--
-- 資料表結構 `BetGodnine`
--

CREATE TABLE IF NOT EXISTS `BetGodnine` (
  `id_BetGodnine` int(10) unsigned NOT NULL,
  `BetGodnine_ID` char(18) NOT NULL COMMENT '下注單號',
  `BetGodnine_Agent_ID` char(15) NOT NULL COMMENT '代理人代號ID',
  `BetGodnine_Member_ID` char(16) NOT NULL COMMENT '閒家代號ID',
  `BetGodnine_Member_Name` char(50) NOT NULL COMMENT '閒家名稱',
  `BetGodnine_Bingo_Period` int(11) NOT NULL COMMENT '開獎Bingo期號',
  `BetGodnine_Chips` int(11) NOT NULL COMMENT '下注籌碼',
  `BetGodnine_Withhold_Chips` int(11) NOT NULL COMMENT '下注預扣籌碼',
  `BetGodnine_Type` tinyint(4) NOT NULL COMMENT '下注區',
  `BetGodnine_Room` char(16) NOT NULL COMMENT '下注房間',
  `BetGodnine_Table` tinyint(4) NOT NULL COMMENT '下注桌',
  `BetGodnine_Chair` tinyint(4) NOT NULL COMMENT '下注椅子',
  `BetGodnine_Num` tinyint(4) NOT NULL COMMENT '下注號',
  `Banker_Table` tinyint(4) DEFAULT NULL COMMENT '長莊該期桌號',
  `BetGodnine_Odds` varchar(10) NOT NULL COMMENT '輸贏賠率',
  `BetGodnine_WinLost_Money` float(16,2) NOT NULL COMMENT '輸贏金額',
  `BetGodnine_Handling_Fee` float(16,2) NOT NULL COMMENT '手續費',
  `BetGodnine_WinLost_AllMoney` float(16,2) NOT NULL COMMENT '閒家輸贏總金額',
  `BetGodnine_Member_Proportion` int(11) NOT NULL COMMENT '下注占成',
  `BetGodnine_Member_Backwater_Ratio` int(11) NOT NULL COMMENT '下注返水比',
  `BetGodnine_Member_WinLost_Money` float(16,2) NOT NULL COMMENT '會員下注輸贏金額',
  `BetGodnine_Member_Backwater_Money` float(16,2) NOT NULL COMMENT '下注返水金額',
  `BetGodnine_Member_WinLost_AllMoney` float(16,2) NOT NULL COMMENT '會員下注總金額',
  `BetGodnine_Member_Report_Money` float(16,2) NOT NULL COMMENT '下注報帳金額',
  `BetGodnine_Online_WinLost_Money` varchar(255) NOT NULL COMMENT '閒家代理人上線輸贏金額',
  `BetGodnine_Online_Backwater_Ratio` varchar(255) NOT NULL COMMENT '閒家代理人上線返水比',
  `BetGodnine_Online_Backwater_Money` varchar(255) NOT NULL COMMENT '閒家代理人上線返水金額',
  `BetGodnine_Online_AllMoney` varchar(255) NOT NULL COMMENT '閒家代理人上線總金額',
  `BetGodnine_Online_Share_Ratio` varchar(255) NOT NULL COMMENT '閒家代理人上線占成比',
  `BetGodnine_Online_Reported_Money` varchar(255) NOT NULL COMMENT '閒家代理人上線報帳金額',
  `BetGodnine_Online_id` varchar(255) NOT NULL COMMENT '閒家代理人上線id',
  `BetGodnine_Banker_Agent_ID` varchar(15) NOT NULL COMMENT '莊家代理人代號ID',
  `BetGodnine_Banker_ID` char(16) NOT NULL COMMENT '莊家代號ID',
  `BetGodnine_Banker_Name` char(50) NOT NULL COMMENT '莊家名稱',
  `BetGodnine_Banker_Proportion` int(11) NOT NULL COMMENT '莊家占成',
  `BetGodnine_Banker_Backwater_Ratio` int(11) NOT NULL COMMENT '莊家返水比',
  `BetGodnine_Banker_WinLost_Money` float(16,2) NOT NULL COMMENT '莊家輸贏金額',
  `BetGodnine_Banker_Backwater_Money` float(16,2) NOT NULL COMMENT '莊家返水金額',
  `BetGodnine_Banker_WinLost_AllMoney` float(16,2) NOT NULL COMMENT '莊家輸贏總金額',
  `BetGodnine_Banker_Report_Money` float(16,2) NOT NULL COMMENT '莊家報帳金額',
  `BetGodnine_Banker_Online_WinLost_Money` varchar(255) NOT NULL COMMENT '莊家代理人上線輸贏金額',
  `BetGodnine_Banker_Online_Backwater_Ratio` varchar(255) NOT NULL COMMENT '莊家代理人上線返水比',
  `BetGodnine_Banker_Online_Backwater_Money` varchar(255) NOT NULL COMMENT '莊家代理人上線返水金額',
  `BetGodnine_Banker_Online_AllMoney` varchar(255) NOT NULL COMMENT '莊家代理人上線總金額',
  `BetGodnine_Banker_Online_Share_Ratio` varchar(255) NOT NULL COMMENT '莊家代理人上線占成比',
  `BetGodnine_Banker_Online_Reported_Money` varchar(255) NOT NULL COMMENT '莊家上線報帳金額',
  `BetGodnine_Banker_Online_id` varchar(255) NOT NULL COMMENT '莊家上線id',
  `BetGodnine_Operate_IP` varchar(15) NOT NULL COMMENT '操作IP',
  `BetGodnine_Content` text NOT NULL COMMENT '備註',
  `BetGodnine_Log` text NOT NULL COMMENT 'Log',
  `BetGodnine_Draw_DT` datetime NOT NULL COMMENT '開獎日期',
  `BetGodnine_Add_DT` datetime NOT NULL COMMENT '押注時間',
  `BetGodnine_WinLost_Type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '輸贏狀態',
  `BetGodnine_Draw` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否已開獎',
  `BetGodnine_On` tinyint(4) NOT NULL DEFAULT '0' COMMENT '權限',
  `BetGodnine_Bingo_NowPeriod` int(11) DEFAULT NULL COMMENT '修改權限時紀錄現在的期數'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `Bingo`
--

CREATE TABLE IF NOT EXISTS `Bingo` (
  `id_Bingo` int(10) unsigned NOT NULL,
  `Bingo_Period` int(11) NOT NULL COMMENT '期數',
  `Bingo_Num` varchar(255) NOT NULL COMMENT '開獎號碼',
  `Bingo_Draw_Order_Num` varchar(255) NOT NULL COMMENT '開獎順序號碼',
  `Bingo_DrawDate` date NOT NULL COMMENT '開獎日期',
  `Bingo_DrawDT` char(5) NOT NULL COMMENT '開獎時間',
  `Bingo_Super_Num` int(11) NOT NULL COMMENT '超級獎號',
  `Bingo_Super_Same` int(11) NOT NULL COMMENT '連莊球數',
  `Bingo_Size_Same` varchar(10) NOT NULL COMMENT '一般大小連莊次數',
  `Bingo_Super_BS_Same` varchar(10) NOT NULL COMMENT '超級大小連莊次數',
  `Bingo_Super_SD_Same` varchar(10) NOT NULL COMMENT '超級單雙連莊次數',
  `Bingo_Godnine_Calculate` varchar(255) NOT NULL COMMENT '財神九仔生計算值',
  `Bingo_Godnine_Multiple` varchar(255) NOT NULL COMMENT '財神九仔生倍數值',
  `Bingo_Add_DT` datetime NOT NULL COMMENT '新增日期',
  `Bingo_On` char(1) NOT NULL DEFAULT '1' COMMENT '參數狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `Bulletin`
--

CREATE TABLE IF NOT EXISTS `Bulletin` (
  `id_Bulletin` int(10) unsigned NOT NULL,
  `Bulletin_Title` varchar(50) NOT NULL COMMENT '公告標題',
  `Bulletin_Pict` varchar(50) NOT NULL COMMENT '公告圖片',
  `Bulletin_Content` text NOT NULL COMMENT '公告內容',
  `Bulletin_Count` int(11) NOT NULL COMMENT '瀏覽次數',
  `Bulletin_PutTop` tinyint(4) NOT NULL DEFAULT '0' COMMENT '置頂狀態',
  `Bulletin_Mod_DT` datetime NOT NULL COMMENT '修改日期',
  `Bulletin_Add_DT` datetime NOT NULL COMMENT '新增日期',
  `Bulletin_On` tinyint(4) NOT NULL DEFAULT '0' COMMENT '消息狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `LogAdmin`
--

CREATE TABLE IF NOT EXISTS `LogAdmin` (
  `id_LogAdmin` int(10) unsigned NOT NULL,
  `LogAdmin_AdminID` varchar(20) NOT NULL COMMENT '管理者ID',
  `LogAdmin_Database` varchar(20) NOT NULL COMMENT '操作類別(資料庫名稱)',
  `LogAdmin_OperatorID` varchar(20) NOT NULL COMMENT '操作ID',
  `LogAdmin_Type` varchar(10) NOT NULL COMMENT '操作動作',
  `LogAdmin_Msg` text NOT NULL COMMENT 'Log內容',
  `LogAdmin_Start_DT` datetime NOT NULL COMMENT '開始日期',
  `LogAdmin_End_DT` datetime NOT NULL COMMENT '結束日期',
  `LogAdmin_Add_DT` datetime NOT NULL COMMENT '新增日期',
  `LogAdmin_On` char(1) NOT NULL DEFAULT '1' COMMENT '參數狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `LogInfo`
--

CREATE TABLE IF NOT EXISTS `LogInfo` (
  `id_LogInfo` int(10) unsigned NOT NULL,
  `LogInfo_OperatorID` varchar(20) NOT NULL COMMENT '操作ID',
  `LogInfo_Database` varchar(20) NOT NULL COMMENT '操作類別(資料庫名稱)',
  `LogInfo_Msg` text NOT NULL COMMENT 'Log內容',
  `LogInfo_Start_DT` datetime NOT NULL COMMENT '開始日期',
  `LogInfo_End_DT` datetime NOT NULL COMMENT '結束日期',
  `LogInfo_Add_DT` datetime NOT NULL COMMENT '新增日期',
  `LogInfo_On` char(1) NOT NULL DEFAULT '1' COMMENT '參數狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `LoginInfo`
--

CREATE TABLE IF NOT EXISTS `LoginInfo` (
  `id_LoginInfo` int(10) unsigned NOT NULL,
  `LoginInfo_ID` varchar(30) NOT NULL COMMENT '登入帳號ID',
  `LoginInfo_IP` varchar(15) NOT NULL COMMENT '登入IP',
  `LoginInfo_Session_ID` varchar(30) NOT NULL COMMENT '登入SESSION ID',
  `LoginInfo_Web` varchar(30) NOT NULL COMMENT '登入後台名稱',
  `LoginInfo_Login_DT` datetime NOT NULL COMMENT '登入時間'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `Member`
--

CREATE TABLE IF NOT EXISTS `Member` (
  `id_Member` int(10) unsigned NOT NULL,
  `Member_ID` char(16) NOT NULL COMMENT '會員代號',
  `Member_Father_ID` char(16) NOT NULL COMMENT '父ID',
  `Member_Name` varchar(50) NOT NULL COMMENT '會員名稱',
  `Member_Alias` varchar(50) NOT NULL COMMENT '會員別名',
  `Member_Login_Title` varchar(5) NOT NULL COMMENT '帳號開頭',
  `Member_Login_Name` varchar(20) NOT NULL COMMENT '帳號',
  `Member_Login_Passwd` char(20) NOT NULL COMMENT '密碼',
  `Member_Level` tinyint(4) NOT NULL DEFAULT '1' COMMENT '帳號權限',
  `Member_Layers` tinyint(4) NOT NULL COMMENT '所在層數',
  `Member_Email` varchar(50) NOT NULL COMMENT 'Email',
  `Member_Birthday` date NOT NULL COMMENT '生日',
  `Member_Sex` char(1) NOT NULL DEFAULT 'M' COMMENT '性別',
  `Member_Mobile` varchar(15) NOT NULL COMMENT '手機',
  `Member_City` char(1) NOT NULL COMMENT '縣市',
  `Member_Title` varchar(20) NOT NULL COMMENT '職稱',
  `Member_Money` float(16,2) NOT NULL COMMENT '金額',
  `Member_BetRegMoney` float(16,2) NOT NULL COMMENT '下注後金額',
  `Member_Peak_Value` int(11) NOT NULL COMMENT '峰頂值',
  `Member_General_Bet_Min` int(11) NOT NULL COMMENT '一般玩法-最小押注金額',
  `Member_Super_Bet_Min` int(11) NOT NULL COMMENT '超?玩法-最小押注金額',
  `Member_Login_DT` datetime NOT NULL COMMENT '上次登入日期',
  `Member_Login_IP` varchar(15) NOT NULL COMMENT '上次登入IP',
  `Member_Online_id` varchar(255) NOT NULL COMMENT '上線id',
  `Member_INRoom_Num` varchar(10) NOT NULL COMMENT '進入房間號',
  `Member_INRoom_DT` datetime NOT NULL COMMENT '進入房間時間',
  `Member_Content` text NOT NULL COMMENT '備註',
  `Member_Sort` int(11) NOT NULL COMMENT '排序',
  `Member_PutTop` tinyint(4) NOT NULL DEFAULT '0' COMMENT '置頂',
  `Member_Log` text NOT NULL COMMENT 'Log',
  `Member_Add_DT` datetime NOT NULL COMMENT '開戶日期',
  `Member_Bingo_On` tinyint(4) NOT NULL COMMENT '賓果投注權限',
  `Member_On` tinyint(4) NOT NULL COMMENT '會員權限',
  `Start_Count_Period` int(11) DEFAULT NULL COMMENT '開始計算該會員未下注期數',
  `Again_BetGodnine_Period` int(11) DEFAULT NULL COMMENT '該會員能再次投注期數'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `ModelSet`
--

CREATE TABLE IF NOT EXISTS `ModelSet` (
  `id_ModelSet` int(10) unsigned NOT NULL,
  `ModelSet_Name` varchar(50) NOT NULL COMMENT '參數名稱',
  `ModelSet_Key` varchar(50) NOT NULL COMMENT '參數關鍵字',
  `ModelSet_Value_Type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '參數值類別',
  `ModelSet_Value` varchar(50) NOT NULL COMMENT '參數功能字',
  `ModelSet_Group` varchar(50) NOT NULL COMMENT '參數群組名',
  `ModelSet_Content` text NOT NULL COMMENT '參數說明',
  `ModelSet_Sort` int(11) NOT NULL COMMENT '排序',
  `ModelSet_Add_DT` datetime NOT NULL COMMENT '新增日期',
  `ModelSet_On` char(1) NOT NULL DEFAULT '1' COMMENT '狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `MoneyLog`
--

CREATE TABLE IF NOT EXISTS `MoneyLog` (
  `id_MoneyLog` int(10) unsigned NOT NULL,
  `MoneyLog_Set_ID` char(16) NOT NULL COMMENT '設定者ID',
  `MoneyLog_Class` tinyint(4) NOT NULL COMMENT '操作分類',
  `MoneyLog_Type` tinyint(4) NOT NULL COMMENT '操作動作',
  `MoneyLog_Bet_ID` char(18) NOT NULL COMMENT '下注訂單號',
  `MoneyLog_Money` float(16,2) NOT NULL COMMENT '操作金額',
  `MoneyLog_Original_Money` float(16,2) NOT NULL COMMENT '操作前金額',
  `MoneyLog_Operator_IP` varchar(15) NOT NULL COMMENT '操作者IP',
  `MoneyLog_Operator_ID` varchar(16) NOT NULL COMMENT '操作者ID',
  `MoneyLog_Operator_Name` varchar(20) NOT NULL COMMENT '操作者名稱',
  `MoneyLog_Online_id` varchar(255) NOT NULL COMMENT '上線id',
  `MoneyLog_Log` varchar(255) NOT NULL COMMENT '操作Log',
  `MoneyLog_Add_DT` datetime NOT NULL COMMENT '操作時間'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `News`
--

CREATE TABLE IF NOT EXISTS `News` (
  `id_News` int(10) unsigned NOT NULL,
  `News_Title` varchar(50) NOT NULL COMMENT '消息標題',
  `News_Pict` varchar(50) NOT NULL COMMENT '消息圖片',
  `News_Content` text NOT NULL COMMENT '消息內容',
  `News_Count` int(11) NOT NULL COMMENT '瀏覽次數',
  `News_PutTop` tinyint(4) NOT NULL DEFAULT '0' COMMENT '置頂狀態',
  `News_Mod_DT` datetime NOT NULL COMMENT '修改日期',
  `News_Add_DT` datetime NOT NULL COMMENT '新增日期',
  `News_On` tinyint(4) NOT NULL DEFAULT '0' COMMENT '消息狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `Odds`
--

CREATE TABLE IF NOT EXISTS `Odds` (
  `id_Odds` int(10) unsigned NOT NULL,
  `Odds_Super_Big` float(8,2) NOT NULL COMMENT '超級大賠率',
  `Odds_Super_Small` float(8,2) NOT NULL COMMENT '超級小賠率',
  `Odds_Super_Single` float(8,2) NOT NULL COMMENT '超級單賠率',
  `Odds_Super_Double` float(8,2) NOT NULL COMMENT '超級雙賠率',
  `Odds_1Start1` float(8,2) NOT NULL COMMENT '1星中1賠率',
  `Odds_2Start1` float(8,2) NOT NULL COMMENT '2星中1賠率',
  `Odds_2Start2` float(8,2) NOT NULL COMMENT '2星中2賠率',
  `Odds_3Start2` float(8,2) NOT NULL COMMENT '3星中2賠率',
  `Odds_3Start3` float(8,2) NOT NULL COMMENT '3星中3賠率',
  `Odds_4Start2` float(8,2) NOT NULL COMMENT '4星中2賠率',
  `Odds_4Start3` float(8,2) NOT NULL COMMENT '4星中3賠率',
  `Odds_4Start4` float(8,2) NOT NULL COMMENT '4星中4賠率',
  `Odds_5Start3` float(8,2) NOT NULL COMMENT '5星中3賠率',
  `Odds_5Start4` float(8,2) NOT NULL COMMENT '5星中4賠率',
  `Odds_5Start5` float(8,2) NOT NULL COMMENT '5星中5賠率',
  `Odds_Big` float(8,2) NOT NULL COMMENT '一般大賠率',
  `Odds_Small` float(8,2) NOT NULL COMMENT '一般小賠率'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `OnLine`
--

CREATE TABLE IF NOT EXISTS `OnLine` (
  `id_OnLine` int(10) unsigned NOT NULL,
  `OnLine_Set_ID` char(16) NOT NULL COMMENT '設定者ID',
  `OnLine_IP` varchar(15) NOT NULL COMMENT '登入IP',
  `OnLine_Bet_DT` datetime NOT NULL COMMENT '下注時間',
  `OnLine_DT` datetime NOT NULL COMMENT '有效時間'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `SystemSet`
--

CREATE TABLE IF NOT EXISTS `SystemSet` (
  `id_SystemSet` int(10) unsigned NOT NULL,
  `SystemSet_Super_Big_Odds` float(8,2) NOT NULL COMMENT '超級大賠率',
  `SystemSet_Super_Small_Odds` float(8,2) NOT NULL COMMENT '超級小賠率',
  `SystemSet_Super_Single_Odds` float(8,2) NOT NULL COMMENT '超級單賠率',
  `SystemSet_Super_Double_Odds` float(8,2) NOT NULL COMMENT '超級雙賠率',
  `SystemSet_1Start1_Odds` float(8,2) NOT NULL COMMENT '1星中1賠率',
  `SystemSet_2Start1_Odds` float(8,2) NOT NULL COMMENT '2星中1賠率',
  `SystemSet_2Start2_Odds` float(8,2) NOT NULL COMMENT '2星中2賠率',
  `SystemSet_3Start2_Odds` float(8,2) NOT NULL COMMENT '3星中2賠率',
  `SystemSet_3Start3_Odds` float(8,2) NOT NULL COMMENT '3星中3賠率',
  `SystemSet_4Start2_Odds` float(8,2) NOT NULL COMMENT '4星中2賠率',
  `SystemSet_4Start3_Odds` float(8,2) NOT NULL COMMENT '4星中3賠率',
  `SystemSet_4Start4_Odds` float(8,2) NOT NULL COMMENT '4星中4賠率',
  `SystemSet_5Start3_Odds` float(8,2) NOT NULL COMMENT '5星中3賠率',
  `SystemSet_5Start4_Odds` float(8,2) NOT NULL COMMENT '5星中4賠率',
  `SystemSet_5Start5_Odds` float(8,2) NOT NULL COMMENT '5星中5賠率',
  `SystemSet_Big_Odds` float(8,2) NOT NULL COMMENT '一般大賠率',
  `SystemSet_Small_Odds` float(8,2) NOT NULL COMMENT '一般小賠率'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `SystemUser`
--

CREATE TABLE IF NOT EXISTS `SystemUser` (
  `id_SystemUser` int(10) unsigned NOT NULL,
  `SystemUser_ID` char(10) NOT NULL COMMENT '會員ID',
  `SystemUser_Name` varchar(30) NOT NULL COMMENT '名稱',
  `SystemUser_Login_Name` varchar(12) NOT NULL COMMENT '帳號',
  `SystemUser_Login_Passwd` char(20) NOT NULL COMMENT '密碼',
  `SystemUser_Level` char(1) NOT NULL DEFAULT '2' COMMENT '帳號權限',
  `SystemUser_Email` varchar(50) NOT NULL COMMENT 'Email',
  `SystemUser_Birthday` date NOT NULL COMMENT '生日',
  `SystemUser_Sex` char(1) NOT NULL COMMENT '性別',
  `SystemUser_Mobile` varchar(15) NOT NULL COMMENT '手機',
  `SystemUser_Title` varchar(20) NOT NULL COMMENT '職稱',
  `SystemUser_Content` text NOT NULL COMMENT '備註',
  `SystemUser_Log` text NOT NULL COMMENT 'Log記錄',
  `SystemUser_On` char(1) NOT NULL COMMENT '資料發表',
  `SystemUser_Add_DT` datetime NOT NULL COMMENT '新增日期',
  `SystemUser_Mod_DT` datetime NOT NULL COMMENT '修改日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `Test_Bingo`
--

CREATE TABLE IF NOT EXISTS `Test_Bingo` (
  `id_Bingo` int(10) unsigned NOT NULL,
  `Bingo_Period` int(11) NOT NULL COMMENT '期數',
  `Bingo_Num` varchar(255) NOT NULL COMMENT '開獎號碼',
  `Bingo_Draw_Order_Num` varchar(255) NOT NULL COMMENT '開獎順序號碼',
  `Bingo_DrawDate` date NOT NULL COMMENT '開獎日期',
  `Bingo_DrawDT` char(5) NOT NULL COMMENT '開獎時間',
  `Bingo_Super_Num` int(11) NOT NULL COMMENT '超級獎號',
  `Bingo_Super_Same` int(11) NOT NULL COMMENT '連莊球數',
  `Bingo_Size_Same` varchar(10) NOT NULL COMMENT '一般大小連莊次數',
  `Bingo_Super_BS_Same` varchar(10) NOT NULL COMMENT '超級大小連莊次數',
  `Bingo_Super_SD_Same` varchar(10) NOT NULL COMMENT '超級單雙連莊次數',
  `Bingo_Godnine_Calculate` varchar(255) NOT NULL COMMENT '財神九仔生計算值',
  `Bingo_Godnine_Multiple` varchar(255) NOT NULL COMMENT '財神九仔生倍數值',
  `Bingo_Add_DT` datetime NOT NULL COMMENT '新增日期',
  `Bingo_On` char(1) NOT NULL DEFAULT '1' COMMENT '參數狀態'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `Agent`
--
ALTER TABLE `Agent`
  ADD PRIMARY KEY (`id_Agent`),
  ADD KEY `Over_Period_Set` (`Over_Period_Set`),
  ADD KEY `Bet_Again_Period` (`Bet_Again_Period`);

--
-- 資料表索引 `ApplyBanker`
--
ALTER TABLE `ApplyBanker`
  ADD PRIMARY KEY (`id_ApplyBanker`);

--
-- 資料表索引 `BackWater`
--
ALTER TABLE `BackWater`
  ADD PRIMARY KEY (`id_BackWater`);

--
-- 資料表索引 `Banker`
--
ALTER TABLE `Banker`
  ADD PRIMARY KEY (`id_Banker`);

--
-- 資料表索引 `Banker2`
--
ALTER TABLE `Banker2`
  ADD PRIMARY KEY (`id_Banker`);

--
-- 資料表索引 `BetGodnine`
--
ALTER TABLE `BetGodnine`
  ADD PRIMARY KEY (`id_BetGodnine`);

--
-- 資料表索引 `Bingo`
--
ALTER TABLE `Bingo`
  ADD PRIMARY KEY (`id_Bingo`);

--
-- 資料表索引 `Bulletin`
--
ALTER TABLE `Bulletin`
  ADD PRIMARY KEY (`id_Bulletin`);

--
-- 資料表索引 `LogAdmin`
--
ALTER TABLE `LogAdmin`
  ADD PRIMARY KEY (`id_LogAdmin`);

--
-- 資料表索引 `LogInfo`
--
ALTER TABLE `LogInfo`
  ADD PRIMARY KEY (`id_LogInfo`);

--
-- 資料表索引 `LoginInfo`
--
ALTER TABLE `LoginInfo`
  ADD PRIMARY KEY (`id_LoginInfo`);

--
-- 資料表索引 `Member`
--
ALTER TABLE `Member`
  ADD PRIMARY KEY (`id_Member`),
  ADD KEY `Again_BetGodnine_Period` (`Again_BetGodnine_Period`),
  ADD KEY `Start_Count_Period` (`Start_Count_Period`);

--
-- 資料表索引 `ModelSet`
--
ALTER TABLE `ModelSet`
  ADD PRIMARY KEY (`id_ModelSet`);

--
-- 資料表索引 `MoneyLog`
--
ALTER TABLE `MoneyLog`
  ADD PRIMARY KEY (`id_MoneyLog`);

--
-- 資料表索引 `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`id_News`);

--
-- 資料表索引 `Odds`
--
ALTER TABLE `Odds`
  ADD PRIMARY KEY (`id_Odds`);

--
-- 資料表索引 `OnLine`
--
ALTER TABLE `OnLine`
  ADD PRIMARY KEY (`id_OnLine`);

--
-- 資料表索引 `SystemSet`
--
ALTER TABLE `SystemSet`
  ADD PRIMARY KEY (`id_SystemSet`);

--
-- 資料表索引 `SystemUser`
--
ALTER TABLE `SystemUser`
  ADD PRIMARY KEY (`id_SystemUser`);

--
-- 資料表索引 `Test_Bingo`
--
ALTER TABLE `Test_Bingo`
  ADD PRIMARY KEY (`id_Bingo`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `Agent`
--
ALTER TABLE `Agent`
  MODIFY `id_Agent` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `ApplyBanker`
--
ALTER TABLE `ApplyBanker`
  MODIFY `id_ApplyBanker` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `BackWater`
--
ALTER TABLE `BackWater`
  MODIFY `id_BackWater` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `Banker`
--
ALTER TABLE `Banker`
  MODIFY `id_Banker` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `Banker2`
--
ALTER TABLE `Banker2`
  MODIFY `id_Banker` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `BetGodnine`
--
ALTER TABLE `BetGodnine`
  MODIFY `id_BetGodnine` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `Bingo`
--
ALTER TABLE `Bingo`
  MODIFY `id_Bingo` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `Bulletin`
--
ALTER TABLE `Bulletin`
  MODIFY `id_Bulletin` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `LogAdmin`
--
ALTER TABLE `LogAdmin`
  MODIFY `id_LogAdmin` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `LogInfo`
--
ALTER TABLE `LogInfo`
  MODIFY `id_LogInfo` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `LoginInfo`
--
ALTER TABLE `LoginInfo`
  MODIFY `id_LoginInfo` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `Member`
--
ALTER TABLE `Member`
  MODIFY `id_Member` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `ModelSet`
--
ALTER TABLE `ModelSet`
  MODIFY `id_ModelSet` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `MoneyLog`
--
ALTER TABLE `MoneyLog`
  MODIFY `id_MoneyLog` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `News`
--
ALTER TABLE `News`
  MODIFY `id_News` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `Odds`
--
ALTER TABLE `Odds`
  MODIFY `id_Odds` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `OnLine`
--
ALTER TABLE `OnLine`
  MODIFY `id_OnLine` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `SystemSet`
--
ALTER TABLE `SystemSet`
  MODIFY `id_SystemSet` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `SystemUser`
--
ALTER TABLE `SystemUser`
  MODIFY `id_SystemUser` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `Test_Bingo`
--
ALTER TABLE `Test_Bingo`
  MODIFY `id_Bingo` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

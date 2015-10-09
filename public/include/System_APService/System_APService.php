<?php
	//此版本的部分提供Web Site使用
	//宣告命名空間
	namespace System_APService;
	
	//先載入各物件
	$systemApPath = glob( __DIR__ ."\\*\\*\\*.php");
	
	if(!empty($systemApPath)){
		foreach($systemApPath as $systemApContent){
			include_once($systemApContent);
			//print_r($systemApContent);
		}
    }else{
        //先載入各物件
        $systemApPath = glob( __DIR__ ."/*/*/*.php");
        if(!empty($systemApPath)){
            foreach($systemApPath as $systemApContent){
                include_once($systemApContent);
                //print_r($systemApContent);
            }
        }
    }
    
    
	//載入結束
	//引用物件命名空間
	use SystemToolsService\clsTools;
	//引用完畢
	
	class clsSystem{
		//相關工具
		public $SystemToolsService;
		
		//供呼叫程式初始化設定
		public function initialization(){
			@session_start();
			
			//相關工具設定
			//基礎的資安防護
			$VTs = new clsTools;
			if(!empty($_POST)){
				$_POST = $VTs->replacePackage($_POST);
			}
			
			if(!empty($_GET)){
				$_GET = $VTs->replacePackage($_GET);
			}
			//結束基礎的資安防護
	
			//存到變數，以重複利用
			$this->SystemToolsService = $VTs;
			//釋放
			$VTs = null;
			//相關工具設定結束			
		}
				
	#這裡是	SystemToolsService
	#modIO
		//讀取頁面Html檔案
		public function GetHtmlContent($fPath){
			return $this->SystemToolsService->GetHtmlContent($fPath);
		}
		//寫LOG檔 ThreadLog(clsName, funName, sDescribe = "", sEventDescribe = "", iErr = 0) ??放哪???
		public function ThreadLog($clsName, $funName, $sDescribe = "", $sEventDescribe = "", $iErr = 0){
			$this->SystemToolsService->ThreadLog($clsName, $funName, $sDescribe, $sEventDescribe, $iErr);
		}
	#modIO結束
		
	#modDataFormate
		//日期轉換
		public function DateTime($changeType,$Date=null){
			$dateStr = $this->SystemToolsService->DateTime($changeType,$Date);
			if(!$dateStr){
				print_r("Error Date Type: ".$changeType."; or Date: ".$Date);
				return false;
			}
			return $dateStr;
		}
		
		//資料轉換成json(encode)
		public function Data2Json($Data){
			return $this->SystemToolsService->Data2Json($Data);
		}
		
		//json轉換成資料轉(decode)
		public function Json2Data($JsonData){
			return $this->SystemToolsService->Json2Data($JsonData);
		}
	#modDataFormate結束
		
	#DataInformationSecurity
		//資訊全重複檢查是否有遺漏的，並取代為HTML CODE
		public function replacePackage($arr){
			$tmpArr = $this->SystemToolsService->replacePackage($arr);
			return $tmpArr;
		}
	#DataInformationSecurity結束
		
	#modArrayDebug
		public function debug($DataArray){
			$this->SystemToolsService->debug($DataArray);
		}
	#modArrayDebug結束
	
	#modCurl相關
		//POST
		public function UrlDataPost($url, $SendArray) {
			//回傳結果是對象URL執行結果
			return $this->SystemToolsService->UrlDataPost($url, $SendArray);
		}
		//GET
		public function UrlDataGet($url) {
			//回傳結果是對象URL執行結果
			return $this->SystemToolsService->UrlDataGet($url);
		}
	#modCurl結束
	#這裡是	SystemToolsService 結束
	
	}
	
	
?>
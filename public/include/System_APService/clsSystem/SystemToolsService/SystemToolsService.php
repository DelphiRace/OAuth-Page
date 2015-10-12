<?php		
	namespace SystemToolsService;
	
	
	class clsTools {
	#modIO
		//讀取頁面Html檔案
		public function GetHtmlContent($fPath){
			$fContent = '';
			if(file_exists($fPath)){
				$fContent = file_get_contents($fPath);
			}else{
				$fPath = str_replace("\\","/",$fPath);
				if(file_exists($fPath)){
					$fContent = file_get_contents($fPath);
				}
			}
			return $fContent;
			
		}
		
		//寫LOG檔 ThreadLog(clsName, funName, sDescribe = "", sEventDescribe = "", iErr = 0) ??放哪???
		public function ThreadLog($clsName, $funName, $sDescribe = "", $sEventDescribe = "", $iErr = 0){
			
		}
	#modIO結束
		
	#modDataFormate
		//日期轉換
		public function DateTime($changeType,$Date=null){
			$dateStr = "";
			$dateStyle = "";
			if($Date != null or $Date != ''){
				//先檢查日期是用哪種分割的
				if(strpos($Date,"/") !== false){
					$dateArr = explode("/",$Date);
					$dateStyle = "/";
				}else if(strpos($Date,"-") !== false){
					$dateArr = explode("-",$Date);
					$dateStyle = "-";
				}else{//不符合現在有的格式
					return false;
				}
				switch($changeType){
					//西元轉民國(年月日)
					case "ADyyyyMMdd_RCyyyMMdd":
						$dateStr = ($dateArr[0]-1911).$dateStyle.($dateArr[1]).$dateStyle.($dateArr[2]);
					break;
					//西元轉民國(年月)
					case "ADyyyyMM_RCyyyMM":
						$dateStr = ($dateArr[0]-1911).$dateStyle.($dateArr[1]);
					break;
					//民國轉西元(年月日)
					case "RCyyyMMdd_ADyyyyMMdd":
						$dateStr = ($dateArr[0]+1911).$dateStyle.($dateArr[1]).$dateStyle.($dateArr[2]);
					break;
					//日期轉時間秒數?
					case "CTime":
						$dateStr = strtotime($Date);
					break;
					//取得現在時間秒數?
					case "CTime_Now":
						$dateStr = time();
					break;
				}
				return $dateStr;
			}
		}
				
		//資料轉換成json(encode)
		public function Data2Json($Data){
			return json_encode($Data);
		}
		
		//json轉換成資料轉(decode)
		public function Json2Data($JsonData){
			return json_decode($JsonData);
		}
	#modDataFormate結束
		
	#DataInformationSecurity
		//資訊全重複檢查是否有遺漏的，並取代為HTML CODE
		public function replacePackage($arr){
			$tmpArr = array();
			if(!empty($arr)){
				foreach($arr as $i => $content){
					//若是多維陣列，再次處理
					if(is_array($content)){
						$arr[$i] = $this->replacePackage($content);
					}else{
						$arr[$i] = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
					}
				}
			}
			$tmpArr = $arr;
			return $tmpArr;
		}
	#DataInformationSecurity結束
		
	#modArrayDebug
		public function debug($DataArray){
			echo "<pre>";
			print_r($DataArray);
			echo "</pre>";
		}
	#modArrayDebug結束
	#modCurl取得網址相關內容
		public function UrlDataPost($url, $SendArray) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//quick fix for SSL
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $SendArray);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  //skip ssl verify
            
			$response = curl_exec($ch);
			curl_close ($ch);
            
            return $response;
		}
		
		public function UrlDataGet($url) {

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_URL, $url );
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  //skip ssl verify
															
			$result = curl_exec($ch);
			curl_close ($ch);

			return $result;
		}
	#modCurl結束
	}
?>
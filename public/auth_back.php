<?php
	session_start();
	//取得OAUTH回來的CODE，準備進行驗證
	$code = $_GET["requestTokenCode"];
	//echo $code;
	
	$url="http://127.0.0.1:99/decode.php";
	
	$postArr = array("requestTokenCode"=>$code);
	//取得Access Token
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $postArr ));
	$response = curl_exec($ch); 
	curl_close($ch);
	$tokenArr = json_decode($response);
	$access_token = $tokenArr->access_token;
	//echo $access_token;
	//print_r($tokenArr);
	
	//使用Access Token取資料
	$postArr = array("access_token"=>$access_token);
	$url="http://127.0.0.1:99/token.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $postArr ));
	$response = curl_exec($ch); 
	curl_close($ch);
	
	$userInfo = json_decode($response);
	$_SESSION["uid"] = $userInfo->uid;
	$_SESSION["userName"] = $userInfo->userName;
	$_SESSION["userMail"] = $userInfo->userMail;
	
	//導回首頁
	header("location: ./");
	//print_r($_SESSION);
?>

<?php

function getHostCookie(){
	
    $cokie_host = '';
    $host_str = trim($_SERVER['HTTP_HOST']);
		$host_arr = explode('.',$host_str);
		if(count($host_arr) >= 2){
			$cokie_host = strtoupper($host_arr[0]) . '_PWTREEUSER_COOKIE_ID';
		}
		
		return empty($cokie_host) ? 'WWW_PWTREEUSER_COOKIE_ID' : $cokie_host;

}

function getdomain(){
    $domain = strtolower(trim($_SERVER['SERVER_NAME']));	
		return preg_match('/(pwtree)\..*/', $domain, $m) ? $m[0] : $domain;
}
    
function getRandStr($len=6){
	
	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
	
	$string="";
	
   while(strlen($string)<$len) {
        $string.=substr($chars,(mt_rand()%strlen($chars)),1);
    }
    return $string;
    
}


function getIp() { 
     if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
         $ip = getenv("HTTP_CLIENT_IP"); 
     else 
         if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
             $ip = getenv("HTTP_X_FORWARDED_FOR"); 
         else 
             if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
                 $ip = getenv("REMOTE_ADDR"); 
             else 
                 if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
                     $ip = $_SERVER['REMOTE_ADDR']; 
                 else 
                     $ip = "unknown"; 
     return ($ip); 
 }


function getHttpResponsePOST($url,$para, $input_charset = '') {


	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, 0 ); // ����HTTPͷ
	curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// ��ʾ������
	curl_setopt($curl,CURLOPT_POST,true); // post��������
	curl_setopt($curl,CURLOPT_POSTFIELDS,$para);// post��������
	$responseText = curl_exec($curl);
	//var_dump( curl_error($curl) );//���ִ��curl�����г����쳣���ɴ򿪴˿��أ��Ա�鿴�쳣����
	curl_close($curl);
	 
	return $responseText;
}
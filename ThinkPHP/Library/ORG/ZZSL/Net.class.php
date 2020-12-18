<?php
namespace ORG\ZZSL;

class Net{    
    public static function get($url, $timeout=5){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }
    
    public static function post($url, $postData='', $timeout=5){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        if(!empty($postData)){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }
    
    
    public static function postFile($host, $url, $port, $postData, $fileData){
        //设置边界
        srand((double)microtime()*1000000);
        $boundary = "---------------------------".substr(md5(rand(0,32000)),0,10);
        
        //构造POST数据
        $data = "--{$boundary}";
        foreach($postData as $key => $val){
            $data .= "\r\nContent-Disposition: form-data; name=\"{$key}\"\r\n\r\n";
            $data .= "{$val}\r\n";
            $data .= "--{$boundary}";
        }
        
        //构造文件数据
        foreach($fileData as $key => $val){
            $data .= "\r\nContent-Disposition: form-data; name=\"{$key}\"; filename=\"{$val}\"\r\n";
            $data .= "Content-Type: application/octet-stream\r\n\r\n";
            $data .= join("", file($val)) . "\r\n";
            $data .= "--{$boundary}";
        }
        $data.="--\r\n\r\n";

        //构造数据头
        $out = "POST ${url} HTTP/1.1\r\n";  
    	$out .= "Host: ${host}\r\n";  
    	$out .= "Content-type: multipart/form-data; boundary={$boundary}\r\n";
    	$out .= "Content-length:".strlen($data)."\r\n";
    	$out .= "Connection:close\r\n\r\n";
    	
    	try{
    	   $fp = fsockopen($host, $port);
    	   if(!$fp){
    	       throw new \Exception("无法连接{$host}{$url}", -1);
    	   }
    	   fputs($fp, $out . $data);
    	   
    	   $response = '';
    	   while($row = fread($fp, 4096)){
    	       $response .= $row;
    	   }
    	   fclose($fp); 
    	   $pos = strpos($response, "\r\n\r\n");
    	   $response = substr($response, $pos+4);
    	   
    	   return $response;
    	}catch(\Exception $e){
    	    throw $e;
    	}
    }
}

<?php

//终端执行，没有使用thinkphp的方法
//域名，换到服务器里的话要修改该域名
define("DOMAIN","https://ipfs.weiyinstudio.com");

function geturl($url){
    $headerArray =array("Content-type:application/json;","Accept:application/json");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($url,CURLOPT_HTTPHEADER,$headerArray);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output,true);
    return $output;
}
function post( $url, $param )
{
    $oCurl = curl_init ();
    curl_setopt ( $oCurl, CURLOPT_SAFE_UPLOAD, false);
    if (stripos ( $url, "https://" ) !== FALSE) {
        curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYHOST, false );
    }

    curl_setopt ( $oCurl, CURLOPT_URL, $url );
    curl_setopt ( $oCurl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $oCurl, CURLOPT_POST, true );
    curl_setopt ( $oCurl, CURLOPT_POSTFIELDS, $param );
    $sContent = curl_exec ( $oCurl );
    $aStatus = curl_getinfo ( $oCurl );
    curl_close ( $oCurl );
    if (intval ( $aStatus ["http_code"] ) == 200) {
        return $sContent;
    } else {
        return false;
    }
}

//执行定时任务
$C = include("APP/Conf/system.php");

// 测试访问链接（域名）
// $url = DOMAIN."/index.php/auto/auto/openjy";
// geturl($url);
// exit;

//$url = DOMAIN."/index.php/auto/auto/accelerate";
//echo $url;
//post($url,array());
////exit;
    
    
$now_time = time();
date_default_timezone_set('PRC');
// if ($now_time > strtotime(date('Y-m-d '.$starttime)) + 60 && $now_time < (strtotime(date('Y-m-d '.$starttime)) + 360)) {
//     $url = DOMAIN."/index.php/auto/auto/openjy";
//     post($url,array());
// }

// if ($now_time < strtotime(date('Y-m-d '.$endtime)) - 60 && $now_time > (strtotime(date('Y-m-d '.$endtime)) - 360)) {
//     $url = DOMAIN."/index.php/auto/auto/closejy";
//     post($url,array());
// }

// if ($now_time >= strtotime(date('Y-m-d '.'23:30:00')) && $now_time < strtotime(date('Y-m-d '.'23:59:59'))) {
//     $url = DOMAIN."/index.php/auto/auto/accelerate";
//     post($url,array());
// }

//凌晨0点0分到0点10分检查积分卡是否过期
if ($now_time >= strtotime(date('Y-m-d')) && $now_time < strtotime(date('Y-m-d '.'00:10:00'))) {
    $url = DOMAIN."/index.php/auto/auto/autoExpire";
    post($url,array());
}
	




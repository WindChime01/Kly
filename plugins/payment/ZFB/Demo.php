<?php

require_once 'alipay-sdk-php-all-master/aop/AopClient.php';
require_once 'alipay-sdk-php-all-master/aop/AopCertClient.php';
require_once 'alipay-sdk-php-all-master/aop/AopCertification.php';
require_once 'alipay-sdk-php-all-master/aop/AlipayConfig.php';
require_once 'alipay-sdk-php-all-master/aop/request/AlipayTradePagePayRequest.php';
require_once 'alipay-sdk-php-all-master/aop/request/AlipayTradeAppPayRequest.php';
require_once 'alipay-sdk-php-all-master/aop/request/AlipayTradePayRequest.php';
require_once 'alipay-sdk-php-all-master/aop/request/AlipayOpenAppQrcodeCreateRequest.php';
require_once 'alipay-sdk-php-all-master/aop/request/AlipayTradeQueryRequest.php';
require_once 'alipay-sdk-php-all-master/aop/request/AlipayTradeFastpayRefundQueryRequest.php';

require_once("common/config.php");
class Demo{
    // 查询app退单
    public function AlipayTradeFastpayRefundQueryRequest($data){
        $alipayConfig = new AlipayConfig();
        $alipayConfig->setServerUrl(ZfbConfig::ServerUrl);
        $alipayConfig->setAppId(ZfbConfig::AppId);
        $alipayConfig->setPrivateKey(ZfbConfig::PrivateKey);
        $alipayConfig->setFormat(ZfbConfig::Format);
        $alipayConfig->setAlipayPublicKey(ZfbConfig::AlipayPublicKey);
        $alipayConfig->setCharset(ZfbConfig::Charset);
        $alipayConfig->setSignType(ZfbConfig::SignType);
        $alipayClient = new AopClient($alipayConfig);
        $request = new AlipayTradeFastpayRefundQueryRequest();
        $request->setBizContent("{".
            "\"trade_no\":\"2014112611001004680073956707\",".
            "\"out_request_no\":\"HZ01RF001\"".
        "}");
        $responseResult = $alipayClient->execute($request);         //公共回调
        $responseApiName = str_replace(".","_",$request->getApiMethodName())."_response";
        $response = $responseResult->$responseApiName;      //哪个接口的回调
        if(!empty($response->code)&&$response->code==10000){
            Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
        }
        else{
            Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
            }
        }

    //查询app交易
    public function appqurey($data){

        $alipayConfig = new AlipayConfig();
        $alipayConfig->setServerUrl(ZfbConfig::ServerUrl);
        $alipayConfig->setAppId(ZfbConfig::AppId);
        $alipayConfig->setPrivateKey(ZfbConfig::PrivateKey);
        $alipayConfig->setFormat(ZfbConfig::Format);
        $alipayConfig->setAlipayPublicKey(ZfbConfig::AlipayPublicKey);
        $alipayConfig->setCharset(ZfbConfig::Charset);
        $alipayConfig->setSignType(ZfbConfig::SignType);
        $alipayClient = new AopClient($alipayConfig);
        $request = new AlipayTradeQueryRequest();
        $request->setBizContent("{".
            "\"out_trade_no\":\"70501111111S001111119\"".
        "}");
        $responseResult = $alipayClient->execute($request);
        $responseApiName = str_replace(".","_",$request->getApiMethodName())."_response";
        $response = $responseResult->$responseApiName;
        if(!empty($response->code)&&$response->code==10000){
            Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
        }
        else{
            Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
            }
        }
    //APP端支付     (有问题)
    public function app($data){
    $alipayConfig = new AlipayConfig();
    $alipayConfig->setServerUrl(ZfbConfig::ServerUrl);
    $alipayConfig->setAppId(ZfbConfig::AppId);
    $alipayConfig->setPrivateKey(ZfbConfig::PrivateKey);
    $alipayConfig->setFormat(ZfbConfig::Format);
    $alipayConfig->setAlipayPublicKey(ZfbConfig::AlipayPublicKey);
    $alipayConfig->setCharset(ZfbConfig::Charset);
    $alipayConfig->setSignType(ZfbConfig::SignType);
    $alipayClient = new AopClient($alipayConfig);
    $request = new AlipayTradeAppPayRequest();
    $request->setBizContent("{".
        "\"out_trade_no\":\"70501111111S001111119\",".
        "\"total_amount\":\"9.00\",".
        "\"subject\":\"大乐透\"".
    "}");
    $responseResult = $alipayClient->sdkExecute($request);
    $responseApiName = str_replace(".","_",$request->getApiMethodName())."_response";
    $response = $responseResult->$responseApiName;
    // dump($responseResult);die;
    if(!empty($response->code)&&$response->code==10000){
        Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
    }
    else{
        Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
        }
    }
    //PC端支付
public function pc($data){
    $alipayConfig = new AlipayConfig();
    $alipayConfig->setServerUrl(ZfbConfig::ServerUrl);
    $alipayConfig->setAppId(ZfbConfig::AppId);
    $alipayConfig->setPrivateKey(ZfbConfig::PrivateKey);
    $alipayConfig->setFormat(ZfbConfig::Format);
    $alipayConfig->setAlipayPublicKey(ZfbConfig::AlipayPublicKey);
    $alipayConfig->setCharset(ZfbConfig::Charset);
    $alipayConfig->setSignType(ZfbConfig::SignType);
    $alipayClient = new AopClient($alipayConfig);
    $request = new AlipayTradePayRequest();
    $request->setBizContent("{".
        "\"out_trade_no\":\"20150320010101001\",".
        "\"total_amount\":\"88.88\",".
        "\"subject\":\"Iphone6 16G\",".
        "\"auth_code\":\"28763443825664394\",".
        "\"scene\":\"bar_code\",".
        "\"buyer_logon_id\":\"2088722001821618\"".
    "}");
    // var_dump($alipayClient);die;
    $responseResult = $alipayClient->execute($request);
    $responseApiName = str_replace(".","_",$request->getApiMethodName())."_response";
    $response = $responseResult->$responseApiName;
    if(!empty($response->code)&&$response->code==10000){
        Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
    }
    else{
        Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
        }
    }
    //生成二维码
public function qrcode($data){
    $alipayConfig = new AlipayConfig();
    $alipayConfig->setServerUrl(ZfbConfig::ServerUrl);
    $alipayConfig->setAppId(ZfbConfig::AppId);
    $alipayConfig->setPrivateKey(ZfbConfig::PrivateKey);
    $alipayConfig->setFormat(ZfbConfig::Format);
    $alipayConfig->setAlipayPublicKey(ZfbConfig::AlipayPublicKey);
    $alipayConfig->setCharset(ZfbConfig::Charset);
    $alipayConfig->setSignType(ZfbConfig::SignType);
    $alipayClient = new AopClient($alipayConfig);
    $request = new AlipayOpenAppQrcodeCreateRequest();
    $request->setBizContent("{".
        "\"url_param\":\"page/component/component-pages/view/view\",".
        "\"query_param\":\"x=1\",".
        "\"describe\":\"二维码描述\"".
    "}");
    $responseResult = $alipayClient->execute($request);
    $responseApiName = str_replace(".","_",$request->getApiMethodName())."_response";
    $response = $responseResult->$responseApiName;
    if(!empty($response->code)&&$response->code==10000){
            Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
        }
        else{
            Return(array("msg"=>$response->sub_msg,"code"=>$response->code));
            }
    }
}
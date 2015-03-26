<?php
/* 
 * 微信服务号静默获取openid示例
 * sunboyu   微信公众号 imsunboyu
 * 2015/3/25
 * */
session_start();
$openid = empty($_SESSION['openid']) ? false : trim($_SESSION['openid']);
if(empty($openid)){
    header("Location:login.php?action=".$action);
    exit;
}
//获得openid 进入自己的业务逻辑



//生成js-sdk认证信息
$jssdk['timestamp'] = time();
$jssdk['noncestr'] = rand(0,99999999999999);
$jssdk['jsapi_ticket'] = _get_jssdk_token();
$jssdk['url'] = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
ksort($jssign);
foreach( $jssdk as $k => $v ){
    $_jssdkarray[] = $k."=".$v;
}
$_jssignstr = join( "&" , $_jssdkarray );
$str = $_jssignstr;
$jssdk['sign'] = sha1( $str );

include("index.tpl");
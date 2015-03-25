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
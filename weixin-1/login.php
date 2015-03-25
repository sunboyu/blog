<?php
require_once("./Init.php");
$code = $_GET['code'];
$action = empty($_GET['action']) ? "index" : $_GET['action'];

if(empty($code)){
    header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".appid."&redirect_uri=".urlencode(authurl)."&response_ptype=code&scope=snsapi_base&state={$action}#wechat_redirect");
}else{
    $action = empty($_GET['state']) ? "index" : $_GET['state'];
    $codetoopenidapi = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".appid."&secret=".secret."&code={$code}&grant_type=authorization_code";
    $openinfo = json_decode(file_get_contents($codetoopenidapi), true);
    $openid = $openinfo['openid'];
    $_SESSION['openid'] = $openid;
    header("Location:index.php?action=".$action);
}

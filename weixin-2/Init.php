<?php
date_default_timezone_set( 'Asia/Chongqing' );
session_start();
define("appid","app id");    #微信公众号的app id
define("secret","secret id");    #微信公众号的 secretid
define("authurl","http://www.sunboyu.com/login.php");   #接口回调地址
define("MYSQL_HOST","localhost");    #数据库登录信息
define("MYSQL_USER","root");
define("MYSQL_PASS","pass");
define("MYSQL_DATA","wx_db");
$db = mysql_connect( MYSQL_HOST , MYSQL_USER , MYSQL_PASS ) or die( mysql_error() );
mysql_select_db( MYSQL_DATA ) or die( mysql_error() );
mysql_query( "SET NAMES utf8" );



/*   建表语句 
--
-- 表的结构 `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `key` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `val` varchar(500) COLLATE utf8_estonian_ci NOT NULL,
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`key`, `val`) VALUES
('token', 'je6ll8E_fXpSaPGlGqG4HahwVnTkNXJD82P6Ol0vclzTzhK0izAP0Hbjlx2EqvsUbXX09t2SoLZm4zMU34CdGYAL63eVCZwBTtIuyQ7VWws');

*/


function _init_token(){
    global $db;
    $getAccServer = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".appid."&secret=".secret;
    $access = json_decode(file_get_contents($getAccServer), true);
    $access_token = $access['access_token'];
    $access_token = mysql_escape_string( $access_token );
    mysql_query("REPLACE INTO config ( `key` , `val` ) VALUES ( 'token' , '$access_token' )") or die( mysql_error() );
}

function _get_token(){
    global $db;
    $sql = "SELECT * FROM config WHERE `key` = 'token'";
    $query = mysql_query( $sql ) or die( mysql_error() );
    $row = mysql_fetch_assoc( $query );
    return $row['val'];
}

function _init_jssdk_token(){
    global $_db;
    _db();
    $token = _get_token();
    $sdkServer = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$token}&type=jsapi";
    $access = json_decode(file_get_contents($sdkServer), true);
    $access_token = $access['ticket'];
    if($access['errcode']==0){
        $access_token = mysql_escape_string( $access_token );
        mysql_query("REPLACE INTO config ( `key` , `val` ) VALUES ( 'ticket' , '$access_token' )") or die( mysql_error() );
    }   
}

function _get_jssdk_token(){
    global $_db;
    _db();
    $sql = "SELECT * FROM config WHERE `key` = 'ticket'";
    $query = mysql_query( $sql ) or die( mysql_error() );
    $row = mysql_fetch_assoc( $query );
    return $row['val'];
}
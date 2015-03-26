<!doctype html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="keywords" content="">
    </head>
    <body>

    </body>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        wx.config({
            debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '<?php echo appid; ?>', // 必填，公众号的唯一标识
            timestamp: <?php echo $jssdk['timestamp']; ?>, // 必填，生成签名的时间戳
            nonceStr: '<?php echo $jssdk['noncestr']; ?>', // 必填，生成签名的随机串
            signature:'<?php echo $jssdk['sign']; ?>' ,// 必填，签名，见附录1
            jsApiList: ['openLocation','getLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function(){
            wx.getLocation({
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    var speed = res.speed; // 速度，以米/每秒计
                    var accuracy = res.accuracy; // 位置精度
                }
            });
            wx.openLocation({
                latitude: 0, // 纬度，浮点数，范围为90 ~ -90
                longitude: 0, // 经度，浮点数，范围为180 ~ -180。
                name: '', // 位置名
                address: '', // 地址详情说明
                scale: 1, // 地图缩放级别,整形值,范围从1~28。默认为最大
                infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
            });
        });
        wx.error(function(res){
            alert(res);
        });
        wx.checkJsApi({
            jsApiList: ['openLocation','getLocation'],
            success: function(res) {
                alert(res.checkResult.getLocation);
            }
        });
    </script>
</html>

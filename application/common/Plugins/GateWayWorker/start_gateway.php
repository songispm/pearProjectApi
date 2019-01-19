<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Workerman\Worker;
use Workerman\WebServer;
use GatewayWorker\Gateway;
use GatewayWorker\BusinessWorker;
use Workerman\Autoloader;
require_once __DIR__ . '/vendor/autoload.php';

$ssl = true;
$context = array();
if ($ssl) {
    // 证书最好是申请的证书
    $context = array(
        // 更多ssl选项请参考手册 http://php.net/manual/zh/context.ssl.php
        'ssl' => array(
            // 请使用绝对路径
            'local_cert' => '/home/handong/Nginx/1_api.thispm.com_bundle.crt', // 也可以是crt文件
            'local_pk' =>  '/home/handong/Nginx/2_api.thispm.com.key',
            'verify_peer' => false,
            'allow_self_signed' => true, //如果是自签名证书需要开启此选项
        )
    );
}

// gateway 进程，这里使用Text协议，可以用telnet测试
$gateway = new Gateway("websocket://10.30.150.39:2345", $context);

if ($ssl) {
    // 开启SSL，websocket+SSL 即wss
    $gateway->transport = 'ssl';
}

// gateway名称，status方便查看
$gateway->name = 'YourAppGateway';
// gateway进程数
$gateway->count = 4;
// 本机ip，分布式部署时使用内网ip
$gateway->lanIp = '127.0.0.1';
// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
$gateway->startPort = 2900;
// 服务注册地址
$gateway->registerAddress = '10.30.150.39:2346';

// 心跳间隔
//$gateway->pingInterval = 10;
// 心跳数据
//$gateway->pingData = '{"type":"ping"}';

/*
// 当客户端连接上来时，设置连接的onWebSocketConnect，即在websocket握手时的回调
$gateway->onConnect = function($connection)
{
    $connection->onWebSocketConnect = function($connection , $http_header)
    {
        // 可以在这里判断连接来源是否合法，不合法就关掉连接
        // $_SERVER['HTTP_ORIGIN']标识来自哪个站点的页面发起的websocket链接
        if($_SERVER['HTTP_ORIGIN'] != 'http://kedou.workerman.net')
        {
            $connection->close();
        }
        // onWebSocketConnect 里面$_GET $_SERVER是可用的
        // var_dump($_GET, $_SERVER);
    };
};
*/

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}


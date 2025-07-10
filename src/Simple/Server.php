<?php
namespace BlackHammer\MtprotoTl\Simple;
require_once "../Base/Init.php";

use Swoole\Server;

$server = new Server(HOST, PORT);

$server->on("start", function ($server) {
    echo serverStartMessageText("tcp");
});

$server->on("connect", function ($serv, $fd) {
    echo "Client {$fd} connected.\n";
});

$server->on("receive", function ($serv, $fd, $reactor_id, $data) {
    $msg = Encoder::decode_my_request($data);
    echo "Received from client {$fd}:\n";
    print_r($msg);

    $serv->send($fd, "Message received\n");
});

$server->on("close", function ($serv, $fd) {
    echo "Client {$fd} closed.\n";
});

$server->start();
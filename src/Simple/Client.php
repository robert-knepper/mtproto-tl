<?php
namespace BlackHammer\MtprotoTl\Simple;
require_once "../Base/Init.php";

use Swoole\Client;

$client = new Client(SWOOLE_SOCK_TCP);

if (!$client->connect(HOST, PORT, 0.5)) {
    exit("connect failed. Error: {$client->errCode}\n");
}

$data = Encoder::encode_my_request("hello world", 42);

$client->send($data);

echo "Sent data.\n";

$response = $client->recv();
echo "Received from server: {$response}\n";

$client->close();
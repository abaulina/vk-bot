<?php

use App\bot\ServerHandler;

require __DIR__ . '/../vendor/autoload.php';

$handler = new ServerHandler();
$data = json_decode(file_get_contents("php://input"));
$handler->parse($data);
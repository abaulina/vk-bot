<?php

namespace App\bot;

use Exception;
use VK\CallbackApi\Server\VKCallbackApiServerHandler;
use VK\Client\VKApiClient;

class ServerHandler extends VKCallbackApiServerHandler
{
    const SECRET = 'mySuperUniqueSecret';
    const GROUP_ID = 217511379;
    const CONFIRMATION_TOKEN = 'bd98980e';
    const BOT_ACCESS_TOKEN = 'vk1.a.-XTtwA7rSDmN_i4m3vVEbcLOWPqWeyldsdgF2DOdZr0n58MIv870zZkyTfb4h3Rc5QFWEAI-TBEUveWqWgiE4d4y9MGtOksIBo2YOdiuMbyTFg4mjpABP6qFcUjqSWtKUFNbsfVQhEs-SpjCEYucZolD8vA2JK2XOBzvAlKhUpxZAir5KbsAoA_3NNJcUlgUBJm7zdSrxvQh89Jlvb4A9Q';
    private VKApiClient $vkApi;
    private Service $service;

    public function __construct()
    {
        $this->vkApi = new VKApiClient('5.82');
        $this->service = new Service();
    }

    function confirmation(int $group_id, ?string $secret)
    {
        if ($secret === self::SECRET && $group_id === self::GROUP_ID) {
            echo self::CONFIRMATION_TOKEN;
        }
    }

    public function messageNew(int $group_id, ?string $secret, array $object)
    {
        if ($secret != self::SECRET) {
            echo "nok";
            return;
        }

        $text = $object["text"];
        $userId = $object["from_id"];
        $payload = $object["payload"];
        $command = $this->getCommand($payload);

        try{
            $result = $this->service->process($command, $text, $userId);
            $this->vkApi->messages()->send(self::BOT_ACCESS_TOKEN, [
                "user_id" => $userId,
                "message" => $result["msg"],
                "keyboard" => json_encode($result["keyboard"], JSON_UNESCAPED_UNICODE),
                "random_id" => random_int(0, 1000000)
            ]);
        }
        catch (Exception) {
            $result = $this->service->getHelpMessage();
            $this->vkApi->messages()->send(self::BOT_ACCESS_TOKEN, [
                "user_id" => $userId,
                "message" => $result["msg"],
                "keyboard" => json_encode($result["keyboard"], JSON_UNESCAPED_UNICODE),
                "random_id" => random_int(0, 1000000)
            ]);
        }

        echo "ok";
    }

    private function getCommand($payload)
    {
        $obj = json_decode($payload);
        return $obj->{'command'};
    }
}
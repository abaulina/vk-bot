<?php

namespace App\bot;

use Exception;
use VK\CallbackApi\Server\VKCallbackApiServerHandler;
use VK\Client\VKApiClient;

class ServerHandler extends VKCallbackApiServerHandler
{
    private VKApiClient $vkApi;
    private Service $service;

    public function __construct()
    {
        $this->vkApi = new VKApiClient('5.82');
        $this->service = new Service();
    }

    function confirmation(int $group_id, ?string $secret)
    {
        if ($secret === SECRET && $group_id === GROUP_ID) {
            echo CONFIRMATION_TOKEN;
        }
    }

    public function messageNew(int $group_id, ?string $secret, array $object)
    {
        if ($secret != SECRET) {
            echo "nok";
            return;
        }

        $text = $object["text"];
        $userId = $object["from_id"];
        $payload = $object["payload"];
        $command = $this->getCommand($payload);

        try{
            $result = $this->service->process($command, $text, $userId);
            $this->vkApi->messages()->send(BOT_ACCESS_TOKEN, [
                "user_id" => $userId,
                "message" => $result["msg"],
                "keyboard" => json_encode($result["keyboard"], JSON_UNESCAPED_UNICODE),
                "random_id" => random_int(0, 1000000)
            ]);
        }
        catch (Exception) {
            $result = $this->service->getHelpMessage();
            $this->vkApi->messages()->send(BOT_ACCESS_TOKEN, [
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
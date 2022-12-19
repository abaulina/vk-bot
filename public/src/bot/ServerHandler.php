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
        $this->vkApi = new VKApiClient('5.80');
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

        $message = $object["message"];
        log_msg($message);

        $text = $message->text;
        $userId = $message->from_id;
        $payload = $message->payload;
        $command = $this->getCommand($payload);

        try{
            $result = $this->service->process($command, $text, $userId);
            $this->vkApi->messages()->send(BOT_ACCESS_TOKEN, [
                "peer_id" => $message->peer_id,
                "message" => $result["msg"],
                "keyboard" => json_encode($result["keyboard"], JSON_UNESCAPED_UNICODE),
                "random_id" => random_int(0, 1000000)
            ]);
        }
        catch (Exception $e) {
            log_error($e);

            $result = $this->service->getHelpMessage();
            $this->vkApi->messages()->send(BOT_ACCESS_TOKEN, [
                "peer_id" => $message->peer_id,
                "message" => $result["msg"],
                "keyboard" => $result["keyboard"],
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
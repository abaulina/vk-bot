<?php

namespace App\helpers;

class KeyboardGenerator
{
    public function getDayOrWeekKeyboard(): array
    {
        return [
            "one_time" => false,
            "buttons" => [
                [["action" => [
                    "type" => "text",
                    "payload" => '{"command": "day"}',
                    "label" => "Сегодня"],
                    "color" => "primary"]],
                [["action" => [
                    "type" => "text",
                    "payload" => '{"command": "week"}',
                    "label" => "Неделя"],
                    "color" => "default"]]
            ]];
    }

    public function getGroupKeyboard($groups): array
    {
        $keyboard = array('one_time' => false);
        $buttons = array();

        foreach ($groups as $group) {
            if(!$group["name"])
                continue;

            $buttons[] = array(
                array('action' => array('type' => 'text', 'payload' => array('command' => 'group'), 'label' => $group["name"]), 'color' => 'primary'));
        }

        $keyboard["buttons"] = $buttons;

        return $keyboard;
    }

    public function getDefaultKeyboard(): array
    {
        return [
            "one_time" => false,
            "buttons" => [
                [["action" => [
                    "type" => "text",
                    "payload" => '{"command": "choose-group"}',
                    "label" => "Выбрать группу"],
                    "color" => "primary"]],
               [["action" => [
                    "type" => "text",
                    "payload" => '{"command": "schedule"}',
                    "label" => "Расписание"],
                    "color" => "primary"]]
            ]];
    }
}
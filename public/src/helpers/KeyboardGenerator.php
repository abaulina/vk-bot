<?php

namespace App\helpers;

class KeyboardGenerator
{
    public function getDayOrWeekKeyboard(): array
    {
        return [
            "one_time" => false,
            "buttons" => [[
                ["action" => [
                    "type" => "text",
                    "payload" => '{"command": "day"}',
                    "label" => "Сегодня"],
                    "color" => "default"],
                ["action" => [
                    "type" => "text",
                    "payload" => '{"command": "week"}',
                    "label" => "Неделя"],
                    "color" => "default"],
            ]]];
    }

    public function getGroupKeyboard($groups): array
    {
        $keyboard = array('one_time' => false);
        $buttons = array();

        foreach ($groups as $group) {
            $buttons[] =
                array('action' => array('type' => 'text', 'payload' => array('command' => 'choose-group'), 'label' => $group["name"]), 'color' => 'default');
        }

        $keyboard["buttons"] = $buttons;

        return $keyboard;
    }

    public function getDefaultKeyboard(): array
    {
        return [
            "one_time" => false,
            "buttons" => [[
                ["action" => [
                    "type" => "text",
                    "payload" => '{"command": "choose-group"}',
                    "label" => "Выбрать группу"],
                    "color" => "default"],
                ["action" => [
                    "type" => "text",
                    "payload" => '{"command": "schedule"}',
                    "label" => "Расписание"],
                    "color" => "default"],
            ]]];
    }
}
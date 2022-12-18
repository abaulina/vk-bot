<?php

namespace App\helpers;

class MessageConstructor
{
    const START_MESSAGE = "Привет! Я знаю расписание для 4 курса МатФака ЯрГУ. Будем дружить?
    Выбери группу, чтобы я мог тебе помочь";
    const SCHEDULE_QUESTION_MESSAGE = "Какое расписание тебя интересует?";
    const CONFIRMATION_MESSAGE = "Приятно познакомиться! Хочешь что-нибудь узнать?";
    const GROUP_OPTIONS_MESSAGE = "Видишь подходящую?";
    const WEEK_SCHEDULE_NOT_FOUND_MESSAGE = "Кажется, такого расписания нет...";
    const DAY_SCHEDULE_NOT_FOUND_MESSAGE = "Кажется, сегодня занятий нет. Отдыхаем!";

    private function getDayByDayNumber($dayOfWeek): string
    {
        return match ($dayOfWeek) {
            '0' => "Понедельник",
            '1' => "Вторник",
            '2' => "Среда",
            '3' => "Четверг",
            '4' => "Пятница",
            '5' => "Суббота",
            '6' => "Воскресенье",
        };
    }

    public function getStartMessage(): string
    {
        return self::START_MESSAGE;
    }

    public function getScheduleNotFoundMessage(): string
    {
        return self::WEEK_SCHEDULE_NOT_FOUND_MESSAGE;
    }

    public function getNoLessonsMessage(): string
    {
        return self::DAY_SCHEDULE_NOT_FOUND_MESSAGE;
    }

    public function getConfirmationMessage(): string
    {
        return self::CONFIRMATION_MESSAGE;
    }

    public function getGroupOptionsMessage(): string
    {
        return self::GROUP_OPTIONS_MESSAGE;
    }

    public function getScheduleQuestionMessage(): string
    {
        return self::SCHEDULE_QUESTION_MESSAGE;
    }

    public function getDayScheduleMessage($schedule): string
    {
        $message = "";
        for ($i = 0; $i < count($schedule); ++$i) {
            $message .= ($i + 1) . '.' . $schedule[$i]["subject"] . PHP_EOL
                . $schedule[$i]["name"] . $schedule[$i]["classroom"] . $schedule[$i]["address"] . PHP_EOL
                . $schedule[$i]["starttime"] . '-' . $schedule[$i]["endtime"] . PHP_EOL;
        }

        return $message;
    }

    public function getWeekScheduleMessage($schedule): string
    {
        $message = "";
        $i = 0;
        $lessonNumber = 1;

        while ($i < count($schedule)) {
            $dayOfWeek = $schedule[$i]["dayofweek"];

            if ($i > 0 && $dayOfWeek == $schedule[$i - 1]["dayofweek"]) {
                $message .= $lessonNumber . '.' . $schedule[$i]["subject"] . PHP_EOL
                    . $schedule[$i]["name"] . $schedule[$i]["classroom"] . ' ' . $schedule[$i]["address"] . PHP_EOL
                    . $schedule[$i]["starttime"] . '-' . $schedule[$i]["endtime"] . PHP_EOL;
            } else {
                $lessonNumber = 1;
                $day = $this->getDayByDayNumber($dayOfWeek);
                $message .= $day . PHP_EOL
                    . $lessonNumber . '.' . $schedule[$i]["subject"] . PHP_EOL
                    . $schedule[$i]["name"] . $schedule[$i]["classroom"] . ' ' . $schedule[$i]["address"] . PHP_EOL
                    . $schedule[$i]["starttime"] . '-' . $schedule[$i]["endtime"] . PHP_EOL;
            }

            $lessonNumber += 1;
            $i += 1;
        }

        return $message;
    }
}
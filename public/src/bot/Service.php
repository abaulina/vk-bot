<?php

namespace App\bot;
use App\db\DbConnector;
use App\helpers\KeyboardGenerator;
use App\helpers\MessageConstructor;
use App\managers\GroupManager;
use App\managers\ScheduleManager;
use App\managers\StudentManager;

class Service
{
    private KeyboardGenerator $keyboardGenerator;
    private MessageConstructor $messageConstructor;
    private GroupManager $groupManager;
    private ScheduleManager $scheduleManager;
    private StudentManager $studentManager;

    public function __construct()
    {
        $db = new DbConnector();
        $this->studentManager = new StudentManager($db);
        $this->scheduleManager = new ScheduleManager($db);
        $this->groupManager = new GroupManager($db);
        $this->keyboardGenerator = new KeyboardGenerator();
        $this->messageConstructor = new MessageConstructor();
    }

    public function process($command, $text, $userId): array
    {
        return match ($command) {
            "start", "help" => $this->getMainView(),
            "schedule" => $this->getDayOrWeekView(),
            "week" => $this->getWeekSchedule($userId),
            "day" => $this->getTodaySchedule($userId),
            "choose-group" => $this->getGroupOptions(),
            "group" => $this->getConfirmationView($text, $userId),
            default => $this->getHelpMessage(),
        };
    }

    private function getMainView(): array
    {
        $message = $this->messageConstructor->getStartMessage();
        $keyboard = $this->keyboardGenerator->getDefaultKeyboard();

        return ["msg" => $message, "keyboard" => $keyboard];
    }

    private function getDayOrWeekView(): array
    {
        $message = $this->messageConstructor->getScheduleQuestionMessage();
        $keyboard = $this->keyboardGenerator->getDayOrWeekKeyboard();

        return ["msg" => $message, "keyboard" => $keyboard];
    }

    public function getHelpMessage(): array
    {
        $message = "Похоже, что-то пошло не так... Попробуем снова? Выбери группу заново.";
        $keyboard = $this->keyboardGenerator->getDefaultKeyboard();

        return ["msg" => $message, "keyboard" => $keyboard];
    }

    private function getConfirmationView($text, $userId): array
    {
        $groupId = $this->groupManager->getGroupIdByName($text);
        if (!$groupId)
            return $this->getHelpMessage();

        $result = $this->studentManager->addOrUpdateStudentGroup($userId, $groupId);

        if (!$result)
            return $this->getHelpMessage();

        $message = $this->messageConstructor->getConfirmationMessage();
        $keyboard = $this->keyboardGenerator->getDefaultKeyboard();

        return ["msg" => $message, "keyboard" => $keyboard];
    }

    private function getGroupOptions(): array
    {
        $result = $this->groupManager->getAllGroupNames()();
        if (!$result)
            return $this->getHelpMessage();

        $message = $this->messageConstructor->getGroupOptionsMessage();
        $keyboard = $this->keyboardGenerator->getGroupKeyboard($result);

        return ["msg" => $message, "keyboard" => $keyboard];
    }

    private function getWeekSchedule($userId): array
    {
        $groupId = $this->studentManager->getStudentGroupId($userId);
        if (!$groupId)
            return $this->getHelpMessage();

        $weekType = $this->getWeekType();
        $result = $this->scheduleManager->getCurrentWeekSchedule($groupId, $weekType);
        $keyboard = $this->keyboardGenerator->getDefaultKeyboard();

        if (!$result) {
            $message = $this->messageConstructor->getScheduleNotFoundMessage();
            return ["msg" => $message, "keyboard" => $keyboard];
        }

        $message = $this->messageConstructor->getWeekScheduleMessage($result);
        return ["msg" => $message, "keyboard" => $keyboard];
    }

    private function getTodaySchedule($userId): array
    {
        $groupId = $this->studentManager->getStudentGroupId($userId);

        if (!$groupId)
            return $this->getHelpMessage();

        $dayOfWeek = date('N') - 1;
        $weekType = $this->getWeekType();
        $result = $this->scheduleManager->getDaySchedule($groupId, $dayOfWeek, $weekType);
        $keyboard = $this->keyboardGenerator->getDefaultKeyboard();

        if (!$result) {
            $message = $this->messageConstructor->getNoLessonsMessage();
            return ["msg" => $message, "keyboard" => $keyboard];
        }

        $message = $this->messageConstructor->getDayScheduleMessage($result);

        return ["msg" => $message, "keyboard" => $keyboard];
    }

    private function getWeekType(): string
    {
        $currentMonth = date("n");
        $currentYear = $currentMonth > 0 && $currentMonth < 9 ? date("Y") - 1 : date("Y");
        $time = strtotime("09/01/{$currentYear}");
        $startDate = date('Y-m-d', $time);

        $startWeekNumber = intval(date("W", $startDate));
        $currentWeekNumber = intval(date("W"));

        if ($currentMonth > 0 && $currentMonth < 9) {
            $lastDateYear = strtotime("12/31/{$currentYear}");
            if (date("N", $lastDateYear) != 1) {
                $currentWeekNumber -= 1;
            }
            $weeksCount = intval(date("W", $lastDateYear)) -
                $startWeekNumber + $currentWeekNumber;
        } else {
            $weeksCount = $currentWeekNumber - $startWeekNumber;
        }

        if ($weeksCount % 2 != 0)
            return 'Denominator';
        return 'Numerator';
    }
}
<?php

namespace App\managers;
use App\db\DbConnectionInterface;

class AttendanceManager
{
    private DbConnectionInterface $dbConnector;

    public function __construct(DbConnectionInterface $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    public function getSkippedClassNumber($studentId, $scheduleId): object|bool
    {
        $result = pg_query_params(
            $this->dbConnector->getConnection(),
            'SELECT SkippedClassNumber FROM Attendance WHERE ScheduleId = $1 and StudentId = $2;',
            array($scheduleId, $studentId)
        );

        if (!$result) {
            return false;
        }

        return pg_fetch_object($result);
    }

    public function updateAttendance($studentId, $scheduleId, $skippedClassNumber): bool
    {
        $result = pg_query_params(
            $this->dbConnector->getConnection(),
            'UPDATE Attendance SET SkippedClassNumber = $1 WHERE ScheduleId = $2 and StudentId = $3;',
            array($skippedClassNumber, $scheduleId, $studentId)
        );

        if (!$result) {
            return false;
        }

        return true;
    }
}
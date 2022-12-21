<?php

namespace App\managers;

use App\db\DbConnectionInterface;

class ScheduleManager
{
    private DbConnectionInterface $dbConnector;

    public function __construct(DbConnectionInterface $db)
    {
        $this->dbConnector = $db;
    }

    public function getCurrentWeekSchedule($groupId, $weekType): bool|array
    {
        $result = pg_query_params(
            $this->dbConnector->getConnection(),
            'SELECT sc.Id, s.Name as subject, l.Name, Classroom, DayOfWeek, Address, 
                    to_char(sc.starttime, $4) as starttime, to_char(sc.endtime , $4) as endtime
            FROM Schedule sc JOIN Subject s ON sc.SubjectId = s.Id JOIN Lector l ON l.Id = sc.LectorId
            WHERE sc.GroupId = $1 and (sc.Week = $2 or sc.Week = $3)
            ORDER BY DayOfWeek, StartTime;',
            array($groupId, $weekType, "Both", 'HH24:MI')
        );

        if (!$result) {
            return false;
        }

        return pg_fetch_all($result);
    }

    public function getDaySchedule($groupId, $dayOfWeek, $weekType): bool|array
    {
        $result = pg_query_params(
            $this->dbConnector->getConnection(),
            'SELECT sc.Id, s.Name as subject, l.Name, Classroom, DayOfWeek, Address,
                    to_char(sc.starttime, $5) as starttime, to_char(sc.endtime , $5) as endtime
            FROM Schedule sc JOIN Subject s ON sc.SubjectId = s.Id JOIN Lector l ON l.Id = sc.LectorId
            WHERE sc.GroupId = $1 and sc.DayOfWeek = $2 and (sc.Week = $3 or sc.Week = $4)
            ORDER BY StartTime asc;',
            array($groupId, $dayOfWeek, $weekType, 'Both', 'HH24:MI')
        );

        if (!$result) {
            return false;
        }

        return pg_fetch_all($result);
    }
}

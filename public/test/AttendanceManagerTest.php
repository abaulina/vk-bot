<?php

namespace App\test;

use PHPUnit\Framework\TestCase;
use App\managers\AttendanceManager;

final class AttendanceManagerTest extends TestCase
{
    private TestDbConnector $dbConnector;

    protected function setUp(): void
    {
        $this->dbConnector = new TestDbConnector();
        $this->dbConnector->deleteAllStudents();
    }

    protected function tearDown(): void
    {
        $this->dbConnector->deleteAllStudents();
    }

    public function testGetSkippedClassNumberNotExistingStudentFailure()
    {
        $attendanceManager = new AttendanceManager($this->dbConnector);

        $result = $attendanceManager->getSkippedClassNumber(132131223,1);

        $this->assertFalse($result);
    }

    public function testGetSkippedClassNumberNotExistingScheduleFailure()
    {
        $attendanceManager = new AttendanceManager($this->dbConnector);

        $result = $attendanceManager->getSkippedClassNumber(1,656546454);

        $this->assertFalse($result);
    }
}

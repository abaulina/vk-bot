<?php

namespace App\test;

use App\managers\StudentManager;
use PHPUnit\Framework\TestCase;

final class StudentManagerTest extends TestCase
{
    private TestDbConnector $dbConnector;

    protected function setUp(): void
    {
        $this->dbConnector = new TestDbConnector();
        $this->dbConnector->deleteAllStudents();
        $this->dbConnector->addGroup(30000, 'КБ-51');
    }

    protected function tearDown(): void
    {
        $this->dbConnector->deleteGroup(30000);
        $this->dbConnector->deleteAllStudents();
    }

    public function testGetStudentGroupIdNotExisting()
    {
        $studentManager = new StudentManager($this->dbConnector);

        $result = $studentManager->getStudentGroupId(2131);

        $this->assertFalse($result);
    }

    public function testGetStudentGroupSuccess()
    {
        $studentManager = new StudentManager($this->dbConnector);
        $studentManager->addOrUpdateStudentGroup(1,30000);

        $result = $studentManager->getStudentGroupId(1);

        $this->assertEquals(30000, $result);
    }

    public function testAddOrUpdateStudentGroupExistingIdSuccess()
    {
        $studentManager = new StudentManager($this->dbConnector);
        $studentManager->addOrUpdateStudentGroup(1, 30000);
        $this->dbConnector->addGroup(40000, 'New');

        $result = $studentManager->addOrUpdateStudentGroup(1, 40000);

        $this->assertTrue($result);
    }

    public function testAddOrUpdateStudentGroupNotExistingGroupFailure()
    {
        $studentManager = new StudentManager($this->dbConnector);
        $studentManager->addOrUpdateStudentGroup(1,  30000);

        $result = $studentManager->addOrUpdateStudentGroup(1, 100);

        $this->assertFalse($result);
    }
}

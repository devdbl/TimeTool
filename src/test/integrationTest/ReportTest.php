<?php

use PHPUnit\Framework\TestCase;

require_once("src/main/controllers/ReportController.php");
require_once("src/main/tools/DatabaseConnector.php");

class ReportTest extends TestCase
{
    public function testCreateReport(){
        $sum = 0;
        $projectId = null;
        $userId = null;
        $dateArray['startDate'] = "2021-08-01";
        $dateArray['endDate'] = "2021-08-01";
        $overview = 1;
        $requestMethod = 'WEB';


        $dbConnection = (new DatabaseConnector())->connect();

        $reportController = new ReportController($dbConnection, $requestMethod, $projectId, $userId, $dateArray, $overview);
        $reportController->processRequest();

        while($reportController->dataArray){
            $sum++;
        }

        $this->assertEquals(4, $sum);
    }

}
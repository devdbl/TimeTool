<?php

require_once("../models/ReportGateway.php");

class ReportController
{
    private $requestMethod;
    private $projectId;
    private $userId;
    private $dateArray;
    private $reportGateway;


    public function __construct($db, $requestMethod, $projectId, $userId, $dateArray)
    {
        $this->requestMethod = $requestMethod;
        $this->projectId = $projectId;
        $this->userId = $userId;
        $this->dateArray = $dateArray;
        $this->reportGateway = new ReportGateway($db);
    }

    public function processRequest(){
        switch($this->requestMethod){
            case 'GET':
                if($this->projectId && !$this->userId){
                    $response = $this->getTimeReportProject($this->projectId);
                }elseif (!$this->projectId && $this->userId){
                    $response = $this->getTimeReportUser($this->userId);
                }elseif ($this->projectId && $this->userId){
                    $response = $this->getTimeReportProjectUser($this->projectId, $this->userId);
                }else{
                    $response = $this->getTimeReport();
                }
                break;
            case 'POST':
                $response = $this->addTimeReport();
                break;
            case 'DELETE':
                break;
            default:
                $response = $this->notFoundRequest();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function addTimeReport(){
        //Der eingeloggt User will eine Buchung auf ein ausgewähltes bereits vorhandenes Projekt vornehmen
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $this->reportGateway->add($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    private function getTimeReport(){
        //Der eingeloggte User will seine erfassten Buchungen letzte 100 einträge anzeigen
        $this->dateArray = $this->validateReport($this->dateArray);
        $result = $this->reportGateway->selectAll($this->dateArray);
        if (! $result) {
            return $this->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getTimeReportUser($userId){
        //Ein User will die letzten 100 Buchungen eines anderen User sehen
        $this->dateArray = $this->validateReport($this->dateArray);
        $result = $this->reportGateway->selectReportUser($this->dateArray,$userId);
        if (! $result) {
            return $this->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;

    }

    private function getTimeReportProject($projectId){
        // ein User will die letzten 100 erfassten Buchungen eines ausgewählten Projektes
        $this->dateArray = $this->validateReport($this->dateArray);
        $result = $this->reportGateway->selectReportProject($this->dateArray,$projectId);
        if (! $result) {
            return $this->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getTimeReportProjectUser($projectId, $userId){
        //Ein User will die letzten 100 erfassten Buchungen eines anderen User für ein bestimmtes Projekt sehen
        $this->dateArray = $this->validateReport($this->dateArray);
        $result = $this->reportGateway->selectReportProjectUser($this->dateArray[0], $this->dateArray[1],$projectId,$userId);
        if (! $result) {
            return $this->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function validateReport($input){
        if (! isset($input['startDate'])) {
            $month = strtotime("-1 Month");
            $input['startDate'] = date("Y-m-d",$month);
        }
        if (! isset($input['endDate'])) {
            $input['endDate'] = date("Y-m-d");
        }
        return $input;
    }

    private function unprocessableEntityResponse(){
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundRequest(){
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

}
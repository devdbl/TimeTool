<?php

require_once("../models/ReportGateway.php");
require_once("../tools/Validation.php");

class ReportController
{
    private $requestMethod;
    private $projectId;
    private $userId;
    private $dateArray;
    private $reportGateway;
    private $overview;
    private $validation;

    public $dataArray;


    public function __construct($db, $requestMethod, $projectId, $userId, $dateArray, $overview)
    {
        $this->requestMethod = $requestMethod;
        $this->projectId = $projectId;
        $this->userId = $userId;
        $this->dateArray = $dateArray;
        $this->overview = $overview;
        $this->reportGateway = new ReportGateway($db);
        $this->validation = new Validation();
    }

    public function processRequest(){
        switch($this->requestMethod){
            case 'GET':
                if($this->projectId && !$this->userId){
                    $response = $this->getTimeReportProject();
                }elseif (!$this->projectId && $this->userId){
                    $response = $this->getTimeReportUser();
                }elseif ($this->projectId && $this->userId){
                    $response = $this->getTimeReportProjectUser();
                }else{
                    $response = $this->getTimeReport();
                }
                break;
            case 'POST':
                $response = $this->addTimeReport();
                break;
            case 'WEB':
                $response = $this->getTimeReportWeb();
                break;
            case 'ADD':
                $response = $this->addReport();
                break;
            default:
                $response = $this->validation->notFoundRequest();
                break;
        }
        header($response['status_code_header']);
        if($response['body']){
            $this->dataArray = $response['body'];
        }
    }

    private function addReport(){
        $input = $this->validation->validateInput($_POST);
        $this->reportGateway->add($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    private function addTimeReport(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $this->reportGateway->add($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    private function getTimeReport(){
        $this->dateArray = $this->validation->validateDate($this->dateArray);
        $result = $this->reportGateway->selectAll($this->dateArray);
        if (! $result) {
            return $this->validation->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getTimeReportWeb(){
        $this->dateArray = $this->validation->validateDate($this->dateArray);
        if($this->overview == 1){
            $result = $this->reportGateway->selectReportUserOverview($this->dateArray,$this->userId);
        }else{
            $result = $this->reportGateway->selectReportUser($this->dateArray,$this->userId);
        }
        if(! $result) {
            return $this->validation->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }


    private function getTimeReportUser(){
        $this->dateArray = $this->validation->validateDate($this->dateArray);
        if($this->overview == 1){
            $result = $this->reportGateway->selectReportUserOverview($this->dateArray,$this->userId);
        }else{
            $result = $this->reportGateway->selectReportUser($this->dateArray,$this->userId);
        }
        if(! $result) {
            return $this->validation->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;

    }


    private function getTimeReportProject(){
        $this->dateArray = $this->validation->validateDate($this->dateArray);
        if($this->overview == 1){
            $result = $this->reportGateway->selectReportProjectOverview($this->dateArray,$this->projectId);
        }else{
            $result = $this->reportGateway->selectReportProject($this->dateArray,$this->projectId);
        }
        if (! $result) {
            return $this->validation->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getTimeReportProjectUser(){
        $this->dateArray = $this->validation->validateDate($this->dateArray);
        $result = $this->reportGateway->selectReportProjectUser($this->dateArray,$this->projectId,$this->userId);
        if (! $result) {
            return $this->validation->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
}
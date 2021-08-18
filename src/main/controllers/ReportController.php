<?php

namespace app\controllers;

use app\models\ReportGateway;

class ReportController
{
    private $db;
    private $requestMethod;
    private $projectId;
    private $userId;
    private $dateArray = array();
    private $reportGateway;


    public function __construct($db, $requestMethod, $projectId, $userId, $dateArray)
    {
        $this->db = $db;
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

    }

    private function getTimeReport(){
        //Der eingeloggte User will seine erfassten Buchungen letzte 100 einträge
    }

    private function getTimeReportUser(){
        //Ein User will die letzten 100 Buchungen eines anderen User sehen
    }

    private function getTimeReportProject(){
        // ein User will die letzten 100 erfassten Buchungen eines ausgewählten Projektes
    }

    private function getTimeReportProjectUser(){
        //Ein User will die letzten 100 erfassten Buchungen eines anderen User für ein bestimmtes Projekt sehen
    }

    private function validateReport($input){
        if (! isset($input['firstname'])) {
            $month = strtotime("-1 Month");
            $input['startDate'] = date("Y-m-d",$month);
        }
        if (! isset($input['endDate'])) {
            $input['endDate'] = date("Y-m-d");
        }
        return true;
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
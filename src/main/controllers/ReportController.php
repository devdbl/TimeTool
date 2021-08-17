<?php

require_once("../models/ReportGateway.php");


class ReportController
{
    private $db;
    private $requestMethod;
    private $projectId;
    private $userId;
    private $reportGateway;


    public function __construct($db, $requestMethod, $projectId, $userId)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->projectId = $projectId;
        $this->userId = $userId;
        $this->reportGateway = new ReportGateway;
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

    private function getTimeReportPeriod(){
        //Der eingeloggte User will seine erfassten Buchungen in einem definierten Zeitraum sehen
    }

    private function getTimeReportUserPeriod(){
        //Ein User will die  Buchungen eines anderen User in einem definierten Zeitraum sehen
    }

    private function getTimeReportProjectPeriod(){
        // ein User will die erfassten Buchungen eines ausgewählten Projektes in einem definierten Zeitraum sehen
    }

    private function getTimeReportProjectUserPeriod(){
        //Ein User will die erfassten Buchungen eines anderen User für ein bestimmtes Projekt in einem definierten Zeitraum sehen
    }

}
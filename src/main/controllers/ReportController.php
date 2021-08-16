<?php

require_once("../controllers/DatabaseController.php");
require_once("../controllers/Validation.php");
require_once("../models/User.php");


class ReportController
{
    private DatabaseController $db;
    private Report $report;
    private User $User;

    public function __construct()
    {
        $this->db = new DatabaseController();
        $this->report = new Report();
        $this->User = new User();
    }


    public function addTimeReport(){
        //Der eingeloggt User will eine Buchung auf ein ausgewähltes bereits vorhandenes Projekt vornehmen
    }

    public function getTimeReport(){
        //Der eingeloggte User will seine erfassten Buchungen in einem bestimmten Zeitraum ansehen
    }

    public function getTimeReportUser(){
        //Ein User will die erfassten Buchungen eines anderen User in einem bestimmten Zeitraum ansehen
    }

    public function getTimeReportProject(){
        // ein User will alle erfassten Buchungen eines ausgewählten Projektes in einem bestimmten Zeitraum ansehen
    }

    public function getTimeReportProjectUser(){
        //Ein User will alle erfassten Buchungen eines anderen User für ein bestimmtes Projekt in einem bestimmten Zeitraum sehen
    }

}
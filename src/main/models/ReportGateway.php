<?php

class ReportGateway
{
    private $db = null;

    /**
     * @param null $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function selectAll($dateArray){
        $statement = "SELECT
                        PROJECT_ID,EMPLOYEE_ID,`TIME`,REPORTDATE 
                      FROM
                        `time`
                      WHERE REPORTDATE
                      BETWEEN :start AND :end
                      ORDER BY ID";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'start' => $dateArray['startDate'],
                'end'   => $dateArray['endDate']
            ));
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function selectReportUser($dateArray,$userId){
        $statement = "SELECT
                        PROJECT_ID,EMPLOYEE_ID,TIME,REPORTDATE 
                      FROM
                        time
                      WHERE (REPORTDATE BETWEEN :start AND :end)
                      AND EMPLOYEE_ID = :userId
                      ORDER BY
                        ID";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'start' => $dateArray['startDate'],
                'end'   => $dateArray['endDate'],
                'userId'=> $userId
            ));
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function selectReportProject($dateArray, $projectId){
        $statement = "SELECT
                        PROJECT_ID,EMPLOYEE_ID,TIME,REPORTDATE 
                      FROM
                        time
                      WHERE (REPORTDATE BETWEEN :start AND :end)
                      AND PROJECT_ID = :projectId
                      ORDER BY
                        ID";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'start' => $dateArray['startDate'],
                'end'   => $dateArray['endDate'],
                'projectId'=> $projectId
            ));
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function selectReportProjectUser($dateArray, $projectId, $userId){
        $statement = "SELECT 
                        PROJECT_ID,EMPLOYEE_ID,SUM(TIME)
                      FROM
                        time
                      WHERE (REPORTDATE BETWEEN :start AND :end)
                      AND EMPLOYEE_ID = :userId AND PROJECT_ID = :projectId
                      ";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'start' => $dateArray['startDate'],
                'end'   => $dateArray['endDate'],
                'projectId' => $projectId,
                'userId'    => $userId
            ));
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function add(Array $insert){
        $statement = "INSERT INTO time
                        (PROJECT_ID,EMPLOYEE_ID,TIME,REPORTDATE,COMMENT)
                      VALUES
                        (:projectId, :personalId, :time, :date, :comment)";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'projectId'     => $insert['projectId'],
                'personalId'    => $insert['personalId'],
                'time'          => $insert['time'],
                'date'          => $insert['date'],
                'comment'       => $insert['comment']
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

}
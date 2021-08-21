<?php

class ProjectGateway
{
    private $db = null;

    /**
     * @param null $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function selectAll(){
        $statement = "SELECT
                        PROJECT_ID,PROJECTNAME,DESCRIPTION,IS_ACTIVE
                      FROM
                        project
                      ORDER BY
                        PROJECT_ID";
        try {
            $statement = $this->db->query($statement);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function selectAllActive(){
        $statement = "SELECT
                        PROJECT_ID,PROJECTNAME,DESCRIPTION
                      FROM
                        project
                      WHERE IS_ACTIVE = 1
                      ORDER BY
                        PROJECT_ID";
        try {
            $statement = $this->db->query($statement);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function selectProject($id){
        $statement = "SELECT 
                        PROJECT_ID,PROJECTNAME,DESCRIPTION
                      FROM
                        project
                      WHERE 
                        PROJECT_ID = ?";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function add(Array $input){
        $statement = "INSERT INTO project
                        (PROJECT_ID,PROJECTNAME,DESCRIPTION)
                      VALUES
                        (:projectId, :projectname, :description)";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'projectId' => $input['projectId'],
                'projectname'  => $input['projectname'],
                'description' =>   $input['description']
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($id, Array $input){
        $statement = "UPDATE project
                      SET
                        PROJECTNAME = :projectname,
                        DESCRIPTION = :description,
                        IS_ACTIVE   = :isActive
                      WHERE
                        PROJECT_ID = :projectId";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([
                'projectId' => (int) $id,
                'projectname'  => $input['projectname'],
                'description' => $input['description'],
                'isActive' => $input['isActive']
            ]);
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id){
        echo "Funktioniert nicht: es wäre das Projekt mit der Projektnummer ".$id. " gelöscht worden";
    }
}
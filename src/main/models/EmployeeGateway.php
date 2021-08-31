<?php

class EmployeeGateway
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
                        EMPLOYEE_ID,FIRSTNAME,LASTNAME,SHORTNAME
                      FROM
                        employee
                      ORDER BY
                        LASTNAME";
        try {
            $statement = $this->db->query($statement);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

    }

    public function select($id){
        $statement = "SELECT 
                        EMPLOYEE_ID,FIRSTNAME,LASTNAME,SHORTNAME
                      FROM
                        employee
                      WHERE 
                        EMPLOYEE_ID = ?";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function add(Array $input){
        $statement = "INSERT INTO employee
                        (EMPLOYEE_ID,FIRSTNAME,LASTNAME,SHORTNAME,PASSWORD,ROLE)
                      VALUES
                        (:personalId, :firstname, :lastname, :shortname, :password, :isadmin)";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'personalId' => $input['personalId'],
                'firstname'  => $input['firstname'],
                'lastname' =>   $input['lastname'],
                'shortname' =>  $input['shortname'],
                'password' =>   $input['password'],
                'isadmin' =>    $input['role'],
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($personalId,Array $input){
        $statement = "UPDATE employee
                      SET
                        FIRSTNAME = :firstname,
                        LASTNAME =  :lastname,
                        PASSWORD =  :password,
                        ROLE =      :role 
                      WHERE
                        EMPLOYEE_ID = :personalId";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([
                'personalId' => (int) $personalId,
                'firstname'  => $input['firstname'],
                'lastname' => $input['lastname'],
                'password' => $input['password'],
                'role' => $input['role'],
            ]);
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }



}
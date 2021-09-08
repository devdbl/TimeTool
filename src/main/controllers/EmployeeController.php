<?php

require_once("../models/EmployeeGateway.php");
require_once("../tools/Validation.php");

class EmployeeController{


    private $requestMethod;
    private $userId;
    private $employeeGateway;
    private $validation;

    public $dataArray;

    
    public function __construct($db, $requestMethod, $userId)
    {
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;
        $this->employeeGateway = new EmployeeGateway($db);
        $this->validation = new Validation();
    }

    public function processRequest(){
        switch($this->requestMethod){
            case 'GET':
                if($this->userId){
                    $response = $this->getUser($this->userId);
                }else{
                    $response = $this->getAllUsers();
                }
                break;
            case 'POST':
                $response = $this->createUser();
                break;
            case 'PUT':
                $response = $this->updateUser($this->userId);
                break;
            case 'DELETE':
                $response = $this->deleteUser($this->userId);
                break;
            default:
                $response = $this->validation->notFoundRequest();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllUsers(){
        $result = $this->employeeGateway->selectAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getUser($personalId){
        $result = $this->employeeGateway->select($personalId);
        if (! $result) {
            return $this->validation->notFoundRequest();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createUser(){
        $input = $_POST;
        if (! $this->validation->validatePerson($input)) {
            return $this->validation->unprocessableEntityResponse();
        }
        $this->employeeGateway->add($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    private function updateUser($personalId){
        $result = $this->employeeGateway->select($personalId);
        if (! $result) {
            return $this->validation->notFoundRequest();
        }
        $input = $_POST;
        if (! $this->validation->validatePerson($input)) {
            return $this->validation->unprocessableEntityResponse();
        }
        $this->employeeGateway->update($personalId, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function deleteUser($personalId){
        echo "Funktioniert nicht: es wäre der Mitarbeiter mit der Personalnummer ".$personalId. " gelöscht worden";
    }
}
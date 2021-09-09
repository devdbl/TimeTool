<?php

require_once("../models/ProjectGateway.php");
require_once("../tools/Validation.php");

class ProjectController{


    private $requestMethod;
    private $getDeactivatedProjects;
    private $projectId;
    private $projectGateway;
    private $validation;


    public function __construct($db, $requestMethod, $projectId, $getDeactivatedProjects)
    {
        $this->requestMethod = $requestMethod;
        $this->projectId = $projectId;
        $this->getDeactivatedProjects = $getDeactivatedProjects;
        $this->projectGateway = new ProjectGateway($db);
        $this->validation = new Validation();
    }

    public function processRequest(){
        switch($this->requestMethod){
            case 'GET':
                if($this->projectId){
                    $response = $this->getProject($this->projectId);
                }elseif($this->getDeactivatedProjects){
                    $response = $this->getAllProjects();
                }else{
                    $response = $this->getAllActiveProjects();
                }
                break;
            case 'POST':
                $response = $this->createProject();
                break;
            case 'PUT':
                $response = $this->updateProject($this->projectId);
                break;
            case 'DELETE':
                $response = $this->deleteProject($this->projectId);
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

    private function getAllProjects(){
        $result = $this->projectGateway->selectAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getAllActiveProjects(){
        $result = $this->projectGateway->selectAllActive();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;

    }

    private function getProject($id){
        $result = $this->projectGateway->selectProject($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createProject(){
        $input = $_POST;
        if (!$this->validation->validateProject($input)) {
            return $this->validation->unprocessableEntityResponse();
        }
        $this->projectGateway->add($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    private function updateProject($id){
        $result = $this->projectGateway->selectProject($id);
        if (! $result) {
            return $this->validation->notFoundRequest();
        }
        $input = $_POST;
        if (! $this->validation->validateProjectUpdate($input)) {
            return $this->validation->unprocessableEntityResponse();
        }
        $this->projectGateway->update($id, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function deleteProject($id){
        echo "Funktioniert nicht: es wäre das Projekt mit der Projektnummer ".$id. " gelöscht worden";
    }
}
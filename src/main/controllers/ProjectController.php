<?php

require_once("../models/ProjectGateway.php");

class ProjectController{


    private $requestMethod;
    private $getDeactivatedProjects;
    private $projectId;
    private $projectGateway;


    public function __construct($db, $requestMethod, $projectId, $getDeactivatedProjects)
    {
        $this->requestMethod = $requestMethod;
        $this->projectId = $projectId;
        $this->getDeactivatedProjects = $getDeactivatedProjects;
        $this->projectGateway = new ProjectGateway($db);
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
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validateProject($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->projectGateway->add($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    private function updateProject($id){
        $result = $this->projectGateway->selectProject($id);
        if (! $result) {
            return $this->notFoundRequest();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validateProjectUpdate($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->projectGateway->update($id, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function deleteProject($id){
        echo "Funktioniert nicht: es wäre das Projekt mit der Projektnummer ".$id. " gelöscht worden";
    }

    private function validateProject($input){
        if (! isset($input['projectId'])) {
            return false;
        }
        if (! isset($input['projectname'])) {
            return false;
        }
        return true;
    }

    private function validateProjectUpdate($input){
        if (! isset($input['projectname'])) {
            return false;
        }
        if (! isset($input['isActive'])) {
            return false;
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
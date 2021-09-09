<?php

class Validation
{

    public function validateInput($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        return htmlspecialchars($data);
    }

    public function validatePerson($data){
        if (! isset($data['firstname'])) {
            return false;
        }
        if (! isset($data['lastname'])) {
            return false;
        }
        if (! isset($data['personalId'])) {
            return false;
        }
        if (! isset($data['shortname'])) {
            return false;
        }
        return true;
    }

    public function validateProject($input){
        if (! isset($input['projectId'])) {
            return false;
        }
        if (! isset($input['projectname'])) {
            return false;
        }
        return true;
    }

    public function validateProjectUpdate($input){
        if (! isset($input['projectname'])) {
            return false;
        }
        if (! isset($input['isActive'])) {
            return false;
        }
        return true;
    }

    public function validateDate($data){
        if (! isset($data['startDate'])) {
            $month = strtotime("-1 Month");
            $data['startDate'] = date("Y-m-d",$month);
        }
        if (! isset($data['endDate'])) {
            $data['endDate'] = date("Y-m-d");
        }
        return $data;
    }

    public function unprocessableEntityResponse(){
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    public function notFoundRequest(){
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

}
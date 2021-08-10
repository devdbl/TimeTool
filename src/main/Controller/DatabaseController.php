<?php
    class DatabaseController{
        private $name = "localhost";
        private $user;
        private $pw;
        private $databaseName;
        
        function __construct($user, $pw, $databaseName){
            $this->user = $user;
            $this->pw = $pw;
            $this->databaseName = $databaseName;

        }

        public function connectDatabase(){
            $con = mysqli_connect($name, $user, $pw, $databaseName);
            if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
        }

        public function getAllProjectIds(){
            $sql = "SELECT PROJECT_ID, PROJECTNAME FROM timetool.project";
            $con = mysqli_connect($this->name, $this->user, $this->pw, $this->databaseName);
            if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $result = mysqli_query($con,$sql);
            
            if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                echo "ID: " . $row["PROJECT_ID"]. " - Name: " . $row["PROJECTNAME"]. "<br>";
            }
            } else {
            echo "0 results";
            }
            $con->close();
        }
        
        public function getProject($projectId){





        }










    }

?>
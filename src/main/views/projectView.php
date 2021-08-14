<?php
    include "DatabaseController.php";


    $data = new DatabaseController("root","","timetool");

    $data->getAllProjectIds();
?>
$(document).ready(function(){
    $("#showEmployee").click(function(){
        $.get( "http://localhost/api/employee.php", function(data) {
            var array = data;
            array.forEach(function(employee){
                $("#employeeList").append("<li>"+ employee.FIRSTNAME + " " + employee.LASTNAME +" / " + employee.EMPLOYEE_ID +" / Ist Administrator: " + employee.ROLE + "</li>");
            });
        });

    });
})
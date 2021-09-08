$(document).ready(function(){
    $("#showProject").click(function(){
        $.get( "http://localhost/api/project.php?getDeactivatedProjects=false", function(data) {
            var projectArray = data;
            projectArray.forEach(function(project){
                $("#projectList").append("<li>"+ project.PROJECT_ID + " / " + project.PROJECTNAME + "</li>");
            });
        });

    });
})
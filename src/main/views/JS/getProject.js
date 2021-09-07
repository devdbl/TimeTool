$(document).ready(function(){
    $("#showProject").click(function(){
        $.get( "http://localhost/api/project.php?getDeactivatedProjects=true", function( data ) {
            var projectArray = JSON.parse(data);
            projectArray.forEach(function(project){
                $("#projectList").append("<li>"+project.PROJECTNAME + " " + project.PROJECT_ID + "</li>");
            });
        });

    });
})
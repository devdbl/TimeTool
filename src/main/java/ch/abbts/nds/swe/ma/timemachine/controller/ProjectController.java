package ch.abbts.nds.swe.ma.timemachine.controller;


import ch.abbts.nds.swe.ma.timemachine.logic.Project;
import ch.abbts.nds.swe.ma.timemachine.logic.ProjectMapper;
import ch.abbts.nds.swe.ma.timemachine.logic.ProjectRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping(path = "/projects")
public class ProjectController {
    @Autowired
    private ProjectRepo projectRepository;
    @Autowired
    private JdbcTemplate jdbcTemplate;

    final private String SELECT_PROJECT_BY_ID = "SELECT * FROM timemachine.project WHERE PROJECT_ID = ?";


    @PostMapping(path = "/add")
    public void addProject(@RequestParam double projectId, @RequestParam String projectName, @RequestParam int projectLimit){
        Project project = new Project();
        project.setProjectId(projectId);
        project.setProjectName(projectName);
        project.setProjectLimit(projectLimit);
        projectRepository.save(project);
    }

    @GetMapping(path = "/allProjects")
    public @ResponseBody Iterable<Project> getAllProjects(){
        return projectRepository.findAll();
    }

    @GetMapping(path = "/getProject")
    public @ResponseBody Project getProject(@RequestParam double projectId){
        return jdbcTemplate.queryForObject(SELECT_PROJECT_BY_ID, new ProjectMapper(), projectId);

    }
}

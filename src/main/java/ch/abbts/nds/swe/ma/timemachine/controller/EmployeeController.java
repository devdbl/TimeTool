package ch.abbts.nds.swe.ma.timemachine.controller;


import ch.abbts.nds.swe.ma.timemachine.logic.Employee;
import ch.abbts.nds.swe.ma.timemachine.logic.EmployeeMapper;
import ch.abbts.nds.swe.ma.timemachine.logic.EmployeeRepo;
import ch.abbts.nds.swe.ma.timemachine.logic.ProjectMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.web.bind.annotation.*;


@RestController
@RequestMapping(path = "/employee")
public class EmployeeController {
    @Autowired
    private EmployeeRepo employeeRepository;
    @Autowired
    private JdbcTemplate jdbcTemplate;

    final private String SELECT_EMPLOYEE_BY_ID = "SELECT * FROM timemachine.personal WHERE PERSONAL_ID = ?";

    @PostMapping(path = "/add")
    public void addNewUser( @RequestParam String firstName, @RequestParam String lastName, @RequestParam String shortName, @RequestParam int personalId, @RequestParam int role){
        Employee employee = new Employee();
        employee.setFirstName(firstName);
        employee.setLastName(lastName);
        employee.setShortName(shortName);
        employee.setPersonalId(personalId);
        employee.setRole(role);
        employeeRepository.save(employee);
    }
    @GetMapping(path="/allEmployees")
    public @ResponseBody Iterable<Employee> getAllUsers() {
        return employeeRepository.findAll();
    }

    @GetMapping(path = "/getEmployee")
    public @ResponseBody Employee getEmployee(@RequestParam int personalId){
        return jdbcTemplate.queryForObject(SELECT_EMPLOYEE_BY_ID, new EmployeeMapper(), personalId);
    }
}

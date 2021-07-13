package ch.abbts.nds.swe.ma.timemachine.controller;


import ch.abbts.nds.swe.ma.timemachine.logic.Employee;
import ch.abbts.nds.swe.ma.timemachine.logic.EmployeeRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;


@RestController
@RequestMapping(path = "/employees")
public class EmployeesController {
    @Autowired
    private EmployeeRepo employeeRepository;

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
    @GetMapping(path="/allUsers")
    public @ResponseBody Iterable<Employee> getAllUsers() {
        return employeeRepository.findAll();
    }

}

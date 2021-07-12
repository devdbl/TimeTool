package ch.abbts.nds.swe.ma.timemachine.controller;


import ch.abbts.nds.swe.ma.timemachine.logic.Employee;
import ch.abbts.nds.swe.ma.timemachine.logic.UserRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;


@RestController
@RequestMapping(path = "/test")//Jump over security
public class EmployeesController {
    @Autowired
    private UserRepo userRepo;

    @PostMapping(path = "/add")
    public @ResponseBody String addNewUser( @RequestParam String lastName, @RequestParam String firstName, @RequestParam String shortName, @RequestParam int personalId, @RequestParam int role){
        // @ResponseBody means the returned String is the response, not a view name
        // @RequestParam means it is a parameter from the GET or POST request
        Employee employee = new Employee();
        employee.setFirstName(firstName);
        employee.setLastName(lastName);
        employee.setShortName(shortName);
        employee.setPersonalId(personalId);
        employee.setRole(role);
        return "Saved";
    }
    @GetMapping(path="/allUsers")
    public @ResponseBody Iterable<Employee> getAllUsers() {
        // This returns a JSON or XML with the users
        return userRepo.findAll();
    }

}

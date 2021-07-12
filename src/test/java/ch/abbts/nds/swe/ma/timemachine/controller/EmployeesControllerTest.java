package ch.abbts.nds.swe.ma.timemachine.controller;

import ch.abbts.nds.swe.ma.timemachine.logic.Employee;
import ch.abbts.nds.swe.ma.timemachine.logic.UserRepo;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;

import static org.junit.jupiter.api.Assertions.*;

class EmployeesControllerTest {

    @Autowired
    private UserRepo userRepository;
    @Test
    void addNewUser() {
        Employee employee = new Employee();
        employee.setFirstName("firstName");
        employee.setLastName("lastName");
        employee.setShortName("shrt");
        employee.setPersonalId(9999);
        employee.setRole(2);
        userRepository.save(employee);
    }

    @Test
    void getAllUsers() {

    }
}
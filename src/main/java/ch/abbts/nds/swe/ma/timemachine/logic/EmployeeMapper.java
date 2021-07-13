package ch.abbts.nds.swe.ma.timemachine.logic;

import org.springframework.jdbc.core.RowMapper;

import java.sql.ResultSet;
import java.sql.SQLException;

public class EmployeeMapper implements RowMapper<Employee> {
    @Override
    public Employee mapRow(ResultSet rs, int rowNum) throws SQLException {
        Employee employee = new Employee();
        employee.setPersonalId(rs.getInt("PERSONAL_ID"));
        employee.setFirstName(rs.getString("FIRSTNAME"));
        employee.setLastName(rs.getString("LASTNAME"));
        employee.setShortName(rs.getString("SHORTNAME"));
        employee.setRole(rs.getInt("ROLE"));
        return employee;
    }
}

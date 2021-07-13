package ch.abbts.nds.swe.ma.timemachine.logic;

import org.springframework.jdbc.core.RowMapper;

import java.sql.ResultSet;
import java.sql.SQLException;

public class ProjectMapper implements RowMapper<Project> {

    @Override
    public Project mapRow(ResultSet rs, int rowNum) throws SQLException {
        Project project = new Project();
        project.setProjectId(rs.getDouble("PROJECT_ID"));
        project.setProjectName(rs.getString("PROJECTNAME"));
        project.setProjectLimit(rs.getInt("PROJECTLIMIT"));
        return project;
    }
}

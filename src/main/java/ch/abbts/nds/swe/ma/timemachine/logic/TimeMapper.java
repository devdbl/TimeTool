package ch.abbts.nds.swe.ma.timemachine.logic;

import org.springframework.jdbc.core.RowMapper;

import java.sql.ResultSet;
import java.sql.SQLException;

public class TimeMapper implements RowMapper<Time> {
    @Override
    public Time mapRow(ResultSet rs, int rowNum) throws SQLException {
        Time time = new Time();
        time.setProjectId(rs.getDouble("PROJECT_ID"));
        time.setPersonalId(rs.getInt("PERSONAL_ID"));
        time.setTime(rs.getString("TIME"));
        time.setWeek(rs.getInt("WEEK"));
        time.setEditTimeStamp(rs.getString("EDIT"));
        time.setComment(rs.getString("COMMENT"));
        return time;
    }
}

package ch.abbts.nds.swe.ma.timemachine.logic;

import org.springframework.jdbc.core.RowMapper;

import java.sql.ResultSet;
import java.sql.SQLException;

public class TimeReportMapper implements RowMapper<TimeReport> {
    @Override
    public TimeReport mapRow(ResultSet rs, int rowNum) throws SQLException {
        TimeReport timeReport = new TimeReport();
        timeReport.setProjectId(rs.getDouble("PROJECT_ID"));
        timeReport.setPersonalId(rs.getInt("PERSONAL_ID"));
        timeReport.setTime(rs.getString("TIME"));
        timeReport.setWeek(rs.getInt("WEEK"));
        timeReport.setEditTimeStamp(rs.getString("EDIT"));
        timeReport.setComment(rs.getString("COMMENT"));
        return timeReport;
    }
}

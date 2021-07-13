package ch.abbts.nds.swe.ma.timemachine.logic;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "time")
public class TimeReport {
    @Id
    @Column(name = "PROJECT_ID")
    private double projectId;
    @Column(name = "PERSONAL_ID")
    private int personalId;
    @Column(name = "TIME")
    private String time;
    @Column(name = "WEEK")
    private int week;
    @Column(name = "EDIT")
    private String editTimeStamp;
    @Column(name = "COMMENT")
    private String comment;

    public TimeReport() {    }

    public double getProjectId() {
        return projectId;
    }

    public void setProjectId(double projectId) {
        this.projectId = projectId;
    }

    public int getPersonalId() {
        return personalId;
    }

    public void setPersonalId(int personalId) {
        this.personalId = personalId;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public int getWeek() {
        return week;
    }

    public void setWeek(int week) {
        this.week = week;
    }

    public String getEditTimeStamp() {
        return editTimeStamp;
    }

    public void setEditTimeStamp(String editTimeStamp) {
        this.editTimeStamp = editTimeStamp;
    }

    public String getComment() {
        return comment;
    }

    public void setComment(String comment) {
        this.comment = comment;
    }
}

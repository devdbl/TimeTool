package ch.abbts.nds.swe.ma.timemachine.logic;


import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "project")
public class Project {
    @Id
    @Column(name = "PROJECT_ID")
    private double projectId;
    @Column(name = "PROJECTNAME")
    private String projectName;
    @Column(name = "PROJECTLIMIT")
    private int projectLimit;

    public Project() {
    }

    public double getProjectId() {
        return projectId;
    }

    public void setProjectId(double projectId) {
        this.projectId = projectId;
    }

    public String getProjectName() {
        return projectName;
    }

    public void setProjectName(String projectName) {
        this.projectName = projectName;
    }

    public int getProjectLimit() {
        return projectLimit;
    }

    public void setProjectLimit(int projectLimit) {
        this.projectLimit = projectLimit;
    }
}

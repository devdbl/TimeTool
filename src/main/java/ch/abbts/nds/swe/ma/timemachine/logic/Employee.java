package ch.abbts.nds.swe.ma.timemachine.logic;

import javax.persistence.*;

@Entity
@Table(name = "personal")
public class Employee {
    @Id
    @Column(name = "PERSONAL_ID")
    private int personalId;
    @Column(name = "FIRSTNAME")
    private String firstName;
    @Column(name = "LASTNAME")
    private String lastName;
    @Column(name = "SHORTNAME")
    private String shortName;
    @Column(name = "ROLE")
    private int role;

    public Employee() {
    }

    public int getPersonalId() {
        return personalId;
    }

    public void setPersonalId(int personalId) {
        this.personalId = personalId;
    }

    public String getFirstName() {
        return firstName;
    }

    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public String getShortName() {
        return shortName;
    }

    public void setShortName(String shortName) {
        this.shortName = shortName;
    }

    public int getRole() {
        return role;
    }

    public void setRole(int role) {
        this.role = role;
    }
}
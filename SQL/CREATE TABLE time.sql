CREATE TABLE IF NOT EXISTS `timetool`.`time` ( 
    `ID` INT NOT NULL AUTO_INCREMENT,
    `PROJECT_ID` DOUBLE NOT NULL,
    `EMPLOYEE_ID` INT NOT NULL,
    `TIME` VARCHAR(45) NOT NULL,
    `WEEK` VARCHAR(45) NOT NULL,
    `EDIT` DATETIME NOT NULL,
    `COMMENT` VARCHAR(255) NULL,
    PRIMARY KEY (`ID`),
        CONSTRAINT `fk_time_personal`
            FOREIGN KEY (`EMPLOYEE_ID`)
            REFERENCES `timetool`.`employee` (`EMPLOYEE_ID`) 
            ON DELETE NO ACTION 
            ON UPDATE NO ACTION,
        CONSTRAINT `fk_time_project`
            FOREIGN KEY (`PROJECT_ID`)
            REFERENCES `timetool`.`project` (`PROJECT_ID`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION) 
ENGINE = InnoDB
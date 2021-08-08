$sql = "CREATE TABLE IF NOT EXISTS `timetool`.`time` (\n"

    . "  `ID` INT NOT NULL AUTO_INCREMENT,\n"

    . "  `PROJECT_ID` DOUBLE NOT NULL,\n"

    . "  `EMPLOYEE_ID` INT NOT NULL,\n"

    . "  `TIME` VARCHAR(45) NOT NULL,\n"

    . "  `WEEK` VARCHAR(45) NOT NULL,\n"

    . "  `EDIT` DATETIME NOT NULL,\n"

    . "  `COMMENT` VARCHAR(255) NULL,\n"

    . "  PRIMARY KEY (`ID`),\n"

    . "  CONSTRAINT `fk_time_personal`\n"

    . "    FOREIGN KEY (`EMPLOYEE_ID`)\n"

    . "    REFERENCES `timetool`.`employee` (`EMPLOYEE_ID`)\n"

    . "    ON DELETE NO ACTION\n"

    . "    ON UPDATE NO ACTION,\n"

    . "  CONSTRAINT `fk_time_project`\n"

    . "    FOREIGN KEY (`PROJECT_ID`)\n"

    . "    REFERENCES `timetool`.`project` (`PROJECT_ID`)\n"

    . "    ON DELETE NO ACTION\n"

    . "    ON UPDATE NO ACTION)\n"

    . "ENGINE = InnoDB";
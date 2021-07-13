package ch.abbts.nds.swe.ma.timemachine.controller;


import ch.abbts.nds.swe.ma.timemachine.logic.TimeReport;
import ch.abbts.nds.swe.ma.timemachine.logic.TimeReportRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.List;

@RestController
@RequestMapping(path = "/report")
public class TimeController {
    @Autowired
    private TimeReportRepo timeReportRepository;
    @Autowired
    private JdbcTemplate jdbcTemplate;

    @GetMapping(path = "/project")
    public @ResponseBody TimeReport getReportByProject(@RequestParam double projectId){
        List<TimeReport> reports = new ArrayList<>();
        timeReportRepository.findById(projectId);
        return null;

    }
}

<?php
    $ProjectId = (isset($_POST["ProjectID"])&& is_numeric($_POST["ProjectID"])) ? $_POST["ProjectID"] : "";
    $ProjectName = (isset($_POST["ProjectName"])&& is_numeric($_POST["ProjectName"])) ? $_POST["ProjectName"] : "";
    $ProjectDescription = (isset($_POST["ProjectDescription"])&& is_numeric($_POST["ProjectDescription"])) ? $_POST["ProjectDescription"] : "";
    $ProjectName = htmlspecialchars($ProjectName);
    $ProjectDescription = htmlspecialchars($ProjectDescription);

    echo "<b> ProjektID:</b> $ProjectId<br/>";
    echo "<b> ProjectName:</b> $ProjectName<br/>";
    echo "<b> ProjectDescription:</b> $ProjectDescription<br/>";
    ?>
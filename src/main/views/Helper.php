<?php

class Helper
{
    public static function getHeader($title, $scripts = "")
    {
        $header =   '<!DOCTYPE html>
                    <html lang="de">
                    
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link href="./CSS/layout.css" type="text/css" rel="stylesheet" />
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
                        '.$scripts.'
                        <title>' . $title . '</title>
                    </head>
                    <body>
                   ';

        return $header;
    }

    public static function getNavbar(){
        $navbar = '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                            <ul class="navbar-nav">
                                
                                </li>
                    
                                <span class="navbar-text">
                                   <h3>Project Time Tool</h3>
                                   <time></time>
                                  </span>
                    </nav>       
                    <!--Bild einzufügen-->
                    <div class="logo">
                        <img src="./resources/Kernkraftwer_Goesgen_Daeniken_AG.jpg" alt="Firmen Logo" class="img-fluid" width="300" >
                    </div>';
        return $navbar;
    }

    public static function getSidebar($isAdmin){
        $sidebar = '<!-- The sidebar -->
                     <div class="sidebar">
                        <a href="zeiterfassung.php"><i class="fa fa-fw fa-clock"></i> Zeiterfassung</a>
                        <a href="mitarbeiterverwaltung_bearbeiten.php"><i class="fa fa-fw fa-user"></i> Mitarbeiter Verwaltung</a>';
        if($isAdmin == 1) {
            $sidebar .= '<a href="projektverwaltung_startpage.php"><i class="fa fa-fw fa-file-export"></i> Projekt Verwaltung</a>';
        }
        $sidebar .=    '<a href="reporterstellen_startpage.php"><i class="fa fa-fw fa-wrench"></i> Report Erstellen</a>
                        <br><br><br><br><br><br><br><br>
                        <a href="logout.php"><i class="far fa-caret-square-left"></i></i> LOGOUT</a>
                     </div>';
        return $sidebar;
    }

    public static function getFooter(){
        $footer = '<div class="footer">
                        <p></Footer></p>
                   </div>
        
                   </body>
                   </html>';
        return $footer;
    }

    public static function sessionChecker($_Session){
        echo "Hello from Session Checker";
        /*
        if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']){
        session_unset();
        session_destroy();
        setcookie(session_name(),"invalid",0,"/");
        }
        */
    }

}
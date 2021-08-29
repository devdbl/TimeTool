<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="layout.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Project Time Tool Neues Projekt</title>
</head>

<body>
    



 <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <ul class="navbar-nav">
            
            </li>

            <span class="navbar-text">
               <h3>Project Time Tool</h3>
               <time></time>
              </span>


    </nav>



 <!-- Load an icon library -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

 <!-- The sidebar -->
 <div class="sidebar">
    <a href="zeiterfassung_startpage.php"><i class="fa fa-fw fa-clock"></i> Zeiterfassung</a>
    <a href="projektverwaltung_startpage.php"><i class="fa fa-fw fa-wrench"></i> Projekt Verwaltung</a>
    <a href="mitarbeiterverwaltung_startpage.php"><i class="fa fa-fw fa-user"></i> Mitarbeiter Verwaltung</a>
    <a href="reporterstellen_startpage.php"><i class="fa fa-fw fa-file-export"></i> Report Erstellen</a><p></p>
 
    <a href="projektverwaltung_neu.php"><i class="far fa-caret-square-left"></i></i> Zurück</a>
  </div> 


<!-- versuch Bild einzufügen-->
<div class="logo">
<img src="../../frontend/Kernkraftwer_Goesgen_Daeniken_AG.jpg" alt="Firmen Logo" class="img-fluid" width="300" >
</div>

 

<form>
    <div class="inhalt">
        <h1>Bitte erfassen sie ein neues Projekt</h4><p></p>
            <div class="form-group">
                <label for="usr">Projektname:</label>
                <input type="text" class="form-control" id="usr">
              </div>
              <div class="form-group">
                <label for="pwd">Projekt ID:</label>
                <input type="text" class="form-control" id="pwd">
              </div>
              <div class="form-group">
                <label for="pwd">Beschreibung:</label>
                <input type="text" class="form-control" id="pwd">
              </div>
              <input type="submit" class="btn btn-info" value="Speichern">
        </form>



<div class="footer">
<p></Footer></p>
</div>

</body>

</html>
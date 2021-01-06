<?php

/**
 *  Index page with async load
 *  @author Maxelweb (marianosciacco.it)
*/

 require_once 'res/config.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CovItaly, grafici e dati sulla diffusione del virus covid-19 in italia. I dati sono presi direttamente dal Dipartimento di Protezione Civile Italiano.">
  <link rel="icon" href="res/images/italy.png">
  <meta name="author" content="Mariano Sciacco">
  <title>CovItaly - Covid 19 Italy</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="res/css/covitaly.css?v=1.3.1">
  <!-- Icono icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top cov-navbar">
    <div class="container">
      <a class="navbar-brand" href="./">
        <img src="res/images/italy.png" width="32" height="32" class="mr-2" alt="">
        Cov<strong>Italy</strong> &nbsp;
        <?=(isset($name) && in_array($name, $_data) ? "<span class='text-danger small font-weight-bold d-none d-sm-inline'>".nameFormat($name)."</span>" : "")?>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-chart-bar"></i> Grafici e dati
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
              foreach($_data as $type)
               echo "<a class='dropdown-item' href='$type'><i class='far fa-dot-circle'></i> ".ucfirst(str_replace('_', ' ', $type))."</a>";
            ?>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownStatus" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-globe-americas"></i> Status Regioni
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownStatus">              
              <a class='dropdown-item' href='<?=DATA_GOV_ZONES_FAQ;?>'><i class='fas fa-info-circle'></i> Domande e risposte Covid-19</a>
              <a class='dropdown-item' href='http://www.salute.gov.it/portale/nuovocoronavirus/archivioNormativaNuovoCoronavirus.jsp?lingua=italiano'><i class='fas fa-gavel'></i> Archivio decreti Covid-19</a>
              <div class="dropdown-divider"></div>
              <a class='dropdown-item' href='https://1dotd4.github.io/covid/'><i class='fas fa-link'></i> Aggiornamenti e grafici aggiuntivi</a>            
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownData" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-database"></i> API e dati
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownData">
              <a class='dropdown-item' href='https://api.covitaly.it'><i class='fas fa-code'></i> API REST (api.covitaly.it)</a>
              <a class='dropdown-item' href='https://github.com/pcm-dpc/COVID-19' target="_blank"><i class='fas fa-link'></i> Dati DPC (ufficiali)</a>
              <div class="dropdown-divider"></div>
              <a class='dropdown-item' href='<?=REPO;?>'><i class='fab fa-github'></i> CovItaly su Github</a> 
              <a class='dropdown-item' href='https://github.com/Maxelweb/covitaly-api'><i class='fab fa-github'></i> API REST su Github</a> 
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" style="margin-top: 100px" id="loading">
    <p class="text-center text-light my-4"><i class="fas fa-circle-notch fa-spin"></i> Caricamento...</p>
  </div>

  <div class="container text-secondary text-center my-4 small cov-footer">
    <a class="text-success" href='<?=REPO;?>'>Covid19 - Italy v<?=VERSION;?></a> <i class="mx-1 fas fa-code"></i> by <a href="https://marianosciacco.it" class="text-light">Mariano Sciacco</a> <br>
    Questo è un sito <strong>NON</strong> ufficiale. I dati sono forniti da parte del <a class="text-danger" href="https://github.com/pcm-dpc/COVID-19" target="_blank">Dipartimento della Protezione Civile.</a>
  </div>


  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script>
    var currentPage = '<?=$name;?>';

    function loadWorkflow(){
        var Cont = $("#loading");
        $.ajax({
            url: "res/switch.php?name="+currentPage, 
            error: function () {
              Cont.html("<p class='text-danger my-4 text-center'><i class='fas fa-times-circle'></i> La pagina non può essere caricata. Ricarica la pagina.</p>");
            },
            success: function(result) {
                Cont.html(result);
            }
        });
    }


    $(document).ready(function() {
      loadWorkflow();
    });

  </script>

</body>

</html>

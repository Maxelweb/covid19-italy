<?php

/**
 *  Index page with async load
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.0
 */

 require_once 'res/config.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Workflow tracker for the working Github repository">
  <link rel="icon" href="res/images/italy.png">
  <meta name="author" content="Maxelweb">
  <title>Covid 19 - Italy</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Icono icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="./">
        <img src="res/images/italy.png" width="32" height="32" alt="">
      Covid-19 - Italia</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-chart-bar"></i> Grafici
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#"><i class="far fa-dot-circle"></i> </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://github.com/pcm-dpc/COVID-19" target="_blank"><i class="fas fa-sync-alt"></i> Dati DPC</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" id="loading">
    <p class="text-center my-4"><i class="fas fa-circle-notch fa-spin"></i> Caricamento...</p>
  </div>

  <div class="container text-secondary text-center my-4 small">
    <a class="text-info" href='<?=REPO;?>'>Covid-19 - Italy <?=VERSION;?></a> <i class="mx-1 fas fa-code"></i> by Mariano Sciacco
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

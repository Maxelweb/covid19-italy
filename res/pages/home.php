<?php

/**
 *  Homepage
 *  @author Maxelweb (marianosciacco.it)
*/

require_once("data_home.php");
require_once("data_regions.php");

?>

<div class="row my-3">
    <div class="col-lg-6 my-3 mx-auto">

		<div class="card bg-light">
	        <div class="card-body">
				<h2 class="my-3"><i class="fas fa-chart-bar"></i> Dati disponibili</h2>

				<p>Clicca su uno dei seguenti link per visualizzare i grafici relativi.</p>

				<div class="list-group cov-list">
					<a href='vaccini' class='list-group-item d-flex justify-content-between align-items-center list-group-item-action cov-list-vax'>
						<span> &rarr; Vaccini</span>
						<span class='badge badge-light badge-pill'><img src="res/images/vax.png" class="cov-vax-icon"> NEW</span>
					</a>
				<?php
					foreach($_data as $type)
					{
						$val = !empty($data) ? nformat($data[0][$type]) : '<i class="fas fa-circle-notch fa-spin"></i>';
						$specialPos = $type == "nuovi_positivi" ? 'font-weight-bold' : '';

						echo "<a href='$type' class='$specialPos list-group-item d-flex justify-content-between align-items-center list-group-item-action '>
						&rarr; ".ucfirst(str_replace('_', ' ', $type))."
						 <span class='badge badge-dark badge-pill'>".$val."</span></a>";
					}
				?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 my-3">
		<div class="card bg-light">
	        <div class="card-body">
				<h2 class="my-3"><i class="fas fa-globe"></i> Status zone nelle regioni</h2>
			
				<p>La seguente mappa è disponibile nel dettaglio nel <a class="underlined" href="<?=DATA_GOV_ZONES_FAQ;?>">sito del governo</a>.
				<br><br>
				<div id="loading-govmap">
				    <p class="text-center text-muted my-4"><i class="fas fa-circle-notch fa-spin"></i> Caricamento...</p>
				</div>	
			</div>
			<div class="card-footer text-muted small">
	     	 <i class="fas fa-history"></i> <strong>Fonte:</strong> www.governo.it, aggiornata in tempo reale dallo stesso sito</strong>
	    	</div>
		</div>
	</div>
</div>

<?php

if(empty($data))
	outputErrorLoading();
else { 

	$latest = $data[0];

?>

<div class="row my-3">
	<div class="col-lg-12 my-3 mx-auto">  
	  <div class="card">
	    <div class="card-header"><i class="fas fa-chart-bar"></i> Statistiche generali a oggi</div>
	    <div class="card-body">
	      <ul>
	        <li><strong>Totale attualmente positivi:</strong> <?=nformat($latest['totale_positivi']);?></li>
	        <li><strong>Variazione totale positivi:</strong> <?=nformat($latest['variazione_totale_positivi'])?></li>
	        <li><strong>Totale casi:</strong> <?=nformat($latest['totale_casi'])?></li>
	        <li><strong>Totale tamponi:</strong> <?=nformat($latest['tamponi'])?></li>
	        <li><strong>Totale dimessi guariti:</strong> <?=nformat($latest['dimessi_guariti'])?></li>
	        <li><strong>Totale deceduti:</strong> <?=nformat($latest['deceduti'])?></li>
	      </ul>
	    </div>
	    <div class="card-footer text-muted small">
	      <i class="fas fa-history"></i> Ultimo aggiornamento dati: <strong><?=str_replace('T', ' ', $latest['data']);?></strong>
	    </div>
	  </div>
	</div>
</div>

<?php } ?>


<div class="row my-3">
    <div class="col-lg-12 my-3 mx-auto">  
      <div class="card card-info">
        <div class="card-header"><i class="fas fa-history"></i> Aggiornamenti di covitaly.it</div>
        <div class="card-body">
        	<div class="alert alert-info"><i class='fas fa-code'></i> Sono state aggiunte delle <a class='underlined' href='https://api.covitaly.it'>API REST</a> per il reperimento di alcuni dati relativi allo status delle regioni. Maggiori informazioni sono disponibili sulla <a class="underlined" href="https://github.com/Maxelweb/covitaly-api">repository Github</a>.</div>
          <ul>
          	<li>v1.3.2 (7 gennaio 2021) - Aggiunte le statistiche sui vaccini</li>
          	<li>v1.3.1 (6 gennaio 2021) - Aggiornato il tema del sito, aggiunti link sul menù superiore</li>
          	<li>v1.3 (26 dicembre 2020) - Aggiornata l'estetica del sito, aggiunta mappa delle zone, aggiunta mappa di distribuzione</li>
          	<li>v1.2 (05 novembre 2020) - Aggiornamento dei grafici e dell'estetica del sito</li>
          	<li>v1.1 (17 aprile 2020) - Aggiornamento formato dati</li>
            <li>v1.0 (13 marzo 2020) - Rilascio iniziale</li>
          </ul>
        </div>
      </div>
    </div>
</div>


<script>

    function loadGovMap(){
        var Cont = $("#loading-govmap");
        $.ajax({
            url: "res/extdata_govmap.php", 
            error: function () {
              Cont.html("<p class='text-danger my-4 text-center'><i class='fas fa-times-circle'></i> La mappa non è disponibile.</p>");
            },
            success: function(result) {
                Cont.html(result);
            }
        });
    }

    $("#abruzzo").tooltip({
    'container': 'body',
    'placement': 'bottom'
});


    $(document).ready(function() {
      loadGovMap();
    });

  </script>
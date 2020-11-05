<?php

/**
 *  Homepage
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.2
 */

require_once("data_home.php");

?>

 <div class="row my-3">
    <div class="col-lg-12 my-3 mx-auto">

		<div class="card bg-light">
	        <div class="card-body">
				<h2 class="my-3"><i class="fas fa-chart-bar"></i> Grafici disponibili</h2>

				<p>Clicca su uno dei seguenti link per visualizzare i grafici relativi.</p>

				<ul>
				<?php
					foreach($_data as $type)
					{
						if($type == "nuovi_positivi")
							echo "<li><a href='$type' class='text-danger font-weight-bold'>".ucfirst(str_replace('_', ' ', $type))."</a></li>";
						else
							echo "<li><a href='$type' class='text-danger'>".ucfirst(str_replace('_', ' ', $type))."</a></li>";
					}
				?>
				</ul>
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
      <div class="card">
        <div class="card-header"><i class="fas fa-history"></i> Aggiornamenti sito</div>
        <div class="card-body">
          <ul>
          	<li>v1.2 (05 novembre 2020) - Aggiornamento dei grafici e dell'estetica del sito</li>
          	<li>v1.1 (17 aprile 2020) - Aggiornamento formato dati</li>
            <li>v1.0 (13 marzo 2020) - Rilascio iniziale</li>
          </ul>
        </div>
      </div>
    </div>
</div>
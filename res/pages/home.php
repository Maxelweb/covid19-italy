<?php

/**
 *  Homepage
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.1
 */

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
						echo "<li><a href='$type' class='text-info'>".ucfirst(str_replace('_', ' ', $type))."</a></li>";
					}
				?>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="row my-3">
    <div class="col-lg-12 my-3 mx-auto">  
      <div class="card">
        <div class="card-header"><i class="fas fa-history"></i> Aggiornamenti sito</div>
        <div class="card-body">
          <ul>
          	<li>v1.1 (17 aprile 2020) - Aggiornamento formato dati</li>
            <li>v1.0 (13 marzo 2020) - Rilascio iniziale</li>
          </ul>
        </div>
      </div>
    </div>
</div>
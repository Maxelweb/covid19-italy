<?php

/**
 *  Homepage
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.0
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
						echo "<li><a href='$type'>".ucfirst(str_replace('_', ' ', $type))."</li>";
					}
				?>
				</ul>
			</div>
		</div>
	</div>
</div>
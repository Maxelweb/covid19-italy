<?php

/**
 *  Vax info per regions
 *  @author Maxelweb (marianosciacco.it)
*/


require_once("data_vax.php");


if(empty($data_vax))
  outputErrorLoading();
else
{ 

  $data_vax = $data_vax["data"];
  $formatname = nameFormat($name);

  usort($data_vax, function ($a, $b) {
      global $name;
      return $a["percentuale_somministrazione"] < $b["percentuale_somministrazione"];
  });

  $dosi_cons = 0;
  $dosi_somm = 0;

    foreach ($data_vax as $elem) {
      $rows .= '<tr>
              <td>'.nameFormat($_data_regions_vax[$elem["area"]]).' <small class="text-muted">('.$elem["area"].')</small></td>
              <td>'.nformat($elem["dosi_somministrate"]).'</td>
              <td>'.nformat($elem["dosi_consegnate"]).'</td>
              <td><em>'.number_format($elem["percentuale_somministrazione"], 1, ',', '.').'%</em></td>
            </tr>';
      $dosi_somm += $elem["dosi_somministrate"];
      $dosi_cons += $elem["dosi_consegnate"];
    }

?>
  
  <center><img src="res/images/vax.png" alt="logo vaccino" class="cov-vax"></center>

  <h3 class="text-center text-light my-4" id="distribuzione">Distribuzione dei Vaccini <a class="text-muted small" href="#distribuzione"><i class="fas fa-link"></i></a></h3>
  <h4 class="text-center text-danger mb-4">
    <?=$formatname;?> &nbsp; 
    <small class="text-muted">
      <i class="fas fa-history"></i> 
      <?=lastUpdate($data_vax[0]['ultimo_aggiornamento']);?>
    </small>
  </h4>
  
  <div class="row my-3">
    <div class="col-lg-4 my-3">  
      <div class="card">
        <div class="card-header"><i class="fas fa-globe"></i> Distribuzione dei Vaccini in Italia</div>
        <div class="card-body">
          <?=$_distribution_image;?>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento: <strong><?=explode('T', $data_vax[0]['ultimo_aggiornamento'])[0];?></strong>
        </div>
      </div>
    </div>
    <div class="col-lg-8 my-3">  
      <div class="card">
        <div class="card-header"><i class="fas fa-chart-area"></i> Distribuzione dei Vaccini per regioni</div>
        <div class="card-body">
          <p>I dati sono ordinati in modo discendente sulla base della percentuale di somministrazione.</p>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <tr>
                <th width="200px"></th>
                <th>Dosi somministrate</th>
                <th>Dosi consegnate</th>
                <th>Percentuale somm.</th>
              </tr>
              <tr class="bg-danger text-light strong">
                <td><strong>Totale <?=$formatname;?>:</strong></td>
                <td><strong><?=nformat($dosi_somm);?></strong></td>
                <td><strong><?=nformat($dosi_cons);?></strong></td>
                <td><em><strong><?=number_format(($dosi_somm/$dosi_cons)*100, 1, ',', '.');?>%</strong></em></td>
              </tr>
            </table>
          </div>
          <div class="table-responsive">  
            <table class="table table-striped table-bordered">
              <tr>
                <th width="200px">Regione</th>
                <th>Dosi somministrate</th>
                <th>Dosi consegnate</th>
                <th>Percentuale somm.</th>
              </tr>
              <?php 
                echo $rows;
              ?>
            </table>
          </div>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento dati: <strong><?=explode('T', $data_vax[0]['ultimo_aggiornamento'])[0];?></strong>
        </div>
      </div>
    </div>
  </div>

<?php 

  $pa = 0;
  echo "<style>";
  foreach ($data_vax as $elem) {
    $fixName = $_data_regions_vax[$elem['area']];

    if($fixName == "PAB" || $fixName == "PAT") { 
      $pa += $elem["percentuale_somministrazione"];
      continue;
    }
      echo '#'.strtolower($fixName) . ' { fill: ' . getColor($elem["percentuale_somministrazione"]/260) . ' } ';    
  } 
  echo '#trentino { fill: ' . getColor(number_format($pa/2, 2)) . ' } ';    
  echo "</style>";

 ?>

<?php

}

?>
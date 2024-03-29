<?php

/**
 *  Data info per regions
 *  @author Maxelweb (marianosciacco.it)
*/


require_once("data_regions.php");


if(empty($data_regions) || empty($data_global_latest)  || !in_array($name, $_data))
  outputErrorLoading();
else
{ 

  $formatname = nameFormat($name);
  $current_name_value = $data_global_latest[0][$name]; 

  usort($data_regions, function ($a, $b) {
      global $name;
      return $a[$name] < $b[$name];
  });

?>
  <h3 class="text-center text-light mt-5 mb-4" id="distribuzione">Distribuzione del dato <a class="text-muted small" href="#distribuzione"><i class="fas fa-link"></i></a></h3>
  <h4 class="text-center text-danger mb-4">
    <?=$formatname;?> &nbsp; 
    <small class="text-muted">
      <i class="fas fa-history"></i> 
      <?=lastUpdate($latest['data']);?>
    </small>
  </h4>
  
  <div class="row my-3">
    <div class="col-lg-8 my-3">  
      <div class="card">
        <div class="card-header"><i class="fas fa-chart-area"></i> Distribuzione del dato per regioni</div>
        <div class="card-body">
          <p>I dati sono ordinati in modo discendente sulla base del dato preso in esame (<?=$formatname;?>).</p>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <tr>
                <th width="300px">Regione</th>
                <th>Dato</th>
                <th>Percentuale</th>
                <th>Note generali</th>
              </tr>
              <?php 
                foreach ($data_regions as $elem) {
                  echo '<tr>
                          <td>'.$elem["denominazione_regione"].'</td>
                          <td>'.nformat($elem[$name]).'</td>
                          <td>'.number_format((($elem[$name]/$current_name_value)*100), 2, ',', '.').'%</td>
                          <td><small>'.(empty($elem["note"]) ? "-" : $elem["note"]).'</small></td>
                        </tr>';
                }
              ?>
              <tr class="bg-secondary text-light strong">
                <td><strong>Totale <?=$formatname;?>:</strong></td>
                <td><strong><?=number_format($current_name_value, 0, "," , ".");?></strong></td>
                <td><strong>100%</strong></td>
                <td></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento dati: <strong><?=str_replace('T', ' ', $latest['data']);?></strong>
        </div>
      </div>
    </div>
    <div class="col-lg-4 my-3">  
      <div class="card">
        <div class="card-header"><i class="fas fa-globe"></i> Distribuzione del dato in Italia</div>
        <div class="card-body">
          <?=$_distribution_image;?>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento: <strong><?=str_replace('T', ' ', $latest['data']);?></strong>
        </div>
      </div>
    </div>
  </div>

<?php 

  $pa = 0;
  echo "<style>";
  foreach ($data_regions as $elem) {
    $fixName = explode(' ', $elem['denominazione_regione']);

    if($fixName == "P.A.") { 
      $pa += $elem[$name];
      continue;
    }
      echo '#'.strtolower($fixName[0]) . ' { fill: ' . getColor(number_format($elem[$name]/$current_name_value, 2)) . ' } ';    
  } 
  echo '#trentino { fill: ' . getColor(number_format($pa/$current_name_value, 2)) . ' } ';    
  echo "</style>";

 ?>

<?php

}

?>
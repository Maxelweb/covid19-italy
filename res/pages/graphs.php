<?php

/**
 *  Graph setup page
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.2
 */


require_once("data_graphs.php");


if(empty($data) || !in_array($name, $_data))
  outputErrorLoading();
else
{ 

  $latest = $data[count($data)-1];
  $formatname = nameFormat($name);
  
?>
        
  <h3 class="text-center text-secondary mt-5 mb-4">Dati statistici COVID-19 - Italia</h3>
  <h4 class="text-center text-danger mb-4"><?=$formatname;?></h4>

  <div class="row my-3">
     <div class="col-lg-6 my-3">  
      <div class="card">
        <div class="card-header"><i class="fas fa-poll"></i> Trend</div>
        <div class="card-body">
          <?php
            $media = ($latest[$name] - $data[count($data)-2][$name]);

            echo '<div class="trend-number">'.nformat($latest[$name]).' <span>('.($media>0?'+':'').(nformat($media)).')</span></div>';

            $today = date("d", strtotime($latest['data'])) == date("d") ? "oggi" : "ieri";
           
            if(($latest[$name] - $data[count($data)-2][$name]) > 0)
              echo "<div class='text-danger my-3'><i class='fas fa-arrow-alt-circle-up'></i> L'ultimo trend registrato ($today) è in <strong>aumento</strong>.</div>";
            else
              echo "<div class='text-success my-3'><i class='fas fa-arrow-alt-circle-down'></i> L'ultimo trend registrato ($today) è in <strong>diminuzione</strong></div>";

            echo '<hr class="my-3">';

            if(($media = calcTrend($data, $name, 7)) > 0)
              echo "<div class='text-danger my-3'><i class='fas fa-arrow-alt-circle-up'></i> Il trend dell'ultima settimana è in <strong>aumento</strong> (media: $media)</div>";
            else
              echo "<div class='text-success my-3'><i class='fas fa-arrow-alt-circle-down'></i> Il trend dell'ultima settimana è in <strong>diminuzione</strong> (media: $media)</div>";

            if(($media = calcTrend($data, $name, 15)) > 0)
              echo "<div class='text-danger my-3'><i class='fas fa-arrow-alt-circle-up'></i> Il trend degli ultimi 15 giorni è in <strong>aumento</strong> (media: $media)</div>";
            else
              echo "<div class='text-success my-3'><i class='fas fa-arrow-alt-circle-down'></i> Il trend degli ultimi 15 giorni è in <strong>diminuzione</strong> (media: $media)</div>";

            if(($media = calcTrend($data, $name, 30)) > 0)
              echo "<div class='text-danger my-3'><i class='fas fa-arrow-alt-circle-up'></i> Il trend degli ultimi 30 giorni è in <strong>aumento</strong> (media: $media)</div>";
            else
              echo "<div class='text-success my-3'><i class='fas fa-arrow-alt-circle-down'></i> Il trend degli ultimi 30 giorni è in <strong>diminuzione</strong> (media: $media)</div>";

            if(($media = calcTrend($data, $name, 60)) > 0)
              echo "<div class='text-danger my-3'><i class='fas fa-arrow-alt-circle-up'></i> Il trend degli ultimi 60 giorni è in <strong>aumento</strong> (media: $media)</div>";
            else
              echo "<div class='text-success my-3'><i class='fas fa-arrow-alt-circle-down'></i> Il trend degli ultimi 60 giorni è in <strong>diminuzione</strong> (media: $media)</div>";

          ?>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento: <strong><?=str_replace('T', ' ', $latest['data']);?></strong>
        </div>
      </div>
    </div>
    <div class="col-lg-6 my-3">  
      <div class="card">
        <div class="card-header"><i class="fas fa-globe"></i> Distribuzione del dato per regioni</div>
        <div class="card-body">
          <?=$_distribution_image;?>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento: <strong><?=str_replace('T', ' ', $latest['data']);?></strong>
        </div>
      </div>
    </div>
  </div>

  <div class="row my-3">
     <div class="col-lg-12 my-3 mx-auto">  
      <div class="card">
        <div class="card-header"><i class="fas fa-chart-line"></i> Grafico andamento e varianza</div>
        <div class="card-body">
          <h4 class="text-center">Andamento del dato</h4>
          <div id="grafico_main"></div>
          <hr>
          <h4 class="text-center">Varianza percentuale <br> <small>(rispetto al giorno precedente)</small></h4>
          <div id="grafico_var"></div>
          <hr>
          <h4 class="text-center">Incremento o decremento giornaliero</h4>
          <div id="grafico_increment"></div>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento grafici: <strong><?=str_replace('T', ' ', $latest['data']);?></strong>
        </div>
      </div>
    </div>
  </div>

  <?php if($name == "nuovi_positivi"){ ?>

  <div class="row my-3">
     <div class="col-lg-12 my-3 mx-auto">  
      <div class="card">
        <div class="card-header"><i class="fas fa-heartbeat"></i> Rapporto nuovi positivi e tamponi effettuati</div>
        <div class="card-body">
          <div id="grafico_rapporto"></div>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento grafici: <strong><?=str_replace('T', ' ', $latest['data']);?></strong>
        </div>
      </div>
    </div>
  </div>

  <?php } ?>


<script>

// Resize

$(window).resize(function(){
  drawCurveTypesMain();
  drawCurveTypesVariance();
  drawCurveTypesIncrement();
  <?php if($name == "nuovi_positivi") { echo "drawCurveTypesRapportoPositiviTamponi();"; } ?>
});


// Dati

google.charts.load('current', {packages: ['corechart', 'line'], language: 'it'});
google.charts.setOnLoadCallback(drawCurveTypesMain);

google.charts.load('current', {packages: ['corechart', 'line'], language: 'it'});
google.charts.setOnLoadCallback(drawCurveTypesVariance);

google.charts.load('current', {packages: ['corechart', 'line'], language: 'it'});
google.charts.setOnLoadCallback(drawCurveTypesIncrement);

<?php if($name == "nuovi_positivi") { ?>

google.charts.load('current', {packages: ['corechart', 'line'], language: 'it'});
google.charts.setOnLoadCallback(drawCurveTypesRapportoPositiviTamponi);

<?php } ?>

function drawCurveTypesMain() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Data');
  data.addColumn('number', '<?=$formatname;?>');
  data.addColumn({ type: 'number', role: 'annotation' });

  data.addRows([ 
    <?php 
      $i = 0;
      foreach(array_slice($data,-10,10) as $elem)
      {
        $i++;
        echo "['".explode('T', $elem['data'])[0]."',".$elem[$name].",".$elem[$name]."]";
        if($i != count($data)) echo ", ";
      }
    ?>
  ]);

  var options = {
    hAxis: {
      title: 'Tempo'
    },
    vAxis: {
      title: 'Numero di persone'
    },
    series: {
      1: {curveType: 'function'}
    },
    height: 400,
    pointSize: 4,
  };

  var chart = new google.visualization.LineChart(document.getElementById('grafico_main'));
  chart.draw(data, options);
}


// Varianza

function drawCurveTypesVariance() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Data');
  data.addColumn('number', 'Varianza %');
  data.addColumn({ type: 'number', role: 'annotation' });

  data.addRows([ 
    <?php 
      $x = array_slice($data,-11,11);
      for($i = 0; $i<count($x); $i++)
      {
        if($i == 0) 
          continue;
        else
          $var = number_format((($x[$i][$name] - $x[$i-1][$name]) / $x[$i-1][$name])*100, 2);

        echo "['".explode('T', $x[$i]['data'])[0]."',"
                .$var.","
                .$var."]";
        if($i != count($x)) echo ", ";
      }
    ?>
  ]);

  var options = {
    hAxis: {
      title: 'Tempo'
    },
    vAxis: {
      title: 'Varianza percentuale',
      format: '#\'%\''
    },
    series: {
      1: {curveType: 'function'}
    },
    colors:['#1c91c0'],
    height: 400,
    pointSize: 4,
  };

  var chart = new google.visualization.LineChart(document.getElementById('grafico_var'));
  chart.draw(data, options);
}


// Incremento / decremento

function drawCurveTypesIncrement() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Data');
  data.addColumn('number', '<?=$formatname;?>');
  data.addColumn({ type: 'number', role: 'annotation' });

  data.addRows([ 
     <?php 
      $x = array_slice($data,-11,11);
      for($i = 0; $i<count($x); $i++)
      {
        if($i == 0) 
          continue;
        else
          $var = $x[$i][$name] - $x[$i-1][$name];

        echo "['".explode('T', $x[$i]['data'])[0]."',"
                .$var.","
                .$var."]";
        if($i != count($x)) echo ", ";
      }
    ?>
  ]);

  var options = {
    hAxis: {
      title: 'Tempo'
    },
    vAxis: {
      title: 'Incremento persone'
    },
    series: {
      1: {curveType: 'function'}
    },
    colors:['#4d1cc0'],
    height: 400,
    pointSize: 4,
  };

  var chart = new google.visualization.LineChart(document.getElementById('grafico_increment'));
  chart.draw(data, options);
}


// Rapporto positivi / tamponi

function drawCurveTypesRapportoPositiviTamponi() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Data');
  data.addColumn('number', 'Rapporto positivi e tamponi');
  data.addColumn({ type: 'number', role: 'annotation' });

  data.addRows([ 
     <?php 
      $x = array_slice($data,-11,11);
      for($i = 0; $i<count($x); $i++)
      {
        if($i == 0) 
          continue;
        else
          $var = ($x[$i]['nuovi_positivi'])/($x[$i]['tamponi'] - $x[$i-1]['tamponi']);

        echo "['".explode('T', $x[$i]['data'])[0]."',"
                .$var.","
                .$var."]";
        if($i != count($x)) echo ", ";
      }
    ?>
  ]);

  var options = {
    hAxis: {
      title: 'Tempo'
    },
    vAxis: {
      title: 'Rapporto positivi e tamponi'
    },
    series: {
      1: {curveType: 'function'}
    },
    colors:['#c01c1c'],
    height: 400,
    pointSize: 4,
  };

  var chart = new google.visualization.LineChart(document.getElementById('grafico_rapporto'));
  chart.draw(data, options);
}

</script>

<?php

}

?>
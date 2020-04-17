<?php

/**
 *  Graph setup page
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.1
 */


require_once("data.php");


if(empty($data) || !in_array($name, $_data))
  echo "<p class='text-danger my-4 text-center'><i class='far fa-frown'></i> Non è stato possibile caricare i dati. Riprova più tardi.</p>";
else
{ 

$latest = $data[count($data)-1];
$formatname = ucfirst(str_replace("_", " ", $name));
  
?>
        
  <h3 class="text-center text-secondary mt-5 mb-4">Dati statistici COVID-19 - Italia</h3>
  <h4 class="text-center text-primary mb-4"><?=$formatname;?></h4>
  
  <div class="row my-3">
    <div class="col-lg-12 my-3 mx-auto">  
      <div class="card">
        <div class="card-header"><i class="fas fa-chart-bar"></i> Statistiche generali a oggi</div>
        <div class="card-body">
          <ul>
            <li><strong class="text-primary">Totale attualmente positivi:</strong> <?=nformat($latest['totale_positivi']);?></li>
            <li><strong class="text-info">Variazione totale positivi:</strong> <?=nformat($latest['variazione_totale_positivi'])?></li>
            <li><strong class="text-secondary">Totale casi:</strong> <?=nformat($latest['totale_casi'])?></li>
            <li><strong>Totale tamponi:</strong> <?=nformat($latest['tamponi'])?></li>
            <li><strong>Totale dimessi guariti:</strong> <?=nformat($latest['dimessi_guariti'])?></li>
            <li><strong class="text-danger">Totale deceduti:</strong> <?=nformat($latest['deceduti'])?></li>
          </ul>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento dati: <strong><?=str_replace('T', ' ', $latest['data']);?></strong>
        </div>
      </div>
    </div>
  </div>

  <div class="row my-3">
    
     <div class="col-lg-12 my-3 mx-auto">  
      <div class="card">
        <div class="card-header"><i class="fas fa-chart-line"></i> Grafico andamento e varianza</div>
        <div class="card-body">
          <h4 class="text-center text-primary mb-4"><?=$formatname;?></h4>
          <div id="grafico_main"></div>
          <div id="grafico_var"></div>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento grafici: <strong><?=$latest['data'];?></strong>
        </div>
      </div>
    </div>

  </div>


<script>

google.charts.load('current', {packages: ['corechart', 'line'], language: 'it'});
google.charts.setOnLoadCallback(drawCurveTypesMain);

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
        height: 500,
        pointSize: 4,
      };

      var chart = new google.visualization.LineChart(document.getElementById('grafico_main'));
      chart.draw(data, options);
    }

</script>

<script>

google.charts.load('current', {packages: ['corechart', 'line'], language: 'it'});
google.charts.setOnLoadCallback(drawCurveTypesVariance);

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
        height: 500,
        pointSize: 4,
      };

      var chart = new google.visualization.LineChart(document.getElementById('grafico_var'));
      chart.draw(data, options);
    }

</script>

<?php

}

?>
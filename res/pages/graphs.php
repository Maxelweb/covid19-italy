<?php

/**
 *  Workflow setup page
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.0
 */


require_once("data.php");


if(empty($data))
  echo "<p class='text-danger my-4 text-center'><i class='far fa-frown'></i> Non è stato possibile caricare i dati. Riprova più tardi.</p>";
else
{ 

$latest = $data[count($data)-1];
  
?>
        
  <h3 class="text-center text-secondary mt-5 mb-4">Dati statistici COVID-19 - Italia</h3>
  <h6 class="text-center text-muted small mb-4">Ultimo aggiornamento pagina: <strong><?=date("Y-m-d  H:i:s");?></strong></h6>
  
  <div class="row my-3">
    <div class="col-lg-12 my-3 mx-auto">  
      <div class="card">
        <div class="card-header"><i class="fas fa-charts-bar"></i> Statistiche generali</div>
        <div class="card-body">
          <ul>
            <li><strong>Totale attualmente positivi:</strong> <?=$latest['totale_attualmente_positivi']?></li>
            <li><strong>Totale casi:</strong> <?=$latest['totale_casi']?></li>
            <li><strong>Totale tamponi:</strong> <?=$latest['tamponi']?></li>
            <li><strong>Totale dimessi guariti:</strong> <?=$latest['dimessi_guariti']?></li>
            <li><strong>Totale deceduti:</strong> <?=$latest['deceduti']?></li>
          </ul>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento dati: <strong><?=$latest['data'];?></strong>
        </div>
      </div>
    </div>
  </div>

  <div class="row my-3">
    
     <div class="col-lg-12 my-3 mx-auto">  
      <div class="card">
        <div class="card-header"><i class="fas fa-charts-bar"></i> Grafico andamento e varianza</div>
        <div class="card-body">
          <div id="grafico_main"></div>
          <div id="grafico_var"></div>
        </div>
        <div class="card-footer text-muted small">
          <i class="fas fa-history"></i> Ultimo aggiornamento grafico: <strong><?=$latest['data'];?></strong>
        </div>
      </div>
    </div>

  </div>


<script>

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawCurveTypes);

function drawCurveTypes() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Data');
      data.addColumn('number', 'Nuovi positivi');
      data.addColumn({ type: 'number', role: 'annotation' });

      data.addRows([ 
        <?php 
          $i = 0;
          foreach(array_slice($data,-10,10) as $elem)
          {
            $i++;
            echo "['".explode(' ', $elem['data'])[0]."',".$elem['nuovi_attualmente_positivi'].",".$elem['nuovi_attualmente_positivi']."]";
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

google.charts.load('current', {packages: ['corechart', 'line']});
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
              $var = number_format((($x[$i]['nuovi_attualmente_positivi'] - $x[$i-1]['nuovi_attualmente_positivi']) / $x[$i-1]['nuovi_attualmente_positivi'])*100);

            echo "['".explode(' ', $x[$i]['data'])[0]."',"
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
          title: 'Varianza percentuale'
        },
        series: {
          1: {curveType: 'function'}
        },
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
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8' />
  <title>Statistici</title>
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
  </script>
  <style>
  #buton_back{
    position: absolute;
    top: 20px;
    right: 20px;
    width: 180px;
    padding: 10px;
    z-index: 100;
    border: 2px solid black;
    background-color: #90EE90;
  }
  </style>
</head>
<body>
<a href="pagina2statistici.php"><button id='buton_back'> Inapoi la harta</button> </a>
<?php
include 'config.php';
$sth = mysqli_query($conn, "SELECT * FROM judet_vaccinati");
$rows=array();
while($r = mysqli_fetch_assoc($sth)){
  $rows[]=$r;
}

?>

<div class="chartBox">
  <canvas id="myChart"></canvas>

</div>
<style>
body{


background: #222;

}

.statistici_vac{

position:relative;
top:-610px;
left:30px;
}

</style>
<div id="selectBox" class="selectBox">
  <select id="statistici_vac" class="statistici_vac">



  </select>
</div>
<script "https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var jsonStr= '<?php echo json_encode($rows) ?>';
var Vaccine = JSON.parse(jsonStr);
for(var i=0;i<Vaccine.length;i++){
  var john = escape(JSON.stringify(parseFloat(Vaccine[i].Vaccinati)));
  var john2 = escape(JSON.stringify(parseFloat(Vaccine[i].Nevaccinati)));
  var john3 = john+","+john2;
  console.log(john3);
  //console.log(john);
  //var judet = escape(JSON.stringify((Vaccine[i].Nume)));
  var judet = Vaccine[i].Nume;
  var x = document.getElementById("statistici_vac");
  var option = document.createElement("option");
  option.text = judet;
  option.value = john3;
   x.add(option);
}





const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['Vaccinati','Nevaccinati'],
    datasets:[{
      label: '# of Votes',
      data: [141411,232298],
      backgroundColor:[
        'rgba(13, 171, 13, 0.88)',
                'rgba(255, 0, 0, 45)'

              ],

      borderColor:[
                'rgba(13, 0, 0, 1)',
                'rgba(13, 0, 0, 1)'

              ],
              borderWidth: 1,
              showTooltip:false
    }]
  },
  options: {
        responsive: true,
        scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 60}]}},
        tooltips:{mode: 'index'},
        legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
  }
});

  const statistici_vac = document.getElementById('statistici_vac');
  statistici_vac.addEventListener('change', Grafice);
  function Grafice(){
    console.log(statistici_vac.value);
    myChart.data.datasets[0].data = statistici_vac.value.split(',');
    myChart.update();
  }
</script>
</body>
</html>

<?php
$host='localhost';
$user='root';
$pass='';
$db='login';
$mysqli= mysqli_connect($host,$user,$pass,$db);

$Nume = '';
$Locuitori = '';
$Vaccinati = '';
$Nevaccinati='';

$sql="SELECT * FROM `judet_vaccinati`";
$result = mysqli_query($mysqli,$sql);

while($row = mysqli_fetch_array($result)){

    $Nume = $Nume . '"'. $row['Nume'].'",';
    $Locuitori=$Locuitori . '"'. $row['Locuitori'].'",';
    $Vaccinati=$Vaccinati . '"'. $row['Vaccinati'].'",';
    $Nevaccinati=$Nevaccinati . '"'. $row['Nevaccinati'].'",';

}



 ?>

 <!DOCTYPE html>
<html>
   <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
     <title>Grafice</title>


     		<style type="text/css">
     			body{
     				font-family: Arial;
     			    margin: 80px 100px 10px 100px;
     			    padding: 0;
     			    color: white;
     			    text-align: center;
     			    background: #555652;
     			}

     			.container {
     				color: #E8E9EB;
     				background: #222;
     				border: #555652 1px solid;
     				padding: 10px;
     			}
     		</style>


   </head>

   <body>
     <div class="container">
       <canvas id="chart" style="width: 100%; height:60vh; background: #222; border: 1px solid #555652 ; margin-top:10px;"></canvas>

 <script>

     var ctx = document.getElementById("chart").getContext('2d');
     var myChart= new Chart(ctx, {
       type:'bar',
       data:{
         labels:[ "Alba","Arges","Arad","Bucuresti","Cluj","Constanta","Sibiu","Timis","Ilfov","Brasov","Prahova","Tulcea","Dolj","Valcea","Mures","Hunedoara","Salaj","Galati",
       "Gorj","Satu Mare","Bistrita-Nasaud","Iasi","Caras-Severin","Ialomita","Dambovita"],
         datasets:
         [{ label: "Persoane Vaccinate",
           data: [<?php echo $Vaccinati; ?>],
           backgroundColor: 'green',
          // borderColor: 'rgb(102, 255, 51)',
           showTooltip: false,
           borderColor: 3
         },
         {   label: "Persoane Nevaccinate ",
             data: [<?php echo $Nevaccinati; ?>],
             backgroundColor: 'red',
            // borderColor: 'rgb(255, 192, 203)',
             showTooltip:false,
             borderWidth:3

         }]
       },
       options: {
           scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 60}]}},
           tooltips:{mode: 'index'},
           legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
       }
     });

 </script>
<h3>Datele prezentate sunt valabile la data de 06.08.2021</h3>

   </body>

 </html>

<!DOCTYPE HTML>
<html>
<head>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<script>
//alert(myData);
//var myData = localStorage.values(2);

localStorage.removeItem( "Nevaccinati" ); // Clear the localStorage
var firstData = myData;
alert('firstData: ' + firstData);
window.onload = function () {
// addDummyData();

  var dataPoints = [];

//  if(window.localStorage) {
    dataPoints = JSON.parse(window.localStorage.getItem("dps"));
  //}
 
  var chart = new CanvasJS.Chart("chartContainer", {
    theme: "light1", // "light2", "dark1", "dark2"
    animationEnabled: false, // change to true
    title:{
      text: "Basic Column Chart"
    },
    data: [
      {
        // Change type to "bar", "area", "spline", "pie",etc.
        type: "column",
        dataPoints: dataPoints
      }
    ]
  });
  chart.render();

  function addDummyData(){
 if(window.localStorage && window.localStorage.getItem("dps") == null) {
     //creating dataPoints as no dataPoints are present in localStorage
     var dps = [
       { label: "apple",  y: 10  },
       { label: "orange", y: 15  },
       { label: "banana", y: 25  },
       { label: "mango",  y: 30  },
       { label: "grape",  y: 28  }
     ];
     window.localStorage.setItem("dps", JSON.stringify(dps));
   }
 }
}

</script>
</body>
</html>

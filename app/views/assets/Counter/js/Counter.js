
$(document).ready(function () {
  var ctx = document.getElementById("Chart").getContext("2d");
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'رطوبت خاک',
        data: [],
        backgroundColor: 'rgba(13, 110, 253, 0.3)',
        borderColor: '#7A89FF',
        borderWidth: 3,
        hoverBorderWidth: 3.5,
      }]
    },
    options: {
      responsive: false,
      scales: {
        xAxes: [{
          distribution: 'linear'
        }]
      }
    }
  });

  function updateChart() {
    $.ajax({
      url: 'data.php',
      method: 'GET',
      success: function (response) {
        console.log("Data received from PHP: ", response);

        myChart.data.labels = response.labels;
        myChart.data.datasets[0].data = response.data;
        myChart.update(); 
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
      }
    });
  }

  updateChart();


  setInterval(updateChart, 15000);
});
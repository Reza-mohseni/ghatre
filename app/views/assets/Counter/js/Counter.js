var myChart;

function fetchDataAndUpdateChart() {
  $.ajax({
    url: 'https://danatm.ir/app/controllers/watering/GetDatalast30days.php',
    method: 'GET',
    success: function(response) {
      console.log("Response: ", response);

      // Parse the response if it's a JSON string
      if (typeof response === 'string') {
        response = JSON.parse(response);
      }

      // Check if labels and data are present
      if (!response.labels || !response.data) {
        console.error("Invalid data format");
        return;
      }

      var ctx = document.getElementById("Chart").getContext("2d");

      // Destroy the previous chart instance if it exists
      if (myChart) {
        myChart.destroy();
      }

      myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: response.labels,
          datasets: [{
            label: 'رطوبت خاک',
            data: response.data,
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
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("AJAX Error: ", textStatus, errorThrown);
    }
  });
}

// Fetch data initially
fetchDataAndUpdateChart();

// Set up a timer to fetch data every 15 seconds (15000 milliseconds)
setInterval(fetchDataAndUpdateChart, 15000);
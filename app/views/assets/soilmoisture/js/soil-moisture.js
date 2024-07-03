$.ajax({
  url: 'data.php',
  method: 'GET',
  success: function(response) {
    console.log("Response: ", response);
    var ctx = document.getElementById("Chart").getContext("2d");
    var myChart = new Chart(ctx, {
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
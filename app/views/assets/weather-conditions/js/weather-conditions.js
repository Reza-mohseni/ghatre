$(document).ready(function () {
  function createHumidityChart() {
    var ctx = document.getElementById("Chart-humidity").getContext("2d");
    var humidityChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          label: 'رطوبت هوا',
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
          x: {
            type: 'linear',
            position: 'bottom'
          }
        }
      }
    });

    function updateHumidityChart() {
      $.ajax({
        url: 'https://danatm.ir/app/controllers/weather_conditions/GetDatahumiditylast14days.php', 
        method: 'GET',
        success: function (response) {
          if (response.labels && response.labels.length > 0 && response.data && response.data.length > 0) {
            humidityChart.data.labels = response.labels;
            humidityChart.data.datasets[0].data = response.data;
            humidityChart.update(); 
          } else {
            console.error("داده‌های دریافتی خالی یا نامعتبر هستند");
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("خطای AJAX: ", textStatus, errorThrown);
        }
      });
    }

    updateHumidityChart();
    setInterval(updateHumidityChart, 15000);
  }

  function createTemperatureChart() {
    var ctx = document.getElementById("Chart-temperature").getContext("2d");
    var temperatureChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          label: 'دما',
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
          x: {
            type: 'linear',
            position: 'bottom'
          }
        }
      }
    });

    function updateTemperatureChart() {
      $.ajax({
        url: 'https://danatm.ir/app/controllers/weather_conditions/GetDatatemperatureClast14days.php', 
        method: 'GET',
        success: function (response) {
          if (response.labels && response.labels.length > 0 && response.data && response.data.length > 0) {
            temperatureChart.data.labels = response.labels;
            temperatureChart.data.datasets[0].data = response.data;
            temperatureChart.update(); 
          } else {
            console.error("داده‌های دریافتی خالی یا نامعتبر هستند");
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("خطای AJAX: ", textStatus, errorThrown);
        }
      });
    }

    updateTemperatureChart();
    setInterval(updateTemperatureChart, 15000);
  }

  createHumidityChart();
  createTemperatureChart();
});
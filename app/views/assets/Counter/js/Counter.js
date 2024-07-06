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
      url: 'http://localhost/ghatre/app/controllers/watering/GetDatalast30days.php', // مسیر صحیح به فایل PHP
      method: 'GET',
      success: function (response) {
        console.log("Data received from PHP: ", response); // چاپ داده‌ها در کنسول

        // بررسی اینکه آیا داده‌ها و برچسب‌ها مقداردهی شده‌اند
        if (response.labels && response.labels.length > 0 && response.data && response.data.length > 0) {
          // به‌روزرسانی داده‌های نمودار
          myChart.data.labels = response.labels;
          myChart.data.datasets[0].data = response.data;
          myChart.update(); // به‌روزرسانی نمودار
        } else {
          console.error("Received data is empty or invalid");
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
      }
    });
  }

  // اولین درخواست برای بارگذاری اولیه داده‌ها
  updateChart();

  var updateInterval;

  function startInterval() {
    updateInterval = setInterval(updateChart, 15000);
  }

  function stopInterval() {
    clearInterval(updateInterval);
  }

  // بررسی وضعیت نمایش صفحه با استفاده از Page Visibility API
  document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
      stopInterval();
    } else {
      startInterval();
      updateChart(); // به‌روزرسانی فوری پس از بازگشت به صفحه
    }
  });

  // شروع interval به محض بارگذاری صفحه
  startInterval();
});

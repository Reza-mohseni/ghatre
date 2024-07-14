$(document).ready(function () {
  // تنظیمات اولیه نمودار
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
        x: {
          type: 'linear',
          position: 'bottom'
        }
      }
    }
  });

  // تابع برای به‌روزرسانی داده‌های نمودار
  function updateChart() {
    $.ajax({
      url: 'https://danatm.ir/app/controllers/watering/GetDatalast14days.php',
      method: 'GET',
      success: function (response) {
        // بررسی اینکه داده‌های دریافتی خالی یا نامعتبر نباشند
        if (response.labels && response.labels.length > 0 && response.data && response.data.length > 0) {
          myChart.data.labels = response.labels;
          myChart.data.datasets[0].data = response.data;
          myChart.update(); // به‌روزرسانی نمودار با داده‌های جدید
        } else {
          console.error("داده‌های دریافتی خالی یا نامعتبر هستند");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("خطای AJAX: ", textStatus, errorThrown); // مدیریت خطاهای AJAX
      }
    });
  }

  updateChart(); // اولین به‌روزرسانی نمودار

  var updateInterval;

  // تابع برای شروع فاصله زمانی به‌روزرسانی نمودار
  function startInterval() {
    updateInterval = setInterval(updateChart, 15000); // به‌روزرسانی هر 15 ثانیه یکبار
  }

  startInterval(); // شروع فاصله زمانی به‌روزرسانی
});

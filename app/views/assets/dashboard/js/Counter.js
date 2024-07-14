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
        x: {
          type: 'linear',
          position: 'bottom'
        }
      }
    }
  });

  function updateChart() {
    $.ajax({
      url: 'https://danatm.ir/app/controllers/watering/GetDatalast14days.php',
      method: 'GET',
      success: function (response) {

        if (response.labels && response.labels.length > 0 && response.data && response.data.length > 0) {

          myChart.data.labels = response.labels;
          myChart.data.datasets[0].data = response.data;
          myChart.update();
        } else {
          console.error("Received data is empty or invalid");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
      }
    });
  }


  updateChart();

  var updateInterval;

  function startInterval() {
    updateInterval = setInterval(updateChart, 15000);
  }

  startInterval();
});

  $(document).ready(function () {
    const url = 'https://danatm.ir/app/controllers/rain/select.php';
    const itemsPerPage = 10;
    let currentPage = 0;
    let totalItems = 0;

    function renderTable(data) {
      const tableHtml = `
      <div class="table-box">
        <table>
          <tr class="t-header">
            <th>وضعیت</th>
            <th>زمان</th>
            <th>تاریخ</th>
            <th>روز هفته</th>
          </tr>
          ${data.map(item => `
            <tr class="t-item">
              <td>${item.status}</td>
              <td>${item.time}</td>
              <td>${item.date}</td>
              <td>${item.weekday}</td>
            </tr>
          `).join('')}
        </table>
      </div>
    `;

      $('#tables').html(tableHtml);
    }

    function renderPagination(totalItems, currentPage) {
      const pageCount = Math.ceil(totalItems / itemsPerPage);
      let paginationHtml = '';

      if (currentPage > 0) {
        paginationHtml += `<button class="page-btn prev-btn" data-page="${currentPage - 1}">قبلی</button>`;
      }

      let startPage = Math.max(0, currentPage - 2);
      let endPage = Math.min(pageCount - 1, currentPage + 2);

      if (startPage > 0) {
        paginationHtml += `<button class="page-btn" data-page="0">1</button>`;
        if (startPage > 1) {
          paginationHtml += `<span>...</span>`;
        }
      }

      for (let i = startPage; i <= endPage; i++) {
        paginationHtml += `<button class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i + 1}</button>`;
      }

      if (endPage < pageCount - 1) {
        if (endPage < pageCount - 2) {
          paginationHtml += `<span>...</span>`;
        }
        paginationHtml += `<button class="page-btn" data-page="${pageCount - 1}">${pageCount}</button>`;
      }

      if (currentPage < pageCount - 1) {
        paginationHtml += `<button class="page-btn next-btn" data-page="${currentPage + 1}">بعدی</button>`;
      }

      $('#pagination-container').html(paginationHtml);
    }

    $(document).on('click', '.page-btn', function () {
      const page = $(this).data('page');
      currentPage = page;
      fetchData(page);
    });

    function fetchData(page) {
      $.ajax({
        url: `${url}?page=${page}&limit=${itemsPerPage}`,
        method: 'GET',
        success: function (response) {
          console.log('Response from server:', response.totalItems);
          if (response && response.data) {
            const data = response.data;
            renderTable(data);
            if (page === 0) {
              totalItems = response.totalItems;
            }
            renderPagination(totalItems, currentPage);
          } else {
            console.error('Unexpected response format:', response);
          }
        },
        error: function (error) {
          console.error('Error fetching data', error);
          console.error('Full error details:', error.responseText);
        }
      });
    }

    fetchData(0);
  });


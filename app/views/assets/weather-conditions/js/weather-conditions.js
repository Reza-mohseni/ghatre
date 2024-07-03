var ctx = document.getElementById("Chart").getContext("2d");

var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['1/1', '1/2', '1/3', '1/4', '1/5', '1/6', '1/7', '1/8', '1/9', '1/10', '1/11', '1/12', '1/13', '1/14', '1/15', '1/16', '1/17', '1/18', '1/19', '1/20', '1/21', '1/22', '1/23', '1/24', '1/25', '1/26', '1/27', '1/28', '1/29', '1/30', '1/31', '2/1', '2/2', '2/3', '2/4',],
    datasets: [{
      label: 'رطوبت خاک',
      data: ['71', '9', '2', '3', '4', '5', '60', '15', '97', '2', '3', '4', '5', '6', '1', '9', '2', '3', '4', '5', '6', '1', '9', '25', '39', '44', '57', '6', '1', '9', '2', '3', '4', '5', '6', '1', '9', '2', '3', '4', '5', '6',],
      backgroundColor: '#F2F2F280',
      borderColor: [
        '#7A89FF80'
      ],
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


var ctx = document.getElementById("Chart-dama").getContext("2d");

var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [ '1/16', '1/17', '1/18', '1/19', '1/20', '1/21', '1/22', '1/23', '1/24', '1/25', '1/26', '1/27', '1/28', '1/29', '1/30', '1/31', '2/1', '2/2', '2/3', '2/4',],
    datasets: [{
      label: 'رطوبت خاک',
      data: [ '9', '2', '3', '4', '5', '6', '1', '9', '25', '39', '44', '57', '6', '1', '9', '2', '3', '4', '5', '6', '1', '9', '2', '3', '4', '5', '6',],
      backgroundColor: '#F26C3245',
      borderColor: [
        '#F26C3280'
      ],
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

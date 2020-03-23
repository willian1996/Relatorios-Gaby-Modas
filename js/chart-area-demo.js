// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';



function ret(param){
    var valores = [];
    $.each(param, function(key, val){
        valores.push(val);
    });

    return valores;
}


//PEGANDO OS VALORES DO JSON NO ARQUIVO

$.getJSON("relatorios/cadastros_mensal/", function(resposta){
    
    var limiteMaximo = Math.max.apply(null, ret(resposta) );
    
    console.log(limiteMaximo);

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: Object.keys(resposta),
        datasets: [{
          label: "cadastros",
          lineTension: 0.3,
          backgroundColor: "rgba(2,117,216,0.2)",
          borderColor: "rgba(2,117,216,1)",
          pointRadius: 1,
          pointBackgroundColor: "rgba(2,117,216,1)",
          pointBorderColor: "rgba(255,255,255,0.8)",
          pointHoverRadius: 1,
          pointHoverBackgroundColor: "rgba(2,117,216,1)",
          pointHitRadius: 50,
          pointBorderWidth: 2,
          data: ret(resposta),
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: limiteMaximo,
              maxTicksLimit: 5
            },
            gridLines: {
              color: "rgba(0, 0, 0, .125)",
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });
    
});

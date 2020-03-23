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

$.getJSON("relatorios/vendas_anual/", function(resposta){

    
    var limiteMaximo = Math.max.apply(null, ret(resposta) );



    // Bar Chart Example
    var ctx = document.getElementById("myBarChart2");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: Object.keys(resposta),
        datasets: [{
          label: "vendas",
          backgroundColor: "#f00",
          borderColor: "#0F0",
          data: ret(resposta),
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: limiteMaximo,
              maxTicksLimit: 5
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });
    
});

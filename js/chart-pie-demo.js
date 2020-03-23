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

$.getJSON("relatorios/cadastros_por_cidade/", function(resposta){


    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: Object.keys(resposta),
        datasets: [{
          data: ret(resposta),
          backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
        }],
      },
    });
    
    
});

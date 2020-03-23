<?php
require_once 'server/Relatorios.php';
$relatorio = new Relatorios();
$totalCadastros = $relatorio->totalCadastros();
$totalVendas = $relatorio->totalVendas();
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!--css-->
    <link rel="stylesheet" href="css/sb-admin.css">
</head>
<body>
    <div class="card mb-3">
        <h1 align="center">Relatório de Cadastros</h1>
    </div>
    <div class="card mb-3">
        <h3 align="center">Total de cadastrados: <?php echo $totalCadastros; ?></h3>
    </div>
    
    <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            
            Cadastros no mes atual</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-8">
            <div class="card mb-3">
              <div class="card-header">
                
                Cadastros nos últimos 6 meses</div>
              <div class="card-body">
                <canvas id="myBarChart" width="100%" height="50"></canvas>
              </div>
            </div>
          </div>
            
          <div class="col-lg-4">
            <div class="card mb-3">
              <div class="card-header">
                
                Cadastros por Cidade</div>
              <div class="card-body">
                <canvas id="myPieChart" width="100%" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>
    <br><br>
    <div class="card mb-3">
        <h1 align="center">Relatório de Vendas</h1>
    </div>
    <div class="card mb-3">
        <h3 align="center">Total de vendas: <?php echo $totalVendas; ?></h3>
    </div>
<div>
    <div class="card mb-3">
          <div class="card-header">
            
            Vendas no mes atual</div>
          <div class="card-body">
            <canvas id="myAreaChart2" width="100%" height="30"></canvas>
          </div>
        </div>
    <div class="col-lg-12">
        <div class="card mb-3">
            <div class="card-header">

            Vendas nos últimos 12 meses
            </div>
            <div class="card-body">
            <canvas id="myBarChart2" width="100%" height="50"></canvas>
            </div>
        </div>
    </div>

</div>

    
    
    <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Custom scripts for all pages-->
<!--  <script src="js/sb-admin.min.js"></script>-->

  <!-- Demo scripts for this page-->
  <script src="js/chart-area-demo.js"></script>
    <script src="js/chart-area-demo2.js"></script>
  <script src="js/chart-bar-demo.js"></script>
    <script src="js/chart-bar-demo2.js"></script>
  <script src="js/chart-pie-demo.js"></script>
</body>
</html>

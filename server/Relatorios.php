<?php

new Relatorios();

class Relatorios{
    private $pdo;
    private $data_atual;

    public function __construct(){
        $option = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET LC_TIME_NAMES = pt_BR"];
        $this->pdo = new PDO("mysql:host=localhost;dbname=loja_gabymodas;charset=utf8", "root", "", $option);
        $this->data_atual = date('Y-m-d H:i:s');

        $uri = urldecode(filter_input(INPUT_SERVER, 'REQUEST_URI'));
        $request = explode('/', $uri);
        $method = isset($request[3]) ? $request[3] : null;
        $param = isset($request[4]) ? $request[4] : null;


        if(method_exists(get_class(), $method)){
            $this->$method($param);

        }else{
            return false;
        }
    }

    public function cadastros_mensal(){
        $mes = date('m');
        $ano = date('Y');

        $sql = "SELECT DAY(cli_data_cad) as dia, COUNT(cli_id) as registro "
              ."FROM gm_clientes "
              ."WHERE MONTH(cli_data_cad) = '{$mes}' "
              ."AND YEAR(cli_data_cad) = '{$ano}' "
              ."GROUP BY DAY(cli_data_cad) ";

        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        foreach($result as $res){
            $dados[$res->dia] = $res->registro;

        }

        $dias_do_mes = $this->_dias_do_mes();

        $final = array_replace($dias_do_mes, $dados);

        echo json_encode($final);

    }
    public function vendas_mensal(){
        $mes = date('m');
        $ano = date('Y');

        $sql = "SELECT DAY(ped_data) as dia, COUNT(ped_id) as registro "
              ."FROM gm_pedidos "
              ."WHERE MONTH(ped_data) = '{$mes}' "
              ."AND YEAR(ped_data) = '{$ano}' "
              ."GROUP BY DAY(ped_data) ";

        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        foreach($result as $res){
            $dados[$res->dia] = $res->registro;

        }

        $dias_do_mes = $this->_dias_do_mes();

        $final = array_replace($dias_do_mes, $dados);

        echo json_encode($final);
        
    }

    private function _dias_do_mes(){
        $hoje = date('d');

        if($hoje <= 10){
            $esse_mes = 10;

        }else if($hoje <= 15){
            $esse_mes = 15;

        }else if($hoje <= 20){
            $esse_mes = 20;

        }else if($hoje <= 25){
            $esse_mes = 25;

        }else{
            $esse_mes = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        }



        $dias = [1 => '0'];
        for($i = 1; $i < $esse_mes; $i++){
            array_push($dias, '0');

        }
        return $dias;
    }
    
    public function cadastros_semestral(){
        $periodo = date('Y-m-d H:i:s', strtotime('-6 months'));
        
        $sql = "SELECT MONTHNAME(cli_data_cad) as mes, COUNT(cli_id) as registro "
              ."FROM gm_clientes "
              ."WHERE cli_data_cad >= '{$periodo}' "
              ."GROUP BY MONTHNAME(cli_data_cad) "
              ."ORDER BY cli_data_cad";
              
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        
        foreach($result as $res){
            $dados[$res->mes] = $res->registro;

        }
        
        echo json_encode($dados);
    }
    
    public function vendas_anual(){
//        $periodo = date('Y-m-d H:i:s', strtotime('-6 months'));
//        
//        $sql = "SELECT MONTHNAME(cli_data_cad) as mes, COUNT(cli_id) as registro "
//              ."FROM gm_clientes "
//              ."WHERE cli_data_cad >= '{$periodo}' "
//              ."GROUP BY MONTHNAME(cli_data_cad) "
//              ."ORDER BY cli_data_cad";
//              
//        $query = $this->pdo->query($sql);
//        $result = $query->fetchAll(PDO::FETCH_OBJ);
//        
//        foreach($result as $res){
//            $dados[$res->mes] = $res->registro;
//
//        }
//        
//        echo json_encode($dados);
        $periodo = date('Y-m-d', strtotime('-12 months'));
        
        $sql = "SELECT MONTHNAME(ped_data) as mes, COUNT(ped_id) as registro "
               ."FROM gm_pedidos "
               ."WHERE ped_data >= '{$periodo}' "
               ."GROUP BY MONTHNAME(ped_data) "
               ."ORDER BY ped_data";
        
        $query = $this->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        
        foreach($result as $res){
            $dados[$res->mes] = $res->registro;

        }
        
        echo json_encode($dados);
    }
        
        
        
        
    
    public function cadastros_por_cidade(){
        $sql = "SELECT cli_cidade, COUNT(cli_id) as registro FROM gm_clientes GROUP BY cli_cidade";
        $sql = $this->pdo->query($sql);
        $result = $sql->fetchAll(PDO::FETCH_OBJ);
        
        
        
        foreach($result as $res){
            $dados[$res->cli_cidade] = $res->registro;
            
        }
        
        
        echo json_encode($dados);

    }
    
    public function totalCadastros(){
        $sql = "SELECT COUNT(cli_id) as total FROM gm_clientes";
        $sql = $this->pdo->query($sql);
        $total = $sql->fetch();
        
        return $total['total'];
        
    }
    
    public function totalVendas(){
        $sql = "SELECT COUNT(ped_id) as total FROM gm_pedidos";
        $sql = $this->pdo->query($sql);
        $total = $sql->fetch();
        
        return $total['total'];
    }








}

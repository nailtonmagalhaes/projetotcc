<?php
    include_once '../conf/acesso-dados.php';
    include_once 'tab-a.php';
    include_once 'tab-b.php';
    include_once 'tab-c.php';
    include_once 'tab-d.php';
    include_once 'tab-e.php';
    try{


        /* Define o local para Holandês(usar pt_BR para o Português(Brasil) ) */
        //setlocale (LC_ALL, 'pt_BR');//OBS: Dessa forma a data local fica com 5 horas a mais

        /*
        echo "<br>";
        $versao = str_replace(".", "", phpversion());
        $versaofull = phpversion();
        $versaoa = substr(phpversion(), 0, 1);

        echo "<br>";
        echo "Versão: ".$versao;
        echo "<br>";
        echo "Versão FULL: ".$versaofull;
        echo "<br>";
        echo "Versão A: ".$versaoa;
        echo "<br>";
        echo "<br>";
        if($versaoa < 7){
            echo "a versão ".$versao." é menor que sete";
        }else{
            echo "a versão ".$versao." não é menor que sete";
        }
        echo "<br>";

        date_default_timezone_set('America/Sao_Paulo');
        $dataLocal = date('d/m/Y');
        $datalocalhora = date("Y-m-d H:i", strtotime("13:00"));        
        echo "Data Local: ".$dataLocal."<br>";
        echo "Data Local Hora: ".$datalocalhora."<br>";
        echo "de dd/MM/yyyy para Y/m/d: ".date("Y-m-d H:i", strtotime("12/09/1985 13:30"))."<br>";
        */

        date_default_timezone_set('America/Sao_Paulo');
        echo "HORA INÍCIO: ".date('d/m/Y H:i:s', time());
        echo "<br><br>";
        echo "ARINDO TRANSAÇÃO...<br>";
        AcessoDados::abreTransacao();
        echo "TRANSAÇÃO ABERTA COM SUCESSO...<br><br>";

        echo "INSERINDO PRIMEIRO REGISTRO...<br>";
        $primeiroregistro = new TabA();
        $primeiroregistro->salvarDados();
        echo "PRIMEIRO REGISTRO INSERIDO COM SUCESSO...<br><br>";
        
        echo "INSERINDO SEGUNDO REGISTRO...<br>";
        $segundoregistro = new TabB();
        $segundoregistro->TabA = $primeiroregistro;
        $segundoregistro->salvarDados();
        echo "SEGUNDO REGISTRO INSERIDO COM SUCESSO...<br><br>";
        
        echo "INSERINDO TERCEIRO REGISTRO...<br>";
        $terceiroregistro = new TabC();
        $terceiroregistro->TabA = $primeiroregistro;
        $terceiroregistro->salvarDados();
        echo "TERCEIRO REGISTRO INSERIDO COM SUCESSO...<br><br>";
        
        echo "INSERINDO QUARTO REGISTRO...<br>";
        $quartoregistro = new TabD();
        $quartoregistro->TabA = $primeiroregistro;
        $quartoregistro->salvarDados();
        echo "QUARTO REGISTRO INSERIDO COM SUCESSO...<br><br>";

        echo "INSERINDO QUINTO REGISTRO...<br>";
        $quinto = new TabE();
        $quinto->TabB = $segundoregistro;
        $quinto->TabC = $terceiroregistro;
        $quinto->salvarDados();
        echo "QUINTO REGISTRO INSERIDO COM SUCESSO...<br><br>";


        echo "FECHANDO TRANSAÇÃO...<br>";
        AcessoDados::confirmaTransacao();
        echo "TRANSAÇÃO FEHCADA COM SUCESSO<br><br>";

        echo "Todos os registros foram inseridos com sucesso</br></br>";

        echo "HORA TÉRMINO: ".date('d/m/Y H:i:s', time());
        
    }catch(Exception $ex){
        echo $ex->getMessage();
    }
?>
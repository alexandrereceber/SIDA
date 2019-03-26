<?php

/**
 * @author Alexandre José da Silva Marques
 * @Criado: 09/11/2018
 * @filesource
 * 
 */

try{
    
    $ChavesPrimarias    = $_REQUEST["sendChavesPrimarias"];
    $Dados              = $_REQUEST["sendCamposAndValores"];

    if(!is_array($ChavesPrimarias) || !is_array($Dados)){
        throw new Exception("Falta Campos");
    }

    if(empty($Tabela)) throw new Exception("Nenhuma tabela foi definida, favor entrar em contato com o administrador.");
    if(!class_exists($Tabela)) throw new Exception("A classe que representa essa tabela não foi encontrada.", 3409);
    
    $AtualizarDados = new $Tabela();
    $AtualizarDados->StartClock();
    $AtualizarDados->setUsuario("Alexandre");
    $AtualizarDados->AtualizarDadosTabela($ChavesPrimarias, $Dados);
    $AtualizarDados->EndClock();
    $ResultRequest["Modo"]             = "U";
    $ResultRequest["Error"] = false;
   /**
    * Armazena o tempo gasto com o processamento até esse ponto. Atualizar Dados
    */
    ConfigSystema::getEndTimeTotal();
    $ResultRequest["TempoTotal"]["BancoDados"]   =  $AtualizarDados->getTempoTotal();
    $ResultRequest["TempoTotal"]["SitemaTotal"]  = ConfigSystema::getTimeTotal();

    echo json_encode($ResultRequest);

} catch (Exception $ex) {
    $ResultRequest["Modo"] = "U";
    $ResultRequest["Error"]     = true;
    $ResultRequest["Codigo"]    = $ex->getCode();
    $ResultRequest["Mensagem"]  = $ex->getMessage();
    $ResultRequest["Trace"]     = $ex->getTraceAsString();
    $ResultRequest["File"]      = $ex->getFile();

    echo json_encode($ResultRequest);
}
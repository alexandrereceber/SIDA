<?php
/**
 * Criado: 29/09/2018
 * Modificado: 
 */
/**
 * Recebe todas as requisições referentes à banco de dados.
 * @Autor 04953988612
 */

//ini_set('display_errors',1);
//ini_set('display_startup_erros',1);
error_reporting(0);

if(@!include_once "./Cabecalho_Tabelas.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]       = true;
    $ResultRequest["Codigo"]      = 3588;
    $ResultRequest["Mensagem"]    = "O arquivo de configuração não foi encontrado. Tabelas";
    
    echo json_encode($ResultRequest);
    exit;
}; 


switch ($Operacao) {
    case "Select":

        if(!@include_once ConfigSystema::get_Path_Systema() . '/BancoDados/CRUD/Select/SelecionarDados.php'){
            $ResultRequest["Modo"]        = "Include";
            $ResultRequest["Error"]       = true;
            $ResultRequest["Codigo"]      = 3400;
            $ResultRequest["Mensagem"]    = "A operação não foi encontrada. Controller";

            echo json_encode($ResultRequest); 
            exit;
        }
    break;
    
    case "Inserir":
        if(!@include_once ConfigSystema::get_Path_Systema() . '/BancoDados/CRUD/Insert/InserirDados.php'){
            $ResultRequest["Modo"]        = "Include";
            $ResultRequest["Error"]       = true;
            $ResultRequest["Codigo"]      = 3401;
            $ResultRequest["Mensagem"]    = "A operação não foi encontrada. Controller";

            echo json_encode($ResultRequest); 
            exit;
        }
        break;

    case "Update":
        if(!@include_once ConfigSystema::get_Path_Systema() . '/BancoDados/CRUD/Update/AtualizarDados.php'){
            $ResultRequest["Modo"]        = "Include";
            $ResultRequest["Error"]       = true;
            $ResultRequest["Codigo"]      = 3402;
            $ResultRequest["Mensagem"]    = "A operação não foi encontrada. Controller";

            echo json_encode($ResultRequest); 
            exit;
        }
        break;

    case "Delete":
        if(!@include_once ConfigSystema::get_Path_Systema() . '/BancoDados/CRUD/Delete/ExcluirDados.php'){
            $ResultRequest["Modo"]        = "Include";
            $ResultRequest["Error"]       = true;
            $ResultRequest["Codigo"]      = 3403;
            $ResultRequest["Mensagem"]    = "A operação não foi encontrada. Controller";

            echo json_encode($ResultRequest); 
            exit;
        }
        break;

    case "UploadsFiles":
        if(!@include_once ConfigSystema::get_Path_Systema() . '/uploadsFiles/BaixarFiles.php'){
            $ResultRequest["Modo"]        = "Include";
            $ResultRequest["Error"]       = true;
            $ResultRequest["Codigo"]      = 3404;
            $ResultRequest["Mensagem"]    = "A operação não foi encontrada. Controller";

            echo json_encode($ResultRequest); 
            exit;
        }
        break;
        
    case "LoadPage":
        if(!@include_once ConfigSystema::get_Path_Systema() . '/LoadPages/LoadPages.php'){
            $ResultRequest["Modo"]        = "Include";
            $ResultRequest["Error"]       = true;
            $ResultRequest["Codigo"]      = 3404;
            $ResultRequest["Mensagem"]    = "A operação não foi encontrada. Controller";

            echo json_encode($ResultRequest); 
            exit;
        }
        break;        
        
    default:
        break;
}
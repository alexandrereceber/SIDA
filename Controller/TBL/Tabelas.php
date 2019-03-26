<?php
/**
 * Criado: 29/09/2018
 * Modificado: 
 * Erros catalogados:
 * 3588 - O arquivo de configuração não foi encontrado. Controller
 * 3585 - O arquivo Engines de configuração do banco de dados não foi localizado. Modelo de tabelas. - ModelosTabelas.php
 * 3586 - O arquivo de configuração não foi encontrado. Modelo de tabelas - ModelosTabelas.php
 * 3587 - O arquivo de configuração não foi encontrado. BDSQL - BDSQL_PDO.php
 * 3589 - A configuração do banco de dados não foi encontrado. Controller
 * 3590 - Error sessão. Controller - Cabecalho_Tabelas.php
 * 3692 - Login necessário, favor entrar em contato com o administrador!. - Cabecalho_Tabelas.php
 * 3693 - Tempos não estão sincronizados, favor entrar em contato com o administrador!. - Cabecalho_Tabelas.php
 * 3694 - Tempo de sessão expirado, favor efetuar login novamente!. - Cabecalho_Tabelas.php
 * 3691 - Login necessário, favor entrar em contato com o administrador!. - Cabecalho_Tabelas.php
 * 3400 - A operação não foi encontrada. Controller
 * 3401 - A operação não foi encontrada. Controller
 * 3402 - A operação não foi encontrada. Controller
 * 3403 - A operação não foi encontrada. Controller
 * 3404 - A operação não foi encontrada. Controller - ExcluirDados.php
 * 3405 - Nenhuma tabela foi definida, favor entrar em contato com o administrador. SelecionarDados.php
 * 3406 - A classe que representa essa tabela não foi encontrada. SelecionarDados.php
 * 3407 - A classe que representa essa tabela não foi encontrada. InserirDados.php
 * 3409 - A classe que representa essa tabela não foi encontrada. AtualizarDados.php
 * 
 * 35200 - Tabela de privilégios não foi encontrada. - ModeloTabelas.php
 * 35201 - Usuário definido não possui privilégios nessa tabela. - ModeloTabelas.php
 * 35202 - Nenhum usuário foi definido para que possa ser verificado o acesso. - ModeloTabelas.php
 * 35203 - PDO Erros diversos - getVerificarPrivilegios - ModeloTabelas.php
 * 35204 - InserirDadosTabela() - ModeloTabelas.php
 * 35205 - AtualizarDadosTabela() - ModeloTabelas.php
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